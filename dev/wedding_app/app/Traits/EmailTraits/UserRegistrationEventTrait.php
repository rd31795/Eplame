<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\UserEvent;
use App\EventRegistration;
use App\Models\Admin\EmailTemplate;
trait UserRegistrationEventTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function UserRegistrationEventTrait($pdf,$name, $mail_id, $user_event_id,$id)
{
	$template_id = $this->emailTemplate['UserRegistrationEventTraitNotification'];
  $event = UserEvent::where('id', $user_event_id)->first();
  $registered = EventRegistration::where('id', $id)->first();
	return $this->UserRegistrationEventTraitSendEmail($pdf,$name, $mail_id, $event, $registered, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserRegistrationEventTraitSendEmail($pdf,$name, $mail_id, $event, $registered, $template_id)
{
  $template = EmailTemplate::find($template_id);
  $view= 'emails.custom_email';
  $arr = [
          'title' => $template->title,
          'subject' => $template->subject,
          'name' => $name,
          'email' => $mail_id,
          'attachment' => $pdf
  ];
  
  $data = $this->UserRegistrationEventTraitHtml($pdf,$name, $mail_id, $event, $registered, $template);
  $ar= ['data' => $data];

  return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function UserRegistrationEventTraitHtml($pdf, $name, $mail_id, $event, $registered, $template)
{ 
  $event_image = url('/')."/".$event->event_picture;
  $start_day = \Carbon\Carbon::parse($event->start_date)->format('l');
  $start_month =  \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b');
  $start_date = \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d');
  $start_year = \Carbon\Carbon::parse($event->start_date)->formatLocalized('%Y');
  $start_time =  \Carbon\Carbon::parse($event->start_time)->format('g:i A');
  $start_event = $start_day.', '.$start_month.' '.$start_date.', '.$start_year.', '.$start_time;

  $end_day = \Carbon\Carbon::parse($event->end_date)->format('l');
  $end_month =  \Carbon\Carbon::parse($event->end_date)->formatLocalized('%b');
  $end_date = \Carbon\Carbon::parse($event->end_date)->formatLocalized('%d');
  $end_year = \Carbon\Carbon::parse($event->end_date)->formatLocalized('%Y');
  $end_time =  \Carbon\Carbon::parse($event->end_time)->format('g:i A');
  $end_event = $end_day.', '.$end_month.' '.$end_date.', '.$end_year.', '.$end_time;
  if(empty($event->location))
  {
    $address = "Online - Anywhere w/Fast Wifi and Sound";
  }else{
     $address =  $event->location;
  }
  if($registered->amount == 0)
  {
    $amount = 'Free';
  }else{
    $amount = $registered->amount;
  }

 
    $text2 = $template->body;
    $text = str_replace("{event_name}", $event->title, $text2);
    $text = str_replace("{link}", $event->zoom_url, $text);
    $text = str_replace("{name}", $name, $text);
    $text = str_replace("{event_picture}", $event_image, $text);
    $text = str_replace("{event_start_date}", $start_event, $text);
    $text = str_replace("{event_end_date}", $end_event, $text);
    $text = str_replace("{event_address}", $address, $text);
    $text = str_replace("{event_amount}", $amount, $text);
    $text = str_replace("{ticket_qty}", $registered->seats, $text);

  return $text;
}

}
















