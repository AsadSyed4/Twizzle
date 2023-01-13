@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Withdraw Requests | Twizzle</title>
    @endpush
    @section('section')
        @php
            $balance = \App\Models\Wallet::where('admins_id', '=', session()->get('admin.id'))->first();
        @endphp
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Withdraw Requests</h5>
                    </div>
                    <div class="table-responsive text-nowrap card-body p-0" id="horizontal-example">
                        @if (count($withdraw_requests) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Bank</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($withdraw_requests as $withdraw_request)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $withdraw_request->id }}</strong>
                                            </td>
                                            <td>{{ $withdraw_request->admins->first_name }}
                                                {{ $withdraw_request->admins->last_name }}({{ $withdraw_request->admins->username }})
                                            </td>
                                            <td>{{ $withdraw_request->bank_accounts->name }}({{ $withdraw_request->bank_accounts->acount_no }})
                                            </td>
                                            <td>${{ $withdraw_request->amount }}</td>
                                            <td>
                                                @if ($withdraw_request->status == 'Pending')
                                                    <select id="status_{{ $withdraw_request->id }}" class="form-select"
                                                        onchange="change_request_status({{ $withdraw_request->id }})">
                                                        <option>Withdraw Status</option>
                                                        <option value="Approved & Sent" @selected($withdraw_request->status == 'Approved & Sent')>
                                                            Approved & Sent</option>
                                                        <option value="Declined" @selected($withdraw_request->status == 'Declined')>Declined
                                                        </option>
                                                    </select>
                                                @else
                                                    @if ($withdraw_request->status == 'Declined')
                                                        <span class="badge bg-danger">{{ $withdraw_request->status }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-success">{{ $withdraw_request->status }}</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ formatted_date($withdraw_request->created_at, 'd-m-Y h:m A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="container d-flex justify-content-center">
                                <h1>Data Not Found.</h1>
                            </div>
                        @endif
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3 mb-n3">
                        {{ $withdraw_requests->render() }}
                    </ul>
                </nav>
            </div>
        </div>
    @endsection
    @push('footer')
        <script>
            function change_request_status(id) {
                var status = $("#status_" + id + " option:selected").val();
                if (status.length !== 0) {
                    $.ajax({
                        url: "{{ route('admin.change-withdraw-request-status') }}",
                        data: {
                            'id': id,
                            'status': status,
                            '_token': '{{ csrf_token() }}'
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
                                iziToast.error({
                                    position: 'topRight',
                                    message: data.message,
                                });
                            }
                        }
                    });
                } else {
                    iziToast.warning({
                        position: 'topRight',
                        message: 'Please Select Status',
                    });
                }
            }
        </script>
    @endpush
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
