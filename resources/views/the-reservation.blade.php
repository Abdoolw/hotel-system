@extends('layouts.hotel')

@section('main')
    <section class="site-hero inner-page overlay" style="background-image: url('{{ asset('images/slider-7.jpg') }}')"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Book Room</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/">Home</a></li>
                        <li>&bullet;</li>
                        <li>Book Room</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div
                                    style="color: green; border: 2px green solid; text-align: center; padding: 5px; margin-bottom: 10px;">
                                    Payment Successful!
                                </div>
                            @endif

                            <form id="payment-form" method="POST"
                                action="{{ route('booking.payment', ['id' => $room->id]) }}">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                {{-- <input type="hidden" name="total_price"
                                    value="{{ (($room->price * (strtotime($checkOut) - strtotime($checkIn))) / (60 * 60 * 24)) * 100 }}">
                                     --}}
                                <input type="hidden" name="total_price" id="total_price">
                                <input type='hidden' name='stripeToken' id='stripe-token-id'>

                                <h2 class="mb-4 text-center">{{ $room->name }} - ${{ $room->price }} / per night</h2>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_name" class="font-weight-bold">Customer Name</label>
                                        <input type="text" id="customer_name" name="customer_name" class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="font-weight-bold">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="font-weight-bold">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="check_in" class="font-weight-bold">Check In</label>
                                        <input type="date" id="check_in" name="check_in" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="check_out" class="font-weight-bold">Check Out</label>
                                        <input type="date" id="check_out" name="check_out" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="people" class="font-weight-bold">Number of People</label>
                                        <select id="people" name="people" class="form-control" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="card-element" class="mb-5">Credit or Debit Card</label>
                                        <div id="card-element" class="form-control"></div>
                                        <div id="card-errors" role="alert"></div>
                                    </div>

                                    <div class="col-md-6 align-self-end">
                                        <button id="pay-btn" class="btn btn-success btn-block text-white" type="button"
                                            onclick="createToken()">Pay Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    document.getElementById("pay-btn").disabled = false;
                    alert(result.error.message);
                } else {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById('payment-form').submit();
                }
            });
        }
    </script>


@endsection
