<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import Product Model
use App\Models\Message; // Import Message Model (Created in previous step)
use Illuminate\Support\Facades\Auth; // Import Auth for user ID

class HomeController extends Controller
{
    /**
     * Show the Home Page
     */
    public function index()
    {
        // Equivalent to: SELECT * FROM `products` LIMIT 6
        $products = Product::limit(6)->get();
        return view('home', compact('products'));
    }

    /**
     * Show the About Page
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the Shop Page
     */
    public function shop()
    {
        // Fetch ALL products (The home page only fetched 6)
        $products = Product::all(); 
        return view('shop', compact('products'));
    }

    /**
     * Show the Contact Page
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Handle Sending a Message
     */
    public function sendMessage(Request $request)
    {
        $userId = Auth::id();

        // 1. Check if the exact same message already exists (Duplicate Check)
        $exists = Message::where('name', $request->name)
            ->where('email', $request->email)
            ->where('number', $request->number)
            ->where('message', $request->message)
            ->exists();

        if ($exists) {
            // Return back with an error message in the session
            return back()->with('message', ['Message sent already!']);
        }

        // 2. Validate the input (Optional but recommended)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // 3. Save the new message to the database
        Message::create([
            'user_id' => $userId,
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'message' => $request->message,
        ]);

        // 4. Return back with success message
        return back()->with('success', 'Message sent successfully!');
    }

    /**
     * Show Single Product Details
     */
    public function viewPage($id)
    {
        $product = Product::find($id);

        // If someone tries to view a product that doesn't exist, send them home
        if(!$product){
            return redirect()->route('home');
        }

        return view('view_page', compact('product'));
    }

    /**
     * Search Page Logic
     */
    public function search(Request $request)
    {
        $search_box = $request->input('search_box');
        $products = [];

        if($search_box){
            // If user typed something, search for it
            $products = Product::where('name', 'LIKE', "%{$search_box}%")->get();
        }

        return view('search', compact('products', 'search_box'));
    }
}
