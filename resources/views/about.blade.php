@extends('layouts.main')
@push('header')
<title>About Us | Twizzle</title>
@endpush
@section('section')
<!-- ========================== MIssions Values ================== -->
<style>
    .about_us_heading {
        background: url(/public/front/images//Group\ 1048.png) no-repeat center center;
        background-size: contain;
    }
</style>
<div class="about_us_heading">
    <div class="container">
        <div class="about_us_heading_inner">
            <h1>Mission & values</h1>
        </div>
    </div>
</div>
<!-- =========================== Missions ======================== -->
<div class="about_us_mission">
    <div class="container">
        <div class="about_us_mission_inner">
            <div class="heading">
                <h1>OUR <br> MISSION</h1>
            </div>
            <div class="content">
                <div class="bottom_style">
                    <span class="black_bg"></span>
                    <span class="white_bg"></span>
                </div>
                <p>
                    Our mission is to eliminate barriers and empower students to take control of their future
                    through college admissions planning.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- =========================== Valuse ======================== -->
<div class="about_us_values">
    <div class="container">
        <div class="about_us_values_inner">
            <div class="heading">
                <h1>Our Values</h1>
            </div>
            <style>
                .about_us_values .box .left_side .image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            </style>
            <div class="content">
                <div class="box">
                    <div class="left_side">
                        <div class="image">
                            <img src="/public/front/images/abimage1.png" alt="">
                        </div>
                    </div>
                    <div class="right_side">
                        <h1>Excellence</h1>
                        <p>
                            We are unwavering in our commitment to providing the best service possible.
                        </p>
                    </div>
                    <span class="border_style"></span>
                </div>
                <div class="box">
                    <div class="left_side">
                        <div class="image">
                            <img src="/public/front/images/abimage2.png" alt="">
                        </div>
                    </div>
                    <div class="right_side">
                        <h1>Innovation</h1>
                        <p>
                            We always look to reinvent what we do and are fearless in our approach.
                        </p>
                    </div>
                    <span class="border_style"></span>
                </div>
                <div class="box">
                    <div class="left_side">
                        <div class="image">
                            <img src="/public/front/images/abimage3.png" alt="">
                        </div>
                    </div>
                    <div class="right_side">
                        <h1>Passion</h1>
                        <p>
                            We approach every task with enthusiasm and positivity.
                        </p>
                    </div>
                    <span class="border_style"></span>
                </div>
                <div class="box">
                    <div class="left_side">
                        <div class="image">
                            <img src="/public/front/images/abimage4.png" alt="">
                        </div>
                    </div>
                    <div class="right_side">
                        <h1>Openness</h1>
                        <p>
                            We believe in the power of listening and think before we act.
                        </p>
                    </div>
                    <span class="border_style"></span>
                </div>
                <div class="box">
                    <div class="left_side">
                        <div class="image">
                            <img src="/public/front/images/abimage5.png" alt="">
                        </div>
                    </div>
                    <div class="right_side">
                        <h1>Equality</h1>
                        <p>
                            We respect everyone for who they are regardless of their background.
                        </p>
                    </div>
                    <span class="border_style"></span>
                </div>
                <div class="clear_both"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer')
@endpush