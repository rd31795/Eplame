
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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Event Album</a></li>
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
                          <form method="post" id="upload_form" enctype="multipart/form-data">
             {{ csrf_field() }}
                              <div class="form-group">
                                <label for="file" class="sr-only">File</label>
                                <div class="input-group">
                                  
                                  <span class="input-group-btn">
                                    <div class="btn btn-default  custom-file-uploader">
                                      <input type="file" class="custom-file-input" name="file[]" multiple="" accept="image/*" id="select_file" >     
                              <!-- onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''"  -->
                                      Select a file
                                    </div>
                                  </span>
                                </div>
                              </div>
                       <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                          <span class="sr-only">0% Complete</span>
                        </div>
                      </div>
                       
      </form>









<div class="row" id="getListing"> 
</div>  
  

                      </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>



     
@endsection



@section('scripts')
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script type="text/javascript">


  getList();
  
  $('body').on('change','#select_file', function(e){
        var form = $('body').find('#upload_form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        var percent = $('body').find('.percent');
        var bar = $('.bar');



         $.ajax({
           url:"{{ url(route('user.event.album',$events->slug)) }}",
           method:"POST",
           data:formData,
           dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           beforeSend: function() {
            
               $('body').find('.progress').show();
               $('.progress').find('span.sr-only').text('0%');

          },
           xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $('.progress').find('span.sr-only').text(percentComplete + '%');
                    $('.progress .progress-bar').css('width', percentComplete + '%');
                }
            }, false);
            return xhr;
          },
           success:function(data)
           {
            $('#globalMessages').html('');
            console.log(data.html);
            if(data.status == 1){
                  $('body').find('.progress').hide();
                  $('.progress').find('span.sr-only').text('0%');
                   $('.progress .progress-bar').css('width','0%');
                    form.reset();
                     getList();

                

            }else{
                $('body').find('.progress').hide();
                  $('.progress').find('span.sr-only').text('0%');
                   $('.progress .progress-bar').css('width','0%');
                $('body').find('#globalMessages').css('display', 'block');

                 $('#globalMessages').html(data.message);

        

            }

           }

          });
    });



$("body").on('click','a.page-link',function(e){
    e.preventDefault();
    var url = $( this ).attr('href');
    getList(url);
});




$("body").on('click','a.deleteBtn',function(e){
    e.preventDefault();
    var url = $( this ).attr('data-delurl');
    getList(url);
});



/*____________________________________________________________________________________________________
|
|
|_____________________________________________________________________________________________________
*/

function getList(link="{{ url(route('user.event.album.ajax',$events->slug)) }}") {

  
  
         $.ajax({

           url:link,
           method:"GET",
          
           dataType:'JSON',
           beforeSend: function() {
            
               $("body").find('.loading-div').show();

           },
           success:function(data)
           {
             $('#getListing').html(data);
           },
            complete: function() {
            
               $("body").find('.loading-div').hide();

           }

          });
}





</script>
 
@endsection
