@extends('layouts.main')
@push('header')
    <title>Edit Profile | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@endpush
@section('section')
    <div class="sign_up">
        <div class="container">
            <div class="sign_up_inner">
                <h1 class="h1heading">Edit Profile</h1>
                <form action="{{ route('user.update-profile') }}" method="POST">
                    @csrf
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
                            <input id="first_name" name="first_name" value="{{ $user->user_profile->f_name }}" type="text"
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
                            <input id="last_name" name="last_name" value="{{ $user->user_profile->l_name }}" type="text"
                                placeholder="Enter your last name" required>
                        </span>
                    </div>
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
                                    <option value="Punjab" @selected($user->user_profile->state == 'Punjab')>Punjab</option>
                                    <option value="KPK" @selected($user->user_profile->state == 'KPK')>KPK</option>
                                    <option value="Sindh" @selected($user->user_profile->state == 'Sindh')>Sindh</option>
                                    <option value="Balochistan" @selected($user->user_profile->state == 'Balochistan')>Balochistan</option>
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
                            <input id="city" name="city" type="text" value="{{ $user->user_profile->city }}"
                                placeholder="Enter city" required>
                        </span>
                        <span>
                            <div style="display: flex">
                                <label for="zip_code">Zip Code</label>
                                <small class="text-danger">
                                    @error('zip_code')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <input id="zip_code" name="zip_code" type="text" value="{{ $user->user_profile->zip }}"
                                placeholder="Enter zipcode" required>
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
                            <input id="current_year" name="current_year" type="year"
                                placeholder="Enter your current year" value="{{ $user->user_profile->current_year }}" required>
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
                                <input id="expected_graduation_date" name="expected_graduation_date" type="date"
                                    value="{{ formatted_date($user->user_profile->expected_graduation_date,"Y-m-d") }}" placeholder="dd/mm/yyyy" required>
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
                                placeholder="Enter your high school name" value="{{ $user->user_profile->high_school_name }}" required>
                        </span>
                        <span>
                            <div style="display: flex">
                                <label for="public_private">Public / private</label>
                                <small class="text-danger">
                                    @error('public_private')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="select">
                                <select name="public_private" id="public_private" required>
                                    <option value="" selected hidden>Select</option>
                                    <option value="Private" @selected($user->user_profile->school_type == 'Private')>Private</option>
                                    <option value="Public" @selected($user->user_profile->school_type == 'Public')>Public</option>
                                </select>
                                <i class="fa-sharp fa-solid fa-caret-down"></i>
                            </div>
                        </span>
                    </div>
                    <div class="field">
                        <span>
                            <label for="school_rank">School ranking <h3>(optional)</h3></label>
                            <input id="school_rank" name="school_rank" type="text" value="{{ $user->user_profile->school_rank }}"
                                placeholder="Enter your school ranking">
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
                                    <option value="Male" @selected($user->user_profile->gender == 'Male')>Male</option>
                                    <option value="Female" @selected($user->user_profile->gender == 'Female')>Female</option>
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
                                    <option value="ABC" @selected($user->user_profile->target_school == 'ABC')>ABC</option>
                                    <option value="DEF" @selected($user->user_profile->target_school == 'DEF')>DEF</option>
                                    <option value="GHI" @selected($user->user_profile->target_school == 'GHI')>GHI</option>
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
                                    <option value="hr" @selected($user->user_profile->time_commitment == 'hr')>hr</option>
                                    <option value="wk" @selected($user->user_profile->time_commitment == 'wk')>wk</option>
                                </select>
                                <i class="fa-sharp fa-solid fa-caret-down"></i>
                            </div>
                        </span>
                    </div>
                    <button class="planner_btn">Update</button>
                </form>

                <h1 class="h1heading" style="margin-top: 60px;">Change Password</h1>
                <form action="{{ route('user.update-password') }}" method="POST">
                    @csrf
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
                    <button class="planner_btn">Update Password</button>
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
