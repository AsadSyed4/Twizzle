@extends('layouts.main')
@push('header')
    <title>Evaluations | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@endpush
@section('section')
    <div class="profile">
        <div class="container">
            <div class="profile_inner">
                <div class="profile_details">
                    <h1>my pROFILE</h1>
                    <a href="{{ route('user.profile') }}">Edit</a>
                    <a href="{{ route('user.payment-history') }}">pAYMENTs</a>
                    <a class="link_class" href="{{ route('user.evalations') }}">Evaluations</a>
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
