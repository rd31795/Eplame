@extends('users.layouts.layout')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Event Types</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('user_events')}}">Events</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Event Types</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@include('admin.error_message')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="col-lg-12 mb-30">
                    <div class="card">
                        <div class="card-block">
                            <div class="event-card-head j-c-s-b">
                                <div class="event-card-head-new">
                                    <h3>Tickets</h3>
                                </div>
                            </div>
                            <!-- ticket sec -->
                            <div class="row">
                                 <!-- 22 march -->
                                 
                                <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                    <div class="ticket-card">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="event-card-head-new">
                                                <h3>Template 1</h3>
                                            </div>
                                            <!-- btn -->
                                            <div class="btn-wrap text-right">
                                                <?php $id=2; ?>
                                                <a href="{{ route('edittickets',$id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="You can change the ticket template." class="cstm-btn solid-btn">Edit</a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="ticket-card-2 d-flex  cs-div-height-width">
                                            <span class="cs-div-width"><span class="text">8.5"</span> </span>
                                            <span class="cs-div-height"><span class="text">2.8"</span> </span>
                                            <div class="cs-left" id="logoPreview2" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS87NtVxiDIrh_kqyHIWkLT8qboJvEHpFuHjQ&usqp=CAU');">
                                                <div class="ticket-logo">
                                                    <img src="{{url('images/ticket/logo-new.svg')}}">
                                                </div>
                                                <div class="ticket-2-content">
                                                    <h2>SPORT EVENT</h2>
                                                    <p>DJ MORRIL POTTER NEW YORK,</p>
                                                    <p>DJ NISSIAN, RUSSEL UNITED STATES</p>
                                                    <p class="p-cntnt">lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                            <div class="cs-right">
                                                <div class="text-center">
                                                    <h2>SPORT EVENT</h2>
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
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                    <div class="ticket-card">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="event-card-head-new">
                                                <h3>Template 2</h3>
                                            </div>
                                            <!-- btn -->
                                            <div class="btn-wrap text-right">
                                                <?php $id=3; ?>
                                                <a href="{{ route('edittickets',$id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="You can change the ticket template." class="cstm-btn solid-btn">Edit</a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="ticket-card-3 d-flex cs-div-height-width">
                                            <span class="cs-div-width"><span class="text">8.5"</span> </span>
                                            <span class="cs-div-height"><span class="text">2.8"</span> </span>
                                            <!-- <div class="cs-left-img" >
                                    <figure  id="logoPreview3" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzsnU0qrc7XKSXB_otTnrsuuyHW97M1IIQ7w&usqp=CAU');">
                                    </figure>
                                 </div> -->
                                            <div class="cs-left" id="logoPreview3" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzsnU0qrc7XKSXB_otTnrsuuyHW97M1IIQ7w&usqp=CAU');">
                                                <div class="ticket-logo">
                                                    <img src="{{url('images/ticket/logo-new.svg')}}">
                                                </div>
                                                <div class="cs-mid">
                                                    <p>SPECIAL NIGHT</p>
                                                    <h5>EVENT NAME</h5>
                                                </div>
                                                <br>
                                                <p>DJ MORRIL POTTER NEW YORK,</p>
                                                <p>DJ NISSIAN, RUSSEL UNITED STATES</p>
                                            </div>
                                            <div class="cs-right">
                                                <div class="bg-layer"></div>
                                                <h5 class="cs-top" style="color:white;">
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
                                <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                    <div class="ticket-card">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="event-card-head-new">
                                                <h3>Template 4</h3>
                                            </div>
                                            <!-- btn -->
                                            <div class="btn-wrap text-right">
                                                <?php $id=5; ?>
                                                <a href="{{ route('edittickets',$id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="You can change the ticket template." class="cstm-btn solid-btn">Edit</a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="ticket-card-5 d-flex cs-div-height-width">
                                            <span class="cs-div-width"><span class="text">8.5" </span> </span>
                                            <span class="cs-div-height"><span class="text">2.8"</span> </span>
                                            <div class="cs-left" id="logoPreview4" style="background-image: url({{url('images/ticket/3.png')}})">
                                                <div class="cs-card-left-img">
                                                    <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8cGFydHklMjBkanxlbnwwfHwwfHw%3D&w=1000&q=80">
                                                </div>
                                                <div>
                                                    <div class="ticket-logo">
                                                        <img src="{{url('images/ticket/logo-new.svg')}}">
                                                    </div>
                                                    <p class="cs-top">SPECIAL NIGHT-2016</p>
                                                    <h6>EVENT NAME</h6>
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
                            </div>
                            <!-- ticket sec end-->
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
@endsection