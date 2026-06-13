<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManageSite;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Helpers\FileUploadHelper;

class ManageSiteController extends Controller
{
    function index(): View
    {
        // $manage_site = new ManageSite();
        // $manage_site->key = "four_three_column";
        // $value = [
        //     'image1' => '$filename1',
        //     'image2' => '$filename2',
        //     'image3' => '$filename3',
        //     'title1' => '$request->title1',
        //     'title2' => '$request->title2',
        //     'sub_title1' => '$request->sub_title1',
        //     'sub_title2' => '$request->sub_title2',
        //     'url1' => '$request->url1',
        //     'title3' => '$request->title3',
        //     'sub_title3' => '$request->sub_title3',
        //     'url3' => '$request->url3',
        //     'url2' => '$request->url2',
        // ];
        // $manage_site->value = json_encode($value);
        // $manage_site->save();

        $basic_setting = ManageSite::where('key', 'basic_setting')->first();
        $home_page_setting = ManageSite::where('key', 'home_page')->first();
        $media_setting = ManageSite::where('key', 'media')->first();
        $seo_setting = ManageSite::where('key', 'seo')->first();
        $first_three_column = ManageSite::where('key', 'first_three_column')->first();
        $second_three_column = ManageSite::where('key', 'second_three_column')->first();
        $third_two_column = ManageSite::where('key', 'third_two_column')->first();
        $four_three_column = ManageSite::where('key', 'four_three_column')->first();
        $footer_setting = ManageSite::where('key', 'footer')->first();

        return view('admin.setting.manage-site', compact(
            'basic_setting',
            'home_page_setting',
            'media_setting',
            'seo_setting',
            'footer_setting',
            'first_three_column',
            'second_three_column',
            'four_three_column',
            'third_two_column',
        ));
    }


