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
                    <li class="breadcrumb-item "><a href="javascript:void(0)">View</a></li>
                    <li class="breadcrumb-item "><a href="{{ route($addLink, ['type' => $type]) }}">Add</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



@include('admin.error_message')

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
       <div class="card-header"><h5>{{$title}}</h5></div>
           <div class="card-body">

  <div id="faq-accordion" class="faq-accordion">

@if(count($newsoffers) == 0)
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">{{ $type }} has not been added yet.</div>
              </div>
@endif

@foreach($newsoffers as $k => $v)
  <div class="acrdn-card">
    <div class="acrdn-header" id="headingOne">
        
        <button class="d-flex align-items-center justify-content-between btn btn-link">
          <h3><span class="fa-stack fa-sm">
            
            <i class="fab fa-readme"></i>
          </span>{{$v->detail}} ( {{ $v->status == '1' ? 'Active' : 'In-Active' }} )</h3>          
        </button>

        <ul class="acrdn-action-btns">
          <li><a href="{{ route('admin.newsoffers.status', ['type'=> $type, 'id'=> $v->id]) }}" class="action_btn btn-warning" data-toggle="tooltip" title="{{ $v->status == '1' ? 'In-Active' : 'Active' }}"><i class="fas fa-toggle-on"></i></a></li>
          <li><a href="{{ route('admin.newsoffers.edit', ['type'=> $type, 'id'=> $v->id]) }}" class="action_btn primary-btn" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
          <li><a onclick="deleteItem(this)" href="javascript:void(0)" data-delurl="{{ route('admin.newsoffers.delete',[ $type, $v->id])}}" class="action_btn danger-btn" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></a></li>
        </ul>

    </div>

    
  </div>
  @endforeach
</div> 

</div>
</div>
</div>
</div>
</div>

{{ $newsoffers->links() }}

@endsection

@section('scripts')
@endsection
