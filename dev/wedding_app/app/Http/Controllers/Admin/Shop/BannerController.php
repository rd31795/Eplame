<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShopBanner;
class BannerController extends Controller
{
   public $filePath = 'admin.shop.banner.';
   public $folder = 'images/shop/homebanner/';
   public function index(){
       return view($this->filePath.'homebanner')
       ->with('title','Banner')
       ->with('homebanner',ShopBanner::whereType(ShopBanner::HOME_PAGE_BANNER)->first())
       ->with('addLink',route('admin.banner.home.setting'));
   }
   public function store(Request $R){
   	    $flash_message="Banner Created";
        $check=ShopBanner::whereType(ShopBanner::HOME_PAGE_BANNER)->first();
        $insert=New ShopBanner;
        $background_image="";
        $extra_image="";
        if($check){
            $insert=$check;
            $flash_message="Banner Updated";
              
            if($R->file('banner_image')){
               // deleteFile($check->background_image);
               $background_image=uploadFileWithAjax($this->folder,$R->file('banner_image'));
            }else{
               $background_image=$check->background_image;
            }
            
            if($R->file('product_image')){
             // deleteFile($check->product_image);
             $extra_image=uploadFileWithAjax($this->folder,$R->file('product_image'));
            }else{
             $extra_image=$check->extra_image;
            }
        }else{
        	$background_image=$R->hasFile('banner_image') ? uploadFileWithAjax($this->folder,$R->file('banner_image')): '';
        	$extra_image=$R->hasFile('product_image') ? uploadFileWithAjax($this->folder,$R->file('product_image')): '';
        }
        $insert->Description=$R->description;
        $insert->redirection_url=$R->url;
        $insert->btn_name=$R->btn_text;
        $insert->background_image=$background_image;
        $insert->extra_image=$extra_image;
        $insert->type=ShopBanner::HOME_PAGE_BANNER;
        $insert->save();
        return redirect()->back()->with('flash_message',$flash_message);
   }





   //Home Page Short Description Banner

   public function shortDescriptionIndex(){
        return view($this->filePath.'shortDescriptionBanner')
       ->with('title','Banner')
       ->with('addLink',route('admin.banner.home.setting'));

   }
}
