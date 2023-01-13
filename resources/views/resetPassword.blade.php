@extends('layouts.main')
@push('header')
    <title>Rest Password | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('section')
    <div class="sign_up">
        <div class="container">
            <div class="sign_up_inner">
                <h1 class="h1heading">Reset Password</h1>
                <form action="{{ route('user.password-reset-post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">                    
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
                    <div class="field">
                        <span>
                            <div style="display: flex">
                                <label for="password">Password</label>
                                <small class="text-danger" id='password_error'>
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <input id="password" name="password" type="password" placeholder="Enter password"
                                onkeyup="check_password()" required>
                        </span>
                        <span>
                            <label for="password_confirmation">Confirm password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                placeholder="Confirm your password" required>
                        </span>
                    </div>
                    <button class="planner_btn">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script>
        function check_password() {
            var text = $('#password').val();
            if (text.length > 7) {
                var check = isPassword(text);
                if (check) {
                    $('#password_error').text('');
                } else {
                    $('#password_error').text('Use Letter,Number And Speacial Character');
                }
            } else {
                $('#password_error').text('Password Must be 8 Letters');
            }
        }

        function isPassword(str) {
            return /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(str);
        }
    </script>
@endpush
