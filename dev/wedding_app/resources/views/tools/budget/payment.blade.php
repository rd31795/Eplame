@extends('layouts.home')

@section('content')
@endsection

<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
        <div class="container">
            <div class="banner-content event-top">
                <h1>Payments</h1>
                 <!-- <p>Lorem ipsum dolor sit amet.</p> -->
            </div>
        </div>
        
    </section>
    @include('tools.includes.navbar')
    <!--Banner section Ends here-->

    <!--Tabs Section starts here-->
    <section class="services-tab-sec">
        <div class="container">
            <div class="sec-card">
                
                
                @if($status == 0)
                <div class="cstm-payment-card text-center my-3">
                    <figure class="cal-icon mb-3">
                        <img src="{{url('/')}}/frontend/images/calculator.png">
                    </figure>
                    <h4>You do not have any payments saved</h4>
                    <div class="btn-wrap mt-3">
                        <a class="cstm-btn solid-btn mr-3 mt-0" href="{{route('users.budget', $slug)}}">Return to Budget</a>
                    </div>
                </div>
                @else
                <div class="cstm_Order_detail my-4">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="cart-items-wrap my-order-detail-card">
                                <div class="row no-gutters">
                                    <div class="col-lg-4">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Order Id</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Details</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="cart-col-wrap">
                                            <div class="cart-table-head">
                                                <h3>Service Fee</h3>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-lg-2">
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
                            @foreach($event_orders as $order_id)
                                @php $order_detail = getOrder($order_id); @endphp
                                @php $extraFees = getOrderExtraFees($order_detail->orderItems); @endphp
                                <div class="cart-items-wrap my-order-detail-card" id="CartItems">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 mb-4">
                                            <div class="cart-col-wrap">

                                                <div class="car-col-body">
                                                    <h4>{{$order_detail->orderID}}</h4>
                                                </div>

                                            </div>
                                        </div>
                                      <div class="col-lg-3 mb-4">
                                            <div class="cart-col-wrap">
                                                <div class="car-col-body">
                                                    <h4>{{$order_detail->amount}}</h4>
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
                                        <div class="col-lg-2 mb-4">
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
                                                        <a href="{{ route('order_details', $order_detail->id) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="Detail"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                            

                                                                            
                          <!--  =========================== -->
                        </div>

                    </div>
                </div>
                @endif
                    
            </div>
        </div>
    </section>
    

@section('scripts')

@endsection