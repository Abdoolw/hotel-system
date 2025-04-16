@extends('layouts.hotel')

@section('main')
    <section class="site-hero inner-page overlay" style="background-image: url(images/slider-7.jpg)"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Available Rooms</h1>
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

    @if (isset($availableRooms) && $availableRooms->isEmpty())
        <p>No rooms available for the selected dates.</p>
    @else
        <section class="section">
            <div class="container">
                <div class="row">
                    @foreach ($availableRooms as $room)
                        <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
                            <a href="{{ route('room.details', $room->id) }}" class="room">
                                <figure class="img-wrap">
                                    <img src="/images/{{ $room->image }}" alt="{{ $room->name }}" class="img-fluid mb-3">
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
    @endif



    {{-- <a href="{{ route('contact.form') }}">Back to Booking</a> --}}
@endsection
