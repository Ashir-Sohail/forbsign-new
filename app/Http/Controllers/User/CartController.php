<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOptionValue;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CartPreference;


class CartController extends Controller
{

    public function index()
    {
        //  On cart page authenticated user add product to wishlist
        $wishlistProductIds = [];
        if (auth()->check()) {
            $wishlistProductIds = Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray();
        }
        $cartpreferences = CartPreference::pluck('value', 'name')->toArray();
        return view('user.cart', compact('wishlistProductIds','cartpreferences'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $options = $request->input('options', []);
        // dd($product, $options);

        $cart = session()->get('cart', []);


        // Base price of product
        $basePrice = $product->current_price;
        $adjustedPrice = $basePrice;

        $customization = [
            'text_input' => $request->input('text_input'),
            'font_style' => $request->input('font_style'),
            'text_color' => $request->input('text_color'),
            'usage_type' => $request->input('usage_type'),
            'text_align' => $request->input('text_align'),
            // 'text_align' => $request->input('text_align'), // if used
        ];
        // Generate a unique key based on product ID + selected options
        $productKey = (string) $product->id;

        if (!empty($options)) {
            $optionKeyParts = [];

            foreach ($options as $opt) {
                $optionId = $opt['option_id'] ?? '';
                $optionValueId = $opt['option_value_id'] ?? '';
                $optionKeyParts[] = $optionId . ':' . $optionValueId;
                if (isset($opt['price_prefix'])) {
                    // Adjust price based on option value
                    if ($opt['price_prefix'] == '+') {
                        $adjustedPrice += $opt['price'];
                    } elseif ($opt['price_prefix'] == '-') {
                        $adjustedPrice -= $opt['price'];
                    }
                }
                // // Fetch option value to adjust price
                // $optionValue = ProductOptionValue::find($optionValueId); // adjust model path if needed

                // if ($optionValue) {
                //     $adjustedPrice = $optionValue->price_modifier;
                // }
            }

            $productKey .= '-' . implode('|', $optionKeyParts);
        }



        if (isset($cart[$productKey])) {
            $cart[$productKey]['quantity']++;
        } else {
            $cart[$productKey] = [
                'id'              => $product->id,
                'name'            => $product->name,
                'quantity'        => 1,  // Start with quantity 1
                'current_price'   => $adjustedPrice,
                'previous_price'  => $product->previous_price,
                'description'     => $product->description,
                'featured_image'  => $product->featured_image,
                'images'          => $product->images,
                'slug'            => $product->slug,
                'category_id'     => $product->cat_id,
                'brand'           => $product->brand,
                'stock'           => $product->stock,
                'created_at'      => $product->created_at,
                'options'         => $options,
                'customization'   => $customization,
                'option_value_id' => $options[0]['option_value_id'] ?? null,


            ];
        }

        // Log::info('Cart contents Updated Values:', [$cart]);
        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart']);
    }

    // public function addToCart(Request $request)
    // {
    //     // dd($request->all());
    //     $cart = session()->get('cart', []);

    //     // CASE 1: Customized Product (no product_id)
    //     if (!$request->has('product_id') && $request->has('custom_text')) {
    //         $customData = $request->only([
    //             'custom_text',
    //             'font',
    //             'color',
    //             'alignment',
    //             'image_id',
    //             'image_url',
    //             'size_id',
    //             'size',
    //             'usage_type'
    //         ]);

    //         // Optional pricing logic for custom
    //         $customPrice = $request->input('size_price', 0);

    //         $uniqueKey = 'custom-' . md5(json_encode($customData));

    //         if (isset($cart[$uniqueKey])) {
    //             $cart[$uniqueKey]['quantity']++;
    //         } else {
    //             $cart[$uniqueKey] = [
    //                 'type'           => 'custom',
    //                 'quantity'       => 1,
    //                 'current_price'  => $customPrice,
    //                 'previous_price' => null,
    //                 'name'           => 'Custom Neon',
    //                 'description'    => 'Customized neon sign',
    //                 'featured_image' => $request->image_url,
    //                 'slug'           => null,
    //                 'category_id'    => null,
    //                 'brand'          => null,
    //                 'stock'          => null,
    //                 'created_at'     => now(),
    //                 'options'        => [],
    //                 'custom'         => $customData
    //             ];
    //         }

    //         session()->put('cart', $cart);
    //         return response()->json(['message' => 'Customized product added to cart']);
    //     }

    //     // CASE 2: Normal Product
    //     $product = Product::findOrFail($request->input('product_id'));
    //     $options = $request->input('options', []);

    //     // Base price of product
    //     $basePrice = $product->current_price;
    //     $adjustedPrice = $basePrice;

    //     // Generate key from product + options
    //     $productKey = (string) $product->id;

    //     if (!empty($options)) {
    //         $optionKeyParts = [];

    //         foreach ($options as $opt) {
    //             $optionId = $opt['option_id'] ?? '';
    //             $optionValueId = $opt['option_value_id'] ?? '';
    //             $optionKeyParts[] = $optionId . ':' . $optionValueId;

    //             if (isset($opt['price_prefix'])) {
    //                 if ($opt['price_prefix'] === '+') {
    //                     $adjustedPrice += $opt['price'];
    //                 } elseif ($opt['price_prefix'] === '-') {
    //                     $adjustedPrice -= $opt['price'];
    //                 }
    //             }
    //         }

    //         $productKey .= '-' . implode('|', $optionKeyParts);
    //     }

    //     if (isset($cart[$productKey])) {
    //         $cart[$productKey]['quantity']++;
    //     } else {
    //         $cart[$productKey] = [
    //             'id'              => $product->id,
    //             'name'            => $product->name,
    //             'quantity'        => 1,
    //             'current_price'   => $adjustedPrice,
    //             'previous_price'  => $product->previous_price,
    //             'description'     => $product->description,
    //             'featured_image'  => $product->featured_image,
    //             'images'          => $product->images,
    //             'slug'            => $product->slug,
    //             'category_id'     => $product->cat_id,
    //             'brand'           => $product->brand,
    //             'stock'           => $product->stock,
    //             'created_at'      => $product->created_at,
    //             'options'         => $options
    //         ];
    //     }

    //     session()->put('cart', $cart);

    //     return response()->json(['message' => 'Product added to cart']);
    // }



    public function cartCount()
    {
        $cart = session()->get('cart', []);
        $totalQuantity = 0;

        foreach ($cart as $item) {
            $totalQuantity += isset($item['quantity']) ? $item['quantity'] : 1;
        }

        return response()->json(['count' => $totalQuantity]);
    }


    // ****  Method to remove all items from cart  ****
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart session cleared!');
    }


    public function removeSelectedItems(Request $request)
    {
        $ids = $request->input('ids'); // Get selected session IDs

        if (empty($ids)) {
            return response()->json(['error' => 'No items selected'], 400);
        }

        $cart = session()->get('cart', []);

        foreach ($ids as $id) {
            unset($cart[$id]); // Remove selected item from session
        }

        session()->put('cart', $cart); // Update session

        return response()->json(['success' => 'Selected items removed.']);
    }


    public function updateQuantity(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $cart = session()->get('cart', []);

        //  Find the matching cart key (even if it has options)
        $matchingKey = null;
        foreach ($cart as $key => $item) {
            if (Str::startsWith($key, (string)$productId)) {
                $matchingKey = $key;
                break;
            }
        }

        if (!$matchingKey || !isset($cart[$matchingKey])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found in cart.'
            ], 404);
        }

        $product = Product::find($productId);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found in database.'
            ], 404);
        }

        //  Check for required options
        $hasRequiredOption = DB::table('product_options')
            ->where('product_id', $productId)
            ->where('required', 1)
            ->exists();

        if ($hasRequiredOption) {
            $optionValueId = $cart[$matchingKey]['options'][0]['option_value_id'] ?? null;

            if (!$optionValueId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Option value not found in cart.'
                ], 400);
            }

            $optionValue = DB::table('product_option_values')
                ->where('product_id', $productId)
                ->where('option_value_id', $optionValueId)
                ->first();

            if (!$optionValue) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Option value not found in database.'
                ], 404);
            }

            if ($optionValue->subtract == 1 && $quantity > $optionValue->quantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Only {$optionValue->quantity} items available for this option."
                ], 400);
            }
        } else {
            // No required options – check stock from product
            if ($product->total_stock !== null && $quantity > $product->total_stock) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Only {$product->total_stock} items available in stock."
                ], 400);
            }
        }

        //  Update cart
        $cart[$matchingKey]['quantity'] = $quantity;
        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Quantity updated successfully.',
            'updated_price' => $cart[$matchingKey]['current_price'] * $quantity
        ]);
    }
}
