<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Website;

class WebsiteController extends Controller
{
    //
    public function index()
    {
        $websites = Website::where('client_id', auth()->guard('client')->id())->get();
        return view('client.website.index', compact('websites'));
    }
}
