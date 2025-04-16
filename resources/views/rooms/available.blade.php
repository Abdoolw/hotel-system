@extends('layouts.dashborad')

@section('main')
    <h2>Available Room List</h2>

    <br>

    <table class="table table-white" width="400px">
        <thead>
            <tr>
                <th scope="col">Room No</th>
                <th scope="col">Price</th>
                <th scope="col">People</th>
            </tr>
        </thead>

        @forelse ($rooms as $room)
            <tbody>
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->price }}</td>
                    <td>{{ $room->people }}</td>
                </tr>
            </tbody>
        @empty
            No Data Found
        @endforelse

    </table>
@endsection
