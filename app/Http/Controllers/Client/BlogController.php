<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Helpers\FileUploadHelper;

class BlogController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function index(): View
    {
        $blogs = Blog::latest()->get();
        return view('client.blog.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('client.blog.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2096',
            'title' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'meta_url' => 'required',
        ]);
        $blog = new Blog();

        $filename = '';
        if ($request->hasFile('image')) {
            $filename = FileUploadHelper::upload($request->file('image'), 'blog');
        }

        $blog->image = $filename;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->meta_title = $request->meta_title;
        $blog->meta_keyword = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->meta_url = $request->meta_url;
        $blog->save();
        return redirect()->route('client.blog.index')->with('success', 'Blog Create successfully');
    }

    public function edit($id): View
    {
        $blog = Blog::findOrFail($id);
        return view('client.blog.update', compact('blog'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg|max:2096',
            'title' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'meta_url' => 'required',
        ]);
        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            FileUploadHelper::delete($blog->image);

            $blog->image = FileUploadHelper::upload(
                $request->file('image'),
                'blog'
            );
        }

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->meta_title = $request->meta_title;
        $blog->meta_keyword = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->meta_url = $request->meta_url;
        $blog->save();
        return redirect()->route('client.blog.index')->with('success', 'Blog Update successfully');
    }

    public function delete($id): RedirectResponse
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image) {
            FileUploadHelper::delete($blog->image);
        }

        $blog->delete();
        return redirect()->route('client.blog.index')->with('success', 'Blog Delete successfully');
    }
}
