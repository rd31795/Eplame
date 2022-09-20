<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\UserDispute;
use App\VendorCategory;
use App\Models\Admin\EmailTemplate;
trait UserDisputeTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function UserDisputeTrait($vendor,$event,$reason,$user,$ticket_id)
{
	$template_id = $this->emailTemplate['UserDisputeNotification'];
	return $this->UserDisputeTraitSendEmail($vendor,$event,$reason,$user,$ticket_id,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserDisputeTraitSendEmail($vendor,$event,$reason,$user,$ticket_id,$template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $vendor->name,
           'email' => $vendor->email
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->UserDisputeTraitHtml($vendor,$event,$reason,$user,$ticket_id,$template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserDisputeTraitHtml($vendor,$event,$reason,$user,$ticket_id,$template)
{ 
	  $text2 = $template->body;  
    $text = str_replace("{name}", $vendor->name, $text2);
    $text = str_replace("{ticket_id}", $ticket_id, $text);
    $text = str_replace("{event}", $event->title, $text);
    $text = str_replace("{reason}", $reason, $text);
    $text = str_replace("{username}", $user->name, $text);
    $text = str_replace("{email}", $user->email, $text);
    $text = str_replace("{phone}", $user->phone_number, $text);
	return $text;
}

}
















