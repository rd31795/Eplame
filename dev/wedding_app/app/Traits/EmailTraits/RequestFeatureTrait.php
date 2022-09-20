<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Models\Admin\EmailTemplate;
trait RequestFeatureTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function RequestFeatureTrait($name, $email, $requirements, $solution, $comp_summary)
{
	$template_id = $this->emailTemplate['RequestFeatureNotification'];
	return $this->RequestFeatureTraitSendEmail($name, $email, $requirements, $solution, $comp_summary, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function RequestFeatureTraitSendEmail($name, $email, $requirements, $solution, $comp_summary, $template_id)
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
    
    $data = $this->RequestFeatureTraitHtml($name, $email, $requirements, $solution, $comp_summary, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function RequestFeatureTraitHtml($name, $email, $requirements, $solution, $comp_summary, $template)
{ 
	$text2 = $template->body;  
    $text = str_replace("{name}", $name, $text2);
    $text = str_replace("{email}", $email, $text);
    $text = str_replace("{description}", $requirements, $text);
    $text = str_replace("{solution}", $solution, $text);
    $text = str_replace("{compition_summary}", $comp_summary, $text);
	return $text;
}

}
















