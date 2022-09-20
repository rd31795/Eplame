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
                                <div class="recent-photo latest-photos">
                                    <h3>Photos</h3>
                                    <div class="row">
                                        @if(!empty($photos[0]->id))
                                            @foreach($photos as $photo)
                                                @if($photo->discussionFileUserId->profile_image)
                                                  <?php $src = asset('').'/'.$member->memberUserId->profile_image;
                                                  ?>
                                                @else
                                                    <?php $src = url('/')."/images/faceless.jpg";
                                                    ?>
                                                @endif
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="outer-wrap">
                                                        <a class="cstm-modal-anc" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-src="{{ url('/') }}/wedding_app/public/uploads/{{ $photo->path }}" data-title="{{ $photo->title }}" data-description="{{ $photo->description }}" data-user_pic="{{ $src }}" data-user_name="{{ $photo->discussionFileUserId->first_name }}" data-upload_date="{{ $photo->updated_at }}">
                                                            <figure><img src="{{ url('/') }}/wedding_app/public/uploads/{{ $photo->path }}"></figure>
                                                        </a>
                                                      <h5>{{ $photo->title }}</h5>
                                                      <p>By {{ $photo->discussionFileUserId->first_name }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {!! $photos->render() !!}
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
                                            <a href="{{ route('forum.group.members', $group->slug) }}" class="view-all">
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

<!-- Modal starts here -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog post-detail" role="document">
    <div class="modal-content">
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
   
      <div class="modal-body">
            <div class="content-cust">
                <div class="left">
                    <figure>
                        <img id="pop-img" src="">
                    </figure>
                </div>                
                <div class="cst-right" id="photo-description">
                      <h3 id="photo-title"></h3>
                      <div class="post-user">
                          <figure>
                            <img id="user-pic" src="">
                          </figure>
                          <h3>By <span id="user_name">Lorem Ipsum</span></h3>
                          <h4 id="photo-date">The October 26, 2020 at 16:15</h4>
                      </div>
                      <div id="ph-des"></div>      
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script>

    jQuery(document).ready(function(){
        $('.cstm-modal-anc').click(function(){
            var src = $(this).data('src');
            var title = $(this).data('title');
            var description = $(this).data('description');
            var user_pic = $(this).data('user_pic');
            var user_name = $(this).data('user_name');
            var upload_date = $(this).data('upload_date');
            $('#pop-img').attr('src', src);
            $('#user-pic').attr('src', user_pic);
            $('#photo-title').text(title);
            $('#ph-des').html(description);
            $('#user_name').text(user_name);
            $('#photo-date').text(upload_date);
        });
    });
</script>
@endsection
