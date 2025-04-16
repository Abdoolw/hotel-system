@extends('layouts.dashborad')

@section('main')
    <div class="px-5">
        <div class="card">
            <div class="text-center">
                <div class="card-header">
                    The Events
                </div>
            </div>

            <div class="row my-2 px-2">
                <div class="px-3 my-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Delete/Edit</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($event as $event)
                                <tr>
                                    <th scope="row">{{ $event->id }}</th>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->Description }}</td>
                                    <td>
                                        <img src="/images/{{ $event->image }}" class="img-fluid rounded-start"
                                            height="100" width="100" alt="1">
                                    </td>
                                    @can('image-edit')
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('event.edit', $event->id) }}">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </a>
                                        @endcan

                                        @can('image-delete')
                                            <form id="deleteForm-{{ $event->id }}"
                                                action="{{ route('event.destroy', $event->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $event->id }})">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                function confirmDelete(id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('deleteForm-' + id).submit();
                        }
                    });
                }
            </script>
        </div>
    </div>
@endsection
