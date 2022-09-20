<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Coupon;
use App\Models\Admin\EmailTemplate;
trait HybridEventTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function HybridEventTrait($user_data,$url)
{
	$template_id = $this->emailTemplate['HybridEventNotification'];
	return $this->HybridEventTraitSendEmail($user_data,$url,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function HybridEventTraitSendEmail($user_data,$url,$template_id)
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
    
    $data = $this->HybridEventTraitHtml($user_data,$url,$template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function HybridEventTraitHtml($user_data,$url,$template)
{ 
	  $text2 = $template->body;
    //$link = $this->getRedirecturl2($url);  
    $text = str_replace("{name}", $user_data->name, $text2);
    $text = str_replace("{url}", $url, $text);
	return $text;
}
public function getRedirecturl2($url)
{

    return '<a href="'.$url.'">'.$url.'</a>';
}

}
















