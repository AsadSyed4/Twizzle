@extends('layouts.main')
@push('header')
    <title>Forget Password | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
@endpush
@section('section')
    <div class="sign_up">
        <div class="container">
            <div class="sign_up_inner">
                <h1 class="h1heading">Reset Password</h1>
                <form action="{{ route('user.password-post') }}" method="POST">
                    @csrf
                    <div style="justify-content: center;margin-top: -5%;margin-bottom: 3%">
                        <p><i class="fa fa-info-circle" style="margin-right: 10px"></i> <b>Please enter your email and we’ll send you a link to reset your password.</b></p>
                    </div>
                    <div class="field" style="justify-content: center;">
                        <span>
                            <div style="display: flex">
                                <label for="email">Email</label>
                                <small class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <input id="email" name="email" value="{{ old('email') }}" type="text"
                                placeholder="Enter your email address" required>
                        </span>
                    </div>
                    <button class="planner_btn">Send Link</button>
                </form>
            </div>
        </div>
    </div>
@endsection
