<?php

namespace App\Http\Controllers;
use File;
use App\User;
use Response;
use ZipArchive;
use App\SmClass;
use App\SmStaff;
use App\SmParent;
use App\SmStudent;
use App\YearCheck;
use App\SmHomework;
use App\ApiBaseMethod;
use App\SmClassSection;
use App\SmNotification;
use App\SmAssignSubject;
use App\SmGeneralSettings;
use App\SmHomeworkStudent;
use Illuminate\Http\Request;
use App\SmUploadHomeworkContent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Notifications\HomeworkNotification;
use Illuminate\Support\Facades\Notification;

class SmHomeworkController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}

    public function homeworkList(Request $request)
    {
        try {
            set_time_limit(900);
            if (teacherAccess()) {
                $homeworkLists = SmHomework::where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)
                ->get();

            } else {
                $homeworkLists = SmHomework::where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)
                ->where('created_by',Auth::user()->id)
                ->get();
            }
            
        if (teacherAccess()) {
            $teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
               $classes= SmAssignSubject::where('teacher_id',$teacher_info->id)
               ->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
               ->where('sm_assign_subjects.academic_id', getAcademicId())
               ->where('sm_assign_subjects.active_status', 1)
               ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
               ->distinct ()
               ->select('sm_classes.id','class_name')
                ->groupBy('sm_classes.id')
               ->get();
        } else {
            $classes = SmClass::where('active_status', 1)
                        ->where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->get();
        }
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['homeworkLists'] = $homeworkLists->toArray();
                $data['classes'] = $classes->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.homework.homeworkList', compact('classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function searchHomework(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class_id' => "required",
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $homeworkLists = SmHomework::query();
            $homeworkLists->where('active_status', 1);
            $homeworkLists->where('class_id', $request->class_id);

            if ($request->section_id != "") {
                $homeworkLists->where('section_id', $request->section_id);
            }
            if ($request->subject_id != "") {
                $homeworkLists->where('subject_id', $request->subject_id);
            }
            if (Auth::user()->role_id == 1) {
                $homeworkLists = $homeworkLists->where('academic_id', getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->get();

            } else {
                $homeworkLists = $homeworkLists->where('academic_id', getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->where('created_by',Auth()->user()->id)
                                ->get();
            }
            $classes = SmClass::where('active_status', '=', '1')
                    ->where('academic_id', getAcademicId())
                    ->where('school_id',Auth::user()->school_id)
                    ->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['homeworkLists'] = $homeworkLists->toArray();
                $data['classes'] = $classes->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.homework.homeworkList', compact('homeworkLists', 'classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function addHomework()
    {
        try {
            if (teacherAccess()) {
                $teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
               $classes= SmAssignSubject::where('teacher_id',$teacher_info->id)
               ->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
               ->where('sm_assign_subjects.academic_id', getAcademicId())
               ->where('sm_assign_subjects.active_status', 1)
               ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
               ->distinct ()
               ->select('sm_classes.id','class_name')
                ->groupBy('sm_classes.id')
               ->get();
        } else {
               $classes = SmClass::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)
                ->get();
        }
            return view('backEnd.homework.addHomework', compact('classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function saveHomeworkData(Request $request)
    {
    //   return   $request->all();
        $request->validate([
            'class_id' => "required",
            'section_id' => "required",
            'subject_id' => "required",
            'homework_date' => "required",
            'submission_date' => "required",
            'marks' => "required|integer|min:0",
            'description' => "required",
            'homework_file' => "sometimes|nullable|mimes:pdf,doc,docx,txt,jpg,jpeg,png,mp4,ogx,oga,ogv,ogg,webm,mp3,",
        ]);

        try {
            $fileName = "";
            if ($request->file('homework_file') != "") {
                $file = $request->file('homework_file');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/homework/', $fileName);
                $fileName = 'public/uploads/homework/' . $fileName;
            }
            $sections=[];
            foreach($request->section_id as $section){
                $sections[]=$section;
                $homeworks = new SmHomework();
                $homeworks->class_id = $request->class_id;
                $homeworks->section_id = $section;
                $homeworks->subject_id = $request->subject_id;
                $homeworks->homework_date = date('Y-m-d', strtotime($request->homework_date));
                $homeworks->submission_date = date('Y-m-d', strtotime($request->submission_date));
                $homeworks->marks = $request->marks;
                $homeworks->description = $request->description;
                $homeworks->file = $fileName;
                $homeworks->created_by = Auth()->user()->id;
                $homeworks->school_id = Auth::user()->school_id;
                $homeworks->academic_id = getAcademicId();
                $results = $homeworks->save();
            }
            
            $students = SmStudent::where('class_id', $request->class_id)
                        ->whereIn('section_id', $sections)
                        ->where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->get();

            foreach ($students as $student) {

                $notification = new SmNotification;
                $notification->user_id = $student->user_id;
                $notification->role_id = 2;
                $notification->date = date('Y-m-d');
                $notification->message = app('translator')->get('lang.homework_assigned');
                $notification->school_id = Auth::user()->school_id;
                $notification->academic_id = getAcademicId();
                $notification->save();
                
                try{
                    $user=User::find($student->user_id);
                    Notification::send($user, new HomeworkNotification($notification));
                }catch (\Exception $e) {
                    Log::info($e->getMessage());
                }

                $parent = SmParent::find($student->parent_id);
                        $notification = new SmNotification();
                        $notification->role_id = 3;
                        $notification->message = app('translator')->get('lang.homework_assigned_child');
                        $notification->date = date('Y-m-d');
                        $notification->user_id = $parent->user_id;
                        $notification->url = "homework-list";
                        $notification->school_id = Auth::user()->school_id;
                        $notification->academic_id = getAcademicId();
                        $notification->save();

                        try{
                            $user=User::find($parent->user_id);
                            Notification::send($user, new HomeworkNotification($notification));
                        }catch (\Exception $e) {
                            Log::info($e->getMessage());
                        }
            }

            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('homework-list');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function downloadHomeworkData($id,$student_id)
    {
        try{
            $hwContent=SmUploadHomeworkContent::where('homework_id',$id)->where('student_id',$student_id)->get();           


            $file_paths=[];
            foreach ($hwContent as $key => $files_row) {
                $only_files=json_decode($files_row->file);
                foreach ($only_files as $second_key => $upload_file_path) {
                    $file_paths[]= $upload_file_path;
                }
            }
            if (count($file_paths)==1) {
                return Response::download($file_paths[0]);
            }else{

                $zip_file_name = str_replace(' ', '_',time().'.zip'); // Name of our archive to download
    
                $new_file_array=[];
                foreach ($file_paths as $key => $file) {
                    $file_name_array=explode('/',$file);
                    $file_original=$file_name_array[array_key_last($file_name_array)];
                    $new_file_array[$key]['path']=$file;
                    $new_file_array[$key]['name']=$file_original;
                    
                }
                $public_dir=public_path('uploads/homeworkcontent');
                $zip = new ZipArchive;
                if ($zip->open($public_dir . '/' . $zip_file_name, ZipArchive::CREATE) === TRUE) {    
                    // Add Multiple file   
                    foreach($new_file_array as $key=> $file) {
                        $zip->addFile($file['path'], @$file['name']);
                    }      
                    $zip->close();
                }

                $zip_file_url=asset('public/uploads/homeworkcontent/'.$zip_file_name);
                session()->put('homework_zip_file', $zip_file_name);
                return Redirect::to($zip_file_url);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function evaluationHomework(Request $request, $class_id, $section_id, $homework_id)
    {
        try {
            $homeworkDetails = SmHomework::where('class_id', $class_id)
                            ->where('section_id', $section_id)
                            ->where('id', $homework_id)
                            ->where('academic_id', getAcademicId())
                            ->first();

            $students = SmStudent::where('class_id', $class_id)
                        ->where('section_id', $section_id)
                        ->where('active_status', 1)
                        ->where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->get();

            return view('backEnd.homework.evaluationHomework', compact('homeworkDetails', 'students', 'homework_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function saveHomeworkEvaluationData(Request $request)
    {
        try {
            if (!$request->student_id) {
                Toastr::error('Their are no students selected', 'Failed');
                return redirect()->back();
            } else {
                $student_idd = count($request->student_id);
                if ($student_idd > 0) {
                    for ($i = 0; $i < $student_idd; $i++) {
                         if (checkAdmin()) {
                            SmHomeworkStudent::where('student_id', $request->student_id[$i])
                            ->where('homework_id', $request->homework_id)
                            ->delete();
                        }else{
                             SmHomeworkStudent::where('student_id', $request->student_id[$i])
                             ->where('homework_id', $request->homework_id)
                             ->where('school_id',Auth::user()->school_id)
                             ->delete();
                        }
                        $homeworkstudent = new SmHomeworkStudent();
                        $homeworkstudent->homework_id = $request->homework_id;
                        $homeworkstudent->student_id = $request->student_id[$i];
                        $homeworkstudent->marks = $request->marks[$i];
                        $homeworkstudent->teacher_comments = $request->teacher_comments[$request->student_id[$i]];
                        $homeworkstudent->complete_status = $request->homework_status[$request->student_id[$i]];
                        $homeworkstudent->created_by = Auth()->user()->id;
                        $homeworkstudent->school_id = Auth::user()->school_id;
                        $homeworkstudent->academic_id = getAcademicId();
                        $results = $homeworkstudent->save();
                    }
                    $homeworks = SmHomework::find($request->homework_id);
                    $homeworks->evaluation_date = date('Y-m-d', strtotime($request->evaluation_date));
                    $homeworks->evaluated_by = Auth()->user()->id;
                    $resultss = $homeworks->update();
                }
                if ($results) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('homework-list');
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function evaluationReport(Request $request)
    {
        try {
            if (teacherAccess()) {
                $teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
                $classes= SmAssignSubject::where('teacher_id',$teacher_info->id)
                ->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
                ->where('sm_assign_subjects.academic_id', getAcademicId())
                ->where('sm_assign_subjects.active_status', 1)
                ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
                ->select('sm_classes.id','class_name')
                ->groupBy('sm_classes.id')
                ->get();
            } else {
                $classes = SmClass::where('active_status', 1)
                    ->where('academic_id', getAcademicId())
                    ->where('school_id',Auth::user()->school_id)
                    ->get();
            }
            return view('backEnd.reports.evaluation', compact('classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function searchEvaluation(Request $request)
    {
        
        $request->validate([
            'class_id' => "required",
            'subject_id' => "required",
        ]);

        try {
            if (teacherAccess()) {
                $homeworkLists = SmHomework::query();
                if($request->class_id !=null){
                  $homeworkLists ->where('class_id', '=', $request->class_id);
                }
                if($request->subject_id !=null){
                    $homeworkLists->where('subject_id', '=', $request->subject_id);
                }

                if($request->section_id !=null){

                    $homeworkLists->where('section_id', '=', $request->section_id);
                }
             $homeworkLists=$homeworkLists->where('active_status', '=', '1')             
                                    ->where('academic_id', getAcademicId())
                                    ->where('school_id',Auth::user()->school_id)
                                    ->where('created_by',Auth::user()->id)
                                    ->get();
            } else {
                $homeworkLists = SmHomework::query();
                if($request->class_id !=null){
                  $homeworkLists ->where('class_id', '=', $request->class_id);
                }
                if($request->subject_id !=null){
                    $homeworkLists->where('subject_id', '=', $request->subject_id);
                }

                if($request->section_id !=null){

                    $homeworkLists->where('section_id', '=', $request->section_id);
                }
                $homeworkLists = $homeworkLists->where('active_status', '=', '1')
                                ->where('subject_id', '=', $request->subject_id)
                                ->where('academic_id', getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->get();
            }

        if (teacherAccess()) {
            $teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
               $classes= SmAssignSubject::where('teacher_id',$teacher_info->id)
               ->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
               ->where('sm_assign_subjects.academic_id', getAcademicId())
               ->where('sm_assign_subjects.active_status', 1)
               ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
               ->select('sm_classes.id','class_name')
                ->groupBy('sm_classes.id')
               ->get();
        } else {
               $classes = SmClass::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)
                ->get();
        }
            return view('backEnd.reports.evaluation', compact('homeworkLists', 'classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function viewEvaluationReport($homework_id)
    {

        try {
            $homeworkDetails = SmHomework::where('id', $homework_id)
                                ->where('academic_id', getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->first();

            $homework_students = SmHomeworkStudent::where('homework_id', $homework_id)
                                ->where('academic_id', getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->get();

            return view('backEnd.reports.viewEvaluationReport', compact('homeworkDetails', 'homework_students'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function homeworkEdit($id)
    {
        try {
             if (checkAdmin()) {
                $homeworkList = SmHomework::find($id);
            }else{
                $homeworkList = SmHomework::where('id',$id)
                            ->where('school_id',Auth::user()->school_id)
                            ->first();
            }
        if (teacherAccess()) {
                $teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
                $classes= SmAssignSubject::where('teacher_id',$teacher_info->id)
                ->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
                ->where('sm_assign_subjects.academic_id', getAcademicId())
                ->where('sm_assign_subjects.active_status', 1)
                ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
                ->select('sm_classes.id','class_name')
                 ->groupBy('sm_classes.id')
                ->get();
        } else {
               $classes = SmClass::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)
                ->get();
        }
            $sections = SmClassSection::where('class_id', '=', $homeworkList->class_id)
                        ->where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->get();

            $subjects = SmAssignSubject::where('class_id', $homeworkList->class_id)
                        ->where('section_id', $homeworkList->section_id)
                        ->where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->get();

            return view('backEnd.homework.homeworkEdit', compact('homeworkList', 'classes', 'sections', 'subjects'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function homeworkUpdate(Request $request)
    {
        $request->validate([
            'class_id' => "required",
            'section_id' => "required",
            'subject_id' => "required",
            'homework_date' => "required",
            'submission_date' => "required",
            'marks' => "required|integer|min:0",
            'description' => "required",
            'homework_file' => "sometimes|nullable|mimes:pdf,doc,docx,txt,jpg,jpeg,png,mp4,ogx,oga,ogv,ogg,webm,mp3",
        ]);

        try {

            $fileName = "";
            if ($request->file('homework_file') != "") {
                $file = $request->file('homework_file');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/homework/', $fileName);
                $fileName = 'public/uploads/homework/' . $fileName;
            }

             if (checkAdmin()) {
                $homeworks = SmHomework::find($request->id);
            }else{
                $homeworks = SmHomework::where('id',$request->id)
                            ->where('school_id',Auth::user()->school_id)
                            ->first();
            }
            $homeworks->class_id = $request->class_id;
            $homeworks->section_id = $request->section_id;
            $homeworks->subject_id = $request->subject_id;
            $homeworks->homework_date = date('Y-m-d', strtotime($request->homework_date));
            $homeworks->submission_date = date('Y-m-d', strtotime($request->submission_date));
            $homeworks->marks = $request->marks;
            $homeworks->description = $request->description;
            if ($fileName != "") {
                $homeworks->file = $fileName;
            }
            $results = $homeworks->save();

            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('homework-list');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function homeworkDelete($id)
    {
        try{
        $tables = \App\tableList::getTableList('homework_id', $id);

        try {
            if ($tables==null) {
                // $homework = SmHomework::find($id);
                if (checkAdmin()) {
                $homework = SmHomework::find($id);
            }else{
                $homework = SmHomework::where('id',$id)
                            ->where('school_id',Auth::user()->school_id)
                            ->first();
            }
                Session::put('path', $homework);
                $result = SmHomework::destroy($id);
                if ($result) {
                    $data = Session::get('path');
                    if ($data->file != "") {
                        $path = url('/') . '/public/uploads/homework/' . $homework->file;
                        if (file_exists($path)) {}
                    }
                    Toastr::success('Operation successful', 'Success');
                    return redirect('homework-list');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } else {
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }


        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            Toastr::error($msg, 'Failed');
            return redirect()->back();
          }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}