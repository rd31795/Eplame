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
                          <input type="hidden" name="vacation_id" id="vacation_id" value="{{$vacation->id}}"/>
                         <div class="row"> 
                           <div class="col-lg-6">
                            {{datebox($errors, 'Start Date*' , 'start_date', $vacation->vacation_from)}}
                           </div>
                           <div class="col-lg-6">
                           {{datebox($errors, 'End Date*' , 'end_date', $vacation->vacation_to)}}
                           </div>
                         </div>
                         <input type="hidden" name="vacation_id" id="vacation_id" value="{{$vacation->id}}">
                         <div class="form-group mt-4 col-lg-12"><button id="UserEventFormBtn" type="submit" class="cstm-btn">Save</button></div>
                   </form>
                </div>
           </div>
         </div>
     </div>
 </div>
 
</div>
@endsection

@section('scripts')
<script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', function() {
                var start_date =  document.getElementById('start_date').value; 
                var end_date =  document.getElementById('end_date').value;            
                $.ajax({
                    type: 'get',
                    url: '{{ URL("vendors/vacation/edit/".$vacation->id) }}',
                    data: { 'start_date': start_date,'end_date': end_date},
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
<script src="{{url('/js/validations/userEventValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>

@endsection
