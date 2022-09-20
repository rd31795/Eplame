@extends('layouts.home')

@section('title') Eplame|CheckList @endsection
@section('description') Eplame|CheckList @endsection
@section('keywords') Eplame|CheckList @endsection

@section('content')
 @include('admin.error_message')

 @include('tools.checklist.includes.popups')
 

<section class="log-sign-banner aos-init aos-animate" data-aos="fade-up" data-aos-duration="3000" "="" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="page-title text-center">
            <h1>{{$checklist_title}}</h1>
                 <p>{{$checklist_tagline}}</p>
        </div>
    </div>    
</section>


@include('tools.includes.navbar')
 
@if(Auth::user()->id == $event->user_id || checkPermission('checklist_management', $event->id) == 1)
<section class="services-tab-sec ">
    <div class="container">
  
       <div class="sec-card">
            <div class="tab-content">
                <!-- tab 3 content -->
                <div class="tab-data" id="twenty-three">
                    <div class="checklist-wrap">
                        <span class="aside-toggle">
                            <i class="fa fa-bars"></i>
                            <span class="cross-class">
                                <i class="fas fa-times"></i>
                            </span>
                        </span>
                        
                        <div class="row">
                            @include('tools.checklist.includes.sidebar')
                            <div class="col-md-9 col-sm-9">
                                <div class="eventlist-text">
                                    <div class="event-task">
                                        <a href="javascirpt:void(0);" 
                                        data-toggle="modal" data-target="#addNewTaskModal" class="task-btn">
                                            Add a New task<span><i class="fas fa-plus"></i></span>
                                        </a>
                                        
                                        <div class="icons">
                                            <a href="{{route('user.tool.getPDFTaskContent',$event->slug)}}">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                            <a href="{{route('user.tool.getprintTaskContent',$event->slug)}}" target="_blank" >
                                                <i class="fas fa-print"></i>
                                            </a>
                                             <a target="_blank" href="javascript:void(0)" title="Calculator" data-toggle="modal" data-target="#calculator_modal">
                                                 <i class="fas fa-calculator"></i>
                                              </a> 
                                        </div>
                                    </div>
                                </div>
                                <div class="planning-list-wrap main-planning-list" id="loadCheckListTasks">
                                        
                               </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how-its-work-sec tool-works">
    <div class="container">
        <div class="sec-heading text-center">          
            <h2>{{$checklist_video_title}}</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="video-container">
                    <figure>
                        <video class="video" id="bVideo" loop="" width="100%" height="100%" poster="{{ $checklist_video_poster ? url('/uploads').'/'.$checklist_video_poster : '/frontend/images/video-poster.png'}}">
                            <source src="{{ $checklist_video ? url('/uploads').'/'.$checklist_video : '/frontend/videos/Dummy Video.mp4' }}" type="video/mp4">
                        </video>

                        <div id="playButton" class="playButton" onclick="playPause()">                            
                            <span><i class="fas fa-play-circle"></i></span>                     
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- banner section starts Ends here -->           


@else
<section class="services-tab-sec">

    <div class="container">
        <div class="sec-card">
            <div class="tab-wrap">
                You are not autorised to access this page.
            </div>
        </div>
    </div>
</section>
@endif
@include('tools.checklist.includes.calculator')
     
@endsection


@section('scripts')
    @if(!empty($_GET['id']))
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                var id = "<?php echo $_GET['id']; ?>";
                $('body').find('#task-'+id).trigger("click");
            }, 500);
        });
    </script>
    @endif
    <script type="text/javascript" src="{{url('/tools/checklist/script.js')}}"></script>
    <script type="text/javascript" src="{{url('/pintable/dist/jQuery.print.min.js')}}"></script>
    <script type="text/javascript">
             let $status = parseInt($("body").find('#chooseTaskModalStatus').val());
             function chooseTaskModalShow() {
                 var $modal = $("body").find('#chooseTaskModal');
                    $modal.modal({
                        backdrop: 'static',
                        keyboard: false
                    });
             }

                 $(".js-select2").select2();
                 $(".js-select2-multi").select2();

  $(".large").select2({
    dropdownCssClass: "big-drop",
  });
      
    </script>

<script>
    $(".resetRadio").on("click",(e)=>{  $(`input[name='${e.target.dataset.target}[]']`).attr('checked',false);   })
</script>
    @include('tools.checklist.includes.calculatorscript')
@endsection
