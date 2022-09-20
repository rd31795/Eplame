@extends('users.layouts.layout')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Edit Event</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="@if(Auth::user()->id == $user_event->user_id) {{ route('user_events') }} @else {{ route('user_co_events') }} @endif">Events</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Edit Event</a></li>
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

  <form role="form" method="post" id="UserEventForm" enctype="multipart/form-data">
    @csrf
        <div class="row">
          <div class="col-md-12">
           {{textbox($errors, 'Title*', 'title', $user_event->title)}}
         </div>

          <div class="col-md-12">
           {{textarea($errors, 'Description*', 'description', $user_event->description)}}
           </div>
          <!--<div class="col-md-6">
            {{textarea($errors, 'Long Description*', 'long_description', $user_event->long_description)}} 
           </div>-->
            @if($user_event->location != '')
         <div class="col-md-12">
           {{textbox($errors, 'Event Location*', 'location', $user_event->location)}}
           </div>
         <div class="col-md-6" style="display: none">
           {{textbox($errors, 'Latitude*', 'latitude', $user_event->latitude)}}
           </div>
         <div class="col-md-6" style="display: none">
           {{textbox($errors, 'Longitude*', 'longitude', $user_event->longitude)}}
         </div>
         @endif
         <div class="col-md-6" style="pointer-events: none;">
           {{datebox($errors, 'Start Date*', 'start_date', date('Y-m-d',strtotime($user_event->start_date)))}}
           </div>
          <div class="col-md-6" style="pointer-events: none;">
           {{datebox($errors, 'End Date*', 'end_date', date('Y-m-d',strtotime($user_event->end_date)))}}
           </div>


           <div class="col-md-6">

             <div class="form-group">
                 <label>Event Anticipated Start Time </label>
                    <input type="text" id="start_time" autocomplete="false"  data-format="hh:mm A" class="input-small form-control" name="start_time" value="{{$user_event->start_time != '' ? $user_event->start_time : old('start_time')}}">
                    <p class="error">{{$errors->first('start_time')}}</p>
              </div>
           </div>

           <div class="col-md-6">
              <div class="form-group">
                 <label>Event Anticipated End Time </label>
                    <input type="text" id="end_time" autocomplete="false" value="{{$user_event->end_time != '' ? $user_event->end_time : old('end_time')}}" data-format="hh:mm A" class="input-small form-control" name="end_time">
                    <p class="error">{{$errors->first('end_time')}}</p>
              </div>
           </div>


           <div class="col-md-12">
           {{textbox($errors, 'Max Person*', 'max_person', $user_event->max_person)}}
           </div>
            <div class="col-md-6">
           {{datebox($errors, 'Registration Deadline Date', 'reg_start_date', $user_event->reg_date)}}
           </div>
          <div class="col-md-6">
           <div class="form-group">
              <label>Time</label>
              <div class='input-group date'>
                 <input type="text" id="reg_start_time"  class="form-control" name="reg_start_time">
              </div>
              </div>
           </div>

            <!-- <div class="col-md-6">
           {{textbox($errors, 'Seasons*', 'seasons', $user_event->seasons)}}
           </div> -->

            <div class="col-md-12">
             <!-- {{choosefile($errors, 'Event Image*', 'event_picture')}} -->
             <div class="form-group ">
             <div class="profile-image">
                <label class="label-file">Event Image*</label>
                         <input type="file" name="event_picture" accept="image/*" onchange="ValidateSingleInput(this, 'image_src')" id="event_picture" class="form-control">
                          @if ($errors->has('event_picture'))
                              <div class="error">{{ $errors->first('event_picture') }}</div>
                          @endif
                   </div>
                 </div>
           </div>

@if($user_event->event_picture !="")
<div class="col-md-12">
    <div class="form-group ">
 <img src="{{url($user_event->event_picture)}}" id="image_src" width="120">
</div>
</div>
@endif








      </div>

      <div class="card-footer cstm-card-ftr">
        <button type="submit" id="UserEventFormBtn" class="cstm-btn">Update</button>
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

     
@endsection



