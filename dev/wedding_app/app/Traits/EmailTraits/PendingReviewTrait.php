<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\EventOrder;
use App\Models\Admin\EmailTemplate;

trait PendingReviewTrait {

#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


  public function PendingReviewTrait($order)
  {
  	$template_id = $this->emailTemplate['PendingReviewNotification'];
  	return $this->PendingReviewTraitSendEmail($order, $template_id);
  }


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



  public function PendingReviewTraitSendEmail($order, $template_id)
  {
  	$template = EmailTemplate::find($template_id);
      $view= 'emails.custom_email';
      $arr = [
             'title' => $template->title,
             'subject' => $template->subject,
             'name' => $order->user->name,
             'email' => $order->user->email,
             'event_slug' => $order->event->slug
      ];
      
      $data = $this->PendingReviewTraitHtml($order,$template);
      $ar= ['data' => $data];
      return $this->sendNotification($view,$ar,$arr);
  }


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



  public function PendingReviewTraitHtml($order,$template)
  { 
  	$text2 = $template->body;
      $url = url('/')."/user/review-form/".$order->id;
      $text = str_replace("{name}", $order->user->name, $text2);
      $text = str_replace("{event_name}", $order->event->title, $text);
      $text = str_replace("{review_url}", $url, $text);
  	
  	return $text;
  }

}































