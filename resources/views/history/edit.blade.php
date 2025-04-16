@extends('layouts.dashborad')

@section('main')
    <div class="px-5">
        <div class="card">
            <div class="text-center">
                <div class="card-header">
                    Edit The History
                </div>
            </div>
            <div class="row my-2 px-2">
                <div class="px-3 my-3">
                    <form class="row g-3" action="{{ route('history.update', $history->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" class="form-control" id="name" name="title"
                                value="{{ $history->title }}">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Year</label>
                            <input type="text" class="form-control" id="job" name="year"
                                value="{{ $history->year }}">
                            @error('job')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="inputDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="inputDescription" name="Description" value="{{ $history->Description }}">>

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
