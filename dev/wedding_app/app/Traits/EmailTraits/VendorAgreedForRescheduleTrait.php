<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\UserDispute;
use App\VendorCategory;
use App\Models\Admin\EmailTemplate;
trait VendorAgreedForRescheduleTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function VendorAgreedForRescheduleTrait($user,$event_name,$vendor)
{
	$template_id = $this->emailTemplate['VendorAgreedForRescheduleNotification'];
	return $this->VendorAgreedForRescheduleTraitSendEmail($user, $event_name, $vendor,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function VendorAgreedForRescheduleTraitSendEmail($user, $event_name, $vendor,$template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $user->name,
           'email' => $user->email
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->VendorAgreedForRescheduleTraitHtml($user, $event_name, $vendor, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function VendorAgreedForRescheduleTraitHtml($user, $event_name, $vendor, $template)
{ 
	  $text2 = $template->body;  
    $text = str_replace("{name}", $user->name, $text2);
    $text = str_replace("{event_name}", $event_name, $text);
    $text = str_replace("{vendor_name}", $vendor->name, $text);
	return $text;
}

}
















