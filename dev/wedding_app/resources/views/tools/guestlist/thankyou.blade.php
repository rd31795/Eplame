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
                  <img src="{{url('/')}}/frontend/images/thank-you.jpg">                      
               </figure>
               <!--                     <h4 class="success-message__title">Thank You</h4> -->
               <p>We have got your response and we will update the same on the event.</p>
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