@extends('users.layouts.layout')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Create In-person Event</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('user_events')}}">Events</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Create Event</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card ex1">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card-media animated cls-preview step1">
                                <h4>Preview</h4>
                                <div class="cls-title yellow-title" id="logoPreview" style="background: url(https://eplame.com/dev/images/event-bg.jpg);">
                                    <div class="cls-title-header">
                                        <div class="main-header__welcome">
                                            <div class="main-header__welcome-title text-light">Welcome, Kanny<strong></strong></div>
                                            <div class="main-header__welcome-subtitle text-light">How are you today?</div>
                                        </div>
                                        <div class="quickview">
                                            <div class="quickview__item">
                                                <div class="quickview__item-total">23</div>
                                                <div class="quickview__item-description">
                                                    <i class="far fa-calendar-alt"></i>
                                                    <span class="text-light">Events</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cls-preview_content">
                                        <h2 id="event-title">Name of your event</h2>
                                        <!-- ********** -->
                                        <!-- ********** end-->
                                    </div>
                                </div>
                                <div class="event-dscptn">
                                    <p id="event-long_description1"></p>
                                </div>
                            </div>
                            <div class="card-media animated cls-preview step2">
                                <h4 class="text-center">Preview</h4>
                                <div class="cls-title yellow-title" id="logoPreview2" style="background: url(https://eplame.com/dev/images/event-bg.jpg);">
                                    <div class="cls-title-header">
                                        <div class="main-header__welcome">
                                            <div class="main-header__welcome-title text-light">Welcome, Kanny<strong></strong></div>
                                            <div class="main-header__welcome-subtitle text-light">How are you today?</div>
                                        </div>
                                        <div class="quickview">
                                            <div class="quickview__item">
                                                <div class="quickview__item-total">23</div>
                                                <div class="quickview__item-description">
                                                    <i class="far fa-calendar-alt"></i>
                                                    <span class="text-light">Events</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cls-preview_content">
                                        <h2 id="event-title2">Name of your event</h2>
                                        <!-- ********** -->
                                        <!-- ********** end-->
                                        <div class="card-event-timing">
                                            <h5 id="event-start_date"></h5>
                                            <h5 class="end_date" id="event-end_date"></h5>
                                        </div>
                                        <div class="card-event-timing">
                                            <h5 id="event-start_time"></h5>
                                            <h5 id="event-end_time"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="cls-title cls-titles">
                                    <div class="media-right">
                                        <div class="card-media-body-top-icons">
                                            <h2>Countdown to the Event</h2>
                                            <div class="sm-countdown-wrap wt-countdown">
                                                <ul class="count-down-timer">
                                                    <div id="timer">
                                                        <div id="days"></div>
                                                        <div id="hours"></div>
                                                        <div id="minutes"></div>
                                                        <div id="seconds"></div>
                                                    </div>
                                                </ul>
                                                <ul class="count-down-timer-new">
                                                    <li><span>Days</span></li>
                                                    <li><span>Hours</span></li>
                                                    <li><span>Minutes</span></li>
                                                    <li><span>Seconds</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              @include('users.events.weather.weather')
                            </div>
                            <div class="animated step3" id="refreshDivID">
                                <h5 class="text-center">Vender Services</h5>
                                <div class="event-detail-full-dec">
                                    <div class="evnt-full-detail">
                                        <ul class="evt-more-dec">
                                            <li>
                                                <p class="evt-more-deatil">
                                                    <span class="icon">
                                                        <i class="fas fa-tags"></i>
                                                    </span>
                                                    <p id="event_type"></p>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="animated step4">
                                <div class="event-detail-full-dec">
                                    <h3 class="evt-title" id="evt-title"></h3>
                                    <!-- <span class="evt-date">Friday, Sep 17, 2:30 PM</span> -->
                                    <div class="evnt-full-detail">
                                        <p id="event-long_description"></p>
                                        <ul class="evt-more-dec">
                                            <li>
                                                <p>
                                                    <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                                    <p id="event_location"></p>
                                                </p>
                                            </li>
                                            <!-- <li><p class="evt-more-deatil"> <span class="icon"><i class="fas fa-folder-open"></i></span>Wedding</p></li> -->
                                            <li>
                                                <p class="evt-more-deatil"> <span class="icon"><i class="fas fa-tags"></i></span>
                                                    <p id="event_type2"></p>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="evt-more-deatil">
                                                    <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                                                    <p id="budget"></p>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="animated step5">
                                <div class="event-detail-full-dec">
                                    <div class="evnt-full-detail">
                                        <img id="frame" />
                                        <div id="image_select"></div>
                                        <div class="text-wrap text-center">
                                            <h3 id="event_style_title"></h3>
                                            <div class="event-dscptn">
                                                <p id="event_style_description"></p>
                                            </div>
                                        </div>
                                        <div class="cstm-theme-color-wrap field_wrapper2"><span class="theme-color-box theme-color-wrap " style="background:#000" id="event_color_name"></span>
                                        </div>
                                         <div id="template_image"></div>
                                        <!-- <div id="choosen-color"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

 
 <div class="col-md-12" id="ticket_preview">
            
        </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card talk-card-event">
                <!-- /.card-header -->
                @include('admin.error_message')
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="first-user-form">
                                <section class="multi_step_form haveFiveSteps">
                                    <div id="msform">
                                        <ul id="progressbar">
                                            <li class="step-item stp-1 active"></li>
                                            <li class="step-item stp-2 "></li>
                                            <li class="step-item stp-3 "></li>
                                            <li class="step-item stp-4 "></li>
                                            <li class="step-item stp-5 "></li>
                                        </ul>
                                    </div>
                                </section>
                                <input type="hidden" name="progressbar" value="1">
                                <div class="card-heading">
                                    <h3>Lets talk about your event.</h3>
                                </div>
                                <div class="step1 stepForm">
                                    @include('users.includes.welcome_popup.stepOne')
                                </div>
                                <div class="step2 stepForm">
                                    @include('users.includes.welcome_popup.stepSecond')
                                </div>
                                <div class="step3 stepForm">
                                    @include('users.includes.welcome_popup.step3')
                                </div>
                                <div class="step4 stepForm">
                                    @include('users.includes.welcome_popup.step4')
                                </div>
                                <div class="step5 stepForm">
                                    @include('users.includes.welcome_popup.step5')
                                </div>
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
<style>
</style>
<script src="{{url('clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{url('/js/comingsoon.js')}}"></script>
<script src="{{url('/js/setLatLong.js')}}"></script>
<script src="{{url('/js/welcome_popup.js')}}"></script>
<script src="{{ asset('/js/userEventColor.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#start_date").on("change",(e)=>{  
  updateDetails()
});
function updateDetails(){
   let latitude=$("#latitude").val();
   let longitude=$("#longitude").val();
   let url=$("#weather_api #venue_weather_route").val();
   let date_start=$("#start_date").val();
   let href=new URL(url);
   href.searchParams.set("latitude",latitude);
   href.searchParams.set("longitude",longitude);
   start_date=new Date();
   if(date_start){
   start_date=new Date(date_start);
   }
   start_date.setDate(start_date.getDate());
   var dateString = moment(start_date).format('YYYY-MM-DD');
   href.searchParams.set("time", dateString);
   $("#weather_api #venue_weather_route").val(href.href);
   getWeatherData();
}
function setForecast(forecast) {

    var today = forecast.daily.data[0];
    let countryUs = '';
    $('#weatherDatePicker').val(getFormattedDate(today.time));
    if (forecast.timezone === 'America/New_York') countryUs = 'toFerenheit';
    // // // modal
    $("#modal-main-icon").attr('src', `/dev/frontend/DarkSky-icons/SVG/${today.icon}.svg`);
    $("#modal-localDate").text(getFormattedDate(today.time));
    // $("#modal-mainTemperature").text(countryUs ? toFerenheit(forecast.currently.temperature) + '°F' : toCelcius(forecast.currently.temperature) + '°C');
    $("#modal-mainTemperature").text(toCelcius(forecast.currently.temperature) + '°C');

    let we = ''
    let data = forecast.daily.data.length > 1 ? forecast.daily.data : forecast.hourly.data;
    for (var i = 1; i < data.length; i++) {
        const f = data[i];

        let temp = '';
        if (countryUs) {
            temp = f.temperature ? `${toFerenheit(f.temperature)}°F` : `${toFerenheit(f.temperatureLow)}°F - ${toFerenheit(f.temperatureHigh)}°F`;
        } else {
            temp = f.temperature ? `${toCelcius(f.temperature)}°C` : `${toCelcius(f.temperatureLow)}°C - ${toCelcius(f.temperatureHigh)}°C`;
        }
        let time = f.temperature ? `${new Date(f.time).getHours()} : ${new Date(f.time).getMinutes()}` : `${getFormattedDate(f.time)}`;
        we += `<div class="weakly-weather-item">
              <p class="mb-0"> ${time} </p> <img id="modal-main-icon" src="/dev/frontend/DarkSky-icons/SVG/${f.icon}.svg">
              <p class="mb-0"> ${temp} </p>
          </div>`;
    }

    $('#w-hourly').empty();
    $('#w-hourly').append(we);
    $('#weather-forcast').show();
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

getWeatherData();
function getFormattedDate(date) {
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date * 1000).toLocaleDateString("en-US", options);
}
// Converts to Celcius
function toCelcius(val) {
  return Math.round((val - 32) * (5/9));
}
// Converts to Farenheit
function toFerenheit(val) {
  var degrees = (val * 1.8) + 32;
  var rounded = Math.round(degrees);
  return rounded;
}
</script>

