@extends('layouts.main')
@push('header')
    <title>Profile | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@endpush
@section('section')
    <div class="profile">
        <div class="container">
            <div class="profile_inner">
                <div class="profile_image">
                    <div class="image">
                        <img id="uploadPreview" src="{{ asset('uploads/' . $user->user_profile->media) }}"
                            onerror="this.src='{{ asset('front/images/profileimage.jpg') }}'" />
                    </div>
                    <h1>{{ $user->user_profile->f_name }} {{ $user->user_profile->l_name }}</h1>
                    <p><i class="fa-solid fa-envelope"></i> {{ $user->email }}</p>
                    <form action="{{ route('user.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="uploadImage">
                            Change Image
                            <input id="uploadImage" type="file" name="myPhoto" onchange="PreviewImage();" />
                        </label>
                        <button type="submit"class="update_btn">Update</button>
                    </form>
                    <div class="login_btn" style="justify-content: center;margin-top: 10px;">
                        <a href="{{ route('user.logout') }}" class="signup"> Logout</a>
                    </div>
                </div>
                <div class="profile_details">
                    <h1>my pROFILE</h1>
                    <a href="{{ route('user.edit-profile') }}">Edit</a>
                    <a href="{{ route('user.payment-history') }}">pAYMENTs</a>
                    <a href="{{ route('user.evalations') }}">Evaluations</a>
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                    </div>
                    <div class="bg_image"><img src="{{ asset('front/images/Vector 1.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
@endpush
