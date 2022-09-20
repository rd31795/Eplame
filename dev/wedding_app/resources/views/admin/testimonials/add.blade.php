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

  <form role="form" method="post" id="testimonialForm" action="{{url(route('store_testimonial'))}}" enctype="multipart/form-data">
                
      @csrf
      
        {{textbox($errors,'Title*','title')}}
        
        {{textarea($errors,'Summary*','summary')}}

        {{selectsimple($errors,'Type*','type',[App\Testimonial::EVENTS => 'Testimonial For Events', App\Testimonial::E_SHOP => 'Testimonial For E-Shop' ])}}

        <div class="form-group">
          <label class="control-label">Thumbnail Image* </label>
          <input type="file" required accept="image/*" onchange="ValidateSingleInput(this, 'image_src')" name="image" id="selImage">
          @if ($errors->has('image'))
              <div class="error">{{ $errors->first('image') }}</div>
          @endif
        </div>
        <img src="" id="image_src" style="width: 100px; height: 100px; display: none"/>

    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" id="testimonialFormSbt" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/testimonialsValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection


 
