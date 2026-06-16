<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Compare;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\ManageSite;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Subscribe;
use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\CustomImage;
use App\Models\CustomFont;
use App\Models\CustomColor;
use App\Models\CustomSize;
use App\Models\Order;
use App\Models\HomePreference;
use App\Models\AboutPreference;
use App\Models\ServicePreference;
use App\Models\StorePreference;
use App\Models\BrandsPreference;
use App\Models\CategoriesPreference;
use App\Models\CartPreference;
use App\Models\Website;

class HomeController extends Controller
{

    public function index(): View
    {
        $homepreferences = HomePreference::pluck('value', 'name')->toArray();
        $categories = Category::with('children') // Eager load child categories
            ->where('status', 1)
            ->whereNull('parent_id')
            ->get();

        $allActiveCategories = Category::where('status', 1)
            ->orderBy('serial', 'asc')
            ->take(4)
            ->get();

        $products = Product::where('status', 1)->get();


        $brands = Brand::where('status', 1)->latest()->take(4)->get();
        $services = Service::latest()->limit(4)->get();

        $blogs = Blog::latest()->limit(10)->get();
        $sliders = Slider::take(4)->get();

        // Load custom sections from ManageSite
        $productsCategories = $categories; // Reuse the categories already fetched
        $home_page_value = json_decode(optional(ManageSite::where('key', 'home_page')->first())->value);
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);

