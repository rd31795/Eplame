<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDispute;
use App\VendorCategory;
use App\User;
use Auth;
use App\Models\DisputeChat;
use App\Traits\EmailTraits\EmailNotificationTrait;
class DisputeController extends Controller
{
    use EmailNotificationTrait;
    public function index()
   {

      $dispute = UserDispute::where('raised_to',Auth::user()->id)->OrderBy('created_at','DESC')->get();

       return view('vendors.dispute.index')
              ->with('dispute',$dispute)
              ->with('title','Vendor Dispute');
   }
   public function detail($id)
	{
        $dispute = UserDispute::where('id', $id)->where('raised_to',Auth::user()->id)->first();
        if(!empty($dispute->id))
        {
          $chats   = DisputeChat::where('dispute_id',$dispute->id)->get();
        }
        return view('vendors.dispute.detail')
        ->with('dispute',$dispute)
         ->with('chats', $chats)
        ->with('title','Dispute');

	}
  public function create($id,Request $request)
  {
    $dispute = UserDispute::where('id', $id)->where('raised_to',Auth::user()->id)->first();
   
    
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
          }else{
            $dispute->admin_status= '1';
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
          return view('vendors.dispute.detail')->with('dispute',$dispute)->with('chats', $chats)->with('title','Dispute');
  }
  public function amountstore(Request $request)
  {
    if(!empty($request->dispute_id))
    {
      $id = $request->dispute_id;
      $amount = $request->amount;
      $dispute = UserDispute::where('id', $id)->first();
      $dispute->vendor_amount = $amount;
      $dispute->save();
      $d = new DisputeChat;
      $d->dispute_id = $request->dispute_id;
      $d->user_id = Auth::user()->id;
      $d->chat = "I am agreed to pay this amount to User ".$amount."";
      $d->save();
     
      $status = ['status' => 1,'messages' => 'Amount has been submitted Successfully!!','redirect_links' => url(route('vendor.disputeDetail',$id ))];
    }else{
            $status = ['status' => 0,'messages' => 'Something went wrong.'];
      }
        return response()->json($status);
  }
}
