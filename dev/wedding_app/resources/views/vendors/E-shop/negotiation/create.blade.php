@extends('layouts.vendor')
@section('vendorContents')
<div class="container-fluid">

 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">Negotiation Discount Coupon</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item">Negotiation Discount Coupon</li>
                <li class="breadcrumb-item">Add</li>
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
                     <form method="post" id="negoatiationForm" enctype="multipart/form-data">
                          @csrf
                         <div class="row">
                           <div class="col-lg-6">
                                {{textbox($errors, 'Coupon Code*', 'coupon_code')}}
                           </div>
                            <div class="col-lg-6">
                            {{textbox($errors, 'Customer Email*', 'customer_email')}}
                           </div>
                           <div class="col-lg-6">
                              {{selectsimple($errors, "Negotiation Off Type", 'negotiation_discount_type',[0 => 'Percent',1 => 'Direct'])}}
                           </div>
                           <div class="col-lg-6">
                              {{selectsimple2WithClass($errors,'Product','product','product-list',[])}}
                           </div>
                           <div class="col-lg-6">
                             {{textbox($errors, 'Percent/Amount*', 'amount')}}
                           </div>
                    <div class="card-footer">
                      <button type="submit" id="btnMenu" class="btn btn-primary">Create</button>
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
<script type="text/javascript">
  $('.product-list').select2({
            placeholder: 'Select an item',
            ajax: {
                url: "{{ route('vendor.negotiable_coupon.search')}}",
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response
                    };
                },
                cache: true
            }
        });
</script>
@endsection
