<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
<link rel="stylesheet" href="{{url('js/lightbox.css')}}" />
@extends('layouts.home')
@section('content')
@endsection
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>{{$user->name}}</h1>
        </div>
    </div>
</section>
<!--Banner section Ends here-->
<section class="services-tab-sec">
    <div class="container">
        <div class="sec-card">
        <div class="rec-disscussion-sec">
        <div class="rcent_discription">
            <figure>
                @if(!empty($user->profile_image))
                    <img src="{{asset('').'/'.$user->profile_image}}">
                @else
                    <img src="{{url('/')}}/images/faceless.jpg">
                @endif
            </figure>
            <div class="user-text-info">
                <h3>{{ $user->name }}</h3>
                <!-- <p>lorem dollor sit amet</p> -->
                <div class="custm-btn-wrap">
                    <?php 
                        $request_status = 0;
                        $request_status = getRequestStatus($user->id);
                    ?>
                    @if(Auth::user())
                        @if(!(Auth::user()->id == $user->id))
                            @if($request_status == 0)
                                <a data-reciever_id="{{$user->id}}" href="javascript:void(0);" class="cstm-btn add_friend">
                                    <i class="fas fa-user"></i> Add Friend
                                </a>
                            @elseif($request_status == 2)
                                <a href="javascript:void(0);" class="cstm-btn">
                                    <i class="fas fa-check"></i> Friend Request Sent
                                </a>
                                <a data-reciever_id="{{$user->id}}" href="javascript:void(0);" class="cstm-btn cancel_friend">
                                    <i class="fas fa-window-close"></i> Cancel Request
                                </a>
                            @elseif($request_status == 1)
                                <a href="javascript:void(0);" class="cstm-btn">
                                    <i class="fas fa-check"></i> Friend
                                </a>
                                <a data-other_user_id="{{$user->id}}" href="javascript:void(0);" class="cstm-btn remove_friend">
                                    <i class="fas fa-user-slash"></i> Remove Friend
                                </a>
                            @endif
                            <a href="javascript:void(0);" class="cstm-btn solid-btn">
                               <i class="fas fa-envelope"></i> Message
                            </a>

                           

                        @endif
                    @endif
                </div>
            </div>
        </div>

        <ul class="cst-tabs-nav border-top pl20 flex">
            <li class="navbar-tab current app-mirror-link pointer mr5">
                <a class="navbar-tab-item" href="">
                    All            </a>
            </li>
            <li class="navbar-tab app-mirror-link pointer mr5">
                <a class="navbar-tab-item" href="{{ route('forum.user.discussions', $user->id) }}">
            Discussions                </a>
                <small class="navbar-tab-item-count count notablet">{{ count($user->discussions) }}</small>
            </li>
            <li class="navbar-tab app-mirror-link pointer mr5">
                <a class="navbar-tab-item" rel="nofollow" href="{{ route('forum.user.photos', $user->id) }}">
                Photos                </a>
                <small class="navbar-tab-item-count count notablet">{{ count($user->discussionfiles) }}</small>
            </li>
            <li class="navbar-tab app-mirror-link pointer mr5">
                <a class="navbar-tab-item" rel="nofollow" href="{{ route('forum.user.videos', $user->id) }}">
                Videos                </a>
                <small class="navbar-tab-item-count count notablet">{{ count($user->discussionvideos) }}</small>
            </li>
            <li class="navbar-tab app-mirror-link pointer">
                <a class="navbar-tab-item" rel="nofollow" href="{{ route('forum.user.friends', $user->id) }}">
                    Friends                </a>
                <small class="navbar-tab-item-count count notablet">{{ countFriends($user->id) }}</small>
            </li> 

            <li class="navbar-tab app-mirror-link pointer">
                <a class="navbar-tab-item" rel="nofollow" href="{{ route('forum.user.events', $user->id) }}">
                    Events</a>
                <small class="navbar-tab-item-count count notablet">{{ $myEventCount = $user->PastEvents(1)}}</small>
            </li> 
        </ul>

   <div class="row">
        <div class="col-lg-12">
            <div class="rec-dis-header">
                











