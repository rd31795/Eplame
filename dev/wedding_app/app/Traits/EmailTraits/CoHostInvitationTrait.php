<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\UserEvent;
use App\CoHost;
use App\Models\Admin\EmailTemplate;
trait CoHostInvitationTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function CoHostInvitationTrait($cohost)
{
	$template_id = $this->emailTemplate['UserEventCoHostNotification'];
	return $this->CoHostInvitationTraitSendEmail($cohost, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function CoHostInvitationTraitSendEmail($cohost, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $cohost->cohost_name,
           'email' => $cohost->cohost_email,
           'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->CoHostInvitationTraitHtml($cohost, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function CoHostInvitationTraitHtml($cohost, $template)
{ 
	$text2 = $template->body;
    $accept_url = url('/')."/user/thanks/".$cohost->id."/1";    
    $login_url = url('/')."/login/";    
    $register_url = url('/')."/register/";    
    $text = str_replace("{name}", $cohost->cohost_name, $text2);
    $text = str_replace("{event_name}", $cohost->event->title, $text);
    $text = str_replace("{event_location}", $cohost->event->location, $text);
    $text = str_replace("{accept_url}", $accept_url, $text);
    $text = str_replace("{login_url}", $login_url, $text);
    $text = str_replace("{register_url}", $register_url, $text);
	
	return $text;
}

}
















