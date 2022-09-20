<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralSettingTrait;
use App\UserEvent;
use App\UserEventGroup;
use App\UserEventMenu;
use App\UserEventGuest;
use App\DefaultGroup;
use Auth;
use PDF;
use Redirect;
use App\Traits\EmailTraits\EmailNotificationTrait;
use Excel;
use Twilio\Rest\Client;

class GuestListController extends Controller
{
	use GeneralSettingTrait;
	use EmailNotificationTrait;
	public $filePath = 'tools.guestlist.';

    public function index($slug){
    	$user_event = UserEvent::FindBySlugOrFail($slug);
    	$checkgroup = UserEventGroup::where('user_event_id', $user_event->id)->where('user_id', Auth::user()->id)->first();
    	$checkmenu = UserEventMenu::where('user_event_id', $user_event->id)->where('user_id', Auth::user()->id)->first();
    	if(empty($checkgroup)){
    		$defaultgroups = DefaultGroup::where('event_type_id', $user_event->event_type)->where('status', 1)->get();
    		$record = new UserEventGroup;
			$record->user_id = Auth::user()->id;
			$record->user_event_id = $user_event->id;
			$record->group_label = 'unassigned';

			$record->save();
    		if(!empty($defaultgroups[0]->id)){
	    		foreach($defaultgroups as $defaultgroup){
		    		$record = new UserEventGroup;
					$record->user_id = Auth::user()->id;
					$record->user_event_id = $user_event->id;
					$record->group_label = $defaultgroup->group_label;

					$record->save();
				}
			}
    	}

    	if(empty($checkmenu)){
    		$defaultmenus = array('Adults', 'Children', 'unassigned');
    		for($i=0; $i<count($defaultmenus); $i++){
	    		$record = new UserEventMenu;
				$record->user_id = Auth::user()->id;
				$record->user_event_id = $user_event->id;
				$record->menu_label = $defaultmenus[$i];

				$record->save();
			}
    	}

    	$user_event_groups = UserEventGroup::where('user_id', Auth::user()->id)->where('user_event_id', $user_event->id)->get();
    	$user_event_menus = UserEventMenu::where('user_id', Auth::user()->id)->where('user_event_id', $user_event->id)->get();
    	$slug = 'guest-tool';
    	return view('tools.guestlist.index', $this->getArrayValue($slug))->with(['user_event_groups' => $user_event_groups, 'user_event_menus' => $user_event_menus, 'user_event'=> $user_event]);
    }

    public function ajax_getgroups(Request $request){
    	$event_id = $request->event_id;
    	$search_text = $request->search_text;
    	$user_event_groups = UserEventGroup::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->get();
    	$user_event_menus = UserEventMenu::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->get();

        $vv = view('tools.guestlist.groups')
              ->with('user_event_groups', $user_event_groups)
              ->with('user_event_menus', $user_event_menus)
              ->with('search_text', $search_text);

        return response()->json([
            'status' => 1,
            'html' => $vv->render()
        ]);
    }

    public function ajax_getmenus(Request $request){
    	$event_id = $request->event_id;
    	$search_text = $request->search_text;
    	$user_event_menus = UserEventMenu::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->get();

        $vv = view('tools.guestlist.menus')
              ->with('user_event_menus', $user_event_menus)
              ->with('search_text', $search_text);

        return response()->json([
            'status' => 1,
            'html' => $vv->render()
        ]);
    }

    public function ajax_getstats(Request $request){
    	$event_id = $request->event_id;
    	$user_event_guests = UserEventGuest::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->get();
    	$guests_attending = UserEventGuest::where('user_id', Auth::user()->id)
    	->where('user_event_id', $event_id)
    	->where('attendance', 1)->get();
    	
    	$guests_pending = UserEventGuest::where('user_id', Auth::user()->id)
    	->where('user_event_id', $event_id)
    	->where('attendance', 0)->get();
    	
    	$guests_declined = UserEventGuest::where('user_id', Auth::user()->id)
    	->where('user_event_id', $event_id)
    	->where('attendance', 2)->get();

        $vv = view('tools.guestlist.stats')
              ->with('user_event_guests', $user_event_guests)
              ->with('guests_attending', $guests_attending)
              ->with('guests_pending', $guests_pending)
              ->with('guests_declined', $guests_declined);

        return response()->json([
            'status' => 1,
            'html' => $vv->render()
        ]);
    }

