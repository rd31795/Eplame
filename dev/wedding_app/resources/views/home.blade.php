@extends('layouts.home')
@section('title') {{ getAllValueWithMeta('meta_title', 'homepage') }} @endsection
@section('description') {{ getAllValueWithMeta('meta_description', 'homepage') }} @endsection
@section('keywords') {{ getAllValueWithMeta('meta_keyword', 'homepage') }} @endsection
@section('content')
<!-- side toggle calender sec starts here -->
<!-- side toggle calender sec starts here -->
<!-- banner section starts here here -->
<!-- user status sidebar -->
@if(Auth::check() && Auth::user()->role == 'user')
@include('includes.user_stats')
@endif
<!-- user status sidebar Ends here -->
<!-- Weather report sidebar -->
<aside class="user-status-content" id="weather-sidebar">
    <div class="sidebar-header">
        <h3>Book a Date</h3>
        <a href="javascript:void(0);" class="close-sidebar" id="calendarSidebar-close"><i class="fas fa-times-circle"></i></a>
    </div>
    <!-- weather section -->
    <input type="hidden" value="{{ route('get_venue_weather') }}" id="weather_route" />
    <div id="result"></div>
    <div class="weather-mini-card mt-2" id="sidebar-weather" style="display: none">
        <input type="hidden" value="{{ route('get_venue_weather', ['latitude' => '40.7128', 'longitude' => '-74.0060']) }}" id="venue_weather_route" />
        <!-- <a data-toggle="modal" data-target="#weatherModal" id="open_weather_modal" style="opacity: 0;" href="javascript:void(0);">
  
            <div class="weather-mini-card">
                <div class="weather-info">
                    <div class="weather-info-wrapper">
                        <div class="info-date">
                        <h1 id="localTime"></h1>
                        <h5><span id="localDate"></span></h5>
                        </div>
                        <div class="info-weather">
                        <div class="weather-wrapper">
                            <span class="weather-temperature" id="mainTemperature"></span>
                            <div class="weather-sunny"><img id="main-icon" src="{{ asset('/frontend/DarkSky-icons/SVG/clear-day.svg') }}">
                            </div>
                        </div>        
                        <h5><span class="weather-city" id="cityName"></span> <spam id="cityCode"></spam></h5>
                        </div>
                    </div>
                </div>
            </div>

        </a> -->
    </div>
    <!-- weather section end -->
    <!-- calendar section -->
    <!-- <div class="calendar-section">
   <div class="row">
      <div class="col-sm-12">
         <div class="calendar calendar-first" id="calendar_first">
            <div class="calendar_header">
               <button class="switch-month switch-left">
                  <i class="fas fa-chevron-left"></i>
               </button>
               <h2></h2>
               <button class="switch-month switch-right">
                  <i class="fas fa-chevron-right"></i>
               </button>
            </div>
            <div class="calendar_weekdays"></div>
            <div class="calendar_content"></div>
         </div>
      </div>
   </div> 
</div> -->
</aside>
<!-- ============================== -->
<section class="main-banner home-main-banner" style="background:url({{$slider_video_url ? url('/uploads').'/'.$slider_video_url : '/frontend/images/banner-bg.png'}});">
    <div class="container">
        <video src="{{$slider_video_url ? url('/uploads').'/'.$slider_video_url : '/frontend/videos/background-vdo.mp4'}}" autoplay muted loop></video>
        <div class="banner-content">
            <h1 id="transtext">{{$slider_title}}</h1>
            <p>{{$slider_tagline}}</p>
            <a href="{{$slider_button_url}}" class="cstm-btn solid-btn">{{$slider_button_title}}</a>
        </div>
    </div>
</section>
<!-- banner section starts Ends here -->
<!--Tabs Section starts here-->
@include('home.includes.homepage_search')
<!--Tabs Section ends here-->
<!-- Marquee tag starts here -->
<div class="take-tour n-ppost">
    <a href="javascript:void(0);" class="take-a-tour" onclick="javascript:introJs().start();">
        <i class="fas fa-paper-plane"></i>
    </a>
    <div class="n-ppost-name">Take A Tour</div>
