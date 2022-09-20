<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Coupon;
use App\Models\Admin\EmailTemplate;
trait VirtualEventTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function VirtualEventTrait($user_data,$url)
{
	$template_id = $this->emailTemplate['VirtualEventNotification'];
	return $this->VirtualEventTraitSendEmail($user_data,$url,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function VirtualEventTraitSendEmail($user_data,$url,$template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $user_data->name,
           'email' => $user_data->email
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->VirtualEventTraitHtml($user_data,$url,$template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function VirtualEventTraitHtml($user_data,$url,$template)
{ 
	  $text2 = $template->body;
    //$link = $this->getRedirecturl($url);  
    $text = str_replace("{name}", $user_data->name, $text2);
    $text = str_replace("{url}", $url, $text);
	return $text;
}
public function getRedirecturl($url)
{

    return '<a href="'.$url.'">'.$url.'</a>';
}

}
















