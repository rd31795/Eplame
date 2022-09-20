
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
        </ul>
        <div class="row">
            <div class="col-lg-8">
                <div class="rec-dis-header">
                    <h3>Discussions</h3>
                    <a href="{{route('user.forum.create')}}" class="cstm-btn solid-btn">Start a discussion</a>
                </div>
                @if(!empty($discussions[0]->id))
                @foreach($discussions as $discussion)
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

                {!! $discussions->render() !!}
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
</script>
@endsection