@extends('layouts.dashborad')

@section('main')
    <div class="px-5">
        <div class="card">
            <div class="text-center">
                <div class="card-header">
                    Add New image
                </div>
            </div>
            <div class="row my-2 px-2">
                <div class="px-3 my-3">
                    <form class="row g-3" action="{{ route('Gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            <label for="photo" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-outline-primary">Add New Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
