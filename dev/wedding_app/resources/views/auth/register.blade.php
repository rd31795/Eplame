@extends('layouts.home')
@section('head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@section('title') {{ getAllValueWithMeta('meta_title', 'signup') }} @endsection
@section('description') {{ getAllValueWithMeta('meta_description', 'signup') }} @endsection
@section('keywords') {{ getAllValueWithMeta('meta_keyword', 'signup') }} @endsection

@section('content')

<!-- <app-header></app-header> -->
<section class="log-sign-banner aos-init aos-animate" data-aos="fade-up" data-aos-duration="3000" style="background:url({{ url('/uploads').'/'.getAllValueWithMeta('signup_background_image', 'signup')}});">
    <div class="container">
            <div class="page-title text-center">
                    <h1>{{ getAllValueWithMeta('signup_title', 'signup') }}</h1>
                </div>
            </div>    
        </section>
        <section class="form-sec aos-init aos-animate" data-aos="fade-down" data-aos-duration="3000">
                <div class="container">         
                  <div class="signUp-form-wrap mr-top sec-card">  
                        <div class="row no-gutters">          
                                <div class="col-lg-6">
                                    <figure class="form-img-wrap">
                                        <img src="{{ url('/uploads').'/'.getAllValueWithMeta('signup_banner', 'signup') }}">
                                        <figcaption class="overlay-text">
                                                <h1>{{ getAllValueWithMeta('heading', 'signup') }}</h1>
                                                <p>{{ getAllValueWithMeta('description', 'signup') }}</p>
                                            </figcaption>
                                    </figure>
                            </div>
                            <div class="col-lg-6">
                            <form class="signUp-form" action="{{url(route('ajax_register'))}}" method="POST"  id="registerForm" enctype="multipart/form-data">
                              <div class="messages">
                                        </div>
                              @csrf
                               <div class="row">
                                   <div class="col-lg-12">                          
                                       <div class="form-group">
                                           <input type="text" name="first_name" formControlName="firstName" placeholder="First Name" class="form-control" />
                                           <span class="input-icon"><i class="fas fa-user"></i></span>
                                       </div>                              
                                   </div>
                                   <div class="col-lg-12">                          
                                       <div class="form-group">
                                           <input type="text" name="last_name" formControlName="lastName" placeholder="Last Name" class="form-control"  />
                                              <span class="input-icon"><i class="fas fa-user"></i></span>
                                            
                                       </div>                              
                                   </div>
                
                                  
                
                                   <div class="col-lg-12">                          
                                       <div class="form-group">
                                           
                                           <input type="text" name="email" formControlName="email" placeholder="Email Id" class="form-control"  />
                                           <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                          
                                       </div>                              
                                   </div>

                                   <div class="col-lg-12">                          
                                       <div class="form-group">
                                           
                                           <input type="file" name="profile_image" formControlName="profile_image" class="form-control"  accept="image/*" />
                                           <span class="input-icon"><i class="fas fa-user"></i></span>
                                          
                                       </div>                              
                                   </div>
                
                                   <div class="col-lg-12">
                                       <div class="form-group">
                                        <input type="password" name="password" formControlName="password" placeholder="Password" id="password" class="form-control"  />
                                        <span class="input-icon"><i class="fas fa-lock"></i></span>
                                        
                                       </div>
                                   </div>
                
                                   <div class="col-lg-12">
                                    <div class="form-group">
                                     <input type="password" name="password_confirmation" formControlName="confirm_password"  placeholder="Confirm Password" class="form-control" />
                                     <span class="input-icon"><i class="fas fa-lock"></i></span>
                                    
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <div class="custom-control custom-checkbox mb-4">
                                    <input type="checkbox" class="custom-control-input" id="ack18" name="ack18" value="18">
                                    <label class="custom-control-label" for="ack18">I Confirm that i am 18 years or older of age.</label> 
                                  </div>
                                  </div>

                                
                                <!-- <div class="custom-control custom-checkbox mb-4">
                                      <input type="checkbox" class="custom-control-input" name="agree" value="1" id="customCheck1">
                                      <label class="custom-control-label" for="customCheck1">I agree to the Terms and Conditions. </label>
                                      <a href="javascript:void(0);" data-toggle="modal" data-target="#info_modal" class="demo-app hasToggle"> 
                                            <i class="fas fa-info-circle"></i>                                   
                                        </a>
                                    </div> -->
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}"></div>
                                    <input type="text" title="Please verify this" class="keycode required" name="keycode" id="keycode">
                                </div>
                            </div>

                               </div>
                
                               
                                 
                                    <div class="form-group btn-wrap">
                                         
                                          <button type="submit" class="cstm-btn solid-btn register-Submit"><span><img src="{{url('200.gif')}}"></span>Register</button>
                                         

                                        
                                    </div>
                                    
                            </form>
                        </div>
                </div>
        </div> 
        </div>   
