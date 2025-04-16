@extends('layouts.dashborad')

@section('main')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success d-inline-block mb-2" href="{{ route('users.create') }}" style="margin-right: 10px;">
                    <i class="fa fa-plus"></i> Create New User
                </a>
                <a href="{{ route('download.pdf') }}" class="btn btn-primary d-inline-block mb-2">Download PDF</a>

            </div>
        </div>
    </div>


    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" class="form-control">

        <br>
        <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>

        <a class="btn btn-warning float-end" href="{{ route('users.export') }}"><i class="fa fa-download"></i> Export User
            Data</a>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge bg-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}"><i
                            class="fa-solid fa-list"></i> Show</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}"><i
                            class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                            Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->links('pagination::bootstrap-5') !!}


@endsection
