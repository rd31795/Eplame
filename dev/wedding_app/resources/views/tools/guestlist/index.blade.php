@extends('layouts.home')
@section('title') Eplame|Guest  @endsection
@section('description') Eplame|Guest  @endsection
@section('keywords') Eplame|Guest  @endsection

@section('content')
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>{{$guest_list_title}}</h1>
            <p>{{$guest_list_tagline}}</p>
        </div>
    </div>
</section>
@include('tools.includes.navbar')
@if(Auth::user()->id == $user_event->user_id || checkPermission('guest_management', $user_event->id) == 1)
<!--Banner section Ends here-->
<section class="guest-list-sec">
    <div class="container">
        <div class="sec-card">
            <div class="sec-heading text-center color-dark">
                <h2>Guest List</h2>
            </div>
            <div class="row" id="stats-div"></div>
            <div class="guet-list-header d-f j-c-s-b mt-4">
                <div class="btn_list-grp d-f a-i-c">
                    <a href="javascript:void(0);" class="cstm-btn solid-btn mr-2" data-toggle="modal" data-target="#AddGuestGroup" id="addguestanc">+ Add guest</a>
                    <a href="javascript:void(0);" class="cstm-btn mr-2" data-toggle="modal" data-target="#MenuGuestGroup" style="display:none;" id="addmenuanc">+ Menu</a>
                    <a href="javascript:void(0);" class="cstm-btn mr-2" data-toggle="modal" data-target="#GuestGroup" id="addgroupanc">+ Group</a>
                    <!-- <a href="javascript:void(0);" class="cstm-btn solid-btn">Send message to guests</a> -->
                </div>
                <ul class="guest-list-search-box">
                    <li>
                        <div class="guest-list-search">
                            <input type="text" name="search-inputs" id="search-inputs" class="form-control" placeholder=" Here.." style="max-width: 300px;" value="" autocomplete="123" autofocus="nope"  />
                        </div>
                    </li>
                    <li>
                        <div class="event-task">
                            <div class="icons">
                                <a href="{{route('user.guestlist.getPDFBudget', $user_event->slug)}}">
                                    <i class="fas fa-file-download"></i>
                                </a>
                                <a href="{{route('user.guestlist.printFunction', $user_event->slug)}}">
                                    <i class="fas fa-print"></i>
                                </a>
                                 <a target="_blank" href="javascript:void(0)" title="Calculator" data-toggle="modal" data-target="#calculator_modal">
                                                 <i class="fas fa-calculator"></i>
                                              </a> 
                                @if($user_event->registration == 'yes')
                                <a class="cstm-share" href="javascript:void(0)">
                                    <i class="fas fa-share-alt"></i>
                                </a>
                                 <div class="todo-listing-wrap mt-4">
                                <ul class="social-icons event-share-icons mb-2 ball" style="margin-left: unset;">
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
                                
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="guest-list-tabbing-wrap mt-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active tab-anc" data-name="group" data-toggle="tab" href="#tabs-1" role="tab">Group</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-anc" data-name="attendance" data-toggle="tab" href="#tabs-2" role="tab">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-anc" data-name="menu" data-toggle="tab" href="#tabs-3" role="tab">Menus</a>
                    </li>

                    @php
                      $registration_type=App\RegistrationType::where('event_id',$user_event->id)->get();
                    @endphp
                    @if(count($registration_type)>0)
                    <li class="nav-item">
                        <a class="nav-link tab-anc" data-name="menu" data-toggle="tab" href="#tabs-4" role="tab">Registrations</a>
                    </li>
                    @endif
                </ul><!-- Tab panes -->
                <div class="tab-content p-0">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                    </div>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                    </div>
                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                    </div>
                    <div class="tab-pane" id="tabs-4" role="tabpanel">
                          @include('tools.includes.ticketpurchase')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Tabs Section starts here-->
