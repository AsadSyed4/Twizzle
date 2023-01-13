@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Blogs | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Blogs</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($blogs) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Short Description</th>
                                        <th>Media</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->id }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->short_content }}</td>
                                            <td><img src="{{ asset('uploads/' . $blog->media) }}"
                                                    class="img-thumbnail w-px-40 h-auto" alt=""></td>
                                            <td>{{ $blog->blog_categories->name }}</td>
                                            <td>
                                                @foreach ($blog->tags as $tag)
                                                    {{ $tag->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="{{ url('/admin/blog/' . $blog->id) }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $blog->id }}"
                                                    onclick="delete_common_mistake({{ $blog->id }})"><i
                                                        class='bx bxs-trash'></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $blog->id }}" hidden>
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
                            <h5>Blog Not Added Yet</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $blogs->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-blog') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-outline mb-4">
                                <input placeholder="Enter Title" class="form-control" id="title" name="title"
                                    required />
                            </div>
                            <div class="form-outline mb-4">
                                <input placeholder="Enter Short Description" class="form-control" id="short"
                                    name="short" required />
                            </div>
                            <div class="form-outline mb-4">
                                <textarea placeholder="Type here" class="ckeditor form-control" rows="3" id="content" name="content"></textarea>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="file" class="form-control" id="media" name="media"
                                    accept="image/png, image/jpg, image/jpeg" required />
                            </div>
                            <div class="form-group mb-4">
                                <label for="tag_id" class="form-label">Categories</label>
                                <select id="blog_cat_id" name="blog_cat_id" class=" form-control" aria-label="Categories"
                                    required>
                                    <option hidden readonly>Select Blog Category</option>
                                    @foreach ($blog_categories as $blog_category)
                                        <option value="{{ $blog_category->id }}" @selected(old('blog_cat_id') == $blog_category->id)>
                                            {{ $blog_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="tag_id" class="form-label">Tags</label>
                                <select class="form-select" id="tag_id" name="tag_id[]" aria-label="Tags" multiple
                                    required>
                                    @foreach ($blog_tags as $blog_tag)
                                        <option value="{{ $blog_tag->id }}" @selected(old('tag_id') == $blog_tag->id)>
                                            {{ $blog_tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Blog</button>
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
                    url: "{{ route('admin.delete-blog') }}",
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
