<?php
namespace App\Traits\Registrationcheckoutproccess;
use Illuminate\Http\Request;
use App\Traits\Registrationcheckoutproccess\Ordersummary;
use App\Traits\Registrationcheckoutproccess\CheckoutPayment;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\EventRegistration;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use App\UserEvent;
use App\UserEventGroup;
use App\UserEventMenu;
use App\DefaultGroup;
use Session;
use App\RegistrationType;
use Spatie\CalendarLinks\Link;
use Carbon\Carbon;
use DateTime;
use PDF;
use Illuminate\Support\Facades\Storage;
use App\EventTemplate;
trait StripeMethod {





#---------------------------------------------------------------------------------
#  comming response after paying with Stripe Method
#---------------------------------------------------------------------------------

public function payWithStripereg(Request $request, $event_id)
{
  
     $error = '';
     if(empty($request->stripeToken)):
         $error .= '<li>Stripe token Expired!</li>';
     else:
                 
                       # create customer to stripe while payment
             try {
    
                           // $AccountWithPayment= $this->CommissionFeeServiceAccordingVendor('STRIPE',1,$event_id);


                            $OrderID = '#EP'.strtotime(date('y-m-d h:i:s'));
                            $token = $request->stripeToken;
                            //$application_fee =$this->getCommissionFee();
                            $total = $this->getTotalOrderCurrent($event_id);
                            $description = 'Customer for pay for '.$OrderID;
                            $charge = \Stripe\Charge::create([
                              "amount" => ($total * 100),
                              "currency" => "usd",
                              "source" => $request->stripeToken,
                              //"shipping" => $shipping,
                              "description" => $description,
                              //"application_fee" => $application_fee,
                              ]);

                              if($charge){

                                    return $this->saveDataInEventOrder($charge,'STRIPE',$OrderID,$event_id);
                              }else{
                                      $error .= '<li><b>Payment Failed</b> Something Wrong going on!</li>';
                              } 

                        
                     
         } catch (Exception $e) {
             echo 'Caught exception: ',  $e->getMessage(), "\n";
         }


       

	   endif; 

     return $error;
     
}
 
#--------------------------------------------------------------------------------------------
# save Data In EventOrder
#--------------------------------------------------------------------------------------------

public function saveDataInEventOrder($charge,$type,$OrderID,$event_id)
{
       $order = $this->getCurentOrders($event_id);
      
       return $this->CreateOrder($charge,$OrderID,$type,$event_id);

 
}

#--------------------------------------------------------------------------------------------
# save Data In EventOrder
#--------------------------------------------------------------------------------------------


public function CreateOrder($charge,$OrderID,$type,$event_id)
{
   $order = $this->getCurentOrders($event_id);
   $data = $this->getBillingAddress();

   $seats_assigned=$data->quantity;
   // $paymentDetails= json_encode($this->CommissionFeeServiceAccordingVendor($type,$event_id));
   $o = new \App\EventRegistration;
   // $o->user_id = Auth::user()->id;
   $o->user_event_id = $event_id;  
   $o->amount = $this->getTotalOrderCurrent($event_id);
   $o->orderID= $OrderID;
   $o->reg_id=$data->reg_id;
   $o->seats=$seats_assigned;
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

   if($o->save())
   {

      $registration_type=RegistrationType::find($data->reg_id);
      $occupied_seats=$registration_type->occupied_seats+$seats_assigned;
      $registration_type->occupied_seats=$occupied_seats;
      $registration_type->available_seats=$registration_type->seats-$occupied_seats;
      $registration_type->save();


      $start_day = \Carbon\Carbon::parse($event_data->start_date)->format('l');
      $start_month =  \Carbon\Carbon::parse($event_data->start_date)->formatLocalized('%b');
      $start_date = \Carbon\Carbon::parse($event_data->start_date)->formatLocalized('%d');
      $start_year = \Carbon\Carbon::parse($event_data->start_date)->formatLocalized('%Y');
      $start_time =  \Carbon\Carbon::parse($event_data->start_time)->format('g:i A');
      if($event_data->location == ''){
        $address = 'Online - Anywhere w/Fast Wifi and Sound, USA';
      }else{
         $address = $event_data->location;
      }
      
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
        } else if($event_template->template_id ==  5){

          $pdf_data  = view('event_templates.event-template-5',[
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
      $this->UserRegistrationEventTrait($path,$data->name,$data->email,$event_id,$o->id);
      Session::forget('billingAddress');
      return redirect()->route('registration.thank-you', ['order_id' => $o->id]);
   }
}
public function freePayment($event_id)
{
   $order = $this->getCurentOrders($event_id);
   $data = $this->getBillingAddress();
   $OrderID = '#EP'.strtotime(date('y-m-d h:i:s'));
   $o = new \App\EventRegistration;
   // $o->user_id = Auth::user()->id;
   $o->user_event_id = $event_id;  
   $o->amount = 0;
   $o->orderID= $OrderID;
   $o->payment_by= 'Free';
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

               $template=EventTemplate::where('id',$event_data->template_id)->first();
               $pdf_data  = view('event_templates.event-template-3',[
                                                                        'event_data'     => $event_data,
                                                                        'event_template' => $event_template,
                                                                        'event_reg'      => $o,
                                                                        'template'       => $template
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
      $this->UserRegistrationEventTrait($path,$data->name,$data->email,$event_id,$o->id);
      // if($this->updateToOrderItemToOrder($type,$charge,$paymentDetails,$o,$order) && $this->userOrderSuccessOrderSuccess($o->id) == 1){
      // if($this->updateToOrderItemToOrder($type,$charge,$o,$order)){
             Session::forget('billingAddress');
             // $this->VendorOrderSuccessOrderSuccess($o->id);
             // $this->AdminOrderSuccessOrderSuccess($o->id);
             return redirect()->route('registration.thank-you', ['order_id' => $o->id]);
      // }

   }
}

// public function updateToOrderItemToOrder($type,$charge,$o,$order)
// {
   
//    foreach ($order->get() as $or) {
//           $or->payment_type = $type;
//           $or->payment_status = 1;
//           $or->payment_data = json_encode($charge);
//           $or->type = 'order';
//           // $or->paymentDetails = $paymentDetails;
//           $or->OrderID = $o->orderID;
//           $or->order_id = $o->id;
//           $or->save();
//    }
//    return true;
// }

#--------------------------------------------------------------------------------------------
# save Data In EventOrder
#--------------------------------------------------------------------------------------------


public function thankyou(Request $request) {
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
public function stripeorder(Request $request)
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
public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:sO');
        } catch (\Exception $e) {

            return '';
        }
    }

}