<section class="how-its-work-sec tool-works">
    <div class="container">
        <div class="sec-heading text-center">
            <h2>{{$guest_list_video_title}}</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="video-container">
                    <figure>
                        <video class="video" id="bVideo" loop="" width="100%" height="100%" poster="{{ $guest_list_video_poster ? url('/uploads').'/'.$guest_list_video_poster : '/frontend/images/video-poster.png'}}">
                            <source src="{{ $guest_list_video ? url('/uploads').'/'.$guest_list_video : '/frontend/videos/Dummy Video.mp4' }}" type="video/mp4">
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
@else
<section class="services-tab-sec">
    <div class="container">
        <div class="sec-card">
            <div class="tab-wrap">
                You are not autorised to access this page.
            </div>
        </div>
    </div>
</section>
@endif
<!-- Modal starts here -->
<div class="modal fade" id="GuestGroup" tabindex="-1" role="dialog" aria-labelledby="GuestGroup">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Group</h4>
                <button type="button" id="GuestGroupClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="groupForm" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="form-label mb-2">Group Name</label>
                        <div class="input-wrap">
                            <input type="text" name="group_label" placeholder="Group" class="form-control">
                            <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                            <input type="hidden" name="event_id" value="{{$user_event->id}}" class="form-control">
                            <input type="hidden" id="hidden-group-id" name="group_id" class="form-control">
                        </div>
                    </div>
                    <div class="btn-wrap">
                        <button type="button" class="cstm-btn solid-btn " id="groupFormSubmit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Menu modal -->
<div class="modal fade" id="MenuGuestGroup" tabindex="-1" role="dialog" aria-labelledby="MenuGuestGroup">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Menu</h4>
                <button type="button" id="MenuGuestGroupClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="menuForm" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="form-label mb-2">Menu Name</label>
                        <div class="input-wrap">
                            <input type="text" name="menu_label" placeholder="Menu" class="form-control">
                            <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                            <input type="hidden" name="event_id" value="{{$user_event->id}}" class="form-control">
                            <input type="hidden" id="hidden-menu-id" name="menu_id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label mb-2">Description</label>
                        <div class="input-wrap">
                            <textarea class="form-control" id="menu_description" col="5" rows="5" placeholder="Menu Detail" name="menu_description"></textarea>
                            <!-- <span class="input-icon"><i class="fas fa-clipboard-list"></i></span> -->
                        </div>
                    </div>
                    <div class="btn-wrap">
                        <button type="button" class="cstm-btn solid-btn " id="menuFormSubmit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Guest Group modal -->
