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
                            <!-- Tabs -->

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
                                <h3>Discussions</h3>
                                <ul class="replies-list">
                                    @if(!empty($discussions[0]->id))
                                        @foreach($discussions as $discussion)
                                            <li>
                                                <div class="discussion-dtl">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                                                            <figure class="profile_wrap">
                                                                @if(!empty($discussion->discussionUserId->profile_image))
                                                                    <img src="{{asset('').'/'.$discussion->discussionUserId->profile_image}}">
                                                                @else
                                                                    <img src="{{url('/')}}/images/faceless.jpg">
                                                                @endif
                                                            </figure>
                                                            <div class="profiel-cont">
                                                                <p>Featured</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-10 col-12">
                                                            <div class="rec-description">
                                                                <a href="{{route('forum.discussion.detail', $discussion->slug)}}">
                                                                    <h4>{{ $discussion-> title }}</h4>
                                                                </a>
                                                                <div class="profiel-rply-dtl">
                                                                    <a href="{{ route('forum.user.wall', $discussion->discussionUserId->id) }}">
                                                                        <span class="small_des">{{ $discussion->discussionUserId->first_name }}</span>
                                                                    </a> 
                                                                    <span class="date_time">{{ \Carbon\Carbon::parse($discussion->created_at)->format('M d, Y H:i') }}
                                                                    </span>
                                                                </div>
                                                                <div class="inner-cont">
                                                                    {!! $discussion->description !!}
                                                                </div>
                                                                <div class="list-sec">
                                                                    <ul class="user-actions">
                                                                        <li><a href="javascript:void(0);"><span><i class="fas fa-comment"></i></span>{{ countComment($discussion->id) }}</a></li>
                                                                        <li><a href="javascript:void(0);"><span><i class="fas fa-eye"></i></span>{{ countView($discussion->id) }}</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            @else
                                                <div class="">
                                                    <div class="cst-up-pic">
                                                    <p>There are no discussion in this group.</p>
                                                      <a href="{{ route('user.forum.create') }}" class="cstm-btn">
                                                         <i class="fas fa-edit"></i>
                                                            Start Discussion
                                                      </a>

                                                    </div>
                                                </div>
                                            @endif
                                    
                                </ul>
                            </div>
                            <div class="recent-photo latest-photos">
                                <h3>Latest photos</h3>
                                <div class="row">
                                    @if(!empty($recent_photos[0]->id))
                                        @foreach($recent_photos as $photo)
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
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
                                              <a href="{{ route('forum.photo.create') }}" class="cstm-btn">
                                                 <i class="fas fa-upload"></i>
                                                    Upload
                                              </a>

                                            </div>
                                        </div>
                                        @endif
                                </div>
                            </div>
                            <div class="recent-photo recent-videos latest-videos">
                                <h3>latest videos</h3>
                                <div class="row">
                                    @if(!empty($recent_videos[0]->id))
                                        @foreach($recent_videos as $video)
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
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
                                              <a href="{{ route('forum.video.create') }}" class="cstm-btn">
                                                 <i class="fas fa-upload"></i>
                                                    Upload
                                              </a>

                                            </div>
                                        </div>
                                        @endif
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
                                        <li>
                                            <a href="{{ route('forum.group.detail', $group->slug) }}" class="nav_link">
                                                <figure><img src="{{url('/')}}/wedding_app/public/uploads/{{$group->thumbnail}}"></figure>{{ $group->label }}
                                            </a>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="rec-sidebar ">
                                <div class="sidebar_heading">
                                    <h3>users online</h3>
                                </div>
                                <ul class="rec-side-nav online-users">
                                    <li>
                                        <ul class="active_users">
                                            @if(!empty($activities[0]->user->id))
                                              @foreach($activities as $active)
                                               <!-- {{ $active->user->first_name}} -->
                                              <li><a href="{{ route('forum.group.detail', $group->slug) }}" class="nav_link">
                                                    <figure>
                                                        @if(!empty($active->user->profile_image))
                                                          <img src="{{asset('').'/'.$active->user->profile_image}}" title="{{ $active->user->first_name }}">
                                                        @else
                                                          <img src="{{url('/')}}/images/faceless.jpg" title="{{ $active->user->first_name }}">
                                                        @endif
                                                    </figure>
                                                  </a></li>
                                              @endforeach
                                            @else
                                            <li> No Online Users </li>
                                            @endif
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('forum.users') }}" class="view-all">
                                        See More Users
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="rec-sidebar ">
                                <div class="sidebar_heading">
                                    <h3>Group Members</h3>
                                </div>
                                <ul class="rec-side-nav active-users">
                                    @if(!empty($recent_members[0]->id))
                                      @foreach($recent_members as $member)
                                        <li>
                                            <a href="{{ route('forum.user.wall', $member->memberUserId->id) }}" class="nav_link">
                                              <figure>
                                                @if($member->memberUserId->profile_image)
                                                  <img src="{{asset('').'/'.$member->memberUserId->profile_image}}">
                                                @else
                                                  <img src="{{url('/')}}/images/faceless.jpg">
                                                @endif
                                              </figure> {{ $member->memberUserId->first_name }}
                                            </a>
                                        </li>
                                        @endforeach
                                        
                                        <li>
                                            <a href="{{ route('forum.group.members', $slug) }}" class="view-all">
                                            View All
                                            </a>
                                        </li>

                                    @else
                                        <li> No Member Available </li>
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
</script>
@endsection