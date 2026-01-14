<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Security Check: Redirect if not an admin
        if (Auth::id() && Auth::user()->user_type !== 'admin') {
            return redirect()->route('home');
        }

        // 2. Fetch Statistics
        $total_pendings = Order::where('payment_status', 'pending')->sum('total_price');
        
        $total_completes = Order::where('payment_status', 'completed')->sum('total_price');
        
        $number_of_orders = Order::count();
        
        $number_of_products = Product::count();
        
        $number_of_users = User::where('user_type', 'user')->count();
        
        $number_of_admins = User::where('user_type', 'admin')->count();
        
        $total_accounts = User::count();
        
        $number_of_messages = Message::count();

        // 3. Return View with Data
        return view('admin.page', compact(
            'total_pendings',
            'total_completes',
            'number_of_orders',
            'number_of_products',
            'number_of_users',
            'number_of_admins',
            'total_accounts',
            'number_of_messages'
        ));
    }
}