<script>



$(document).ready(function() {
    var styval = $('#style_type').val();
    if (styval == 0) {
        $('#style-field-1').css('display', 'block');
        $('#style-field-3').css('display', 'block');
    } else {
        $('#style-field-1').css('display', 'none');
        $('#style-field-3').css('display', 'none');
    }
});


$('#style_type').change(function() {
    var val = $(this).val();
    if (val == 0) {
        $('#style-field-1').css('display', 'block');
        $('#style-field-3').css('display', 'block');
    } else {
        $('#style-field-1').css('display', 'none');
        $('#style-field-3').css('display', 'none');
    }
});

$(function() {
    $('#title').keyup(function() {
        var text = $('#title').val()
        if (text != '') {
            $('#event-title').text($(this).val());
            $('#event-title2').text($(this).val());
            $('#evt-title').text($(this).val());
        } else {
            $('#event-title').text('Name of your event');
        }
    });
});

$(function() {
    $('#long_description').keyup(function() {
        $('#event-long_description').text($(this).val());
        $('#event-long_description1').text($(this).val());
    });
});
$(function() {
    $('#event_budget').keyup(function() {
        $('#budget').text($(this).val());
    });
});
$(function() {
    $('#style_title').keyup(function() {
        $('#event_style_title').text($(this).val());
    });
});
$(function() {
    $('#style_description').keyup(function() {
        $('#event_style_description').text($(this).val());
    });
});
$(function() {
    $('#start_date').on('change', function() {
        $('#event-start_date').text($(this).val());
    });
});
$(function() {
    $('#end_date').on('change', function() {
        $('#event-end_date').text($(this).val());
    });
});
$(function() {
    $('#start_time').on('click', function() {
        $('#event-start_time').text($(this).val());
    });
});
$(function() {
    $('#end_time').on('click', function() {
        $('#event-end_time').text($(this).val());
    });
});

