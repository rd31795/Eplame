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
                <small class="navbar-tab-item-count count notablet">{{ $user->PastEvents(1)}}</small>
            </li> 
        </ul>

        <div class="row">
            <div class="col-lg-8">
                <div class="rec-dis-header">
                    <h3>Recent Discussions</h3>
                    <a href="{{route('user.forum.create')}}" class="cstm-btn solid-btn">Start a discussion</a>
                </div>
                @if(!empty($recent_discussions[0]->id))
                @foreach($recent_discussions as $discussion)
                <div class="rec-disscussion-card">
                    <figure class="dis-profile-img">
                      @if(!empty($discussion->discussionUserId->profile_image))
                        <img src="{{asset('').'/'.$discussion->discussionUserId->profile_image}}">
                      @else
                        <img src="{{url('/')}}/images/faceless.jpg">
                      @endif
                    </figure>
                    <div class="rec-description">
                        <a href="{{route('forum.discussion.detail', $discussion->slug)}}">
                            <h4>{{ $discussion-> title }}</h4>
                        </a>
                        <span class="small_des"><a href="{{ route('forum.user.wall', $discussion->discussionUserId->id) }}"> {{ $discussion->discussionUserId->first_name }}</a> in <a href="{{ route('forum.group.detail', $discussion->discussionGroupId->slug) }}">{{ $discussion->discussionGroupId->label }}</a></span> <span class="date_time">{{ \Carbon\Carbon::parse($discussion->created_at)->format('M d, Y H:i') }}</span>
                        {!! $discussion->description !!}
                        <ul class="user-actions">
                            <li><a href="javascript:void(0);"><span><i class="fas fa-comment"></i></span>{{ countComment($discussion->id) }}</a></li>
                            <li><a href="javascript:void(0);"><span><i class="fas fa-eye"></i></span>{{ countView($discussion->id) }}</a></li>
                        </ul>
                    </div>
                </div>
                @endforeach
                @endif

                <div class="btn-wrap text-center border-top">
                    <a href="{{ route('forum.user.discussions', $user->id) }}" class="cstm-btn solid-btn">View all discussion</a>
                </div>
                <div class="recent-photo">
                    <h3>Recently added photos</h3>
                    <div class="row">
                      @if(!empty($top_photos[0]->id))
                        @foreach($top_photos as $photo)
                          <div class="col-lg-4">
                              <div class="outer-wrap">
                                  <figure><img src="{{ url('/') }}/wedding_app/public/uploads/{{ $photo->path }}"></figure>
                                  <h5>{{ $photo->title }}</h5>
                                  <p>By {{ $photo->discussionFileUserId->first_name }}</p>
                              </div>
                          </div>
                        @endforeach
                      @else
                        <div class="col-md-12">
                            <div class="cst-up-pic">
                            <p>There are no recent photos available.</p>
                            @if(Auth::user())
                                @if(Auth::user()->id == $user->id)
                                  <a href="{{ route('forum.photo.create') }}" class="cstm-btn">
                                     <i class="fas fa-upload"></i>
                                        Upload
                                  </a>
                                @endif
                            @endif
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>
                <div class="recent-photo recent-videos">
                    <h3>Recently added videos</h3>
                    <div class="row">
                      @if(!empty($top_videos[0]->id))
                        @foreach($top_videos as $video)
                          <div class="col-lg-4">
                              <div class="outer-wrap">
                                <iframe width="223" height="180" src="{{ $video->path }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
                                  <h5>{{ $video->title }}</h5>
                                  <p>By {{ $video->discussionFileUserId->first_name }}</p>
                              </div>
                          </div>
                        @endforeach
                        @else
                          <div class="col-md-12">
                              <div class="cst-up-pic">
                              <p>There are no recent videos available.</p>
                                @if(Auth::user())
                                    @if(Auth::user()->id == $user->id)
                                        <a href="{{ route('forum.video.create') }}" class="cstm-btn">
                                        <i class="fas fa-upload"></i>
                                        Upload
                                        </a>
                                    @endif
                                @endif
                              </div>
                          </div>
                          @endif
                    </div>
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