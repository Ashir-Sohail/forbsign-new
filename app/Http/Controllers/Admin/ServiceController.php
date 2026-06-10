<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::latest()->get();
        $serviceCount = Service::count();
        return view('admin.service.index', compact('services', 'serviceCount'));
    }

    public function create(): View
    {
        return view('admin.service.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Check service count
        if (Service::count() >= 4) {
            return redirect()->route('admin.service.index')
                ->with('error', 'You can only create up to 4 services.');
        }
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,svg|max:2096',
        ]);

        $filename = '';
        if ($request->file('image')) {
            //  Upload to S3
            $filename = $request->file('image')->store('service', 's3');
            // Make file publicly accessible
            Storage::disk('s3')->setVisibility($filename, 'public');
        }

        $service = new Service();
        $service->image = $filename;
        $service->title = $request->title;
        $service->details = $request->details;
        $service->save();
        return redirect()->route('admin.service.index')->with('success', 'Service add successfully');
    }

    public function edit($id): View
    {
        $service = Service::findOrFail($id);
        return view('admin.service.update', compact('service'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2096',
        ]);
        $service = Service::findOrFail($id);

        $filename = '';
        if ($request->hasFile('image')) {

            //  Optionally delete the old image from S3
            if ($service->image && Storage::disk('s3')->exists($service->image)) {
                Storage::disk('s3')->delete($service->image);
            }

            //  Upload new image
            $filename = $request->file('image')->store('service', 's3');
            Storage::disk('s3')->setVisibility($filename, 'public');

            //  Save new image path
            $service->image = $filename;
        }

        $service->title = $request->title;
        $service->details = $request->details;
        $service->save();
        return redirect()->route('admin.service.index')->with('success', 'Service Update successfully');
    }

    public function delete($id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        // Delete image from S3 if it exists
        if ($service->image && Storage::disk('s3')->exists($service->image)) {
            Storage::disk('s3')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('admin.service.index')->with('success', 'Service Delete successfully');
    }
}
