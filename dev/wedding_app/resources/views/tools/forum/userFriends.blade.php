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
                <a class="navbar-tab-item" href="{{ route('forum.user.wall', $user->id) }}">
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
        </ul>

        <div class="row">
            <div class="col-lg-8">
                <div class="replies-sec dis-rply-sec">
                    <h3>Friends</h3>
                        @if(!empty($friends[0]->id))
                        <div class="cust_outer-wrap">
                            <div class="custom_mem_wrap">
                                @foreach($friends as $friend)
                                    @if($user->id == $friend->sender_id)
                                        <div class="member_card">
                                            <div class="mem_info">
                                                <figure>
                                                    @if(!empty($friend->recieverId->profile_image))
                                                        <img src="{{asset('').'/'.$friend->recieverId->profile_image}}">
                                                    @else
                                                        <img src="{{url('/')}}/images/faceless.jpg">
                                                    @endif
                                                </figure>
                                                <div class="mem-name">
                                                    <a href="{{ route('forum.user.wall', $friend->recieverId->id) }}">{{$friend->recieverId->name}}</a>
                                                </div>
                                            </div>
                                            <ul class="mem_dis">
                                                <li>
                                                    <a href="javascript:void(0);">262
                                                        <span>
                                                            Messages
                                                        </span>
                                                    </a>

                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">{{count($friend->recieverId->discussions)}}
                                                        <span>
                                                            discussions
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">{{ count($friend->recieverId->discussionfiles) }}
                                                        <span>
                                                            Photos
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="add-friend">
                                                <?php 
                                                    $request_status = 0;
                                                    $request_status = getRequestStatus($friend->reciever_id);
                                                ?>
                                                @if(Auth::user())
                                                    @if(!(Auth::user()->id == $friend->reciever_id))
                                                        @if($request_status == 0)
                                                        <a data-reciever_id="{{$friend->reciever_id}}" href="javascript:void(0);" class="add_friend" href="javascript:void(0);">
                                                            <i class="fas fa-user"></i> Add Friend
                                                        </a>
                                                        @elseif($request_status == 2)
                                                            <a href="javascript:void(0);" class="cstm-btn">
                                                                <i class="fas fa-check"></i> Friend Request Sent
                                                            </a>
                                                        @elseif($request_status == 1)
                                                            <a href="javascript:void(0);">
                                                                <i class="fas fa-check"></i> Friends
                                                            </a>                                    
                                                        @endif
                                                        
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="member_card">
                                            <div class="mem_info">
                                                <figure>
                                                    @if(!empty($friend->senderId->profile_image))
                                                        <img src="{{asset('').'/'.$friend->senderId->profile_image}}">
                                                    @else
                                                        <img src="{{url('/')}}/images/faceless.jpg">
                                                    @endif
                                                </figure>
                                                <div class="mem-name">
                                                    <a href="{{ route('forum.user.wall', $friend->senderId->id) }}">{{$friend->senderId->name}}</a>
                                                </div>
                                            </div>
                                            <ul class="mem_dis">
                                                <li>
                                                    <a href="javascript:void(0);">262
                                                        <span>
                                                            Messages
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">{{count($friend->senderId->discussions)}}
                                                        <span>
                                                            discussions
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">{{ count($friend->senderId->discussionfiles) }}
                                                        <span>
                                                            Photos
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="add-friend">
                                                <?php 
                                                    $request_status = 0;
                                                    $request_status = getRequestStatus($friend->sender_id);
                                                ?>
                                                @if(Auth::user())
                                                    @if(!(Auth::user()->id == $friend->sender_id))
                                                        @if($request_status == 0)
                                                        <a data-reciever_id="{{$friend->sender_id}}" href="javascript:void(0);" class="add_friend" href="javascript:void(0);">
                                                            <i class="fas fa-user"></i> Add Friend
                                                        </a>
                                                        @elseif($request_status == 2)
                                                            <a href="javascript:void(0);" class="cstm-btn">
                                                                <i class="fas fa-check"></i> Friend Request Sent
                                                            </a>
                                                        @elseif($request_status == 1)
                                                            <a href="javascript:void(0);">
                                                                <i class="fas fa-check"></i> Friends
                                                            </a>                                    
                                                        @endif
                                                        
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                {!! $friends->render() !!}
                            </div>                    
                    </div>
                    @else
                        <div class="no-friend">
                            <p><span>Sorry!!</span> You have no friend in your friend list.</p>
                        </div>

                    @endif
                    
                </div>
            @if(Auth::user())
                @if(Auth::user()->id == $user->id)
                    <div class="replies-sec dis-rply-sec">
                        <h3>Pending Friend Requests</h3>
                            @if(!empty($pending_friends[0]->id))
                                <div class="custom_mem_wrap">
                                @foreach($pending_friends as $friend)
                                <div class="cust_outer-wrap">
                                    <div class="member_card">
                                        <div class="mem_info">
                                            <figure>
                                                @if(!empty($friend->senderId->profile_image))
                                                    <img src="{{asset('').'/'.$friend->senderId->profile_image}}">
                                                @else
                                                    <img src="{{url('/')}}/images/faceless.jpg">
                                                @endif
                                            </figure>
                                            <div class="mem-name">
                                                <a href="{{ route('forum.user.wall', $friend->senderId->id) }}">{{$friend->senderId->name}}</a>
                                            </div>
                                        </div>
                                        <ul class="mem_dis">
                                            <li>
                                                <a href="javascript:void(0);">262
                                                    <span>
                                                        Messages
                                                    </span>
                                                </a>

                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">{{count($friend->senderId->discussions)}}
                                                    <span>
                                                        discussions
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">{{ count($friend->senderId->discussionfiles) }}
                                                    <span>
                                                        Photos
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="add-friend">
                                            <a data-sender_id="{{$friend->sender_id}}" href="javascript:void(0);" class="accept_friend">
                                                <i class="fas fa-user"></i> Accept Request
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {!! $pending_friends->render() !!}
                            </div>
                            @else
                            <div class="no-friend">
                                <p><span>Sorry!!</span> You have no friend requests.</p>
                            </div>
                            @endif
                    </div>
                @endif
            @endif
           
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
            <div class="rec-sidebar dis-bar">
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
<script>

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

$('.accept_friend').click(function(){ 
    var sender_id = $(this).data('sender_id');

        $.ajax({
            url: "<?= url(route('forum.accept_friend')) ?>" ,
            data:{
              'sender_id': sender_id
            }, 
            dataTYPE:'JSON',
            success: function (data) {
                location.reload();
            }
        });
    });
</script>
@endsection