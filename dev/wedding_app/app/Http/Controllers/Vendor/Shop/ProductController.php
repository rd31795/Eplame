<?php

namespace App\Http\Controllers\Vendor\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use Auth;
use App\Models\Vendors\Eshop;
use App\Models\Products\ProductCategory;
use App\Models\Products\ProductType;
use App\Models\Shop\ShopCategory;
use App\Models\Products\ProductInventory;
use App\Models\Products\ProductImage;
use App\Models\Vendors\RejectionReason;
class ProductController extends Controller
{

public $filePath = 'vendors.E-shop.products.';

public $path = 'images/products/';
#=====================================================================================
#  index 
#=====================================================================================

public function index($value='')
{
         
	   
	    $product = Product::with(
                    	    	'ProductAssignedVariations',
                    	    	'ProductAssignedVariations.inventoryWithVariation',
                    	    	'subcategory.ProductVariations',
                    	    	'subcategory.ProductVariations.variationTypes',
                    	    	'variationAttributes'
                    	    )
                          ->where('create_status',1)
                    	    ->where('parent',0)
                    	    ->where('user_id',Auth::user()->id)
                    	    ->orderBy('id','DESC')
                          ->paginate(20);
      return view($this->filePath.'index')->with('products',$product);
}




#=====================================================================================
#  index 
#=====================================================================================

public function create($value='')
{
	 return $this->createNewOne();
	 
}


#=====================================================================================
#  index 
#=====================================================================================

public function edit($id)
{

    $shop = Auth::user()->shop;
    $ShopCategory = new ShopCategory;
    $product = Product::with(
    	'ProductAssignedVariations',
    	'ProductAssignedVariations.inventoryWithVariation',
    	'subcategory.ProductVariations',
    	'subcategory.ProductVariations.variationTypes',
    	'variationAttributes'
    )->where('user_id',Auth::user()->id)->where('id',$id);

    if($product->count() == 0){
    	return redirect()->route('vendor.shop.products.create');
    }
    //12/12/2021
    $productTypes = ProductType::all();
    //12/12/2021 End

    $category = $ShopCategory->parentCategory($shop->id,0);
         return view($this->filePath.'add')
              ->with('shop',$shop)
              ->with('category',$category)
              ->with('ShopCategory',$ShopCategory)
              ->with('productTypes',$productTypes)
              ->with('product',$product->first());
}



#=====================================================================================
#  create new product
#=====================================================================================


public function update(Request $request,$product_id)
{

	$shop_id = Auth::user()->shop->id;
	 $this->validate($request,[
         'name' => 'required',
         'description' => 'required',
         'short_description' => 'required',
         'thumbnail' => function(){
           return 'required|image|dimensions:ratio=2/2';
         }
	 ]);
  
 

	 $product = Product::find($product_id);
	 $product->name = trim($request->name);
	 $product->description = trim($request->description);
	 $product->short_description = trim($request->short_description);
	 $product->create_status = 1;
	 $product->thumbnail = $request->hasFile('thumbnail') ? uploadFileWithAjax($this->path, $request->thumbnail) : $product->thumbnail;

   //12/12/2021
     $product->product_type_id = $request->product_type_id;
     $product->is_negotiable   = $request->is_negotiable;
     $product->shipping= $request->is_shipping_charges;
     $product->local_pickup= $request->is_local_pickup;
     $product->shipping_available= $request->is_shipping;
   //12/12/2021 End
	 $product->save();
	 $product->sluggable();
   $product->createProductWithVariation();
   $this->resubmitAfterChanging($product);
	 return redirect()->route('vendor.shop.products.index')->with('messages','Product is saved successfully!');
}


#=====================================================================================
#  create new product
#=====================================================================================

public function createNewOne()
{
	$product = Product::where('user_id',Auth::user()->id)->where('create_status',0)
	->where('shop_id',Auth::user()->shop->id);
   if($product->count() > 0){
		$product_id = $product->first()->id;
	}else{
		$p = new Product;
		$p->user_id = Auth::user()->id;
		$p->shop_id =Auth::user()->shop->id;
		$p->save();
    $product_id = $p->id;
	}
   
   

   return redirect()->route('vendor.shop.products.edit',$product_id);
}



#=====================================================================================
#  create new product
#=====================================================================================

public function saveCategory(Request $request,$id)
{
   $v = \Validator::make($request->all(),[
          'category_id' => 'required',
          'subcategory_id' => 'required',
          'childcategory_id' => 'required',
   ]);

   $product = Product::where('user_id',Auth::user()->id)
                     ->where('id',$id)
                     ->where('shop_id',Auth::user()->shop->id);
 
   if($product->count() > 0){
	    $p = $product->first();
	    $p->category_id =$request->category_id;
	    $p->subcategory_id =$request->subcategory_id;
	    $p->childcategory_id =$request->childcategory_id;
	    $p->save();

   return response()->json(['status' => 1]);
   }




}


#------------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------------------------

public function ajaxCategory(Request $request)
{     
	  $shop = Auth::user()->shop;
      $ShopCategory = new ShopCategory;
       if($request->parent > 0){

	      $category = $ShopCategory->parentCategory($shop->id,$request->parent);

       }elseif($request->subparent > 0){
            $category = ProductCategory::where('subparent',$request->subparent)->where('status',1)->orderBy('label','ASC')->get();

       }

       if(!empty($category)){
       	     $text ='<option value="">select</option>';
       	  foreach ($category as $key => $cate) {
       	  	 $text .='<option value="'.$cate->id.'">'.$cate->label.'</option>';
       	  }

       	  return response()->json($text);
       }
	 
}


#=================================================================================================
#=================================================================================================
#=================================================================================================



public function createGeneralSetting(Request $request,$product_id)
{
	 $product = Product::find($product_id);


	 if($product->id == Auth::user()->id){
	 	$status = ['status' => 0, 'messages' => 'Unautherized to do this operation!'];
	 }else{
          
          $product->height = trim($request->height);
          $product->weight = trim($request->weight);
          $product->length = trim($request->length);
          $product->width = trim($request->width);
          $product->price = trim($request->price);
          $product->sale_price = trim($request->sale_price);
          $product->final_price = trim(($request->price - $request->sale_price));
          $product->save();

	 	$status = ['status' => 1, 'messages' => 'General Setting is saved'];

	 }

	 return response()->json($status);
}










#=====================================================================================================
#=====================================================================================================
#=====================================================================================================




