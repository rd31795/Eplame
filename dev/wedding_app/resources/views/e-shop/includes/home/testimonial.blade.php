<!-- Testimonial Page starts here--> 
<!--  <section class="testimonial" data-step="10" data-intro="This section shows what our clients think of us.">
    <div class="container aos-init aos-animate" data-aos="fade-left" data-aos-duration="3000">
        <div class="sec-heading text-center">
            <h2>{{$testimonial_title}}</h2>
        </div> 
        <div class="owl-carousel owl-theme owl-loaded owl-drag">
            @if(!empty($testimonials[0]->id))
            @foreach($testimonials as $testimonial)
            <div class="item">
                <div class="wrap">
                    <figure>
                        <img class="commas" src="{{url('/')}}/frontend/images/commas.png" alt="" />
                        <img src="{{ url('/').'/wedding_app/public/uploads/'.$testimonial->image }}" alt="" />
                    </figure>
                    <p>{{ $testimonial->summary }}</p>
                    <p class="name">{{ $testimonial->title }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section> -->
<!-- TESTIMONIALS SECTION CODE -->
<section class="testimonials-sec">
    <div class="container">
        <div class="sec-heading text-center">
            <h2>That's what our client says about us</h2>
        </div>
        <div class="Testimonials_content">
            <!-- carousel -->
            <div class="owl-carousel custome_slide testimonial-slider">
                <!-- card -->
                 @foreach($testimonials as $testimonial)
                <div class="test_img">
                    <div class="Testimonials_card">
                        <div class="Testimonials_card-top">
                            <h5>{{ $testimonial->title }}</h5>
                            <p>{{ $testimonial->summary }}</p>
                        </div>
                        <div class="Testimonials_card-bottom">
                            <figure>
                                <img src="{{ url('/').'/wedding_app/public/uploads/'.$testimonial->image }}" class="img-fluid">
                            </figure>
                            <!-- <h6>Jacob Tylor</h6>
                            <p>Lorem ipsum</p> -->
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- card -->
                <!-- card -->
               <!--  <div class="test_img">
                    <div class="Testimonials_card">
                        <div class="Testimonials_card-top">
                            <h5>heading Service</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Auctor neque sed imperdiet nibh lectus feugiat nunc sem.</p>
                        </div>
                        <div class="Testimonials_card-bottom">
                            <figure>
                                <img src="https://eplame.com/dev/wedding_app/public/uploads/1609916988.png" class="img-fluid">
                            </figure>
                            <h6>heading Parker</h6>
                            <p>Lorem ipsum</p>
                        </div>
                    </div>
                </div> -->
                <!-- card -->
                <!-- card -->
            <!--     <div class="test_img">
                    <div class="Testimonials_card">
                        <div class="Testimonials_card-top">
                            <h5>heading Collaborating</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Auctor neque sed imperdiet nibh lectus feugiat nunc sem.</p>
                        </div>
                        <div class="Testimonials_card-bottom">
                            <figure>
                                <img src="https://eplame.com/dev/wedding_app/public/uploads/1609916988.png" class="img-fluid">
                            </figure>
                            <h6>Stephany Martin</h6>
                            <p>Lorem ipsum</p>
                        </div>
                    </div>
                </div> -->
                <!-- card -->
                <!-- card -->
               <!--  <div class="test_img">
                    <div class="Testimonials_card">
                        <div class="Testimonials_card-top">
                            <h5>heading Collaborating</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Auctor neque sed imperdiet nibh lectus feugiat nunc sem.</p>
                        </div>
                        <div class="Testimonials_card-bottom">
                            <figure>
                                <img src="https://eplame.com/dev/wedding_app/public/uploads/1609916988.png" class="img-fluid">
                            </figure>
                            <h6>heading Martin</h6>
                            <p>Lorem ipsum</p>
                        </div>
                    </div>
                </div> -->
                <!-- card -->
            </div>
            <!-- carousel end-->
        </div>
    </div>
</section>
<!-- TESTIMONIALS SECTION END CODE 