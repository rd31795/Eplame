<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\User;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\Order;
use App\Models\EventOrder;
use Session;
use App\Models\Admin\EmailTemplate;
trait ShopRejectedEmailTrait {







#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------


public function ShopRejectedEmailTrait($shop)
{
	$template_id = $this->emailTemplate['ShopRejectedEmailTraitFullNotification'];
	return $this->ShopRejectedEmailTraitSendEmail($shop,$template_id);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function ShopRejectedEmailTraitSendEmail($shop,$template_id)
{
	$template = EmailTemplate::find($template_id);
    $view= 'emails.custom_email';
    $arr = [
           'title' => $template->title,
           'subject' => $template->subject,
           'name' => $shop->user->name,
           'email' => $shop->user->email
    ];
    
    $data = $this->ShopRejectedEmailTraitHtml($shop,$template);
    $ar= ['data' => $data];
   return $this->sendNotification($view,$ar,$arr);
}


#---------------------------------------------------------------------------------------------------
#  Order Success
#---------------------------------------------------------------------------------------------------



public function ShopRejectedEmailTraitHtml($shop,$template)
{ 
	$text2 = $template->body;
    $text = str_replace("{name}",$shop->user->name,$text2);
    $text = str_replace("{shopName}",$shop->name,$text);
    $text = str_replace("{reasons}",$shop->RejectionReason->reason,$text);
	
	return $text;
}








}































