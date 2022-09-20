<?php

namespace App\Http\Controllers\Home\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\BusinessReview;
use App\VendorCategory;
use Gmopx\LaravelOWM\LaravelOWM;
use App\VendorVacation;
class ServiceDetailController extends Controller
{
    
 public $folderPath ='home.business.services.detail';

#-----------------------------------------------------------------------
#     Service Page 
#-----------------------------------------------------------------------

public function index()
{
	 
	return view($this->folderPath.'.index');
}

#-----------------------------------------------------------------------
#     Service Page 
#-----------------------------------------------------------------------


public function index2(Request $request, $cateSlug, $vendorSlug)
{
     $category = Category::where('slug', $cateSlug);
	 $vendorCategory = VendorCategory::with([
	 	'VendorPackage' => function($vp){
	 		return $vp->where('status', 1)->get();
	 	} 
	 ])->where('publish', 1);

     $status  = VendorCategory::where('business_url',$vendorSlug)->first();
     if($status->listing_active == 0 || $status->listing_active == 2)
     {
          abort(404);
     }
	 if($category->count() == 0 || $vendorCategory->count() == 0 ){
	 	abort(404);
	 }
     
      
      $vendor =  $vendorCategory->where('business_url',$vendorSlug)->where('status', 3)->first();
   
      $recommendedVendor =  VendorCategory::where('category_id',$category->first()->id)
											     ->where('id','!=',$vendor->id)
											     ->where('publish', 1)
											     ->where('status', 3)
											     ->paginate(5);

     $event = \App\VendorEventGame::with('Event')->where('category_id',$category->first()->id)->where('user_id',$vendor->user_id);

     $amenities = \App\VendorAmenity::
                                   join('category_variations','category_variations.category_id','=','vendor_amenities.category_id')
                                   ->select('vendor_amenities.*')
                                   ->where('vendor_amenities.category_id',$category->first()->id)
                                   ->where('vendor_amenities.type','amenity')
                                   ->where('vendor_amenities.user_id',$vendor->user_id)
                                   ->groupBy('vendor_amenities.amenity_id');
 
     $games = \App\VendorAmenity::join('category_variations','category_variations.category_id','=','vendor_amenities.category_id')                            ->select('vendor_amenities.*')
                                   ->where('vendor_amenities.category_id',$category->first()->id)
                                   ->where('vendor_amenities.type','game')
                                   ->where('vendor_amenities.user_id',$vendor->user_id)
                                   ->groupBy('vendor_amenities.amenity_id');


                            
  $packages = \Request::route()->getName() == "home.vendor.customPackage" ? $vendor->CustomPackages : $vendor->VendorPackage;
  $vacations = \App\VendorVacation::where('vendor_id',$vendor->user_id)->get();
  

  $reviews = BusinessReview::where('admin_approval', 1)->where('vendor_category_id', $vendor->id)->orderBy('updated_at', 'DESC')->get();
  $reviews5 = BusinessReview::where('admin_approval', 1)->where('vendor_category_id', $vendor->id)->where('rating', 5)->get();
  $reviews4 = BusinessReview::where('admin_approval', 1)->where('vendor_category_id', $vendor->id)->where('rating', 4)->get();
  $reviews3 = BusinessReview::where('admin_approval', 1)->where('vendor_category_id', $vendor->id)->where('rating', 3)->get();
  $reviews2 = BusinessReview::where('admin_approval', 1)->where('vendor_category_id', $vendor->id)->where('rating', 2)->get();
  $reviews1 = BusinessReview::where('admin_approval', 1)->where('vendor_category_id', $vendor->id)->where('rating', 1)->get();
 
return view($this->folderPath.'.index')
  ->with('games',$games)
  ->with('amenities',$amenities)
  ->with('events',$event)
  ->with('styles',$vendor->styles)
  ->with('services', $vendor->subcategory)
  ->with('VendorEvents', $vendor->VendorEvents)
  ->with('seasons',$vendor->seasons)
  ->with('packages',$packages)
  ->with('vacations',$vacations)
  ->with('recommendedVendor',$recommendedVendor)
  ->with('reviews', $reviews)
  ->with('reviews5', $reviews5)
  ->with('reviews4', $reviews4)
  ->with('reviews3', $reviews3)
  ->with('reviews2', $reviews2)
  ->with('reviews1', $reviews1)
  ->with('vendor',$vendor);

}

#-----------------------------------------------------------------------
#     Service Page 
#-----------------------------------------------------------------------


public function getStyleOfThisVendor($styles,$relation,$col)
{
	$arr = [];
	if($styles->count() > 0){
		foreach ($styles as $s) {
			 array_push($arr, $s->$relation->$col);
		}


	}
	return count($arr) > 0 ? implode(', ', $arr) : '';
}

public function getweather(Request $req) {
	$weather_api_key = getAllValueWithMeta('weather_api_key', 'global-settings');
	// $weather_api_key = '8b9eccd531cf8de092a195b4d5c2d869';

	$headers = [
        'Content-Type: application/json',
   	];
    
    $weather = curl_init();
    if($req->time) {
      // $req->time = \Carbon\Carbon::parse($req->time)->timestamp;
    	$req->time = \Carbon\Carbon::parse($req->time)->addDay()->timestamp;
    
		$url = "https://api.darksky.net/forecast/$weather_api_key/$req->latitude,$req->longitude,$req->time,$weeks_days";
    } else {
    $url = "https://api.darksky.net/forecast/$weather_api_key/$req->latitude,$req->longitude";
    }

    curl_setopt($weather, CURLOPT_URL, $url);
    curl_setopt($weather, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($weather, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($weather);
    curl_close ($weather);
    $weather_json = json_decode($server_output, true);
    

    return response()->json($weather_json);
    
}

public function get_weather(Request $req) {
  $weather_api_key = getAllValueWithMeta('weather_api_key', 'global-settings');
  // $weather_api_key = '8b9eccd531cf8de092a195b4d5c2d869';
  $headers = [
        'Content-Type: application/json',
    ];
    $weather = curl_init();
    if($req->time) { 
      $current_time=\Carbon\Carbon::now();
      $current_time=$current_time->toTimeString();
      $time= \Carbon\Carbon::parse($req->time.'00:00:00')->addDay()->setTimezone('UTC')->timestamp;
    $url = "https://api.darksky.net/forecast/$weather_api_key/$req->latitude,$req->longitude,$time";
    } else {
    $url = "https://api.darksky.net/forecast/$weather_api_key/$req->latitude,$req->longitude";
    }
    curl_setopt($weather, CURLOPT_URL, $url);
    curl_setopt($weather, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($weather, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($weather);
    curl_close ($weather);
    $weather_json = json_decode($server_output, true);
    return response()->json($weather_json);
    // return response()->json($weather_json);
    
}
 

}
