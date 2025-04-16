@extends('layouts.hotel')

@section('main')
    <section class="site-hero inner-page overlay" style="background-image: url(images/slider-7.jpg)"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">About Us</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/">Home</a></li>
                        <li>&bullet;</li>
                        <li>About</li>
                    </ul>
                </div>
            </div>
        </div>

        <a class="mouse smoothscroll" href="#next">
            <div class="mouse-icon">
                <span class="mouse-wheel"></span>
            </div>
        </a>
    </section>
    <!-- END section -->

    @foreach ($house as $house)
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
                        <figure class="img-absolute">
                            <img src="/images/{{ $house->image1 }}" alt="Image" class="img-fluid">
                        </figure>
                        <img src="/images/{{ $house->image2 }}" alt="Image" class="img-fluid rounded">
                    </div>
                    <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
                        <h2 class="heading">{{ $house->title }}</h2>
                        <p class="mb-4">{{ $house->Description }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endforeach


    <div class="container section">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7 mb-5">
                <h2 class="heading" data-aos="fade-up">Leadership</h2>
            </div>
        </div>

        <div class="row"> <!-- إضافة صف لتجميع العناصر -->
            @foreach ($leadership as $member)
                <!-- استخدام متغير مختلف لتجنب التداخل -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="block-2">
                        <div class="flipper">
                            <div class="front" style="background-image: url('/images/{{ $member->image }}');">
                                <!-- تصحيح استخدام url -->
                                <div class="box">
                                    <h2>{{ $member->name }}</h2>
                                    <p>{{ $member->job }}</p>
                                </div>
                            </div>
                            <div class="back">
                                <blockquote>
                                    <p>{{ $member->Description }}</p>
                                </blockquote>
                                <div class="author d-flex">
                                    <div class="image mr-3 align-self-center">
                                        <img src="/images/{{ $member->image }}" alt="">
                                    </div>
                                    <div class="name align-self-center">{{ $member->name }}<span
                                            class="position">{{ $member->job }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .flip-container -->
                </div>
            @endforeach
        </div> <!-- END .row -->
    </div> <!-- END .container -->


    <section class="section slider-section bg-light">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">Photos</h2>
                    <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the
                        countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="home-slider owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($image as $img)
                            <div class="slider-item">
                                <a href="/images/{{ $img->image }}" data-fancybox="images"
                                    data-caption="Caption for this image">
                                    <img src="/images/{{ $img->image }}" alt="Image placeholder" class="img-fluid">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!-- END slider -->
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->


    <div class="section">
        <div class="container">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7 mb-5">
                    <h2 class="heading" data-aos="fade">History</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach ($history as $event)
                    <div class="col-md-8">
                        <div class="timeline-item" date-is='{{ $event->year }}' data-aos="fade">
                            <h3>{{ $event->title }}</h3>
                            <p>{{ $event->Description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
