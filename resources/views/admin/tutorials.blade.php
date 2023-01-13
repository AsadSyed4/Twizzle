@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Tutorials | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Tutorials</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($videos) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Thumbnail</th>
                                        <th>Category</th>
                                        <th>Is Show</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $video->title }}</td>
                                            <td>{{ $video->link }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/'.$video->thumbnail) }}" class="img-fluid img-thumbnail"/>
                                            </td>
                                            <td>{{ $video->tutorials_categories->name }}</td>
                                            <td>
                                                <div class="form-group mb-2">
                                                    <select id="video_{{ $video->id }}" name="is_show"
                                                        class=" form-control" onchange="change_status({{ $video->id }})">
                                                        <option value="Show"
                                                            @if ($video->is_show == 'Show') selected @endif>Show
                                                        </option>
                                                        <option value="Hide"
                                                            @if ($video->is_show == 'Hide') selected @endif>Hide
                                                        </option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $video->id }}"
                                                    onclick="delete_video({{ $video->id }})"><i class='bx bxs-trash'></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $video->id }}" hidden>
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="container d-flex justify-content-center">
                            <h5>No Tutorial Available</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $videos->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Tutorial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-tutorial') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="title">Tutorial Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title" value="{{ old('title') }}" required>
                                <small class="text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="link">Tutorial Link</label>
                                <input type="text" class="form-control" id="link" name="link"
                                    value="{{ old('link') }}" placeholder="Enter Link" required>
                                <small class="text-danger">
                                    @error('link')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group mb-4">
                                <select id="video_cat_id" name="video_cat_id" class=" form-control" required>
                                    <option value="" hidden readonly>Select Tutorial Category</option>
                                    @foreach ($video_categories as $video_category)
                                        <option value="{{ $video_category->id }}"
                                            @if (old('video_cat_id') == $video_category->id) selected @endif>
                                            {{ $video_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <select id="is_show" name="is_show" class="form-control" required>
                                    <option value="Show" @if (old('is_show') == 'Show') selected @endif>Show
                                    </option>
                                    <option value="Show" @if (old('is_show') == 'Hide') selected @endif>Hide
                                    </option>
                                </select>
                                <small class="text-danger">
                                    @error('is_show')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group mb-4"> 
                                <label class="form-label" for="thumbnail">Thumbnail</label> 
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/png, image/jpg, image/jpeg" required>                              
                                <small class="text-danger">
                                    @error('thumbnail')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-2" type="submit">Add Tutorial</button>
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

            function change_status(id) {
                $.ajax({
                    url: "{{ route('admin.show-tutorial') }}",
                    data: {
                        'id': id,
                        'is_show': $('#video_' + id + ' option:selected').val()
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data.success) {
                            iziToast.success({
                                position: 'topRight',
                                message: data.message,
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

            function delete_video(id) {
                $.ajax({
                    url: "{{ route('admin.delete-tutorial') }}",
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
