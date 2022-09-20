@extends('users.layouts.layout')
@section('content')
<link rel="stylesheet" href="{{url('js/lightbox.css')}}" />
<style type="text/css">
.seasonName {
    color: #fff !important;
}

.headline-wrap.text-center:before {
    content: "";
    position: absolute;
    height: 1px;
    background: #eda008 !important;
    width: 25%;
    left: 0;
    top: 11px;
}

.headline-wrap.text-center {
    position: relative;
    margin-bottom: 20px;
}

.headline-wrap.text-center.color-green,
.headline-wrap.text-center.color-danger {
    position: relative;
    margin-bottom: 0px;
    margin-top: 20px;
}

.headline-wrap.text-center:after {
    content: "";
    position: absolute;
    height: 1px;
    background: #eda008 !important;
    width: 25%;
    right: 0;
    top: 11px;
}

.event-planning-table-wrap .cart-totals .line {
    display: none;
}

.event-planning-table-wrap .cart-totals .headline {
    background-color: #5372aa00;
    color: #eda008;
}

.event-planning-table-wrap {
    /* background-image: linear-gradient(to right, #6389ca 0%, #34486a 100%); */
    border: 4px solid #4472c4;
    padding: 15px;
    border-radius: 4px;
    max-width: 300px;
    width: 100%;
    animation: avatar-pulse 2s infinite;
    background-image: linear-gradient(to right, #6389ca 0%, #34486a 100%);
    animation: avatar-pulse 2s infinite;
    transition: background-color 0.5s;
    transition: 0.5s ease all;
}

.event-planning-table-wrap .cart-totals .cart-table th,
.event-planning-table-wrap .cart-totals .cart-table td {
    width: auto;
    padding: 15px 10px;
    color: #fff;
    background: transparent;
    border-bottom: #ffffff29 1px solid !important;
}

.events-detail-sec .card .cls-hide-show {
    background: #35486b;
    border: none;
    color: #fff;
    margin-left: 20px;
    margin-right: 20px;
    height: 28px;
    width: 28px;
    font-size: 20px;
    padding: 0;
    outline: none;
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 28px;
}

.event-card-head-new {
    display: flex;
    align-items: center;
}

.cust-thanku2 {
    width: 100% !important;
    border-bottom: 1px solid #e2e2e2;
    padding: 10px;
    margin: 20px;
}

.cust-thanku2 h3 {
    margin-bottom: 0;
    padding-bottom: 0;
    border: none;
}

.events-detail-sec .card .cls-hide-show i {
    font-size: 12px;
}

.pcoded-inner-content .edit-event-btn {
    padding: 12px;
    width: 100%;
    font-size: 14px;
}

table.pending-done-status td a.running-status2 {
    background: #3f4d67;
}
</style>
@php $stripe = SripeAccount();@endphp
@php $eventStatus = EventCurrentStatus($user_event->start_date,$user_event->end_date) @endphp
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="page-header-title">
                    <h5 class="m-b-10">Detail Event</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="@if(Auth::user()->id == $user_event->user_id) {{ route('user_events') }} @else {{ route('user_co_events') }} @endif">Events</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Detail Event</a></li>
                </ul>
            </div>
            @if(($eventStatus == 'Upcoming Event') && (Auth::user()->id == $user_event->user_id || checkPermission('event_management', $user_event->id) == 1))
            <div class="col-md-2">
                <div class="btn-wrap text-right mb-3">
                    <a href="@if(Auth::user()->id == $user_event->user_id) {{ route('user_show_edit_event', $user_event->slug) }} @else {{ route('user_show_edit_co_event', $user_event->slug) }} @endif" class="cstm-btn edit-event-btn">Edit Event</a>
                </div>
            </div>
            @endif
            @if(($eventStatus == 'Upcoming Event') && (Auth::user()->id == $user_event->user_id || checkPermission('event_management', $user_event->id) == 1) || $eventStatus == 'Ongoing Event')
            <div class="col-md-3">
                <div class="btn-wrap text-right mb-3">
                    <a href="{{ route('user_reschedule_event', $user_event->slug) }}" class="cstm-btn edit-event-btn">Reschedule Event</a>
                </div>
            </div>
            @endif
            @if(($eventStatus == 'Upcoming Event') && (Auth::user()->id == $user_event->user_id || checkPermission('event_management', $user_event->id) == 1) || $eventStatus == 'Ongoing Event')
            <div class="col-md-2">
                <div class="btn-wrap text-right mb-3">
                    <a href="" class="cstm-btn edit-event-btn" data-toggle="modal" data-target="#cancel-event">Cancel Event</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<input type="hidden" id="start_date" value="{{$user_event->start_date}}">
<div class="pcoded-content p-0">
    @php $banner_image = $user_event->banner_image !='' ? $user_event->banner_image : '/dev/images/event-bg.jpg';   @endphp
    <div class="main-header" style="background-image: url('{{url($banner_image)}}');">
        <div class="main-header__intro-wrapper">
            <div class="main-header__welcome">
                <div class="main-header__welcome-title text-light">Welcome, {{ Auth::user()->first_name }}<strong></strong></div>
                <div class="main-header__welcome-subtitle text-light">How are you today?</div>
            </div>
            <div class="quickview">
                <div class="quickview__item">
                    @php
                     $upcoming_user_event=Auth::user()->UpcomingUserEvents->where('event_status', 1)->count();
                     @endphp
                    <div class="quickview__item-total">{{ $upcoming_user_event }}</div>
                    <div class="quickview__item-description">
                        <i class="far fa-calendar-alt"></i>
                        <span class="text-light">Upcoming {{$upcoming_user_event>1?'Events':'Event'}}</span>
                    </div>
                </div>
                <!-- <div class="quickview__item">
    }
<div class="quickview__item-total">64</div>
<div class="quickview__item-description">
<i class="far fa-comment"></i>
<span class="text-light">Messages</span>
</div>
</div>
<div class="quickview__item">
<div class="quickview__item-total">27°</div>
<div class="quickview__item-description">
<i class="fas fa-map-marker-alt"></i>
<span class="text-light">Austin</span>
</div>
</div> -->
            </div>
        </div>
        <div class="order-status-row">
            <article class="media order shadow delivered">
                <!--  <figure class="media-left">
         <i class="fas fa-thumbs-up"></i>
      </figure> -->
                <div class="media-content">
                    <div class="content">
                        <h3>
                            <strong>{{$user_event->title}}</strong>
                            <br>
                            <small>{{$user_event->description}}
                            </small>
                        </h3>
                    </div>
                </div>
                <div class="media-right">
                    @if($eventStatus == 'Upcoming Event')
                    <div class="card-media-body-top-icons u-float-right">
                        <div class="sm-countdown-wrap wt-countdown">
                            <ul class="count-down-timer">
                                <input type="hidden" value="{{$user_event->start_date}}" id="start_date_{{$user_event->id}}" class="timerWatch" data-days="#days_{{$user_event->id}}" data-hours="#hours_{{$user_event->id}}" data-minutes="#minutes_{{$user_event->id}}" data-seconds="#seconds_{{$user_event->id}}" />
                                <li><span id="days_{{$user_event->id}}"></span>days</li>
                                <li><span id="hours_{{$user_event->id}}"></span>Hours</li>
                                <li><span id="minutes_{{$user_event->id}}"></span>Minutes</li>
                                <li><span id="seconds_{{$user_event->id}}"></span>Seconds</li>
                            </ul>
                        </div>
                    </div>
                    @else
                    <div class="tags has-addons">
                        <span class="tag is-light">Status:</span>
                        <span class="tag is-delivered">{{ $eventStatus }}</span>
                    </div>
                    @endif
                </div>
            </article>
        </div>
    </div>
