<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Website;

class FaqController extends Controller
{
    function index(): View
    {
        $client = auth()->guard('client')->user();
        $faqs = Faq::where('client_id', $client->id)->where('website_id', $client->website->id)->get();
        return view('client.faq.index', compact('faqs'));
    }
    function create(): View
    {
        $website = Website::where('client_id', auth()->guard('client')->id())->get();
        $faq_categories = FaqCategory::where('client_id', auth()->guard('client')->id())->get();
        return view('client.faq.create', compact('website', 'faq_categories'));
    }
    function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'details' => 'required',
            'website_id' => 'required',
            'website_id' => 'required|integer',
        ]);

        // Inject authenticated client_id manually
        $validate['client_id'] = auth()->guard('client')->id();
        Faq::create($validate);
        return redirect()->route('client.faq.index')->with('success', 'Faq  add successfully');
    }
    function edit($id): View
    {
        $faq = Faq::findOrFail($id);
        $website = Website::where('client_id', auth()->guard('client')->id())->get();
        $faq_categories = FaqCategory::where('client_id', auth()->guard('client')->id())->get();
        return view('client.faq.update', compact('faq', 'website', 'faq_categories'));
    }
    function update(Request $request, $id): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'details' => 'required',
            'website_id' => 'required|integer',
        ]);
        Faq::where('id', $id)->update($validate);
        return redirect()->route('client.faq.index')->with('success', 'Faq  update successfully');
    }
    function delete($id): RedirectResponse
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('client.faq.index')->with('success', 'Faq  delete successfully');
    }
}
