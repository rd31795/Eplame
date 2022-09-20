@extends('layouts.vendor')
@section('vendorContents')

<div class="container-fluid">
  @include('admin.error_message')
      <div class="row">

      <div class="col-lg-6 offset-lg-3">
        <div class="section-title text-center">
          <h2>SHIPPING ADDRESS SETTING</h2>
        </div>
      <div class="vendor-form-wrap">
        <form
        method="post"
        id="shippingForm"
        action="{{route('add_vendor_shipping_address')}}"
        >
        @csrf
          <div class="row">
           <div class="col-lg-12">
            <div class="row">
            <div class="col-md-6">
                   <div class="form-group">
                  <input type="text" id="phone_number" class="form-control" name="phone_number"
                  value="{{$address->phone_number ?? ''}}"
                  placeholder="Enter your Phone Number">
                  <span class="input-icon"><i class="fas fa-phone-alt" ></i></span>
               </div>
            </div>
            <div class="col-md-6">
                   <div class="form-group">
                  <input type="text" id="address" class="form-control" name="address" autocomplete="false"
                  value="{{$address-> address ?? ''}}"
                  placeholder="Enter your Street Address"
                  autocomplete="false"
                  >
                  <span class="input-icon"><i class="fas fa-search-location"></i></span>
               </div>
            </div>

            

            <div class="col-md-6">
                   <div class="form-group">
                  <input type="text" id="country" class="form-control" name="country"
                  value="{{$address-> country ?? ''}}"
                  placeholder="Enter your Country">
                  <span class="input-icon"><i class="fas fa-flag"></i></span>
               </div>
            </div>
            <div class="col-md-6">
                   <div class="form-group">
                  <input type="text" id="state" class="form-control" name="state"
                  value="{{$address->   state ?? ''}}"
                  placeholder="Enter your State">
                  <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
               </div>
            </div>
            <div class="col-md-6">
                   <div class="form-group">
                  <input type="text" id="city" class="form-control" name="city"
                  value="{{$address->   city ?? ''}}"
                  placeholder="Enter your City">
                  <span class="input-icon"><i class="fas fa-city"></i></span>
               </div>
            </div>
            <div class="col-md-6">
                   <div class="form-group">
                  <input type="text" id="zipcode" class="form-control" name="zipcode"
                  value="{{$address->     zipcode ?? ''}}"
                  placeholder="Enter Your Zipcode">
                  <span class="input-icon"><i class="fas fa-mail-bulk"></i></span>
               </div>
            </div>
            <div class="col-md-12">
                   <div class="form-group">
                  <input type="text" id="address_2" class="form-control" name="address_2" autocomplete="false"
                  value="{{$address->       address_2 ?? ''}}"
                  placeholder="Enter Extra Address Details (Optional)"
                  autocomplete="false"
                  >
                  <span class="input-icon"><i class="fas fa-search-location"></i></span>
               </div>
            </div>
            <div class="col-md-12">
                   <div class="form-group">
                      <button type="submit" class="btn btn-block btn-primary" id="add_shipping_address">Add Shipping Address</button>
                   </div>
            </div>

            <input type="hidden" id="country_short_code" name="country_short_code" value="{{$address->       country_code  ?? ''}}">
            <input type="hidden" id="latitude" name="latitude" value="{{$address->        latitude ?? ''}}">
            <input type="hidden" id="longitude" name="longitude" value="{{$address->       longitude ?? ''}}">


      </div>
    </div>
      </div>
    </div>

@endsection

@section('scripts')
<script src="{{url('/admin-assets/js/validations/customValidation.js')}}"></script>
<script src="https://yauzer.com/js/validate.min.js"></script>
<script src="{{url('/js/validations/vendorShippingAddressValidation.js')}}"></script>
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
