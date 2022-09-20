@extends('users.layouts.layout')
@section('content')
<style type="text/css">
    .field_wrapper .pick-color-field-wrap .form-control.ColourSelect {
        height: 45px;
    }
    ul.input-group-btn.color-btn.acrdn-action-btns.cs-plus {
        position: absolute;
    }
</style>
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Create Virtual Event</h5>
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
                                        <img id="frame" />
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
                                        <p id="event-long_description">Description</p>
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
                                <p id="event-long_description"></p>
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
                            </div>
                           <div class="animated step2" id="refreshDivID">
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
                            <div class="animated step3">
                                <img id="frame" />
                                        <div id="image_select"></div>
                                        <div class="text-wrap text-center">
                                            <h3 id="event_style_title"></h3>
                                            <div class="event-dscptn">
                                                <p id="event_style_description"></p>
                                            </div>
                                        </div>
                                        <div class="cstm-theme-color-wrap field_wrapper2 "><span class="theme-color-box theme-color-wrap" style="background:#000" id="event_color_name5"></span>
                                        </div>
                                <!-- buttons end -->
                            </div>
                        </div>
                    </div>
                </div>
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
                                <section class="multi_step_form haveFiveSteps haveThreeSteps">
                                    <div id="msform">
                                        <ul id="progressbar">
                                            <li class="step-item stp-1 active"></li>
                                            <li class="step-item stp-2 "></li>
                                             <li class="step-item stp-3 "></li>
                                            <!-- <li class="step-item stp-4 "></li>
                                        <li class="step-item stp-5 "></li> -->
                                        </ul>
                                    </div>
                                </section>
                                <input type="hidden" name="progressbar" value="1">
                                <div class="card-heading">
                                    <h3>Lets talk about your event.</h3>
                                </div>
                                <div class="step1 stepForm">
                                    @include('users.includes.virtual.stepOne')
                                </div>
                                <div class="step2 stepForm">
                                    @include('users.includes.virtual.stepSecond')
                                </div>
                                <div class="step3 stepForm">
                                    @include('users.includes.virtual.step3')
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
<script src="{{url('/js/virtualform.js')}}"></script>
<script src="{{ asset('/js/userEventColor.js') }}"></script>
<script>
$('#create-event-btn').click(function() {
    $('#firstUserModal').modal('show');
});
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
        } else {
            $('#event-title').text('Name of your event');
        }
    });
});

$(function() {
    $('#description').keyup(function() {
        $('#event-long_description').text($(this).val());
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
    $('#reg_type').keyup(function() {

        $('#event-reg_type').text($(this).val());

    });
});
$(function() {
    $('#credit').on('click', function() {
        $('#event-credit').text(this.checked ? this.value : '');
    });
});
$(function() {
    $('#check').on('click', function() {
        $('#event-check').text(this.checked ? this.value : '');
    });
});
$(function() {
    $('#offline').on('click', function() {
        $('#event-offline').text(this.checked ? this.value : '');
    });
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
    }

});
 $("#back").click(function() {
    $( "#refreshDivID" ).load(window.location.href + " #refreshDivID" );
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
function readURL(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(previewId).css('background-image', 'url(' + e.target.result + ')');
            $(previewId).hide();
            $(previewId).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#banner_image").change(function() {
    readURL(this, '#logoPreview');
});
</script>
@endsection