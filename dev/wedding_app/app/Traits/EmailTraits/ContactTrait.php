<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Coupon;
use App\Models\Admin\EmailTemplate;
trait ContactTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function ContactTrait($name,$email,$phone,$message)
{
	$template_id = $this->emailTemplate['ContactNotification'];
	return $this->ContactTraitSendEmail($name,$email,$phone,$message, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function ContactTraitSendEmail($name,$email,$phone,$message, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $name,
           'email' => 'patrickphp2@gmail.com'
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->ContactTraitHtml($name,$email,$phone,$message, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function ContactTraitHtml($name,$email,$phone,$message, $template)
{ 
	  $text2 = $template->body;  
    $text = str_replace("{name}", $name, $text2);
    $text = str_replace("{email}", $email, $text);
    $text = str_replace("{phone}", $phone, $text);
    $text = str_replace("{message}", $message, $text);
	return $text;
}

}
















