@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>{{ $user->username }} | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y justify-content-center">
                <div class="col-6">
                    <div class="card h-100">
                      <div class="card-body">
                        <h3 class="card-title">{{ $user->user_profile->f_name }} {{ $user->user_profile->l_name }}</h3>
                        <h6 class="card-subtitle text-muted">{{ $user->email }} ({{ $user->username }})</h6>
                      </div>
                      <img class="img-fluid" src="{{ asset('uploads/users/'.$user->user_profile->media) }}" alt="Card image cap" onerror="this.src='{{ asset('admin/assets/img/elements/5.jpg') }}'"/>
                      <div class="card-body">
                        <p class="card-text">
                            <Address>{{ $user->user_profile->city }},{{ $user->user_profile->state }},{{ $user->user_profile->zip }}</Address>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Gender</b>: {{ $user->user_profile->gender }}
                                </div>
                                <div class="col-md-8">
                                    <b>High School name</b>: {{ $user->user_profile->high_school_name }}
                                </div>    
                            </div>                            
                        </p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
