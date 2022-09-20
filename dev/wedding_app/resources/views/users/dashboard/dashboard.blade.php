@extends('users.layouts.layout') @section('content')

<style type="text/css">
/*220421*/
.package__wrapper.card {
    width: 100%;
    text-align: center;
}
.package__wrapper.card .package_title {
    position: relative;
    padding-bottom: 80%;
}
.package__wrapper.card .package_title:before {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    background: #00000082;
    z-index: 9;
}
.package__wrapper.card .package_title h4 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50% , -50%);
    color: #fff;
    font-size: 20px;
    z-index: 9;
    font-weight: 600;
}
.package__wrapper.card .package_title img {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    object-fit: cover;
    height: 100%;
    width: 100%;
}
section.package-product-sec h5 {
    font-size: 25px;
    margin-bottom: 30px;
    font-weight: 600;
}
.package__wrapper-content>div {
    margin: 5px 0;
    /* background: #ededed; */
    padding: 4px 0;
    /* box-shadow: 0 0 4px rgb(0 0 0 / 42%); */
    /* border-radius: 6px; */
    /* border: 1px solid; */
    border-right: 0;
    border-left: 0;
}
.package__wrapper-content {
    padding: 15px;
}
.cs-slash {
    font-size: 22px;
    vertical-align: middle;
}
.stripe-button-el {
    display: none;
}
</style>

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">My Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0);">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


@php
$type_of_package=2;
@endphp
@if(request()->get('type')==2)
  @php
      $type_of_package=1;
  @endphp
@endif
<!-- featured category product start -->
<section class="package-product-sec">
    <div class="container">
        <div class="row mb-30">
            @php
            $packages=DB::table('purchase_package_product')->select('packages.*','purchase_package_product.id as purchase_package_id','purchase_package_product.status as purchase_package_status',DB::raw('CASE WHEN purchase_package_product.status=1 THEN 1 WHEN purchase_package_product.status=2 THEN 2 WHEN purchase_package_product.status=0 THEN 3 END as priority'),'purchase_package_product.start_date as package_purchase_date','purchase_package_product.expiry_date as package_expiry_date')-> join('packages','packages.id','=','purchase_package_product.package_id')->where('packages.type_of_package','=',$type_of_package)->where('user_id',Auth::id())->orderBy('priority','ASC')->get();
            @endphp
            <div class="col-md-12">
                @if(count($packages)>0)
                <h5>Packages Purchased By You</h5>
                @endif
            </div>
            @foreach($packages as $key=>$value)
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 d-flex">
                <div class="package__wrapper card">
                    <div class="">
                        <div class="package {{str_replace(' ','_',$value->title)}}">
                            <div class="package_title">
                                <img src="{{url('wedding_app/public/uploads')}}/{{$value->package_image}}" class="img-fluid" />
                                <h4>{{$value->title}}</h4>
                            </div>
                            <div class="package__wrapper-content">
                                <div class="package_summary">
                                    {!! $value->summary !!}
                                </div>
                                <div class="" style="font-weight: 700;">
                                      <p ><u>Purchase Date </u> <span style="font-size: 12px">{{Carbon\Carbon::parse($value->package_purchase_date)->format('Y-m-d')}}</span></p>
                                      <p> <u>Expiry Date </u>   <span style="font-size: 12px">{{Carbon\Carbon::parse($value->package_expiry_date)->format('Y-m-d')}}</span></p>
                                </div>
                                
                                <div class="package_type">
                                    @switch($value->purchase_package_status)
                                    @case(1)
                                    <span><button class="btn  btn-success">Active</button></span>
                                    @break
                                    @case(2)
                                    <span><a href="{{$type_of_package==2?route('activate_new_plan_event',$value->purchase_package_id):route('activate_new_plan',$value->purchase_package_id)}}" class="btn  btn-warning">Not Active</a></span>
                                    @break
                                    @case(0)
                                    <span><button class="btn  btn-danger">Validity Finished</button></span>
                                    @break
                                    @default
                                    <span>Something went wrong, please contact with administrator</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<hr>
<section class="package-product-sec">
    <div class="container">
          @php
            $packages=DB::table('packages')->where('packages.type_of_package','=',$type_of_package)->where('status',1)->orderBy('packages.price','Asc')->get();
            @endphp
        <div class="row">
            @if(count($packages)>0)
            <div class="col-md-12">
                <h5>Buy any Package and list your particular category product on top</h5>
            </div>
            @endif
            @foreach($packages as $key=>$value)
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 d-flex">
                <div class="package__wrapper card">
                    <div class="package {{str_replace(' ','_',$value->title)}}">
                        <div class="package_title">
                            <img src="{{url('wedding_app/public/uploads')}}/{{$value->package_image}}" class="img-fluid" />
                            <h4>{{$value->title}}</h4>
                        </div>
                        <div class="package__wrapper-content">
                            <div class="package_summary">
                                {!! $value->summary !!}
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="font-weight: 700;">
                                <div class="package-validity">
                                    <div class="package_validity">
                                        @switch($value->package_validity_type)
                                        @case(1)
                                        <span> {{$value->package_validity}} @if($value->package_validity==1) Day @else Days @endif</span>
                                        @break
                                        @case(2)
                                        <span> {{$value->package_validity}} @if($value->package_validity==1) Month @else Months @endif</span>
                                        @break
                                        @case(3)
                                        <span> {{$value->package_validity}} @if($value->package_validity==1) Year @else Years @endif</span>
                                        @break
                                        @default
                                        <span>Something went wrong, please try again</span>
                                        @endswitch
                                    </div>
                                </div>
                                <span class="cs-slash">&nbsp;/&nbsp;</span>
                                <div class="package_price">
                                     {{$value->price}}$
                                </div>
                            </div>
                            @if($type_of_package==1)
                            <div class="number_of_catgories">
                                <div class="caetgory_in_top">Any {{$value->category_count}} Category </div>
                            </div>
                            @endif
                            <div class="buy_package">
                                <form action="{{$type_of_package==2?url(route('featured_package_purchase_event',$value->id)):url(route('featured_package_purchase',$value->id))}}" method="POST">
                                    <?php 
  $stripe = SripeAccount();  ?>
                                    @csrf
                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button new-main-button" data-key="{{$stripe['pk']}}" data-amount="{{$value->price * 100}}" data-name="Envision" data-class="Envision" data-description="Shopping" data-email="{{Auth::user()->email}}" data-locale="auto" data-label="Buy Now">
                                    </script>
                                    <script>                        $(".stripe-button-el").hide();
    </script>
                                    <input type="hidden" name="price" value="{{$value->price}}">
                                    <button type="submit" class="btn btn-success">Buy Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>  
