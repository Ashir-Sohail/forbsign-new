<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomImage;
use Illuminate\Support\Facades\File;

class CustomImageController extends Controller
{
    public function index()
    {
        $customImgs = CustomImage::latest()->get();
        return view('admin.custom-img.index', compact('customImgs'));
    }

    public function create()
    {
        // Logic to show form for creating a new custom image
        return view('admin.custom-img.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // 1. Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'per_character_price' => 'required|numeric|min:0',
            'serial' => 'nullable',
        ]);

        // 2. Upload to public/uploads/custom-images
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('uploads/custom-images');
            File::ensureDirectoryExists($destination); // Laravel 10+

            $file->move($destination, $filename);
            $imagePath = 'uploads/custom-images/' . $filename;
        }

        // 3. Store in DB
        CustomImage::create([
            'name' => $request->name,
            'image_path' => $imagePath,
            'per_character_price' => $request->per_character_price,
            'serial' => $request->serial ?? 0,
            'status' => 1,
        ]);

        // 4. Redirect
        return redirect()->route('admin.custom_image.index')
            ->with('success', 'Custom image created successfully.');
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
