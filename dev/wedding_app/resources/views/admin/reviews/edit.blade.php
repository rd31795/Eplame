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
            <form role="form" method="post" id="reviewForm" class="custt-edit-form" action="{{url(route('update_review',$review->id))}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Rating*</label>
              
              <div class="star-rating edit-star">
                <input id="star-5" type="radio" name="rating" value="5" @if($review->rating==5) checked @endif />
                <label for="star-5" title="5 stars">
                  <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-4" type="radio" name="rating" value="4" @if($review->rating==4) checked @endif/>
                <label for="star-4" title="4 stars">
                  <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-3" type="radio" name="rating" value="3" @if($review->rating==3) checked @endif/>
                <label for="star-3" title="3 stars">
                  <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-2" type="radio" name="rating" value="2" @if($review->rating==2) checked @endif/>
                <label for="star-2" title="2 stars">
                  <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
                <input id="star-1" type="radio" name="rating" value="1" @if($review->rating==1) checked @endif/>
                <label for="star-1" title="1 star">
                  <i class="active fa fa-star" aria-hidden="true"></i>
                </label>
              </div>
              </div>
              {{textbox($errors, 'Title*', 'title', $review->title)}}
              <div class="form-group">
                <label class="control-label">Image</label>
                <input type="file" name="image" id="image" onchange="ValidateSingleInput(this, 'image_src')" accept="image/*">
                @if ($errors->has('thumbnail'))
                        <div class="error">{{ $errors->first('thumbnail') }}</div>
                    @endif
                  </div>
              <img id="image_src" style="width: 100px; height: 100px;" src="{{ url('/').'/wedding_app/public/uploads/'.$review->images }}" />
              {{textarea($errors, 'Summary*', 'summary', $review->summary)}}
    
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" id="reviewFormSbt" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>        <!-- /.col -->
  </div>
      <!-- /.row -->
</section>

 
     
@endsection

@section('scripts')
<script src="{{url('/admin-assets/js/validations/reviewsValidation.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection
 
