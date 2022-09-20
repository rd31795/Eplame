<?php
namespace App\Traits\Registrationcheckoutproccess;
use Illuminate\Http\Request;
use App\Traits\Registrationcheckoutproccess\Ordersummary;
use App\Traits\Registrationcheckoutproccess\CheckoutPayment;
use App\Traits\Registrationcheckoutproccess\StripeMethod;
use App\Traits\Registrationcheckoutproccess\PaypalMethod;
use App\Traits\Registrationcheckoutproccess\TotalOrderCalulation;
use App\Traits\EmailTraits\EmailNotificationTrait;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use Session;
use App\UserEvent;
use App\RegistrationType;


trait Billing_reg{

	use Ordersummary;
	use CheckoutPayment;
	use StripeMethod;
	use PaypalMethod;
	use TotalOrderCalulation;
	use EmailNotificationTrait;


#---------------------------------------------------------------------------------
# Billing Address
#---------------------------------------------------------------------------------
public function billingAddress()
{
     // jassi91@yopmail.com
	 
       //Session::forget('billingAddress');
	 //return $checkoutType = $this->checkDirectOrNot();
	   Session::forget('OrderSummary');


	   return view('tools.forum.registrationForm')
	   ->with('stepNumber',1)
	   ->with('haveDeal',1)
	   ->with('checkout',1)
	   ->with('submitBillingForm',$this->nextStepRoute('checkout.getOrderSummary2'))
	   ->with('obj',$this)
	   ->with('orders',$this->getCurentOrders())
	   ->with('address',$this->getBillingAddress());
}

#---------------------------------------------------------------------------------
# Billing Address
#---------------------------------------------------------------------------------

public function postAddress(Request $request)
{
        $rules = [
	         'first_name' => 'required',
	         'email' => 'required',
	         'mobile' => 'required',
	         'address' => 'required',
	         'country' => 'required',
	         'state' => 'required',
	         'city' => 'required',
	         'zipcode' => 'required',
	         'latitude' => 'required',
	       
         ];

     $v = \Validator::make($request->all(),$rules,[
             'latitude.required' => 'Please choose address from dropdown'
     ]);

     $tax = ratesForLocation($request->zipcode, $request->city, $request->country_short_code);
   	 
     // if($v->fails()){
     // 	 return response()->json(['status' => 0,'errors' => $v->errors()]);
     // }elseif($tax['status'] == 0 || $tax['val'] == 0){
     //     $errors = (object)['tax' => $tax['messages']];
     //     return response()->json(['status' => 0,'errors' => $errors]);
     // }else{
       $registration_id=$request->reg_type;
       $ticket_qty=$request->input('inventory_'.$registration_id)?$request->input('inventory_'.$registration_id):1;
       $registration=RegistrationType::find($registration_id);
       $registration_price=0;
       $single_unit_price=0;
       if($registration){
       	   $single_unit_price=$registration->price;
           $registration_price=$registration->price*$ticket_qty;
       }
        $arr = [
	         'name' => $request->first_name.' '.$request->last_name,
	         'email' => $request->email,
	         'mobile' => $request->mobile,
	         'age' => $request->age,
	         'gender' => $request->gender,
	         'address' => $request->address,
	         'country' => $request->country,
	         'state' => $request->state,
	         'city' => $request->city,
	         'zipcode' => $request->zipcode,
	         'latitude' => $request->latitude,
	         'longitude' =>$request->longitude,
	         'country_short_code' =>$request->country_short_code,
	         'quantity'=>$ticket_qty,
	         'single_unit_price'=>$single_unit_price,
	         'reg_type' =>$registration_price,
	         'reg_id'=>$registration_id,
	         'tax'=> $tax['val']
         ];
         
         Session::put('billingAddress',json_encode($arr));
         $url = url(route('checkout.orderSummary2',$request->event_id));

         return response()->json(['status' => 1,'errors' => 'Billing Address is saved', 'redirectLink' => $url]);
 
     //}
}

#---------------------------------------------------------------------------------
# Billing Address Object
#---------------------------------------------------------------------------------
public function getBillingAddress()
{
	 $address = [ 
	  'first_name' => '',
	  'email' => '',
	  'mobile' => '',
	  'address' => '',
	  'age' => '',
	  'gender' => '',
	  'country' => '',
	  'state' => '',
	  'city' => '',
	  'zipcode' => '',
	  'country_short_code' => '',
	  'latitude' => '',
	  'longitude' => ''
	];

	$billing = Session::has('billingAddress') ? json_decode(Session::get('billingAddress')) : $address;

	return (object)$billing;
}


#-----------------------------------------------------------------------------------------------------------
#   check steps
#-----------------------------------------------------------------------------------------------------------

public function checkStep($number, $event_id)
{
    $order = $this->getCurentOrders($event_id);
 	$event = UserEvent::where('id',$event_id)->first();
 	// dd($event);
	if($order->count() == 0){
		return redirect()->route('my_cart')->with('messages','Your cart have no item to buy.');
	}
	if(!Session::has('billingAddress') && $number > 1){

		// return redirect()->route('user.event.registration',['id' => $event_id, 'slug' => $event->slug])->with('messages','Please complete the billing step first');
		abort(404);
	}
 
	if(!Session::has('OrderSummary') && $number > 2){
		return redirect()->route('checkout.getOrderSummary2')->with('messages','Please complete the order summary step first');
	}
}

#-----------------------------------------------------------------------------------------------------------
#   check steps
#-----------------------------------------------------------------------------------------------------------

public function checkDirectOrNot()
{
	return $paymentType = \Request::segment(1) == "checkout" ? "cart" : "direct";
}


}