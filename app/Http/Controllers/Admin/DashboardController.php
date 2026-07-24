<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    function index(): View
    {
        $pending_orders = Order::whereOrderStatus('pending')->count();
        $processing_orders = Order::whereOrderStatus('processing')->count();
        $progress_orders = Order::whereOrderStatus('progress')->count();
        $delivered_orders = Order::whereOrderStatus('delivered')->count();
        $canceled_orders = Order::whereOrderStatus('canceled')->count();
        $all_orders = Order::count();
        $total_earning = Order::sum('total');
        $total_products = Product::count();
        $total_customer = User::count();
        $total_category = Category::count();
        $total_brand = Brand::count();
        $total_transaction = Transaction::count();
        $total_blog = Blog::count();

        return view('admin.dashboard', compact(
            'pending_orders',
            'processing_orders',
            'progress_orders',
            'delivered_orders',
            'canceled_orders',
            'all_orders',
            'total_earning',
            'total_products',
            'total_customer',
            'total_category',
            'total_brand',
            'total_transaction',
            'total_blog',
        ));
    }
}
