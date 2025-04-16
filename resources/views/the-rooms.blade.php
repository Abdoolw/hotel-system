@extends('layouts.hotel')

@section('main')
    <section class="site-hero inner-page overlay" style="background-image: url(images/slider-7.jpg)"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Rooms</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/">Home</a></li>
                        <li>&bullet;</li>
                        <li>Rooms</li>
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

    <section class="section pb-4">
        <div class="container">

            <div class="row check-availabilty" id="next">
                <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

                    <form action="/check-availability" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                                <div class="field-icon-wrap">
                                    <div class="icon"><span class="icon-calendar"></span></div>
                                    <input type="date" id="checkin_date" name="check_in" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                                <div class="field-icon-wrap">
                                    <div class="icon"><span class="icon-calendar"></span></div>
                                    <input type="date" id="checkout_date" name="check_out" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="adults" class="font-weight-bold text-black">People</label>
                                        <div class="field-icon-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select id="adults" class="form-control" name="people" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 align-self-end">
                                <button type="submit" class="btn btn-primary btn-block text-white">Check
                                    Availability</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="section">
        <div class="container">

            <div class="row">
                @foreach ($room as $room)
                    <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
                        <a href="{{ route('room.details', $room->id) }}" class="room">
                            <figure class="img-wrap">
                                <img src="/images/{{ $room->image }}" alt="Free website template" class="img-fluid mb-3">
                            </figure>
                            <div class="p-3 text-center room-info">
                                <h2>{{ $room->name }}</h2>
                                <span class="text-uppercase letter-spacing-1">{{ $room->price }}/ per night</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
