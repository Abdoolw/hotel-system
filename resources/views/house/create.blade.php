@extends('layouts.dashborad')

@section('main')
    <div class="px-5">
        <div class="card">
            <div class="text-center">
                <div class="card-header">
                    Add House
                </div>
            </div>
            <div class="row my-2 px-2">
                <div class="px-3 my-3">
                    <form class="row g-3" action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" class="form-control" id="name" name="title"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="photo" class="form-label">Image1</label>
                            <input type="file" class="form-control" id="image" name="image1">
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="photo" class="form-label">Image2</label>
                            <input type="file" class="form-control" id="image" name="image2">
                            @error('image2')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="inputDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="inputDescription" name="Description"
                                value="{{ old('Description') }}">

                            @error('Description')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-outline-primary">Add House</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