    function basic_setting(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();
        $value = [
            'app_name' => $request->app_name,
            'home_page_title' => $request->home_page_title,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }
    function media(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();

        // Handle to  upload and manage media files
        if ($request->hasFile('logo')) {
            FileUploadHelper::delete($request->old_logo);

            $logo = FileUploadHelper::upload($request->file('logo'), 'media');
        } else {
            $logo = $request->old_logo;
        }

        if ($request->hasFile('favicon')) {
            FileUploadHelper::delete($request->old_favicon);

            $favicon = FileUploadHelper::upload($request->file('favicon'), 'media');
        } else {
            $favicon = $request->old_favicon;
        }

        if ($request->hasFile('loader')) {
            FileUploadHelper::delete($request->old_loader);

            $loader = FileUploadHelper::upload($request->file('loader'), 'media');
        } else {
            $loader = $request->old_loader;
        }

        $value = [
            'logo' => $logo,
            'favicon' => $favicon,
            'loader' => $loader,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }
    function seo(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();
        $value = [
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();

        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }
    function footer(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();

        $filename1 = $request->old_image1;
        if ($request->hasFile('image1')) {
            FileUploadHelper::delete($request->old_image1);
            $filename1 = FileUploadHelper::upload($request->file('image1'), 'footer');
        }

        $value = [
            'image1' => $filename1,
            'address' => $request->address,
            'google_maps_url' => $request->google_maps_url,
            'phone' => $request->phone,
            'email' => $request->email,
            'copyright' => $request->copyright,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'pinterest' => $request->pinterest,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }

    // function home_page(Request $request)
    // {
    //     // dd($request->all());
    //     $manage_site = ManageSite::where('key', $request->key)->first();
    //     // Handle image1
    //     $filename1 = $request->old_image1;
    //     if ($request->file('image1')) {
    //         if ($request->old_image1 && Storage::disk('s3')->exists($request->old_image1)) {
    //             Storage::disk('s3')->delete($request->old_image1);
    //         }
    //         $filename1 = $request->file('image1')->store('home_page', 's3');
    //         Storage::disk('s3')->setVisibility($filename1, 'public');
    //     }

    //     // Handle image2
    //     $filename2 = $request->old_image2;
    //     if ($request->file('image2')) {
    //         if ($request->old_image2 && Storage::disk('s3')->exists($request->old_image2)) {
    //             Storage::disk('s3')->delete($request->old_image2);
    //         }
    //         $filename2 = $request->file('image2')->store('home_page', 's3');
    //         Storage::disk('s3')->setVisibility($filename2, 'public');
    //     }

    //     $value = [
    //         'image1' => $filename1,
    //         'image2' => $filename2,
    //         'title1' => $request->title1,
    //         'title2' => $request->title2,
    //         'sub_title1' => $request->sub_title1,
    //         'sub_title2' => $request->sub_title2,
    //         'url1' => $request->url1,
    //         'url2' => $request->url2,
    //     ];
    //     $manage_site->value = json_encode($value);
    //     $manage_site->save();
    //     return redirect()->back()->with('success', $request->key . ' Update Successfully');
    // }

    function home_page(Request $request)
    {
        // dd($request->all());
        // Handle image1
        $filename1 = $request->old_image1;
        if ($request->hasFile('image1')) {
            FileUploadHelper::delete($request->old_image1);
            $filename1 = FileUploadHelper::upload($request->file('image1'), 'home_page');
        }

        // Handle image2
        $filename2 = $request->old_image2;
        if ($request->hasFile('image2')) {
            FileUploadHelper::delete($request->old_image2);
            $filename2 = FileUploadHelper::upload($request->file('image2'), 'home_page');
        }

        $value = [
            'image1' => $filename1,
            'image2' => $filename2,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'sub_title1' => $request->sub_title1,
            'sub_title2' => $request->sub_title2,
            'url1' => $request->url1,
            'url2' => $request->url2,
        ];
        ManageSite::updateOrCreate(
            ['key' => $request->key], // Search condition
            ['value' => json_encode($value)] // Data to update or insert
        );
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }

    function first_three_column(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();
        $filename1 = '';
        if ($request->hasFile('image1')) {
            FileUploadHelper::delete($request->old_image1);
            $filename1 = FileUploadHelper::upload($request->file('image1'), 'home_page');
        } else {
            $filename1 = $request->old_image1;
        }

        $filename2 = '';
        if ($request->hasFile('image2')) {
            FileUploadHelper::delete($request->old_image2);
            $filename2 = FileUploadHelper::upload($request->file('image2'), 'home_page');
        } else {
            $filename2 = $request->old_image2;
        }
        $filename3 = '';
        if ($request->hasFile('image3')) {
            FileUploadHelper::delete($request->old_image3);
            $filename3 = FileUploadHelper::upload($request->file('image3'), 'home_page');
        } else {
            $filename3 = $request->old_image3;
        }
        $value = [
            'image1' => $filename1,
            'image2' => $filename2,
            'image3' => $filename3,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'sub_title1' => $request->sub_title1,
            'sub_title2' => $request->sub_title2,
            'url1' => $request->url1,
            'title3' => $request->title3,
            'sub_title3' => $request->sub_title3,
            'url3' => $request->url3,
            'url2' => $request->url2,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }
    function second_three_column(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();
        $filename1 = '';
        if ($request->hasFile('image1')) {
            FileUploadHelper::delete($request->old_image1);
            $filename1 = FileUploadHelper::upload($request->file('image1'), 'home_page');
        } else {
            $filename1 = $request->old_image1;
        }

        $filename2 = '';
        if ($request->hasFile('image2')) {
            FileUploadHelper::delete($request->old_image2);
            $filename2 = FileUploadHelper::upload($request->file('image2'), 'home_page');
        } else {
            $filename2 = $request->old_image2;
        }
        $filename3 = '';
        if ($request->hasFile('image3')) {
            FileUploadHelper::delete($request->old_image3);
            $filename3 = FileUploadHelper::upload($request->file('image3'), 'home_page');
        } else {
            $filename3 = $request->old_image3;
        }
        $value = [
            'image1' => $filename1,
            'image2' => $filename2,
            'image3' => $filename3,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'sub_title1' => $request->sub_title1,
            'sub_title2' => $request->sub_title2,
            'url1' => $request->url1,
            'title3' => $request->title3,
            'sub_title3' => $request->sub_title3,
            'url3' => $request->url3,
            'url2' => $request->url2,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }
    function third_two_column(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();
        $filename1 = '';
        if ($request->hasFile('image1')) {
            FileUploadHelper::delete($request->old_image1);
            $filename1 = FileUploadHelper::upload($request->file('image1'), 'home_page');
        } else {
            $filename1 = $request->old_image1;
        }

        $filename2 = '';
        if ($request->hasFile('image2')) {
            FileUploadHelper::delete($request->old_image2);
            $filename2 = FileUploadHelper::upload($request->file('image2'), 'home_page');
        } else {
            $filename2 = $request->old_image2;
        }
        $value = [
            'image1' => $filename1,
            'image2' => $filename2,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'sub_title1' => $request->sub_title1,
            'sub_title2' => $request->sub_title2,
            'url1' => $request->url1,
            'url2' => $request->url2,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }
    function four_three_column(Request $request)
    {
        $manage_site = ManageSite::where('key', $request->key)->first();
        $filename1 = '';
        if ($request->hasFile('image1')) {
            FileUploadHelper::delete($request->old_image1);
            $filename1 = FileUploadHelper::upload($request->file('image1'), 'home_page');
        } else {
            $filename1 = $request->old_image1;
        }

        $filename2 = '';
        if ($request->hasFile('image2')) {
            FileUploadHelper::delete($request->old_image2);
            $filename2 = FileUploadHelper::upload($request->file('image2'), 'home_page');
        } else {
            $filename2 = $request->old_image2;
        }
        $filename3 = '';
        if ($request->hasFile('image3')) {
            FileUploadHelper::delete($request->old_image3);
            $filename3 = FileUploadHelper::upload($request->file('image3'), 'home_page');
        } else {
            $filename3 = $request->old_image3;
        }
        $value = [
            'image1' => $filename1,
            'image2' => $filename2,
            'image3' => $filename3,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'sub_title1' => $request->sub_title1,
            'sub_title2' => $request->sub_title2,
            'url1' => $request->url1,
            'title3' => $request->title3,
            'sub_title3' => $request->sub_title3,
            'url3' => $request->url3,
            'url2' => $request->url2,
        ];
        $manage_site->value = json_encode($value);
        $manage_site->save();
        return redirect()->back()->with('success', $request->key . ' Update Successfully');
    }
}
