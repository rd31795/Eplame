<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/giphy/ui/trumbowyg.giphy.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/emoji/ui/trumbowyg.emoji.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="https://www.eplame.com/dev/frontend/css/styles.css">
@extends('layouts.home')
@section('content')
<?php  
 $stripe = SripeAccount(); 
?>
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Registration Form</h1>
        </div>
    </div>
</section>
<section class="services-tab-sec Personal-Information-from">
    <div class="container">
         <div class="sec-card ">
        <fieldset>
            <div class="card-heading step-billing-heading">
                <h3><i class="fas fa-money-check-alt"></i> Payment Method </h3>
                <div id="messages"></div>
            </div>
            <div class="checkout-billing-address p-4">
                <div class="alert alert-info closer-step mb-3" role="alert">
                    <i class="fa fa-info-circle"></i> One Step closer to your registration
                </div>
                <div class="payment-table sidebar">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="payment-card-detail">
                                <ul class="nav nav-tabs" id="Payment-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="allevent-tab" data-toggle="tab" href="#allevent" role="tab" aria-controls="allevent" aria-selected="true">Payment By Stripe</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="false">Payment By Paypal</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="PaymentTabContent">
                                    <div class="tab-pane fade active show" id="allevent" role="tabpanel" aria-labelledby="allevent-tab">
                                        <div id="paymentStripe" class="payment-type">
                                     @include('tools.forum.payment.stripe')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                                        <div id="paymentPaypal" class="payment-type">
                                            @include('tools.forum.payment.paypal2')
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- <div class="payment-button-wrapper">
                            <button class="cstm-btn solid-btn btn-back-step" data-action="step2" data-step="2" type="button">Back</button>
                            <button class="cstm-btn solid-btn">Next</button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        </div>     
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript" src="{{url('/js/cartpage.js')}}"></script>
@endsection