<div class="pcoded-content p-0">
<div class="main-header" style="background-image: url({{ asset('images/event-bg.jpg') }}">
<div class="main-header__intro-wrapper">
<div class="main-header__welcome">
<!-- <div class="main-header__welcome-title text-light">Welcome, {{ $user->first_name }}<strong></strong></div>
<div class="main-header__welcome-subtitle text-light">How are you today?</div> -->
</div>
<div class="quickview">
<div class="quickview__item">
<div class="quickview__item-total">{{ $user->UpcomingEvents->count() }}</div>
<div class="quickview__item-description">
<i class="far fa-calendar-alt"></i>
<span class="text-light">Events</span>
</div>
</div>
<!-- <div class="quickview__item">
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
       
        @php $eventStatus = EventCurrentStatus($user_event->start_date,$user_event->end_date) @endphp
         @if($user_event->start_date < date('Y-m-d'))        
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
           <!-- <div class="tags has-addons">
              <span class="tag is-light">Status:</span>
              <span class="tag is-delivered">{{ $eventStatus }}</span>
           </div> -->
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
               <div class="event-card-head j-c-s-b ">
                 
                  <!-- Shared Event Icon Html -->
                <div class="row">
                    <div class="col-md-6">
                 
                  <h3 class="evt-title">{{ ucfirst($user_event->title) }}</h3>
                       <span class="evt-date">{{ \Carbon\Carbon::parse($user_event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($user_event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($user_event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($user_event->start_time)->format('g:i A') }}</span>
                       <div class="evnt-full-detail">
                         <p>{{ $user_event->long_description }}</p>
                         </div>
                          <ul class="social-icons event-share-icons">
                    <li>
                       <a target="_blank" href="<?= \Share::load(url()->full(),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->facebook() ?>">
                       <img src="https://yauzer.com/images/icon-fb.png" alt="Facebook">
                    </a>
                   </li>
                    <li>
                       <a target="_blank" href="<?= \Share::load(url()->full(),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->twitter() ?>">
                          <img src="https://yauzer.com/images/icon-twitter.png" alt="Twitter">
                       </a>
                    </li>
                    <li>
                       <a target="_blank" href="<?= \Share::load(url()->full(),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->gplus() ?>">
                          <img src="https://yauzer.com/images/icon-gplus.png" alt="Google Plus">
                       </a>
                    </li>
                    <li>
                       <a target="_blank" href="<?= \Share::load(url()->full(),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->linkedin() ?>">
                          <img src="https://yauzer.com/images/linkedin-icon.png" alt="Linkedin">
                       </a>
                    </li>
                    <li>
                       <a target="_blank" href="<?= \Share::load(url()->full(),'Check out '.$user_event->title.' on Envisiun User Please check it ASAP.')->pinterest() ?>">
                          <img src="https://yauzer.com/images/icon-Pinterest.png" alt="Pinterest">
                       </a>
                    </li>
                  </ul>

                  </div>
                  <div class="col-md-6">                      

               <div class="row  cstm-flex-row">
                 <div class="col-lg-12">
                   <div class="event-detail-full-dec">

                         <ul class="evt-more-dec mt-0">
                         <li><p><span class="icon"><i class="fas fa-map-marker-alt"></i></span>{{ $user_event->location }}</p></li>
                         <li><p class="evt-more-deatil"> <span class="icon"><i class="fas fa-tags"></i></span> @foreach($user_event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last), @endif @endforeach</p></li>
                         
                       </ul>
                       
                   </div>
                 </div>
                  
               </div>

                  </div>
              </div>
                  <!-- Shared Event Icon Html End -->
               </div>
 
            </div>
         </div>
      </div>






<!-- ======================= -->
      <div class="col-lg-12 mb-30">
         <div class="card">
            <hr class="hr-break">
            <div class="card-block">
               <div class="event-card-head j-c-s-b">
                  <h3>Vendors Services</h3>                  
                 </div> 

 @foreach($user_event->eventCategories as $category)
 @if($category->getHiredVendor != null && $category->getHiredVendor->count() > 0)
 
<?php
$cate = $category->getHiredVendor->vendor;
$facebook_url = getBasicInfo($cate->vendors->id, $cate->category_id, 'basic_information', 'facebook_url');
$linkedin_url = getBasicInfo($cate->vendors->id, $cate->category_id, 'basic_information', 'linkedin_url');
$twitter_url =  getBasicInfo($cate->vendors->id, $cate->category_id, 'basic_information', 'twitter_url');
$instagram_url = getBasicInfo($cate->vendors->id, $cate->category_id, 'basic_information', 'instagram_url');
$pinterest_url = getBasicInfo($cate->vendors->id, $cate->category_id, 'basic_information', 'pinterest_url');

$followus = empty($facebook_url) && empty($linkedin_url) && empty($twitter_url) && empty($instagram_url) && empty($pinterest_url) ? 'hide' : '';
?>

<?php //$businesses = \App\VendorCategory::whereIn('id', $ids); ?>

                           
                            <div class="detail-in-breif aos-init aos-animate" data-aos="fade-left" data-aos-duration="2000">
                                <div class="row">
                                    <div class="col-lg-4">
                                        
                                        <div class="custom-left-content">

                                           @if($cate->category && $cate->category->cover_type == 1)

                                            <img src="{{url(getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','cover_photo'))}}">

                                           
                                           @else

                                                <div class="video-container custom-video-container">
                                                     <a href="javascript:void(0);" class="play-btn" 
                                                         data-toggle="modal"
                                                         data-video="{{url(getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','cover_video'))}}"
                                                         data-target="Video-Modal-relation-{{$cate->id}}">
                                                           <span><i class="far fa-play-circle"></i></span>
                                                        </a>

                                                       <img src="{{url(getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','cover_video_image'))}}" draggable="false" class="Video-Modal-relation-{{$cate->id}}">

                                                      <div class="video-screen" id="Video-Modal-relation-{{$cate->id}}">
                                                                
                                                      </div>
                                              </div>


                                           @endif

 
                                      </div>
                                         
                                    
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="right-content">
                                          <div class="listing-head">
                                    <a href="{{url( route('vendor_detail_page',[$cate->category->slug, $cate->business_url]))}}"> <h4 class="padding-rt">{{getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','business_name')}}</h4></a>
                                           
                                           <ul class="listing-action-btns">
                                             @if(Auth::check() && Auth::User()->role == 'user')
                                             <li><a id="fav_vendor_{{$cate->id}}" href="javascript:void(0)" data-url="{{ route('user_add_favourite_vendors', $cate->id) }}" class="list-icon-btn {{ fav_vendor($cate->id) }}"><i class="fa_heart fas fa-heart"></i></a>
                                             </li>
                                             @endif

                                             <li><a href="tel:{{getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','phone_number')}}" class="list-icon-btn"><i class="fas fa-phone-alt"></i></a></li>
                                           </ul>

                                   <p class="ser-text"> {{$cate->category->label}}</p>
 

                                            <ul class="rating">
                                                <li class="price-detail-wrap">
                                                  <div class="price-review-detail"><p>Starting From:</p> <span> ${{custom_format(getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','min_price'),2)}} for {{getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','min_guest')}} <i class="fa fa-users"></i> </span>
                                                  </div>
                                                </li>
                                                <li>
                                                  @php $avg = getAvgRating($cate->category_id); @endphp
                                                <ul class="inner-list">
                                                  <div class="Stars listing-stars" style="--rating: {{$avg}};" aria-label="Rating of this product is {{$avg}} out of 5."></div>
                                                </ul>
                                              </li>
                                                <li>
                                                    <p class="review">{{getReviewCount($cate->category_id)}} Reviews</p>
                                                </li>
                                               
                                            </ul>
                                          </div>

                                            <ul class="sitting-capacity">
                                               @if($cate->category->capacity == 1)
                                                 <li>
                                                  <p class=""><i class="fa fa-users"></i> <?= $cate->sitting_capacity > 0 ? 'Sitting Capacity <b>'.$cate->sitting_capacity.'</b>' : ''?> </p></li>

                                                  <li>
                                                    <p><?= $cate->standing_capacity > 0 ? 'Standing Capacity<b>'.$cate->standing_capacity.'</b>' : ''?></p>
                                                 </li>
                                                @endif
                                            </ul>
                                            <hr>

                                            <p class="detail">
                                                <?php $description = getBasicInfo($cate->vendors->id, $cate->category_id,'basic_information','short_description'); ?>
                                               {{substr($description,0,100)}} {{strlen($description) > 100 ? '...' : ''}}
                                            </p>
                                            <ul class="social-links listing-social {{$followus}}">
                                              <li><p>Follow us:</p></li>

                                              <li class="{{empty($facebook_url) ? 'hide' : ''}}">
                                                <a href="<?= $facebook_url ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                              </li>
                                              <li class="{{empty($linkedin_url)? 'hide' : ''}}">
                                                <a href="<?= $linkedin_url ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                              </li>
                                              <li class="{{empty($twitter_url) ? 'hide' : ''}}">
                                                <a href="<?= $twitter_url ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                              </li>
                                              <li class="{{empty($instagram_url) ? 'hide' : ''}}">
                                                <a href="<?= $instagram_url ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                              </li>
                                              <li class="{{empty($pinterest_url) ? 'hide' : ''}}">
                                                <a href="<?= $pinterest_url ?>" target="_blank"><i class="fab fa-pinterest"></i></a>
                                              </li>
                                            </ul>

                                            <a href="javascript:void(0);" class="cstm-btn solid-btn detail-btn"><i class="fa fa-comment-dots"></i> Chat</a>
                                            <a href="{{url( route('vendor_detail_page',[$cate->category->slug, $cate->business_url]))}}"
                                             class="cstm-btn solid-btn detail-btn getQuote3"
                                             data-id="{{$cate->id}}">Request A Qoute</a>

                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-break">
                           
 @endif
 @endforeach

</div>

                      </div>


 
                
           </div>
       

 













      <div class="col-lg-12 mb-30">
         <div class="card">
            <div class="card-block">
               <div class="event-card-head">
                  <h3>Event Theme</h3>
               </div>
               <div class="row">

                  
            <!-- weather section -->
            <div class="col-md-6" id="sidebar-weather" style="display: block;">
            
            <div class="evt-theme-card bs mt-4 wow bounceInLeft" data-wow-delay="500ms" style="background-image: url({{ asset('frontend/images/weather.png') }})">
                      <div class="evt-theme-body">
                        <div class="form-group mb-0">
            <input type="hidden" min="{{date('Y-m-d', strtotime($user_event->start_date))}}" max="{{date('Y-m-d', strtotime($user_event->end_date))}}" value="{{date('Y-m-d', strtotime($user_event->start_date))}}" class="form-control" id="weatherDatePicker" placeholder="select date">
            </div>
            <div class="weather-mini-card mt-2">
              <div class="weather-info">
                <div class="weather-info-wrapper">
                  <div class="info-date">
                    <h1 id="sidebar-localTime"></h1>
                    <h5><span id="sidebar-localDate"></span></h5>
                  </div>                  
                  <div class="info-weather">
                    <div class="weather-wrapper">
                      <span class="weather-temperature" id="sidebar-mainTemperature"></span>
                      <div class="weather-sunny"><img id="sidebar-main-icon" src="{{ asset('/dev/frontend/DarkSky-icons/SVG/clear-day.svg') }}"></div>
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
            

                  <div class="col-md-6">
                     <div class="evt-theme-card bs mt-4 wow bounceInRight animated" data-wow-delay="800ms" style="background-image: url({{ asset('images/event-theme-bg-2.jpg') }})">
                      <div class="evt-theme-body">
                        @php $colours = (array)json_decode($user_event->colour); @endphp
                        <div class="title">Event Theme Color</div>
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
      <div class="col-md-12">
          @php $videos = \App\Models\UserEventAlbum::where('event_id',$user_event->id)->where('type', 'video')->paginate(20);  @endphp
          <h3>Event Videos</h3>
      </div>

      <section class="event_gallery-sec">
        @if(!empty($videos) && count($videos) > 0)
          @foreach($videos as $key => $video)
            <iframe width="300" height="300" src="{{$video->file_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
          @endforeach
        @endif
      </section>
      
      <div class="col-md-12">
          @php $imagess = \App\Models\UserEventAlbum::where('event_id',$user_event->id)->where('type', '!=', 'video')->paginate(20);  @endphp
          <h3>Event Album</h3>
      </div>
      <section class="event_gallery-sec">
        @if(!empty($imagess) && count($imagess) > 0)
           @foreach($imagess as $key => $img)
            <img src="{{url($img->file_link)}}" width="100%">    
            @endforeach
      </section>

 
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


























                  
          
        <div class="col-lg-4" style="display: none;">
            <div class="rec-sidebar">
                <div class="sidebar_heading">
                    <h3>User's Groups</h3>
                </div>
                <ul class="rec-side-nav">
                    @if(!empty($user_groups[0]->id))
                    @foreach($user_groups as $group)
                    <li><a href="{{ route('forum.group.detail', $group->memberGroupId->slug) }}" class="nav_link">
                            <figure><img src="{{url('/')}}/wedding_app/public/uploads/{{$group->memberGroupId->thumbnail}}"></figure>{{ $group->memberGroupId->label }}
                        </a></li>
                    @endforeach
                    @else
                        <li>No Groups Available</li>
                    @endif
                </ul>
            </div>
            <div class="sidebar_heading">
                    <h3>Groups</h3>
                </div>
                <ul class="rec-side-nav">
                    @if(!empty($groups[0]->id))
                    @foreach($groups as $group)
                    <li><a href="{{ route('forum.group.detail', $group->slug) }}" class="nav_link">
                            <figure><img src="{{url('/')}}/wedding_app/public/uploads/{{$group->thumbnail}}"></figure>{{ $group->label }}
                        </a></li>
                    @endforeach

                    @endif
                </ul>
            </div>
            
        </div>
    </div>
    </div>
</div>
</div>
</section>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/trumbowyg.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/trumbowyg.giphy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/trumbowyg.emoji.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/noembed/trumbowyg.noembed.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script src="{{url('js/lightbox.js')}}"></script>
<script src="{{url('/js/weather-custom.js')}}"></script>
<script>

// weather start
function getWeather(lat, long, time) {
   const weather_route = "{{ route('get_venue_weather') }}";
   const url = `${weather_route}?latitude=${lat}&longitude=${long}&time=${time}`;
   getSideBarWeatherData(url);
}

getWeather('{{$user_event->latitude}}', '{{$user_event->longitude}}', '{{date('Y-m-d', strtotime($user_event->start_date))}}');

$('#seasonName').text(getSeasonSouthernHemisphere('{{date('Y-m-d', strtotime($user_event->start_date))}}'));

$('#weatherDatePicker').change(function() {
    const date = $(this).val();
    $("body").find('.custom-loading').show();
    $('#seasonName').text(getSeasonSouthernHemisphere(date));
    getWeather('{{$user_event->latitude}}', '{{$user_event->longitude}}', date);
});
















$('#trumbowyg-demo').trumbowyg({
    btns: [
        ['bold', 'italic'],
        ['unlink'],
        ['link'],
        ['insertImage'],
        ['insertVideo'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['giphy'],
        ['emoji'],
        ['noembed']
    ],
    plugins: {
        giphy: {
            apiKey: 'dne0PgmMe61WBWm4J3LTXiphBlIdlMst'
        }
    },
    autogrow: true
});

$('.Community-slider').owlCarousel({
    loop: true,
    margin: 30,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 3,
            nav: false
        },
        1000: {
            items: 6,
            nav: true,
            loop: false
        }
    }
});

$('.add_friend').click(function(){ 
    var reciever_id = $(this).data('reciever_id');

        $.ajax({
            url: "<?= url(route('forum.send_request')) ?>" ,
            data:{
              'reciever_id': reciever_id
            }, 
            dataTYPE:'JSON',
            success: function (data) {
                location.reload();
            }
        });
    });

$('.cancel_friend').click(function(){ 
    var reciever_id = $(this).data('reciever_id');

        $.ajax({
            url: "<?= url(route('forum.cancel_request')) ?>" ,
            data:{
              'reciever_id': reciever_id
            }, 
            dataTYPE:'JSON',
            success: function (data) {
                location.reload();
            }
        });
    });

$('.remove_friend').click(function(){ 
    var other_user_id = $(this).data('other_user_id');

        $.ajax({
            url: "<?= url(route('forum.remove_friend')) ?>" ,
            data:{
              'other_user_id': other_user_id
            }, 
            dataTYPE:'JSON',
            success: function (data) {
                location.reload();
            }
        });
    });









//----------------------------- Light Box ----------------------------------













</script>
@endsection