</div>
<!--Popular event starts here-->
<section class="home-event-types" style="background:url('{{url('/')}}/frontend/images/event-back.png');" data-step="5" data-intro="You will find the popular events here.">
    <div class="container">
        <div class="sec-heading text-center">
            <h4>{{ $section1_title }}</h4>
            <h2>{{ $section1_tagline }}</h2>
        </div>

         <div class="cs-search d-flex align-items-center flex-wrap justify-content-right">
           <!--  <div class="cs-left-content">
                <h5>Popular in</h5>
            </div> -->
            <form id="fetch_events">
            <div class="form-group">
               <input type="text"  class="form-control" placeholder="Location" id="address_event" name="location" autocomplete="off" >

               <input  type="hidden"  name="latitude" id="event_latitude" value="">
               <input  type="hidden"  name="longitude" id="event_longitude" value="">
          
               <span class="input-icon" id="search_events"><i class="fas fa-search"></i></span>
               <span id="loading"></span>
            </div>
            <input type="submit" style="display: none;">
           </form>
         </div>
         <br>
         <!--Row One-->
        <div class="event-slider owl-carousel owl-theme owl-loaded owl-drag" id="event-slider-3" display="none">
            
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
                            </div>
                        </figcaption>
                    </div>
                </a>
                <!-- card end -->
            </div>
            @endforeach
        </div>

        <h2 class="text-center first_event_records{{ $hybridInperson->count() > 0 || $virtualEvent->count() > 0 ? ' d-none' : ''}}">No record found.</h2>
        
        <!--Row Two-->
        <div class="event-slider owl-carousel owl-theme owl-loaded owl-drag" id="event-slider-2">
            @foreach($hybridInperson as $hyb_In)
            <div class="item">
                <!-- card -->
                <a href="{{ url('eventDetail/' . $hyb_In->slug) }}" target="_blank"">
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
                        </figcaption>
                    </div>
                </a>
                <!-- card end -->
            </div>
            @endforeach
        </div>
        <div class="d-flex align-items-center flex-wrap justify-content-center view_all_event_div">
            <a href="{{ url(route('events_all')) }}" id="location_view_all" data-href="{{url(route('events_all'))}}" class="cstm-btn solid-btn view_all_events{{ $hybridInperson->count() > 1 ? '' : ' d-none'}}">View All</a>
        </div>
        
    </div>
</section>
<!--Popular event ends here-->
<section class="pop-news">
    <div class="container">
        <div class="sec-heading text-center">
            <h2>Deals & Discount</h2>
        </div>
        <div class="owl-carousel owl-theme pop-news-carousel" data-step="4" data-intro="You can grab the exiciting deals from here.">
            @if(!empty($offers[0]->id))
                @foreach($offers as $offer)
                <div class="item">
                    <div class="box">
                        <div class="deal">
                            <h3>{{ $offer->title }}</h3>
                            <ul class="photography">
                                <li>
                                    <h4>{{ $offer->category->label}}</h4>
                                </li>
                                <li>
                                    <p>{{ $offer->Business->title}}</p>
                                </li>
                            </ul>
                            <a href="javascript:void(0);" class="coupon-code" data-toggle="tooltip">
                                <span class="code-text">{{ $offer->deal_code }}</span>
                                <span class="get-code">Get Code</span>
                            </a>
                        </div>
                        <div class="cstm-wrap">
                            <a href="{{url( route('vendor_detail_page',[$offer->Business->category->slug,$offer->Business->business_url]))}}#deals-sec" class="cstm-btn solid-btn">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{url(route('get_deal_detail',[$offer->slug]))}}" class="cstm-btn solid-btn">
                                <i class="fas fa-tags"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<section class="cust-marquee" data-step="6" data-intro="Here you will find the latest news.">
    <div class="container">
        <ul>
            <marquee direction="left" scrollamount="8">
                @if(!empty($news[0]->id))
                    @foreach($news as $new)
                        <li>{{ $new->detail }}</li>
                    @endforeach
                @else
                    <li>There are no news available for now.</li>
                @endif
            </marquee>
        </ul>
    </div>
