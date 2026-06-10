<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
    public function index()
    {
        $client = auth()->guard('client')->user();
        $subscribers = Subscribe::where('website_id', $client->website->id)->get();
        return view('client.subscriber.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        $client = auth()->guard('client')->user();
        Subscribe::where('id', $id)
            ->where('website_id', $client->website->id)
            ->firstOrFail();
        return redirect()->back()->with('success', 'Subscriber deleted');
    }
}
