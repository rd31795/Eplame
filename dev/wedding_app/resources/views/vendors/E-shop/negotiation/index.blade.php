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
                <li class="breadcrumb-item"><a href="{{ route('vendor.negotiable_coupon.add')}}">Add</a></li>
            </ul>
   </div>

</div>
@include('vendors.errors')


<div class="row">
    <div class="col-lg-12">
       <div class="card vendor-dash-card">

                <div class="card-body">
                    <table class="table cstm-eshop-table">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Coupon Code</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                     <tbody>
                       @foreach($coupons as $k => $coupon)
                           <tr>
                              <td>{{$k + 1}}</td>

                                <td>
                                   <h3>{{$coupon->coupon}}</h3>
                                </td>
                                <td>
                                    <h3>{{$coupon->products->name}}</h3>
                                </td>
                                 <td>
                                    <h3>{{$coupon->amount}} {{$coupon->type==App\Models\NegotiationDiscount::PERCENT?"%OFF":"OFF"}}</h3>
                                </td>
                               <td>
                                 {{ $coupon->is_active ?'Active' : 'In-Active' }}
                               </td>
                             <td>
                               @if(!$coupon->is_used || $coupon->is_active)
                               <a href="{{url(route('vendor.negotiable_coupon.status',$coupon->id))}}" class="btn btn-danger btn-sm">
                                   {{ !$coupon->is_active ?'Active' : 'In-Active' }}
                               </a>
                               @else
                               <button class="btn btn-warning btn-sm">
                                  {{ $coupon->is_used ?'Used' : 'Not-Used' }}
                               </button>
                               @endif
                             </td>
                           </tr>

                       @endforeach
                     </tbody>

                    </table>



               </div>
      </div>
  </div>
</div>
</div>
@endsection