</section>
<!-- Marquee tag ends here -->
<!-- Plan togather section starts here -->
<section class="plan-togather-sec">
    <div class="budget-plan-banner" style="background: url({{ $section2_image ? url('/uploads').'/'.$section2_image : '/frontend/images/budget-plan-bg.png' }});">
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-duration="3000">
            <div class="sec-heading text-center">
                <h4>{{ $section2_title }}</h4>
                <h2>{{ $section2_tagline }}</h2>
            </div>
            <div class="budget-btn-wrap text-center">
                <a href="javascript:void(0);" class="budget-btn">
                    <span class="bdgt-icon"><img src="{{url('/')}}/frontend/images/budget-plan-icon.png"></span>
                    <h3>{{$section2_image_tagline}}</h3>
                    <span class="down-indi-arrow">
                        <img src="{{url('/')}}/frontend/images/down-lg-arrow.png">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="budget-packages-container">
        <div class="container">
            <div class="sec-card" data-step="7" data-intro="You can create your budget by seleting the vendors in the given categories.">
                <div class="optn-select">
                    <div class="form-group">
                        <select class="form-control" id="cat-carousel">
                            @if(!empty($categories[0]->id))
                            <option value="">Select an option...</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->label }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="tab-wrap aos-init aos-animate" data-aos="fade-down" data-aos-duration="3000">
                    <div class="packages-slider owl-carousel owl-theme">
                        <?php $i=1; 
                  $j=1; ?>
                        @if(!empty($categories[0]->id))
                        @foreach($categories as $category)
                        <div class="item" data-c_id="t-{{$category->id}}" data-index="{{$i}}" title="{{$category->label}}">
                            <div class="tab-button">
                                <div class="package-item wow bounceInDown" data-wow-delay="500ms">
                                    <a href="javascript:void();" data-tag="t-{{$category->id}}" @if($i==1) class="activelink" @endif>
                                        <span class="service-icon">
                                            <img class="category--img" src="{{url($category->image)}}">
                                        </span>
                                        <h3>{{ $category->label }}</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="tab-content">
                    <!-- tab 1 content -->
                    @if(!empty($categories[0]->id))
                    @foreach($categories as $category)
                    <?php $vendors = getVendors($category->id); ?>
                    <div class="tab-data @if($j == 1) active @else hide @endif" id="t-{{$category->id}}">
                        @if(!empty($vendors[0]->id))
                        <div class="owl-carousel owl-theme packages-row aos-init aos-animate" data-aos="fade-left" data-aos-duration="3000">
                            @foreach($vendors as $vendor)
                            <?php $img_src = getVendorCover($category->id, $vendor->id); ?>
                            <div class="item">
                                <div class="main-package-card">
                                    <input type="radio" name="carousel_radio{{$category->id}}" id="carousel_radio{{$vendor->id}}">
                                    <label class="target-label" for="carousel_radio{{$vendor->id}}" data-cat_id="{{ $category->id }}" data-price="{{$vendor->price}}" data-src="{{url($category->image)}}" data-label="{{$category->label}}" data-vendor="{{$vendor->id}}">
                                        <figure>
                                            <img src="{{url('/')}}/{{$img_src}}">
                                        </figure>
                                        <figcaption class="text-center">
                                            <h3 class="pkg-heading">{{$vendor->title}}</h3>
                                            <h4 class="pkg-price">${{$vendor->price}}</h4>
                                        </figcaption>
                                        <span class="distance">
                                            <h4>25</h4>
                                            <p> Miles</p>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="no_business"> Business not found.</p>
                        @endif
                    </div>
                    <?php $j++; ?>
                    @endforeach
                    @endif
                    <!-- tab 2 content -->
                    <!-- tab 4 content -->
                    <div class="">
                        <div class="price-card">
                            <div class=" price-card aos-init aos-animate" data-aos="fade-rigth" data-aos-duration="3000">
                                <div class="cal-content">
                                    <div class="row owl-carousel owl-theme price-card-carousel">
                                    </div>
                                </div>
                                <div class="total-price-col">
                                    <div class="price-content">
                                        <div class="total-price">
                                            <label>Total:<span class="t-amount" id="t-total-amt">$0</span>
                                            </label>
                                        </div>
                                        <a href="javascript:void(0)" class="cstm-btn solid-btn book-now-btn">Book Now</a>
                                    </div>
                                    <span class="calc-icon">=</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab 5 content -->
                    <div class="tab-data hide" id="t-five">
                    </div>
                    <!-- tab 6 content -->
                    <div class="tab-data hide" id="six">
                        <form class="services-form">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" id="" class="form-control" placeholder="Location">
                                        <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" id="" class="form-control" placeholder="Event Type">
                                        <span class="input-icon"><i class="fas fa-glass-cheers"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" id="" class="form-control" placeholder="Suggested Vendor">
                                        <span class="input-icon"><i class="fas fa-user"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" id="" class="form-control" placeholder="Amenties">
                                        <span class="input-icon"><i class="fas fa-concierge-bell"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" id="" class="form-control" placeholder="Guest#">
                                        <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrap text-center">
                                <a href="{{url(route('home_vendor_listing_page'))}}" class="cstm-btn solid-btn">Search <span><i class="fas fa-search"></i></span></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Plan togather section ends here -->

