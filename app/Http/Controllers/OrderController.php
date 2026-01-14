<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import Order Model
use App\Models\Cart;  // Import Cart Model
use Illuminate\Support\Facades\Auth; // Import Auth

class OrderController extends Controller
{
    /**
     * Show the Checkout Page
     */
    public function checkout()
    {
        $userId = Auth::id();
        
        // Get all cart items for this user
        $cartItems = Cart::where('user_id', $userId)->get();
        
        // Calculate Grand Total
        $grandTotal = 0;
        foreach($cartItems as $item){
            $grandTotal += ($item->price * $item->quantity);
        }

        return view('checkout', compact('cartItems', 'grandTotal'));
    }

    /**
     * Handle Order Placement (Form Submission)
     */
    public function placeOrder(Request $request)
    {
        $userId = Auth::id();
        
        // 1. Gather User Input
        $name = $request->name;
        $number = $request->number;
        $email = $request->email;
        $method = $request->method;
        
        // Combine address parts into one string (matching your original format)
        $address = 'flat no. '. $request->flat.', '. $request->street.', '. $request->city.', '. $request->country.' - '. $request->pin_code;
        $placed_on = date('d-M-Y');

        // 2. Prepare Cart Data for the Order
        $cartItems = Cart::where('user_id', $userId)->get();
        $cart_total = 0;
        $cart_products = [];

        if($cartItems->count() > 0){
            foreach($cartItems as $item){
                // Create a string like "Book Name (2)"
                $cart_products[] = $item->name.' ('.$item->quantity.') ';
                $cart_total += ($item->price * $item->quantity);
            }
        }
        // Convert array to comma-separated string
        $total_products = implode(', ', $cart_products);

        // 3. Validation: Is cart empty?
        if($cart_total == 0){
            return back()->with('message', ['your cart is empty!']);
        }

        // 4. Validation: Check for duplicate order (Optional safety check)
        $orderExists = Order::where('name', $name)
            ->where('number', $number)
            ->where('email', $email)
            ->where('method', $method)
            ->where('address', $address)
            ->where('total_products', $total_products)
            ->where('total_price', $cart_total)
            ->exists();

        if($orderExists){
            return back()->with('message', ['order placed already!']);
        }

        // 5. Save the Order
        Order::create([
            'user_id' => $userId,
            'name' => $name,
            'number' => $number,
            'email' => $email,
            'method' => $method,
            'address' => $address,
            'total_products' => $total_products,
            'total_price' => $cart_total,
            'placed_on' => $placed_on,
            'payment_status' => 'pending' // Default status
        ]);

        // 6. Clear the Cart (Order is done!)
        Cart::where('user_id', $userId)->delete();

        // 7. Redirect to Checkout page with success message
        return redirect()->route('checkout')->with('success', 'order placed successfully!');
    }

    /**
     * Show User's Past Orders
     */
    public function orders()
    {
        $userId = Auth::id();
        
        // Fetch orders for this user, sorted by newest first
        $orders = Order::where('user_id', $userId)->orderBy('created_at', 'DESC')->get();

        return view('orders', compact('orders'));
    }
}