<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\Admin\EmailTemplate;
trait AdminFeedbackTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function AdminFeedbackTrait($name, $email, $summary)
{
  $template_id = $this->emailTemplate['FeedbackNotification'];
  return $this->AdminFeedbackTraitSendEmail($name, $email, $summary, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function AdminFeedbackTraitSendEmail($name, $email, $summary, $template_id)
{
  $template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => 'Admin',
           'email' => 'patrickphp2@gmail.com'
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->AdminFeedbackTraitHtml($name, $email, $summary, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function AdminFeedbackTraitHtml($name, $email, $summary, $template)
{ 
  $text2 = $template->body;  
    $text = str_replace("{name}", $name, $text2);
    $text = str_replace("{email}", $email, $text);
    $text = str_replace("{description}", $summary, $text);
  return $text;
}

}
