<!-- How its work section starts here -->
<section class="how-its-work-sec" data-step="8" data-intro="You can get the knowledge about how to utilize this platform.">
    <div class="container aos-init aos-animate" data-aos="fade-right" data-aos-duration="3000">
        <div class="sec-heading text-center">
            <h4>{{$section3_title}}</h4>
            <h2>{{$section3_tagline}}</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="video-container">
                    <figure>
                        <video class="video" id="bVideo" loop="" width="100%" height="100%" poster="{{ $section3_video_poster ? url('/uploads').'/'.$section3_video_poster : '/frontend/images/video-poster.png'}}">
                            <source src="{{ $section3_video ? url('/uploads').'/'.$section3_video : '/frontend/videos/Dummy Video.mp4' }}" type="video/mp4">
                        </video>
                        <div id="playButton" class="playButton" onclick="playPause()">
                            <span><i class="fas fa-play-circle"></i></span>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- How its work section ends here -->
<!--Get to knw section starts here-->
<section class="home-get" style="background: url( {{ $section4_image ? url('/uploads').'/'.$section4_image : '/frontend/images/budget-plan-bg.png' }});" data-step="9" data-intro="Signup here to know more about us.">
    <div class="container">
        <div class="sec-heading text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="3000">
            <h4>{{$section4_title1}}</h4>
            <h2>{{$section4_tagline1}}</h2>
        </div>
        <div class="aos-init aos-animate" data-aos="fade-up" data-aos-duration="2000">
            <p>{{$section4_description}}</p>
            <p class="get-text">
                <span>{{$section4_title2}}</span>{{$section4_tagline2}}
            </p>
            <a href="{{$section4_button_url}}" class="cstm-btn solid-btn">
                {{$section4_button_title}}
            </a>
        </div>
    </div>
