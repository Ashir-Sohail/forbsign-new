<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomColor;

class CustomColorController extends Controller
{
    public function index()
    {
        $customColors = CustomColor::latest()->get();
        return view('admin.custom-color.index', compact('customColors'));
    }

    public function create()
    {
        return view('admin.custom-color.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hex_code' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'serial' => 'nullable',
        ]);

        CustomColor::create([
            'name' => $request->name,
            'hex_code' => $request->hex_code,
            'serial' => $request->serial ?? 0,
            'status' => 1,
        ]);

        return redirect()->route('admin.custom_color.index')->with('success', 'Custom color added successfully.');
    }
}