    public function ajax_getattendance(Request $request){
    	$event_id = $request->event_id;
    	$search_text = $request->search_text;
    	

    	if(!empty($request->search_text)){
    		$user_event_attending = UserEventGuest::where('user_id', Auth::user()->id)
    			->where('user_event_id', $event_id)
    			->where('attendance', 1)
    			->where('fname', 'like', '%' . $search_text . '%')
    			->get();
    		
    		$user_event_pending = UserEventGuest::where('user_id', Auth::user()->id)
    			->where('user_event_id', $event_id)
    			->where('attendance', 0)
    			->where('fname', 'like', '%' . $search_text . '%')
    			->get();

    		$user_event_declined = UserEventGuest::where('user_id', Auth::user()->id)
    			->where('user_event_id', $event_id)
    			->where('attendance', 2)
    			->where('fname', 'like', '%' . $search_text . '%')
    			->get();
    	}else{

    		$user_event_attending = UserEventGuest::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->where('attendance', 1)->get();
    		dd($user_event_attending);

    		$user_event_pending = UserEventGuest::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->where('attendance', 0)->get();

    		$user_event_declined = UserEventGuest::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->where('attendance', 2)->get();
    	}
    	

    	$user_event_menus = UserEventMenu::where('user_id', Auth::user()->id)->where('user_event_id', $event_id)->get();

        $vv = view('tools.guestlist.attendance')
              ->with('user_event_attending', $user_event_attending)
              ->with('user_event_pending', $user_event_pending)
              ->with('user_event_menus', $user_event_menus)
              ->with('user_event_declined', $user_event_declined);

        return response()->json([
            'status' => 1,
            'html' => $vv->render()
        ]);
    }

    public function ajax_addgroup(Request $request){
    	$event_id = $request->event_id;
   		$user_id = Auth::user()->id;

    	if(!empty($request->group_id)){
    		$rec = UserEventGroup::find($request->group_id);
    		$rec->group_label = $request->group_label;
    		$rec->save();
			return response()->json([
				'status' => 0,
	            'id' => $rec->id,
	            'label' => $rec->group_label
	        ]);
    	}else{
			$rec  = new UserEventGroup;
			$rec->group_label = $request->group_label;
			$rec->user_id = $user_id;
			$rec->user_event_id = $event_id;
			$rec->save();
			return response()->json([
				'status' => 1,
	            'id' => $rec->id,
	            'label' => $rec->group_label
	        ]);
		}
	}

	public function ajax_addmenu(Request $request){
   		$event_id = $request->event_id;
   		$user_id = Auth::user()->id;
   		if(!empty($request->menu_id)){
    		$rec = UserEventMenu::find($request->menu_id);
    		$rec->menu_label = $request->menu_label;
    		$rec->menu_description = $request->menu_description;
    		$rec->save();
			return response()->json([
				'status' => 0,
	            'id' => $rec->id,
	            'label' => $rec->menu_label
	        ]);
    	}else{
			$rec  = new UserEventMenu;
			$rec->user_id = $user_id;
			$rec->user_event_id = $event_id;
			$rec->menu_label = $request->menu_label;
			$rec->menu_description = $request->menu_description;
			$rec->save();
			return response()->json([
				'status' => 1,
	            'id' => $rec->id,
	            'label' => $rec->menu_label
	        ]);
		}	
	}

