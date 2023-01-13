@if (session()->get('LoggedIn'))
    @extends('layouts.main')
    @push('header')
        <title>Ask a Question | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @section('section')
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center mt-2 border rounded">
                <h2 class="text-warning text-center mt-2"><strong>Ask A Question From Community</strong></h2>
                <form id="ask_form" action="{{ url('/ask') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-md-2 text-black">

                        <div class="form-outline mb-3">
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required/>
                            <label class="form-label" for="title">Question Title</label>
                            <small class="text-danger">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-outline mb-3">
                            <textarea id="description" name="description" class="form-control" required></textarea>
                            <label class="form-label" for="description">Question Description</label>
                            <small class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <select id="question_type" name="question_type" class=" form-control" required>
                                <option readonly hidden>Select Question Type</option>
                                @foreach ($question_types as $question_type)
                                    <option value="{{ $question_type->id }}">{{ $question_type->question_type }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">
                                @error('question_type')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="file" class="form-control" name="question_media" id="question_media"
                                placeholder="Upload Eassy" accept=".png,.jpg">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-block mb-3">Submit For Answers</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    @endsection

@else
    <script>
        window.location.href = "{{ url('/login') }}";
    </script>
@endif
