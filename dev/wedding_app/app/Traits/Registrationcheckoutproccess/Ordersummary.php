<?php
namespace App\Traits\Registrationcheckoutproccess;
use Illuminate\Http\Request;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use App\UserEvent;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use Session;
trait Ordersummary {



#-------------------------------------------------------------------------------------------------------
#  Order Summary Listing Page
#-------------------------------------------------------------------------------------------------------


public function orderSummary($event_id)
{

	//return $this->CommissionFeeServiceAccordingVendor('STRIPE',1);
//return $this->getCurentOrders()->get();
    $data = $this->getBillingAddress();
    	$this->checkStep(2 ,$event_id);
        Session::put('OrderSummary',1);
    	return view('tools.forum.orderSummary') 
    	->with('orders',$this->getCurentOrders($event_id))
        ->with('obj',$this)
    	->with('stepNumber',2)
        ->with('data', $data)
        ->with('haveDeal',1);
   
}

 
#-------------------------------------------------------------------------------------------------------
#  Order Summary Listing Page
#-------------------------------------------------------------------------------------------------------


public function getCurentOrders($event_id)
{  
     $checkoutType = $this->checkDirectOrNot();
     return $orderEvent = UserEvent::where('id',$event_id)->first();
	 
}


#-------------------------------------------------------------------------------------------------------
#  Order Summary Listing Page
#-------------------------------------------------------------------------------------------------------


public function nextStepRoute($route)
{  
     $checkoutType = $this->checkDirectOrNot();
     return $checkoutType == "direct" ? url(route("direct.".$route)) : url(route($route));
     
}



#------------------------------------------------------------------------------------------------------
#  get Order Summary
#------------------------------------------------------------------------------------------------------


public function getOrderSummary()
{
	 $order = $this->getCurentOrders();
     $items = view('users.includes.cart.list')
     ->with('CartItems',$order->get());
     $amountDetail = view('users.includes.cart.cart_total')
     ->with('CartItems',$order)->with('checkout',1)->with('obj',$this);


   
    $data = [
            'items' => $items->render(),
            'amountDetail' => $amountDetail->render(),
           ];

    return response()->json([
            'status' => 1,
            'data' => $data
    ]);
}








}