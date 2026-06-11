<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Subscribe;


class DashboardController extends Controller
{
    function index()
    {
        $client = auth()->user();
        $websiteId = $client->website?->id;

        if (!$websiteId) {
            return response()->json([
                'msg' => 'Client does not have a website'
            ], 404);
        }
        $pending_orders = Order::whereOrderStatus('pending')->where('website_id', $client->website->id)->count();
        $processing_orders = Order::whereOrderStatus('processing')->where('website_id', $client->website->id)->count();
        $progress_orders = Order::whereOrderStatus('progress')->where('website_id', $client->website->id)->count();
        $delivered_orders = Order::whereOrderStatus('delivered')->where('website_id', $client->website->id)->count();
        $canceled_orders = Order::whereOrderStatus('canceled')->where('website_id', $client->website->id)->count();
        $all_orders = Order::where('website_id', $client->website->id)->count();
        $total_earning = Order::where('website_id', $client->website->id)->sum('total');
        $total_products = Product::where('client_id', $client->id)->count();
        // $total_customer = User::count();
        $total_category = Category::where('client_id', $client->id)->count();
        $total_brand = Brand::where('client_id', $client->id)->count();
        $total_transaction = Transaction::where('website_id', $client->website->id)->count();
        $total_blog = Blog::where('client_id', $client->id)->count();
        $total_sub = Subscribe::where('website_id', $client->website->id)->count();
        $total_web = Website::where('client_id', $client->id)->count();

        // $total_client = Client::count();
        // $active_client = Client::where('status', 1)->count();
        return view('client.dashboard', compact(
            'pending_orders',
            'processing_orders',
            'progress_orders',
            'delivered_orders',
            'canceled_orders',
            'canceled_orders',
            'all_orders',
            'total_earning',
            'total_products',
            // 'total_customer',
            'total_category',
            'total_brand',
            'total_transaction',
            'total_blog',
            'total_sub',
            'total_web',
            // 'total_client',
            // 'active_client',
        ));
    }
}
