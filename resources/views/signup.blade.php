@if (!session()->get('LoggedIn'))
    @extends('layouts.main')
    @push('header')
        <title>Sign Up | Twizzle</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    @section('section')
        <div class="sign_up">
            <div class="container">
                <div class="sign_up_inner">
                    <h1 class="h1heading">Sign up</h1>
                    <form action="{{ url('/signup') }}" method="POST">
                        @csrf
                        <div id="basic">
                            <div class="field">
                                <span>
                                    <div style="display: flex">
                                        <label for="first_name">First name</label>
                                        <small class="text-danger">
                                            @error('first_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <input id="first_name" name="first_name" value="{{ old('first_name') }}" type="text"
                                        placeholder="Enter your first name" required>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="last_name">Last name</label>
                                        <small class="text-danger">
                                            @error('last_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <input id="last_name" name="last_name" value="{{ old('last_name') }}" type="text"
                                        placeholder="Enter your last name" required>
                                </span>
                            </div>
                            <div class="field">
                                <span>
                                    <div style="display: flex">
                                        <label for="username">Username</label>
                                        <small class="text-danger" id="username_error">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <input id="username" name="username" value="{{ old('username') }}" type="text"
                                        placeholder="Enter your unique username" onkeyup="check_username()" required>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="email">Email</label>
                                        <small class="text-danger" id="email_error">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <input id="email" name="email" value="{{ old('email') }}" type="text"
                                        placeholder="Enter your email address" onkeyup="check_email()" required>
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
                            <button class="planner_btn" onclick="next()">Next</button>
                        </div>
                        <div id="detail" hidden>
                            <div class="field three_fields">
                                <span>
                                    <div style="display: flex">
                                        <label for="state">State</label>
                                        <small class="text-danger">
                                            @error('state')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="select">
                                        <select name="state" id="state" required>
                                            <option value="" selected hidden>Select</option>
                                            <option value="Punjab" @selected(old('state') == 'Punjab')>Punjab</option>
                                            <option value="KPK" @selected(old('state') == 'KPK')>KPK</option>
                                            <option value="Sindh" @selected(old('state') == 'Sindh')>Sindh</option>
                                            <option value="Balochistan" @selected(old('state') == 'Balochistan')>Balochistan</option>
                                        </select>
                                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                                    </div>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="city">City</label>
                                        <small class="text-danger">
                                            @error('city')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <input id="city" name="city" type="text" value="{{ old('city') }}"
                                        placeholder="Enter city" required>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="zip_code">Zip code</label>
                                        <small class="text-danger">
                                            @error('zip_code')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <input id="zip_code" name="zip_code" type="text" value="{{ old('zip_code') }}"
                                        placeholder="Enter zip code" required>
                                </span>
                            </div>
                            <div class="field">
                                <span>
                                    <div style="display: flex">
                                        <label for="current_year">Current Year</label>
                                        <small class="text-danger">
                                            @error('current_year')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="select">
                                        <select name="current_year" id="current_year" required>
                                            <option value="" selected hidden>Select</option>
                                            <option value="Freshman" @selected(old('current_year') == 'Freshman')>Freshman</option>
                                            <option value="Sophomore" @selected(old('current_year') == 'Sophomore')>Sophomore</option>
                                            <option value="Junior" @selected(old('current_year') == 'Junior')>Junior</option>
                                            <option value="Senior" @selected(old('current_year') == 'Senior')>Senior</option>
                                            <option value="Other" @selected(old('current_year') == 'Other')>Other</option>
                                        </select>
                                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                                    </div>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="expected_graduation_date">Expected graduation date</label>
                                        <small class="text-danger">
                                            @error('expected_graduation_date')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="select">
                                        <input id="expected_graduation_date" name="expected_graduation_date"
                                            type="date" value="{{ old('expected_graduation_date') }}"
                                            placeholder="dd/mm/yyyy" required>
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <span>
                                    <div style="display: flex">
                                        <label for="high_school_name">High school</label>
                                        <small class="text-danger">
                                            @error('high_school_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <input id="high_school_name" name="high_school_name" type="text"
                                        placeholder="Enter your high school name" value="{{ old('high_school_name') }}"
                                        required>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="public_private">School Type</label>
                                        <small class="text-danger">
                                            @error('public_private')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="select">
                                        <select name="public_private" id="public_private" required>
                                            <option value="" selected hidden>Select</option>
                                            <option value="Private" @selected(old('public_private') == 'Private')>Private</option>
                                            <option value="Public" @selected(old('public_private') == 'Public')>Public</option>
                                            <option value="Other" @selected(old('public_private') == 'Other')>Other</option>
                                        </select>
                                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <span>
                                    <label for="school_rank">School ranking <h3>(optional)</h3></label>
                                    <div class="select">
                                        <select name="school_rank" id="school_rank" required>
                                            <option value="" selected hidden>Select</option>
                                            <option value="1st" @selected(old('school_rank') == '1st')>1<sup>st</sup> Quartile
                                            </option>
                                            <option value="2nd" @selected(old('school_rank') == '2nd')>2<sup>nd</sup> Quartile
                                            </option>
                                            <option value="3rd" @selected(old('school_rank') == '3rd')>3<sup>rd</sup> Quartile
                                            </option>
                                            <option value="4th" @selected(old('school_rank') == '4th')>4<sup>th</sup> Quartile
                                            </option>
                                        </select>
                                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                                    </div>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="demographic">Demographic</label>
                                        <small class="text-danger">
                                            @error('demographic')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="select">
                                        <select name="demographic" id="demographic" required>
                                            <option value="" selected hidden>Select</option>
                                            <option value="Male" @selected(old('demographic') == 'Male')>Male</option>
                                            <option value="Female" @selected(old('demographic') == 'Female')>Female</option>
                                            <option value="Rather Not Say" @selected(old('demographic') == 'Rather Not Say')>Rather Not Say
                                            </option>
                                        </select>
                                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <span>
                                    <div style="display: flex">
                                        <label for="target_school">Target school</label>
                                        <small class="text-danger">
                                            @error('target_school')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="select">
                                        <select name="target_school" id="target_school" required>
                                            <option value="" selected hidden>Select</option>
                                            <option value="Elite (Tier 1)" @selected(old('target_school') == 'Elite (Tier 1)')>Elite (Tier 1)
                                            </option>
                                            <option value="Compitative (Tiers 2-4)" @selected(old('target_school') == 'Compitative (Tiers 2-4)')>
                                                Compitative (Tiers 2-4)</option>
                                            <option value="Regular" @selected(old('target_school') == 'Regular')>Regular</option>
                                            <option value="Other" @selected(old('target_school') == 'Other')>Other</option>
                                        </select>
                                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                                    </div>
                                </span>
                                <span>
                                    <div style="display: flex">
                                        <label for="time_commitment">Time commitment</label>
                                        <small class="text-danger">
                                            @error('time_commitment')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="select">
                                        <select name="time_commitment" id="time_commitment" required>
                                            <option value="" selected hidden>Select</option>
                                            <option value="1-3 hours" @selected(old('time_commitment') == '1-3 hours')>1-3 hours</option>
                                            <option value="4-10 hours" @selected(old('time_commitment') == '4-10 hours')>4-10 hours</option>
                                            <option value="11-20 hours" @selected(old('time_commitment') == '11-20 hours')>11-20 hours</option>
                                            <option value="20+ hours" @selected(old('time_commitment') == '20+ hours')>20+ hours</option>
                                        </select>
                                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                                    </div>
                                </span>
                            </div>
                            <button class="planner_btn">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            function next() {
                var f_name = $('#first_name').val();
                var l_name = $('#last_name').val();
                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();
                if (f_name.length !== 0 && l_name.length !== 0 && username.length !== 0 && email.length !== 0 && password
                    .length !== 0 && password_confirmation.length !== 0) {
                    $('#basic').attr('hidden', true);
                    $('#detail').removeAttr('hidden');
                }else{
                    iziToast.error({
                            position: 'topRight',
                            message: 'All fields are required.',
                        });
                }
            }

            function check_username() {
                var text = $('#username').val();
                var replaced = text.replace(/[^a-z0-9]/gi, '');
                $('#username').val(replaced);
                var check = lettersNumbersSpacesDashes(replaced);
                if (check) {
                    $('#username_error').text('');
                    $.ajax({
                        url: "{{ route('user.check-username') }}",
                        data: {
                            'text': text,
                            '_token': '{{ csrf_token() }}'
                        },
                        type: 'POST',
                        success: function(data) {
                            if (data.success) {
                                $('#username_error').text('');
                            } else {
                                $('#username_error').text('Username Already Exist.');
                            }
                        }
                    });
                } else {
                    $('#username_error').text('Use Numbers And Letters Only.');
                }
            }

            function check_email() {
                var text = $('#email').val();
                var check = isEmail(text);
                if (check) {
                    $('#email_error').text('');
                    $.ajax({
                        url: "{{ route('user.check-email') }}",
                        data: {
                            'text': text,
                            '_token': '{{ csrf_token() }}'
                        },
                        type: 'POST',
                        success: function(data) {
                            if (data.success) {
                                $('#email_error').text('');
                            } else {
                                $('#email_error').text('Email Already Exist.');
                            }
                        }
                    });
                } else {
                    $('#email_error').text('Email is not Valid.');
                }
            }

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

            function lettersNumbersSpacesDashes(str) {
                return /^[A-Za-z0-9 -]*$/.test(str);
            }

            function isEmail(str) {
                return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    .test(str);
            }

            function isPassword(str) {
                return /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(str);
            }

            function valid_email(email) {
                const settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "https://email-checker.p.rapidapi.com/verify/v1?email=" + email,
                    "method": "GET",
                    "headers": {
                        "X-RapidAPI-Key": "a865f42c9fmshc1bb947a00091bbp11eb74jsn3edf779d3696",
                        "X-RapidAPI-Host": "email-checker.p.rapidapi.com"
                    }
                };

                $.ajax(settings).done(function(response) {
                    return true
                });
            }
        </script>
    @endpush
@else
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif
