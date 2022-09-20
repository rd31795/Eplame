<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css"/>

@extends('layouts.home')

@section('content')
@endsection

<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Edit Comment</h1>
        </div>
    </div>
    
</section>
    <!--Banner section Ends here-->

    <!--Tabs Section starts here-->
<section class="services-tab-sec">

    <div class="container">
        <div class="sec-card">
        <div class="row">
            <div class="col-lg-8">
          <!--  Category Management block -->
            <div class="checklist-wrap bugdet-page">
            @if(Auth::user()->id == $comment->user_id)
               <form class="discussion-card" name="createDiscussion" id="createDiscussionForm" method="post" action="{{ route('forum.comment.update', $comment->id) }}" enctype= "multipart/form-data">
                @csrf
                    <div class="discussion-editor-wrap">
                        <label for="trumbowyg-demo">Edit Comment</label>
                        <textarea id="trumbowyg-demo" name="description">{!! $comment->description !!}</textarea>
                        <input type="hidden" name="discussion_id" value="{{ $comment->discussion_id }}">
                        <input type="hidden" name="parent_comment_id" value="{{ $comment->parent_comment_id }}">
                    </div>
                    <div class="btn-wrap text-center mt-4">
                       <button type="button" id="createDiscussionFormSubmit" class="cstm-btn solid">Submit</button>
                    </div>
                </form>

            @else
                <p> You are not authorised to access this Page.</p>
            @endif
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
                        <li><a href="javascript:void(0);" class="nav_link">
                                <figure><img src="{{url('/')}}/wedding_app/public/uploads/{{$group->thumbnail}}"></figure>{{ $group->label }}
                            </a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
          <!--  Category Management Ends block -->
        </div>
    </div>
</section>
    <!--Tabs Section ends here-->

 

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/trumbowyg.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/trumbowyg.giphy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/trumbowyg.emoji.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/noembed/trumbowyg.noembed.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/upload/trumbowyg.upload.min.js"></script>
<script>
    $(document).ready(function(){
    $("#createDiscussionForm").validate({
          rules: {
            description:{
                required: true,
                minlength:10,
                maxlength: 1000
            }
          },
        });

        $('#createDiscussionFormSubmit').click(function(){
            $(this).attr('disabled', true);
            if($('#createDiscussionForm').valid()){
                $('#createDiscussionForm').submit();
                $(this).attr('disabled', false);
            }else{
                $(this).attr('disabled', false);
                return false;
            }   
        });
    });

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
    btns: [['bold', 'italic'], ['unlink'], ['link'], ['image'], ['insertVideo'],['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'], ['giphy'], ['emoji'], ['noembed']],
    plugins: {
        giphy: {
            apiKey: 'dne0PgmMe61WBWm4J3LTXiphBlIdlMst'
        }
    },
    autogrow: true
});
</script>
@endsection