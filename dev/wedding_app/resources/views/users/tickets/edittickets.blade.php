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
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center" id="logoPreview1">
                                        <div class="cs-left">
                                            <div class="ticket-logo">
                                                <img src="{{url('images/ticket/logo-new.svg')}}">
                                            </div>
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
                                            <p id="ticket-text">lorem ipsum dolor sit amet</p>
                                        </div>
                                        <div class="cs-right">
                                            <p>$ 10.0</p>
                                            <h5>Title</h5>
                                            <p>january 23th 1021</p>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="template-cover-text">Back Cover</h3>
                                <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center">
                                        <div class="cs-left-back" id="logoPreviewBack">
                                            <p id="ticket-backcover-text">lorem ipsum dolor sit amet</p>
                                        </div>
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
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-2 d-flex">
                                        <div class="cs-left" id="logoPreview1"   style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS87NtVxiDIrh_kqyHIWkLT8qboJvEHpFuHjQ&usqp=CAU');">
                                    <div class="ticket-logo">
                                       <img src="{{url('images/ticket/logo-new.svg')}}">
                                    </div>
                                    <div class="ticket-2-content theme-color-header">
                                    <div id="header_content" >   
                                    <h2>SPORT EVENT</h2>
                                    </div>
                                    <div id="location">
                                    <p>DJ MORRIL POTTER NEW YORK,</p>
                                    <p>DJ NISSIAN, RUSSEL UNITED STATES</p>
                                    </div>
                                    <p class="p-cntnt" id="ticket-text">lorem ipsum dolor sit amet</p>
                                    </div>
                                 </div>
                                        <div class="cs-right " id="ticket-right-side">
                                    <div class="text-center">
                                       <h2>EVENT TITLE</h2>
                                       <hr class="border_color_theme">
                                            <ul class="mt-2">
                                                <li>
                                                    <p>DATE: 23-1-2018</p>
                                                </li>
                                                <li>
                                                    <p>TIME: 7:00PM</p>
                                                </li>
                                            </ul>
                                       <p class="p-cntnt cs-p-cntnt "><span>
                                          VIP GATE PASS
                                       </span>     
                                    #3R34R43ASFD</p>
                                    </div>
                                    <div class="cs-rows-wrapper">
                                      
                                    </div>
                                 </div>
                                    </div>
                                </div>
                                <h3 class="template-cover-text">Back Cover</h3>
                                <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center">
                                        <div class="cs-left-back" id="logoPreviewBack">
                                            <p id="ticket-backcover-text">lorem ipsum dolor sit amet</p>
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
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-3 d-flex">
                                        <!-- <div class="cs-left-img">
                                            <figure id="logoPreview1" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzsnU0qrc7XKSXB_otTnrsuuyHW97M1IIQ7w&usqp=CAU');">
                                            </figure>
                                        </div> -->
                                        <div class="cs-left" id="logoPreview1" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzsnU0qrc7XKSXB_otTnrsuuyHW97M1IIQ7w&usqp=CAU');">
                                            <div class="ticket-logo">
                                                <img src="{{url('images/ticket/logo-new.svg')}}">
                                            </div>
                                            <div class="cs-mid text-center theme-color-header" id="header_content">
                                                <p>SPECIAL NIGHT</p>
                                                <h5>EVENT NAME</h5>
                                            </div>
                                            <br>
                                            <p>DJ MORRIL POTTER NEW YORK,</p>
                                            <p>DJ NISSIAN, RUSSEL UNITED STATES</p>
                                        </div>
                                        <div class="cs-right" id="ticket-right-side">
                                            <div class="bg-layer theme-color"></div>
                                            <h5 class="cs-top " style="color: white;">
                                                EVENT TITLE
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
                                                    <p id="ticket-text">lorem ipsum dolor sit amet</p>
                                                </li>
                                            </ul>
                                            <div class="bg-layer theme-color"></div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="template-cover-text">Back Cover</h3>
                                <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center">
                                        <div class="cs-left-back" id="logoPreviewBack">
                                            <p id="ticket-backcover-text">lorem ipsum dolor sit amet</p>
                                        </div>
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
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-4 d-flex">
                                        <div class="cs-left" id="logoPreview1" style="background-image: url(https://d1csarkz8obe9u.cloudfront.net/posterpreviews/dark-pink-background-template-design-04eeaaaf9ea63502ddd92ad5e20f8f3e_screen.jpg?ts=1561436711);">
                                            <div class="ticket-logo">
                                                <img src="{{url('images/ticket/logo-new.svg')}}">
                                            </div>

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
                                            <!--  <div class="cs-sponsor-button d-flex align-items-center justify-content-between">
                                                <p id="ticket-text" >lorem ipsum dolor sit amet</p>
                                                <p>sponsor</p>
                                                <p>sponsor</p>
                                                <p>sponsor</p>
                                            </div> -->
                                            <div class="cs-sponsor-button ">
                                                <p id="ticket-text">lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>
                                        <div class="cs-right" >
                                            <div class="cs-right-inner">
                                                <h6>EVENT NAME</h6>
                                                <h5>VIP GAT PASS</h5>
                                                <h5>000055446</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="template-cover-text">Back Cover</h3>
                                <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center">
                                        <div class="cs-left-back" id="logoPreviewBack">
                                            <p id="ticket-backcover-text">lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($template_id == 5)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <div class="btn-wrap">
                                    <h3 id="template_title">Template 4</h3>
                                </div>
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-5 d-flex">
                                        <div class="cs-left" id="logoPreview1" style="background-image: url({{url('images/ticket/3.png')}})">
                                            <div class="cs-card-left-img">
                                                <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8cGFydHklMjBkanxlbnwwfHwwfHw%3D&w=1000&q=80" id="front_event_picture">
                                            </div>
                                            <div>
                                                <div class="ticket-logo">
                                                    <img src="{{url('images/ticket/logo-new.svg')}}">
                                                </div>
                                                <div id="header_content">
                                                <p class="cs-top">SPECIAL NIGHT-2016</p>
                                                <h6>EVENT NAME</h6>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <div class="fourth-ticket">
                                                            <h6>Date</h6>
                                                            <p>2202/07/12 - 2022/07/30</p>
                                                            <br>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h6>Time</h6>
                                                        <div class="fourth-ticket d-flex justify-content-between">
                                                            <div>
                                                                
                                                                <p>DOOR OPEN</p>
                                                                <h6><strong>09:00 PM</strong></h6>
                                                            </div>
                                                            <div>
                                                                
                                                                <p>DOOR CLOSE</p>
                                                                <h6><strong>09:10 PM</strong></h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cs-right" id="ticket-right-side">
                                            <div class="cs-right-inner">
                                                <h6>EVENT NAME</h6>
                                                <h5>VIP GAT PASS</h5>
                                                <h5>000055446</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="template-cover-text">Back Cover</h3>
                                <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center">
                                        <div class="cs-left-back" id="logoPreviewBack">
                                            <p id="ticket-backcover-text">lorem ipsum dolor sit amet</p>
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
                            <div class="front-section-fields">
                                <h4><a data-toggle="collapse" data-parent="#Ticket1" href="#front_area" class="edit-ticket-h4"><span class="text-section">Front Section</span> <i class="fas fa-angle-down"></i></a></h4>
                                <div id="front_area" class="panel-collapse collapse show">
                                	@if($template_id == 5)
                                	<div class="form-group">
                                        <label class="control-label">Image* <i class="fas fa-info-circle" data-toggle="tooltip" title="event_picture" data-original-title="Event Picture!"></i></label>
                                        <input type="file" class="form-control custom-file-input2" accept="image/*" name="picture" id="event_picture">
                                    </div>
                                	@else
                                	<div class="form-group ">
                                        <label class="control-label">Theme Colour* <i class="fas fa-info-circle" data-toggle="tooltip" title="Font Colour!"></i></label>
                                        <input type="hidden" id="countColours" value="1">
                                        <div class="row field_wrapper">
                                            <div class="element col-lg-3 col-md-6">
                                                <div class="pick-color-field-wrap">
                                                    <div class="form-group">
                                                        <input type="color" onchange="themecolor(this)" class="ColorGet" style="width: 46px; margin-left: -2px;" name="theme_color"  data-id="event_theme_color" id="side_ticket_color">
                                                         <input type="text" onchange="themecolor(this)" id="ticket_theme_color" data-id="event_theme_color" value="\" class="form-control ColourSelect" name="colourNames[]" placeholder="Colour Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                	@endif

                                	 

                                    <div class="form-group ">
                                        <label class="control-label">Side Ticket Colour* <i class="fas fa-info-circle" data-toggle="tooltip" title="Font Colour!"></i></label>
                                        <input type="hidden" id="countColours" value="1">
                                        <div class="row field_wrapper">
                                            <div class="element col-lg-3 col-md-6">
                                                <div class="pick-color-field-wrap">
                                                    <div class="form-group">
                                                        <input type="color" onchange="sideTicketColor(this)" class="ColorGet" style="width: 46px; margin-left: -2px;" name="ticket_right_side"  data-id="side_ticket_color" id="ticket_side_color">
                                                         <input type="text" onchange="themecolor(this)" id="ticket_side_color" data-id="event_side_color" value="\" class="form-control ColourSelect" name="colourNames[]" placeholder="Colour Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Template Name* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Event Picture!"></i></label>
                                        <input type="text" class="form-control  custom-file-input2" name="template_name" id="template_name">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control ckeditor" cols="80" id="header-content" name="header_content" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Background Image* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Event Picture!"></i></label>
                                        <input type="file" class="form-control custom-file-input2" accept="image/*" name="background_picture" id="background_picture">
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label">Font Colour* <i class="fas fa-info-circle" data-toggle="tooltip" title="Font Colour!"></i></label>
                                        <input type="hidden" id="countColours" value="1">
                                        <div class="row field_wrapper">
                                            <div class="element col-lg-3 col-md-6">
                                                <div class="pick-color-field-wrap">
                                                    <div class="form-group">
                                                        <input type="color" onchange="GetColourName(this)" class="ColorGet" style="width: 46px; margin-left: -2px;" name="colours" value="#000" data-id="event_color_name" id="template_font_color">
                                                        <input type="text" onchange="GetColourName(this)" id="event_color_name" data-id="template_font_color" value="black" class="form-control ColourSelect" name="colourNames[]" placeholder="Colour Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label">Logo Colour* <i class="fas fa-info-circle" data-toggle="tooltip" title="Logo Colour!"></i></label>
                                        <input type="hidden" id="countColoursLogo" value="1">
                                        <div class="row field_wrapper">
                                            <div class="element col-lg-3 col-md-6">
                                                <div class="pick-color-field-wrap">
                                                    <div class="form-group">
                                                        <input type="color" onchange="GetColourName(this)" class="ColorGet" style="width: 46px; margin-left: -2px;" name="logocolours" value="#000" id="template_logo_color" data-id="logo_color_name">
                                                        <input type="text" onchange="GetColourName(this)" data-id="template_logo_color" id="logo_color_name" value="black" class="form-control ColourSelect" name="logoColourNames[]" placeholder="Logo Colour Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($template_id != 5)
                                    <div class="form-group">
                                        <label class="control-label">Footer Text <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Enter your own footer text"></i></label>
                                        <input type="text" class="form-control  custom-file-input2" value="lorem ipsum dolor sit amet" name="template_text" id="template_text">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="back-section-fields">
                                <h4><a data-toggle="collapse" data-parent="#Ticket1" href="#back_area" class="edit-ticket-h4"><span class="text-section">Back Section</span> <i class="fas fa-angle-down"></i></a></h4>
                                <div id="back_area" class="panel-collapse collapse show">
                                    <div class="form-group">
                                        <label class="control-label">Back Cover Text <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Enter your own text"></i></label>
                                        <textarea class="form-control  custom-file-input2 ckeditor" name="template_backcover_text" id="template_backcover_text"></textarea>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label">Back Cover Font Colour <i class="fas fa-info-circle" data-toggle="tooltip" title="Font Colour!"></i></label>
                                        <input type="hidden" id="backcountColours" value="1">
                                        <div class="row field_wrapper">
                                            <div class="element col-lg-3 col-md-6">
                                                <div class="pick-color-field-wrap">
                                                    <div class="form-group">
                                                        <input type="color" onchange="GetColourName(this)" class="ColorGet" style="width: 46px; margin-left: -2px;" name="back_colours" value="#000" data-id="event_back_color_name" id="template_back_font_color">
                                                        <input type="text" onchange="GetColourName(this)" id="event_back_color_name" data-id="template_back_font_color" value="black" class="form-control ColourSelect" name="colourNames[]" placeholder="Back Colour Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Back Cover Background Image* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Event Back Cover Picture!"></i></label>
                                        <input type="file" class="form-control custom-file-input2" accept="image/*" name="back_cover_background_picture" id="back_cover_background_picture">
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
<script src="https://cdn.ckeditor.com/4.17.2/full/ckeditor.js"></script>
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
function fontreadURL(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
        	console.log(e.target.result);
            $(previewId).attr('src', `${e.target.result}`);
            $(previewId).hide();
            $(previewId).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#background_picture").change(function() {
    readURL(this, '#logoPreview1');
});

