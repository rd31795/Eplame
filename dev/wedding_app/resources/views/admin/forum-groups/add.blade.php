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

  <form role="form" method="post" id="forumgroupForm" action="{{url(route('store_forum_group'))}}" enctype="multipart/form-data">
                
      @csrf
      
        {{textbox($errors,'Group Name*','label')}}
        
        {{textarea($errors,'Description*','description')}}

        <div class="form-group">
          <label>Thumbnail Image* </label>
          <input type="file" required accept="image/*" onchange="ValidateSingleInput(this, 'image_src')" name="thumbnail" id="selImage">
          @if ($errors->has('thumbnail'))
              <div class="error">{{ $errors->first('thumbnail') }}</div>
          @endif
        </div>
        <img src="" id="image_src" style="width: 100px; height: 100px; display: none"/>

        <div class="form-group">
          <label>Cover Image* </label>
          <input type="file" required accept="image/*" onchange="ValidateSingleInput(this, 'image_src1')" name="cover_img" id="cover_img">
          @if ($errors->has('cover_img'))
              <div class="error">{{ $errors->first('cover_img') }}</div>
          @endif
        </div>
        <img src="" id="image_src1" style="width: 100px; height: 100px; display: none"/>

    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" id="ForumgroupFormSbt" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/forumgroupValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection


 
