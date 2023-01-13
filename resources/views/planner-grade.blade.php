@extends('layouts.main')
@push('header')
    <title>Planner Grade | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('section')
    <div class="planner">
        <div class="container">
            <div class="planner_inner table_inner">
                <div class="r_heading_style l_heading_style">
                    <h1>PROGREss REPORT</h1>
                    <div class="bottom_style">
                        <span class="white_bg"></span>
                        <span class="black_bg"></span>
                    </div>
                </div>                
                <div class="table_btn_export">
                    <a class="planner_btn" href="{{ route('user.planner-grade') }}">Classes & Grades</a>
                    <a class="planner_btn table_btn_export_D"
                        href="{{ route('user.planner-extracurriculars') }}">Extracurriculars</a>
                </div>
                <table class="table">
                    <tr style="background-color: black !important;">
                        <th>ID</th>
                        <th>Year</th>
                        <th>Course title</th>
                        <th>Teacher name</th>
                        <th>Final grade</th>
                        <th>
                            Personal interest                            
                        </th>
                        <th>GPA</th>
                    </tr>
                    @php
                        $classes = \App\Models\StudentClassesGrades::where('users_id', '=', session()->get('user_id'))->get();
                    @endphp
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                            <td>{{ $class->year }}</td>
                            <td>{{ $class->course_title }}</td>
                            <td>{{ $class->teacher_name }}</td>
                            <td>{{ $class->final_grade }}</td>
                            <td>
                                <div>
                                    <h2>{{ $class->interest }}</h2>                                    
                                </div>
                            </td>
                            <td>{{ $class->gpa }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="table_btn_export">
                    <a class="planner_btn export" href="javascript:void(0)">Add new</a>
                    <a class="planner_btn" href="{{ route('user.export-classes') }}">Export</a>
                </div>
            </div>
        </div>
    </div>
    <div class="addnew">
        <div class="box">
            <i class="fal addnew_pop_btn fa-times-circle"></i>
            <h1>add new</h1>
            <form action="{{ route('user.add-planner-grade') }}" method="POST">
                @csrf
                <span>
                    <label for="Year">Year</label>
                    <div>
                        <select id="Year" name="year">
                            <option value="Sophomore">Sophomore</option>
                            <option value="Senior">Senior</option>
                            <option value="Junior">Junior</option>
                            <option value="Freshman">Freshman</option>
                        </select>
                        <i class="fas fa-caret-down"></i>
                    </div>
                </span>
                <span>
                    <label for="course_title">Course title</label>
                    <input type="text" id="course_title" placeholder="Course Title" name="course_title">
                </span>
                <span>
                    <label for="teacher_name">Teacher name</label>
                    <input type="text" id="teacher_name" placeholder="Teacher name" name="teacher_name">
                </span>
                <span class="row_span">
                    <span>
                        <label for="final_grade">Final grade</label>
                        <input type="text" id="final_grade" placeholder="Grade" max="1" name="final_grade">
                    </span>
                    <span>
                        <label for="Final grade">GPA</label>
                        <div>
                            <select id="Final grade" name="gpa">
                                <option value="1.0">1.0 GPA</option>
                                <option value="1.5">1.5 GPA</option>
                                <option value="2.0">2.0 GPA</option>
                                <option value="2.5">2.5 GPA</option>
                                <option value="3.0">3.0 GPA</option>
                                <option value="3.5">3.5 GPA</option>
                                <option value="4.0">4.0 GPA</option>
                            </select>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </span>
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
                <button class="planner_btn">Confirm</button>
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
