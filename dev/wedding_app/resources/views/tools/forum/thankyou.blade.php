@extends('layouts.home')
@section('content')
<section class="log-sign-banner" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
   <div class="container">
      <div class="page-title text-center">
         <h1>Thank You</h1>
      </div>
   </div>
</section>
<section class="checklist-wrap thankyou-sec">
   <div class="container">
      <div class="sec-card">
         <div class="thankyou-card">
            <div class="success-message text-center">
               <figure class="apporved-icon">
                  <img src="/dev/frontend/images/thank-you.jpg">                      
               </figure>
               <!--                     <h4 class="success-message__title">Thank You</h4> -->
               <p>Thank you for the registration.</p>
            </div>
         </div>
         <div class="row">
            <!-- start Heading -->
            <div class="col-lg-12">  
         <div class="w-100 mt-4">
         <div class="responsive-table">
            <table class="table table-striped order-list-table">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Order Id</th>
                     <th>Payment Type</th>
                     <th>Price</th>
                     <th></th>
                  </tr>
               <tbody>
                  <tr>
                     <td>1</td>
                     <td>{{ $order->orderID }}</td>
                     <td>{{ $order->payment_by }}</td>
                     <td>${{ $order->amount }}</td>
                     <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Add to Calendar</button></td>
                  </tr>
               </tbody>
               </thead>
            </table>
         </div>
       </div>
         <div class="order-summary-wrap">
            <div class="row">
               <div class="col-lg-12">
                  <div class="order-sum-card">
                     <div class="billing-addres-detail">
                        <h3 class="rec-heading">Billing Address</h3>
                        <div class="billing-address-line">
                           <p>
                              <span>
                              <i class="fas fa-user"></i>
                              </span>
                              {{ json_decode($order->billing_address)->name }}
                           </p>
                           <p> 
                              <span> 
                              <i class="fas fa-map-marker-alt"></i> 
                              </span> 
                              {{ json_decode($order->billing_address)->address }}, {{ json_decode($order->billing_address)->city }}, {{ json_decode($order->billing_address)->state }} {{ json_decode($order->billing_address)->country }} {{ json_decode($order->billing_address)->zipcode }}
                           </p>
                           <p> 
                              <span> <i class="fas fa-envelope"></i> </span>
                              {{ json_decode($order->billing_address)->email }}
                           </p>
                           <p>
                              <span><i class="fas fa-phone-alt"></i></span> {{ json_decode($order->billing_address)->mobile }}
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add to Calender</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <a href="{{$google}}" class="cstm-btn solid-btn" target="_blank"> Google Calender</a><br>
                    <a href="{{$yahoo}}" class="cstm-btn solid-btn" target="_blank"> Yahoo Calender</a><br>
                    <a href="{{$outlook}}" class="cstm-btn solid-btn" target="_blank"> Outlook Calender</a><br>
                    <a href="{{$ics}}" class="cstm-btn solid-btn" target="_blank"> iCal Calender</a>
                  </div>
                  <div class="modal-footer">
                   
                  </div>
                </div>
              </div>
            </div>
            <div class="button-wrap mt-4 text-center">
              <a href="{{url('/')}}" class="cstm-btn solid-btn">Back to Home</a>
            </div>
      </div>
   </div>

   </div>
   </div>
</section>
@endsection
<style type="text/css">
  span.tax {
    font-size: 10px;
    padding-left: 4px;
</style>