<?php

namespace App\Http\Controllers;

use App\User;
use App\SmExam;
use App\SmNews;
use App\SmPage;
use App\SmClass;
use App\SmEvent;
use App\SmStaff;
use App\SmCourse;
use App\SmSchool;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmExamType;
use App\SmNewsPage;
use App\SmAboutPage;
use App\SmCoursePage;
use App\ApiBaseMethod;
use App\SmContactPage;
use App\SmNoticeBoard;
use App\SmTestimonial;
use App\SmNewsCategory;
use App\SmHeaderSubMenu;
use App\SmContactMessage;
use App\SmGeneralSettings;
use App\SmHomePageSetting;
use App\SmSocialMediaIcon;
use App\SmBackgroundSetting;
use App\SmCourseCategory;
use App\SmHeaderMenuManager;
use Illuminate\Http\Request;
use CreateSmHeaderMenusTable;
use App\SmFrontendPersmission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;
use Modules\SaasSubscription\Entities\SmPackagePlan;
use Modules\RolePermission\Entities\InfixPermissionAssign;

class SmFrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    public function index()
    {
        try {
            if (Schema::hasTable('users')) {
                if (Schema::hasTable('users')) {
                    $contact = SmContactPage::first();
                    $setting = SmGeneralSettings::first();
                    $permisions = SmFrontendPersmission::where('parent_id', 1)->where('is_published', 1)->get();
                    $per = [];
                    foreach ($permisions as $permision) {
                        $per[$permision->name] = 1;
                    }

                    $data = [
                        'setting' => $setting,
//                    'custom_link' => SmCustomLink::find(1),
                        'per' => $per,
//                      'active_style' => SmStyle::where('is_active', 1)->first(),
//                      'is_registration_permission' => SmRegistrationSetting::where('registration_permission',1)->first(),
                    ];

                    $testInstalled = DB::table('users')->get();
                    if (count($testInstalled) < 1) {
                        return view('install.welcome_to_infix');
                    } else {
                        $home_data = [
                            'exams' => SmExam::all(),
                            'news' => SmNews::orderBy('order', 'asc')->limit(3)->get(),
                            'testimonial' => SmTestimonial::all(),
                            'academics' => SmCourse::orderBy('id', 'asc')->limit(3)->get(),
                            'exam_types' => SmExamType::all(),
                            'events' => SmEvent::all(),
                            'notice_board' => SmNoticeBoard::where('is_published', 1)->orderBy('created_at', 'DESC')->take(3)->get(),
                            'classes' => SmClass::where('active_status', 1)->get(),
                            'subjects' => SmSubject::where('active_status', 1)->get(),
                            'section' => SmSection::where('active_status', 1)->get(),
                            'homePage' => SmHomePageSetting::find(1),
                        ];

                        $url = explode('/', $setting->website_url);

                        if ($setting->website_btn == 0) {
                            return redirect('login');
                        } else {

                            if ($setting->website_url == '') {

                                if (moduleStatusCheck('Saas') == TRUE) {

                                    if (moduleStatusCheck('SaasSubscription') == TRUE) {

                                        $packages = SmPackagePlan::where('active_status', 1)->get();
                                    } else {
                                        $packages = [];
                                    }
                                    $home_data = [
                                        'contact_info' => $contact,
                                        'school' => $setting,
                                        'packages' => $packages
                                    ];
                                    return view('saas::auth.saas_landing')->with(array_merge($data, $home_data));
                                } else {
                                    return view('frontEnd.home.light_home')->with(array_merge($data, $home_data));
                                }
                            } elseif ($url[max(array_keys($url))] == 'home') {

                                if (moduleStatusCheck('Saas') == TRUE) {
                                    $home_data = [
                                        'contact_info' => $contact,
                                        'school' => $setting,
                                    ];
                                    return view('saas::auth.saas_landing')->with(array_merge($data, $home_data));
                                } else {
                                    return view('frontEnd.home.light_home')->with(array_merge($data, $home_data));
                                }
                            } else {
                                $url = $setting->website_url;
                                return Redirect::to($url);
                            }
                        }
                    }
                } else {
                    return view('install.welcome_to_infix');
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function about()
    {
        try {
            $exams = SmExam::all();
            $exams_types = SmExamType::all();
            $classes = SmClass::where('active_status', 1)->get();
            $subjects = SmSubject::where('active_status', 1)->get();
            $sections = SmSection::where('active_status', 1)->get();
            $about = SmAboutPage::first();
            $testimonial = SmTestimonial::all();
            $totalStudents = SmStudent::where('active_status', 1)->get();
            $totalTeachers = SmStaff::where('active_status', 1)->where('role_id', 4)->get();
            $history = SmNews::with('category')->where('category_id', 2)->limit(3)->get();
            $mission = SmNews::with('category')->where('category_id', 3)->limit(3)->get();
            return view('frontEnd.home.light_about', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'about', 'testimonial', 'totalStudents', 'totalTeachers', 'history', 'mission'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function news()
    {

        try {
            $exams = SmExam::all();
            $exams_types = SmExamType::all();
            $classes = SmClass::where('active_status', 1)->get();
            $subjects = SmSubject::where('active_status', 1)->get();
            $sections = SmSection::where('active_status', 1)->get();
            return view('frontEnd.home.light_news', compact('exams', 'classes', 'subjects', 'exams_types', 'sections'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function contact()
    {
        try {
            $exams = SmExam::all();
            $exams_types = SmExamType::all();
            $classes = SmClass::where('active_status', 1)->get();
            $subjects = SmSubject::where('active_status', 1)->get();
            $sections = SmSection::where('active_status', 1)->get();

            $contact_info = SmContactPage::first();
            return view('frontEnd.home.light_contact', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'contact_info'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function institutionPrivacyPolicy()
    {

        try {
            $exams = SmExam::all();
            $exams_types = SmExamType::all();
            $classes = SmClass::where('active_status', 1)->get();
            $subjects = SmSubject::where('active_status', 1)->get();
            $sections = SmSection::where('active_status', 1)->get();

            $contact_info = SmContactPage::first();
            return view('frontEnd.home.institutionPrivacyPolicy', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'contact_info'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function developerTool($purpose){

        if($purpose == 'debug_true'){
            envu([
                'APP_ENV' => 'local',
                'APP_DEBUG'     =>  'true',
                ]);

                dd('Debug Mode Is Ture');
        }
        elseif($purpose == 'debug_false'){
            envu([
                'APP_ENV' => 'production',
                'APP_DEBUG'     =>  'false',
                ]);

                dd('Debug Mode Is False');
        }

        elseif($purpose == "sync_true"){
            envu([
                'APP_SYNC'     =>  'true',
                ]); 

                dd('App Sync Mode Is True');
         }

         elseif($purpose == "sync_false"){
            envu([
                'APP_SYNC'     =>  'false',
                ]); 

                dd('App Sync Mode Is False');
         }
    }


    public function institutionTermServices()
    {

        try {
            $exams = SmExam::all();
            $exams_types = SmExamType::all();
            $classes = SmClass::where('active_status', 1)->get();
            $subjects = SmSubject::where('active_status', 1)->get();
            $sections = SmSection::where('active_status', 1)->get();

            $contact_info = SmContactPage::first();
            return view('frontEnd.home.institutionTermServices', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'contact_info'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function newsDetails($id)
    {

        try {
            $news = SmNews::find($id);
            $otherNews = SmNews::orderBy('id', 'asc')->whereNotIn('id', [$id])->limit(3)->get();
            $a = 2;
            $b = 3;
            $c = 9;
            $notice_board = SmNoticeBoard::where('is_published', 1)->orderBy('created_at', 'DESC')->take(3)->get();
            return view('frontEnd.home.light_news_details', compact('news', 'notice_board', 'otherNews'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function newsPage()
    {
        try {
            $news = SmNews::paginate(4);
            $newsPage = SmNewsPage::first();
            return view('frontEnd.home.light_news', compact('news', 'newsPage'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function loadMorenews(Request $request)
    {
        try{
            $count = SmNews::count();
            $skip = $request->skip;
            $limit = $count - $skip;
            $due_news = SmNews::skip($skip)->take(4)->get();
            return view('frontEnd.home.loadMoreNews',compact('due_news','skip','count'));
        }catch(\Exception $e){
            return response('error');
        }
    }

    public function conpactPage()
    {
        try {
            $module_links = InfixPermissionAssign::where('role_id', Auth::user()->role_id)->where('school_id', Auth::user()->school_id)->pluck('module_id')->toArray();

            $contact_us = SmContactPage::first();
            return view('frontEnd.contact_us', compact('contact_us', 'module_links'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function contactPageEdit()
    {

        try {
            $contact_us = SmContactPage::first();
            $update = "";

            return view('frontEnd.contact_us', compact('contact_us', 'update'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function contactPageStore(Request $request)
    {
        if ($request->file('image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'zoom_level' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'google_map_address' => 'required',
            ]);
        } else {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'zoom_level' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'google_map_address' => 'required',
                'image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        }

        try {
            $fileName = "";
            if ($request->file('image') != "") {
                $contact = SmContactPage::find(1);
                if ($contact != "") {
                    if ($contact->image != "") {
                        if (file_exists($contact->image)) {
                            unlink($contact->image);
                        }
                    }
                }

                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/contactPage/', $fileName);
                $fileName = 'public/uploads/contactPage/' . $fileName;
            }

            $contact = SmContactPage::first();
            if ($contact == "") {
                $contact = new SmContactPage();
            }
            $contact->title = $request->title;
            $contact->description = $request->description;
            $contact->button_text = $request->button_text;
            $contact->button_url = $request->button_url;

            $contact->address = $request->address;
            $contact->address_text = $request->address_text;
            $contact->phone = $request->phone;
            $contact->phone_text = $request->phone_text;
            $contact->email = $request->email;
            $contact->email_text = $request->email_text;
            $contact->latitude = $request->latitude;
            $contact->longitude = $request->longitude;
            $contact->zoom_level = $request->zoom_level;
            $contact->school_id = Auth::user()->school_id;
            $contact->google_map_address = $request->google_map_address;
            if ($fileName != "") {
                $contact->image = $fileName;
            }

            $result = $contact->save();

            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('contact-page');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function aboutPage()
    {

        try {
            $about_us = SmAboutPage::first();
            return view('frontEnd.about_us', compact('about_us'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function aboutPageEdit()
    {

        try {
            $about_us = SmAboutPage::first();
            $update = "";

            return view('frontEnd.about_us', compact('about_us', 'update'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function newsHeading()
    {

        try {
            $SmNewsPage = SmNewsPage::first();
            $update = "";

            return view('backEnd.news.newsHeadingUpdate', compact('SmNewsPage', 'update'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function newsHeadingUpdate(Request $request)
    {

        if ($request->file('image') == "" && $request->file('main_image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
            ]);
        } elseif ($request->file('image') != "" && $request->file('main_image') != "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'dimensions:min_width=1420,min_height=450',
                'main_image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        } elseif ($request->file('image') != "" && $request->file('main_image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        } elseif ($request->file('image') == "" && $request->file('main_image') != "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'main_image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        }

        try {
            $fileName = "";
            if ($request->file('image') != "") {
                $about = SmNewsPage::find(1);
                if ($about != "") {
                    if ($about->image != "") {
                        if (file_exists($about->image)) {
                            unlink($about->image);
                        }
                    }
                }

                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/about_page/', $fileName);
                $fileName = 'public/uploads/about_page/' . $fileName;
            }

            $mainfileName = "";
            if ($request->file('main_image') != "") {
                $about = SmNewsPage::find(1);
                if ($about != "") {
                    if ($about->main_image != "") {
                        if (file_exists($about->main_image)) {
                            unlink($about->main_image);
                        }
                    }
                }

                $file = $request->file('main_image');
                $mainfileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/about_page/', $mainfileName);
                $mainfileName = 'public/uploads/about_page/' . $mainfileName;
            }

            $about = SmNewsPage::first();
            if ($about == "") {
                $about = new SmNewsPage();
            }
            $about->title = $request->title;
            $about->description = $request->description;
            $about->main_title = $request->main_title;
            $about->main_description = $request->main_description;
            $about->button_text = $request->button_text;
            $about->button_url = $request->button_url;
            if ($fileName != "") {
                $about->image = $fileName;
            }
            if ($mainfileName != "") {
                $about->main_image = $mainfileName;
            }
            $result = $about->save();

            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('news-heading-update');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect('news-heading-update');
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    // end heading update

    public function courseHeading()
    {

        try {
            $SmCoursePage = SmCoursePage::first();
            $update = "";

            return view('backEnd.course.courseHeadingUpdate', compact('SmCoursePage', 'update'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseDetailsHeading()
    {

        try {
            $SmCoursePage = SmCoursePage::where('is_parent', 0)->first();
            $update = "";

            return view('backEnd.course.courseDetailsHeading', compact('SmCoursePage', 'update'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseDetailsHeadingUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'image' => 'nullable',
        ]);

        try {
            $about = SmCoursePage::where('is_parent', 0)->first();
            if ($about == "") {
                $about = new SmCoursePage();
            }
            $fileName = "";
            if ($request->file('image') != "") {
                $about = SmCoursePage::find(1);
                if ($about != "") {
                    if ($about->image != "") {
                        if (file_exists($about->image)) {
                            unlink($about->image);
                        }
                    }
                }

                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/about_page/', $fileName);
                $fileName = 'public/uploads/about_page/' . $fileName;
                $about->image = $fileName;
            }
            $about->title = $request->title;
            $about->description = $request->description;
            $about->button_text = $request->button_text;
            $about->button_url = $request->button_url;
            $about->is_parent = 0;
            $result = $about->save();

            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('course-details-heading');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect('course-heading-update');
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseHeadingUpdate(Request $request)
    {
        // if ($request->file('image') == "" && $request->file('main_image') == "") {
        if ($request->file('image')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
            ]);
        // } elseif ($request->file('image') != "" && $request->file('main_image') != "") {
        } elseif ($request->file('image')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'dimensions:min_width=1420,min_height=450',
                'main_image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        // } elseif ($request->file('image') != "" && $request->file('main_image') == "") {
        } elseif ($request->file('image')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        // } elseif ($request->file('image') == "" && $request->file('main_image') != "") {
        } elseif ($request->file('image')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'main_image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        }

        try {
            $fileName = "";
            if ($request->file('image') != "") {
                $about = SmCoursePage::find(1);
                if ($about != "") {
                    if ($about->image != "") {
                        if (file_exists($about->image)) {
                            unlink($about->image);
                        }
                    }
                }

                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/about_page/', $fileName);
                $fileName = 'public/uploads/about_page/' . $fileName;
            }

            // $mainfileName = "";
            // if ($request->file('main_image') != "") {
            //     $about = SmCoursePage::find(1);
            //     if ($about != "") {
            //         if ($about->main_image != "") {
            //             if (file_exists($about->main_image)) {
            //                 unlink($about->main_image);
            //             }
            //         }
            //     }

            //     $file = $request->file('main_image');
            //     $mainfileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //     $file->move('public/uploads/about_page/', $mainfileName);
            //     $mainfileName = 'public/uploads/about_page/' . $mainfileName;
            // }

            $about = SmCoursePage::first();
            if ($about == "") {
                $about = new SmCoursePage();
            }
            $about->title = $request->title;
            $about->description = $request->description;
            $about->main_title = $request->main_title;
            $about->main_description = $request->main_description;
            $about->button_text = $request->button_text;
            $about->button_url = $request->button_url;
            if ($fileName != "") {
                $about->image = $fileName;
            }
            // if ($mainfileName != "") {
            //     $about->main_image = $mainfileName;
            // }
            $result = $about->save();

            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('course-heading-update');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect('course-heading-update');
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function aboutPageStore(Request $request)
    {

        if ($request->file('image') == "" && $request->file('main_image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
            ]);
        } elseif ($request->file('image') != "" && $request->file('main_image') != "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'dimensions:min_width=1420,min_height=450',
                'main_image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        } elseif ($request->file('image') != "" && $request->file('main_image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        } elseif ($request->file('image') == "" && $request->file('main_image') != "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'main_image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1420,min_height=450',
            ]);
        }

        try {
            $fileName = "";
            if ($request->file('image') != "") {
                $about = SmAboutPage::find(1);
                if ($about != "") {
                    if ($about->image != "") {
                        if (file_exists($about->image)) {
                            unlink($about->image);
                        }
                    }
                }

                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/about_page/', $fileName);
                $fileName = 'public/uploads/about_page/' . $fileName;
            }

            $mainfileName = "";
            if ($request->file('main_image') != "") {
                $about = SmAboutPage::find(1);
                if ($about != "") {
                    if ($about->main_image != "") {
                        if (file_exists($about->main_image)) {
                            unlink($about->main_image);
                        }
                    }
                }

                $file = $request->file('main_image');
                $mainfileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/about_page/', $mainfileName);
                $mainfileName = 'public/uploads/about_page/' . $mainfileName;
            }

            $about = SmAboutPage::first();
            if ($about == "") {
                $about = new SmAboutPage();
            }
            $about->title = $request->title;
            $about->description = $request->description;
            $about->main_title = $request->main_title;
            $about->main_description = $request->main_description;
            $about->button_text = $request->button_text;
            $about->button_url = $request->button_url;
            if ($fileName != "") {
                $about->image = $fileName;
            }
            if ($mainfileName != "") {
                $about->main_image = $mainfileName;
            }
            $result = $about->save();

            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('about-page');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $contact_message = new SmContactMessage();
            $contact_message->name = $request->name;
            $contact_message->email = $request->email;
            $contact_message->subject = $request->subject;
            $contact_message->message = $request->message;
            $result = $contact_message->save();

            $receiver_name= "System Admin";
            $subject= $request->subject;
            $view= "frontEnd.contact_mail";
            $compact['data'] = array('name' => $request->name, 'email' => $request->email,'subject'=>$request->subject,'message'=>$request->message);
            $contact_page_email = SmContactPage::where('school_id', Auth::user()->school_id)->first();
            $setting = SmGeneralSettings::find(1);
            if($contact_page_email->email){
                $email = $contact_page_email->email;
            }else{
                $email = $setting->email;
            }

            @send_mail($email, $receiver_name, $subject, $view, $compact);
              
            DB::commit();
            if ($result) {
                return response()->json(['success'=>'success']);
            } else {
                return response()->json(['error'=>'error']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json('error');
        }
    }

    public function deleteMessage($id){
        try{
            SmContactMessage::find($id)->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect('contact-message');
        }catch(\Exception $e){
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function contactMessage(Request $request)
    {
        try {
            $contact_messages = SmContactMessage::orderBy('id', 'desc')->get();
            $module_links = InfixPermissionAssign::where('role_id', Auth::user()->role_id)->where('school_id', Auth::user()->school_id)->pluck('module_id')->toArray();
            return view('frontEnd.contact_message', compact('contact_messages', 'module_links'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    //user register method start
    public function register()
    {

        try {
            $login_background = SmBackgroundSetting::where([['is_default', 1], ['title', 'Login Background']])->first();

            if (empty($login_background)) {
                $css = "";
            } else {
                if (!empty($login_background->image)) {
                    $css = "background: url('" . url($login_background->image) . "')  no-repeat center;  background-size: cover;";

                } else {
                    $css = "background:" . $login_background->color;
                }
            }
            $schools = SmSchool::where('active_status', 1)->get();
            return view('auth.registerCodeCanyon', compact('schools', 'css'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function customer_register(Request $request)
    {

        $request->validate([
            'fullname' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);

        try {
            //insert data into user table
            $s = new User();
            $s->role_id = 4;
            $s->full_name = $request->fullname;
            $s->username = $request->email;
            $s->email = $request->email;
            $s->active_status = 0;
            $s->access_status = 0;
            $s->password = Hash::make($request->password);
            $s->save();
            $result = $s->toArray();
            $last_id = $s->id; //last id of user table

            //insert data into staff table
            $st = new SmStaff();
            $st->school_id = 1;
            $st->user_id = $last_id;
            $st->role_id = 4;
            $st->first_name = $request->fullname;
            $st->full_name = $request->fullname;
            $st->last_name = '';
            $st->staff_no = 10;
            $st->email = $request->email;
            $st->active_status = 0;
            $st->save();

            $result = $st->toArray();
            if (!empty($result)) {
                Toastr::success('Operation successful', 'Success');
                return redirect('login');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            Toastr::error('Operation Failed,' . $e->getMessage(), 'Failed');
            return redirect()->back();
        }
    }

    public function course()
    {

        try {
            $exams = SmExam::all();
            $course = SmCourse::paginate(3);
            $news = SmNews::orderBy('order', 'asc')->limit(4)->get();
            $exams_types = SmExamType::all();
            $coursePage = SmCoursePage::first();
            $classes = SmClass::where('active_status', 1)->get();
            $subjects = SmSubject::where('active_status', 1)->get();
            $sections = SmSection::where('active_status', 1)->get();
            return view('frontEnd.home.light_course', compact('exams', 'classes', 'coursePage', 'subjects', 'exams_types', 'sections', 'course', 'news'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseDetails($id)
    {
        try {
            $course = SmCourse::find($id);
            $course_details = SmCoursePage::where('is_parent',0)->first();
            $courses = SmCourse::orderBy('id', 'asc')->whereNotIn('id', [$id])->limit(3)->get();
            return view('frontEnd.home.light_course_details', compact('course', 'courses','course_details'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function loadMoreCourse(Request $request)
    {
        try{
            $count = SmCourse::count();
            $skip = $request->skip;
            $limit = $count - $skip;
            $due_courses = SmCourse::skip($skip)->take(3)->get();
            return view('frontEnd.home.loadMorePage',compact('due_courses','skip','count'));
        }catch(\Exception $e){
            return response('error');
        }
    }

    public function socialMedia()
    {
        $visitors = SmSocialMediaIcon::all();
        return view('frontEnd.socialMedia', compact('visitors'));
    }

    public function socialMediaStore(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'icon' => 'required',
            // 'icon' => 'required|dimensions:min_width=24,max_width=24',
            'status' => 'required',
        ]);
        try {
            // $fileName = "";
            // if ($request->file('icon') != "") {
            //     $file = $request->file('icon');
            //     $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //     $file->move('public/uploads/socialIcon/', $fileName);
            //     $fileName = 'public/uploads/socialIcon/' . $fileName;
            // }
            $visitor = new SmSocialMediaIcon();
            $visitor->url = $request->url;
            $visitor->icon = $request->icon;
            $visitor->status = $request->status;
            $result = $visitor->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {

                    return ApiBaseMethod::sendResponse(null, 'Created successfully.');
                }
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            } else {
                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function socialMediaEdit($id)
    {
        $visitors = SmSocialMediaIcon::all();
        $visitor = SmSocialMediaIcon::find($id);
        return view('frontEnd.socialMedia', compact('visitors', 'visitor'));
    }

    public function socialMediaUpdate(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'icon' => 'required',
            // 'icon' => 'dimensions:min_width=24,max_width=24',
            'status' => 'required',
        ]);

        try {
            // $fileName = "";
            // if ($request->file('icon') != "") {

            //     $visitor = SmSocialMediaIcon::find($request->id);
            //     if ($visitor->icon != "") {
            //         if (file_exists($visitor->icon)) {
            //             unlink($visitor->icon);
            //         }
            //     }

            //     $file = $request->file('icon');
            //     $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //     $file->move('public/uploads/socialIcon/', $fileName);
            //     $fileName = 'public/uploads/socialIcon/' . $fileName;

            // }

            $visitor = SmSocialMediaIcon::find($request->id);
            $visitor->url = $request->url;
            $visitor->icon = $request->icon;
            $visitor->status = $request->status;
            $result = $visitor->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {

                    return ApiBaseMethod::sendResponse(null, 'Updated successfully.');
                }
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            } else {
                if ($result) {

                    Toastr::success('Operation successful', 'Success');
                    return redirect('social-media');
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function socialMediaDelete(Request $request, $id)
    {
        try {
            $visitor = SmSocialMediaIcon::find($id);
            // if ($visitor->icon != "") {
            //     if (file_exists($visitor->icon)) {
            //         unlink($visitor->icon);
            //     }
            // }
            $result = $visitor->delete();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {
                    return ApiBaseMethod::sendResponse(null, 'Deleted successfully.');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('social-media');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function headerMenuManager()
    {
        try{
            $pages = SmPage::where('is_dynamic',1)->get();
            $static_pages = SmPage::where('is_dynamic',0)->get();
            $courses = SmCourse::where('school_id',Auth::user()->school_id)->get();
            $courseCategories = SmCourseCategory::where('school_id',Auth::user()->school_id)->get();
            $news = SmNews::where('school_id',Auth::user()->school_id)->get();
            $news_categories = SmNewsCategory::where('school_id',Auth::user()->school_id)->get();
            $menus = SmHeaderMenuManager::where('parent_id',NULL)->orderBy('position')->get();
            return view('frontEnd.headerMenuManager',compact('pages','static_pages','courses','courseCategories','news_categories','news','menus'));
        }catch (\Exception $e) {
            return response('error');
        }
    }

    public function addElement(Request $request)
    {
        try{
            if($request->type == "dPages"){
                foreach($request->element_id as $data){
                    $dpage = SmPage::findOrFail($data);
                    SmHeaderMenuManager::create([
                        'title' => $dpage->title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => $dpage->slug,
                        'position' => 387437
                    ]);
                }
            }elseif($request->type == "sPages"){
                foreach($request->element_id as $data){
                    $spage = SmPage::findOrFail($data);
                    SmHeaderMenuManager::create([
                        'title' => $spage->title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => $spage->slug,
                        'position' => 387437
                    ]);
                }
            }elseif($request->type == "dCourse"){
                foreach($request->element_id as $data){
                    $spage = SmCourse::findOrFail($data);
                    SmHeaderMenuManager::create([
                        'title' => $spage->title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'position' => 387437
                    ]);
                }
            }elseif($request->type == "dCourseCategory"){
                foreach($request->element_id as $data){
                    $spage = SmCourseCategory::findOrFail($data);
                    SmHeaderMenuManager::create([
                        'title' => $spage->category_name,
                        'type' => $request->type,
                        'element_id' => $data,
                        'position' => 387437
                    ]);
                }
            }elseif($request->type == "dNews"){
                foreach($request->element_id as $data){
                    $dNews = SmNews::findOrFail($data);
                    SmHeaderMenuManager::create([
                        'title' => $dNews->news_title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'position' => 387437
                    ]);
                }
            }elseif($request->type == "dNewsCategory"){
                foreach($request->element_id as $data){
                    $dNewsCategory = SmNewsCategory::findOrFail($data);
                    SmHeaderMenuManager::create([
                        'title' => $dNewsCategory->category_name,
                        'type' => $request->type,
                        'element_id' => $data,
                        'position' => 387437
                    ]);
                }
            }elseif($request->type == "customLink"){
                SmHeaderMenuManager::create([
                    'title' => $request->title,
                    'link' => $request->link,
                    'type' => $request->type,
                    'position' => 387437
                ]);
            }
            return $this->reloadWithData();
       }catch (\Exception $e) {
            return response('error');
        }
    }

    public function elementUpdate(Request $request)
    {
        try{
            if($request->type == "dPages"){
                SmHeaderMenuManager::where('id',$request->id)->update([
                    'title' => $request->title,
                    'type' => $request->type,
                    'element_id' => $request->page,
                    'show' => $request->content_show,
                    'is_newtab' => $request->is_newtab,
                ]);
            }elseif($request->type == "sPages"){
                SmHeaderMenuManager::where('id',$request->id)->update([
                    'title' => $request->title,
                    'type' => $request->type,
                    'element_id' => $request->static_pages,
                    'show' => $request->content_show,
                    'is_newtab' => $request->is_newtab,
                ]);
            }elseif($request->type == "dCourse"){
                SmHeaderMenuManager::where('id',$request->id)->update([
                        'title' => $request->title,
                        'type' => $request->type,
                        'element_id' => $request->course,
                        'show' => $request->content_show,
                        'is_newtab' => $request->is_newtab,
                    ]);
            }elseif($request->type == "dCourseCategory"){
                SmHeaderMenuManager::where('id',$request->id)->update([
                        'title' => $request->title,
                        'type' => $request->type,
                        'element_id' => $request->course_category,
                        'show' => $request->content_show,
                        'is_newtab' => $request->is_newtab,
                    ]);
            }elseif($request->type == "dNews"){
                SmHeaderMenuManager::where('id',$request->id)->update([
                    'title' => $request->title,
                    'type' => $request->type,
                    'element_id' => $request->news,
                    'show' => $request->content_show,
                    'is_newtab' => $request->is_newtab,
                ]);
            }elseif($request->type == "dNewsCategory"){
                SmHeaderMenuManager::where('id',$request->id)->update([
                    'title' => $request->title,
                    'type' => $request->type,
                    'element_id' => $request->news_category,
                    'show' => $request->content_show,
                    'is_newtab' => $request->is_newtab,
                ]);
            }elseif($request->type == "customLink"){
                SmHeaderMenuManager::where('id',$request->id)->update([
                    'title' => $request->title,
                    'link' => $request->link,
                    'type' => $request->type,
                    'show' => $request->content_show,
                    'is_newtab' => $request->is_newtab,
                ]);
            }
            return $this->reloadWithData();
       }catch (\Exception $e) {
            return response('error');
        }
    }

    public function deleteElement(Request $request)
    {
        try{
            $element = SmHeaderMenuManager::find($request->id);
                if(count($element->childs) > 0){
                    foreach($element->childs as $child){
                        $child->update(['parent_id' => $element->parent_id]);
                    }
                }
            $element->delete();
            return $this->reloadWithData();
        }catch (\Exception $e) {
            return response('error');
        }
    }

    public function reordering(Request $request)
    {
        $menuItemOrder = json_decode($request->get('order'));
        $this->orderMenu($menuItemOrder, null);
        return true;
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach($menuItems as $index => $item){
            
            $menuItem = SmHeaderMenuManager::findOrFail($item->id);
            $menuItem->update([
                'position' => $index + 1,
                'parent_id' => $parentId
                ]);
            if(isset($item->children)){
                $this->orderMenu($item->children, $menuItem->id);
            }
        }
    }

    private function reloadWithData()
    {
        $pages = SmPage::where('is_dynamic',1)->get();
        $static_pages = SmPage::where('is_dynamic',0)->get();
        $courses = SmCourse::where('school_id',Auth::user()->school_id)->get();
        $courseCategories = SmCourseCategory::where('school_id',Auth::user()->school_id)->get();
        $news = SmNews::where('school_id',Auth::user()->school_id)->get();
        $news_categories = SmNewsCategory::where('school_id',Auth::user()->school_id)->get();
        $menus = SmHeaderMenuManager::where('parent_id',NULL)->orderBy('position')->get();
        return view('frontEnd.headerSubmenuList',compact('pages','static_pages','courses','courseCategories','news_categories','news','menus'));
    }

    public function pageList()
    {
        try{
            $pages = SmPage::where('is_dynamic',1)->get();
            return view('frontEnd.pageList',compact('pages'));
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function createPage()
    {
        return view('frontEnd.createPage');
    }

    public function savePageData(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:sm_pages,slug',
            'details' => 'required',
            'header_image'=> 'dimensions:min_width=1420,min_height=450',
        ]);
        try{
            $fileName = "";
            $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
            $file = $request->file('header_image');
            $fileSize =  filesize($file);
            $fileSizeKb = ($fileSize / 1000000);
            if($fileSizeKb >= $maxFileSize){
                Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                return redirect()->back();
            }
            if ( ($request->file('header_image') != "")) {
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/pages/', $fileName);
                $fileName = 'public/uploads/pages/' . $fileName;

            }
            elseif ($file != "") {
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/pages/', $fileName);
                $fileName = 'public/uploads/pages/' . $fileName;
            }

            $data= new SmPage();
            $data->title= $request->title;
            $data->sub_title= $request->sub_title;
            $data->slug= $request->slug;
            $data->details= $request->details;
            $data->header_image = $fileName;
            $data->save();
            Toastr::success('Operation successfull', 'Success');
            return redirect('create-page');
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function editPage($id)
    {
        try{
            $editData = SmPage::find($id);
            return view('frontEnd.createPage',compact('editData'));
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updatePageData(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:sm_pages,slug,'.$request->id,
            'details' => 'required',
        ]);

        try{

            $fileName = "";
            $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
            $file = $request->file('header_image');
            $fileSize =  filesize($file);
            $fileSizeKb = ($fileSize / 1000000);
            if($fileSizeKb >= $maxFileSize){
                Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                return redirect()->back();
            }

            if ( ($request->file('header_image') != "")) {
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/pages/', $fileName);
                $fileName = 'public/uploads/pages/' . $fileName;

            }

            elseif ($file != "") {
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/pages/', $fileName);
                $fileName = 'public/uploads/pages/' . $fileName;
            }
            $data= SmPage::find($request->id);
            $data->title= $request->title;
            $data->sub_title= $request->sub_title;
            $data->slug= $request->slug;
            $data->details= $request->details;
            if ($request->file('header_image') != "") {
                $data->header_image = $fileName;
            }
            $data->save();
            Toastr::success('Operation successfull', 'Success');
            return redirect('page-list');
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    



    public function viewPage($slug)
    {
        try{
            $page = SmPage::where('slug',$slug)->first();
            return view('frontEnd.pages.pages',compact('page'));
         }catch (\Exception $e) {
             Toastr::error('Operation Failed', 'Failed');
             return redirect()->back();
         }
    }

    public function deletePage(Request $request)
    {
        try{
            $data = SmPage::find($request->id);

            if ($data->header_image != "") {
                unlink($data->header_image);
            }

           $result = SmPage::find($request->id)->delete();
           if($result){
                Toastr::success('Operation Successfull', 'Success');
           }else{
                Toastr::error('Operation Failed', 'Failed');
           }
            return redirect('page-list');
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}