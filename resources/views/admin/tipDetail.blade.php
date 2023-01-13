@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>TIP Detail | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                @foreach ($tip as $item)
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card overflow-hidden mb-4">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Category : <strong>{{ $item->tipsCategories->name }}</strong></span>
                                    <span>Sub Category : <strong>{{ $item->tipsSubCategories->name }}</strong></span>
                                </div>
                                <div class="card-body" id="vertical-example">
                                    <div class="d-flex justify-content-center">
                                        <span class="h5">Content</span>
                                    </div>
                                    {!! $item->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
