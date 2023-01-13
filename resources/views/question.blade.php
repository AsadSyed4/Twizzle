@extends('layouts.main')
@section('section')
    @push('header')
    <meta name="title" property='og:title' content="{{ $question->title }}" />
        <meta name="description" property='og:description' content="{{ $question->description }}" />
        <link rel="image_src" property='og:image' href="{{ asset('uploads/'.$question->media) }}" />
        <meta property='og:url' content='{{ url('/question/'.$question->id) }}' />
        <title>
            {{ $question->title }} | Twizzle</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
    @push('body')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v15.0&appId=835472887906283&autoLogAppEvents=1" nonce="2KLg7Uhu"></script>
    @endpush
    @php
        $view = $question->views;
        \App\Models\CommunityQuestionsModel::where('id', '=', $question->id)->update(['views' => $view + 1]);
    @endphp
    <div class="blogs">
        <div class="container">
            <div class="blogs_inner cummunity_inner">
                <div class="heading">
                    <h1 class="h1heading">Community</h1>
                </div>
                <div class="blogs_posts">

                    <div class="filter">
                        <form class="search" action="{{ route('user.community-search-by-name') }}" method="POST">
                        @csrf
                            <input type="text" placeholder="Search" name="name">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <form action="{{ route('user.community-search-by-categories') }}" method="POST">
                            @csrf
                            <div class="category">
                            <h2>Categories</h2>
                            @foreach ($question_types as $question_type)
                                <label for="{{ $question_type->id }}">
                                    <input id="{{ $question_type->id }}" type="checkbox" name="selected[]"
                                        value="{{ $question_type->id }}"
                                        onclick="this.form.submit()"@if (!is_null($selected) && in_array($question_type->id, $selected)) checked @endif>
                                    <h3 onclick="this.form.submit()">{{ $question_type->question_type }}</h3>
                                </label>
                            @endforeach
                            </div>                        
                            <div class="category">
                                <h2>Sort By</h2>
                                <div class="select">
                                    <select name="sort" onchange="this.form.submit()">
                                        <option value="" hidden>Sort by</option>
                                        <option value="newest" @selected($sort=='newest')>Newest</option>
                                        <option value="oldest" @selected($sort=='oldest')>Oldest</option>   
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        </form>
                        <form class="category">
                            <h2>
                                Applied Filters
                                @if (!empty($selected))
                                    <span class="clear_all">
                                        Clear All
                                        <i class="far fa-times"></i>
                                    </span>
                                @endif
                            </h2>
                            <div class="select_category">
                                @foreach ($question_types as $question_type)
                                    @if (!is_null($selected) && in_array($question_type->id, $selected))
                                        <span>{{ $question_type->question_type }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </form>
                    </div>

                    <div class="posts cummunity cummunity_single_product cummunity_thread">
                        <div class="col">
                            <div class="user_question_icon">
                                Question
                            </div>
                            <div class="content">
                                <h1>
                                    {{ $question->title }}
                                </h1>
                                <span class="viewers">
                                    <span
                                        class="category_btn">{{ $question->community_question_types->question_type }}</span>
                                </span>
                            </div>
                        </div>

                        <div class="answers" style="margin-left: 20px;">
                            @foreach ($question->answers as $answer)
                                <div class="answers_box">
                                    <div class="profile_image">
                                        <div class="image"><a href="#"><img
                                                    src="{{ asset('front/images/pexels-pixabay-159497 2.png') }}"
                                                    alt=""></a></div>
                                        <a href="javascript:void(0)"><span>{{ \App\Models\UserModel::Where('id', '=', $answer->user_id)->first()->username }}
                                            </span></a>
                                    </div>
                                    <div class="content">
                                        {{-- <div class="note">
                                            <span>Lorem Ipsum said :
                                                <i class="fal fa-hand-point-left"></i>
                                            </span>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor
                                                incididunt ut labore et dolore
                                                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                laboris
                                                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                reprehenderit
                                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                            </p>
                                        </div> --}}
                                        <p>
                                            {{ $answer->answer }}
                                        </p>
                                        <div class="share">
                                            <span><i class="fal fa-clock"></i>
                                                {{ formatted_date($answer->created_at, 'm-d-y') }}</span>
                                            <span style="margin-left: 20px">
                                                Share :
                                                <a href="https://www.facebook.com/dialog/share?app_id=835472887906283&display=popup&quote={{ $answer->answer }}&href={{ url('/question/'.$question->id) }}&redirect_uri={{ url('/') }}" target="_blank"><i class="fab fa-facebook-square"></i></a>
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url('/question/'.$question->id) }}&summary={{ $answer->answer }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col" style="margin-top: 40px;">
                            <form style="display: flex;" action="{{ route('user.answer') }}" method="POST">
                                @csrf
                                <textarea class="reply-input" placeholder="Your Reply Here..." name="answer" rows="3" style="width: 1007px;"></textarea>
                                <input type="hidden" name="id" value="{{ $question->id }}" />
                                <input type="submit" class="reply-button" value="Reply" />
                            </form>
                        </div>

                        <div class="heading">
                            <h1 class="h1heading">Similar Threads</h1>
                        </div>
                        <div class="scroll_comments">
                            <div class="comments">
                                @php
                                    $similar_threads = \App\Models\CommunityQuestionsModel::where('status', '=', 'Open')
                                        ->where('qestion_type_id', '=', $question->qestion_type_id)
                                        ->where('id', '<>', $question->id)
                                        ->with('community_question_types', 'users', 'admins')
                                        ->take(3)
                                        ->get();
                                @endphp
                                @foreach ($similar_threads as $similar_thread)
                                    <div class="comments_col">
                                        <div class="image"><a href="{{ url('/question/' . $similar_thread->id) }}"><img
                                                    src="{{ asset('front/images/pexels-pixabay-159497 2.png') }}"
                                                    alt=""></a></div>
                                        <div class="question">
                                            <div>
                                                <span class="category_btn">Question</span>
                                                <p>{{ $similar_thread->title }}
                                                </p>
                                            </div>
                                            <div>
                                                <span><i class="fal fa-user"></i>
                                                    @if (!is_null($similar_thread->users))
                                                        {{ $similar_thread->users->username }}
                                                    @else
                                                        {{ $similar_thread->admins->username }}
                                                    @endif
                                                </span><span><i
                                                        class="fal fa-clock"></i>{{ formatted_date($similar_thread->created_at, 'm-d-y') }}</span>
                                                <span
                                                    class="category_btn">{{ $similar_thread->community_question_types->question_type }}</span>
                                            </div>
                                        </div>
                                        <div class="comment_views">
                                            @php
                                                $answer_count = \App\Models\CommunityQuestionAnswersModel::where('question_id', '=', $similar_thread->id)->count();
                                            @endphp
                                            <span>{{ $answer_count }} <i class="fal fa-comment-alt-lines"></i></span>
                                            <span>{{ $similar_thread->views }} <i class="far fa-eye"></i></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
@endpush
{{-- @push('footer')
    <script>
        function count_like_dislike(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/count-like-dislike') }}",
                data: {
                    'question_id': {{ $id }},
                    'answer_id': id
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        $('#like_count_' + id).html(data.likes);
                        $('#dislike_count_' + id).html(data.dislikes);
                    } else {
                        $('#like_count_' + id).html('0');
                        $('#dislike_count_' + id).html('0');
                    }
                }
            });
        }

        function like_answer(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/like-answer') }}",
                data: {
                    'question_id': {{ $id }},
                    'answer_id': id
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            position: 'topRight',
                            message: data.message,
                        });
                        count_like_dislike(id);
                    } else {
                        iziToast.error({
                            position: 'topRight',
                            message: data.message,
                        });
                    }
                }
            });
        }

        function dislike_answer(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/dislike-answer') }}",
                data: {
                    'question_id': {{ $id }},
                    'answer_id': id
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            position: 'topRight',
                            message: data.message,
                        });
                        count_like_dislike(id);
                    } else {
                        iziToast.error({
                            position: 'topRight',
                            message: data.message,
                        });
                    }
                }
            });
        }

        function count_like_dislike_question() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/count-like-dislike-question') }}",
                data: {
                    'question_id': {{ $id }}
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        $('#like_count_question').html(data.likes);
                        $('#dislike_count_question').html(data.dislikes);
                    } else {
                        $('#like_count_question').html('0');
                        $('#dislike_count_question').html('0');
                    }
                }
            });
        }

        function like_question() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/like-question') }}",
                data: {
                    'question_id': {{ $id }}
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            position: 'topRight',
                            message: data.message,
                        });
                        count_like_dislike_question();
                    } else {
                        iziToast.error({
                            position: 'topRight',
                            message: data.message,
                        });
                    }
                }
            });
        }

        function dislike_question() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/dislike-question') }}",
                data: {
                    'question_id': {{ $id }}
                },
                type: 'POST',
                success: function(data) {
                    if (data.success) {
                        iziToast.success({
                            position: 'topRight',
                            message: data.message,
                        });
                        count_like_dislike_question();
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
@endpush --}}
