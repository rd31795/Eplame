@extends('vendors.management.layout')
@section('vendorContents')

<div class="container-fluid">


 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">{{$title}}</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                
            </ul>
        </div>
  </div>

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
            <div class="card-header">
              <h3>{{$title}} </h3>
            </div>
                 <div class="card-body">
                 @include('admin.error_message')  
                     <form method="post" id="UserEventForm" enctype="multipart/form-data">
                          @csrf
                         	<div class="row"> 
                           <div class="col-lg-6">
                            {{textbox($errors, 'Start Date*' , 'start_date')}}
                           </div>
                           <div class="col-lg-6">
                           {{textbox($errors, 'End Date*' , 'end_date')}}
                           </div>
                         </div>
                         <div class="form-group mt-4 col-lg-12"><button id="UserEventFormBtn" type="submit" class="cstm-btn">Saves</button></div>
                   </form>
                </div>
           </div>
         </div>
     </div>
 </div>
 
</div>
@endsection

@section('scripts')

<script src="{{url('/js/validations/userEventValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
  $( function() {
    $( "#start_date" ).datepicker({
      minDate: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#end_date").datepicker("option", "minDate", dt);
        }
    });
    $( "#end_date" ).datepicker({
       dateFormat: 'yy-mm-dd',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#start_date").datepicker("option", "maxDate", dt);
        }
    });
  } );
  </script>
<script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', function() {
                var start_date =  document.getElementById('start_date').value; 
                var end_date =  document.getElementById('end_date').value;             
                $.ajax({
                    type: 'get',
                    url: '{{ route("vendors.vacation.ajaxValidation") }}',
                    data: { 'start_date': start_date,'end_date': end_date },
                    dataType: 'json',      //return data will be json
                    success: function(data) {
                      
                      alert(data);
                    },
                    error:function(){

                    }
                });
            });
        });
</script>
@endsection