    public function imageUploading(Request $request,$id)
    {
         $product = Product::find($id);
         if($request->hasFile('images')){

                  # save images
                          $imageLink = array();
                          $delink = array();

                          foreach ($request->file('images') as $key => $file) {
                               $image_name = uploadFileWithAjax($this->path, $file);
                                array_push($imageLink, url($image_name));


                                $image = new ProductImage;
                                $image->product_id = $product->id;
                                $image->image = $image_name;
                                $image->type = 'product';
                                $image->variation_id = !empty($request->variation_id) ? $request->variation_id : 0;
                                $image->save();

                                      $del = array(
                                             'caption' => 'product_image',
                                             'url' => url(route('vendor.shop.products.ajax.DeleteImageUploading',[$product->id,$image->id])),
                                             'key' => $image->id
                                       );
                                array_push($delink, $del);
                          }
              

              $json = array(
                            'initialPreview' => $imageLink,
                            'initialPreviewAsData' => true,
                            'initialPreviewConfig' => $delink,
             );

              $this->resubmitAfterChanging($product);

             return response()->json($json); 
               
         }



 }



#======================================================================================================
#======================================================================================================
#======================================================================================================



 public function imageDelete($product_id,$id)
 {

   $product = Product::where('user_id',Auth::user()->id)->where('id',$product_id);
   $p = ProductImage::find($id);

   if($product->count() > 0 && $p->product_id == $product_id){
    $p->delete();

       echo "{}";  
    }
 }


#======================================================================


 public function status($product_id)
 {
    $product = Product::where('user_id',Auth::user()->id)->where('id',$product_id);
     if($product->count() > 0){

        $s = $product->first();
        $status = $s->status == 1 ? 0 : 1;
        $s->status = $status;
        $s->save();
        if($s->subProducts->count() > 0){
            foreach ($s->subProducts as $p) {
                  $p->status = $status;
                  $p->save();
            }
        }

    }
    return redirect()->back()->with('messages','Product status has been change successfully.');
 }






#----------------------------------------------------------------------------------------------
#----------------------------------------------------------------------------------------------
#----------------------------------------------------------------------------------------------

public function resubmitAfterChanging($product)
{


     switch ($product->approved_status) {
      case 1:
         $reason ='User has been changed something in shop settings';
        break;
      case 2:
         $reason ='The shop has been resubmitted for approval.';
        break;
      
      default:
         $reason ='The shop has been submitted for approval.';
        break;
     }






      $r = new RejectionReason;
      $r->type_id = $product->id;
      $r->type = 'product';
      $r->reason = $reason;
      $r->save();
      return $this->productChangeStatus($product->slug,0);
}
  

#----------------------------------------------------------------------------------------------
#----------------------------------------------------------------------------------------------
#----------------------------------------------------------------------------------------------


public function productChangeStatus($productSlug,$status)
{
   $product = Product::findBySlug($productSlug);
   $product->approved_status = $status;
   $product->save();

   if($product->subProducts != null && $product->subProducts->count() > 0){
              foreach ($product->subProducts as $p) {
                   $p->approved_status = $status;
                   $p->save();
              }
   }
   return 1;

}

#----------------------------------------------------------------------------------------------
#----------------------------------------------------------------------------------------------
#----------------------------------------------------------------------------------------------


}
