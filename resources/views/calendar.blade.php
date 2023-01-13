@extends('layouts.main')
@push('header')
    <title>Calendar | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <style>
        .fc-view {
            margin-top: -1.5%;
        }

        .fc-month-view {
            margin-top: -1.5%;
        }

        .fc-basic-view {
            margin-top: -1.5%;
        }

        .fc-toolbar {
            background: black;
            padding: 15px 20px;
            font-style: normal;
            font-weight: 700;
            font-size: 23.1749px;
            color: white;
            justify-content: space-between;
        }

        .fc-header-toolbar {
            background: black;
            padding: 15px 20px;
            font-style: normal;
            font-weight: 700;
            font-size: 23.1749px;
            color: white;
            justify-content: space-between;
        }

        .fc-head-container {
            padding: 27px 0px;
            background: #F7F7F7;
            font-style: normal;
            font-weight: 700;
            font-size: 23.1749px;
        }

        .fc-widget-header {
            padding: 27px 0px;
            background: #F7F7F7;
            font-style: normal;
            font-weight: 700;
            font-size: 23.1749px;
        }

        tr:first-child>td>.fc-day-grid-event {
            margin-top: 2px;
            background-color: transparent;
            border: 0;
        }


        .fc-content {
            position: relative;
            z-index: 2;
            background-color: #21DBB6 !important;
            border: 0;
            border-radius: 16px;
            font-weight: 400;
            font-size: 18px;
            letter-spacing: 0.02em;
            padding: 2px;
            padding-left: 4px;
        }

        .fc-event {
            position: relative;
            z-index: 2;
            background-color: #21DBB6 !important;
            border: 0;
            border-radius: 16px;
            font-weight: 400;
            font-size: 18px;
            letter-spacing: 0.02em;
            padding: 2px;
            padding-left: 4px;
        }
    </style>
@endpush
@push('btn')
    <li>
        <button class="btn btn-outline-info" onclick="download_event()" style="margin-right: 5px">Export events</button>
    </li>
