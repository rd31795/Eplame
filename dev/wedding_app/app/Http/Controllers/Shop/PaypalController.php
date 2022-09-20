<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\EventOrder;
use App\Models\Shop\ShopCartItems;
use App\Models\Vendors\DiscountDeal;
use App\Models\Shop\ShopOrder;
use App\Models\Products\Product;
use App\User;
use App\Traits\ShopCheckout\PaymentStepTrait;
use App\Traits\ShopCheckout\TotalOrderCalulationTrait;
use App\Traits\ShopCheckout\ShopCheckoutShippingTrait;
use Session;
class PaypalController extends Controller
{
    use ShopCheckoutShippingTrait;
    public function handlePayment()
    {

        $cart = ShopCartItems::where('user_id', Auth::user()->id)->where('type','cart')
							->get();
      
        // echo '<pre>';
        // print_r($cart);
        // echo '<pre>';
        // die();
        $product['items'] = [];
        $final_price = 0;
        foreach($cart as $cart_item){
            $productData = \App\Models\Products\Product::where('id', $cart_item->product_id)->first();
           // echo '<pre>'; print_r($product); echo '</pre>'; die();

            $cartItem = [];
            $cartItem['name'] = $productData->name;
            $cartItem['price'] = $productData->final_price;
            $cartItem['desc'] = $productData->short_description;
            $cartItem['qty'] = $cart_item->quantity;
            $final_price = $final_price + $productData->final_price;

            $product['items'][] = $cartItem;
        }
        // echo '<pre>'; print_r($product); echo '</pre>'; die();
        if($this->getShippingRate()>0){
             $shipping_price=[];
             $shipping_price['name']='Shipping Charges';
             $shipping_price['price']=$this->getShippingRate();
             $shipping_price['desc']="extra shipping charges";
             $shipping_price['qty']=1;
             array_push($product['items'], $shipping_price);
             $final_price=$final_price+$this->getShippingRate();
        } 

        $product['invoice_id'] = time();
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('shop.checkout.paypal.success.payment');
        $product['cancel_url'] = route('shop.checkout.paypal.cancel.payment');
        $product['total'] = $final_price;
        $paypalModule = new ExpressCheckout;
        $res = $paypalModule->setExpressCheckout($product, true);
        return redirect($res['paypal_link']);
    }
   
    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }
  
    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // echo '<pre>'; print_r($request->all()); echo '</pre>';
            // echo '<pre>'; print_r($response); echo '</pre>';
            // dd('Payment was successfull. The payment success page goes here!');

            $OrderID = '#EPSHOP'.strtotime(date('y-m-d h:i:s'));

            return $this->saveDataInShopOrder($response, 'PAYPAL', $OrderID);
        }else{
            
        }
  
        //dd('Error occured!');
    }
public function getShippingRate(){
    if(Session::has('shippingAddress')){
     $products=Auth::user()->ShopProductCartItems->pluck('product_id');
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

    #--------------------------------------------------------------------------------------------
    # save Data In EventOrder
    #--------------------------------------------------------------------------------------------

    public function saveDataInShopOrder($response, $type, $OrderID)
    {        
        return $this->CreateOrder($response, $OrderID, $type);
    }

    #--------------------------------------------------------------------------------------------
    # save Data In EventOrder
    #--------------------------------------------------------------------------------------------


    public function CreateOrder($response, $OrderID, $type)
    {
    
        $paymentDetails= json_encode($this->CommissionFeeServiceAccordingVendor($type));
        $o = new ShopOrder;
        $o->orderID=$OrderID;
        $o->user_id =Auth::user()->id;
        $o->shipping_address = json_encode($this->getBillingAddress());
        $o->billing_address = json_encode($this->getShippingAddress());
        $o->payment_detail=json_encode($response);
        $o->balance_transaction= $paymentDetails;
        $o->amount=$this->getGrandTotal();
        $o->payment_by=$type;
        $o->status=1;

        if($o->save()){
            if(Auth::user()->createOrderFromCart($o)){
                $to_address=json_decode(Session::get('shippingAddress'));
                Session::forget('shippingAddress');
                Session::forget('shopBillingAddress');
                $this->ShopProductOrderPlacedForVendorSuccess($o->id);
                $this->ShopProductOrderPlacedSuccess($o->id);
                // $this->AdminOrderSuccessOrderSuccess($o->id);
                $vendor=ShopCartItems::whereOrderId($o->id)->first();
                $this->shipping($vendor->vendor,$vendor->shop,$vendor->product,$to_address);
                return redirect()->route('shop.checkout.thankyou', ['order_id' => $o->id]);
            }
        }
    }


    #--------------------------------------------------------------------------------------------
    # save Data In EventOrder
    #--------------------------------------------------------------------------------------------


    public function thankyou(Request $request) {
        $order = ShopOrder::find($request->order_id);
        return view($this->filePath.'thankyou')->with('order',$order);
    }
}
