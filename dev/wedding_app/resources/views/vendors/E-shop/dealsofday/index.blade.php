@extends('layouts.vendor')
@section('vendorContents')
<div class="container-fluid">

 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">Deals of day</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item">{{$product->name}}</li>
                <li class="breadcrumb-item">Create Deal</li>
            </ul>
   </div>

</div>
@include('vendors.errors')
    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
            <div class="card-header">
              <h3>{{$title}} </h3>
            </div>
                 <div class="card-body">
                     <form method="post" method="{{route('vendor.shop.products.deal_of_day.create',['id'=>$product->id])}}" enctype="multipart/form-data">
                          @csrf
                         <div class="row">
                           <div class="col-lg-6">
                                {{textnumber($errors, 'deal applicable for how much time in hours (Max 24 hours)*', 'deal_time',null,1,24)}}
                           </div>
                           <div class="col-lg-6">
                            current price of product-> {{$product->final_price}}
                             {{textnumber($errors, 'Deal Price of Product', 'deal_price',null,1)}}
                           </div>
                    <div class="card-footer">
                      <button type="submit" id="btnMenu" class="btn btn-primary">Generate Deal</button>
                    </div></div>
                   </form>
                </div>
           </div>
         </div>
     </div>
 </div>

</div>
@endsection

@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{url('/js/validations/negotiationform.js')}}"></script>
<script src="{{url('/js/validations/imageShow.js')}}"></script>
@endsection
