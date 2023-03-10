<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin/assets') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    @stack('header')

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
    <!--IZI TOAST-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('admin.index') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <path
                                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                        id="path-1"></path>
                                    <path
                                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                        id="path-3"></path>
                                    <path
                                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                        id="path-4"></path>
                                    <path
                                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                        id="path-5"></path>
                                </defs>
                                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                <mask id="mask-2" fill="white">
                                                    <use xlink:href="#path-1"></use>
                                                </mask>
                                                <use fill="#696cff" xlink:href="#path-1"></use>
                                                <g id="Path-3" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-3"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                                </g>
                                                <g id="Path-4" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-4"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                                </g>
                                            </g>
                                            <g id="Triangle"
                                                transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                                <use fill="#696cff" xlink:href="#path-5"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">Twizzle</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>
                @if (session()->has('admin'))
                    <ul class="menu-inner py-1">
                        @if (in_array('1', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                                @if ($active == 'index') active @endif">
                                <a href="{{ route('admin.index') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                    <div data-i18n="Analytics">Dashboard</div>
                                </a>
                            </li>
                        @endif

                        @if (in_array('2', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                            @if ($active == 'user') active @endif">
                                <a href="{{ route('admin.users') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                                    <div data-i18n="Analytics">Users</div>
                                </a>
                            </li>
                        @endif

                        @if (in_array('3', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                            @if ($active == 'eassy') active @endif">
                                <a href="{{ route('admin.eassy') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bxs-file"></i>
                                    <div data-i18n="Analytics">Eassy</div>
                                </a>
                            </li>
                        @endif

                        @if (in_array('4', session()->get('admin.allow')))
                            <li class="menu-item @if ($active == 'tutorial category' || $active == 'tutorial' ) active @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bxs-videos"></i>
                                    <div data-i18n="Layouts">Tutorials</div>
                                </a>

                                <ul class="menu-sub" @if ($active == 'tutorial category' || $active == 'tutorial' ) style="display: block" @endif>
                                    <li class="menu-item @if ($active == 'tutorial category') active @endif">
                                        <a href="{{ route('admin.tutorials-categories') }}" class="menu-link">
                                            <div data-i18n="Without menu">Categories</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($active == 'tutorial') active @endif">
                                        <a href="{{ route('admin.tutorials') }}" class="menu-link">
                                            <div data-i18n="Without menu">Videos</div>
                                        </a>
                                    </li>                                    
                                </ul>
                            </li>
                        @endif

                        @if (in_array('5', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                            @if ($active == 'package') active @endif">
                                <a href="{{ route('admin.package') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-package"></i>
                                    <div data-i18n="Analytics">Packages</div>
                                </a>
                            </li>
                        @endif

                        {{-- <li class="menu-item 
                        @if ($active == 'test') active @endif">
                            <a href="{{ route('admin.tests') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-test-tube"></i>
                                <div data-i18n="Analytics">Tests</div>
                            </a>
                        </li> --}}

                        @if (in_array('6', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                            @if ($active == 'community') active @endif">
                                <a href="{{ route('admin.community-questions') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-group"></i>
                                    <div data-i18n="Analytics">Community</div>
                                </a>
                            </li>
                        @endif

                        @if (in_array('7', session()->get('admin.allow')))
                            <li class="menu-item @if ($active == 'cm category' || $active == 'cm sub category' || $active == 'cm') active @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-error-alt"></i>
                                    <div data-i18n="Layouts">Common Mistakes</div>
                                </a>

                                <ul class="menu-sub" @if ($active == 'cm category' || $active == 'cm sub category' || $active == 'cm') style="display: block" @endif>
                                    <li class="menu-item @if ($active == 'cm category') active @endif">
                                        <a href="{{ route('admin.cm-category') }}" class="menu-link">
                                            <div data-i18n="Without menu">CM Categories</div>
                                        </a>
                                    </li>
                                    {{-- <li class="menu-item @if ($active == 'cm sub category') active @endif">
                                        <a href="{{ route('admin.cm-sub-category') }}" class="menu-link">
                                            <div data-i18n="Without menu">CM Sub Categories</div>
                                        </a>
                                    </li> --}}
                                    <li class="menu-item @if ($active == 'cm') active @endif">
                                        <a href="{{ route('admin.common-mistakes') }}" class="menu-link">
                                            <div data-i18n="Without menu">Common Mistakes</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (in_array('8', session()->get('admin.allow')))
                            <li class="menu-item @if ($active == 'tip category' || $active == 'tip sub category' || $active == 'tip') active @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-chalkboard"></i>
                                    <div data-i18n="Layouts">TIPS</div>
                                </a>

                                <ul class="menu-sub" @if ($active == 'tip category' || $active == 'tip sub category' || $active == 'tip') style="display: block" @endif>
                                    <li class="menu-item @if ($active == 'tip category') active @endif">
                                        <a href="{{ route('admin.tips-category') }}" class="menu-link">
                                            <div data-i18n="Without menu">TIPS Categories</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($active == 'tip sub category') active @endif">
                                        <a href="{{ route('admin.tips-sub-category') }}" class="menu-link">
                                            <div data-i18n="Without menu">TIPS Sub Categories</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($active == 'tip') active @endif">
                                        <a href="{{ route('admin.tips') }}" class="menu-link">
                                            <div data-i18n="Without menu">TIPS</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (in_array('9', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                            @if ($active == 'admin') active @endif">
                                <a href="{{ route('admin.admins') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                                    <div data-i18n="Analytics">Admins</div>
                                </a>
                            </li>
                        @endif

                        @if (in_array('10', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                            @if ($active == 'withdraw_g') active @endif">
                                <a href="{{ route('admin.withdraw-requests-g') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                                    <div data-i18n="Analytics">Withdraw Request</div>
                                </a>
                            </li>
                        @endif

                        @if (in_array('11', session()->get('admin.allow')))
                            <li
                                class="menu-item 
                            @if ($active == 'withdraw_a') active @endif">
                                <a href="{{ route('admin.withdraw-requests-a') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                                    <div data-i18n="Analytics">Withdraw Request</div>
                                </a>
                            </li>
                        @endif

                        @if (in_array('12', session()->get('admin.allow')))
                            <li class="menu-item @if ($active == 'event category' || $active == 'event') active @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                                    <div data-i18n="Layouts">Calendar</div>
                                </a>

                                <ul class="menu-sub" @if ($active == 'event category' || $active == 'event') style="display: block" @endif>
                                    <li class="menu-item @if ($active == 'event category') active @endif">
                                        <a href="{{ route('admin.events-categories') }}" class="menu-link">
                                            <div data-i18n="Without menu">Events Categories</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($active == 'event') active @endif">
                                        <a href="{{ route('admin.events') }}" class="menu-link">
                                            <div data-i18n="Without menu">Events</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (in_array('13', session()->get('admin.allow')))
                            <li class="menu-item @if ($active == 'blog category' || $active == 'blog' || $active == 'tag') active @endif">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bxl-blogger"></i>
                                    <div data-i18n="Layouts">Blog</div>
                                </a>

                                <ul class="menu-sub" @if ($active == 'blog category' || $active == 'blog' || $active == 'tag') style="display: block" @endif>
                                    <li class="menu-item @if ($active == 'blog category') active @endif">
                                        <a href="{{ route('admin.blog-category') }}" class="menu-link">
                                            <div data-i18n="Without menu">Blog Categories</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($active == 'tag') active @endif">
                                        <a href="{{ route('admin.blog-tags') }}" class="menu-link">
                                            <div data-i18n="Without menu">Blog Tags</div>
                                        </a>
                                    </li>
                                    <li class="menu-item @if ($active == 'blog') active @endif">
                                        <a href="{{ route('admin.blogs') }}" class="menu-link">
                                            <div data-i18n="Without menu">Blogs</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                @endif
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none"
                                    placeholder="Search..." aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('/uploads/' . session()->get('admin.media')) }}" alt
                                            class="w-px-40 h-auto rounded-circle"
                                            onerror="this.onerror=null;this.src='{{ asset('admin/assets/img/avatars/error.png') }}'" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('/uploads/' . session()->get('admin.media')) }}"
                                                            alt class="w-px-40 h-auto rounded-circle"
                                                            onerror="this.onerror=null;this.src='{{ asset('admin/assets/img/avatars/error.png') }}'" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-semibold d-block">{{ session()->get('admin.f_name') }}
                                                        {{ session()->get('admin.l_name') }}</span>
                                                    <small
                                                        class="text-muted">@if (session()->get('admin.role')=="Super Admin")
                                                        <i class="fab fa-angular text-success fa-lg"></i>
                                                    @endif{{ session()->get('admin.role') }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
