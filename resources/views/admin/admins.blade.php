@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Admins | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Admins</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal">
                            <i class='bx bx-cross'></i> Role
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adminModal">
                            <i class='bx bx-cross'></i> Admin
                        </button>
                    </div>
                    <div class="table-responsive text-nowrap card-body p-0" id="horizontal-example">
                        @if (count($admins) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>
                                                @if ($admin->admins_roles_id == 1)
                                                    <i class="fab fa-angular text-success fa-lg me-3"></i>
                                                @endif
                                                <strong>{{ $admin->username }}</strong>
                                            </td>
                                            <td> {{ $admin->first_name }} {{ $admin->last_name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->admins_roles->role }}</td>
                                            <td>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $admin->id }}"
                                                    onclick="delete_admin({{ $admin->id }})"><i
                                                        class='bx bxs-trash'></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $admin->id }}" hidden>
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="container d-flex justify-content-center">
                                <h1>No User Available</h1>
                            </div>
                        @endif
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3 mb-n3">
                        {{ $admins->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-admin') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="first_name" name="first_name"
                                            class="form-control form-control-lg" placeholder="First Name"
                                            value="{{ old('first_name') }}" required />
                                        <small class="text-danger">
                                            @error('first_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="last_name" name="last_name"
                                            class="form-control form-control-lg" placeholder="Last Name"
                                            value="{{ old('last_name') }}" required />
                                        <small class="text-danger">
                                            @error('last_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-outline">
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg" placeholder="Email"
                                            value="{{ old('email') }}" />
                                        <small class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-outline">
                                        <input type="text" id="username" name="username"
                                            class="form-control form-control-lg" placeholder="Username"
                                            value="{{ old('username') }}" required />
                                        <small class="text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <select id="public_private" name="role_id"
                                        class="form-select form-control-lg form-control"
                                        value="{{ old('public_private') }}" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">
                                        @error('public_private')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                                <div class="mb-4">
                                    <div class="form-outline">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" placeholder="Password"
                                            value="{{ old('username') }}" />
                                        <small class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Add Admin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-role') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="role_name">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name"
                                    value="{{ old('package_name') }}" placeholder="Enter Role Name" required>
                                <small class="text-danger">
                                    @error('role_name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="role_name">Allow</label>
                                <div class="row">
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_1" name="allow[]" value="1" required />
                                        <label class="form-label" for="allow_1">Dashboard</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_2" name="allow[]" value="2" />
                                        <label class="form-label" for="allow_2">Users</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_3" name="allow[]" value="3" />
                                        <label class="form-label" for="allow_3">Eassay</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_4" name="allow[]" value="4" />
                                        <label class="form-label" for="allow_4">Tutorials</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_5" name="allow[]" value="5" />
                                        <label class="form-label" for="allow_5">Packages</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_6" name="allow[]" value="6" />
                                        <label class="form-label" for="allow_6">Community</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_7" name="allow[]" value="7" />
                                        <label class="form-label" for="allow_7">Common Mistakes</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_8" name="allow[]" value="8" />
                                        <label class="form-label" for="allow_8">TIPS</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_9" name="allow[]" value="9" />
                                        <label class="form-label" for="allow_9">Admins</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_11" name="allow[]" value="11" />
                                        <label class="form-label" for="allow_11" style="font-size: 9px;">Withdraw Request
                                            Admin</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_10" name="allow[]" value="10" />
                                        <label class="form-label" for="allow_10">Withdraw Request</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_12" name="allow[]" value="12" />
                                        <label class="form-label" for="allow_12">Calendar</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="checkbox" id="allow_13" name="allow[]" value="13" />
                                        <label class="form-label" for="allow_12">Blog</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            function delete_admin(id) {
                $.ajax({
                    url: "{{ route('admin.delete-admin') }}",
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    beforeSend: function() {
                        $("#loading_btn_" + id).removeAttr('hidden');
                        $("#dlt_btn_" + id).hide();
                    },
                    success: function(data) {
                        if (data.success) {
                            iziToast.success({
                                position: 'topRight',
                                message: data.message,
                            });
                            window.location.reload();
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
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
