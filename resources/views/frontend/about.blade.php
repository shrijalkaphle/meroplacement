@extends('layout.frontend')
@section('title', 'About Us')
@section('body')



    <!-- Start About -->
<section id="job-about">
    <div class="container py-5">
        <div class='col-12'>
              <p>{!! $sitesetting->about !!}</p>
            
        </div>
      
    </div>
</section>
<!-- End About -->

<!-- Start Job For -->
<section id="job-for" class="section-gap">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="job-for-area">
                <!-- Title -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="job-title">
                            <h2 style="color: white">Who is the website for?</h2>	
                        </div>
                    </div>
                </div>
                <!-- Start for Content -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="job-for-content">
                            <div class="row">
                                <!-- start single item -->
                                <div class="col-md-4">
                                    <div class="job-single-for">
                                        <i class="fa fa-eye"></i>
                                        <h3>Job Seeker</h3>
                                        <p>Find new vacancies or freelancing jobs</p>
                                    </div>
                                </div>
                                <!-- End single item -->
                                <!-- start single item -->
                                <div class="col-md-4">
                                    <div class="job-single-for">
                                        <i class="fa fa-user"></i>
                                        <h3>Employers</h3>
                                        <p>Post new job vacancies for the company.</p>
                                    </div>
                                </div>
                                <!-- End single item -->
                                <!-- start single item -->
                                <div class="col-md-4">
                                    <div class="job-single-for">
                                        <i class="fa fa-building-o"></i>
                                        <h3>Companies</h3>
                                        <p>Hire an employee for the company.</p>
                                    </div>
                                </div>
                                <!-- End single item -->
                            
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- End job for Content -->
            </div>
        </div>
    </div>
</div>
</section>
<!-- End job for -->

    





<!-- Start testimonial Area -->
<section class="home-testimonial section-gap" id="review">
    <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Testimonial from our Clients</h1>
                    <p>Who are in extremely love with eco friendly system.</p>
                </div>
            </div>
        </div>
        <section class="home-testimonial-bottom">
            <div class="container testimonial-inner">
                <div class="row d-flex justify-content-center">
                      @foreach ($testimonials as $t)
                    <div class="col-md-4 style-3">
                        <div class="tour-item ">
                            <div class="tour-desc bg-grey">
                                <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="/uploads/{{ $t->image }}" width="70"></div>
                                <div class="link-name d-flex justify-content-center" style="font-weight:700">{{ $t->title }}</div>
                                
                                <div class="tour-text color-grey-3 text-center mt-2">{{ $t->description }}</div>
                            </div>
                        </div>
                    </div>
                     @endforeach
                  
          
                </div>
        </section>
</section>


<!--<section class="testimonial-area section-gap" id="review">-->
<!--    <div class="container">-->
<!--        <div class="row d-flex justify-content-center">-->
<!--            <div class="menu-content pb-60 col-lg-8">-->
<!--                <div class="title text-center">-->
<!--                    <h1 class="mb-10">Testimonial from our Clients</h1>-->
<!--                    <p>Who are in extremely love with eco friendly system.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>						-->
<!--        <div class="row">-->
<!--            <div class="splide">-->
<!--                <div class="splide__track">-->
<!--                    <ul class="splide__list">-->
<!--                        @foreach ($testimonials as $t)-->
<!--                            <li class="splide__slide">-->
<!--                                <div class="single-review">-->
<!--                                    <img src="/uploads/{{ $t->image }}">-->
<!--                                    <div class="title d-flex flex-row">-->
<!--                                        <h4>{{ $t->title }}</h4>-->
<!--                                    </div>-->
<!--                                    <p> {{ $t->description }} </p>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        @endforeach-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
   
<!--        </div>-->
<!--    </div>	-->
<!--</section>-->
@endsection

@section('script')
    <script>
        var splide = new Splide( '.splide', {
            type: 'loop',
            arrows: false,
            autoplay: true,
            interval: 5000,
            rewind: true
        } )
        splide.mount()
    </script>
@endsection