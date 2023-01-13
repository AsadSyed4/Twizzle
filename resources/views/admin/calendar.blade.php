@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Calendar | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Calendar</h5>
                        <a href="{{ route('admin.events') }}" class="btn btn-primary">List View</a>
                    </div>
                    <div class="card-body">
                        <div id='calendar' class="p-1"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" class="form-control" id="title" readonly>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" readonly></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="cat">Category</label>
                            <input type="text" class="form-control" id="cat" readonly>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="start">Start Date</label>
                            <input type="text" class="form-control" id="start" readonly>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="end">End Date</label>
                            <input type="text" class="form-control" id="end" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                // pass _token in all ajax
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // initialize calendar in all events
                var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    events: "{{ route('admin.calendar') }}",
                    displayEventTime: true,
                    eventRender: function(event, element, view) {
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                    },
                    selectHelper: true,
                    eventClick: function(event) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.get-event') }}",
                            data: {
                                id: event.id,
                            },
                            success: function(response) {
                                $('#title').val(response.title);
                                $('#description').text(response.description);
                                $('#cat').val(response.event_categories.name);
                                $('#start').val(response.start);
                                $('#end').val(response.end);
                                $('#eventModal').modal('show');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
