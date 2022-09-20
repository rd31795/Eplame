@extends('users.layouts.layout')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Reschedule Event</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="@if(Auth::user()->id == $user_event->user_id) {{ route('user_events') }} @else {{ route('user_co_events') }} @endif">Events</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Reschedule Event</a></li>
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
       @if(!empty($message))
         <div class="row">
               <div class="col-md-12">
                     <div class="alert alert-success" role="alert">
                      {{$message}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                 </div>
          </div>
         @endif
            <div class="card-body">
             
<div class="col-md-12">

  <form role="form" method="post" id="UserEventForm" enctype="multipart/form-data">
    @csrf
        <div class="row">

           <div class="col-md-6">
           {{datebox($errors, 'Start Date*', 'start_date', date('Y-m-d',strtotime($user_event->start_date)))}}
           </div>
          <div class="col-md-6">
           {{datebox($errors, 'End Date*', 'end_date', date('Y-m-d',strtotime($user_event->end_date)))}}
           </div>


      </div>

      <div class="card-footer cstm-card-ftr">
        <button type="submit" id="UserEventFormBtn" class="cstm-btn">Reschedule Event</button>
      </div>
   </form>

  </div>
         @if(!empty($vendor_details))
                       <h4 class="mb-3">Hired Vendors Details are given below</h4>
                      <div class="narinder-detail-sec">
                        <div class="narinder-detail"> 
                         
                          Vendor Name - {{$vendor_details->name}} <br>
                          Email - {{$vendor_details->email}} <br>
                          Phone Number -  {{$vendor_details->phone_number}} <br>
                          Address -{{$vendor_details->user_location}}<br>
                            <a href="javascript:;" onClick="jqac.arrowchat.chatWith({{$vendor_details->id}});" class="running-status cstm-btn solid-btn running-status2">
                            <span data-toggle="tooltip" title="Chat with vendor regarding reschedule event"><i class="far fa-comment"></i></span>
                            </a>
                         
                       </div>
                     </div>
              @endif

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
<script src="{{url('clockface/js/clockface.js')}}" type="text/javascript"></script>
<script src="{{url('/js/setLatLong.js')}}"></script>
<script src="{{url('/js/validations/userEventValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
<script src="{{ asset('/js/userEventColor.js') }}"></script>
<style type="text/css">
  .narinder-detail {
    width: 33%;
    margin-left: 5px;
    margin-right: 5px;
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 5px;
    background: #CAE4E8;
    box-shadow: 0 0 5px rgb(0 0 0 / 20%);
    color: #000;
    font-weight: 600;
    line-height: 1.8;
  } 
.narinder-detail-sec {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
}
.narinder-detail .running-status2 {
    margin: 10px auto 0!important;
    padding: 5px 10px;
    max-width: 35px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<script type="text/javascript">
  $('#start_time').clockface();
  $('#end_time').clockface();

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