@section('scripts')
<style>
span.glyphicon.glyphicon-chevron-up {
    display: flex!important;
    align-items: center;
    justify-content: center;
}
span.glyphicon.glyphicon-chevron-down {
    display: flex!important;
    align-items: center;
    justify-content: center;
}
.glyphicon-chevron-up:before {
    content: "\f077";
    font-weight: 900;
    font-family: 'Font Awesome 5 Free';
}
.glyphicon-chevron-down:before {
    content: "\f078";
    font-weight: 900;
    font-family: 'Font Awesome 5 Free';
}
</style>
<script src="{{url('/js/setLatLong.js')}}"></script>
<script src="{{url('/js/validations/virtualHybridEventValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script src="{{ asset('/js/userEventColor.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

  <script type="text/javascript">
    $.noConflict();
  jQuery(document).ready(function ($) {

    $('#start_time').datetimepicker({
      format: 'LT'
    });
  });
    jQuery(document).ready(function ($) {

    $('#end_time').datetimepicker({
      format: 'LT'
    });
  });  
     jQuery(document).ready(function ($) {

    $('#reg_start_time').datetimepicker({
      format: 'LT'
    });
  });

  $('#event_categories').select2({ 
    closeOnSelect: false
   });


$('#event_categories').on('select2:select', function (e) {
    $(this).parent().find('label').eq(1).css('display', 'none');
});

$('select[name="event_type"]').change(function() {
    const selectedEvent = $(this).children("option:selected").val();
    $('#event_categories').empty();
     getCat(selectedEvent);
});

function getCat(selectedEvent) {
  $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{route('user_get_event_categories')}}",
        type: "post",
        dataType: "JSON",
        data: { '_token': $('meta[name="csrf-token"]').attr('content'), 'id': selectedEvent },
        success: function(res)
        {
          $.each(res.category_variation, function(key, value) {
            $('#event_categories')
            .append($("<option></option>")
            .attr("value", value.category.id)
            .text(value.category.label)); 
          });
          setTimeout(() => {
            $('#event_categories').val(JSON.parse($('#sel_cats').val()));
            $('#event_categories').trigger('change');
          }, 100)
        },
        error: function(err) {
            console.log(err);
        }
    });
}
getCat($('#sel_eve_id').val());

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

// Get Current color and append the value in next input
// function loadColorJQ() {
//     $('.ColorGet').on('change', function() { 
//       var val = $( this ).val();
//       $( this ).next().val(val);
//     });
//   }
// loadColorJQ();

// Add Remove multiple color for event
// $(document).ready(function(){

 //  const coloursArr = JSON.parse($('#coloursArr').val());
 //  const plus = `<li id="plus">
 //                    <a href="javascript:void(0)" id="AddNewColorEventEdit" class="action_btn primary-btn" data-toggle="tooltip" title="" data-original-title="Add new Color">
 //                      <i class="fas fa-plus"></i>
 //                    </a>
 //                  </li>`;

 //  $("#AddNewColorEventEdit").click(function(){
 //    coloursArr.push('new');
 //    console.log('kkk');
 //  // Finding total number of elements added
 //  var total_element = $(".element").length;
 //  var lastid = $(".element:last").attr("id");
 //  var split_id = lastid.split("_");
 //  var nextindex = Number(split_id[1]) + 1;

 //  var max = 4;
 //  // Check total number elements
 //  if(total_element < max ){
 //   // Adding new div AddRemoveColorEvent after last occurance of element class
 //   $(".element:last").after("<div class='element col-lg-3 col-md-6' id='div_"+ nextindex +"'></div>");
 
 //   // Adding element to <div>
 //   $("#div_" + nextindex).append('<div class="form-group"><input type="color" class="ColorGet" style="width: 46px; margin-left: -2px;"><input type="text" readonly value="{{old('colour')}}" class="form-control ColourSelect" name="colour[]"> <ul class="acrdn-action-btns"><li><a href="javascript:void(0)" id="remove_'+nextindex+'" class="action_btn danger-btn remove_color_event" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fas fa-trash-alt"></i></a></li></ul></div>'); 
 //  }
 //  // Load get solor function to select color
 //  loadColorJQ(); 
 // });

  // Remove element
  // $("#AddRemoveColorEvent").on('click','.remove_color_event',function() {
  //   coloursArr.pop();
  //   if(coloursArr.length === 1) {
  //     // $('.acrdn-action-btns').hide();
  //     $('.acrdn-action-btns').html(plus);
  //   } 

  //   if(coloursArr.length > 1 && coloursArr.length < 4) {
  //     $('.acrdn-action-btns').show();
  //   }

  //   var id = this.id;
  //   var split_id = id.split("_");
  //   var deleteindex = split_id[1];
  //   // Remove <div> with id
  //   const divId = "#div_" + deleteindex;
  //   $(divId).remove();

  //   // const color = $(divId).find('Input').val();
    
  // });


// });
</script>
@endsection