</section>

<section class="content">
    <div class="row">

        <!-- [ rating list ] end-->
        <div class="col-xl-12 col-md-12">
            <div class="content-main-wrap">
              <div class="card-heading">
                     <h3>Upcoming Events</h3>
                  </div>
                                
              <!--   Upcoming event -->
              @if(count($events) > 0)
                @foreach($events as $k => $event)     
                  @php  
                    $start_time = \Carbon\Carbon::now();  
                    $finish_time = \Carbon\Carbon::parse($event->end_date); 
                    $result = $start_time->diffInDays($finish_time, false);
                  @endphp

                @if($result > 0)                           
                <div class="card-media  mt-4 wow bounceInRight" data-wow-delay="{{100 * ($k + 0.5)}}ms">
                    <!-- media container -->
                    <div class="card-media-object-container">
                    	  <a href="{{$event->event == 0 ? route('user_show_detail_event', $event->slug) : route('show_virtual_hybrid_detail_event', $event->slug)}}">
                        <div class="card-media-object" style="background-image: url({{url($event->event_picture)}});">
                            <div class="date-ribbon">
                                <h2>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }}</h2>
                                <h1>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}</h1></div>
                        </div>
                    </a>


                        <span class="card-media-object-tag subtle {{ str_slug(EventCurrentStatus($event->start_date,$event->end_date)) }}"><?= EventCurrentStatus($event->start_date,$event->end_date) ?></span>
                    </div>
                    <!-- body container -->
                    <div class="card-media-body">
                        <div class="card-media-body-top">
                            <span class="subtle">
                                <strong>{{ ucfirst($event->title) }}</strong></br>
                                 {{ \Carbon\Carbon::parse($event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}</span>
                                 
                            <div class="card-media-body-top-icons u-float-right">
                                <div class="sm-countdown-wrap">
                                <ul class="count-down-timer">
                                    <input type="hidden" value="{{$event->start_date}}" id="start_date_{{$event->id}}" class="timerWatch" data-days="#days_{{$event->id}}" data-hours="#hours_{{$event->id}}" data-minutes="#minutes_{{$event->id}}" data-seconds="#seconds_{{$event->id}}" />
                                    <li><span id="days_{{$event->id}}"></span>days</li>
                                    <li><span id="hours_{{$event->id}}"></span>Hours</li>
                                    <li><span id="minutes_{{$event->id}}"></span>Minutes</li>
                                    <li><span id="seconds_{{$event->id}}"></span>Seconds</li>
                                </ul>
                            </div>

                            </div>
                        </div>
                        <span class="card-media-body-heading">{{ $event->description }}</span>

                        @if($event->registration == 'yes')
        <span class="badge badge-pill badge-primary">Registration Available</span>
      @endif
      @foreach($event->eventCategories as $loopingTags) <span class="badge badge-pill badge-primary">{{ $loopingTags->eventCategory->label }}</span> @if (!$loop->last)
        @endif @endforeach
                        <div class="card-media-body-supporting-bottom">
                            <span class="card-media-body-supporting-bottom-text subtle">{{ $event->location }}</span>
                            <span class="card-media-body-supporting-bottom-text subtle u-float-right">Event Budget &ndash; ${{ $event->event_budget }}</span>
                        </div>
                        <div class="card-media-body-supporting-bottom card-media-body-supporting-bottom-reveal">

                            <span class="card-media-body-supporting-bottom-text subtle ">
                            	{{--@foreach($event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last)
        , @endif @endforeach --}}

    </span>
                             @if($event->event == 0)
                            <a href="{{route('user_show_detail_event', $event->slug)}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
                             @else
                             <a href="{{route('show_virtual_hybrid_detail_event', $event->slug)}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
                            @endif
                        </div>
                    </div>
                </div>
                  @endif
                @endforeach
               @else
                  <div class="alert alert-info closer-step mb-3" role="alert">
                     <i class="fa fa-info-circle"></i> No Upcoming Events Found
                  </div>
               @endif

                <!-- ============================== -->

            </div>
        </div>

        {{ $events->links() }}

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

<input type="hidden" id="login_count" value="{{Auth::user()->login_count}}"> @endsection @section('scripts')
<script src="{{url('clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{url('/js/comingsoon.js')}}"></script>
<script src="{{url('/js/setLatLong.js')}}"></script>
<script src="{{url('/js/welcome_popup.js')}}"></script>
<script type="text/javascript">
    var login_count = $("body").find('#login_count').val();

    if (parseInt(login_count) == 0) {
        $('#firstUserModal').modal('show');
    }

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