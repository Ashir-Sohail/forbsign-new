<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePreference;
use App\Models\AboutPreference;
use App\Models\ServicePreference;
use App\Models\StorePreference;
use App\Models\ContactPreference;
use App\Models\CategoriesPreference;
use App\Models\BrandsPreference;
use App\Models\CartPreference;

class PreferencesController extends Controller
{
    //
    public function home_preferences()
    {
        $homepreferences = HomePreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.home_preferences', compact('homepreferences'));
    }

    public function home_store(Request $request)
    {
        // dd($request->all());
        $data =  $request->validate([
            // General Tab
            'general_heading' => 'required|string|max:255',
            'general_description' => 'required|string|max:1000',

            // Images Tab
            'image_one_button' => 'required|string|max:255',
            'image_one_button_link' => 'required|string|max:1000',
            'image_two_button' => 'required|string|max:255',
            'image_two_button_link' => 'required|string|max:1000',

            // Trusted Tab
            'icon1' => 'required|string',
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'title3' => 'required|string|max:255',

            'icon2' => 'required|string',
            'scond_title1' => 'required|string|max:255',
            'scond_title2' => 'required|string|max:255',
            'scond_title3' => 'required|string|max:255',

            'icon3' => 'required|string',
            'third_title1' => 'required|string|max:255',
            'third_title2' => 'required|string|max:255',
            'third_title3' => 'required|string|max:255',

            'icon4' => 'required|string',
            'fourth_title1' => 'required|string|max:255',
            'fourth_title2' => 'required|string|max:255',
            'fourth_title3' => 'required|string|max:255',

            // Craft Tab
            'craft_heading1' => 'required|string|max:255',
            'craft_heading2' => 'required|string|max:255',
            'craft_description' => 'required|string',

            // Button Heading Tab
            'customer_favorite_heading' => 'required|string|max:255',
            'visit_store' => 'required|string|max:255',
            'visit_store_link' => 'required|string|max:1000',
            'categories_heading' => 'required|string|max:255',
            'categories_button' => 'required|string|max:255',
            'categories_button_link' => 'required|string|max:1000',
            'brands_heading' => 'required|string|max:255',
            'brands_button' => 'required|string|max:255',
            'brands_button_link' => 'required|string|max:1000',

            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',

            // Customer Tab
            'customer_heading' => 'required|string|max:255',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            HomePreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }
        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }

    public function about_preferences()
    {
        $aboutpreferences = AboutPreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.about_preferences', compact('aboutpreferences'));
    }

    public function about_store(Request $request)
    {
        $data =  $request->validate([
            // About Tab
            'about_title' => 'required|string|max:255',
            'about_heading' => 'required|string|max:1000',
            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',

            // Customer Tab
            'customer_heading' => 'required|string|max:255',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            AboutPreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }

    public function service_preferences()
    {
        $servicepreferences = ServicePreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.service_preferences', compact('servicepreferences'));
    }

    public function service_store(Request $request)
    {
        $data =  $request->validate([
            // Service Section Tab
            'service_title' => 'required|string|max:255',
            'service_heading' => 'required|string|max:1000',

            // Body Tab
            'body_heading' => 'required|string|max:255',
            'body_description' => 'required|string',

            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',

            // Customer Tab
            'customer_heading' => 'required|string|max:255',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            ServicePreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }

    public function store_preferences()
    {
        $storepreferences = StorePreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.store_preferences', compact('storepreferences'));
    }

    public function store_store(Request $request)
    {
        $data =  $request->validate([
            // Store Section Tab
            'store_title' => 'required|string|max:255',
            'store_heading' => 'required|string|max:1000',

            // Card Tab
            'card_heading1' => 'required|string|max:255',
            'card_heading2' => 'required|string|max:255',
            'card_heading3' => 'required|string|max:255',

            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            StorePreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }

    public function contact_preferences()
    {
        $contactpreferences = ContactPreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.contact_preferences', compact('contactpreferences'));
    }

    public function contact_store(Request $request)
    {
        // dd($request->all());
        $data =  $request->validate([
            // Contact Section Tab
            'contact_title' => 'required|string|max:255',
            'contact_heading' => 'required|string|max:1000',

            // Body Tab
            'body_heading' => 'required|string|max:255',
            'form_heading' => 'required|string|max:255',
            'form_button' => 'required|string',
            'address_heading' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'direction_button' => 'required|string',
            'address_contact_heading' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'email' => 'required|email|max:25',
            'social_heading' => 'required|string|max:255',

            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',

            // Customer Tab
            'customer_heading' => 'required|string|max:255',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            ContactPreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }

    public function categories_preferences()
    {
        $categoriespreferences = CategoriesPreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.categories_preferences', compact('categoriespreferences'));
    }

    public function categories_store(Request $request)
    {
        $data =  $request->validate([
            // Category Tab
            'categories_title' => 'required|string|max:255',
            'categories_heading' => 'required|string|max:1000',
            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',

            // Customer Tab
            'customer_heading' => 'required|string|max:255',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            CategoriesPreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }

    public function brands_preferences()
    {
        $brandspreferences = BrandsPreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.brands_preferences', compact('brandspreferences'));
    }
    public function brands_store(Request $request)
    {
        $data =  $request->validate([
            // Brand Tab
            'brand_title' => 'required|string|max:255',
            'brand_heading' => 'required|string|max:1000',
            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',

            // Customer Tab
            'customer_heading' => 'required|string|max:255',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            BrandsPreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }

    public function cart_preferences()
    {
        $cartpreferences = CartPreference::pluck('value', 'name')->toArray();
        return view('admin.preferences.cart_preferences', compact('cartpreferences'));
    }

    public function cart_store(Request $request)
    {
        $data =  $request->validate([
            // Card Tab
            'card_heading' => 'required|string|max:255',
            'card_button1' => 'required|string|max:255',
            'card_button2' => 'required|string|max:255',
            'order_heading' => 'required|string|max:255',
            'card_subtotal' => 'required|string|max:255',
            'card_shipping' => 'required|string|max:255',

            // Information Tab
            'information_icon1' => 'required|string',
            'information_heading1' => 'required|string|max:255',
            'information_description1' => 'required|string',

            'information_icon2' => 'required|string',
            'information_heading2' => 'required|string|max:255',
            'information_description2' => 'required|string',

            'information_icon3' => 'required|string',
            'information_heading3' => 'required|string|max:255',
            'information_Description3' => 'required|string',
        ]);
        foreach ($data as $key => $value) {
            // Store or update the preference
            CartPreference::updateOrCreate(
                ['name' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }
}
