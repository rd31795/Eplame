<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DisputeVendor;
use App\Traits\EmailTraits\EmailNotificationTrait;
use App\Models\UserDispute;
use App\VendorCategory;
use App\User;
use Auth;
use App\Models\DisputeChat;
class DisputeController extends Controller
{
   
use EmailNotificationTrait;

   public function index()
   {

   	   return view('admin.disputes.index');
   }








    /*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/	


	public function ajax()
	{
	 
		$events = \App\Models\DisputeVendor::select('*')->orderBy('created_at','DESC')
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
            $url = url(route('admin.vendor.dispute.detail',$data->id));
            $text .='<a href="'.$url.'" class="dropdown-item">Detail</a>';
            $text .='<div class="dropdown-divider"></div>';
            //$status=$data->status == 0 ? 'Active' : 'In-Active';
            //$text .='<a href="'.route('event_status',$data->slug).'" class="dropdown-item">'.$status.'</a>';

            $text .='</div>';
            $text .='</div>';

            return $text;
    }






#==============================================================================================================


    public function detail($id)
    {
       $dispute = DisputeVendor::with('orderEvent')->where('id',$id)->first();
       return view('admin.disputes.detail')
            ->with('data',$dispute)
            ->with('order',$dispute->orderEvent)
            ->with('event',$dispute->orderEvent->event);
    }



#==============================================================================================================

    public function block($id)
    {       $dispute = DisputeVendor::with('orderEvent')->where('id',$id)->first();
    	    $vendorCategory = \App\VendorCategory::find($dispute->vendor_id);
		    $vendorCategory->status = 5;
		    $vendorCategory->publish = 0;
		    $vendorCategory->save();
            if($this->BlockVendorEmailOrderSuccess($vendorCategory) == 1){
            	$dispute->status = 2;
            	$dispute->save();
            	return redirect()->route('admin.vendor.dispute.detail',$id)->with('messages','This Vendor has been blocked successfully.');
            }
    }
    public function disputelist()
    {

      $dispute = UserDispute::all();

       return view('admin.dispute-chat.index')
              ->with('dispute',$dispute)
              ->with('title','Disputes');
    }
    public function disputeajax()
    {
        $dispute = UserDispute::all();

        return datatables()->of($dispute)
        ->addColumn('action', function ($t) {
        return  $this->Actiondispute($t);
        })->editColumn('dispute_status', function($t){
      return $t->dispute_status == 1 || $t->dispute_status == 3 ? 'Open' : 'Closed';
        })->editColumn('raised_by',function($t){
          $user = getUser($t->raised_by);
        return $user->name;
          })->editColumn('amount',function($t){
          $amount = $t->dispute_status == 3 ? 'Pending' :'';
        return $amount;
          })->editColumn('vendor_amount',function($t){
          $vendor_amount = $t->dispute_status == 3  ? "$".$t->vendor_amount : 0;
        return $vendor_amount;
          })
        ->make(true);
    }

    public function Actiondispute($data)
    {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';
            $url = url(route('admin.disputeDetail',$data->id));
            $text .='<a href="'.$url.'" class="dropdown-item">Detail</a>';
            $text .='<div class="dropdown-divider"></div>';
            //$status=$data->status == 0 ? 'Active' : 'In-Active';
            //$text .='<a href="'.route('event_status',$data->slug).'" class="dropdown-item">'.$status.'</a>';

            $text .='</div>';
            $text .='</div>';

            return $text;
    }

    public function disputedetail($id)
    {
       $dispute = UserDispute::where('id',$id)->first();
        if(!empty($dispute->id))
        {
           $chats   = DisputeChat::where('dispute_id',$dispute->id)->get();
           $dispute->admin_open_status= '1';
           $dispute->save();
           //$otherchats = DisputeChat::where('user_id', '!=',Auth::user()->id)->where('dispute_id',$dispute->id)->get();
        }
       return view('admin.dispute-chat.detail')
            ->with('dispute',$dispute)->with('chats', $chats)->with('title','Dispute');
    }
    public function disputecreate($id,Request $request)
    {
        $dispute = UserDispute::where('id',$id)->first();
        if($request->send == "send")
        {
            
          $validatedData = $request->validate([
              'content' => ['required'],
             
          ]);
          $d = new DisputeChat;
          $d->dispute_id = $request->dispute_id;
          $d->user_id = Auth::user()->id;
          $d->chat = $request->content;
          $d->save();
        }elseif($request->close == "close") {
              $dispute->dispute_status= '2';
              $dispute->save(); 
              $d = new DisputeChat;
              $d->dispute_id = $request->dispute_id;
              $d->user_id = Auth::user()->id;
              $d->chat = "Closed by Admin";
              $d->save();
        }elseif($request->approved == "approved") {
          $dispute->admin_status= '2';
            $dispute->save(); 
              $d = new DisputeChat;
              $d->dispute_id = $request->dispute_id;
              $d->user_id = Auth::user()->id;
              $d->chat = "Admin available to involve in dispute";
              $d->save();
        }else{
              $dispute->admin_status= '2';
              $dispute->save(); 
              $d = new DisputeChat;
              $d->dispute_id = $request->dispute_id;
              $d->user_id = Auth::user()->id;
              $d->chat = "The admin is busy and will be back shortly.";
              $d->save();
        }
          if(!empty($dispute->id))
          {
            $chats   = DisputeChat::where('dispute_id',$dispute->id)->get();
            //$otherchats = DisputeChat::where('user_id', '!=',Auth::user()->id)->where('dispute_id',$dispute->id)->get();
           }
          return view('admin.dispute-chat.detail')->with('dispute',$dispute)->with('chats', $chats)->with('title','Dispute');
    }

    

}
