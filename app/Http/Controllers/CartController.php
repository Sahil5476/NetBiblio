<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ===========================
    // CART FUNCTIONS
    // ===========================

    /**
     * Show the Cart Page
     */
    public function cart()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();
        return view('cart', compact('cartItems'));
    }

    /**
     * Add Item to Cart
     * (Handles logic: If in wishlist, remove it. If already in cart, show error)
     */
    public function addToCart(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->product_id;
        $productName = $request->product_name ?? Product::find($productId)->name;
        $productPrice = $request->product_price ?? Product::find($productId)->price;
        $productImage = $request->product_image ?? Product::find($productId)->image;
        $productQty = $request->product_quantity ?? 1;

        // 1. Check if already in Cart
        $cartCheck = Cart::where('user_id', $userId)->where('name', $productName)->exists();
        if ($cartCheck) {
            return back()->with('message', ['already added to cart']);
        }

        // 2. Check if in Wishlist (and remove if found)
        $wishlistCheck = Wishlist::where('user_id', $userId)->where('name', $productName)->first();
        if ($wishlistCheck) {
            $wishlistCheck->delete();
        }

        // 3. Add to Cart
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $productQty,
            'image' => $productImage
        ]);

        return back()->with('success', 'product added to cart');
    }

    /**
     * Update Cart Quantity
     */
    public function updateCart(Request $request)
    {
        $cartId = $request->cart_id;
        $quantity = $request->cart_quantity;

        Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->update(['quantity' => $quantity]);

        return back()->with('success', 'cart quantity updated!');
    }

    /**
     * Remove Single Item from Cart
     */
    public function removeFromCart($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'item removed from cart!');
    }

    /**
     * Remove All Items from Cart
     */
    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();
        return back()->with('success', 'cart cleared successfully!');
    }

    // ===========================
    // WISHLIST FUNCTIONS
    // ===========================

    /**
     * Show the Wishlist Page
     */
    public function wishlist()
    {
        $userId = Auth::id();
        $wishlistItems = Wishlist::where('user_id', $userId)->get();
        // Calculate total for display logic
        $grandTotal = $wishlistItems->sum('price');
        
        return view('wishlist', compact('wishlistItems', 'grandTotal'));
    }

    /**
     * Add Item to Wishlist
     */
    public function addToWishlist(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->product_id;
        // Fetch details if not in request (safety check)
        $product = Product::find($productId);
        $productName = $request->product_name ?? $product->name;
        $productPrice = $request->product_price ?? $product->price;
        $productImage = $request->product_image ?? $product->image;

        // 1. Check if already in Wishlist
        $wishlistCheck = Wishlist::where('user_id', $userId)->where('name', $productName)->exists();
        if ($wishlistCheck) {
            return back()->with('message', ['already added to wishlist']);
        }

        // 2. Check if already in Cart
        $cartCheck = Cart::where('user_id', $userId)->where('name', $productName)->exists();
        if ($cartCheck) {
            return back()->with('message', ['already added to cart']);
        }

        // 3. Add to Wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage
        ]);

        return back()->with('success', 'product added to wishlist');
    }

    /**
     * Remove Single Item from Wishlist
     */
    public function removeFromWishlist($id)
    {
        Wishlist::where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'item removed from wishlist!');
    }

    /**
     * Remove All Items from Wishlist
     */
    public function clearWishlist()
    {
        Wishlist::where('user_id', Auth::id())->delete();
        return back()->with('success', 'wishlist cleared successfully!');
    }
}