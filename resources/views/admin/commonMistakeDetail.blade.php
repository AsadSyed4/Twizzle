@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Common Mistake Detail | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card overflow-hidden mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <span>Category : <strong>{{ $common_mistake->cmCategories->name }}</strong></span>
                                <span>Type : <strong>{{ $common_mistake->cm_type }}</strong></span>
                            </div>
                            <div class="card-body" id="vertical-example">
                                <div class="d-flex justify-content-center">
                                    <span class="h5">Content</span>
                                </div>
                                {!! $common_mistake->content !!}
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
