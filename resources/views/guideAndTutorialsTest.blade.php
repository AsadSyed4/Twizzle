@extends('layouts.main')
@push('header')
<title>Test Do,s & Don'ts | Twizzle</title>
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" /> --}}
@endpush
@section('section')
<div class="testing">
    <div class="container">
        <div class="testing_inner">
            <div class="r_heading_style l_heading_style">
                <h1>Test</h1>
                <div class="bottom_style">
                    <span class="black_bg"></span>
                    <span class="white_bg"></span>
                    <span>Do’s & Don’ts</span>
                </div>
            </div>

            <div class="faq_box">
                <ul>
                    <li class="add_class_faq content_1_btn">Vocab</li>
                    <li class="content_2_btn">PRactice</li>
                    <li class="content_3_btn">TIME MANAGEMENT</li>
                    <li class="content_4_btn">CHOOSING ANSWERS</li>
                </ul>

                <div class="content add_class_content content_1">
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Find context clues
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    In vocab questions, even if you’re unfamiliar with the particular definition,
                                    remember that the correct answer choice will be a synonym for the highlighted word.
                                    Look for clues – a connecting pronoun or noun – that will signal what the right
                                    answer is.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Remove choice synonyms
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    In vocab questions, eliminate choices that are synonyms with each other since you
                                    can only have one correct answer choice. You shouldn’t lose time trying to decide
                                    between two choices that essentially have the same meaning.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Manage hard words
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    On the first read through, you may notice some difficult words. It’s important to
                                    make note of them but not lose time. They might not appear as questions or in answer
                                    choices at all. If the word does appear in a question or answer choice, you can come
                                    back to that later.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Prepare a vocab list
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    Commonly tested SAT words should be memorized beforehand. There are many lists
                                    available, and you should use these to make a list that works for you. When
                                    studying, pay attention to words that have multiple meanings such as “compelling” or
                                    “yield.”
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content content_2">
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Train for test day
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    Getting used to the rhythm of taking the test is important. Take a full practice
                                    test at the same time as your real test once a week a month before your test date.
                                    The goal is to make every aspect of test day seem familiar to you. This will help
                                    keep you calm and relaxed.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Use good materials
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    Use College Board/ACT official materials since nothing else will be written as
                                    closely to the actual test. There are dozens of officially released test booklets
                                    online. Practicing with materials that have a different format and wording from the
                                    actual test is like preparing for the wrong test!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Practice on your own
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    Do not do full tests with friends and review together as you will be taking the
                                    actual test alone. This means you will need to trust your own review process. It may
                                    be more enjoyable to study together, but you should spend time developing your own
                                    method.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Review is everything
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    There is no point in practicing unless you properly review the results. You need to
                                    understand the reason why you got each answer right or wrong instead of just looking
                                    at your score. Also note how to avoid repeating your own mistakes. An ineffective
                                    review process is the biggest reason why students struggle to improve their test
                                    scores.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content content_3">
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Get a timer
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    The best way to get used to completing sections within the given time is practicing
                                    with a timer. Identify the problems that take up the most time and practice those
                                    types to get faster. We have a timer available on the site for you to use.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Instant honest decision
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    Sometimes you will look at a question and simply not know how to approach it, or you
                                    feel it’s possible but know it will take several minutes to work out. Instantly
                                    recognize these questions and skip them. Finish the rest of the test before coming
                                    back to these questions.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Use every second
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    Finishing early means you have time to go back and check your work. This means, if
                                    possible, every question. Some students only go back to questions they were unsure
                                    of, but many students actually make marking errors on easy questions. If you have
                                    the time, make sure you didn’t do this.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Find shortcuts
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    There are many different ways to solve problems in the math section; not every
                                    method will use the same amount of time. If you are in the no-calc section of SAT
                                    and you’re grinding out time-consuming algebraic equations, chances are you missed
                                    the shortcut.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content content_4">
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Know the structure
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    For SAT, one of the hardest things for students to get used to is that many
                                    questions have two answers that seem to be correct. Think of most answer choices as
                                    having a “Most correct > Less correct > Less incorrect > Most incorrect” structure.
                                    Always look for the “Most correct” answer.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Mark the error
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    When looking for wrong answers, make sure to mark within the answer choice which
                                    part makes it the wrong answer – instead of just crossing off the answer choice
                                    itself. This will make review much faster since you don’t need to read the entire
                                    answer choice again.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Find the reference
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    Questions that do not ask you to find the reference lines will still have
                                    information in the passage that supports the right answer choice. Finding that
                                    information will help confirm you have the right answer. Even for “imply, infer, or
                                    suggest” questions, there will be indirect support that can be identified.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="outline">
                        <div class="box">
                            <div class="faq_heading">
                                <h3>
                                    Learn wrong choices
                                </h3>
                                <div class="image slide_down  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 7.88281L7.32759 1.5561L13.6543 7.88281" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="image slide_up  ">
                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00088 1.64844L7.32759 7.97515L13.6543 1.64844" stroke="#202020"
                                            stroke-width="1.77717" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq_content">
                                <p>
                                    In the reading section, there are three very common types of wrong answers. Not
                                    Mentioned: it has no supporting information from the passage; Not Relevant: it has
                                    nothing to do with the question; Not Correct: it is easily proven wrong by
                                    contradicting statements in the passage.
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