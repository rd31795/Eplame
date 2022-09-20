@extends('users.layouts.layout')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">{{$events->title}}</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('user_events')}}">Events</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Event Videos</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- /.card-header -->
        @include('admin.error_message')
        <div class="card-body">
          <div class="col-md-12">
            <form method="post" action="{{ route('user.event.post_videos', $events->slug) }}" id="video_upload_form" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="video_url" class="">Video URL*</label>
                <div class="input-group">
                  <input type="text" name="video_url" id="video_url" placeholder="Enter the Youtube Video embed URL"><a target="_blank" href="{{url('/faq')}}"><i class="fas fa-info-circle"></i></a>
                </div>
                <div class="input-group">
                  <input type="submit" name="Submit" id="video_upload_formBtn" value="submit">
                </div>
              </div>
            </form>
            <div class="row" id="getListing">
              @if(!empty($videos[0]->id))
                @foreach($videos as $video)
                  <div class="col-lg-4">
                    <div class="gallery-card">
                      <div class="image-gallery-container">
                        <iframe width="300" height="300" src="{{$video->file_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                
                        <div class="card-info">
                          <ul class="acrdn-action-btns">
                            <li><a data-toggle="tooltip" title="Delete" onclick="deleteItem(this)" href="javascript:void(0)" 
                              data-delurl="{{route('user.event.video.delete',[$events->slug, $video->id])}}" class="action_btn deleteBtn danger-btn"><i class="fas fa-trash-alt"></i></a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              <div class="col-md-12"> 
                   
                {{$videos->links()}}

              </div>     
              @else
                <div class="col-md-12">
                  <div class="alert alert-warning" role="alert">Your Video Gallery do not have any video yet.</div>
                </div>
              @endif
            </div> 
          </div>
        </div>
    <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
      <!-- /.row -->
</section>



     
@endsection
@section('scripts')
<script src="{{url('/js/validations/eventvideos.js')}}"></script>
<script type="text/javascript">



/*$("body").on('click','a.page-link',function(e){
  e.preventDefault();
  var url = $( this ).attr('href');
});*/




$("body").on('click','a.deleteBtn',function(e){
  e.preventDefault();
  var url = $( this ).attr('data-delurl');
});



/*____________________________________________________________________________________________________
|
|
|_____________________________________________________________________________________________________
*/





</script>
 
@endsection
