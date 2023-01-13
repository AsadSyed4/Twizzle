@extends('layouts.main')
@push('header')
    <title>Common Mistakes | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('section')
    <div class="planner planner_desire">
        <div class="container">
            <div class="planner_inner">
                <div class="r_heading_style l_heading_style">
                    <h1>Common Mistakes</h1>
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                    </div>
                </div>
                <div class="interest mistake">
                    <div class="left">
                        <div class="box">
                            <ul>
                                @php
                                    $mistakes = \App\Models\CmCategories::where('status', '=', 'Active')->get();
                                @endphp
                                @foreach ($mistakes as $mistake)
                                    <li class="{{ $mistake->name }}_btn" onclick="set_cm_id({{ $mistake->id }})">
                                        {!! $mistake->media !!}
                                        <h2>{{ $mistake->name }}</h2>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="content">
                                @foreach ($mistakes as $mistake)
                                    <div
                                        class="@if ($mistake->name != 'Content') {{ strtolower($mistake->name) }} @else {{ $mistake->name }} @endif" style="display: none;">
                                        <h2>Description</h2>
                                        <p>
                                            {{ $mistake->description }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mistake_right">
                        <h1>Examples</h1>
                        <div id="cat_content">
                            <div class="box_outer">
                                <div class="box" id="mistake_content">
                                    <p>
                                        Example Here.
                                    </p>
                                </div>
                            </div>
                            <ul class="category_select">
                                <li onclick="get_cm('Ivy')">
                                    <input name="radio" type="radio">
                                    <p>Ivy</p>
                                </li>
                                <li onclick="get_cm('Good')">
                                    <input name="radio" type="radio">
                                    <p>Good</p>
                                </li>
                                <li onclick="get_cm('Fair')">
                                    <input name="radio" type="radio">
                                    <p>Fair</p>
                                </li>
                                <li onclick="get_cm('Poor')">
                                    <input name="radio" type="radio">
                                    <p>Poor</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script>
        var cm_id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function set_cm_id(id){
            cm_id=id;
        }

        function get_cm(type) {
            if(cm_id === '' || cm_id === null || cm_id === undefined || cm_id == null ){
                iziToast.warning({
                    position: 'topRight',
                    message: 'Please Select Category.',
                });
            }else{
                $.ajax({
                url: "{{ route('user.get-common-mistake') }}",
                data: {
                    'id': cm_id,
                    'type': type
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        $("#mistake_content").html(data.test.content);
                    } else {
                        iziToast.warning({
                            position: 'topRight',
                            message: data.test,
                        });
                    }
                }
            });
            }            
        }
    </script>
@endpush
