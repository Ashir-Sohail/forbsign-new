<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    function index(): View
    {
        $wishlists = Wishlist::with('product')->whereUserId(auth()->id())->get();
        return view('user.wishlists', compact('wishlists'));
    }


    public function addToWishlist($rawId)
    {
        if(!Auth::check()){
            return redirect()->back()->with('message', 'Please login to add products to your wishlist.');
        }
        // Step 1: Extract product ID from "79-145:60"
        $productId = null;

        if (strpos($rawId, '-') !== false) {
            // "79-145:60" → split by "-" → ["79", "145:60"]
            $parts = explode('-', $rawId);
            $productId = $parts[0]; 
        } elseif (is_numeric($rawId)) {
            $productId = $rawId;
        }


        // Step 2: Validate product exists
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Step 3: Add to wishlist if not already added
        $userId = auth()->id();

        if (Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists()) {
            return redirect()->back()->with('message', 'Product already in wishlist.');
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return redirect()->back()->with('message', 'Product added to wishlist.');
    }


    function clear_wishlist()
    {
        Wishlist::whereUserId(auth()->id())->delete();
        return redirect()->route('user.wishlist')->with('success', 'wishlist empty successfully');
    }

    function remove_wishlist($id)
    {
        Wishlist::whereUserId(auth()->id())->findOrFail($id)->delete();
        return redirect()->route('user.wishlist')->with('success', 'wishlist remove successfully');
    }
}
