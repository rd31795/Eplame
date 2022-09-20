<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="https://www.eplame.com/dev/frontend/css/styles.css">
@extends('layouts.home')
@section('content')
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Registration Form</h1>
        </div>
    </div>
</section>
<section class="services-tab-sec Personal-Information-from">
    <div class="container">
        <div class="sec-card step1">
            <!-- event flyer -->
           <!--  <div class="event-flyer">
    <div class="event-flyer-content">
        <h2>EVENT NAME</h2>
        <hr>
        <hr>
        <figure>
            <img src="" class="img-fluid">
        </figure>
        <div class="event-flyer-wrapper">
            <h5>DAY</h5>
            <h6>MONTH</h6>
        </div>
        <hr>
        <div class="event-flyer-wrapper">
            <h5>TIME</h5>
            <h6>AM/PM</h6>
        </div>
        <hr>
        <div class="event-flyer-wrapper">
            <h5>PLACE</h5>
            <h6>ADDRESS</h6>
        </div>
        <hr>
        <h4>FREE DRINKS</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
    </div>
</div> -->
            <!-- event flyer end -->
         <h3 class="text-center">Personal Information</h3>
            <h5 class="text-center">Fill out the information below, then click Next to continue.</h5>
            <div id="messages"></div>
            <form class="step2-form" id="billingFormReg" method="post">
                 @csrf
                <input type="hidden" name="event_id" id="event_id" value="{{$user_event->id}}">
                <!-- 210930 -->
                 <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">First Name <i class="fas fa-info-circle" data-toggle="tooltip" title="First Name of the Guest"></i></label>
                            <div class="input-wrap">
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control">
                                <input type="hidden" name="event_id" value="{{$user_event->id}}" class="form-control">
                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Last Name <i class="fas fa-info-circle" data-toggle="tooltip" title="Last Name of the Guest"></i></label>
                            <div class="input-wrap">
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Age <i class="fas fa-info-circle" data-toggle="tooltip" title="Age of the Guest"></i></label>
                            <div class="input-wrap">
                                <input type="text" name="age" id="age" placeholder="Age" class="form-control">
                                <input type="hidden" id="hidden-guest-id" name="guest_id" class="form-control">
                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Gender <i class="fas fa-info-circle" data-toggle="tooltip" title="Gender of the Guest"></i></label>
                            <div class="input-wrap">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="input-icon"><i class="fas fa-chevron-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Email <i class="fas fa-info-circle" data-toggle="tooltip" title="Guest will get an email having invite URL."></i></label>
                            <div class="input-wrap">
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Contact Number <i class="fas fa-info-circle" data-toggle="tooltip" title="Contact Number of the Guest."></i>
                                </label>
                            <div class="input-wrap">
                                <input type="text" name="mobile" id="mobile" placeholder="Contact Number" class="form-control">
                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </div>
                    </div>
                     @if(count($register_type) > 0)
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label mb-2">Registration Type<i class="fas fa-info-circle" data-toggle="tooltip" title="According to Registration Type fee will be calculate"></i>
                            </label>
                            <div class="input-wrap">
                                    @foreach($register_type as $register_data)
                                    @if($register_data->available_seats>0)

                                    <input type="radio" name="reg_type" id="reg_type"  value="{{$register_data->id}}" >
                                    <label for="corp-2" style="text-transform: uppercase;"><strong>{{$register_data->reg_type}}</strong>({{$register_data->price}}$)</label><br>
                                    <p style="font-size:14px;">{{$register_data->description}}</p>
                                    @if($register_data->inventory > 1)
                                      <select name="inventory_{{$register_data->id}}" class="form-control">
                                        @for($i=1;$i<=$register_data->inventory;$i++)
                                          <option  value="{{$i}}">{{$i}}</option>
                                        @endfor
                                      </select> 
                                    @endif
                                    <hr>
                                    @else
                                     <strong>SOLD OUT</strong>
                                     <label for="corp-2" style="text-transform: uppercase;
    opacity: 0.5;
    text-decoration: line-through;"><strong>{{$register_data->reg_type}}</strong>({{$register_data->price}}$)</label><br>
                                     <p style="font-size:14px;">{{$register_data->description}}</p>
                                     <hr>
                                    @endif
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                     <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Address <i class="fas fa-info-circle" data-toggle="tooltip" title="Address of the Guest"></i></label>
                            <div class="input-wrap">
                                 <input type="text" id="address" class="form-control" name="address" autocomplete="false" placeholder="Enter your Address">
                                <span class="input-icon"><i class="fas fa-search-location"></i></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Country <i class="fas fa-info-circle" data-toggle="tooltip" title="Country of the Guest"></i></label>
                            <div class="input-wrap">
                                 <input type="text" id="country" class="form-control" name="country" placeholder="Enter your Country"> 
                                <span class="input-icon"><i class="fas fa-flag"></i></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">State <i class="fas fa-info-circle" data-toggle="tooltip" title="State of the Guest"></i></label>
                            <div class="input-wrap">
                                <input type="text" id="state" class="form-control" name="state" placeholder="Enter your State"> 
                                <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">City <i class="fas fa-info-circle" data-toggle="tooltip" title="City of the Guest"></i></label>
                            <div class="input-wrap">
                                <input type="text" id="city" class="form-control" name="city" placeholder="Enter your City">
                                <span class="input-icon"><i class="fas fa-city"></i></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Zipcode <i class="fas fa-info-circle" data-toggle="tooltip" title="Zipcode"></i></label>
                            <div class="input-wrap">
                                  <input type="text" id="zipcode" class="form-control" name="zipcode" placeholder="Enter Your Zipcode">
                                <span class="input-icon"><i class="fas fa-mail-bulk"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label mb-2">Group</label>
                            <div class="input-wrap">
                                <select name="group" id="group" class="form-control">
                                    @if(!empty($user_event_groups[0]->id))
                                    @foreach($user_event_groups as $user_event_group)
                                    <option value="{{$user_event_group->id}}">{{$user_event_group->group_label}}</option>
                                    @endforeach
                                    @else
                                    <option value="">Please add a group</option>
                                    @endif
                                </select>
                                <span class="input-icon"><i class="fas fa-chevron-down"></i></span>
                            </div>
                        </div>
                    </div> -->
                  <!--   <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label mb-2">Menus</label>
                            <div class="input-wrap">
                                <select name="menu" id="menu" class="form-control">
                                    @if(!empty($user_event_menus[0]->id))
                                    @foreach($user_event_menus as $user_event_menu)
                                    <option value="{{$user_event_menu->id}}">{{$user_event_menu->menu_label}}</option>
                                    @endforeach
                                    @else
                                    <option value="">Please add a menu</option>
                                    @endif
                                </select>
                                <span class="input-icon"><i class="fas fa-chevron-down"></i></span>
                            </div>
                        </div>
                    </div> -->
                     <input type="hidden" id="country_short_code" name="country_short_code" >
                    <input type="hidden" id="latitude" name="latitude" >
                    <input type="hidden" id="longitude" name="longitude" >
                    
                </div>
                <!-- 210930 end -->
               <div class="payment-button-wrapper">
                    <button  id="billingFormBtnReg" type="submit"  class="cstm-btn solid-btn">
                        Save & Continue
                    </button>
                </div>
            </form>
        </div>
      
         
        
    </div>
