<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
@extends('layouts.home')
@section('content')
@endsection
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Discussion Details</h1>
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
                                            <p>19 november 2020</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-12">
                                        <div class="rec-description">
                                            <figure class="traianle-icon">  <img src="http://49.249.236.30:50/images/triangle.png">
                                                   </figure>
                                            <h4>{{ $discussion->title }}</h4>
                                            <span class="small_des"><a href="{{ route('forum.user.wall', $discussion->discussionUserId->id) }}">{{ $discussion->discussionUserId->first_name }}</a> in <a href="{{ route('forum.group.detail', $discussion->discussionGroupId->slug) }}"> {{ $discussion->discussionGroupId->label }}</a></span> <span class="date_time">{{ \Carbon\Carbon::parse($discussion->created_at)->format('M d, Y H:i') }}</span>
                                            <div class="inner-list-wrap">
                                            <ul class="user-actions">
                                                <li><a href="javascript:void(0);"><span><i class="fas fa-comment"></i></span>{{ countComment($discussion->id) }}</a></li>
                                                <li><a href="javascript:void(0);"><span><i class="fas fa-eye"></i></span>{{ countView($discussion->id) }}</a></li>
                                            </ul>
                                             <a @if(Auth::user()) href="#reply-form" @else href="{{route('login')}}" @endif id="disc-reply" class="cstm-btn solid-btn">Reply</a>
                                         </div>
                                            <div class="inner-cont">
                                                {!! $discussion->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="replies-sec">
                                <h3><span>{{count($comments)}}</span> replies</h3>
                                <ul class="replies-list">
                                    @if(!empty($comments[0]->id))
                                        @foreach($comments as $comment)
                                        <li>
                                            <div class="discussion-dtl" id="{{ $comment->id }}">
                                                <div class="row">
                                                     <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                                                        <figure class="profile_wrap">
                                                            @if(!empty($comment->commentUserId->profile_image))
                                                                <img src="{{asset('').'/'.$comment->commentUserId->profile_image}}">
                                                            @else
                                                                <img src="{{url('/')}}/images/faceless.jpg">
                                                            @endif
                                                        </figure>
                                                        <div class="profiel-cont">
                                                              <p>Featured</p>
                                                        </div>
                                                    </div>
                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-12">
                                                        <div class="rec-description" id="id{{ $comment->id }}">
                                                                <div class="profiel-rply-dtl">
                                                                    <span class="small_des">{{ $comment->commentUserId->first_name }}</span> <span class="date_time">{{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y H:i') }}</span>
                                                                </div>
                                                                @if($comment->parent_comment_id > 0)
                                                                <div class="view-wrap"><a href="#{{ $comment->parent_comment_id}}" class="tagged-anc" data-id="{{ $comment->parent_comment_id}}">View Tagged Comment</a></div>
                                                                @endif
                                                            <div class="inner-cont">
                                                                {!! $comment->description !!}
                                                            </div>
                                                            <div class="btn-wrap">
                                                                @if (Auth::user())
                                                                    @if(Auth::user()->id == $comment->user_id)
                                                                        <a href="{{route('forum.comment.edit', $comment->id)}}" class="cstm-btn solid-btn">Edit</a>
                                                                    @endif
                                                                @endif
                                                                <a @if(Auth::user()) href="#reply-form" @else href="{{route('login')}}" @endif data-id="{{ $comment->id}}" class="cstm-btn solid-btn cmnt-reply">Reply</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            @if (Auth::user())
                                <div class="replies-form" id="reply-form">
                                    <h3>Reply</h3>
                                   <div class="row">
                                                     <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                                                        <figure class="profile_wrap">
                                                            @if(!empty(Auth::user()->profile_image))
                                                                <img src="{{asset('').'/'.Auth::User()->profile_image}}">
                                                            @else
                                                                <img src="{{url('/')}}/images/faceless.jpg">
                                                            @endif
                                                        </figure>
                                                        <div class="profiel-cont">
                                                              <p>{{Auth::user()->first_name}}</p>
                                                        </div>
                                                    </div>
                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-12">
                                    <form class="discussion-card" name="createComment" id="createCommentForm" method="post" action="{{ route('forum.comment.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <textarea id="trumbowyg-demo" name="description"></textarea>
                                        <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                                        <input type="hidden" id="par_cmnt_id" name="parent_comment_id" value="">
                                        <div class="btn-wrap  mt-4">
                                            <button type="button" id="createCommentFormSubmit" class="cstm-btn solid">Reply</button>
                                          </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/upload/trumbowyg.upload.min.js"></script>
<script>
$.extend(true, $.trumbowyg, {
        langs: {
            // jshint camelcase:false
            en: {
                noembed: 'Upload Video'
            },
        }
    });
$('#trumbowyg-demo').trumbowyg({
    btnsDef: {
        // Create a new dropdown
        image: {
            dropdown: ['insertImage', 'upload'],
            ico: 'insertImage'
        }
    },
    btns: [
        ['bold', 'italic'],
        ['unlink'],
        ['link'],
        ['image'],
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

$("#createCommentForm").validate({
    rules: {
        description:{
            required: true,
            minlength:10,
            maxlength: 1000
        }
      },
    });

    $('#createCommentFormSubmit').click(function(){
        $(this).attr('disabled', true);
        if($('#createCommentForm').valid()){
            $('#createCommentForm').submit();
            $(this).attr('disabled', false);
        }else{
            $(this).attr('disabled', false);
            return false;
        }   
    });

    $('.cmnt-reply').click(function(){
        var id = $(this).data('id');
        $('#par_cmnt_id').val(id);
    });

    $('#disc-reply').click(function(){
        $('#par_cmnt_id').val('');
    });

    $('.tagged-anc').click(function(){
        var id = $(this).data('id');
        $('body').find('#id'+id).toggleClass('cstm-active');

        setTimeout(function(){
         // toggle another class
         $('body').find('#id'+id).toggleClass('cstm-active'); 
        },5000);
    });
</script>
@endsection