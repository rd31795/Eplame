<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
class CouponController extends Controller
{
  public function index() {
    	return view('admin.coupon.index')->with(['title' => 'Coupon Management', 'addLink' => 'admin.coupon.create']);
    	
    }
     public function ajax_getCoupon() {
		$coupon = Coupon::select(['title','deal_code','slug', 'status'])->get();
		
		return datatables()->of($coupon)
		->addColumn('action', function ($t) {
			return  $this->Actions($t);
		})->editColumn('status', function($t){
			return $t->status == 1 ? 'Active' : 'In-Active';
		})->editColumn('title',function($t){
        return str_limit($t->title, 50);
        })->make(true);
	}
	   public function showCreate() {
    	return view('admin.coupon.create')->with(['title' => 'Create Coupon', 'addLink' => 'admin.coupon.create']);
    }
    public function showEdit($slug) {
    	$coupon = Coupon::FindBySlugOrFail($slug);
    	return view('admin.coupon.edit')
    	->with(['coupon' => $coupon, 'title' => 'Edit Coupon', 'addLink' => 'admin.coupon.list']);
    }
     public function create(Request $request) {
    	$validatedData = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'deal_code' => ['required'],
            'deal_life' => ['required'],
            'deal_off_type'=> ['required'],
            'amount' => ['required'],
            'description' => ['required'],
        ]);
        $d = new Coupon;
         $d->title = trim($request->title);
          $d->start_date = trim($request->start_date);
          $d->amount = trim($request->amount);
          $d->deal_off_type = trim($request->deal_off_type);
          $d->deal_code = trim($request->deal_code);
          $d->description = trim($request->description);
          $d->expiry_date = trim($request->expiry_date);
          $d->deal_life = trim($request->deal_life);
          $d->min_price =$request->deal_off_type == 1 ? $request->min_amount : 0;
          $d->save();
    	
    	return redirect()->route('admin.coupon.list')->with('flash_message', 'Coupon has been created successfully!');
    }
     public function Actions($data) {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';


            $text .='<a href="'.route('admin.coupon.showEdit', $data->slug).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            $text .='<a href="'.route('admin.coupon.status', $data->slug).'" class="dropdown-item">'.$status.'</a>';


            $text .='</div>';
            $text .='</div>';

            return $text;
    }
    public function couponStatus($slug) {
     $coupon = Coupon::FindBySlugOrFail($slug);

     if(!empty($coupon)){
       $coupon->status = $coupon->status == 1 ? 0 : 1;
        $coupon->save();
        $msg= $coupon->status == 1 ? '<b>'.$coupon->title.'</b> is Activated' : '<b>'.$coupon->title.'</b> is Deactivated';
       return redirect(route('admin.coupon.list'))->with('flash_message', $msg);
     }
     return redirect()->back()->with('flash_message', 'Something Went Woring!');
    }
    public function update(Request $request, $slug) {

    	$d = Coupon::FindBySlugOrFail($slug);
      $d->title = trim($request->title);
          $d->start_date = trim($request->start_date);
          $d->amount = trim($request->amount);
          $d->deal_off_type = trim($request->deal_off_type);
          $d->deal_code = trim($request->deal_code);
          $d->description = trim($request->description);
          $d->expiry_date = trim($request->expiry_date);
          $d->deal_life = trim($request->deal_life);
          $d->min_price =$request->deal_off_type == 1 ? $request->min_amount : 0;
          $d->save();
    	// $coupon->update([
    	// 	'title' => $request['title'],
    	// 	'deal_code' => $request['deal_code'],
    	// 	'deal_life' =>$request['deal_life'],
    	// 	'deal_off_type	'=>$request['deal_off_type'],
    	// 	'amount'=>$request['amount'],
    	// 	'description'=>$request['description'],
    	// 	'start_date' => $request['start_date'],
    	// 	'expiry_date' =>$request['expiry_date'],
    	// 	'min_price'=>$request['min_amount'],
    	// ]);
    	return redirect()->route('admin.coupon.list')->with('flash_message', 'Coupon has been updated successfully!');
    }

}
