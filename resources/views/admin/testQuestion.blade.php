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
                    <h5>Test</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class='bx bx-cross'></i>
                    </button>
                </div>
                @if (count($test_questions) > 0)
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th>Correct Option</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($test_questions as $test_question)
                                    <tr>
                                        <td>{{ $test_question->id }}</td>
                                        <td>{{ $test_question->question }}</td>
                                        <td>{{ $test_question->a }}</td>
                                        <td>{{ $test_question->b }}</td>
                                        <td>{{ $test_question->c }}</td>
                                        <td>{{ $test_question->d }}</td>
                                        <td>{{ $test_question->correct_option }}</td>
                                        <td>
                                            <button class="btn btn-danger" id="dlt_btn_{{ $test_question->id }}"
                                                onclick="delete_test_question({{ $test_question->id }})"><i class='bx bxs-trash' ></i></button>
                                            <button class="btn btn-danger" type="button" id="loading_btn_{{ $test_question->id }}" hidden>
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
                        <h5>Question Not Added Yet</h5>
                    </div>
                @endif
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{ $test_questions->render() }}
                </ul>
            </nav>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add-test-question') }}" method="Post">
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="question">Question</label>
                            <textarea class="form-control" id="question" name="question" placeholder="Enter Question" value="{{ old('question') }}" required></textarea>                        
                            <small class="text-danger">
                                @error('question')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="option_a">Option A</label>
                            <textarea class="form-control" id="option_a" name="option_a" placeholder="Enter Option A" value="{{ old('option_a') }}" required></textarea>                            
                            <small class="text-danger">
                                @error('option_a')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="option_b">Option B</label>
                            <textarea class="form-control" id="option_b" name="option_b" placeholder="Enter Option B" value="{{ old('option_b') }}" required></textarea>                            
                            <small class="text-danger">
                                @error('option_b')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="option_c">Option C</label>
                            <textarea class="form-control" id="option_c" name="option_c" placeholder="Enter Option C" value="{{ old('option_c') }}" required></textarea>                            
                            <small class="text-danger">
                                @error('option_c')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="option_d">Option D</label>
                            <textarea class="form-control" id="option_d" name="option_d" placeholder="Enter Option D" value="{{ old('option_d') }}" required></textarea>
                            <small class="text-danger">
                                @error('option_d')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="form-group mb-4">
                            <select id="correct_option" name="correct_option" class=" form-control" required>
                                <option hidden readonly>Select Correct Option</option>
                                <option value="a" @if (old('correct_option') == 'a') selected @endif>A
                                </option>
                                <option value="b" @if (old('correct_option') == 'a') selected @endif>B
                                </option>
                                <option value="c" @if (old('correct_option') == 'c') selected @endif>C
                                </option>
                                <option value="d" @if (old('correct_option') == 'd') selected @endif>D
                                </option>
                            </select>
                            <small class="text-danger">
                                @error('correct_option')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="test_id" value="{{ $test_id }}" />
                            <button type="submit" class="btn btn-primary btn-block mb-4">Add Question</button>    
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
                url: "{{ route('admin.delete-test-question') }}",
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
