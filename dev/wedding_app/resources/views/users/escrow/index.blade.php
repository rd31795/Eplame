@extends('users.layouts.layout') 
@section('content')



<section class="content">
    <div class="row">
        <div class="col-xl-12 col-md-12 m-b-30">
            <div class="card">
                <div class="card-body">
                    <div><p class="p-amnt">Total Escrow Amount: <span> ${{ getTotalEscrow() }}</span></p></div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="cart-items-wrap my-order-detail-card">
                                <div class="row no-gutters">
                                    <div class="col-lg-2">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Order Id</h3>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Total Amount</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Escrow Amount</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Paid Amount</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Service Charge</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Tax</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Action</h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- start Heading -->

                            @if(@sizeof($orders))
                                @foreach($orders as $item)
                                    @php   
                                        $date = \Carbon\Carbon::parse($item->created_at);
                                        $now = \Carbon\Carbon::now();
                                        $diff = $date->diffInDays($now);
                                    @endphp
                                    @if($diff <= 30)
                                    @php

                                    $extraFees = getOrderExtraFees($item->orderItems);

                                        $esc_amt = 0;

                                    foreach($item->orderItems as $it){
                                      $parent = $it->category->parent;
                                      $cate = \App\Category::find($it->category->id);
                                      if($parent == 0){
                                        $admin_escrow_percentage = $cate->escrow_percentage;
                                      }else{
                                        $parent_cat = \App\Category::find($parent);
                                        $admin_escrow_percentage =  $parent_cat->escrow_percentage;
                                      }

                                        if(!($admin_escrow_percentage > 0)){
                                            $admin_escrow_percentage =  getAllValueWithMeta('admin_escrow_percentage', 'global-settings');
                                        }

                                      $price = $it->package->price;
                                      $esc_amt = $esc_amt + (($price * $admin_escrow_percentage)/100);

                                    }
                                     
                                    @endphp
                                        <div class="cart-items-wrap my-order-detail-card" id="CartItems">
                                            <div class="row no-gutters">
                                                <div class="col-lg-2 mb-4">
                                                    <div class="cart-col-wrap">

                                                        <div class="car-col-body">
                                                            <h4>{{ $item->orderID }}</h4>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-lg-2 mb-4">
                                                    <div class="cart-col-wrap">
                                                        <div class="car-col-body">
                                                            <h4>${{ $item->amount }}</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 mb-4">
                                                    <div class="cart-col-wrap">
                                                        <div class="car-col-body">
                                                            <h4>${{ $esc_amt }}</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 mb-4">
                                                    <div class="cart-col-wrap">
                                                        <div class="car-col-body">
                                                            <h4>${{ $item->amount - $esc_amt}}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="col-lg-2 mb-4">
                                                    <div class="cart-col-wrap">
                                                        <div class="car-col-body">

                                                        <h4>${{ $extraFees['service'] }}</h4>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-1 mb-4">
                                                    <div class="cart-col-wrap">
                                                        <div class="car-col-body">

                                                        <h4>${{ $extraFees['tax'] }}</h4>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-1 mb-4">
                                                    <div class="cart-col-wrap">

                                                        <div class="car-col-body">

                                                            <div class="action-btn-wrap1">
                                                                <a href="{{ route('order_details', $item->id) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Detail"><i class="fas fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            @else
                              <div class="alert alert-info closer-step mb-3 mt-4" role="alert">
                                 <i class="fa fa-info-circle"></i> No Escrow Details Found
                              </div>
                            @endif
                
                          <!--  =========================== -->
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection 
    @section('scripts') 
@endsection