<div class="modal fade" id="AddGuestGroup" tabindex="-1" role="dialog" aria-labelledby="AddGuestGroup">
    <div class="modal-dialog" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Guests</h4>
                <button type="button" class="close" id="AddGuestGroupClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="add_guest_tabWrap">
                    <ul class="nav nav-tabs" id="galleryTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Guest-tabs-1" role="tab">Add new guest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Guest-tabs-2" role="tab">Import Guests</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="Guest-tabs-1" role="tabpanel">
                            <form id="guestForm" method="post" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">First Name</label>
                                            <div class="input-wrap">
                                                <input type="text" name="fname" placeholder="First Name" class="form-control">
                                                <input type="hidden" name="event_id" value="{{$user_event->id}}" class="form-control">
                                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Last Name</label>
                                            <div class="input-wrap">
                                                <input type="text" name="lname" placeholder="Last Name" class="form-control">
                                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Age</label>
                                            <div class="input-wrap">
                                                <input type="text" name="age" placeholder="Age" class="form-control">
                                                <input type="hidden" id="hidden-guest-id" name="guest_id" class="form-control">
                                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Gender</label>
                                            <div class="input-wrap">
                                                <select name="gender" id="gender-opt" class="form-control">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                <span class="input-icon"><i class="fas fa-chevron-down"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Group</label>
                                            <div class="input-wrap">
                                                <select name="group" id="group-opt" class="form-control">
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
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Menus</label>
                                            <div class="input-wrap">
                                                <select name="menu" id="menu-opt" class="form-control">
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
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Email<i class="fas fa-info-circle" data-toggle="tooltip" title="Guest will get an email having invite URL."></i></label>
                                            <div class="input-wrap">
                                                <input type="text" name="email" placeholder="Email" class="form-control">
                                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label mb-2">Contact Number<i class="fas fa-info-circle" data-toggle="tooltip" title="Guest will get an SMS having invite URL."></i></label>
                                            <div class="input-wrap">
                                                <input type="text" name="contact_no" placeholder="Contact Number" class="form-control">
                                                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrap">
                                    <button type="button" class="cstm-btn solid-btn " id="guestFormSubmit">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="Guest-tabs-2" role="tabpanel">
                            <div class="import_guest_card text-center">
                                <h3 class="mini-heading mb-3">Import guests</h3>
                                <h5>Easily organise and import your guest list using our template.</h5>
                                <div class="btn-wrap text-center mt-4">
                                    <a href="{{route('user.guestlist.downloadformat',['slug' => $user_event->slug, 'type' => 'xlsx'] ) }}" type="button" class="cstm-btn mb-2">Download Template</a> <br>
                                    <div class="import_file_btn">
                                        <form id="importForm" class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">
                                            @csrf
                                            <input type="file" id="selectedFile" name="import_file" style="display: none;" accept=".csv" />
                                            <div class="wrap-new">
                                                <input type="button" value="Browse..." onclick="document.getElementById('selectedFile').click();" />
                                                <span class="browse-text">
                                                    <p id="filename">No file chosen...</p>
                                                </span>
                                            </div>
                                            <!-- <input type="file" name="import_file" accept=".csv"/> -->
                                            <input type="hidden" name="event_id" value="{{$user_event->id}}" />
                                            <button type="button" id="importFormSubmit" class="cstm-btn solid-btn ">Import File</button>
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
                <form id="shareRegistrationEventForm" autocomplete="off">
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
@include('tools.checklist.includes.calculator')
@endsection
@section('scripts')
<script src='{{url("/")}}/frontend/js/circle-progress.min.js'></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
getstats();


function ComingGuest(el) {
    $(el).circleProgress({
            fill: { gradient: ["#f3bb4e", "#f4af59"] },
            startAngle: -Math.PI / 2,
            emptyFill: { color: "#fff" },
            reverse: true,
            emptyFill: 'transparent'
        })
        .on('circle-animation-progress', function(event, progress, stepValue) {
            $(this).find('.progress-value > span').text(Math.round(stepValue.toFixed(2).substr(1) * 100));
        });
};

function ComingGuestPercentage(el) {
    $(el).circleProgress({
            fill: { gradient: ["#f3bb4e", "#f4af59"] },
            startAngle: -Math.PI / 2,
            emptyFill: { color: "#fff" },
            reverse: true,
            emptyFill: 'transparent'
        })
        .on('circle-animation-progress', function(event, progress, stepValue) {
            $(this).find('.progress-value > span').text(Math.round(stepValue.toFixed(2).substr(1) * 100));
        });
};

function PendingGuest(el) {
    $(el).circleProgress({
            fill: { gradient: ["#f3bb4e", "#f4af59"] },
            startAngle: -Math.PI / 2,
            emptyFill: { color: "#fff" },
            reverse: true,
            emptyFill: 'transparent'
        })
        .on('circle-animation-progress', function(event, progress, stepValue) {
            $(this).find('.progress-value > span').text(Math.round(stepValue.toFixed(2).substr(1) * 100));
        });
};


function DeclinesGuest(el) {
    $(el).circleProgress({
            fill: { gradient: ["#f3bb4e", "#f4af59"] },
            startAngle: -Math.PI / 2,
            emptyFill: { color: "#fff" },
            emptyFill: 'transparent',
            reverse: true,
        })
        .on('circle-animation-progress', function(event, progress, stepValue) {
            $(this).find('.progress-value > span').text(Math.round(stepValue.toFixed(2).substr(1) * 100));
        });
};



