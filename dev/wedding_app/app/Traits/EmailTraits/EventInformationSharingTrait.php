<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\UserEvent;
use App\VendorCategory;
use App\Models\Admin\EmailTemplate;
trait EventInformationSharingTrait {


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function EventInformationSharingTrait($service, $e)
{
	$template_id = $this->emailTemplate['EventInformationSharingNotification'];
	return $this->EventInformationSharingTraitSendEmail($service, $e, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function EventInformationSharingTraitSendEmail($service, $e, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $service->vendors->name,
           'email' => $service->vendors->email
    ];
    
    $data = $this->EventInformationSharingTraitHtml($service, $e, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function EventInformationSharingTraitHtml($service, $e, $template)
{ 
	$text2 = $template->body;
    $text = str_replace("{user_name}", $e->users->name, $text2);
    $text = str_replace("{user_email}", $e->users->email, $text);
    $text = str_replace("{vendor_name}", $service->vendors->name, $text);
    $text = str_replace("{event_name}", $e->title, $text);
    $text = str_replace("{event_location}", $e->location, $text);
	
	return $text;
}








}































