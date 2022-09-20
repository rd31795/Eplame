<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\Traits\EmailTraits\EmailTemplateTrait;
use App\Traits\EmailTraits\UserNotificationTrait;
 
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use Session;
use App\Models\Admin\EmailTemplate;
trait EmailNotificationTrait {


use EmailTemplateTrait;
use UserNotificationTrait;

#----------------------------------------------------------------------------------------------
# 
#----------------------------------------------------------------------------------------------

public function sendNotification($emailTeplate,$data,$arr)
{
    \Mail::send($emailTeplate,$data, function($message) use($arr) {
		if(!empty($arr['attachment'])){
	           $message->to($arr['email'], $arr['name'])
	           ->subject($arr['subject'])->attach($arr['attachment']);
	       }else{
	       		$message->to($arr['email'], $arr['name'])
	           ->subject($arr['subject']);
	       }
	               
	    });
    return 1;
    }

    public function sendNotificationWithoutName($emailTeplate,$data,$arr)
    {
        \Mail::send($emailTeplate,$data, function($message) use($arr) {
            if(!empty($arr['attachment'])){
                   $message->to($arr['email'])
                   ->subject($arr['subject'])->attach($arr['attachment']);
               }else{
                       $message->to($arr['email'])
                   ->subject($arr['subject']);
               }

            });
        return 1;
        }

}