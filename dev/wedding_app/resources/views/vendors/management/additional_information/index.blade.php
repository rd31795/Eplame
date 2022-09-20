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
          <li class="breadcrumb-item"><a href="javascript:void(0)">List</a></li>
      </ul>
    </div>
        <div class="side-btns-wrap">
          <a href="{{url(route($addLink, $slug))}}" class="add_btn"><i class="fa {{$label == ""?'fa-plus':'fa-pencil-alt'}}"></i></a>
        </div>
  </div>
@include('vendors.errors')

 
    <div class="row">
      <div class="col-lg-12">
        <div class="card vendor-dash-card">
          <div class="card-header">
            <h3>{{$title}} </h3>
          </div>
          <div class="card-body additional-info-index">
            <div class="col-md-12"> 
              @if($detail == "" && $label == "")  
                <div class="col-md-12">
                  <div class="alert alert-warning" role="alert">No Additional Information is added to this business.</div>
                </div>
              @else
                <p><span>label:</span>{{ $label }}</p>
                <span>Description:</span>{!! $detail !!}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
