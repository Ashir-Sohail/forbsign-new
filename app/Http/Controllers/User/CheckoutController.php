<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Models\Product;
use App\Models\ProductOptionValue;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use App\Models\ManageSite;
use App\Http\Requests\StripePaymentRequest;
use App\Models\Website;

class CheckoutController extends Controller
{
    public const ORDER_STATUS_PENDING = 'pending';
    public const ORDER_STATUS_PROCESSING = 'processing';
    public const PAYMENT_STATUS_PAID = 'paid';
    public const PAYMENT_STATUS_UNPAID = 'unpaid';
    public const PAYMENT_STATUS_SUCCEEDED = 'succeeded';

    public function index()
    {
        $carts = session()->get('cart', []);
        if (empty($carts)) {
            return redirect()->route('user.store')->with('error', 'Your cart is empty.');
        }

        $total_cart = 0;

        foreach ($carts as $item) {
            $product = Product::find($item['id']);

            if (!$product) {
                return redirect()->route('user.cart')->with('error', 'A product in your cart no longer exists.');
            }

            //  Check if product has required options
            $hasRequiredOptions = DB::table('product_options')
                ->where('product_id', $product->id)
                ->where('required', 1)
                ->exists();

            if ($hasRequiredOptions) {
                $options = $item['options'] ?? [];

                foreach ($options as $option) {
                    $optionValue = DB::table('product_option_values')
                        ->where('product_id', $product->id)
                        ->where('option_value_id', $option['option_value_id'])
                        ->first();

                    if (!$optionValue) {
                        return redirect()->route('user.cart')->with('error', "Option value not found for product '{$product->name}'.");
                    }

                    if ($optionValue->subtract == 1 && $optionValue->quantity < $item['quantity']) {
                        return redirect()->route('user.cart')->with('error', "Not enough stock for selected option in '{$product->name}'.");
                    }
                }
            } else {
                //  Product has no required options, check total stock
                if ($product->total_stock < $item['quantity']) {
                    return redirect()->route('user.cart')->with('error', "Insufficient stock for product: {$product->name}");
                }
            }

            //  Calculate total
            $total_cart += (float)$item['quantity'] * (float)$item['current_price'];
        }

        $billing_address = null;
        if (Auth::check()) {
            $billing_address = BillingAddress::where('user_id', Auth::id())->first();
        }

        $user = Auth::user();

        return view('user.checkout', compact('billing_address', 'carts', 'total_cart', 'user'));
    }


    public function StripePayment(StripePaymentRequest $request)
    {
        // dd($request->all());
        if (!Auth::check()) {
            return redirect()->route('user.checkout')->with('error', 'Please log in to continue with the payment.');
        }

        $cartItems = session('cart', []);


        if (empty($cartItems)) {
            return redirect()->route('user.cart')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            // 1. Save Billing Address
            $host = $request->getHost();  // e.g. "abc.com" or "def.com"
            // Remove the ".com" or any top-level domain
            $domain = explode('.', $host)[0];  // "abc" or "def"
            // Find the website ID based on the domain
            $webid = Website::where('domain_name', $domain)->value('id');
            $billing = BillingAddress::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'address1'    => $request->address1,
                    'address2'    => $request->address2,
                    'phone'     => $request->contact,
                    'city'        => $request->city,
                    'zip_code'    => $request->zip_code,
                    'check_input' => $request->check_input,
                ]
            );

            // 2. Create Order
            $order = Order::create([
                'user_id'            => Auth::id(),
                'website_id'         => $webid,
                'billing_address_id' => $billing->id,
                'order_status'       => self::ORDER_STATUS_PENDING,
                'total'              => 0,
            ]);

            $cartTotal = 0;

