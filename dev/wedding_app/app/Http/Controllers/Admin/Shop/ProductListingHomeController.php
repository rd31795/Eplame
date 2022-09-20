<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductListHome;
use App\Models\Products\ProductCategory;
use App\Http\Requests\homeProductListValidation;
use DB;
class ProductListingHomeController extends Controller
{
   public $filePath = 'admin.ProductListingHome.';
   public $getting_error="Getting Some Error...";
   public function index(){

       return view($this->filePath.'index')
       ->with('title','Product Listing Home Page')
       ->with('addLink',route('admin.home.productlist.setting'))
       ->with('productListing',ProductListHome::get());
   }

   public function createform(){
      $productCategory=ProductCategory::where('status',1)->where('parent',0)->orderBy('sorting','ASC')->get();
      return view($this->filePath.'add') 
           ->with('title','Product Listing Home Page')
           ->with('addLink',route('admin.home.product.listing'))
           ->with('productCategory',$productCategory);
   }

   public function store(homeProductListValidation $R){
     try {
          $msg=$this->getting_error;
          DB::beginTransaction();
   	      $view_all=2;
       	  if($R->view_all){
          $view_all=1;
   	    }
        $insert=new ProductListHome;
        if($R->productlist_update_id){
          $insert=ProductListHome::find($R->productlist_update_id);
        }
        $insert->Heading=$R->heading;
        $insert->product_category=implode(',',$R->allcategory);
        $insert->view_all=$view_all;
        if($insert->save()){
                 $msg = "Product listing is added successfully in home page";
                 if($R->productlist_update_id){
                   $msg = "Product listing is updated successfully in home page";
                 }
                 DB::commit();
          }
      }catch(\Exception $e){
                 DB::rollback();
                 $msg=$e->getMessage();
      }
        return redirect()->back()->with('Msg',$msg);

   }

   public function edit($id){
       $productlisting = ProductListHome::find($id);
       $productCategory=ProductCategory::where('status',1)->where('parent',0)->orderBy('sorting','ASC')->get();
       return view($this->filePath.'edit')
           ->with('productListing',$productlisting) 
           ->with('title','Product Listing Home Page')
           ->with('addLink',route('admin.home.product.listing'))
           ->with('productCategory',$productCategory);
    }

   public function status($id){
       try {
          $msg=$this->getting_error;
          DB::beginTransaction();
          $productlist = ProductListHome::find($id);
          if($productlist) {
            $productlist->status = $productlist->status ? 0 : 1;
            if($productlist->save()){
                 $msg = "Product List Status Changed Successfully!";
                 DB::commit();
              }
          }
          }catch (\Exception $e) {
                 DB::rollback();
                 $msg=$e->getMessage();
          }
          return redirect()->back()->with('messages',$msg);
  }

  public function delete($id){
     try {
          $msg=$this->getting_error;
          DB::beginTransaction();
          $productlist = ProductListHome::find($id);
          if($productlist) {
            if($productlist->delete()){
                 $msg = "Product List deleted Successfully!";
                 DB::commit();
              }
          }
          }catch (\Exception $e) {
                 DB::rollback();
                 $msg=$e->getMessage();
          }
          return redirect()->back()->with('messages',$msg);
  }

  public function viewAllToggle($id){
       try {
          $msg=$this->getting_error;
          DB::beginTransaction();
          $productlist = ProductListHome::find($id);
          if($productlist) {
            $productlist->view_all = $productlist->view_all == ProductListHome::SHOW_VIEW_ALL ? ProductListHome::HIDE_VIEW_ALL : ProductListHome::SHOW_VIEW_ALL;
            if($productlist->save()){
                 $msg = "Product List Status Changed Successfully!";
                 DB::commit();
              }
          }
          }catch (\Exception $e) {
                 DB::rollback();
                 $msg=$e->getMessage();
          }
          return redirect()->back()->with('messages',$msg);
  }

}
