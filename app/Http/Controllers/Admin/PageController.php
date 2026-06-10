<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'meta_title' => 'required|string',
            'meta_description' => 'required',
            'meta_keywords' => 'required|string',
            'meta_url' => 'required|string',
        ]);

        $page = Page::findOrFail($id);
        $page->update($request->all());

        return redirect()->route('admin.pages')->with('success', 'Page updated successfully.');
    }
}
