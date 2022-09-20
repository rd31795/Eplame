@extends('layouts.vendor')
@section('vendorContents')
<div class="container-fluid">

 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">Featured Category</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item">Featured Category</li>
            </ul>
   </div>
     
</div>
<div class="select_category"> 
      @php
          $user_featured_category=DB::table('featured_category_user')->select('featured_category_user.*')
          ->join('purchase_package_product','purchase_package_product.package_id','=','featured_category_user.package')->where('featured_category_user.user_id',Auth::id())->where('purchase_package_product.status',1)->get();
          $categories_array=[];
          foreach($user_featured_category  as $key=>$value)
          {

              array_push($categories_array,$value->category_id);
          }
          
          $purchasePackageProduct=DB::table('purchase_package_product')->where('user_id',Auth::id())->where('status',1)->first();
      @endphp
</div>
@include('vendors.errors')
@if($purchasePackageProduct)
@php
  $package=DB::table('packages')->where('id',$purchasePackageProduct->package_id)->first();
@endphp

@if($package)
<div class="col-md-12">
      <h3><strong>Based on your active package you can make any {{$purchasePackageProduct->category_count}} {{$package->category_count==1?'Category':'Categories'}} Products Featured</strong></h3>
      <strong>Active Plan</strong> : {{$package->title}} <br>
      <strong>Package Expiry Date</strong> : {{\Carbon\Carbon::parse($purchasePackageProduct->expiry_date)->format('M d Y h:i a')}}   <br>
</div>


<div class="col-md-12" id="categories" data-category={{$purchasePackageProduct->category_count}}  data-url="{{route('vendor.shop.featuredcategory')}}">
      <div class="Category">
        @php

         $navbarCategory = \App\Models\Products\ProductCategory::where('status',1)->where('parent',0)->orderBy('sorting','ASC')->get();

        @endphp
          @foreach($navbarCategory as $k => $cate)
          @php
          $check=\App\Models\Shop\ShopCategory::where('vendor_id',Auth::id())->where('category_id',$cate->id)->first();
          @endphp
               @if($check)

          <hr>
               @if($cate->subCategoryActives->count() > 0)
                <h3><strong>{{$cate->label}}</strong></h3>
                         @foreach($cate->subCategoryActives as $s => $subcate)
                         @if($subcate->childCategoryActives->count() > 0 ) 
                            <h5>{{$subcate->label}}</h5>
                              @foreach($subcate->childCategoryActives as $ch => $childCate)
                              <div class="child_category"> 
                              <p><input type="checkbox" id="featured_category_{{$childCate->id}}" name="featured_category[]" class="assign-category"  {{in_array( $childCate->id ,$categories_array )?'Checked':''}} value="{{$childCate->id}}">{{$childCate->label}}</p>
                              </div>
                              @endforeach
                         @endif    
                         @endforeach
               @endif
           <hr>
               @endif

          @endforeach
        <h3></h3>
      </div>
</div>
@endif
@endif
</div>



@section('scripts')
   <script src="{{url('js/featuredcat.js')}}"></script>
@endsection
   
@endsection

 