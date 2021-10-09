<?php

namespace App\Http\Controllers;

use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\YearCheck;
use App\SmBaseSetup;
use App\ApiBaseMethod;
use App\SmClassSection;
use App\SmAssignSubject;
use App\SmGeneralSettings;
use App\SmStudentCategory;
use App\SmStudentAttendance;
use App\SmSubjectAttendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SmSubjectAttendanceController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}

    public function index(Request $request)
    {
        try{
            $classes = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();
            
                return view('backEnd.studentInformation.subject_attendance', compact('classes'));
           
            
           
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'class' => 'required | numeric ',
            'section' => 'required | numeric ',
            'subject' => 'required | numeric ',
            'attendance_date' => 'required ',
        ]);
        try{
            $date = $request->attendance_date;
            $class = $request->class;
            $subject_id = $request->subject;
            $section_id = $request->section;

            $input['attendance_date']= $date;
            $input['class']= $class;
            $input['subject']= $subject_id;
            $input['section']= $section_id;

            $classes = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();
            $sections = SmClassSection::with('sectionName')->where('active_status', 1)->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)->where('class_id', $class)->get();
            $subjects = SmAssignSubject::with('subject')->where('active_status', 1)->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)->where('class_id', $class)->where('section_id', $section_id)
                ->groupBy('subject_id')->get();
            $students = SmStudent::where('class_id', $class)->where('section_id', $section_id)->where('active_status', 1)->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)->get();

            if ($students->isEmpty()) {
                Toastr::error('No Result Found', 'Failed');
                return redirect('subject-wise-attendance');
            }

            $already_assigned_students = [];
            $new_students = [];
            $attendance_type = "";
            foreach ($students as $student) {
                $attendance = SmSubjectAttendance::where('student_id', $student->id)->where('subject_id', $subject_id)->where('attendance_date', date('Y-m-d', strtotime($request->attendance_date)))->where('academic_id', getAcademicId())->first();

                if ($attendance != "") {
                    $already_assigned_students[] = $attendance;
                    $attendance_type =  $attendance->attendance_type;
                } else {
                    $new_students[] =  $student;
                }
            }

            $class_id = $request->class;
            $class_info = SmClass::find($request->class);
            $section_info = SmSection::find($request->section);
            $subject_info = SmSubject::find($request->subject);

            $search_info['class_name'] = $class_info->class_name;
            $search_info['section_name'] = $section_info->section_name;
            $search_info['subject_name'] = $subject_info->subject_name;
            $search_info['date'] = $request->attendance_date;
            $generalSetting = SmGeneralSettings::where('school_id',Auth::user()->school_id)->first();
            if ($generalSetting->attendance_layout==1) {
                return view('backEnd.studentInformation.subject_attendance_list', compact('classes','subject_id','section_id','subjects','sections','date', 'class_id', 'date', 'already_assigned_students', 'new_students', 'attendance_type', 'search_info', 'input'));
            } else {
                return view('backEnd.studentInformation.subject_attendance_list2', compact('classes','subject_id','section_id','subjects','sections','date', 'class_id', 'date', 'already_assigned_students', 'new_students', 'attendance_type', 'search_info', 'input'));
            }

            
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'class' => 'required | numeric ',
            'section' => 'required | numeric ',
            'subject' => 'required | numeric ',
            'date' => 'required',
        ]);

        try {
            foreach ($request->id as $student) {
                $attendance = SmSubjectAttendance::where('student_id', $student)
                            ->where('subject_id', $request->subject)
                            ->where('attendance_date', date('Y-m-d', strtotime($request->date)))
                            ->where('academic_id', getAcademicId())
                            ->first();

                if ($attendance != "") 
                {
                    $attendance->delete(); 
                }

                $attendance = new SmSubjectAttendance();
                $attendance->attendance_type = $request->attendance[$student];
                $attendance->student_id = $student;
                $attendance->subject_id = $request->subject;
                $attendance->school_id = Auth::user()->school_id;
                $attendance->academic_id = getAcademicId();
                $attendance->notes = $request->note[$student];
                $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                $r= $attendance->save();
            }
        if($r) {
            Toastr::success('Operation successful', 'Success');
            return redirect('subject-wise-attendance');
        }else{

                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
        }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function storeAttendanceSecond(Request $request)
    {
       
    //    return date('Y-m-d', strtotime($request->attendance_date));
 
        try {

            $present_list=[];
            foreach ($request->status as $key => $std) {
                $present_list[]=$key;
            }

            foreach ($request->id as $key => $student_id) {
                # code...
                $attendance = SmSubjectAttendance::where('student_id', $student_id)
                ->where('subject_id', $request->subject_id)
                ->where('attendance_date', date('Y-m-d', strtotime($request->attendance_date)))
                ->where('academic_id', getAcademicId())
                ->first();
                if ($attendance != "")
                 { 
                    $attendance->delete(); 
                 }
                $attendance = new SmSubjectAttendance();
                $attendance->student_id = $student_id;
                $attendance->subject_id = $request->subject_id;
                $attendance->school_id = Auth::user()->school_id;
                $attendance->academic_id = getAcademicId();
                if (in_array($student_id,$present_list)) {
                    $attendance->attendance_type = 'P';
                 } else {
                    $attendance->attendance_type = 'A';
                 }

                $attendance->notes = $request->note[$student_id];
                $attendance->attendance_date = date('Y-m-d', strtotime($request->attendance_date));
                $r= $attendance->save();
            }
            return response()->json('success');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function subjectHolidayStore(Request $request)
    {     
        $students = SmStudent::where('class_id', $request->class_id)
        ->where('section_id', $request->section_id)
        ->where('active_status', 1)
        ->where('academic_id', getAcademicId())
        ->where('school_id', Auth::user()->school_id)
        ->get();

        if ($students->isEmpty()) {
            Toastr::error('No Result Found', 'Failed');
            return redirect('subject-wise-attendance');
        }
        if ($request->purpose == "mark") {
            foreach ($students as $student) {
                $attendance = SmSubjectAttendance::where('student_id', $student->id)
                    ->where('subject_id', $request->subject_id)
                    ->where('attendance_date', date('Y-m-d', strtotime($request->attendance_date)))
                    ->where('academic_id', getAcademicId())
                    ->first();
                if (!empty($attendance)) {
                    $attendance->delete();

                    $attendance = new SmSubjectAttendance();
                    $attendance->attendance_type= "H";
                    $attendance->notes= "Holiday";
                    $attendance->attendance_date = date('Y-m-d', strtotime($request->attendance_date));
                    $attendance->student_id = $student->id;
                    $attendance->subject_id = $request->subject_id;
                    $attendance->academic_id = getAcademicId();
                    $attendance->school_id = Auth::user()->school_id;
                    $attendance->save();

                }else{
                    $attendance = new SmSubjectAttendance();
                    $attendance->attendance_type= "H";
                    $attendance->notes= "Holiday";
                    $attendance->attendance_date = date('Y-m-d', strtotime($request->attendance_date));
                    $attendance->student_id = $student->id;
                    $attendance->subject_id = $request->subject_id;
                    $attendance->academic_id = getAcademicId();
                    $attendance->school_id = Auth::user()->school_id;
                    $attendance->save();
                }
            }
        }elseif($request->purpose == "unmark"){
            foreach ($students as $student) {
                $attendance = SmSubjectAttendance::where('student_id', $student->id)
                    ->where('subject_id', $request->subject_id)
                    ->where('attendance_date', date('Y-m-d', strtotime($request->attendance_date)))
                    ->where('academic_id', getAcademicId())
                    ->first();
                if (!empty($attendance)) {
                    $attendance->delete();
                }
            }
        } 
        Toastr::success('Operation successful', 'Success');
        return redirect('subject-wise-attendance');
    }

    public function subjectAttendanceReport(Request $request)
    {
        try{
            $classes = SmClass::where('active_status', 1)
            ->where('academic_id', getAcademicId())
            ->where('school_id',Auth::user()->school_id)
            ->get();

            $types = SmStudentCategory::where('school_id',Auth::user()->school_id)->get();

            $genders = SmBaseSetup::where('active_status', '=', '1')
            ->where('base_group_id', '=', '1')
            ->where('school_id',Auth::user()->school_id)
            ->get();

            return view('backEnd.studentInformation.subject_attendance_report_view', compact('classes', 'types', 'genders'));
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function subjectAttendanceReportSearch(Request $request)
    {
        $input = $request->all();
            $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required',
            'month' => 'required',
            'year' => 'required'
        ]);

        if ($validator->fails()) {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
                }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $year = $request->year;
            $month = $request->month;
            $class_id = $request->class;
            $section_id = $request->section;
            $assign_subjects = SmAssignSubject::where('class_id',$class_id)
                                ->where('section_id',$section_id)
                                ->first();

            $subject_id = $assign_subjects->subject_id;
            $current_day = date('d');

            $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
            $classes = SmClass::where('active_status', 1)
                        ->where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->get();

            $students = SmStudent::where('class_id', $request->class)
                        ->where('section_id', $request->section)
                        ->where('active_status', 1)
                        ->where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->get();

            $attendances = [];

            foreach ($students as $student) {
                $attendance = SmSubjectAttendance::where('sm_subject_attendances.student_id', $student->id)
                ->join('sm_students','sm_students.id','=','sm_subject_attendances.student_id')
                ->where('attendance_date', 'like', $year . '-' . $month . '%')
                ->where('sm_subject_attendances.academic_id', getAcademicId())
                ->where('sm_subject_attendances.school_id',Auth::user()->school_id)
                ->get();

                if ($attendance) {
                    $attendances[] = $attendance;
                }
            }

            return view('backEnd.studentInformation.subject_attendance_report_view', compact('classes', 'attendances', 'days', 'year', 'month', 'current_day', 'class_id', 'section_id','subject_id'));
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
            }
    }
    public function subjectAttendanceAverageReport(Request $request)

    {

        try{

            $classes = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();

            $types = SmStudentCategory::where('school_id',Auth::user()->school_id)->get();

            $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->where('school_id',Auth::user()->school_id)->get();

            return view('backEnd.studentInformation.subject_attendance_report_average_view', compact('classes', 'types', 'genders'));

        }catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }
    public function subjectAttendanceAverageReportSearch(Request $request)

    {

        $input = $request->all();

        $validator = Validator::make($input, [

            'class' => 'required',

            'section' => 'required',

            // 'subject' => 'required',

            'month' => 'required',

            'year' => 'required'

        ]);

        if ($validator->fails()) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());

            }

            return redirect()->back()

                ->withErrors($validator)

                ->withInput();

        }

        try{

            $year = $request->year;

            $month = $request->month;

            $class_id = $request->class;

            $section_id = $request->section;

            $assign_subjects=SmAssignSubject::where('class_id',$class_id)->where('section_id',$section_id)->first();
            $subject_id = $assign_subjects->subject_id;

            $current_day = date('d');

            $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);

            $classes = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();

            $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();

            $attendances = [];

            foreach ($students as $student) {

                $attendance = SmSubjectAttendance::where('sm_subject_attendances.student_id', $student->id)

                ->join('sm_students','sm_students.id','=','sm_subject_attendances.student_id')

                // ->where('subject_id', $subject_id)

                ->where('attendance_date', 'like', $year . '-' . $month . '%')

                ->where('sm_subject_attendances.academic_id', getAcademicId())

                ->where('sm_subject_attendances.school_id',Auth::user()->school_id)

                ->get();

                if ($attendance) {

                    $attendances[] = $attendance;

                }

            }

            // return $attendances;
            return view('backEnd.studentInformation.subject_attendance_report_average_view', compact('classes', 'attendances', 'days', 'year', 'month', 'current_day', 'class_id', 'section_id','subject_id'));

        }catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }


    public function studentAttendanceReportPrint($class_id, $section_id, $month, $year)
    {
        try{
            $current_day = date('d');
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $classes = SmClass::where('active_status', 1)->where('school_id',Auth::user()->school_id)->get();
            $students = SmStudent::where('class_id', $class_id)->where('section_id', $section_id)->where('active_status', 1)->where('school_id',Auth::user()->school_id)->get();

            $attendances = [];
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', 'like', $year . '-' . $month . '%')->where('school_id',Auth::user()->school_id)->get();
                if (count($attendance) != 0) {
                    $attendances[] = $attendance;
                }
            }
            // $customPaper = array(0, 0, 700.00, 1000.80);
            // $pdf = PDF::loadView(
            //     'backEnd.studentInformation.student_attendance_print',
            //     [
            //         'classes' => $classes,
            //         'attendances' => $attendances,
            //         'days' => $days,
            //         'year' => $year,
            //         'month' => $month,
            //         'class_id' => $class_id,
            //         'section_id' => $section_id
            //     ]
            // )->setPaper('A4', 'landscape');
            // return $pdf->stream('student_attendance.pdf');
            return view('backEnd.studentInformation.student_attendance_report', compact('classes', 'attendances', 'days', 'year', 'month', 'current_day', 'class_id', 'section_id'));

        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }
    public function subjectAttendanceReportAveragePrint($class_id, $section_id, $month, $year){
      set_time_limit(2700);
        try{
            $current_day = date('d');

            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $students = SmStudent::where('class_id', $class_id)
            ->where('section_id', $section_id)
            ->where('active_status', 1)
            ->where('academic_id', getAcademicId())
            ->where('school_id',Auth::user()->school_id)
            ->get();

            $attendances = [];

            foreach ($students as $student) {
                $attendance = SmSubjectAttendance::where('sm_subject_attendances.student_id', $student->id)
                ->join('sm_students','sm_students.id','=','sm_subject_attendances.student_id')
                ->where('attendance_date', 'like', $year . '-' . $month . '%')
                ->where('sm_subject_attendances.academic_id', getAcademicId())
                ->where('sm_subject_attendances.school_id',Auth::user()->school_id)
                ->get();

                if ($attendance) {
                    $attendances[] = $attendance;
                }
            }

        return view('backEnd.studentInformation.student_subject_attendance',compact('attendances','days' , 'year'  , 'month','class_id'  ,'section_id'));
            // $customPaper = array(0, 0, 700.00, 1900.80);
            // $pdf = PDF::loadView(
            //     'backEnd.studentInformation.student_subject_attendance',
            //     [
            //         'attendances' => $attendances,
            //         'days' => $days,
            //         'year' => $year,
            //         'month' => $month,
            //         'class_id' => $class_id,
            //         'section_id' => $section_id
            //     ]
            // )
            // ->setPaper('A4', 'landscape');
            // // ->setPaper($customPaper, 'landscape');
            // return $pdf->stream('student_subject_attendance.pdf');
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function subjectAttendanceReportPrint($class_id, $section_id, $month, $year){
      set_time_limit(2700);
        try{
            $current_day = date('d');

            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $students = SmStudent::where('class_id', $class_id)
            ->where('section_id', $section_id)
            ->where('active_status', 1)
            ->where('academic_id', getAcademicId())
            ->where('school_id',Auth::user()->school_id)
            ->get();

            $attendances = [];

            foreach ($students as $student) {
                $attendance = SmSubjectAttendance::where('sm_subject_attendances.student_id', $student->id)
                ->join('sm_students','sm_students.id','=','sm_subject_attendances.student_id')
                ->where('attendance_date', 'like', $year . '-' . $month . '%')
                ->where('sm_subject_attendances.academic_id', getAcademicId())
                ->where('sm_subject_attendances.school_id',Auth::user()->school_id)
                ->get();

                if ($attendance) {
                    $attendances[] = $attendance;
                }
            }

        return view('backEnd.studentInformation.student_subject_attendance',compact('attendances','days' , 'year'  , 'month','class_id'  ,'section_id'));
            // $customPaper = array(0, 0, 700.00, 1900.80);
            // $pdf = PDF::loadView(
            //     'backEnd.studentInformation.student_subject_attendance',
            //     [
            //         'attendances' => $attendances,
            //         'days' => $days,
            //         'year' => $year,
            //         'month' => $month,
            //         'class_id' => $class_id,
            //         'section_id' => $section_id
            //     ]
            // )
            // ->setPaper('A4', 'landscape');
            // // ->setPaper($customPaper, 'landscape');
            // return $pdf->stream('student_subject_attendance.pdf');
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}