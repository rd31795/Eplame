@extends('e-shop.layouts.layout')
@section('styleSheet')
<link rel="stylesheet" type="text/css" href="{{url('/e-shop/css/cart-style.css')}}">
@endsection
@section('content')
<!-- banner section starts here here -->
<section class="inner-main-banner" style="background-image:url({{url('/e-shop/images/product-listing-banner-bg.png')}});">
    <div class="container">
        <div class="inner-banner-content text-center">
            <h1>Checkout</h1>
        </div>
    </div>
</section>
<!--Shopping cart sec starts here -->
<section class="checkout-step-sec">
    <div class="container">
      <div class="multi_step_form">  
          <div id="msform">                   
            <!-- progressbar -->
               @php
              $shipping_and_pickup=0;
              $ShopCartItems=Auth::user()->ShopProductCartItems->pluck('product_id');
               if(Session::get('express_checkout')==1){
                    $ShopCartItems=App\Models\Shop\ShopCartItems::where('user_id',Auth::id())->where('type','buynow')->pluck('product_id');
               }
              $product=App\Models\Products\Product::whereIn('id',$ShopCartItems);
              $shipping_count=$product->where('shipping_available',1)->count();
               if($product->where('local_pickup',1)->count() == 1 && Session::get('express_checkout') == 1){
                    $shipping_and_pickup=3;
               }
               if(count(Auth::user()->ShopProductCartItems)==1){
                      $order=Auth::user()->ShopProductCartItems;
                      if($order[0]->product->local_pickup && $order[0]->product->shipping_available!=1){
                         $shipping_and_pickup=2;
                      }
                }
            
               if($product->where('shipping_available',1)->where('local_pickup',1)->count()>0 ){
                    $shipping_and_pickup=1;
                } 
              if($product->where('local_pickup',1)->count() == count(Auth::user()->ShopProductCartItems)){
                    $shipping_and_pickup=2;
               }
              if($shipping_count==1 && Session::get('express_checkout')==1){
                    $shipping_and_pickup=0;
              } 
             
              @endphp

            @if($shipping_and_pickup!=0)
             <style>
                 .multi_step_form #msform #progressbar li{
                    width: calc(100%/3);
                 }
             </style>
            @endif
            <ul id="progressbar">
              @if($shipping_and_pickup == 0)  
                 <li class="{{$number >= 1 ? 'active' : ''}}" >Shipping Address</li>  
              @endif
              <li class="{{$number >= 2 ? 'active' : ''}}"  >Cart Review</li> 
              <li class="{{$number >= 3 ? 'active' : ''}}"  >Billing Address</li>
              <li class="{{$number >= 4 ? 'active' : ''}}"  >Payment</li>
            </ul>
      
              @yield('checkContent')
          </div>
        </div>              
    </div>
</section>
<!--Shopping cart sec ends here -->
@endsection
