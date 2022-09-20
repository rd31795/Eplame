<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="https://www.eplame.com/dev/frontend/css/styles.css">
<style type="text/css">
.cs-weather-wrapper {
    border: none;
    min-height: 170px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 8px;
    color: white;
    padding: 20px 15px;
    position: relative;
    overflow: hidden;
}

.cs-weather-wrapper span.weather-city {
    color: #fff;
}

section.about-theme-sec {
    background-color: #f3f3f3;
    padding: 50px 0;
}

.about-theme-content {
    box-shadow: 0 0 8px rgb(0 0 0 / 41%);
    padding: 35px 30px;
    border-radius: 10px;
    background-color: #fff;
}

.about-theme-content h3 {
    text-align: center;
    font-size: 40px;
    line-height: 48px;
    margin-bottom: 20px;
    font-weight: 600;
}

.about-theme-content h5 {
    font-size: 18px;
    font-weight: 500;
    padding-bottom: 12px;
    margin-top: 20px;
}

.about-theme-content p {
    margin-bottom: 10px;
}

.cs-theme-img img {
    width: 100%;
    max-width: 260px;
}

.cs-event-theme .row {
    margin: 0 !important;
}

.pending-done-card {
    width: 100%;
    text-align: center;
    border-radius: 10px;
    padding: 15px 10px;
    box-shadow: 0 0 10px rgb(0 0 0 / 30%);
    margin: 10px 0;
    background-image: linear-gradient(to bottom right, #35476b, #b58ec3);
}

.pending-done-card img {
    border-radius: 50%;
    width: 120px !important;
    height: 120px !important;
    object-fit: cover;
    margin-bottom: 20px;
}

.pending-done-card h4,
.pending-done-card p {
    color: #fff;
}

.pending-done-card h4 span {
    display: block;
    font-size: 14px;
    color: #ebebeb;
    border-bottom: 1px solid;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.cs-content-card p {
    color: #000;
    font-size: 15px;
    padding-top: 3px;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.social-links.event-listing-social li a:hover {
    color: #0a173a;
}
.cs-sticky {
    position: sticky!important;
    top: 30px;
}
.eventDetail_added .row {
    align-items: flex-start;
}
.event-listing-card figure img {
    width: 100%;
}
.cs-email-event_inner {
    word-break: break-all;
}
.event-listing-card.cs-event-listing-card .wrap_event_widget label {
    min-width: 70px;
}
select#select_weather_unit {
      width: 90%;
      background: #ffffff;
      padding: 7px;
      border-radius: 30px;
      outline: none;
      margin: 10px auto;
      text-align: center;
      justify-content: center;
      display: flex;
  }
.weather_unit_wrapper select#select_weather_unit {
    margin: 0;
    flex: 0 0 54px;
}

.weather_unit_wrapper input#weather-report {
    height: 41px;
    padding: 0 30px;
    margin-right: 10px;
}
</style>
@extends('layouts.home')
@section('content')
<section class="main-banner cust-banner-height eventDetail_added" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>{{$user_event->title}}</h1>
        </div>
    </div>
