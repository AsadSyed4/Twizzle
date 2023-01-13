@extends('layouts.main')
@push('header')
<title>Home | Twizzle</title>
@endpush
@section('section')
<!-- ========================= Section One ======================== -->
<div class="section_one">
    <div class="container">
        <div class="section_one_inner">
            <div class="section_one_left">
                <h1>The smart way to streamline college admissions</h1>
                <p>
                    Personalized notifications, essay feedback, and practical tips easily accessible on any device
                    to help you plan your future
                </p>
                @if (!session()->get('LoggedIn'))
                <a class="same_btn_style" href="{{ url('/signup') }}">
                    <h3>GET STARTED</h3> <i class="fal fa-angle-right"></i>
                </a>
                @else
                <a class="same_btn_style" href="{{ route('user.profile') }}">
                    <h3>GET STARTED</h3> <i class="fal fa-angle-right"></i>
                </a>
                @endif
            </div>
            <div class="section_one_right">
                @php
                $fst_video = \App\Models\VideoModel::where('status', '=', 'Active')
                ->where('is_show', '=', 'Show')
                ->orderBy('id', 'desc')
                ->first();
                @endphp
                <iframe width="560" height="315" src="{{ $fst_video->link }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<!-- ========================= Section Two ======================== -->
<div class="section_two">
    <div class="container">
        <div class="section_two_inner">
            <div class="section_two_left">
                <div class="tip">
                    <div class="tip_box">
                        <div class="tip_box_heading">
                            <h3>Seniors</h3>
                            <i class="fal fa-chevron-up"></i>
                        </div>
                        <div class="tip_box_content">
                            <ul>
                                <li>Strengthen your argument for admission to your target school</li>
                                <li>Obtain relevant experience for your field of interest by summer</li>
                                <li>Streamline your extracurriculars to best fit your package</li>
                            </ul>
                        </div>
                    </div>
                    <div class="tip_box">
                        <div class="tip_box_heading">
                            <h3>Juniors</h3>
                            <i class="fal fa-chevron-up"></i>
                        </div>
                        <div class="tip_box_content">
                            <ul>
                                <li>Start writing full Common App essays for practice, using strong outlines</li>
                                <li>Build up a strong portfolio of experience relevant to your field of interest</li>
                                <li>Focus on official College Board material for SAT/ACT prep</li>
                            </ul>
                        </div>
                    </div>
                    <div class="tip_box">
                        <div class="tip_box_heading">
                            <h3>Sophomores</h3>
                            <i class="fal fa-chevron-up"></i>
                        </div>
                        <div class="tip_box_content">
                            <ul>
                                <li>Start defining fields of interests and pursuing related activities</li>
                                <li>For Common App essays, focus on creating strong outlines</li>
                                <li>Look for leadership opportunities that suit your interests and age</li>
                            </ul>
                        </div>
                    </div>
                    <div class="tip_box">
                        <div class="tip_box_heading">
                            <h3>Freshmen</h3>
                            <i class="fal fa-chevron-up"></i>
                        </div>
                        <div class="tip_box_content">
                            <ul>
                                <li>A good GPA is a must. Focus on getting good grades</li>
                                <li>Start reading sample essays for your Common App</li>
                                <li>Look for topics that you enjoy and genuinely interest you</li>
                            </ul>
                        </div>
                    </div>
                    <div class="tip_box">
                        <div class="tip_box_heading">
                            <h3>Junior high</h3>
                            <i class="fal fa-chevron-up"></i>
                        </div>
                        <div class="tip_box_content">
                            <ul>
                                <li>Take part in activities that give you more in-depth knowledge</li>
                                <li>Hone your writing skills by taking part in competitions</li>
                                <li>Join a club to explore your interests</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section_two_right">
                <div class="r_heading_style">
                    <h1>Where to begin</h1>
                    <a href="{{ url('/blog/6') }}">
                        <h2 class="heading_style_h2">Junior HIGH</h2>
                    </a>
                    <a href="{{ url('/blog/6') }}">
                        <h2>hIgh SCHOOL</h2>
                    </a>
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                    </div>
                    <div class="image">
                        <svg width="60" height="179" viewBox="0 0 60 179" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M30 3H57V87M57 87H39.5M57 87V176.5H3" stroke="#202020" stroke-width="5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Section Three ======================== -->
