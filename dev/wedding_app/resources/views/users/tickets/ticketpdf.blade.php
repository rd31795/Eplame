@extends('users.layouts.layout')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h4 class="m-b-10">Event Ticket</h4>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('user_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('user_events')}}">Events</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Event Ticket</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-block">
                    <div class="event-card-head j-c-s-b">
                        <div class="event-card-head-new">
                            <h3>Tickets</h3>
                        </div>
                    </div>
                    <!-- ticket sec -->
                    <div class="row">
                        @if($template_id == 1)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="btn-wrap">
                                   <h3 id="template_title">Custom Template</h3> 
                                </div>
                                <!-- btn -->
                                <!-- btn end -->
                                <br>
                                <div class="ticket-card-1 d-flex align-items-center" id="logoPreview1">
                                    <div class="cs-left">
                                       
                                        <p>Address </p>
                                        <h2>Title</h2>
                                        <ul class="d-flex align-items-center justify-content-between">
                                            <li>
                                                <div class="cs-ticket-1">
                                                    <p>Jan <strong>
                                                            23
                                                        </strong>2018 </p>
                                                    <p class="cs-bottom">
                                                        starts at 9 PM
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cs-ticket-1">
                                                    <strong>
                                                        ADMIT <br>
                                                        ONE
                                                    </strong>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cs-ticket-1">
                                                    <p>ticket</p>
                                                    <p><strong>10 $ </strong> </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <p>Add here more info about event ( ex. if event is only 21 +)</p>
                                    </div>
                                    <div class="cs-right">
                                        <p>$ 10.0</p>
                                        <h5>Title</h5>
                                        <p>january 23th 1021</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($template_id == 2)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="btn-wrap">
                                  <h3 id="template_title">Template 1</h3>   
                                </div>
                                <br>
                                <div class="ticket-card-2 d-flex">
                                    <div class="cs-left" id="logoPreview1" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS87NtVxiDIrh_kqyHIWkLT8qboJvEHpFuHjQ&usqp=CAU');">
                                        <h6>Lorem ipsum</h6>
                                        <h2>SPORT EVENT</h2>
                                        <p class="p-cntnt">lorem ipsum dolor sit amet</p>
                                        <div class="cs-rows-wrapper">
                                            <ul class="d-flex flex-wrap align-items-center">
                                                <li>
                                                    <div class="cs-card">
                                                        <h6 class="cs-yellow">ROW</h6> <p><strong>01</strong> </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cs-card">
                                                        <h6 class="cs-yellow">ROW</h6> <p><strong>02</strong> </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cs-card">
                                                        <h6 class="cs-yellow">ROW</h6> <p><strong>03</strong> </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cs-card">
                                                        <h5>VIP</h5>
                                                    </div>
                                                </li>
                                            </ul>
                                            <p>lorem:<strong> 35 </strong></p>
                                        </div>
                                    </div>
                                    <div class="cs-right">
                                        <div class="text-center">
                                            <h6>Lorem ipsum</h6>
                                            <h2>SPORT EVENT</h2>
                                            <p class="p-cntnt">lorem ipsum dolor sit amet</p>
                                        </div>
                                        <div class="cs-rows-wrapper">
                                            <ul class="d-flex flex-wrap align-items-center">
                                                <li>
                                                    <div class="cs-card">
                                                       <h6 class="cs-yellow">ROW</h6>  <p><strong>01</strong> </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cs-card">
                                                        <h6 class="cs-yellow">ROW</h6> <p><strong>02</strong> </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cs-card">
                                                        <h6 class="cs-yellow">ROW</h6> <p><strong>03</strong> </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cs-card">
                                                        <h5>VIP</h5>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        @endif
                        @if($template_id == 3)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="btn-wrap">
                                    <h3 id="template_title">Template 2</h3> 
                                </div>
                                <br>
                                <div class="ticket-card-3 d-flex">
                                    <div class="cs-left-img">
                                        <figure id="logoPreview1" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzsnU0qrc7XKSXB_otTnrsuuyHW97M1IIQ7w&usqp=CAU');">
                                        </figure>
                                    </div>
                                    <div class="cs-left">
                                        <ul class="d-flex justify-content-between">
                                            <li>
                                                <div class="cs-li-card">
                                                    <h6>C</h6>
                                                    <p>Sec</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cs-li-card">
                                                    <h6>21</h6>
                                                    <p>Row</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cs-li-card">
                                                    <h6>9</h6>
                                                    <p>Seat</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="cs-mid text-right">
                                            <p>SPECIAL NIGHT</p>
                                            <h5>EVENT NAME</h5>
                                        </div>
                                        <br>
                                        <p>DJ MORRIL POTTER NEW YORK,</p>
                                        <p>DJ NISSIAN, RUSSEL UNITED STATES</p>
                                    </div>
                                    <div class="cs-right">
                                        <div class="bg-layer"></div>
                                        <h5 class="cs-top">
                                            EVENT TICKET - 2018
                                        </h5>
                                        <ul>
                                            <li>
                                                <p>VIP: $ ENTRY PASS</p>
                                            </li>
                                            <li>
                                                <p>DATE: 23-1-2018</p>
                                            </li>
                                            <li>
                                                <p>TIME: 7:00PM</p>
                                            </li>
                                            <li>
                                                <p>THIS PARTY IS FOR COUPLE</p>
                                            </li>
                                        </ul>
                                        <div class="bg-layer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($template_id == 4)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="btn-wrap">
                                    <h3 id="template_title">Template 3</h3> 
                                </div>
                                <br>
                                <div class="ticket-card-4 d-flex">
                                    <div class="cs-left" id="logoPreview1" style="background-image: url(https://d1csarkz8obe9u.cloudfront.net/posterpreviews/dark-pink-background-template-design-04eeaaaf9ea63502ddd92ad5e20f8f3e_screen.jpg?ts=1561436711);">
                                        <p class="cs-top">SPECIAL NIGHT-2016</p>
                                        <h6>EVENT NAME</h6>
                                        <ul class="d-flex">
                                            <li>
                                                <div class="fourth-ticket">
                                                    <h6>1 st</h6>
                                                    <p>Dj JACCULIN</p>
                                                    <br>
                                                    <h6>2nd</h6>
                                                    <p>DJ MARIA</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="fourth-ticket">
                                                    <h6>30$</h6>
                                                    <p>EVENT PRICE</p>
                                                    <br>
                                                    <p>DOOR OPEN</p>
                                                    <h6><strong>09 : PM</strong></h6>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="cs-sponsor-button d-flex align-items-center justify-content-between">
                                            <p>sponsor</p>
                                            <p>sponsor</p>
                                            <p>sponsor</p>
                                        </div>
                                    </div>
                                    <div class="cs-right">
                                        <div class="cs-right-inner">
                                            <h6>EVENT NAME</h6>
                                            <h5>VIP GAT PASS</h5>
                                            <h5>000055446</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- ticket sec end-->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-block">
                    <div class="event-card-head j-c-s-b">
                        <div class="event-card-head-new">
                            <h3>Tickets</h3>
                        </div>
                    </div>
                    <br>
                    <!-- ticket sec -->
                    <div id="Ticket1" class="desc">
                        <form method="post" enctype="multipart/form-data" action="">
                           @csrf
                            <div class="form-group">
                                <label class="control-label">Template Name* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Event Picture!"></i></label>
                                    <input type="text" class="form-control  custom-file-input2" name="template_name" id="template_name" >
                                </div>
                                 <div class="form-group">
                                    <label class="control-label">Background Image* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Event Picture!"></i></label>
                                    <input type="file" class="form-control" accept="image/*" custom-file-input2" name="background_picture" id="background_picture" > 
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Font Colour* <i class="fas fa-info-circle" data-toggle="tooltip" title="Font Colour!"></i></label>
                                     <input type="hidden" id="countColours" value="1"> 
                                      <div class="row field_wrapper">
                                       <div class="element col-lg-3 col-md-6">
                                            <div class="pick-color-field-wrap">               
                                              <div class="form-group">
                                                <input type="color" class="ColorGet" style="width: 46px; margin-left: -2px;" name="colours" value="#000" id="template_font_color">
                                                <input type="text" onchange="GetColourName(this)" id="event_color_name" value="black" class="form-control ColourSelect" name="colourNames[]" placeholder="Colour Name">
                                              </div>
                                            </div>            
                                      </div>
                                    </div>
                             </div>
                            <div class="btn-wrap text-right">
                                <button class="cstm-btn solid-btn">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- ticket sec end-->
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
<!-- First User Modal -->
@endsection
@section('scripts')
<style>
    #UserEventForm .form-group .my-img-grp {
    height: 130px;
    margin: 0 auto;
    display: block;
}
#UserEventForm h4 {
    text-align: center;
    font-size: 18px;
    font-weight: 600;
}
.event-types-wrapper {
  height: 420px;
  display: flex;
  align-items: center;
}
</style>
<script src="{{url('clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{url('/js/comingsoon.js')}}"></script>
<script src="{{url('/js/setLatLong.js')}}"></script>
<script src="{{url('/js/welcome_popup.js')}}"></script>
<script src="{{ asset('/js/userEventColor.js') }}"></script>
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
$("#background_picture").change(function() {
    readURL(this, '#logoPreview1');
});
// $("#background_image2").change(function() {
//     readURL(this, '#logoPreview2');
// });

