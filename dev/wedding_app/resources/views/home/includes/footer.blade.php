<footer class="site-footer">
  <a href="javascript:void(0);" class="scrollTop"><i class="fas fa-arrow-alt-circle-up"></i></a>

  <!-- feedback  -->

<!-- chat bot  -->
  <div id="chat-bot">
    <div class="messenger br10">

      
      <a href="javascript:void(0);" class="report-bug" data-toggle="modal" data-target="#myModal2"><i class="fas fa-exclamation"></i>Report a Bug</a>
        
      <a href="javascript:void(0);" class="post-test" data-toggle="modal" data-target="#myModal3"><i class="fab fa-usps"></i>Post a Testimonial</a>

      <a href="javascript:void(0);" class="post-test" data-toggle="modal" data-target="#myModal4"><i class="fas fa-paper-plane"></i>Request a Feature</a>
      
      <a href="{{ url('/') }}/contact-us" class="post-feed"><i class="fas fa-reply"></i> Contact Us</a>
      
      @if(Auth::user())
        <a href="javascript:;" onClick="jqac.arrowchat.chatWith('1');" class="post-feed"><i class="fas fa-comment"></i>Chat with Admin
        </a>
      @endif
    </div>
    <div class="icon">
      <i class="far fa-question-circle"></i>
      <div class="cstm-tooltip tool-left">
          Need Help?
      </div>
    </div>
  </div>
 <!-- The Modal -->
    <!-- <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
          <div class="modal-header">
            <h4 class="modal-title">Post a Feedback</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="modal_body">
            
            <div class="alert alert-success feedback-success" role="alert" style="display: none;">
              <p>Feedback has been submitted successfully</p>
            </div>
          <form id="feedbackForm" autocomplete="off">
            @csrf
              <input type="hidden" name="_token" value="">
              <div class="form-group">
                <label>Name*</label>
                <input type="text" class="form-control" name="name" placeholder="Name*">
              </div>
              <div class="form-group">
                <label>Email*</label>
                <input type="email" class="form-control" name="email" placeholder="Email*" autocomplete="off" autofocus="off">
              </div>
              <div class="form-group">
                <label>Feedback Details*</label>
                <textarea class="form-control" name="summary" placeholder="Description*" rows="4"></textarea>
              </div>
              <div class="form-group">
                <button class="cstm-btn post-sub-btn" id="feedbackFormBtn" type="submit">Submit</button>
              </div>
          </form>
        </div>
        </div>
      </div>
    </div> -->
     <!-- The Modal End -->
     <!-- The Modal2 -->
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Report a Bug</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="modal_body">
            
            <div class="alert alert-success bug-success" role="alert" style="display: none;">
              <p>Bug has been reported successfully</p>
            </div>
          
          <!-- Modal body -->
          <form id="bugForm" enctype="multipart/form-data" autocomplete="off">
            @csrf
              <div class="form-group">
                <label>Name*</label>
                <input type="text" class="form-control" name="name" placeholder="Name*">
              </div>
              <div class="form-group">
                <label>Email*</label>
                <input type="email" class="form-control" name="email" placeholder="Email*" autocomplete="off" autofocus="off">
              </div>
              <div class="form-group">
                <label>Bug Description*</label>
                <textarea class="form-control" name="summary" placeholder="Description*" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label>Attachment</label>
                <input type="file" name="attachment" class="form-group" accept="image/png, image/gif, image/jpeg">
              </div>
              <div class="form-group">
                <button class="cstm-btn post-sub-btn" id="bugFormBtn" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
     <!-- The Modal2 End -->
     <!-- The Modal3 -->
    <div class="modal fade" id="myModal3">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Post a Testimonial</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="modal_body">
            @if(!(Auth::user()))
              <div class="alert alert-warning" role="alert">
                <p>Kindly <a href="{{ url('/')}}/login">login</a> in order to fill up this form.</p>
              </div>
            @endif
            <div class="alert alert-success testimonial-success" role="alert" style="display: none;">
              <p>Testimonial has been posted successfully</p>
            </div>
          
            <!-- Modal body -->
            <form id="testimonialForm" autocomplete="off">
              @csrf
              <div class="form-group">
                <label>Testimonial Description*</label>
                  <textarea class="form-control" name="summary" placeholder="Description*" rows="4"></textarea>
                </div>
                @if(Auth::user())
                  <div class="form-group">
                    <button class="cstm-btn post-sub-btn" id="testimonialFormBtn" type="submit">Submit</button>
                  </div>
                @endif
            </form>
          </div>
        </div>
      </div>
    </div>
     <!-- The Modal3 End -->
     <!-- The Modal4 -->
    <div class="modal fade" id="myModal4">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Request a Feature</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="modal_body">
            
            <div class="alert alert-success feature-success" role="alert" style="display: none;">
              <p>Feature has been requested successfully.</p>
            </div>
          
          <!-- Modal body -->
          <form id="requestForm" autocomplete="off">
            @csrf
              <div class="form-group">
                <label>Name*</label>
                <input type="text" class="form-control" name="name" placeholder="Name*">
              </div>
              <div class="form-group">
                <label>Email*</label>
                <input type="email" class="form-control" name="email" placeholder="Email*" autocomplete="off" autofocus="off">
              </div>
              <p>Please elaborate on the objective of your Feature Request by answering the questions listed below:</p>
              <div class="form-group">
                <label>Feature Requirements*</label>
                <textarea class="form-control" name="requirements" placeholder="Description*" rows="4"></textarea>
              </div>  
              <div class="form-group">
                <label>What does the solution look like?</label>
                <textarea class="form-control" name="solution" placeholder="Type Here..." rows="4"></textarea>
              </div>             
              <div class="form-group">
                <label>Do any competitors currently implement this feature? If so, Kindly provide us the details.</label>
                <textarea class="form-control" name="comp_summary" placeholder="Type Here..." rows="4"></textarea>
              </div>
              <div class="form-group">
                <button class="cstm-btn post-sub-btn" id="requestFormBtn" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
     <!-- The Modal4 End -->
