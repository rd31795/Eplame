@extends('e-shop.layouts.layout')
@section('content')
<!-- banner section starts here here -->
{{-- <section class="main-banner home-main-banner" style="background-image:url({{url($homebanner->background_image)}});">
    <div class="container">
        <div class="banner-content">
            <div class="row cstm-flex-row">
                <div class="col-lg-7 wow bounceInLeft" data-wow-delay=".40s">
                    <div class="banner-text">
                        {!! $homebanner->Description !!}
                        <!--   <h1>
                             <small>Sed ut perspiciatis unde omnis</small>
                            vero eos et accusamus et iusto odio </h1>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p> -->
                    </div>
                    @if($homebanner->btn_name)
                    <div class="btn-wrap mt-4">
                        <a href="{{$homebanner->redirection_url}}" class="cstm-btn solid-btn">{{$homebanner->btn_name}}</a>
                    </div>
                    @endif
                </div>
                <div class="col-lg-5 wow bounceInRight" data-wow-delay=".40s">
                    <figure class="banner-product-img wow rubberBand" data-wow-delay=".45s">
                        <img src="{{url($homebanner->extra_image)}}">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<section class="banner-slider-sec">
    <div class="banner-slider-content">
        <!-- slider -->
        <div class="owl-carousel owl-theme banner-slider">
            @foreach($homebanner as $slider)
            <div class="item" style="background:url('{{url($slider->background_image)}}');">
                <a href="javascript:void(0);">
                <div class="container">
                    <div class="banner-card">                    
                        <div class="row cstm-flex-row">
                            <div class="col-lg-12 wow bounceInLeft" data-wow-delay=".40s">
                                <div class="banner-text">
                               {!! $slider->Description !!} 
                                </div>
                            </div>
                        </div>                      
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- slider end -->
    </div>
</section>
<!-- banner section starts Ends here -->
<div id="loadFeaturedCategory" data-route="{{url(route('shop.ajax.featuredCategory'))}}"></div>
<!--product type start here -->
@include('e-shop.includes.home.productTypes')

@include('e-shop.includes.home.topSeller')
<!--product type end here -->
<!--Products section starts here-->
@include('e-shop.includes.home.newProducts')
<!-- Products section ends here-->
@include('e-shop.includes.home.popularProducts')

@include('e-shop.includes.home.commonCategory')
{{--
<!--Featured section starts here-->
@include('e-shop.includes.home.featuredProducts')
<!--Featured section ends here-->
@include('e-shop.includes.home.categoryproduct')
--}}

@include('e-shop.includes.home.CategoryProductlisting')
<!--Some information About Site Start-->
@include('e-shop.includes.home.shortAboutUs')
<!--Some information About Site End -->
<!-- Testimonial Section Start -->
@include('e-shop.includes.home.testimonial')
<!--  Testimonial Section End  -->
@endsection