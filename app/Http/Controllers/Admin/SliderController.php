<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::latest()->get();
        $sliderCount = Slider::count();
        return view('admin.slider.index', compact('sliders', 'sliderCount'));
    }

    public function create(): View
    {
        return view('admin.slider.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Check slider count
        if (Slider::count() >= 4) {
            return redirect()->route('admin.slider.index')
                ->with('error', 'You can only create up to 4 sliders.');
        }
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2096',
            'url' => [
                'required',
                'regex:/^(https?:\/\/)?([\w\-]+\.)+[\w\-]{2,}(\/[^\s]*)?$/'
            ],
        ]);

        $filename = '';
        if ($request->file('image')) {
            // Upload to S3
            $filename = $request->file('image')->store('slider', 's3');
            // Make file publicly accessible
            Storage::disk('s3')->setVisibility($filename, 'public');
        }

        $slider = new Slider();
        $slider->image = $filename;
        $slider->url = $request->url;
        $slider->title = $request->title;
        $slider->details = $request->details;
        $slider->save();
        return redirect()->route('admin.slider.index')->with('success', 'Slider add successfully');
    }

    public function edit($id): View
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.update', compact('slider'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2096',
            'url' => [
                'required',
                'regex:/^(https?:\/\/)?([\w\-]+\.)+[\w\-]{2,}(\/[^\s]*)?$/'
            ],
        ]);

        $slider = Slider::findOrFail($id);
        $filename = '';
        if ($request->hasFile('image')) {

            //  Optionally delete the old image from S3
            if ($slider->image && Storage::disk('s3')->exists($slider->image)) {
                Storage::disk('s3')->delete($slider->image);
            }

            //  Upload new image
            $filename = $request->file('image')->store('slider', 's3');
            Storage::disk('s3')->setVisibility($filename, 'public');

            //  Save new image path
            $slider->image = $filename;
        }

        $slider->url = $request->url;
        $slider->title = $request->title;
        $slider->details = $request->details;
        $slider->save();
        return redirect()->route('admin.slider.index')->with('success', 'Slider Update successfully');
    }

    public function delete($id): RedirectResponse
    {
        $slider = Slider::findOrFail($id);
        $path = public_path('storage\\' . $slider->image);
        // Delete image from S3 if it exists
        if ($slider->image && Storage::disk('s3')->exists($slider->image)) {
            Storage::disk('s3')->delete($slider->image);
        }

        $slider->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Slider Delete successfully');
    }
}
