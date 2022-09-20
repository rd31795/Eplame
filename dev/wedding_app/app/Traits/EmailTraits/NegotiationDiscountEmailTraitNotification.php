<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Coupon;
use App\Models\Admin\EmailTemplate;
trait NegotiationDiscountEmailTraitNotification {
    use EmailNotificationTrait;
    use EmailTemplateTrait;

#---------------------------------------------------------------------------------------------------
#  Negotiation Success
#---------------------------------------------------------------------------------------------------


public function NegotiationEventTrait($coupon_details)
{
  $template_id = $this->emailTemplate['NegotiationDiscountEmailTraitNotification'];
  return $this->NegotiationEventTraitSendEmail($coupon_details,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Negotiation Success
#---------------------------------------------------------------------------------------------------



public function NegotiationEventTraitSendEmail($coupon_details,$template_id)
{
  $template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'email' => $coupon_details->email
    ];

    $data = $this->NegotiationEventTraitHtml($coupon_details,$template);
    $ar= ['data' => $data];
   return $this->sendNotificationWithoutName($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Negotiation Success
#---------------------------------------------------------------------------------------------------



public function NegotiationEventTraitHtml($coupon_details,$template)
{
    $text2 = $template->body;
      $text = str_replace("{coupon_code}", $coupon_details->coupon, $text2);
    return $text;
}


}
















