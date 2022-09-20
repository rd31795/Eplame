<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\UserDispute;
use App\VendorCategory;
use App\Models\Admin\EmailTemplate;
trait UserDisputeAdminTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function UserDisputeAdminTrait($event,$reason,$user,$ticket_id)
{
  $template_id = $this->emailTemplate['UserDisputeAdminNotification'];
  return $this->UserDisputeAdminTraitSendEmail($event,$reason,$user,$ticket_id,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserDisputeAdminTraitSendEmail($event,$reason,$user,$ticket_id,$template_id)
{
  $template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => 'Admin',
           'email' => 'patrickphp2@gmail.com'
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->UserDisputeAdminTraitHtml($event,$reason,$user,$ticket_id,$template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserDisputeAdminTraitHtml($event,$reason,$user,$ticket_id,$template)
{ 
    $text2 = $template->body;  
    $text = str_replace("{ticket_id}", $ticket_id, $text2);
    $text = str_replace("{event}", $event->title, $text);
    $text = str_replace("{reason}", $reason, $text);
    $text = str_replace("{username}", $user->name, $text);
    $text = str_replace("{email}", $user->email, $text);
    $text = str_replace("{phone}", $user->phone_number, $text);
  return $text;
}

}