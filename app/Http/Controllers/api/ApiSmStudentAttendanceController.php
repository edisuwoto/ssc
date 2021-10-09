<?php

namespace App\Http\Controllers\api;

use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\SmBaseSetup;
use App\SmSmsGateway;
use App\ApiBaseMethod;
use App\SmAcademicYear;
use App\SmStudentCategory;
use App\SmStudentAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ApiSmStudentAttendanceController extends Controller
{
    public function studentAttendanceCheck(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'date' => "required",
            'class' => "required",
            'section' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
 
        }

        $student_ids = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->select('id')->get();
        $students = SmStudent::with('className','section')->where('class_id', $request->class)->where('section_id', $request->section)->get();
        $studentAttendance=SmStudentAttendance::whereIn('student_id', $student_ids)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->orderby('student_id','ASC')->get();

                $student_attendance=[];
                $no_attendance=[];
                 if(count($studentAttendance)==0){
         
			            foreach($students as $student){

			                $d['id']=$student->id;
			                $d['student_id']=$student->id;
			                $d['student_photo']=$student->student_photo;
			                $d['full_name']=$student->full_name;
			                $d['roll_no']=  $student->roll_no;
			                $d['class_name']=$student->className->class_name;
			                $d['section_name']=  $student->section->section_name;    
			                $d['attendance_type']=null;
			                $d['user_id']=$student->user_id;
			    
			                $no_attendance[]=$d;
			            }
       				 }else{
			        foreach ($studentAttendance as $attendance){

			            $d['id']=$attendance->id;
			            $d['student_id']=$attendance->student_id;
			            $d['student_photo']=$attendance->studentInfo->student_photo;
			            $d['full_name']=$attendance->studentInfo->full_name;
			            $d['roll_no']=  $attendance->studentInfo->roll_no;
			            $d['class_name']=$attendance->studentInfo->className->class_name;
			            $d['section_name']=  $attendance->studentInfo->section->section_name;    
			            $d['attendance_type']=$attendance->attendance_type;
			            $d['user_id']=$attendance->studentInfo->user_id;
			            
			            $student_attendance[]=$d;
			        }
                }
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
               if (count($studentAttendance)>0) {
                    return ApiBaseMethod::sendResponse($student_attendance,null);
                } else {
                    return ApiBaseMethod::sendResponse($no_attendance,'Student attendance not done yet');
                }
         }


                 


        // if (ApiBaseMethod::checkUrl($request->fullUrl())) {
        //     return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        // }
    }


    public function deviceInfo(Request $request){
         $sms = SmSmsGateway::where('gateway_name','Mobile_SMS')->first();
         if($sms){
            $sms->device_info = $request->device_info;
            $result =  $sms->save();
                if($result){
                    return ApiBaseMethod::sendResponse('success', null);
                }
         }
         else{
            return ApiBaseMethod::sendResponse('error', null);
         }
    }

    public function saas_studentAttendanceCheck(Request $request, $school_id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'date' => "required",
            'class' => "required",
            'section' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->select('id')->where('school_id',$school_id)->get();

        if (empty($attendance)) {
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('school_id',$school_id)->first();

                if ($attendance != "") {
                    return ApiBaseMethod::sendError('Student Attendance Already Done.', $validator->errors());
                } else {
                    return ApiBaseMethod::sendResponse(null, 'Student attendance not done yet');
                }
            }
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        }
    }
    public function studentAttendanceStoreFirst(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'date' => "required",
            'class' => "required",
            'section' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->select('id')->get();
        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();
        if (empty($attendance)) {
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();
                if ($attendance != "") {
                    $attendance->delete();
                } else {
                    $attendance = new SmStudentAttendance();
                    $attendance->student_id = $student->id;
                    $attendance->attendance_type = "P";
                    $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                    $attendance->academic_id = SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR();
                    $attendance->save();
                }
            }
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        }
    }
    public function saas_studentAttendanceStoreFirst(Request $request, $school_id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'date' => "required",
            'class' => "required",
            'section' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->select('id')->where('school_id',$school_id)->get();
        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('school_id',$school_id)->first();
        if (empty($attendance)) {
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('school_id',$school_id)->first();
                if ($attendance != "") {
                    $attendance->delete();
                } else {
                    $attendance = new SmStudentAttendance();
                    $attendance->student_id = $student->id;
                    $attendance->attendance_type = "P";
                    $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                    $attendance->academic_id = SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR();
                    $attendance->save();
                }
            }
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        }
    }
    public function studentAttendanceStoreSecond(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => "required",
            'date' => "required",
            'attendance' => "required",
            'class' => "required",
            'section' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->select('id')->get();
        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();
        if (empty($attendance)) {
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();
                if ($attendance != "") {
                    $attendance->delete();
                }

                $attendance = new SmStudentAttendance();
                $attendance->student_id = $student->id;
                $attendance->attendance_type =$request->attendance;
                $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                $attendance->academic_id = SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR();
                $attendance->save();
            }
        }
        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();
        if ($attendance != "") {
            $attendance->delete();
        }
        $attendance = new SmStudentAttendance();
        $attendance->student_id = $request->id;
        $attendance->attendance_type = $request->attendance;
        $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
        $attendance->academic_id = SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR();
        $attendance->save();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        }
    }
    public function saas_studentAttendanceStoreSecond(Request $request, $school_id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => "required",
            'date' => "required",
            'attendance' => "required",
            'class' => "required",
            'section' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->select('id')->where('school_id',$school_id)->get();
        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('school_id',$school_id)->first();
        if (empty($attendance)) {
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('school_id',$school_id)->first();
                if ($attendance != "") {
                    $attendance->delete();
                }

                $attendance = new SmStudentAttendance();
                $attendance->student_id = $student->id;
                $attendance->attendance_type = "P";
                $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                $attendance->school_id = $school_id;
                $attendance->save();
            }
        }
        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('school_id',$school_id)->first();
        if ($attendance != "") {
            $attendance->delete();
        }
        $attendance = new SmStudentAttendance();
        $attendance->student_id = $request->id;
        $attendance->attendance_type = $request->attendance;
        $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
        $attendance->school_id = $school_id;
        $attendance->academic_id = SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR();
        $attendance->save();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        }
    }
    public function student_attendance_index(Request $request)
    {

        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($classes, null);
            }
            return view('backEnd.studentInformation.student_attendance', compact('classes'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function saas_student_attendance_index(Request $request, $school_id)
    {

        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($classes, null);
            }
            return view('backEnd.studentInformation.student_attendance', compact('classes'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function studentSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required',
            'attendance_date' => 'required'
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
            $date = $request->attendance_date;
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            if ($students->isEmpty()) {
                Toastr::error('No Result Found', 'Failed');
                return redirect('student-attendance');
            }

            $already_assigned_students = [];
            $new_students = [];
            $attendance_type = "";
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->attendance_date)))->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->first();

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

            $search_info['class_name'] = $class_info->class_name;
            $search_info['section_name'] = $section_info->section_name;
            $search_info['date'] = $request->attendance_date;


            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['date'] = $date;
                $data['class_id'] = $class_id;
                $data['already_assigned_students'] = $already_assigned_students;
                $data['new_students'] = $new_students;
                $data['attendance_type'] = $attendance_type;
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.studentInformation.student_attendance', compact('classes', 'date', 'class_id', 'date', 'already_assigned_students', 'new_students', 'attendance_type', 'search_info'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function saas_studentSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required',
            'attendance_date' => 'required'
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
            $date = $request->attendance_date;
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            if ($students->isEmpty()) {
                Toastr::error('No Result Found', 'Failed');
                return redirect('student-attendance');
            }

            $already_assigned_students = [];
            $new_students = [];
            $attendance_type = "";
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->attendance_date)))->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->first();

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

            $search_info['class_name'] = $class_info->class_name;
            $search_info['section_name'] = $section_info->section_name;
            $search_info['date'] = $request->attendance_date;


            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['date'] = $date;
                $data['class_id'] = $class_id;
                $data['already_assigned_students'] = $already_assigned_students;
                $data['new_students'] = $new_students;
                $data['attendance_type'] = $attendance_type;
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.studentInformation.student_attendance', compact('classes', 'date', 'class_id', 'date', 'already_assigned_students', 'new_students', 'attendance_type', 'search_info'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function student_search_index(Request $request)
    {

        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($classes, null);
            }
            return view('backEnd.studentInformation.student_attendance', compact('classes'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function saas_student_search_index(Request $request,$school_id)
    {

        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($classes, null);
            }
            return view('backEnd.studentInformation.student_attendance', compact('classes'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    
    public function studentAttendanceStore(Request $request)
    {

        try {
            foreach ($request->id as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->first();

                if ($attendance != "") {
                    $attendance->delete();
                }


                $attendance = new SmStudentAttendance();
                $attendance->student_id = $student;
                if (isset($request->mark_holiday)) {
                    $attendance->attendance_type = "H";
                } else {
                    $attendance->attendance_type = $request->attendance[$student];
                    $attendance->notes = $request->note[$student];
                }
                $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                $attendance->save();
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
            }
            Toastr::success('Operation successful', 'Success');
            return redirect('student-attendance');
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function saas_studentAttendanceStore(Request $request)
    {

        try {
            foreach ($request->id as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->first();

                if ($attendance != "") {
                    $attendance->delete();
                }


                $attendance = new SmStudentAttendance();
                $attendance->student_id = $student;
                if (isset($request->mark_holiday)) {
                    $attendance->attendance_type = "H";
                } else {
                    $attendance->attendance_type = $request->attendance[$student];
                    $attendance->notes = $request->note[$student];
                }
                $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                $attendance->school_id =$request->school_id;
                $attendance->save();
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
            }
            Toastr::success('Operation successful', 'Success');
            return redirect('student-attendance');
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function studentAttendanceReport(Request $request)
    {
        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();
            $types = SmStudentCategory::all();
            $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['types'] = $types->toArray();
                $data['genders'] = $genders->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.studentInformation.student_attendance_report', compact('classes', 'types', 'genders'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function saas_studentAttendanceReport(Request $request,$school_id)
    {
        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();
            $types = SmStudentCategory::where('school_id',$school_id)->get();
            $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['types'] = $types->toArray();
                $data['genders'] = $genders->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.studentInformation.student_attendance_report', compact('classes', 'types', 'genders'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    
    public function studentAttendanceReportSearch(Request $request)
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $year = $request->year;
            $month = $request->month;
            $class_id = $request->class;
            $section_id = $request->section;
            $current_day = date('d');
            $clas = SmClass::findOrFail($request->class);
            $sec = SmSection::findOrFail($request->section);
            $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();
            $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            $attendances = [];
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', 'like', $request->year . '-' . $request->month . '%')->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();
                if (count($attendance) != 0) {
                    $attendances[] = $attendance;
                }
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['attendances'] = $attendances;
                $data['days'] = $days;
                $data['year'] = $year;
                $data['month'] = $month;
                $data['current_day'] = $current_day;
                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                return ApiBaseMethod::sendResponse($data, null);
            }

            return view('backEnd.studentInformation.student_attendance_report', compact('classes', 'attendances', 'days', 'year', 'month', 'current_day', 'class_id', 'section_id', 'clas', 'sec'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function saas_studentAttendanceReportSearch(Request $request, $school_id)
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $year = $request->year;
            $month = $request->month;
            $class_id = $request->class;
            $section_id = $request->section;
            $current_day = date('d');
            $clas = SmClass::where('school_id',$school_id)->findOrFail($request->class);
            $sec = SmSection::where('school_id',$school_id)->findOrFail($request->section);
            $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();
            $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();

            $attendances = [];
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', 'like', $request->year . '-' . $request->month . '%')->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();
                if (count($attendance) != 0) {
                    $attendances[] = $attendance;
                }
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['attendances'] = $attendances;
                $data['days'] = $days;
                $data['year'] = $year;
                $data['month'] = $month;
                $data['current_day'] = $current_day;
                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                return ApiBaseMethod::sendResponse($data, null);
            }

            return view('backEnd.studentInformation.student_attendance_report', compact('classes', 'attendances', 'days', 'year', 'month', 'current_day', 'class_id', 'section_id', 'clas', 'sec'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function studentAttendanceReport_search(Request $request)
    {
        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();
            $types = SmStudentCategory::all();
            $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['types'] = $types->toArray();
                $data['genders'] = $genders->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.studentInformation.student_attendance_report', compact('classes', 'types', 'genders'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
    public function saas_studentAttendanceReport_search(Request $request, $school_id)
    {
        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();
            $types = SmStudentCategory::where('school_id',$school_id)->get();
            $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->where('academic_id', SmAcademicYear::SINGLE_SCHOOL_API_ACADEMIC_YEAR())->where('school_id',$school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['types'] = $types->toArray();
                $data['genders'] = $genders->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.studentInformation.student_attendance_report', compact('classes', 'types', 'genders'));
        } catch (\Exception $e) {
           return ApiBaseMethod::sendError('Error.', $e->getMessage());
        }
    }
}