</section>


<section class="how-its-work-sec aos-init aos-animate" data-aos="fade-right" data-aos-duration="3000">
   <div class="container">
      <div class="sec-heading text-center">
         <h4>{{ getAllValueWithMeta('section1_title', 'signup') }}</h4>
         <h2>{{ getAllValueWithMeta('section1_tagline', 'signup') }}</h2>
      </div>
      <div class="row">
         <div class="col-lg-10 offset-lg-1">
            <div class="video-container">
               <figure>
                  <video class="video" id="bVideo" loop="" style="width: 100% !important;" height="100%" poster="{{ url('/uploads').'/'.getAllValueWithMeta('section1_video_poster', 'signup') }}">
                     <source src="{{ url('/uploads').'/'.getAllValueWithMeta('section1_video', 'signup') }}" type="video/mp4">
                  </video>
                  <div id="playButton" class="playButton" onclick="playPause()">
                     <span><i class="fas fa-play-circle"></i></span>
                  </div>
               </figure>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="testimonial">
   <div class="container aos-init" data-aos="fade-left" data-aos-duration="3000">
      <div class="sec-heading text-center">
         <h2>{{ getAllValueWithMeta('section2_title', 'signup') }}</h2>
      </div>
      <div class="test owl-carousel owl-theme owl-loaded owl-drag">
         
         
         
      <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-4480px, 0px, 0px); transition: all 0.25s ease 0s; width: 7840px;"><div class="owl-item cloned" style="width: 1110px; margin-right: 10px;"><div class="item">
            <div class="wrap">
               <figure>
                  <img class="commas" src="/frontend/images/commas.png" alt="">
                  <img src="/frontend/images/test.png" alt="">
               </figure>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
               <p class="name">John Smith</p>
            </div>
         </div></div><div class="owl-item cloned" style="width: 1110px; margin-right: 10px;"><div class="item">
            <div class="wrap">
               <figure>
                  <img class="commas" src="/frontend/images/commas.png" alt="">
                  <img src="/frontend/images/test.png" alt="">
               </figure>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
               <p class="name">John Smith</p>
            </div>
         </div></div><div class="owl-item" style="width: 1110px; margin-right: 10px;"><div class="item">
            <div class="wrap">
               <figure>
                  <img class="commas" src="/frontend/images/commas.png" alt="">
                  <img src="/frontend/images/test.png" alt="">
               </figure>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
               <p class="name">John Smith</p>
            </div>
         </div></div><div class="owl-item" style="width: 1110px; margin-right: 10px;"><div class="item">
            <div class="wrap">
               <figure>
                  <img class="commas" src="/frontend/images/commas.png" alt="">
                  <img src="/frontend/images/test.png" alt="">
               </figure>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
               <p class="name">John Smith</p>
            </div>
         </div></div><div class="owl-item active" style="width: 1110px; margin-right: 10px;"><div class="item">
            <div class="wrap">
               <figure>
                  <img class="commas" src="/frontend/images/commas.png" alt="">
                  <img src="/frontend/images/test.png" alt="">
               </figure>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
               <p class="name">John Smith</p>
            </div>
         </div></div><div class="owl-item cloned" style="width: 1110px; margin-right: 10px;"><div class="item">
            <div class="wrap">
               <figure>
                  <img class="commas" src="/frontend/images/commas.png" alt="">
                  <img src="/frontend/images/test.png" alt="">
               </figure>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
               <p class="name">John Smith</p>
            </div>
         </div></div><div class="owl-item cloned" style="width: 1110px; margin-right: 10px;"><div class="item">
            <div class="wrap">
               <figure>
                  <img class="commas" src="/frontend/images/commas.png" alt="">
                  <img src="/frontend/images/test.png" alt="">
               </figure>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
               <p class="name">John Smith</p>
            </div>
         </div></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots"><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot active"><span></span></button></div></div>
   </div>
</section>

@endsection


@section('scripts')

<script type="text/javascript" src="{{url('/frontend/js/register.js')}}"></script>

@endsection