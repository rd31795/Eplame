@extends('layouts.home')
@section('content')
<section class="log-sign-banner" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="page-title text-center">
            <h1>Get in touch</h1>
        </div>
    </div>    
</section>
<section class="contact-us-sec">
   <div class="container">
	    <div class="sec-card">      	
			<div class="row">
				<div class="col-lg-7">
				  	<div class="card-heading">
							<h3>send your message</h3>			
						</div>
						  @include('admin.error_message') 
						 <form role="form" method="post" id="ContactForm" enctype="multipart/form-data">
						 @csrf
						<div class="row">
						<div class="col-lg-6">
		                     <div class="form-group">
		                         <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name*">
		                           <span class="input-icon"><i class="fas fa-user"></i></span>
		                     </div>
		                 </div>
		                 <div class="col-lg-6">
		                     <div class="form-group">
		                         <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name">
		                           <span class="input-icon"><i class="fas fa-user"></i></span>
		                     </div>
		                 </div>
		                 <div class="col-lg-6">
		                     <div class="form-group">                                           
	                            <input type="text" formcontrolname="email" name="email" placeholder="Email Id*" class="form-control">
	                             <span class="input-icon"><i class="fas fa-envelope"></i></span>                                           
	                         </div>
		                 </div>
		                 <div class="col-lg-6">
		                     <div class="form-group">
		                         <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone*">
		                           <span class="input-icon"><i class="fas fa-phone"></i></span>
		                     </div>
		                 </div>
		                 <div class="col-lg-12">
		                     <div class="form-group">	                        
		                         <div class="wrap">
		                         	<textarea rows="5" name="message"  id="message" class="form-control" placeholder="Your Message" ></textarea>
		                         </div>	                           
		                     </div>
		                 </div>
		                 <div class="col-lg-12">
		                     <div class="form-group">	                        
		                        <!--  <a href="javascript:void(0);" class="cstm-btn solid-btn"> Send </a>  --> 
		                         <button class="cstm-btn solid-btn" type="submit" id="ContactFormBtn">Send</button>                         
		                     </div>
		                 </div>
					</div>
				 </form>
			  </div>
				<div class="col-lg-5">
					<div class="contact-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50017129.747348726!2d-115.30606582615425!3d40.07979883502246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sin!4v1574426579303!5m2!1sen!2sin"></iframe>
					</div>
				</div>
		    </div>
      	</div>

      	<div class="address-detail">

      		<h2>CONTACT US</h2>
      		<div class="address">
                <span class="icons-font"><i class="fas fa-map-marker-alt"></i> <p>address</p></span>
                <p>{{ getAllValueWithMeta('address', 'global-settings') }}</p>
            </div>
            <div class="fon-email">
                <div class="fon">
                    <span class="icons-font"><i class="fas fa-phone-alt"></i> <p>phone</p></span>
                    <p>{{ getAllValueWithMeta('mobile', 'global-settings') }}</p>
                    <p>{{ getAllValueWithMeta('phone_number', 'global-settings') }}</p>
                </div>
                <div class="mail">
                    <span class="icons-font"><i class="fas fa-envelope"></i> <p>email</p></span>
                    <p>{{ getAllValueWithMeta('contact_email', 'global-settings') }}</p>
                     <p>{{ getAllValueWithMeta('alter_email', 'global-settings') }}</p>
                </div>
            </div>
            <div class="contact-social">
            	@if(!empty(getAllValueWithMeta('facebook_url', 'global-settings')))
            	<a href="{{getAllValueWithMeta('facebook_url', 'global-settings')}}" class="icoon icon-1">
            		<i class="fab fa-facebook-f"></i>
            	</a>
            	@endif
            	@if(!empty(getAllValueWithMeta('email_id', 'global-settings')))
            	<a href="mailto:{{getAllValueWithMeta('email_id', 'global-settings')}}" class="icoon icon-2">
            		<i class="fas fa-envelope"></i>
            	</a>
            	@endif
            	@if(!empty(getAllValueWithMeta('twitter_url', 'global-settings')))
            	<a href="{{getAllValueWithMeta('twitter_url', 'global-settings')}}" class="icoon icon-3">
            		<i class="fab fa-twitter"></i>
            	</a>
            	@endif
            	@if(!empty(getAllValueWithMeta('instagram_url', 'global-settings')))
            	<a href="{{getAllValueWithMeta('instagram_url', 'global-settings')}}" class="icoon icon-4">
            		<i class="fab fa-instagram"></i>
            	</a>
            	@endif
            	@if(!empty(getAllValueWithMeta('linkedin_url', 'global-settings')))
            	<a href="{{getAllValueWithMeta('linkedin_url', 'global-settings')}}" class="icoon icon-5">
            		<i class="fab fa-linkedin-in"></i>
            	</a>
            	@endif
            	@if(!empty(getAllValueWithMeta('skype', 'global-settings')))
            	<a href="{{getAllValueWithMeta('skype', 'global-settings')}}" class="icoon icon-6">
            		<i class="fab fa-skype"></i>
            	</a>
            	@endif
            	@if(!empty(getAllValueWithMeta('whatsapp_num', 'global-settings'))) 
            	<a href="{{getAllValueWithMeta('whatsapp_num', 'global-settings')}}" class="icoon icon-7">
            		<i class="fab fa-whatsapp"></i>
            	</a>
            	@endif

            </div>
      	</div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{url('/js/validations/contactValidation.js')}}"></script>
@endsection
