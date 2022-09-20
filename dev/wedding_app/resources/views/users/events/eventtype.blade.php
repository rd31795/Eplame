
@extends('users.layouts.layout')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Event Types</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('user_events')}}">Events</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Event Types</a></li>
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
                  <div class="card-body event-types-wrapper">
                       <div class="col-md-12">
                            <form role="form" method="post" id="UserEventForm" enctype="multipart/form-data">
                                  @csrf
                               <div class="row">   
                                <div class="col-md-4">
                                 <div class="form-group">
                                  <a href="{{ route('user_in_person_event') }}" data-toggle="tooltip" data-placement="top" data-original-title="You can create the In person Event by click on image."><img src="https://eplame.com/dev/images/events/event.png" id="Myimg" class="my-img-grp" ></a>
                                  </div>
                                  <h4>In person</h4>
                                </div> 
                                  <div class="col-md-4">
                                 <div class="form-group">
                                  <?php $id=1; ?>
                                  <a href="{{ route('user_virtual_event',$id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="You can create the virtual Event by click on image."><img src="https://eplame.com/dev/images/events/virtual-event.png" id="Myimg1" class="my-img-grp" ></a>
                                  </div>
                                 <h4>Virtual Event</h4>
                                </div>
                                  <div class="col-md-4">
                                 <div class="form-group">
                                  <a href="{{ route('user_hybrid_event') }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="You can create the Hybrid Event by click on image."> <img src="https://eplame.com/dev/images/events/hybrid.png" id="Myimg1" class="my-img-grp"></a>
                                  </div>
                                  <h4>Hybrid Event</h4>
                                </div>        
                              </div>
                            </form>
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

<!-- First User Modal -->
<div class="modal fade" id="firstUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-5">
                        <figure class="about-event-img">
                            <img src="{{ asset('/frontend/images/event-form-img.png') }}">
                            <div class="form-img-cont text-center">
                                <h2 class="modal-title">CONGRATULATIONS</h2>
                                <p>Let’s Help Plan Your Event <br> we are always a step ahead</p>
                            </div>
                        </figure>
                    </div>
                    <div class="col-lg-7">
                        <div class="first-user-form">

                            <section class="multi_step_form haveFiveSteps">
                                <div id="msform">
                                    <ul id="progressbar">
                                        <li class="step-item stp-1 active"></li>
                                        <li class="step-item stp-2 "></li>
                                        <li class="step-item stp-3 "></li>
                                        <li class="step-item stp-4 "></li>
                                        <li class="step-item stp-5 "></li>
                                    </ul>
                                </div>
                            </section>
                            <input type="hidden" name="progressbar" value="1">

                            <div class="card-heading">
                                <h3>Lets talk about your event.</h3>
                            </div>

                            <div class="step1 stepForm">
                                @include('users.includes.welcome_popup.stepOne')
                            </div>

                            <div class="step2 stepForm">
                                @include('users.includes.welcome_popup.stepSecond')
                            </div>

                            <div class="step3 stepForm">
                                @include('users.includes.welcome_popup.step3')
                            </div>

                            <div class="step4 stepForm">
                                @include('users.includes.welcome_popup.step4')
                            </div>

                            <div class="step5 stepForm">
                                @include('users.includes.welcome_popup.step5')
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" id="login_count" value="{{Auth::user()->login_count}}">

     
@endsection




@section('scripts')
<style>
#UserEventForm .form-group .my-img-grp {
    height: 130px;
    margin: 0 auto;
    display: block;
}
#UserEventForm h4 {
    text-align: center;
    font-size: 18px;
    font-weight: 600;
}
.event-types-wrapper {
  height: 420px;
  display: flex;
  align-items: center;
}
</style>
<script src="{{url('clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{url('/js/comingsoon.js')}}"></script>
<script src="{{url('/js/setLatLong.js')}}"></script>
<script src="{{url('/js/welcome_popup.js')}}"></script>
<script src="{{ asset('/js/userEventColor.js') }}"></script>
<script>
//   $(document).ready(function(){
//   $('#Myimg').click(function(){
//       $('#firstUserModal').modal('show')
//   });
// });
  $(document).ready(function(){
var styval = $('#style_type').val();
if(styval == 0){
    $('#style-field-1').css('display', 'block');
    $('#style-field-3').css('display', 'block');
  }else{
    $('#style-field-1').css('display', 'none');
    $('#style-field-3').css('display', 'none');
  }
});


$('#style_type').change(function(){
  var val = $(this).val();
  if(val == 0){
    $('#style-field-1').css('display', 'block');
    $('#style-field-3').css('display', 'block');
  }else{
    $('#style-field-1').css('display', 'none');
    $('#style-field-3').css('display', 'none');
  }
});
</script>

@endsection