<div class="section_three">
    <div class="container">
        <div class="section_three_inner">
            <div class="r_heading_style l_heading_style">
                <h1>hOW</h1>
                <div class="bottom_style">
                    <span>iT WORKS</span>
                    <span class="black_bg"></span>
                    <span class="white_bg"></span>
                </div>
            </div>

            <div class="s_t_steps">
                <div class="s_t_steps_box_outer">
                    <div class="s_t_steps_box">
                        <div class="image">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1364_36826)">
                                    <path
                                        d="M16.5666 13.6544C15.7013 12.7884 14.2974 12.7884 13.4321 13.6544C10.2193 16.8672 8.64018 21.3428 9.09908 25.9345C9.21358 27.0783 10.1772 27.931 11.3026 27.931C11.3765 27.931 11.451 27.9272 11.525 27.9199C12.7435 27.798 13.6324 26.711 13.5105 25.4933C13.1839 22.2302 14.2982 19.0573 16.5666 16.7888C17.4326 15.9236 17.4326 14.5196 16.5666 13.6544Z"
                                        fill="#202020" />
                                    <path
                                        d="M25.3448 0C11.3696 0 0 11.3696 0 25.3448C0 39.32 11.3696 50.6897 25.3448 50.6897C39.32 50.6897 50.6897 39.32 50.6897 25.3448C50.6897 11.3696 39.3199 0 25.3448 0ZM25.3448 46.2561C13.8141 46.2561 4.43355 36.8756 4.43355 25.3448C4.43355 13.8141 13.8141 4.43355 25.3448 4.43355C36.8749 4.43355 46.2561 13.8141 46.2561 25.3448C46.2561 36.8756 36.8756 46.2561 25.3448 46.2561Z"
                                        fill="#202020" />
                                    <path
                                        d="M59.3505 56.216L43.242 40.1076C42.376 39.2416 40.9735 39.2416 40.1075 40.1076C39.2415 40.973 39.2415 42.3769 40.1075 43.2422L56.216 59.3505C56.649 59.7835 57.2157 60 57.7833 60C58.3508 60 58.9175 59.7835 59.3505 59.3505C60.2164 58.4852 60.2164 57.0813 59.3505 56.216Z"
                                        fill="#202020" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1364_36826">
                                        <rect width="60" height="60" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <h3>Research</h3>
                        <p>Videos/blogs</p>
                    </div>
                </div>
                <div class="arrow">
                    <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <mask id="mask0_1364_36770" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="47" height="47">
                            <rect x="0.839844" y="0.961304" width="45.5079" height="45.5079" fill="url(#pattern0)" />
                        </mask>
                        <g mask="url(#mask0_1364_36770)">
                            <rect x="0.839844" y="0.961304" width="45.5079" height="45.5079" fill="#202020" />
                        </g>
                        <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_1364_36770" transform="scale(0.00195312)" />
                            </pattern>
                            <image id="image0_1364_36770" width="512" height="512"
                                xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>

                </div>
                <div class="s_t_steps_box_outer">
                    <div class="s_t_steps_box">
                        <div class="image">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M30.0002 0C21.6779 0 14.9077 6.77016 14.9077 15.0925C14.9077 23.4148 21.6779 30.1849 30.0002 30.1849C38.3225 30.1849 45.0926 23.4148 45.0926 15.0925C45.0926 6.77016 38.3225 0 30.0002 0ZM30.0002 25.746C24.1259 25.746 19.3467 20.9667 19.3467 15.0925C19.3467 9.2182 24.1259 4.43895 30.0002 4.43895C35.8744 4.43895 40.6537 9.2182 40.6537 15.0925C40.6537 20.9667 35.8744 25.746 30.0002 25.746Z"
                                    fill="#202020" />
                                <path
                                    d="M30.0001 35.5117C16.7247 35.5117 6.32568 46.268 6.32568 60H10.7646C10.7646 48.5697 19.0344 39.9507 30.0001 39.9507C40.9658 39.9507 49.2356 48.5704 49.2356 60H53.6746C53.6746 46.2681 43.2756 35.5117 30.0001 35.5117Z"
                                    fill="#202020" />
                            </svg>
                        </div>
                        <h3>Build Profile</h3>
                        <p>Receive recommendations</p>
                    </div>
                </div>
                <div class="arrow">
                    <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <mask id="mask0_856_2304" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="47" height="47">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="url(#pattern0)" />
                        </mask>
                        <g mask="url(#mask0_856_2304)">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="#202020" />
                        </g>
                        <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_856_2304" transform="scale(0.00195312)" />
                            </pattern>
                            <image id="image0_856_2304" width="512" height="512"
                                xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </div>
                <div class="s_t_steps_box_outer">
                    <div class="s_t_steps_box">
                        <div class="image">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1364_36887)">
                                    <path
                                        d="M51.1624 27.4362V12.3037C51.1624 8.70722 48.2173 5.73667 44.6205 5.73667H43.8057V4.71086C43.8057 2.1448 41.7254 0.0645324 39.1594 0.0645324C36.5933 0.0645324 34.513 2.1448 34.513 4.71086V5.73667H17.4765V4.71086C17.4765 2.10918 15.3673 0 12.7656 0C10.1639 0 8.05477 2.10918 8.05477 4.71086V5.73667H7.35073C3.75408 5.73667 0.827148 8.70722 0.827148 12.3037V47.0511C0.827148 50.6477 3.75408 53.6197 7.35073 53.6197H27.8196C31.1943 57.6563 36.1824 59.9923 41.4438 60C51.214 60 59.1728 52.0397 59.1728 42.2692C59.1731 36.0766 55.9378 30.6052 51.1624 27.4362ZM37.0943 4.71086C37.0745 3.58671 37.9695 2.65925 39.0937 2.63937C39.1118 2.63912 39.1298 2.63899 39.1479 2.63912C40.2826 2.62711 41.2124 3.53728 41.2244 4.67214C41.2245 4.68505 41.2245 4.69796 41.2244 4.71086V9.73768H37.0943V4.71086ZM10.6361 4.71086C10.6483 3.55431 11.5959 2.62673 12.7525 2.63899C12.7545 2.63899 12.7565 2.63899 12.7584 2.63912C13.9192 2.63912 14.8952 3.55018 14.8952 4.71086V9.73768H10.6361V4.71086ZM3.40844 12.3037C3.40844 10.1304 5.1774 8.31796 7.35073 8.31796H8.05477V11.082C8.05477 11.7947 8.65002 12.319 9.36285 12.319H16.1542C16.8669 12.319 17.4765 11.7947 17.4765 11.082V8.31796H34.513V11.082C34.4939 11.7461 35.0168 12.2999 35.6808 12.319C35.7046 12.3196 35.7283 12.3196 35.7521 12.319H42.5435C43.2178 12.3414 43.7827 11.8129 43.8052 11.1385C43.8058 11.1197 43.806 11.1009 43.8057 11.082V8.31796H44.6205C46.8085 8.34003 48.5728 10.1157 48.5811 12.3037V16.449H3.40844V12.3037ZM7.35073 51.0384C5.1774 51.0384 3.40844 49.2244 3.40844 47.0511V19.0303H48.5811V26.0326C46.3345 25.0462 43.9073 24.5374 41.4536 24.5383C31.6834 24.5383 23.7296 32.5102 23.7296 42.2807C23.7247 45.3503 24.518 48.3682 26.0319 51.0384H7.35073ZM41.4438 57.3957C33.0833 57.3957 26.3057 50.6182 26.3057 42.2576C26.3057 33.897 33.0833 27.1195 41.4438 27.1195C49.8044 27.1195 56.582 33.897 56.582 42.2576V42.2577C56.5725 50.6143 49.8005 57.3863 41.4438 57.3957Z"
                                        fill="#202020" />
                                    <path
                                        d="M47.5242 42.262H41.8699V34.4962C41.8699 33.7834 41.292 33.2056 40.5792 33.2056C39.8664 33.2056 39.2886 33.7834 39.2886 34.4962V43.5514C39.2999 44.2691 39.8856 44.8446 40.6035 44.8433H47.5242C48.237 44.8433 48.8148 44.2655 48.8148 43.5527C48.8148 42.8399 48.237 42.262 47.5242 42.262Z"
                                        fill="#202020" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1364_36887">
                                        <rect width="60" height="60" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <h3>Manage Schedule</h3>
                        <p>Personalized calendar</p>
                    </div>
                </div>
                <div class="arrow">
                    <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <mask id="mask0_856_2304" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="47" height="47">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="url(#pattern0)" />
                        </mask>
                        <g mask="url(#mask0_856_2304)">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="#202020" />
                        </g>
                        <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_856_2304" transform="scale(0.00195312)" />
                            </pattern>
                            <image id="image0_856_2304" width="512" height="512"
                                xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </div>
                <div class="s_t_steps_box_outer">
                    <div class="s_t_steps_box">
                        <div class="image">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1364_36901)">
                                    <path
                                        d="M37.087 2.07153H6.38758C2.85114 2.08455 -0.00693768 4.95815 7.11021e-05 8.49458V42.5533C-0.0034333 42.8852 0.122725 43.2056 0.351512 43.4459L14.0327 57.5531C14.2715 57.8034 14.6014 57.9465 14.9473 57.9496H37.087C40.6205 57.9496 43.4465 55.0599 43.4465 51.5265V8.49458C43.4465 4.96115 40.6205 2.07153 37.087 2.07153ZM13.7133 53.4925L4.29095 43.8519H12.3841C13.0905 43.8519 13.7133 44.4096 13.7133 45.1165V53.4925ZM40.8833 51.5265C40.9048 53.6367 39.2117 55.3648 37.1016 55.3863H16.2765V45.1165C16.2765 42.9963 14.5037 41.2887 12.3841 41.2887H2.56328V8.49458C2.55477 6.37342 4.26642 4.64626 6.38758 4.63475H37.087C39.1972 4.64826 40.8968 6.36942 40.8833 8.47956V51.5265Z"
                                        fill="#202020" />
                                    <path
                                        d="M34.3198 18.7324H9.94323C9.23584 18.7324 8.66162 19.3061 8.66162 20.014C8.66162 20.7219 9.23584 21.2956 9.94323 21.2956H34.3198C35.0272 21.2956 35.6014 20.7219 35.6014 20.014C35.6014 19.3061 35.0272 18.7324 34.3198 18.7324Z"
                                        fill="#202020" />
                                    <path
                                        d="M34.3198 26.422H9.94323C9.23584 26.422 8.66162 26.9957 8.66162 27.7036C8.66162 28.4115 9.23584 28.9852 9.94323 28.9852H34.3198C35.0272 28.9852 35.6014 28.4115 35.6014 27.7036C35.6014 26.9957 35.0272 26.422 34.3198 26.422Z"
                                        fill="#202020" />
                                    <path
                                        d="M34.3198 34.1117H9.94323C9.23584 34.1117 8.66162 34.6854 8.66162 35.3933C8.66162 36.1012 9.23584 36.6749 9.94323 36.6749H34.3198C35.0272 36.6749 35.6014 36.1012 35.6014 35.3933C35.6014 34.6854 35.0272 34.1117 34.3198 34.1117Z"
                                        fill="#202020" />
                                    <path
                                        d="M9.94323 14.1186H21.1978C21.9052 14.1186 22.4794 13.5449 22.4794 12.837C22.4794 12.1291 21.9052 11.5554 21.1978 11.5554H9.94323C9.23584 11.5554 8.66162 12.1291 8.66162 12.837C8.66162 13.5449 9.23584 14.1186 9.94323 14.1186Z"
                                        fill="#202020" />
                                    <path
                                        d="M54.2697 3.33008C51.1228 3.33408 48.5716 5.88328 48.5656 9.03072L48.54 47.7352C48.5395 47.941 48.5891 48.1442 48.6842 48.327L53.1328 56.8832C53.3536 57.3072 53.7921 57.573 54.2702 57.573C54.7483 57.573 55.1864 57.3072 55.4071 56.8832L59.8557 48.327C59.9508 48.1442 60.0004 47.941 60.0004 47.7352L59.9744 9.03072C59.9684 5.88328 57.4172 3.33408 54.2697 3.33008ZM57.4162 16.2973H51.1238L51.1243 15.0157H57.4152L57.4162 16.2973ZM57.4182 18.8605L57.4362 46.4151H51.1038L51.1223 18.8605H57.4182ZM54.2702 5.89329C56.0034 5.89579 57.4082 7.30005 57.4117 9.03322L57.4137 12.4525H51.1263L51.1288 9.03272C51.1323 7.29955 52.5371 5.89579 54.2702 5.89329ZM54.2702 53.4744L51.9323 48.9783H56.6077L54.2702 53.4744Z"
                                        fill="#202020" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1364_36901">
                                        <rect width="60" height="60" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <h3>Practice Essays</h3>
                        <p>Get evaluations</p>
                    </div>
                </div>
                <div class="arrow">
                    <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <mask id="mask0_856_2304" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="47" height="47">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="url(#pattern0)" />
                        </mask>
                        <g mask="url(#mask0_856_2304)">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="#202020" />
                        </g>
                        <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_856_2304" transform="scale(0.00195312)" />
                            </pattern>
                            <image id="image0_856_2304" width="512" height="512"
                                xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </div>
                <div class="s_t_steps_box_outer">
                    <div class="s_t_steps_box">
                        <div class="image">
                            <svg width="48" height="60" viewBox="0 0 48 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M41.5699 7.86111H36.1418V5.43276C36.1418 4.6471 35.2848 4.29002 34.4991 4.29002H30.2852C29.2853 1.43309 26.7855 0.00462453 23.9285 0.00462453C21.1031 -0.101598 18.5331 1.63091 17.5719 4.29002H13.4293C12.6437 4.29002 11.858 4.6471 11.858 5.43276V7.86111H6.42975C3.21301 7.89542 0.581375 10.433 0.430176 13.6463V54.5717C0.430176 57.7143 3.2871 59.9998 6.42975 59.9998H41.5699C44.7126 59.9998 47.5695 57.7143 47.5695 54.5717V13.6465C47.4183 10.433 44.7867 7.89542 41.5699 7.86111ZM14.7148 7.14694H18.6431C19.3289 7.06328 19.8797 6.5416 20.0002 5.86134C20.4232 4.01933 22.0392 2.69709 23.9285 2.64733C25.8003 2.70406 27.392 4.03041 27.7854 5.86134C27.9134 6.56511 28.5006 7.09349 29.2138 7.14694H33.285V12.8608H14.7148V7.14694ZM44.7126 54.5718C44.7126 56.1432 43.1412 57.143 41.5699 57.143H6.42975C4.85843 57.143 3.2871 56.1432 3.2871 54.5718V13.6465C3.43283 12.0109 4.78789 10.7481 6.42975 10.7182H11.8579V14.3608C11.9334 15.1611 12.6265 15.7597 13.4292 15.7179H34.499C35.3165 15.7626 36.0313 15.1721 36.1416 14.3608V10.718H41.5698C43.2115 10.7481 44.5667 12.0107 44.7124 13.6463V54.5718H44.7126Z"
                                    fill="#202020" />
                                <path
                                    d="M18.5002 31.9308C17.9644 31.3661 17.075 31.3342 16.5003 31.8594L11.9292 36.2162L10.0008 34.2163C9.46503 33.6516 8.5756 33.6198 8.00088 34.1449C7.44762 34.7246 7.44762 35.6366 8.00088 36.2162L10.9292 39.216C11.1826 39.4998 11.5487 39.6567 11.9291 39.6446C12.3058 39.6392 12.6652 39.4852 12.9289 39.216L18.4999 33.9307C19.0522 33.4241 19.0891 32.5655 18.5824 32.0134C18.5564 31.9845 18.5289 31.9571 18.5002 31.9308Z"
                                    fill="#202020" />
                                <path
                                    d="M38.9988 35.002H22.5715C21.7826 35.002 21.1431 35.6415 21.1431 36.4304C21.1431 37.2194 21.7826 37.8589 22.5715 37.8589H38.9988C39.7877 37.8589 40.4273 37.2194 40.4273 36.4304C40.4273 35.6415 39.7877 35.002 38.9988 35.002Z"
                                    fill="#202020" />
                                <path
                                    d="M18.5002 20.5031C17.9644 19.9383 17.075 19.9065 16.5003 20.4317L11.9292 24.7885L10.0008 22.7886C9.46503 22.2238 8.5756 22.192 8.00088 22.7172C7.44762 23.2968 7.44762 24.2088 8.00088 24.7885L10.9292 27.7883C11.1826 28.0721 11.5487 28.229 11.9291 28.2168C12.3058 28.2115 12.6652 28.0574 12.9289 27.7883L18.4999 22.503C19.0522 21.9963 19.0891 21.1378 18.5824 20.5856C18.5564 20.5568 18.5289 20.5293 18.5002 20.5031Z"
                                    fill="#202020" />
                                <path
                                    d="M38.9988 23.5742H22.5715C21.7826 23.5742 21.1431 24.2137 21.1431 25.0027C21.1431 25.7916 21.7826 26.4311 22.5715 26.4311H38.9988C39.7877 26.4311 40.4273 25.7916 40.4273 25.0027C40.4273 24.2137 39.7877 23.5742 38.9988 23.5742Z"
                                    fill="#202020" />
                                <path
                                    d="M18.5002 43.3584C17.9644 42.7936 17.075 42.7619 16.5003 43.287L11.9292 47.6438L10.0008 45.6439C9.46503 45.0791 8.5756 45.0474 8.00088 45.5725C7.44762 46.1521 7.44762 47.0641 8.00088 47.6438L10.9292 50.6436C11.1826 50.9274 11.5487 51.0843 11.9291 51.0721C12.3058 51.0668 12.6652 50.9127 12.9289 50.6436L18.4999 45.3583C19.0522 44.8516 19.0891 43.9931 18.5824 43.4409C18.5564 43.4122 18.5289 43.3848 18.5002 43.3584Z"
                                    fill="#202020" />
                                <path
                                    d="M38.9988 46.4297H22.5715C21.7826 46.4297 21.1431 47.0692 21.1431 47.8582C21.1431 48.6471 21.7826 49.2866 22.5715 49.2866H38.9988C39.7877 49.2866 40.4273 48.6471 40.4273 47.8582C40.4273 47.0692 39.7877 46.4297 38.9988 46.4297Z"
                                    fill="#202020" />
                            </svg>
                        </div>
                        <h3>Test Prep</h3>
                        <p>SAT/ACT timer</p>
                    </div>
                </div>
                <div class="arrow">
                    <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <mask id="mask0_856_2304" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="47" height="47">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="url(#pattern0)" />
                        </mask>
                        <g mask="url(#mask0_856_2304)">
                            <rect x="0.941406" y="0.961304" width="45.5079" height="45.5079" fill="#202020" />
                        </g>
                        <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_856_2304" transform="scale(0.00195312)" />
                            </pattern>
                            <image id="image0_856_2304" width="512" height="512"
                                xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </div>
                <div class="s_t_steps_box_outer">
                    <div class="s_t_steps_box">
                        <div class="image">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1364_36951)">
                                    <path
                                        d="M18.9938 19.707H25.6783L29.1488 25.2707C29.3293 25.5693 29.6529 25.7512 30.0015 25.7502C30.3501 25.7497 30.6728 25.5658 30.8517 25.2667L34.3222 19.707H41.0063C42.9445 19.707 44.5606 18.162 44.5606 16.2242V3.48373C44.5606 1.54549 42.9445 0 41.0063 0H18.9938C17.056 0 15.4395 1.54549 15.4395 3.48373V16.2242C15.4395 18.162 17.056 19.707 18.9938 19.707ZM17.4478 3.48373C17.4478 2.65313 18.1637 2.00836 18.9938 2.00836H41.0063C41.8369 2.00836 42.5523 2.65313 42.5523 3.48373V16.2242C42.5523 17.0548 41.8369 17.6986 41.0063 17.6986H33.7657C33.4176 17.705 33.0964 17.8889 32.9145 18.186L30 22.8529L27.0861 18.1821C26.9037 17.8859 26.5825 17.7035 26.2344 17.6986H18.9938C18.1637 17.6986 17.4478 17.0548 17.4478 16.2242V3.48373Z"
                                        fill="#202020" />
                                    <path
                                        d="M14.2283 38.8966C18.6035 38.8966 22.1632 35.4526 22.1632 31.2192C22.1632 26.9858 18.6035 23.5417 14.2283 23.5417C9.85319 23.5417 6.29395 26.9858 6.29395 31.2192C6.29395 35.4526 9.85368 38.8966 14.2283 38.8966ZM14.2283 25.5501C17.4963 25.5501 20.1548 28.0934 20.1548 31.2192C20.1548 34.345 17.4963 36.8883 14.2283 36.8883C10.9608 36.8883 8.3023 34.3455 8.3023 31.2192C8.3023 28.0929 10.9608 25.5501 14.2283 25.5501Z"
                                        fill="#202020" />
                                    <path
                                        d="M2.26886 59.9996H26.1877C26.7423 59.9996 27.2385 59.5809 27.2385 59.0264V53.0047C27.2385 46.101 21.3953 40.4844 14.2469 40.4844C7.09902 40.4844 1.25537 46.101 1.25537 53.0047V59.0264C1.2588 59.2906 1.36815 59.5422 1.55839 59.7251C1.74912 59.908 2.00458 60.007 2.26886 59.9996ZM3.26373 53.0047C3.26373 47.2086 8.20616 42.4927 14.2469 42.4927C20.2877 42.4927 25.2301 47.2091 25.2301 53.0047V57.9913H3.26373V53.0047Z"
                                        fill="#202020" />
                                    <path
                                        d="M37.8374 31.2192C37.8374 35.4526 41.3971 38.8966 45.7723 38.8966C50.1469 38.8966 53.7066 35.4526 53.7066 31.2192C53.7066 26.9858 50.1474 23.5417 45.7723 23.5417C41.3966 23.5417 37.8374 26.9858 37.8374 31.2192ZM45.7723 25.5501C49.0398 25.5501 51.6983 28.0934 51.6983 31.2192C51.6983 34.345 49.0398 36.8883 45.7723 36.8883C42.5043 36.8883 39.8458 34.3455 39.8458 31.2192C39.8458 28.0929 42.5043 25.5501 45.7723 25.5501Z"
                                        fill="#202020" />
                                    <path
                                        d="M32.7617 53.0047V59.0264C32.7617 59.5809 33.2579 59.9996 33.8125 59.9996H57.7318C57.9956 60.007 58.2516 59.908 58.4423 59.7251C58.6325 59.5422 58.7419 59.2906 58.7448 59.0264V53.0047C58.7448 46.101 52.9017 40.4844 45.7533 40.4844C38.6054 40.4844 32.7617 46.101 32.7617 53.0047ZM56.7365 53.0047V57.9913H34.7701V53.0047C34.7701 47.2086 39.7125 42.4927 45.7533 42.4927C51.794 42.4927 56.7365 47.2091 56.7365 53.0047Z"
                                        fill="#202020" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1364_36951">
                                        <rect width="60" height="60" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <h3>Your Community</h3>
                        <p>Share with others</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================= Videos ========================= -->
