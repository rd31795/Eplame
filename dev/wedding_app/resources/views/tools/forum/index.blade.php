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
            <h1>Forum</h1>
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
                        <?php $counter = 1; ?>
                        @if(!empty($top_discussions[0]->id))
                        @foreach($top_discussions as $discussion)
                        <div class="col-lg-4 col-md-6">
                            <div class="cstm_comm_card text-center">
                                <figure class="Community_pro_img">
                                  @if(!empty($discussion->discussionUserId->profile_image))
                                    <img src="{{asset('').'/'.$discussion->discussionUserId->profile_image}}">
                                  @else
                                    <img src="{{url('/')}}/images/faceless.jpg">
                                  @endif
                                </figure>
                                <div class="comm_text">
                                    <h3><a href="{{ route('forum.discussion.detail', $discussion->slug) }}">{{ $discussion->title }}</a></h3>
                                    <a href="{{ route('forum.user.wall', $discussion->discussionUserId->id) }}">
                                        <span class="cmnt_name">-{{ $discussion->discussionUserId->first_name }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if($counter == 1)
                        <div class="col-lg-4 col-md-6 cstm-order-2">
                            <div class="search_card text-center">
                                <h4>Ask Questions and get answers with the help of other engaged couples.</h4>
                                <div class="input-wrap">
                                    <select onchange="location = this.value;">
                                      <option>Search...</option>
                                        @if(!empty($groups[0]->id))
                                        @foreach($groups as $group)
                                        <option value="{{ route('forum.group.detail', $group->slug) }}">{{ $group->label }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="ser-icon"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <?php $counter++;?>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!--  Category Management Ends block -->
        </div>
    </div>
</section>
<!--Tabs Section ends here-->
<section class="Community-slider-sec">
    <div class="container">
        <div class="Community-slider owl-carousel owl-theme">
            @if(!empty($groups[0]->id))
                @foreach($groups as $group)
                <div class="item wow bounceInDown">
                    <div class="tab-button">
                        <div class="tab-item">
                            <a href="{{ route('forum.group.detail', $group->slug) }}" data-tag="twenty-three" class="getCategory">
                                <span class="service-icon no-border">
                                    <img class="category--img" src="{{url('/')}}/wedding_app/public/uploads/{{$group->thumbnail}}">
                                </span>
                                <h3>{{ $group->label }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<section class="rec-disscussion-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="rec-dis-header">
                    <h3>Recent Discussions</h3>
                    <a href="{{route('user.forum.create')}}" class="cstm-btn solid-btn">Start a discussion</a>
                </div>
                <ul class="discussion_breadcrum">
                    <li><a href="{{route('forum.discussions')}}" class="">Recent discussion</a></li>
                    <li><a href="{{route('forum.discussions', array('sort' => 'recent_comments'))}}" class="">Recent comments</a></li>
                    <li><a href="{{route('forum.discussions', array('sort' => 'most_popular'))}}" class="">Most popular</a></li>
                    <li><a href="{{route('forum.discussions', array('sort' => 'most_views'))}}" class="">Most viewed</a></li>
                </ul>
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
                            <span class="small_des"><a href="{{ route('forum.user.wall', $discussion->discussionUserId->id) }}" > {{ $discussion->discussionUserId->first_name }} </a> in <a href="{{ route('forum.group.detail', $discussion->discussionGroupId->slug) }}" >{{ $discussion->discussionGroupId->label }}</a></span><span class="date_time">{{ \Carbon\Carbon::parse($discussion->created_at)->format('M d, Y H:i') }}</span>
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
                    <a href="{{ route('forum.discussions') }}" class="cstm-btn solid-btn">View all discussion</a>
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
                              <a href="{{ route('forum.photo.create') }}" class="cstm-btn">
                                 <i class="fas fa-upload"></i>
                                    Upload
                              </a>

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
        <div class="col-lg-4">
            <div class="rec-sidebar">
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
            <div class="rec-sidebar ">
                <div class="sidebar_heading">
                    <h3>Most Active Users</h3>
                </div>
                <ul class="rec-side-nav active-users">
                    @if(count($array_with_count)>0)
                      @foreach($array_with_count as $key=>$val)
                      <li><a href="{{ route('forum.user.wall', getUsers($key)->id)}}" class="nav_link">
                                @if(getUsers($key)->user_active == 1)
                              <figure>
                                @if(!empty(getUsers($key)->profile_image))
                                  <img src="{{asset('').'/'.getUsers($key)->profile_image}}">
                                @else
                                  <img src="{{url('/')}}/images/faceless.jpg">
                                @endif
                              </figure> {{ getUsers($key)->first_name }}
                              @endif
                          </a></li>
                      @endforeach
                        <li>
                            <a href="{{ route('forum.users') }}" class="view-all">
                            See More Users
                            </a>
                        </li>
                    @else
                      <li> No Active Users </li>
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
                              <li><a href="{{ route('forum.user.wall', $active->user->id) }}" class="nav_link">
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
    navigation: true,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
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
</script>
@endsection