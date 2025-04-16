@extends('layouts.hotel')

@section('main')
    <section class="site-hero inner-page overlay" style="background-image: url(images/slider-7.jpg)"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Contact</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/">Home</a></li>
                        <li>&bullet;</li>
                        <li>Contact</li>
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
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section class="section contact-section" id="next">
        <div class="container">
            <div class="row">
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

                    <form action="{{ route('contact.us.store') }}" method="POST" class="bg-white p-md-5 p-4 mb-5 border">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control ">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control ">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control ">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">subject</label>
                                <input type="text" id="phone" name="subject" class="form-control ">
                                @if ($errors->has('subject'))
                                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 form-group">
                                <label for="message">Write Message</label>
                                <textarea name="message" id="message" name="message" class="form-control " cols="30" rows="8"></textarea>
                                @if ($errors->has('message'))
                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Send Message"
                                    class="btn btn-primary text-white font-weight-bold">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-md-10 ml-auto contact-info">
                            <p><span class="d-block">Address:</span> <span> 98 West 21th Street, Suite 721 New York NY
                                    10016</span></p>
                            <p><span class="d-block">Phone:</span> <span> (+1) 234 4567 8910</span></p>
                            <p><span class="d-block">Email:</span> <span> info@domain.com</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section testimonial-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">People Says</h2>
                </div>
            </div>
            <div class="row">
                <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($feed as $feed)
                        <!-- استخدام $feeds بدلاً من $feed -->
                        <div class="testimonial text-center slider-item">
                            <div class="author-image mb-3">
                                <img src="/images/{{ $feed->image }}" alt="Image placeholder"
                                    class="rounded-circle mx-auto">
                            </div>
                            <blockquote>
                                {{-- <p>&ldquo;{{ $feed->Description }}.&rdquo;</p> <!-- تأكد من أن الوصف كاملاً هنا --> --}}
                                <p>&ldquo;{!! nl2br(e($feed->Description)) !!}&rdquo;</p>
                            </blockquote>
                            <p><em>&mdash; {{ $feed->name }}</em></p>
                        </div>
                    @endforeach
                </div>
                <!-- END slider -->
            </div>
        </div>
    </section>
@endsection
