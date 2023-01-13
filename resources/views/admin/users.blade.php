@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Users | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet">
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden p-2">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Users</h3>
                        <form id="search_form" class="d-flex justify-content-center" method="POST">
                            @csrf
                            <div class="col-2">
                                <select class="form-select" name="s_gender" id="s_gender">
                                    <option value="">Gender</option>
                                    @php
                                        $genders = \App\Models\UserProfileModel::select('gender')
                                            ->orderBy('gender', 'asc')
                                            ->groupBy('gender')
                                            ->get();
                                    @endphp
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->gender }}">{{ $gender->gender }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-select" name="s_state" id="s_state">
                                    <option value="">State</option>
                                    @php
                                        $states = \App\Models\UserProfileModel::select('state')
                                            ->orderBy('state', 'asc')
                                            ->groupBy('state')
                                            ->get();
                                    @endphp
                                    @foreach ($states as $state)
                                        <option value="{{ $state->state }}">{{ $state->state }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-select" name="s_school_type" id="s_school_type">
                                    <option value="">School Type</option>
                                    @php
                                        $school_types = \App\Models\UserProfileModel::select('school_type')
                                            ->orderBy('school_type', 'asc')
                                            ->groupBy('school_type')
                                            ->get();
                                    @endphp
                                    @foreach ($school_types as $school_type)
                                        <option value="{{ $school_type->school_type }}">{{ $school_type->school_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-select" name="s_school_rank" id="s_school_rank">
                                    <option value="">School Rank</option>
                                    @php
                                        $school_ranks = \App\Models\UserProfileModel::select('school_rank')
                                            ->orderBy('school_rank', 'asc')
                                            ->groupBy('school_rank')
                                            ->get();
                                    @endphp
                                    @foreach ($school_ranks as $school_rank)
                                        <option value="{{ $school_rank->school_rank }}">{{ $school_rank->school_rank }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-select" name="s_current_year" id="s_current_year">
                                    <option value="">Current year</option>
                                    @php
                                        $current_years = \App\Models\UserProfileModel::select('current_year')
                                            ->orderBy('current_year', 'asc')
                                            ->groupBy('current_year')
                                            ->get();
                                    @endphp
                                    @foreach ($current_years as $current_year)
                                        <option value="{{ $current_year->current_year }}">
                                            {{ $current_year->current_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="button" id="reset" class="btn btn-primary" hidden
                                    onclick="reset_form()"><i class='bx bx-reset'></i></button>
                                <button type="submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i></button>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class='bx bx-user-plus' style="font-size: 20px"></i>
                        </button>
                    </div>
                    <table class="table p-0 text-nowrap card-body" id="horizontal-example">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>email</th>
                                <th>gender</th>
                                <th>state</th>
                                <th>school type</th>
                                <th>school rank</th>
                                <th>current year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3 mb-n3">

                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-user') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="state" name="state"
                                                    class="form-control form-control-lg" placeholder="State"
                                                    value="{{ old('state') }}" required />
                                                <small class="text-danger">
                                                    @error('state')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="city" name="city"
                                                    class="form-control form-control-lg" placeholder="City"
                                                    value="{{ old('city') }}" required />
                                                <small class="text-danger">
                                                    @error('city')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="zip_code" name="zip_code"
                                                    class="form-control form-control-lg" placeholder="Zip Code"
                                                    value="{{ old('zip_code') }}" required />
                                                <small class="text-danger">
                                                    @error('zip_code')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="current_year" name="current_year"
                                                    class="form-control form-control-lg" placeholder="Current Year"
                                                    value="{{ old('current_year') }}" readonly />
                                                <small class="text-danger">
                                                    @error('current_year')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="expected_graduation_date"
                                                    name="expected_graduation_date" class="form-control form-control-lg"
                                                    onfocus="(this.type='date')" placeholder="Expected Graduation Date"
                                                    value="{{ old('expected_graduation_date') }}" required />
                                                <small class="text-danger">
                                                    @error('expected_graduation_date')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="high_school_name" name="high_school_name"
                                                    class="form-control form-control-lg" placeholder="High School Name"
                                                    value="{{ old('high_school_name') }}" required />
                                                <small class="text-danger">
                                                    @error('high_school_name')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <select id="public_private" name="public_private"
                                                    class="form-select form-control-lg form-control"
                                                    value="{{ old('public_private') }}" required>
                                                    <option value="Public">Public</option>
                                                    <option value="Private">Private</option>
                                                </select>
                                                <small class="text-danger">
                                                    @error('public_private')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="school_rank" name="school_rank"
                                                    class="form-control form-control-lg" placeholder="School Rank"
                                                    value="{{ old('school_rank') }}" required />
                                                <small class="text-danger">
                                                    @error('school_rank')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <select id="demographic" name="demographic"
                                                    class="form-select form-control-lg form-control"
                                                    value="{{ old('demographic') }}" required>
                                                    <option hidden selected>Demographic</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Prefer to not Say">Prefer to not Say</option>
                                                </select>
                                                <small class="text-danger">
                                                    @error('demographic')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <select name="target_school" id="target_school"
                                                    class="form-select form-control-lg form-control"
                                                    value="{{ old('target_school') }}" required>
                                                    <option hidden selected>Target Schools</option>
                                                    <option value="ABC">ABC</option>
                                                    <option value="DEF">DEF</option>
                                                    <option value="GHI">GHI</option>
                                                </select>
                                                <small class="text-danger">
                                                    @error('target_school')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <select name="time_commitment" id="time_commitment"
                                                    class="form-select form-control-lg form-control"
                                                    value="{{ old('time_commitment') }}" required>
                                                    <option hidden selected>Time commitment</option>
                                                    <option value="hrs">hrs</option>
                                                    <option value="wk">wk</option>
                                                </select>
                                                <small class="text-danger">
                                                    @error('time_commitment')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="f_name" name="f_name"
                                                    class="form-control form-control-lg" placeholder="First name"
                                                    value="{{ old('f_name') }}" required />
                                                <small class="text-danger">
                                                    @error('f_name')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="l_name" name="l_name"
                                                    class="form-control form-control-lg" placeholder="Last name"
                                                    value="{{ old('l_name') }}" required />
                                                <small class="text-danger">
                                                    @error('l_name')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="username" name="username"
                                            class="form-control form-control-lg" placeholder="Username"
                                            value="{{ old('username') }}" required />
                                        <small class="text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                            @if (!empty($errorUsername))
                                                {{ $errorUsername }}
                                            @endif
                                        </small>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" placeholder="Password" required />
                                        <small class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control form-control-lg" placeholder="Confirm Password"
                                            required />
                                        <small class="text-danger">
                                            @error('password_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg" placeholder="Email"
                                            value="{{ old('email') }}" required />
                                        <small class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                            @if (!empty($errorEmail))
                                                {{ $errorEmail }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
        <script type="text/javascript">
            var table = $('#horizontal-example').dataTable({
                responsive: true,
            });
            $(document).ready(function() {
                $('#current_year').val(new Date().getFullYear());
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.get-users') }}",
                    success: function(users) {
                        if (users.length > 0) {
                            $.each(users, function(index, user) {
                                table.fnAddData([
                                    user.id,
                                    user.username,
                                    user.email,
                                    user.gender,
                                    user.state,
                                    user.school_type,
                                    user.school_rank,
                                    user.current_year,
                                    '<a href="/admin/user/' + user
                                    .id +
                                    '" class="edit btn btn-info btn-sm"><i class="fa fa-eye"></i></a> <a href="/admin/delete-user/' +
                                    user.id +
                                    '" class="edit btn btn-danger btn-sm"><i class="bx bxs-trash"></i></a>'
                                ]);
                            });
                        } else {
                            iziToast.warning({
                                position: 'topRight',
                                message: 'Record Not Found',
                            });
                        }

                    }
                });
            });

            $(function() {
                $("#search_form").on("submit", function(e) {
                    e.preventDefault();
                    $('#reset').removeAttr('hidden');
                    var form_data = $("#search_form").serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.search-users') }}",
                        data: form_data,
                        success: function(users) {
                            table.fnClearTable();
                            if (users.length > 0) {
                                $.each(users, function(index, user) {
                                    table.fnAddData([
                                        user.id,
                                        user.username,
                                        user.email,
                                        user.gender,
                                        user.state,
                                        user.school_type,
                                        user.school_rank,
                                        user.current_year,
                                        '<a href="/admin/user/' + user
                                        .id +
                                        '" class="edit btn btn-info btn-sm"><i class="fa fa-eye"></i></a> <a href="/admin/delete-user/' +
                                        user.id +
                                        '" class="edit btn btn-danger btn-sm"><i class="bx bxs-trash"></i></a>'
                                    ]);
                                });
                            } else {
                                iziToast.warning({
                                    position: 'topRight',
                                    message: 'Record Not Found',
                                });
                            }

                        }
                    });
                });

            });

            function reset_form() {
                $('#s_gender').prop('selectedIndex', 0);
                $('#s_state').prop('selectedIndex', 0);
                $('#s_school_type').prop('selectedIndex', 0);
                $('#s_school_rank').prop('selectedIndex', 0);
                $('#s_current_year').prop('selectedIndex', 0);
                $('#reset').attr('hidden', 'true');
            }
        </script>
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
