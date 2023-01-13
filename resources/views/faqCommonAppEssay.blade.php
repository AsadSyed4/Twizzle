@extends('layouts.main')
@push('header')
    <title>Common App Essays FAQs | Twizzle</title>
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
                        <li><a class="sidebar_a" href="{{ route('user.faqs-common-app-essays') }}">Common App Essays</a></li>
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
                                    How long will it take to get my essay back?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    7 days max or it's free. It’s important that we have enough time to take your essay apart and see what's driving it, what kind of potential holes it has, and how you can improve. Detailed feedback takes time, but it will be worth the wait.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    I have questions for the grader. How can I contact the grader?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    Let Twizzle connect you. Send your request by going to Contact us > Grader. As graders focus primarily on evaluating the essay submitted, any questions you may have should be directly related to the feedback provided. Graders do not provide consultation.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    I’m not happy with the feedback that I received. What should I do?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    We guarantee 100 percent satisfaction; every single essay graded at Twizzle is given the same care and attention each and every time. If you feel we didn't live up to our promise, let us know by submitting your request through Contact us > Essay evaluation.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    Can I set up a counseling session for my essay?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    If you want a more traditional counseling package to review and answer all of your college preparation inquiries, we offer solutions on a limited basis. Submit your request through Contact us > Others and we will review your submission.
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
