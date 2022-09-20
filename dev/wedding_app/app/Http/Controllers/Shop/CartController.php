<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
use App\Models\Products\Product;
use Auth;
use App\Models\Vendors\Eshop;
use App\Models\Products\ProductCategory;
use App\Models\Shop\ShopCategory;
use App\Models\Products\ProductInventory;
use App\Models\Products\ProductImage;
use App\Models\Products\ProductAssignedVariation;
use App\Models\NegotiationDiscount;
use Cart;
use App\Traits\ProductCart\AddCartItemTrait;
use App\Models\Shop\ShopCartItems;
use App\Traits\Shipment\ShipmentTrait;
use App\User;
class CartController extends Controller
{

	 use AddCartItemTrait;
	 use ShipmentTrait;
	 public $filePath = 'e-shop.modules.cart.';
	 public $include = 'e-shop.includes.cart.';


#=====================================================================================================
#=====================================================================================================
#=====================================================================================================


public function index(Request $request)
{   
	// $new = ShopCartItems::with('choosedVariation','choosedVariation.inventoryWithVariation')->get();
 //    return $new;
	return view($this->filePath.'index');
}

public function productPrice(Request $request,$product_id){
	$ProductVariantPriceHtml=$this->ProductVariantPriceHtml($request,$product_id);
    return response()->JSON($ProductVariantPriceHtml);
} 

#=====================================================================================================
#=====================================================================================================
#=====================================================================================================

public function cartOperations(Request $request)
{

	// $getContent = Cart::getContent();

	// echo '<pre>';
	// print_r($getContent);

	// die();
	$type = $request->type;
	 switch ($type) {
	 	case 'add':
	 		 return $this->addQty($request,1);
	 		break;
	 	case 'sub':
	 		return $this->addQty($request,0);
	 		break;
	    case 'remove':
	 		return $this->addQty($request,2);
	 		break;
	 	case 'list':
	 		return $this->listItemOfcart();
	 		break;
	 	
	 	default:
	 		# code...
	 		break;
	 }
}
#====================================================================================================
#====================================================================================================
#====================================================================================================

public function addQty($request,$val)
{
       $rowId = $request->id;
	 if(Auth::check() && Auth::user()->role == "user"){

	 	$userCart = ShopCartItems::where('user_id',Auth::user()->id)->where('id',$rowId);

	 	 if($userCart->count() > 0){
	 	 	if($val == 2) {
	 	 		$CouponAppliedOnMultipleVariant=ShopCartItems::where('negotiation_discounts_id',$userCart->pluck('negotiation_discounts_id'))->whereType('cart')->whereUserId(Auth::id())->count();
	 	 		if($CouponAppliedOnMultipleVariant <= 1){
	 	 		   NegotiationDiscount::whereId($userCart->pluck('negotiation_discounts_id'))
	 	 		   ->update([
                    "is_active"=>NegotiationDiscount::ACTIVE,
                    "is_used"=>NegotiationDiscount::NOT_USED                  
	 	 		   ]);
	 	 		}
                 $userCart->delete();
	 	 	}else{
		 	 	$c = $userCart->first();
		 	 	$qty = $val == 1 ? ($c->quantity + 1) : abs($c->quantity - 1);
		 	 	$c->quantity = $qty;
		 	 	$c->total = ($qty * $c->price);
		 	 	$c->save();
	 	   }

	 	 }

	 }else{
		  $rowId = $request->id;
          $cart = Cart::get($rowId);
		  if($val == 2){
                 Cart::remove($rowId);
          }else{
			      $new = $val == 1 ? 1 : -1;
				    Cart::update($rowId,[
						'quantity' => $new
					]);
	      }

     }
      return  $this->listItemOfcart();


}

#====================================================================================================
#====================================================================================================
#====================================================================================================


public function listItemOfcart()
{ 
   $user_id = Auth::check() && Auth::user()->role == "user" ? Auth::user()->id : 0;
   $view = Auth::check() && Auth::user()->role == "user" ? 'withLogin' : 'withoutLoginCart';
   $userCart = ShopCartItems::where('user_id',$user_id)->where('type','cart');

   $vv = view($this->include.$view)->with('userCartContent',$userCart);
   $v = view($this->include.'totals')->with('userCartContent',$userCart);

   return [
        'status' => 1,
        'htm' => $vv->render(),
        'totals' => $v->render()
   ];
	
}


#====================================================================================================
#====================================================================================================
#====================================================================================================

public function isCouponValid(request $R){
	$status=400;
	$message="Not valid Coupon";
	$success=false;
    $check=NegotiationDiscount::whereCoupon(strtoupper($R->coupon_code))->whereProductId($R->product_id)->whereIsActive(NegotiationDiscount::ACTIVE)->first();
     if($check){
         $status=200;
         $message="Valid coupon";
         $success=true;
     }
    return response()->json([
     'status' => $status,
     'message' => $message,
     'success' => $success
    ]);
}


#====================================================================================================
#====================================================================================================
#====================================================================================================

public function shippingrates(request $request)
{
  $vendor=User::whereId($request->vendor)->first();
  $shipment_rates=$this->getShippingRates($vendor,$request);
  if($shipment_rates){
   return $shipment_rates->rate;
  }else{
  	return 0;
  }
}


}
