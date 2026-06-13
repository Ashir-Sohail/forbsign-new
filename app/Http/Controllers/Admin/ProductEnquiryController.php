<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductEnquiry;
use App\Helpers\FileUploadHelper;

class ProductEnquiryController extends Controller
{
    public function index()
    {
        $enquiries = ProductEnquiry::latest()->get();
        return view('admin.product-enquiry.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = ProductEnquiry::findOrFail($id);
        return view('admin.product_enquiries.show', compact('enquiry'));
    }

    public function destroy($id)
    {

        $enquiry = ProductEnquiry::findOrFail($id);

        if ($enquiry->file) {
            FileUploadHelper::delete($enquiry->file);
        }

        $enquiry->delete();
        return redirect()->route('admin.product-enquiries')->with('success', 'Enquiry deleted successfully.');
    }
}