<div class="videos">
    <div class="container">
        <div class="videos_inner">
            <div class="r_heading_style l_heading_style">
                <h1>NEW</h1>
                <div class="bottom_style">
                    <span class="black_bg"></span>
                    <span class="white_bg"></span>
                    <span>Videos</span>
                </div>
            </div>
            <style>
                .videos_inner .row .col{
                    border-radius: 20px;
                }
                .video_box {
                    position: relative;
                    width: 100%;
                    height: 100%;
                }

                .video_box .image {
                    width: 100%;
                    height: 100%;
                }

                .video_box .play_time {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                    transition: 0.5s;
                    cursor: pointer;
                }

                .video_box .play_time:hover{
                    background: rgba(0,0,0,0.2);
                }

                .video_box .play_time .play_time_box{
                    width: 100%;
                    height: 100%;
                    position: relative;
                }

                .video_box .play_time .play_icon {
                    width: 80px;
                    height: 80px;
                    border-radius: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: rgba(254, 0, 0, 0.7);
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50% , -50%);
                }

                .video_box .play_time .play_icon i {
                    font-size: 28px;
                    color: #FFFFFF;
                }

                .video_box .play_time .timer {
                    min-width: 80px;
                    padding: 5px 10px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: #FFFFFF;
                    border-radius: 25px;
                    position: absolute;
                    bottom: 15px;
                    right: 15px;
                }

                .video_box .play_time .timer i {
                    font-size: 16px;
                    color: #202020;
                    margin-right: 5px;
                }

                .video_box .play_time .timer span {
                    font-family: 'AvantGarde Bk BT';
                    font-style: normal;
                    font-weight: 400;
                    font-size: 18px;
                    letter-spacing: 0.02em;
                    color: #202020;
                }
                /* Sign Up Button */
                .section_five_inner a {
                    border-radius: 16px;
                }
            </style>

            <div class="row video_slider">
                @php
                $videos = \App\Models\VideoModel::where('status', '=', 'Active')
                ->where('is_show', '=', 'Show')
                ->orderBy('id', 'desc')
                ->get();
                @endphp
                @foreach ($videos as $video)
                <div class="col">
                    <div class="video_box video_id{{ $video->id }}" onclick="play_video({{ $video->id }})">
                        <div class="image">
                            <img src="{{ asset('uploads/' . $video->thumbnail) }}" id="image_{{ $video->id }}"
                                style="cursor:pointer;max-width: 100%;" height="100%" />

                        </div>
                        <div class="play_time">
                            <div class="play_time_box">
                                <div class="play_icon">
                                    <i class="fas fa-play"></i>
                                </div>
                                <div class="timer">
                                    <i class="fal fa-clock"></i>
                                    <span>1.5 Hours</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <iframe id="iframe_{{ $video->id }}" width="100%" height="100%" class="embed-responsive-item"
                        src="{{ $video->link }}" allow="" g-show="showvideo" frameborder="0"
                        style="display:none"></iframe>
                </div>
                @endforeach
            </div>

            <a href="{{ route('user.videos') }}" class="blog_nav">
                View More
                <i class="fa fa-long-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
