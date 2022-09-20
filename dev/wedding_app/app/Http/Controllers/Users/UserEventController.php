<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Testimonial;
use App\UserEvent;
use App\UserEventPerson;
use App\VendorCategory;
use App\VendorEventGame;
use App\VendorCategoryMetaData;
use App\Style;
use App\CategoryVariation;
use App\Category;
use App\UserEventGuest;
use App\UserEventMetaData;
use App\CoHost;
use App\User;
use App\RescheduleEvent;
use App\DisputeReason;
use App\Models\Order;
use Auth;
use App\ThankyouTemplate;
use App\RegistrationType;
use App\EventTemplate;
use Redirect;
use App\Models\EventOrder;
use App\Models\DisputeVendor;
use App\Models\UserEventAlbum;
use App\Tools\CheckList\MainTraits;
use App\Traits\GeneralSettingTrait;
use App\Traits\EmailTraits\EmailNotificationTrait;
use App\EventTicket;
class UserEventController extends Controller
{
    use MainTraits; 
    use GeneralSettingTrait;
    use EmailNotificationTrait;

    public function testEvent(){
        $event_data = UserEvent::find(296);
        $event_template = EventTemplate::where('template_id', $event_data->template_id)->first();

        

        $o = \App\EventRegistration::where('user_event_id', 296)->first();

        $pdf_data  = view('event_templates.event-template-4',[
                        'event_data'     => $event_data,
                        'event_template' => $event_template,
                        'event_reg'      => $o
                    ])->render();
        
        // echo '<pre>';
        // print_r($o);
        // die();

        echo $pdf_data;
        //die();

        $pdf = \App::make('dompdf.wrapper');
        $path = 'images/' .$event_data->title. '.pdf';
        $pdf->loadHTML($pdf_data)->save($path);
        $UserRegistrationEventTrait = $this->UserRegistrationEventTrait($path, "Gurbaj Singh", 'gurbaj@yopmail.com', 296, $o->id);
        echo '<pre>';
        print_r($UserRegistrationEventTrait);
        echo '</pre>';
        die();
    }

    public function index($status='all', Request $request) {
        $cohost_event_ids = Cohost::where('cohost_id', Auth::user()->id)->where('status', 1)->pluck('event_id')->toArray();
        $events = UserEvent::where(['user_id' => Auth::User()->id])
        ->where(function($t) use($status, $request, $cohost_event_ids){
            if($status == 'upcoming'){
                $t->whereDate('start_date','>',date('Y-m-d'));
            }elseif($status == 'past'){
                $t->whereDate('end_date','<',date('Y-m-d'));
            }elseif($status == 'ongoing'){
                $t->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'));
            }elseif($status == 'co-host'){
                $t->whereIn('id', $cohost_event_ids)->where('user_id');
            }elseif($status == 'search'){
                $t->where('title','like', '%' .$request->search. '%');
            }
        })
        ->where('event_status', 1)
        ->OrderBy('start_date','DESC')
        ->paginate(10);
        return view('users.events.index')
        ->with('status',$status)
        ->with('events', $events);
    }

