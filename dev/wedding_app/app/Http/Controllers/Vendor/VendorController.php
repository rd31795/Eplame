<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ShippingAddress;
use App\Http\Requests\vendorShipping;
use Auth;

class VendorController extends Controller
{
    

public $vendorCategories =0;
//public $user_id =\Auth::user()->id;
#---------------------------------------------------	
#  construct
#---------------------------------------------------

	public function __construct()
	 {	
	     $this->middleware('auth');
       $this->middleware(function ($request, $next) {
          if(Auth::user()->services->count() == 0){
          	return redirect()->route('vendor_category_assign');
          }
          return $next($request);
          
       });

      
		 
	}
#---------------------------------------------------	
#  construct
#---------------------------------------------------


public function checkCategoryOfVendor()
{
	     $vendorCategory = \App\VendorCategory::where('user_id',Auth::user()->id);
	    $this->vendorCategories = $vendorCategory->count();
}

#---------------------------------------------------  
#  dashboard
#---------------------------------------------------

   public function index(Request $request)
   {
         $u = User::find(Auth::user()->id);
         $u->vendor_active = 1;
         $u->save();
        $val = (!empty($request->type)) && $request->type == 2 ? 'e-shop' : 'event';
        \Session::put('currentVendorLink',$val);
       return view('vendors.dashboard');
   }


   public function payment() {
    return view('vendors.settings.payment');
   }

   public function updatePayment(Request $request) {
     Auth::User()->update($request->all());
     return redirect()->back()->with('flash_message', "Your Payment Settings has been changed successfully"); 
   }

#---------------------------------------------------	
#  vendor_profile
#---------------------------------------------------

   public function vendor_profile($value='')
   {
   	   return view('vendors.settings');
   }

#---------------------------------------------------  
#  vendor_profile
#---------------------------------------------------


public function vendorProfile(Request $request) {
   $this->validate($request,[
         'image' => 'image',
         'name' => 'required',
    ]);
     $path = 'images/vendors/profile/';
     $u = User::find(Auth::user()->id);
     $u->profile_image = $request->hasFile('image') ? uploadFileWithAjax($path,$request->file('image')) : $u->profile_image;
     $u->name = $request->name;
     $u->phone_number = $request->phone_number;
     $u->save();
    
     return redirect()->back()->with('flash_message',"Your Profile has been changed"); 
}
 


#---------------------------------------------------  
#  vendor_profile
#---------------------------------------------------

   public function password($value='')
   {
       return view('vendors.password');
   }

#---------------------------------------------------  
#  vendor_profile
#---------------------------------------------------




public function changePassword(Request $request)
{
              $this->validate($request,['old_password' => 'required','password' => ['required', 'string', 'min:6', 'confirmed']]);
                  $u= User::find(Auth::user()->id);
                 if (\Hash::check($request->old_password , $u->password))
                 {          
                             $u->password= \Hash::make($request->password);
                             $u->save();
                             return redirect()->back()->with('flash_message',"your password has been changed");
                      
                           
                 }else{
                                 
                                  
                        return redirect()->back()->with('old_password',"invalid old password");
                 }
      
}
public function vendor_profile_deactivation(Request $request)
    {
       $u= User::find(Auth::user()->id);
       $u->vendor_active = 0;
       $u->save();
        Auth::logout();
        return redirect('/login')->with('messages','Your Account is deactivated.');
    }


#------------------------------------------------------
#  Shipping Address Setting
#------------------------------------------------------

public function shippingAddress(){
    $address=ShippingAddress::whereVendorId(Auth::id())->First();
    return view('vendors.shippingaddress')->with(['address'=>$address]);
}

public function AddshippingAddress(vendorShipping $request){
     $insert=ShippingAddress::whereVendorId(Auth::id())->first();
     if(!$insert){
         $insert=new ShippingAddress;
     }
     $insert->vendor_id=Auth::id();
     $insert->phone_number=$request->phone_number;
     $insert->address=$request->address;
     $insert->country=$request->country;
     $insert->state=$request->state;
     $insert->city=$request->city;
     $insert->address_2=$request->address_2;
     $insert->zipcode=$request->zipcode;
     $insert->longitude=$request->longitude;
     $insert->latitude=$request->latitude;
     $insert->country_code=$request->country_short_code;
     $insert->save();
     return redirect()->back()->with('messages','Shipping Address Is updated successfully');

}
}


