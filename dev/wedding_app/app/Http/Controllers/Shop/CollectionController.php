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
class CollectionController extends Controller
{
    
    public $filePath = 'e-shop.modules.collections.';
    public $include = 'e-shop.includes.products.';

#================================================================================================
#================================================================================================
#================================================================================================

    public function collection(request $R){
         $slug="";
         $category=Product::groupBY('childcategory_id')->get();
       switch ($R->type) {
       	case Product::FEATURED_PRODUCTS:
       		$slug=Product::FEATURED_PRODUCTS;
       		$category=Product::where('featured',1)->groupBY('childcategory_id')->get();
       		break;
       	case Product::TOP_SELLER:
       	   
       	    $product_ids=ShopCartItems::select('product_id',DB::raw('count(product_id) as orders'))->whereType('order')->groupBY('product_id')->take(100)->pluck('product_id');
       	    $category=Product::whereIn('id',$product_ids)->groupBY('childcategory_id')->get();
       	    $slug=Product::TOP_SELLER;
       	    break;
        default:
       		$type=ProductType::whereSlug($R->type)->first();
       		$slug=$type->slug;
            $category=Product::where('product_type_id',$type->id)->groupBY('childcategory_id')->get();
       		break;
       }
       return view($this->filePath.'index')
             ->with('category',$category)
             ->with('type',$slug);
    }

#=================================================================================================
#=================================================================================================
#=================================================================================================

 


}