    public function coHostEvents($status='all', Request $request) {
        $cohost_event_ids = Cohost::where('cohost_id', Auth::user()->id)->where('status', 1)->pluck('event_id')->toArray();
        $events = UserEvent::whereIn('id', $cohost_event_ids)
        ->where(function($t) use($status, $request, $cohost_event_ids){
            if($status == 'upcoming'){
                $t->whereDate('start_date','>',date('Y-m-d'));
            }elseif($status == 'past'){
                $t->whereDate('end_date','<',date('Y-m-d'));
            }elseif($status == 'ongoing'){
                $t->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'));
            }elseif($status == 'search'){
                $t->where('title','like', '%' .$request->search. '%');
            }
        })
        ->OrderBy('start_date','DESC')
        ->paginate(10);
        return view('users.events.coEvents')
        ->with('status',$status)
        ->with('events', $events);
    }



#--------------------------------------------------------------------------------------------------------------------
# Albums
#--------------------------------------------------------------------------------------------------------------------


public function postAlbum(Request $request,$slug)
{


         
       $events = UserEvent::where(['user_id' => Auth::User()->id])
         ->whereDate('end_date','<',date('Y-m-d')) 
         ->OrderBy('start_date','DESC');

         if($events->count() == 0){
              
             $status = ['status' => 0,'messages' => 'User Event is not found!'];
         }else{
            foreach ($request->file('file') as $key => $file) {
             $image_name = uploadFileWithAjax('images/vendors/gallery/',$file,1);
                
             $e = new UserEventAlbum;
             $e->file_link = $image_name['file'];
             $e->type = $image_name['extension'];
             $e->event_id = $events->first()->id;
             $e->user_id = Auth::user()->id;
             $e->save();

         }
               $status = ['status' => 1,'messages' => 'File Uploaded Successfully!!'];
         }

         return response()->json($status);
         
     
}





#--------------------------------------------------------------------------------------------------------------------
# Albums
#--------------------------------------------------------------------------------------------------------------------

public function album_ajax($slug)
{
         $events = UserEvent::where(['user_id' => Auth::User()->id])
         ->whereDate('end_date','<',date('Y-m-d')) 
         ->OrderBy('start_date','DESC');
           
           $vv = view('users.events.album_files')->with('event',$events)->render();
          return response()->json($vv);
}


public function albumDelete($slug,$id)
{





        $u = UserEventAlbum::find($id);
        if(!empty($u)){

        $u->delete();
        }


            return redirect()->route('user.event.album',$slug)->with('flash_message', 'File Deleted Successfuly!');

         // $events = UserEvent::where(['user_id' => Auth::User()->id])
         // ->whereDate('end_date','<',date('Y-m-d')) 
         // ->OrderBy('start_date','DESC');
           
         //   $vv = view('users.events.album_files')->with('event',$events)->render();
         //  return response()->json($vv);
}





#--------------------------------------------------------------------------------------------------------------------
# Albums
#--------------------------------------------------------------------------------------------------------------------


public function album($slug)
{
       $events = UserEvent::where(['user_id' => Auth::User()->id])
         ->whereDate('end_date','<',date('Y-m-d')) 
         ->OrderBy('start_date','DESC');

         if($events->count() == 0){
             return redirect()->route('user_events')->with('flash_message', 'User Event is not found!');
         
         }
         
    return view('users.events.album')->with('events',$events->first());
}

public function videos($slug)
{
    $events = UserEvent::FindBySlugOrFail($slug);
    $videos = UserEventAlbum::where('user_id', Auth::user()->id)->where('type', 'video')->where('event_id', $events->id)->paginate(20);

    return view('users.events.videos')->with(['events' => $events, 'videos'=> $videos]);
}

public function storeVideos($slug, Request $request)
{
    $events = UserEvent::FindBySlugOrFail($slug);
    $e = new UserEventAlbum;
    $e->file_link = $request->video_url;
    $e->type = 'video';
    $e->event_id = $events->id;
    $e->user_id = Auth::user()->id;
    $e->save();
         
    return redirect()->route('user.event.videos', $slug)->with('flash_message', 'Video Inserted Successfuly!');
}

public function videoDelete($slug,$id)
{
    $u = UserEventAlbum::find($id);
    if(!empty($u)){
        $u->delete();
    }
    return redirect()->route('user.event.videos', $slug)->with('flash_message', 'Video Deleted Successfuly!');

}


    public function showCreateEvent() {
        $events = Event::where('status', 1)->get();
        $styles = Style::where('status', 1)->get();
        return view('users.events.create')->with(['events' => $events, 'styles' => $styles]);
    }

