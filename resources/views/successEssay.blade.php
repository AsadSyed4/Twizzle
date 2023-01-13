@extends('layouts.main')
@push('header')
    <title>Upload Eassy | Twizzle</title>
@endpush
@section('section')
    <div class="message">
        <div class="container">
            <div class="message_inner">
                <div class="title2">
                    <h1>Message</h1>
                </div>
                <h2>Your essay submited</h2>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                    leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                    with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <a class="title_btn" href="{{ route('user.essay-grading') }}">Go Back</a>
            </div>
        </div>
    </div>
@endsection
