<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserEvent;
use App\FavouriteVendor;
use Hash,DB;
use Carbon\Carbon;
use App\VendorCategory;
use App\Traits\EmailTraits\EmailNotificationTrait;

class DashboardController extends Controller {

  use EmailNotificationTrait;

#----------------------------------------------------------------------
#    dashboard function
#----------------------------------------------------------------------
 
public function index($status='upcoming') {
         $u = User::find(Auth::user()->id);
         $u->user_active = 1;
         $u->save();
        $events = UserEvent::where(['user_id' => Auth::User()->id])
        ->where(function($t) use($status){
            if($status == 'upcoming'){
                $t->whereDate('start_date','>',date('Y-m-d'));
            }
        })
        ->where('event_status', 1)
        ->OrderBy('start_date','ASC')
        ->paginate(10);
	return view('users.dashboard.dashboard')->with('events', $events);
}

public function profile() {
	return view('users.profile');
}

public function stats() {
  return view('users.dashboard.stats');
}

public function updateProfile(Request $request) {
	$user = Auth::User();
	if($request->old_password) {
		if(Hash::check($request->old_password, $user->password)) {
	      $user->password = Hash::make($request->password);         
	      $user->save();
	      // Auth::logout();
	      return redirect()->back()->with('flash_message', 'Password has updated successfully');
	    } else {
	      return redirect()->back()->with('error_flash_message', 'Please enter currect Old Password');
	    }
	}

	if($request->hasFile('image')) {
     $path = 'images/vendors/profile/';
     $request['profile_image'] = uploadFileWithAjax($path, $request->image);
     if($user->profile_image != 'user.jpg') {
        if($user->profile_image && file_exists($path.$user->profile_image)) {
            unlink($path.$user->profile_image);
        }
     }
 	}
    
     $user->update($request->all());  
     User::where('id',Auth::id())->update([
        "latitude"=>$request->latitude,
        "longitude"=>$request->longitude
     ]); 
     if($request->address_id){
        DB::table('address_details')->where('id',$request->address_id)->update([
             "user_id"=>Auth::id(),
             "country"=>$request->country,
             "state"=>$request->state,
             "city"=>$request->city,
             "country_short_code"=>$request->country_short_code,
             "zipcode"=>$request->zipcode
       ]);
     }else{
      DB::table('address_details')->insert([
            "user_id"=>Auth::id(),
            "country"=>$request->country,
            "state"=>$request->state,
            "city"=>$request->city,
            "country_short_code"=>$request->country_short_code,
            "zipcode"=>$request->zipcode
      ]);
     }
     
     return redirect()->back()->with('flash_message', "Your Profile has updated successfully"); 
}

	public function addFavouriteVendors($id) {
		$favourite_vendor = FavouriteVendor::where('vendor_id', $id)->first();
		if($favourite_vendor) {
          $favourite_vendor->delete();
		  return response()->json(['message'=> 'Your favourite vendor has been removed successfully', 'status' => false ]);
		}
            $user = Auth::User();
            $meta = new FavouriteVendor;
            $meta->vendor_id = $id;
            $meta->user_id = $user->id;
            $meta->save();
        return response()->json(['message'=> 'Your favourite vendor has been saved successfully', 'status' => true ]);
    }

    public function favouriteVendors() {
        $favourite_vendors = FavouriteVendor::paginate(10);
        return view('users.favourite-vendor.index')->with(['favourite_vendors'=> $favourite_vendors]);
    }

    public function deleteFavouriteVendor(Request $request) {
        if($request->id) {
	        FavouriteVendor::find($request->id)->delete();
	        return redirect()->back()->with('flash_message', 'Your favourite vendor has been deleted successfully');
        }
    }

    public function vendorForm(){
      return view('users.becomeVendor');
    }

    public function userAsVendor(Request $request){
      $user_id = Auth::user()->id;
      $u = User::find($user_id);
      if(!empty($u)){

        $id_proof = uploadFileWithAjax('videos/vendors/cover/',$request->file('id_proof'));

        $u->user_location = $request->user_location;
        $u->phone_number = $request->phone_number;
        $u->user_location = $request->location;
        $u->latitude = $request->latitude;
        $u->longitude = $request->longitude;
        $u->website_url = $request->website_url;
        $u->ein_bs_number = $request->ein_bs_number;
        $u->age = Carbon::parse($request->age)->format('Y-m-d');
        $u->id_proof = $id_proof;
        $u->vendor_status = 0;
        $u->refer_data = $this->getReferAccount($request);
        $u->role = 'vendor';
        if($u->save() && $this->addBusinessCategories($request,$u->id) == 1) {

              $u->sendEmailVerificationNotification();
              $this->NewVendorEmailSuccess($u);
             return redirect()->route('become-a-vendor');
        }
      }
    }

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

    public function addBusinessCategories($request,$user_id)
    {
      foreach ($request->categories as $key => $value) {
            
        $parent = $this->categorySave($value,0,$user_id);
      }
      return 1;
    }

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
    public function profile_deactivation(Request $request)
    {
       $u= User::find(Auth::user()->id);
       $u->user_active = 0;
       $u->save();
        Auth::logout();
        return redirect('/login')->with('messages','Your Account is deactivated.');
    }
}
