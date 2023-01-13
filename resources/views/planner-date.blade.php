@extends('layouts.main')
@push('header')
    <title>Planning | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('section')
    <div class="planner planner_date">
        <div class="container">
            <div class="planner_inner">
                <div class="r_heading_style l_heading_style">
                    <a href="{{ route('user.planning') }}">
                        <div class="svg_image">
                            <svg width="41" height="23" viewBox="0 0 41 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.76373 12.96L38.2882 12.96C38.799 12.96 39.2852 12.8326 39.6599 12.6004C40.0268 12.3729 40.3555 11.9935 40.3555 11.4887C40.3555 10.9839 40.0269 10.6045 39.6599 10.377C39.2853 10.1448 38.799 10.0174 38.2882 10.0174L2.76373 10.0174C2.253 10.0174 1.76678 10.1447 1.3921 10.3769C1.02502 10.6043 0.696453 10.9838 0.696453 11.4887C0.696453 11.9936 1.02498 12.373 1.39207 12.6005C1.76674 12.8327 2.25297 12.96 2.76373 12.96Z"
                                    fill="#202020" stroke="#202020" />
                                <path
                                    d="M10.4494 22.0487L10.4496 22.0489C11.0243 22.623 11.9551 22.623 12.5297 22.0489L12.5299 22.0487C13.1045 21.4741 13.1048 20.5424 12.5299 19.9679C12.5299 19.9678 12.5298 19.9678 12.5297 19.9677L4.05205 11.4897L12.5297 3.01167C13.1047 2.43725 13.1047 1.5053 12.5297 0.930885C12.2426 0.643862 11.8656 0.500002 11.4897 0.500002C11.1136 0.500002 10.7365 0.643915 10.4494 0.931042L10.7981 1.27975L10.4494 0.931046L0.93135 10.4494C0.356793 11.024 0.35648 11.9558 0.931343 12.5302C0.931404 12.5303 0.931465 12.5304 0.931526 12.5304L10.4494 22.0487Z"
                                    fill="#202020" stroke="#202020" />
                            </svg>
                        </div>
                        Go Back
                    </a>
                    <div>
                        <h1>Activity Planner</h1>
                        <div class="bottom_style">
                            <span class="white_bg"></span>
                            <span class="black_bg"></span>
                        </div>
                    </div>
                </div>
                <form id="form" action="{{ route('user.save-to-calander') }}" method="POST">
                    @csrf
                    <div class="time_table">                        
                        <div class="box">
                            <div class="scroll_box">
                                <b style="position: absolute;top: 3%;color: #21DBB6;">Select</b>
                                @foreach ($events as $event)
                                    <div class="col">
                                        <div>
                                            <label for="{{ $event->id }}"><input id="{{ $event->id }}" name="event[]"
                                                    type="checkbox"
                                                    value="{{ $event->id }}"> {{ formatted_date($event->start, 'd M Y') }}</label>
                                            <span></span>
                                        </div>
                                        <div>
                                            <h2>{{ $event->title }}</h2>
                                            <p>
                                                {{ $event->description }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="table_btn_export">
                        <a class="planner_btn export2" href="{{ route('calendar.index') }}">Go to Calnedar</a>
                        <button type="submit" class="planner_btn" style="border: 0;margin-left: -40%;">Save to calendar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            position: 'topRight',
                            message: response.message,
                        });
                        $("#form").trigger("reset");
                    }
                }
            });
        }));
    </script>
@endpush