$("#event_picture").change(function() {
    fontreadURL(this, '#front_event_picture');
});

$("#back_cover_background_picture").change(function() {
    readURL(this, '#logoPreviewBack');
});


// $("#template_logo_color").change(function() {
//     console.log("template_logo_color", $(this).val());
//     $(".ticket-logo img").css('background', $(this).val());
// });

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
var colorWellBack;
var colorWellLogo;
window.addEventListener("load", startup, false);

function startup() {
    colorWell = document.querySelector("#template_font_color");
    colorWellLogo = document.querySelector("#template_logo_color");

    // colorWell.addEventListener('input', function(e) {
    //     e.preventDefault();
    //     FrontUpdateFirst(e);
    // }, { passive: false });

    // colorWell.addEventListener('change', function(e) {
    //     e.preventDefault();
    //     FrontUpdateAll(e);
    // }, { passive: false });

    colorWell.addEventListener('input', function(e) {
        e.preventDefault();
        FrontUpdateAll(e);
    }, { passive: false });

    // colorWell.addEventListener("input", FrontUpdateFirst, false);
    // colorWell.addEventListener("change", FrontUpdateAll, false);
    colorWell.select();


    colorWellLogo.addEventListener('input', function(e) {
        e.preventDefault();
        FrontLogo(e);
    }, { passive: false });


    colorWellLogo.select();

    colorWellBack = document.querySelector("#template_back_font_color");

    // colorWellBack.addEventListener('input', function(e) {
    //     e.preventDefault();
    //     BackUpdateFirst(e);
    // }, { passive: false });

    // colorWellBack.addEventListener('change', function(e) {
    //     e.preventDefault();
    //     FrontUpdateAll(e);
    // }, { passive: false });

    colorWellBack.addEventListener('input', function(e) {
        e.preventDefault();
        BackUpdateAll(e);
    }, { passive: false });

    // colorWellBack.addEventListener("input", BackUpdateFirst, false);
    // colorWellBack.addEventListener("change", BackUpdateAll, false);
    colorWellBack.select();

}

