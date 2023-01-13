@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Events | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Events</h5>
                        <a href="{{ route('admin.calendar-view') }}" class="btn btn-primary">Calendar View</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($events) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Usernaem</th>
                                        <th>Title</th>                                        
                                        <th>Category</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->admins->username }}</td>
                                            <td>{{ $event->title }}</td>                                            
                                            <td>{{ $event->event_categories->name }}</td>
                                            <td>{{ $event->start }}</td>
                                            <td>{{ $event->end }}</td>
                                            <td>
                                                <button class="btn btn-info"
                                                    onclick="view_event({{ $event->id }})"><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $event->id }}"
                                                    onclick="delete_event({{ $event->id }})"><i class='bx bxs-trash'></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $event->id }}" hidden>
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="container d-flex justify-content-center">
                            <h5>Events Not Added Yet</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $events->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-event') }}" method="Post">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title" value="{{ old('name') }}" required>
                                <small class="text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Type here"></textarea>
                                <small class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="cat">Category</label>
                                <select class="form-select" id="cat" name="cat" required>
                                    @foreach ($event_categories as $event_category)
                                        <option value="{{ $event_category->id }}">{{ $event_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="start">Start Date</label>
                                <input type="date" class="form-control" id="start" name="start"
                                    placeholder="Enter Name" value="{{ old('start') }}" min="{{ date('m-d-Y') }}"
                                    required>
                                <small class="text-danger">
                                    @error('start')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="end">End Date</label>
                                <input type="date" class="form-control" id="end" name="end"
                                    min="{{ date('m-d-Y') }}" placeholder="Enter Name" value="{{ old('end') }}"
                                    required>
                                <small class="text-danger">
                                    @error('end')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="singleEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" class="form-control" id="stitle" readonly>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="sdescription" readonly></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="cat">Category</label>
                            <input type="text" class="form-control" id="scat" readonly>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="start">Start Date</label>
                            <input type="text" class="form-control" id="sstart" readonly>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="end">End Date</label>
                            <input type="text" class="form-control" id="send" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            function delete_event(id) {
                $.ajax({
                    url: "{{ route('admin.delete-event') }}",
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

            function view_event(id) {
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.get-event') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#stitle').val(response.title);
                        $('#sdescription').text(response.description);
                        $('#scat').val(response.event_categories.name);
                        $('#sstart').val(response.start);
                        $('#send').val(response.end);
                        $('#singleEventModal').modal('show');
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
