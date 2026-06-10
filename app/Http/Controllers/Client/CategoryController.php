<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Website;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('client_id', auth()->guard('client')->id())->get();
        return view('client.category.index', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::with('children')->whereNull('parent_id')
            ->where('client_id', auth()->guard('client')->id())->get();
        $websites = Website::where('client_id', auth()->guard('client')->id())->get();
        return view('client.category.create', compact('categories', 'websites'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'website_id' => 'required|exists:websites,id',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2096',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_url' => 'required',
            'meta_description' => 'required',
            'parent_id' => 'nullable|exists:categories,id',

        ]);


        $filename = '';
        if ($request->file('image')) {
            //  Upload to S3
            $filename = $request->file('image')->store('category', 's3');
            // Make file publicly accessible
            Storage::disk('s3')->setVisibility($filename, 'public');
        }

        $category = new Category();
        $category->client_id = auth()->guard('client')->id();
        $category->website_id = $request->website_id;
        $category->image = $filename;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->meta_title = $request->meta_title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_url = $request->meta_url;
        $category->meta_description = $request->meta_description;
        $category->serial = $request->serial;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('client.category.index')->with('success', 'Category add successfully');
    }

    public function edit($id): View
    {

        $category = Category::findOrFail($id);
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $websites = Website::where('client_id', auth()->guard('client')->id())->get();
        return view('client.category.update', compact('category', 'categories','websites'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'website_id' => 'required|exists:websites,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2096',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_url' => 'required',
            'meta_description' => 'required',
        ]);

        $category = Category::findOrFail($id);

        $filename = '';
        if ($request->hasFile('image')) {

            //  Optionally delete the old image from S3
            if ($category->image && Storage::disk('s3')->exists($category->image)) {
                Storage::disk('s3')->delete($category->image);
            }

            //  Upload new image
            $filename = $request->file('image')->store('category', 's3');
            Storage::disk('s3')->setVisibility($filename, 'public');

            //  Save new image path
            $category->image = $filename;
        }
        $category->website_id = $request->website_id;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->meta_title = $request->meta_title;
        $category->meta_url = $request->meta_url;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->serial = $request->serial;
        $category->parent_id = $request->parent_id;

        $category->save();
        return redirect()->route('client.category.index')->with('success', 'Category Update successfully');
    }

    public function delete($id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        if ($category->image && Storage::disk('s3')->exists($category->image)) {
            Storage::disk('s3')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category Delete successfully');
    }

    public function update_status($id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        if ($category->status == 1) {
            $category->status = 0;
            $category->save();

            return redirect()->route('client.category.index')->with('success', 'Category Status un-active successfully');
        } else {
            $category->status = 1;
            $category->save();

            return redirect()->route('client.category.index')->with('success', 'Category Status active successfully');
        }
    }
}
