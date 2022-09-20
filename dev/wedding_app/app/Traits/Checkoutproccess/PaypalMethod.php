<?php
namespace App\Traits\Checkoutproccess;
use Illuminate\Http\Request;
use App\Traits\Checkoutproccess\Ordersummary;
use App\Traits\Checkoutproccess\CheckoutPayment;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use Srmklive\PayPal\Services\ExpressCheckout;
use Session;
use App\Models\Order;
trait PaypalMethod {

#---------------------------------------------------------------------------------
#  comming response after paying with Stripe Method
#---------------------------------------------------------------------------------

public function payWithPaypal()
{
                               # create customer to stripe while payment
             try {
    
                           $AccountWithPayment= $this->CommissionFeeServiceAccordingVendor('PAYPAL',1);


                            $OrderID = '#EP'.strtotime(date('y-m-d h:i:s'));
                            // $token = $request->stripeToken;
                            $application_fee =$this->getCommissionFee();
                            $total = $this->getTotalOrderCurrent();
                            $description = 'Customer for pay for '.$OrderID;
                            $data = [];
                            $data['items'] = [
                                [
                                    'name' => 'Eplame',
                                    'price' => $total,
                                    'desc'  => $description,
                                    'qty' => 1
                                ]
                            ];
                      
                            $data['invoice_id'] = $OrderID;
                            $data['invoice_description'] = "Order {$data['invoice_id']} Invoice";
                            $data['return_url'] = route('checkouts.thankyou');
                            $data['cancel_url'] = route('checkout.billingAdress');
                            $data['total'] = 0.01;
                      
                            $provider = new ExpressCheckout;
                      
                            $response = $provider->setExpressCheckout($data);
                      
                            $response = $provider->setExpressCheckout($data, true);
                            return redirect($response['paypal_link']);
                        
                     
         } catch (Exception $e) {
             echo 'Caught exception: ',  $e->getMessage(), "\n";
         }
     
}
 
#--------------------------------------------------------------------------------------------
# save Data In EventOrder
#--------------------------------------------------------------------------------------------

// public function saveDataInEventOrder1($charge,$type,$OrderID)
// {
//        $order = $this->getCurentOrders();
      
//        return $this->CreateOrder1($charge,$OrderID,$type);

 
// }

#--------------------------------------------------------------------------------------------
# save Data In EventOrder
#--------------------------------------------------------------------------------------------


public function CreateOrders(Request $request)
{
    $provider = new ExpressCheckout;
   $response = $provider->getExpressCheckoutDetails($request->token);
        // dd($response);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
         $order = $this->getCurentOrders();
        $type ="Paypal";
         $paymentDetails= json_encode($this->CommissionFeeServiceAccordingVendor($type));
         $o = new \App\Models\Order;
         $o->user_id = Auth::user()->id;
         $o->amount = $this->getTotalOrderCurrent();
         $o->orderID=$response['INVNUM'];
         $o->payment_by= $type;
         $o->balance_transaction= $paymentDetails;
         $o->billing_address= json_encode($this->getBillingAddress());
         $o->status=1;
         if($o->save()){

             // $orders = $order->update([
             //    'payment_type' => $type,
             //    'payment_status' => 1,
             //    'payment_data' => json_encode($charge),
             //    'type' => 'order',
             //    'paymentDetails' => $paymentDetails,
             //    'OrderID' => $OrderID,
             //    'order_id' => $o->id,
             //  ]);
            if($this->updateToOrderItemToOrder1($type,$response,$paymentDetails,$o,$order) && $this->userOrderSuccessOrderSuccess($o->id) == 1){
                   Session::forget('billingAddress');
                   $this->VendorOrderSuccessOrderSuccess($o->id);
                   $this->AdminOrderSuccessOrderSuccess($o->id);
                   return redirect()->route('thank-you-payments', ['order_id' => $o->id]);
                   
             }

         }
    }

}


public function updateToOrderItemToOrder1($type,$response,$paymentDetails,$o,$order)
{
   
   foreach ($order->get() as $or) {
          $or->payment_type = $type;
          $or->payment_status = 1;
          $or->payment_data = json_encode($response);
          $or->type = 'order';
          $or->paymentDetails = $paymentDetails;
          $or->OrderID = $o->orderID;
          $or->order_id = $o->id;
          $or->save();
   }
   return true;
}

#--------------------------------------------------------------------------------------------
# save Data In EventOrder
#--------------------------------------------------------------------------------------------


public function thankyous(Request $request) {
 $order = Order::find($request->order_id);
 return view('users.checkout.thankyou')->with('order',$order);
}
public function stripeorder1(Request $request)
{    
    if(isset($_POST['stipe_payment_btn']))
    {
        $vendor_id = $request->get('vendor_id');
        $stripe_id = $request->get('stripe');
        $stripetoken = $request->input('stripeToken');
        $amount = $_POST['stipe_payment_btn'];
        $stripe = SripeAccount();
        \Stripe\Stripe::setApiKey($stripe['sk']);
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'USD',
            'description' => "Send to Vendor",
            'source' => $stripetoken,
            'destination' => $stripe_id,
        ]);
      if($charge->paid==true){
         return response('Payment has been successfull');
 
      }else{
         return response('Some Error Occured!!');
      }
    }
}

}