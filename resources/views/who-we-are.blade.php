@extends('layouts.main')
@push('header')
<title>Who We Are | Twizzle</title>
<style>
    .about_us_heading.about_us_heading_s {
        background: url(/public/front/images//Group\ 1047.png) no-repeat center center;
        background-size: contain;
    }
    .about_us_main_inner .box h1,
    .about_us_main_inner .box h1 span {
        text-transform: uppercase !important;
    }
</style>
@endpush
@section('section')
<!-- ========================== Who We Are ================== -->
<div class="about_us_heading about_us_heading_s">
    <div class="container">
        <div class="about_us_heading_inner">
            <h1>Who We Are</h1>
        </div>
    </div>
</div>
<!-- ===========================  ======================== -->
<div class="about_us_main">
    <div class="container">
        <div class="about_us_main_inner">
            <div class="box">
                <div class="heading">
                    <h1>
                        Simple & <br>
                        streamlined
                    </h1>
                </div>
                <div class="content">
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                    </div>
                    <p>
                    This is what we think college admissions prep should be. Applying for college has become way too complex, with too many steps required and not enough support. We believe all high school students who want to go to college should have the right guidance and tools to make that a reality.  
                    </p>
                </div>
            </div>
            <div class="box">
                <div class="heading">
                    <h1>
                        <span>Twizzle</span>
                        ahead
                    </h1>
                </div>
                <div class="content">
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                    </div>
                    <p>
                    That’s why we’ve stripped everything down to the essentials. Instead of flooding our pages with information, we’ve kept things to the point. Our lectures and grading offer tips that can be applied directly to your essays. Our planning tools are easy to use and keep you up to date wherever you go. And you also have a community to share with along the way. Helping you advance with ease – that is our goal.
                    </p>
                </div>
            </div>
            <div class="box">
                <div class="heading">
                    <h1>
                        We are…
                    </h1>
                </div>
                <div class="content">
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                    </div>
                    <p>
                    A team of college admissions experts, who are on a mission to transform the college admissions experience. Having taught over xxx students in the past xx years, we have a track record of getting xx percent of our students into top-tier schools. We understand how the requirements of each school are nuanced and unique, and we know how to help students discover their strengths and be their unique selves in order to stand out from the crowd.
                    </p>
                </div>
            </div>
            <div class="clear_both"></div>
        </div>
    </div>
</div>
@endsection
@push('footer')
@endpush