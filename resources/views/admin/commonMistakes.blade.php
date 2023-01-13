@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Common Mistakes | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Common Mistakes</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($common_mistakes) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($common_mistakes as $common_mistake)
                                        <tr>
                                            <td>{{ $common_mistake->id }}</td>
                                            <td>{{ $common_mistake->cmCategories->name }}</td>
                                            <td>{{ $common_mistake->cm_type }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ url('/admin/common-mistake-detail/' . $common_mistake->id) }}"><i class="fa fa-eye"></i></a>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $common_mistake->id }}"
                                                    onclick="delete_common_mistake({{ $common_mistake->id }})"><i class='bx bxs-trash' ></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $common_mistake->id }}" hidden>
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
                        <div class="container d-flex justify-content-center mt-3">
                            <h5>Common Mistake Not Added Yet</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation" class="mt-3">
                    <ul class="pagination justify-content-center">
                        {{ $common_mistakes->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Common Mistake</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-cm') }}" method="Post">
                            @csrf
                            <div class="form-outline mb-4">
                                <textarea placeholder="Type here" class="ckeditor form-control" rows="3" id="content" name="content"></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <select id="cm_cat_id" name="cm_cat_id" class=" form-control" required>
                                    <option value="" hidden readonly>Select CM Category</option>
                                    @foreach ($cm_categories as $cm_category)
                                        <option value="{{ $cm_category->id }}" @selected(old('cm_cat_id') == $cm_category->id)>
                                            {{ $cm_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <select id="cm_type" name="cm_type" class=" form-control" required>
                                    <option value="" hidden readonly>Select Type</option>
                                    <option value="Ivy">Ivy</option>
                                    <option value="Good">Good</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Poor">Poor</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Common Mistake</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.ckeditor ').ckeditor();
            });
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function delete_common_mistake(id) {
                $.ajax({
                    url: "{{ route('admin.delete-cm') }}",
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
