<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\UserDispute;
use App\VendorCategory;
use App\Models\Admin\EmailTemplate;
trait UserReschduleDatesTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function UserReschduleDatesTrait($vendor, $event_name, $start_date, $end_date)
{
	$template_id = $this->emailTemplate['UserReschduleDatesNotification'];
	return $this->UserReschduleDatesTraitSendEmail($vendor, $event_name, $start_date, $end_date,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserReschduleDatesTraitSendEmail($vendor, $event_name, $start_date, $end_date,$template_id)
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
    
    $data = $this->UserReschduleDatesTraitHtml($vendor, $event_name,  $start_date, $end_date, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserReschduleDatesTraitHtml($vendor, $event_name,  $start_date, $end_date, $template)
{ 
	  $text2 = $template->body;  
    $text = str_replace("{name}", $vendor->name, $text2);
    $text = str_replace("{event_name}", $event_name, $text);
    $text = str_replace("{start_date}", $start_date, $text);
    $text = str_replace("{end_date}", $end_date, $text);
	return $text;
}

}
















