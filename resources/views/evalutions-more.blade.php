@extends('layouts.main')
@push('header')
    <title>Evaluations | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@endpush
@section('section')
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
                            <th>Serial no</th>
                            <th>
                                Date
                                <span>
                                    <i class="fal fa-angle-up"></i>
                                    <i class="fal fa-angle-down"></i>
                                </span>
                            </th>
                            <th>
                                Status
                                <span>
                                    <i class="fal fa-angle-up"></i>
                                    <i class="fal fa-angle-down"></i>
                                </span>
                            </th>
                            <th>
                                University
                                <span>
                                    <i class="fal fa-angle-up"></i>
                                    <i class="fal fa-angle-down"></i>
                                </span>
                            </th>
                            <th>
                                Download
                            </th>
                        </tr>
                        @php
                            $essays = \App\Models\EassyModel::where('user_id', '=', session()->get('user_id'))
                                ->orderBy('essay.created_at', 'desc')
                                ->take(10)
                                ->get();
                        @endphp
                        @foreach ($essays as $essay)
                            <tr>
                                <td>{{ $essay->id }}</td>
                                <td>{{ formatted_date($essay->created_at, 'd/m/Y') }}</td>
                                <td>Submitted</td>
                                <td>{{ $essay->university }}</td>
                                <td><a class="download" href="{{ url('/download') }}/{{ $essay->media }}">Download</a></td>
                            </tr>
                        @endforeach
                    </table>

                    <a class="simple_button" href="{{ route('user.profile') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
@endpush
