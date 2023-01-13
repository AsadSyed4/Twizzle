@extends('layouts.main')
@push('header')
<title>Videos | Twizzle</title>
@endpush
@section('section')
<div class="blogs">
    <div class="container">
        <div class="blogs_inner videos_inner">
            <div class="heading">
                <h1>Videos</h1>
                <div class="bottom_style">
                    <span class="white_bg"></span>
                    <span class="black_bg"></span>
                </div>
            </div>

            <div class="blogs_posts">
                <div class="filter">
                    <form class="search" action="{{ route('user.videos-search-by-name') }}" method="POST">
                        @csrf
                        <input type="text" placeholder="Search" name="name" required>
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <form action="{{ route('user.videos-search-by-category') }}" method="POST">
                        @csrf
                        @php
                        $video_categories = \App\Models\TutorialsCategories::all();
                        @endphp
                        <div class="category">
                            <h2>Categories</h2>
                            @foreach ($video_categories as $video_category)
                            <label for="{{ $video_category->id }}">
                                <input id="{{ $video_category->id }}" type="checkbox" name="selected[]"
                                    value="{{ $video_category->id }}" onclick="this.form.submit()" @if (!is_null($selected)
                                    && in_array($video_category->id, $selected)) checked @endif>
                                <h3 onclick="this.form.submit()">{{ $video_category->name }}</h3>
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
                            <a class="clear_all" href="{{ route('user.videos') }}">
                                Clear All
                                <i class="fa fa-times"></i>
                            </a>
                            @endif
                        </h2>
                        <div class="select_category">
                            @foreach ($video_categories as $video_category)
                            @if (!is_null($selected) && in_array($video_category->id, $selected))
                            <span>{{ $video_category->name }}</span>
                            @endif
                            @endforeach
                        </div>
                    </form>
                </div>
                <style>
                    .video_boxx {
                        position: relative;
                        width: 100%;
                        height: 100%;
                        border-radius: 13.1425px;
                        overflow: hidden;
                    }

                    .video_boxx .image {
                        width: 100%;
                        /*height: 100%;*/
                    }

                    .video_boxx .play_time {
                        position: absolute;
                        top: 0px;
                        left: 0px;
                        width: 100%;
                        height: 100%;
                        transition: 0.5s;
                        cursor: pointer;
                    }

                    .video_boxx .play_time:hover {
                        background: rgba(0, 0, 0, 0.2);
                    }

                    .video_boxx .play_time .play_time_box {
                        width: 100%;
                        height: 100%;
                        position: relative;
                    }

                    .video_boxx .play_time .play_icon {
                        width: 60px;
                        height: 60px;
                        border-radius: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: rgba(254, 0, 0, 0.7);
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                    }

                    .video_boxx .play_time .play_icon i {
                        font-size: 24px;
                        color: #FFFFFF;
                    }

                    .video_boxx .play_time .timer {
                        padding: 3px 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #FFFFFF;
                        border-radius: 25px;
                        position: absolute;
                        bottom: 10px;
                        right: 10px;
                    }

                    .video_boxx .play_time .timer i {
                        font-size: 10px;
                        color: #202020;
                        margin-right: 5px;
                    }

                    .video_boxx .play_time .timer span {
                        font-family: 'AvantGarde Bk BT';
                        font-style: normal;
                        font-weight: 400;
                        font-size: 10px;
                        letter-spacing: 0.02em;
                        color: #202020;
                    }
                </style>

                <div class="posts">
                    @foreach ($videos as $video)
                    <script></script>
                    <div class="video_box ">
                        <div class="video_boxx ">
                            <div class="image">
                            <img class="video_id{{ $video->id }}" src="{{ asset('uploads/' . $video->thumbnail) }}" id="image_{{ $video->id }}"
                                style="cursor:pointer;max-width: 100%;" height="100%" />
                                    <iframe id="iframe_{{ $video->id }}" width="100%" height="100%"
                                class="embed-responsive-item" src="{{ $video->link }}" allow="" g-show="showvideo"
                                frameborder="0" style="display:none"></iframe>

                            </div>
                            <div class="play_time video_id{{ $video->id }}" onclick="play_video({{ $video->id }})">
                                <div class="play_time_box">
                                    <div class="play_icon">
                                        <i class="fas fa-play"></i>
                                    </div>
                                    <div class="timer">
                                        <i class="fal fa-clock"></i>
                                        <span>1.5 Hours</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="image">
                            <img src="{{ asset('uploads/' . $video->thumbnail) }}" id="image_{{ $video->id }}"
                                style="cursor:pointer;max-width: 100%;" height="100%"
                                onclick="play_video({{ $video->id }})" />

                            <iframe id="iframe_{{ $video->id }}" width="100%" height="100%"
                                class="embed-responsive-item" src="{{ $video->link }}" allow="" g-show="showvideo"
                                frameborder="0" style="display:none"></iframe>
                        </div> -->
                        <div class="content">
                            <p>
                                {{ $video->title }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer')
<script>
    function play_video(id) {
        var src = $('#iframe_' + id).attr('src');
        $('.video_id' + id).css({
            'display': 'none'
        });
        $('#iframe_' + id).css({
            'display': 'block'
        });
        $('#iframe_' + id).attr('src', src + '?autoplay=1');
        $('#iframe_' + id).attr('allow', 'autoplay');
    }
</script>
@endpush