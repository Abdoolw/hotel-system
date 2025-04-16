@extends('layouts.hotel')

@section('main')
    <section class="site-hero inner-page overlay" style="background-image: url('{{ asset('images/slider-7.jpg') }}')"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Events</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/">Home</a></li>
                        <li>&bullet;</li>
                        <li>Events</li>
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

    <section class="section bg-light">

        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h4 class="heading" data-aos="fade">{{ $event->title }}</h4>
                </div>
            </div>

            <div class="site-block-half d-block d-lg-flex bg-white" data-aos="fade" data-aos-delay="100">
                <a href="#" class="image d-block bg-image-2"
                    style="background-image: url('/images/{{ $event->image }}');"></a>
                <div class="text">
                    <p>{{ $event->Description }}</p>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
                        language ocean.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
