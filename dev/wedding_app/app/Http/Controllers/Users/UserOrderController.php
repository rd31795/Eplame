<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
    	return view('users.orders.index');
    }

    public function orderDetail($orderID)
    {
    	 $currentOrder = Order::with('orderItems','orderItems.package')->where('id', $orderID)
        ->where('user_id', Auth::user()->id)
        ->first();
    	if(!empty($currentOrder)){
    		return view('users.orders.order_detail', compact('currentOrder'));
    	}else{
    		abort(404);
    	}
    }

    public function escrowListing()
    {
        $orders = Order::where('user_id', Auth::user()->id)->where('status', '1')
           ->where( 'created_at', '>', date('Y-m-d', strtotime("-30 days")))
           ->get();

        
        return view('users.escrow.index')->with(['orders' => $orders]);
    }
}
