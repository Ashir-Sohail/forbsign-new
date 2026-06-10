<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Website;

class FaqCategoryController extends Controller
{
    public function index(): View
    {
        $client = auth()->user();
        $faq_categories = FaqCategory::where('client_id', $client->id)->where('website_id', $client->website->id)->get();
        return view('client.faq-category.index', compact('faq_categories'));
    }

    public function create(): View
    {
        $website = Website::where('client_id', auth()->user()->id)->get();
        return view('client.faq-category.create', compact('website'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required|unique:faq_categories',
            'text' => 'required',
            'website_id' => 'required',
            // 'meta_keyword' => 'required',
            // 'meta_description' => 'required',
        ]);
        FaqCategory::create([
            'client_id' => auth()->user()->id,
            'website_id' => $validate['website_id'],
            'name' => $validate['name'],
            'text' => $validate['text'],
            'slug' => Str::slug($validate['name']),
            // 'meta_keyword' => $validate['meta_keyword'],
            // 'meta_description' => $validate['meta_description'],
        ]);
        return redirect()->route('client.faq-category.index')->with('success', 'Faq category add successfully');
    }

    public function edit($id): View
    {
        $website = Website::where('client_id', auth()->user()->id)->get();
        $faq_category = FaqCategory::findOrFail($id);
        return view('client.faq-category.update', compact('website','faq_category'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'text' => 'required',
            'website_id' => 'required',
            // 'meta_keyword' => 'required',
            // 'meta_description' => 'required',
        ]);
        FaqCategory::where('id', $id)->update([
            'website_id' => $validate['website_id'],
            'name' => $validate['name'],
            'text' => $validate['text'], // add this line just for now
            'slug' => Str::slug($validate['name']),
            // 'meta_keyword' => $validate['meta_keyword'],
            // 'meta_description' => $validate['meta_description'],
        ]);
        return redirect()->route('client.faq-category.index')->with('success', 'Faq category update successfully');
    }

    public function delete($id): RedirectResponse
    {
        FaqCategory::findOrFail($id)->delete();
        return redirect()->route('client.faq-category.index')->with('success', 'Faq category delete successfully');
    }

    public function update_status($id): RedirectResponse
    {
        $faq_category = FaqCategory::findOrFail($id);
        if ($faq_category->status == 1) {
            $faq_category->status = 0;
            $faq_category->save();

            return redirect()->route('client.faq-category.index')->with('success', 'FaqCategory Status un-active successfully');
        } else {
            $faq_category->status = 1;
            $faq_category->save();

            return redirect()->route('client.faq-category.index')->with('success', 'FaqCategory Status active successfully');
        }
    }
}