    public function create(Request $request) { 

        // echo '<pre>';
        // print_r($request->all());
        // die();

        $this->validate($request,[
                 'title' => 'required',
                 'description' => 'required',
                 'start_date' => 'required',
                 'start_time' => 'required',
                 // 'end_time' => 'required',
                 // 'end_date' => 'required',
                 // 'location' => 'required',
                 // 'latitude' => 'required',
                 // 'longitude' => 'required',
                 // 'event_type' => 'required',
                 // 'min_person' => 'required',
                 // 'max_person' => 'required',
                 // 'event_picture' => 'required|image',
                 // 'seasons' => 'required',
                 // 'colourNames' => 'required',
                 // 'colours' => 'required',
                 
         ]);
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


        $path = 'images/events/';
        $e =new  UserEvent;
        $e->user_id = trim(Auth::user()->id);
        $e->style_id = trim($request->style_id);

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

        if(trim($request->style_id) == 0){
            $e->style_title = trim($request->style_title);
        }
        $e->style_description = trim($request->style_description);
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
        $e->payment_motheds = trim($request->payment_method);
        $e->reg_type = json_encode( array('reg_type' => $request->reg_type ,'price' =>$request->price ,'capacity' => $request->capacity) );
        $e->seasons = $season;
        if(!empty($request->colourNames) && !empty($request->colours)) {
            $e->colour = json_encode($colours);
        }
        $e->event_picture = $request->hasFile('event_picture') ? uploadFileWithAjax($path, $request->event_picture) : $e->event_picture;

        if(trim($request->style_id) == 0){
            $e->style_image = $request->hasFile('style_image') ? uploadFileWithAjax($path, $request->style_image) : $e->style_image;
        }
        $e->save();
          
        $url = url(route('user_show_detail_event', $e->slug));

        $categories = $request->event_categories;
        $u = Auth::user();
        UserEventMetaData::where('event_id', $e->id)->delete();
        $this->save_event_meta_data($categories,$u,$e);
        $u->login_count = 1;
        $u->save();

        $latitudeFrom = $e->latitude;
        $longitudeFrom = $e->longitude;
        

        $vendor_event_games = VendorEventGame::where('event_id', $e->event_type)->pluck('vendor_category_id')->toArray();
        $vendor_services = VendorCategory::whereIn('id', $vendor_event_games)->where('status', 3)->get();
        foreach($vendor_services as $service){
            $latitudeTo = $service->latitude;
            $longitudeTo = $service->longitude;

            $travel_distance = VendorCategoryMetaData::where('vendor_category_id', $service->id)->where('key', 'travel_distaince')->where('type', 'basic_information')->first();
            $travel_distance = $travel_distance->keyValue;
            $distance_in_km = latlongDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);
            $distance_in_km = round($distance_in_km);
            $distance_in_miles = ($distance_in_km * 0.621);
            $distance_in_miles = intval(round($distance_in_miles));
            
            if($distance_in_miles <= intval(round($travel_distance))){
                if($request->agree == 1){
                    $this->EventInformationSharingTrait($service, $e);
                }
            }
        }


