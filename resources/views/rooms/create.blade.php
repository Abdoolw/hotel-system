@extends('layouts.dashborad')

@section('main')
    <div class="px-5">
        <div class="card">
            <div class="text-center">
                <div class="card-header">
                    Add New Room
                </div>
            </div>
            <div class="row my-2 px-2">
                <div class="px-3 my-3">
                    <form class="row g-3" action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Price</label>
                            <input type="text" class="form-control" id="name" name="price"
                                value="{{ old('price') }}">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">People</label>
                            <input type="text" class="form-control" id="name" name="people"
                                value="{{ old('people') }}">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="photo" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-outline-primary">Add New Room</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


<script type="text/javascript">
    $('#contactUSForm').submit(function(event) {
        event.preventDefault();

        grecaptcha.ready(function() {
            grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {
                action: 'subscribe_newsletter'
            }).then(function(token) {
                $('#contactUSForm').prepend(
                    '<input type="hidden" name="g-recaptcha-response" value="' + token +
                    '">');
                $('#contactUSForm').unbind('submit').submit();
            });;
        });
    });
</script>
