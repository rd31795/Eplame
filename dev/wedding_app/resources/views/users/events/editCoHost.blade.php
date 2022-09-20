@extends('users.layouts.layout')
@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Edit Co-Host</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="{{ route('user_show_detail_event', $user_event->slug) }}">Event</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Edit Co-Host</a></li>
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

  <form role="form" method="post" id="coHostForm" action="{{route('user_update_co_host', $cohost->id)}}" class="co-host">
    @csrf
        <div class="row">
          
        <div class="col-md-6 stat-name">
              <label for="name">Name*</label>
              <input type="text" name="name" class="form-control" placeholder="Name*" value="{{$cohost->cohost_name}}">
            </div>
            <div class="col-md-6 stat-name">
              <label for="relation">Relation*</label>
              <input type="text" name="relation" class="form-control" placeholder="Relation*" value="{{$cohost->relation}}">
            </div>
      </div>
      <h3 class="pt-5 pb-3">Capabilities</h3>
      <div class="row">
          <div class="col-md-12">
            <label class="container-c">Event Sharing
              <input type="checkbox" id="event_sharing" name="event_sharing" value="1" @if($cohost->event_sharing == 1) checked @endif>
              <span class="checkmark"></span>
            </label>
            <!-- <input type="checkbox" id="event_sharing" name="event_sharing" value="1" @if($cohost->event_sharing == 1) checked @endif>
            <label for="event_sharing">Event Sharing</label> -->
          </div>
          <div class="col-md-12">
            <label class="container-c">Guest Management
              <input type="checkbox" id="guest_management" name="guest_management" value="1" @if($cohost->guest_management == 1) checked @endif>
              <span class="checkmark"></span>
            </label>

            <!-- <input type="checkbox" id="guest_management" name="guest_management" value="1" @if($cohost->guest_management == 1) checked @endif>
            <label for="guest_management">Guest Management</label> -->
          </div>
          <div class="col-md-12">
            <label class="container-c">Checklist Management
               <input type="checkbox" id="checklist_management" name="checklist_management" value="1" @if($cohost->checklist_management == 1) checked @endif>
              <span class="checkmark"></span>
            </label>

            <!-- <input type="checkbox" id="checklist_management" name="checklist_management" value="1" @if($cohost->checklist_management == 1) checked @endif>
            <label for="checklist_management">Checklist Management</label> -->
          </div>
          <div class="col-md-12">
            <label class="container-c">Budget Management
               <input type="checkbox" id="budget_management" name="budget_management" value="1" @if($cohost->budget_management == 1) checked @endif>
              <span class="checkmark"></span>
            </label>

            <!-- <input type="checkbox" id="budget_management" name="budget_management" value="1" @if($cohost->budget_management == 1) checked @endif>
            <label for="budget_management">Budget Management</label> -->
          </div>
          <div class="col-md-12">
            <label class="container-c">Hire Vendors
               <input type="checkbox" id="vendor_management" name="vendor_management" value="1" @if($cohost->vendor_management == 1) checked @endif>
              <span class="checkmark"></span>
            </label>

            <!-- <input type="checkbox" id="budget_management" name="budget_management" value="1" @if($cohost->budget_management == 1) checked @endif>
            <label for="budget_management">Budget Management</label> -->
          </div>
          <div class="col-md-12">
            <label class="container-c">Edit Event
               <input type="checkbox" id="event_management" name="event_management" value="1" @if($cohost->event_management == 1) checked @endif>
              <span class="checkmark"></span>
            </label>

            <!-- <input type="checkbox" id="budget_management" name="budget_management" value="1" @if($cohost->budget_management == 1) checked @endif>
            <label for="budget_management">Budget Management</label> -->
          </div>
      </div>
       <h3 class="pt-4 pb-3">Status</h3>
      <div class="row my-row">
          <div class="col-md-12">
            <label class="container-r">Active
              <input type="radio" value="1" id="status_active" name="status" @if($cohost->status == 1) checked @endif>
              <span class="checkmark1"></span>
            </label>
            <!-- <input type="radio" value="1" id="status_active" name="status" @if($cohost->status == 1) checked @endif>
            <label for="status_active">Active</label> -->
          </div>
          <div class="col-md-12">
            <label class="container-r">In-Active
             <input type="radio" value="0" id="status_inctive" name="status" @if($cohost->status == 0) checked @endif>
              <span class="checkmark1"></span>
            </label>

            <!-- <input type="radio" value="0" id="status_inctive" name="status" @if($cohost->status == 0) checked @endif>
            <label for="status_inctive">In-Active</label> -->
          </div>
      </div>

      <div class="card-footer cstm-card-ftr">
        <button type="submit" id="coHostFormBtn" class="cstm-btn">Update</button>
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
<script>

  $("#coHostForm").validate({
  rules: {
    name: {
      required: true,
      minlength: 2,
      maxlength: 40,
      lettersonly: true
    },
    relation:{
      required: true,
      minlength: 2,
      maxlength: 40
    }
  },
});

$('#coHostFormBtn').click(function(){
    $(this).attr('disabled', true);
    if($('#coHostForm').valid()){
        $('#coHostForm').submit();
    }else{
        $(this).attr('disabled', false);
        return false;
    }   
});



</script>
@endsection


