@extends('layouts.main')
@push('header')
    <title>{{ $blog->title }} | Twizzle</title>
@endpush
@section('section')
    <div class="single_blog">
        <div class="container">
            <div class="single_blog_inner">
                <div class="left">
                    <h1>{{ $blog->title }}</h1>
                    <div class="image"> <img src="{{ asset('uploads/' . $blog->media) }}" alt=""
                            onerror="this.src='{{ asset('front/images/image 1.png') }}'" />
                    </div>
                    <div class="content">
                        {!! $blog->content !!}
                        <ul>
                            <li onclick="copyToClipboard()"><a href="javascript:void(0)"><i class="fal fa-copy"></i> Copy
                                    Link</a></li>
                            <li><a href="mailto:?subject=&amp;body=Check out this site {{ url('/blog/'.$blog->id) }}"><i class="fa fa-envelope"></i></a></li>
                            <li onclick="shareFB()"><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                            <li onclick="tweetCurrentPage()"><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                        <div class="recommend_blogs">
                            <h2>Recommended Blogs</h2>
                            <div class="row">
                                @php
                                    $recent_blogs = \App\Models\blogs::where('id', '<>', $blog->id)
                                        ->where('status', '=', 'Active')
                                        ->orderBy('id', 'desc')
                                        ->take(3)
                                        ->get();
                                @endphp
                                @foreach ($recent_blogs as $recent_blog)
                                    <div class="col">
                                        <div class="image"><a href="{{ url('/blog/' . $recent_blog->id) }}"><img
                                                    src="{{ asset('uploads/' . $recent_blog->media) }}" alt=""
                                                    onerror="this.src='{{ asset('front/images/image 1.png') }}'"></a>
                                        </div>
                                        <div class="content">
                                            <span>
                                                <a
                                                    href="{{ url('/blog/' . $recent_blog->id) }}">{{ $recent_blog->title }}</a>
                                                <h3>{{ formatted_date($recent_blog->created_at, 'm/d/y') }}</h3>
                                            </span>
                                            <p>
                                                {{ $recent_blog->short_content }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="recommend_blogs recent_blogs">
                        <h2>Recent Blogs</h2>
                        <div class="row">
                            @foreach ($recent_blogs as $recent_blog)
                                <div class="col">
                                    <div class="image"><a href="{{ url('/blog/' . $recent_blog->id) }}"><img
                                                src="{{ asset('uploads/' . $recent_blog->media) }}" alt=""
                                                onerror="this.src='{{ asset('front/images/image 1.png') }}'"></a>
                                    </div>
                                    <div class="content">
                                        <span>
                                            <a href="{{ url('/blog/' . $recent_blog->id) }}">{{ $recent_blog->title }}</a>
                                            <h3>{{ formatted_date($recent_blog->created_at, 'm/d/y') }}</h3>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script>
        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href);
            iziToast.success({
                position: 'topRight',
                message: 'Link Copied.',
            });
        }

        function shareFB() {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=` + window.location.href, "_blank")
        }

        function tweetCurrentPage() {
            window.open("https://twitter.com/share?url=" + encodeURIComponent(window.location.href), '_blank');
            return false;
        }
    </script>
@endpush
