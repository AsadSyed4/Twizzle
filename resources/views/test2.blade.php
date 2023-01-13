@if (session()->get('LoggedIn'))
    @extends('layouts.main')
    @push('header')
        <title>Tests | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('front/style2.css') }}">
    @endpush
    @section('section')
        {{-- <div class="container text-center mt-3">
            <div class="row rounded-3 border">
                <div class="col-md-3 bg-warning rounded-left">
                    <ul class="list-unstyled p-2 mt-2">
                        @if (count($tests) > 0)
                            @foreach ($tests as $test)
                                <li class="border-bottom"><a href="javascript:void(0)" onclick="get_test({{ $test->id }})"><b>{{ $test->name }}</b></a></li>
                            @endforeach
                        @else
                            <li class="text-white">Test Not Added Yet.</li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-9 rounded-right bg-violet-500 d-flex align-items-center justify-content-center" id="result">
                    <span class="h4">Test Showcase</span>
                </div>
            </div>
        </div> --}}
        <div class="planner planner_desire master_plan timer">
            <div class="container">
                <div class="planner_inner planner_desire_inner">
                    <div class="r_heading_style l_heading_style">
                        <h1>Timers</h1>
                        <div class="bottom_style">
                            <span class="white_bg"></span>
                            <span class="black_bg"></span>
                        </div>
                    </div>


                    <div class="timer_inner">
                        <ul class="sat" id="test">
                            @foreach ($tests as $test)
                                <li @if ($id == $test->id) class="sat_li" @endif><a
                                        href="{{ url('/tests/' . $test->id) }}">{{ $test->name }}</a></li>
                                @if ($id == $test->id)
                                    <script>
                                        var full_time = {{ $test->duration }};
                                    </script>
                                @endif
                            @endforeach
                        </ul>
                        <div class="content">
                            <div class="box">
                                <ul class="testing" id="section_full">
                                    <li class="testing_li" onclick="full_section()">Full Test</li>
                                    @foreach ($section as $item)
                                        <li onclick="section_time({{ $item->duration }})">{{ $item->name }}</li>
                                    @endforeach
                                </ul>
                                <div class="time_now">
                                    <h2 id="heading">Full Test</h2>
                                    <div id="content">
                                        <ul>
                                            <li>01</li>
                                            :
                                            <li>11</li>
                                            :
                                            <li>00</li>
                                        </ul>
                                        <div class="controls">
                                            <span><i class="fas fa-pause"></i></span>
                                            <span><i class="fas fa-play"></i></span>
                                            <span><i class="fas fa-stop"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            var interval, h, m, s;

            function pad(d) {
                return (d < 10) ? '0' + d.toString() : d.toString();
            }

            function Timer(duration) {
                var timer = duration,
                    hours, minutes, seconds;
                interval = setInterval(function() {
                    hours = parseInt((timer / 3600) % 24, 10)
                    minutes = parseInt((timer / 60) % 60, 10)
                    seconds = parseInt(timer % 60, 10);

                    hours = pad(hours);
                    minutes = pad(minutes);
                    seconds = pad(seconds);

                    $('#timer').text(hours + ":" + minutes + ":" + seconds);

                    --timer;
                }, 1000);
            }

            function stop_interval(h, m, s, duration) {
                clearInterval(interval);
                set_div(h, m, s, duration);
            }

            $('#test li').on('click', function() {
                $('#test li').removeClass('sat_li');
                $(this).addClass('sat_li');
            });

            $('#section_full li').on('click', function() {
                $('#section_full li').removeClass('testing_li');
                $(this).addClass('testing_li');
                var heading = $(this).text();
                $('#heading').text(heading);
            });

            $(document).ready(function() {
                get_test({{ $id }});
            });

            function section_time(d) {
                clearInterval(interval);
                d = Number(d);
                if (d > 60) {
                    h = Math.floor(d / 60);
                    m = Math.floor(d % 60 / 60);
                    s = Math.floor(d % 3600);
                } else {
                    h = 0;
                    m = d;
                    s = 0;
                }
                set_div(h, m, s, d);
            }

            function full_section() {
                clearInterval(interval);
                d = Number(full_time);
                console.log(d);
                h = Math.floor(d / 60);
                m = Math.floor(d % 60 / 60);
                s = Math.floor(d % 3600);
                set_div(h, m, s, d);
            }

            function get_test(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/get-test') }}",
                    data: {
                        'test_id': id,
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data.success) {
                            test = data.test;
                            clearInterval(interval);
                            d = Number(test.duration);
                            var h = Math.floor(d / 60);
                            var m = Math.floor(d % 60 / 60);
                            var s = Math.floor(d % 60 % 60);
                            set_div(h, m, s, test.duration);
                            // window.setTimeout(function() {
                            //     $('#test').submit();
                            // }, 30000);                            
                        } else {
                            iziToast.warning({
                                position: 'topRight',
                                message: data.message,
                            });
                        }
                    }
                });
            }

            function set_div(h, m, s, duration) {
                html = '<div id="timer" style="font-size: 81.6703px;font-weight: 700;">' + pad(h) +
                    ':' + pad(m) + ':' + pad(s) +
                    '</div><div class = "controls"><span><i class="fas fa-pause"> </i></span> <span><i class="fas fa-play" id="play" onclick="Timer(' +
                    duration * 60 +
                    ')"> </i></span> <span><i class="fas fa-stop" onclick="stop_interval(' + h + ',' + m + ',' + s + ',' +
                    duration + ')"> </i></span></div>';
                $('#content').html('');
                $('#content').html(html);
            }

            function saveAnswer(tid, qid, ans) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/save-test-answer') }}",
                    data: {
                        'test_id': tid,
                        'question_id': qid,
                        'answer': ans
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data.success) {

                        } else {
                            iziToast.error({
                                position: 'topRight',
                                message: data.message,
                            });
                        }
                    }
                });
            }
        </script>
    @endpush
@else
    <script>
        window.location.href = "{{ url('/login') }}";
    </script>
@endif
