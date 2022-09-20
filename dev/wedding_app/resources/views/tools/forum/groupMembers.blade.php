<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
@extends('layouts.home')
@section('content')
@endsection
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>{{ $group->label }}</h1>
        </div>
    </div>
</section>
<!--Banner section Ends here-->
<!--Tabs Section starts here-->
<section class="services-tab-sec">
    <div class="container">
        <div class="sec-card">
            <!--  Category Management block -->
            <div class="checklist-wrap bugdet-page">
                <div class="main_commm_wrap">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="inner-page-dtl">
                                <figure class="main_img">
                                    <img src="{{url('/')}}/wedding_app/public/uploads/{{ $group->cover_img}}">
                                    <p>{{ $group->label }}</p>
                                    @if(Auth::user())
                                        <div class="btn-group nbtn-1">
                                        @if($status == 0)
                                            <a href="{{route('forum.group.join', $group->slug)}}" class="cstm-btn solid-btn">
                                               Join Group
                                            </a>
                                        @elseif($status == 1)
                                            <a href="{{route('forum.group.leave', $group->slug)}}" class="cstm-btn solid-btn">
                                               Leave Group
                                            </a>
                                        @endif
                                        </div>
                                    @endif
                                </figure>
                                <div class="cont-wrap">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <p>{{ $group->description }}</p>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12">

                                            <ul class="rec-side-nav online-users">
                                                <li>
                                                    <ul class="active_users">
                                                        @if(!empty($recent_members[0]->id))
                                                            @foreach($recent_members as $member)
                                                        <!-- Kanny -->
                                                                <li>
                                                                    <figure class="cstm-image">
                                                                        @if(!empty($member->memberUserId->profile_image))
                                                                            <img src="{{asset('').'/'.$member->memberUserId->profile_image}}">
                                                                        @else
                                                                            <img src="{{url('/')}}/images/faceless.jpg">
                                                                        @endif
                                                                    </figure>
                                                                </li>
                                                                @endforeach
                                                            @endif

                                                    </ul>
                                                </li>
                                                <li>
                                                    <p>{{count($recent_members)}} Members
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="cst-tabs-nav border-top pl20 flex">
                                <li class="navbar-tab current app-mirror-link pointer mr5">
                                    <a class="navbar-tab-item" href="{{ route('forum.group.detail', $group->slug) }}">
                                        All            </a>
                                </li>
                                            <li class="navbar-tab app-mirror-link pointer mr5">
                                        <a class="navbar-tab-item" href="{{ route('forum.group.discussions', $group->slug) }}">
                                            Discussions                </a>
                                        <small class="navbar-tab-item-count count notablet">{{ count($group->groupdiscussions) }}</small>
                                    </li>
                                            <li class="navbar-tab app-mirror-link pointer mr5">
                                        <a class="navbar-tab-item" rel="nofollow" href="{{ route('forum.group.photos', $group->slug) }}">
                                        Photos                </a>
                                        <small class="navbar-tab-item-count count notablet">{{ count($group->groupphotos) }}</small>
                                    </li>
                                                    <li class="navbar-tab app-mirror-link pointer mr5">
                                        <a class="navbar-tab-item" rel="nofollow" href="{{ route('forum.group.videos', $group->slug) }}">
                                        Videos                </a>
                                        <small class="navbar-tab-item-count count notablet">{{ count($group->groupvideos) }}</small>
                                    </li>
                                                    <li class="navbar-tab app-mirror-link pointer">
                                        <a class="navbar-tab-item" rel="nofollow" href="{{ route('forum.group.members', $group->slug) }}">
                                            Members                </a>
                                        <small class="navbar-tab-item-count count notablet">{{ count($group->groupmembers) }}</small>
                                    </li>
                                </ul>
                            <div class="replies-sec dis-rply-sec">
                                <h3>Members</h3>
                                <div class="cust_outer-wrap">
                                <div class="custom_mem_wrap">
                                    @if(!empty($group_members[0]->id))
                                        @foreach($group_members as $member)
                                            <div class="member_card">
                                                <div class="mem_info">
                                                    <figure>
                                                        @if(!empty($member->memberUserId->profile_image))
                                                            <img src="{{asset('').'/'.$member->memberUserId->profile_image}}">
                                                        @else
                                                            <img src="{{url('/')}}/images/faceless.jpg">
                                                        @endif
                                                    </figure>
                                                    <div class="mem-name">
                                                        <a href="{{ route('forum.user.wall', $member->memberUserId->id) }}">{{$member->memberUserId->name}}</a>
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
                                                        <a href="javascript:void(0);">{{count($member->memberUserId->discussions)}}
                                                            <span>
                                                                discussions
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">{{ count($member->memberUserId->discussionfiles) }}
                                                            <span>
                                                                Photos
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="add-friend">
                                                    <?php 
                                                        $request_status = 0;
                                                        $request_status = getRequestStatus($member->user_id);
                                                    ?>
                                                    @if(Auth::user())
                                                        @if(!(Auth::user()->id == $member->user_id))
                                                            @if($request_status == 0)
                                                            <a data-reciever_id="{{$member->user_id}}" href="javascript:void(0);" class="add_friend" href="javascript:void(0);">
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
                                        @endforeach
                                    @endif
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-4 right-sidebar ">
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
                <!--  Category Management Ends block -->
            </div>
        </div>
</section>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/trumbowyg.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/trumbowyg.giphy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/trumbowyg.emoji.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/noembed/trumbowyg.noembed.min.js"></script>
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

</script>
@endsection