@endpush
@section('section')
    <div class="calendar">
        <div class="container">
            <div class="calendar_inner">
                <div class="heading_c" style="display: flex;justify-content: space-between;">
                    <h1 class="h1heading">MY CALENDAR</h1>
                    <style>
                        .schedule {
                            display: inline-block;
                            padding: 15px 35px;
                            font-family: 'AvantGarde Bk BT';
                            font-style: normal;
                            font-weight: 700;
                            font-size: 23.1749px;
                            letter-spacing: 0.02em;
                            color: #FFFFFF;
                            background: #A46EF7;
                            box-shadow: 0.391688px 0.783376px 6.6587px rgba(0, 0, 0, 0.25);
                            border-radius: 16px;
                            text-decoration: none;
                        }

                        .schedule i {
                            font-size: 20px;
                            color: #FFFFFF;
                            margin-right: 10px;
                        }
                    </style>
                    <ul>
                        <li><a class="schedule" href="javascript:void(0)"><i class="fas fa-plus-circle"></i> Add
                                schedule</a></li>
                    </ul>
                </div>

                <div class="calendar_container" id="calendar">
                </div>

                <div class="calendar_info">
                    <ul>
                        <li><span class="blue_color"></span>Today</li>
                        <li><span class="green_color"></span>Event</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="schedule_pop">
        <form id="form" class="box" action="{{ route('calendar.create') }}" method="POST">
            @csrf
            <i class="fal login_pop_btn fa-times-circle"></i>
            <div class="field">
                <span>
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" placeholder="Call at ....">
                </span>
            </div>
            <div class="field">
                <span class="checkbox_box">
                    <input name="etype" id="event" type="radio" value="Event" checked>
                    <label for="event" style="margin-left: -27%;margin-top: -12%;">Event</label>
                </span>
                <span class="checkbox_box">
                    <input name="etype" id="task" type="radio" value="Task">
                    <label for="task" style="margin-left: -27%;margin-top: -12%;">Task</label>
                </span>
                <span class="checkbox_box">
                    <input name="etype" id="reminder" type="radio" value="Reminder">
                    <label for="reminder" style="margin-left: -27%;margin-top: -12%;">Reminder</label>
                </span>
            </div>
            <div class="field">
                <span>
                    <label for="start_date">Start date</label>
                    <input id="start_date" name="start_date" type="date" placeholder="Call at ...."
                        onchange="setMinOfEndDate()">
                </span>
                <span>
                    <label for="start_time">Time</label>
                    <input id="start_time" name="start_time" type="time" placeholder="Call at ....">
                </span>
            </div>
            <div class="field">
                <span>
                    <label for="end_date">End date</label>
                    <input id="end_date" name="end_date" type="date" placeholder="Call at ....">
                </span>
                <span>
                    <label for="end_time">Time</label>
                    <input id="end_time" name="end_time" type="time" placeholder="Call at ....">
                </span>
            </div>
            <div class="field">
                <span class="checkbox_box">
                    <input id="current_day" name="current_day" type="checkbox" value="1">
                    <label for="current_day">All Day</label>
                </span>
            </div>
            <div class="field">
                <span>
                    <label for="description">Description</label>
                    <textarea id="description" name="description"></textarea>
                </span>
            </div>
            <button class="title_btn">Save</button>
        </form>
    </div>

    <div class="schedule_pop1" id="edit_event">
        <div class="box">
            <i class="fal login_pop_btn fa-times-circle"></i>
            <div class="field">
                <span>
                    <label for="title">Title</label>
                    <input id="e_title" type="text" placeholder="Call at ...." readonly>
                </span>
            </div>
            <div class="field">
                <span class="checkbox_box">
                    <input name="etype" id="e_event" type="radio" value="Event" disabled>
                    <label for="event" style="margin-left: -27%;margin-top: -12%;">Event</label>
                </span>
                <span class="checkbox_box">
                    <input name="etype" id="e_task" type="radio" value="Task" disabled>
                    <label for="task" style="margin-left: -27%;margin-top: -12%;">Task</label>
                </span>
                <span class="checkbox_box">
                    <input name="etype" id="e_reminder" type="radio" value="Reminder" disabled>
                    <label for="reminder" style="margin-left: -27%;margin-top: -12%;">Reminder</label>
                </span>
            </div>
            <div class="field">
                <span>
                    <label for="start_date">Start date</label>
                    <input id="e_start_date" type="date" placeholder="Call at ...." readonly>
                </span>
                <span>
                    <label for="start_time">Time</label>
                    <input id="e_start_time" type="time" placeholder="Call at ...." readonly>
                </span>
            </div>
            <div class="field">
                <span>
                    <label for="end_date">End date</label>
                    <input id="e_end_date" type="date" placeholder="Call at ...." readonly>
                </span>
                <span>
                    <label for="end_time">Time</label>
                    <input id="e_end_time" type="time" placeholder="Call at ...." readonly>
                </span>
            </div>
            <div class="field">
                <span>
                    <label for="description">Description</label>
                    <textarea id="e_description" readonly></textarea>
                </span>
            </div>
            <form id="form" action="{{ route('calendar.destroy') }}" method="POST">
                @csrf
                <input type="hidden" id="e_id" name="e_id">
                <button type="submit" class="title_btn">Delete</button>
            </form>
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
                events: "{{ route('calendar.index') }}",
                displayEventTime: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");

                    $.ajax({
                        url: "{{ route('calendar.edit') }}",
                        data: {
                            start: start,
                            end: end,
                            id: event.id,
                        },
                        type: "POST",
                        success: function(response) {
                            if (response.success) {
                                iziToast.success({
                                    position: 'topRight',
                                    message: response.message,
                                });
                            } else {
                                iziToast.error({
                                    position: 'topRight',
                                    message: response.message,
                                });
                            }
                        }
                    });
                },
                eventClick: function(event) {
                    $.ajax({
                            type: "post",
                            url: "{{ route('calendar.get-event') }}",
                            data: {
                                id: event.id,                                
                            },
                            success: function(response) {
                                if (response.success) {
                                    var single_event=response.event;
                                    // calendar.fullCalendar('removeEvents', event.id);
                                    $("#e_title").val(single_event.title);
                                    if(single_event.type=="Event"){
                                        $('#e_event').attr('checked',true);
                                    }else if (single_event.type=="Task") {
                                        $('#e_task').attr('checked',true);
                                    }else{
                                        $('#e_reminder').attr('checked',true);
                                    }                                    
                                    $("#e_start_date").val(single_event.start.substring(0,10));
                                    $("#e_start_time").val(single_event.start.substring(11,16));
                                    $("#e_end_date").val(single_event.end.substring(0,10));
                                    $("#e_end_time").val(single_event.end.substring(11,16));
                                    $('#e_description').val(single_event.description);
                                    $('#e_id').val(single_event.id);
                                } else {
                                    iziToast.error({
                                        position: 'topRight',
                                        message: response.message,
                                    });
                                }
                            }
                        });
                    $('#edit_event').fadeIn();                    
                }
            });
        });

        function download_event() {
            $.ajax({
                url: "{{ route('calendar.download') }}",
                type: 'POST',
                success: function(data) {
                    console.log(data);
                }
            });
        }

        $(document).ready(function() {
            $('#form input').on('change', function() {
                var check = $('input[name=current_day]:checked', '#form').val();
                if (check == 1) {
                    $("input[name='start_date']").attr("disabled", true);
                    $("input[name='start_time']").attr("disabled", true);
                    $("input[name='end_date']").attr("disabled", true);
                    $("input[name='end_time']").attr("disabled", true);
                } else {
                    $("input[name='start_date']").removeAttr("disabled");
                    $("input[name='start_time']").removeAttr("disabled");
                    $("input[name='end_date']").removeAttr("disabled");
                    $("input[name='end_time']").removeAttr("disabled");
                }
            });
        });

        function setMinOfEndDate() {
            $('#end_date').val('').attr('type', 'text').attr('type', 'date');
            var date = new Date($('#start_date').val());
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            $('#end_date').attr('min',year+"-"+month+"-"+day);
        }
    </script>
@endpush
