@extends('layouts.main')
@push('header')
    <title>Planner Extracurriculars | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('section')
    <!-- =========================== planner =========================== -->
    <div class="planner">
        <div class="container">
            <div class="planner_inner planner_ex_inner table_inner">
                <div class="r_heading_style l_heading_style">
                    <h1>PROGREss REPORT</h1>
                    <div class="bottom_style">
                        <span class="white_bg"></span>
                        <span class="black_bg"></span>
                    </div>
                </div>
                <div class="table_btn_export">
                    <a class="planner_btn table_btn_export_F" href="{{ route('user.planner-grade') }}">Classes & Grades</a>
                    <a class="planner_btn" href="{{ route('user.planner-extracurriculars') }}">Extracurriculars</a>
                </div>
                <table class="table">
                    <tr style="background-color: #A9A9A9 !important;">
                        <th>ID</th>
                        <th>Organization</th>
                        <th>Duties & responsibilities</th>
                        <th>
                            Personal interest                            
                        </th>
                    </tr>
                    @php
                        $extras = \App\Models\StudentExtraCurriculars::where('users_id', '=', session()->get('user_id'))->get();
                    @endphp
                    @foreach ($extras as $extra)
                        <tr>
                            <td>{{ $extra->id }}</td>
                            <td>{{ $extra->organization }}</td>
                            <td>{{ $extra->duties_responsibilities }}</td>
                            <td>                                
                                <h2>{{ $extra->interest }}</h2>                                
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div class="table_btn_export">
                    <a class="planner_btn export2" href="javascript:void(0)">Add new</a>
                    <a class="planner_btn" href="{{ route('user.export-extra') }}">Export</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ==================== POP PAGE ======================= -->
    <div class="addnew addnew2">
        <div class="box">
            <i class="fal addnew_pop_btn fa-times-circle"></i>
            <h1>add new</h1>
            <form action="{{ route('user.add-planner-extracurriculars') }}" method="POST">
                @csrf
                <span>
                    <label for="organization">Organization</label>
                    <input type="text" placeholder="Organization" id="organization" name="organization">
                </span>
                <span>
                    <label for="duties_responsibilities">Duties and responsibilities</label>
                    <textarea name="duties_responsibilities" id="duties_responsibilities"
                        placeholder="Duties and responsibilities"></textarea>
                </span>
                <span>
                    <label for="Personal Interest">Personal interest</label>
                    <div class="select">
                        <ul>
                            <li>
                                <h2>Interest</h2>
                            </li>
                        </ul>
                        <ul>
                            <li><input name="interest" type="radio" value="Low">
                                <h3>Low</h3>
                            </li>                            
                        </ul>
                        <ul>
                            <li><input name="interest" type="radio" value="Medium">
                                <h3>Medium</h3>
                            </li>
                        </ul>
                        <ul>
                            <li><input name="interest" type="radio" value="High">
                                <h3>High</h3>
                            </li>
                        </ul>
                    </div>
                </span>
                <button type="submit" class="planner_btn" style="margin-top: 0px;">Confirm</button>
            </form>
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
    </script>
@endpush