<!--   main body end  -->



<!-- Feedback  -->
    <div class="container">
        <div class="ftr-content">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <a href="{{ route('homepage') }}" class="ftr-logo"><img src="{{url('/')}}/frontend/images/logo.svg"></a>
                </div>
                <div class="col-lg-2 col-md-2 col-6">
                    <div class="ftr-links-wrap">
                        <h3>Eplame</h3>
                        <ul class="ftr-links">
                            <?php $cmsmenu = \App\CmsMenu::where('status',1)->get();  ?>
                           @foreach($cmsmenu as $cate)
                             @if($cate->page_type == 0)
                                @php $cms_page = cmsMenu($cate->cms_id);  @endphp  
                                 @if(!empty($cms_page))
                                 <li><a href="{{route('cmsPage', ['slug' => $cms_page->slug])}}">{{$cms_page->title}} </a></li>
                                 @endif
                              @else
                            <li><a href="{{$cate->custom_url}}">{{$cate->custom_name}} </a></li>
                            @endif
                              @endforeach
                           
                            <!--<li><a href="{{route('contact_us')}}">Contact Us</a></li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-6">
                    <div class="ftr-links-wrap">
                        <h3>Vendors</h3>
                        <ul class="ftr-links">
                           <?php $categori = \App\Category::where('featured',0)->get();  ?>
                           @foreach($categori as $cate)
                            <li><a href="{{url('vendor-listing')}}?category_id={{$cate->id}}">{{$cate->label}}</a></li>
                           @endforeach
                          
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-6">
                    <div class="ftr-links-wrap">
                        <h3>terms</h3>
                        <ul class="ftr-links">
                            <li><a href="{{ route('cmsPage', ['slug' => 'terms-and-condition']) }}">Terms And Conditions</a></li>
                            <li><a href="{{ route('cmsPage', ['slug' => 'privacy-policy']) }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-6 res-full-width">
                    <div class="ftr-links-wrap">
                        <h3>Let's Connect</h3>
                        <ul class="social-links">
                          @if(!empty(getAllValueWithMeta('facebook_url', 'global-settings')))
                            <li><a href="{{getAllValueWithMeta('facebook_url', 'global-settings')}}" ><span><i class="fab fa-facebook-f"></i></span></a></li>
                            @endif
                            @if(!empty(getAllValueWithMeta('email_id', 'global-settings')))
                            <li><a href="mailto:{{getAllValueWithMeta('email_id', 'global-settings')}}"><span><i class="fas fa-envelope"></i></span></a></li>
                            @endif
                            @if(!empty(getAllValueWithMeta('twitter_url', 'global-settings')))
                            <li><a href="{{getAllValueWithMeta('twitter_url', 'global-settings')}}" ><span><i class="fab fa-twitter"></i></span></a></li>
                            @endif
                            @if(!empty(getAllValueWithMeta('instagram_url', 'global-settings')))
                            <li><a href="{{getAllValueWithMeta('instagram_url', 'global-settings')}}"><span><i class="fab fa-instagram"></i></span></a></li>
                            @endif
                            @if(!empty(getAllValueWithMeta('linkedin_url', 'global-settings')))
                            <li><a href="{{getAllValueWithMeta('linkedin_url', 'global-settings')}}"><span><i class="fab fa-linkedin-in"></i></span></a></li>
                            @endif
                            @if(!empty(getAllValueWithMeta('skype', 'global-settings')))
                            <li><a href="{{getAllValueWithMeta('skype', 'global-settings')}}"><span><i class="fab fa-skype"></i></span></a></li>
                            @endif
                            @if(!empty(getAllValueWithMeta('whatsapp_num', 'global-settings')))
                            <li><a href="{{getAllValueWithMeta('whatsapp_num', 'global-settings')}}"><span><i class="fab fa-whatsapp"></i></span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="ftr-bottom-bar">
            <p class="copy-right-text">© 2019 Eplame.</p>
            <ul class="social-links">
                <li><a href="javascript:void(0);"><span><i class="fab fa-facebook-f"></i></span></a></li>
                <li><a href="javascript:void(0);"><span><i class="fab fa-twitter"></i></span></a></li>
                <li><a href="javascript:void(0);"><span><i class="fab fa-instagram"></i></span></a></li>
                <li><a href="javascript:void(0);"><span><i class="fab fa-linkedin-in"></i></span></a></li>
            </ul>
        </div>
    </div>
  </footer>





