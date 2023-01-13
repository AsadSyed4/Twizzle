@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Admin Profile | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @section('section')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.update-profile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('/uploads/'.session()->get('admin.media')) }}" alt="user-avatar" class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar" onerror="this.onerror=null;this.src='{{ asset('admin/assets/img/avatars/error.png') }}'"/>
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="upload" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" onchange="readURL(this);"/>
                                        </label>                                        
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">                            
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input class="form-control" type="text" id="firstName" name="firstName"
                                                value="{{ session()->get('admin.f_name') }}" autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input class="form-control" type="text" name="lastName" id="lastName"
                                                value="{{ session()->get('admin.l_name') }}" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="email" id="email" name="email"
                                                value="{{ session()->get('admin.email') }}" placeholder="john.doe@example.com" readonly/>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ session()->get('admin.username') }}" readonly/>
                                            <small></small>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter New Password" autocomplete="off"/>
                                            <small class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </small>                                       
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                                placeholder="Enter New Password Again" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                            </div>
                        </form>
                        <!-- /Account -->
                    </div>
                    <div class="card">
                        <h5 class="card-header">Delete Account</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?
                                    </h6>
                                    <p class="mb-0">Once you delete your account, there is no going back. Please be
                                        certain.</p>
                                </div>
                            </div>
                            <form id="formAccountDeactivation" action="{{ route('admin.delete-profile') }}" method="POST">
                                @csrf
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="accountActivation"
                                        id="accountActivation" name="accountActivation" required/>
                                    <label class="form-check-label" for="accountActivation">I confirm my account
                                        deactivation</label>
                                </div>
                                <input type="hidden" value="{{ session()->get('admin.id') }}" name="id"/>
                                <button type="submit" class="btn btn-danger deactivate-account">Deactivate
                                    Account</button>
                            </form>
                        </div>
                    </div>
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

            function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#uploadedAvatar')
                        .attr('src', e.target.result);                        
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        </script>
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