$(function() {
    $('#location').on('change keyup click', function(event) {
        $("#test").click(function() {
            $('#event_location').text($('#location').val());
        });
    });
});
$(function() {
    $('#credit').on('click', function() {
        $('#event-credit').text(this.checked ? this.value : '');
    });
});

function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
}
// $('input[name="colourNames[]"]').keyup(function() {
//   var id=$(this).attr('id')
//  $('#'+id+'').text($(this).val());
// });

$(document).on('change', '#style_type', function() {
    var id = $("#style_type option:selected").val();
    $.ajax({
        type: "GET",
        url: "<?= url(route('user.event.getimage')) ?>",
        data: { val: id },
        contentType: "application/json; charset=utf-8",
        dataType: "Json",
        success: function(result) {
            $('#image_select').html('<img src="/dev/wedding_app/public/uploads/' + result.status + '" />');
        }

    });
});

// $(document).on('change', '#template_id', function() {
//     var id = $("#template_id option:selected").val();
//     $.ajax({
//         type: "GET",
//         url: "<?= url(route('user.event.gettemplate')) ?>",
//         data: { val: id },
//         contentType: "application/json; charset=utf-8",
//         dataType: "Json",
//         success: function(result) {
//             $('#template_image').html('<img src="{{url("/")}}/' + result.status + '" />');
//         }

//     });
// });
$(document).on('change','#selling',function(){
        if($(this).is(":checked")){
        $('#template_id').closest('.form-group').show();
        $("#selling").val(true);
      }
      else{
        $('#template_id').closest('.form-group').hide();
          $("#selling").val(false);
      }
    });
$(document).on('click','.categoryCheckboxes',function(){
  var data = $(this).data("label");
   var id = $(this).data("id");
    var pervious = $('#event_type').html();
    if(pervious.includes(data))
    {
      $("#"+id).remove();
    }else{
     $('#event_type').append("<span id="+id+">"+data+",</span>");
     $('#event_type2').append("#<span>" + data + "</span>,");
    }
   

  //console.log(string.indexOf(substring)!== -1)

});
$("#back").click(function() {
    $( "#refreshDivID" ).load(window.location.href + " #refreshDivID" );
  });

// $(document).on('click', '.categoryCheckboxes', function() {
//     var data = $(this).data("label");
//     $('#event_type').append("#<span>" + data + "</span>,<br>");
    

// });

function makeTimer() {

    //    var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
    var date = $(".end_date").text();

    var endTime = new Date(date);

    endTime = (Date.parse(endTime) / 1000);

    var now = new Date();
    now = (Date.parse(now) / 1000);

    var timeLeft = endTime - now;

    var days = Math.floor(timeLeft / 86400);

    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

    if (hours < "10") {
        hours = "0" + hours;
    }
    if (minutes < "10") {
        minutes = "0" + minutes;
    }
    if (seconds < "10") {
        seconds = "0" + seconds;
    }
    if (date == "") {
        $("#days").html(0);
        $("#hours").html(0);
        $("#minutes").html(0);
        $("#seconds").html(0);
    } else {
        $("#days").html(days);
        $("#hours").html(hours);
        $("#minutes").html(minutes);
        $("#seconds").html(seconds);
    }
}

setInterval(function() { makeTimer(); }, 1000);
</script>
<script>
function readURL(input, previewId, previewId2) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(previewId).css('background-image', 'url(' + e.target.result + ')');
            $(previewId).hide();
            $(previewId).fadeIn(650);
            $(previewId2).css('background-image', 'url(' + e.target.result + ')');
            $(previewId2).hide();
            $(previewId2).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#banner_image").change(function() {
    readURL(this, '#logoPreview', '#logoPreview2');
});

</script>
@endsection