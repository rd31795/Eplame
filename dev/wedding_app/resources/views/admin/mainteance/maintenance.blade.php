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

                    <form role="form" action="{{route('admin.maintenance_settings')}}" method="post" id="maintenanceForm" enctype="multipart/form-data">
                                  <div class="card-body">
<div class="row">
                                         @csrf
         <div class="col-md-12">
         	<div class="form-group">
                   <input type="text" id="page_title" class="form-control" name="page_title"
                   placeholder="Enter Page Title"
                   value="{{$maintenance->page_title??''}}">
            </div>
         </div>

          <div class="col-md-12">
          <div class="form-group">
             {{textarea($errors,'Description','description',$maintenance->description)}}
            </div>
         </div>


 <div class="col-md-12">
         <img src="{{url($maintenance->image??'')}}" id="image_src" style="width: 300px; height: 300px; display: {{$maintenance->image?'block':'none'}};"
         />
            <div class="form-group">
            <label class="label-file">Site Maintenance Image*</label>
            <input type="file" accept="image/*" id="maintenance_image" onchange="ValidateSingleInput(this, 'image_src')" class="form-control" name="maintenance_image">
           </div>
            </div>
            </div>
     </div>                                 
      </div>
      <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" id="maintenanceSbt" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/maintenance.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>

@endsection
