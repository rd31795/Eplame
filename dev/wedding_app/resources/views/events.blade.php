@extends('layouts.home')
@section('content')
  <section class="main-banner" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading">Event Listing</h1>
                <div class="search-bar-all-events">
                    <form id="fetch_events">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="cs-search d-flex">
                                  <!--   <div class="form-group">
                                    <input type="text"  class="form-control" placeholder="Location" id="event_address" name="location" autocomplete="off" >

                                    <input  type="hidden"  name="latitude" id="event_latitude" value="">
                                    <input  type="hidden"  name="longitude" id="event_longitude" value="">

                                    <span class="input-icon"><i class="fas fa-search"></i></span>
                                    </div> -->
                                            <div class="form-group">
               <input type="text"  class="form-control" placeholder="Location" id="event_address" name="location" autocomplete="off" >

               <input  type="hidden"  name="latitude" id="event_latitude" value="">
               <input  type="hidden"  name="longitude" id="event_longitude" value="">
          
               <span class="input-icon" id="search_events"><i class="fas fa-search"></i></span>
               <span id="loading"></span>
            </div>
                                </div>
                            </div>
                        </div>                  
                    </div>
                    <input type="submit"  style="display: none;" >
                    </form>
                </div>

            </div>
        </div>
    </section>
    <section class="vendor-listing-sec checklist-wrap">
        <div class="container lr-container">
            <div class="sec-card outer-wrap">
                <span class="aside-toggle">
                    <i class="fa fa-bars"></i>
                    <span class="cross-class">
                        <i class="fas fa-times" style="display: none;"></i>
                    </span>
                </span>
                @include('admin.error_message')
                @include('includes.ajaxMessage')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-content">
                            <div class="default-event_records">
                                <p>Showing Results <b id="categoryCount">{{ $hybridInperson->total() }}</b></p>
                                <hr>
                                @foreach($hybridInperson as $hyb_In)
                                    <a href="{{ url('eventDetail/' . $hyb_In->slug) }}" target="_blank">
                                        <div class="event-slide-card">
                                            <figure>
                                                <img src="{{url('/')}}/{{$hyb_In->event_picture}}" class="img-fluid">
                                            </figure>
                                            <figcaption>
                                                <h4>{{ $hyb_In->title }}</h4>
                                                <div class="event-slide-time">
                                                    <p>{{ \Carbon\Carbon::parse($hyb_In->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($hyb_In->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($hyb_In->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($hyb_In->start_time)->format('g:i A') }}</p>
                                                </div>
                                                <div class="content">
                                                    <p>{{ $hyb_In->location }}</p>
                                                </div>
                                                @if($hyb_In)
                                                    <h3>Sponsered</h3>
                                                @endif
                                            </figcaption>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="event_pagination">
                                    {{ $hybridInperson->links('pagination.default') }}
                                </div>
                                <h4>{{ $hybridInperson->total() == 0 ? 'No Records Found.' : '' }} </h4>
                            </div>
                            <div class="ajax-event_records owl-carousel owl-theme owl-loaded owl-drag">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- banner section starts Ends here -->

@endsection

@section('scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrGKmz60iMoKfZLLQSK5LOzqHCf_TynQM&libraries=places"></script>
<script>
// function initialize() 
// {
//     var input = document.getElementById('event_address');
//     var options = {    
//     types: ['address'],
//     componentRestrictions: {country: ["us", "ca"]}
//     };
//     var componentForm = {
//       street_number: 'short_name',
//       route: 'long_name',
//       locality: 'long_name',
//       administrative_area_level_1: 'short_name',
//       country: 'long_name',
//       postal_code: 'short_name'
//     };    
//     var autocomplete = new google.maps.places.Autocomplete(input, options);
//     google.maps.event.addListener(autocomplete, 'place_changed', function () {
//         var place = autocomplete.getPlace();
        
//         for (var i = 0; i < place.address_components.length; i++) {
//         var addressType = place.address_components[i].types[0];
//         if (componentForm[addressType]) {
//             var val = place.address_components[i][componentForm[addressType]];
//             console.log(addressType); 
//         }
//         }
//         document.getElementById('event_latitude').value = place.geometry.location.lat();
//         document.getElementById('event_longitude').value = place.geometry.location.lng();
//         autocompleted = true;
//     });

    
// }
// google.maps.event.addDomListener(window, 'load', initialize);

$("#search_events").on("click",()=>{
          var event_address = $("#event_address").val();
          var latitude = $("#event_latitude").val();
          var longitude = $("#event_longitude").val();
          ajax(event_address,latitude,longitude);
})  
$("#fetch_events").on("submit",(e)=>{
      e.preventDefault();
       var event_address = $("#event_address").val();
       var latitude = $("#event_latitude").val();
          var longitude = $("#event_longitude").val();
          ajax(event_address,latitude,longitude);
});


function ajax(event_address,latitude,longitude){
     $.ajax({
                method: 'post',
                url : "<?= url(route('home.eventsearch')) ?>",
                data:  { latitude: latitude,longitude: longitude,event_address:event_address },
                headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                success: function(response) {
                    console.log("response of search", response);
                    $(".default-event_records").hide();
                    if(response == "false"){
                        $(".ajax-event_records").html('<h4>No Records Found</h4>');
                    }else{
                        if(response.trim() == ''){
                            $(".ajax-event_records").html('<h4>No Records Found</h4>');
                        }else{
                            $(".ajax-event_records").html(response);
                        }
                    }
                },
                    beforeSend:function(){
                $(".custom-loading").show();
            },
            complete:function(){
                $(".custom-loading").hide();
            }

                    
                    //  $('.first_event_records').removeClass('d-none');
                    //  $('.view_all_events').removeClass('d-none');
                    //  if(response == "false"){
                    //     $('#event-slider-1').show();
                    //     $('#event-slider-2').show();
                    //     $("#event-slider-3").show();
                    //  }else{
                    //     $('#event-slider-1').hide();
                    //     $('#event-slider-2').hide();
                    //     if(response.trim() == ''){
                    //         $('.view_all_events').addClass('d-none');
                    //         $('.first_event_records').removeClass('d-none');
                    //     }else{
                    //         $('.view_all_events').removeClass('d-none');
                    //         $('.first_event_records').addClass('d-none');
                    //     }

                    //     $("#event-slider-3").html(response);
                    //   } 
            });
}



// $(document).ready(function() {
//     $('#event_address').focusout(function() {
//         setTimeout(function() { 
//             var event_address = $("#event_address").val();
//             var latitude = $("#event_latitude").val();
//             var longitude = $("#event_longitude").val();
//             console.log("latitude", latitude);
//             console.log("longitude", longitude);


//             $.ajax({
//                 method: 'post',
//                 url : "<?= url(route('home.eventsearch')) ?>",
//                 data:  { latitude: latitude,longitude: longitude,event_address:event_address },
//                 headers: {
//                 'X-CSRF-TOKEN': $('input[name=_token]').val()
//                 },
//                 success: function(response) {
//                     console.log("response of search", response);
//                     $(".default-event_records").hide();
//                     if(response == "false"){
//                         $(".ajax-event_records").html('<h4>No Records Found</h4>');
//                     }else{
//                         if(response.trim() == ''){
//                             $(".ajax-event_records").html('<h4>No Records Found</h4>');
//                         }else{
//                             $(".ajax-event_records").html(response);
//                         }
//                     }

                    
//                     //  $('.first_event_records').removeClass('d-none');
//                     //  $('.view_all_events').removeClass('d-none');
//                     //  if(response == "false"){
//                     //     $('#event-slider-1').show();
//                     //     $('#event-slider-2').show();
//                     //     $("#event-slider-3").show();
//                     //  }else{
//                     //     $('#event-slider-1').hide();
//                     //     $('#event-slider-2').hide();
//                     //     if(response.trim() == ''){
//                     //         $('.view_all_events').addClass('d-none');
//                     //         $('.first_event_records').removeClass('d-none');
//                     //     }else{
//                     //         $('.view_all_events').removeClass('d-none');
//                     //         $('.first_event_records').addClass('d-none');
//                     //     }

//                     //     $("#event-slider-3").html(response);
//                     //   } 
//                 }
//             });
//         }, 800);
//     });
// });
</script>
@endsection