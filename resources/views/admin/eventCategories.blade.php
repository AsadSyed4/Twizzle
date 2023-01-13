@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Event Categories | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Event Categories</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($event_categories) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($event_categories as $event_category)
                                        <tr>
                                            <td>{{ $event_category->id }}</td>
                                            <td>{{ $event_category->name }}</td>
                                            <td>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $event_category->id }}"
                                                    onclick="delete_event_category({{ $event_category->id }})"><i class='bx bxs-trash'></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $event_category->id }}" hidden>
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="container d-flex justify-content-center">
                            <h5>Event Category Not Added Yet</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $event_categories->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-events-category') }}" method="Post">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="{{ old('name') }}" required>
                                <small class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Event Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            function delete_event_category(id) {
                $.ajax({
                    url: "{{ route('admin.delete-events-category') }}",
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    beforeSend: function() {
                        $("#loading_btn_" + id).removeAttr('hidden');
                        $("#dlt_btn_" + id).hide();
                    },
                    success: function(data) {
                        if (data.success) {
                            iziToast.success({
                                position: 'topRight',
                                message: data.message,
                            });
                            window.location.reload();
                        } else {
                            iziToast.error({
                                position: 'topRight',
                                message: data.message,
                            });
                        }
                    }
                });
            }
        </script>
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
