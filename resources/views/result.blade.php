@if (session()->get('LoggedIn'))
    @extends('layouts.main')
    @push('head')
        <title>Result | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @section('section')
        <div class="container text-center mt-3 border rounded shadow">
            <h1 class="bg-warning rounded-top p-2 text-white" style="margin-left: -1.1%;margin-right: -1.1%;">Result</h1>
            <div class="p-2">
                <div class="d-flex justify-content-between">
                    <span class="h5">Username: <span class="text-warning">{{ session()->get('user_name') }}</span></span>
                    <span class="h5">Test: <span class="text-warning">{{ $test_name }}</span></span>
                </div>
                <div class="d-flex flex-column bd-highlight mb-3">
                    <span class="h5 text-warning">Total Marks:</span> <span class="h5">{{ $total_questions }}</span><br>
                    <span class="h5 text-warning">Scored Marks:</span> <span class="h5">{{ $scored_marks }}</span><br>
                    <span class="h5 text-warning">Attempted Questions:</span> <span
                        class="h5">{{ $attempted_questions }}</span>
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif
