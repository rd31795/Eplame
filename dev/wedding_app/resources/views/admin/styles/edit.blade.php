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
                    <li class="breadcrumb-item "><a href="{{ $addLink }}">View</a></li>
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

  <form role="form" method="post" id="venueForm" enctype="multipart/form-data">
                
                   @csrf
                  
                   {{textbox($errors,'Title*','title', $style->title)}}
                   {{textarea($errors,'Description*','description', $style->description)}}

                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" onchange="ValidateSingleInput(this, 'image_src')" accept="image/*" />
                    @if ($errors->has('image'))
                        <div class="error">{{ $errors->first('image') }}</div>
                    @endif
                    <img id="image_src" class="img-thumbnail" width="100" src="{{url('/wedding_app/public/uploads/').'/'.$style->image }}" />
                  </div>                  
                  
               

                <div class="card-footer">
                  <button type="submit" id="btnVanue" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/valueValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection