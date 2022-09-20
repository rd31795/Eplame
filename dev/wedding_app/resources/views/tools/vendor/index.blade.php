@extends('layouts.home')

@section('title') Welcome to Eplame @endsection
@section('description') Welcome to Eplame @endsection
@section('keywords') Welcome to Eplame @endsection

@section('content')
<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
        <div class="container">
            <div class="banner-content event-top">
                <h1>{{ $vendor_title }}</h1>
                 <p>{{ $vendor_tagline }}</p>
            </div>
        </div>
        
    </section>
    @include('tools.includes.navbar')
    @if(Auth::user()->id == $user_event->user_id || checkPermission('vendor_management', $user_event->id) == 1)
    <section class="vendor-manager-sec">
        <div class="container">
            <div class="sec-card">
                <!-- <div class="btn-wrap checklist-wrap text-right mb-3">
                    <a href="javascirpt:void(0);" class="task-btn">
                        Add Vendor<span><i class="fas fa-plus"></i></span>
                    </a>
                </div> -->
            <div class="sec-heading text-center dark-heading">
                            <h2>HIRED Vendors</h2>
                        </div>
            <div class="row packages-row aos-init aos-animate" data-aos="fade-left" data-aos-duration="3000">
                @if(!empty($orders[0]->id))
                    @foreach($orders as $order)
                        <div class="col-lg-4 col-md-4">
                            <div class="main-package-card">
                                @if($order->vendor->category && $order->vendor->category->cover_type == 1)
                                    <figure>
                                        <img src="{{url(getBasicInfo($order->vendor->vendors->id, $order->vendor->category_id,'basic_information','cover_photo'))}}">
                                    </figure>
                                @else
                                    <figure>
                                        <img src="{{url(getBasicInfo($order->vendor->vendors->id, $order->vendor->category_id,'basic_information','cover_video_image'))}}">
                                    </figure>
                                @endif
                               <a href="{{url('/listing/'.$order->vendor->category->slug.'/'.$order->vendor->business_url)}}" class="event_info-text text-center">                        
                                  <h3 class="pkg-heading">{{$order->vendor->category->label}}</h3>
                                  <h4 class="destination-text">{{$order->vendor->title}}</h4>
                               </a>
                               <!-- <a href="javascript:void(0);" class="distance">
                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                  <p>Review</p>
                               </a> -->
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="block-box" style="width: 100%;">
                    <div class="not-found-box">
                        <div class="warning-box space">
                            <div class="shadow-box">
                                <div class="info-tab tip-icon" title="Useful Tips">
                                    <span class="fas fa-exclamation-triangle"> </span> <i></i>
                                </div>
                                <div class="warning-text">
                                    <h4>No Vendor hired</h4>
                                    <p>You have not hired any vendor on this event till now.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                @endif                   
                  </div><!-- End -->
                   <div class="event-category-sec">
                        <div class="container">
                            <div class="sec-heading text-center dark-heading">
                                <h4>Keep searching for your wedding vendors</h4>
                                <h2>NOT HIRED? HIRE THEM!</h2>
                            </div>
                            <div class="row">
                                @foreach($cate as $cat)
                                <div class="col-lg-3">
                                    <div class="category_card">
                                        <span class="category_icon"><img src="{{url('/')}}/{{$cat->image}}"></span>
                                        <div class="category_text">
                                            <h3>{{$cat->label}}</h3>
                                            <a href="{{url('/')}}/vendor-listing?category_id={{$cat->id}}" class="find-btn mt-3"><i class="fas fa-search mr-2"></i> Find</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-lg-3">
                                    <div class="category_card">
                                        <span class="category_icon"><img src="{{url('/')}}/images/categories/1600874752PvbMEbTmGjEyUGmlKk2PVenue.png"></span>
                                        <div class="category_text">
                                            <h3>Others</h3>
                                            <a href="{{url('/')}}/vendor-listing" class="find-btn mt-3"><i class="fas fa-search mr-2"></i> Find</a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
              </div>
        </div>
    </section>
    <section class="how-its-work-sec tool-works">
        <div class="container">
            <div class="sec-heading text-center">          
                  <h2>{{$vendor_video_title}}</h2>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="video-container">
                        <figure>
                            <video class="video" id="bVideo" loop="" width="100%" height="100%" poster="{{ $vendor_video_poster ? url('/uploads').'/'.$vendor_video_poster : '/frontend/images/video-poster.png'}}">
                                <source src="{{ $vendor_video ? url('/uploads').'/'.$vendor_video : '/frontend/videos/Dummy Video.mp4' }}" type="video/mp4">
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
    @else
    <section class="services-tab-sec">

        <div class="container">
            <div class="sec-card">
                <div class="tab-wrap">
                    You are not autorised to access this page.
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@section('scripts')

@endsection