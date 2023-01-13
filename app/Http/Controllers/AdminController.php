<?php

namespace App\Http\Controllers;

use App\Models\AdminEvents;
use App\Models\Admins;
use App\Models\AdminsRoles;
use App\Models\BankAccounts;
use App\Models\CmCategories;
use App\Models\CmSubCategories;
use App\Models\CommonMistakes;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\EassyModel;
use App\Models\EssayGrading;
use App\Models\SubscriptionModel;
use App\Models\CommunityQuestionsModel;
use App\Models\CommunityQuestionTypesModel;
use App\Models\EventCategories;
use App\Models\BlogCategories;
use App\Models\blogs;
use App\Models\BlogsTags;
use App\Models\Tags;
use App\Models\UsedTags;
use App\Models\VideoModel;
use App\Models\TestQuestions;
use App\Models\Tests;
use App\Models\TestsSections;
use App\Models\Tips;
use App\Models\TipsCategories;
use App\Models\TipsSubCategories;
use App\Models\Transection;
use App\Models\TutorialsCategories;
use Illuminate\Support\Facades\Storage;
use App\Models\Wallet;
use App\Models\WithdrawRequests;
use \PDF;
use Yajra\Datatables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $active = 'index';
        return view('admin.index')->with(compact('active'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',

        ]);
        $email = $request->email;
        $pass = md5($request->password); 
        $user = Admins::where(function ($query) use ($email) {
            $query->where('email', '=', $email)->orWhere('username', '=', $email);
        })->where('password', '=', $pass)->where('status', '=', 'Active')->with('admins_roles')->first();
        if (!empty($user)) {
            $allow = explode(',', $user->admins_roles->allow);
            $admin['f_name'] = $user->first_name;
            $admin['l_name'] = $user->last_name;
            $admin['username'] = $user->username;
            $admin['role'] = $user->admins_roles->role;
            $admin['allow'] = $allow;
            $admin['email'] = $user->email;
            $admin['id'] = $user->id;
            $admin['media'] = $user->media;
            session()->put('admin', $admin);
            return redirect(route('admin.index'));
        } else {
            notify()->error('Invalid Cridentials', '', 'topRight');
            return redirect()->back();
        }
    }

    public function admin_logout()
    {
        session()->forget('admin');
        return redirect(route('admin.login'));
    }

    public function users()
    {
        $active = 'user';
        $data = compact('active');
        return view('admin.users')->with($data);
    }

    public function get_users(Request $request)
    {
        if ($request->ajax()) {
            $users = UserModel::where('status', '=', 'Active')->with('user_profile')->get();
            $users->map(function ($i) {
                $i->id = $i->id;
                $i->username = $i->username;
                $i->email = $i->email;
                $i->gender = $i->user_profile->gender;
                $i->state = $i->user_profile->state;
                $i->school_type = $i->user_profile->school_type;
                $i->school_rank = $i->user_profile->school_rank;
                $i->current_year = $i->user_profile->current_year;
                unset($i->user_profile);
                return $i;
            });
            return response()->json($users);
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    $btn = '<a href="/admin/user/' . $user->id . '" class="edit btn btn-info btn-sm">View</a> <a href="/admin/delete-user/' . $user->id . '" class="edit btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function search_users(Request $request)
    {
        if ($request->ajax()) {
            $gender = $request->s_gender;
            $state = $request->s_state;
            $school_type = $request->s_school_type;
            $school_rank = $request->s_school_rank;
            $current_year = $request->s_current_year;
            $users = UserProfileModel::query();

            if (!empty($gender)) {
                $users = $users->where('gender', '=', $gender);
            }

            if (!empty($state)) {
                $users = $users->where('state', '=', $state);
            }

            if (!empty($school_type)) {
                $users = $users->where('school_type', '=', $school_type);
            }

            if (!empty($school_rank)) {
                $users = $users->where('school_rank', '=', $school_rank);
            }

            if (!empty($current_year)) {
                $users = $users->where('current_year', '=', $current_year);
            }

            $users = $users->with('users')->get();
            $users->map(function ($i) {
                $i->id = $i->users->id;
                $i->username = $i->users->username;
                $i->email = $i->users->email;
                $i->gender = $i->gender;
                $i->state = $i->state;
                $i->school_type = $i->school_type;
                $i->school_rank = $i->school_rank;
                $i->current_year = $i->current_year;
                unset($i->users);
                return $i;
            });
            return response()->json($users);
        }
    }

    public function user_profile($id)
    {
        $find = UserModel::find($id);
        if (!is_null($find)) {
            $active = 'user';
            $user = UserModel::where('id', '=', $id)->with('user_profile')->first();
            $data = compact('active', 'user');
            return view('admin.userProfile')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function admins()
    {
        $active = 'admin';
        $data = array();
        $admins = Admins::where('status', '=', 'Active')->with('admins_roles')->orderBy('created_at', 'desc')->paginate(10);
        $roles = AdminsRoles::all();
        $data = compact('active', 'admins', 'roles');
        return view('admin.admins')->with($data);
    }

    public function add_admin(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'role_id' => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ]);
        $check_username = Admins::where('username', '=', $request->username)->count();
        if ($check_username == 0) {
            $check_email = Admins::where('email', '=', $request->email)->count();
            if ($check_email == 0) {
                $admin = new Admins();
                $admin->email = $request->email;
                $admin->first_name = $request->first_name;
                $admin->last_name = $request->last_name;
                $admin->username = $request->username;
                $admin->password = md7($request->password);
                $admin->admins_roles_id = $request->role_id;
                if ($admin->save()) {
                    notify()->success('Admin Added.', '', 'topRight');
                } else {
                    notify()->error('Try Again.', '', 'topRight');
                }
            } else {
                notify()->error('Email Already Exist.', '', 'topRight');
            }
        } else {
            notify()->error('Username Taken.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_admins(Request $request)
    {
        if ($request->ajax()) {
            $admin = Admins::find($request->id);
            if (!is_null($admin)) {
                $admin->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Admin Deleted'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin Not Found'
                ]);
            }
        }
    }

    public function deleteUser($id)
    {
        $user = UserModel::find($id);
        if ($user) {
            UserProfileModel::where('user_id', '=', $id)->update(['status' => 'Deleted']);
            EassyModel::where('user_id', '=', $id)->delete();
            \App\Models\UsersJournal::where('user_id', '=', $id)->delete();
            \App\Models\CalendarEventModel::where('user_id', '=', $id)->delete();
            $user->status = "Deleted";
            $user->save();
            notify()->success('User Deleted', '', 'topRight');
        } else {
            notify()->error('User Not Found', '', 'topRight');
        }
        return redirect()->back();
    }

    public function eassy()
    {
        $active = 'eassy';
        if (session()->get('admin.role') == "Super Admin") {
            $admins = Admins::where('admins_roles_id', '=', 3)->get();
            $users = UserModel::where('status', '=', 'Active')->orderBy('created_at', 'desc')->get();
            $packages = SubscriptionModel::orderBy('created_at', 'desc')->get();
            $eassys = EassyModel::with('users', 'essay_grading', 'subscription', 'admins')->orderBy('essay.created_at', 'desc')->paginate(10);
            $data = compact('eassys', 'active', 'admins', 'users', 'packages');
            return view('admin.eassy')->with($data);
        } else {
            $eassys = EassyModel::where('admins_id', '=', session()->get('admin.id'))->with('users', 'essay_grading', 'subscription')->orderBy('essay.created_at', 'desc')->paginate(10);
            $data = compact('eassys', 'active');
            return view('admin.eassy')->with($data);
        }
    }

    public function packages()
    {
        $active = 'package';
        $packages = SubscriptionModel::paginate(7);
        $data = compact('active', 'packages');
        return view('admin.packages')->with($data);
    }

    public function deletePackage(Request $request)
    {
        if ($request->ajax()) {
            $package = SubscriptionModel::find($request->id);
            if (!is_null($package)) {
                EassyModel::where('subscription_id', '=', $request->id)->delete();
                $package->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Package Deleted'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Package Not Found'
                ]);
            }
        }
    }

    public function addPackage(Request $request)
    {
        $request->validate([
            'package_name' => 'required',
            'package_description' => 'required',
            'package_price' => 'required'
        ]);
        $package = new SubscriptionModel();
        $package->subscription_name = $request['package_name'];
        $package->description = $request['package_description'];
        $package->sub_price = $request['package_price'];
        if ($package->save()) {
            notify()->success('Package Added', '', 'topRight');
        } else {
            notify()->error('Try Again', '', 'topRight');
        }
        return redirect()->back();
    }

    public function question()
    {
        $active = 'community';
        $question_types = CommunityQuestionTypesModel::orderBy('created_at', 'desc')->get();
        $questions = CommunityQuestionsModel::with('community_question_types', 'users', 'admins')->orderBy('created_at', 'desc')->paginate(7);
        $data = compact('questions', 'active', 'question_types');
        return view('admin.question')->with($data);
    }

    public function change_status(Request $request)
    {
        if ($request->ajax()) {
            $update = CommunityQuestionsModel::where('id', '=', $request->question_id)->update(['status' => $request->status]);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Question ' . $request->status
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function add_video_form()
    {
        $active = "tutorial";
        $videos = VideoModel::where('status', '=', 'Active')->with('tutorials_categories')->paginate(7);
        $video_categories = TutorialsCategories::all();
        $data = compact('videos', 'video_categories', 'active');
        return view('admin.tutorials')->with($data);
    }

    public function add_video(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'is_show' => 'required'
        ]);
        $uploadedFile = $request->file('thumbnail')->getClientOriginalName();
        $uploadedFileName = pathinfo($uploadedFile, PATHINFO_FILENAME);
        $fileName = $uploadedFileName ."-thumbnail". $request->file('thumbnail')->getClientOriginalExtension();
        $uploaded = $request->file('thumbnail')->storeAs('thumbnails', $fileName, ['disk' => 'public']);
        $link = '';
        $video = new VideoModel();
        $video->title = $request->title;
        if (strpos($request->link, 'https://www.youtube.com/watch?v=') !== false) {
            $link = str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $request->link);
        } else if (strpos($request->link, 'https://youtu.be/') !== false) {
            $link = str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $request->link);
        }
        $video->link = $link."?autoplay=1";
        $video->thumbnail = $uploaded;
        $video->tutorials_categories_id = $request->video_cat_id;
        $video->is_show = $request->is_show;
        $video->status = 'Active';
        if ($video->save()) {
            notify()->success('Tutorial Added', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function show_video(Request $request)
    {
        if ($request->ajax()) {
            $update = VideoModel::where('id', '=', $request->id)->update(['is_show' => $request->is_show]);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tutorial is now ' . strtolower($request->is_show)
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function delete_video(Request $request)
    {
        if ($request->ajax()) {
            $update = VideoModel::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Video Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function test_page()
    {
        $active = "test";
        $tests = Tests::where('status', '=', 'Active')->paginate(7);
        $data = compact('tests', 'active');
        return view('admin.test')->with($data);
    }

    public function add_test(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'is_show' => 'required',
        ]);
        $test = new Tests();
        $test->name = $request->name;
        $test->description = $request->description;
        $test->duration = $request->duration;
        $test->is_show = $request->is_show;
        $test->status = 'Active';
        if ($test->save()) {
            notify()->success('Test Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function publish_test(Request $request)
    {
        if ($request->ajax()) {
            $update = Tests::where('id', '=', $request->id)->update(['is_show' => $request->status]);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Test is now ' . strtolower($request->status)
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function delete_test(Request $request)
    {
        if ($request->ajax()) {
            TestQuestions::where('tests_id', '=', $request->id)->update(['status' => 'Deleted']);
            $update = Tests::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if ($update) {
                return response()->json([
                    'success' => true,
                    'message' => 'Test Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function test_sections_page($id, $name)
    {
        $active = 'test';
        $test_sections = TestsSections::where('tests_id','=',$id)->where('status','=','Active')->paginate(7);
        $test_id = $id;
        $test_name = $name;
        $data = compact('test_sections', 'test_id', 'test_name', 'active');
        return view('admin.testSections')->with($data);
    }

    public function test_question_page($id, $name)
    {
        $active = 'test';
        $test_questions = TestQuestions::leftJoin('tests', 'test_questions.tests_id', '=', 'tests.id')
            ->where('tests.status', '=', 'Active')->where('test_questions.status', '=', 'Active')->where('test_questions.tests_id', '=', $id)
            ->select(['test_questions.id as id', 'test_questions.question as question', 'test_questions.option_a as a', 'test_questions.option_b as b', 'test_questions.option_c as c', 'test_questions.option_d as d', 'test_questions.correct_option as correct_option', 'test_questions.status as status'])
            ->paginate(7);
        $test_id = $id;
        $test_name = $name;
        $data = compact('test_questions', 'test_id', 'test_name', 'active');
        return view('admin.testQuestion')->with($data);
    }

    public function add_test_question(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_option' => 'required',
        ]);
        $question = new TestQuestions();
        $question->tests_id = $request->test_id;
        $question->question = $request->question;
        $question->option_a = $request->option_a;
        $question->option_b = $request->option_b;
        $question->option_c = $request->option_c;
        $question->option_d = $request->option_d;
        $question->correct_option = $request->correct_option;
        $question->status = 'Active';
        if ($question->save()) {
            notify()->success('Question Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function add_section(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'duration' => 'required'
        ]);
        $section = new TestsSections();
        $section->tests_id = $request->test_id;
        $section->name = $request->name;
        $section->duration = $request->duration;
        $section->status = 'Active';
        if ($section->save()) {
            notify()->success('Section Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_section(Request $request)
    {
        if ($request->ajax()) {
            $update = TestsSections::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Section Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function delete_test_question(Request $request)
    {
        if ($request->ajax()) {
            $update = TestQuestions::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Question Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function tip_category_page()
    {
        $active = 'tip category';
        $tips_categories = TipsCategories::where('status', '=', 'Active')->paginate(7);
        $data = compact('tips_categories', 'active');
        return view('admin.tipCategory')->with($data);
    }

    public function tutorials_categories()
    {
        $active = 'tutorial category';
        $tutorial_categories = TutorialsCategories::paginate(7);
        $data = compact('tutorial_categories', 'active');
        return view('admin.tutorialsCategories')->with($data);
    }

    public function add_tutorial_category(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $tutorial_category = new TutorialsCategories();
        $tutorial_category->name = $request->name;
        if ($tutorial_category->save()) {
            notify()->success('Tutorial Category Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_tutorial_category(Request $request)
    {
        if ($request->ajax()) {
            $update = TutorialsCategories::where('id', '=', $request->id)->delete();
            if ($update) {                
                return response()->json([
                    'success' => true,
                    'message' => 'Tutorial Category Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function add_tips_category(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $tips_category = new TipsCategories();
        $tips_category->name = $request->name;
        if ($tips_category->save()) {
            notify()->success('TIPS Category Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_tips_category(Request $request)
    {
        if ($request->ajax()) {
            $update = TipsCategories::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if ($update) {
                TipsSubCategories::where('tips_categories_id', '=', $request->id)->update(['status' => 'Deleted']);
                Tips::where('tips_categories_id', '=', $request->id)->update(['status' => 'Deleted']);
                return response()->json([
                    'success' => true,
                    'message' => 'TIPS Category Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function tip_sub_category_page()
    {
        $active = 'tip sub category';
        $tips_sub_categories = TipsSubCategories::where('tips_sub_categories.status', '=', 'Active')->with('tipsCategories')->paginate(7);
        $tips_categories = TipsCategories::where('status', '=', 'Active')->get();
        $data = compact('tips_sub_categories', 'tips_categories', 'active');
        return view('admin.tipSubCategory')->with($data);
    }

    public function add_tips_sub_category(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $tips_sub_category = new TipsSubCategories();
        $tips_sub_category->tips_categories_id = $request->tips_cat_id;
        $tips_sub_category->name = $request->name;
        if ($tips_sub_category->save()) {
            notify()->success('TIPS Sub Category Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_tips_sub_category(Request $request)
    {
        if ($request->ajax()) {
            $update = TipsSubCategories::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if ($update) {
                Tips::where('tips_sub_categories_id', '=', $request->id)->update(['status' => 'Deleted']);
                return response()->json([
                    'success' => true,
                    'message' => 'Tips Sub Category Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function tips_page()
    {
        $active = 'tip';
        $tips_sub_categories = TipsSubCategories::where('status', '=', 'Active')->get();
        $tips_categories = TipsCategories::where('status', '=', 'Active')->get();
        $tips = Tips::where('status', '=', 'Active')->with('tipsCategories', 'tipsSubCategories')->paginate(7);
        $data = compact('tips_sub_categories', 'tips_categories', 'tips', 'active');
        return view('admin.tips')->with($data);
    }

    public function add_tip(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);
        $tip = new Tips();
        $tip->tips_categories_id = $request->tips_cat_id;
        $tip->tips_sub_categories_id = $request->tips_sub_cat_id;
        $tip->content = stripslashes($request->content);
        if ($tip->save()) {
            notify()->success('TIP Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_tip(Request $request)
    {
        if ($request->ajax()) {
            $update = Tips::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tip Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function get_tips_sub_categories(Request $request)
    {
        if ($request->ajax()) {
            $tips_sub_categories = TipsSubCategories::where('tips_categories_id', '=', $request->id)->where('status', '=', 'Active')->get();
            if (!is_null($tips_sub_categories)) {
                return response()->json([
                    'success' => true,
                    'data' => $tips_sub_categories
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function tip_detail($id)
    {
        $active = 'tip';
        $tip = Tips::where('id', '=', $id)->where('status', '=', 'Active')->with('tipsCategories', 'tipsSubCategories')->get();
        if (count($tip) > 0) {
            $data = compact('tip', 'active');
            return view('admin.tipDetail')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function cm_category_page()
    {
        $active = 'cm category';
        $cm_categories = CmCategories::where('status', '=', 'Active')->paginate(7);
        $data = compact('cm_categories', 'active');
        return view('admin.mcCategories')->with($data);
    }

    public function blog_category_page()
    {
        $active = 'blog category';
        $blog_categories = BlogCategories::where('status', '=', 'Active')->paginate(7);
        $data = compact('active', 'blog_categories');
        return view('admin.blogCategories')->with($data);
    }

    public function blog_tag_page()
    {
        $active = 'tag';
        $blog_tags = Tags::where('status', '=', 'Active')->paginate(7);
        $data = compact('active', 'blog_tags');
        return view('admin.blogTags')->with($data);
    }

    public function add_cm_category(Request $request)
    {        
        $request->validate([
            'name' => 'required',
            'discription' => 'required',
            'media' => 'required'
        ]);
        $cm_category = new CmCategories();
        $cm_category->name = $request->name;
        $cm_category->description = $request->discription;
        $cm_category->media = stripslashes($request->media);
        if ($cm_category->save()) {
            notify()->success('Common Mistake Category Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function add_blog_category(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $blog_category = new BlogCategories();
        $blog_category->name = $request->name;
        if ($blog_category->save()) {
            notify()->success('Blog Category Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function add_blog_tag(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $blog_tag = new Tags();
        $blog_tag->name = $request->name;
        if ($blog_tag->save()) {
            notify()->success('Blog Tag Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_cm_category(Request $request)
    {
        if ($request->ajax()) {
            $update = CmCategories::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                CmSubCategories::where('cm_categories_id', '=', $request->id)->update(['status' => 'Deleted']);
                CommonMistakes::where('cm_categories_id', '=', $request->id)->update(['status' => 'Deleted']);
                return response()->json([
                    'success' => true,
                    'message' => 'Common Mistake Category Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function delete_blog_category(Request $request)
    {
        if ($request->ajax()) {
            $update = BlogCategories::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Blog Category Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function delete_blog_tag(Request $request)
    {
        if ($request->ajax()) {
            $update = Tags::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Blog Tag Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function delete_blog(Request $request)
    {
        if ($request->ajax()) {
            $update = blogs::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Blog Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function cm_sub_category_page()
    {
        $active = 'cm sub category';
        $cm_sub_categories = CmSubCategories::where('cm_sub_categories.status', '=', 'Active')->with('cmCategories')->paginate(7);
        $cm_categories = CmCategories::where('status', '=', 'Active')->get();
        $data = compact('cm_sub_categories', 'cm_categories', 'active');
        return view('admin.cmSubCategories')->with($data);
    }

    public function add_cm_sub_category(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $cm_sub_category = new CmSubCategories();
        $cm_sub_category->cm_categories_id = $request->cm_cat_id;
        $cm_sub_category->name = $request->name;
        if ($cm_sub_category->save()) {
            notify()->success('Common Mistake Sub Category Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_cm_sub_category(Request $request)
    {
        if ($request->ajax()) {
            $update = CmSubCategories::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                CommonMistakes::where('cm_sub_categories_id', '=', $request->id)->update(['status' => 'Deleted']);
                return response()->json([
                    'success' => true,
                    'message' => 'Common Mistake Sub Category Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function cm_page()
    {
        $active = 'cm';
        $cm_categories = CmCategories::where('status', '=', 'Active')->get();
        $common_mistakes = CommonMistakes::where('status', '=', 'Active')->with('cmCategories')->paginate(7);
        $data = compact('cm_categories', 'common_mistakes', 'active');
        return view('admin.commonMistakes')->with($data);
    }

    public function blog_page()
    {
        $active = 'blog';
        $blog_categories = BlogCategories::where('status', '=', 'Active')->get();
        $blog_tags = Tags::where('status', '=', 'Active')->get();
        $blogs = blogs::where('status', '=', 'Active')->with('blog_categories','tags')->paginate(7);
        $data = compact('blog_categories', 'blog_tags','blogs', 'active');
        return view('admin.blogs')->with($data);
    }

    public function add_cm(Request $request)
    {        
        $request->validate([
            'content' => 'required'
        ]);
        $common_mistake = new CommonMistakes();
        $common_mistake->cm_categories_id = $request->cm_cat_id;
        $common_mistake->cm_type = $request->cm_type;
        $common_mistake->content = stripslashes($request->content);
        if ($common_mistake->save()) {
            notify()->success('Common Mistake Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function add_blog(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'title' => 'required',
            'media' => 'required',
        ]);
        $uploadedFile = $request->file('media')->getClientOriginalName();
        $uploadedFileName = pathinfo($uploadedFile, PATHINFO_FILENAME);
        $fileName = $uploadedFileName . "-" .session()->get('admin.id'). "." . $request->file('media')->getClientOriginalExtension();
        $uploaded = $request->file('media')->storeAs('blogs', $fileName, ['disk' => 'public']);
        $blog = new blogs();
        $blog->blog_categories_id = $request->blog_cat_id;
        $blog->title = $request->title;
        $blog->short_content = $request->short;
        $blog->media = $uploaded;
        $blog->content = stripslashes($request->content);
        if ($blog->save()) {
            foreach ($request->tag_id as $tag_id) {
                $tag = new BlogsTags();
                $tag->blogs_id=$blog->id;
                $tag->tags_id=$tag_id;
                $tag->save();
            }
            notify()->success('Blog Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_cm(Request $request)
    {
        if ($request->ajax()) {
            $update = CommonMistakes::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Common Mistake Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function get_cm_sub_categories(Request $request)
    {
        if ($request->ajax()) {
            $cm_sub_categories = CmSubCategories::where('cm_categories_id', '=', $request->id)->where('status', '=', 'Active')->get();
            if (!is_null($cm_sub_categories)) {
                return response()->json([
                    'success' => true,
                    'data' => $cm_sub_categories
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function cm_detail($id)
    {
        $active = 'cm';
        $common_mistake = CommonMistakes::where('id', '=', $id)->where('status', '=', 'Active')->with('cmCategories')->first();
        if (!is_null($common_mistake)) {
            $data = compact('common_mistake', 'active');
            return view('admin.commonMistakeDetail')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function blog_detail($id)
    {
        $active = 'blog';
        $blog = blogs::where('id', '=', $id)->where('status', '=', 'Active')->with('blog_categories', 'tags')->first();
        if (!is_null($blog) > 0) {
            $data = compact('blog', 'active');
            return view('admin.blogDetail')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function admin_profile()
    {
        $id = session()->get('admin.id');
        $find = Admins::find($id);
        if (!is_null($find)) {
            $active = '';
            $data = compact('active');
            return view('admin.profile')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function update_admin_profile(Request $request)
    {
        if (!empty($request->file('upload'))) {
            $ImgValue     = $request->file('upload');
            $img = Storage::disk('public')->put('admins', $ImgValue);
            if (!empty($img)) {
                if (!empty($request->password) && !empty($request->password_confirmation)) {
                    $request->validate([
                        'password' => 'confirmed'
                    ]);
                    $update = Admins::where('email', '=', $request->email)->update(['first_name' => $request->firstName, 'last_name' => $request->lastName, 'media' => $img, 'password' => md7($request->password)]);
                    if ($update) {
                        notify()->success('profile Updated', '', 'topRight');
                        return redirect(route('admin.logout'));
                    } else {
                        notify()->error('Try Again', '', 'topRight');
                        return redirect()->back();
                    }
                } else {
                    $update = Admins::where('email', '=', $request->email)->update(['first_name' => $request->firstName, 'last_name' => $request->lastName, 'media' => $img]);
                    if ($update) {
                        notify()->success('profile Updated', '', 'topRight');
                        return redirect(route('admin.logout'));
                    } else {
                        notify()->error('Try Again', '', 'topRight');
                        return redirect()->back();
                    }
                }
            } else {
                notify()->error('Image Not Uploaded', '', 'topRight');
                return redirect()->back();
            }
        } else {
            if (!empty($request->password) && !empty($request->password_confirmation)) {
                $request->validate([
                    'password' => 'confirmed'
                ]);
                $update = Admins::where('email', '=', $request->email)->update(['first_name' => $request->firstName, 'last_name' => $request->lastName, 'password' => md7($request->password)]);
                if ($update) {
                    notify()->success('profile Updated', '', 'topRight');
                    return redirect(route('admin.logout'));
                } else {
                    notify()->error('Try Again', '', 'topRight');
                    return redirect()->back();
                }
            } else {
                $update = Admins::where('email', '=', $request->email)->update(['first_name' => $request->firstName, 'last_name' => $request->lastName]);
                if ($update) {
                    notify()->success('profile Updated', '', 'topRight');
                    return redirect(route('admin.logout'));
                } else {
                    notify()->error('Try Again', '', 'topRight');
                    return redirect()->back();
                }
            }
        }
    }

    public function delete_admin(Request $request)
    {
        $find = Admins::find($request->id);
        if (!is_null($find)) {
            $request->validate([
                'accountActivation' => 'required'
            ]);
            $update = Admins::where('id', '=', $request->id)->update(['status' => 'Deleted']);
            if ($update) {
                return redirect(route('admin.logout'));
            } else {
                notify()->error('Try Again', '', 'topRight');
                return redirect()->back();
            }
        } else {
            notify()->error('Admin not found', '', 'topRight');
            return redirect()->back();
        }
    }

    public function add_user(Request $request)
    {
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'public_private' => 'required',
            'school_rank' => 'required',
            'target_school' => 'required',
            'time_commitment' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'email' => 'required|email'
        ]);
        $user = new UserModel();
        $profile = new UserProfileModel();
        $usernameExist = UserModel::where('username', '=', $request->username)->get();
        if (empty($usernameExist->toArray())) {
            $emailExist = UserModel::where('email', '=', $request->email)->get();
            if (empty($emailExist->toArray())) {
                $user->username = $request['username'];
                $user->email = $request['email'];
                $user->password = md7($request['password']);
                $user->status = "Active";
                $user->save();
                if (!empty($user->id)) {
                    $profile->user_id = $user->id;
                    $profile->f_name = $request['f_name'];
                    $profile->l_name = $request['l_name'];
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
                    $success = "User Added";
                    notify()->success($success, "", "topRight");
                }
            } else {
                $error = "Email already register";
                notify()->error($error, "", "topRight");
            }
        } else {
            $error = "Username taken";
            notify()->error($error, "", "topRight");
        }
        return redirect()->back();
    }

    public function add_role(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
            'allow' => 'required'
        ]);
        $allow = implode(',', $request->allow);
        $role = new AdminsRoles();
        $role->role = $request->role_name;
        $role->allow = $allow;
        if ($role->save()) {
            notify()->success('Role Added.', '', 'topRight');
        } else {
            notify()->success('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function eassy_grading(Request $request)
    {
        $request->validate([
            'essay_id' => 'required',
            'user_id' => 'required',
            'admin_id' => 'required'
        ]);
        $essay_grading = new EssayGrading();
        $essay_grading->essay_id = $request->essay_id;
        $essay_grading->grammar_grade = $request->grammar_grading;
        $essay_grading->grammar_note = $request->grammar_note;
        $essay_grading->content_grade = $request->content_grading;
        $essay_grading->content_note = $request->content_note;
        $essay_grading->structure_grade = $request->structure_grading;
        $essay_grading->structure_note = $request->structure_note;
        $essay_grading->final_thought_grade = $request->final_thought_grading;
        $essay_grading->final_thought_note = $request->final_thought_note;
        $essay_grading->admins_id = $request->admin_id;
        $essay_grading->users_id = $request->user_id;
        $essay_grading->status = 'Pending';
        if ($essay_grading->save()) {
            $subscription_id = EassyModel::where('id', '=', $request->essay_id)->first()->subscription_id;
            $price = SubscriptionModel::where('id', '=', $subscription_id)->first()->sub_price;
            $wallet = Wallet::where('admins_id', '=', $request->admin_id)->first();
            if (!is_null($wallet)) {
                $new_price = $wallet->balance + $price;
                Wallet::where('admins_id', '=', $request->admin_id)->update(['balance' => $new_price]);
                $transection = new Transection();
                $transection->admins_id = $request->admin_id;
                $transection->balance = $price;
                $transection->save();
            } else {
                $wallet = new Wallet();
                $wallet->admins_id = $request->admin_id;
                $wallet->balance = $price;
                if ($wallet->save()) {
                    $transection = new Transection();
                    $transection->admins_id = $request->admin_id;
                    $transection->balance = $price;
                    $transection->save();
                }
            }
            notify()->success('Grade Submitted', '', 'topRight');
        } else {
            notify()->error('Try Again', '', 'topRight');
        }
        return redirect()->back();
    }

    public function view_grading($id)
    {
        $grading = EssayGrading::where('essay_id', '=', $id)->with('eassay', 'eassay.users', 'admins')->first();
        $data['learner'] = UserProfileModel::where('user_id', '=', $grading->users_id)->first()->f_name . " " . UserProfileModel::where('user_id', '=', $grading->users_id)->first()->l_name;
        $data['checker'] = $grading->admins->first_name . " " . $grading->admins->last_name . '(' . $grading->admins->username . ')';
        $data['date'] = $grading->created_at;
        $data['grammar_grade'] = $grading->grammar_grade;
        $data['grammar_note'] = $grading->grammar_note;
        $data['content_grade'] = $grading->content_grade;
        $data['content_note'] = $grading->content_note;
        $data['structure_grade'] = $grading->structure_grade;
        $data['structure_note'] = $grading->structure_note;
        $data['final_thought_grade'] = $grading->final_thought_grade;
        $data['final_thought_note'] = $grading->final_thought_note;
        //return view('admin.pdf')->with(compact('grading'));
        ini_set('max_execution_time', 300);
        $pdf = PDF::setOptions(['isHtml7ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->loadView('admin.pdf', array('grading' => $grading));
        return $pdf->download($id . '.pdf');
    }

    public function withdraw_grader()
    {
        $active = "withdraw_g";
        $accounts = BankAccounts::where('admins_id', '=', session()->get('admin.id'))->get();
        $withdraw_requests = WithdrawRequests::where('admins_id', '=', session()->get('admin.id'))->with('admins', 'bank_accounts')->orderBy('created_at', 'desc')->paginate(10);
        $data = compact('active', 'withdraw_requests', 'accounts');
        return view('admin.withdrawGrader')->with($data);
    }

    public function add_bank_account(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account' => 'required'
        ]);
        $account = new BankAccounts();
        $account->admins_id = session()->get('admin.id');
        $account->name = $request->name;
        $account->acount_no = $request->account;
        if ($account->save()) {
            notify()->success('Bank Account Added.', '', 'topRight');
        } else {
            notify()->success('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function submit_withdraw_request(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'bank_id' => 'required'
        ]);
        $wallet = Wallet::where('admins_id', '=', session()->get('admin.id'))->first();
        if ($wallet->balance >= $request->amount) {
            $withdraw_request = new WithdrawRequests();
            $withdraw_request->admins_id = session()->get('admin.id');
            $withdraw_request->bank_accounts_id = $request->bank_id;
            $withdraw_request->amount = $request->amount;
            if ($withdraw_request->save()) {
                $new_price = $wallet->balance - $request->amount;
                Wallet::where('admins_id', '=', session()->get('admin.id'))->update(['balance' => $new_price]);
                $transection = new Transection();
                $transection->admins_id = session()->get('admin.id');
                $transection->balance = $request->amount;
                $transection->description = 'Withdraw';
                $transection->transection_type = 'Out';
                $transection->save();
                notify()->success('Withdraw Request Submitted.', '', 'topRight');
            } else {
                notify()->error('Try Again.', '', 'topRight');
            }
        } else {
            notify()->error('Your requested amount is greater than your balance', '', 'topRight');
        }
        return redirect()->back();
    }

    public function withdraw_admin()
    {
        $active = "withdraw_a";
        $withdraw_requests = WithdrawRequests::with('admins', 'bank_accounts')->orderBy('created_at', 'desc')->paginate(10);
        $data = compact('active', 'withdraw_requests');
        return view('admin.withdrawAdmin')->with($data);
    }

    public function change_withdraw_request_status(Request $request)
    {
        $find = WithdrawRequests::find($request->id);
        if (!is_null($find)) {
            $update = WithdrawRequests::where('id', '=', $request->id)->update(['status' => $request->status]);
            if ($update) {
                if ($request->status == "Declined") {
                    $req = WithdrawRequests::where('id', '=', $request->id)->first();
                    $balance = Wallet::where('admins_id', '=', $req->admins_id)->first()->balance;
                    $price = $balance + $req->amount;
                    Wallet::where('admins_id', '=', $req->admins_id)->update(['balance' => $price]);
                    $transection = new Transection();
                    $transection->admins_id = $req->admins_id;
                    $transection->description = 'Refund';
                    $transection->balance = $req->amount;
                    $transection->save();
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Status Changed.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found.'
            ]);
        }
    }

    public function eassy_assign_to(Request $request)
    {
        if ($request->ajax()) {
            $array = explode(',', $request->essay);
            foreach ($array as $id) {
                EassyModel::where('id', '=', $id)->update(['admins_id' => $request->admin_id]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Essay Assigned'
            ]);
        }
    }

    public function grading_status(Request $request)
    {
        if ($request->ajax()) {
            $update = EssayGrading::where('id', '=', $request->id)->update(['status' => $request->status]);
            if ($update) {
                if ($request->status == "Disapproved") {
                    $essay_grading = EssayGrading::where('id', '=', $request->id)->first();
                    $essay = EassyModel::where('id', '=', $essay_grading->essay_id)->first();
                    $price = SubscriptionModel::where('id', '=', $essay->subscription_id)->first()->sub_price;
                    $wallet = Wallet::where('admins_id', '=', $essay->admins_id)->first();
                    if (!is_null($wallet)) {
                        $new_price = $wallet->balance - $price;
                        Wallet::where('admins_id', '=', $essay->admins_id)->update(['balance' => $new_price]);
                        $transection = new Transection();
                        $transection->admins_id = $essay->admins_id;
                        $transection->description = 'Essay Reduction';
                        $transection->transection_type = 'Out';
                        $transection->balance = $price;
                        $transection->save();
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Updated'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again'
                ]);
            }
        }
    }

    public function events()
    {
        $active = 'event';
        $events = AdminEvents::with('admins', 'event_categories')->orderBy('created_at')->paginate(10);
        $event_categories = EventCategories::orderBy('created_at')->get();
        $data = compact('active', 'events', 'event_categories');
        return view('admin.events')->with($data);
    }

    public function calendar_view()
    {
        $active = 'event';
        $data = compact('active');
        return view('admin.calendar')->with($data);
    }

    public function add_event(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'cat' => 'required'
        ]);
        $event = new AdminEvents();
        $event->admins_id = session()->get('admin.id');
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = $request->start;
        $event->event_categories_id = $request->cat;
        $event->end = $request->end;
        if ($event->save()) {
            notify()->success('Event Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_event(Request $request)
    {
        if ($request->ajax()) {
            $event = AdminEvents::find($request->id);
            if (!is_null($event)) {
                $event->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Event Deleted'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Event Not Found'
                ]);
            }
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $event = new AdminEvents();
        $event->admins_id = session()->get('admin.id');
        $event->title = $request['title'];
        $event->start = $request['start'];
        $event->end = $request['end'];
        if ($event->save()) {
            return response()->json([
                'success' => true,
                'data' => $event
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'title' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $event = AdminEvents::where('id', $request['id'])
            ->update([
                'title' => $request['title'],
                'start' => $request['start'],
                'end' => $request['end'],
            ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    public function destroy(Request $request)
    {
        $found = AdminEvents::find($request->id);
        if (!is_null($found)) {
            if (AdminEvents::where('id', $request->id)->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Event removed successfully.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not removed.'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.'
            ]);
        }
    }

    public function calendar(Request $request)
    {
        $user_id = session()->get('admin.id');
        if ($request->ajax()) {
            $events = AdminEvents::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)->where('admins_id', '=', $user_id)
                ->get();
            return response()->json($events);
        }
    }

    public function events_categories()
    {
        $active = "event category";
        $event_categories = EventCategories::orderBy('created_at', 'desc')->paginate(10);
        $data = compact('active', 'event_categories');
        return view('admin.eventCategories')->with($data);
    }

    public function add_events_category(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $event_category = new EventCategories();
        $event_category->name = $request->name;
        if ($event_category->save()) {
            notify()->success('Category Added.', '', 'topRight');
        } else {
            notify()->error('Try Again.', '', 'topRight');
        }
        return redirect()->back();
    }

    public function delete_event_category(Request $request)
    {
        if ($request->ajax()) {
            $update = EventCategories::where('id', '=', $request->id)->delete();
            if (!is_null($update)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Common Mistake Sub Category Deleted.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Try Again.'
                ]);
            }
        }
    }

    public function get_event(Request $request)
    {
        if ($request->ajax()) {
            $event = AdminEvents::where('id', '=', $request->id)->with('admins', 'event_categories')->first();
            return response()->json($event);
        }
    }

    public function upload_user_essay(Request $request)
    {
        $request->validate([
            "user_id" => "required",
            "package_id" => "required",
            "eassy" => "required|file"
        ]);
        $uploadedFile = $request->file('eassy')->getClientOriginalName();
        $uploadedFileName = pathinfo($uploadedFile, PATHINFO_FILENAME);
        $user = UserModel::where('id', '=', $request->user_id)->first();
        $fileName = $uploadedFileName . "-" . $user->username . "-" . $user->id . "." . $request->file('eassy')->getClientOriginalExtension();
        $file = public_path("uploads/essays/" . $fileName);
        if (!file_exists($file)) {
            $uploaded = $request->file('eassy')->storeAs('essays', $fileName, ['disk' => 'public']);
            if (!empty($uploaded)) {
                $eassy = new EassyModel();
                $eassy->user_id = $request->user_id;
                $eassy->subscription_id = $request->package_id;
                $eassy->media = $uploaded;
                $eassy->save();
                $success = "Eassy Uploaded Successfully!";
                notify()->success($success, "", "topRight");
            } else {
                $error = "Eassy Not Uploaded. Please try Again!";
                notify()->error($error, "", "topRight");
            }
        } else {
            $error = "Eassy Already Exist. Try new Eassy!";
            notify()->error($error, "", "topRight");
        }
        return redirect()->back();
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
                $question->admins_id = session()->get('admin.id');
                $question->status = 'Open';
                if ($question->save()) {
                    $success = "Question submitted.";
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
            $question->admins_id = session()->get('admin.id');
            $question->status = 'Open';
            if ($question->save()) {
                $success = "Question submitted.";
                notify()->success($success, "", "topRight");
            } else {
                $error = "Try Again Later.";
                notify()->error($error, "", "topRight");
            }
        }
        return redirect()->back();
    }

    public function eassy_search(Request $request)
    {
        $user_id = $request->s_user;
        $grader_id = $request->s_grader;
        $package_id = $request->s_package;
        $date = $request->date;
        $eassys = EassyModel::query();

        if (!empty($user_id)) {
            $eassys = $eassys->where('user_id', '=', $user_id);
        }

        if (!empty($grader_id)) {
            $eassys = $eassys->where('admins_id', '=', $grader_id);
        }

        if (!empty($package_id)) {
            $eassys = $eassys->where('subscription_id', '=', $package_id);
        }

        if (!empty($date)) {
            $eassys = $eassys->where('created_at', '<=', $date);
        }

        $eassys = $eassys->with('users', 'essay_grading', 'subscription', 'admins')->orderBy('essay.created_at', 'desc')->paginate(10);
        if (count($eassys) > 0) {
            $admins = Admins::where('admins_roles_id', '=', 3)->get();
            $users = UserModel::where('status', '=', 'Active')->orderBy('created_at', 'desc')->get();
            $packages = SubscriptionModel::orderBy('created_at', 'desc')->get();
            $active = 'eassy';
            $data = compact('eassys', 'active', 'admins', 'users', 'packages');
            return view('admin.eassy')->with($data);
        } else {
            notify()->info('Data Not Found.', '', 'topRight');
            return redirect()->back();
        }
    }

    public function question_search(Request $request)
    {
        $user = $request->s_user;
        $admin = $request->s_admin;
        $type = $request->s_type;
        $status = $request->s_status;
        $title = $request->s_title;
        $questions = CommunityQuestionsModel::query();

        if (!empty($user)) {
            $questions = $questions->where('user_id', '=', $user);
        }

        if (!empty($admin)) {
            $questions = $questions->where('admins_id', '=', $admin);
        }

        if (!empty($type)) {
            $questions = $questions->where('qestion_type_id', '=', $type);
        }

        if (!empty($status)) {
            $questions = $questions->where('status', '=', $status);
        }

        if (!empty($title)) {
            $questions = $questions->where(function ($query) use ($title) {
                return $query->where('title', 'LIKE', "%" . $title . "%")
                    ->orWhere('description', 'LIKE', "%" . $title . "%");
            });
        }

        $questions = $questions->with('community_question_types', 'users', 'admins')->orderBy('created_at', 'desc')->paginate(7);
        if (count($questions) > 0) {
            $active = 'community';
            $question_types = CommunityQuestionTypesModel::orderBy('created_at', 'desc')->get();
            $data = compact('questions', 'active', 'question_types');
            return view('admin.question')->with($data);
        } else {
            notify()->info('Data Not Found.', '', 'topRight');
            return redirect()->back();
        }
    }
}
