@extends('layouts.admin')
 
@section('content')
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h5 class="m-b-10">{{ $title }}</h5>
          </div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{$addLink}}">View</a></li>             
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
              <form  method="post" action="{{route('admin.slider.edit',$slider->id)}}" id="SliderBannerForm" enctype="multipart/form-data" >
                  @csrf
              <div class="row" style="width:100%;">
                  <div class="col-lg-12">
                      {{textareackeditor($errors,'Description','description',$slider->Description??"")}}  
                  </div>
                  <div class="col-md-12">
                        <div class="form-group">
                        <input type="text" id="url" class="form-control" name="url"
                        placeholder="Enter Redirection Url"
                        value="{{$slider->redirection_url ?? ''}}">
                     </div>
                  </div>

               <div class="col-md-12">
               <img src="{{url($slider->background_image??'')}}" id="image_src" style="width: 100%; display: <?php if($slider->background_image)echo "block"; else echo "none"; ?>;"
               />
                 <div class="form-group">
                <label class="label-file">Slider Image*</label>
               <input type="file" accept="image/*" id="banner_image" onchange="ValidateSingleInput(this, 'image_src')"   class="form-control" name="banner_image">
              </div>
              </div>

              </div>
                  <div class="card-footer">
                    <button type="submit" id="SliderFormBtn" class="btn btn-primary">Update</button>
                  </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    
@endsection

@section('scripts')
<script src="{{url('/admin-assets/js/validations/sliderValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection
