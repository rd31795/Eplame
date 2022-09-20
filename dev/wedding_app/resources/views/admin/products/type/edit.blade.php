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
              <form role="form" method="post" action="{{route('admin.products.update.types',$product_type->id)}}" id="ProductTypeEditForm" enctype="multipart/form-data">
              @csrf
              @method('patch')
              <div class="col-lg-6 col-md-6 col-sm-12">
              {{textbox($errors, 'Label*', 'label',$product_type->label)}}  
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
               <img src="{{url($product_type->image??'')}}" id="image_src" style="width: 25%; height: 50%; display: <?php if($product_type->image)echo "block"; else echo "none"; ?>;"
               />
                 <div class="form-group">
                <label class="label-file">Product Type Image*</label>
               <input type="file" accept="image/*" id="product_type_image" onchange="ValidateSingleInput(this, 'image_src')"   class="form-control" name="product_type_image">
              </div>
              </div>       
                <div class="card-footer">
                  <button type="submit" id="ProductTypeEditFormBtn" class="btn btn-primary">Update</button>
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
<script src="{{url('/js/validations/imageShow.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#ProductTypeEditForm").validate({
        rules: {
          name: {
            required: true,
          },
        },
      });
      
      $('#ProductTypeEditFormBtn').click(function(){
        $(this).attr('disabled', true);
        if($('#ProductTypeEditForm').valid()){
          $('#ProductTypeEditForm').submit();
        }else{
          $(this).attr('disabled', false);
          return false;
        }   
      });
    });
  </script>
@endsection
