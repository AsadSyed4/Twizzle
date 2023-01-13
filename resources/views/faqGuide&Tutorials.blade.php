@extends('layouts.main')
@push('header')
    <title>Guides & Tutorials FAQs | Twizzle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@endpush
@section('section')
<div class="blogs">
    <div class="container">
        <div class="blogs_inner cummunity_inner faq_inner">
            <div class="heading">
                <h1 class="h1heading">FAQs</h1>
            </div>
            <div class="blogs_posts">
                <div class="sidebar">
                    <ul>
                        <li><a class="sidebar_a" href="{{ route('user.faqs-guide-and-tutorial') }}">Guides & Tutorials</a></li>
                        <li><a href="{{ route('user.faqs-planner') }}">Planner</a></li>
                        <li><a href="{{ route('user.faqs-common-app-essays') }}">Common App Essays</a></li>
                        <li><a href="{{ route('user.faqs-community') }}">Community</a></li>
                        <li><a href="{{ route('user.faqs-payment') }}">Payment</a></li>
                        <li><a href="{{ route('user.faqs-other') }}">Others</a></li>
                    </ul>
                </div>

                <div class="posts cummunity cummunity_single_product cummunity_thread">
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    I have a topic/question that I would like covered in a blog post or video. Where can I leave this information? 
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    We’re always happy to listen to your needs and provide as much feedback as possible. Go to Contact us > Topics/questions to leave us a note. We will look through requests to identify the topics that have the highest demand and give those priority.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer')
@endpush
