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
            <h1>Discussions</h1>
        </div>
    </div>
</section>
<section class="services-tab-sec">
    <div class="container">
        <div class="sec-card">
            <div class="rec-disscussion-sec">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="rec-dis-header">
                            <h3>Recent Discussions</h3>
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
                                <span class="small_des"><a href="{{ route('forum.user.wall', $discussion->discussionUserId->id) }}">{{ $discussion->discussionUserId->first_name }}</a> in <a href="{{ route('forum.group.detail', $discussion->discussionGroupId->slug) }}">{{ $discussion->discussionGroupId->label }}</a></span> <span class="date_time">{{ \Carbon\Carbon::parse($discussion->created_at)->format('M d, Y H:i') }}</span>
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
        </div></div></section>
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

            </script>
            @endsection
