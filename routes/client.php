<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\BrandController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\OptionController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\FaqCategoryController;
use App\Http\Controllers\Client\FaqController;
use App\Http\Controllers\Client\ManageController;
use App\Http\Controllers\Admin\ManageSiteController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Client\SubscribeController;
use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomImageController;
use App\Http\Controllers\Admin\CustomSizeController;
use App\Http\Controllers\Admin\CustomColorController;
use App\Http\Controllers\Admin\ProductEnquiryController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\PreferencesController;
use App\Http\Controllers\Client\ClientController;


Route::prefix('client')->group(function () {
    // Route::middleware(['guest:admin'])->group(function () {
    //     Route::controller(LoginController::class)->group(function () {
    //         Route::get('/auth/login', 'index')->name('admin.auth.login');
    //         Route::post('/auth/login', 'login')->name('admin.auth.make.login');
    //     });
    // });
    Route::controller(ClientController::class)->group(function () {
        Route::get('/login', 'index')->name('client.login');
        Route::post('/after/login', 'login')->name('client.make.login');
        Route::get('forgot-password',  'showForgotPasswordForm')->name('passwordforgot');
        Route::post('forgot-password',  'submitForgotPasswordForm')->name('passwordemail');
        Route::get('reset-password/{token}',  'showResetPasswordForm')->name('showresetpassword');
        Route::post('reset-password',  'submitResetPasswordForm')->name('updateresetpassword');
    });
    Route::middleware(['auth:client'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('client.dashboard');

        // Cients Login Route
        Route::controller(ClientController::class)->group(function () {
            Route::get('/profile', 'profile_view')->name('client.profile.view');
            Route::post('/profile/update', 'update_profile')->name('client.update.profile');
            Route::post('logout', 'logout')->name('client.logout');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/index', 'index')->name('client.category.index');
            Route::get('/category/create', 'create')->name('client.category.create');
            Route::post('/category/store', 'store')->name('client.category.store');
            Route::get('/category/edit/{id}', 'edit')->name('client.category.edit');
            Route::post('/category/update/{id}', 'update')->name('client.category.update');
            Route::get('/category/delete/{id}', 'delete')->name('client.category.delete');
            Route::get('/category/status/{id}', 'update_status')->name('client.category.change.status');
        });

        Route::controller(OptionController::class)->group(function () {
            Route::get('/option/index', 'index')->name('client.option.index');
            Route::get('/option/create', 'create')->name('client.option.create');
            Route::post('/option/store', 'store')->name('client.option.store');
            Route::get('/option/edit/{id}', 'edit')->name('client.option.edit');
            // Route::get('/option/value/delete/{id}', 'option_value_delete')->name('client.option.value.delete');
            Route::get('/option/value/delete/{id}', 'option_value_delete')->name('client.option.value.delete');
            Route::post('/option-value/update/{id}', 'option_value_update')->name('client.option.value.update');



            Route::post('/option/update/{id}', 'update')->name('client.option.update');
            Route::get('/option/delete/{id}', 'delete')->name('client.option.delete');
            Route::get('/option/status/{id}', 'update_status')->name('client.option.change.status');
        });


        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/sub-category/index', 'index')->name('client.sub-category.index');
            Route::get('/sub-category/create', 'create')->name('client.sub-category.create');
            Route::post('/sub-category/store', 'store')->name('client.sub-category.store');
            Route::get('/sub-category/edit/{id}', 'edit')->name('client.sub-category.edit');
            Route::post('/sub-category/update/{id}', 'update')->name('client.sub-category.update');
            Route::get('/sub-category/delete/{id}', 'delete')->name('client.sub-category.delete');
            Route::get('/sub-category/status/{id}', 'update_status')->name('client.sub-category.change.status');
        });

        Route::controller(ChildCategoryController::class)->group(function () {
            Route::get('/child-category/index', 'index')->name('client.child-category.index');
            Route::get('/child-category/create', 'create')->name('client.child-category.create');
            Route::post('/child-category/store', 'store')->name('client.child-category.store');
            Route::get('/child-category/edit/{id}', 'edit')->name('client.child-category.edit');
            Route::post('/child-category/update/{id}', 'update')->name('client.child-category.update');
            Route::get('/child-category/delete/{id}', 'delete')->name('client.child-category.delete');
            Route::post('/child-category/get/sub-category', 'get_sub_category')->name('client.child-category.get.sub-category');
            Route::post('/child-category/update/sub-category', 'update_sub_category')->name('client.child-category.update.sub-category');
            Route::get('/child-category/status/{id}', 'update_status')->name('client.child-category.change.status');
        });

        Route::controller(BrandController::class)->group(function () {
            Route::get('/brand/index', 'index')->name('client.brand.index');
            Route::get('/brand/create', 'create')->name('client.brand.create');
            Route::post('/brand/store', 'store')->name('client.brand.store');
            Route::get('/brand/edit/{id}', 'edit')->name('client.brand.edit');
            Route::post('/brand/update/{id}', 'update')->name('client.brand.update');
            Route::get('/brand/delete/{id}', 'delete')->name('client.brand.delete');
            Route::get('/brand/status/{id}', 'update_status')->name('client.brand.change.status');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/index', 'index')->name('client.product.index');
            Route::get('/product/create', 'create')->name('client.product.create');
            Route::post('/product/store', 'store')->name('client.product.store');
            Route::get('/product/edit/{id}', 'edit')->name('client.product.edit');
            Route::post('/product/update/{id}', 'update')->name('client.product.update');

            Route::get('/product/delete/{id}', 'delete')->name('client.product.delete');
            Route::get('/product/change/status/{id}', 'update_status')->name('client.product.change.status');
            Route::post('/product/child/category', 'get_child_category')->name('client.product.get.child-category');
            Route::post('/product/nested/sub/category', 'getSubCategory')->name('client.product.get.sub.category');
            Route::get('/product/get-option-values/{id}',  'getOptionValues')->name('client.product.get.option.values');
        });

        Route::controller(FaqCategoryController::class)->group(function () {
            Route::get('/faq-category/index', 'index')->name('client.faq-category.index');
            Route::get('/faq-category/create', 'create')->name('client.faq-category.create');
            Route::post('/faq-category/store', 'store')->name('client.faq-category.store');
            Route::get('/faq-category/edit/{id}', 'edit')->name('client.faq-category.edit');
            Route::post('/faq-category/update/{id}', 'update')->name('client.faq-category.update');
            Route::get('/faq-category/delete/{id}', 'delete')->name('client.faq-category.delete');
            Route::get('/faq-category/status/{id}', 'update_status')->name('client.faq-category.change.status');
        });

        Route::controller(FaqController::class)->group(function () {
            Route::get('/faq/index', 'index')->name('client.faq.index');
            Route::get('/faq/create', 'create')->name('client.faq.create');
            Route::post('/faq/store', 'store')->name('client.faq.store');
            Route::get('/faq/edit/{id}', 'edit')->name('client.faq.edit');
            Route::post('/faq/update/{id}', 'update')->name('client.faq.update');
            Route::get('/faq/delete/{id}', 'delete')->name('client.faq.delete');
        });

        // Route::controller(BlogController::class)->group(function () {
        //     Route::get('/blog/index', 'index')->name('client.blog.index');
        //     Route::get('/blog/create', 'create')->name('client.blog.create');
        //     Route::post('/blog/store', 'store')->name('client.blog.store');
        //     Route::get('/blog/edit/{id}', 'edit')->name('client.blog.edit');
        //     Route::post('/blog/update/{id}', 'update')->name('client.blog.update');
        //     Route::post('/upload/image', 'uploadImage')->name('client.blog.uploadImage');
        //     Route::get('/blog/delete/{id}', 'delete')->name('client.blog.delete');
        // });

        Route::controller(BlogController::class)->group(function () {
            Route::get('/blog/index', 'index')->name('client.blog.index');
            Route::get('/blog/create', 'create')->name('client.blog.create');
            Route::post('/blog/store', 'store')->name('client.blog.store');
            Route::get('/blog/edit/{id}', 'edit')->name('client.blog.edit');
            Route::post('/blog/update/{id}', 'update')->name('client.blog.update');
            Route::get('/blog/delete/{id}', 'delete')->name('client.blog.delete');
        });

        // Route::controller(SliderController::class)->group(function () {
        //     Route::get('/slider/index', 'index')->name('admin.slider.index');
        //     Route::get('/slider/create', 'create')->name('admin.slider.create');
        //     Route::post('/slider/store', 'store')->name('admin.slider.store');
        //     Route::get('/slider/edit/{id}', 'edit')->name('admin.slider.edit');
        //     Route::post('/slider/update/{id}', 'update')->name('admin.slider.update');
        //     Route::post('/slider/delete/{id}', 'delete')->name('admin.slider.delete');
        // });

        // Route::controller(ServiceController::class)->group(function () {
        //     Route::get('/service/index', 'index')->name('admin.service.index');
        //     Route::get('/service/create', 'create')->name('admin.service.create');
        //     Route::post('/service/store', 'store')->name('admin.service.store');
        //     Route::get('/service/edit/{id}', 'edit')->name('admin.service.edit');
        //     Route::post('/service/update/{id}', 'update')->name('admin.service.update');
        //     Route::get('/service/delete/{id}', 'delete')->name('admin.service.delete');
        // });

        // Route::controller(ManageSiteController::class)->group(function () {
        //     Route::get('/manage-site/index', 'index')->name('admin.manage-site.index');
        //     Route::post('/manage-site/basic-setting', 'basic_setting')->name('admin.manage-site.basic_setting');
        //     Route::post('/manage-site/media', 'media')->name('admin.manage-site.media');
        //     Route::post('/manage-site/seo', 'seo')->name('admin.manage-site.seo');
        //     Route::post('/manage-site/footer', 'footer')->name('admin.manage-site.footer');
        //     Route::post('/manage-site/home_page', 'home_page')->name('admin.manage-site.home_page');
        //     Route::post('/manage-site/first_three_column', 'first_three_column')->name('admin.manage-site.first_three_column');
        //     Route::post('/manage-site/second_three_column', 'second_three_column')->name('admin.manage-site.second_three_column');
        //     Route::post('/manage-site/third_two_column', 'third_two_column')->name('admin.manage-site.third_two_column');
        //     Route::post('/manage-site/four_three_column', 'four_three_column')->name('admin.manage-site.four_three_column');
        // });

        Route::controller(ManageController::class)->group(function () {
            Route::get('/all-order', 'index')->name('client.all.order');
            Route::get('/order/invoice/{id}', 'invoice')->name('client.order.invoice');
            Route::get('/pending-order', 'pending_order')->name('client.pending.order');
            Route::get('/processing-order', 'prcossing_order')->name('client.processing.order');
            Route::get('/progress-order', 'progress_order')->name('client.progress.order');
            Route::get('/delivered-order', 'delivered_order')->name('client.delivered.order');
            Route::get('/canceled-order', 'canceled_order')->name('client.canceled.order');
            Route::get('/change-payment-status//{id}', 'change_payment_status')->name('client.order.change.status');
            Route::get('/pending-status/{id}', 'pending_status')->name('client.order.change.pending.status');
            Route::get('/progress-status/{id}', 'progress_status')->name('client.order.change.progress.status');
            Route::get('/delivered-status/{id}', 'delivered_status')->name('client.order.change.delivered.status');
            Route::get('/processig-status/{id}', 'process_status')->name('client.order.change.processing.status');
            Route::get('/canceled-status/{id}', 'canceled_status')->name('client.order.change.canceled.status');
            Route::get('/transactions', 'transactions')->name('client.transactions');
            Route::get('/transactions/{id}', 'transactions_delete')->name('client.transactions.delete');
        });

        // Route::controller(ProductEnquiryController::class)->group(function () {

        //     Route::get('product-enquiries',  'index')->name('admin.product-enquiries');
        //     Route::get('product-enquiries/{id}',  'show')->name('admin.product-enquiries.show');
        //     Route::delete('product-enquiries/{id}',  'destroy')->name('admin.product-enquiries.delete');
        // });

        // Route::controller(CustomerController::class)->group(function () {
        //     Route::get('/customers', 'index')->name('admin.customer');
        //     Route::get('/customers/edit/{id}', 'edit')->name('admin.customer.edit');
        //     Route::post('/customers/{id}', 'update')->name('admin.customer.update');
        //     Route::get('/customers/{id}', 'delete')->name('admin.customer.delete');
        // });

        Route::controller(SubscribeController::class)->group(function () {
            Route::get('/subscribers', 'index')->name('client.subscribers');
            Route::get('/subscribers/{id}',  'destroy')->name('client.subscribers.delete');
        });


        // Route::controller(PageController::class)->group(function () {
        //     Route::get('/pages', 'index')->name('admin.pages');
        //     Route::get('/pages/edit/{id}', 'edit')->name('admin.pages.edit');
        //     Route::post('/pages/update/{id}', 'update')->name('admin.pages.update');
        // });

        // Route::controller(CustomImageController::class)->group(function () {
        //     Route::get('/custom-image/index', 'index')->name('admin.custom_image.index');
        //     Route::get('/custom-image/create', 'create')->name('admin.custom_image.create');
        //     Route::post('/custom-image/store', 'store')->name('admin.custom_image.store');
        //     Route::get('/custom-image/edit/{id}', 'edit')->name('admin.custom_image.edit');
        //     Route::post('/custom-image/update/{id}', 'update')->name('admin.custom_image.update');
        //     Route::get('/custom-image/delete/{id}', 'delete')->name('admin.custom_image.delete');
        //     Route::get('/custom-image/status/{id}', 'update_status')->name('admin.custom_image.change.status');
        // });

        // Route::controller(CustomSizeController::class)->group(function () {
        //     Route::get('/custom-size/index', 'index')->name('admin.custom_size.index');
        //     Route::get('/custom-size/create', 'create')->name('admin.custom_size.create');
        //     Route::post('/custom-size/store', 'store')->name('admin.custom_size.store');
        //     Route::get('/custom-size/edit/{id}', 'edit')->name('admin.custom_size.edit');
        //     Route::post('/custom-size/update/{id}', 'update')->name('admin.custom_size.update');
        //     Route::get('/custom-size/delete/{id}', 'delete')->name('admin.custom_size.delete');
        //     Route::get('/custom-size/status/{id}', 'update_status')->name('admin.custom_size.change.status');
        // });


        // Route::controller(CustomColorController::class)->group(function () {
        //     Route::get('/custom-color/index', 'index')->name('admin.custom_color.index');
        //     Route::get('/custom-color/create', 'create')->name('admin.custom_color.create');
        //     Route::post('/custom-color/store', 'store')->name('admin.custom_color.store');
        //     Route::get('/custom-color/edit/{id}', 'edit')->name('admin.custom_color.edit');
        //     Route::post('/custom-color/update/{id}', 'update')->name('admin.custom_color.update');
        //     Route::get('/custom-color/delete/{id}', 'delete')->name('admin.custom_color.delete');
        //     Route::get('/custom-color/status/{id}', 'update_status')->name('admin.custom_color.change.status');
        // });

        // // Clients Route
        // Route::controller(ClientController::class)->group(function () {
        //     Route::get('/index', 'index')->name('admin.client.index');
        //     Route::get('/admin/create', 'create')->name('admin.client.create');
        //     Route::post('/admin/store', 'store')->name('admin.client.store');
        //     Route::get('/edit/{id}', 'edit')->name('admin.client.edit');
        //     Route::post('/update/{id}', 'update')->name('admin.client.update');
        //     Route::get('/status/{id}', 'update_status')->name('admin.client.change.status');
        //     Route::delete('/delete/{id}', 'delete')->name('admin.client.delete');
        // });

        // // Email Template Route
        // Route::controller(EmailTemplateController::class)->group(function () {
        //     Route::get('/email/index', 'index')->name('admin.email.index');
        //     Route::get('/email/create', 'create')->name('admin.email.create');
        //     Route::post('/admin/email/store', 'store')->name('admin.email.store');
        //     Route::get('/email/edit/{id}', 'edit')->name('admin.email.edit');
        //     Route::post('/email/update/{id}', 'update')->name('admin.email.update');
        //     Route::delete('/email/delete/{id}', 'delete')->name('admin.email.delete');
        // });

        // // Prefrences
        // Route::controller(PreferencesController::class)->group(function () {
        //     Route::get('/hom/preferences', 'home_preferences')->name('admin.home.preferences');
        //     Route::post('/hom/store/preferences', 'home_store')->name('admin.home.store.preferences');
        //     Route::get('/about/preferences', 'about_preferences')->name('admin.about.preferences');
        //     Route::post('/about/store/preferences', 'about_store')->name('admin.about.store.preferences');
        //     Route::get('/service/preferences', 'service_preferences')->name('admin.service.preferences');
        //     Route::post('/service/store/preferences', 'service_store')->name('admin.service.store.preferences');
        //     Route::get('/store/preferences', 'store_preferences')->name('admin.store.preferences');
        //     Route::post('/store/store/preferences', 'store_store')->name('admin.store.store.preferences');
        //     Route::get('/contact/preferences', 'contact_preferences')->name('admin.contact.preferences');
        //     Route::post('/contact/store/preferences', 'contact_store')->name('admin.contact.store.preferences');
        //     Route::get('/categories/preferences', 'categories_preferences')->name('admin.categories.preferences');
        //     Route::post('/categories/store/preferences', 'categories_store')->name('admin.categories.store.preferences');
        //     Route::get('/brands/preferences', 'brands_preferences')->name('admin.brands.preferences');
        //     Route::post('/brands/store/preferences', 'brands_store')->name('admin.brands.store.preferences');
        //     Route::get('/cart/preferences', 'cart_preferences')->name('admin.cart.preferences');
        //     Route::post('/cart/store/preferences', 'cart_store')->name('admin.cart.store.preferences');
        // });
    });
});
