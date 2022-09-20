<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
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
        <div class="col-lg-8">
            <div class="rec-dis-header">
                <h3>Recent Events</h3>

                 @if($myEventCount > 0)              
                <?php $myEvents = $user->PastEvents(); ?>
                @foreach($myEvents as $k => $event)
                  <div class="card-media  mt-4 wow bounceInRight" data-wow-delay="{{100 * ($k + 0.5)}}ms">
                    <!-- media container -->
                    <div class="card-media-object-container">
                      <div class="card-media-object" style="background-image: url({{$event->event_picture !='' ? url($event->event_picture) : '' }});">
                        <div class="date-ribbon"><h2>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }}</h2> <h1>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}</h1></div>
                      </div>
                      <span class="card-media-object-tag subtle {{ str_slug(EventCurrentStatus($event->start_date,$event->end_date)) }}">{{ EventCurrentStatus($event->start_date,$event->end_date)}}</span>
                    </div>
                    <!-- body container -->
                    <div class="card-media-body">
                      <div class="card-media-body-top">
                        <span class="subtle">
                          <strong>{{ ucfirst($event->title) }}</strong></br>
                          {{ \Carbon\Carbon::parse($event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                        </span>
                        <div class="card-media-body-top-icons u-float-right">
                         
                        </div>
                      </div>
                      <span class="card-media-body-heading">{{ $event->description }}</span>
                      <div class="card-media-body-supporting-bottom">
                        <span class="card-media-body-supporting-bottom-text subtle">{{ $event->location }}</span>
                        <span class="card-media-body-supporting-bottom-text subtle u-float-right">Event Budget &ndash; ${{ $event->event_budget }}</span>
                      </div>
                      <div class="card-media-body-supporting-bottom card-media-body-supporting-bottom-reveal">
                        <span class="card-media-body-supporting-bottom-text subtle ">@foreach($event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last)
                        , @endif @endforeach</span>
                        <a href="{{route('forum.user.eventDetail',[$user->id,$event->slug])}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
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
        <div class="col-lg-4">
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
<script>
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
</script>
@endsection