</section>
<!--Get to knw section ends here-->
<!--Testimonial Page starts here-->
<section class="testimonial" data-step="10" data-intro="This section shows what our clients think of us.">
    <div class="container aos-init aos-animate" data-aos="fade-left" data-aos-duration="3000">
        <div class="sec-heading text-center">
            <h2>{{$section5_title}}</h2>
        </div>
        <div class="test owl-carousel owl-theme owl-loaded owl-drag">
            @if(!empty($testimonials[0]->id))
            @foreach($testimonials as $testimonial)
            <div class="item">
                <div class="wrap">
                    <figure>
                        <img class="commas" src="{{url('/')}}/frontend/images/commas.png" alt="" />
                        <img src="{{ url('/').'/wedding_app/public/uploads/'.$testimonial->image }}" alt="" />
                    </figure>
                    <p>{{ $testimonial->summary }}</p>
                    <p class="name">{{ $testimonial->title }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
<div id="weatherModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="inner-loader" id="weather-loader" style="display: none;">
                <div class="loader5"></div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Weather Report</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="weather-form">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="weatherDatePicker" placeholder="select date">
                                <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <input type="button" onclick="searchWeather()" class="cstm-btn" value="Search">
                        </div>
                    </div>
                </form>
            </div>
            <!--  Weather chart sec -->
            <div class="weather-chart-container">
                <div class="" id="weather-content">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card card-weather">
                                <div class="weather-card-body" style="background-image: url(https://eplame.com/dev/frontend/images/weather.png)">
                                    <div class="weather-date-location">
                                        <p class="text-gray"> <span class="weather-date" id="modal-localDate"></span>
                                            <span class="weather-location" id="modal-cityName"></span> <span class="weather-location" id="modal-cityCode"></span> </p>
                                    </div>
                                    <div class="weather-data d-flex">
                                        <div class="mr-auto">
                                            <div class="weather-status d-f a-i-c">
                                                <span class="weather-status-icon"><img id="modal-main-icon" src="https://eplame.com/dev/frontend/DarkSky-icons/SVG/clear-day.svg"></span>
                                                <h4 class="display-3" id="modal-mainTemperature"></h4>
                                            </div>
                                            <p id="tempDescription"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="weather-card-body p-0">
                                    <div class="d-flex weakly-weather" id="w-hourly"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{url('/js/comingsoon.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrGKmz60iMoKfZLLQSK5LOzqHCf_TynQM&libraries=places"></script>
<script type="text/javascript" src="{{url('js/validations/home_searching.js')}}"></script>
<script type="text/javascript" src="{{url('js/validations/setLatLongEvent.js')}}"></script>
<script src="{{url('/js/weather-custom.js')}}"></script>
<script src="{{url('/js/validations/searchValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script>
$(document).ready(function() {

    setTimeout(() => {
        // jQuery().find('.custom-loading').hide();
        $('#event-slider-1').css('display', 'block');
    }, 1500)

    // ToolTip Js
    $('[data-toggle="tooltip"]').tooltip();

});

// check user for weather
@if(Auth::check() && Auth::User() -> role == 'user')
currentLatLongWeather();
@endif
</script>
<script>
$(function() {
    $("#datepicker1, #datepicker2, #datepicker3, #datepicker4").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
    });
});

$(document).ready(function() {
    var text = ["欢迎", "BIENVENIDAS", "स्वागत हे", "أهلا بك", "BEM-VINDA", "ようこそ", "BIENVENUE", "ДОБРО ПОЖАЛОВАТЬ", "WELKOM", "Welcome"];
    var index = 0;

    $("#transtext").fadeTo(1, 0);

    setInterval(function() {
        $("#transtext").stop().html(text[index]).fadeTo(500, 1, function() {
            index++;
            $("#transtext").delay(400).fadeTo(500, 0);
            if (index == 10) {
                index = 0;
            };
        });
    }, 1800);

    // var width = $(window).width();
    // if(width > 1351){
    //    $('#weather-sidebar').addClass('show-sidebar');
    //    $('#UserUpcmStatus').addClass('show-sidebar');
    // }
});

function myFunction() {
    /* Get the text field */
    var copyText = $('.coupon-code').text();

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
}
</script>
<script>
$('.pop-news-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    slideBy: 3,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});



function getWeatherData() {

    const venue_weather_route = $('#result #venue_weather_route').val();
    console.log("venue_weather_route", venue_weather_route);
    $.ajax({
        type: "GET",
        url: venue_weather_route,
        cache: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },

        success: function(forecast) {

            if (forecast.code === 400 || forecast.code === 403) return;

            $('#weather-loader').css('display', 'none');
            $('#open_weather_modal').css('opacity', '1');
            console.log("forecast", forecast);
            setForecast(forecast);
            startClock(forecast.currently.time);
        },
        error: function(error) {
            $('#weather-loader').css('display', 'none');
            console.log("Error with ajax: " + error);
        }
    });
}
const d = new Date();
//$('#weatherDatePicker').val(`${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`);
getWeatherData();

function startClock(time) {

    $("#localTime").text(new Date(time).toLocaleTimeString());

}

function setForecast(forecast) {

    var today = forecast.daily.data[0];
    let countryUs = '';
    $('#weatherDatePicker').val(getFormattedDate(today.time));
    if (forecast.timezone === 'America/New_York') countryUs = 'toFerenheit';

    if (forecast.daily.data.length > 1) {
        $("#tempDescription").text(today.summary);
        $("#humidity").text(today.humidity);
        $("#wind").text(today.windSpeed);
        $("#localDate").text(getFormattedDate(today.time));
        $("#main-icon").attr('src', `/frontend/DarkSky-icons/SVG/${forecast.currently.icon}.svg`);
        // $("#mainTemperature").text(countryUs ? toFerenheit(forecast.currently.temperature) + '°F' : toCelcius(forecast.currently.temperature) + '°C');
        console.log(forecast.currently.temperature);
        $("#mainTemperature").text(toCelcius(forecast.currently.temperature) + '°C');

    }

    // // // modal
    $("#modal-main-icon").attr('src', `/dev/frontend/DarkSky-icons/SVG/${today.icon}.svg`);
    $("#modal-localDate").text(getFormattedDate(today.time));
    // $("#modal-mainTemperature").text(countryUs ? toFerenheit(forecast.currently.temperature) + '°F' : toCelcius(forecast.currently.temperature) + '°C');
    if($("#select_weather_unit").val()==1){
    $("#modal-mainTemperature").text(toCelcius(f   ) + '°C');
    }else{
    $("#modal-mainTemperature").text(toFerenheit(forecast.currently.temperature) + '°F');
    }

    let we = '';
    let data = forecast.daily.data.length > 1 ? forecast.daily.data : forecast.hourly.data;
    for (var i = 1; i < data.length; i++) {
        const f = data[i];

        let temp = '';
        // if (countryUs) {
        	if($("#select_weather_unit").val()==1){
        	   temp = f.temperature ? `${toCelcius(f.temperature)}°C` : `${toCelcius(f.temperatureLow)}°C - ${toCelcius(f.temperatureHigh)}°C`
            }else{
               temp = f.temperature ? `${toFerenheit(f.temperature)}°F` : `${toFerenheit(f.temperatureLow)}°F - ${toFerenheit(f.temperatureHigh)}°F`;
            }
        // } else {
        // ;
        // 

        let time = f.temperature ? `${new Date(f.time).getHours()} : ${new Date(f.time).getMinutes()}` : `${getFormattedDate(f.time)}`;
        we += `<div class="weakly-weather-item">
              <p class="mb-0"> ${time} </p> <img id="modal-main-icon" src="/dev/frontend/DarkSky-icons/SVG/${f.icon}.svg">
              <p class="mb-0"> ${temp} </p>
          </div>`;
    }

    $('#w-hourly').empty();
    $('#w-hourly').append(we);
}


function searchWeather() {
    $('#weather-loader').css('display', 'block');
    let date = $('#weatherDatePicker').val();
    let url = $('#result  #venue_weather_route').val();
    let href=new URL(url);
    href.searchParams.set('time',date);
    $('#result #venue_weather_route').val(`${href.href}`);
    getWeatherData();
}

$("#weatherModal").on("shown.bs.modal", function() {
    const venue_weather_route = $('#venue_weather_route').val();
    $('#venue_weather_route').val(venue_weather_route.split('&time')[0]);
    //$('#open_weather_modal').css('opacity', '0');
    getWeatherData();
});




// // Applies the following format to date: WeekDay, Month Day, Year
/*function getFormattedDate(date) {
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date * 1000).toLocaleDateString("en-US", options);
}

// // // Formats the text to CamelCase
function toCamelCase(str) {
  var arr = str.split(" ").map(
    function(sentence){
      return sentence.charAt(0).toUpperCase() + sentence.substring(1);
    }
  );
  return arr.join(" ");
}

// // Converts to Celcius
function toCelcius(val) {
  return Math.round((val - 32) * (5/9));
}

// Converts to Farenheit
function toFerenheit(val) {
  var degrees = (val * 1.8) + 32;
  var rounded = Math.round(degrees);
  return rounded;
}*/


$('.packages-row').owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    dots: false,
    autoplay: false,
    slideBy: 4,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        },
        1200: {
            items: 4
        }
    }
});

