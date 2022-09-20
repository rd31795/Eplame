<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\UserDispute;
use App\VendorCategory;
use App\Models\Admin\EmailTemplate;
trait AgreedMailToAdminTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function AgreedMailToAdminTrait($user,$ticket_id)
{
  $template_id = $this->emailTemplate['AgreedMailToAdminNotification'];
  return $this->AgreedMailToAdminTraitSendEmail($user,$ticket_id,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function AgreedMailToAdminTraitSendEmail($user,$ticket_id,$template_id)
{
  $template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => 'Admin',
           'email' => 'patrickphp2@gmail.com',
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->AgreedMailToAdminTraitHtml($user,$ticket_id,$template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function AgreedMailToAdminTraitHtml($user,$ticket_id,$template)
{ 
    $text2 = $template->body; 
    //$link = $this->getRedirectLink($ticket_id); 
    $text = str_replace("{name}", $user->name, $text2);
    $text = str_replace("{ticket_id}", $ticket_id, $text);
  return $text;
}
// public function getRedirectLink($ticket_id)
// {
//     $url =url(route('admin.disputeDetail',$ticket_id));

//     return '<a href="'.$url.'">Click Here</a>';
// }
}