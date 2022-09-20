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
use App\Models\Products\ProductAssignedVariation;
use App\Models\Products\ProductType;
use App\Models\Shop\ShopCartItems;
use DB;
class ProductFilterController extends Controller
{
   

    public $filePath = 'e-shop.modules.products.';
    public $include = 'e-shop.includes.products.';


#================================================================================
#================================================================================
#================================================================================


public function index(Request $request,$category_id)
{
 
     $simpleIds =$this->getSimpleProductId($request,$category_id);
     $ids = $this->getProductIDWIthFilters($request,$category_id);
     $compineIDS = array_merge($simpleIds,$ids);
     $filterArray=[
       'filters' => !empty($request) ? 1 : 0,
       'filterArr' => $compineIDS
     ];
   $Product = Product::select('products.*','featured_category_user.id as package_id')->has('eshop') 
                      ->where('childcategory_id',$category_id)
                      ->where('create_status',1)
                      ->where('approved_status',1)
                      ->where('products.status',1);
                     
                        $Product->where(function($t) use($filterArray){
                              if($filterArray['filters'] > 0){
                                 $t->whereIn('products.id',$filterArray['filterArr']);
                               }
                        })->where(function($t) use($request){
                               
                              if(!empty($request->price)){
                                $price = explode('&', $request->price);
                                $t->whereBetween('products.final_price',[$price[0],$price[1]]);
                              }
                        });
                        if($request->type){
                          switch ($request->type) {
                               case Product::FEATURED_PRODUCTS:
                                 $Product=$Product->where('featured',1);
                                break;
                                case Product::TOP_SELLER:
                                 $product_ids=ShopCartItems::select('product_id',DB::raw('count(product_id) as orders'))->whereType('order')
                                 ->join('products','products.id','=','shop_cart_items.product_id')
                                 ->where('products.childcategory_id',$category_id)
                                 ->groupBY('product_id')->take(100)->pluck('product_id');
                                  $Product=$Product->whereIn('id',$product_ids)->orWhereIn('parent',$product_ids);
                                break;
                               default:
                                $product_type=ProductType::where('slug',$request->type)->first();
                                $Product=$Product->where('product_type_id',$product_type->id);
                               break;
                           } 
                          
                        }
                         $Product=$Product->LeftJoin('featured_category_user', function($join)
                                     {
                                        $join->on('products.user_id','=','featured_category_user.user_id')->on('products.childcategory_id','=','featured_category_user.category_id');
                                     });
                         $Product=$Product->LeftJoin('purchase_package_product', function($join)
                                     {
                                        $join->on('purchase_package_product.package_id','=','featured_category_user.package')->on('purchase_package_product.user_id','=','featured_category_user.user_id')->where('purchase_package_product.package_type',1)->where('purchase_package_product.status','=',1);
                                     });
                        
                         // $Product=$Product->LeftJoin('purchase_package_product','purchase_package_product.package_id','=','featured_category_user.package');
                         $Product=$Product->orderBy('purchase_package_product.price','DESC');
                         $Product=$Product->get();

           $vv = view($this->include.'list')
               ->with('products',$Product);
   return response()->json(['status' => 1,'htm' => $vv->render()]);
}


#================================================================================
#================================================================================
#================================================================================


public function getSimpleProductId($request,$category_id)
{
	 $product = Product::has('eshop')->where('products.product_type',0)
	                   ->where('products.childcategory_id',$category_id)
	                   ->where('products.create_status',1) 
                     ->where('products.approved_status',1)
                      ->where('products.status',1);
                     
                      if(!empty($request->price)){
    		            		$price = explode('&', $request->price);
    		            		$product->whereBetween('products.final_price',[$price[0],$price[1]]);
		            	    }
  return $product->pluck('id')->toArray();
}



public function getProductIDWIthFilters($request,$category_id)
{
        $product =  Product::has('eshop')
                          ->join('product_assigned_variations','product_assigned_variations.parent','=','products.variant_id')
                          ->select('product_assigned_variations.*')
                          ->where('products.childcategory_id',$category_id)
                          ->where('products.approved_status',1)
                          ->where('products.create_status',1);

            // $ids = $product->where('products.product_type',1)
                 $ids = $product->where('products.create_status',1)
                           ->where('products.approved_status',1)
                           ->where('products.status',1)
                           ->where('products.variant_id','>',0)
                           ->groupBy('product_assigned_variations.parent') 
                           ->pluck('product_assigned_variations.parent')
                           ->toArray();

        foreach ($request->all() as $key => $value) {
                   if($key != 'type'){
                    if($key != 'price' ){
                      if($key != 'product-type'){
                        $ids = $this->getProductIdS($category_id,$key,$value,$ids);
                      }
                    }
                   }
                   
        }
       return Product::whereIn('variant_id',$ids)->pluck('id')->toArray();
}




#===============================================================================================================



public function getProductIdS($category_id,$key,$value,$ids=0)
{
             $product =  Product::has('eshop')
                                          ->join('product_assigned_variations','product_assigned_variations.parent','=','products.variant_id')
                                          ->select('product_assigned_variations.*')
                                          ->where('products.childcategory_id',$category_id)
                                          ->where('products.create_status',1)
                                          ->where('products.approved_status',1)
                                          ->where('product_assigned_variations.type',$key)
                                          ->whereIn('product_assigned_variations.attribute_id',$value)
                                          ->where('products.product_type',1)
                                          ->where(function($t) use($ids){
                                                 if(is_array($ids)){
                                                    $t->whereIn('product_assigned_variations.parent',$ids);
                                                 }
                                          })
                                          ->where('products.create_status',1)
                                          ->where('products.status',1)
                                          ->groupBy('product_assigned_variations.parent')
                                          ->pluck('product_assigned_variations.parent')
                                          ->toArray();
             return $product;
 
}
#===============================================================================================================





}
