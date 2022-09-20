<?php

namespace App\Http\Controllers\Vendor\Shop;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\NegotiationValidation;
use App\Models\Shop\ShopCartItems;
use App\Models\Products\Product;
use App\Models\NegotiationDiscount as NG;
use App\Traits\EmailTraits\NegotiationDiscountEmailTraitNotification;
use Auth;
class NegotiationDiscount extends Controller
{
    use NegotiationDiscountEmailTraitNotification;
    public $filePath = 'vendors.E-shop.negotiation.';
    #==========================================================================


public function index()
{
	$route="vendor.negotiable_coupon.add";
    $coupons=NG::where('vendor_id',Auth::id())->paginate(20);
    return view($this->filePath.'index')->with('coupons',$coupons)->with('route',$route);
}

public function showCreate(){
    return view($this->filePath.'create')->with('title','Create Negotiation Coupon');
}

public function Create(NegotiationValidation $R){
  $insert=new NG;
    $insert->vendor_id=Auth::user()->id;
    $insert->product_id=$R->product;
    $insert->type=$R->negotiation_discount_type;
    $insert->coupon=strtoupper($R->coupon_code);
    $insert->email=$R->customer_email;
    $insert->amount=$R->amount;
    $insert->save();
    $this->NegotiationEventTrait(NG::find($insert->id));
    return redirect()->route('vendor.negotiable_coupon')->with('flash_message', 'Coupon has been created successfully!');
}

public function searchProduct(request $request){
   $search=$request->searchTerm;
   $data=Product::select('id','name as text')->Where('name', 'like', '%' . $search . '%')->where([['user_id',Auth::user()->id],['parent',0]])->limit(10)->get();
   return json_encode($data);
}

public function toggleStatus(request $R){
    $coupon=NG::find($R->id);
    if($coupon->is_used){
        $coupon->is_active=NG::IN_ACTIVE;
    }else{
        $coupon->is_active=$coupon->is_active?NG::IN_ACTIVE:NG::ACTIVE;
    }
    $coupon->save();
    return redirect()->back()->with('flash_message', 'Coupon status has been change successfully to In Active.');
}

public function ProductPrice(request $R){
    dd(Auth::id());
    $data=Product::whereId($R->product)->pluck('final_price');
    return $data;
}

public function checkCoupon(NegotiationValidation $R){
      return 1;
}

}