$('.price-card-carousel').owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    dots: false,
    autoplay: false,
    slideBy: 3,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});



$('.target-label').click(function() {


    var price = $(this).data('price');
    var src = $(this).data('src');
    var label = $(this).data('label');
    var id = $(this).data('cat_id');
    var vendor_id = $(this).data('vendor');
    if ($('body').find('#itemid-' + id).length) {

    } else {
        $('.price-card-carousel').owlCarousel('add', '<div class="item selected-vendors" id="itemid-' + id + '" data-vendor="' + vendor_id + '"><div class="selected-ser-card selected text-center"><span class="service-icon"><img class="category--img" src="' + src + '"></span><div class="prc-heading">   <h3 class="cat-lab">' + label + '</h3><h4 class="price ">$<span class="pri-' + id + ' sp-price-tar"></span></h4></div><span class="calc-icon">+</span></div></div>').owlCarousel('update');
    }
    var total = 0;
    var url = "<?php echo route('home_vendor_listing_page'); ?>";
    $('.book-now-btn').click(function() {
        var i = 1;
        $('.selected-vendors').each(function() {
            var v_id = $(this).data('vendor');
            if (i == 1) {
                url = url + '?' + 'vendor[]=' + v_id;
            } else {
                url = url + '&' + 'vendor[]=' + v_id;
            }
            i++;
        });
        window.location.href = url;
    })

    $('body').find('.pri-' + id).text(price);
    $('.sp-price-tar').each(function() {
        var val = $(this).text();
        total = parseFloat(total + parseFloat(val));
    });
    var amt = '$' + total;
    $('#t-total-amt').text(amt);
    var count = $('.price-card-carousel .owl-stage .owl-item').length;

    $('.price-card-carousel .owl-stage .owl-item .calc-icon').each(function(index) {
        if (index === count - 1) {
            // this is the last one
            $(this).addClass('lastItemplus');
        } else {
            $(this).removeClass('lastItemplus');
        }
    });
});