<!-- First User Modal -->
<!-- <div class="modal fade" id="firstUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Why are you here?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-heading">
      <h3>Lets talk about your event.</h3>     
    </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Event Title <i class="fas fa-info-circle"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="address">
              <span class="input-icon"><i class="fas fa-pencil-alt"></i></span>
            </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Short description <i class="fas fa-info-circle"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="description">
              <span class="input-icon"><i class="fas fa-pencil-alt"></i></span>
            </div>
            </div>
          </div>
         <div class="col-lg-6">
            <div class="form-group">
              <label>Event Place <i class="fas fa-info-circle"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="evt-place">
              <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>lorem ipsum <i class="fas fa-info-circle"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="">
              <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            </div>
          </div>
      </div>
    </div>
    </div>
  </div>
</div> -->





<!-- First User Modal -->
<div class="modal fade cart-modal" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
 
      <div class="modal-body">
        
        <div class="row">
          <div class="col-lg-6">
            <figure class="about-event-img">
              <img src="{{ asset('/frontend/images/event-form-img.png') }}">
              <div class="form-img-cont text-center">
              <h2 class="modal-title">Lorem ipsum is simply dummy text</h2>
              <p>Lorem Ipsum is simply dummy text of the printing is simply dummy text of the printing</p>
            </div>
            </figure>
          </div>
          <div class="col-lg-6">
            <div class="first-user-form">

            <!-- <div class="card-heading">
      <h3>Lorem ipsum is simply</h3>     
    </div> -->

            <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
                           <select class="form-control select2 eventType" name="event_type[]" data-placeholder="Event Type" id="EventSelect">
                              <option></option>
                           </select>
                           <span class="input-icon"><i class="fas fa-glass-cheers"></i></span>
                        </div>
            </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Short description <i class="fas fa-info-circle"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="description">
            </div>
            </div>
          </div>
         <div class="col-lg-12">
            <div class="form-group">
              <label>Event Place <i class="fas fa-info-circle"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="evt-place">
            </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>lorem ipsum <i class="fas fa-info-circle"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="">
            </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="btn-wrap text-right">
              <button class="cstm-btn solid-btn">Back</button>
              <button class="cstm-btn solid-btn">Next</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
  </div>
</div>
     




  <!-- Modal -->
<div class="modal fade" id="VenuesCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Businesses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background: url('/frontend/images/business-modal-bg.jpg');">
         <div class="venues-categories-wrap">
           <ul class="venues-cat-list row">

         <?php $businessCategory = \App\Category::join('vendor_categories','vendor_categories.category_id','=','categories.id')
                               ->select('categories.*')
                               ->where('categories.status',1)
                               ->where('categories.parent',0)
                               ->where('vendor_categories.status',3)
                               ->where('vendor_categories.publish',1)
                               ->orderBy('sorting','ASC')
                               ->groupBy('categories.id')
                               ->get(); ?>   

          @foreach($businessCategory as $business)       

             <li class="col-lg-4">
               <a href="{{url(route('home_vendor_listing_page'))}}?category_id={{$business->id}}" class="category-link"><span class="cate-link-icon">
                <img src="{{ url($business->image)}}"></span>
                {{$business->label}} <b>({{$business->businesses->count()}})</b></a>
             </li>
             
           @endforeach
             
             
           </ul>
         </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


