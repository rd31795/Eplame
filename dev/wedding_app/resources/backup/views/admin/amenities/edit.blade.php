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

  <form role="form" method="post" id="eventForm" action="{{url(route('update_amenity', $amenity->slug))}}" enctype="multipart/form-data">
                <div class="card-body">


                   @csrf
                  
                   {{textbox($errors,'Amenity Type*','name', $amenity->name)}}
                   {{textarea($errors,'Description*','description', $amenity->description)}}

                          <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="type" id="ame-1" value="amenity" {{ $amenity->type == 'amenity' ? 'checked' : '' }}>
                            <label class="custom-control-label"for="ame-1">Amenity</label>
                          </div>

                          <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="type" id="game" value="game" {{ $amenity->type == 'game' ? 'checked' : '' }}>
                            <label class="custom-control-label"for="game">Game</label>
                          </div> 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="eventFormSbt" class="btn btn-primary">Submit</button>
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
<script src="{{url('/admin-assets/js/validations/eventValidation.js')}}"></script>
@endsection


 
