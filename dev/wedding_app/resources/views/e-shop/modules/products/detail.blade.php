@extends('e-shop.layouts.layout')
<!-- varun code  -->
@section('styleSheet')
 <link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="{{url('/arrowchat/external.php?type=css')}}" charset="utf-8">
@endsection
@section('content')
@php  $stock = $pro->parent > 0 ? $pro->checkStock() : $product->checkStock(); $reviews = ProductRate($product); @endphp

 
 <!-- banner section starts here here -->
    <section class="inner-main-banner" style="background-image:url({{url('/e-shop/images/product-listing-banner-bg.png')}});">
        <div class="container">
            <div class="inner-banner-content text-center">
                <h1>Product Details</h1>
            </div>
        </div>
    </section>
    <section class="product-detail-sec">
      <div class="container">
          <!-- product detail card -->  
          <div class="card mb-5">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-lg-6">
             <div class="product-slider-wrap">
               <div id="slider" class="flexslider">
          <ul class="slides">

            @foreach($product->ProductImages as $img)
             <li>
              <img src="{{url($img->image)}}" />
            </li>   
            @endforeach        
          </ul>
        </div>
        <div id="carousel" class="flexslider">
          <ul class="slides">
              @foreach($product->ProductImages as $img)
             <li>
              <img src="{{url($img->image)}}" />
            </li>   
            @endforeach       
          </ul>
        </div>
             </div>
            
          </div>
          <div class="details col-lg-6">
            <h3 class="product-title">{{$product->name}}</h3>


            <div class="price-rating-wrap">
                    @if($product->product_type == 1)
                       <h4 class="price"><span>{!!$pro->productPrice()['html']!!}</span></h4>  
                    @else
                       <h4 class="price"><span>{!!$product->productPrice()['html']!!}</span></h4>  
                    @endif
                    {!!$reviews['rating']!!}
            </div>
                   @php
                $package_exist=DB::table('featured_category_user')->join('purchase_package_product','purchase_package_product.package_id','=','featured_category_user.package')->where('category_id',$product->childcategory_id)->where('featured_category_user.user_id',$product->user_id)->where('status',1)->first();
            @endphp
            @if($package_exist)
            <div class="product_sponsered"> 
                <P > <strong>Sponsered</strong></P><hr>
            </div>
            @endif
            <p class="product-description">{{$product->short_description}}</p>

              <!--  <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
 -->
      @if($stock != null && $stock->stock > 0)
               <p class="vote"><strong>Stock : </strong> {{$stock->stock > 0 ? 'In Stock' : 'Out Of Stock'}} 
                
                {!!$stock->stock > 0 && $stock->lowInStock >= $stock->stock ? '<strong>('.$stock->stock.' items)</strong>' : ''!!}
              </p>
      @endif

      



        <form id="ADDToCART" data-action="{{url(route('shop.ajax.addToCart',$product->id))}}">

          <div id="ProductDetailFilter">
               @include('e-shop.includes.products.addToCartForm')
          </div>
           <!--  <h5 class="colors">colors:
              <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
              <span class="color green"></span>
              <span class="color blue"></span>
            </h5> -->

            <div class="action btn-wrap mt-3 mb-2 cs-action-btn-wrap">

                   <button class="cstm-btn solid-btn cartButton " data-buy=0 onclick="cart(this)">add to cart</button>
                   @if(Auth::id() != $pro->user_id && Auth::user())
                   <button class="cstm-btn solid-btn buyNow" data-buy=1 onclick="buy(this)" >Buy Now</button>
                   @endif
                                 <a href="javascript:void(0)" 
                                                       class="wishlist {{$product->hasInWishlist()}} cstm-wishlist-btn"
                                                       data-url="{{url(route('shop.wishlist.create',$product->id))}}"
                                                       ><span class="fa fa-heart"></span>
                                                     </a>
                 @if(($product->is_negotiable && Auth::user()) && Auth::id() !=  $pro->user_id )
                   <a href="javascript:;"  onclick="jqac.arrowchat.chatWith('{{$pro->user_id}}');" class="cstm-btn solid-btn detail-btn getQuote3" data-id='{{$pro->id}}' id="negotiation_chat">Chat for negotiation</a>
                   <input id="test" type="hidden" />
                 <script type="text/javascript">
                   document.querySelector("#negotiation_chat").addEventListener('click',(e)=>{
                   	jqac.arrowchat.sendMessage('{{$pro->user_id}}','PRODUCT->:  '+window.location.href);
                   });
                 </script>
                 @endif       
                 @if($product->shipping!=1)
                 <div class="free-shipping">
                   <strong>Free Shipping</strong>  
                  <div id="run-shipping"> 
                    <i class="fas fa-shipping-fast"></i>
                  </div>
                 </div>
                 @else
                 <div class="free-shipping">
                   <strong>Shipping is not Free</strong>  
                  <div id="run-shipping"> 
                    <i class="fas fa-shipping-fast"></i>
                  </div>
                 </div>
                  <div class="shipping_rate_view" style="display: none;">
                       Extra Shipping charges <span id="extra_shipping_rates"></span> <span style="font-size: 14px;">(Based on your current location)</span>
                  </div>
                  <div class="check-shipping-rates">
                       <label for="shipping_rates" style="display: none;">Get Shipping Rates</label>
                       <input type="hidden" id="shipping_rates" data-vendor='{{$pro->user_id}}' class="form-control pac-target-input valid" name="address" autocomplete="off" value="" placeholder="Enter your Address">
                  </div>   
                 @endif   

                 
                 @if($product->shipping_available!=1)
                    <div class="Shipping_not_avail">
                      <span id="available_local_pickup_only">Product is Available For Local Pickup Only</span>
                   </div>
                 @elseif($product->local_pickup)
                   <div class="local_pickup">
                      <span id="available_local_pickup">Product is Available For Local Pickup To</span>
                   </div>
                 @endif
            </div>
           @if(($product->is_negotiable && Auth::user()) && Auth::id() != $pro->user_id )
                @if($is_already_negotiated>0)
                 <div class="form-group">
                    <span class="negotiated" style="color:green">Already Negotiated</span>
                 </div>
                @else
                <div class="form-group"> 
                         <input type="text" id="negotiation_coupon" data-url="{{url(route('shop.ajax.negotiationcoupon',$product->id))}}" placeholder="Add Negotiation coupon If any" name="negotiation_coupon" class="form-control"/>
                </div>
                @endif
                       
            @endif   
            <div id="errorMessageBox"></div>

          </form>

        


          </div>
        </div>
      </div>
    </div>
         <!--  End -->
      </div>
    </section>
    <section class="product-description-sec">
      <div class="container">
      <div class="product-des-container">
        <ul class="nav nav-tabs row" role="tablist">
          <li class="nav-item col-6">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Product Description</a>
          </li>
          <li class="nav-item col-6">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
          </li>
          
        </ul><!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="description-content">
              <h3>Product Description</h3>
               {!!$product->description!!} 
            </div>
          </div>
          <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="description-content">
              <div class="row">
                <div class="col-lg-6">
                  <figure class="product-specification-img">
                    <img src="{{url($product->thumbnail)}}">
                  </figure>
                </div>
                <div class="col-lg-6">
                  <div class="specification-head">
                    <h3>Specification</h3>
                  </div>
              <table class="table specification-table" id="tblProductSpecifics">
                     <tbody>
                  <?php
                      $specification = $product->ProductAttributeVariableProduct->where('product_view',1);
 
                  ?>                    
 
                        @foreach($specification as $attribute)

                         <tr>
                              <td class="ItemSpecificName">{{$attribute->type}}</td>
                                
                                <td class="ItemSpecificValue">
                                          @foreach($attribute->childAttributes as $sp)
                                                 <span>{{$sp->variation->name}}</span>
                                          @endforeach
                                </td>
                            </tr>
                          
                        @endforeach
                    </tbody>
                    </table>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>


    @if($product->reviews != null && $product->reviews->count() > 0)

   <!--  reviews and rating sec starts here -->



