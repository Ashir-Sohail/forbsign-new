<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Helpers\FileUploadHelper;


class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.index', compact('brands'));
    }

    public function create(): View
    {
        return view('admin.brand.create');
    }

    public function store(BrandRequest $request): RedirectResponse
    {

        $filename = '';
        if ($request->hasFile('image')) {
            $filename = FileUploadHelper::upload($request->file('image'), 'brand');
        }

        $brand = new Brand();
        $brand->image = $filename;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->meta_title = $request->meta_title;
        $brand->meta_keyword = $request->meta_keyword;
        $brand->meta_description = $request->meta_description;
        $brand->meta_url = $request->meta_url;
        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Brand add successfully');
    }

    public function edit($id): View
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.update', compact('brand'));
    }

    public function update(BrandRequest $request, $id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {

            FileUploadHelper::delete($brand->image);

            $brand->image = FileUploadHelper::upload($request->file('image'), 'brand');
        }

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->meta_title = $request->meta_title;
        $brand->meta_url = $request->meta_url;
        $brand->meta_keyword = $request->meta_keyword;
        $brand->meta_description = $request->meta_description;
        $brand->save();
        return redirect()->route('admin.brand.index')->with('success', 'Brand Update successfully');
    }

    public function delete($id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);
        FileUploadHelper::delete($brand->image);

        // Delete the brand record from DB
        $brand->delete();

        return redirect()->route('admin.brand.index')->with('success', 'Brand Delete successfully');
    }

    public function update_status($id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);
        if ($brand->status == 1) {
            $brand->status = 0;
            $brand->save();

            return redirect()->route('admin.brand.index')->with('success', 'Brand Status un-active successfully');
        } else {
            $brand->status = 1;
            $brand->save();

            return redirect()->route('admin.brand.index')->with('success', 'Brand Status active successfully');
        }
    }
}
