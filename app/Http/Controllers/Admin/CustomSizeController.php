<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomSize;

class CustomSizeController extends Controller
{
    public function index()
    {
        $customSizes = CustomSize::latest()->get();
        return view('admin.custom-size.index', compact('customSizes'));
    }

    public function create()
    {
        // Logic to show form for creating a new custom image
        return view('admin.custom-size.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // 1. Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'extra_price' => 'nullable|numeric|min:0',
            'serial' => 'nullable',
        ]);

        // 2. Store in DB
        CustomSize::create([
            'name' => $request->name,
            'extra_price' => $request->extra_price ?? 0,
            'serial' => $request->serial ?? 0,
            'status' => 1,
        ]);

        // 3. Redirect
        return redirect()->route('admin.custom_size.index')
            ->with('success', 'Custom size created successfully.');
    }

    public function edit($id)
    {
        // Logic to show form for editing an existing custom image
        return view('admin.custom-img.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing custom image
        return redirect()->route('admin.custom-img.index')->with('success', 'Custom image updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete a custom image
        return redirect()->route('admin.custom-img.index')->with('success', 'Custom image deleted successfully.');
    }
}
