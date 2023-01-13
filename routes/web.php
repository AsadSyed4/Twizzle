<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarEventController;

//Users Routes
Route::get('/', [UserController::class, 'home'])->name('user.home');
Route::get('/about-us', [UserController::class, 'about'])->name('user.about');
Route::get('/who-we-are', [UserController::class, 'who_we_are'])->name('user.who-we-are');
Route::get('/guide-and-tutorial-test', [UserController::class, 'guide_and_tutorial_test'])->name('user.guide-and-tutorial-test');
Route::get('/faqs/planner', [UserController::class, 'faqs_planner'])->name('user.faqs-planner');
Route::get('/faqs/guide-and-tutorial', [UserController::class, 'faqs_gat'])->name('user.faqs-guide-and-tutorial');
Route::get('/faqs/common-app-essays', [UserController::class, 'faqs_common_app_essays'])->name('user.faqs-common-app-essays');
Route::get('/faqs/community', [UserController::class, 'faqs_community'])->name('user.faqs-community');
Route::get('/faqs/payment', [UserController::class, 'faqs_payment'])->name('user.faqs-payment');
Route::get('/faqs/other', [UserController::class, 'faqs_other'])->name('user.faqs-other');
Route::get('/planning', [UserController::class, 'planning'])->name('user.planning');
Route::get('/planner-grade', [UserController::class, 'planner_grade'])->name('user.planner-grade');
Route::get('/planner-how-it-works',function(){
    return view('plannerHowItWorks');
})->name('user.planner-how-it-works');
Route::post('/planner-grade', [UserController::class, 'add_planner_grade'])->name('user.add-planner-grade');
Route::get('/export-classes', [UserController::class, 'export_classes'])->name('user.export-classes');
Route::get('/planner-extracurriculars', [UserController::class, 'planner_extracurriculars'])->name('user.planner-extracurriculars');
Route::post('/planner-extracurriculars', [UserController::class, 'add_planner_extracurriculars'])->name('user.add-planner-extracurriculars');
Route::get('/export-extra', [UserController::class, 'export_extra'])->name('user.export-extra');
Route::post('/events', [UserController::class, 'planner_date'])->name('user.planner-date');
Route::post('/save-to-calander', [UserController::class, 'save_to_calander'])->name('user.save-to-calander');
Route::get('/master-plan', [UserController::class, 'master_plan'])->name('user.master-plan');
Route::get('/login', [UserController::class, 'loginForm']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/signup', [UserController::class, 'signUpForm']);
Route::post('/signup', [UserController::class, 'signUp']);
Route::post('/update', [UserController::class, 'update']);
Route::get('/videos', [UserController::class, 'guide_and_tutorial'])->name('user.videos');
Route::post('/videos', [UserController::class, 'videos_search_by_category'])->name('user.videos-search-by-category');
Route::post('/videos/search', [UserController::class, 'videos_search_by_name'])->name('user.videos-search-by-name');
Route::post('/check-username', [UserController::class, 'check_username'])->name('user.check-username');
Route::post('/check-email', [UserController::class, 'check_email'])->name('user.check-email');
Route::get('/social-media-share', [UserController::class, 'ShareWidget']);
Route::get('/util', function () { return view('util'); })->name('user.util');
Route::get('/disclaimer', function () { return view('disclaimer'); })->name('user.disclaimer');
Route::get('/terms-of-use', function () { return view('termsOfUse'); })->name('user.terms-of-use');
Route::get('/legal', function () { return view('legal'); })->name('user.legal');
Route::get('/privacy', function () { return view('privacy'); })->name('user.privacy');
Route::get('/cookies', function () { return view('cookies'); })->name('user.cookies');
//User Blogs
Route::get('/blogs', [UserController::class, 'blogs'])->name('user.blogs');
Route::post('/blogs', [UserController::class, 'blogs_search_by_category'])->name('user.blogs-search-by-category');
Route::post('/blogs/search', [UserController::class, 'blogs_search_by_name'])->name('user.blogs-search-by-name');
//Forget Password
Route::get('forget-password', [UserController::class, 'showForgetPasswordForm'])->name('user.password-get');
Route::post('forget-password-backend', [UserController::class, 'submitForgetPasswordForm'])->name('user.password-post'); 
Route::get('reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('user.reset-password-get');
Route::post('reset-password', [UserController::class, 'submitResetPasswordForm'])->name('user.password-reset-post');

//Prevent Back Routes
Route::group(['middleware' => 'preventBack'], function () {
    //User Routes
    Route::get('/community', [UserController::class, 'community'])->name('user.community');
    Route::post('/community', [UserController::class, 'community_search_by_category'])->name('user.community-search-by-categories');
    Route::post('/community/search', [UserController::class, 'community_search_by_name'])->name('user.community-search-by-name');
    Route::get('/common-mistake', [UserController::class, 'app_mistake'])->name('user.app-mistake');
    //Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile'); 
    Route::get('account/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify'); 
    //Route::get('/profile', [UserController::class, 'profile'])->middleware(['auth', 'verified'])->name('user.profile');
    Route::get('/edit-profile', [UserController::class, 'edit_profile'])->name('user.edit-profile');
    Route::post('/update-profile', [UserController::class, 'update_profile'])->name('user.update-profile');
    Route::post('/update-password', [UserController::class, 'update_password'])->name('user.update-password');
    Route::post('/image', [UserController::class, 'image'])->name('user.image');
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/essay-grading', [UserController::class, 'uploadEassyForm'])->name('user.essay-grading');
    Route::post('/uploadEassy', [UserController::class, 'uploadEassy'])->name('UserController.uploadEassy');
    Route::get('/ask-question', [UserController::class, 'askForm'])->name('UserController.askForm');
    Route::post('/ask', [UserController::class, 'ask']);
    Route::get('/question/{id}', [UserController::class, 'question']);
    Route::post('/answer', [UserController::class, 'answer'])->name('user.answer');
    Route::get('/post', [UserController::class, 'post'])->name('post');
    Route::post('/like-answer', [UserController::class, 'like_answer']);
    Route::post('/dislike-answer', [UserController::class, 'dislike_answer']);
    Route::post('/count-like-dislike', [UserController::class, 'count_like_dislike']);
    Route::post('/like-question', [UserController::class, 'like_question']);
    Route::post('/dislike-question', [UserController::class, 'dislike_question']);
    Route::post('/count-like-dislike-question', [UserController::class, 'count_like_dislike_question']);
    Route::get('/my-account/{id}', [UserController::class, 'detail']);
    Route::get('/tests', [UserController::class, 'tests'])->name('user.tests');
    Route::get('/tests/{id}', [UserController::class, 'tests_section']);
    Route::get('/journal', [UserController::class, 'journal'])->name('user.journal');
    Route::get('/journal/{id}', [UserController::class, 'edit_journal_page'])->name('user.edit-journal');
    Route::post('/get-test', [UserController::class, 'get_test']);
    Route::post('/get-common-mistake', [UserController::class, 'get_common_mistake'])->name('user.get-common-mistake');
    Route::post('/save-test-answer', [UserController::class, 'save_test_answer']);
    Route::post('/result', [UserController::class, 'test_result']);
    Route::post('/add-journal', [UserController::class, 'add_journal']);
    Route::post('/edit-journal', [UserController::class, 'edit_journal']);
    Route::post('/backup-journal', [UserController::class, 'backup_journal'])->name('user.backup-journal');
    Route::post('/delete-journal', [UserController::class, 'delete_journal'])->name('user.delete-journal');
    Route::get('/payment-history', [UserController::class, 'payment_history'])->name('user.payment-history');
    Route::get('/payment-history-more', [UserController::class, 'payment_history_more'])->name('user.payment-history-more');
    Route::get('/evalations', [UserController::class, 'evalations_more'])->name('user.evalations');
    Route::get('/evalations-more', [UserController::class, 'evalations_more'])->name('user.evalations-more');
    //User Single Blog
    Route::get('/blog/{id}', [UserController::class, 'single_blog'])->name('user.sigle-blog');
    //Calender Events Routes
    Route::get('/calendar', [CalendarEventController::class, 'index'])->name('calendar.index');
    Route::post('/get-event', [CalendarEventController::class, 'get_event'])->name('calendar.get-event');
    Route::post('/calendar/create-event', [CalendarEventController::class, 'create'])->name('calendar.create');
    Route::post('/calendar/edit-event', [CalendarEventController::class, 'edit'])->name('calendar.edit');
    Route::post('/calendar/remove-event', [CalendarEventController::class, 'destroy'])->name('calendar.destroy');
    Route::post('/calendar/download', [CalendarEventController::class, 'getEventsICalObject'])->name('calendar.download');
    //Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/logout', [AdminController::class, 'admin_logout'])->name('admin.logout');
    //User eassays
    Route::get('/admin/eassy', [AdminController::class, 'eassy'])->name('admin.eassy');
    Route::post('/admin/eassy', [AdminController::class, 'eassy_search'])->name('admin.eassy-search');
    Route::post('/admin/eassy-grading', [AdminController::class, 'eassy_grading'])->name('admin.eassy-grading');
    Route::post('/admin/eassy-assign-to', [AdminController::class, 'eassy_assign_to'])->name('admin.eassy-assign-to');
    Route::post('/admin/grading-status', [AdminController::class, 'grading_status'])->name('admin.grading-status');
    Route::get('/admin/view-grading/{id}', [AdminController::class, 'view_grading'])->name('admin.view-grading');
    //download essay
    Route::get('/download/essays/{file}', function ($file) {
        $path = public_path('uploads/essays/' . $file);
        return response()->download($path);
    });
    //Admins
    Route::get('/admin/admins', [AdminController::class, 'admins'])->name('admin.admins');
    Route::post('/admin/add-admin', [AdminController::class, 'add_admin'])->name('admin.add-admin');
    Route::post('/admin/delete-admin', [AdminController::class, 'delete_admins'])->name('admin.delete-admin');
    //Admin Event
    Route::get('/admin/events', [AdminController::class, 'events'])->name('admin.events');
    Route::get('/admin/calendar-view', [AdminController::class, 'calendar_view'])->name('admin.calendar-view');
    Route::post('/admin/add-event', [AdminController::class, 'add_event'])->name('admin.add-event');
    Route::get('/admin/calendar', [AdminController::class, 'calendar'])->name('admin.calendar');
    Route::post('/admin/delete-event', [AdminController::class, 'delete_event'])->name('admin.delete-event');
    Route::post('/admin/calendar/create-event', [AdminController::class, 'create'])->name('admin.create');
    Route::patch('/admin/calendar/edit-event', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/get-event', [AdminController::class, 'get_event'])->name('admin.get-event');
    //Events Categories
    Route::get('/admin/events-categories', [AdminController::class, 'events_categories'])->name('admin.events-categories');
    Route::post('/admin/add-events-category', [AdminController::class, 'add_events_category'])->name('admin.add-events-category');
    Route::post('/admin/delete-events-category', [AdminController::class, 'delete_event_category'])->name('admin.delete-events-category');
    //packages
    Route::get('/admin/packages', [AdminController::class, 'packages'])->name('admin.package');
    Route::post('/admin/add-package', [AdminController::class, 'addPackage'])->name('admin.add-package');
    Route::post('/admin/delete-package', [AdminController::class, 'deletePackage'])->name('admin.delete-package');
    //User
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users', [AdminController::class, 'search_users'])->name('admin.search-users');
    Route::get('/admin/user/{id}', [AdminController::class, 'user_profile']);
    Route::get('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
    Route::post('/admin/add-user', [AdminController::class, 'add_user'])->name('admin.add-user');
    Route::get('/admin/get-users', [AdminController::class, 'get_users'])->name('admin.get-users');
    //Community questions
    Route::get('/admin/community-questions', [AdminController::class, 'question'])->name('admin.community-questions');
    Route::post('/admin/community-questions', [AdminController::class, 'question_search'])->name('admin.community-questions-search');
    Route::post('/admin/change-status', [AdminController::class, 'change_status'])->name('admin.change-status');
    //Tutorials Categories
    Route::get('/admin/tutorials-categories', [AdminController::class, 'tutorials_categories'])->name('admin.tutorials-categories');
    Route::post('/admin/add-tutorial-category', [AdminController::class, 'add_tutorial_category'])->name('admin.add-tutorial-category');
    Route::post('/admin/delete-tutorial-category', [AdminController::class, 'delete_tutorial_category'])->name('admin.delete-tutorial-category');
    //videos
    Route::get('/admin/tutorials', [AdminController::class, 'add_video_form'])->name('admin.tutorials');
    Route::post('/admin/add-tutorial', [AdminController::class, 'add_video'])->name('admin.add-tutorial');
    Route::post('/admin/show-tutorial', [AdminController::class, 'show_video'])->name('admin.show-tutorial');
    Route::post('/admin/delete-tutorial', [AdminController::class, 'delete_video'])->name('admin.delete-tutorial');
    //Test
    Route::get('/admin/tests', [AdminController::class, 'test_page'])->name('admin.tests');
    Route::post('/admin/add-test', [AdminController::class, 'add_test'])->name('admin.add-test');
    Route::post('/admin/publish-test', [AdminController::class, 'publish_test'])->name('admin.publish-test');
    Route::post('/admin/delete-test', [AdminController::class, 'delete_test'])->name('admin.delete-test');
    //Test questions
    Route::get('/admin/test-sections/{id}/{name}', [AdminController::class, 'test_sections_page']);
    Route::post('/admin/add-section', [AdminController::class, 'add_section'])->name('admin.add-section');
    Route::post('/admin/delete-section', [AdminController::class, 'delete_section'])->name('admin.delete-section');
    //Test questions
    Route::get('/admin/test-question/{id}/{name}', [AdminController::class, 'test_question_page']);
    Route::post('/admin/add-test-question', [AdminController::class, 'add_test_question'])->name('admin.add-test-question');
    Route::post('/admin/delete-test-question', [AdminController::class, 'delete_test_question'])->name('admin.delete-test-question');
    //Tips Category
    Route::get('/admin/tip-category', [AdminController::class, 'tip_category_page'])->name('admin.tips-category');
    Route::post('/admin/add-tips-category', [AdminController::class, 'add_tips_category'])->name('admin.add-tips-category');
    Route::post('/admin/delete-tips-category', [AdminController::class, 'delete_tips_category'])->name('admin.delete-tips-category');
    //Tips Sub Category
    Route::get('/admin/tip-sub-category', [AdminController::class, 'tip_sub_category_page'])->name('admin.tips-sub-category');
    Route::post('/admin/add-tips-sub-category', [AdminController::class, 'add_tips_sub_category'])->name('admin.add-tip-sub-category');
    Route::post('/admin/delete-tips-sub-category', [AdminController::class, 'delete_tips_sub_category'])->name('admin.delete-tip-sub-category');
    //Tips
    Route::get('/admin/tips', [AdminController::class, 'tips_page'])->name('admin.tips');
    Route::post('/admin/add-tip', [AdminController::class, 'add_tip'])->name('admin.add-tip');
    Route::post('/admin/delete-tip', [AdminController::class, 'delete_tip'])->name('admin.delete-tip');
    Route::post('/admin/get-tips-sub-categories', [AdminController::class, 'get_tips_sub_categories'])->name('admin.get-tips-sub-cat');
    Route::get('/admin/tip-detail/{id}', [AdminController::class, 'tip_detail']);
    //Common Mistake Category
    Route::get('/admin/common-mistake-categories', [AdminController::class, 'cm_category_page'])->name('admin.cm-category');
    Route::post('/admin/add-common-mistake-category', [AdminController::class, 'add_cm_category'])->name('admin.add-cm-category');
    Route::post('/admin/delete-common-mistake-category', [AdminController::class, 'delete_cm_category'])->name('admin.delete-cm-category');
    //Common Mistake Sub Category
    Route::get('/admin/common-mistake-sub-category', [AdminController::class, 'cm_sub_category_page'])->name('admin.cm-sub-category');
    Route::post('/admin/add-common-mistake-sub-category', [AdminController::class, 'add_cm_sub_category'])->name('admin.add-cm-sub-category');
    Route::post('/admin/delete-common-mistake-sub-category', [AdminController::class, 'delete_cm_sub_category'])->name('admin.delete-cm-sub-category');
    //Common Mistake
    Route::get('/admin/common-mistakes', [AdminController::class, 'cm_page'])->name('admin.common-mistakes');
    Route::post('/admin/add-common-mistake', [AdminController::class, 'add_cm'])->name('admin.add-cm');
    Route::post('/admin/delete-common-mistake', [AdminController::class, 'delete_cm'])->name('admin.delete-cm');
    Route::post('/admin/get-common-mistake-sub-categories', [AdminController::class, 'get_cm_sub_categories'])->name('admin.get-cm-sub-cat');
    Route::get('/admin/common-mistake-detail/{id}', [AdminController::class, 'cm_detail']);
    //Blog Category
    Route::get('/admin/blog-categories', [AdminController::class, 'blog_category_page'])->name('admin.blog-category');
    Route::post('/admin/add-blog-category', [AdminController::class, 'add_blog_category'])->name('admin.add-blog-category');
    Route::post('/admin/delete-blog-category', [AdminController::class, 'delete_blog_category'])->name('admin.delete-blog-category');
    //Blog Tags
    Route::get('/admin/blog-tags', [AdminController::class, 'blog_tag_page'])->name('admin.blog-tags');
    Route::post('/admin/add-blog-tags', [AdminController::class, 'add_blog_tag'])->name('admin.add-blog-tag');
    Route::post('/admin/delete-blog-tag', [AdminController::class, 'delete_blog_tag'])->name('admin.delete-blog-tag');
    //Admin Blogs
    Route::get('/admin/blogs', [AdminController::class, 'blog_page'])->name('admin.blogs');
    Route::post('/admin/add-blog', [AdminController::class, 'add_blog'])->name('admin.add-blog');
    Route::post('/admin/delete-blog', [AdminController::class, 'delete_blog'])->name('admin.delete-blog');
    Route::get('/admin/blog/{id}', [AdminController::class, 'blog_detail']);
    //Admin Account
    Route::get('/admin/profile', [AdminController::class, 'admin_profile'])->name('admin.profile');
    Route::post('/admin/update-profile', [AdminController::class, 'update_admin_profile'])->name('admin.update-profile');
    Route::post('/admin/delete-profile', [AdminController::class, 'delete_admin'])->name('admin.delete-profile');
    //Add Role
    Route::post('/admin/add-role', [AdminController::class, 'add_role'])->name('admin.add-role');
    //Withdraw Request Grader
    Route::get('/admin/withdraw-requests', [AdminController::class, 'withdraw_grader'])->name('admin.withdraw-requests-g');
    Route::get('/admin/withdraw-request', [AdminController::class, 'withdraw_admin'])->name('admin.withdraw-requests-a');
    Route::post('/admin/change-withdraw-request-status', [AdminController::class, 'change_withdraw_request_status'])->name('admin.change-withdraw-request-status');
    //Bank account
    Route::post('/admin/add-bank-account', [AdminController::class, 'add_bank_account'])->name('admin.add-bank-account');
    Route::post('/admin/submit-withdraw-request', [AdminController::class, 'submit_withdraw_request'])->name('admin.submit-withdraw-request');
    //Upload User Essay
    Route::post('/admin/upload-user-essay', [AdminController::class, 'upload_user_essay'])->name('admin.upload-user-essay');
    //Ask Community Question
    Route::post('/admin/ask', [AdminController::class, 'ask'])->name('admin.ask');
});

Route::get('/twizzel-admin', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