<!-- ========================= Section Five ======================== -->
<div class="section_five">
    <div class="container">
        <div class="section_five_inner">
            <p>Get your Common App essay graded, using a package that best fits your needs</p>
            @if (!session()->get('LoggedIn'))
            <a class="same_btn_style" href="{{ url('signup') }}">Sign up</a>
            @else
            <a class="same_btn_style" href="{{ route('user.evalations') }}">Evaluations</a>
            @endif
        </div>
    </div>
</div>
<!-- ========================= Section Four ======================== -->
<div class="section_four">
    <div class="container">
        <div class="section_four_inner">
            <div class="r_heading_style l_heading_style">
                <h1>Latest</h1>
                <div class="bottom_style">
                    <span class="black_bg"></span>
                    <span class="white_bg"></span>
                    <span>BLog Posts</span>
                </div>
            </div>
            <style>
                .oneline_text{
                    height: 24px;
                    overflow: hidden;
                    display: inline-block;
                    position: relative;
                    padding-right: 20px;
                    box-sizing: border-box;
                }
                .oneline_text::after{
                    content: "...";
                    position: absolute;
                    right: 0px;
                    top: 0px;
                }
            </style>
            <div class="s_f_blog">
                @php
                $blogs = \App\Models\blogs::where('status', '=', 'Active')
                ->orderBy('id', 'desc')
                ->get();
                @endphp
                @foreach ($blogs as $blog)
                <div class="s_f_blog_box">
                    <div class="image"><a href="{{ url('/blog/' . $blog->id) }}"><img
                                src="{{ asset('uploads/' . $blog->media) }}" alt=""
                                onerror="this.src='{{ asset('front/images/image 1.png') }}'"></a></div>
                    <div class="content">
                        <a href="{{ url('/blog/' . $blog->id) }}">{{ $blog->title }}</a>
                        <p>
                            <span class="oneline_text">
                               {{ cut_string($blog->short_content, 100) }}...
                            </span>
                            <a href="{{ url('/blog/' . $blog->id) }}">Read More</a>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('user.blogs') }}" class="blog_nav">
                View More
                <i class="fa fa-long-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