// function FrontUpdateFirst(event) {
//     var p = document.querySelector(".front-cover-content p");
//     var strong = document.querySelector(".front-cover-content strong");
//     var span1 = document.querySelector(".front-cover-content cs-yellow");

//     var h2 = document.querySelector(".front-cover-content h2");
//     var h3 = document.querySelector(".front-cover-content h3");
//     var h4 = document.querySelector(".front-cover-content h4");
//     var h5 = document.querySelector(".front-cover-content h5");
//     var h6 = document.querySelector(".front-cover-content h6");


//     // var span = document.querySelector("span");
//     if(p != null){
//         p.style.color = event.target.value;
//     }
//     if(h2 != null){
//         h2.style.color = event.target.value;
//     }
//     if(h3 != null){
//         h3.style.color = event.target.value;
//     }
//     if(h4 != null){
//         h4.style.color = event.target.value;
//     }
//     if(h5 != null){
//         h5.style.color = event.target.value;
//     }
//     if(h6 != null){
//         h6.style.color = event.target.value;
//     }
//     if(strong != null){
//         strong.style.color = event.target.value;
//     }
//     if(span1 != null){
//         span1.style.color = event.target.value;
//     }
// }
function FrontLogo(event) {
    var logo = document.querySelector(".ticket-logo img");
    if (logo != null) {
        logo.style.background = event.target.value;
    }
}

