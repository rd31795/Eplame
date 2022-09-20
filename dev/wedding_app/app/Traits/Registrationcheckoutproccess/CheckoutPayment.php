<?php
namespace App\Traits\Registrationcheckoutproccess;
use Illuminate\Http\Request;
use App\Traits\Checkoutproccess\Ordersummary;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use Session;
trait CheckoutPayment {

	

#===========================================================================================
#===========================================================================================
#===========================================================================================



 public function paymentPage($event_id)
 {
 	 $data = $this->getBillingAddress();
 	 $this->checkStep(3,$event_id);
	 return view('tools.forum.payment')
	 ->with('stepNumber',3)
	 ->with('orders',$this->getCurentOrders($event_id))
	 ->with('obj',$this)
	 ->with('data', $data)
     ->with('haveDeal',1);
 }


#===========================================================================================
#===========================================================================================
#===========================================================================================










 
}

