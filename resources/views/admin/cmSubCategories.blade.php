@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>CM Sub Categories | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>CM Sub Categories</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($cm_sub_categories) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($cm_sub_categories as $cm_sub_category)
                                        <tr>
                                            <td>{{ $cm_sub_category->id }}</td>
                                            <td>{{ $cm_sub_category->name }}</td>
                                            <td>{{ $cm_sub_category->cmCategories->name }}</td>
                                            <td>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $cm_sub_category->id }}"
                                                    onclick="delete_cm_sub_category({{ $cm_sub_category->id }})"><i class='bx bxs-trash' ></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $cm_sub_category->id }}" hidden>
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
                            <h5>CM Sub Category Not Added Yet</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $cm_sub_categories->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add CM Sub Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-cm-sub-category') }}" method="Post">
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
                            <div class="form-group mb-4">
                                <select id="cm_cat_id" name="cm_cat_id" class=" form-control" required>
                                    <option hidden readonly>Select CM Category</option>
                                    @foreach ($cm_categories as $cm_category)
                                        <option value="{{ $cm_category->id }}" @selected(old('cm_cat_id') == $cm_category->id)>
                                            {{ $cm_category->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">
                                    @error('cm_cat_id')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add CM Sub Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function delete_cm_sub_category(id) {
                $.ajax({
                    url: "{{ route('admin.delete-cm-sub-category') }}",
                    data: {
                        'id': id
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
