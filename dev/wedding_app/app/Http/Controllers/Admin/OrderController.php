<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;

class OrderController extends Controller
{
    


    public function index(Request $request)
    {
    	return view('admin.orders.index');
    }

    public function escrowListing(Request $request)
    {
        return view('admin.escrow.index');
    }




    /*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/	
    public function detail(Request $request,$id)
    {
    	$orders = \App\Models\Order::find($id);
    	return view('admin.orders.detail')->with('order',$orders);
    }




    /*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/	


	public function ajax()
	{
	 
		$events = \App\Models\Order::select(['id','orderID','amount', 'payment_by'])->orderBy('created_at','DESC')
		              ->get();

		return datatables()->of($events)
		->addColumn('action', function ($t) {
		return  $this->Actions($t);
		})
		
		->editColumn('amount',function($t){
		return '$'.$t->amount;
		})

		->make(true);
	}

    public function escrowajax()
    {
     
        $events = \App\Models\Order::where( 'created_at', '>', date('Y-m-d', strtotime("-30 days")))->where('status', 1)->orderBy('created_at','DESC')->get();

        

        return datatables()->of($events)
        
        ->addColumn('user', function ($t) {
        return  $this->user_name($t);
        })
        ->addColumn('user_escrow', function ($t) {
        return  $this->user_escrow($t);
        })
        ->addColumn('amount', function ($t) {
        return  '$'.$t->amount;
        })
        ->addColumn('action', function ($t) {
        return  $this->Actions($t);
        })

        ->make(true);
    }


	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/
    

    public function Actions($data)
    {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';
          $url = url(route('admin.orderDetail',$data->id));
          $text .='<a href="'.$url.'" class="dropdown-item">Detail</a>';
            $text .='<div class="dropdown-divider"></div>';
            //$status=$data->status == 0 ? 'Active' : 'In-Active';
            //$text .='<a href="'.route('event_status',$data->slug).'" class="dropdown-item">'.$status.'</a>';

            $text .='</div>';
            $text .='</div>';

            return $text;
    }

    public function user_escrow($data)
    {
        $esc_amt = 0;
        foreach($data->orderItems as $it){
          $parent = $it->category->parent;
          $cate = Category::find($it->category->id);
          if($parent == 0){
            $admin_escrow_percentage = $cate->escrow_percentage;
          }else{
            $parent_cat = Category::find($parent);
            $admin_escrow_percentage =  $parent_cat->escrow_percentage;
          }

            if(!($admin_escrow_percentage > 0)){
                $admin_escrow_percentage =  getAllValueWithMeta('admin_escrow_percentage', 'global-settings');
            }

          $price = $it->package->price;
          $esc_amt = $esc_amt + (($price * $admin_escrow_percentage)/100);
        }
        

        return '$'.$esc_amt;
    }

    public function user_name($data)
    {
        $user = User::find($data->user_id);

        return $user->name;
    }
}
