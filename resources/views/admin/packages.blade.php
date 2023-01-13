@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Packages | Twizzle</title>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Packages</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal">
                            <i class='bx bx-cross'></i>
                        </button>
                    </div>
                    @if (count($packages) > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Package Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->id }}</td>
                                            <td>{{ $package->subscription_name }}</td>
                                            <td>{{ $package->description }}</td>
                                            <td>{{ $package->sub_price }}</td>
                                            <td>
                                                <button class="btn btn-danger" id="dlt_btn_{{ $package->id }}"
                                                    onclick="delete_package({{ $package->id }})"><i
                                                        class='bx bxs-trash'></i></button>
                                                <button class="btn btn-danger" type="button"
                                                    id="loading_btn_{{ $package->id }}" hidden>
                                                    <img src="{{ asset('admin/assets/loading.gif') }}">
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="container d-flex justify-content-center">
                            <h5>No Package Available</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $packages->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="packageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-package') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="package_name">Package Name</label>
                                <input type="text" class="form-control" id="package_name" name="package_name"
                                    value="{{ old('package_name') }}" placeholder="Enter Package Name" required>
                                <small class="text-danger">
                                    @error('package_name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="package_name">Package Description</label>
                                <input type="text" class="form-control" id="package_description"
                                    name="package_description" value="{{ old('package_description') }}"
                                    placeholder="Enter Package Description" required>
                                <small class="text-danger">
                                    @error('package_description')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="package_name">Package Price</label>
                                <input type="text" class="form-control" id="package_price" name="package_price"
                                    value="{{ old('package_price') }}" placeholder="Enter Package Price" required>
                                <small class="text-danger">
                                    @error('package_price')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Package</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            function delete_package(id) {
                $.ajax({
                    url: "{{ route('admin.delete-package') }}",
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    beforeSend: function() {
                        $("#loading_btn_" + id).removeAttr('hidden');
                        $("#dlt_btn_" + id).hide();
                    },
                    success: function(data) {
                        if (data.success) {
                            iziToast.success({
                                position: 'topRight',
                                message: data.message,
                            });
                            window.location.reload();
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
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
