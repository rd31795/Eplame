<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\Admin\EmailTemplate;
trait AdminBugTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function AdminBugTrait($name, $email, $summary, $full_url)
{
	$template_id = $this->emailTemplate['BugNotification'];
	return $this->AdminBugTraitSendEmail($name, $email, $summary, $full_url, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function AdminBugTraitSendEmail($name, $email, $summary, $full_url, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => 'Admin',
           'email' => 'patrickphp2@gmail.com',
           'attachment' => $full_url
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->AdminBugTraitHtml($name, $email, $summary, $full_url, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function AdminBugTraitHtml($name, $email, $summary, $full_url, $template)
{ 
	$text2 = $template->body;  
    $text = str_replace("{name}", $name, $text2);
    $text = str_replace("{email}", $email, $text);
    $text = str_replace("{description}", $summary, $text);
	return $text;
}

}
















