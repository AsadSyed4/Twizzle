@if (session()->get('LoggedIn'))
@extends('layouts.main')
@push('head')
<title>My Account | Twizzle</title>
@endpush
@php
    $user_data=array();
@endphp
@foreach ($user as $item)
    @php
        $user_data=$item;
    @endphp
@endforeach
@section('section')
<section>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mt-4 border rounded">
            <h2 class="text-center"><strong>My Profile</strong></h2>
            <form action="{{ url('/update') }}" method="POST">
                @csrf
                <div class="row g-0">
                    <div class="col-xl-6">
                        <div class="card-body p-md-5 text-black">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="f_name" name="f_name" class="form-control form-control-lg" placeholder="First name" value="{{ $user_data->f_name }}" />
                                        <small class="text-danger">
                                            @error('f_name')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="l_name" name="l_name" class="form-control form-control-lg" placeholder="Last name" value="{{ $user_data->l_name }}" />
                                        <small class="text-danger">
                                            @error('l_name')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="state" name="state" class="form-control form-control-lg" placeholder="State" value="{{ $user_data->state }}" />
                                        <small class="text-danger">
                                            @error('state')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="city" name="city" class="form-control form-control-lg" placeholder="City" value="{{ $user_data->city }}" />
                                        <small class="text-danger">
                                            @error('city')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="zip_code" name="zip_code" class="form-control form-control-lg" placeholder="Zip Code" value="{{ $user_data->zip }}" />
                                        <small class="text-danger">
                                            @error('zip_code')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="current_year" name="current_year" class="form-control form-control-lg" placeholder="Current Year" value="{{ $user_data->current_year }}" readonly />
                                        <small class="text-danger">
                                            @error('current_year')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="expected_graduation_date" name="expected_graduation_date" class="form-control form-control-lg" onfocus="(this.type='date')" placeholder="{{ $user_data->expected_graduation_date }}" value="{{ $user_data->expected_graduation_date }}" />
                                        <small class="text-danger">
                                            @error('expected_graduation_date')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="high_school_name" name="high_school_name" class="form-control form-control-lg" placeholder="High School Name" value="{{ $user_data->high_school_name }}" />
                                        <small class="text-danger">
                                            @error('high_school_name')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <select id="public_private" name="public_private" class="form-select form-control-lg form-control">
                                            <option value="Public" @if ($user_data->school_type == "Public")
                                                selected
                                            @endif>Public</option>
                                            <option value="Private" @if ($user_data->school_type == "Private")
                                                selected
                                            @endif>Private</option>
                                        </select>
                                        <small class="text-danger">
                                            @error('public_private')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="school_rank" name="school_rank" class="form-control form-control-lg" placeholder="School Rank" value="{{ $user_data->school_rank }}" />
                                        <small class="text-danger">
                                            @error('school_rank')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <select id="demographic" name="demographic" class="form-select form-control-lg form-control">
                                            <option hidden selected>Demographic</option>
                                            <option value="Male" @if ($user_data->gender == "Male")
                                                selected
                                            @endif>Male</option>
                                            <option value="Female" @if ($user_data->gender == "Female")
                                                selected
                                            @endif>Female</option>
                                            <option value="Prefer to not Say" @if ($user_data->gender == "Prefer to not say")
                                                selected
                                            @endif>Prefer to not Say</option>
                                        </select>
                                        <small class="text-danger">
                                            @error('demographic')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <select name="target_school" id="target_school" class="form-select form-control-lg form-control">
                                            <option hidden selected>Target Schools</option>
                                            <option value="ABC" @if ($user_data->target_school == "ABC")
                                                selected
                                            @endif>ABC</option>
                                            <option value="DEF" @if ($user_data->target_school == "DEF")
                                                selected
                                            @endif>DEF</option>
                                            <option value="GHI" @if ($user_data->target_school == "GHI")
                                                selected
                                            @endif>GHI</option>
                                        </select>
                                        <small class="text-danger">
                                            @error('target_school')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <select name="time_commitment" id="time_commitment" class="form-select form-control-lg form-control">
                                            <option hidden selected>Time commitment</option>
                                            <option value="hrs" @if ($user_data->time_commitment == "hrs")
                                                selected
                                            @endif>hrs</option>
                                            <option value="wk" @if ($user_data->time_commitment == "wk")
                                                selected
                                            @endif>wk</option>
                                        </select>
                                        <small class="text-danger">
                                            @error('time_commitment')
                                            {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card-body p-md-5 text-black">

                            <div class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username" value="{{ $user_data->username }}" readonly/>
                                <small class="text-danger">
                                    @error('username')
                                    {{ $message }}
                                    @enderror
                                    @if (!empty($errorUsername))
                                    {{ $errorUsername }}
                                    @endif
                                </small>
                            </div>


                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ $user_data->email }}" readonly/>
                                <small class="text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                    @if (!empty($errorEmail))
                                    {{ $errorEmail }}
                                    @endif
                                </small>
                            </div>
                            <input type="hidden" value="{{ $user_data->id }}" id="id" name="id"/>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success btn-lg ms-2">Update</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#current_year').val(new Date().getFullYear());
    });

</script>
@else
<script>
    window.location.href = "{{ url('/login') }}";

</script>
@endif