function getgroups() {
    
    var event_id = "{{$user_event->id}}";
    var search_text = $('#search-input').val();
    $.ajax({
        url: "<?= url(route('user.event.getgroups')) ?>",
        data: {
            'event_id': event_id,
            'search_text': search_text
        },
        type: 'GET',
        dataTYPE: 'json',
        success: function(result) {
        
            if (parseInt(result.status) == 1) {
                $('#tabs-1').html(result.html);
            }
        }
    });
}

function getstats() {
    
    var event_id = "{{$user_event->id}}";
    $.ajax({
        url: "<?= url(route('user.event.getstats')) ?>",
        data: {
            'event_id': event_id
        },
        type: 'GET',
        dataTYPE: 'json',
        success: function(result) {
            if (parseInt(result.status) == 1) {
                $('#stats-div').html(result.html);
                ComingGuest('#ComingGuest');
                DeclinesGuest('#DeclinesGuest');
                PendingGuest('#PendingGuest');
                ComingGuestPercentage('#ComingGuestPercentage');
            }
        }
    });
}

function getmenus() {
    
    var event_id = "{{$user_event->id}}";
    var search_text = $('#search-input').val();
    $.ajax({
        url: "<?= url(route('user.event.getmenus')) ?>",
        data: {
            'event_id': event_id,
            'search_text': search_text
        },
        type: 'GET',
        dataTYPE: 'json',
        success: function(result) {
            if (parseInt(result.status) == 1) {
                $('#tabs-3').html(result.html);
            }
        }
    });
}

function getattedance() {
    
    var event_id = "{{$user_event->id}}";
    var search_text = $('#search-input').val();
    $.ajax({
        url: "<?= url(route('user.event.getattendance')) ?>",
        data: {
            'event_id': event_id,
            'search_text': search_text
        },
        type: 'GET',
        dataTYPE: 'json',
        success: function(result) {
            if (parseInt(result.status) == 1) {
                $('#tabs-2').html(result.html);
            }
        }
    });
}

getgroups();

$('.tab-anc').click(function() {
    
    var name = $(this).data('name');
    if (name == 'group') {
        $('#addgroupanc').css('display', 'block');
        $('#addmenuanc').css('display', 'none');
        getgroups();
    } else if (name == 'menu') {
        $('#addmenuanc').css('display', 'block');
        $('#addgroupanc').css('display', 'none');
        getmenus();
    } else if (name == 'attendance') {
        $('#addgroupanc').css('display', 'none');
        $('#addmenuanc').css('display', 'none');
        getattedance();
    }
});

$('#groupForm').validate({
    rules: {
        group_label: {
            required: true,
            minlength: 2,
            maxlength: 30
        }
    },
});

