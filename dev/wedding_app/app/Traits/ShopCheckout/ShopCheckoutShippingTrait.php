<?php
namespace App\Traits\ShopCheckout;
use Illuminate\Http\Request;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use Session;
use App\Traits\ShopCheckout\PaymentStepTrait;
use App\Traits\ShopCheckout\TotalOrderCalulationTrait;
use App\Traits\ShopCheckout\StripeMethodTrait;
use App\Models\Shop\ShopCartItems;
use App\Models\Products\Product;
use Illuminate\Support\Facades\Crypt;
trait ShopCheckoutShippingTrait {
use PaymentStepTrait;
use TotalOrderCalulationTrait;
use StripeMethodTrait;




public function index(Request $request)
{
	$number = 1;
	$express_checkout=0;
	if($request->express_checkout){
	$express_checkout=Crypt::decrypt($request->express_checkout);
	 Session::put('express_checkout',$express_checkout);
	}
	if($express_checkout==1){
	 $CartItems=ShopCartItems::where('user_id',Auth::id())->where('type','buynow')->orderBy('id','DESC')->first();
	 $CartItems=[$CartItems->product_id];
	}else{
	Session::forget('express_checkout');
    $CartItems=Auth::user()->ShopProductCartItems->pluck('product_id');
	}
    $arr = $this->checkStep($number);
    $product=Product::whereIn('id',$CartItems);
    if($product->count()==1){
    	if($express_checkout==1){
           $order=ShopCartItems::where('user_id',Auth::id())->where('type','buynow')->orderBy('id','DESC')->get();
    	}else{
          $order=Auth::user()->ShopProductCartItems;
    	}
          if($order[0]->product->local_pickup && $order[0]->product->shipping_available!=1){
             return  redirect(route('shop.checkout.reviewCart'));
          }
    }
    $shipping_and_pickup=0;
    if($product->where('shipping_available',1)->where('local_pickup',1)->count()>0 ){
        $shipping_and_pickup=1;
    }

    if($product->where('local_pickup',1)->count() == count(Auth::user()->ShopProductCartItems) && $product->where('shipping_available',1)->count()==0){
    	return  redirect(route('shop.checkout.reviewCart'));
    }

    if($arr['status'] == 1){
    	return $arr['url'];
    }
	return view($this->filePath.'index')
    		->with('number',$number)
    		 ->with('obj',$this) 
    		 ->with('shipping_and_pickup',$shipping_and_pickup) 
	        ->with('address',$this->getShippingAddress())
	        ->with('express_checkout',$express_checkout);
  
}



#---------------------------------------------------------------------------------
# Billing Address
#---------------------------------------------------------------------------------
public function billingAddress()
{
	    $number = 3;
	    $arr = $this->checkStep($number);
	    if($arr['status'] == 1){
	    	return $arr['url'];
	    }
	  return view($this->filePath.'billingAddress')
            ->with('number',$number)
             ->with('obj',$this)
	        ->with('backward',url(route('shop.checkout.reviewCart')))
	        ->with('address',$this->getBillingAddress());
	     
}

#---------------------------------------------------------------------------------
# Billing Address
#---------------------------------------------------------------------------------

public function postAddress(Request $request)
{
        $rules = [
	         'name' => 'required',
	         'email' => 'required',
	         'phone_number' => 'required',
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
      
     // $tax = ratesForLocation($request->zipcode, $request->city, $request->country_short_code);
     // if($v->fails()){
     // 	 return response()->json(['status' => 0,'errors' => $v->errors()]);
     // }elseif($tax['status'] == 0 || $tax['val'] == 0){
     //     $errors = (object)['tax' => $tax['messages']];
     //     return response()->json(['status' => 0,'errors' => $errors]);
     // }else{

        $arr = [
	         'name' => $request->name,
	         'email' => $request->email,
	         'phone_number' => $request->phone_number,
	         'address' => $request->address,
	         'country' => $request->country,
	         'state' => $request->state,
	         'city' => $request->city,
	         'zipcode' => $request->zipcode,
	         'latitude' => $request->latitude,
	         'longitude' =>$request->longitude,
	         'country_short_code' =>$request->country_short_code,
	         // 'tax'=> $tax['val']
	         'tax' => 2
         ];
         Session::put('shippingAddress',json_encode($arr));
         $url =  url(route('shop.checkout.reviewCart'));
         return response()->json([
         	'status' => 1,
         	'errors' => 'Shipping Address is saved',
         	'redirectLink' => $url
         ]);
 
     // }
}
#---------------------------------------------------------------------------------
# Billing Address
#---------------------------------------------------------------------------------

public function postBillingAddress(Request $request)
{
        $rules = [
	         'name' => 'required',
	         'email' => 'required',
	         'phone_number' => 'required',
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

      
     if($v->fails()){
     	 return response()->json(['status' => 0,'errors' => $v->errors()]);
     }else{

        $arr = [
	         'name' => $request->name,
	         'email' => $request->email,
	         'phone_number' => $request->phone_number,
	         'address' => $request->address,
	         'country' => $request->country,
	         'state' => $request->state,
	         'city' => $request->city,
	         'zipcode' => $request->zipcode,
	         'latitude' => $request->latitude,
	         'longitude' =>$request->longitude,
	         'country_short_code' =>$request->country_short_code
	          
         ];
         Session::put('shopBillingAddress',json_encode($arr));
         $url =  url(route('shop.checkout.payment'));
         return response()->json([
         	'status' => 1,
         	'errors' => 'Billing Address is saved',
         	'redirectLink' => $url
         ]);
 
     }
}

#---------------------------------------------------------------------------------
# Billing Address Object
#---------------------------------------------------------------------------------
public function getBillingAddress()
{
	 $address = [ 
	  'name' => '',
	  'email' => '',
	  'phone_number' => '',
	  'address' => '',
	  'country' => '',
	  'state' => '',
	  'city' => '',
	  'zipcode' => '',
	  'country_short_code' => '',
	  'latitude' => '',
	  'longitude' => ''
	];

	$billing = Session::has('shopBillingAddress') ? json_decode(Session::get('shopBillingAddress')) : $address;

	return (object)$billing;
}

#---------------------------------------------------------------------------------
# Billing Address Object
#---------------------------------------------------------------------------------
public function getShippingAddress()
{
	 $address = [ 
	  'name' => '',
	  'email' => '',
	  'phone_number' => '',
	  'address' => '',
	  'country' => '',
	  'state' => '',
	  'city' => '',
	  'zipcode' => '',
	  'country_short_code' => '',
	  'latitude' => '',
	  'longitude' => ''
	];

	$billing = Session::has('shippingAddress') ? json_decode(Session::get('shippingAddress')) : $address;

	return (object)$billing;
}

#-----------------------------------------------------------------------------------------------------------
#   check steps
#-----------------------------------------------------------------------------------------------------------

public function checkStep($number)
{
      

      $status=0;
      $url='';
    
	 
	if(!Session::has('shippingAddress') && $number > 1){
		$url = redirect()->route('shop.checkout.index')->with('messages','Please complete the billing step first');
	}

	if(!Session::has('reviewOrderCart') && $number > 2){
		$url = redirect()->route('shop.checkout.index')->with('messages','Please complete the Order Review step first');
	}

   if(!Session::has('shopBillingAddress') && $number > 3){
		$url = redirect()->route('shop.checkout.index')->with('messages','Please complete the Billing Address step first');
	}
	return [
       'status' => $status,
       'url' => $url
	];
}























 
























}