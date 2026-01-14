<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    /**
     * Show All Orders
     */
    public function index()
    {
        // Get all orders (newest first usually looks better)
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Update Payment Status
     */
    public function updateStatus(Request $request)
    {
        $order = Order::find($request->order_id);

        if($order){
            $order->payment_status = $request->update_payment;
            $order->save();
            return back()->with('success', 'payment status has been updated!');
        }

        return back()->with('error', 'Order not found!');
    }

    /**
     * Delete Order
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        
        if($order){
            $order->delete();
            return back()->with('success', 'Order deleted successfully!');
        }
        
        return back()->with('error', 'Order not found!');
    }
}