<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\VendorCommission;
class VendorCommissionController extends Controller
{
    public function index(Request $request) {
    	return view('admin.commission.vendor_index')->with('title', 'Vendors');	
    }
     	public function ajax_getVendorscommission(Request $request)
   	{
   		$vendors = User::where('role', 'vendor')
                     ->where('login_count','>',0)
                     ->get();

		  return datatables()->of($vendors)
		         ->addColumn('action', function ($t) {
			              return $this->createAction($t, 'admin_vendor_business', 'vendor_status', 'set_commission');
	           	})
        		 ->editColumn('status', function($t) {
        			      return $t->status == 1 ? 'Active' : 'In-Active';
        		 })
        		 ->make(true);
   	}
   	public function changeStatus($id) {
		$user = User::find($id);

     if(!empty($user)) {
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        $msg= $user->vendor_status == 1 ? '<b>'.$user->name.'</b> is Activated' : '<b>'.$user->name.'</b> is Deactivated';
       return redirect(route('list_vendors'))->with('flash_message', $msg);
     }
     return redirect()->back()->with('flash_message', 'Something Went Woring!');
	}

  public function business($id) {
    $vendor = User::find($id);
    return view('admin.commission.business')->with(['title' => 'Vendor Business', 'vendor'=> $vendor]);
  }
  public function store(Request $request)
  {
   $this->validate($request,[
   	'vendor_id' =>'required',
     'commission_type' => 'required',
     'slab_from' => 'required',
     'slab_to' => 'required',

   ]);
         return $this->saveSlabs($request);
         return redirect()->back()->with('messages','Slab is saved!');
 

 }
public function saveSlabs($request)
{
 
     
        if($request->slab_from >= $request->slab_to){

          $msg = 'Commission Slab must be greater than from start';
          return redirect()->back()->with('messages',$msg)->withInput();

        }elseif(count($this->getSlabAll($request)) > 0){

        	$msg = 'This slab range already used in another slab';
        	return redirect()->back()->with('messages',$msg)->withInput();

        }else{

         $vendor_id=$request->route('id');
	       $c = new VendorCommission;
	       $c->vendor_id=$vendor_id;
         $c->slab_from = $request->slab_from;
         $c->slab_to = $request->slab_to;
         $c->commission_type = $request->commission_type;
       	 $c->amount = $request->amount;
       	 $c->min_amount = $request->min_amount;
         $c->type = 'slab';
         $c->save();

         return redirect()->back()->with('messages','Slab is saved Successfully');
       }
 }
 public function getSlabAll($request)
{
    $slab = VendorCommission::get();
    $array = [];
    foreach ($slab as $key => $data) {
       if(in_array($request->slab_from, range($data->slab_from,$data->slab_to)))
       {
        array_push($array,$data->id);
       }
       if(in_array($request->slab_to, range($data->slab_from,$data->slab_to))){
                array_push($array,$data->id);
       }
    }

    return $array;
}
	// public function delete($id)
	// {
	// 	$c = VendorCommission::find($id);
		
	// 	if ($c != null) {
	//         $c->delete();
	//         return redirect()->back()->with('messages','Slab is deleted Successfully');
 //    	}
	   
	// }
    public function delete($id)
    {
      $c = VendorCommission::find($id);
      $c->delete();
       return redirect()->back()->with('messages','Slab is deleted Successfully');
    }
      public function vendor_commission_fee(Request $request)
		{   
			$vendor_id=$request->route('id');
			$vendors = User::where('id', $vendor_id)->first();
			$slab = VendorCommission::where('vendor_id',$vendor_id)->where('type','slab')->orderBy('slab_from','ASC')->get();
			return view('admin.commission.vendor_fee')
			->with('slab',$slab)
			->with('title','Vendor Commission Fee Settings')->with('vendors',$vendors);
		}
		function createAction($data, $businessUrl, $stsUrl, $comissionurl) {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';

            if(!empty($businessUrl)) {
              $text .='<a href="'.route($businessUrl, $data->id).'" class="dropdown-item">View Business</a>';
              $text .='<div class="dropdown-divider"></div>';
            }
            
            if(!empty($stsUrl)) {
              $status=$data->vendor_status == 0 ? 'Active' : 'In-Active';
              $text .='<a href="'.route($stsUrl, $data->id).'" class="dropdown-item">'.$status.'</a>';
              $text .='<div class="dropdown-divider"></div>';
            }

            if(!empty($comissionurl)) {
               $text .='<a href="'.route($comissionurl, $data->id).'" class="dropdown-item">Set Commission</a>';
            }
            $text .='</div>';
            $text .='</div>';

            return $text;
}

}