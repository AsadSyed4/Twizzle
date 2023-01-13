@extends('layouts.main')
@push('head')
    <title>Sign In | Twizzle</title>
@endpush
@section('section')
    <div class="mt-5"> </div>
    <main class="form-signin shadow mx-auto p-4">
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <h2 class="text-center">Twizzel</h2>
            <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>

            <div class="form-outline mb-4">
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                <label class="form-label" for="email">Email Address</label>
                <small class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </small>
            </div>
            <div class="form-outline mb-4">
                <input type="password" class="form-control" id="password" name="password" required>
                <label class="form-label" for="password">Password</label>
            </div>

            <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="remember-me" id="form4Example4" checked />
                <label class="form-check-label" for="form4Example4">
                    Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
        </form>

        @if (!empty($error))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @php
                            notify($error, '', 'error', 'topRight');
                        @endphp
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