            // 3. Handle Cart Items
            foreach ($cartItems as $item) {
                $product = Product::findOrFail($item['id']);
                $basePrice = $item['current_price'];
                $finalPrice = $basePrice;
                $quantity = $item['quantity'];
                $selectedCustomization = $item['customization'] ?? [];
                $selectedOptions = $item['options'] ?? [];

                // 3.1 Handle Option Values
                foreach ($selectedOptions as $option) {
                    $optionValueId = $option['option_value_id'];

                    if (!$optionValueId) {
                        continue;
                    }

                    $optionValue = ProductOptionValue::where('product_id', $product->id)
                        ->where('option_value_id', $optionValueId)
                        ->lockForUpdate()
                        ->first();

                    if (!$optionValue) {
                        throw new \Exception("Invalid option selected for product: " . $product->name);
                    }

                    // Price adjustment
                    // $priceAdjustment = floatval($option['price']);
                    // if ($option['price_prefix'] === '-') {
                    //     $finalPrice -= $priceAdjustment;
                    // } else {
                    //     $finalPrice += $priceAdjustment;
                    // }

                    // Quantity subtract
                    if ((int)$option['subtract'] === 1) {

                        if ($optionValue->quantity < $quantity) {
                            throw new \Exception("Not enough stock for selected option in: " . $product->name);
                        }

                        $optionValue->quantity -= $quantity;
                        $optionValue->save();
                    }
                }


                //  Check if product has required options
                $hasRequiredOptions = DB::table('product_options')
                    ->where('product_id', $product->id)
                    ->where('required', 1)
                    ->exists();

                if (!$hasRequiredOptions) {
                    //  If no required options, subtract from main product stock
                    if ($product->total_stock < $quantity) {
                        throw new \Exception("Not enough stock for product: " . $product->name);
                    }
                    $product->decrement('total_stock', $quantity);
                };

                // 3.3 Create Order Item
                OrderItem::create([
                    'order_id'         => $order->id,
                    'product_id'       => $product->id,
                    'quantity'         => $quantity,
                    'price'            => $finalPrice,
                    'option_value_ids' => !empty($selectedOptions)
                        ? json_encode(array_column($selectedOptions, 'option_value_id'))
                        : null,
                    'customization' => !empty($selectedCustomization)
                        ? json_encode($selectedCustomization)
                        : null,

                ]);

                $cartTotal += $finalPrice * $quantity;
            }

            // 4. Update Order Total
            $order->update(['total' => $cartTotal]);

            // 5. Stripe Payment
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $charge = \Stripe\Charge::create([
                "amount" => $request->price * 100,
                // "amount"      => $cartTotal * 100, // Stripe uses cents
                "currency"    => "gbp",
                "source"      => $request->stripeToken,
                "description" => "Payment from " . Auth::user()->name,
            ]);

            if (!$charge || !isset($charge->id)) {
                throw new \Exception("Stripe payment failed. Please try again.");
            }

            // 6. Transaction Save
            Transaction::create([
                'website_id'      => $webid,
                'order_id'         => $order->id,
                'user_id'          => Auth::id(),
                'total_amount'     => $cartTotal,
                'payment_status'   => self::PAYMENT_STATUS_PAID,
                'payment_method'   => 'stripe',
                'stripe_charge_id' => $charge->id,
            ]);

            // 7. Update Order Status
            $order->update(['order_status' => self::ORDER_STATUS_PROCESSING]);



            DB::commit();
            // 8. Emails

            $order->load('user');

            try {
                Mail::to(Auth::user()->email)->queue(new OrderConfirmationMail($order));
            } catch (\Exception $e) {
                Log::error('User Email Failed: ' . $e->getMessage());
            }

            try {
                Mail::to(config('mail.admin_email'))->queue(new OrderConfirmationMail($order, true));
            } catch (\Exception $e) {
                Log::error('Admin Email Failed: ' . $e->getMessage());
            }


            // 9. Clear Cart
            session()->forget('cart');
            return redirect()->route('checkout.thankyou', $order->id);


            // return redirect()->route('user.home')->with('success', 'Payment successful and order placed.');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd('catch');
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function thankYou(Order $order)
    {
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.thankyou', compact('order', 'footer_value'));
    }


    public function order()
    {
        $orders = Order::with('transactions')
            ->whereUserId(auth()->id())
            ->latest()
            ->get();

        return view('user.order', compact('orders'));
    }

