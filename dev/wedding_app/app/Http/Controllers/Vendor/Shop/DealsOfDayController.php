<?php

namespace App\Http\Controllers\Vendor\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\Product;
use App\DealsOfDay;
use Auth;
class DealsOfDayController extends Controller
{
	//This section is on hold because client doesn't give us the permision for this section.
	//Table is already migrated in database.
    public $filePath = 'vendors.E-shop.dealsofday.';
    public $msg="Try again later....";
    #==========================================================================
    public function index(request $request)
    {
    	try{
    	$product=Product::find($request->id);
    	if($product){
    		return view($this->filePath.'index')
    	   ->with('title','Deals of Day')
    	   ->with('product',$product);

    	}
    	}catch (\Exception $e) {
           $this->msg=$e->getMessage();
        }
        return redirect()->back();
}


}
