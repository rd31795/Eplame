@extends('vendors.management.layout')
@section('vendorContents')
<div class="container-fluid">

	 

    <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">{{$title}}</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route($addLink , $slug) }}">List</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Add Video</a></li>
            </ul>
        </div>
  </div>
@include('vendors.errors')

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
       <div class="card-header"><h3>Add a video </h3></div>
           <div class="card-body">

<div class="row">
 
     

<div class="col-md-12">
  <form method="post" id="videoForm" enctype="multipart/form-data">
   {{textbox($errors,'Title','title')}}
   {{choosefilemultiple($errors,'Video Cover Photo','cover_photo')}}
   <div class="form-group label-floating is-empty">
    <label class="control-label">Video Link (please paste here youtube video link)</label><a title="Guide to get the youtube video URL." target="_blank" href="{{url('/faq')}}"><i class="fas fa-info-circle"></i></a>
    <input type="text" class="form-control " name="video_link" value="" id="video_link">
  </div> 
@csrf
<button class="cstm-btn">Save</button>
</form>
</div>



 
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script src="{{url('/js/validations/videoValidation.js')}}"></script>
@endsection