    public function storeBillingAddress(Request $request)
    {
        $request->validate([
            'address1'    => 'required|string|max:255',
            'address2'    => 'nullable|string|max:255',
            'zip_code'       => 'required|string|max:20',
            'city'        => 'required|string|max:100',
            'check_input' => 'nullable|boolean',
            'contact'    => 'required|string|max:20',

        ]);

        BillingAddress::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'address1'  => $request->address1,
                'address2'  => $request->address2,
                'zip_code'  => $request->zip_code,
                'city'      => $request->city,
                'check_input'      => $request->check_input,
                'contact'   => $request->contact,
            ]
        );

        return redirect()->route('user.dashboard')->with('success', 'Billing address saved successfully.');
    }

    public function update_billing_address(Request $request)
    {

        $validate = $request->validate([
            'address1' => 'required',
            'address2' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $billing_address = BillingAddress::whereUserId(auth()->id())->first();
        if ($billing_address) {
            BillingAddress::where('user_id', auth()->id())->update([
                'user_id' => auth()->id(),
                'address1' =>  $request->address1,
                'address2' => $request->address2,
                'zip_code' => $request->zip_code,
                'company' => $request->company ?? ' ',
                'city' => $request->city,
                'phone' => $request->phone,
            ]);
        }
        return redirect()->route('user.payment')->with('success', 'billing address add successfully');
    }

    public function payment()
    {
        if (Cart::whereUserId(auth()->id())->count() <= 0) {
            return redirect()->route('user.store')->with('error', 'Your cart is empty');
        }
        $billing_address = BillingAddress::whereUserId(auth()->id())->first();
        return view('user.payment', compact('billing_address'));
    }

    function checkout_submit_cash_on_delivery(Request $request)
    {
        $order = new Order();
        $transaction = new Transaction();
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = substr(str_shuffle($characters), 0, 10);

        $total_amount = Cart::whereUserId(auth()->id())->sum('sub_total');
        $product_ids = Cart::whereUserId(auth()->id())->pluck('product_id');
        $order->uuid = $randomString;
        $order->transaction_id = 'null';
        $order->user_id = auth()->id();
        $order->total_amount = $total_amount;
        $order->payment_status = self::PAYMENT_STATUS_UNPAID;
        $order->order_status = self::ORDER_STATUS_PENDING;
        $order->product_id = json_encode($product_ids);
        $order->payment_method = $request->payment_method;
        $order->save();

        $transaction->order_id = $order->uuid;
        $transaction->user_id = auth()->id();
        $transaction->payment_status = self::PAYMENT_STATUS_UNPAID;
        $transaction->order_status = self::ORDER_STATUS_PENDING;
        $transaction->total_amount = $total_amount;
        $transaction->save();

        Cart::whereUserId(auth()->id())->delete();

        return redirect()->route('user.order')->with('success', 'Order place successfully');
    }

    public function stripePost(Request $request)
    {
        $total_amount = Cart::whereUserId(auth()->id())->sum('sub_total');


        $order = new Order();
        $transaction = new Transaction();
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = substr(str_shuffle($characters), 0, 10);

        $product_ids = Cart::whereUserId(auth()->id())->pluck('product_id');
        $order->uuid = $randomString;
        // $order->transaction_id = $charge->id;
        $order->transaction_id = 'askldfja12312';
        $order->user_id = auth()->id();
        $order->total_amount = $total_amount;
        $order->payment_status = self::PAYMENT_STATUS_SUCCEEDED;
        $order->order_status = self::ORDER_STATUS_PENDING;
        $order->product_id = json_encode($product_ids);
        $order->payment_method = $request->payment_method;
        $order->save();

        $transaction->order_id = $order->uuid;
        $transaction->user_id = auth()->id();
        $transaction->payment_status = self::PAYMENT_STATUS_SUCCEEDED;
        $transaction->order_status = self::ORDER_STATUS_PENDING;
        $transaction->total_amount = $total_amount;
        $transaction->save();

        Cart::whereUserId(auth()->id())->delete();

        return redirect()->route('user.order')->with('success', 'Order place successfully');
    }

    public function checkout_submit_back_transfer(Request $request)
    {
        $order = new Order();
        $transaction = new Transaction();
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = substr(str_shuffle($characters), 0, 10);

        $total_amount = Cart::whereUserId(auth()->id())->sum('sub_total');
        $product_ids = Cart::whereUserId(auth()->id())->pluck('product_id');
        $order->uuid = $randomString;
        $order->transaction_id = $request->transaction;
        $order->user_id = auth()->id();
        $order->total_amount = $total_amount;
        $order->payment_status = self::PAYMENT_STATUS_UNPAID;
        $order->order_status = self::ORDER_STATUS_PENDING;
        $order->product_id = json_encode($product_ids);
        $order->payment_method = $request->payment_method;
        $order->save();

        $transaction->order_id = $order->uuid;
        $transaction->user_id = auth()->id();
        $transaction->payment_status = self::PAYMENT_STATUS_UNPAID;
        $transaction->order_status = self::ORDER_STATUS_PENDING;
        $transaction->total_amount = $total_amount;
        $transaction->save();

        Cart::whereUserId(auth()->id())->delete();

        return redirect()->route('user.order')->with('success', 'Order place successfully');
    }
}
