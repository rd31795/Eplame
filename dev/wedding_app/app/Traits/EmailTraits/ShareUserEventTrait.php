<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\UserEvent;
use App\Models\Admin\EmailTemplate;
trait ShareUserEventTrait {


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function ShareUserEventTrait($mail_id, $user_event_id)
{
	$template_id = $this->emailTemplate['ShareUserEventNotification'];
  $event = UserEvent::where('id', $user_event_id)->first();
	return $this->ShareUserEventTraitSendEmail($mail_id, $event, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function ShareUserEventTraitSendEmail($mail_id, $event, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'name' => '',
           'subject' => $template->subject,
           'email' => $mail_id
    ];
    
    $data = $this->ShareUserEventTraitHtml($mail_id, $event, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function ShareUserEventTraitHtml($mail_id, $event, $template)
{ 
  $detail_url = url('/')."/forum/user/".$event->user_id."/".$event->slug."/event";
	$text2 = $template->body;
  $text = str_replace("{detail_url}", $detail_url, $text2);
	return $text;
}








}































