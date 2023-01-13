@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Tests | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Test</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($tests) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Duration</th>
                                        <th>Is Show</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($tests as $test)
                                        <tr>
                                            <td>{{ $test->id }}</td>
                                            <td><a href="{{ url('/admin/test-sections/'.$test->id.'/'.$test->name ) }}">{{ $test->name }}</a></td>
                                            <td>{{ $test->description }}</td>
                                            <td>{{ $test->duration }} mints</td>
                                            <td>
                                                <div class="form-group mb-2">
                                                    <select id="test_{{ $test->id }}" class=" form-control"
                                                        onchange="change_status({{ $test->id }})">
                                                        <option value="Publish" @if ($test->is_show == 'Publish') selected @endif>Publish
                                                        </option>
                                                        <option value="Draft" @if ($test->is_show == 'Draft') selected @endif>Draft
                                                        </option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $test->id }}" onclick="delete_test({{ $test->id }})"><i class='bx bxs-trash' ></i></button>
                                                <button class="btn btn-danger" type="button" id="loading_btn_{{ $test->id }}" hidden>
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="container d-flex justify-content-center">
                            <h5>No Test Available</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $tests->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Test</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-test') }}" method="Post">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                    value="{{ old('name') }}" required>                                
                                <small class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Description" value="{{ old('description') }}" required></textarea>
                                <small class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Duration <small class="text-info">In
                                    minuts</small></label>
                                <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter Time"
                                    value="{{ old('duration') }}" min="0" required>                                
                                <small class="text-danger">
                                    @error('duration')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group mb-4">
                                <select id="is_show" name="is_show" class=" form-control" required>
                                    <option hidden readonly>Wanna Publish?</option>
                                    <option value="Publish" @if (old('is_show') == 'Publish') selected @endif>Publish
                                    </option>
                                    <option value="Draft" @if (old('is_show') == 'Draft') selected @endif>Draft
                                    </option>
                                </select>
                                <small class="text-danger">
                                    @error('is_show')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Test</button>
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
                    url: "{{ route('admin.publish-test') }}",
                    data: {
                        'id': id,
                        'status': $('#test_' + id + ' option:selected').val()
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
            function delete_test(id) {
                $.ajax({
                    url: "{{ route('admin.delete-test') }}",
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
