@extends('layouts.dashborad')

@section('main')
    <div class="container">
        <h1>Reservations Rooms </h1>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary"> Create New Reservation </a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>customer_name </th>
                    <th>Room</th>
                    <th>check_in </th>
                    <th>check_out </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->customer_name }}</td>
                        <td>{{ $reservation->room->name }}</td>
                        <td>{{ $reservation->check_in }}</td>
                        <td>{{ $reservation->check_out }}</td>
                        <td>
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">edit</a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
