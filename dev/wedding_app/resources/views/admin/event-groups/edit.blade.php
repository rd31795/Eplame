@extends('layouts.admin')
 
@section('content')
<div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">{{$title}}</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item "><a href="{{ route($addLink) }}">View</a></li>
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

  <form role="form" method="post" id="groupForm" action="{{url(route('update_group',$groups->slug))}}" enctype="multipart/form-data">
                


                   @csrf
                  
                   {{textbox($errors,'Event Type*','group_label',$groups->group_label)}}
                   <select class="form-control" name="event_type_id">
   
                    <option>Select Event Type</option>
                      
                      @foreach ($events as $event)
                        <option value="{{$event->id}}" {{ ( $event->id == $groups->event_type_id) ? 'selected' : '' }}> 
                            {{ $event->name }} 
                        </option>
                      @endforeach    
                    </select>
                    
              
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="groupFormSbt" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/groupValidation.js')}}"></script>
@endsection
 
