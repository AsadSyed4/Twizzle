@extends('layouts.main')
@push('header')
    <title>Terms Of Use | Twizzle</title>
@endpush
@section('section')
    <!-- ========================== MIssions Values ================== -->
    <div class="about_us_heading">
        <div class="container">
            <div class="about_us_heading_inner">
                <h1>Terms Of Use</h1>
            </div>
        </div>
    </div>
    <div name="termly-embed" data-id="1ad5af5e-928b-4d32-a34a-b15add43a727" data-type="iframe"></div>
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
@endsection
@push('footer')
@endpush
