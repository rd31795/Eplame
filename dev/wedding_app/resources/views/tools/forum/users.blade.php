<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
@extends('layouts.home')
@section('content')
@endsection
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Forum Members</h1>
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
                            <div class="replies-sec dis-rply-sec">
                                <h1>Forum Members</h1>
                                <div class="custom_mem_wrap">
                                    <div class="row"> 
                                    @if(!empty($users[0]->id))
                                        @foreach($users as $user)
                                        <div class="col-lg-6">
                                            <div class="member_card">
                                                <div class="mem_info">
                                                    <figure>
                                                        @if(!empty($user->profile_image))
                                                            <img src="{{asset('').'/'.$user->profile_image}}">
                                                        @else
                                                            <img src="{{url('/')}}/images/faceless.jpg">
                                                        @endif
                                                    </figure>
                                                    <div class="mem-name">
                                                        <a href="{{ route('forum.user.wall', $user->id) }}">{{$user->name}}</a>
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
                                                        <a href="javascript:void(0);">{{ count($user->discussions)}}
                                                            <span>
                                                                discussions
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">{{ count($user->discussionfiles)}}
                                                            <span>
                                                                Photos
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="add-friend">
                                                    <a href="javascript:void(0);">
                                                        <i class="fas fa-user"></i> Add as friend
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        {!! $users->render() !!}

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

</script>
@endsection