	public function ajax_addguest(Request $request){
		$event_id = $request->event_id;
		$event = UserEvent::find($request->event_id);
   		$user_id = Auth::user()->id;

   		if(!empty($request->guest_id)){
   			$rec = UserEventGuest::find($request->guest_id);
			$email = $rec->email;
			$rec->user_event_group_id = $request->group;
			$rec->user_event_menu_id = $request->menu;
			$rec->fname = $request->fname;
			$rec->lname = $request->lname;
			$rec->age = $request->age;
			$rec->email = $request->email;
			$rec->attendance = $rec->attendance;
			$rec->contact_no = $request->contact_no;
			$rec->gender = $request->gender;
			$rec->save();
			if($email != $request->email){
				$guest = UserEventGuest::find($rec->id);
				$this->GuestInvitationTrait($guest);
			}
   		}else{
			$rec  = new UserEventGuest;
			$rec->user_id = $user_id;
			$rec->user_event_id = $event_id;
			$rec->user_event_group_id = $request->group;
			$rec->user_event_menu_id = $request->menu;
			$rec->fname = $request->fname;
			$rec->lname = $request->lname;
			$rec->age = $request->age;
			$rec->email = $request->email;
			$rec->attendance = 0;
			$rec->contact_no = $request->contact_no;
			$rec->gender = $request->gender;

			$rec->save();
			$return_id = $rec->id;

			// to send SMS
			//$receiverNumber = "+918427006594";
			$receiverNumber = $request->contact_no;
			$accept_url = url('/')."/thanks/".$return_id."/1";
    		$decline_url = url('/')."/thanks/".$return_id."/2";
        	$message = "Hello {$request->fname}, This is to invite you on the {$event->title} on the following location {$event->location}. To accept the inviation please click on the follwoing link:  {$accept_url} or to Decline the invitation please click on the following link: {$decline_url}";

			$account_sid = getenv("TWILIO_ACCOUNT_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);

            //end SMS

			$guest = UserEventGuest::find($return_id);
			$this->GuestInvitationTrait($guest);
		}
	}

	public function ajax_updateAttMenu(Request $request){
		$user_guest = UserEventGuest::find($request->id);
		if($request->label == 'menu'){
			$user_guest->user_event_menu_id = $request->value;
		}elseif($request->label == 'attendance'){
			$user_guest->attendance = $request->value;
		}
		$user_guest->save();
	}

	public function ajax_removeGroupMenu(Request $request){
		if($request->label == 'menu'){
			$rec = UserEventMenu::find($request->id);
			$unassigned_menu = UserEventMenu::where('user_id', Auth::user()->id)->where('user_event_id', $request->event_id)->where('menu_label', 'unassigned')->first();
			$data = UserEventGuest::where('user_event_menu_id', $request->id)->get();
			if(!empty($data[0]->id)){
				foreach($data as $dat){
					$dat->user_event_menu_id = $unassigned_menu->id;
					$dat->save();
				}
			}
		}elseif($request->label == 'group'){
			$rec = UserEventGroup::find($request->id);
			$data = UserEventGuest::where('user_event_group_id', $request->id)->get();
			$unassigned_group = UserEventGroup::where('user_id', Auth::user()->id)->where('user_event_id', $request->event_id)->where('group_label', 'unassigned')->first();
			if(!empty($data[0]->id)){
				foreach($data as $dat){
					$dat->user_event_group_id = $unassigned_group->id;
					$dat->save();
				}
			}
		}elseif($request->label == 'guest'){
			$rec = UserEventGuest::find($request->id);
		}
		$rec->delete();
	}

	public function thanks($id, $status){
		if($status == 1 || $status == 2){
			if($status == 1){
				$guest = UserEventGuest::find($id);
				if(!empty($guest)){
					$guest->attendance = 1;
					$guest->save();
					$info = 1;
				}else{
					abort(404);
				}
			}elseif($status == 2){
				$guest = UserEventGuest::find($id);
				if(!empty($guest)){
					$guest->attendance = 2;
					$guest->save();
					$info = 2;
				}else{
					abort(404);
				}
			}
			return view('tools.guestlist.thankyou')->with(['info' => $info]);
		}
		else{
			abort(404);
		}
	}

	public function printFunction(Request $request, $slug)
	{
		$user_event = UserEvent::FindBySlugOrFail($slug);
	        $guestlistEntries = UserEventGuest::where('user_event_id', $user_event->id)
	        ->where('user_id', Auth::user()->id)
	        ->get();
	    return $vv = view($this->filePath.'includes.print')
	  	      ->with('guestlistEntries',$guestlistEntries)
	  	      ->with('event',$user_event);
	}

	public function getPDFBudget(Request $request, $slug)
	{
	    $user_event = UserEvent::FindBySlugOrFail($slug);
        $guestlistEntries = UserEventGuest::where('user_event_id',$user_event->id)
        ->where('user_id', Auth::user()->id)
        ->get();

        $vv = view($this->filePath.'includes.pdf')
      	      ->with('guestlistEntries',$guestlistEntries)
      	      ->with('event',$user_event);

		$pdf = PDF::loadView($this->filePath.'includes.pdf', [
		'guestlistEntries' => $guestlistEntries,
		'event' => $user_event
		]);
		return $pdf->download('guestlist.pdf');
	      
	}

	public function downloadExcel($slug, $type)
	{
		$user_event = UserEvent::FindBySlugOrFail($slug);
		$guest_data = UserEventGuest::where('user_event_id', $user_event->id)
		->where('user_id', Auth::user()->id)
		->get()->toArray();

		$guestlist_array = array();
		$heading_data = array();
        $i = 1;
        $heading_data[] = array(
            "fname",
            "lname",
            "age",
            "gender",
            "group",
            "email",
            "contact_no",
            "menu",
            );

        $guestlist_array = $heading_data;

          
            $column_data = array(
            'test',
            'test',
            '25',
            'male',
            'friends',
            'patrickphp2@gmail.com',
            '9999999999',
            'adults',
            );
            array_push($guestlist_array,$column_data);  

		return Excel::create('guestlist_example', function($excel) use ($guestlist_array) {
			$excel->sheet('mySheet', function($sheet) use ($guestlist_array)
	        {
				$sheet->fromArray($guestlist_array, null, 'A1', false, false);
	        });
		})->download('csv');
	}

	public function importExcel(Request $request)
	{

		$user_event = UserEvent::find($request->event_id);
		$file = $request->file('import_file');
        if($file){
            $path = $file->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
					$insert[] = ['fname' => $value->fname, 'lname' => $value->lname, 'gender' => $value->gender, 'age' => $value->age, 'email' => $value->email, 'contact_no' => $value->contact_no, 'user_id' => Auth::user()->id, 'user_event_id' => $user_event->id, 'group'=> $value->group, 'menu'=> $value->menu];
					
				}
                if(!empty($insert)){
                    foreach($insert as $ins){
                    	if((!empty($ins['fname'])) && (!empty($ins['lname'])) && (!empty($ins['age'])) && (!empty($ins['gender'])) && (!empty($ins['email'])) && (!empty($ins['contact_no']))){

                    		$g = UserEventGroup::where('user_event_id', $user_event->id)->where('user_id', Auth::user()->id)->where('group_label', 'unassigned')->first();
                    		

                    		if(empty($ins['group'])){
                    			$group_id = $g->id;
                    		}else{
								$group_label = $ins['group'];
								$gr = UserEventGroup::where('user_event_id', $user_event->id)->where('user_id', Auth::user()->id)->where('group_label', $group_label)->first();
                    			if(!empty($gr->id)){
                    				$group_id = $gr->id;
                    			}else{
                    				$group_id = $g->id;
                    			}
                    		}

                    		$m = UserEventMenu::where('user_event_id', $user_event->id)->where('user_id', Auth::user()->id)->where('menu_label', 'unassigned')->first();

                    		if(empty($ins['menu'])){
                    			$menu_id = $m->id;
                    		}else{
								$menu_label = $ins['menu'];
								$mr = UserEventMenu::where('user_event_id', $user_event->id)->where('user_id', Auth::user()->id)->where('menu_label', $menu_label)->first();
								if(!empty($mr->id)){
                    				$menu_id = $mr->id;
                    			}else{
                    				$menu_id = $m->id;
                    			}
                    		}
                    		

                    		

	                		$rec = new UserEventGuest;
	                		$rec->fname = $ins['fname'];
	                		$rec->lname = $ins['lname'];
	                		$rec->age = $ins['age'];
	                		$rec->gender = $ins['gender'];
	                		$rec->email = $ins['email'];
	                		$rec->contact_no = $ins['contact_no'];
	                		$rec->user_event_group_id = $group_id;
	                		$rec->user_event_menu_id = $menu_id;
	                		$rec->user_id = Auth::user()->id;
	                		$rec->user_event_id = $user_event->id;
	                		$rec->attendance = 0;
	                		$rec->save();

	                		// to send SMS
							$receiverNumber = "+918427006594";
				        	$message = "This is testing from dev";

							$account_sid = getenv("TWILIO_ACCOUNT_SID");
				            $auth_token = getenv("TWILIO_AUTH_TOKEN");
				            $twilio_number = getenv("TWILIO_FROM");
				  
				            $client = new Client($account_sid, $auth_token);
				            $client->messages->create($receiverNumber, [
				                'from' => $twilio_number, 
				                'body' => $message]);
				            
				            //end SMS

							$guest = UserEventGuest::find($rec->id);
							$this->GuestInvitationTrait($guest);
						}
                    }
                }
            }
        }

    return response()->json(['success' => 1]);
    }
}
