@extends('layouts.main')
@push('header')
    <title>Blogs | Twizzle</title>
@endpush
@section('section')
<div class="blogs">
    <div class="container">
        <div class="blogs_inner">
            <div class="heading">
                <h1>BLOGS</h1>
                <div class="bottom_style">
                    <span class="black_bg"></span>
                    <span class="white_bg"></span>
                </div>
            </div>

            <div class="blogs_posts">
                <div class="filter">
                    <form class="search" action="{{ route('user.blogs-search-by-name') }}" method="POST">
                        @csrf
                        <input type="text" placeholder="Search" name="name">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <form action="{{ route('user.blogs-search-by-category') }}" method="POST">
                        @csrf
                        <div class="category">
                        <h2>Categories</h2>
                        @foreach ($blog_categories as $blog_category)
                        <label for="{{ $blog_category->id }}">
                            <input id="{{ $blog_category->id }}" name="selected[]" type="checkbox" value="{{ $blog_category->id }}" @if (!is_null($selected) && in_array($blog_category->id, $selected)) checked @endif onclick="this.form.submit()">
                            <h3 onclick="this.form.submit()">{{ $blog_category->name }}</h3>
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
                                <a class="clear_all" href="{{ route('user.blogs') }}">
                                    Clear All
                                    <i class="far fa-times"></i>
                                </a>
                            @endif
                        </h2>
                        <div class="select_category">
                            @foreach ($blog_categories as $blog_category)
                                @if (!is_null($selected) && in_array($blog_category->id, $selected))
                                    <span>{{ $blog_category->name }}</span>
                                @endif
                            @endforeach
                        </div>
                    </form>
                </div>
                <style>
                .oneline_text{
                    height: 24px;
                    overflow: hidden;
                    display: inline-block;
                    position: relative;
                    padding-right: 20px;
                    box-sizing: border-box;
                }
                .oneline_text::after{
                    content: "...";
                    position: absolute;
                    right: 0px;
                    top: 0px;
                }
            </style>
                <div class="posts">
                    @if (count($blogs)>0)
                        @foreach ($blogs as $blog)
                            <div class="box">
                                <div class="image"><a href="{{ url('/blog/' . $blog->id) }}"><img src="{{ asset('uploads/'.$blog->media) }}" alt="" onerror="this.src='{{ asset('front/images/image 1.png') }}'"></a></div>
                                <div class="content">
                                    <a href="{{ url('/blog/' . $blog->id) }}">
                                        {{ $blog->title }}
                                    </a>
                                    <p>
                                        <span class="oneline_text">
                                          {{ $blog->short_content }}
                                        </span>
                                        <a href="{{ url('/blog/' . $blog->id) }}">Read More</a>
                                    </p>
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