</section>
<!-- Modal -->
@endsection
@section('scripts')
<script type="text/javascript" src="{{url('/js/cartpage.js')}}"></script>

<script src="{{ asset('/js/checkout/billingValidationReg.js') }}" ></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrGKmz60iMoKfZLLQSK5LOzqHCf_TynQM&libraries=places"></script>
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
<style type="text/css">
/*event flyer*/
.event-flyer {
    padding: 50px;
    background: #a1a1a1;
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
    background-image: url('https://i.pinimg.com/736x/13/46/73/134673ec17caaa90555af1391869b6b8.jpg');
    background-size: cover;
    background-position: center;
    margin-bottom: 30px;
}

.event-flyer-content {
    background-color: #091327;
    color: #fff;
    padding: 25px;
}

.event-flyer-content h2 {
    color: #eca321;
}

.event-flyer-content hr {
    background-color: #929292!important;
}

.event-flyer-content p {
    color: #fff;
    font-size: 14px;
}

.event-flyer-content h4 ,.event-flyer-content h5 ,.event-flyer-content h6 {
    color: #fff;
}
.event-flyer-content h4 {
    font-size: 22px;
    font-weight: 700;
    color: silver;
}
.event-flyer-content h5 {
    font-size: 20px;
    font-weight: 600;
}
/*event flyer end*/
</style>

@endsection