</section>
<section class="cs-event-Detail-sec eventDetail_added cs-event-theme">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 cs-sticky">
                <div class="event-listing-card">
                    <figure>
                        <img src="{{url('/')}}/{{$user_event->event_picture}}" class="img-fluid" alt="event-listing-img">
                    </figure>
                </div>
                <div class="event-listing-card cs-content-card">
                    <!-- <div class="row"> -->
                        <!-- <div class="col-lg-12"> -->
                            <div class="about-theme-card">
                                <h5>
                                    About this event
                                </h5>
                                <p>{{$user_event->description ? $user_event->description : $user_event->long_description}}</p>
                                @php $colours = (array)json_decode($user_event->colour); @endphp
                                <!-- <h5>Theme color code</h5> -->
                            </div>
                        <!-- </div> -->
                    <!-- </div> -->
                    <hr>
                    <ul class="social-links justify-content-end event-listing-social">
                        @if(getAllValueWithMeta('facebook', 'global-settings') == '1')
                        <li>
                            <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => $user_event->user_id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->facebook() ?>">
                                <i<span><i class="fab fa-facebook-f"></i></span>
                            </a>
                        </li>
                        @endif
                        @if(getAllValueWithMeta('twitter', 'global-settings') == '1')
                        <li>
                            <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => $user_event->user_id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->twitter() ?>">
                                <span><i class="fab fa-twitter"></i></span>
                            </a>
                        </li>
                        @endif
                        @if(getAllValueWithMeta('linkdin', 'global-settings') == '1')
                        <li>
                            <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => $user_event->user_id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->linkedin() ?>">
                                <span><i class="fab fa-linkedin-in"></i></span>
                            </a>
                        </li>
                        @endif
                        @if(getAllValueWithMeta('pintrest', 'global-settings') == '1')
                        <li>
                            <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => $user_event->user_id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->pinterest() ?>">
                                <span><i class="fab fa-pinterest"></i></span>
                            </a>
                        </li>
                        @endif
                        @if(getAllValueWithMeta('email', 'global-settings') == '1')
                        <li>
                            <a target="_blank" href="javascript:void(0)" data-toggle="modal" data-target="#reg-share-event">
                                <span><i class="fas fa-envelope"></i></span>
                            </a>
                        </li>
                        @endif
                        @if(getAllValueWithMeta('whatsapp', 'global-settings') == '1')
                        <li>
                            <a target="_blank" href="https://wa.me/?text={{route('forum.user.eventDetail',  ['id' => $user_event->user_id, 'slug' => $user_event->slug])}}" data-action="share/whatsapp/share">
                                <span><i class="fab fa-whatsapp"></i></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                @if($user_event->registration == 'yes')
                @if($user_event->max_person != $event_count)
                <div class="event-listing-card cs-content-card cs-registration-outer">
                    <div class="lines-with-btn">
                        <a href='{{url("/")."/registration/".$user_event->id."/".$user_event->slug."/event"}}' target="_blank" class="details-regBtn">Registration / Get Ticket</a>
                    </div>
                </div>
                @else
                <div class="event-listing-card cs-content-card">
                    <div class="lines-with-btn">
                        <a href='' class="details-regBtn">SOLD OUT</a>
                    </div>
                </div>
                @endif
                @endif
                <div class="event-listing-card cs-content-card">
                    <div class="cs-date">
                        <h5>Event Details</h5>
                        <hr>
                        <time class="clrfix" data-automation="event-details-time">
                            <p> <strong>Date:</strong> &nbsp;{{ \Carbon\Carbon::parse($user_event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($user_event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($user_event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($user_event->start_date)->formatLocalized('%Y') }}</p>
                            <p> <strong>Time:</strong> &nbsp;{{ \Carbon\Carbon::parse($user_event->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($user_event->end_time)->format('g:i A') }}</p>
                            <p><strong>Ticket:</strong> &nbsp;
                                @if($min == $max)
                                @if(empty($min)) FREE @else {{$min}} @endif
                                @elseif($min != $max)
                                ${{$min}} - ${{$max}}
                                @else
                                FREE
                                @endif</p>
                            <hr>
                            <div class="cs-Location">
                                <h5>Location</h5>
                                <hr>
                                <div class="event-details__data">
                                    @if($user_event->location == '')
                                    <p>Online - Anywhere w/Fast Wifi and Sound, USA</p>
                                    @else
                                    <p>{{$user_event->location}}</p>
                                    @endif
                                    <div id="map"></div>
                                </div>
                            </div>
                            <hr>
                            @if($user_event->latitude && $user_event->longitude)
                            @php
                            $start_date=\Carbon\Carbon::parse($user_event->start_date);
                            $start_date=$start_date->format('Y-m-d');
                            @endphp
                            <div id="weather_api">
                                @php
                                $start_date=\Carbon\Carbon::parse($user_event->start_date);
                                $start_date=$start_date->format('Y-m-d');
                                @endphp

                                <input type="hidden" id="venue_weather_route" value="https://eplame.com/dev/venue/get-weather?latitude={{$user_event->latitude}}&longitude={{$user_event->longitude}}&time={{$start_date}}">
                            </div>
                            <!-- weather section -->
                            <div class="card">
                                <div class="card-block">
                                    <div class="" id="">
                                        <div id="weather_api">
                                            <input type="hidden" id="venue_weather_route" value="https://eplame.com/dev/venue/get-weather?latitude=40.71895689999999&amp;longitude=-74.00128629999999&amp;time=2022-03-19">
                                        </div>
                                        <!-- weather section -->
                                        <div class="" id="">
                                            <div class="cs-weather-wrapper" data-wow-delay="500ms" style="background-image: url({{ asset('frontend/images/weather.png') }})">
                                                <div class="evt-theme-body">
                                                    <div class="form-group mb-0 weather_unit_wrapper d-flex align-items-center justify-content-between">
                                                        <input type="date" min="{{date('Y-m-d', strtotime($user_event->start_date))}}" max="{{date('Y-m-d', strtotime($user_event->end_date))}}" value="{{date('Y-m-d', strtotime($user_event->start_date))}}" class="form-control" id="weather-report" placeholder="select date">
                                                        <select id="select_weather_unit">
                                                             <option value=1>°C</option>
                                                             <option value=2>°F</option>
                                                        </select>
                                                    </div>
                                                    <div class="weather-mini-card mt-2">
                                                        <div class="weather-info">
                                                            <div class="weather-info-wrapper">
                                                                <div class="info-date">
                                                                    <h1 id="sidebar-localTime"></h1>
                                                                    <h5><span id="sidebar-localDate">{{$user_event->start_date}}</span></h5>
                                                                </div>
                                                                <div class="info-weather">
                                                                    <div class="weather-wrapper">
                                                                        <span class="weather-temperature" id="sidebar-mainTemperature">24°C</span>
                                                                        <div class="weather-sunny"><img id="sidebar-main-icon1" src=""></div>
                                                                    </div>
                                                                    <h4 class="seasonName">
                                                                        <span class="weather-city">Season</span>
                                                                        <spam id="seasonName"></spam>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <p>
                                <button type="button" class="cstm-btn solid-btn" data-toggle="modal" data-target="#exampleModal">Add to Calendar</button>
                            </p>
                        </time>
                    </div>
                </div>
                <div class="event-listing-card cs-event-listing-card">
                    <h5>ORGANIZERS</h5>
                    <hr>
                    <div class="wrap_event_widget">
                        <div class="clearfix event_row">
                            <label>Name: </label>
                            <span>{{$user_data->name}}</span>
                        </div>
                        <div class="clearfix event_row">
                            <label>Email: </label>
                            <span class="cs-email-event_inner">{{$user_data->email}}</span>
                        </div>
                        <div class="clearfix event_row">
                            <label>Phone: </label>
                            <span>{{$user_data->phone_number}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add to Calender</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a href="{{$google}}" target="_blank" class="cstm-btn solid-btn"> Google Calender</a><br>
                            <a href="{{$yahoo}}" target="_blank" class="cstm-btn solid-btn"> Yahoo Calender</a><br>
                            <a href="{{$outlook}}" target="_blank" class="cstm-btn solid-btn"> Outlook Calender</a><br>
                            <a href="{{$ics}}" target="_blank" class="cstm-btn solid-btn"> iCal Calender</a>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-theme-sec">
    <div class="container">
        <!-- **************section*********** -->
        <div class="about-theme-content">
            <h3>{{$user_event->title}}</h3>
            <div class="row">
                <!-- 21 -->
                <div class="col-lg-8">
                    <div class="about-theme-card">
                        <!-- Event Theme -->
                        <h5>Event Theme</h5>
                        <p>{{$user_event->style_description}}</p>
                        @if($user_event->style_id > 0 || !empty($user_event->style_image))
                        @if($user_event->style_id > 0)
                        <div class="cs-theme-img">
                            <img src="{{url('/wedding_app/public/uploads/').'/'.$user_event->style->image}}">
                        </div>
                        @else
                        <div class="cs-theme-img">
                            <img src="{{asset('').'/'.$user_event->style_image}}">
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="event_theme_color">
                        @foreach($colours as $key => $colour)
                        <li>
                            <div class="theme-color-wrap">
                                <h5>
                                    <span>Color Name:</span> &nbsp; {{$colour->colourName }}
                                </h5>
                                <span class="theme-color-box" style="background:{{ 
                                    $colour->colour }}; height:100px; width:100px;"></span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-12">
                    @php
                    $teams=\DB::table('user_event_person')->where('event_id',$user_event->id);
                    @endphp
                    @if($teams->count() > 0)
                    <div class="event_teams">
                        <div class="team-title">
                            <center>
                                <h3><strong>CELEBRITY SINGERS</strong></h3>
                            </center>
                        </div>
                        <div class="row">
                            @foreach($teams->get() as $key=>$value)
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex">
                                <div class="pending-done-card">
                                    <figure>
                                        <img src="{{url($value->image)}}" style="width: 120px;height: auto;" class="img-fluid" alt="">
                                    </figure>
                                    <h4>{{$value->name}}
                                        <span>
                                            ({{$value->title}})
                                        </span>
                                    </h4>
                                    <p>{{$value->short_desc}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- **************section*********** end-->
    </div>
</section>
<section class="home-event-types" style="background:url('{{url('/')}}/frontend/images/event-back.png');" data-step="7" data-intro="You will find the popular events here.">
    <div class="container">
        <div class="sec-heading text-center">
            <h4>More Events</h4>
            <h2>Near by you</h2>
        </div>
        <!--Row One-->
        <div class="event-slider owl-carousel owl-theme owl-loaded owl-drag" id="event-slider-1">
            @foreach($virtualEvent as $virtual)
            <div class="item">
                <!-- card -->
                <a href="{{ url('eventDetail/' . $virtual->slug) }}" target="_blank">
                    <div class="event-slide-card">
                        <figure>
                            <img src="{{url('/')}}/{{$virtual->event_picture}}" class="img-fluid">
                        </figure>
                        <figcaption>
                            <h4>{{ $virtual->title }}</h4>
                            <div class="event-slide-time">
                                <p>{{ \Carbon\Carbon::parse($virtual->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($virtual->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($virtual->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($virtual->start_time)->format('g:i A') }}</p>
                            </div>
                            <div class="content">
                                <p>Online - Anywhere w/Fast Wifi and Sound</p>
                                @if($virtual->reg_fee != 0)
                                <p><span class="icon"><i class="fas fa-dollar-sign"></i></span>{{ $virtual->reg_fee }}</span></p>
                                @else
                                <p>Free</p>
                                @endif
                            </div>
                        </figcaption>
                    </div>
                </a>
                <!-- card end -->
            </div>
            @endforeach
        </div>
        <!--Row Two-->
        <div class="event-slider owl-carousel owl-theme owl-loaded owl-drag">
            @foreach($hybridInperson as $hyb_In)
            <div class="item">
                <!-- card -->
                <a href="{{ url('eventDetail/' . $hyb_In->slug) }}" target="_blank"">
                    <div class=" event-slide-card">
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
                            @if($hyb_In->reg_fee != 0)
                            <p><span class="icon"><i class="fas fa-dollar-sign"></i></span>{{ $hyb_In->reg_fee }}</span></p>
                            @else
                            <p>Free</p>
                            @endif
                        </div>
                    </figcaption>
            </div>
            </a>
            <!-- card end -->
        </div>
        @endforeach
    </div>
    </div>
</section>
<div id="reg-share-event" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Share Event Registration form</h4>
                <button type="button" class="close share-event-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="alert alert-success share-success" role="alert" style="display: none;">
                    <p>Event Registration form has been shared successfully</p>
                </div>
                <form id="shareRegistrationEventForm">
                    @csrf
                    <div class="form-group cstm-email-div">
                        <label for="exampleInputEmail1">Email Id</label>
                        <input type="text" name="email" class="form-control" placeholder="Email Address...">
                        <input type="hidden" name="event_id" id="event-id" value="{{$user_event->id}}">
                    </div>
                    <button type="submit" class="cstm-btn solid-btn" id="shareRegistrationEventFormBtn" type="submit">Share</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@endsection
@section('scripts')
<script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrGKmz60iMoKfZLLQSK5LOzqHCf_TynQM&callback=initMap"></script>
<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: parseFloat('<?php if($user_event->latitude == '
                '){ echo $lat = 36.778259;}else{ echo $lat = $user_event->latitude;};?>'),
            lng: parseFloat('<?php if($user_event->longitude == '
                '){ echo $long =  -119.417931;}else{ echo $long = $user_event->longitude;};?>')
        },
        scrollwheel: false,
        zoom: 2
    });
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {
            lat: parseFloat('<?php if($user_event->latitude == '
                '){ echo $lat = 36.778259;}else{ echo $lat = $user_event->latitude;};?>'),
            lng: parseFloat('<?php if($user_event->longitude == '
                '){ echo $long = -119.417931;}else{ echo $long = $user_event->longitude;};?>')
        }
    });
    marker.addListener('click', toggleBounce);
} // close function here

$(document).ready(function() {

    setTimeout(() => {
        // jQuery().find('.custom-loading').hide();
        $('#event-slider-1').css('display', 'block');
    }, 1500)

    // ToolTip Js
    $('[data-toggle="tooltip"]').tooltip();

});
$("#shareRegistrationEventForm").validate({
    rules: {
        email: {
            required: true,
            minlength: 2,
            maxlength: 200
        }
    },
});

$('#shareRegistrationEventFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#shareRegistrationEventForm').valid()) {
        $('#shareRegistrationEventForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function shareRegistrationEventForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('user.event.share')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.share-success').css('display', 'block');
                location.reload();
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#shareRegistrationEventForm', function(e) {
    e.preventDefault();
    shareRegistrationEventForm($(this));
});

