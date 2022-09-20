<?php

namespace App\Http\Controllers\Vendor\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\PurchasePackageProduct;
use Auth,DB;
class FeaturedProductCategoryController extends Controller
{
 public $filePath = 'vendors.E-shop.featured.';
 #==========================================================================
 public function index()
 { 
	return view($this->filePath.'index');
 }
 #===========================================================================
 public function assignFeaturedCategory(request $request)
 { 
    $purchasePackage=PurchasePackageProduct::where('user_id',Auth::id())->where('status',1)->first();
    $package=Package::where('id',$purchasePackage->package_id)->first();
    if(!$request->categories){
    DB::table('featured_category_user')->where('user_id',Auth::id())->delete();
    }
    if($request->categories){
    if(count($request->categories) > $purchasePackage->category_count){
        return response()->json(['status'=>422,'message'=>'Select categories according to your plan or for more benefit upgrade your plan','success'=>false],422);
    }else{
    	if($request->categories){
    		  DB::table('featured_category_user')->where('user_id',Auth::id())->delete();
              foreach ($request->categories as $key => $value) {
                     DB::table('featured_category_user')->insert([
                    "category_id"=>$value,
                    "package"=> $package->id,
                    "user_id"=>Auth::id(),
                    "purchase_package"=>$purchasePackage->id
             ]);
              }
    	
    	}

    } 
    }
        
         return response()->json(['status'=>200,'message'=>"Featured Category Updated",'success'=>true],200);
    }
 

}
