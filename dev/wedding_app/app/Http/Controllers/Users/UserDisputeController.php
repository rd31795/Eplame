<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\UserDispute;
use App\VendorCategory;
use App\User;
use App\Models\DisputeChat;
use App\DisputeReason;
use App\Traits\EmailTraits\EmailNotificationTrait;
class UserDisputeController extends Controller
{
    use EmailNotificationTrait;


     public function store(Request $request){

    	if(!empty($request->vendor_id) && !empty($request->business_id) && !empty($request->event_order_id) && !empty($request->user_id)){
    		$reason_id = $request->reason;
    		$business_id = $request->business_id;
    		$vendor_id = $request->vendor_id;
    		// $check=UserDispute::whereOrderId($request->event_order_id)->whereRaisedBy(Auth::user()->id)->first();
    		$dispute = new UserDispute;
    		// if($check){
      //         $dispute=$check;
      //         $dispute->dispute_status=1;
    		// }
    		$dispute->reason = $reason_id; 
    		$dispute->raised_by = Auth::user()->id; 
    		$dispute->raised_to = $vendor_id; 
    		$dispute->business_id = $business_id; 
    		$dispute->order_id = $request->event_order_id;
	        $dispute->solution = $request->solution;
	        $dispute->amount = $request->amount;
	        $dispute->otherReason = $request->otherreason;
    		$dispute->admin_status = 0;
    		$dispute->save();
    		$ticket_id = $dispute->id;
    		$event = VendorCategory::where('id', $business_id)->first();
    		$vendor = User::where('id', $vendor_id)->first();
    		$user = User::where('id', Auth::user()->id)->first();
    		$reason =DisputeReason::where('id', $reason_id)->first();
        if(!empty($reason)){
          $reson = $reason->reasons;
          $this->UserDisputeTrait($vendor,$event,$reson,$user,$ticket_id);
          $this->UserDisputeAdminTrait($event,$reson,$user,$ticket_id);
        }else{
          $reason = $request->otherreason;
          $this->UserDisputeTrait($vendor,$event,$reason,$user,$ticket_id);
          $this->UserDisputeAdminTrait($event,$reason,$user,$ticket_id);
        }
    		
            $status = ['status' => 1,'messages' => 'Dispute has been submitted Successfully!!','redirect_links' => url(route('user.disputeDetail',$ticket_id))];
    	}else{
            $status = ['status' => 0,'messages' => 'Something went wrong.'];
        }
        return response()->json($status);
    }
    public function disputelist()
   {

      $dispute = UserDispute::where('raised_by',Auth::user()->id)->OrderBy('created_at','DESC')->get();

       return view('users.dispute.index')
              ->with('dispute',$dispute)
              ->with('title','Dispute');
   }
    public function detail($id)
    {
        $dispute = UserDispute::where('raised_by',Auth::user()->id)->where('id', $id)->first();
        if(!empty($dispute->id))
        {
          $chats   = DisputeChat::where('dispute_id',$dispute->id)->get();
        }
        return view('users.dispute.detail')
        ->with('dispute',$dispute)
         ->with('chats', $chats)
        ->with('title','Dispute');

    }
    public function raiseAgain($id){
      UserDispute::whereId($id)->update([
         "dispute_status"=>1
      ]);
      return redirect(route('user.disputeDetail',$id));
    }
  public function create($id,Request $request)
  {
          $dispute = UserDispute::where('raised_by',Auth::user()->id)->where('id', $id)->first();
   
         
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
          }elseif($request->satisfied == "satisfied"){
              $dispute->dispute_status= '2';
              $dispute->save(); 

              $d = new DisputeChat;
              $d->dispute_id = $request->dispute_id;
              $d->user_id = Auth::user()->id;
              $d->chat = "Satisfied with your respond ";
              $d->save();
          }elseif($request->agreed == "agreed"){
              $dispute->dispute_status= '3';
              $dispute->save(); 

              $d = new DisputeChat;
              $d->dispute_id = $request->dispute_id;
              $d->user_id = Auth::user()->id;
              $d->chat = "Agreed with Vendor Amount";
              $d->save();
              $ticket_id = $dispute->id;
              $user = User::where('id', Auth::user()->id)->first();
              $this->AgreedMailToAdminTrait($user,$ticket_id);
          }else{
            $dispute->dispute_status= '1';
            $dispute->save(); 
            $d = new DisputeChat;
            $d->dispute_id = $request->dispute_id;
            $d->user_id = Auth::user()->id;
            $d->chat = "The request was sent to the admin for its participation in the dispute.";
            $d->save();
            $ticket_id = $dispute->id;
            $user = User::where('id', Auth::user()->id)->first();
           $this->AdminInvolvedInDisputeTrait($user,$ticket_id);
          }
         
          if(!empty($dispute->id))
          {
            $chats   = DisputeChat::where('dispute_id',$dispute->id)->get();
          }
          return view('users.dispute.detail')->with('dispute',$dispute)->with('chats', $chats)->with('title','Dispute');
  }
}
