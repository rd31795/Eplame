<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\UserDispute;
use App\VendorCategory;
use App\Models\Admin\EmailTemplate;
trait UserCancelTheEventTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function UserCancelTheEventTrait($vendor, $event_name)
{
	$template_id = $this->emailTemplate['UserCancelTheEventNotification'];
	return $this->UserCancelTheEventTraitSendEmail($vendor, $event_name, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserCancelTheEventTraitSendEmail($vendor, $event_name, $template_id)
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
    
    $data = $this->UserCancelTheEventTraitHtml($vendor, $event_name, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserCancelTheEventTraitHtml($vendor, $event_name, $template)
{ 
	  $text2 = $template->body;  
    $text = str_replace("{name}", $vendor->name, $text2);
    $text = str_replace("{event_name}", $event_name, $text);
	return $text;
}

}
