$('#groupFormSubmit').click(function() {
    
    $(this).attr('disabled', true);
    if ($('#groupForm').valid()) {
        $('#groupForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function groupForm($this) {
    
    $.ajax({
        url: "<?= url(route('ajax_addgroup')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (parseInt(data.status) == 1) {
                $('#group-opt').append('<option value="' + data.id + '">' + data.label + '</option>');
            } else if (parseInt(data.status) == 0) {
                $('#group-opt').find("option[value='" + data.id + "']").val(data.id);
                $('#group-opt').find("option[value='" + data.id + "']").text(data.label);
            }
            $('#groupFormSubmit').attr('disabled', false);
            $('#GuestGroupClose')[0].click();
            $('#groupForm')[0].reset();

            getgroups();
        }
    });
}

$("body").on('submit', '#groupForm', function(e) {
    
    e.preventDefault();
    groupForm($(this));
});

$('#menuForm').validate({
    rules: {
        menu_label: {
            required: true,
            minlength: 2,
            maxlength: 30
        },
        menu_description: {
            required: true,
            minlength: 2,
            maxlength: 150
        }
    },
});

$('#menuFormSubmit').click(function() {
    
    $(this).attr('disabled', true);
    if ($('#menuForm').valid()) {
        $('#menuForm').submit();
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function menuForm($this) {
    
    $.ajax({
        url: "<?= url(route('ajax_addmenu')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            if (parseInt(data.status) == 1) {
                $('#menu-opt').append('<option value="' + data.id + '">' + data.label + '</option>');
            } else if (parseInt(data.status) == 0) {
                $('#menu-opt').find("option[value='" + data.id + "']").val(data.id);
                $('#menu-opt').find("option[value='" + data.id + "']").text(data.label);
            }
            $('#menuFormSubmit').attr('disabled', false);
            $('#MenuGuestGroupClose')[0].click();
            $('#menuForm')[0].reset();
            getmenus();
        }
    });
}

$("body").on('submit', '#menuForm', function(e) {
    
    e.preventDefault();
    menuForm($(this));
});

$('#guestForm').validate({
    rules: {
        fname: {
            required: true,
            minlength: 2,
            maxlength: 30,
            lettersonly: true
        },
        lname: {
            required: true,
            minlength: 2,
            maxlength: 30,
            lettersonly: true
        },
        age: {
            required: true,
            minlength: 1,
            maxlength: 3,
            digits: true
        },
        gender: {
            required: true
        },
        group: {
            required: true
        },
        menu: {
            required: true
        },
        email: {
            required: true,
            email: true,
            minlength: 2,
            maxlength: 40,
        },
        contact_no: {
            required: true,
            minlength: 8,
            maxlength: 12,
            digits: true
        }
    },
});

$("body").on('click', '#guestFormSubmit', function() {
    
    $(this).attr('disabled', true);
    if ($('#guestForm').valid()) {
        $('#guestForm').submit();
        $('.custom-loading').css('display', 'block');
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function guestForm($this) {
    
    $.ajax({
        url: "<?= url(route('ajax_addguest')) ?>",
        data: $this.serialize(),
        type: 'POST', // http method
        dataTYPE: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val()
        },
        success: function(data) {
            $('.custom-loading').css('display', 'none');
            $('#guestFormSubmit').attr('disabled', false);
            $('#AddGuestGroupClose')[0].click();
            $('#guestForm')[0].reset();
            getattedance();
            getmenus();
            getgroups();
            getstats();
        }
    });
}

$("body").on('submit', '#guestForm', function(e) {
    
    e.preventDefault();
    guestForm($(this));
});

$("body").on('click', '.update-opt', function() {
    
    var $this = $(this);
    $.ajax({
        url: "<?= url(route('user.guest.ajax_updateAttMenu')) ?>",
        data: {
            'id': $this.data('id'),
            'value': $this.data('value'),
            'label': $this.data('label')
        },
        dataTYPE: 'json',
        success: function(result) {
            getmenus();
            getgroups();
            getattedance();
            getstats();
        }
    });
});

$("body").on('click', '.remove-opt', function() {
    
    var event_id = "{{$user_event->id}}";
    var $this = $(this);
    if ($this.data('label') == 'group') {
        $('#group-opt').find("option[value='" + $this.data('id') + "']").remove();
    } else if ($this.data('label') == 'menu') {
        $('#menu-opt').find("option[value='" + $this.data('id') + "']").remove();
    }
    $.ajax({
        url: "<?= url(route('user.ajax_removeGroupMenu')) ?>",
        data: {
            'id': $this.data('id'),
            'label': $this.data('label'),
            'event_id': event_id
        },
        dataTYPE: 'json',
        success: function(result) {
            getmenus();
            getgroups();
            getattedance();
            getstats();
        }
    });
});

$("body").on('click', '.group-edit', function() {
    
    $('#groupForm')[0].reset();
    $('#GuestGroup').find("input[name='group_id']").val($(this).data('id'));
    $('#GuestGroup').find("input[name='group_label']").val($(this).data('value'));
});

$("body").on('click', '.menu-edit', function() {
    
    $('#menuForm')[0].reset();
    $('#MenuGuestGroup').find("input[name='menu_id']").val($(this).data('id'));
    $('#MenuGuestGroup').find("input[name='menu_label']").val($(this).data('value'));
    $('#MenuGuestGroup').find("textarea#menu_description").val($(this).data('desription'));
});

$("body").on('click', '.guest-edit', function() {
    
    $('#guestForm')[0].reset();
    $('#AddGuestGroup').find("input[name='guest_id']").val($(this).data('id'));
    $('#AddGuestGroup').find("input[name='fname']").val($(this).data('fname'));
    $('#AddGuestGroup').find("input[name='lname']").val($(this).data('lname'));
    $('#AddGuestGroup').find("input[name='email']").val($(this).data('email'));
    $('#AddGuestGroup').find("input[name='contact_no']").val($(this).data('contact_no'));
    $('#AddGuestGroup').find("input[name='age']").val($(this).data('age'));
    $('select#gender-opt option[value="' + $(this).data('gender') + '"]').prop("selected", "true");
    $('select#group-opt option[value="' + $(this).data('group') + '"]').prop("selected", "true");
    $('select#menu-opt option[value="' + $(this).data('menu') + '"]').prop("selected", "true");
});


$('#importForm').validate({
    rules: {
        import_file: {
            required: true,
            extension: "csv"
        }
    },
});

$('#importFormSubmit').click(function() {
    
    $(this).attr('disabled', true);
    if ($('#importForm').valid()) {
        $('#importForm').submit();
        $('.custom-loading').css('display', 'block');
    } else {
        $(this).attr('disabled', false);
        return false;
    }
});

function importForm($this) {
    
    var form = $('#importForm')[0];
    var formData = new FormData(form);

    $.ajax({
        url: "{{ url(route('user.guestlist.importExcel')) }}",
        method: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,

        beforeSend: function() {


        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            return xhr;
        },
        success: function(data) {
            $('.custom-loading').css('display', 'none');
            $('#importFormSubmit').attr('disabled', false);
            $('#AddGuestGroupClose')[0].click();
            if (data.success == 1) {
                getmenus();
                getgroups();
                getattedance();
                getstats();
            } else {
                alert('Something Went Wrong. Please check your CSV and try again.');
            }
        }
    });
}

$("body").on('submit', '#importForm', function(e) {
    
    e.preventDefault();
    importForm($(this));
});

$('#addguestanc').click(function() {
    
    $('#guestForm')[0].reset();
    $('#hidden-guest-id').val("");
});

$('#addmenuanc').click(function() {
    
    $('#menuForm')[0].reset();
    $('#hidden-menu-id').val("");
});

$('#addgroupanc').click(function() {
    
    $('#groupForm')[0].reset();
    $('#hidden-group-id').val("");
});
$("body").on('click', '.toggle-check', function() {
    
    if ($('body').find('.toggle-check').is(':checked')) {
        $('body').find('#toggle-label').text("Only Allow RSVP Guests");
    } else {
        $('body').find('#toggle-label').text("Open Event");
    }
});

let keyIndex = 1; //comment:use to stop first time becoz of chrome autofil 
$('#search-inputs').on('input',function() {
    
    if(keyIndex != 1)
    {
        getmenus();
        getgroups();
        getattedance();

    }
    keyIndex = 0;
});

$('#selectedFile').change(function(e) {
    
    var val = e.target.files[0].name;
    if (val != '') {
        $('#filename').text(val);
    } else {
        $('#filename').text('No File Chosen...');
    }
});
</script>
<script type="text/javascript">
    $('.cstm-share').click(function() {
        
    $('.ball').css('display', 'flex');
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
        url: "<?= url(route('user.event.shareRegistration')) ?>",
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

    document.querySelectorAll(".commandstats").forEach((e)=>{
          commonstats(`#${e.id}`);
    });
    function commonstats(el){
 $(el).circleProgress({
            fill: { gradient: ["#f3bb4e", "#f4af59"] },
            startAngle: -Math.PI / 2,
            emptyFill: { color: "#fff" },
            reverse: true,
            emptyFill: 'transparent'
        })
        .on('circle-animation-progress', function(event, progress, stepValue) {
            $(this).find('.progress-value > span').text(Math.round(stepValue.toFixed(2).substr(1) * 100));
        });
}
</script>
@include('tools.checklist.includes.calculatorscript')
@endsection