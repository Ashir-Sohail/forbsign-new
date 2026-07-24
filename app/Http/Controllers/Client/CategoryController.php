<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\FileUploadHelper;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->get();
        return view('client.category.index', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('client.category.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2096',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_url' => 'required',
            'meta_description' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            $filename = FileUploadHelper::upload($request->file('image'), 'category');
        }

        $category = new Category();
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
        return view('client.category.update', compact('category', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2096',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_url' => 'required',
            'meta_description' => 'required',
        ]);

        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            FileUploadHelper::delete($category->image);
            $category->image = FileUploadHelper::upload($request->file('image'), 'category');
        }

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
        FileUploadHelper::delete($category->image);
        $category->delete();
        return redirect()->route('client.category.index')->with('success', 'Category Delete successfully');
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