function FrontUpdateAll(event) {

    document.querySelectorAll(".front-cover-content p").forEach(function(p) {
        p.style.color = event.target.value;
    });
    document.querySelectorAll(".front-cover-content h2").forEach(function(h2) {
        h2.style.color = event.target.value;
    });
    document.querySelectorAll(".front-cover-content h3").forEach(function(h3) {
        h3.style.color = event.target.value;
    });
    document.querySelectorAll(".front-cover-content h4").forEach(function(h4) {
        h4.style.color = event.target.value;
    });
    document.querySelectorAll(".front-cover-content h5").forEach(function(h5) {
        h5.style.color = event.target.value;
    });
    document.querySelectorAll(".front-cover-content h6").forEach(function(h6) {
        h6.style.color = event.target.value;
    });

    document.querySelectorAll(".front-cover-content strong").forEach(function(strong) {
        strong.style.color = event.target.value;
    });
    document.querySelectorAll(".front-cover-content cs-yellow").forEach(function(span1) {
        span1.style.color = event.target.value;
    });
}

// function BackUpdateFirst(event) {


//     var p = document.querySelector(".back-cover-content p");
//     var strong = document.querySelector(".back-cover-content strong");
//     var span1 = document.querySelector(".back-cover-content cs-yellow");

//     var h2 = document.querySelector(".back-cover-content h2");
//     var h3 = document.querySelector(".back-cover-content h3");
//     var h4 = document.querySelector(".back-cover-content h4");
//     var h5 = document.querySelector(".back-cover-content h5");
//     var h6 = document.querySelector(".back-cover-content h6");


