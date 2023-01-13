@extends('layouts.main')
@push('header')
    <title>Payment History | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@endpush
@section('section')
    <!-- ========================= Payment Method ==================== -->
    <div class="profile">
        <div class="container">
            <div class="profile_inner">
                <div class="left payment_table payment_table2">
                    <div class="filters">
                        <div class="feild">
                            <label for="search">Search</label>
                            <span>
                                <input id="Search" type="text" placeholder="Search here">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <div class="feild">
                            <label for="Latest">Sort by</label>
                            <select id="Latest">
                                <option value="1">Latest</option>
                                <option value="1">Oldest</option>
                                <option value="1">Hot</option>
                                <option value="1">Low price</option>
                            </select>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="feild">
                            <button class="simple_button">Search</button>
                        </div>
                    </div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>
                                Date
                                <span>
                                    <i class="fa fa-angle-up"></i>
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </th>
                            <th>
                                Status
                                <span>
                                    <i class="fa fa-angle-up"></i>
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </th>
                            <th>
                                Amount
                                <span>
                                    <i class="fa fa-angle-up"></i>
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </th>
                        </tr>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ formatted_date($payment->created_at, 'm/d/Y') }}</td>
                                <td>{{ $payment->description }}</td>
                                <td>${{ floatval($payment->balance) }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a class="simple_button" href="{{ route('user.payment-history') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
@endpush
