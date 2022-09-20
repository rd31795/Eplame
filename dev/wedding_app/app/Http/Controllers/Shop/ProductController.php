<?php

namespace App\Http\Controllers\Shop;

use Auth;
use Illuminate\Http\Request;
use App\Models\Vendors\Eshop;
use App\Models\Products\Product;
use App\Models\Shop\ShopCategory;
use App\Http\Controllers\Controller;
use App\Models\Products\ProductImage;
use App\Models\Products\ProductCategory;
use App\Models\Products\ProductInventory;
use App\Models\Shop\ShopCartItems;
use App\Models\Products\ProductType;
use DB;
class ProductController extends Controller
{
    
    public $filePath = 'e-shop.modules.products.';
    public $include = 'e-shop.includes.products.';

#================================================================================================
#================================================================================================
#================================================================================================

	public function index(request $R,$cateSlug,$subcate,$childSlug=null)
	{
       $productType=$R->type;
       $ProductCategory = ProductCategory::with([
       	  'categoryParent',
          'categorySubparent'
         ])
         ->where('slug',$childSlug)
         ->first();
		   return view($this->filePath.'index')
           
              ->with('product_type',$productType)
              ->with('childCategory',$ProductCategory->categorySubparent->childCategory)
              ->with('categorySubparent',$ProductCategory->categorySubparent)
		          ->with('category',$ProductCategory);

	}

    public function index2(request $R,$cateSlug,$subcate)
  {
      $productType=$R->type;
      $ProductCategory = ProductCategory::with([
          'categoryParent',
          'childCategory'
         ])
         ->where('slug',$subcate)
         ->first();
       return view($this->filePath.'index')
            ->with('product_type',$productType)
             ->with('childCategory',$ProductCategory->childCategory)
              ->with('categorySubparent',$ProductCategory)
            ->with('category',$ProductCategory);
  }




#================================================================================================
#================================================================================================
#================================================================================================

	public function detail($slug)
	{
      
      $p = Product::has('eshop')->with('getParentProductData')
                                  
                                 ->where('slug',$slug)
                                 ->where('create_status',1)
                                 ->where('approved_status',1)
                                 ->where('status',1);
                                 
      if($p->count() == 0){
        return redirect('/shop');
      }
      $pro = $p->first();
         $product = $pro->parent > 0 ? $pro->getParentProductData : $pro;
         $is_already_negotiated=ShopCartItems::whereProductId($product->id)->whereType('cart')->where('negotiation_discounts_id','!=',0)->where('user_id',Auth::id())->count();
         $relatedProduct=Product::has('eshop')->where('childcategory_id',$product->childcategory_id)
                                 ->where('create_status',1)
                                 ->where('approved_status',1)
                                 ->where('status',1)
                                 ->Where(DB::raw('CASE parent WHEN 0 THEN final_price != 0 END'))
                                 ->take(20)
                                 ->get();
         return view($this->filePath.'detail')
                            ->with('product',$product)
		                        ->with('pro',$pro)
                            ->with('relatedProduct',$relatedProduct)
                            ->with('is_already_negotiated',$is_already_negotiated);
	  }


    public function productType($product_type){
      switch ($product_type) {
         case Product::NEW_PRODUCTS :
             return Product::NEW_PRODUCTS ;
           break;
         case Product::FEATURED_PRODUCTS :
             return Product::FEATURED_PRODUCTS ;
           break;
         default:
              return false;
           break;
       }
    }


#=================================================================================================
#=================================================================================================
#=================================================================================================

 


}