        return redirect()->route('user_events')->with('flash_message', 'User Event has been saved successfully');
    }

    public function getEventCategories(Request $request) {
        $event = Event::with(['categoryVariation' => function($q) {
            $q->groupBy('category_id');
        }, 'categoryVariation.category'])
        ->find($request->id);
        return response()->json($event);
    }


    public function getEventCategory(Request $request) {
        $event = Event::with(['categoryVariation' => function($q) {
                $q->groupBy('category_id');
            }, 'categoryVariation.category'])
            ->where('id',$request->id);
        $text ="";
        
        if($event->count() > 0){
            $categoryVariation = $event->first();
            foreach ($categoryVariation->categoryVariation as $value) {
                $text .='<div class="col-lg-6">';
                $text .='<div class="vendor-category" >';
                $text .='<div class="category-checkboxes category-title"  >';
                $text .='<input type="checkbox" class="categoryCheckboxes" data-label = "'.$value->category->label.'" data-id="'.$value->category->id.'" name="categories[]" value="'.$value->category->id.'" id="category-'.$value->category->id.'" >';
                $text .='<label for="category-'.$value->category->id.'">'.$value->category->label.'</label>';
                $text .='</div>';
                $text .='</div>';
                $text .='</div>';
            }
        }

        return response()->json($text);
    }



    public function showEditEvent($slug) {
        $events = Event::where('status', 1)->get();
        $styles = Style::where('status', 1)->get();
        $user_event = UserEvent::FindBySlugOrFail($slug);
         
        $user_event['categories'] = !empty($cat_ids) ? json_encode($cat_ids) : [];
        return view('users.events.edit')->with(['events' => $events, 'user_event' => $user_event, 'styles' => $styles]);
    }
    public function showEditVirtualHybridEvent($slug){
          $events = Event::where('status', 1)->get();
        $styles = Style::where('status', 1)->get();
        $user_event = UserEvent::FindBySlugOrFail($slug);
         
        $user_event['categories'] = !empty($cat_ids) ? json_encode($cat_ids) : [];
        return view('users.events.editVirtualHybrid')->with(['events' => $events, 'user_event' => $user_event, 'styles' => $styles]);
    }

    public function showDetailEvent($slug) {
        $user_event = UserEvent::FindBySlugOrFail($slug);

        if($this->saveCategories($user_event) == 1){
            return redirect()->route('user_show_detail_event',$slug);
        }
        $events = Event::where('status', 1)->get();
        $cohosts = CoHost::where('event_id', $user_event->id)->get();
        $user_event = UserEvent::FindBySlugOrFail($slug);
        $user_event_person = UserEventPerson::where('event_id', $user_event->id)->get();

        // echo '<pre>';
        // print_r($user_event_person);
        // echo '</pre>';
        // die();
     $eventTicket=EventTicket::whereEventId($user_event->id)->first();
         $event_ticket_template=0;
            if($eventTicket)
            {
            $event_ticket_template=$eventTicket->event_template->template_id;
            }
        $thanktemplates = ThankyouTemplate::where('status', 1)->get();
        $dispute_reason = DisputeReason::where('status', 1)->get();
        return view('users.events.detail')->with(['events' => $events, 'user_event' => $user_event, 'user_event_person' => $user_event_person, 'cohosts' => $cohosts, 'thanktemplates' => $thanktemplates, 'dispute_reason' => $dispute_reason,'eventTicket'=>$eventTicket,'event_ticket_template'=>$event_ticket_template ]);
    }

    public function update(Request $request, $slug) {
 

        $this->validate($request,[
                 'title' => 'required',
                 'long_description' => 'required',
                 // 'start_date' => 'required',
                 'start_time' => 'required',
                 'end_time' => 'required',
                 // 'end_date' => 'required',
                 //'location' => 'required',
                 'latitude' => 'required',
                 'longitude' => 'required',
                 'event_type' => 'required',
                 'style_id' => 'required',
                 'min_person' => 'required',
                 'max_person' => 'required',
                 'event_picture' => 'image',
                 'style_image' => 'image',
                 //'seasons' => 'required',
                 //'colourNames' => 'required',
                 //'colours' => 'required',
                  
        ]);
        

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


        $path = 'images/events/';
        $e = UserEvent::FindBySlugOrFail($slug);
        $season = $e->seasons;
        $e->user_id = trim($e->user_id);
        $e->style_id = trim($request->style_id);
        if(trim($request->style_id) == 0){
            $e->style_title = trim($request->style_title);
        }
        $e->style_description = trim($request->style_description);
        $e->title = trim($request->title);
        //$e->description = trim($request->description);

        $e->start_time = trim($request->start_time);
        $e->end_time = trim($request->end_time);
        $e->location = trim($request->location);
        $e->latitude = trim($request->latitude);
        $e->longitude = trim($request->longitude);
        $e->event_type = trim($request->event_type);
        $e->event_budget = trim($request->event_budget);
        $e->long_description = trim($request->long_description);
        $e->min_person = trim($request->min_person);
        $e->max_person = trim($request->max_person);
        $e->seasons = $season;
        if(!empty($request->colourNames) && !empty($request->colours)) {
            $e->colour = json_encode($colours);
        }
        
        $e->event_picture = $request->hasFile('event_picture') ? uploadFileWithAjax($path, $request->event_picture) : $e->event_picture;
        if(trim($request->style_id) == 0){
            $e->style_image = $request->hasFile('style_image') ? uploadFileWithAjax($path, $request->style_image) : $e->style_image;
        }
        $e->save();  
        $url = url(route('user_show_detail_event',$e->slug));
        $categories = $request->event_categories;
        $u = Auth::user();
        UserEventMetaData::where('event_id', $e->id)->delete();
        $this->save_event_meta_data($categories,$u,$e);
        $u->login_count = 1;
        $u->save();
        
        if(Auth::user()->id == $e->user_id){
            return redirect()->route('user_events')->with('flash_message', 'User Event has been updated successfully');
        }else{
            return redirect()->route('user_co_events')->with('flash_message', 'Co-Host Event has been updated successfully');
        }
        
        
    }
    public function updateVirtualHybridEvent(Request $request, $slug)
    {
        $this->validate($request,[
                'title' => 'required',
                'description' => 'required',
                'max_person' => 'required',
                'event_picture' => 'image',
                
        ]);
    

        $path = 'images/events/';
        $e = UserEvent::FindBySlugOrFail($slug);
        $e->user_id = trim($e->user_id);
        $e->title = trim($request->title);
        $e->start_time = trim($request->start_time);
        $e->end_time = trim($request->end_time);
        $e->location = trim($request->location);
        $e->latitude = trim($request->latitude);
        $e->longitude = trim($request->longitude);
        $e->description = trim($request->description);
        $e->max_person = trim($request->max_person);
        $e->reg_date = trim($request->reg_start_date);
        $e->reg_time = trim($request->reg_start_time);
        
        $e->event_picture = $request->hasFile('event_picture') ? uploadFileWithAjax($path, $request->event_picture) : $e->event_picture;
        $e->save();  
        
        return redirect()->route('user_events')->with('flash_message', 'User Event has been updated successfully');
        
    }
    public function save_event_meta_data($categories, $user, $event) {
        foreach ($categories as $key => $value) {
            $meta = new UserEventMetaData;
            $meta->parent = 0;
            $meta->user_id = $user->id;
            $meta->event_id = $event->id;
            $meta->type = 'events';
            $meta->key = 'category_id';
            $meta->key_value = $value;
            $meta->save();
        }
    }

    public function eventExtraDetail(Request $request, $slug){
        $e = UserEvent::FindBySlugOrFail($slug);
        $e->update($request->all());
        $e->save();

        return Redirect::back()->with('flash_message', 'User Event has been updated successfully');
    }


    public function hiteshEvent(){
        return view('users.events.hitesh_event');
    }

