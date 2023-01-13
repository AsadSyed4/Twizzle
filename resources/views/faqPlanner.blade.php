@extends('layouts.main')
@push('header')
    <title>Planner FAQs | Twizzle</title>
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
                        <li><a class="sidebar_a" href="{{ route('user.faqs-planner') }}">Planner</a></li>
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
                                    How do I use the Planner? What is it for?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    Keeping track of your grades and extracurricular activities is essential when it comes to college admissions prep. It gives you a bird’s eye view of where you stand; it helps you understand your interests; and provides clues as to how you can make your package more competitive. The Planner gives you a simple way to input your data and store it in one place. You can also keep track of your performance with the GPA calculator so you know what your strengths and weaknesses are.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    How accurate is the GPA calculator?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    The GPA calculator is intended to give you an approximate idea of where you stand. Update the grades each quarter to keep track of any changes.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    I don’t know what my field of interest is yet. Can I still use the Desired Events feature? 
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    Of course. Some students may have specific plans and goals, but many other students learn as they go. Use our Desired Events to explore your options and figure out what field interests you the most.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="faq_col">
                            <div class="faq_col_heading">
                                <h2>
                                    I would like to see events for multiple fields of interests on my Calendar. How can I set that up?
                                </h2>
                                <i class="far fa-angle-down"></i>
                            </div>
                            <div class="faq_col_content">
                                <p>
                                    The Desired Events page has an Export option that lets you sync upcoming events to your personal calendar. Choose whichever fields interest you, select the events you would like to save, and export to your calendar.
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
