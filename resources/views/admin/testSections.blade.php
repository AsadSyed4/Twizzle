@extends('admin.layouts.main')
@push('header')
    <title>{{ $test_name }} | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('section')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between">
                    <h5>Sections</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class='bx bx-cross'></i>
                    </button>
                </div>
                @if (count($test_sections) > 0)
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($test_sections as $test_section)
                                    <tr>
                                        <td>{{ $test_section->id }}</td>
                                        <td>{{ $test_section->name }}</td>
                                        <td>{{ $test_section->duration }} mints</td>
                                        <td>
                                            <button class="btn btn-danger" id="dlt_btn_{{ $test_section->id }}"
                                                onclick="delete_test_question({{ $test_section->id }})"><i class='bx bxs-trash' ></i></button>
                                            <button class="btn btn-danger" type="button" id="loading_btn_{{ $test_section->id }}" hidden>
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
                        <h5>Section Not Added Yet</h5>
                    </div>
                @endif
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{ $test_sections->render() }}
                </ul>
            </nav>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add-section') }}" method="Post">
                        @csrf
                        <div class="form-outline mb-4">                            
                            <input class="form-control" id="name" name="name" placeholder="Enter Section Name" value="{{ old('name') }}" required/>
                            <small class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-outline mb-4">                            
                            <input class="form-control" id="duration" name="duration" placeholder="Enter Duration (in mints)" value="{{ old('duration') }}" required/>
                            <small class="text-danger">
                                @error('duration')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="test_id" value="{{ $test_id }}" />
                            <button type="submit" class="btn btn-primary btn-block mb-4">Add Section</button>    
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
        function delete_test_question(id) {
            $.ajax({
                url: "{{ route('admin.delete-section') }}",
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