#------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------

    public function getOrderDetailOfEvent(Request $request,$id)
    {
        $event = UserEvent::where('id',$id)->where('user_id',Auth::user()->id)->first();

        $EventOrder = \App\Models\EventOrder::where('category_id',$request->category_id)
                                ->where('type','order')
                                ->where('user_id',Auth::user()->id)
                                ->where('event_id',$id)
                                ->first();

        

        if(empty($event)){
            abort(404);
        }
        
        $vv = view('users.events.order')
              ->with('order',$EventOrder)
              ->with('event',$event);

        return response()->json([
            'status' => 1,
            'htm' => $vv->render()
        ]);


    }




#------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------



    public function dispute(Request $request,$orderID)
    {

       $EventOrder = \App\Models\EventOrder::where('type','order')
                                 ->where('user_id',Auth::user()->id)
                               ->where('id',$orderID);
 
          if($EventOrder->count() == 0){
              abort(404);
          }
          $event = UserEvent::where('id',$EventOrder->first()->event_id)->where('user_id',Auth::user()->id);

          if($event->count() == 0){
            abort(404);
          }
          return view('users.orders.dispute')
                      ->with('order',$EventOrder->first())
                      ->with('event',$event->first());
 


    }



#====================================================================================================
#====================================================================================================
#====================================================================================================



    public function disputePost(Request $request,$id)
    {
      
        $this->validate($request,[
            'reason' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'summary' => 'required'

        ]);
         $EventOrder = \App\Models\EventOrder::where('type','order')
                                 ->where('user_id',Auth::user()->id)
                                 ->where('id',$id);
 
          if($EventOrder->count() == 0){
               return redirect()->back()->with('messages','This order is not exist!');
          }
          $event = UserEvent::where('id',$EventOrder->first()->event_id)->where('user_id',Auth::user()->id);
          if($event->count() == 0){
             return redirect()->back()->with('messages','The Event does not exist!');
          }
          $o = $EventOrder->first();
          $data = DisputeVendor::where('order_id',$o->order_id)
                       ->where('vendor_id',$o->vendor_id)
                       ->where('event_id',$o->event_id)
                       ->where('user_id',$o->user_id)
                       ->where('event_order_id',$o->id);

          if($data->count() == 0){
                $d = new DisputeVendor;
                $d->reason = $request->reason;
                $d->phone_number = $request->phone_number;
                $d->email = $request->email;
                $d->summary = $request->summary;
                $d->user_id = $o->user_id;
                $d->vendor_id = $o->vendor_id;
                $d->event_id = $o->event_id;
                $d->event_order_id = $o->id;
                $d->order_id = $o->order_id;
                $d->save();
                return redirect()
                     ->route('order_details',$o->order_id)
                     ->with('messages','Dispute request has been sent successfully!');
            
          }
          


             return redirect()
                     ->route('order_details',$o->order_id)
                     ->with('messages','Dispute request have sent already');

    }

    public function shareEvent(Request $request){
        if(!empty($request->email) && !empty($request->event_id)){
            $emails = explode(',', $request->email);
            $user_event_id =  $request->event_id;
            foreach($emails as $email){
                if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
                    $this->ShareUserEventTrait($email, $user_event_id);
                }
            }
            return 101;
        }
    }
    public function shareRegistrationEvent(Request $request){
        if(!empty($request->email) && !empty($request->event_id)){
            $emails = explode(',', $request->email);
            $user_event_id =  $request->event_id;
            foreach($emails as $email){
                if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
                    $this->RegistrationEventInvitationTrait($email, $user_event_id);
                }
            }
            return 101;
        }
    }

    public function postThanksNote(Request $request){
        if(!empty($request->guest_ids)){
            $guests = $request->guest_ids;
            $note = '';
            if(!empty($request->note)){
                $note = $request->note;
            }
            foreach($guests as $guest_id){
                $guest = UserEventGuest::find($guest_id);
                $this->GuestThankYouNoteTrait($guest, $note);
            }
            return 101;
        }
    }

    public function postTestimonial(Request $request){
        if(!empty($request->summary)){
            $testimonial = new Testimonial;
            $name = Auth::user()->name;
            $profile_pic = Auth::user()->profile_pic;
            if(empty($profile_pic)){
                $profile_pic = '1609916988.png';
            }
            $testimonial->title = $name;
            $testimonial->summary = $request->summary;
            $testimonial->image = $profile_pic;
            $testimonial->status = 0;
            $testimonial->save();
            return 101;
        }
    }

    public function cohostInvitation(Request $request){
        if(!empty($request->name && !empty( $request->email) && !empty( $request->event_id) && !empty( $request->relation))){
            $event = UserEvent::find($request->event_id);
            $cohostcheck = CoHost::where('cohost_email', $request->email)->where('event_id', $request->event_id)->first();
            if(!empty($cohostcheck)){
                return 102;
            }else{
                $cohost = new CoHost;
                $cohost->host_id = $event->user_id;
                $cohost->cohost_name = $request->name;
                $cohost->cohost_email = $request->email;
                $cohost->event_id = $request->event_id;
                $cohost->relation = $request->relation;
                $cohost->event_sharing = $request->event_sharing;
                $cohost->guest_management = $request->guest_management;
                $cohost->checklist_management = $request->checklist_management;
                $cohost->budget_management = $request->budget_management;
                $cohost->vendor_management = $request->vendor_management;
                $cohost->event_management = $request->event_management;
                $cohost->status = 0;
                $cohost->save();
                $cohost = CoHost::find($cohost->id);
                $this->CoHostInvitationTrait($cohost);
                return 101;
            }
        }
    }

    public function coHostThanks($id, $status){
        if($status == 1){
            $cohost = CoHost::find($id);
            if(!empty($cohost) && ($cohost->cohost_email == Auth::user()->email)){
                $cohost->status = 1;
                $cohost->cohost_id = Auth::user()->id;
                $cohost->save();
                $info = 1;
                return redirect()->route('user_co_events')->with('flash_message','Event has been added to your co-host event listing successfully!');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function editCoHost(Request $request){
        $cohost = CoHost::find($request->id);
        $user_event = UserEvent::find($cohost->event_id);
        return view('users.events.editCoHost')->with(['user_event' => $user_event, 'cohost' => $cohost]);
    }

    public function updateCoHost (Request $request, $id) {

        $this->validate($request,[
                 'name' => 'required',
                 'relation' => 'required',    
        ]);

        $cohost = CoHost::Find($id);
        if(!empty($cohost)){
            $cohost->cohost_name = $request->name;
            $cohost->relation = $request->relation;
            $cohost->event_sharing = $request->event_sharing;
            $cohost->guest_management = $request->guest_management;
            $cohost->checklist_management = $request->checklist_management;
            $cohost->budget_management = $request->budget_management;
            $cohost->vendor_management = $request->vendor_management;
            $cohost->event_management = $request->event_management;
            $cohost->status = $request->status;
            $cohost->save();
        }

        return redirect()->route('user_events')->with('flash_message', 'User Event has been updated successfully');
    }
    public function changeStatus(Request $request){
       
        if(!empty($request->user_event_id))
        {
         $id = $request->user_event_id;
         $events = UserEvent::Find($id);
         $events->event_status = 0;
         $events->save();
         $orderEvent = EventOrder::where('event_id',$id)->first();
         if(!empty($orderEvent))
         {
            $vendor = VendorCategory::where('id',$orderEvent->vendor_id)->first();
            $vendor_info = User::where('id',$vendor->user_id)->first();
            $this->UserCancelTheEventTrait($vendor_info,$events->title);
         }
         
         $status = ['status' => 1,'messages' => 'Event has been cancel Successfully!!','redirect_links' => url(route('user_events'))];
        }else{
            $status = ['status' => 0,'messages' => 'Something went wrong.'];
        }
        return response()->json($status);
    }
      public function showEditRechedule($slug) {
        $events = Event::where('status', 1)->get();
        $styles = Style::where('status', 1)->get();
        $user_event = UserEvent::FindBySlugOrFail($slug);
         
        $user_event['categories'] = !empty($cat_ids) ? json_encode($cat_ids) : [];
        return view('users.events.reschedule')->with(['events' => $events, 'user_event' => $user_event, 'styles' => $styles]);
    }

    public function rescheduleEvent(Request $request, $slug)
    {
        if(!empty($request->start_date) && !empty($request->end_date))
        { 

                $event = UserEvent::FindBySlugOrFail($slug);
                $event_id = $event->id;
                $event_vendor_count = $event->vendor_count;
                $vendor_count = EventOrder::where('event_id', $event_id)->count();
                if($vendor_count == $event_vendor_count)
                {
                    $event->start_date = trim($request->start_date);
                    $event->end_date = trim($request->end_date);
                    $event->save(); 
                     $vendor = EventOrder::where('event_id', $event_id)->get();
                     foreach($vendor as $vendors){
                        $event_vendor_id = $vendors->vendor_id;
                        $category_id = $vendors->category_id;
                        $vendor_id = VendorCategory::where('id',$event_vendor_id)->first();
                        $vendor_info = User::where('id',$vendor_id->user_id)->first();
                        $this->UserReschduleDatesTrait($vendor_info, $event->title,$request->start_date,$request->end_date);
                    }
                }else{
                    
                      $vendor = EventOrder::where('event_id', $event_id)->get();
                     foreach($vendor as $vendors){
                        $event_vendor_id = $vendors->vendor_id;
                        $category_id = $vendors->category_id;
                        $vendor_id = VendorCategory::where('id',$event_vendor_id)->first();
                        $vendor_info = User::where('id',$vendor_id->user_id)->first();
                        $reschedule = new  RescheduleEvent;
                        $reschedule->event_id = $event_id;
                        $reschedule->start_date = $request->start_date;
                        $reschedule->end_date = $request->end_date;
                        $reschedule->user_id = Auth::user()->id;
                        $reschedule->vendor_category_id = $event_vendor_id;
                        $reschedule->category_id = $category_id;
                        $reschedule->vendor_count = 0;
                        $reschedule->reshedule_request = 1;
                        $reschedule->save();
                        $this->RescheduleEmailToVendorTrait($vendor_info, $event->title,$request->start_date,$request->end_date);
                          }
                     return view('users.events.reschedule')->with(['user_event' => $event,'vendor_details' => $vendor_info,'message' => 'Please contact hired vendors for their approval to reschedule the event. Event dates will be updated when vendors will approve the request.']);
                    
                }

            }
             return redirect()->route('user_events')->with('flash_message', 'Event Dates has been updated successfully');   

    }
    public function eventType()
    {
         return view('users.events.eventtype');
    }
    public function inpersonEvent(){
       $events = Event::where('status', 1)->get();
        $styles = Style::where('status', 1)->get();
        return view('users.events.inPersonEvent')->with(['events' => $events, 'styles' => $styles]);  
    }
    public function virtualEvent()
    {
        $events = Event::where('status', 1)->get();
        $styles = Style::where('status', 1)->get();
        return view('users.events.virtualEvent')->with(['events' => $events, 'styles' => $styles]); 
    }
     public function hybridEvent()
    {
        $events = Event::where('status', 1)->get();
        $styles = Style::where('status', 1)->get();
        return view('users.events.hybridEvent')->with(['events' => $events, 'styles' => $styles]); 
    }
    public function showVirtualHydridDetailEvent($slug){
        $user_event = UserEvent::FindBySlugOrFail($slug);
        $events = Event::where('status', 1)->get();
        $cohosts = CoHost::where('event_id', $user_event->id)->get();
        $min = RegistrationType::where('event_id', $user_event->id)->min('price');
        $max = RegistrationType::where('event_id', $user_event->id)->max('price');
        $user_guest = UserEventGuest::where('user_event_id', $user_event->id)->first();
        $thanktemplates = ThankyouTemplate::where('status', 1)->get();
        $dispute_reason = DisputeReason::where('status', 1)->get();
         $eventTicket=EventTicket::whereEventId($user_event->id)->first();
         $event_ticket_template=0;
            if($eventTicket)
            {
            $event_ticket_template=$eventTicket->event_template->template_id;
            }
        return view('users.events.virtualHydbridDetail')->with(['events' => $events, 'user_event' => $user_event, 'cohosts' => $cohosts, 'thanktemplates' => $thanktemplates, 'dispute_reason' => $dispute_reason, 'userGuest' => $user_guest, 'min'=> $min, 'max' => $max, 'event_ticket_template'=>$event_ticket_template,'eventTicket'=>$eventTicket]);
    }
    public function getImage(Request $request){
        $id = $request->val;   
         $styles = Style::where('id',$id)->first();
         $image = $styles->image;
         $status = ['status' => $image];
        return response()->json($status);
    }

    public function getTemplate(Request $request){
        $id = $request->val;   
         $template = EventTemplate::where('id',$id)->first();
         $template_html="";
         switch ($template->template_id) {
                case EventTemplate::CUSTOM_TEMPLATE:
                   $template_html=view('users.tickets.templates.customtemplate',compact('template'))->render();
                break;
                case EventTemplate::TEMPLATE1:
                   $template_html=view('users.tickets.templates.template1',compact('template'))->render();
                break;
                case EventTemplate::TEMPLATE2:
                   $template_html=view('users.tickets.templates.template2',compact('template'))->render();
                break;
                case EventTemplate::TEMPLATE3:
                   $template_html=view('users.tickets.templates.template3',compact('template'))->render();
                break;
                case EventTemplate::TEMPLATE4:
                   $template_html=view('users.tickets.templates.template4',compact('template'))->render();
                break;
             default:
                 $template_html="<div class='error'>Getting Some Error...</div>";
                 break;
         }
         return response()->json($template_html);
    }
    public function getEventType(Request $request){
        $id = $request->event_id;   
        $event_data = Event::find($id);
        $type = $event_data->type;
        $status = ['status' => $type];
        return response()->json($status);
    }
    public function tickets()
    {
      return view('users.tickets.tickets');   
    }
    public function edittickets($id)
    {
        return view('users.tickets.edittickets')->with('template_id', $id); 
    }
    public function storetickets(Request $request, $id)
    {

        $eventticket = new EventTemplate;
        $eventticket->template_id = $id;
        $eventticket->template_name = $request->template_name;
        $eventticket->user_id = Auth::user()->id;
        $eventticket->font_color = $request->colours;
        $eventticket->back_font_colour = $request->back_colours;
        $eventticket->logo_color = $request->logocolours;
        $path = 'images/events/';
        $eventticket->background_image = uploadFileWithAjax($path, $request->background_picture);
        $eventticket->back_cover_background_picture = uploadFileWithAjax($path, $request->back_cover_background_picture);
        if($request->picture){
            $eventticket->picture=uploadFileWithAjax($path,$request->picture);
        }
        $eventticket->template_text = $request->template_text;
        $eventticket->template_backcover_text = $request->template_backcover_text;
        $eventticket->font_color = $request->colours;
        $eventticket->header_content=$request->header_content;
        $eventticket->theme_color=$request->theme_color;
        $eventticket->ticket_right_side=$request->ticket_right_side;
        
        $eventticket->save();

        return redirect()->route('tickets')->with('flash_message', 'Ticket Inserted Successfuly!');
    }


    public function ticketDesign(request $request, $id){
         $eventTicket=EventTicket::whereEventId($id)->first();
         if($eventTicket)
         {
           $event_ticket_template=$eventTicket->event_template->template_id;
           $event=$eventTicket->user_events;
           return view('users.tickets.event_tickets.ticket')->with('template_id', $event_ticket_template)->with('eventTicket',$eventTicket)->with('event',$event); 
         }else{
            return redirect()->back()->with('flash_message','Ticket not exist');
         }
         

    }

    public function editTicketDesign(request $request, $id){

        $eventticket = EventTicket::find($id);
        $eventticket->user_id = Auth::user()->id;
        $eventticket->font_color = $request->colours;
        $eventticket->back_font_colour = $request->back_colours;
        $eventticket->logo_color = $request->logocolours;
        $path = 'images/events/';
        if($request->background_picture){
        $eventticket->background_image = uploadFileWithAjax($path, $request->background_picture);
        }
        if($request->back_cover_background_picture){
        $eventticket->back_cover_background_picture = uploadFileWithAjax($path, $request->back_cover_background_picture);
        }
        if($request->picture){
            $eventticket->picture=uploadFileWithAjax($path,$request->picture);
        }
        $eventticket->template_text = $request->template_text;
        $eventticket->template_backcover_text = $request->template_backcover_text;
        $eventticket->font_color = $request->colours;
        $eventticket->header_content=$request->header_content;
        $eventticket->theme_color=$request->theme_color;
        $eventticket->ticket_right_side=$request->ticket_right_side;
        if($eventticket->save()){
            $inventory_country=$request->inventory_country;
            for($i=0;$i<$inventory_country;$i++){
                RegistrationType::where('id',$request->input('inventory_id_'.$i))->update([
                  "inventory"=>$request->input('quantity_'.$i),
                  "price"=>$request->input('price_'.$i),
                  "description"=>$request->input('description_'.$i)
                ]);
            }
        }
        return redirect()->back()->with('flash_message', 'Ticket Inserted Successfuly!');
    }
}