</div>
<section class="events-detail-sec">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-block">
                    <div class="event-card-head a-i-c j-c-s-b">
                        <div class="event-card-head-new">
                            <button href="#collapse1" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h3 class="mb-0">Event Details</h3>
                        </div>
                        <!-- Shared Event Icon Html -->
                        @php @endphp
                        @if(Auth::user()->id == $user_event->user_id || checkPermission('event_sharing', $user_event->id) == 1)
                        <ul class="social-icons event-share-icons mb-2 ball" style="margin-left: unset; ">
                            @if(getAllValueWithMeta('facebook', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => Auth::user()->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->facebook() ?>">
                                    <img src="https://yauzer.com/images/icon-fb.png" alt="Facebook">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('twitter', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => Auth::user()->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->twitter() ?>">
                                    <img src="https://yauzer.com/images/icon-twitter.png" alt="Twitter">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('linkdin', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => Auth::user()->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->linkedin() ?>">
                                    <img src="https://yauzer.com/images/linkedin-icon.png" alt="Linkedin">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('pintrest', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('forum.user.eventDetail',  ['id' => Auth::user()->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->pinterest() ?>">
                                    <img src="https://yauzer.com/images/icon-Pinterest.png" alt="Pinterest">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('email', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="javascript:void(0)" data-toggle="modal" data-target="#share-event">
                                    <img src="{{url('/')}}/images/email.png" alt="email">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('whatsapp', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="https://wa.me/?text={{route('forum.user.eventDetail',  ['id' => Auth::user()->id, 'slug' => $user_event->slug])}}" data-action="share/whatsapp/share">
                                    <img src="{{url('/')}}/images/whatsapp.png" alt="Whatsapp">
                                </a>
                            </li>
                            @endif
                            <!--  @if(getAllValueWithMeta('snapchat', 'global-settings') == '1')
                      <li>
                         <a target="_blank" href="https://www.snapchat.com/scan?attachmentUrl={{route('forum.user.eventDetail',  ['id' => Auth::user()->id, 'slug' => $user_event->slug])}}">
                            <img src="https://yauzer.com/images/icon-Whatsapp.png" alt="Snapchat">
                         </a>
                      </li>
                    @endif -->
                        </ul>
                        <a class="cstm-btn mb-2 cstm-share" href="javascript:void(0)">
                            <i class="fas fa-share-alt"></i>
                        </a>
                        @endif
                        <!-- Shared Event Icon Html End -->
                    </div>
                    <div class="row  cstm-flex-row" id="collapse1" style="display: flex;">
                        <div class="col-lg-6">
                            <div class="event-detail-full-dec">
                                <h3 class="evt-title">{{ ucfirst($user_event->title) }}</h3>
                                <span class="evt-date">{{ \Carbon\Carbon::parse($user_event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($user_event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($user_event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($user_event->start_time)->format('g:i A') }}</span>
                                <div class="evnt-full-detail">
                                    <p>{{ $user_event->long_description }}</p>
                                    <ul class="evt-more-dec">
                                        <li>
                                            <p><span class="icon"><i class="fas fa-map-marker-alt"></i></span>{{ $user_event->location }}</p>
                                        </li>
                                        <li>
                                            <p class="evt-more-deatil"> <span class="icon"><i class="fas fa-folder-open"></i></span>{{ $user_event->eventType->name }}</span></p>
                                        </li>
                                        <li>
                                            <p class="evt-more-deatil"> <span class="icon"><i class="fas fa-tags"></i></span> @foreach($user_event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last), @endif @endforeach</p>
                                        </li>
                                        <li>
                                            <p class="evt-more-deatil"> <span class="icon"><i class="fas fa-dollar-sign"></i></span>${{ $user_event->event_budget }}</span></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="event-detail-side-img">
                                <div class="eggShape-wrap">
                                    <div class="eggShape-container eggShape-1"></div>
                                    <div class="eggShape-container eggShape-2"></div>
                                    <!-- <div class="eggShape-container eggShape-3"></div> -->
                                    @php
                                         $event_image=$user_event->event_picture !='' ? $user_event->event_picture : '';
                                    @endphp
                                    <div class="egg-shape-img" style="background-image: url('{{url($event_image)}}');"></div>
                                    <div class="eggShape-container eggShape-5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Event Planning tool -->
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-block">
                    <div class="event-card-head j-c-s-b cus-to-head">
                        <div class="event-card-head-new">
                            <button href="#collapse2" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h3>My Event Planning Tool Box</h3>
                        </div>
                    </div>
                    <div class="row" id="collapse2" style="display: flex;">
                        <div class="col-lg-7">
                            <div class="event-planning-navigation">
                                <nav class="evt-plan-navigation">
                                    <ul>
                                        <li>Welcome Back {{ Auth::user()->name }}! Lets continue Planning</li>
                                        <li><a href="{{ route('user_show_create_event') }}" data-toggle="tooltip" title="1. You have successfully created the event."><span class="plan-nav-icon"><i class="far fa-edit"></i></span>Create <br /> Event</a></li>
                                        <li><a href="{{url(route('user.tool.checklist',$user_event->slug))}}" data-toggle="tooltip" title="2. Now let’s look at your Checklist and what’s needed for the Event"><span class="plan-nav-icon"><i class="fas fa-tasks"></i></span>Checklist</a></li>
                                        <li><a href="{{route('users.budget', $user_event->slug)}}" data-toggle="tooltip" title="3. Great! Let’s work on your Budget"><span class="plan-nav-icon"><i class="fas fa-dollar-sign"></i></span>Budget</a></li>
                                        <li><a href="{{ route('users.guestList', $user_event->slug) }}" data-toggle="tooltip" title="4. Invite guest to Your Event"><span class="plan-nav-icon"><i class="fas fa-list-alt"></i></span>Guest List</a></li>
                                        <li><a href="{{route('users.events.vendors', $user_event->slug)}}" title="5. Start Hiring Vendors" data-toggle="tooltip"><span class="plan-nav-icon"><i class="fas fa-truck-moving"></i></span>Vendor <br /> Manager</a></li>
                                        <li><a href="{{route('user.event.ticket_design',$user_event->id)}}" title="6. Edit Event Ticket" data-toggle="tooltip"><span class="plan-nav-icon"><i class="fab fa-chrome"></i></span>Event <br /> Ticket</a></li>
                                        <li><a href="{{url('/')}}/shop" title="7. Setup a Registry / Souvenir store or Shop for your Event" data-toggle="tooltip"><span class="plan-nav-icon"><i class="fas fa-store"></i></span>
                                        <li><a href="{{ url('/') }}/forum" title="8. Get Ideas for your Event or Share your Ideas/Experience" data-toggle="tooltip"><span class="plan-nav-icon"><i class="fas fa-comments"></i></span>Forum</a></li>
                                        E-Shop/<br>Registry</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="right-col-table">
                                <div class="event-planning-table-wrap">
                                    <div class="cart-totals mt-2">
                                        <div class="headline-wrap text-center">
                                            <h3 class="headline">My Budget</h3>
                                        </div>
                                        <span class="line"></span>
                                        <div class="clearfix"></div>
                                        <table class="cart-table margin-top-5">
                                            @php $b = getEventBudget($user_event) @endphp
                                            <tbody>
                                                <tr>
                                                    <th>Total Budget</th>
                                                    <td><strong>${{custom_format($user_event->event_budget,2)}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Expenses on Vendor</th>
                                                    <td><strong><span class="minus-sign">-</span> ${{custom_format($b['spend'],2)}} </strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Remaining Balance</th>
                                                    <td><strong>${{custom_format($b['remain'],2)}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Extra Expenses</th>
                                                    <td><strong>${{custom_format($b['over'],2)}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Escrow Amount</th>
                                                    @php $es_amt = getTotalEscrowEvent($user_event->id); @endphp
                                                    <td><strong>${{custom_format($es_amt,2)}}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        @if($b['over'] == 0)
                                        <div class="btn-wrap text-center">
                                            <h3 class="cstm-btn success-btn blink-text">On Budget</h3>
                                            <span class="line"></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        @else
                                        <div class="btn-wrap text-center">
                                            <h3 class="cstm-btn danger-btn blink-text">Over Budget</h3>
                                            <span class="line"></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        @endif
                                        <!-- <a href="#" class="calculate-shipping"><i class="fa fa-arrow-circle-down"></i> Calculate Shipping</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======================= -->
        @if($user_event->registration == 'yes')
       <!--  <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-block">
                    <div class="event-card-head j-c-s-b">
                        <div class="event-card-head-new">
                            <button href="#collapse11" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h3>Share Registration Form </h3>
                        </div>
                    </div>
                    <div class="todo-listing-wrap mt-4" id="collapse11" style="display: block;">
                        <ul class="social-icons event-share-icons mb-2 ball" style="margin-left: unset; ">
                            @if(getAllValueWithMeta('facebook', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('user.event.registration',  ['id' => $user_event->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->facebook() ?>">
                                    <img src="https://yauzer.com/images/icon-fb.png" alt="Facebook">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('twitter', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('user.event.registration',  ['id' => $user_event->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->twitter() ?>">
                                    <img src="https://yauzer.com/images/icon-twitter.png" alt="Twitter">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('linkdin', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('user.event.registration',  ['id' => $user_event->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->linkedin() ?>">
                                    <img src="https://yauzer.com/images/linkedin-icon.png" alt="Linkedin">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('pintrest', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="<?= \Share::load(route('user.event.registration',  ['id' => $user_event->id, 'slug' => $user_event->slug]),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->pinterest() ?>">
                                    <img src="https://yauzer.com/images/icon-Pinterest.png" alt="Pinterest">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('email', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="javascript:void(0)" data-toggle="modal" data-target="#reg-share-event">
                                    <img src="{{url('/')}}/images/email.png" alt="email">
                                </a>
                            </li>
                            @endif
                            @if(getAllValueWithMeta('whatsapp', 'global-settings') == '1')
                            <li>
                                <a target="_blank" href="https://wa.me/?text={{route('user.event.registration',  ['id' => $user_event->id, 'slug' => $user_event->slug])}}" data-action="share/whatsapp/share">
                                    <img src="{{url('/')}}/images/whatsapp.png" alt="Whatsapp">
                                </a>
                            </li>
                            @endif
                        </ul>
                        <a class="cstm-btn mb-2 cstm-share" href="javascript:void(0)">
                            <i class="fas fa-share-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
        @endif

                     @if(Auth::user()->id == $user_event->user_id  && $eventTicket)
             @php 
               $event=$eventTicket->user_events;
             @endphp
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="cstm-card-head">
                                        <div class="event-card-head-new">
                                            <button href="#collapse200" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                                            <h5 class="card-title">Event Ticket</h5>
                                        </div>
                                    </div>
                                   <div id="collapse200">
                         
                                      @if($event_ticket_template == 2)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-2 d-flex">
                                        <div class="cs-left" id="logoPreview1"   style="background-image: url('{{url($eventTicket->background_image)}}'); color:{{$eventTicket->font_color}};">
                                    <div class="ticket-logo">
                                       <img src="{{url('images/ticket/logo-new.svg')}}" style="background: {{$eventTicket->logo_color}}">
                                    </div>
                                    <div class="ticket-2-content theme-color-header" style="background-color:{{$eventTicket->theme_color}}b3;">
                                    <div id="header_content" >   
                                    {!!$eventTicket->header_content!!}
                                    </div>
                                    <div id="location">
                                    <p>{{$event->location}}</p>
                                    </div>
                                    <p class="p-cntnt" id="ticket-text">{{$eventTicket->template_text}}</p>
                                    </div>
                                 </div>
                                        <div class="cs-right " id="ticket-right-side" style="color:{{$eventTicket->font_color}};  background-color: {{$eventTicket->ticket_right_side}}">
                                    <div class="text-center">
                                       <h2 style="font-size: 18px; color:{{$eventTicket->font_color}}" >{{$event->title}}</h2>
                                       <hr class="border_color_theme" style="border-color:{{$eventTicket->theme_color}}"> 
                                            <ul class="mt-2">
                                                <li>
                                                    @if($event->start_date == $event->end_date)
                                                    <p style="margin: 0 0 10px">{{Carbon\Carbon::parse($item[$event->start_date])->format('Y-m-d')}}</p>
                                                    @else
                                                    <p style="margin: 0 0 10px">{{Carbon\Carbon::parse($event->start_date)->format('Y-m-d')}} - {{Carbon\Carbon::parse($event->end_date)->format('Y-m-d')}}</p>
                                                    @endif
                                                </li>
                                                <li>
                                                    <p>{{$event->start_time}} - {{$event->end_time}}</p>
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
                                        <div class="cs-left-back" id="logoPreviewBack" style="background-image:url('{{url($eventTicket->back_cover_background_picture)}}'); color: {{$eventTicket->back_font_colour}};">
                                            <div id="ticket-backcover-text">{!! $eventTicket->template_backcover_text !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                         @if($event_ticket_template == 3)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-3 d-flex">
                                        <!-- <div class="cs-left-img">
                                            <figure id="logoPreview1" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzsnU0qrc7XKSXB_otTnrsuuyHW97M1IIQ7w&usqp=CAU');">
                                            </figure>
                                        </div> -->
                                        <div class="cs-left" id="logoPreview1" style="background-image:url('{{url($eventTicket->background_image)}}'); color:{{$eventTicket->font_color}};">
                                            <div class="ticket-logo">
                                                <img src="{{url('images/ticket/logo-new.svg')}}"  style="background: {{$eventTicket->logo_color}}">
                                            </div>
                                            <div class="cs-mid text-center theme-color-header" id="header_content">
                                                {!!$eventTicket->header_content!!}
                                            </div>
                                            <br>
                                            <p>{{$event->location}}</p>
                                        </div>
                                        <div class="cs-right" id="ticket-right-side">
                                            <div class="bg-layer theme-color"></div>
                                            <h5 class="cs-top " style="color: white;">
                                                {{$event->title}}
                                            </h5>
                                            <ul>
                                                <li>
                                                    <p>VIP: $ ENTRY PASS</p>
                                                </li>
                                                <li>
                                                     @if($event->start_date == $event->end_date)
                                                    <p>DATE: {{Carbon\Carbon::parse($item[$event->start_date])->format('Y-m-d')}}</p>
                                                     @else
                                                    <p>DATE: {{Carbon\Carbon::parse($event->start_date)->format('Y-m-d')}} - {{Carbon\Carbon::parse($event->end_date)->format('Y-m-d')}}</p>
                                                     @endif
                                                </li>
                                                <li>
                                                    <p>TIME: {{$event->start_time}} - {{$event->end_time}}</p>
                                                </li>
                                                <li>
                                                    <p id="ticket-text">{{$eventTicket->template_text}}</p>
                                                </li>
                                            </ul>
                                            <div class="bg-layer theme-color" style="background-color:{{$eventTicket->theme_color}};"></div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="template-cover-text">Back Cover</h3>
                                <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center">
                                        <div class="cs-left-back" id="logoPreviewBack" style="background-image:url('{{url($eventTicket->back_cover_background_picture)}}'); color: {{$eventTicket->back_font_colour}};">
                                            <p id="ticket-backcover-text">{!! $eventTicket->template_backcover_text !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif


                        @if($event_ticket_template == 5)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ticket-card">
                                <h3 class="template-cover-text">Front Cover</h3>
                                <div class="front-cover-content">
                                    <div class="ticket-card-5 d-flex">
                                        <div class="cs-left" id="logoPreview1" style="background-image:url('{{url($eventTicket->background_image)}}'); color:{{$eventTicket->font_color}};">
                                            <div class="cs-card-left-img">
                                                <img src="{{url($eventTicket->picture)}}" id="front_event_picture">
                                            </div>
                                            <div>
                                                <div class="ticket-logo"> 
                                                    <img src="{{url('images/ticket/logo-new.svg')}}" style="background: {{$eventTicket->logo_color}};">
                                                </div>
                                                <div id="header_content">
                                                 {!!$eventTicket->header_content!!}
                                                </div>
                                                <ul>
                                                    <li>
                                                        <div class="fourth-ticket">
                                                            <h6>Date</h6>
                                                    @if($event->start_date == $event->end_date)
                                                    <p>{{Carbon\Carbon::parse($item[$event->start_date])->format('Y-m-d')}}</p>
                                                     @else
                                                    <p>{{Carbon\Carbon::parse($event->start_date)->format('Y-m-d')}} - {{Carbon\Carbon::parse($event->end_date)->format('Y-m-d')}}</p>
                                                     @endif
                                                            <br>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h6>Time</h6>
                                                        <div class="fourth-ticket d-flex justify-content-between">
                                                            <div>
                                                                
                                                                <p>DOOR OPEN</p>
                                                                <h6><strong>{{$event->start_time}} </strong></h6>
                                                            </div>
                                                            <div>
                                                                
                                                                <p>DOOR CLOSE</p>
                                                                <h6><strong> {{$event->end_time}}</strong></h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cs-right" id="ticket-right-side"  style="color:{{$eventTicket->font_color}};  background-color: {{$eventTicket->ticket_right_side}}">
                                            <div class="cs-right-inner">
                                                <h6> {{$event->title}}</h6>
                                                <h5>VIP GAT PASS</h5>
                                                <h5>000055446</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="template-cover-text">Back Cover</h3>
                                <div class="back-cover-content">
                                    <div class="ticket-card-1 d-flex align-items-center" >
                                        <div class="cs-left-back" id="logoPreviewBack" style="background-image:url('{{url($eventTicket->back_cover_background_picture)}}'); color: {{$eventTicket->back_font_colour}};">
                                            <p id="ticket-backcover-text">{!! $eventTicket->template_backcover_text !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                          </div>
                                   
                                </div>
                            </div>
                        </div>
                        @endif
        <!-- ======================= -->
        @if($user_event->user_id == Auth::user()->id)
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-block">
                    <div class="event-card-head cst-sb-hd">
                        <div class="event-card-head-new">
                            <button href="#collapse3" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h3>Event Co-Host</h3>
                        </div>
                    </div>
                    <div class="row cust-n-row" id="collapse3" style="display: flex;">
                        <div class="col-md-6">
                            <div class="add-co-host">
                                <h5>Add Co-Host</h5>
                                <form method="POST" id="coHostForm">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name*"><i class="fas fa-info-circle" data-toggle="tooltip" title="Enter name of the Co-Host."></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email*"><i class="fas fa-info-circle" data-toggle="tooltip" title="Co-Host will get an inviation link in the email."></i>
                                        <input type="hidden" name="event_id" value="{{$user_event->id}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="relation" class="form-control" placeholder="Relation*"><i class="fas fa-info-circle" data-toggle="tooltip" title="Relation with the Co-Host."></i>
                                    </div>
                                    <div class="form-group grp1">
                                        <h3>Capabilities</h3>
                                        <label class="container-c">Event Sharing
                                            <input type="checkbox" id="event_sharing" name="event_sharing" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <!-- <input type="checkbox" id="event_sharing" name="event_sharing" value="1" class="co-mng">
                        <span class="checkmark"></span>
                        <label for="event_sharing">Event Sharing</label> -->
                                    </div>
                                    <div class="form-group grp1">
                                        <label class="container-c">Guest_Management
                                            <input type="checkbox" id="guest_management" name="guest_management" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <!-- <input type="checkbox" id="guest_management" name="guest_management" value="1" class="co-mng">
                        <span class="checkmark"></span>
                        <label for="guest_management">guest_management</label> -->
                                    </div>
                                    <div class="form-group grp1">
                                        <label class="container-c">Checklist Management
                                            <input type="checkbox" id="checklist_management" name="checklist_management" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <!-- <input type="checkbox" id="checklist_management" name="checklist_management" value="1" class="co-mng">
                        <span class="checkmark"></span>
                        <label for="checklist_management">Checklist Management</label> -->
                                    </div>
                                    <div class="form-group grp1">
                                        <label class="container-c">Budget Management
                                            <input type="checkbox" id="budget_management" name="budget_management" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <!--       <input type="checkbox" id="budget_management" name="budget_management" value="1" class="co-mng">
                        <span class="checkmark"></span>
                        <label for="budget_management">Budget Management</label> -->
                                    </div>
                                    <div class="form-group grp1">
                                        <label class="container-c">Hire Vendors
                                            <input type="checkbox" id="vendor_management" name="vendor_management" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <!--       <input type="checkbox" id="budget_management" name="budget_management" value="1" class="co-mng">
                        <span class="checkmark"></span>
                        <label for="budget_management">Budget Management</label> -->
                                    </div>
                                    <div class="form-group grp1">
                                        <label class="container-c">Edit Event
                                            <input type="checkbox" id="event_management" name="event_management" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <!--       <input type="checkbox" id="budget_management" name="budget_management" value="1" class="co-mng">
                        <span class="checkmark"></span>
                        <label for="budget_management">Budget Management</label> -->
                                    </div>
                                    <div class="alert alert-success cohost-success" role="alert" style="display: none;">
                                        <p></p>
                                    </div>
                                    <button type="submit" id="coHostFormBtn" class="cstm-btn solid-btn">Send</button>
                                </form>
                                <!-- <div class="my-form">
                      <label class="container-c">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                      </label>
                      <label class="container-c">Two
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                      <label class="container-c">Three
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                      <label class="container-c">Four
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                    </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="add-co-host">
                                <h5>Listing of Co-Host</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($cohosts[0]->id))
                                        @foreach($cohosts as $cohost)
                                        <tr>
                                            <td>{{$cohost->cohost_email}}</td>
                                            <td class="@if($cohost->status == 0) inactive @else active @endif">@if($cohost->status == 0) In-Active @else Active @endif</td>
                                            <td><a href="{{ route('user_edit_co_host', $cohost->id) }}">Edit</a></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-block">
                    <div class="event-card-head cst-sb-hd">
                        <div class="event-card-head-new">
                            <button href="#collapse4" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h3>Event Theme</h3>
                        </div>
                    </div>
                    <div class="row cust-n-row" id="collapse4" style="display: flex;">
                        <div id="weather_api">
                             @php 
                    $start_date=\Carbon\Carbon::parse($user_event->start_date);
                    $start_date=$start_date->format('Y-m-d');
                    @endphp
         <input type="hidden" id="venue_weather_route" value="https://eplame.com/dev/venue/get-weather?latitude={{$user_event->latitude}}&longitude={{$user_event->longitude}}&time={{$start_date}}">
     </div>
                        <!-- weather section -->
                        <div class="col-md-4 col-sm-12" id="sidebar-weather" >
                            <h4 class="sub-head">My event date weather management</h4>
                            <div class="evt-theme-card bs mt-4 wow bounceInLeft" data-wow-delay="500ms" style="background-image: url({{ asset('frontend/images/weather.png') }})">
                                <div class="evt-theme-body">
                                    <div class="form-group mb-0">
                                        <input type="date" min="{{date('Y-m-d', strtotime($user_event->start_date))}}" max="{{date('Y-m-d', strtotime($user_event->end_date))}}" value="{{date('Y-m-d', strtotime($user_event->start_date))}}" class="form-control" id="weatherDatePicker" placeholder="select date">
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

                        <!-- weather section end -->
                        <!-- <div class="col-md-6">
                     <div class="evt-theme-card bs mt-4 wow bounceInLeft" data-wow-delay="500ms" style="background-image: url({{ asset('images/event-theme-bg.jpg') }})">
                      <div class="evt-theme-body">
                        <div class="title">Seasons</div>
                        <div class="value">{{$user_event->seasons}}</div>
                     </div>
                    </div>
                  </div> -->
                        @if($user_event->style_id > 0 || !empty($user_event->style_image))
                        <div class="col-md-4 col-sm-12 pos-z">
                            <h4 class="sub-head">Style Management</h4>
                            <div class="center-box wow bounceInRight animated mt-4" data-wow-delay="800ms">
                                <div class="image-box">
                                    <figure id="style-img1">
                                        @if($user_event->style_id > 0)
                                        <img src="{{url('/wedding_app/public/uploads/').'/'.$user_event->style->image}}">
                                        @else
                                        <img src="{{asset('').'/'.$user_event->style_image}}">
                                        @endif
                                    </figure>
                                </div>
                                <div class="text-wrap">
                                    @if($user_event->style_id > 0)
                                    <h3>{{ $user_event->style->title }}</h3>
                                    @else
                                    <h3>{{ $user_event->style_title }}</h3>
                                    @endif
                                    @if($user_event->style_id > 0)
                                    @if(!empty($user_event->style_description))
                                    <p>{{ $user_event->style_description }}</p>
                                    @else
                                    <p>{{ $user_event->style->description }}</p>
                                    @endif
                                    @else
                                    <p>{{ $user_event->style_description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-4 col-sm-12">
                            <h4 class="sub-head">Event Theme Color</h4>
                            <div class="evt-theme-card bs mt-4 wow bounceInRight animated mt-4" data-wow-delay="800ms" style="background-image: url({{ asset('images/event-theme-bg-2.jpg') }})">
                                <div class="evt-theme-body">
                                    @php $colours = (array)json_decode($user_event->colour); @endphp
                                    <div class="title"></div>
                                    <!-- <div class="value">{{$user_event->colour}}<span class="theme-color-box" style="background: {{$user_event->colour}}"></span></div> -->
                                    <ul class="event-theme-color">
                                        @foreach($colours as $key => $colour)
                                        <li>
                                            <div class="theme-color-wrap"><span class="theme-color-box" style="background:{{ $colour->colour }}">{{ $colour->colourName }}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                        <!--  <li><div class="theme-color-wrap"><span class="theme-color-box" style="background:#a864a8;">#a864a8</span></div></li>
                         <li><div class="theme-color-wrap"><span class="theme-color-box" style="background:#362f2d;">#362f2d</span></div></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  todo list html -->
        @if($eventStatus == 'Upcoming Event' || $eventStatus == 'Ongoing Event')
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-block">
                    <div class="event-card-head j-c-s-b">
                        <div class="event-card-head-new">
                            <button href="#collapse10" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h3><i class="fas fa-tasks"></i></span> Todo List </h3>
                        </div>
                    </div>
                    <div class="todo-listing-wrap mt-4" id="collapse10" style="display: block;">
                        <ul class="Todo-item-list row wow bounceInRight" data-wow-delay="800ms">
                        <?php
                        $ToDoTask = $user_event->ToDoTasks();
                        
                        $ToDoTasks = $ToDoTask->take(8)->get();
                        $count = 1;
                        ?>
                            @foreach($ToDoTasks as $task)
                            <!-- <li class="col-lg-12">
                   <div class="todo-item">
                      <a href="{{ route('user.tool.checklist', $user_event->slug) }}?id={{$task->id}}"><span>{{$task->task}} </span></a>

                      <span>
                          <i class="far fa-calendar"></i>
                          <strong>({{$task->task_date}}) </strong>
                           {{ \Carbon\Carbon::parse($task->task_date)->diffForhumans()}}
                      </span>                                         
                      
                   </div>
                </li> -->
                            <li class="col-lg-3 col-md-4">
                                <!--  -->
                                <div class="flip-card">
                                    <div class="flip-card-inner">
                                        <div class="flip-card-front @if($count == 1) blue @elseif($count == 2) pink @elseif($count == 3) green @elseif($count == 4) blue @elseif($count == 5) pink @elseif($count == 6) @elseif($count == 7) pink @elseif($count == 8) green @endif">
                                            <div class="todo-item">
                                                <a href="{{ route('user.tool.checklist', $user_event->slug) }}?id={{$task->id}}">
                                                    <figure>
                                                        <img src="{{ asset('/frontend/images/calendar.svg') }}">
                                                        <span>
                                                            <h3>{{ \Carbon\Carbon::parse($task->task_date)->format('d M y')}}</h3>
                                                        </span>
                                                        <!--  <div class="cstm-tooltip tooltip-right">{{ $task->task }}</div> -->
                                                    </figure>
                                                </a>
                                            </div>
                                        </div>
                                        <a class="flip-card-back" href="{{ route('user.tool.checklist', $user_event->slug) }}?id={{$task->id}}">
                                            <div class="text-flip">
                                                @php $parent_task_name = parentTaskName($task->parent, $task->task_id); @endphp
                                                <span>{{ strlen($parent_task_name)<=20 ? $parent_task_name : substr($parent_task_name,0,20).'...' }}</span> <span>{{ strlen($task->task)<=20 ? $task->task : substr($task->task,0,20).'...' }}</span>
                                                <span>
                                                    <h3>{{ \Carbon\Carbon::parse($task->task_date)->format('d M y')}}</h3>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php
                    $count++;
                  ?>
                            @endforeach
                        </ul>
                        <a href="{{url(route('user.tool.checklist', $user_event->slug))}}" class="cstm-btn solid-btn">Take me to my checklist</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($eventStatus == 'Past Event' && $user_event->user_id == Auth::user()->id)
        <div class="col-lg-12 mb-30">
            <div class="card detail-main-card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="cust-thanku season-thnku">
                                <div class="event-card-head-new cust-thanku2">
                                    <button href="#collapse5" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                                    <h3>Your Event Finally Made It</h3>
                                </div>
                                <div class="row" id="collapse5" style="display: flex;">
                                    <div class="col-lg-7 col-md-12 col-sm-12">
                                        <div class="season-form-thnku">
                                            <div class="event-card-head cst-sb-hd">
                                                <h4 class="sub-head">Thank You Note</h4>
                                            </div>
                                            <div class="alert alert-success thanks-success" role="alert" style="display: none;">
                                                <p>Thank you note has been shared successfully</p>
                                            </div>
                                            <form method="POST" id="thankNoteForm">
                                                <div class="form-group">
                                                    <label>Select Guests* <i class="fas fa-info-circle" data-toggle="tooltip" title="You can choose a perdefined template or you can create your own by choosing custom template option."></i></label>
                                                    @php $guests = $user_event->guests; @endphp
                                                    <select class="form-control select2" id="thanks-note-select" multiple="multiple" name="guest_ids[]">
                                                        @if(!empty($guests[0]->id))
                                                        @foreach($guests as $guest)
                                                        <option value="{{$guest->id}}">{{ $guest->fname }} {{ $guest->lname }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Select Template <i class="fas fa-info-circle" data-toggle="tooltip" title="Add your note here..."></i></label>
                                                    <select class="form-control" id="thanks-template" name="template">
                                                        <option value="">Custom Template</option>
                                                        @if(!empty($thanktemplates[0]->id))
                                                        @foreach($thanktemplates as $template)
                                                        <option value="{{$template->description}}">{{ $template->title }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Write A Note <i class="fas fa-info-circle" data-toggle="tooltip" title="Add a note for your guests."></i></label>
                                                    <textarea class="form-control" id="thank-note-area" name="note" placeholder="Type Here..."></textarea>
                                                </div>
                                                <button type="submit" id="thankNoteFormBtn" class="cstm-btn solid-btn">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <div class="season-review">
                                            <h4 class="sub-head">Share your Event Photos / Album</h4>
                                            <div class="cst-wrap-btn">
                                                <a href="{{ route('user.event.album', $user_event->slug) }}" class="cstm-btn solid-btn">
                                                    <span data-toggle="tooltip" title="You can share your event album"><i class="fas fa-upload"></i></span>
                                                </a>
                                                <a href="{{ route('user.event.videos', $user_event->slug) }}" class="cstm-btn solid-btn">
                                                    <span data-toggle="tooltip" title="You can share your event video"> <i class="fas fa-file-video"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="season-review">
                                            <h4 class="sub-head">Post a Testimonial</h4>
                                            <a href="javascript::void(0)" class="cstm-btn solid-btn" data-toggle="modal" data-target="#testimonial-modal">
                                                <span data-toggle="tooltip" title="You can post a testimonial"><i class="fas fa-file-image"></i></span>
                                            </a>
                                        </div>
                                        <div class="season-review">
                                            <div class="form-group">
                                                <h4 class="sub-head">Reviews</h4>
                                                <select class="form-control" id="select-review">
                                                    <option value="0">Select a Vendor</option>
                                                    @foreach($user_event->eventCategories as $category)
                                                    @if($category->getHiredVendor != null && $category->getHiredVendor->count() > 0)
                                                    <option value="{{$category->getHiredVendor->vendor->id}}">{{$category->getHiredVendor->vendor->title}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="cst-wrap-btn">
                                                <a href="javascript:void(0)" id="select-rev-anc" class="cstm-btn solid-btn">
                                                    <span data-toggle="tooltip" title="You can give the review"><i class="fas fa-star"></i></span>
                                                </a>
                                                @if(count( categoryOrders($category->eventCategory->id, $user_event->id) ) > 0)
                                                @php
                                                $order = categoryOrders($category->eventCategory->id, $user_event->id);
                                                @endphp
                                                @foreach ($order as $object)
                                                @php if(!empty(getPaymentGateway($object->vendor_id)))
                                                {
                                                $getpayment = getPaymentGateway($object->vendor_id); @endphp
                                                <a href="javascript:void(0)" id="select-vendor-tip" class="cstm-btn solid-btn">
                                                    <span data-toggle="tooltip" title="You can give the tip to Vendor"><i class="fas fa-hand-holding-usd"></i></span>
                                                    <a href="javascript:void(0);" hidden data-matched="t{{$category->getHiredVendor->vendor->id}}" data-vendor_id="{{$getpayment->id}}" data-stripe="{{$getpayment->stripe_account}}" class="cstm-btn solid-btn tip-submit-btn" data-toggle="modal" data-target="#vendor-tip"></a>
                                                    @php } @endphp
                                                    @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="cust-tool-review season-review">
                  <ul>
                      <li>
                        <h4 class="sub-head">Share your Event Photos/Album</h4>
                        <div class="cst-wrap-btn">
                            <a href="{{ route('user.event.album', $user_event->slug) }}" class="cstm-btn solid-btn">Upload  Album</a>
                            <a href="{{ route('user.event.videos', $user_event->slug) }}" class="cstm-btn solid-btn">Upload Videos</a>
                        </div>
                      </li>
                      <li>
                        <h4 class="sub-head">Post a Testimonial</h4>
                        <a href="javascript::void(0)" class="cstm-btn solid-btn" data-toggle="modal" data-target="#testimonial-modal">Post Testimonial</a>
                      </li>
                      <li>
                        <div class="form-group">
                          <h4 class="sub-head">Reviews</h4>
                          <select class="form-control" id="select-review">
                            <option value="0">Select a Vendor</option>
                            @foreach($user_event->eventCategories as $category)
                              @if($category->getHiredVendor != null && $category->getHiredVendor->count() > 0)           
                                <option value="{{$category->getHiredVendor->vendor->id}}">{{$category->getHiredVendor->vendor->title}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                        <a href="javascript:void(0)" id="select-rev-anc" class="cstm-btn solid-btn">Review</a>
                      </li>
                      
                  </ul>
                </div>
              </div> -->
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- ======================= -->
        @if(Auth::user()->id == $user_event->user_id || checkPermission('vendor_management', $user_event->id) == 1)
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-block">
                        <div class="event-card-head j-c-s-b">
                            <div class="event-card-head-new">
                                <button href="#collapse6" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                                <h3>Vendors Services you choose for your Event</h3>
                            </div>
                            <p class="bdgt-amout">Budget ${{$user_event->event_budget}}</p>
                        </div>
                        <div class="table-responsive" id="collapse6" style="display: flex;">
                            <table class="table event-table pending-done-status">
                                @foreach($user_event->eventCategories as $category)
                                <tr class="{{count( categoryOrders($category->eventCategory->id, $user_event->id) ) > 0 ? 'bg-success' : ''}}">
                                    <td><label>{{$category->eventCategory->label}} </label></td>
                                    <td><label>
                                            @if($category->getHiredVendor != null && $category->getHiredVendor->count() > 0)
                                            {{$category->getHiredVendor->vendor->title}}
                                            @else
                                            N/A
                                            @endif
                                        </label>
                                    </td>
                                    <td>
                                        <p class="hire-status">{{(count( categoryOrders($category->eventCategory->id, $user_event->id)) > 0) ? 'Hired' :'Not Hired'}}</p>
                                    </td>
                                    <td>
                                        @if(count( categoryOrders($category->eventCategory->id, $user_event->id) ) > 0)
                                        @php
                                        $order = categoryOrders($category->eventCategory->id, $user_event->id);
                                        @endphp
                                        @foreach ($order as $object)
                                        @php if(!empty(getPaymentGateway($object->vendor_id)))
                                        {
                                        $getpayment = getPaymentGateway($object->vendor_id);
                                        $disputeEventId = checkLatestEventID($object->id);
                                        if(empty($disputeEventId))
                                        {
                                        @endphp
                                        <a href="javascript:void(0);" data-vendorid="{{$getpayment->id}}" data-businessid="{{$object->vendor_id}}" data-event_orderid="{{$object->id}}" data-userid="{{$object->user_id}}" class="pending-status dispute-submit-btn" data-toggle="modal" data-target="#raise-dispute"><span data-toggle="tooltip" title="You can raise the dispute against Vendor"><i class="fas fa-gavel"></i></span></a>
                                        @php }elseif(!empty($disputeEventId) && $disputeEventId->dispute_status == 1){@endphp
                                        <a href="{{url(route('user.disputeDetail',$disputeEventId->id))}}" class="running-status dispute-submit-btn"><span data-toggle="tooltip" title="Dispute is going on against Vendor"><i class="fas fa-gavel"></i></span></a>
                                        @php }
                                        else{
                                        @endphp
                                        <a href="javascript:void(0);" data-vendorid="{{$getpayment->id}}" data-businessid="{{$object->vendor_id}}" data-event_orderid="{{$object->id}}" data-userid="{{$object->user_id}}" class="hire-status  dispute-submit-btn" style="pointer-events: none;cursor: default;"><span data-toggle="tooltip" title="Dispute is solved"><i class="fas fa-gavel"></i></span></a>
                                        @php 
                                         }
                                        } @endphp
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count( categoryOrders($category->eventCategory->id, $user_event->id) ) > 0)
                                        <span class="event-status color-green">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                        @else
                                        <span class="event-status color-red">
                                            <i class="fas fa-times-circle"></i>
                                        </span>
                                        @endif
                                    </td>
                                    @if(count( categoryOrders($category->eventCategory->id, $user_event->id) ) > 0)
                                    <td class="action-td">
                                        <a href="javascript:void(0);" data-url="{{url(route('getOrderDetailOfEvent',$user_event->id))}}?category_id={{$category->eventCategory->id}}" data-categoryID="{{$category->eventCategory->id}}" data-eventID="{{$category->eventCategory->id}}" data-title="Hired Vendor Detail for {{$category->eventCategory->label}} Service" class="action-btn detail-btn" data-toggle="tooltip" title="Hired Vendor Details"><i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                        $order = categoryOrders($category->eventCategory->id, $user_event->id);
                                        @endphp
                                        <a href="javascript:void(0);" data-match="t{{$category->getHiredVendor->vendor->id}}" data-vendor_cate_id="
                                {{$category->getHiredVendor->vendor->id}}" data-event_id="{{$user_event->id}}" data-event_order_id="{{$order[0]->id}}" class="action-btn review-submit-btn" data-toggle="modal" data-target="#star-review"><span data-toggle="tooltip" title="You can give the review"><i class="fas fa-star"></i></span>
                                        </a>
                                    </td>
                                    @else
                                    <td class="action-td"><a href="javascript:void(0);" class="action-btn" data-toggle="tooltip" title="Hired Vendor Details"><i class="fas fa-eye-slash"></i></a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($user_event_person))
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-block">
                        <div class="event-card-head j-c-s-b">
                            <div class="event-card-head-new">
                                <button href="#collapse61" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                                <h3>Event Team</h3>
                            </div>
                        </div>
                        <div class="table-responsive" id="collapse61" style="display: flex;">
                            <table class="table event-table pending-done-status">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Short Description</th>
                                </tr>
                                @foreach($user_event_person as $event_person)
                                <tr>
                                    <td><img src="{{url($event_person->image)}}" style="width: 120px;height: auto;"></td>
                                    <td>{{$event_person->name}}</td>
                                    <td>{{$event_person->title}}</td>
                                    <td>{{$event_person->short_desc}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if(Auth::user()->id == $user_event->user_id || checkPermission('vendor_management', $user_event->id) == 1)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="cstm-card-head">
                        <div class="event-card-head-new">
                            <button href="#collapse7" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h5 class="card-title">Recommended Vendors for {{$user_event->title}}</h5>
                        </div>
                    </div>
                    @foreach($user_event->eventCategories as $category)
                    <div class="recommended-vedors-wrap" id="collapse7" style="display: block;">
                        <!-- Accordian starts here -->
                        <div class="panel-group" id="accordionSingleOpen" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$category->id}}">
                                    <h4 class="panel-title">
                                        <div role="button" data-toggle="collapse" href="#collapseItemOpen{{$category->id}}" aria-expanded="true" aria-controls="collapseItemOpenOne" class="cst-acc collapsed">
                                            <div class="rec-card">
                                                <div class="view-cstom">
                                                    <h3 class="rec-heading">{{$category->eventCategory->label}}</h3>
                                                    <a href="{{ route('home_vendor_listing_page') }}?category_id={{$category->eventCategory->id}}" class="cstm-btn solid-btn">View All</a>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </h4>
                                </div>
                                <div id="collapseItemOpen{{$category->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$category->id}}">
                                    <div class="panel-body">
                                        <div class="row">
                                            @if(count($category->eventCategory->businesses) > 0)
                                                @foreach($category->eventCategory->businesses as $business)
                                                    @php
                                                    if(!empty(getBasicInfo($business->vendors->id, $business->category_id,'basic_information','cover_photo')))
                                                    {
                                                        $businessImage = url(getBasicInfo($business->vendors->id, $business->category_id,'basic_information','cover_photo'));
                                                    }else{
                                                        $businessImage = url("images/vendors/settings/default.png");
                                                    }
                                                    @endphp
                                                    <div class="col-lg-4">
                                                        <a href="{{ route('vendor_detail_page', ['catslug' => $category->eventCategory->slug, 'bslug' => $business->business_url]) }}" class="recommended-vedor" target="_blank">
                                                            <figure> <img src="{{ $businessImage }}" /></figure>
                                                            <div class="rec-detail">
                                                                <h3>{{ $business->title }}</h3>
                                                                <p>{{ getBasicInfo($business->vendors->id, $business->category_id,'basic_information','short_description') }}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-lg-12">
                                                    <h5>No Recommended Vendor</h5>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="cstm-card-head">
                        <div class="event-card-head-new">
                            <button href="#collapse8" class="nav-toggle cls-hide-show"><i class="fas fa-minus"></i></button>
                            <h5 class="card-title">Idea Tracker / Event Diary</h5>
                        </div>
                    </div>
                    <!-- open book sec -->
                    <div class="row" id="collapse8" style="display: flex;">
                        <div class="col-md-12">
                            <form method="Post" action="{{ route('eventExtraDetail', $user_event->slug) }}">
                                @csrf
                                <div class="open-book-wrap">
                                    <section class="open-book">
                                        <header>
                                            <h1>Eplame</h1>
                                            <h6>Eplame</h6>
                                        </header>
                                        <article>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="recommended-vedors-wrap idea-tracker">
                                                         <div class="rec-card">
                                                            <h3 class="rec-heading">Idea Tracker</h3>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class='form-group'>
                                                                        <label>Ideas*</label>
<textarea class='form-control  myTextEditor' id='ideas' name='ideas' rows='23' col='23'>{{ $user_event->ideas}}</textarea>                                                                
 {{--
             {{textarea($errors, 'Ideas*', 'ideas', $user_event->ideas)}}
 --}}
                                                                        <p class='error'></p>
                                                                    </div>
                                                                    <a href="javascript:void" class="turn">P.T.O</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="recommended-vedors-wrap event-tracker">
                                                        <div class="rec-card">
                                                            <h3 class="rec-heading">Event Diary</h3>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class='form-group'><label>Event Diary*</label><textarea class='form-control  myTextEditor' id='notepad' name='notepad' rows='23' col='23'>{{ $user_event->notepad }}</textarea>
                                                                        <p class='error'></p>
                                                                    </div>
                                                                    <a href="javascript:void" class="back-go">Go Back</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        <footer>
                                            <ol id="page-numbers">
                                                <li>1</li>
                                                <li>2</li>
                                            </ol>
                                        </footer>
                                    </section>
                                </div>
                                @if(Auth::user()->id == $user_event->user_id || checkPermission('event_management', $user_event->id) == 1)
                                <div class="card-footer w-100">
                                    <button type="submit" id="UserEventFormBtn" class="cstm-btn btn-css">Update</button>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <!-- Open book sec end here -->
                </div>
            </div>
        </div>
        @php $imagess = \App\Models\UserEventAlbum::where('type', '!=', 'video')->where('event_id',$user_event->id)->paginate(20); @endphp
        @if(!empty($imagess) && count($imagess) > 0)
        <div class="card">
            <div class="card-body">
                <div class="cstm-card-head">
                    <h5 class="card-title">Event Album</h5>
                </div>
                <section class="event_gallery-sec">
                    @foreach($imagess as $key => $img)
                    <img src="{{url($img->file_link)}}" width="100%">
                    @endforeach
                </section>
            </div>
        </div>
        <div class="lightbox">
            <div class="title"></div>
            <div class="filter"></div>
            <div class="arrowr"></div>
            <div class="arrowl"></div>
            <div class="close"></div>
        </div>
        @endif
    </div>
</section>
<!-- Modal -->
<div id="cat_Modal" class="modal fade unique-class" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
            </div>
        </div>
    </div>
</div>
@if(!empty($getpayment))
<div id="vendor-tip" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tip to Vendor</h4>
                <button type="button" class="close review-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-card-detail">
                            <ul class="nav nav-tabs" id="Payment-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="allevent-tab" data-toggle="tab" href="#allevent" role="tab" aria-controls="allevent" aria-selected="true" style="display: {{ $getpayment->stripe_account != ''? 'block' : 'none'  }}">Payment By Stripe</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="false" style="display: {{ $getpayment->paypal_account  != ''? 'block' : 'none' }}">Payment By Paypal</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="PaymentTabContent">
                                <div class="tab-pane fade active show" id="allevent" role="tabpanel" aria-labelledby="allevent-tab">
                                    <div id="paymentStripe" class="payment-type">
                                        <form role="form" action="{{ route('checkout.stripeorder') }}" method="POST" class="require-validation" data-cc-on-file="false" id="payment-form">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <p class="stripe-error py-3 text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 required">
                                                    <div class="form-group">
                                                        <label class="control-label">Name on Card</label>
                                                        <input type="text" class="form-control" required size="4">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 required">
                                                    <div class="form-group">
                                                        <label class="control-label">Card Number</label>
                                                        <input type="text" autocomplete='off' class="form-control card-number" required size="20">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 required">
                                                    <div class="form-group">
                                                        <label class='control-label'>CVC</label>
                                                        <input type="text" autocomplete="off" class="form-control card-cvc" required placeholder="ex. 311" size="4">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Expiration Month</label>
                                                        <input type="text" class="form-control card-expiry-month" required placeholder="MM" size="2">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class='control-label'>Expiration Year</label>
                                                        <input type="text" class="form-control card-expiry-year" required placeholder="YYYY" size="4">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group d-none">
                                                    <div class="alert-danger alert">
                                                        <h6 class="inp-error">Please correct the errors and try again.</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="vendor_id" id="vendor-id">
                                                    <input type="hidden" name="stripe" id="stripe">
                                                    <hr>
                                                    <input type="text" name="stipe_payment_btn" class="form-control" placeholder="Amount*"><br>
                                                    <button class="cstm-btn solid-btn" type="submit">Pay</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                                    <div id="paymentPaypal" class="payment-type">
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" id="expressCheckoutUrl" value="{{ route('checkout.expressCheckoutUser') }}">
                                            <input type="hidden" id="pay_vendor_id" name="pay_vendor_id" value="{{$getpayment->paypal_account}}">
                                            <input type="hidden" name="currency_code" value="USD">
                                            <input type="text" id="pay_amount" name="pay_amount" value="" class="form-control"><br>
                                            <button id="paypal_btn" type="submit" class="cstm-btn solid-btn">Pay by Paypal</button>
                                        </form>
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
<div id="raise-dispute" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Raise a Dispute</h4>
                <button type="button" class="close review-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="alert alert-success dispute-success" role="alert" style="display: none;">
                    <p>Dispute has been submitted Successfully!!</p>
                </div>
                <div class="alert alert-warning dispute-failed" role="alert" style="display: none;">
                    <p>Something went wrong</p>
                </div>
                <form id="raisedisputeForm" enctype="multipart/formdata">
                    @csrf
                    <input type="hidden" name="user_id" id="user-id">
                    <input type="hidden" name="vendor_id" id="vendorid">
                    <input type="hidden" name="business_id" id="business-id">
                    <input type="hidden" name="event_order_id" id="event-orderid">
                    <div class="form-group">
                        <label>Reason <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Reason of dispute."></i></label>
                        <select class="form-control" id="dis_reason" name="reason">
                            <option value="">Select a Reason*</option>
                            @foreach($dispute_reason as $dispute_reasons)
                            <option value="{{$dispute_reasons->id}}">{{$dispute_reasons->reasons}}</option>
                            @endforeach
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group" id="otherreason">
                        <label>Mention your Reason <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Reason of dispute."></i></label>
                        <textarea class="form-control" name="otherreason" placeholder="Write your dispute*"> </textarea>
                    </div>
                    <div class="form-group">
                        <label>Proposed Solution <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="You can propose a solution to the dispute."></i></label>
                        <textarea class="form-control" name="solution" id="solution" placeholder="Write your solution*"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Amount <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Amount."></i></label>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount*">
                    </div>
                    <div class="form-group">
                        <button class="cstm-btn solid-btn" id="disputeFormBtn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="cancel-event" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Vendor Policies</h4>
                <button type="button" class="close review-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="alert alert-success event-success" role="alert" style="display: none;">
                    <p>Event has been Cancelled Successfully!!</p>
                </div>
                <div class="alert alert-warning event-failed" role="alert" style="display: none;">
                    <p>Something went wrong</p>
                </div>
                <form id="cancelEventForm" enctype="multipart/formdata">
                    @csrf
                    <b>Please check the vendor's policies in business listing page before canceling the event.</b>
                    <br><br>
                    <b>Are you sure you still want to cancel the event ?</b>
                    <br> <br>
                    <input type="hidden" name="user_event_id" value="{{$user_event->id}}">
                    <div class="form-group">
                        <button class="cstm-btn solid-btn" data-dismiss="modal" type="button">No</button>
                        <button class="cstm-btn solid-btn" id="CanceEventFormBtn" type="submit">Yes</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="star-review" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Write a Review!</h4>
                <button type="button" class="close review-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
                <form id="reviewForm" enctype="multipart/formdata">
                    @csrf
                    <div class="form-group">
                        <label>Rating</label>
                        <div class="star-rating">
                            <input id="star-5" type="radio" name="rating" value="5" checked />
                            <label for="star-5" title="5 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-4" type="radio" name="rating" value="4" />
                            <label for="star-4" title="4 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-3" type="radio" name="rating" value="3" />
                            <label for="star-3" title="3 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-2" type="radio" name="rating" value="2" />
                            <label for="star-2" title="2 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-1" type="radio" name="rating" value="1" />
                            <label for="star-1" title="1 star">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title*">
                    </div>
                    <div class="form-group">
                        <div class="upload-custom">
                            <input type="file" name="image" accept="image/*">
                        </div>
                    </div>
                    <input type="hidden" name="event_id" id="event-id">
                    <input type="hidden" name="vendor_category_id" id="vendor-category-id">
                    <input type="hidden" name="order_id" id="order-id">
                    <div class="form-group">
                        <textarea class="form-control" name="reason" placeholder="Reason*"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="cstm-btn solid-btn" id="reviewFormBtn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="share-event" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Share Event</h4>
                <button type="button" class="close share-event-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="alert alert-success share-success" role="alert" style="display: none;">
                    <p>Event has been shared successfully</p>
                </div>
                <form id="shareEventForm">
                    @csrf
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="text" name="email" class="form-control" placeholder="Email Address...">
                    </div>
                    <input type="hidden" name="event_id" id="event-id" value="{{$user_event->id}}">
                    <div class="form-group">
                        <button class="cstm-btn solid-btn" id="shareEventFormBtn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="testimonial-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Post a Testimonial</h4>
                <button type="button" class="close testimonial-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="alert alert-success testimonial-success" role="alert" style="display: none;">
                    <p>Testimonial has been posted successfully</p>
                </div>
                <form id="testimonialForm">
                    @csrf
                    <div class="form-group">
                        <label>Testimonial Description* <i class="fas fa-info-circle" data-toggle="tooltip" title="After admin's approval it will be shown on the home page."></i></label>
                        <textarea class="form-control" name="summary" placeholder="Description*" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="cstm-btn solid-btn" id="testimonialFormBtn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="big-imge">
    <a href="javascript:void(0)" class="close style-close">X</a>
    <img src="">
</div>
@endsection
@section('scripts')

<script src="{{url('/js/weather-custom.js')}}"></script>
<script src="{{url('/js/comingsoon.js')}}"></script>
<script src="{{url('/js/weather-custom.js')}}"></script>
<script type="text/javascript">
$("#otherreason").hide();
$("#dis_reason").change(function() {
    var val = $("#dis_reason").val();
    if (val == "Other") {
        $("#otherreason").show();
    } else {
        $("#otherreason").hide();
    }
});
</script>
<script type="text/javascript">
CKEDITOR.replace('ideas');

// weather start
function getWeather(lat, long, time) {
    const weather_route = "{{ route('get_venue_weather') }}";
    const url = `${weather_route}?latitude=${lat}&longitude=${long}&time=${time}`;
    getSideBarWeatherData(url);
}

getWeather('{{$user_event->latitude}}', '{{$user_event->longitude}}', '{{date('
    Y - m - d ', strtotime($user_event->start_date))}}');

$('#seasonName').text(getSeasonSouthernHemisphere('{{date('
    Y - m - d ', strtotime($user_event->start_date))}}'));

$('#weatherDatePicker').change(function() {
    const date = $(this).val();
    $("body").find('.custom-loading').show();
    $('#seasonName').text(getSeasonSouthernHemisphere(date));
    getWeather('{{$user_event->latitude}}', '{{$user_event->longitude}}', date);
});
// weather end

function payments(paymentsData) {
    console.log('paymentsData ', paymentsData);

    let modal_data = '';
    for (var i = 0; i < paymentsData.length; i++) {

        modal_data += `<div class="order-booking-card">
   <div class="card-heading">
   <h3>Event Details</h3>
   </div>
   <div class="responsive-table">
   <table class="table table-striped order-list-table">
   <thead>
   <tr>
   <th>#</th>
   <th>Order Id</th>
   <th>Payment Type</th>
   <th>Price</th>
   </tr>
   </thead>
   <tbody>
   <tr>
   <td>1</td>
   <td>INVORD28</td>
   <td>paypal</td>
   <td>$556</td>
   </tr>
   </tbody>
   </table>
   </div>
   <div class="order-summary-wrap">
   <div class="row">
   <div class="col-lg-6">
   <div class="order-sum-card">
   <div class="billing-addres-detail">
   <h3 class="rec-heading">Billings Address</h3>
   
   <div class="billing-address-line">
   <p><span><i class="fas fa-user"></i></span>Narinder Singh</p>
   <p> <span> <i class="fas fa-map-marker-alt"></i> </span> sddsd, sdsdsd, Baretta, Punjab India wqewewe</p>
   <p> <span> <i class="fas fa-envelope"></i> </span> bajwa987647ss0491@gmail.com</p>
   <p><span><i class="fas fa-phone-volume"></i></span> 1212878777</p>
   <p></p> 
   </div>
   </div>
   </div>
   </div>
   
   <div class="col-lg-6">
   <div class="order-sum-card">
   <div class="billing-addres-detail">
   
   <div class="payment-sidebar cstm-sidebar">
   <h3 class="rec-heading">Payment Details</h3>
   <table id="payment-table" class="table payment-table">
   <tbody><tr>
   <th>
   Price
   <p>(Gold)</p>
   </th>
   <td>$1000</td>
   </tr>
   <tr>
   <th colspan="2">
   Addons 
   <ul class="mini-inn-table">
   <li><span class="labl"> Add On for two Large Portrait </span><span> $50 </span></li>     
   </ul>
   </th>
   </tr>
   <tr>
   <th>Tax</th>
   <td> $ 3</td>
   </tr>
   <tr>
   <th>Service Fee</th>
   <td>$ 3</td>
   </tr>
   <tr class="total-price-row">
   <th>Total Payable Amount</th>
   <td>$<span id="packagePrice">556</span></td>
   </tr>
   </tbody></table>
   <section class="content-header">
   <div class="row" id="suc_show" style="display: none;">
   <div class="col-md-12">
   <div class="alert alert-success">
   <strong>Success! </strong>
   <span id="res_mess"></span>
   </div>
   </div>
   </div>              
   <div class="row" id="err_show" style="display: none;">
   <div class="col-md-12">
   <div class="alert alert-danger">
   <strong>Error! </strong>
   <span id="err_mess"></span>
   </div>         
   </div>
   </div>
   </section>                
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>`;
        paymentsData[i]
    }
    $('#modal_body').html(modal_data);
}
</script>
<script>
var radius = '';
if (window.innerWidth < 767) {
    radius = '10em';
} else {
    radius = '10em'; //distance from center
}
var type = 1, //circle type - 1 whole, 0.5 half, 0.25 quarter
    start = -90, //shift start from 0
    $elements = $('.event-planning-navigation li:not(:first-child)'),
    numberOfElements = (type === 1) ? $elements.length : $elements.length - 1, //adj for even distro of elements when not full circle
    slice = 360 * type / numberOfElements;

$elements.each(function(i) {
    var $self = $(this),
        rotate = slice * i + start,
        rotateReverse = rotate * -1;

    $self.css({
        'transform': 'rotate(' + rotate + 'deg) translate(' + radius + ') rotate(' + rotateReverse + 'deg)'
    });
});





//###############################################################################################################


$("body").on('click', '.detail-btn', function(e) {
    e.preventDefault();
    var $this = $(this);
    getDetail($this);
});

//################################################################################################################


function getDetail($this) {

    var $model = $('#cat_Modal');
    var eventID = $this.attr('data-eventID');
    var categoryID = $this.attr('data-categoryID');
    var url = $this.attr('data-url');
    var title = $this.attr('data-title');
    $model.find('.modal-title').text(title);


    $.ajax({
        url: url,
        type: 'GET',
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        beforeSend: function() {
            $("body").find('.custom-loading').show();


        },
        success: function(result) {
            if (parseInt(result.status) == 1) {

                $model.find('#modal_body').html(result.htm);
                $model.modal('show');
                $("body").find('.custom-loading').hide();
            }

        },
        complete: function() {
            $("body").find('.custom-loading').hide();
        },
        error: function(jqXhr, textStatus, errorMessage) {

        }

    });
}

$('.review-submit-btn').click(function() {
    var order_id = $(this).data('event_order_id');
    var event_id = $(this).data('event_id');
    var vendor_category_id = $(this).data('vendor_cate_id');
    $('#reviewForm').find('#event-id').val(event_id);
    $('#reviewForm').find('#order-id').val(order_id);
    $('#reviewForm').find('#vendor-category-id').val(vendor_category_id);
});

$('.tip-submit-btn').click(function() {
    var vendor_id = $(this).data('vendor_id');
    var stripe_id = $(this).data('stripe');
    $('#payment-form').find('#vendor-id').val(vendor_id);
    $('#payment-form').find('#stripe').val(stripe_id);

});
$('.dispute-submit-btn').click(function() {

    var vendorid = $(this).data('vendorid');
    var user_id = $(this).data('userid');
    var business_id = $(this).data('businessid');
    var event_orderid = $(this).data('event_orderid');
    $('#raisedisputeForm').find('#vendorid').val(vendorid);
    $('#raisedisputeForm').find('#user-id').val(user_id);
    $('#raisedisputeForm').find('#business-id').val(business_id);
    $('#raisedisputeForm').find('#event-orderid').val(event_orderid);

});

$("#reviewForm").validate({
    rules: {
        rating: {
            required: true
        },
        title: {
            required: true,
            minlength: 2,
            maxlength: 30
        },
        reason: {
            required: true,
            minlength: 10,
            maxlength: 250
        }

    },
});

$('#reviewFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#reviewForm').valid()) {
        $('#reviewForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function reviewForm($this) {
    var form = $('body').find('#reviewForm')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    $.ajax({
        url: "<?= url(route('business.review.store')) ?>",
        method: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            $('.review-close').trigger("click");
            var thanks_url = "<?= url(route('review.thanks')) ?>";
            window.location.href = thanks_url;
        }
    });
}

$("body").on('submit', '#reviewForm', function(e) {
    e.preventDefault();
    reviewForm($(this));
});

$("#raisedisputeForm").validate({
    rules: {
        otherreason: {
            required: true
        },
        solution: {
            required: true,
            minlength: 5
        },
        reason: {
            required: true
        },
        amount: {
            required: true,
            digits: true
        },

    },
});
$('#disputeFormBtn').click(function() {
    $(this).attr('disabled', true);

    if ($('#raisedisputeForm').valid()) {

        $('#raisedisputeForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});
$('#raisedisputeForm').on('submit',(e)=>{
    e.preventDefault();
    raisedisputeForm(e);
})
function raisedisputeForm($this) {
    var form = $('body').find('#raisedisputeForm')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);

    $.ajax({
        url: "<?= url(route('business.dispute.store')) ?>",
        method: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data.status == '1') {
                $('.dispute-success').css('display', 'block').fadeIn().delay(3000).fadeOut();
                window.location.href = data.redirect_links;
                return true;

            } else {
                $('.dispute-failed').css('display', 'block').fadeIn().delay(3000).fadeOut();
            }

        }
    });
}


$('#CanceEventFormBtn').click(function() {
    $(this).attr('disabled', true);

    if ($('#cancelEventForm').valid()) {

        $('#cancelEventForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function cancelEventForm($this) {
    var form = $('body').find('#cancelEventForm')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);

    $.ajax({
        url: "<?= url(route('user.event.eventcancel')) ?>",
        method: "POST",
        data: formData,
        //dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data.status == '1') {
                $('.event-success').css('display', 'block').fadeIn().delay(3000).fadeOut();
                window.location.href = data.redirect_links;
                return true;

            } else {
                $('.event-failed').css('display', 'block').fadeIn().delay(3000).fadeOut();
            }

        }
    });
}
$("body").on('submit', '#cancelEventForm', function(e) {
    e.preventDefault();
    cancelEventForm($(this));
});

$('.cstm-share').click(function() {
    $('.ball').css('display', 'flex');
});

$("#shareEventForm").validate({
    rules: {
        email: {
            required: true,
            minlength: 2,
            maxlength: 200
        }
    },
});

$('#shareEventFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#shareEventForm').valid()) {
        $('#shareEventForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function shareEventForm($this) {
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

$("body").on('submit', '#shareEventForm', function(e) {
    e.preventDefault();
    shareEventForm($(this));
});

$("#select-rev-anc").click(function() {
    var id = $('#select-review').val();
    if (id > 0) {
        var test = $("a[data-match=t" + id + "]").trigger('click');
    }
});

$("#select-vendor-tip").click(function() {
    var id = $('#select-review').val();
    if (id > 0) {
        var test = $("a[data-matched=t" + id + "]").trigger('click');
    }
});

$("#testimonialForm").validate({
    rules: {
        summary: {
            required: true,
            minlength: 2,
            maxlength: 150
        }
    },
});

$('#testimonialFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#testimonialForm').valid()) {
        $('#testimonialForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function testimonialForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('user.testimonial.post')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.testimonial-success').css('display', 'block');
                location.reload();
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#testimonialForm', function(e) {
    e.preventDefault();
    testimonialForm($(this));
});

$('#thanks-note-select').select2({
    closeOnSelect: false
});

$("#thankNoteForm").validate({
    rules: {
        "guest_ids[]": {
            required: true
        },
        note: {
            maxlength: 250
        }
    },
});

$('#thankNoteFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#thankNoteForm').valid()) {
        $('#thankNoteForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function thankNoteForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('user.guest.thanks')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.thanks-success').css('display', 'block');
                location.reload();
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#thankNoteForm', function(e) {
    e.preventDefault();
    thankNoteForm($(this));
});
$("body").on('click', '#style-img1', function() {
    var src = $(this).find('img').attr('src');
    $('.big-imge').css('display', 'block');
    $('body').addClass('fixed');
    $('.big-imge').find('img').attr('src', src);
});
$('.style-close').click(function() {
    $('body').removeClass('fixed');
    $('.big-imge').css('display', 'none');
});

$(".turn").click(function() {
    setTimeout(function() {
        $('.open-book').addClass('turn-page');
    }, 1000);
    setTimeout(function() {
        $(".event-tracker").css('display', 'block');
        $(".idea-tracker").css('display', 'none');
    }, 1300);
});

$(".back-go").click(function() {
    setTimeout(function() {
        $('.open-book').removeClass('turn-page');
    }, 1300);
    setTimeout(function() {
        $(".event-tracker").css('display', 'none');
        $(".idea-tracker").css('display', 'block');
    }, 1000);
});

$("#coHostForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 2,
            maxlength: 40,
            lettersonly: true
        },
        email: {
            required: true,
            minlength: 2,
            maxlength: 50
        },
        relation: {
            required: true,
            minlength: 2,
            maxlength: 40
        }
    },
});

$('#coHostFormBtn').click(function() {
    $(this).attr('disabled', true);
    if ($('#coHostForm').valid()) {
        $('#coHostForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function coHostForm($this) {
    $('.custom-loading').css('display', 'block');
    $.ajax({
        url: "<?= url(route('cohost_invitation')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (data == 101) {
                $('.custom-loading').css('display', 'none');
                $('.cohost-success').css('display', 'block');
                $('.cohost-success').find('p').text('Invitation has been sent successfully.');
                location.reload();
            } else if (data == 102) {
                $('.custom-loading').css('display', 'none');
                $('.cohost-success').css('display', 'block');
                $('.cohost-success').find('p').text('You have already sent an invitation to this email.');
                $('#coHostFormBtn').attr('disabled', false);
            } else {
                alert('something went wrong');
            }
        }
    });
}

$("body").on('submit', '#coHostForm', function(e) {
    e.preventDefault();
    coHostForm($(this));
});

$('#coHostForm').click(function() {
    $(this).find('.cohost-success').css('display', 'none');
});

$('#thanks-template').change(function() {
    var val = $(this).val();
    $('#thank-note-area').val(val);
});

// tooltip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
// tooltip end
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]',
                'input[type=password]',
                'input[type=text]',
                'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('.inp-error'),
            valid = true;
        $errorMessage.addClass('d-none');
        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('d-none');
                e.preventDefault();
            }
        });

        if (!$form.data('cc-on-file')) {



            e.preventDefault();
            Stripe.setPublishableKey("<?php echo $stripe['pk']; ?>");
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }

    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.stripe-error').text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.nav-toggle').click(function() {
        //get collapse content selector
        var collapse_content_selector = $(this).attr('href');

        //make the collapse content to be shown or hide
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function() {
            if ($(this).css('display') == 'none') {
                //change the button label to be 'Show'
                toggle_switch.html('+');
            } else {
                //change the button label to be 'Hide'
                toggle_switch.html('<i class="fas fa-minus"></i>');
            }
        });
    });

});


getWeatherData()
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

function setForecast(forecast) {
    var today = forecast.daily.data[0];
    $("#sidebar-main-icon1").attr('src', `/dev/frontend/DarkSky-icons/SVG/${today.icon}.svg`);
    $("#sidebar-mainTemperature").text(toCelcius(forecast.currently.temperature) + '°C');
}

function getFormattedDate(date) {
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date * 1000).toLocaleDateString("en-US", options);
}
// Converts to Celcius
function toCelcius(val) {
  return Math.round((val - 32) * (5/9));
}
</script>
@endsection