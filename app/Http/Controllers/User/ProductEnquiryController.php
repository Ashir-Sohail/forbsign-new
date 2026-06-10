<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductEnquiry;
use App\Mail\ProductEnquiryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProductEnquiryController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:20',
            'message'        => 'required|string',
            'file' => 'required|mimes:jpeg,png,pdf,zip|max:2048000',

        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            try {
                $filePath = $request->file('file')->store('product_enquiriy', 's3');
                Storage::disk('s3')->setVisibility($filePath, 'public');
            } catch (\Exception $e) {
                dd('S3 upload error: ' . $e->getMessage());
            }
        }


        // Save enquiry
        $enquiry = ProductEnquiry::create([
            'product_id'     => $request->product_id,
            'name'           => $request->name,
            'email'          => $request->email,
            'contact_number' => $request->contact_number,
            'message'        => $request->message,
            'file'           => $filePath,
        ]);

        $enquiry = ProductEnquiry::with('product')->latest()->first();
        Mail::to(config('mail.admin_email'))->queue(new ProductEnquiryMail($enquiry));


        return response()->json(['message' => 'Your enquiry has been submitted successfully!']);
    }
}
