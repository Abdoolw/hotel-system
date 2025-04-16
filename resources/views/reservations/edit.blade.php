@extends('layouts.dashborad')

@section('main')
    <div class="container">
        <h1>Edit Reservation</h1>

        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="room_id">room</label>
                <select name="room_id" class="form-control" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $room->id == $reservation->room_id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="customer_name">customer_name</label>
                <input type="text" name="customer_name" class="form-control" value="{{ $reservation->customer_name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="phone"> phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $reservation->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="email"> email</label>
                <input type="email" name="email" class="form-control" value="{{ $reservation->email }}" required>
            </div>
            <div class="mb-3">
                <label for="check_in"> check_in</label>
                <input type="date" name="check_in" class="form-control" value="{{ $reservation->check_in }}" required>
            </div>
            <div class="mb-3">
                <label for="check_out">check_out</label>
                <input type="date" name="check_out" class="form-control" value="{{ $reservation->check_out }}" required>
            </div>
            <div class="mb-3">
                <label for="people"> number of people</label>
                <input type="number" name="people" class="form-control" value="{{ $reservation->people }}" required>
            </div>
            <button type="submit" class="btn btn-success"> Update Reservation</button>
        </form>
    </div>
@endsection