function setForecast(forecast) {
    var today = forecast.daily.data[0];  
    console.log(today);
    console.log(toCelcius(forecast.currently.temperature) + '°C');
    $("#sidebar-main-icon1").attr('src', `/dev/frontend/DarkSky-icons/SVG/${today.icon}.svg`);
    if($("#select_weather_unit").val()==1){
      $("#sidebar-mainTemperature").text(toCelcius(forecast.currently.temperature) + '°C').fadeIn();
    }else{
     $("#sidebar-mainTemperature").text(toFerenheit(forecast.currently.temperature) + '°F').fadeIn();
    }
    $("#sidebar-localDate").text(getFormattedDate(today.time));
}

$("#weather-report").on("change", (e) => {
    weather();
});

$("#select_weather_unit").on("change",()=>{
  $("#sidebar-mainTemperature").fadeOut();
  weather();
});

function weather(){
     let url = $('#weather_api #venue_weather_route').val();
    let href = new URL(url);
    href.searchParams.set('time', $("#weather-report").val());
    $('#weather_api #venue_weather_route').val(href.href);
    getWeatherData();
}

function getWeatherData() {

    const venue_weather_route = $('#weather_api #venue_weather_route').val();

    $.ajax({
        type: "GET",
        url: venue_weather_route,
        cache: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },

        success: function(forecast) {
            if (forecast.code === 400 || forecast.code === 403) return;
            setForecast(forecast);
        },
        error: function(error) {
            $('#weather-loader').css('display', 'none');
            console.log("Error with ajax: " + error);
        }
    });
}


function getFormattedDate(date) {
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date * 1000).toLocaleDateString("en-US", options);
}
// Converts to Celcius
function toCelcius(val) {
    return Math.round((val - 32) * (5 / 9));
}
// Converts to Farenheit
function toFerenheit(val) {
    var degrees = (val * 1.8) + 32;
    var rounded = Math.round(degrees);
    return rounded;
}

getWeatherData();
</script>
@endsection