<?php
namespace App\Traits\Registrationcheckoutproccess;
use Illuminate\Http\Request;
use App\Traits\Registrationcheckoutproccess\Ordersummary;
use App\Traits\Registrationcheckoutproccess\CheckoutPayment;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use App\UserEvent;
use App\UserEventGroup;
use App\UserEventMenu;
use App\DefaultGroup;
use App\EventRegistration;
use Srmklive\PayPal\Services\ExpressCheckout;
use Session;
use App\Models\Order;
use Spatie\CalendarLinks\Link;
use Carbon\Carbon;
use DateTime;
trait PaypalMethod {

#---------------------------------------------------------------------------------
#  comming response after paying with Stripe Method
#---------------------------------------------------------------------------------

public function payWithPaypalreg(Request $request, $event_id)
{
                               # create customer to stripe while payment
             try {
    
                           //$AccountWithPayment= $this->CommissionFeeServiceAccordingVendor('PAYPAL',1);


                            $OrderID = '#EP'.strtotime(date('y-m-d h:i:s'));
                            // $token = $request->stripeToken;
                            //$application_fee =$this->getCommissionFee();
                            $total = $this->getTotalOrderCurrent($event_id);
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
                            $data['return_url'] = route('checkout.thankyou',$event_id);
                            $data['cancel_url'] = route('homepage2');
                            $data['total'] = $total;
                      
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


public function CreateOrders(Request $request,$event_id)
{
    $provider = new ExpressCheckout;
   $response = $provider->getExpressCheckoutDetails($request->token);
        // dd($response);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
        $type ="Paypal";
         $data = $this->getBillingAddress();
         // $paymentDetails= json_encode($this->CommissionFeeServiceAccordingVendor($type,$event_id));
         $o = new \App\EventRegistration;
         // $o->user_id = Auth::user()->id;
         $o->user_event_id = $event_id;  
         $o->amount = $this->getTotalOrderCurrent($event_id);
         $o->orderID= $response['INVNUM'];
         $o->payment_by= $type;
         // $o->balance_transaction= $paymentDetails;
         $o->billing_address= json_encode($this->getBillingAddress());
         $o->status=1;

         $event_data = UserEvent::find($event_id);
         $checkgroup = UserEventGroup::where('user_event_id', $event_id)->where('user_id', $event_data->user_id)->first();
            $checkmenu = UserEventMenu::where('user_event_id', $event_id)->where('user_id', $event_data->user_id)->first();
            if(empty($checkgroup)){
              $defaultgroups = DefaultGroup::where('event_type_id', $event_data->event_type)->where('status', 1)->get();
              $record = new UserEventGroup;
            $record->user_id =$event_data->user_id;
            $record->user_event_id = $event_data->id;
            $record->group_label = 'unassigned';

            $record->save();
              if(!empty($defaultgroups[0]->id)){
                foreach($defaultgroups as $defaultgroup){
                  $record = new UserEventGroup;
                $record->user_id = $event_data->user_id;
                $record->user_event_id = $event_data->id;
                $record->group_label = $defaultgroup->group_label;

                $record->save();
              }
            }
            }

            if(empty($checkmenu)){
              $defaultmenus = array('Adults', 'Children', 'unassigned');
              for($i=0; $i<count($defaultmenus); $i++){
                $record = new UserEventMenu;
              $record->user_id = $event_data->user_id;
              $record->user_event_id = $event_data->id;
              $record->menu_label = $defaultmenus[$i];

              $record->save();
            }
            }

            $user_event_groups = UserEventGroup::where('user_id', $event_data->user_id)->where('user_event_id', $event_data->id)->first();
            $user_event_menus = UserEventMenu::where('user_id', $event_data->user_id)->where('user_event_id', $event_data->id)->first();

         $guest = new \App\UserEventGuest;
         $guest->user_id = $event_data->user_id;
         $guest->user_event_id = $event_id;
         $guest->fname = $data->name;
         $guest->email = $data->email;
         $guest->age = $data->age;
         $guest->contact_no = $data->mobile;
         $guest->gender = $data->gender;
         $guest->user_event_group_id = $user_event_groups->id;
         $guest->user_event_menu_id=$user_event_menus->id;
         $guest->attendance = 1;
         $guest->type = 1;
         $guest->save();

         if($o->save()){

              $pdf_data = '';

                    if($event_data->template_id) {

                      $event_template = EventTemplate::where('id',$event_data->template_id)->first();

                      if($event_template->template_id == 1 ) {

                        $pdf_data  = view('event_templates.event-template-1',[
                                                                                'event_data'     => $event_data,
                                                                                'event_template' => $event_template,
                                                                                'event_reg'      => $o
                                                                              ])->render();

                      } else if($event_template->template_id ==  2) {

                        $pdf_data  = view('event_templates.event-template-2',[
                                                                                'event_data'     => $event_data,
                                                                                'event_template' => $event_template,
                                                                                'event_reg'      => $o
                                                                              ])->render();

                      } else if($event_template->template_id ==  3) {

                       $pdf_data  = view('event_templates.event-template-3',[
                                                                                'event_data'     => $event_data,
                                                                                'event_template' => $event_template,
                                                                                'event_reg'      => $o
                                                                              ])->render();

                      } else if($event_template->template_id ==  4){

                         $pdf_data  = view('event_templates.event-template-4',[
                                                                                'event_data'     => $event_data,
                                                                                'event_template' => $event_template,
                                                                                'event_reg'      => $o
                                                                              ])->render();
                      }    

                    } else {

                      $pdf_data  = view('event_templates.event-template-1',[
                                                                              'event_data'     => $event_data,
                                                                              'event_template' => '',
                                                                              'event_reg'      => $o
                                                                            ])->render();
                    }
        $pdf = \App::make('dompdf.wrapper');
        $path = 'images/' .$event_data->title. '.pdf';
        $pdf->loadHTML($pdf_data)->save($path);
           $this->UserRegistrationEventTrait($path,$data->name,$data->email,$event_id);
                   Session::forget('billingAddress');
                   return redirect()->route('thank-you-payment', ['order_id' => $o->id]);
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


public function thankyou1(Request $request) {
 $order = EventRegistration::find($request->order_id);
  $event_data = UserEvent::find($order->user_event_id);
  $Starttime =  date("H:i:s", strtotime($event_data->start_time));

  $Sdate = str_replace('/', '-', $event_data->start_date);
  $start_date = date('Y-m-d', strtotime($Sdate));
  $startdDate = $start_date.' '.$Starttime;
  $Endtime =  date("H:i:s", strtotime($event_data->end_time));
  $Edate = str_replace('/', '-', $event_data->end_date);
  $end_date = date('Y-m-d', strtotime($Edate));
  $enddDate = $end_date.' '.$Endtime;
   if(empty($event_data->location))
  {
       $location = 'USA';
  }
  else{
    $location = $event_data->location;
  }
  $from = Carbon::createFromFormat('Y-m-d H:i:s', $startdDate);
  $to = Carbon::createFromFormat('Y-m-d H:i:s', $enddDate);
 
  $link = Link::create($event_data->title, $from, $to)
        ->description($event_data->description)
        ->address($location);

  // Generate a link to create an event on Google calendar
  $google =  $link->google();
  // Generate a link to create an event on Yahoo calendar
  $yahoo = $link->yahoo();
  // Generate a link to create an event on outlook.com calendar
  $outlook =  $link->webOutlook();
  // Generate a data uri for an ics file (for iCal & Outlook)
  $ics =  $link->ics();
  return view('tools.forum.thankyou')->with('google',$google)
        ->with('yahoo',$yahoo)
        ->with('outlook',$outlook)
        ->with('ics',$ics)
        ->with('order',$order);
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