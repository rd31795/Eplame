@extends('e-shop.layouts.checkout')
@section('checkContent')
   <!-- fieldsets -->
 
   <fieldset class="step-content" style="">
         <form 
         class="step-form-content" 
         id="shippingForm" 
         action="{{url(route('shop.checkout.shipping'))}}"
         > 
         @csrf
               <h2 class="step-content-title">Shipping Address</h2>
            <div class="row">
            <div class="col-lg-8">
               <div class="row">                        


               <div class="col-md-6">
                     <!-- {{textbox($errors,'Name','name',$address->name)}} -->
                   @php 
                     $address_details=DB::table('address_details')->where('user_id',Auth::id())->first();
                   @endphp
                  <div class="form-group">
                    <input type="text" id="name" class="form-control" name="name" 
                     value="{{$address->name?$address->name:Auth::user()->name}}" 
                     placeholder="Enter your Name">
                     <span class="input-icon"><i class="fas fa-user"></i></span>
                     
                  </div>


               </div>
               <div class="col-md-6">
                     <!-- {{textbox($errors,'Email','email',$address->email)}} -->
                  <div class="form-group">
                     <input type="email" id="email" class="form-control" name="email" 
                     value="{{$address->email?$address->email:Auth::user()->email}}" 
                     placeholder="Enter your Email">
                     <span class="input-icon"><i class="fas fa-envelope"></i></span>
                  </div>

               </div> 
               <div class="col-md-6">
                     <!-- {{textbox($errors,'Phone Number','phone_number',$address->phone_number)}} -->
                     <div class="form-group">
                     <input type="text" id="phone_number" class="form-control" name="phone_number" 
                     value="{{$address->phone_number?$address->phone_number:Auth::user()->phone_number}}" 
                     placeholder="Enter your Phone Number">
                     <span class="input-icon"><i class="fas fa-phone-alt"></i></span>
                  </div>
               </div> 
               <div class="col-md-6">
                     <!-- {{textbox($errors,'Address','address',$address->address)}} -->
                     <div class="form-group">
                     <input type="text" id="address" class="form-control" name="address" autocomplete="false" 
                     value="{{$address->address?$address->address:Auth::user()->user_location}}" 
                     placeholder="Enter your Address">
                     <span class="input-icon"><i class="fas fa-search-location"></i></span>
                  </div>
               </div> 
               <div class="col-md-6">
                     <!-- {{textbox($errors,'Country','country',$address->country)}} -->
                     <div class="form-group">
                     <input type="text" id="country" class="form-control" name="country" 
                     value="{{$address->country?$address->country:$address_details->country}}" 
                     placeholder="Enter your Country">
                     <span class="input-icon"><i class="fas fa-flag"></i></span>
                  </div>
               </div> 
               <div class="col-md-6">
                     <!-- {{textbox($errors,'State','state',$address->state)}} -->
                     <div class="form-group">
                     <input type="text" id="state" class="form-control" name="state" 
                     value="{{$address->state?$address->state:$address_details->state}}" 
                     placeholder="Enter your State">
                     <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                  </div>
               </div> 
               <div class="col-md-6">
                     <!-- {{textbox($errors,'City','city',$address->city)}} -->
                     <div class="form-group">
                     <input type="text" id="city" class="form-control" name="city" 
                     value="{{$address->city?$address->city:$address_details->city}}" 
                     placeholder="Enter your City">
                     <span class="input-icon"><i class="fas fa-city"></i></span>
                  </div>
               </div> 
               <div class="col-md-6">
                     <!-- {{textbox($errors,'Zipcode','zipcode',$address->zipcode)}} -->
                     <div class="form-group">
                     <input type="text" id="zipcode" class="form-control" name="zipcode" 
                     value="{{$address->zipcode?$address->zipcode:$address_details->zipcode}}" 
                     placeholder="Enter Your Zipcode">
                     <span class="input-icon"><i class="fas fa-mail-bulk"></i></span>
                  </div>
               </div>
               
               <input type="hidden" id="country_short_code" name="country_short_code" value="{{ $address->country_short_code?$address->country_short_code:$address_details->country_short_code }}">
               <input type="hidden" id="latitude" name="latitude" value="{{ $address->latitude?$address->latitude:Auth::user()->latitude }}">
               <input type="hidden" id="longitude" name="longitude" value="{{ $address->longitude?$address->longitude:Auth::user()->longitude }}">
               </div>

               <div id="messages"></div>
               </div> 
                                       
            
            <div class="col-lg-4" id="priceCartSideBar">
               @include('e-shop.includes.checkout.priceCartSidebar')

            </div>         

               <div class="col-md-12">

                  <!-- <button class="cstm-btn solid-btn">Continue</button> -->
                  <div class="multistep-footer mt-4 text-right"> 
                  
                  <button type="submit" class="cstm-btn solid-btn submitBTN">Save &amp; Continue</button>
               </div>   

               </div>
         </div>
            </form>
   </fieldset>
      <!-- Second step start here -->

@endsection

@php
$google_api_key =  getAllValueWithMeta('google_api_key', 'global-settings');
@endphp

@section('jscript')
<script src="{{url('/admin-assets/js/validations/customValidation.js')}}"></script>
<script src="https://yauzer.com/js/validate.min.js"></script>
<script type="text/javascript" src="{{url('e-shop/js/checkout/ajax.js')}}"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{$google_api_key}}&libraries=places"></script>
<script type="text/javascript">
   
function initialize() 
{
    var input = document.getElementById('address');
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
        
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            var addressType = addressType;
            switch (addressType) { 
              case 'locality': 
                document.getElementById('city').value = val;
                break;
              case 'administrative_area_level_1': 
                document.getElementById('state').value = val;
                break;
              case 'postal_code': 
                document.getElementById('zipcode').value = val;
                break;               
              case 'country': 
                document.getElementById('country').value = val;
                document.getElementById('country_short_code').value = place.address_components[i].short_name;
                break;                  
            }            
          }
        }
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
        document.getElementById('address').value = place.name;
        autocompleted = true;
    });
}
google.maps.event.addDomListener(window, 'load', initialize);   

 </script>

@endsection
