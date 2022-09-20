<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Coupon;
use App\Models\Admin\EmailTemplate;
trait SignupCouponCodeTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function SignupCouponCodeTrait($user,$coupon)
{
	$template_id = $this->emailTemplate['SignupCouponCodeNotification'];
	return $this->SignupCouponCodeTraitSendEmail($user, $coupon, $template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function SignupCouponCodeTraitSendEmail($user, $coupon, $template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $user->first_name,
           'email' => $user->email
           //'event_slug' => $cohost->event->slug
    ];
    
    $data = $this->SignupCouponCodeTraitHtml($user, $coupon, $template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function SignupCouponCodeTraitHtml($user, $coupon, $template)
{ 
	  $text2 = $template->body;  
    $text = str_replace("{name}", $user->first_name, $text2);
    $text = str_replace("{deal_code}", $coupon->deal_code, $text);
	return $text;
}

}
















