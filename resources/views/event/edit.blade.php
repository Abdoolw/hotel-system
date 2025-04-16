@extends('layouts.dashborad')

@section('main')
    <div class="px-5">
        <div class="card">
            <div class="text-center">
                <div class="card-header">
                    Edit The Event
                </div>
            </div>
            <div class="row my-2 px-2">
                <div class="px-3 my-3">
                    <form class="row g-3" action="{{ route('event.update', $event->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" class="form-control" id="name" name="title"
                                value="{{ $event->name }}">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="photo" class="form-label">Image</label>
                            <input type="file" class="form-control" id="inputPassword4" name="image">
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="inputDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="inputDescription" name="Description" value="{{ $event->Description }}">>

                            @error('Description')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4 justify-content-center mt-3">
                            <button type="submit" class="btn btn-outline-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
