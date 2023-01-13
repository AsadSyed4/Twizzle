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
                <div class="left payment_table">
                    @if (count($payments) > 0)
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Amount</th>
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
                        <a class="simple_button" href="{{ route('user.payment-history-more') }}">
                            <i class="fal fa-angle-double-right"></i>
                            More details
                        </a>
                    @else
                        <table>
                            <tr>
                                <th></th>
                                <th>No History</th>
                                <th></th>
                            </tr>
                        </table>
                    @endif
                </div>
                <div class="profile_details">
                    <h1>my pROFILE</h1>
                    <a href="{{ route('user.profile') }}">Edit</a>
                    <a class="link_class" href="{{ route('user.payment-history') }}">pAYMENTs</a>
                    <a href="{{ route('user.evalations') }}">Evaluations</a>
                    <div class="bottom_style">
                        <span class="black_bg"></span>
                        <span class="white_bg"></span>
                    </div>
                    <div class="bg_image"><img src="{{ asset('front/images/Vector 1.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
@endpush
