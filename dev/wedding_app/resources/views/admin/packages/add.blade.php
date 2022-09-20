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


@php
   $check_event=$event??false;
@endphp 
<div class="col-md-12">

  <form role="form" method="post" id="ProductPackageForm" action="{{$check_event?url(route('admin.home.event.featured-package.store')):url(route('admin.home.product.featured-package.store'))}}" enctype="multipart/form-data">
      @csrf
        {{textbox($errors,'Title*','title')}}
        {{textareackeditor($errors,'Summary*','featured_summary')}}
        <div class="form-group">
          <label class="control-label" id="package_validity">Package Validity* </label><i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="When the package will expire after purchasing by client ."></i>
          <input type="number" class="form-control" value="1" name="package_validity" id="package_validity" />
        </div>
        <div class="form-group">
          <label for="package_type" >Expiry Type</label><i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Select The Package expiry type like The package will expire in days,months or years"></i>
          <select class="form-control" id="package_type" name="package_type">
            <option value="1">Days</option>
            <option value="2">Months</option>
            <option value="3">Years</option>
          </select>
        </div>
         @if(!$check_event)
        <div class="form-group">
          <label for="catgories" class="control-label">Number of Categories</label><i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="How many categories products a vendor is able to make featured"></i>
          <input type="number" class="form-control" value="1" name="category_count" id="catgories" />
        </div>
        @else
        <div class="form-group">
          <label for="catgories" class="control-label">Event Type</label><i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Check the event type based on that the user events will become featured"></i>
          <label for="inperson_event">Inperson</label>
          <input type="checkbox" name="event_type[]" value=0 id="inperson_event">
          <label for="virtual_event">Virtual</label>
          <input type="checkbox" name="event_type[]"  value=1 id="virtual_event">
          <label for="hybrid_event">Hybrid</label>
          <input type="checkbox" name="event_type[]" value=2 id="hybrid_event">
          <!-- <input type="number" class="form-control" value="1" name="category_count" id="catgories" /> -->
        </div>
        @endif
         <div class="form-group">
          <label class="control-label" id="package_price">Package Price*</label>
          <input type="number" class="form-control" value="1" name="package_price" id="package_price" />
         </div>
        <div class="form-group">
          <label class="control-label">Package Image*</label>
          <input type="file" required accept="image/*" onchange="ValidateSingleInput(this, 'image_src')" name="image" id="selImage">
          @if ($errors->has('image'))
              <div class="error">{{ $errors->first('image') }}</div>
          @endif
        </div>

        <img src="" id="image_src" style="width: 100px; height: 100px; display: none"/>

    <!-- /.card-body -->
    @if($check_event)
      <input type="hidden" name='event' value=1>
    @endif

    <div class="card-footer">
      <button type="submit" id="ProductPackageFormSbt" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/FeaturedPackagesValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection


 
