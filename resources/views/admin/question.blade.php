@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Community Questions | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Community Questions</h5>
                        @if (session()->get('admin.role') == 'Super Admin')
                            <form id="search_form" class="row d-flex justify-content-around" action="{{ route('admin.community-questions-search') }}" method="POST">
                                @csrf
                                <div class="col-2">
                                    <select class="form-select" name="s_user" id="s_user">
                                        <option value="">Users</option>
                                        @php
                                            $users = \App\Models\UserModel::orderBy('created_at', 'desc')->get();
                                        @endphp
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-select" name="s_admin" id="s_admin">
                                        <option value="">Admins</option>
                                        @php
                                            $admins = \App\Models\Admins::where('admins_roles_id', '=', 1)
                                                ->orderBy('created_at', 'desc')
                                                ->get();
                                        @endphp
                                        @foreach ($admins as $admin)
                                            <option value="{{ $admin->id }}">{{ $admin->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-select" name="s_type" id="s_type">
                                        <option value="">Types</option>
                                        @php
                                            $types = \App\Models\CommunityQuestionTypesModel::orderBy('created_at', 'desc')->get();
                                        @endphp
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->question_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-select" name="s_status" id="s_status">
                                        <option value="">Status</option>
                                        <option value="Open">Open</option>
                                        <option value="Closed">Closed</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" name="s_title" id="s_title"
                                        placeholder="Type here" />
                                </div>
                                <div class="col-2">
                                    <button type="button" id="reset" class="btn btn-primary" hidden
                                        onclick="reset_form()"><i class='bx bx-reset'></i></button>
                                    <button type="submit" class="btn btn-primary"><i
                                            class='bx bx-search-alt-2'></i></button>
                                </div>
                            </form>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#questionModal">
                                <i class='bx bx-cross'></i>
                            </button>
                        @endif
                    </div>
                    @if (count($questions) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Media</th>
                                        <th>Question Type</th>
                                        <th>status</th>
                                        <th>Submitted</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                @if (!is_null($question->users))
                                                    {{ $question->users->username }}
                                                @else
                                                    {{ $question->admins->username }}
                                                @endif
                                            </td>
                                            <td>{{ $question->title }}</td>
                                            <td>{{ $question->description }}</td>
                                            <td><img src="{{ asset('uploads/' . $question->media) }}" class="img-thumbnail w-px-40 h-auto"
                                                    alt=""></td>
                                            <td>{{ $question->community_question_types->question_type }}</td>
                                            <td>
                                                <div class="w-100">
                                                    <select id="question_{{ $question->id }}" name="question_type"
                                                        class=" form-control"
                                                        onchange="change_status({{ $question->id }})">
                                                        <option value="Open"
                                                            @if ($question->status == 'Open') selected @endif>Open
                                                        </option>
                                                        <option value="Pending"
                                                            @if ($question->status == 'Pending') selected @endif>Pending
                                                        </option>
                                                        <option value="Closed"
                                                            @if ($question->status == 'Closed') selected @endif>Closed
                                                        </option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>{{ time_diffrence($question->created_at) }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="container d-flex justify-content-center">
                            <h5>No Questions Available</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $questions->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        @if (session()->get('admin.role') == 'Super Admin')
            <div class="modal fade" id="questionModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.ask') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-outline mb-3">
                                        <input type="text" id="title" name="title" class="form-control"
                                            value="{{ old('title') }}" placeholder="Enter Title" required />
                                        <small class="text-danger">
                                            @error('title')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>

                                    <div class="form-outline mb-3">
                                        <textarea id="description" name="description" class="form-control" placeholder="Enter Description" required></textarea>
                                        <small class="text-danger">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <select id="question_type" name="question_type" class=" form-control" required>
                                            @foreach ($question_types as $question_type)
                                                <option value="{{ $question_type->id }}">
                                                    {{ $question_type->question_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">
                                            @error('question_type')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>

                                    <div class="form-outline mb-3">
                                        <input type="file" class="form-control" name="question_media"
                                            id="question_media" placeholder="Upload Eassy" accept=".png,.jpg">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endsection
    @push('footer')
        <script>
            function change_status(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.change-status') }}",
                    data: {
                        'question_id': id,
                        'status': $('#question_' + id + ' option:selected').val()
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data.success) {
                            iziToast.success({
                                position: 'topRight',
                                message: data.message,
                            });
                        } else {
                            iziToast.error({
                                position: 'topRight',
                                message: data.message,
                            });
                        }
                    }
                });
            }

            function reset_form() {
                $('#s_user').prop('selectedIndex', 0);
                $('#s_admin').prop('selectedIndex', 0);
                $('#s_type').prop('selectedIndex', 0);
                $('#s_status').prop('selectedIndex', 0);
                $('#s_title').val('');
                $('#reset').attr('hidden', 'true');
            }
        </script>
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
