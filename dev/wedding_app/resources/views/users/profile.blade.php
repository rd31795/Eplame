@extends('users.layouts.layout')
@section('content')

<div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10"></h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url(route('user_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

  <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
 
            <div class="card-body">

              @include('admin.error_message')
              <form method="post" action="{{route('profile_deactivation')}}" class="pass-settings">
                @csrf
                
                <button type="submit" class="btn btn-primary deactive-button ml-auto" ><?= Auth::User()->user_active == 0 ? 'Activate' : 'Deactivate' ?></button>
              </form>
              <div class="row">
                <div class="col-md-6">
                  <h3>Profile</h3>
                  <form role="form" id="profileForm" method="post" action="{{url('user/profile')}}" enctype="multipart/form-data">
                    <div class="profile-card">
                      @csrf

                      <input type="hidden" class="form-control" name="latitude" value="{{Auth::User()->latitude}}" id="latitude">
                      <input type="hidden" class="form-control" name="longitude" value="{{Auth::User()->longitude}}" id="longitude">
                      
                      {{textbox($errors,'Name','name',Auth::User()->name)}}
                      {{textbox($errors,'Phone Number','phone_number',Auth::User()->phone_number)}}
                      <!-- {{textbox($errors,'Location','user_location', Auth::User()->user_location)}} -->
                      <div class="user_address">
                      	<hr>
                      	@php
                      	 $address=DB::table('address_details')->where('user_id',Auth::id())->first();
                      	@endphp
                      <div class="form-group label-floating is-focused">
                        <label class="control-label">Location</label>
                        <input type="text" class="form-control" id="location" name="user_location" value="{{Auth::User()->user_location}}">
                      </div>
                           @if($address)
                           <input type="hidden" value="{{$address->id}}" name="address_id">
                           @endif 
                		   <div class="form-group">
                               <input type="text" id="country" class="form-control valid" name="country" value="{{$address->country ?? ''}}" placeholder="Enter your Country">
                           </div>
                           <div class="form-group">
                               <input type="text" id="state" class="form-control valid" name="state" value="{{$address->state ?? ''}}" placeholder="Enter your State">
                           </div>
                           <div class="form-group">
                               <input type="text" id="city" class="form-control valid" name="city" value="{{$address->city ?? ''}}" placeholder="Enter your City">
                           </div>
                           <div class="form-group">
                           	   <input type="text" name="country_short_code" class="form-control valid" id="country_short_code" value="{{$address->country_short_code ?? ''}}" placeholder="Country Short Code">
                           </div>
                           <div class="form-group">
                               <input type="text" id="zipcode" class="form-control valid" name="zipcode" value="{{$address->zipcode ?? ''}}" placeholder="Enter Your Zipcode">
                           </div>
                         
                           <hr>
                       </div>

                       <div class="profile-image">
                             <input type="file" name="image" accept="image/*" onchange="ValidateSingleInput(this, 'image_src')" id="selImage" class="form-control">
                             <img id="image_src" class="img-radius" style="width: 100px; height: 100px; margin-top: 6px;" src="{{ Auth::User()->profile_image ? asset('').'/'.Auth::User()->profile_image : asset('/images/user.jpg') }}">
                              @if ($errors->has('image'))
                                  <div class="error">{{ $errors->first('image') }}</div>
                              @endif
                       </div>
                      
                    </div>
                    <!-- /.card-body -->

                    <div class="profile-card-ftr">
                      <button type="submit" id="profileFormBtn" class="btn btn-primary">Update Profile</button>
                    </div>
                  </form>
                </div>

                <div class="col-md-6">
                  <h3>Password Settings</h3>
                  <form role="form" id="passwordForm" method="post" enctype="multipart/form-data">
                    <div class="profile-card">
                       @csrf
                       {{password($errors,'Old Password*','old_password')}}
                       {{password($errors,'New Password*','password')}}
                       {{password($errors,'Confirm Password*','password_confirmation')}}                  
                    </div>
                    <!-- /.card-body -->

                    <div class="">
                      <button type="submit" id="passwordFormBtn" class="btn btn-primary">Change Password</button>
                    </div>
                 </form>
                </div>
              </div>        
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
     
     



@endsection
@section('scripts')
<script src="{{url('/js/validations/profileValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<!-- <script src="{{url('/js/setLatLong.js')}}"></script> -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrGKmz60iMoKfZLLQSK5LOzqHCf_TynQM&amp;libraries=places"></script>
 <script type="text/javascript">
function initialize() 
{
    var input = document.getElementById('location');
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
