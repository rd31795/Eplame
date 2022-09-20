<header class="site-header">
        <!-- header starts here -->
        <div class="top-bar inner-header">
            <div class="container">
              <div class="top-inner-nav mob-hide"> 
                <a href="{{url('/')}}" class="brand-name"><img src="{{url('/')}}/frontend/images/logo.svg"></a>
                <button class="menu-toggle" type="button">
                    <span><i class="fas fa-bars"></i></span> Menu
                </button>
                
                <ul class="inn-top-navigation">
                   <!-- <li><a href="javascript:void(0);" data-toggle="modal" data-target="#VenuesCategoriesModal">Businesses</a></li> -->
                   <li class="mob-hide"><a href="{{ route('home_vendor_listing_page') }}">Businesses</a></li>
                   <li><a href="{{url(route('all_deals'))}}">Deals & Discount</a></li>
                   <li><a href="{{url(route('shop.index'))}}">Shop</a></li>
                    @if(Auth::check())
                    <li>
                        <a href="{{ route('user_show_favourite_vendors') }}" class="fav-list mr-2"><i class="fas fa-heart"></i>
                            <sup id="fav_ven">{{ Auth::User()->favouriteVendors->count() }}</sup>
                        </a>
                    </li>
                     <li class="mob-hide">
                         <a href="{{url(route('my_cart'))}}" class="fav-list wt-btn mr-2">
                         <i class="fas fa-cart-plus"></i>
                         <sup id="fav_ven2">{{ Auth::User()->CartItems->count() }}</sup>
                         </a>
                      </li>

                       <li class="mob-hide">
                         <a href="{{url(route('my_wishlist'))}}" class="fav-list wt-btn mr-2">
                         <i class="fas fa-list"></i>
                         <sup id="fav_ven2">{{ Auth::User()->MyWishlist->count() }}</sup>
                         </a>
                      </li>
                    @endif
                   
                    @include('home.includes.messageCountHeader')
                  
                  @if(Auth::check())
                   <li>                                       
                        <div class="nav-item nav-profile dropdown">
                          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span class="nav-profile-img">
                              <i class="fas fa-user-circle"></i>
                            </span>
                            <div class="nav-profile-text">
                              <p class="user-name-text">{{Auth::user()->first_name}} {{ Auth::User()->role === 'user' ? 'Customer' : 'Vendor' }}</p>
                            </div>
                          </a>
                          <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="@if(Auth::user()->role == 'vendor' && Auth::user()->vendor_status == 1) {{url(route('vendor_dashboard'))}} @else {{url(route('user_dashboard'))}} @endif"><span><i class="far fa-user"></i></span> Profile</a>
                               <a class="dropdown-item" href="{{ route('logout') }}"><span><i class="fas fa-sign-out-alt"></i></span> Logout</a>
                           </div>
                        </div>
                  </li>
                          @else
                    <li class="user header-btns">
                            <a href="{{url('/login')}}" class="cstm-btn solid-btn">Login</a>
                            <a href="{{url('/register')}}" class="cstm-btn">Sign Up</a>
                    </li>
                          @endif
                        
                        
                  
                </ul>
                @if(Auth::check())
                <button class="toolbox" type="button">
                    <span><i class="fas fa-wrench"></i></span> Toolbox
                </button>
                @endif
              </div>
             <div class="top-Mob-nav">
                 <div class="top-menus-wrap">
                <button class="menu-toggle" type="button">
                    <span><i class="fas fa-bars"></i></span> Menu
                </button>
                <a href="http://49.249.236.30:6633" class="brand-name"><img src="{{url('/')}}/frontend/images/logo.svg"></a>
                @if(Auth::check())
                <button class="toolbox mob-hide" type="button">
                    <span><i class="fas fa-wrench"></i></span> Toolbox
                </button>
                @endif
                <!-- only for mobile -->
                <ul class="mob-side-menus">
                    <li class="user log-sign-btns">
                       
                   @if(Auth::check())

                    <span>
                            <i class="fas fa-user"></i>
                        </span>
                  <div class="dropdown">
                     <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="@if(Auth::user()->role == 'vendor' && Auth::user()->vendor_status == 1) {{url(route('vendor_dashboard'))}} @else {{url(route('user_dashboard'))}} @endif">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                     </div>
                  </div>
                  @else
                  <a href="{{url('/login')}}" class="cstm-btn solid-btn">Login</a>
                  <a href="{{url('/register')}}" class="cstm-btn">Sign Up</a>
                  @endif
                    </li>
                <li>
                  @if(Auth::check())
                <button class="toolbox" type="button">
                    <span><i class="fas fa-wrench"></i></span> Toolbox
                </button>
                @endif
              </li>
              <li>
                  <div class="icon-grp">
                     <a href="javascript:void(0);" class=""><i class="fas fa-envelope"></i></a>

                  @if(Auth::Check() && Auth::User()->role === 'user')
                      <a href="{{ route('user_show_favourite_vendors') }}" class="fav-list">
                            <i class="fas fa-heart"></i>
                            <sup id="fav_ven2">{{ Auth::User()->favouriteVendors->count() }}</sup>
                        </a>
                  @endif

                  </div>
              </li>

            </ul>
           </div>
            </div>
        </div>
        </div>

   

        <!-- <a href="javascript:void(0);" id="calender-toggle">
          <span><i class="fas fa-calendar-alt"></i></span>
        </a> -->
       
    </header>

     <!--For Menu-->
   <nav id="main-navigation" class="">
      <div class="container">
         <ul id="menus-list" class="menu-list">
            <li>
               <a href="/" style="background:url({{url('/')}}/frontend/images/menu-home-img.png)">
                  <span class="nav-item-icon"><i class="fas fa-home"></i></span>
                  <h3>Home</h3>
               </a>
            </li>
            <li>
               <a href="{{ route('cmsPage', ['slug' => 'about-us']) }}" style="background:url({{url('/')}}/frontend/images/menu-about.png)">
                  <span class="nav-item-icon"><i class="fas fa-address-card"></i></span>
                  <h3>About Us</h3>
               </a>
            </li>
            <li>
               <a href="{{ route('home.faq') }}" style="background:url({{url('/')}}/frontend/images/menu-faq.png)">
                  <span class="nav-item-icon"><i class="fas fa-comment-dots"></i></span>
                  <h3>FAQ</h3>
               </a>
            </li>
            <li>
               <a href="{{route('contact_us')}}" style="background:url({{url('/')}}/frontend/images/menu-contact-us.png)">
                  <span class="nav-item-icon"><i class="fas fa-id-badge"></i></span>
                  <h3>Contact Us</h3>
               </a>
            </li>
            <li>
               <a href="{{ route('cmsPage', ['slug' => 'privacy-policy']) }}" style="background:url({{url('/')}}/frontend/images/menu-policies.png)">
                  <span class="nav-item-icon"><i class="fas fa-clipboard"></i></span>
                  <h3>Polices</h3>
               </a>
            </li>
            <li>
               <a href="{{ route('community')}}" style="background:url({{url('/')}}/frontend/images/menu-forum.png)">
                  <span class="nav-item-icon"><i class="fas fa-users"></i></span>
                  <h3>Forum</h3>
               </a>
            </li>
            <li>
               <a href="javascript:void(0);" style="background:url({{url('/')}}/frontend/images/menu-testimonial.png)">
                  <span class="nav-item-icon"><i class="fas fa-star"></i></span>
                  <h3>Testimonials</h3>
               </a>
            </li>
            <li>
               <a href="{{ route('home_vendor_listing_page') }}" style="background:url({{url('/')}}/frontend/images/menu-vendor.png)">
                  <span class="nav-item-icon"><i class="fas fa-star"></i></span>
                  <h3>Businesses</h3>
               </a>
            </li>
            <li>
               <a href="{{url(route('all_deals'))}}" style="background:url({{url('/')}}/frontend/images/menu-vendor.png)">
                  <span class="nav-item-icon"><i class="fas fa-star"></i></span>
                  <h3>Deals & Discount</h3>
               </a>
            </li>
            <li>
               <a href="{{url('/vendor/register')}}" style="background:url({{url('/')}}/frontend/images/menu-vendor.png)">
                  <span class="nav-item-icon"><i class="fas fa-star"></i></span>
                  <h3>New Vendor</h3>
               </a>
            </li>
            <li>
               <a href="{{url('/register')}}" style="background:url({{url('/')}}/frontend/images/menu-sign.png)">
                  <span class="nav-item-icon"><i class="fas fa-star"></i></span>
                  <h3>SignUp</h3>
               </a>
            </li>
            <li>
               <a href="{{url('/register')}}" style="background:url({{url('/')}}/frontend/images/menu-sign.png)">
                  <span class="nav-item-icon"><i class="fas fa-star"></i></span>
                  <h3>Login</h3>
               </a>
            </li>
         </ul>
      </div>
      <a href="javascript:void(0);" (click)="close_nav()" class="nav-close-btn"><i class="fas fa-times"></i></a>
   </nav>
   <!--For toolbox-->
   <nav id="tool-nav" class="">
      <div class="container">
         <ul id="menus-list" class="menu-list">
            <li>
               <a href="javascript:void(0);">
                  <span class="nav-item-icon"><img src="{{url('/')}}/frontend/images/event-listing.png"/></span>
                  <h3>Event Checklist</h3>
               </a>
            </li>
            <li>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#BudgetingModal">
                  <span class="nav-item-icon">
                  <img src="{{url('/')}}/frontend/images/budgeting-tool.png"/>
                  </span>
                  <h3>Budgeting tool</h3>
               </a>
            </li>
            <li>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#GuestListModal">
                  <span class="nav-item-icon">
                  <img src="{{url('/')}}/frontend/images/guest-list.png"/></span>
                  <h3>Guest List</h3>
               </a>
            </li>
            {{--
             <li>
               <a href="{{ route('calculator') }}">
                  <span class="nav-item-icon">
                  <img src="{{url('/')}}/frontend/images/calculators.png"/></span>
                  <h3>Calculator</h3>
               </a>
             </li>
            --}}
            <li>
               <a href="{{ route('community')}}">
                  <span class="nav-item-icon">
                  <img src="{{url('/')}}/frontend/images/forum.png"/></span>
                  <h3>Forum</h3>
               </a>
            </li>
            <li>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#VendorModal">
                  <span class="nav-item-icon">
                  <img src="{{url('/')}}/frontend/images/vendor-manager.png"/></span>
                  <h3>Vendor Manager</h3>
               </a>
            </li>
            <li>
               <a href="javascript:void(0);">
                  <span class="nav-item-icon">
                  <img src="{{url('/')}}/frontend/images/favourite.png"/></span>
                  <h3>Favorite</h3>
               </a>
            </li>
         </ul>
      </div>
      <a href="javascript:void(0);" (click)="close_nav()" class="nav-close-btn"><i class="fas fa-times"></i></a>
   </nav>

   @if(Auth::check())
    @php $events = upcomingEvents(); @endphp
    <div class="modal fade modal-center" id="BudgetingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Budgeting tool</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(count($events) > 0)
        @foreach($events as $event)

         <div class="card-media  mt-4 wow bounceInRight" data-wow-delay="50ms">
    <!-- media container -->
    <div class="card-media-object-container">
      <div class="card-media-object" style="background-image: url({{$event->event_picture !='' ? url($event->event_picture) : '' }});">
        <div class="date-ribbon"><h2>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }}</h2> <h1>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}</h1></div>
      </div>
      <span class="card-media-object-tag subtle upcoming-event">Upcoming Event</span>
    </div>
    <!-- body container -->
    <div class="card-media-body">
      <div class="card-media-body-top">
        <span class="subtle">
          <strong>{{ ucfirst($event->title) }}</strong><br>
          {{ \Carbon\Carbon::parse($event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
        </span>
        <div class="card-media-body-top-icons u-float-right">
         
        </div>
      </div>
      <span class="card-media-body-heading">{{ $event->description }}</span>
      <div class="card-media-body-supporting-bottom">
        <span class="card-media-body-supporting-bottom-text subtle">{{ $event->location }}</span>
        <span class="card-media-body-supporting-bottom-text subtle u-float-right">Event Budget – ${{ $event->event_budget }}</span>
      </div>
      <div class="card-media-body-supporting-bottom card-media-body-supporting-bottom-reveal">
        <span class="card-media-body-supporting-bottom-text subtle ">@foreach($event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last)
        , @endif @endforeach</span>
        <a href="{{route('users.budget', $event->slug)}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
      </div>
    </div>
  </div>
  @endforeach
  @else
    <div class="alert alert-info closer-step mb-3 mt-4" role="alert">
      <i class="fa fa-info-circle"></i> No Events Found
    </div>
  @endif
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-center" id="VendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vendor Manager</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(count($events) > 0)
        @foreach($events as $event)

         <div class="card-media  mt-4 wow bounceInRight" data-wow-delay="50ms">
    <!-- media container -->
    <div class="card-media-object-container">
      <div class="card-media-object" style="background-image: url({{$event->event_picture !='' ? url($event->event_picture) : '' }});">
        <div class="date-ribbon"><h2>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }}</h2> <h1>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}</h1></div>
      </div>
      <span class="card-media-object-tag subtle upcoming-event">Upcoming Event</span>
    </div>
    <!-- body container -->
    <div class="card-media-body">
      <div class="card-media-body-top">
        <span class="subtle">
          <strong>{{ ucfirst($event->title) }}</strong><br>
          {{ \Carbon\Carbon::parse($event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
        </span>
        <div class="card-media-body-top-icons u-float-right">
         
        </div>
      </div>
      <span class="card-media-body-heading">{{ $event->description }}</span>
      <div class="card-media-body-supporting-bottom">
        <span class="card-media-body-supporting-bottom-text subtle">{{ $event->location }}</span>
        <span class="card-media-body-supporting-bottom-text subtle u-float-right">Event Budget – ${{ $event->event_budget }}</span>
      </div>
      <div class="card-media-body-supporting-bottom card-media-body-supporting-bottom-reveal">
        <span class="card-media-body-supporting-bottom-text subtle ">@foreach($event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last)
        , @endif @endforeach</span>
        <a href="{{route('users.events.vendors', $event->slug)}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
      </div>
    </div>
  </div>
  @endforeach
  @else
    <div class="alert alert-info closer-step mb-3 mt-4" role="alert">
      <i class="fa fa-info-circle"></i> No Events Found
    </div>
  @endif
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-center" id="GuestListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Guest List Manager</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(count($events) > 0)
        @foreach($events as $event)

         <div class="card-media  mt-4 wow bounceInRight" data-wow-delay="50ms">
    <!-- media container -->
    <div class="card-media-object-container">
      <div class="card-media-object" style="background-image: url({{$event->event_picture !='' ? url($event->event_picture) : '' }});">
        <div class="date-ribbon"><h2>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }}</h2> <h1>{{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}</h1></div>
      </div>
      <span class="card-media-object-tag subtle upcoming-event">Upcoming Event</span>
    </div>
    <!-- body container -->
    <div class="card-media-body">
      <div class="card-media-body-top">
        <span class="subtle">
          <strong>{{ ucfirst($event->title) }}</strong><br>
          {{ \Carbon\Carbon::parse($event->start_date)->format('l') }}, {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%b') }} {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%d') }}, {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
        </span>
        <div class="card-media-body-top-icons u-float-right">
         
        </div>
      </div>
      <span class="card-media-body-heading">{{ $event->description }}</span>
      <div class="card-media-body-supporting-bottom">
        <span class="card-media-body-supporting-bottom-text subtle">{{ $event->location }}</span>
        <span class="card-media-body-supporting-bottom-text subtle u-float-right">Event Budget – ${{ $event->event_budget }}</span>
      </div>
      <div class="card-media-body-supporting-bottom card-media-body-supporting-bottom-reveal">
        <span class="card-media-body-supporting-bottom-text subtle ">@foreach($event->eventCategories as $loopingTags)#{{ $loopingTags->eventCategory->label }} @if (!$loop->last)
        , @endif @endforeach</span>
        <a href="{{route('users.guestList', $event->slug)}}" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW DETAILS</a>
      </div>
    </div>
  </div>
  @endforeach
  @else
    <div class="alert alert-info closer-step mb-3 mt-4" role="alert">
      <i class="fa fa-info-circle"></i> No Events Found
    </div>
  @endif
      </div>
    </div>
  </div>
</div>
@endif

