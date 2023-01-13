@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Withdraw Requests | Twizzle</title>
    @endpush
    @section('section')
        @php
            $balance=\App\Models\Wallet::where('admins_id','=',session()->get('admin.id'))->first();
        @endphp
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Withdraw Requests</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bankModal">
                            Add Bank Account
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#withdrawModal" @if(is_null($balance) || $balance->balance < 1) disabled @endif>
                            Submit Withdraw Request
                        </button>
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
                                            <td>{{ $withdraw_request->admins->first_name }} {{ $withdraw_request->admins->last_name }}</td>
                                            <td>{{ $withdraw_request->bank_accounts->name }}({{ $withdraw_request->bank_accounts->acount_no }})</td>
                                            <td>${{ $withdraw_request->amount }}</td>
                                            <td>
                                                @if ($withdraw_request->status=='Pending')
                                                    <span class="badge bg-info">{{ $withdraw_request->status }}</span>
                                                @elseif ($withdraw_request->status=='Declined')
                                                    <span class="badge bg-danger">{{ $withdraw_request->status }}</span>
                                                @elseif ($withdraw_request->status=='Approved & Sent')
                                                    <span class="badge bg-success">{{ $withdraw_request->status }}</span>                                                
                                                @endif
                                            </td>
                                            <td>{{ formatted_date($withdraw_request->created_at,'d-m-Y h:m A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="container d-flex justify-content-center">
                                <h1>You didn't submit any Request</h1>
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
        <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Bank Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add-bank-account') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="role_name">Bank Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('package_name') }}" placeholder="Enter Bank Name" required>
                                <small class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="role_name">Acount No.</label>
                                <input type="text" class="form-control" id="account" name="account"
                                    value="{{ old('package_name') }}" placeholder="Enter Account No." required>
                                <small class="text-danger">
                                    @error('account')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Add Bank Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.submit-withdraw-request') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="0" @if (is_null($balance))
                                    max="0"
                                @else
                                    max="{{ $balance->balance }}"
                                @endif
                                    value="{{ old('amount') }}" placeholder="Enter Amount" required>
                                <small class="text-danger">
                                    @error('amount')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group mb-4">
                                <label class="form-label" for="bank_id">Account</label>
                                <select id="bank_id" name="bank_id"
                                    class="form-select form-control-lg form-control" required>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}({{ $account->acount_no }})</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">
                                    @error('bank_id')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
