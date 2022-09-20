<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\Admin\EmailTemplate;
trait SubAdminRegistrationTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function SubAdminRegistrationTrait($user)
{
	$template_id = $this->emailTemplate['SubAdminRegistrationNotification'];
	return $this->SubAdminRegistrationTraitSendEmail($user, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function SubAdminRegistrationTraitSendEmail($user, $template_id)
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
    
    $data = $this->SubAdminRegistrationTraitHtml($user, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function SubAdminRegistrationTraitHtml($user, $template)
{ 
	$text2 = $template->body;  
    $text = str_replace("{name}", $user->name, $text2);
    $text = str_replace("{email}", $user->email, $text);
	return $text;
}

}
















