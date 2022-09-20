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
        </ul>

        <div class="row">
            <div class="col-lg-8">
                <div class="recent-photo latest-photos">
                    <h3>Photos</h3>
                    <div class="row">
                        @if(!empty($photos[0]->id))
                            @foreach($photos as $photo)
                                @if($photo->discussionFileUserId->profile_image)
                                  <?php $src = asset('').'/'.$photo->discussionFileUserId->profile_image;
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
                          <h3>By <span id="user_name">  </span></h3>
                          <h4 id="photo-date"></h4>
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