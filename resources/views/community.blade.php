@extends('layouts.main')
@push('header')
    <title>Community | Twizzle</title>
@endpush
@section('section')
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
                        <form action="{{ route('user.community-search-by-categories') }}" method="POST" id="cat_form">
                            @csrf
                            <div class="category">
                                <h2>Categories</h2>
                                @foreach ($question_types as $question_type)
                                    <label for="{{ $question_type->id }}">
                                        <input id="{{ $question_type->id }}" type="checkbox" name="selected[]"
                                            value="{{ $question_type->id }}"
                                            onclick="this.form.submit()" @if (!is_null($selected) && in_array($question_type->id, $selected)) checked @endif>
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
                                    <a class="clear_all" href="{{ route('user.community') }}">
                                        Clear All
                                        <i class="far fa-times"></i>
                                    </a>
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
                    <div class="posts cummunity">
                        @if (count($questions)>0)
                            @foreach ($questions as $question)
                                <div class="col">
                                    <div class="image"><a href="{{ url('/question/' . $question->id) }}"><img
                                                src="{{ asset('uploads/' . $question->media) }}" alt=""
                                                onerror="this.src='{{ asset('front/images/secsixvid.png') }}'"></a></div>
                                    <div class="content">
                                        <h1><a href="{{ url('/question/' . $question->id) }}">{{ $question->title }}</a>
                                        </h1>
                                        <span class="viewers">
                                            <span>
                                                @php
                                                    $answer_count = \App\Models\CommunityQuestionAnswersModel::where('question_id', '=', $question->id)->count();
                                                @endphp
                                                <span>{{ $answer_count }} <i class="fal fa-comment-alt-lines"></i></span>
                                                <span>{{ $question->views }} <i class="far fa-eye"></i></span>
                                            </span>
                                            <span
                                                class="category_btn">{{ $question->community_question_types->question_type }}</span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1>Data Not Found.</h1>
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
