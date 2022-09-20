<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\UserEvent;
use App\Models\Admin\EmailTemplate;
trait RegistrationEventInvitationTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function RegistrationEventInvitationTrait($mail_id, $user_event_id)
{
	$template_id = $this->emailTemplate['RegistrationEventInvitationNotification'];
  $event = UserEvent::where('id', $user_event_id)->first();
	return $this->RegistrationEventInvitationTraitSendEmail($mail_id, $event, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function RegistrationEventInvitationTraitSendEmail($mail_id, $event, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => '',
           'email' => $mail_id,
    ];
    
    $data = $this->RegistrationEventInvitationTraitHtml($mail_id, $event, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function RegistrationEventInvitationTraitHtml($mail_id, $event, $template)
{ 
	$detail_url = url('/')."/eventDetail/".$event->slug;
  $text2 = $template->body;
  $text = str_replace("{event_name}", $event->title, $text2);
  $text = str_replace("{link}", $detail_url, $text);
  return $text;
}

}
















