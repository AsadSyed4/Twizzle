@extends('layouts.main')
@push('header')
    <title>Common App Journal | Twizzle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('section')
    <div class="app">
        <div class="container">
            <div class="app_inner">
                <div class="r_heading_style l_heading_style">
                    <h1>Common App</h1>
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                        <span>Journal</span>
                    </div>
                </div>
                <div class="entry">
                    <div class="left_side">
                        @php
                            $journal=\App\Models\UsersJournal::where('id','=',$id)->first();                            
                        @endphp
                        <form class="box" id="my_form" action="{{ url('/edit-journal') }}" method="POST">
                            @csrf
                            <span>
                                <h3>Journal</h3>
                                <input type="hidden" value="{{ $id }}" name="id"/>
                                <a class="planner_btn" onclick="document.getElementById('my_form').submit();">Update</a>
                            </span>                            
                            <input id="name" name="name" value="{{ $journal->title }}" type="text" style="padding: 2%;border-radius: 5px;border: 2px solid #D5DAE1;background: rgba(255, 255, 255, 0.95);font-style: normal;font-family: 'AvantGarde Bk BT';letter-spacing: 0.02em;color: #0B0519;width: 95.5%;margin-top: 20px;"
                                placeholder="This journal is only for you. Give it a title that is easy to remember and most intuitive." required>
                            <textarea name="description" id="description" placeholder="Write your journal">{{ $journal->description }}</textarea>                            
                        </form>
                    </div>
                    <div class="right_side">
                        <h3>Your Journals</h3>
                        <div class="box">
                            <ul>
                                @foreach ($journals as $journal)
                                    <li>
                                        <h4><a href="{{ url('/journal/'.$journal->id) }}" style="text-decoration: none;">{{ $journal->title }}</a></h4>
                                        <span>
                                            <h4>{{ formatted_date($journal->created_at, 'd-M-Y') }}</h4>
                                            <i class="far fa-trash-alt" onclick="delete_journal({{ $journal->id }})"></i>
                                        </span>
                                    </li>
                                @endforeach
                                <a class="planner_btn export3" href="javascript:void(0)">Export</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==================== POP PAGE ======================= -->
    <div class="addnew backup">
        <div class="box">
            <i class="fal addnew_pop_btn fa-times-circle"></i>
            <h1>Back Up</h1>
            <form action="{{ route('user.backup-journal') }}" method="POST">
                @csrf
                <span>
                    <label for="Course title">How would you like to back up?</label>
                    <div>
                        <ul>
                            <li>
                                <input name="back_up" type="radio" value="1">
                                <h3>Top Smart</h3>
                            </li>
                            <li>
                                <input name="back_up" type="radio" value="2">
                                <h3>Email</h3>
                            </li>
                            <li>
                                <input name="back_up" type="radio" value="3">
                                <h3>Both</h3>
                            </li>
                        </ul>
                    </div>
                </span>
                <button class="planner_btn" type="submit">Confirm</button>
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

        function delete_journal(id) {
            $.ajax({
                url: "{{ route('user.delete-journal') }}",
                data: {
                    'id': id,
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            position: 'topRight',
                            message: data.message,
                        });
                        window.location.reload();
                    } else {
                        iziToast.console.error({
                            position: 'topRight',
                            message: data.message,
                        });
                    }
                }
            });
        }
    </script>
@endpush