//     // var span = document.querySelector("span");
//     if(p != null){
//         p.style.color = event.target.value;
//     }
//     if(h2 != null){
//         h2.style.color = event.target.value;
//     }
//     if(h3 != null){
//         h3.style.color = event.target.value;
//     }
//     if(h4 != null){
//         h4.style.color = event.target.value;
//     }
//     if(h5 != null){
//         h5.style.color = event.target.value;
//     }
//     if(h6 != null){
//         h6.style.color = event.target.value;
//     }
//     if(strong != null){
//         strong.style.color = event.target.value;
//     }
//     if(span1 != null){
//         span1.style.color = event.target.value;
//     }
// }

function BackUpdateAll(event) {
    document.querySelectorAll(".back-cover-content p").forEach(function(p) {
        p.style.color = event.target.value;
    });
    document.querySelectorAll(".back-cover-content h2").forEach(function(h2) {
        h2.style.color = event.target.value;
    });
    document.querySelectorAll(".back-cover-content h3").forEach(function(h4) {
        h3.style.color = event.target.value;
    });
    document.querySelectorAll(".back-cover-content h4").forEach(function(h4) {
        h4.style.color = event.target.value;
    });
    document.querySelectorAll(".back-cover-content h5").forEach(function(h5) {
        h5.style.color = event.target.value;
    });
    document.querySelectorAll(".back-cover-content h6").forEach(function(h6) {
        h6.style.color = event.target.value;
    });

    document.querySelectorAll(".back-cover-content strong").forEach(function(strong) {
        strong.style.color = event.target.value;
    });
    document.querySelectorAll(".back-cover-content cs-yellow").forEach(function(span1) {
        span1.style.color = event.target.value;
    });
}

$(function() {
    $('#template_text').keyup(function() {
        var text = $('#template_text').val()
        if (text != '') {
            $('#ticket-text').text($(this).val());
        } else {
            $('#ticket-text').text('');
        }
    });
    const template_backcover_text = CKEDITOR.instances['template_backcover_text'];
    template_backcover_text.on('change', function(evt) {
        let html = evt.editor.getData();
        $('#ticket-backcover-text').html(html);
    });
    // $('#template_backcover_text').keyup(function() {
    //    CKEDITOR.instances['template_backcover_text'].getData();
    //     var text = $('#template_backcover_text').val()
    //     if (text != '') {
    //         $('#ticket-backcover-text').text($(this).val());
    //     } else {
    //         $('#ticket-backcover-text').text('lorem ipsum dolor sit amet');
    //     }
    // });
});

function themecolor(e){
  $(".theme-color").attr('style',`background-color:${e.value}`);
  $(".theme-color-header").attr('style',`background-color:${e.value}b3;`)
  $('.border_color_theme').attr('style',`border-color:${e.value}`);
}
function sideTicketColor(e){
   $("#ticket-right-side").attr('style',`background-color:${e.value}`);
}
</script>
<script>
var header_content_html = $("#header_content").html();
const header_content = CKEDITOR.replace('header-content', {
    toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
        },
        {
            "name": "document",
            "groups": ["mode"]
        },
        {
            "name": "styles",
            "groups": ["styles"]
        },
        {
            "name": "about",
            "groups": ["about"]
        }

    ],
    // Remove the redundant buttons from toolbar groups defined above.
    removeButtons: 'Superscript,Anchor,Styles,PasteFromWord'
});
header_content.on('change', function(evt) {
    let html = evt.editor.getData();
    var font_color = $(".ColorGet").val();
    let length = evt.editor.getData().length;
    $("#header_content").html(`<span style='color:${font_color};'>${html}</span>`);
});
// $(window).on('load', function() {
//     $('#template_backcover_text').ckeditor();
// });
</script>
@endsection