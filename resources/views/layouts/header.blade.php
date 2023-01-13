<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('header')
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    <!--IZI TOAST-->
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
</head>
 
<body>
    @stack('body')
    <!-- ========================= Header ======================== -->
    <div class="header">
        <div class="container">
            <div class="header_inner">
                <div class="header_logo"><a href="{{ url('/') }}"><img src="{{ asset('front/images/Frame.png') }}"
                            alt=""></a></div>
                <div class="header_menu">
                    <ul>
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                        <li>
                            <a href="javascript:void(0)">About
                                <div class="icon_image">
                                    <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.37469 1.28125L6.71469 6.62125L12.0547 1.28125" stroke="#D4D4D4"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="drop_down">
                                <li><a href="{{ route('user.who-we-are') }}">Who we are</a></li>
                                <li><a href="{{ route('user.about') }}">About Us</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">gUIDES & tuTORIALS
                                <div class="icon_image">
                                    <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.37469 1.28125L6.71469 6.62125L12.0547 1.28125" stroke="#D4D4D4"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="drop_down">
                                <li><a href="{{ route('user.master-plan') }}">Master plan</a></li>
                                <li><a href="{{ route('user.videos') }}">Videos</a></li>
                                <li><a href="{{ route('user.blogs') }}">Blog posts</a></li>
                                <li><a href="{{ route('user.guide-and-tutorial-test') }}">Test Do's & Dont's</a></li>
                                <li><a href="{{ route('user.tests') }}">Test timers</a></li>
                            </ul>
                        </li>                        
                        <li>
                            <a href="javascript:void(0)">pLANNING
                            <div class="icon_image">
                                    <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.37469 1.28125L6.71469 6.62125L12.0547 1.28125" stroke="#D4D4D4"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="drop_down">
                                <li><a href="{{ route('user.planner-how-it-works') }}">how it works</a></li>
                                <li><a href="{{ route('user.planner-grade') }}">Progress Report</a></li>
                                <li><a href="{{ route('user.planning') }}">Activity Planner</a></li>                                
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Essay Grading
                            <div class="icon_image">
                                    <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.37469 1.28125L6.71469 6.62125L12.0547 1.28125" stroke="#D4D4D4"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="drop_down">
                                <li><a href="{{ route('user.evalations') }}">Evolutions</a></li>
                                <li><a href="{{ route('user.essay-grading') }}">Grading Packages</a></li>
                                <li><a href="{{ route('user.journal') }}">Essay journal</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('calendar.index') }}">calendar</a></li>                        
                        <li>
                            <a href="javascript:void(0)">cOMMUNITY
                            <div class="icon_image">
                                    <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.37469 1.28125L6.71469 6.62125L12.0547 1.28125" stroke="#D4D4D4"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="drop_down">
                                <li><a href="{{ route('user.community') }}">cOMMUNITY</a></li>
                                <li><a href="{{ route('user.faqs-guide-and-tutorial') }}">FAQs</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="login_btn">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                    <span>
                        @if (!session()->get('LoggedIn'))
                            <!-- <div class="login_btn"> -->
                                <a class="login" href="javascript:void(0)">Login</a>
                                <a class="signup" href="{{ url('/signup') }}">Sign up</a>
                            <!-- </div> -->
                        @else
                            <!-- <div class="login_btn"> -->
                                <a class="login" href="{{ route('user.profile') }}">My Account</a>
                            <!-- </div> -->
                        @endif
                    </span>
                </div>



                
            </div>
        </div>
    </div>
