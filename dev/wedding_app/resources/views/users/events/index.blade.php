@extends('users.layouts.layout')

@section('content')


<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-header-title">
<h5 class="m-b-10">My Events</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
<li class="breadcrumb-item "><a href="javascript:void(0);">Events</a></li>
</ul>
</div>

<div class="col-md-6">
<div class="btn-wrap text-right mb-3">
<!--<a href="{{ route('user_show_create_event') }}" class="cstm-btn">Create Event</a>-->
<!-- <a href="javascript::void(0)" id="create-event-btn" class="cstm-btn">Create Event</a> -->
<a href="{{ route('user_event_type') }}" class="cstm-btn">Create Event</a>
</div>
</div>

</div>
</div>
</div>
@include('admin.error_message')
<section class="content">
<div class="row">

<!-- [ rating list ] end-->
    <div class="col-xl-12 col-md-12 m-b-30">
    	<div class="content-main-wrap event-content">
        <div class="search-bar">
          <div class="form-group">
            <form action="{{ url(route('user_event','search')) }}">
              <input type="text" maxlength="50" name="search" class="form-control" placeholder="Search">
              <span><i class="fas fa-search"></i></span>
            </form>
          </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a href="{{url(route('user_events'))}}" class="nav-link  {{$status == 'all' ? 'active' : ''}} show">All Events</a>
            </li>
            <li class="nav-item">
                <a href="{{url(route('user_event','upcoming'))}}" class="nav-link {{$status == 'upcoming' ? 'active' : ''}}" id="upcoming-tab">Upcoming Events</a>
            </li>
            <li class="nav-item">
                <a href="{{url(route('user_event','ongoing'))}}" class="nav-link {{$status == 'ongoing' ? 'active' : ''}}" id="upcoming-tab">Ongoing Events</a>
            </li>
             <li class="nav-item">
                <a href="{{url(route('user_event','past'))}}" class="nav-link {{$status == 'past' ? 'active' : ''}}" id="expred-tab">Past Events</a>
            </li>
            <li class="nav-item">
                <a href="{{url(route('user_event','search'))}}?search=" class="nav-link {{$status == 'search' ? 'active' : ''}}" id="search-tab">Search</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="allevent" role="tabpanel" aria-labelledby="allevent-tab">
            
@if(count($events) > 0)              
@foreach($events as $k => $event)
  <div class="card-media  mt-4 wow bounceInRight" data-wow-delay="{{100 * ($k + 0.5)}}ms">
    <!-- media container -->
    <div class="card-media-object-container">
      <a href="{{$event->event == 0 ? route('user_show_detail_event', $event->slug) : route('show_virtual_hybrid_detail_event', $event->slug)}}">
      	@php 
      	  $event_picture=$event->event_picture !=''? $event->event_picture : '';
      	@endphp
      <div class="card-media-object" style="background-image: url('{{url($event_picture)}}');">
      	<div class="date-ribbon"><h2>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }}</h2> <h1>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}</h1></div>
      </div>
    </a>
      <span class="card-media-object-tag subtle {{ str_slug(EventCurrentStatus($event->start_date,$event->end_date)) }}">{{ EventCurrentStatus($event->start_date,$event->end_date)}}</span><br>
    </div>
    <!-- body container -->
    <div class="card-media-body">
      <div class="card-media-body-top">
        <span class="subtle">
          <strong>{{ ucfirst($event->title) }} </strong></br>
          
          {{ \Carbon\Carbon::parse($event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
        </span>
        <div class="right-cntnt">
        	@if($event->event == 0)
          <h6>In-person Event </h6>
          @elseif($event->event == 1)
           <h6>Virtual Event </h6>
          @else
           <h6>Hybrid Event </h6>
           @endif
        </div>
        
      </div>
      <span class="card-media-body-heading">{{ $event->description }}</span>

      @if($event->registration == 'yes')
        <span class="badge badge-pill badge-primary">Registration Available</span>
      @endif
      <div class="event_tags_badge">
      @foreach($event->eventCategories as $loopingTags) <span class="badge badge-pill badge-primary">{{ $loopingTags->eventCategory->label }}</span> @if (!$loop->last)
        @endif @endforeach
      </div>
      
      <div class="card-media-body-supporting-bottom">
        <span class="card-media-body-supporting-bottom-text subtle">{{ $event->location }}</span>
        @if($event->event == 0)
        <span class="card-media-body-supporting-bottom-text subtle u-float-right">Event Budget &ndash; ${{ $event->event_budget }}</span>
        @endif
      </div>
      <div class="card-media-body-supporting-bottom card-media-body-supporting-bottom-reveal">
        <span class="card-media-body-supporting-bottom-text subtle ">{{--@foreach($event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last)
        , @endif @endforeach--}}</span>
        @if($event->event == 0)
        <a href="{{route('user_show_detail_event', $event->slug)}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
        @else
         <a href="{{route('show_virtual_hybrid_detail_event', $event->slug)}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
        @endif
      </div>
    </div>
  </div>
@endforeach
@else
<div class="alert alert-info closer-step mb-3 mt-4" role="alert">
  <i class="fa fa-info-circle"></i> No Events Found
</div>
@endif

            </div>
        </div>
        {{ $events->links() }}
    </div>
  </div>

</div>

<!-- /.row -->

</section>

<!-- First User Modal -->
<div class="modal fade" id="firstUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-5">
                        <figure class="about-event-img">
                            <img src="{{ asset('/frontend/images/event-form-img.png') }}">
                            <div class="form-img-cont text-center">
                                <h2 class="modal-title">CONGRATULATIONS</h2>
                                <p>Let’s Help Plan Your Event <br> we are always a step ahead</p>
                            </div>
                        </figure>
                    </div>
                    <div class="col-lg-7">
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

            </div>
        </div>
    </div>
</div>


<input type="hidden" id="login_count" value="{{Auth::user()->login_count}}">
@endsection
@section('scripts')
<style>
strong.eventType {
    color: #35486b;
    font-size: 14px;
    font-weight: 900;
}
</style>
<script src="{{url('clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{url('/js/comingsoon.js')}}"></script>
<script src="{{url('/js/setLatLong.js')}}"></script>
<script src="{{url('/js/welcome_popup.js')}}"></script>
<script src="{{ asset('/js/userEventColor.js') }}"></script>
<script>
  $('#create-event-btn').click(function(){
    $('#firstUserModal').modal('show');
  });
  $(document).ready(function(){
var styval = $('#style_type').val();
if(styval == 0){
    $('#style-field-1').css('display', 'block');
    $('#style-field-3').css('display', 'block');
  }else{
    $('#style-field-1').css('display', 'none');
    $('#style-field-3').css('display', 'none');
  }
});


$('#style_type').change(function(){
  var val = $(this).val();
  if(val == 0){
    $('#style-field-1').css('display', 'block');
    $('#style-field-3').css('display', 'block');
  }else{
    $('#style-field-1').css('display', 'none');
    $('#style-field-3').css('display', 'none');
  }
});
</script>

@endsection


