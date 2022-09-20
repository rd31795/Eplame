<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use UserEventGuest;
use UserEvent;
use App\Models\Admin\EmailTemplate;
trait GuestInvitationTrait {







#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function GuestInvitationTrait($guest)
{
	$template_id = $this->emailTemplate['UserEventGuestNotification'];
	return $this->GuestInvitationTraitSendEmail($guest, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function GuestInvitationTraitSendEmail($guest, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $guest->fname,
           'email' => $guest->email,
           'event_slug' => $guest->guestEvent->slug
    ];
    
    $data = $this->GuestInvitationTraitHtml($guest,$template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function GuestInvitationTraitHtml($guest,$template)
{ 
	$text2 = $template->body;
    $accept_url = url('/')."/thanks/".$guest->id."/1";
    $decline_url = url('/')."/thanks/".$guest->id."/2";
    $text = str_replace("{name}", $guest->fname, $text2);
    $text = str_replace("{event_location}", $guest->guestEvent->location, $text);
    $text = str_replace("{accept_url}", $accept_url, $text);
    $text = str_replace("{decline_url}", $decline_url, $text);
	
	return $text;
}








}































