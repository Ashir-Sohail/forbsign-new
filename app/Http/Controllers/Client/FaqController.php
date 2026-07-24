<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    function index(): View
    {
        $faqs = Faq::latest()->get();
        return view('client.faq.index', compact('faqs'));
    }

    function create(): View
    {
        $faq_categories = FaqCategory::latest()->get();
        return view('client.faq.create', compact('faq_categories'));
    }

    function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'details' => 'required',
        ]);
        Faq::create($validate);
        return redirect()->route('client.faq.index')->with('success', 'Faq  add successfully');
    }

    function edit($id): View
    {
        $faq = Faq::findOrFail($id);
        $faq_categories = FaqCategory::latest()->get();
        return view('client.faq.update', compact('faq', 'faq_categories'));
    }

    function update(Request $request, $id): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'details' => 'required',
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