        return view('user.home', compact(
            'homepreferences',
            'brands',
            'services',
            'blogs',
            'sliders',
            'home_page_value',
            'productsCategories',
            'categories',
            'allActiveCategories',
            'products',
            'footer_value',
        ));
    }


    function add_to_wishlist($id): RedirectResponse
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($wishlist) {
            return redirect()->back()->with('success', 'Product is already in wishlist');
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $id
            ]);
            return redirect()->back()->with('success', 'Product added to wishlist successfully');
        }
    }

    function add_to_compare($id): RedirectResponse
    {
        $compare = Compare::whereUserIdAndProductId(auth()->id(), $id)->first();
        if ($compare) {
            return redirect()->back()->with('success', 'Product already in compare');
        } else {
            Compare::create([
                'user_id' => auth()->id(),
                'product_id' => $id
            ]);
            return redirect()->back()->with('success', 'Product add to successfully compare');
        }
    }

    function add_to_cart(Request $request)
    {
        $requestData = $request->cartData;
        if (!$requestData || empty($requestData['product_id']) || empty($requestData['selectedFont']) || empty($requestData['selectedSize'])) {
            return response()->json(['success' => false, 'message' => 'Required fields are missing']);
        }

        $product_id = $requestData['product_id'];
        $selectedFont = $requestData['selectedFont'];
        $selectedSize = $requestData['selectedSize'];
        $overallWidth = $requestData['overallWidth'];
        $selectedSignLayout = $requestData['selectedSignLayout'];
        $homeNumber = $requestData['homeNumber'];
        $streetName = $requestData['streetName'];
        $text = $requestData['text'];
        $textStyle = $requestData['textStyle'];
        $top = $requestData['top'];
        $bottom = $requestData['bottom'];
        $product = Product::findOrFail($product_id);
        // $cart = Cart::whereUserIdAndProductId(auth()->id(), $product_id)->first();

        // if ($cart) {
        //     $cart->qty = $cart->qty + 1;
        //     $cart->sub_total = $cart->total * $cart->qty;
        //     $cart->save();
        //     return redirect()->back()->with('success', 'Product update successfully');
        // } else {
        $number = str_replace(",", "", $product->current_price);
        // Check if the same product with the same options already exists in the cart
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product_id)
            ->where('selectedFont', $selectedFont)
            ->where('selectedSize', $selectedSize)
            ->where('overallWidth', $overallWidth)
            ->where('selectedSignLayout', $selectedSignLayout)
            ->where('homeNumber', $homeNumber)
            ->where('streetName', $streetName)
            ->where('text', $text)
            ->where('textStyle', $textStyle)
            ->where('top', $top)
            ->where('bottom', $bottom)
            ->first();

        if ($cart) {
            // If cart item exists, increase the quantity and update the subtotal
            $cart->qty += 1;
            $cart->sub_total = $cart->total * $cart->qty;
            $cart->save();

            return response()->json(['success' => true, 'message' => 'Product quantity updated successfully']);
        } else {
            // Create a new cart item if it doesn't exist
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product_id,
                'selectedFont' => $selectedFont,
                'selectedSize' => $selectedSize,
                'overallWidth' => $overallWidth,
                'selectedSignLayout' => $selectedSignLayout,
                'homeNumber' => $homeNumber,
                'streetName' => $streetName,
                'text' => $text,
                'textStyle' => $textStyle,
                'top' => $top,
                'bottom' => $bottom,
                'total' => $number,
                'sub_total' => $number,
                'qty' => 1,
            ]);

            return response()->json(['success' => true, 'message' => 'Product added to cart successfully']);
        }

        // dd(Cart::whereUserId(auth()->id())->latest()->get());

        // Wishlist::whereProductId($id)->delete();
        //     return redirect()->back()->with('success', 'Product add to cart successfully');
        // }
    }

    // function add_to_cart(Request $request)
    // {
    //     // Define validation rules
    //     $validator = Validator::make($request->cartData, [
    //         'product_id' => 'required|exists:products,id', // Ensure product exists
    //         'selectedFont' => 'required|string|max:255',   // Font must be provided and be a string
    //         'selectedSize' => 'required|string|max:255',   // Size must be provided and be a string
    //         'overallWidth' => 'required|numeric|min:0',    // Width must be a positive number
    //         'selectedSignLayout' => 'required|string|max:255', // Layout must be provided and be a string
    //         'homeNumber' => 'required|string|max:10',      // Home number must be a string, max 10 characters
    //         'streetName' => 'required|string|max:255',     // Street name must be provided
    //         'text' => 'nullable|string|max:500',           // Text is optional, max 500 characters
    //         'textStyle' => 'nullable|string|max:255',      // Text style is optional, max 255 characters
    //         'top' => 'nullable|string|max:255',            // Top text is optional, max 255 characters
    //         'bottom' => 'nullable|string|max:255',         // Bottom text is optional, max 255 characters
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
    //     }

    //     $requestData = $request->cartData;
    //     $product_id = $requestData['product_id'];
    //     $selectedFont = $requestData['selectedFont'];
    //     $selectedSize = $requestData['selectedSize'];
    //     $overallWidth = $requestData['overallWidth'];
    //     $selectedSignLayout = $requestData['selectedSignLayout'];
    //     $homeNumber = $requestData['homeNumber'];
    //     $streetName = $requestData['streetName'];
    //     $text = $requestData['text'];
    //     $textStyle = $requestData['textStyle'];
    //     $top = $requestData['top'];
    //     $bottom = $requestData['bottom'];
    //     $product = Product::findOrFail($product_id);

    //     // Assuming no existing cart logic (can be added back if needed)
    //     $number = str_replace(",", "", $product->current_price);
    //     Cart::create([
    //         'user_id' => auth()->id(),
    //         'product_id' => $product_id,
    //         'selectedFont' => $selectedFont,
    //         'selectedSize' => $selectedSize,
    //         'overallWidth' => $overallWidth,
    //         'selectedSignLayout' => $selectedSignLayout,
    //         'homeNumber' => $homeNumber,
    //         'streetName' => $streetName,
    //         'text' => $text,
    //         'textStyle' => $textStyle,
    //         'top' => $top,
    //         'bottom' => $bottom,
    //         'total' => $number,
    //         'sub_total' => $number,
    //         'qty' => 1,
    //     ]);

    //     return response()->json(['success' => true, 'message' => 'Product added to cart successfully']);
    // }



    public function product_details($slug): View
    {
        $product = Product::whereSlug($slug)->firstOrFail();
        $products = Product::whereCatId($product->cat_id)->latest()->get();
        $sessionCart = session()->get('cart', []);
        $inCart = isset($sessionCart[$product->id]);

        $productOptions = Product::with([
            'productOptions.option',                    // Loads each ProductOption and its Option
            'productOptionValues.option_values.option'    // Loads each ProductOptionValue, its OptionValue, and the related Option
        ])
            ->where('slug', $slug)
            ->firstOrFail();
        // dd($productOptions->toArray());
        return view('user.product-details', compact('product', 'products', 'inCart'));
    }

    public function customize_product()
    {
        $customImages = CustomImage::where('status', 1)->orderBy('serial')->get();
        $defaultImage = $customImages->first();
        // dd($defaultImage->toArray());

        // $customFonts = CustomFont::where('status', 1)->orderBy('serial')->get();
        $customColors = CustomColor::where('status', 1)->orderBy('serial')->get();
        $customSizes  = CustomSize::where('status', 1)->orderBy('serial')->get();

        return view('user.customize-product', compact(
            'customImages',
            'defaultImage',
            'customColors',
            'customSizes'
        ));
    }


    public function removeSelectedItems(Request $request)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return response()->json(['error' => 'No items selected'], 400);
        }

        $cart = session()->get('cart', []);
        foreach ($ids as $id) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);

        return response()->json(['success' => 'Selected items removed from cart.']);
    }


    public function shop(Request $request): View
    {
        $storepreferences = StorePreference::pluck('value', 'name')->toArray();
        // Get only top-level categories with their children
        $categories = Category::whereNull('parent_id')->with('children')->latest()->get();
        $brands = Brand::latest()->get();

        // Start query builder for products
        $query = Product::with('categories', 'brand')->where('status', 1);
        // Check for category filter
        if ($request->has('category')) {
            $categoryId = $request->input('category');

            // Get all child IDs recursively
            $categoryIds = $this->getAllChildCategoryIds($categoryId);
            $query->whereIn('cat_id', $categoryIds);
        }

        // Get final product list
        $products = $query->latest()->get();

        // Get the maximum current_price from the Product table
        $maxPrice = Product::where('status', 1)->max('current_price');

        return view('user.shop', compact('categories', 'products', 'brands', 'maxPrice', 'storepreferences'));
    }


    public function filter(Request $request)
    {
        // dd($request->all());
        $query = Product::query();

        // Filter by selected categories
        if ($request->has('categories') && count($request->categories)) {
            $query->whereIn('cat_id', $request->categories);
        }
        if ($request->filled('size_min') && $request->filled('size_max')) {
            $sizeMin = (float) $request->size_min;
            $sizeMax = (float) $request->size_max;

            $query->whereHas('sizes', function ($q) use ($sizeMin, $sizeMax) {
                $q->whereBetween('size', [$sizeMin, $sizeMax]);
            });
        }

        // Price filter — only apply if price_min and price_max are sent and non-empty
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $priceMin = (float) $request->price_min;
            $priceMax = (float) $request->price_max;

            $query->whereBetween('current_price', [$priceMin, $priceMax]);
            // dd($query->toSql());
        }
        // Eager load sizes relationship
        $query->with('sizes');
        $products = $query->get();
        return view('user.partials.product-list', compact('products'))->render();
    }




    // Helper method to get all child category IDs recursively
    protected function getAllChildCategoryIds($parentId)
    {
        $ids = [$parentId];

        $children = Category::where('parent_id', $parentId)->get();

        foreach ($children as $child) {
            $ids = array_merge($ids, $this->getAllChildCategoryIds($child->id));
        }

        return $ids;
    }

    public function search_product(Request $request)
    {
        $query = $request->input('query');
        // dd('here');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('user.search-products', compact('products', 'query'));
    }

    public function product_by_category($slug): View
    {
        $category = Category::where('slug', $slug)
            ->with(['products' => function ($query) {
                $query->where('status', 1);
            }])
            ->firstOrFail();
        // dd($category->toArray());

        $products = $category->products;
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);


        return view('user.category-product', compact('category', 'products', 'footer_value'));
    }

    public function categories(): View
    {
        $categoriespreferences = CategoriesPreference::pluck('value', 'name')->toArray();
        $categories = Category::where('status', 1)->latest()->get();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);

        return view('user.category', compact('categories', 'footer_value', 'categoriespreferences'));
    }

    public function product_by_sub_category($id, $cat_id): View
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::where(['sub_cat_id' => $id, 'cat_id' => $cat_id])->latest()->get();
        return view('user.shop', compact('categories', 'products', 'brands'));
    }


    public function product_by_child_category($id, $cat_id, $sub_id): View
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::where(['child_cat_id' => $id, 'sub_cat_id' => $sub_id, 'cat_id' => $cat_id])->latest()->get();
        return view('user.shop', compact('categories', 'products', 'brands'));
    }


    public function brands(): View
    {
        $brandspreferences = BrandsPreference::pluck('value', 'name')->toArray();
        $brands = Brand::where('status', 1)->latest()->get();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);

        return view('user.brand', compact('brands', 'footer_value', 'brandspreferences'));
    }

    public function showTrackOrderForm(): View
    {
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.track-order', compact('footer_value'));
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_number' => 'required',
            'email' => 'required|email',
        ]);

        // Get the order with related user info
        $order = Order::where('id', $request->order_number)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('email', $request->email);
            })
            ->with(['user', 'orderItems.product', 'transactions']) // 👈 add 'transaction'
            ->first();
        // dd($order->toArray());

        if ($order) {
            return view('user.order-status', compact('order'));
        } else {
            return back()->with('error', 'No order found for the provided details.');
        }
    }


    public function product_by_brand($slug): View
    {
        $brand = Brand::where('slug', $slug)
            ->with(['products' => function ($query) {
                $query->where('status', 1);
            }])
            ->firstOrFail();
        $products = $brand->products;
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);

        return view('user.brand-products', compact('brand', 'products', 'footer_value'));
    }

    public function service(): View
    {
        $servicepreferences = ServicePreference::pluck('value', 'name')->toArray();
        $services = Service::latest()->get();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.service', compact('services', 'footer_value', 'servicepreferences'));
    }

    public function about(): View
    {
        $aboutpreferences = AboutPreference::pluck('value', 'name')->toArray();
        $page = Page::where('type', 'about_us')->firstOrFail();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.about', compact('page', 'footer_value', 'aboutpreferences'));
    }

    public function delivery_information(): View
    {
        $page = Page::where('type', 'delivery_info')->firstOrFail();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.delivery-information', compact('page', 'footer_value'));
    }

    public function terms_and_conditions(): View
    {
        $page = Page::where('type', 'terms_condition')->firstOrFail();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.terms-and-condition', compact('page', 'footer_value'));
    }

    public function blog(): View
    {
        $blogs = Blog::latest()->get();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.blog', compact('blogs', 'footer_value'));
    }

    public function blog_details($id): View
    {
        $blog = Blog::where('id', $id)->firstOrFail();
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.blog-details', compact('blog', 'footer_value'));
    }

    public function blog_by_category($id): View
    {
        $blogs = Blog::where('cat_id', $id)->latest()->get();
        $recent_blogs = Blog::where('cat_id', $id)->limit(4)->latest()->get();
        // $categories = BlogCategory::latest()->get();
        return view('user.blog', compact('blogs', 'recent_blogs'));
    }

    public function blog_search(Request $request): View
    {
        $blogs = Blog::where('title', 'LIKE', '%' . $request->search . '%')->orWhere('title', 'LIKE', '%' . $request->search . '%')->latest()->get();
        $recent_blogs = Blog::limit(4)->latest()->get();
        // $categories = BlogCategory::latest()->get();
        return view('user.blog', compact('blogs', 'categories', 'recent_blogs'));
    }

    public function faq_category(): View
    {
        $faq_categories = FaqCategory::latest()->where('status', 1)->get();

        return view('user.faq-category', compact('faq_categories'));
    }

    public function faq_by_category($slug): View
    {
        $faqcategory  = FaqCategory::where('slug', $slug)->first();
        return view('user.faqs', compact('faqcategory'));
    }


    public function subscribe(Request $request)
    {
        $host = $request->getHost();  // e.g. "abc.com" or "def.com"
        // Remove the ".com" or any top-level domain
        $domain = explode('.', $host)[0];  // "abc" or "def"
        // Find the website ID based on the domain
        $webid = Website::where('domain_name', $domain)->value('id');
        $request->validate([
            'email' => 'required|email|unique:subscribes,email'
        ]);

        // Create a new subscription record
        Subscribe::create([
            'email' => $request->email,
            'website_id' => $webid
        ]);
        return response()->json(['success' => true, 'message' => 'Subscribed successfully']);
    }


    public function contact(): View
    {
        $footer_value = json_decode(optional(ManageSite::where('key', 'footer')->first())->value);
        return view('user.contact', compact('footer_value'));
    }

    public function save_contact(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9\s\-]{10,20}$/'],
            'message' => 'required'
        ]);
        Contact::create($validate);
        return redirect()->back()->with('success', 'Contact save successfully');
    }

    public function review(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'rating' => 'required',
            'review' => 'required',
            'product_id' => 'required',
            'subject' => 'required',
        ]);
        Review::create($validate);
        return redirect()->back()->with('success', 'Review Successfully');
    }
}
