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
                    <li class="breadcrumb-item "><a href="{{ url($addLink) }}">View</a></li>
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

                    <form role="form" action="{{route('admin.banner.home.setting.create')}}" method="post" id="banner" enctype="multipart/form-data">
                                  <div class="card-body">
<div class="row">
                                         @csrf
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="label-file">Title</label>
                                              <input type="text" name="title" >
                                            </div>
                                        </div>
       
<!--          <div class="col-md-12">
         <img src="{{url($homebanner->background_image??'')}}" id="image_src" style="width: 300px; height: 300px; display: none;"
         />
            <div class="form-group">
            <label class="label-file">Banner Background Image*</label>
            <input type="file" accept="image/*" id="banner_image" onchange="ValidateSingleInput(this, 'image_src')" class="form-control" name="banner_image">
           </div>
            </div> -->

            </div>
     </div>                                 
      </div>
      <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" id="categoryFormSbt" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/categoryValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>

@endsection
