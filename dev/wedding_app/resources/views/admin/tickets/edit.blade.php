@extends('layouts.admin')
 
@section('content')
@section('style')
<link rel="stylesheet" href="{{url('/css/user.css')}}">
@endsection
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h5 class="m-b-10">{{ $title }}</h5>
          </div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{route($addLink)}}">View</a></li>             
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
              <form  method="post" action="{{route('store_ticket_type',['id'=>$data->id])}}" id="TicketTypeForm" >
              <div class="row" style="width:100%;">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                  @csrf
                     {{textbox($errors, 'type*', 'type',$data->title)}}    
                  </div>
              </div>
              @php
              $assigned_templates=[]; 
              if($data->assigned_templates!='null')
                 $assigned_templates=json_decode($data->assigned_templates);
              @endphp
              <label><strong>Assignee Templates to the ticket type which you are going to create</strong></label>
                       <hr style="border-top: dotted 2px;">
                      <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                     <div class="form-group">
                                        <input type="checkbox" class="schediuler  mt-2" {{in_array(1,$assigned_templates)?"checked":""}} value=1 name="ticket_templates[] ">
                                     </div>
                                      @include('users.tickets.templates.template1')
                         </div>
                         <hr style="border-top: dotted 2px;">
                          <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                     <div class="form-group">
                                        <input type="checkbox" class="schediuler mt-2"  {{in_array(2,$assigned_templates)?"checked":""}} value=2 name="ticket_templates[] ">
                                     </div>
                                      @include('users.tickets.templates.template1')
                         </div>
                         <hr style="border-top: dotted 2px;">
                          <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                     <div class="form-group">
                                        <input type="checkbox" class="scheduler mt-2" {{in_array(3,$assigned_templates)?"checked":""}} value=3 name="ticket_templates[] ">
                                     </div>
                                      @include('users.tickets.templates.template1')
                         </div>
                         <hr style="border-top: dotted 2px;">
                          <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                                     <div class="form-group">
                                        <input type="checkbox" class="schediuler mt-2" {{in_array(4,$assigned_templates)?"checked":""}} value=4 name="ticket_templates[] ">
                                     </div>
                                      @include('users.tickets.templates.template1')
                         </div>
                         <hr style="border-top: dotted 2px;">



                  <div class="card-footer">
                    <button type="submit" id="TicketTypeFormBtn" class="btn btn-primary">Update</button>
                  </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{url('/admin-assets/js/validations/ticketTypeValidation.js')}}"></script>
