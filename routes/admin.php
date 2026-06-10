<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\Admin\ManageSiteController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomImageController;
use App\Http\Controllers\Admin\CustomSizeController;
use App\Http\Controllers\Admin\CustomColorController;
use App\Http\Controllers\Admin\ProductEnquiryController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\PreferencesController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\WebsiteTemplateController;


Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('/auth/login', 'index')->name('admin.auth.login');
            Route::post('/auth/login', 'login')->name('admin.auth.make.login');
        });
    });
    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::controller(LoginController::class)->group(function () {
            Route::get('/profile', 'profile_view')->name('admin.profile.view');
            Route::post('/profile/update', 'update_profile')->name('admin.update.profile');
            Route::post('/logout', 'logout')->name('admin.logout');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/index', 'index')->name('admin.category.index');
            Route::get('/category/create', 'create')->name('admin.category.create');
            Route::post('/category/store', 'store')->name('admin.category.store');
            Route::get('/category/edit/{id}', 'edit')->name('admin.category.edit');
            Route::post('/category/update/{id}', 'update')->name('admin.category.update');
            Route::get('/category/delete/{id}', 'delete')->name('admin.category.delete');
            Route::get('/category/status/{id}', 'update_status')->name('admin.category.change.status');
        });

        Route::controller(OptionController::class)->group(function () {
            Route::get('/option/index', 'index')->name('admin.option.index');
            Route::get('/option/create', 'create')->name('admin.option.create');
            Route::post('/option/store', 'store')->name('admin.option.store');
            Route::get('/option/edit/{id}', 'edit')->name('admin.option.edit');
            // Route::get('/option/value/delete/{id}', 'option_value_delete')->name('admin.option.value.delete');
            Route::get('/option/value/delete/{id}', 'option_value_delete')->name('admin.option.value.delete');
            Route::post('/option-value/update/{id}', 'option_value_update')->name('admin.option.value.update');



            Route::post('/option/update/{id}', 'update')->name('admin.option.update');
            Route::get('/option/delete/{id}', 'delete')->name('admin.option.delete');
            Route::get('/option/status/{id}', 'update_status')->name('admin.option.change.status');
        });


        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/sub-category/index', 'index')->name('admin.sub-category.index');
            Route::get('/sub-category/create', 'create')->name('admin.sub-category.create');
            Route::post('/sub-category/store', 'store')->name('admin.sub-category.store');
            Route::get('/sub-category/edit/{id}', 'edit')->name('admin.sub-category.edit');
            Route::post('/sub-category/update/{id}', 'update')->name('admin.sub-category.update');
            Route::get('/sub-category/delete/{id}', 'delete')->name('admin.sub-category.delete');
            Route::get('/sub-category/status/{id}', 'update_status')->name('admin.sub-category.change.status');
        });

        Route::controller(ChildCategoryController::class)->group(function () {
            Route::get('/child-category/index', 'index')->name('admin.child-category.index');
            Route::get('/child-category/create', 'create')->name('admin.child-category.create');
            Route::post('/child-category/store', 'store')->name('admin.child-category.store');
            Route::get('/child-category/edit/{id}', 'edit')->name('admin.child-category.edit');
            Route::post('/child-category/update/{id}', 'update')->name('admin.child-category.update');
            Route::get('/child-category/delete/{id}', 'delete')->name('admin.child-category.delete');
            Route::post('/child-category/get/sub-category', 'get_sub_category')->name('admin.child-category.get.sub-category');
            Route::post('/child-category/update/sub-category', 'update_sub_category')->name('admin.child-category.update.sub-category');
            Route::get('/child-category/status/{id}', 'update_status')->name('admin.child-category.change.status');
        });

        Route::controller(BrandController::class)->group(function () {
            Route::get('/brand/index', 'index')->name('admin.brand.index');
            Route::get('/brand/create', 'create')->name('admin.brand.create');
            Route::post('/brand/store', 'store')->name('admin.brand.store');
            Route::get('/brand/edit/{id}', 'edit')->name('admin.brand.edit');
            Route::post('/brand/update/{id}', 'update')->name('admin.brand.update');
            Route::get('/brand/delete/{id}', 'delete')->name('admin.brand.delete');
            Route::get('/brand/status/{id}', 'update_status')->name('admin.brand.change.status');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/index', 'index')->name('admin.product.index');
            Route::get('/product/create', 'create')->name('admin.product.create');
            Route::post('/product/store', 'store')->name('admin.product.store');
            Route::get('/product/edit/{id}', 'edit')->name('admin.product.edit');
            Route::post('/product/update/{id}', 'update')->name('admin.product.update');

            Route::get('/product/delete/{id}', 'delete')->name('admin.product.delete');
            Route::get('/product/change/status/{id}', 'update_status')->name('admin.product.change.status');
            Route::post('/product/child/category', 'get_child_category')->name('admin.product.get.child-category');
            Route::post('/product/nested/sub/category', 'getSubCategory')->name('admin.product.get.sub.category');
            Route::get('/product/get-option-values/{id}',  'getOptionValues')->name('admin.product.get.option.values');
        });

        Route::controller(FaqCategoryController::class)->group(function () {
            Route::get('/faq-category/index', 'index')->name('admin.faq-category.index');
            Route::get('/faq-category/create', 'create')->name('admin.faq-category.create');
            Route::post('/faq-category/store', 'store')->name('admin.faq-category.store');
            Route::get('/faq-category/edit/{id}', 'edit')->name('admin.faq-category.edit');
            Route::post('/faq-category/update/{id}', 'update')->name('admin.faq-category.update');
            Route::get('/faq-category/delete/{id}', 'delete')->name('admin.faq-category.delete');
            Route::get('/faq-category/status/{id}', 'update_status')->name('admin.faq-category.change.status');
        });

        Route::controller(FaqController::class)->group(function () {
            Route::get('/faq/index', 'index')->name('admin.faq.index');
            Route::get('/faq/create', 'create')->name('admin.faq.create');
            Route::post('/faq/store', 'store')->name('admin.faq.store');
            Route::get('/faq/edit/{id}', 'edit')->name('admin.faq.edit');
            Route::post('/faq/update/{id}', 'update')->name('admin.faq.update');
            Route::get('/faq/delete/{id}', 'delete')->name('admin.faq.delete');
        });

        Route::controller(BlogController::class)->group(function () {
            Route::get('/blog/index', 'index')->name('admin.blog.index');
            Route::get('/blog/create', 'create')->name('admin.blog.create');
            Route::post('/blog/store', 'store')->name('admin.blog.store');
            Route::get('/blog/edit/{id}', 'edit')->name('admin.blog.edit');
            Route::post('/blog/update/{id}', 'update')->name('admin.blog.update');
            Route::post('/upload/image', 'uploadImage')->name('admin.blog.uploadImage');
            Route::get('/blog/delete/{id}', 'delete')->name('admin.blog.delete');
        });

        // Route::controller(BlogController::class)->group(function () {
        //     Route::get('/blog/index', 'index')->name('admin.blog.index');
        //     Route::get('/blog/create', 'create')->name('admin.blog.create');
        //     Route::post('/blog/store', 'store')->name('admin.blog.store');
        //     Route::get('/blog/edit/{id}', 'edit')->name('admin.blog.edit');
        //     Route::post('/blog/update/{id}', 'update')->name('admin.blog.update');
        //     Route::get('/blog/delete/{id}', 'delete')->name('admin.blog.delete');
        // });

        Route::controller(SliderController::class)->group(function () {
            Route::get('/slider/index', 'index')->name('admin.slider.index');
            Route::get('/slider/create', 'create')->name('admin.slider.create');
            Route::post('/slider/store', 'store')->name('admin.slider.store');
            Route::get('/slider/edit/{id}', 'edit')->name('admin.slider.edit');
            Route::post('/slider/update/{id}', 'update')->name('admin.slider.update');
            Route::post('/slider/delete/{id}', 'delete')->name('admin.slider.delete');
        });

        Route::controller(ServiceController::class)->group(function () {
            Route::get('/service/index', 'index')->name('admin.service.index');
            Route::get('/service/create', 'create')->name('admin.service.create');
            Route::post('/service/store', 'store')->name('admin.service.store');
            Route::get('/service/edit/{id}', 'edit')->name('admin.service.edit');
            Route::post('/service/update/{id}', 'update')->name('admin.service.update');
            Route::get('/service/delete/{id}', 'delete')->name('admin.service.delete');
        });

        Route::controller(ManageSiteController::class)->group(function () {
            Route::get('/manage-site/index', 'index')->name('admin.manage-site.index');
            Route::post('/manage-site/basic-setting', 'basic_setting')->name('admin.manage-site.basic_setting');
            Route::post('/manage-site/media', 'media')->name('admin.manage-site.media');
            Route::post('/manage-site/seo', 'seo')->name('admin.manage-site.seo');
            Route::post('/manage-site/footer', 'footer')->name('admin.manage-site.footer');
            Route::post('/manage-site/home_page', 'home_page')->name('admin.manage-site.home_page');
            Route::post('/manage-site/first_three_column', 'first_three_column')->name('admin.manage-site.first_three_column');
            Route::post('/manage-site/second_three_column', 'second_three_column')->name('admin.manage-site.second_three_column');
            Route::post('/manage-site/third_two_column', 'third_two_column')->name('admin.manage-site.third_two_column');
            Route::post('/manage-site/four_three_column', 'four_three_column')->name('admin.manage-site.four_three_column');
        });

        Route::controller(ManageController::class)->group(function () {
            Route::get('/all-order', 'index')->name('admin.all.order');
            Route::get('/order/invoice/{id}', 'invoice')->name('admin.order.invoice');
            Route::get('/pending-order', 'pending_order')->name('admin.pending.order');
            Route::get('/processing-order', 'prcossing_order')->name('admin.processing.order');
            Route::get('/progress-order', 'progress_order')->name('admin.progress.order');
            Route::get('/delivered-order', 'delivered_order')->name('admin.delivered.order');
            Route::get('/canceled-order', 'canceled_order')->name('admin.canceled.order');
            Route::get('/change-payment-status//{id}', 'change_payment_status')->name('admin.order.change.status');
            Route::get('/pending-status/{id}', 'pending_status')->name('admin.order.change.pending.status');
            Route::get('/progress-status/{id}', 'progress_status')->name('admin.order.change.progress.status');
            Route::get('/delivered-status/{id}', 'delivered_status')->name('admin.order.change.delivered.status');
            Route::get('/processig-status/{id}', 'process_status')->name('admin.order.change.processing.status');
            Route::get('/canceled-status/{id}', 'canceled_status')->name('admin.order.change.canceled.status');
            Route::get('/transactions', 'transactions')->name('admin.transactions');
            Route::get('/transactions/{id}', 'transactions_delete')->name('admin.transactions.delete');
        });

        Route::controller(ProductEnquiryController::class)->group(function () {

            Route::get('product-enquiries',  'index')->name('admin.product-enquiries');
            Route::get('product-enquiries/{id}',  'show')->name('admin.product-enquiries.show');
            Route::delete('product-enquiries/{id}',  'destroy')->name('admin.product-enquiries.delete');
        });

        Route::controller(CustomerController::class)->group(function () {
            Route::get('/customers', 'index')->name('admin.customer');
            Route::get('/customers/edit/{id}', 'edit')->name('admin.customer.edit');
            Route::post('/customers/{id}', 'update')->name('admin.customer.update');
            Route::get('/customers/{id}', 'delete')->name('admin.customer.delete');
        });

        Route::controller(SubscribeController::class)->group(function () {
            Route::get('/subscribers', 'index')->name('admin.subscribers');
            Route::get('/subscribers/{id}',  'destroy')->name('admin.subscribers.delete');
        });


        Route::controller(PageController::class)->group(function () {
            Route::get('/pages', 'index')->name('admin.pages');
            Route::get('/pages/edit/{id}', 'edit')->name('admin.pages.edit');
            Route::post('/pages/update/{id}', 'update')->name('admin.pages.update');
        });

        Route::controller(CustomImageController::class)->group(function () {
            Route::get('/custom-image/index', 'index')->name('admin.custom_image.index');
            Route::get('/custom-image/create', 'create')->name('admin.custom_image.create');
            Route::post('/custom-image/store', 'store')->name('admin.custom_image.store');
            Route::get('/custom-image/edit/{id}', 'edit')->name('admin.custom_image.edit');
            Route::post('/custom-image/update/{id}', 'update')->name('admin.custom_image.update');
            Route::get('/custom-image/delete/{id}', 'delete')->name('admin.custom_image.delete');
            Route::get('/custom-image/status/{id}', 'update_status')->name('admin.custom_image.change.status');
        });

        Route::controller(CustomSizeController::class)->group(function () {
            Route::get('/custom-size/index', 'index')->name('admin.custom_size.index');
            Route::get('/custom-size/create', 'create')->name('admin.custom_size.create');
            Route::post('/custom-size/store', 'store')->name('admin.custom_size.store');
            Route::get('/custom-size/edit/{id}', 'edit')->name('admin.custom_size.edit');
            Route::post('/custom-size/update/{id}', 'update')->name('admin.custom_size.update');
            Route::get('/custom-size/delete/{id}', 'delete')->name('admin.custom_size.delete');
            Route::get('/custom-size/status/{id}', 'update_status')->name('admin.custom_size.change.status');
        });


        Route::controller(CustomColorController::class)->group(function () {
            Route::get('/custom-color/index', 'index')->name('admin.custom_color.index');
            Route::get('/custom-color/create', 'create')->name('admin.custom_color.create');
            Route::post('/custom-color/store', 'store')->name('admin.custom_color.store');
            Route::get('/custom-color/edit/{id}', 'edit')->name('admin.custom_color.edit');
            Route::post('/custom-color/update/{id}', 'update')->name('admin.custom_color.update');
            Route::get('/custom-color/delete/{id}', 'delete')->name('admin.custom_color.delete');
            Route::get('/custom-color/status/{id}', 'update_status')->name('admin.custom_color.change.status');
        });

        // Clients Route
        Route::controller(ClientController::class)->group(function () {
            Route::get('/client/index', 'index')->name('admin.client.index');
            Route::get('/admin/client/create', 'create')->name('admin.client.create');
            Route::post('/admin/client/store', 'store')->name('admin.client.store');
            Route::get('/client/edit/{id}', 'edit')->name('admin.client.edit');
            Route::post('/client/update/{id}', 'update')->name('admin.client.update');
            Route::get('/client/status/{id}', 'update_status')->name('admin.client.change.status');
            Route::delete('/client/delete/{id}', 'delete')->name('admin.client.delete');
        });

        // Email Template Route
        Route::controller(EmailTemplateController::class)->group(function () {
            Route::get('/email/index', 'index')->name('admin.email.index');
            Route::get('/email/create', 'create')->name('admin.email.create');
            Route::post('/admin/email/store', 'store')->name('admin.email.store');
            Route::get('/email/edit/{id}', 'edit')->name('admin.email.edit');
            Route::post('/email/update/{id}', 'update')->name('admin.email.update');
            Route::delete('/email/delete/{id}', 'delete')->name('admin.email.delete');
        });

        // Prefrences
        Route::controller(PreferencesController::class)->group(function () {
            Route::get('/hom/preferences', 'home_preferences')->name('admin.home.preferences');
            Route::post('/hom/store/preferences', 'home_store')->name('admin.home.store.preferences');
            Route::get('/about/preferences', 'about_preferences')->name('admin.about.preferences');
            Route::post('/about/store/preferences', 'about_store')->name('admin.about.store.preferences');
            Route::get('/service/preferences', 'service_preferences')->name('admin.service.preferences');
            Route::post('/service/store/preferences', 'service_store')->name('admin.service.store.preferences');
            Route::get('/store/preferences', 'store_preferences')->name('admin.store.preferences');
            Route::post('/store/store/preferences', 'store_store')->name('admin.store.store.preferences');
            Route::get('/contact/preferences', 'contact_preferences')->name('admin.contact.preferences');
            Route::post('/contact/store/preferences', 'contact_store')->name('admin.contact.store.preferences');
            Route::get('/categories/preferences', 'categories_preferences')->name('admin.categories.preferences');
            Route::post('/categories/store/preferences', 'categories_store')->name('admin.categories.store.preferences');
            Route::get('/brands/preferences', 'brands_preferences')->name('admin.brands.preferences');
            Route::post('/brands/store/preferences', 'brands_store')->name('admin.brands.store.preferences');
            Route::get('/cart/preferences', 'cart_preferences')->name('admin.cart.preferences');
            Route::post('/cart/store/preferences', 'cart_store')->name('admin.cart.store.preferences');
        });

        // Website Route
        Route::controller(WebsiteController::class)->group(function () {
            Route::get('/website/index', 'index')->name('admin.website.index');
            Route::get('/website/create', 'create')->name('admin.website.create');
            Route::post('/website/store', 'store')->name('admin.website.store');
            Route::get('/website/edit/{id}', 'edit')->name('admin.website.edit');
            Route::post('/website/update/{id}', 'update')->name('admin.website.update');
            Route::get('/website/status/{id}', 'update_status')->name('admin.website.change.status');
            Route::delete('/website/delete/{id}', 'delete')->name('admin.website.delete');
        });

        // Website Template Route
        Route::controller(WebsiteTemplateController::class)->group(function () {
            Route::get('/website-template/index', 'index')->name('admin.website-template.index');
            Route::get('/website-template/create', 'create')->name('admin.website-template.create');
            Route::post('/website-template/store', 'store')->name('admin.website-template.store');
            Route::get('/website-template/edit/{id}', 'edit')->name('admin.website-template.edit');
            Route::post('/website-template/update/{id}', 'update')->name('admin.website-template.update');
            Route::get('/website-template/status/{id}', 'update_status')->name('admin.website-template.change.status');
            Route::delete('/website-template/delete/{id}', 'delete')->name('admin.website-template.delete');
        });
    });
});