<section class="reviewsAndRating-sec">
  <div class="container">
    <div class="sec-heading text-center">
                <h2>Reviews</h2>
            </div>
<div class="cstm-rating-wrap">
   <div class="rating-head">
          <span class="heading">User Rating</span>
          <div>
            {!!$reviews['rating']!!}

          </div>
          <p>{{ $reviews['rate']}} average based on {{ $reviews['count']}} reviews.</p>
   </div>
   <hr style="border:3px solid #f1f1f1">

   {!! $reviews['overall']!!}
 </div>

 

<div class="customers-reviws-wrap">


@foreach($product->reviews as $r)
  <div class="review-card">
    <div class="testimonial">
                   <h4>{{$r->title}}</h4>
                  <p>{{$r->review}}</p>
                </div>
                <div class="media">
                  <figure class="media-left client-img">
                    @if($r->user->profile_image != "")
                    <img src="{{url($r->user->profile_image)}}" alt=""> 
                    @endif                  
                  </figure>
                  <div class="media-body">
                    <div class="overview">
                      <div class="name"><b>{{$r->user->name}}</b></div>
                                        
                      <div class="star-rating">
                        {!!ProductReviewRate($r->rating)!!}
                      </div>
                    </div>                    
                  </div>
                </div>
  </div>
  @endforeach
 
