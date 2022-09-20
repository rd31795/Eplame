<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;      
use App\Traits\GeneralSettingTrait;
use App\User;
use App\Coupon;
use App\UserEvent;
use App\Models\Vendors\DiscountDeal;
use App\Models\Admin\CmsPage;
use App\Category;
use App\Testimonial;
use App\NewsOffer;
use App\VendorCategory;
use Spatie\CalendarLinks\Link;
use DateTime;
use Carbon\Carbon;
use App\FAQs;
use App\RegistrationType;
use App\EventRegistration;
use App\PurchasePackageProduct;
use App\Traits\ProductCart\UserCartTrait;
use App\Traits\EmailTraits\EmailNotificationTrait;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    use RegistersUsers;
    use GeneralSettingTrait;
    use EmailNotificationTrait;
    use UserCartTrait;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function register()
    {
        if(Auth::check()){
              $url = url(route('request.messages')).'?type=logged';
              return redirect($url);
        }
        return view('auth.register2');
    }

    public function showCmsPage($slug) {
      $page = CmsPage::where('slug', $slug)->where('status',1)->firstOrFail();
      if(!empty($page))
      {
         return view('cmspage')->with('page', $page);
      }
      else{
        return view('errors/404');
      }
     
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
        if(!empty($request->test)){
            return getUserNotifications();
            return \App\User::with('newVendorsBusinessMessages','newVendorsBusinessMessages.unReadMessages')->where('id',\Auth::user()->id)->first();
        }


        $slug = 'homepage';
        $news = NewsOffer::where('type', 'news')->where('status', 1)->orderBy('updated_at', 'Desc')->get();

        $today = strtotime(date('Y-m-d'));

        $discount_deals = DiscountDeal::join('vendor_categories','vendor_categories.id','=','discount_deals.vendor_category_id')
                          ->join('categories','categories.id','=','vendor_categories.category_id')
                          ->join('users','users.id','=','vendor_categories.user_id')
                          ->select('discount_deals.*',
                            'vendor_categories.travel_distaince',
                            'vendor_categories.latitude',
                            'vendor_categories.longitude' 
                          )
                          ->where('vendor_categories.status',3)
                          ->where('vendor_categories.publish',1);

        $offers = $discount_deals->get(); 
        $offers = $offers->filter(function($d){
                    if($d->deal_life == 1 ){
                        $cDate = strtotime(date('Y-m-d'));
                        $start = strtotime($d->start_date);
                        $end = strtotime($d->expiry_date);
                        if($cDate >= $start && $cDate <= $end){
                            return $d;
                        }
                    }elseif($d->deal_life == 0){
                        return $d;
                    }                         
                });   

        $ip = request()->ip();
        $lat_lon = Location::get($ip);

        if(isset($lat_lon->latitude)){
            $lat = $lat_lon->latitude;
        }else{
            $lat = '';
        }

        if(isset($lat_lon->longitude)){
            $lon = $lat_lon->longitude;
        }else{
            $lon = '';
        }   
        
        
        // echo '<pre>';
        // print_r($lat_lon);
        // echo '</pre>';
        // die();


        $virtual_event = UserEvent::where('event',1)->where('registration','yes')
                        ->where('event_status',1)->skip(0)->take(10)
                        ->where('end_date', '>=', date('Y-m-d').' 00:00:00');

        $sqlDistance = DB::raw('( 3959 * acos( cos( radians(' . $lat . ') ) 
                            * cos( radians( latitude ) ) 
                            * cos( radians( longitude ) 
                            - radians(' . $lon  . ') ) 
                            + sin( radians(' . $lat  . ') ) 
                            * sin( radians( latitude ) ) ) )');

        $virtual_event = $virtual_event
                     ->select('*')
                     ->selectRaw("{$sqlDistance} AS distance")
                     ->orderBy('distance', 'ASC')
                     ->having('distance', '<=', 50)->get();

        // echo '<pre>';
        // print_r($virtual_event);
        // echo '</pre>';
        // die();

        // $virtual_event = $virtual_event->filter(function($d){
        //                                             $ip = request()->ip();
        //                                             $lat_lon = Location::get($ip);
                                            
        //                                             if(isset($lat_lon->latitude)){
        //                                                 $lat = $lat_lon->latitude;
        //                                             }else{
        //                                                 $lat = '';
        //                                             }
                                            
        //                                             if(isset($lat_lon->longitude)){
        //                                                 $lon = $lat_lon->longitude;
        //                                             }else{
        //                                                 $lon = '';
        //                                             }   
                                                    
        //                                             $data = DB::table("user_events")->where('id',$d->id)
        //                                             ->select("id"
        //                                                 , DB::raw("3959 * acos(cos(radians(" . $lat . ")) 
        //                                                 * cos(radians(".$d->latitude.")) 
        //                                                 * cos(radians(".$d->longitude.") - radians($lon) ) + sin( radians(" . $lat . ") )
        //                                                 * sin(radians(".$d->latitude."))) AS distance"))
        //                                                 ->first();

        //                                             if($data->distance <= 50)
        //                                             {
        //                                                 return $d;
        //                                             }           
        //                                         }); 

        
        
        $hybrid_inperson = UserEvent::whereIn('event',[0,2])->where('registration','yes')->where('event_status',1)->skip(0)->take(10)->where('end_date', '>=', date('Y-m-d').' 00:00:00');

        $sqlDistance = DB::raw('( 3959 * acos( cos( radians(' . $lat . ') ) 
                               * cos( radians( latitude ) ) 
                               * cos( radians( longitude ) 
                               - radians(' . $lon  . ') ) 
                               + sin( radians(' . $lat  . ') ) 
                               * sin( radians( latitude ) ) ) )');

        $hybrid_inperson = $hybrid_inperson
                            ->select('*')
                            ->selectRaw("{$sqlDistance} AS distance")
                            ->orderBy('distance', 'ASC')
                            ->having('distance', '<=', 50)->get();



      $categories = Category::where(['status'=> 1, 'parent'=> 0])->orderBy('label','ASC')->get();
      $testimonials = Testimonial::where('status', 1)->where('type',Testimonial::EVENTS)->orderBy('updated_at','DESC')->get();
      // $min = RegistrationType::where('event_id', $user_event->id)->min('price');
      // $max = RegistrationType::where('event_id', $user_event->id)->max('price');
      return view('home', $this->getArrayValue($slug))->with(['categories' => $categories, 'news' => $news, 'offers' => $offers, 'testimonials' => $testimonials, 'virtualEvent' => $virtual_event, 'hybridInperson' => $hybrid_inperson]);
    }

    public function events_all(Request $request){
        if($request->event_address != ''){

            $event_address = $request->event_address;
            // $response = $this->getAreaDetails($event_address);
            // $response = json_decode($response, true);
            // if(isset($response['candidates'][0]['geometry']['location'])){

            //     $location = $response['candidates'][0]['geometry']['location'];
            //     $lat = $location['lat'];
            //     $lon = $location['lng'];

            // }else{
            //     $lat = "";
            //     $lon = "";
            // }
            
        }else{

            $ip = request()->ip();
            $lat_lon = Location::get($ip);
             $country=$lat_lon->countryName;
             $countryCode=$lat_lon->countryCode;
             // $city=$lat_lon->cityName;

             //  $country="canada";

            $lat = $lat_lon->latitude;
            $lon = $lat_lon->longitude;
            $hybrid_inperson = UserEvent::whereIn('event',[0, 1, 2])->where('registration','yes')->where('event_status',1);
            $hybrid_inperson= $hybrid_inperson->where('location','like','%'.$countryCode)
               ->where('end_date', '>=', date('Y-m-d').' 00:00:00')
               ->paginate(10);
            return view('events')->with(['hybridInperson' => $hybrid_inperson]);
        }

        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // die();
          

       // DB::connection()->enableQueryLog();

        // $hybrid_inperson = UserEvent::whereIn('event',[0, 1, 2])
        //                     ->where('registration','yes')->where('event_status',1)
        //                     ->where('end_date', '>=', date('Y-m-d').' 00:00:00');

        // $sqlDistance = DB::raw('( 6371 * acos( cos( radians(' . $lat . ') ) 
        //                        * cos( radians( latitude ) ) 
        //                        * cos( radians( longitude ) 
        //                        - radians(' . $lon  . ') ) 
        //                        + sin( radians(' . $lat  . ') ) 
        //                        * sin( radians( latitude ) ) ) )');

        // $hybrid_inperson = $hybrid_inperson
        //                     ->select('*')
        //                     ->whereRaw($sqlDistance . '<= ?', [100])
        //                     ->paginate(10);
 $hybrid_inperson = UserEvent::select('user_events.*','events_package_ids.package_events')->whereIn('event',[0, 1, 2])->where('registration','yes')->where('event_status',1);
  $hybrid_inperson=$hybrid_inperson->LeftJoin('purchase_package_product',function($join)
  {
               $join->on('purchase_package_product.user_id','=','user_events.user_id')->where('purchase_package_product.package_type',2)->where('purchase_package_product.status',1);
         
  });
  $hybrid_inperson=$hybrid_inperson->LeftJoin('events_package_ids',function($join){
              $join->on('events_package_ids.package_id','purchase_package_product.id')->on('events_package_ids.package_events','=','user_events.event');
  });
   $hybrid_inperson=$hybrid_inperson->orderBy('purchase_package_product.price','DESC');
 $hybrid_inperson=$hybrid_inperson
   // ->where('location','like','%'.$address_components[count($address_components)-2]->short_name.'%')
   ->where('location','like','%'.$request->event_address.'%')
   // ->orWhere('location','like','%'.$address_components[count($address_components)-2]->long_name.'%')
   ->where('end_date', '>=', date('Y-m-d').' 00:00:00')
   ->paginate(10);


        // echo '<pre>';
        // print_r($hybrid_inperson);
        // echo '</pre>';
        // die();

       // $queries = DB::getQueryLog();
        // echo '<pre>';
        // print_r($paginate_records);
        // echo '</pre>';
        // die();
        return view('events')->with(['hybridInperson' => $hybrid_inperson]);
    }
    
    public function getAreaDetails($searhInput){

        $query_req = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?fields=formatted_address%2Cgeometry&input=".$searhInput."&inputtype=textquery&key=AIzaSyBrGKmz60iMoKfZLLQSK5LOzqHCf_TynQM"; 

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $query_req, []);
   
        $statusCode = $response->getStatusCode();
  
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody;
    }

    public function eventsearch(Request $request)
    {
  
        $latArr = [];
        $lngArr = [];
        if($request->event_address != ''){
            $event_address = $request->event_address;
            $response = $this->getAreaDetails($event_address);

            if(isset($response['candidates'][0]['geometry']['location'])){

                $location = $response['candidates'][0]['geometry']['location'];
                $lat = $location['lat'];
                $lon = $location['lng'];

                // if(count($response['candidates']) > 1){
                //     $geometry = array_column(array_column($response['candidates'], 'geometry'), 'location');

                //     $latArr = array_column('lat', $geometry);
                //     $lngArr = array_column('lng', $geometry);
                // }
            }else{
                $data = "false";
                return response()->json($data);
            }  
            
            // echo '<pre>';
            // print_r($geometry);
            // echo '</pre>';
            // die();
        }else{

            $ip = request()->ip();
            $lat_lon = Location::get($ip);
               
            $lat = $lat_lon->latitude;
            $lon = $lat_lon->longitude;
        }
$hybrid_inperson = UserEvent::select('user_events.*','events_package_ids.package_events','purchase_package_product.package_id as package_id','purchase_package_product.id as purchase_package_id')->whereIn('event',[0, 1, 2])->where('registration','yes')->where('event_status',1)->skip(0)->take(10)->where('end_date', '>=', date('Y-m-d').' 00:00:00');

if($request->current_ip){
	// $lat=$request->latitude;
	// $lon=$request->longitude;
     $ip = request()->ip();
     $lat_lon = Location::get($ip);
     $country=$lat_lon->countryName;
     $countryCode=$lat_lon->countryCode;
     $hybrid_inperson = UserEvent::whereIn('event',[0, 1, 2])->where('registration','yes')->where('event_status',1);
     $hybrid_inperson= $hybrid_inperson->where('location','like','%'.$countryCode)
               ->where('end_date', '>=', date('Y-m-d').' 00:00:00')
               ->skip(0)->take(10);
    // $sqlDistance = DB::raw('( 3959 * acos( cos( radians(' . $lat . ') ) 
    //                             * cos( radians( latitude ) ) 
    //                             * cos( radians( longitude ) 
    //                             - radians(' . $lon  . ') ) 
    //                             + sin( radians(' . $lat  . ') ) 
    //                            * sin( radians( latitude ) ) ) )');

    //     $hybrid_inperson = $hybrid_inperson
    //                         ->select('*')
    //                         ->selectRaw("{$sqlDistance} AS distance")
    //                         ->orderBy('distance', 'ASC')
    //                         ->having('distance', '<=', 50);
}else{
// 	$geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lon.'&sensor=false&key=AIzaSyDREz_0lewIpKjNrvCc_WWRdh9oeytOrm4');
// $output= json_decode($geocode);
//   $address_components=$output->results[0]->address_components;

   $hybrid_inpelonrson = $hybrid_inperson
   // ->where('location','like','%'.$address_components[count($address_components)-2]->short_name.'%')
   ->where('location','like','%'.$request->event_address.'%')
   // ->orWhere('location','like','%'.$address_components[count($address_components)-2]->long_name.'%')
   ->where('end_date', '>=', date('Y-m-d').' 00:00:00');
  } 
     
        
   //   $hybrid_inperson=$hybrid_inperson->LeftJoin('purchase_package_product', function($join)
   //                                   {
   //                                     // $check_package=PurchasePackageProduct::select('packages.*')->join('packages','packages.id','=','purchase_package_product.package_id')->where('user_id',Auth::id())->where('purchase_package_product.status',1)->where('purchase_package_product.package_type',2)->first();
   //                                      $join->on('purchase_package_product.user_id','=','user_events.user_id')->where('purchase_package_product.package_type',2)->where('purchase_package_product.status',1);
   //                                   });
   // $hybrid_inperson=$hybrid_inperson->orderBy('purchase_package_product.price','DESC');
  $hybrid_inperson=$hybrid_inperson->LeftJoin('purchase_package_product',function($join)
  {
               $join->on('purchase_package_product.user_id','=','user_events.user_id')->where('purchase_package_product.package_type',2)->where('purchase_package_product.status',1);
         
  });
  $hybrid_inperson=$hybrid_inperson->LeftJoin('events_package_ids',function($join){
              $join->on('events_package_ids.package_id','purchase_package_product.id')->on('events_package_ids.package_events','=','user_events.event');
  });
   $hybrid_inperson=$hybrid_inperson->orderBy('purchase_package_product.price','DESC');
   $hybrid_inpelonrson=$hybrid_inperson->get();
// $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lon.'&sensor=false&key=AIzaSyDREz_0lewIpKjNrvCc_WWRdh9oeytOrm4');
// $output= json_decode($geocode);
// $check=file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJ2WrMN9MDDUsRpY9Doiq3aJk&key=AIzaSyDREz_0lewIpKjNrvCc_WWRdh9oeytOrm4');
// $lat=json_decode($check)->result->geometry->location->lat;
// $lon=json_decode($check)->result->geometry->location->lng;


        // $sqlDistance = DB::raw('( 3959 * acos( cos( radians(' . $lat . ') ) 
        //                        * cos( radians( latitude ) ) 
        //                        * cos( radians( longitude ) 
        //                        - radians(' . $lon  . ') ) 
        //                        + sin( radians(' . $lat  . ') ) 
        //                        * sin( radians( latitude ) ) ) )');

        // $hybrid_inperson = $hybrid_inperson
        //                     ->select('*')
        //                     ->selectRaw("{$sqlDistance} AS distance")
        //                     ->orderBy('distance', 'ASC')
        //                     ->having('distance', '<=', 400);
       
        // echo '<pre>';
        // print_r($hybrid_inpelonrson);
        // echo '</pre>';
        // die();
        foreach($hybrid_inpelonrson as $event_detail)
        {
           
        ?>

            <div class="owl-item cloned" style="width: 270px; margin-right: 10px;">
            <div class="item">
                    <a href="<?php echo url('eventDetail/' . $event_detail->slug) ?>" target="_blank">
                        <div class="event-slide-card">
                            <figure>
                                <img src="<?php echo url('/')?>/<?php echo $event_detail->event_picture?>" class="img-fluid">
                            </figure>
                            <figcaption>
                                <h4><?php echo  $event_detail->title ?></h4>
                                <div class="event-slide-time">
                                <p><?php echo \Carbon\Carbon::parse($event_detail->start_date)->format('l') ?>,<?php echo  \Carbon\Carbon::parse($event_detail->start_date)->formatLocalized('%b') ?> <?php echo \Carbon\Carbon::parse($event_detail->start_date)->formatLocalized('%d') ?>, <?php echo \Carbon\Carbon::parse($event_detail->start_time)->format('g:i A') ?></p> 
                                </div>
                                
                                <div class="content">
                                    <?php if(empty($event_detail->location)){   ?>
                                    <p>Online - Anywhere w/Fast Wifi and Sound</p>
                                <?php }else{ ?>
                                    <p><?php echo $event_detail->location?></p>
                                <?php } ?>
                                </div>
                            </figcaption>
                            <div class="content">
                               <?php if(!empty($event_detail->package_events)){ ?>
                                     <h3>Sponsered</h3>
                               <?php  } ?>
                                </div>
                        </div>
                    </a>
                    <!-- card end -->
                </div>
            </div>
        <?php 
        }
            
     
    }


    #---------------------------------------------------------------------
    # ajax register
    #----------------------------------------------------------------------


    public function userRegisterUpdate(Request $request,$token)
    {

            $v= \Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'id_proof' => ['required', 'image']
                
            ],[
                'id_proof.image' => 'Please upload image format of document'
            ]);


            $user = User::where('role','vendor')
                    ->where('custom_token',$token);
                        


    
            if($v->fails()){
                return response()->json(['status' => 0,'errors' => $v->errors()]);
            }elseif($user->count() == 0){
                return response()->json(['status' => 0,'errors' => ['Token has been Expired.']]);
            }else{
                
                $status = $this->updateAccount($request,$user->first());
                $url = url(route('request.messages')).'?type=account-updated';
                return response()->json([
                    'status' => 8,
                    'redirectLink' => $url
                ]);

            }
    }




    #---------------------------------------------------------------------
    # ajax register
    #----------------------------------------------------------------------

    public function updateAccount($request,$u)
    {
        $id_proof = uploadFileWithAjax('videos/vendors/cover/',$request->file('id_proof'));
        
        $u->first_name = $request->first_name;
        $u->last_name = $request->last_name;
        $u->name = $request->first_name.' '.$request->last_name;
        $u->phone_number = $request->phone_number;
        $u->user_location = $request->location;
        $u->website_url = $request->website_url;
        $u->ein_bs_number = $request->ein_bs_number;
        $u->age = Carbon::parse($request->age)->format('Y-m-d');
        $u->id_proof = $id_proof;
        $u->status = 1;
        $u->status = 0;
        $u->custom_token = null;
        $u->updated_status = 1;
        if($u->save()) {

            $this->NewVendorEmailSuccess($u);
            return 1;
        }
    }


    #---------------------------------------------------------------------
    # ajax register
    #----------------------------------------------------------------------


    public function userRegister(Request $request)
    {
            

            if(!empty($request->type)){
                    $v= \Validator::make($request->all(), [
                        'first_name' => ['required', 'string', 'max:255'],
                        'last_name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        
                        'password' => ['required', 'string', 'min:6'],
                        'password' => ['required','min:6','confirmed']
                    
                    ]);
                }else{
                        $v= \Validator::make($request->all(), [
                        'first_name' => ['required', 'string', 'max:255'],
                        'last_name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'profile_image' => ['required'],
                        'password' => ['required', 'string', 'min:6'],
                        'password' => ['required','min:6','confirmed']
                        
                    ]);
                }


            // print_r($request->all());
            // die;

            if($v->fails()){
                return response()->json(['status' => 0,'errors' => $v->errors()]);
            }else{

                if(!empty($request->type)){
                $status = $this->saveNewVendor($request);
                }else{
                $status = $this->saveNewUser($request,'user');
                }
            

                return response()->json(['status' => 1,'message' => 'We sent you an activation code. Check your Email and click on the link to verify.']);

            }
    }






    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------


    public function saveNewVendor($request)
    {


        $id_proof = uploadFileWithAjax('videos/vendors/cover/',$request->file('id_proof'));
        $u = new \App\User;
        $u->first_name = $request->first_name;
        $u->last_name = $request->last_name;
        $u->name = $request->first_name.' '.$request->last_name;
        $u->email = $request->email;
        $u->user_location = $request->user_location;
        $u->phone_number = $request->phone_number;
        $u->user_location = $request->location;
        $u->latitude = $request->latitude;
        $u->longitude = $request->longitude;
        $u->website_url = $request->website_url;
        $u->ein_bs_number = $request->ein_bs_number;
        $u->age = Carbon::parse($request->age)->format('Y-m-d');
        $u->id_proof = $id_proof;
        $u->refer_data = $this->getReferAccount($request);
        $u->status = 1;
        $u->vendor_status = 0;
        $u->role = 'vendor';
        $u->password = \Hash::make($request->password);
        if($u->save() && $this->addBusinessCategories($request,$u->id) == 1) {

            $u->sendEmailVerificationNotification();
            $this->NewVendorEmailSuccess($u);
            return 1;
        }

    }

    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------

    public function getReferAccount($request)
    {
        if(!empty($request->reference_business_name)):
            $category = \App\Category::where('id',$request->business_type);

            $arr = [
                'reference_business_name' => $request->reference_business_name,
                'reference_email' => $request->reference_email,
                'reference_contact_number' => $request->reference_contact_number
            ];
            
            return json_encode($arr);
        endif;
    }

    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------


    public function addBusinessCategories($request,$user_id)
    {
        foreach ($request->categories as $key => $value) {
            
            $parent = $this->categorySave($value,0,$user_id);
        }
        return 1;
    }



    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------



    public function categorySave($value,$parent=0,$user_id)
    {
            $v= VendorCategory::where('parent',$parent)->where('category_id',$value)->where('user_id',$user_id);
            $id = 0;
            if($v->count() == 0){
                $vCate = new VendorCategory;
                $vCate->parent = $parent;
                $vCate->category_id = $value;
                $vCate->user_id = $user_id;
                $vCate->status = 1;
                $vCate->save();
                $id = $vCate->id;

            }else{
                $category = $v->first();
                $id = $category->id;
            }
            return $id;
    }

    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------


    public function saveNewUser($request, $role="user")
    { 
        if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $filename);
        }

        $user = new User;
        $path = 'images/vendors/profile/';  
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->profile_image = $path.$filename;
        $user->role = $role;
        $user->vendor_status = 0;
        $user->status = 1;
        $user->password = \Hash::make($request->password);
        $coupon = Coupon::where('id', 3)->first();

        if($user->save()){
        $user->sendEmailVerificationNotification();
        $this->SignupCouponCodeTrait($user,$coupon);
        return 1;
        }
    }





    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------


    public function userLogin(Request $request,$role="user")
    {
        $v= \Validator::make($request->all(), [
            
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
                
            ]);

            if($v->fails()){
                return response()->json(['status' => 0,'errors' => $v->errors()]);
            }else{

                $role = $this->login($request);
                return response()->json($role);

            }
    }


    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------


    public function userLoginPopup(Request $request, $role="user")
    {
        $v= \Validator::make($request->all(), [
            
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
                
            ]);

            if($v->fails()){
                return response()->json(['status' => 0,'errors' => $v->errors()]);
            }else{

                        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'user']))
                        {
                                if(Auth::check() && Auth::user()->email_verified_at){
                                if(Auth::user()->status == 1):


                                        $arr = [
                                                'status' => 1,
                                                'message' => 'Please wait... Redirecting to your dashboard.',
                                                'redirectLink' => url(route('user_dashboard')),
                                                'users' => Auth::user(),
                                                'upcoming_events' => Auth::user()->UpcomingUserEvents
                                            ];
                                    else:

                                        Auth::logout();
                                        
                                            $arr = [
                                                'status' => 2,
                                                'message' => 'Your account is blocked by the Admin.'
                                            
                                            ];

                                    endif;

                                } else {

                                Auth::logout();
                                
                                    $arr = [
                                        'status' => 2,
                                        'message' => 'Your account is not verified yet.'
                                    
                                    ];
                                }

                    }elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'vendor']))
                        {
                                if(Auth::check() && Auth::user()->email_verified_at){
                                if(Auth::user()->status == 1):
                                        $arr = [
                                                'status' => 1,
                                                'message' => 'Please wait... Redirecting to your dashboard.',
                                                'redirectLink' => url(route('user_dashboard')),
                                                'users' => Auth::user(),
                                                'upcoming_events' => Auth::user()->UpcomingUserEvents
                                            ];
                                    else:

                                        Auth::logout();
                                        
                                            $arr = [
                                                'status' => 2,
                                                'message' => 'Your account is blocked by the Admin.'
                                            
                                            ];

                                    endif;

                                } else {

                                Auth::logout();
                                
                                    $arr = [
                                        'status' => 2,
                                        'message' => 'Your account is not verified yet.'
                                    
                                    ];
                                }

                    }

                        else {
                        
                            $arr = [
                                'status' => 2,
                                'message' => 'Invalid Email | Password'
                                
                            ];
                    }
                return response()->json($arr);

            }
    }

    #-----------------------------------------------------------------------
    #  save new user
    #-----------------------------------------------------------------------


    public function login($request)
    {
        $arr =[];
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'vendor']))
            {

            // return Auth::user();
                if(Auth::check() && Auth::user()->email_verified_at){

                                    if(Auth::user()->status == 1):

                                        if(Auth::user()->vendor_status == 1):
                                            if(Auth::user()->vendor_active == 1):
                                                    $u = User::find(Auth::user()->id);
                                                    $u->login_count = ($u->login_count + 1);
                                                    /*$u->user_active = 1;*/
                                                    $u->save();
                                                    

                                                $arr = [
                                                            'status' => 1,
                                                            'message' => 'Please wait... Redirecting to your dashboard.',
                                                            'redirectLink' => url(route('vendor_dashboard'))
                                                        ];
                                            elseif(Auth::user()->user_active == 1):
                                                $arr = [
                                                    'status' => 1,
                                                    'message' => 'Please wait... Redirecting to your dashboard.',
                                                    'redirectLink' => url(route('user_dashboard'))
                                                    ];

                                            else:
                                                    $u = User::find(Auth::user()->id);
                                                    $u->user_active = 1;
                                                    $u->vendor_active = 1;
                                                    $u->save();
                                                    $arr = [
                                                            'status' => 1,
                                                            'message' => 'Please wait... Redirecting to your dashboard.',
                                                            'redirectLink' => url(route('vendor_dashboard'))
                                                        ];
                                            endif;
                                        else:
                                            
                                            $arr = [
                                                'status' => 1,
                                                'message' => 'Your vendor profile is under verification process. We are redireting you to the user profile',
                                                'redirectLink' => url(route('user_dashboard'))
                                            ];
                                        endif;
                                    else:

                                                
                                                Auth::logout();
                                                $arr = [
                                                    'status' => 2,
                                                    'message' => 'Your account is under verification process.',
                                                    'redirectLink' => url(route('vendor_dashboard'))
                                                ];

                                    endif;
                    
                    

                
                }else{
                Auth::logout();
                

                    $arr = [
                        'status' => 2,
                        'message' => 'Your account is not verified yet.',
                        'redirectLink' => url(route('vendor_dashboard'))
                    ];
                }

            }elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin']))
            {
                
                    $arr = [
                        'status' => 1,
                        'message' => 'Please wait... Redirecting to your dashboard.',
                        'redirectLink' => url(route('admin_dashboard'))
                    ];

            }elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'subadmin']))
            {
                
                    $arr = [
                        'status' => 1,
                        'message' => 'Please wait... Redirecting to your dashboard.',
                        'redirectLink' => url(route('admin_dashboard'))
                    ];

            }elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'user']))
            {

            
                if(Auth::check() && Auth::user()->email_verified_at){

                            $url = !empty($request->redirectLink) ? $request->redirectLink : url(route('user_dashboard'));

                

                                if(Auth::user()->status == 1):
                                            $u= User::find(Auth::user()->id);
                                            $u->user_active = 1;
                                            $u->save();
                                                $this->TransferCartItemToUserTable();
                                                $arr = [
                                                    'status' => 1,
                                                    'message' => 'Please wait... Redirecting to your dashboard.',
                                                    'redirectLink' => $url
                                                ];
                                    else:

                                                Auth::logout();
                                                $arr = [
                                                    'status' => 2,
                                                    'message' => 'Your account is blocked by the Admin.',
                                                    'redirectLink' =>  $url
                                                ];

                                    endif;



                } else {

                Auth::logout();
                
                    $arr = [
                        'status' => 2,
                        'message' => 'Your account is not verified yet.'
                    
                    ];
                }

            } else {
            
                $arr = [
                        'status' => 2,
                        'message' => 'Invalid Email | Password'
                    
                    ];
            }

            return $arr;
    }







    #-------------------------------------------------------------------------
    #
    #-----------------------------------------------------------------------



    public function requestMessages(Request $request)
    {
        $type = !empty($request->type) ? $request->type : 1;
        return view('auth.requestMessages')
            ->with('type',$type);
    }


    #-------------------------------------------------------------------------
    #
    #-----------------------------------------------------------------------



    public function about()
    {


    

        return view('home.cms.about_us');
    }



    #-------------------------------------------------------------------------
    #
    #-----------------------------------------------------------------------



    public function contact()
    {
        return view('home.cms.contact_us');
    }
    public function contactsend(Request $request)
    {
    $validatedData = $request->validate([
                'firstname' => ['required'],
                'lastname' => ['required'],
                'email' =>['required', 'string', 'email', 'max:255'],
                'phone' =>['required','numeric'],
                'message' => ['required'],
            
            ]);
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $name = $firstname.' '.$lastname;
        $email = $request->email;
        $phone = $request->phone;
        $message = $request->message;
        $this->ContactTrait($name,$email,$phone,$message);

    return redirect()->route('home.cms.contact_us')->with('flash_message', 'Message has been sent successfully!');
    }


    
    #-------------------------------------------------------------------------
    # email for email template testing
    #-----------------------------------------------------------------------



    public function email()
    {
    return $this->VendorOrderSuccessOrderSuccess(11);
                $o = \App\Models\Order::find(10);
                $order = \App\Models\EventOrder::where('order_id',$o->id)
                                //->where('vendor_id',35)
                                    ->where('type','order')->get();
        return view('emails.customEmail')->with('order',$order)->with('o',$o);
    }

    #-------------------------------------------------------------------------
    # email for email template testing
    #-----------------------------------------------------------------------


    public function faq() {
        $faqs = FAQs::whereIn('type', ['user', 'vendor'])->get();
        return view('home.faq.faq')->with(['faqs' => $faqs]);
    }

    #-------------------------------------------------------------------------
    # email for email template testing
    #-----------------------------------------------------------------------



    public function vendorUpdate($token)
    {
    $user = User::where('role','vendor')
                    ->where('custom_token',$token);
    if($user->count() == 0){
        return redirect(route('request.messages').'?type=token-expired');
    }
    
    return view('auth.updateVendor')->with('user',$user->first());
    }

    public function postFeedback(Request $request){
        if(!empty($request->summary)){
            $name = $request->name;
            $email = $request->email;
            $summary = $request->summary;
            $this->AdminFeedbackTrait($name, $email, $summary);
            return 101;
        }
    }

    public function reportBug(Request $request){
        if(!empty($request->summary)){
            $name = $request->name;
            $email = $request->email;
            $summary = $request->summary;
            $full_url = '';
            if($request->hasFile('attachment')){
            $path = 'images/';
            $url = uploadFileWithAjax($path, $request->file('attachment'));
            $full_url = url('/').'/'.$url;
            }
            $this->AdminBugTrait($name, $email, $summary, $full_url);
            return 101;
        }
    }

    public function requestFeature(Request $request){
        if(!empty($request->requirements)){
            $name = $request->name;
            $email = $request->email;
            $requirements = $request->requirements;
            $solution = $request->solution;
            $comp_summary = $request->comp_summary;
            $this->RequestFeatureTrait($name, $email, $requirements, $solution, $comp_summary);
            return 101;
        }
    }
    public function eventDetail($slug)
    {
        $user_event = UserEvent::FindBySlugOrFail($slug);
        $Starttime =  date("H:i:s", strtotime($user_event->start_time));

        $Sdate = str_replace('/', '-', $user_event->start_date);
        $start_date = date('Y-m-d', strtotime($Sdate));
        $startdDate = $start_date.' '.$Starttime;
        $Endtime =  date("H:i:s", strtotime($user_event->end_time));
        $Edate = str_replace('/', '-', $user_event->end_date);
        $end_date = date('Y-m-d', strtotime($Edate));
        $enddDate = $end_date.' '.$Endtime;
        
        if(empty($user_event->location))
        {
            $location = 'USA';
        }else{
            $location = $user_event->location;
        }
        
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $startdDate);
        $to = Carbon::createFromFormat('Y-m-d H:i:s', $enddDate);
        
        $link = Link::create($user_event->title, $from, $to)
                ->description($user_event->description)
                ->address($location);

        // Generate a link to create an event on Google calendar
        $google =  $link->google();
        // Generate a link to create an event on Yahoo calendar
        $yahoo = $link->yahoo();
        // Generate a link to create an event on outlook.com calendar
        $outlook =  $link->webOutlook();
        // Generate a data uri for an ics file (for iCal & Outlook)
        $ics =  $link->ics();

        $virtual_event = UserEvent::where('event', 1)->where('event_status',1)->get();
        $virtual_event = $virtual_event->filter(function($d){
                            $cDate = strtotime(date('Y-m-d'));
                            $end = strtotime($d->end_date);
                            if($cDate <= $end){
                                return $d;
                            }
                                            
                        }); 
        
        $hybrid_inperson = UserEvent::whereIn('event',[0,2])->where('event_status',1)->get();

        $ip = request()->ip();
        $lat_lon = \Location::get($ip); 
        $lat = $lat_lon->latitude;
        $lon = $lat_lon->longitude;

        $hybrid_inperson = $hybrid_inperson->filter(function($d) use($lat,$lon){
                $cDate = strtotime(date('Y-m-d'));
                $end = strtotime($d->end_date);
                 $dLatitude=$d->latitude;
                 $dLongitude=$d->longitude;
                if($cDate <= $end){
                    if($dLatitude!="" && $dLongitude!= ""){
                        $data = DB::table("user_events")->where('id',$d->id)
                ->select("id"
                    ,DB::raw("6371 * acos( 
                     cos (radians($lat)) 
                    * cos(radians($dLatitude)) 
                    * cos(radians($dLongitude) - radians($lon)) 
                    + sin(radians($lat)) 
                    * sin(radians($dLatitude)) 
                ) AS distance"))
                    ->first();
                     if($data->distance <= 80)
                    {
                    return $d;
                    }
                    }
                
                   
                    
                }
                                
        }); 
        $event_count=EventRegistration::where('user_event_id', $user_event->id)->count();
        $min = RegistrationType::where('event_id', $user_event->id)->min('price');
        $max = RegistrationType::where('event_id', $user_event->id)->max('price');
        $user_data =User::where('id', $user_event->user_id)->first();

            return view('home.includes.event_details')->with('google',$google)
            ->with('yahoo',$yahoo)
            ->with('outlook',$outlook)
            ->with('ics',$ics)->with('user_event', $user_event)->with('virtualEvent', $virtual_event)->with('hybridInperson', $hybrid_inperson)->with('user_data', $user_data)->with('min', $min)->with('max', $max)->with('event_count',$event_count);
    }



  public function  getLocation(request $request){
     $ip = request()->ip();
     $location = Location::get($ip);
    return $location;
  }


}
