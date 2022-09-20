<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShopBanner;
use DB;
class SliderController extends Controller
{
   public $filePath = 'admin.slider.';
   public $folder = 'images/shop/homebanner/';
   public $getting_error="Getting Some Error...";
  public function index(){
    return view($this->filePath.'index',[
          'title'    => 'Slider',
          'addLink'  => route('admin.slider.create'),
          'sliders' =>ShopBanner::whereType(ShopBanner::HOME_PAGE_SLIDER)->get()
      ]);
  }


  public function create(){
       return view($this->filePath.'add',[
       'title' => 'Create Slider Banner',
       'addLink'  => route('admin.banner.home.slider'),
       ]);
  }

  public function delete($id){
        try {
        DB::beginTransaction();
        $msg=$this->getting_error;
        $banner=ShopBanner::find($id);
        $image=$banner->background_image;
        if($banner->delete()){
           $msg="Banner Deleted";
           DB::commit();
        }
        }catch (\Exception $e) {
           DB::rollback();
           $msg=$e->getMessage();
        }
        return redirect()->back()->with('messages',$msg);
  }

  public function store(request $R){
    try {
        DB::beginTransaction();
        $msg=$this->getting_error;
        $insert=New ShopBanner;
        $background_image=$R->hasFile('banner_image') ? uploadFileWithAjax($this->folder,$R->file('banner_image')): '';
        $insert->Description=$R->description;
        $insert->redirection_url=$R->url;
        $insert->background_image=$background_image;
        $insert->type=ShopBanner::HOME_PAGE_SLIDER;
        if($insert->save()){
           $msg="Banner Created";
           DB::commit();
        }
        }catch (\Exception $e) {
           DB::rollback();
           $msg=$e->getMessage();
        }
        return redirect()->route('admin.banner.home.slider')->with('messages',$msg);
  }

  public function edit($id){
       return view($this->filePath.'edit',[
       'title' => 'Update Slider Banner',
       'addLink'  => route('admin.banner.home.slider'),
       'slider' => ShopBanner::find($id)
       ]);
  }

  public function update(request $R,$id){
    try {
    $msg=$this->getting_error;
    DB::beginTransaction();
    $slider=ShopBanner::find($id);
    if($R->file('banner_image')){
        $background_image=uploadFileWithAjax($this->folder,$R->file('banner_image'));
    }else{
        $background_image=$slider->background_image;
    }
    $slider->Description=$R->description;
    $slider->redirection_url=$R->url;
    $slider->background_image=$background_image;
    if($slider->save()){
           $msg="Banner Updated";
           DB::commit();
    }
    }catch (\Exception $e) {
           DB::rollback();
           $msg=$e->getMessage();
    }
    return redirect()->back()->with('messages',$msg);
  }

  public function status($id){
      try {
    $msg=$this->getting_error;
    DB::beginTransaction();
    $slider = ShopBanner::find($id);
    if($slider) {
      $slider->status = $slider->status ? 0 : 1;
      if($slider->save()){
           $msg = "Slider Status Changed Successfully!";
           DB::commit();
        }
    }
    }catch (\Exception $e) {
           DB::rollback();
           $msg=$e->getMessage();
    }
    return redirect()->back()->with('messages',$msg);
  }



  // public function sliderAjax(){

  //   $slider = ShopBanner::select(['id','background_image','status'])->get();
  //    return (datatables()->of($slider)
  //                      // ->addColumn('action',function($slider) {
  //                      //        return $this->Actions($slider);
  //                      // })
  //                      ->addColumn('label',function($slider){
  //                             return $this->image($slider);
  //                      })
  //                      ->editColumn('status',function($slider) {
  //                          return $slider->status == 1 ? 'Active' : 'In-Active';
  //                      }) 
  //                      ->make(true));

  // }


  #--------------------------------------------------------------------------------------------
# slider Ajax Search --All Action List Here
#-------------------------------------------------------------------------------------------- 
  
  // protected function Actions($data) {
        

  //   $text  ='<div class="btn-group">';
  //       $text .='<button type="button" class="btn btn-primary">Action</button>';
  //       $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
  //       $text .='<span class="caret"></span>';
  //       $text .='<span class="sr-only">Toggle Dropdown</span>';
  //       $text .='</button>';
  //       $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';

  //       $text .='<a href="'.route('admin.products.edit.types',$data->id).'" class="dropdown-item">Edit</a>';
  //       $text .='<div class="dropdown-divider"></div>';
  //       $status=$data->status == 0 ? 'Active' : 'In-Active';
  //       $text .='<a href="'.route('admin.products.status.types',$data->id).'" class="dropdown-item">'.$status.'</a>';

  //       $text .='</div>';
  //       $text .='</div>';

  //       return $text;
  // }
}