$('#cat-carousel').on('change', function() {
    var id = $(this).val();
    if (id > 0) {
        var item_index = $("div[data-c_id=t-" + id + "]").data('index');
        var index = parseInt(item_index - 2);
        $('.packages-slider').trigger('to.owl.carousel', [index, 6, true]);
        $("a[data-tag=t-" + id + "]").trigger('click');
    }
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
          ajaxData(pos.lat,pos.lng,null,true);
        });


//   $('#address_event').focusout(function() {
//      // setTimeout(function() { 
//           var event_address = $("#address_event").val();
//           var latitude = $("#event_latitude").val();
//           var longitude = $("#event_longitude").val();
//           ajaxData(latitude,longitude,event_address);
//           // }, 800);
// });

$("#search_events").on("click",()=>{
	     var event_address = $("#address_event").val();
          var latitude = $("#event_latitude").val();
          var longitude = $("#event_longitude").val();
          ajaxData(latitude,longitude,event_address);
}) ;


$("#fetch_events").on("submit",(e)=>{
       e.preventDefault();
      var event_address = $("#address_event").val();
      var latitude = $("#event_latitude").val();
      var longitude = $("#event_longitude").val();
      ajaxData(latitude,longitude,event_address);
});

});

  function ajaxData(latitude,longitude,event_address,current_ip=null){
      $.ajax({
            method: 'post',
            url : "<?= url(route('home.eventsearch')) ?>",
            data:  { latitude: latitude,longitude: longitude,event_address:event_address,current_ip:current_ip },
            headers: {
             'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            success: function(response) {
             console.log("response of search", response);
             $('.first_event_records').removeClass('d-none');
             $('.view_all_events').removeClass('d-none');
             if(response == "false"){
                $('#event-slider-1').show();
                $('#event-slider-2').show();
                $("#event-slider-3").show();
             }else{
                $('#event-slider-1').hide();
                $('#event-slider-2').hide();
                if(response.trim() == ''){
                    $('.view_all_events').addClass('d-none');
                    $('.first_event_records').removeClass('d-none');
                }else{
                    var view_all=$("#location_view_all").attr('data-href');
                    view_all=view_all+"?event_address="+event_address;
                    $("#location_view_all").attr('href',view_all);
                    $('.view_all_events').removeClass('d-none');
                    $('.first_event_records').addClass('d-none');
                }

                $("#event-slider-3").html(response);
              } 
            },
            beforeSend:function(){
            	$("#loading").text('Loading...')
            },
            complete:function(){
                $("#loading").text('')	
            }

          });
  }       
  </script>
@endsection