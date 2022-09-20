<?php

namespace App\Http\Controllers\Users;

require '/var/www/html/dev/wedding_app/vendor/autoload.php';
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Traits\ZoomJWT;
use App\Event;
use App\UserEvent;
use App\UserEventPerson;
use App\EventTemplate;
use App\CategoryVariation;
use App\Category;
use App\UserEventMetaData;
use App\Models\Order;
use App\User;
use App\RegistrationType;
use App\EventTicket;
use Auth;
use App\Traits\EmailTraits\EmailNotificationTrait;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Carbon\Carbon;
class PopUpStepController extends Controller
{

    use ZoomJWT;
    use EmailNotificationTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;




public function saveEventFromPopup(Request $request)
{
       
    // echo '<pre>';
    // print_r($request->person_name);
    // echo '</pre>';
    // die();
    
  // return response()->json(['status' => 0,'errors' => $request->all()]);
   $v = \Validator::make($request->all(),[
            'title' => 'required',
            // 'description' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'event_type' => 'required',
            'end_time' => 'required',
            'end_date' => 'required',
            'banner_image' => 'required',
            'event_picture' => 'required|image',
        ]);
//return $request->all();

   if($v->fails()){
       return response()->json(['status' => 0,'errors' => $v->errors()]);
   }else{

    if($request->event == 1)
    {

            $e = new UserEvent;
            $e->style_id = trim($request->style_type);
            $e->event = 0;
            if(trim($request->style_type) == 0){
                $e->style_title = trim($request->style_title);
            }
            $e->style_description = trim($request->style_description);
            $e->event_type = trim($request->event_type);
            $e->event = $request->event;
            $e->user_id = trim(Auth::user()->id);
            $e->title = trim($request->title);
            $e->description = trim($request->description);
            $e->start_date = trim($request->start_date);
            $e->start_time = trim($request->start_time);
            $e->end_time = trim($request->end_time);
            $e->end_date = trim($request->end_date);
            $e->max_person = trim($request->max_person);
            $e->reg_date = trim($request->reg_start_date);
            $e->reg_time = trim($request->reg_start_time);
            $e->souvenir_store_url = trim($request->souvenir_url);
            $e->payment_motheds = trim($request->payment_method);
            $e->registration = trim($request->event_registration);
            $e->template_id = trim($request->template_id);
           
            
            $colours = array();
            if(!empty($request->colourNames) && !empty($request->colours)) {
              foreach($request->colourNames as $key => $cname) {
                    if(!empty($request->colourNames[$key] && $request->colours[$key])) {
                        $colours[] = [
                            'colourName' => $request->colourNames[$key],
                            'colour' => $request->colours[$key]
                        ]; 
                    }   
                }
            }
            if(!empty($request->colourNames) && !empty($request->colours)) {
                $e->colour = json_encode($colours);
            }
             $path = 'images/events/';
             $e->event_picture = uploadFileWithAjax($path, $request->event_picture);
             $e->banner_image = uploadFileWithAjax($path, $request->banner_image);
             if($request->media == 'zoom')
             {
                $data =$this->create($request->all());
                $e->zoom_url = $data->join_url;
                $join_url = $data->join_url;
             }elseif($request->media == 'googlemeet'){
                $client = new Google_Client();
                $client->setApplicationName('Eplame');
                $client->setScopes('https://www.googleapis.com/auth/calendar');
                $client->setAuthConfig(storage_path('app/google-calendar/oauth-credentials.json'));
                $client->setAccessType('offline');
                $client->setPrompt('select_account consent');
                $client->setRedirectUri("https://eplame.com/dev/user/events");

             
                $tokenPath = storage_path('app/google-calendar/oauth-token.json');
                if (file_exists($tokenPath)) {
                  $accessToken = json_decode(file_get_contents($tokenPath), true);        
                  $client->setAccessToken($accessToken);
                  
                }
                 

                // If there is no previous token or it's expired.
                if ($client->isAccessTokenExpired()) {
                    // Refresh the token if possible, else fetch a new one.
                    if ($client->getRefreshToken()) {
                        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    } else {
                        // Request authorization from the user.
                       $authUrl = $client->createAuthUrl();
                        echo "<a href=".$authUrl.">press</a>";

                       $authCode = trim(define('STDIN',fopen("php://stdin","r")));
                         //$authCode = trim(fgets(STDIN));
                    
                        // Exchange authorization code for an access token.             
                        $code = $_GET['code'];
                         $authCode = trim($code);
                        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                        $client->setAccessToken($accessToken);

                        //Check to see if there was an error.
                        if (array_key_exists('error', $accessToken)) {
                            throw new Exception(join(', ', $accessToken));
                        }
                    }
                    // Save the token to a file.
                    if (!file_exists(dirname($tokenPath))) {
                        mkdir(dirname($tokenPath), 0700, true);
                    }
                    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
                }
                $service = new Google_Service_Calendar($client);

                // Print the next 10 events on the user's calendar.
                $calendarId = 'eplame19@gmail.com';
                $event = new Google_Service_Calendar_Event(array(
                  'summary' => $request->title,
                  'description' => $request->description,
                  'start' => array(
                    'dateTime' => $this->toZoomTimeFormat($request->start_date.''.$request->start_time)
                  ),
                  'end' => array(
                    'dateTime' => $this->toZoomTimeFormat($request->end_date.''.$request->end_time)
                  ),
                  "conferenceData" => [
                        "createRequest" => [
                            "requestId" => "123",
                          "conferenceSolutionKey" => [
                            "type" => "hangoutsMeet"
                          ],
                          
                        ]
                    ]
                ));
                //dd($event);
                $events = $service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
                $e->zoom_url = $events->hangoutLink;
                $join_url = $events->hangoutLink;
             }else{
             	$time_it = time();
             	 $url = "https://eplame.com/dev/arrowchat/public/video/?rid=".$time_it."";
             	 $e->zoom_url =  $url;
                 $join_url =  $url;
             }
             
             $e->save();
           
             if(!empty($request->reg_type) && !empty($request->reg_price)) {
                foreach($request->reg_type as $item => $value)
                {
                    $data=array(
                        'event_id'=>$e->id,
                        'reg_type'=>$request->reg_type[$item],
                        'price'=>$request->reg_price[$item],
                        'description'=>$request->reg_description[$item],
                    );
                    RegistrationType::insert($data);
                }
            }

            if(!empty($request->person_name) && !empty($request->person_name)) {
                for($p=0; $p<count($request->person_name);$p++){
        
                    $person_name = $request->person_name[$p];
                    $person_short_desc = $request->person_short_desc[$p];
                    $person_title = $request->person_title[$p];
                    $person_image = $request->person_image[$p];
                    
                    $path = 'images/events/';
                    $event_person = new UserEventPerson();
                    $event_person->name = $person_name;
                    $event_person->short_desc = $person_short_desc;
                    $event_person->title = $person_title;
                    $event_person->event_id = $e->id;
                    $event_person->image = uploadFileWithAjax($path, $person_image);
                    $event_person->save();
        
                }
            }

             $categories = explode(',', $request->event_categories);
             $this->save_event_meta_data($categories,$e);

             $user_data = User::find(Auth::user()->id);
             $this->VirtualEventTrait($user_data,$join_url);
             $url = url(route('user_show_detail_event',$e->slug));
             return response()->json(['status' => 1,'url' => $url, 'data' => $url]);
          
    }elseif($request->event == 2){
        $e = new UserEvent;
        $e->style_id = trim($request->style_type);
        $e->event = 0;
        if(trim($request->style_type) == 0){
            $e->style_title = trim($request->style_title);
        }
        $e->style_description = trim($request->style_description);
        $e->event_type = trim($request->event_type);
        $e->event = $request->event;
        $e->user_id = trim(Auth::user()->id);
        $e->title = trim($request->title);
        $e->description = trim($request->description);
        $e->start_date = trim($request->start_date);
        $e->start_time = trim($request->start_time);
        $e->end_time = trim($request->end_time);
        $e->end_date = trim($request->end_date);
        $e->location = trim($request->location);
        $e->latitude = trim($request->latitude);
        $e->longitude = trim($request->longitude);
        $e->max_person = trim($request->max_person);
        $e->physical_seat = trim($request->physical_seat);
        $e->virtual_seat = trim($request->virtual_seat);
        $e->registration = trim($request->event_registration);
        $e->reg_date = trim($request->reg_start_date);
        $e->reg_time = trim($request->reg_start_time);
        $e->payment_motheds = trim($request->payment_method);
        $e->souvenir_store_url = trim($request->souvenir_url);
        $e->reg_fee = trim($request->event_fee);
        if($request->selling_ticket == true){
        $e->template_id = trim($request->template_id);
        }
        $e->event_budget= trim($request->event_budget);
        $colours = array();
        if(!empty($request->colourNames) && !empty($request->colours)) {
          foreach($request->colourNames as $key => $cname) {
                if(!empty($request->colourNames[$key] && $request->colours[$key])) {
                    $colours[] = [
                        'colourName' => $request->colourNames[$key],
                        'colour' => $request->colours[$key]
                    ]; 
                }   
            }
        }
        if(!empty($request->colourNames) && !empty($request->colours)) {
            $e->colour = json_encode($colours);
        }
        $path = 'images/events/';
        $e->event_picture = uploadFileWithAjax($path, $request->event_picture);
        $e->banner_image = uploadFileWithAjax($path, $request->banner_image);
        if($request->media == 'zoom')
             {
                $data =$this->create($request->all());
                $e->zoom_url = $data->join_url;
                $join_url = $data->join_url;
             }elseif($request->media == 'googlemeet'){
                $client = new Google_Client();
                $client->setApplicationName('Eplame');
                $client->setScopes('https://www.googleapis.com/auth/calendar');
                $client->setAuthConfig(storage_path('app/google-calendar/oauth-credentials.json'));
                $client->setAccessType('offline');
                $client->setPrompt('select_account consent');
                $client->setRedirectUri("https://eplame.com/dev/user/events");

             
                $tokenPath = storage_path('app/google-calendar/oauth-token.json');
                if (file_exists($tokenPath)) {
                  $accessToken = json_decode(file_get_contents($tokenPath), true);        
                  $client->setAccessToken($accessToken);
                  
                }
                 

                // If there is no previous token or it's expired.
                if ($client->isAccessTokenExpired()) {
                    // Refresh the token if possible, else fetch a new one.
                    if ($client->getRefreshToken()) {
                        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    } else {
                        // Request authorization from the user.
                       $authUrl = $client->createAuthUrl();
                        echo "<a href=".$authUrl.">press</a>";

                       $authCode = trim(define('STDIN',fopen("php://stdin","r")));
                         //$authCode = trim(fgets(STDIN));
                    
                        // Exchange authorization code for an access token.             
                        $code = $_GET['code'];
                         $authCode = trim($code);
                        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                        $client->setAccessToken($accessToken);

                        //Check to see if there was an error.
                        if (array_key_exists('error', $accessToken)) {
                            throw new Exception(join(', ', $accessToken));
                        }
                    }
                    // Save the token to a file.
                    if (!file_exists(dirname($tokenPath))) {
                        mkdir(dirname($tokenPath), 0700, true);
                    }
                    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
                }
                $service = new Google_Service_Calendar($client);

                // Print the next 10 events on the user's calendar.
                $calendarId = 'eplame19@gmail.com';
                $event = new Google_Service_Calendar_Event(array(
                  'summary' => $request->title,
                  'description' => $request->description,
                  'start' => array(
                    'dateTime' => $this->toZoomTimeFormat($request->start_date.''.$request->start_time)
                  ),
                  'end' => array(
                    'dateTime' => $this->toZoomTimeFormat($request->end_date.''.$request->end_time)
                  ),
                  "conferenceData" => [
                        "createRequest" => [
                            "requestId" => "123",
                          "conferenceSolutionKey" => [
                            "type" => "hangoutsMeet"
                          ],
                          
                        ]
                    ]
                ));
                //dd($event);
                $events = $service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
                $e->zoom_url = $events->hangoutLink;  
                $join_url = $events->hangoutLink;
             }else{
             	 $time_it = time();
             	 $url = "https://eplame.com/dev/arrowchat/public/video/?rid=".$time_it."";
             	 $e->zoom_url =  $url;
                 $join_url =  $url;
             }


            
            $e->save();

             if($request->selling_ticket == true){
                $e->template_id = trim($request->template_id);
                $data=EventTemplate::whereId($request->template_id)->first();
                $data['event_template_id']=$data->id;
                $data['user_id']=Auth::id();
                $data['event_id']=$e->id;
                unset($data['id']);
                unset($data['status']);
                unset($data['template_name']);
                unset($data['created_at']);
                unset($data['updated_at']);
                unset($data['template_id']);
                EventTicket::insert(json_decode($data,true));
             }
            // if(!empty($request->reg_type) && !empty($request->reg_price)) {
            //     foreach($request->reg_type as $item => $value)
            //     {
            //       $data=array(
            //             'event_id'=>$e->id,
            //             'reg_type'=>$request->reg_type[$item],
            //             'price'=>$request->reg_price[$item],
            //             'description'=>$request->reg_description[$item],
            //         );
            //         RegistrationType::insert($data);
            //     }
                    
            // }
              for($i=0;$i<=(int)$request->counter;$i++)
                {
                    $data=array(
                        'event_id'=>$e->id,
                        'reg_type'=>$request->input('reg_type_'.$i),
                        'price'=>$request->input('reg_price_'.$i),
                        'seats'=>$request->input('reg_seats_'.$i),
                        'available_seats'=>$request->input('reg_seats_'.$i),
                        'description'=>$request->input('reg_description_'.$i),
                    );
                    RegistrationType::insert($data);
                }
            
            if(!empty($request->person_name) && !empty($request->person_name)) {
                for($p=0; $p<count($request->person_name);$p++){
        
                    $person_name = $request->person_name[$p];
                    $person_short_desc = $request->person_short_desc[$p];
                    $person_title = $request->person_title[$p];
                    $person_image = $request->person_image[$p];
                    
                    $path = 'images/events/';

                    $event_person = new UserEventPerson();
                    $event_person->name = $person_name;
                    $event_person->short_desc = $person_short_desc;
                    $event_person->title = $person_title;
                    $event_person->event_id = $e->id;
                    $event_person->image = uploadFileWithAjax($path, $person_image);
                    $event_person->save();
        
                }
            }

            $categories = explode(',', $request->event_categories);
            $this->save_event_meta_data($categories,$e);

             $user_data = User::find(Auth::user()->id);
             $this->HybridEventTrait($user_data,$join_url);
             $url = url(route('user_show_detail_event',$e->slug));
             return response()->json(['status' => 1,'url' => $url, 'data' => $url]);
    }else{
        
        
        $month = \Carbon\Carbon::parse($request->start_date)->format('m');
        if( $month == '03' || $month == '04' || $month == '05'){    
            $season = 'spring';
        }elseif($month == '06' || $month == '07' || $month == '08'){
            $season = 'summer';
        }elseif($month == '09' || $month == '10' || $month == '11'){
            $season = 'autumn';
        }else{
            $season = 'winter';
        }

   	    $path = 'images/events/';
        $e = new UserEvent;
        $e->style_id = trim($request->style_type);
        $e->event = 0;
        if(trim($request->style_type) == 0){
            $e->style_title = trim($request->style_title);
        }
        $e->style_description = trim($request->style_description);
        $e->user_id = trim(Auth::user()->id);
        $e->title = trim($request->title);
        $e->description = trim($request->description);
        $e->start_date = trim($request->start_date);
        $e->start_time = trim($request->start_time);
        $e->end_time = trim($request->end_time);
        $e->end_date = trim($request->end_date);
        $e->location = trim($request->location);
        $e->latitude = trim($request->latitude);
        $e->longitude = trim($request->longitude);
        $e->event_type = trim($request->event_type);
        $e->event_budget = trim($request->event_budget);
        $e->long_description = trim($request->long_description);
        $e->min_person = trim($request->min_person);
        $e->max_person = trim($request->max_person);
        $e->reg_date = trim($request->reg_start_date);
        $e->reg_time = trim($request->reg_start_time);
        $e->registration = trim($request->event_registration);
        $e->payment_motheds = trim($request->payment_method);
        $e->reg_fee = trim($request->event_fee);
        $e->seasons = trim($season);
        if($request->selling_ticket == true){
        $e->template_id = trim($request->template_id);
        }
        $e->souvenir_store_url = trim($request->souvenir_url);
        $colours = array();
        if(!empty($request->colourNames) && !empty($request->colours)) {
          foreach($request->colourNames as $key => $cname) {
                if(!empty($request->colourNames[$key] && $request->colours[$key])) {
                    $colours[] = [
                        'colourName' => $request->colourNames[$key],
                        'colour' => $request->colours[$key]
                    ]; 
                }   
            }
        }
        if(!empty($request->colourNames) && !empty($request->colours)) {
            $e->colour = json_encode($colours);
        }
         
        $e->event_picture = uploadFileWithAjax($path, $request->event_picture);
        $e->banner_image = uploadFileWithAjax($path, $request->banner_image);
        if(trim($request->style_type) == 0){
            $e->style_image = $request->hasFile('style_image') ? uploadFileWithAjax($path, $request->style_image) : $e->style_image;
        }
         if($request->media == 'zoom')
             {
                $data =$this->create($request->all());
                $e->zoom_url = $data->join_url;
                $join_url = $data->join_url;
             }elseif($request->media == 'googlemeet'){
                $client = new Google_Client();
                $client->setApplicationName('Eplame');
                $client->setScopes('https://www.googleapis.com/auth/calendar');
                $client->setAuthConfig(storage_path('app/google-calendar/oauth-credentials.json'));
                $client->setAccessType('offline');
                $client->setPrompt('select_account consent');
                $client->setRedirectUri("https://eplame.com/dev/user/events");

             
                $tokenPath = storage_path('app/google-calendar/oauth-token.json');
                if (file_exists($tokenPath)) {
                  $accessToken = json_decode(file_get_contents($tokenPath), true);        
                  $client->setAccessToken($accessToken);
                  
                }
                 

                // If there is no previous token or it's expired.
                if ($client->isAccessTokenExpired()) {
                    // Refresh the token if possible, else fetch a new one.
                    if ($client->getRefreshToken()) {
                        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    } else {
                        // Request authorization from the user.
                       $authUrl = $client->createAuthUrl();
                        echo "<a href=".$authUrl.">press</a>";

                       $authCode = trim(define('STDIN',fopen("php://stdin","r")));
                         //$authCode = trim(fgets(STDIN));
                    
                        // Exchange authorization code for an access token.             
                        $code = $_GET['code'];
                         $authCode = trim($code);
                        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                        $client->setAccessToken($accessToken);

                        //Check to see if there was an error.
                        if (array_key_exists('error', $accessToken)) {
                            throw new Exception(join(', ', $accessToken));
                        }
                    }
                    // Save the token to a file.
                    if (!file_exists(dirname($tokenPath))) {
                        mkdir(dirname($tokenPath), 0700, true);
                    }
                    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
                }
                $service = new Google_Service_Calendar($client);

                // Print the next 10 events on the user's calendar.
                $calendarId = 'eplame19@gmail.com';
                $event = new Google_Service_Calendar_Event(array(
                  'summary' => $request->title,
                  'description' => $request->description,
                  'start' => array(
                    'dateTime' => $this->toZoomTimeFormat($request->start_date.''.$request->start_time)
                  ),
                  'end' => array(
                    'dateTime' => $this->toZoomTimeFormat($request->end_date.''.$request->end_time)
                  ),
                  "conferenceData" => [
                        "createRequest" => [
                            "requestId" => "123",
                          "conferenceSolutionKey" => [
                            "type" => "hangoutsMeet"
                          ],
                          
                        ]
                    ]
                ));
                //dd($event);
                $events = $service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
                $e->zoom_url = $events->hangoutLink;
                $join_url = $events->hangoutLink;
             }else{
             	$time_it = time();
             	 $url = "https://eplame.com/dev/arrowchat/public/video/?rid=".$time_it."";
             	 $e->zoom_url =  $url;
                 $join_url =  $url;
             }
        $e->save();
          if($request->selling_ticket == true){
                $e->template_id = trim($request->template_id);
                $data=EventTemplate::whereId($request->template_id)->first();
                $data['event_template_id']=$data->id;
                $data['user_id']=Auth::id();
                $data['event_id']=$e->id;
                unset($data['id']);
                unset($data['status']);
                unset($data['template_name']);
                unset($data['created_at']);
                unset($data['updated_at']);
                unset($data['template_id']);
                EventTicket::insert(json_decode($data,true));
             }
            // if(!empty($request->reg_type) && !empty($request->reg_price)) {
            //     foreach($request->reg_type as $item => $value)
            //     {
            //       $data=array(
            //             'event_id'=>$e->id,
            //             'reg_type'=>$request->reg_type[$item],
            //             'price'=>$request->reg_price[$item],
            //             'description'=>$request->reg_description[$item],
            //         );
            //         RegistrationType::insert($data);
            //     }
                    
            // }
             for($i=0;$i<(int)$request->counter;$i++)
                {
                    $data=array(
                        'event_id'=>1,
                        'reg_type'=>$request->input('reg_type_'.$i),
                        'price'=>$request->input('reg_price_'.$i),
                        'seats'=>$request->input('reg_seats_'.$i),
                        'available_seats'=>$request->input('reg_seats_'.$i),
                        'description'=>$request->input('reg_description_'.$i),
                    );
                    RegistrationType::insert($data);
                }
            
        // if(!empty($request->reg_type) && !empty($request->reg_price)) {
        //     foreach($request->reg_type as $item => $value)
        //     {
        //         $data=array(
        //             'event_id'=>$e->id,
        //             'reg_type'=>$request->reg_type[$item],
        //             'price'=>$request->reg_price[$item],
        //             'description'=>$request->reg_description[$item],
        //         );
        //         RegistrationType::insert($data);
        //     }
        // }

        if(!empty($request->person_name) && !empty($request->person_name)) {
            for($p=0; $p<count($request->person_name);$p++){
    
                $person_name = $request->person_name[$p];
                $person_short_desc = $request->person_short_desc[$p];
                $person_title = $request->person_title[$p];
                $person_image = $request->person_image[$p];
                
                $path = 'images/events/';
                $event_person = new UserEventPerson();
                $event_person->name = $person_name;
                $event_person->short_desc = $person_short_desc;
                $event_person->title = $person_title;
                $event_person->event_id = $e->id;
                $event_person->image = uploadFileWithAjax($path, $person_image);
                $event_person->save();
    
            }
        }
        

        $user_data = User::find(Auth::user()->id);
        $this->HybridEventTrait($user_data,$join_url);
        $url = url(route('user_show_detail_event',$e->slug));

        $categories = explode(',', $request->event_categories);
        $this->save_event_meta_data($categories,$e);
        $u = Auth::user();
        $u->login_count = 1;
        $u->save();
        
       return response()->json(['status' => 1,'url' => $url]);
    }
   }

	 
}






 public function save_event_meta_data($categories,$event) {
        foreach ($categories as $key => $value) {
            $meta = new UserEventMetaData;
            $meta->parent = 0;
            $meta->user_id = Auth::user()->id;
            $meta->event_id = $event->id;
            $meta->type = 'events';
            $meta->key = 'category_id';
            $meta->key_value = $value;
            $meta->save();
        }
}
   public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:sO');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : '.$e->getMessage());

            return '';
        }
    }








}