// $("#background_image3").change(function() {
//     readURL(this, '#logoPreview3');
// });
// $("#background_image4").change(function() {
//     readURL(this, '#logoPreview4');
// });
$(function() {
    $('#template_name').keyup(function() {
        var text = $('#template_name').val()
        if (text != '') {
            $('#template_title').text($(this).val());
        } else {
            $('#template_title').text('Template Name');
        }
    });
});
var colorWell;
window.addEventListener("load", startup, false);
function startup() {
  colorWell = document.querySelector("#template_font_color");
  colorWell.addEventListener("input", updateFirst, false);
  colorWell.addEventListener("change", updateAll, false);
  colorWell.select();
}
function updateFirst(event) {
  var p = document.querySelector("p");
  var h5 = document.querySelector("h5");
  var h6 = document.querySelector("h6");
  var h2 = document.querySelector("h2");
  var strong = document.querySelector("strong");
   var span1 = document.querySelector("cs-yellow");
  // var span = document.querySelector("span");
    p.style.color = event.target.value;
    h5.style.color = event.target.value;
    h6.style.color = event.target.value;
    h2.style.color = event.target.value;
    strong.style.color = event.target.value;
     span1.style.color = event.target.value;
  }
function updateAll(event) {
  document.querySelectorAll("p").forEach(function(p) {
    p.style.color = event.target.value;
  });
  document.querySelectorAll("h5").forEach(function(h5) {
    h5.style.color = event.target.value;
  });
  document.querySelectorAll("h6").forEach(function(h6) {
    h6.style.color = event.target.value;
  });
  document.querySelectorAll("h2").forEach(function(h2) {
    h2.style.color = event.target.value;
  });
  document.querySelectorAll("strong").forEach(function(strong) {
    strong.style.color = event.target.value;
  });
  document.querySelectorAll("cs-yellow").forEach(function(span1) {
    span1.style.color = event.target.value;
  });
}
</script>
@endsection