<!-- ========================= Section Eight ======================== -->
<div class="section_eight">
    <div class="container">
        <div class="section_eight_inner">
            <div class="s_e_left">
                <div class="r_heading_style l_heading_style">
                    <h1>Your</h1>
                    <span>Community</span>
                    <div class="bottom_style">
                        <span class="white_bg"></span>
                        <span class="black_bg"></span>
                    </div>
                </div>
                <p>
                    You’re not alone in this journey.
                    Post questions, share info, and connect with others.
                </p>
                <a class="same_btn_style" href="{{ url('/community') }}">
                    <h3>Go to feed</h3>
                </a>
            </div>
            <div class="s_e_right">
                <div class="scroll_comments">
                    <div class="comments">
                        @php
                        $questions = \App\Models\CommunityQuestionsModel::where('status', '=', 'Open')
                        ->with('community_question_types', 'users', 'admins')
                        ->orderBy('id', 'desc')
                        ->take(5)
                        ->get();
                        @endphp
                        @foreach ($questions as $question)
                        <div class="comments_col">
                            <div class="image"><a href="{{ url('/question/' . $question->id) }}"><img
                                        src="{{ asset('front/images/pexels-pixabay-159497 2.png') }}" alt=""></a></div>
                            <div class="question">
                                <div>
                                    <span class="category_btn">Question</span>
                                    <p>{{ $question->title }}
                                    </p>
                                </div>
                                <div>
                                    <span><i class="fal fa-user"></i>
                                        @if (!is_null($question->users))
                                        {{ $question->users->username }}
                                        @else
                                        {{ $question->admins->username }}
                                        @endif
                                    </span><span><i class="fal fa-clock"></i>
                                        {{ formatted_date($question->created_at, 'm-d-y') }}</span>
                                    <span class="category_btn">{{ $question->community_question_types->question_type
                                        }}</span>
                                </div>
                            </div>
                            <div class="comment_views">
                                @php
                                $answer_count = \App\Models\CommunityQuestionAnswersModel::where('question_id', '=',
                                $question->id)->count();
                                @endphp
                                <span>{{ $answer_count }} <i class="fal fa-comment-alt-lines"></i></span>
                                <span>{{ $question->views }} <i class="far fa-eye"></i></span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer')
<script>
    function play_video(id) {
        var src = $('#iframe_' + id).attr('src');
        $('.video_id' + id).css({
            'display': 'none'
        });
        $('#iframe_' + id).css({
            'display': 'block'
        });
        $('#iframe_' + id).attr('src', src + '?autoplay=1');
        $('#iframe_' + id).attr('allow', 'autoplay');
    }
</script>
@endpush