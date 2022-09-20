<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css"/>

@extends('layouts.home')

@section('content')
@endsection

<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Create Discussion</h1>
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
               <form class="discussion-card" name="createDiscussion" id="createDiscussionForm" method="post" action="{{ route('user.forum.store') }}">
                @csrf
                   <div class="discussion-editor-wrap">
                        <label class="form-label">Discussion title*</label>
                        <div class="input-wrap">
                           <input type="text" name="title" class="form-control">
                        </div>
                        <textarea id="trumbowyg-demo" name="description"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Select a group*</label>
                                <small class="input_field_info">Choosing a relevant group helps others find your discussion!</small>
                                <div class="input-wrap">
                                    <select name="group" id="group-opt" class="form-control valid">
                                        <option value="">Select a Group...</option>
                                        @if(!empty($groups[0]->id))
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}">{{$group->label}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="input-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="btn-wrap text-center mt-4">
                       <button type="button" id="createDiscussionFormSubmit" class="cstm-btn solid">Post</button>
                   </div>
                </form>

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
            title: {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            group:{
                required: true
            },
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
        },
        upload: {
            serverPath: 'https://api.imgur.com/3/image',
            fileFieldName: 'image',
            headers: {
                'Authorization': 'Client-ID 12337df3ad42058'
            },
            urlPropertyName: 'data.link'
        }
    },
    autogrow: true
});
</script>
@endsection