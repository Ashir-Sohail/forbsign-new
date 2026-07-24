<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\WishListController;
use App\Http\Controllers\User\ProductEnquiryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//   ******** Authenticated Routes ********
Route::middleware(['guest'])->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('user.register');
        Route::post('/register', 'create')->name('user.make.register');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('user.login');
        Route::post('/login', 'login')->name('user.make.login');
        Route::get('/forgot-password',  'showForgotPasswordForm')->name('password.forgot');
        Route::post('/forgot-password',  'submitForgotPasswordForm')->name('password.email');
        Route::get('/reset-password/{token}',  'showResetPasswordForm')->name('show.reset.password');
        Route::post('/reset-password',  'submitResetPasswordForm')->name('update.reset.password');
    });
});



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('user.home');
    Route::get('/services', 'service')->name('user.services');
    Route::get('/contact', 'contact')->name('user.contact');
    Route::post('/save_contact', 'save_contact')->name('user.save_contact');
    Route::get('/store', 'shop')->name('user.store');
    Route::get('/about', 'about')->name('user.about');
    Route::get('/delivery-information', 'delivery_information')->name('user.delivery');
    Route::get('/terms-and-conditions', 'terms_and_conditions')->name('user.terms');
    Route::get('/track-order', 'showTrackOrderForm')->name('user.trackorder');
    Route::post('/track-order', 'trackOrder')->name('user.trackorder.submit');


    // Route::get('/store', 'filter')->name('user.store.filter');
    Route::get('/store/filter', 'filter')->name('store.filter');


    Route::get('/shop/category/{id}', 'product_by_category')->name('user.shop.category');
    Route::get('/shop/category/{id}/{cat_id}', 'product_by_sub_category')->name('user.shop.sub.category');
    Route::get('/shop/category/{id}/{cat_id}/{sub_id}', 'product_by_child_category')->name('user.shop.child.category');

    Route::post('/review', 'review')->name('user.review');
    Route::post('/subscribe', 'subscribe')->name('user.subscribe');

    Route::get('/blogs', 'blog')->name('user.blog');
    Route::get('blog/{id}', 'blog_details')->name('user.blog_details');

    Route::get('/brand', 'brands')->name('user.brand');
    Route::get('/brand/product/{slug}', 'product_by_brand')->name('user.brand.product');



    Route::get('/blog/category/{id}', 'blog_by_category')->name('user.blog.category');
    Route::get('/product-details/{slug}', 'product_details')->name('user.product_details');
    Route::get('/customize-product', 'customize_product')->name('user.customize_product');

    Route::get('/faq', 'faq_category')->name('user.faq');
    Route::get('/faq/{slug}', 'faq_by_category')->name('user.faqs');
    Route::get('/price/product', 'product_by_price')->name('user.product.price');

    Route::get('/search', 'search_product')->name('user.search.product');

    // Route::get('/category/product/{slug}', 'product_by_category')->name('user.category.product');
    Route::get('/categories', 'categories')->name('user.categories');
    Route::get('/category/product/{slug}', 'product_by_category')->name('category.products');



    Route::middleware(['auth'])->group(function () {
        Route::get('/add_to_wishlist/{id}', 'add_to_wishlist')->name('user.add_to_wishlist');
        Route::get('/add_to_compare/{id}', 'add_to_compare')->name('user.add_to_compare');
        Route::post('/add_to_cart', 'add_to_cart')->name('user.add_to_cart');
    });
});



Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('user.cart');
    Route::post('/add-to-cart', 'addToCart')->name('user.add-cart');
    Route::get('/cart/clear', 'clearCart')->name('user.cart.clear');
    Route::get('/cart-count', 'cartCount')->name('cart.count');
    Route::post('/cart/remove-selected',  'removeSelectedItems')->name('user.cart.remove.selected');
    Route::post('/cart/update',  'updateQuantity')->name('cart.updateQuantity');
});


Route::controller(ProductEnquiryController::class)->group(function () {
    Route::post('/product-enquiry',  'store')->name('product.enquiry.store');
});


Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'index')->name('user.checkout');
    Route::get('/thank-you/{order}', 'thankYou')->name('checkout.thankyou');
});

Route::middleware(['auth'])->group(function () {

    Route::controller(WishListController::class)->group(function () {
        Route::get('/wishlist', 'index')->name('user.wishlist');
        Route::get('/wishlist/add/{id}', 'addToWishlist')->name('user.wishlist.add');  // Add this
        Route::get('/wishlist/clear', 'clear_wishlist')->name('user.wishlist.clear');
        Route::get('/wishlist/remove/{id}', 'remove_wishlist')->name('user.wishlist.remove');
    });
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'index')->name('user.compare');
        Route::get('/compare/remove/{id}', 'remove_compare')->name('user.compare.remove');
    });
    Route::controller(CheckoutController::class)->group(function () {
        // Route::get('/checkout', 'index')->name('user.checkout');
        Route::post('/checkout/payment', 'StripePayment')->name('user.stripe.payment.store');
        // Route::post('/billing/address', 'update_billing_address')->name('user.billing_address');
        Route::get('/payment', 'payment')->name('user.payment');
        Route::get('/order', 'order')->name('user.order');
        Route::post('/checkout/cash-on-delivery', 'checkout_submit_cash_on_delivery')->name('user.checkout.cash.on.delivery');
        Route::post('/checkout/bank-transfer', 'checkout_submit_back_transfer')->name('user.checkout.bank.transfer');
        Route::post('/stripe', 'stripePost')->name('user.checkout.stripe');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
        Route::get('/profile', 'show_profile')->name('user.dashboard.profile');
        Route::post('/update/profile', 'update_profile')->name('user.profile.update');
        Route::get('/address', 'show_address')->name('user.dashboard.address');
        Route::post('/update/address', 'update_address')->name('user.address.update');
        Route::post('/logout', 'logout')->name('user.logout');
        Route::delete('/account', 'deleteAccount')->name('user.account.delete');
    });
});


require_once 'admin.php';
require_once 'client.php';