</div>
</div>
</section>
   <!-- ========================================== -->
@endif
  
  
  <!--related products starts here-->
    @include('e-shop.includes.products.relatedProducts')
  <!--Featured section ends here-->
 

@endsection



@section('jscript')
<script type="text/javascript">
function buy(e){
	    formsubmittion(e.dataset.buy);
} 
function cart(e){
	 formsubmittion(e.dataset.buy);
}
function formsubmittion(buyNow=0){
 $("body").on('submit','#ADDToCART',function(event){
    event.preventDefault();
    $('.cartButton').attr('disabled','true');
	$('.buyNow').attr('disabled','true');
      checkNegotiationCoupon(buyNow);
  });
}
</script>
<script type="text/javascript" src="{{url('/e-shop/js/products/cart.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function(){
      var $loader = $("body").find('.custom-loading');
          $loader.show();
 
   
  });
</script>
<script type="text/javascript" src="{{url('/e-shop/js/products/size.js')}}"></script>
<script>
function getVariantPriceView(data){
     updateUrlParameter('sizes',$("input[name=sizes]:checked").val());
     $.ajax({
        url:"{{route('shop.ajax.getprice',$product->id)}}",
        dataType: 'json',
        data: data,
        success:function(result)
        { 
            document.querySelector("h4.price span").innerHTML=result;
        }
    });
   }


</script>

@if(($product->is_negotiable && Auth::user()) && Auth::id() != $pro->user_id )
<script type="text/javascript" src="{{url('/arrowchat/includes/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{url('/arrowchat/includes/js/jquery-ui.js')}}"></script>   
<script type="text/javascript" src="{{url('/arrowchat/external.php?type=djs')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{url('/arrowchat/external.php?type=js')}}" charset="utf-8"></script>     

@endif   
@if($product->shipping==1)
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrGKmz60iMoKfZLLQSK5LOzqHCf_TynQM&amp;libraries=places"></script>
<script>
function initialize() 
{

    var input = document.getElementById('shipping_rates'); 
    var options = {    
    types: ['address'],
    componentRestrictions: {country: ["us", "ca"]}
    };
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };    
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        let shippingRatesObject={};
        shippingRatesObject['vendor']=input.dataset.vendor;
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            var addressType = addressType;
            switch (addressType) { 
              case 'locality': 
              shippingRatesObject['city']=val;
                // document.getElementById('city').value = val;
                break;
              case 'administrative_area_level_1': 
              shippingRatesObject['state']=val;
                // document.getElementById('state').value = val;
                break;
              case 'postal_code': 
              shippingRatesObject['zipcode']=val;
                // document.getElementById('zipcode').value = val;
                break;               
              case 'country': 
                shippingRatesObject['country']=val;
                shippingRatesObject['country_short_code']=place.address_components[i].short_name;
                // document.getElementById('country').value = val;
                // document.getElementById('country_short_code').value = place.address_components[i].short_name;
                break;                  
            }            
          }
        }
        // document.getElementById('latitude').value = place.geometry.location.lat();
        // document.getElementById('longitude').value = place.geometry.location.lng();
       $.ajax({
        url:`{{route('shipping.rates')}}`,
        data:shippingRatesObject,
        success:function(data){
          if(data!=0){
            $("#extra_shipping_rates").html(`${data}$`);
          }else{
           $("#extra_shipping_rates").html(`Not Available`);
          }

           $(".shipping_rate_view").show();
        }

       });
        document.getElementById('shipping_rates').value = place.name;
        autocompleted = true;
    });
}
google.maps.event.addDomListener(window, 'load', initialize);   
$.ajax({
       url:`{{route('current_location')}}`,
       success:function(data){
       	  let shippingRatesObject={};
       	   shippingRatesObject['vendor']=document.querySelector("#shipping_rates").dataset.vendor;
       	   shippingRatesObject['city']=data.cityName;
       	    shippingRatesObject['state']=data.regionName;
       	       shippingRatesObject['zipcode']=data.zipCode;
       	       shippingRatesObject['country']=data.countryName;
                shippingRatesObject['country_short_code']=data.countryCode;
       	    $.ajax({
        url:`{{route('shipping.rates')}}`,
        data:shippingRatesObject,
        success:function(data){
          if(data!=0){
            $("#extra_shipping_rates").html(`${data}$`);
          }else{
           $("#extra_shipping_rates").html(`Not Available`);
          }

           $(".shipping_rate_view").show();
        }

       });
       }
	});

</script>
@endif
@endsection