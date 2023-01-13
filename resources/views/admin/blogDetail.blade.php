@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Blog Detail | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card overflow-hidden mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <span>Category : <strong>{{ $blog->blog_categories->name }}</strong></span>
                                <span>Tags : <strong>
                                        @foreach ($blog->tags as $tag)
                                            {{ $tag->name }},
                                        @endforeach
                                    </strong></span>
                            </div>
                            <div class="card-body" id="vertical-example">
                                <div class="d-flex justify-content-center">
                                    <span class="h5">{{ $blog->title }}</span>
                                </div>
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
