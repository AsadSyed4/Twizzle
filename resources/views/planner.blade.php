@extends('layouts.main')
@push('header')
    <title>Planning | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('section')
    <div class="planner planner_desire">
        <div class="container">
            <div class="planner_inner">
                <div class="r_heading_style l_heading_style">
                    <h1>Activity Planner</h1>
                    <div class="bottom_style">
                        <span class="white_bg"></span>
                        <span class="black_bg"></span>
                    </div>
                </div>

                <div class="interest">
                    <div class="right">
                        <ol>
                            <h2>Tips for all students</h2>
                            <p>
                                In addition to achievements in school, accomplishments outside of school are a major
                                component of a competitive package. Here are 4 tips that will help.
                            </p>
                            <li>
                                <span>Building a website:</span> Whatever your interest, having a website to act as a
                                launchpad for
                                all of your related activities is an efficient way to put forward your accomplishments.
                            </li>
                            <li>
                                <span>Starting a club:</span> Starting a club, managing it, and documenting its
                                continued growth and
                                success is an activity that is viewed favorably no matter what. But being the founder of
                                a successful club in your stated interest will have even more impact in proving your
                                leadership acumen.
                            </li>
                            <li>
                                <span>Community outreach:</span> Volunteer work and community outreach are amazing
                                things to include
                                in your package because they clearly illustrate your desire to do more. If your outreach
                                ties back to your stated interest, then you will further improve the effectiveness of
                                your application.
                            </li>
                            <li>
                                <span>Integrating activities:</span> You can integrate all three activities to further
                                strengthen
                                your case. You can start a club with a website listing its activities including
                                community outreach. If you are a freshman or sophomore, and you are serious about
                                getting into a top school, you have more than enough time to build every component of
                                this out fully. If you are a junior, then you may want to add in a competition or
                                conference related to your stated interest.
                            </li>
                        </ol>
                    </div>
                    <form class="left" action="{{ route('user.planner-date') }}" method="POST" id="form">
                        @csrf
                        <div class="box_outer">
                            <div class="box">
                                <p>
                                    <input name="check_event" type="radio" value="1" checked>
                                    I already have a definite interest. I would like to know how to prepare for a
                                </p>
                                <div class="checkboxes">
                                    @php
                                        $evet_cats = \App\Models\EventCategories::all();
                                    @endphp
                                    @foreach ($evet_cats as $evet_cat)
                                        <p>
                                            <input type="checkbox" name="cat[]" value="{{ $evet_cat->id }}">
                                            {{ $evet_cat->name }}
                                        </p>
                                    @endforeach
                                </div>
                                <p>
                                    <input name="check_event" type="radio" value="2">
                                    I am currently undecided. I would like to know of all upcoming events and
                                    opportunities
                                    that
                                    are available to students
                                </p>
                            </div>
                        </div>
                        <button type="submit" class="planner_btn" style="border: 0">Submit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script>
        var check=1;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#form input').on('change', function() {
                check = $('input[name=check_event]:checked', '#form').val();
                if (check == 2) {
                    $("input[name='cat[]']").attr("disabled", true);
                    $("input[name='cat[]']").attr("required", true);
                } else {
                    $("input[name='cat[]']").removeAttr("disabled");
                    $("input[name='cat[]']").removeAttr("required");
                }
            });
        });

        $('#form').submit(function() {
            if (check == 1) {
                if ($('input:checkbox', this).is(':checked')) {
                    return true;
                } else {
                    iziToast.warning({
                        position: 'topRight',
                        message: 'Please Select Event.',
                    });
                    return false;
                }
            }
        });
    </script>
@endpush
