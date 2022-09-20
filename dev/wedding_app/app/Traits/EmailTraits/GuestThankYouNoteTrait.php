<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\UserEvent;
use App\Models\Admin\EmailTemplate;
trait GuestThankYouNoteTrait {


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function GuestThankYouNoteTrait($guest, $note)
{
	$template_id = $this->emailTemplate['GuestThankYouNoteNotification'];
	return $this->GuestThankYouNoteTraitSendEmail($guest, $note, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function GuestThankYouNoteTraitSendEmail($guest, $note, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'name' => $guest->fname,
           'subject' => $template->subject,
           'email' => $guest->email,
           'event_slug' => $guest->guestEvent->slug,
           'note' => $note
    ];
    
    $data = $this->GuestThankYouNoteTraitHtml($guest, $note, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function GuestThankYouNoteTraitHtml($guest, $note, $template)
{ 
	$text2 = $template->body;
  $text = str_replace("{name}", $guest->fname, $text2);
  $text = str_replace("{event_name}", $guest->guestEvent->title, $text);
  $text = str_replace("{note}", $note, $text);
	return $text;
}








}































