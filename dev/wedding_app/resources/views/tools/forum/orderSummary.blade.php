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

    <div id="message"></div>
    <h3 class="text-center">Order Summary</h3>
    @php
       $registration_type= App\RegistrationType::find($data->reg_id);
    @endphp
     <form class="step2-form" id="secondEventCreate" >   
        @csrf
        <div class="Order-Summary-wrapper">
            <div class="Order-Summary-head">
                <h2>Attendee Name</h2>
            </div>
            <div class="Order-Summary-inner-head">
                <div class="Order-Summary-inner-head-1">
                    <h5>Item</h5>
                    <span>
                        <h5>Price</h5>
                    </span>
                </div>
                <div class="Order-Summary-inner-head-2">
                    <h4>Event Fee</h4>
                    <div class="admission-item">
                        <h5>Event Fee</h5>
                        <span><strong style="text-transform: ">{{$registration_type?$registration_type->reg_type:''}}</strong> ( @if(!empty($data->reg_type)){{$data->quantity}} * ${{$data->single_unit_price}}@else $0 @endif )</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="sub-total">
                <div class="sub-total-inner">
                    <h5>Subtotal</h5>
                    <span>@if(!empty($data->reg_type))${{$data->reg_type}}@else $0 @endif</span>
                </div>
                <div>
                    <h5>Order Total</h5>
                    <span>@if(!empty($data->reg_type))${{$data->reg_type}}@else $0 @endif</span>
                </div>
            </div>
            <!--  <div class="payment-wrapper">
                            <h5 class="text-center">Payment</h5>
                          </div> -->
        </div>
        <div class="payment-button-wrapper">
            @if($data->reg_type == 0)
             <div class="col-md-12 text-right mb-4"><a href="{{url('/registration/payment-free/'.$orders->id)}}" class="cstm-btn solid-btn pull-right">Save</a></div>
              
              @else
              <div class="col-md-12 text-right mb-4"><a href="{{url('/registration/payment2/'.$orders->id)}}" class="cstm-btn solid-btn pull-right">Continue</a></div>
              @endif
        </div>
    </form>
    </div>     
    </div>
</section>

@section('scripts')
<!-- <script src="{{url('/js/registerform.js')}}"></script> -->
<script type="text/javascript" src="{{url('/js/cartpage.js')}}"></script>
<style type="text/css">
/*210913*/
.Order-Summary-head h2 {
    font-size: 22px;
    color: #35486b;
}

.Order-Summary-inner-head {
    margin: 15px 0;
}

.Order-Summary-inner-head-1 {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.Order-Summary-wrapper h5 {
    color: #35486b;
    font-size: 19px;
    margin: 0;
}

.animated.step3 {
    width: 100%;
}

.sub-total div {
    display: flex;
    justify-content: space-between;
}

.Order-Summary-inner-head-1 h5 {
    color: #fff;
}

.Order-Summary-inner-head-1 {
    background: #35486b;
    padding: 5px 10px;
}

.admission-item {
    display: flex;
    justify-content: space-between;
}

.admission-item h5 {
    font-size: 15px !important;
}

.sub-total-inner h5 {
    font-size: 15px;
}

.payment-wrapper {
    margin: 30px 0 20px;
}

.payment-method-div {
    display: block;
}</style>

@endsection