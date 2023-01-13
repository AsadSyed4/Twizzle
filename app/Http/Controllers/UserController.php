<?php

namespace App\Http\Controllers;

use App\Exports\ClassesExport;
use App\Exports\ExtraExport;
use App\Models\CommunityQuestionAnswersModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\SubscriptionModel;
use App\Models\EassyModel;
use App\Models\CommunityQuestionTypesModel;
use App\Models\CommunityQuestionsModel;
use App\Models\LikesAnswersModel;
use App\Models\DislikesAnswersModel;
use App\Models\LikesQuestionsModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\DislikesQuestionsModel;
use App\Models\VideoModel;
use App\Models\blogs;
use App\Models\Tests;
use App\Models\UserTestAnswers;
use App\Models\UsersJournal;
use App\Mail\NotifyMail;
use App\Models\AdminEvents;
use App\Models\Admins;
use App\Models\blogCategories;
use App\Models\CalendarEventModel;
use App\Models\CommonMistakes;
use App\Models\PasswordReset;
use App\Models\StudentClassesGrades;
use App\Models\StudentExtraCurriculars;
use App\Models\TestsSections;
use App\Models\Transection;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\IcalendarGenerator\Components\Calendar;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function home()
    {
        //dd(session()->all());
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function app_mistake()
    {
        return view('app-mistake');
    }

    public function who_we_are()
    {
        return view('who-we-are');
    }

    public function guide_and_tutorial_test()
    {
        return view('guideAndTutorialsTest');
    }

    public function faqs_planner()
    {
        return view('faqPlanner');
    }

    public function faqs_gat()
    {
        return view('faqGuide&Tutorials');
    }

    public function faqs_common_app_essays()
    {
        return view('faqCommonAppEssay');
    }

    public function faqs_community()
    {
        return view('faqCommunity');
    }

    public function faqs_payment()
    {
        return view('faqPaymnet');
    }

    public function faqs_other()
    {
        return view('faqOther');
    }

    public function planning()
    {
        if (session()->get('LoggedIn')) {
            return view('planner');
        } else {
            notify()->info('Please Login or Register for Planner.', '', 'topRight');
            return redirect('/');
        }
    }

    public function planner_grade()
    {
        if (session()->get('LoggedIn')) {
            return view('planner-grade');
        } else {
            notify()->info('Please Login or Register for Planner Grade.', '', 'topRight');
            return redirect('/');
        }
    }

    public function add_planner_grade(Request $request)
    {
        if (session()->get('LoggedIn')) {
            $request->validate([
                'year' => 'required',
                'course_title' => 'required',
                'teacher_name' => 'required',
                'final_grade' => 'required',
                'gpa' => 'required',
                'interest' => 'required',
            ]);
            $class = new StudentClassesGrades();
            $class->users_id = session()->get('user_id');
            $class->year = $request->year;
            $class->course_title = $request->course_title;
            $class->teacher_name = $request->teacher_name;
            $class->final_grade = $request->final_grade;
            $class->gpa = $request->gpa;
            $class->interest = $request->interest;
            if ($class->save()) {
                notify()->success('Added.', '', 'topRight');
            } else {
                notify()->error('Try Again.', '', 'topRight');
            }
            return redirect()->back();
        } else {
            notify()->info('Please Login or Register.', '', 'topRight');
            return redirect('/');
        }
    }

    public function export_extra()
    {
        if (session()->get('LoggedIn')) {

            $file_name = 'Classes & grades_' . date('m_Y_d_H_i_s') . '.xlsx';
            return \Excel::download(new ExtraExport, $file_name);
        } else {
            notify()->info('Please Login or Register for export.', '', 'topRight');
            return redirect('/');
        }
    }

    public function planner_extracurriculars()
    {
        if (session()->get('LoggedIn')) {
            return view('planner-extrac');
        } else {
            notify()->info('Please Login or Register for Planner Extracurriculars.', '', 'topRight');
            return redirect('/');
        }
    }

    public function add_planner_extracurriculars(Request $request)
    {
        if (session()->get('LoggedIn')) {
            $request->validate([
                'organization' => 'required',
                'duties_responsibilities' => 'required',
                'interest' => 'required',
            ]);
            $extra = new StudentExtraCurriculars();
            $extra->users_id = session()->get('user_id');
            $extra->organization = $request->organization;
            $extra->duties_responsibilities = $request->duties_responsibilities;
            $extra->interest = $request->interest;
            if ($extra->save()) {
                notify()->success('Added.', '', 'topRight');
            } else {
                notify()->error('Try Again.', '', 'topRight');
            }
            return redirect()->back();
        } else {
            notify()->info('Please Login or Register.', '', 'topRight');
            return redirect('/');
        }
    }

    public function export_classes()
    {
        if (session()->get('LoggedIn')) {

            $file_name = 'Classes & grades_' . date('m_Y_d_H_i_s') . '.xlsx';
            return \Excel::download(new ClassesExport, $file_name);
        } else {
            notify()->info('Please Login or Register for export.', '', 'topRight');
            return redirect('/');
        }
    }

    public function planner_date(Request $request)
    {
        if (session()->get('LoggedIn')) {
            if ($request->check_event == 2) {
                $events = AdminEvents::with('event_categories')->orderBy('start', 'asc')->get();
            } else {
                $events = new AdminEvents();
                foreach ($request->cat as $key => $value) {
                    if ($key == 0) {
                        $events = $events->where('event_categories_id', '=', $value);
                    } else {
                        $events = $events->orWhere('event_categories_id', '=', $value);
                    }
                }
                $events = $events->with('event_categories')->orderBy('start', 'desc')->get();
            }
            $data = compact('events');
            return view('planner-date')->with($data);
        } else {
            notify()->info('Please Login or Register for Planner.', '', 'topRight');
            return redirect('/');
        }
    }

    public function master_plan()
    {
        return view('master-plan');
    }

    public function save_to_calander(Request $request)
    {
        if ($request->ajax()) {
            foreach ($request->event as $id) {
                $event = AdminEvents::where('id', '=', $id)->first();
                $user_event = new CalendarEventModel();
                $user_event->user_id = session()->get('user_id');
                $user_event->title = $event->title;
                $user_event->type = 'Event';
                $user_event->description = $event->description;
                $user_event->start = $event->start;
                $user_event->end = $event->end;
                $user_event->save();
            }
            return response()->json([
                'success' => true,
                'message' => 'Event Added.'
            ]);
        }
    }

    public function signUpForm()
    {
        return view('signup');
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'current_year' => 'required',
            'expected_graduation_date' => 'required',
            'high_school_name' => 'required',
            'public_private' => 'required',
            'demographic' => 'required',
            'target_school' => 'required',
            'time_commitment' => 'required'
        ]);
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $request->password)) {
            $user = new UserModel();
            $profile = new UserProfileModel();
            $usernameExist = UserModel::where('username', '=', $request->username)->get();
            if (empty($usernameExist->toArray())) {
                $emailExist = UserModel::where('email', '=', $request->email)->get();
                if (empty($emailExist->toArray())) {
                    $user->username = $request['username'];
                    $user->email = $request['email'];
                    $user->password = md5($request['password']);
                    $user->status = "Active";
                    $user->save();
                    if (!empty($user->id)) {
                        $profile->user_id = $user->id;
                        $profile->f_name = $request['first_name'];
                        $profile->l_name = $request['last_name'];
                        $profile->state = $request['state'];
                        $profile->city = $request['city'];
                        $profile->zip = $request['zip_code'];
                        $profile->current_year = $request['current_year'];
                        $profile->expected_graduation_date = $request['expected_graduation_date'];
                        $profile->high_school_name = $request['high_school_name'];
                        $profile->school_type = $request['public_private'];
                        $profile->school_rank = $request['school_rank'];
                        $profile->gender = $request['demographic'];
                        $profile->target_school = $request['target_school'];
                        $profile->time_commitment = $request['time_commitment'];
                        $profile->save();
                        $token = Str::random(64);
                        UserVerify::create([
                            'users_id' => $user->id,
                            'token' => $token
                        ]);

                        Mail::send('emails.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
                            $message->to($request->email);
                            $message->subject('Email Verification Mail');
                        });
                        $success = "Successfully registered. Verification email sent.";
                        notify()->success($success, "", "topRight");
                        return redirect('/');
                    }
                } else {
                    $error = "Email already register";
                    notify()->error($error, "", "topRight");
                    return redirect()->back();
                }
            } else {
                $error = "Username taken";
                notify()->error($error, "", "topRight");
                return redirect()->back();
            }
        } else {
            notify()->warning('Please Letter, Number and Special Character.');
            return redirect()->back();
        }
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->with('users')->first();
        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->users;

            if (!$user->is_email_verified) {
                $verifyUser->users->is_email_verified = 1;
                $verifyUser->users->email_verified_at = date('Y-m-d H:i:s');
                $verifyUser->users->save();
                notify()->success('Your e-mail is verified. You can now login.', '', 'topRight');
            } else {
                notify()->success('Your e-mail is already verified. You can now login.', '', 'topRight');
            }
        }
        return redirect('/');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'current_year' => 'required',
            'expected_graduation_date' => 'required',
            'high_school_name' => 'required',
            'public_private' => 'required',
            'demographic' => 'required',
            'target_school' => 'required',
            'time_commitment' => 'required'
        ]);
        $update = UserProfileModel::where('user_id', '=', session()->get('user_id'))->update([
            'f_name' => $request->first_name,
            'l_name' => $request->last_name,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip_code,
            'current_year' => $request->current_year,
            'expected_graduation_date' => $request->expected_graduation_date,
            'high_school_name' => $request->high_school_name,
            'school_type' => $request->public_private,
            'gender' => $request->demographic,
            'target_school' => $request->target_school,
            'time_commitment' => $request->time_commitment
        ]);
        if ($update) {
            notify()->success('Profile Updated.', "", "topRight");
            return redirect('/logout');
        } else {
            notify()->error('Try Again.', "", "topRight");
            return redirect()->back();
        }
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $request->password)) {
            if (strlen($request->password) > 7) {
                $update = UserModel::Where('id', '=', session()->get('user_id'))->update(['password' => md5($request->password)]);
                if ($update) {
                    notify()->success('Password Updated.', "", "topRight");
                    return redirect('/logout');
                } else {
                    notify()->error('Try Again.', "", "topRight");
                    return redirect()->back();
                }
            } else {
                notify()->warning('Password must be minimum 8 characters.');
                return redirect()->back();
            }
        } else {
            notify()->warning('Please Letter, Number and Special Character.');
            return redirect()->back();
        }
    }

    public function check_username(Request $request)
    {
        if ($request->ajax()) {
            $usernameExist = UserModel::where('username', '=', $request->text)->count();
            if ($usernameExist == 0) {
                return response()->json([
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                ]);
            }
        }
    }

    public function check_email(Request $request)
    {
        if ($request->ajax()) {
            $usernameExist = UserModel::where('email', '=', $request->text)->count();
            if ($usernameExist == 0) {
                return response()->json([
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                ]);
            }
        }
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $username = $request['email'];
        $password = md5($request['password']);

        $user = UserModel::where(function ($query) use ($username) {
            $query->where('email', '=', $username)->orWhere('username', '=', $username);
        })->where('password', '=', $password)->where('status', '=', 'Active')->where('is_email_verified', '=', '1')->first();
        if (!is_null($user)) {
            session()->put('user_id', $user->id);
            session()->put('user_name', $user->username);
            session()->put('user_mail', $user->email);
            session()->put('LoggedIn', true);
            $success = "Log In Successful.";
            notify()->success($success, "", "topRight");
            return redirect()->back();
        } else {
            $error = "Email or Password invalid.";
            notify()->error($error, "", "topRight");
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->forget('user_id');
        session()->forget('user_name');
        session()->put('LoggedIn', false);
        return redirect('/');
    }

    public function uploadEassyForm()
    {
        if (session()->get('LoggedIn')) {
            $packages = SubscriptionModel::all();
            $data = compact('packages');
            return view('uploadEassyForm')->with($data);
        } else {
            notify()->info('Please Login or Register for Essay Grading.', '', 'topRight');
            return redirect('/');
        }
    }

    public function uploadEassy(Request $request)
    {
        $request->validate([
            "eassy" => "required|file"
        ]);
        $uploadedFile = $request->file('eassy')->getClientOriginalName();
        $uploadedFileName = pathinfo($uploadedFile, PATHINFO_FILENAME);
        $fileName = $uploadedFileName . "-" . session()->get('user_name') . "-" . session()->get('user_id') . "." . $request->file('eassy')->getClientOriginalExtension();
        $uploaded = $request->file('eassy')->storeAs('essays', $fileName, ['disk' => 'public']);
        if (!empty($uploaded)) {
            $eassy = new EassyModel();
            $eassy->user_id = session()->get('user_id');
            $eassy->subscription_id = $request->package;
            $eassy->media = $uploaded;
            $eassy->university = $request->university;
            if ($eassy->save()) {
                $transection = new Transection();
                $transection->user_id = session()->get('user_id');
                $transection->description = 'Paid';
                $transection->transection_type = 'Out';
                $transection->balance = SubscriptionModel::where('id', '=', $request->package)->first()->sub_price;
                $transection->save();
                notify()->success("Eassy Uploaded Successfully!", "", "topRight");
                return view('successEssay');
            } else {
                notify()->error("Please try Again!", "", "topRight");
                return redirect()->back();
            }
        } else {
            notify()->error("Eassy Not Uploaded. Please try Again!", "", "topRight");
            return redirect()->back();
        }
    }

    public function community()
    {
        if (session()->get('LoggedIn')) {
            $selected = array();
            $sort = '';
            $question_types = CommunityQuestionTypesModel::all();
            $questions = CommunityQuestionsModel::Where('status', '=', 'Open')->with('community_question_types', 'users', 'admins')->orderBy('created_at', 'desc')->get();
            $data = compact('question_types', 'questions', 'selected','sort');
            return view('community')->with($data);
        } else {
            notify()->info('Please Login or Register for Community.', '', 'topRight');
            return redirect('/');
        }
    }

    public function community_search_by_category(Request $request)
    {
        if (session()->get('LoggedIn')) {
            $selected = $request->selected;
            $sort = $request->sort;
            $question_types = CommunityQuestionTypesModel::all();
            if (!empty($request->selected)) {
                $questions = CommunityQuestionsModel::Where('status', '=', 'Open')->where(
                    function ($query) use ($request) {
                        $i = 1;
                        foreach ($request->selected as $value) {
                            if ($i == 1) {
                                $query->where('qestion_type_id', "=", $value);
                            } else {
                                $query->orWhere('qestion_type_id', "=", $value);
                            }
                            $i++;
                        }
                    }
                )->with('community_question_types', 'users', 'admins');
                if($request->sort=='newest'){
                    $questions=$questions->orderBy('id', 'desc')->get();
                }else{
                    $questions=$questions->orderBy('id', 'asc')->get();
                }
            } else {
                $questions = CommunityQuestionsModel::Where('status', '=', 'Open')->with('community_question_types', 'users', 'admins');
                if($request->sort=='newest'){
                    $questions=$questions->orderBy('id', 'desc')->get();
                }else{
                    $questions=$questions->orderBy('id', 'asc')->get();
                }
            }
            $data = compact('questions', 'question_types', 'selected','sort');
            return view('community')->with($data);
        } else {
            notify()->info('Please Login or Register for Community.', '', 'topRight');
            return redirect('/');
        }
    }

    public function community_search_by_name(Request $request)
    {
        if (session()->get('LoggedIn')) {
            $selected = array();
            $question_types = CommunityQuestionTypesModel::all();
            if (!empty($request->name)) {
                $questions = CommunityQuestionsModel::Where('status', '=', 'Open')->where(
                    function ($query) use ($request) {
                        $query->where('title', "LIKE", "%" . $request->name . "%");
                        $query->orWhere('description', "=", "%" . $request->name . "%");
                    }
                )->with('community_question_types', 'users', 'admins')->orderBy('created_at', 'desc')->get();
            } else {
                $questions = CommunityQuestionsModel::Where('status', '=', 'Open')->with('community_question_types', 'users', 'admins')->orderBy('created_at', 'desc')->get();
            }
            $data = compact('questions', 'question_types', 'selected');
            return view('community')->with($data);
        } else {
            notify()->info('Please Login or Register for Community.', '', 'topRight');
            return redirect('/');
        }
    }

    public function profile()
    {
        if (session()->get('LoggedIn')) {
            $user = UserModel::where('status', '=', 'Active')->where('id', '=', session()->get('user_id'))->with('user_profile')->first();
            $data = compact('user');
            return view('profile')->with($data);
        } else {
            notify()->info('Please Login or Register for User Profile.', '', 'topRight');
            return redirect('/');
        }
    }

    public function edit_profile()
    {
        if (session()->get('LoggedIn')) {
            $user = UserModel::where('status', '=', 'Active')->where('id', '=', session()->get('user_id'))->with('user_profile')->first();
            $data = compact('user');
            return view('edit')->with($data);
        } else {
            notify()->info('Please Login or Register for Edit Profile.', '', 'topRight');
            return redirect('/');
        }
    }

    public function payment_history()
    {
        if (session()->get('LoggedIn')) {
            $payments = Transection::where('user_id', '=', session()->get('user_id'))->orderBy('id', 'desc')->take(5)->get();
            $data = compact('payments');
            return view('payment')->with($data);
        } else {
            notify()->info('Please Login or Register for Payment History.', '', 'topRight');
            return redirect('/');
        }
    }

    public function payment_history_more()
    {
        if (session()->get('LoggedIn')) {
            $payments = Transection::where('user_id', '=', session()->get('user_id'))->orderBy('id', 'desc')->get();
            $data = compact('payments');
            return view('paymentMore')->with($data);
        } else {
            notify()->info('Please Login or Register for Payment History.', '', 'topRight');
            return redirect('/');
        }
    }

    public function evalations()
    {
        if (session()->get('LoggedIn')) {
            //$payments=Transection::where('user_id','=',session()->get('user_id'))->orderBy('id','desc')->take(5)->get();
            //$data = compact('payments');
            return view('evaluations');
        } else {
            notify()->info('Please Login or Register for Evalations History.', '', 'topRight');
            return redirect('/');
        }
    }

    public function evalations_more()
    {
        if (session()->get('LoggedIn')) {
            //$payments=Transection::where('user_id','=',session()->get('user_id'))->orderBy('id','desc')->take(5)->get();
            //$data = compact('payments');
            return view('pdf');
        } else {
            notify()->info('Please Login or Register for Evalations History.', '', 'topRight');
            return redirect('/');
        }
    }

    public function image(Request $request)
    {
        if (!empty($request->file('myPhoto'))) {
            $uploadedFile = $request->file('myPhoto')->getClientOriginalName();
            $uploadedFileName = pathinfo($uploadedFile, PATHINFO_FILENAME);
            $fileName = $uploadedFileName . "-" . session()->get('user_name') . "-" . session()->get('user_id') . "." . $request->file('myPhoto')->getClientOriginalExtension();
            $uploaded = $request->file('myPhoto')->storeAs('users', $fileName, ['disk' => 'public']);
            if ($uploaded) {
                $update = UserProfileModel::where('user_id', '=', session()->get('user_id'))->update(['media' => $uploaded]);
                if ($update) {
                    notify()->success('Image Updated.', '', 'topRight');
                    return redirect()->back();
                } else {
                    notify()->error('Try Again.', '', 'topRight');
                    return redirect()->back();
                }
            } else {
                notify()->error('Image Not Uploaded.', '', 'topRight');
                return redirect()->back();
            }
        } else {
            notify()->warning('Please Select Image.', '', 'topRight');
            return redirect()->back();
        }
    }

    public function askForm()
    {
        $data = array();
        $question_types = CommunityQuestionTypesModel::all();
        $data = compact('question_types');
        return view('ask-question')->with($data);
    }

    public function ask(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'question_type' => 'required'
        ]);
        $question = new CommunityQuestionsModel();
        if (!empty($request->file('question_media'))) {
            $uploadedFile = $request->file('question_media')->getClientOriginalName();
            $uploadedFileName = pathinfo($uploadedFile, PATHINFO_FILENAME);
            $fileName = $uploadedFileName . "-" . session()->get('user_name') . "-" . session()->get('user_id') . "." . $request->file('question_media')->getClientOriginalExtension();
            $uploaded = $request->file('question_media')->storeAs('communty', $fileName, ['disk' => 'public']);
            if (!empty($uploaded)) {
                $question->title = $request->title;
                $question->description = $request->description;
                $question->qestion_type_id = $request->question_type;
                $question->media = $uploaded;
                $question->user_id = session()->get('user_id');
                $question->status = 'Pending';
                if ($question->save()) {
                    $success = "Question submitted to Admin. Your question will be published after approved.";
                    notify()->success($success, "", "topRight");
                } else {
                    $error = "Try Again Later.";
                    notify()->error($error, "", "topRight");
                }
            } else {
                $error = "Question media not Uploaded try again.";
                notify()->error($error, "", "topRight");
            }
        } else {
            $question->title = $request->title;
            $question->description = $request->description;
            $question->qestion_type_id = $request->question_type;
            $question->user_id = session()->get('user_id');
            $question->status = 'Pending';
            if ($question->save()) {
                $success = "Question submitted to Admin. Your question will be published after approved.";
                notify()->success($success, "", "topRight");
            } else {
                $error = "Try Again Later.";
                notify()->error($error, "", "topRight");
            }
        }
        return redirect()->back();
    }

    public function question($id)
    {
        if (session()->get('LoggedIn')) {
            $question = CommunityQuestionsModel::find($id);
            if (!is_null($question)) {
                $selected = array();
                $sort = '';
                $question_types = CommunityQuestionTypesModel::all();
                $question = CommunityQuestionsModel::Where('id', '=', $id)->with('community_question_types', 'users', 'admins', 'answers')->first();
                $count_likes_question = LikesQuestionsModel::where('question_id', '=', $id)->count();
                $count_dis_likes_question = DislikesQuestionsModel::where('question_id', '=', $id)->count();
                $answers = CommunityQuestionAnswersModel::leftJoin('users', 'community_question_answers.user_id', '=', 'users.id')->select(['community_question_answers.id as id', 'community_question_answers.answer as answer', 'community_question_answers.created_at as created_at', 'users.username as username'])
                    ->where('community_question_answers.question_id', '=', $id)->get();
                if (!empty($answers->toArray())) {
                    foreach ($answers as $answer) {
                        $likes = LikesAnswersModel::where('question_id', '=', $id)->where('answer_id', '=', $answer->id)->get();
                        $count_likes[$answer->id] = count($likes);
                        $dis_like = DislikesAnswersModel::where('question_id', '=', $id)->where('answer_id', '=', $answer->id)->get();
                        $count_dis_likes[$answer->id] = count($dis_like);
                    }
                }
                $data = array();
                if (!empty($answers->toArray())) {
                    $data = compact('question_types', 'question', 'answers', 'count_likes', 'count_dis_likes', 'count_likes_question', 'count_dis_likes_question', 'selected','sort');
                } else {
                    $data = compact('question_types', 'question', 'answers', 'count_likes_question', 'count_dis_likes_question', 'selected','sort');
                }
                return view('question')->with($data);
            } else {
                return redirect()->back();
            }
        } else {
            notify()->info('Please Login or Register for Community.', '', 'topRight');
            return redirect('/');
        }
    }

    public function answer(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'id' => 'required'
        ]);
        $answer = new CommunityQuestionAnswersModel();
        $answer->question_id = $request->id;
        $answer->user_id = session()->get('user_id');
        $answer->answer = $request->answer;
        if ($answer->save()) {
            $success = "Your Answer Submited.";
            notify()->success($success, "", "topRight");
        } else {
            $error = "Try Again Later.";
            notify()->error($error, "", "topRight");
        }
        return redirect()->back();
    }

    public function post(Request $request)
    {
        $answers = CommunityQuestionAnswersModel::leftJoin('users', 'community_question_answers.user_id', '=', 'users.id')->select(['community_question_answers.id as id', 'community_question_answers.answer as answer', 'community_question_answers.created_at as created_at', 'users.username as username'])
            ->where('community_question_answers.question_id', '=', '9')->paginate(2);

        if ($request->ajax()) {
            $html = '';
            foreach ($answers as $answer) {
                $html .= '<div class="col-10"><p class="mb-2"><strong>' . $answer->username . '</strong></p><p>' . $answer->answer . '</p></div>';
            }

            return $html;
        }
        // return view('lazy2');
    }

    public function like_answer(Request $request)
    {
        if ($request->ajax()) {
            $like = LikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->where('user_id', '=', session()->get('user_id'))->get();
            $like = $like->toArray();
            if (empty($like)) {
                $dislike = DislikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->where('user_id', '=', session()->get('user_id'))->get();
                $dislike = $dislike->toArray();
                if (empty($dislike)) {
                    $newLike = new LikesAnswersModel();
                    $newLike->question_id = $request->question_id;
                    $newLike->answer_id = $request->answer_id;
                    $newLike->user_id = session()->get('user_id');
                    if ($newLike->save()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Liked.'
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Try Again.'
                        ]);
                    }
                } else {
                    $deleteDislike = DislikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->where('user_id', '=', session()->get('user_id'))->delete();
                    if ($deleteDislike) {
                        $newLike = new LikesAnswersModel();
                        $newLike->question_id = $request->question_id;
                        $newLike->answer_id = $request->answer_id;
                        $newLike->user_id = session()->get('user_id');
                        if ($newLike->save()) {
                            return response()->json([
                                'success' => true,
                                'message' => 'Liked.'
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Try Again.'
                            ]);
                        }
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You Already Liked Answer.'
                ]);
            }
        }
    }

    public function dislike_answer(Request $request)
    {
        if ($request->ajax()) {
            $dislike = DislikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->where('user_id', '=', session()->get('user_id'))->get();
            $dislike = $dislike->toArray();
            if (empty($dislike)) {
                $like = LikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->where('user_id', '=', session()->get('user_id'))->get();
                $like = $like->toArray();
                if (empty($like)) {

                    $newDislike = new DislikesAnswersModel();
                    $newDislike->question_id = $request->question_id;
                    $newDislike->answer_id = $request->answer_id;
                    $newDislike->user_id = session()->get('user_id');
                    if ($newDislike->save()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Disliked.'
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Try Again.'
                        ]);
                    }
                } else {
                    $deletelike = LikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->where('user_id', '=', session()->get('user_id'))->delete();
                    if ($deletelike) {
                        $newDislike = new DislikesAnswersModel();
                        $newDislike->question_id = $request->question_id;
                        $newDislike->answer_id = $request->answer_id;
                        $newDislike->user_id = session()->get('user_id');
                        if ($newDislike->save()) {
                            return response()->json([
                                'success' => true,
                                'message' => 'Disliked.'
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Try Again.'
                            ]);
                        }
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You Already Disliked Answer.'
                ]);
            }
        }
    }

    public function count_like_dislike(Request $request)
    {
        if ($request->ajax()) {
            $count_likes = LikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->count();
            $count_dis_likes = DislikesAnswersModel::where('question_id', '=', $request->question_id)->where('answer_id', '=', $request->answer_id)->count();
            return response()->json([
                'success' => true,
                'likes' => $count_likes,
                'dislikes' => $count_dis_likes
            ]);
        }
    }

    public function like_question(Request $request)
    {
        if ($request->ajax()) {
            $like = LikesQuestionsModel::where('question_id', '=', $request->question_id)->where('user_id', '=', session()->get('user_id'))->get();
            $like = $like->toArray();
            if (empty($like)) {
                $dislike = DislikesQuestionsModel::where('question_id', '=', $request->question_id)->where('user_id', '=', session()->get('user_id'))->get();
                $dislike = $dislike->toArray();
                if (empty($dislike)) {
                    $newLike = new LikesQuestionsModel();
                    $newLike->question_id = $request->question_id;
                    $newLike->user_id = session()->get('user_id');
                    if ($newLike->save()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Liked.'
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Try Again.'
                        ]);
                    }
                } else {
                    $deleteDislike = DislikesQuestionsModel::where('question_id', '=', $request->question_id)->where('user_id', '=', session()->get('user_id'))->delete();
                    if ($deleteDislike) {
                        $newLike = new LikesQuestionsModel();
                        $newLike->question_id = $request->question_id;
                        $newLike->user_id = session()->get('user_id');
                        if ($newLike->save()) {
                            return response()->json([
                                'success' => true,
                                'message' => 'Liked.'
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Try Again.'
                            ]);
                        }
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You Already Liked Question.'
                ]);
            }
        }
    }

    public function dislike_question(Request $request)
    {
        if ($request->ajax()) {
            $dislike = DislikesQuestionsModel::where('question_id', '=', $request->question_id)->where('user_id', '=', session()->get('user_id'))->get();
            $dislike = $dislike->toArray();
            if (empty($dislike)) {
                $like = LikesQuestionsModel::where('question_id', '=', $request->question_id)->where('user_id', '=', session()->get('user_id'))->get();
                $like = $like->toArray();
                if (empty($like)) {

                    $newDislike = new DislikesQuestionsModel();
                    $newDislike->question_id = $request->question_id;
                    $newDislike->user_id = session()->get('user_id');
                    if ($newDislike->save()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Disliked.'
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Try Again.'
                        ]);
                    }
                } else {
                    $deletelike = LikesQuestionsModel::where('question_id', '=', $request->question_id)->where('user_id', '=', session()->get('user_id'))->delete();
                    if ($deletelike) {
                        $newDislike = new DislikesQuestionsModel();
                        $newDislike->question_id = $request->question_id;
                        $newDislike->user_id = session()->get('user_id');
                        if ($newDislike->save()) {
                            return response()->json([
                                'success' => true,
                                'message' => 'Disliked.'
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Try Again.'
                            ]);
                        }
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You Already Disliked Question.'
                ]);
            }
        }
    }

    public function count_like_dislike_question(Request $request)
    {
        if ($request->ajax()) {
            $count_likes = LikesQuestionsModel::where('question_id', '=', $request->question_id)->count();
            $count_dis_likes = DislikesQuestionsModel::where('question_id', '=', $request->question_id)->count();
            return response()->json([
                'success' => true,
                'likes' => $count_likes,
                'dislikes' => $count_dis_likes
            ]);
        }
    }

    public function detail($id)
    {
        $find_user = UserModel::find($id);
        if (!is_null($find_user)) {
            $user = UserModel::where('users.status', '=', 'Active')->where('users.id', '=', $id)->leftJoin('user_profile', 'users.id', '=', 'user_profile.user_id')
                ->select('*')->get();
            $data = array();
            $data = compact('user');
            return view('detail')->with($data);
        } else {
            notify()->warning('Please Contact Admin', '', 'topRight');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $profile = UserProfileModel::where('user_id', '=', $request->id)
            ->update([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'state' => $request->state,
                'city' => $request->city,
                'zip' => $request->zip_code,
                'current_year' => $request->current_year,
                'expected_graduation_date' => $request->expected_graduation_date,
                'high_school_name' => $request->high_school_name,
                'school_type' => $request->public_private,
                'school_rank' => $request->school_rank,
                'gender' => $request->demographic,
                'target_school' => $request->target_school,
                'time_commitment' => $request->time_commitment
            ]);
        if (!is_null($profile)) {
            notify()->success("Profile Updated.", "", "topRight");
        } else {
            notify()->error("Try Again.", "", "topRight");
        }
        return redirect()->back();
    }

    public function guide_and_tutorial()
    {
        $selected = array();
        $sort='';
        $videos = VideoModel::where('is_show', '=', 'Show')->where('status', '=', 'Active')->orderBy('id', 'desc')->get();
        $data = compact('videos', 'selected','sort');
        return view('tutorial')->with($data);
    }

    public function videos_search_by_category(Request $request)
    {
        $selected = $request->selected;
        $sort = $request->sort;
        if (!empty($request->selected)) {
            $videos = VideoModel::Where('status', '=', 'Active')->where('status', '=', 'Active')->where(
                function ($query) use ($request) {
                    $i = 1;
                    foreach ($request->selected as $value) {
                        if ($i == 1) {
                            $query->where('tutorials_categories_id', "=", $value);
                        } else {
                            $query->orWhere('tutorials_categories_id', "=", $value);
                        }
                        $i++;
                    }
                }
            );
            if($request->sort=='newest'){
                $videos=$videos->orderBy('id', 'desc')->get();
            }else{
                $videos=$videos->orderBy('id', 'asc')->get();
            }
        } else {
            $videos = VideoModel::where('is_show', '=', 'Show')->where('status', '=', 'Active');
            if($request->sort=='newest'){
                $videos=$videos->orderBy('id', 'desc')->get();
            }else{
                $videos=$videos->orderBy('id', 'asc')->get();
            }
        }
        $data = compact('videos', 'selected','sort');
        return view('tutorial')->with($data);
    }

    public function videos_search_by_name(Request $request)
    {
        $selected = array();
        if (!empty($request->name)) {
            $videos = VideoModel::Where('status', '=', 'Active')->where('status', '=', 'Active')->where('title', "LIKE", "%" . $request->name . "%")->orderBy('id', 'desc')->get();
        } else {
            $videos = VideoModel::where('is_show', '=', 'Show')->where('status', '=', 'Active')->orderBy('id', 'desc')->get();
        }
        $data = compact('videos', 'selected');
        return view('tutorial')->with($data);
    }

    public function tests()
    {
        if (session()->get('LoggedIn')) {
            $tests = Tests::where('is_show', '=', 'Publish')->where('status', '=', 'Active')->get();
            $data = compact('tests');
            return view('test')->with($data);
        } else {
            notify()->info('Please Login or Register for Tests.', '', 'topRight');
            return redirect('/');
        }
    }

    public function tests_section($id)
    {
        if (session()->get('LoggedIn')) {
            $tests = Tests::where('is_show', '=', 'Publish')->where('status', '=', 'Active')->get();
            $section = TestsSections::where('tests_id', '=', $id)->where('status', '=', 'Active')->get();
            $data = compact('tests', 'section', 'id');
            return view('test2')->with($data);
        } else {
            notify()->info('Please Login or Register for Tests.', '', 'topRight');
            return redirect('/');
        }
    }

    public function get_test(Request $request)
    {
        if ($request->ajax()) {
            $test = Tests::where('id', '=', $request->test_id)->where('is_show', '=', 'Publish')->where('status', '=', 'Active')->with('sections')->first();
            $answers = UserTestAnswers::where('user_id', '=', session()->get('user_id'))->where('tests_id', '=', $request->test_id)->get();
            $answers = $answers->toArray();
            if (empty($answers)) {
                return response()->json([
                    'success' => true,
                    'test' => $test
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "You Attempted Test."
                ]);
            }
        }
    }

    public function get_common_mistake(Request $request)
    {
        if ($request->ajax()) {
            $common_mistake = CommonMistakes::where('cm_categories_id', '=', $request->id)->where('cm_type', '=', $request->type)->where('status', '=', 'Active')->first();
            if (!is_null($common_mistake)) {
                return response()->json([
                    'success' => true,
                    'test' => $common_mistake
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'test' => "No Example."
                ]);
            }
        }
    }

    public function save_test_answer(Request $request)
    {

        if ($request->ajax()) {
            $find = UserTestAnswers::where('user_id', '=', session()->get('user_id'))->where('tests_id', '=', $request->test_id)->where('question_id', '=', $request->question_id)->get();
            if (empty($find->toArray())) {
                $answer = new UserTestAnswers();
                $answer->user_id = session()->get('user_id');
                $answer->tests_id = $request->test_id;
                $answer->question_id = $request->question_id;
                $answer->user_answer = $request->answer;
                $answer->save();
            } else {
                UserTestAnswers::where('user_id', '=', session()->get('user_id'))->where('tests_id', '=', $request->test_id)->where('question_id', '=', $request->question_id)->update(['user_answer' => $request->answer]);
            }
        }
    }

    public function test_result(Request $request)
    {
        $test = Tests::where('id', '=', $request->test_id)->where('is_show', '=', 'Publish')->where('status', '=', 'Active')->with('questions')->get();
        $test = $test->toArray();
        $questions = $test[0]['questions'];
        $test_name = $test[0]['name'];
        $total_questions = count($test[0]['questions']);
        $attempted_questions = 0;
        $scored_marks = 0;
        foreach ($questions as $question) {
            $answers = UserTestAnswers::where('user_id', '=', session()->get('user_id'))->where('tests_id', '=', $request->test_id)->where('question_id', '=', $question['id'])->get();
            $answers = $answers->toArray();
            if (!empty($answers)) {
                foreach ($answers as $answer) {
                    if ($answer['question_id'] == $question['id']) {
                        $attempted_questions++;
                        if ($answer['user_answer'] == $question['correct_option']) {
                            $scored_marks++;
                        }
                    }
                }
            }
        }
        $data = compact('total_questions', 'attempted_questions', 'scored_marks', 'test_name');
        return view('result')->with($data);
    }

    public function journal()
    {
        if (session()->get('LoggedIn')) {
            $journals = UsersJournal::where('status', '=', 'Active')->where('user_id', '=', session()->get('user_id'))->get();
            $data = compact('journals');
            return view('journal')->with($data);
        } else {
            notify()->info('Please Login or Register for App Journal.', '', 'topRight');
            return redirect('/');
        }
    }

    public function edit_journal_page($id)
    {
        if (session()->get('LoggedIn')) {
            $journals = UsersJournal::where('status', '=', 'Active')->where('user_id', '=', session()->get('user_id'))->get();
            $data = compact('journals', 'id');            
            return view('editJournal')->with($data);
        } else {
            notify()->info('Please Login or Register for App Journal.', '', 'topRight');
            return redirect('/');
        }
    }

    public function add_journal(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'name' => 'required',
        ]);
        $journal = new UsersJournal();
        $journal->user_id = session()->get('user_id');
        $journal->description = $request->description;
        $journal->title = $request->name;
        if ($journal->save()) {
            notify()->success('Journal Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function edit_journal(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'name' => 'required'
        ]);
        $update = UsersJournal::where('id', '=', $request->id)->update(['description' => $request->description,'title'=>$request->name]);
        if ($update) {
            notify()->success('Journal Updated.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_journal(Request $request)
    {
        if ($request->ajax()) {
            $journal = UsersJournal::where('id', '=', $request->id)->delete();
            if ($journal) {
                return response()->json([
                    'success' => true,
                    'message' => 'Journal Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Try Again."
                ]);
            }
        }
    }

    public function single_blog($id)
    {
        $find = blogs::find($id);
        if ($find) {
            $blog = blogs::where('status', '=', 'Active')->where('id', '=', $id)->first();
            return view('single_blog')->with(compact('blog'));
        } else {
            return redirect()->back();
        }
    }

    public function backup_journal(Request $request)
    {
        if ($request->back_up == 2 || $request->back_up == 3) {
            Mail::to(session()->get('user_mail'))->send(new NotifyMail());

            if (Mail::flushMacros()) {
                notify()->success("Mail not sent", "", "topRight");
                return redirect()->back();
            } else {
                if ($request->back_up == 2) {
                    notify()->success("Mail Sent.", "", "topRight");
                } else {
                    notify()->success("Top Smart Added and Mail Sent.", "", "topRight");
                }
                return redirect()->back();
            }
        } else {
            notify()->success("Top Smart Added.", "", "topRight");
            return redirect()->back();
        }
    }

    public function blogs()
    {
        $selected = array();
        $sort='';
        $blog_categories = blogCategories::where('status', '=', 'Active')->get();
        $blogs = blogs::where('status', '=', 'Active')->with('blog_categories', 'tags')->orderBy('id', 'desc')->get();
        return view('blogs')->with(compact('blogs', 'blog_categories', 'selected','sort'));
    }

    public function blogs_search_by_category(Request $request)
    {
        $selected = $request->selected;
        $sort = $request->sort;
        $blog_categories = blogCategories::where('status', '=', 'Active')->get();
        if (!empty($request->selected)) {
            $blogs = blogs::Where('status', '=', 'Active')->where(
                function ($query) use ($request) {
                    $i = 1;
                    foreach ($request->selected as $value) {
                        if ($i == 1) {
                            $query->where('blog_categories_id', "=", $value);
                        } else {
                            $query->orWhere('blog_categories_id', "=", $value);
                        }
                        $i++;
                    }
                }
            )->with('blog_categories', 'tags');
            if($request->sort=='newest'){
                $blogs=$blogs->orderBy('id', 'desc')->get();
            }else{
                $blogs=$blogs->orderBy('id', 'asc')->get();
            }
        } else {
            $blogs = blogs::where('status', '=', 'Active')->with('blog_categories', 'tags');
            if($request->sort=='newest'){
                $blogs=$blogs->orderBy('id', 'desc')->get();
            }else{
                $blogs=$blogs->orderBy('id', 'asc')->get();
            }
        }
        return view('blogs')->with(compact('blogs', 'blog_categories', 'selected','sort'));
    }

    public function blogs_search_by_name(Request $request)
    {
        $selected = array();
        $blog_categories = blogCategories::where('status', '=', 'Active')->get();
        if (!empty($request->name)) {
            $blogs = blogs::Where('status', '=', 'Active')->where(
                function ($query) use ($request) {
                    $query->where('title', "LIKE", "%" . $request->name . "%");
                    $query->orWhere('short_content', "=", "%" . $request->name . "%");
                }
            )->with('blog_categories', 'tags')->orderBy('id', 'desc')->get();
        } else {
            $blogs = blogs::where('status', '=', 'Active')->with('blog_categories', 'tags')->orderBy('id', 'desc')->get();
        }
        return view('blogs')->with(compact('blogs', 'blog_categories', 'selected'));
    }

    public function showForgetPasswordForm()
    {
        return view('forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        PasswordReset::create([
            'email' => $request->email,
            'token' => $token
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        notify()->success('We have emailed you instructions to reset your password.', '', 'topRight');
        return redirect(route('user.home'));
    }

    public function showResetPasswordForm($token)
    {
        return view('resetPassword', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = PasswordReset::where('email', '=', $request->email)->where('token', '=', $request->token)->first();
        if (!$updatePassword) {
            notify()->error('Invalid token!', '', 'topRight');
            return redirect('/');
        }

        User::where('email', $request->email)->update(['password' => md5($request->password)]);

        PasswordReset::where(['email' => $request->email])->delete();
        notify()->success('Your password has been changed!', '', 'topRight');
        return redirect('/');
    }
}
