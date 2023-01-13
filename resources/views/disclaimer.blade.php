@extends('layouts.main')
@push('header')
    <title>Disclaimer | Twizzle</title>
@endpush
@section('section')
    <!-- ========================== MIssions Values ================== -->
    <div class="about_us_heading">
        <div class="container">
            <div class="about_us_heading_inner">
                <h1>Disclaimer</h1>
            </div>
        </div>
    </div>
    <!-- =========================== Missions ======================== -->
    <div class="about_us_mission">
        <div class="container">
            <div name="termly-embed" data-id="f1ea03de-d437-4dbf-abce-329635b167bd" data-type="iframe"></div>
            <script type="text/javascript">
                (function(d, s, id) {
                    var js, tjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://app.termly.io/embed-policy.min.js";
                    tjs.parentNode.insertBefore(js, tjs);
                }(document, 'script', 'termly-jssdk'));
            </script>
        </div>
    </div>
@endsection
@push('footer')
@endpush
