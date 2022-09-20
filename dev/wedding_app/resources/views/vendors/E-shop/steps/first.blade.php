@extends('vendors.E-shop.steps.layouts')
@section('innerContent')

 <form method="post" id="shopCreate" action="{{url(route('shop.ajax.firstStep',1))}}"> 
<div class="panel" id="step-shop-1" data-step="1">
 <div class="shop-form-card">
  <header class="panel__header text-center">
                      <h2 class="panel__title">Name Your Shop</h2>
                      <p class="panel__subheading">Choose a memorable name that reflects your style.</p>
                  </header>
<div class="create-shop-form">
   <div class="row">
       <div class="col-lg-12">
           
               
                <div id="globalMessages"></div>
                <div class="row">
                  
                        <div class="col-lg-8">
                            <div class="form-group">
                              <div class="cstm-form-control-wrap">
                                <input type="text" name="shop_name"
                                 class="form-control shop-input"
                                  placeholder="Enter your shop name"
                                  value="{{$shop->count() > 0 ? $e->name : ''}}">
                                <input type="hidden" 
                                       id="checkAvailabilty" 
                                       value="{{url(route('shop.ajax.checkAvailablityValiadation'))}}">
                            </div>
                            </div>
                                  <div class="form-group">
                                  <p>Your shop name will appear in your shop and next to each of your listings throughout ENVISIUN. After you open your shop, you can change your name once. </p>
                                  </div>
                             
                             <div class="row">
                                <div class="col-md-12">
                                   <h5>Address</h5>
                                </div>

<?php $address = $shop->count() > 0 ? (array)json_decode($e->address) : []; ?>


                              <div class="col-md-6">
                                  
                                   <div class="form-group">
                                  <input type="text" id="address" class="form-control" name="address" autocomplete="false" 
                                  value="{{count($address) > 0 ? $address['address'] : ''}}" 
                                  placeholder="Enter your Address"
                                  autocomplete="false" 
                                   required="">
                                  <span class="input-icon"><i class="fas fa-search-location"></i></span>
                               </div>
                            </div> 
                            <div class="col-md-6">
                               

                                   <div class="form-group">
                                  <input type="text" id="country" class="form-control" name="country" 
                                  value="{{count($address) > 0 ? $address['address'] : ''}}"
                                  placeholder="Enter your Country" required="">
                                  <span class="input-icon"><i class="fas fa-flag"></i></span>
                               </div>
                            </div> 
                            <div class="col-md-6">
                                  
                                   <div class="form-group">
                                  <input type="text" id="state" class="form-control" name="state" 
                                  value="{{count($address) > 0 ? $address['state'] : ''}}"
                                  placeholder="Enter your State" required="">
                                  <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                               </div>
                            </div> 
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                  <input type="text" id="city" class="form-control" name="city" 
                                  value="{{count($address) > 0 ? $address['city'] : ''}}"
                                  placeholder="Enter your City" required="">
                                  <span class="input-icon"><i class="fas fa-city"></i></span>
                               </div>
                            </div> 
                            <div class="col-md-6">
                  
                                   <div class="form-group">
                                  <input type="text" id="zipcode" class="form-control" name="zipcode" 
                                   value="{{count($address) > 0 ? $address['zipcode'] : ''}}"
                                   placeholder="Enter Your Zipcode" required="">
                                  <span class="input-icon"><i class="fas fa-mail-bulk"></i></span>
                               </div>
                            </div>

                            
                            <input type="hidden" id="country_short_code" name="country_short_code"  value="{{count($address) > 0 ? $address['country_short_code'] : ''}}">
                            <input type="hidden" id="latitude" name="latitude"  value="{{count($address) > 0 ? $address['latitude'] : ''}}">
                            <input type="hidden" id="longitude" name="longitude" 
                            value="{{count($address) > 0 ? $address['longitude'] : ''}}">


 


 </div>




 
                        </div>


                        <div class="col-lg-4">
                          @if($shop->count() > 0)
                          <input type="hidden" name="logo" value="{{$shop->count() > 0 && $e->logo != '' ? url($e->logo) : ''}}">
                          @endif
                            <!-- Upload  -->
                          <div class="uploader file-upload-form {{$shop->count() > 0 && $e->logo != '' ? 'hasFile' : ''}}">
                            <!-- <input id="file-upload" type="file" name="logo" accept="image/*" /> -->
                              <input type="file" id="file-upload" name="logo" accept="image/*" onchange="ValidateSingleInputs(this, 'file-image')" id="logo" class="form-control">
                            <label for="file-upload" id="file-drag">
                              <img 
                              id="file-image" 
                              src="{{$shop->count() > 0 && $e->logo != '' ? url($e->logo) : ''}}" 
                              alt="Preview" 
                              class="hidden" 
                              style="display:{{$shop->count() > 0 && $e->logo != '' ? 'block' : 'none'}};"
                              >
                              <div id="start">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                
                                <div id="notimage" class="hidden">Please select an image</div>
                                <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                              </div>
                              <div id="response" class="hidden">
                                <div id="messages"></div>
                                <progress class="progress" id="file-progress" value="0">
                                  <span>0</span>%
                                </progress>
                              </div>
                            </label>
                          </div>
                        </div> 
                      </div>
                  
                       

                      
                 
               
     </div>
   </div>
  
</div>

 
   
 


 </div>
</div>

<div class="wizard__footer">
              
               <button class="cstm-btn btn-submit next">Create Shop</button>
 </div>
 </form>

@endsection

@section('scripts')
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script type="text/javascript" src="{{url('/js/vendors/shop.js')}}"></script>
 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDULjv0UAVmj_zgc9GjBhJNh9fNuEj87LQ&libraries=places"></script>



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