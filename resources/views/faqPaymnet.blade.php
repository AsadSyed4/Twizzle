@extends('layouts.main')
@push('header')
    <title>Payment FAQs | Twizzle</title>
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
                        <li><a href="{{ route('user.faqs-guide-and-tutorial') }}">Guides & Tutorials</a></li>
                        <li><a href="{{ route('user.faqs-planner') }}">Planner</a></li>
                        <li><a href="{{ route('user.faqs-common-app-essays') }}">Common App Essays</a></li>
                        <li><a href="{{ route('user.faqs-community') }}">Community</a></li>
                        <li><a class="sidebar_a" href="{{ route('user.faqs-payment') }}">Payment</a></li>
                        <li><a href="{{ route('user.faqs-other') }}">Others</a></li>
                    </ul>
                </div>

                <div class="posts cummunity cummunity_single_product cummunity_thread">
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    I would like to receive extra rounds of feedback on an essay I already submitted. Can I pay only for extra feedback?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    You can apply for 2 extra rounds of feedback for $50 on our payment page. This is only if it is the same essay topic and builds on the existing essay. Graders hold the right to turn down a request if they deem the essay is different enough to deserve a completely new evaluation.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    I bought a 10-essay bundle but I don’t think I can use them all. Can I get a refund?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    The 10-essay bundle is for students who anticipate a large volume of essay submissions. We do not offer refunds on unused evaluations.
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
