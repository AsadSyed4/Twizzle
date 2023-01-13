@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>TIPS | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>TIPS</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($tips) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($tips as $tip)
                                        <tr>
                                            <td>{{ $tip->id }}</td>
                                            <td>{{ $tip->tipsCategories->name }}</td>
                                            <td>{{ $tip->tipsSubCategories->name }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ url('/admin/tip-detail/' . $tip->id) }}"><i class="fa fa-eye"></i></a>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $tip->id }}"
                                                    onclick="delete_tip({{ $tip->id }})"><i class='bx bxs-trash'></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $tip->id }}" hidden>
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
                            <h5>TIPS Not Added Yet</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $tips->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add TIP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-tip') }}" method="Post">
                            @csrf
                            <div class="form-outline mb-4">
                                <textarea placeholder="Type here" class="ckeditor form-control" rows="3" id="content" name="content"></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <select id="tips_cat_id" name="tips_cat_id" class=" form-control" required
                                    onchange="get_tips_sub_category()">
                                    <option hidden readonly>Select Tips Category</option>
                                    @foreach ($tips_categories as $tips_category)
                                        <option value="{{ $tips_category->id }}"
                                            @if (old('tips_cat_id') == $tips_category->id) selected @endif>{{ $tips_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger">
                                    @error('tips_cat_id')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group mb-4">
                                <select id="tips_sub_cat_id" name="tips_sub_cat_id" class=" form-control" required>
                                    <option hidden readonly>Select Tips Sub Category</option>
                                    @foreach ($tips_sub_categories as $tips_sub_category)
                                        <option value="{{ $tips_sub_category->id }}"
                                            @if (old('tips_sub_cat_id') == $tips_sub_category->id) selected @endif>
                                            {{ $tips_sub_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger">
                                    @error('tips_sub_cat_id')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add TIP</button>
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

            function delete_tip(id) {
                $.ajax({
                    url: "{{ route('admin.delete-tip') }}",
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

            function get_tips_sub_category() {
                $.ajax({
                    url: "{{ route('admin.get-tips-sub-cat') }}",
                    data: {
                        'id': $('#tips_cat_id option:selected').val()
                    },
                    type: 'POST',
                    beforeSend: function() {
                        $('#tips_sub_cat_id').empty();
                        $('#tips_sub_cat_id').append($('<option>', {
                            value: 1,
                            text: 'loading...'
                        }));
                    },
                    success: function(data) {
                        if (data.success) {
                            sub_cat = data.data;
                            $('#tips_sub_cat_id').empty();
                            $.each(sub_cat, function(index, value) {
                                $('#tips_sub_cat_id').append($('<option>', {
                                    value: value.id,
                                    text: value.name
                                }));
                            });
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
