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
use App\Models\Shop\ShopCartItems;
use App\Models\Products\Product;
use App\User;
use EasyPost\Shipment;
use EasyPost\EasyPost;
use EasyPost\Error;

trait PaymentStepTrait {
	public $shipping_price=0;

public function payment()
{     
	$number = 4;
    $arr = $this->checkStep($number);
    if($arr['status'] == 1){
    	return $arr['url'];
    }

    Auth::user()->getShopCartTotal();
   
	return view($this->filePath.'payment')
		  ->with('number',$number)
		  ->with('obj',$this)
	      ->with('backward',url(route('shop.checkout.billingAddress')));	 
}

#==================================================================================================
#==================================================================================================
#==================================================================================================

public function paymentEvalueAteToVendor()
{
	$order = Auth::user()->ShopProductCartItemOfVendors;
	foreach ($order as $key => $o) {
		$payableAmount = $o->getOrderOfSingleVendor->sum('total');
	}    
}

#==================================================================================================
#==================================================================================================
#==================================================================================================


public function getTotalOrder()
{
   $total=Auth::user()->ShopProductCartItems->sum('total');
  if(Session::get('express_checkout')==1){
     $cart_item=ShopCartItems::where('user_id',Auth::id())->where('type','buynow')->orderBy('id','DESC')->first();
     $total=$cart_item->total;
  }
	return $total;

}


#==================================================================================================
#==================================================================================================
#==================================================================================================


public function getTax()
{
   return getTaxPriceAccordingToZipcode();
}

 
#===================================================================================================
#===================================================================================================
#===================================================================================================


public function getCommissionFee($total=null)
{
    $totalAmount = $total == null ? $this->getTotalOrder()  : $total;
    return getFee($totalAmount, 'commission_fee_type', 'commission_fee_amount');
}


#===================================================================================================
#===================================================================================================
#===================================================================================================

public function getGrandTotal()
{
	return ($this->getShippingRate()+$this->getServiceFee() + $this->getTax() + $this->getTotalOrder());
}



#===================================================================================================
#===================================================================================================
#===================================================================================================

public function getShippingRate(){
	if(Session::has('shippingAddress')){
	 $products=Auth::user()->ShopProductCartItems->pluck('product_id');
    if(Session::get('express_checkout')==1){
                    $products=ShopCartItems::where('user_id',Auth::id())->where('type','buynow')->pluck('product_id');
    }
		 $users=Product::whereIn('id',$products)->where('shipping',1)->orWhereIn('parent',$products)->where('shipping',1)->groupBy('user_id')->pluck('user_id');
        if(count($users)>0){
                $vendors=User::whereIn('id',$users)->get();
                $shipping_rate=0;
                foreach ($vendors as $key => $value) {
                	$shipping=$this->getShippingRates($value,json_decode(Session::get('shippingAddress')));
                     
                     $shipping_rate+=(float)$shipping->rate;
                }
                return $shipping_rate;
}
}
return 0;

}


#------------------------------------------------------------------------------------------
#  get Total Summary
#------------------------------------------------------------------------------------------

public function getTotalWithTr()
{
  
  $sum=Auth::user()->ShopProductCartItems->sum('total');
  if(Session::get('express_checkout')==1){
     $sum=ShopCartItems::where('user_id',Auth::id())->where('type','buynow')->orderBy('id','DESC')->first();
     $sum=$sum->total;
  }
	$text ='<table class="cart__totals">';
	$text .='<thead class="cart__totals-header">';
	$text .='<tr>';
	$text .='<th>Subtotal</th>';
	$text .='<td>$'.custom_format($sum,2).'</td>';
	$text .='</tr>';
	$text .='</thead>';
	$text .='<tbody class="cart__totals-body">';
	$text .='<tr>';
	$text .='<th>Service Fee</th>';
	$text .='<td><strong><span class="plus-sign">+</span>$'.custom_format($this->getServiceFee(),2).'</strong></td>';
	$text .='</tr>'; 
	     if(Session::has('shippingAddress')){
          $shipping_rate='<td><strong><span class="plus-sign">+</span>$'.custom_format($this->getShippingRate()).'</strong></td1>';
        if($this->getShippingRate()==0){
           $shipping_rate='<td><strong>Free</strong></td>';
        }
          $products=ShopCartItems::where('user_id',Auth::id())->where('type','buynow')->pluck('product_id');
          $check=Product::whereIn('id',$products)->where('shipping',0)->count();

		 	 $text.='<tr>';

      if($check!=Session::has('express_checkout') ||  !Session::has('express_checkout')){
		 	 $text.='<th>Shipping Charges</th>';
		 	 $text.=$shipping_rate;
      }

		$text .='<tr>';
		$text .='<th>Tax</th>';
		$text .='<td><strong><span class="plus-sign">+</span>  $'.custom_format($this->getTax(),2).'</strong></td></tr>';
	}
	
	$text .='</tbody>';
	$text .='<tfoot class="cart__totals-footer">';
	$text .='<tr>';
	$text .='<th>Grand Total</th>';
	$text .='<td> $'.custom_format($this->getGrandTotal(),2).'</td>';
	$text .='</tr>';
	$text .='</tfoot>';
	$text .='</table>';
		
	return $text;
}








#===================================================================================================
#===================================================================================================
#===================================================================================================

#---------------------------------------------------------------------------------------
#  get Current Order Total
#---------------------------------------------------------------------------------------


public function getServiceFee($total=null)
{
    $totalAmount = $total == null ? $this->getTotalOrder()  : $total;
    return getFee($totalAmount, 'service_fee_type', 'service_fee_amount');
}


 public function getShippingCharges($vendor,$to_address){
    $from_address=$vendor->shippingAddresses;
    \EasyPost\EasyPost::setApiKey(env('EASYPOST_API'));
    $shipment = \EasyPost\Shipment::create(array(
        "to_address" => array(
            "name"=> Auth::user()->name,
            "company"=>null,
            "street1"=>"getting rate",
            "city"=> $to_address->city,
            "state"=> $to_address->state,
            "zip"=> $to_address->zipcode,
            "country"=> $to_address->country_short_code,
            "phone"=> Auth::user()->phone_number,
            "mode"=> "test",
            "carrier_facility"=> null,
            "residential"=> "getting shipping rates",
            "email"=>Auth::user()->email,
        ),
        "from_address" => array(
            "name"=> $vendor->name,
            "company"=>null,
            "street1"=> $from_address->address,
            "street2"=> $from_address->address_2,
            "city"=> $from_address->city,
            "state"=> $from_address->state,
            "zip"=> $from_address->zipcode,
            "country"=> $from_address->country,
            "phone"=> $from_address->phone_number,
            "mode"=> "test",
            "carrier_facility"=> null,
            "residential"=> null,
            "email"=> $vendor->email,
        ),
        "parcel" => array(
          "length" => 1,
          "width" => 1,
          "height" => 1,
          "weight" => 352.74
        )
      ));
     if($to_address->zipcode){
      return $shipment->lowest_rate()->rate;
     }else{
      return 0;
     }
      
  }





}