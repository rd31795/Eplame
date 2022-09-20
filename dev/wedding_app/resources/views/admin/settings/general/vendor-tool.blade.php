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
                    <li class="breadcrumb-item">
                      <a href="{{url(route('admin_dashboard'))}}">
                      <i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item "><a href="{{ route($addLink) }}">View</a></li>
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Edit</a></li>
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
            <form role="form" method="post" id="vendorForm" action="" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="type" value="{{Request::route('id')}}">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Banner Settings</h5>
                   {{textbox($errors,'Page Title*', 'vendor_title', $vendor_title)}}
                   {{textbox($errors,'Page Tagline*', 'vendor_tagline', $vendor_tagline)}}
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Tutorial Section</h5>
                   {{textbox($errors,' Title*', 'vendor_video_title', $vendor_video_title)}}

                   <div class="form-group">
                    <label class="label-file">Video Poster*</label>
                    <input type="file" accept="image/*" onchange="ValidateSingleInput(this, 'video_poster_src')" class="form-control" name="vendor_video_poster">
                   </div>

                   <img src="{{ url('/uploads').'/'.$vendor_video_poster }}" id="video_poster_src" style="width: 100px;" />

                    <div class="form-group">
                    <label class="label-file">Video*</label>
                    <input type="file" class="form-control" name="vendor_video">
                   </div>    
                   <video width="320" height="240" controls>
                      <source src="{{ url('/uploads').'/'.$vendor_video }}" type="video/mp4">
                      <source src="{{ url('/uploads').'/'.$vendor_video }}" type="video/ogg">
                    </video>     
                </div>
            </div>
            <div class="card-footer">
              <button type="submit" id="vendorFormBtn" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/settings/vendorValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection