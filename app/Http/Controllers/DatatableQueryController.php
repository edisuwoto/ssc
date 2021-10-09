<?php

namespace App\Http\Controllers;

use DataTables;
use App\SmClass;
use App\SmStaff;
use App\SmSection;
use App\SmStudent;
use App\SmUserLog;
use App\SmAddIncome;
use App\SmEmailSmsLog;
use App\SmLeaveDefine;
use App\SmAcademicYear;
use App\SmNotification;
use App\SmAssignSubject;
use App\SmBankPaymentSlip;
use App\SmStudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\SmTeacherUploadContent;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class DatatableQueryController extends Controller
{
    public function studentDetailsDatatable(Request $request){
        // return $request;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
           
            $request->validate([
                'academic_year' => 'required',
                'class' => 'required',
           ]);

               $students = SmStudent::query();
               $students->where('active_status', 1);
               if ($request->class != "") {
                   $students->where('class_id', $request->class);
               }
               if ($request->section != "") {
                   $students->where('section_id', $request->section);
               }
               if ($request->academic_year != "") {
                   $students->where('academic_id', $request->academic_year);
               }
               if ($request->name != "") {
                   $students->where('full_name', 'like', '%' . $request->name . '%');
               }
               if ($request->roll_no != "") {
                   $students->where('roll_no', 'like', '%' . $request->roll_no . '%');
               }
   
   
               $students = $students->where('school_id', Auth::user()->school_id)
                            ->with(array('className' => function($query) {
                                $query->select('id','class_name');
                            }))
                            ->with(array('section' => function($query) {
                                $query->select('id','section_name');
                            }))
                            ->with(array('parents' => function($query) {
                                $query->select('id','fathers_name');
                            }))
                            ->with(array('gender' => function($query) {
                                $query->select('id','base_setup_name');
                            }))
                            ->with(array('category' => function($query) {
                                $query->select('id','category_name');
                            }))
                            ->take(10)
                            ->get();
   
               $classes = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
   
               $sessions = SmAcademicYear::where('school_id', Auth::user()->school_id)->get();
   
   
               $academic_year = $request->academic_year;
               $class_id = $request->class;
               $name = $request->name;
               $roll_no = $request->roll_no;
               $section = $request->section;

               return view('backEnd.studentInformation.student_details', compact('classes', 'class_id', 'name', 'roll_no', 'sessions','section','academic_year'));
        }

        if ($request->ajax()) {
 
            $students = SmStudent::query();
            $students->where('active_status', 1);
            if ($request->class != "") {
                $students->where('class_id', $request->class);
            }
            if ($request->section != "") {
                $students->where('section_id', $request->section);
            }
            if ($request->academic_year != "") {
                $students->where('academic_id',$request->academic_year);
            }
            if ($request->name != "") {
                $students->where('full_name', 'like', '%' . $request->name . '%');
            }
            if ($request->roll_no != "") {
                $students->where('roll_no', 'like', '%' . $request->roll_no . '%');
            }

// return $request;
            $students = $students->where('school_id', Auth::user()->school_id)
            ->where('academic_id',getAcademicId())
            ->with(array('className' => function($query) {
                $query->select('id','class_name');
            }))
            ->with(array('section' => function($query) {
                $query->select('id','section_name');
            }))
            ->with(array('parents' => function($query) {
                $query->select('id','fathers_name');
            }))
            ->with(array('gender' => function($query) {
                $query->select('id','base_setup_name');
            }))
            ->with(array('category' => function($query) {
                $query->select('id','category_name');
            }))
            ->get();
            
            return Datatables::of($students)
                    ->addIndexColumn()
                    ->addColumn('dob', function($row){
    
                        $dob = dateConvert(@$row->date_of_birth);
    
                        return $dob;
                        })
                    ->rawColumns(['dob'])
                    ->addColumn('action', function($row){
                        $btn = '<div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" target="_blank" href="'.route('student_view', [$row->id]).'">'.app('translator')->get('lang.view').'</a>'.
                                            (userPermission(66) === true ? '<a class="dropdown-item" href="'.route('student_edit', [$row->id]).'">'.app('translator')->get('lang.edit').'</a>' : '').
                                        
                                            (userPermission(67) === true ? (Config::get('app.app_sync') ? '<span  data-toggle="tooltip" title="Disabled For Demo "><a  class="dropdown-item" href="#"  >'.app('translator')->get('lang.disable').'</a></span>' : 
                                            '<a onclick="deleteId('.$row->id.');" class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.disable').'</a>') : '' ).
                                        
                                    '</div>
                                </div>';
    
                            return $btn;
                    })
                    
                    ->rawColumns(['action'])
                    ->make(true);

                }
                return view('backEnd.studentInformation.students');  
 
    }

    public function searchStudentList(Request $request){


        $students = SmStudent::query();
        $students->where('active_status', 1);
        if ($request->class != "") {
            $students->where('class_id', $request->class);
        }
        if ($request->section != "") {
            $students->where('section_id', $request->section);
        }
        if ($request->academic_year != "") {
            $students->where('academic_id', $request->academic_year);
        }
        if ($request->name != "") {
            $students->where('full_name', 'like', '%' . $request->name . '%');
        }
        if ($request->roll_no != "") {
            $students->where('roll_no', 'like', '%' . $request->roll_no . '%');
        }


        $students = $students->where('school_id', Auth::user()->school_id)
                            ->with(array('className' => function($query) {
                                $query->select('id','class_name');
                            }))
                            ->with(array('section' => function($query) {
                                $query->select('id','section_name');
                            }))
                            ->with(array('parents' => function($query) {
                                $query->select('id','fathers_name');
                            }))
                            ->with(array('gender' => function($query) {
                                $query->select('id','base_setup_name');
                            }))
                            ->with(array('category' => function($query) {
                                $query->select('id','category_name');
                            }))
                            ->get();
        
        return Datatables::of($students)
                ->addIndexColumn()
                ->addColumn('dob', function($row){

                    $dob = dateConvert(@$row->date_of_birth);

                    return $dob;
                    })
                ->rawColumns(['dob'])
                ->addColumn('action', function($row){
                    $btn = '<div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" target="_blank" href="'.route('student_view', [$row->id]).'">'.app('translator')->get('lang.view').'</a>'.
                                        (userPermission(66) === true ? '<a class="dropdown-item" href="'.route('student_edit', [$row->id]).'">'.app('translator')->get('lang.edit').'</a>' : '').
                                    
                                        (userPermission(67) === true ? (Config::get('app.app_sync') ? '<span  data-toggle="tooltip" title="Disabled For Demo "><a  class="dropdown-item" href="#"  >'.app('translator')->get('lang.disable').'</a></span>' : 
                                        '<a onclick="deleteId('.$row->id.');" class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.disable').'</a>') : '' ).
                                    
                                '</div>
                            </div>';

                        return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);

            return view('backEnd.studentInformation.students');  
    }

    public function AjaxStudentSearch($class,$section,$date)
    {
        
        try {
            // $date = $request->attendance_date;
            if (getClassActeacherAccesscess()) {
                $classes = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();
            } else {
                $teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
               $classes= SmAssignSubject::where('teacher_id',$teacher_info->id)->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
               ->where('sm_assign_subjects.academic_id', getAcademicId())
               ->where('sm_assign_subjects.active_status', 1)
               ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
               ->select('sm_classes.id','class_name')
                ->groupBy('sm_classes.id')
               ->get();
            }
            $students = SmStudent::where('class_id', $class)->where('section_id', $section)->where('active_status', 1)->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)->get();

            if ($students->isEmpty()) {
                Toastr::error('No Result Found', 'Failed');
                return redirect('student-attendance');
            }

            $already_assigned_students = [];
            $new_students = [];
            $attendance_type = "";
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)
                    ->where('attendance_date', date('Y-m-d', $date))
                    ->where('academic_id', getAcademicId())
                    ->where('school_id', Auth::user()->school_id)
                    ->first();
                if ($attendance != "") {
                    $already_assigned_students[] = $attendance;
                    $attendance_type = $attendance->attendance_type;
                } else {
                    $new_students[] = $student;
                }
            }
            $class_id = $class;
            $section_id = $section;
            $class_info = SmClass::find($class);
            $section_info = SmSection::find($section);

            $search_info['class_name'] = $class_info->class_name;
            $search_info['section_name'] = $section_info->section_name;
            $search_info['date'] = $date;

            $all_students=[];
            foreach ($already_assigned_students as $key => $value) {
                $all_students[$value->student_id]['std_id']=$value->student_id;
                $all_students[$value->student_id]['admission_no']=$value->studentInfo->admission_no;
                $all_students[$value->student_id]['roll_no']=$value->studentInfo->roll_no;
                $all_students[$value->student_id]['full_name']=$value->studentInfo->full_name;
                $all_students[$value->student_id]['attendance_type']=$value->attendance_type;
                $all_students[$value->student_id]['notes']=$value->notes;
                $all_students[$value->student_id]['attendance_date']=$value->attendance_date;
            }
            foreach ($new_students as $key => $value) {
                $all_students[$value->id]['std_id']=$value->id;
                $all_students[$value->id]['admission_no']=$value->admission_no;
                $all_students[$value->id]['roll_no']=$value->roll_no;
                $all_students[$value->id]['full_name']=$value->full_name;
                $all_students[$value->id]['attendance_type']='';
                $all_students[$value->id]['notes']='';
                $all_students[$value->id]['attendance_date']='';
            }
            // return $all_students;

            // if ($request->ajax()) {
 
              
                return Datatables::of($all_students)
                        ->addIndexColumn()
                        ->addColumn('teacher_note', function($row){
                            $note_input = '<input type="text" name="note>';
        
                                return $note_input;
                        })
                        // ->rawColumns(['teacher_note'])

                        ->addColumn('action', function($row){
                            
                            $btn = '<div class="d-flex radio-btn-flex">
                                    <div class="mr-20">
                                        <input type="radio" data-id="'.$row['std_id'].'" name="attendance['.$row['std_id'].']" id="attendanceP'.$row['std_id'].'"'.($row['attendance_type']=='P' ? 'checked':'').' value="P" class="common-radio attendanceP attendance_type">
                                        <label for="attendanceP'.$row['std_id'].'">'.app('translator')->get('lang.present').'</label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" data-id="'.$row['std_id'].'" name="attendance['.$row['std_id'].']" id="attendanceL'.$row['std_id'].'"'.($row['attendance_type']=='L' ? 'checked':'').' value="L" class="common-radio attendanceL attendance_type">
                                        <label for="attendanceL'.$row['std_id'].'">'.app('translator')->get('lang.late').'</label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" data-id="'.$row['std_id'].'" name="attendance['.$row['std_id'].']" id="attendanceA'.$row['std_id'].'"'.($row['attendance_type']=='A' ? 'checked':'').' value="A" class="common-radio attendanceA attendance_type">
                                        <label for="attendanceA'.$row['std_id'].'">'.app('translator')->get('lang.absent').'</label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" data-id="'.$row['std_id'].'" name="attendance['.$row['std_id'].']" id="attendanceF'.$row['std_id'].'"'.($row['attendance_type']=='F' ? 'checked':'').' value="F" class="common-radio attendanceF attendance_type">
                                        <label for="attendanceF'.$row['std_id'].'">'.app('translator')->get('lang.half_day').'</label>
                                    </div>
                                       
    
                                    </div>';
        
                                return $btn;
                        })
                        ->rawColumns(['action','teacher_note'])

                        ->make(true);
    
                    // }


       
            return view('backEnd.studentInformation.student_attendance', compact('classes', 'date', 'class_id','section_id', 'date', 'already_assigned_students', 'new_students', 'attendance_type', 'search_info'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function getStaffList(){
        try {
            if (Auth::user()->role_id == 1) {
                $staffs = SmStaff::where('school_id', Auth::user()->school_id)
                                    ->where('is_saas',0)
                                    ->with(array('roles' => function($query) {
                                        $query->select('id','name');
                                    }))
                                    ->with(array('departments' => function($query) {
                                        $query->select('id','name');
                                    }))
                                    ->with(array('designations' => function($query) {
                                        $query->select('id','title');
                                    }))
                                    ->get();
            } else {
                $staffs = SmStaff::where('is_saas',0)->where('school_id', Auth::user()->school_id)
                                    ->where('role_id', '!=', 1)
                                    ->where('role_id', '!=', 5)
                                    ->with(array('roles' => function($query) {
                                        $query->select('id','name');
                                    }))
                                    ->with(array('departments' => function($query) {
                                        $query->select('id','name');
                                    }))
                                    ->with(array('designations' => function($query) {
                                        $query->select('id','title');
                                    }))
                                    ->get();
            }

            return Datatables::of($staffs)
                    ->addIndexColumn()
                    ->addColumn('switch', function($row){
                        if (Auth::user()->id!=$row->user_id || Auth::user()->role_id !=1) {
                            $btn = '<label class="switch">
                            <input type="checkbox" id="'.$row->id.'" class="switch-input-staff" '.($row->active_status == 0? '':'checked').'>
                            <span class="slider round"></span>
                          </label>';
                        } else {
                            $btn = '';
                        }
                        
                        
    
                            return $btn;
                    })
                    
                    ->addColumn('action', function($row){
                        $btn = '<div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" target="_blank" href="'.route('viewStaff', [$row->id]).'">'.app('translator')->get('lang.view').'</a>'.
                                            (userPermission(163) === true ? '<a class="dropdown-item" href="'.route('editStaff', [$row->id]).'">'.app('translator')->get('lang.edit').'</a>' : '').
                                        
                                            (userPermission(164) === true ? ($row->role_id != Auth::user()->role_id ? '' : 
                                            '<a onclick="deleteId('.$row->id.');" class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.disable').'</a>') : '' ).
                                        
                                    '</div>
                                </div>';
    
                            return $btn;
                    })
                    
                    ->rawColumns(['action','switch'])
                    ->make(true);

                return view('backEnd.studentInformation.students');  
        } catch (\Throwable $th) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }






    public function incomeList(Request $request){

        $add_incomes = SmAddIncome::with('incomeHeads','paymentMethod')->where('active_status', '=', 1)->where('school_id', Auth::user()->school_id)->get();
            
            return Datatables::of($add_incomes)
                    ->addIndexColumn()
                    ->addColumn('date', function($row){
    
                        $date = dateConvert(@$row->created_at);
    
                        return $date;
                        })
                    ->rawColumns(['date'])
                    ->addColumn('action', function($row){
                        $btn = '<div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" target="_blank" href="'.route('student_view', [$row->id]).'">'.app('translator')->get('lang.view').'</a>'.
                                            (userPermission(66) === true ? '<a class="dropdown-item" href="'.route('student_edit', [$row->id]).'">'.app('translator')->get('lang.edit').'</a>' : '').
                                        
                                            (userPermission(67) === true ? (Config::get('app.app_sync') ? '<span  data-toggle="tooltip" title="Disabled For Demo "><a  class="dropdown-item" href="#"  >'.app('translator')->get('lang.disable').'</a></span>' : 
                                            '<a onclick="deleteId('.$row->id.');" class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteStudentModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.disable').'</a>') : '' ).
                                        
                                    '</div>
                                </div>';
    
                            return $btn;
                    })
                    
                    ->rawColumns(['action'])
                    ->make(true);

                }


                public function emailSmsLogAjax()
                {
                    $emailSmsLogs = SmEmailSmsLog::where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->latest()->get();
                    return Datatables::of($emailSmsLogs)
                    ->addIndexColumn()
                    ->addColumn('date', function($row){
                        $date = dateConvert(@$row->created_at);
                        return $date;
                        })
                        ->addColumn('send_via', function($row){
                           if($row->send_through == "E"){
                            $type = "Email";
                           }else{
                            $type = "Sms";
                           }
                            return $type;
                            })
                    ->rawColumns(['date'])
                   
                    ->make(true);
                }

                public function userLogAjax(Request $request){
                    
                    $user_logs = SmUserLog::where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->orderBy('id', 'desc')
                        ->with(array('role' => function($query) {
                            $query->select('id','name');
                        })) 
                        ->with(array('user' => function($query) {
                            $query->select('id','full_name');
                        })) 
                        ->get();

                        return Datatables::of($user_logs)
                    ->addIndexColumn()
                    ->addColumn('date', function($row){
                        $date = dateConvert(@$row->created_at);
                        return $date;
                        })
                        
                        ->rawColumns(['date'])

                        ->addColumn('login_time', function($row){
                            $login_time = $row->created_at->toDayDateTimeString();
                            return $login_time;
                            })
                            ->rawColumns(['login_time'])
                   
                    ->make(true);
                }
                
                public function bankPaymentSlipAjax()
                {
                    $bank_slips = SmBankPaymentSlip::with('studentInfo','feesType')->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->orderBy('approve_status','asc')->latest()->get();

                    return Datatables::of($bank_slips)
                    ->addIndexColumn()
                    ->addColumn('date', function($row){
                        $date = dateConvert(@$row->created_at);
                        return $date;
                        })
                        ->rawColumns(['date'])
                        ->addColumn('status', function($row){
                            if($row->approve_status == 0){
                                $btn = '<button class="primary-btn small bg-warning text-white border-0">'.app('translator')->get('lang.pending').'</button>';
                            }
                            elseif($row->approve_status == 1){
                                    $btn = '<button class="primary-btn small bg-success text-white border-0  tr-bg">'.app('translator')->get('lang.approved').'</button>';
                                }
                                elseif($row->approve_status == 2){
                                    $btn = '<button class="primary-btn small bg-danger text-white border-0  tr-bg">'.app('translator')->get('lang.rejected').'</button>';
                                }
                                return $btn;
                        })
                        ->addColumn('slip', function($row){
                            if( (!empty($row->slip) )){
                                $btn = '<a class="text-color" data-toggle="modal" data-target="#showCertificateModal('.$row->id.');" href="#">'.app('translator')->get('lang.approve').'</a>';
                            }
                            else{
                                    $btn = "";
                                }
                                return $btn;
                        })

                        ->addColumn('action', function($row){
                            if($row->approve_status == 0) {
                                $btn = '<div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                <div class="dropdown-menu dropdown-menu-right">
                                        <a onclick="enableId('.$row->id.');" class="dropdown-item" href="#" data-toggle="modal" data-target="#enableStudentModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.approve').'</a>'.
                                        '<a onclick="rejectPayment('.$row->id.');" class="dropdown-item" href="#" data-toggle="modal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.reject').'</a>'.
                                '</div>
                                </div>';
                            } 
                            elseif($row->approve_status == 1){
                                $btn = '<div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">'.app('translator')->get('lang.approved').'</a>'.
                                '</div>
                                </div>';
                            }
                            elseif($row->approve_status == 2){
                                $btn = '<div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                <div class="dropdown-menu dropdown-menu-right">
                                        <a onclick="viewReason('.$row->id.');" class="dropdown-item '."reason".$row->id.'" href="#" data-reason="'.$row->reason.'"  >'.app('translator')->get('lang.view').'</a>'.
                                '</div>
                                </div>';
                            }
        
                                return $btn;
                        })

                        ->rawColumns(['status','action','slip'])
                        ->make(true);
                    
                }



        public function assignmentList(){

            $user = Auth()->user();

            if (teacherAccess()) {
                SmNotification::where('user_id', $user->id)->where('role_id', 1)->update(['is_read' => 1]);
            }

            if (!teacherAccess()) {

                $uploadContents = SmTeacherUploadContent::where('content_type', 'as')->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();

            } else {

                $uploadContents = SmTeacherUploadContent::where(function ($q) {
                    $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
                })->where('content_type', 'as')->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();
            }
            return Datatables::of($uploadContents)
                    ->addIndexColumn()
                    ->addColumn('date', function($row){
    
                        $date = dateConvert(@$row->created_at);
    
                        return $date;
                        })
                        ->addColumn('type', function($row){
                            if($row->content_type == 'as'){
                             $type = "Assignment";
                            }elseif($row->content_type == 'st'){
                             $type = "Study Material";
                            }
                            elseif($row->content_type == 'sy'){
                                $type = "Syllabus";
                            }
                            else{
                                $type = "Others";
                            }
                            return $type;
                           
                             })

                             ->addColumn('avaiable', function($row){
                                if($row->available_for_admin == 1){
                                 $avaiable = app('translator')->get('lang.all_admins');
                                }elseif($row->available_for_all_classes == 1){
                                 $avaiable = app('translator')->get('lang.all_classes_student');
                                }
                                elseif($row->classes != "" && $row->sections != ""){
                                    $avaiable = app('translator')->get('lang.all_students_of'). " ". $row->classes->class_name.'->'.@$row->sections->section_name;
                                }elseif($row->classes != "" && $row->section ==null){
                                    $avaiable = app('translator')->get('lang.all_students_of'). " ". $row->classes->class_name.'->'.app('translator')->get('lang.all_sections');

                                }
                                
                                return $avaiable;
                               
                                 })

                                ->addColumn('class_sections', function($row){
                                if( ($row->class != "" ) && ($row->section != "")){
                                    $classes = $row->classes->class_name;
                                    $sections = $row->sections->section_name;
                                    return $classes.'('. $sections .')' ;
                                }elseif(($row->class != "" ) && ($row->section ==null)){
                                    $classes = $row->classes->class_name;
                                    $nullsections = app('translator')->get('lang.all_sections');
                                    return $classes .'('. $nullsections .')' ;
                                }
                                elseif($row->section != ""){
                                   return $sections = $row->sections->section_name;
                                }
                                elseif($row->class != ""){
                                    return $classes = $row->classes->class_name;
                                 }
                                                        
                                })


                    ->rawColumns(['date'])
                    ->addColumn('action', function($row){
                        $btn = '<div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                            <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="'.route('upload-content-view', [$row->id]).'">'.app('translator')->get('lang.view').'</a>'.
                                            (userPermission(587) === true ? '<a class="dropdown-item" href="'.route('upload-content-edit', [$row->id]).'">'.app('translator')->get('lang.edit').'</a>' : '').
                                        
                                            (userPermission(95) === true ? (Config::get('app.app_sync') ? '<span  data-toggle="tooltip" title="Disabled For Demo "><a  class="dropdown-item" href="#"  >'.app('translator')->get('lang.disable').'</a></span>' : 
                                            '<a onclick="deleteAssignMent('.$row->id.');"  class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteApplyLeaveModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.delete').'</a>') : '' ).
                                           
                                        
                                    '</div>
                                </div>';
    
                            return $btn;
                    })
                    
                    ->rawColumns(['action','date'])
                    ->make(true);
        }  
        
        
        public function leaveDefineList(){
            $leave_defines = SmLeaveDefine::where('active_status', 1)
            ->where('school_id',Auth::user()->school_id)
            ->where('academic_id', getAcademicId())
            ->with(array('role' => function($query) {
                $query->select('id','name');
            }))
            ->with(array('user' => function($query) {
                $query->select('id','full_name');
            }))
            ->with(array('leaveType' => function($query) {
                $query->select('id','type');
            }))
            ->get();

            return Datatables::of($leave_defines)
                        ->addColumn('action', function($row){
                            $btn = '<div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                        <div class="dropdown-menu dropdown-menu-right">'
                                                .(userPermission(201) === true ? '<a class="dropdown-item" href="'.route('leave-define-edit', [$row->id]).'">'.app('translator')->get('lang.edit').'</a>' : '').

                                                (userPermission(201) === true ? (Config::get('app.app_sync') ? '<span  data-toggle="tooltip" title="Disabled For Demo "><a  class="dropdown-item" href="#"  >'.app('translator')->get('lang.disable').'</a></span>' : 
                                                '<a onclick="addLeaveDay('.$row->id.');"  class="dropdown-item '."reason".$row->id.'" href="#" data-toggle="modal" data-target="#addLeaveDayModal" data-total_days="'.$row->days.'"  >'.app('translator')->get('lang.add_days').'</a>') : '' ).

                                                (userPermission(202) === true ? (Config::get('app.app_sync') ? '<span  data-toggle="tooltip" title="Disabled For Demo "><a  class="dropdown-item" href="#"  >'.app('translator')->get('lang.disable').'</a></span>' : 
                                                '<a onclick="deleteLeaveDefine('.$row->id.');"  class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteLeaveDefineModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.delete').'</a>') : '' ).
                                            
                                            
                                        '</div>
                                    </div>';

                                return $btn;
                        })
                        
                        ->rawColumns(['action','date'])
                        ->make(true);
                        
        }
        
        
        public function syllabusList(){
            try{
            if (!teacherAccess() ) {
                $uploadContents = SmTeacherUploadContent::where('content_type', 'sy')
                                                        ->where('academic_id', getAcademicId())
                                                        ->where('school_id',Auth::user()
                                                        ->school_id)->get();
            } else {
                $uploadContents = SmTeacherUploadContent::where(function ($q) {
                    $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
                })->where('content_type', 'sy')->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();
            }
            // return  $uploadContents;
            return Datatables::of($uploadContents)
                    ->addIndexColumn()
                    ->addColumn('date', function($row){
    
                        $date = dateConvert(@$row->created_at);
    
                        return $date;
                        })
                        ->addColumn('type', function($row){
                            if($row->content_type == 'as'){
                             $type = "Assignment";
                            }elseif($row->content_type == 'st'){
                             $type = "Study Material";
                            }
                            elseif($row->content_type == 'sy'){
                                $type = "Syllabus";
                            }
                            else{
                                $type = "Others";
                            }
                            return $type;
                           
                             })

                             ->addColumn('avaiable', function($row){
                                if($row->available_for_admin == 1){
                                 $avaiable = app('translator')->get('lang.all_admins');
                                }elseif($row->available_for_all_classes == 1){
                                 $avaiable = app('translator')->get('lang.all_classes_student');
                                }
                                elseif($row->classes != "" && $row->sections != ""){
                                    $avaiable = app('translator')->get('lang.all_students_of'). " ". $row->classes->class_name.'->'.@$row->sections->section_name;
                                }elseif($row->classes != "" && $row->section ==null){
                                    $avaiable = app('translator')->get('lang.all_students_of'). " ". $row->classes->class_name.'->'.app('translator')->get('lang.all_sections');

                                }
                                
                                return $avaiable;
                               
                                 })

                                ->addColumn('class_sections', function($row){
                                if( ($row->class != "" ) && ($row->section != "")){
                                    $classes = $row->classes->class_name;
                                    $sections = $row->sections->section_name;
                                    return $classes.'('. $sections .')' ;
                                }elseif(($row->class != "" ) && ($row->section ==null)){
                                    $classes = $row->classes->class_name;
                                    $nullsections = app('translator')->get('lang.all_sections');
                                    return $classes .'('. $nullsections .')' ;
                                }
                                elseif($row->section != ""){
                                   return $sections = $row->sections->section_name;
                                }
                                elseif($row->class != ""){
                                    return $classes = $row->classes->class_name;;
                                 }                       
                                })


                    ->rawColumns(['date'])
                    ->addColumn('action', function($row){
                        $btn = '<div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">'.app('translator')->get('lang.select').'</button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                            <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="'.route('upload-content-view', [$row->id]).'">'.app('translator')->get('lang.view').'</a>'.
                                            (userPermission(587) === true ? '<a class="dropdown-item" href="'.route('upload-content-edit', [$row->id]).'">'.app('translator')->get('lang.edit').'</a>' : '').
                                        
                                            (userPermission(95) === true ? (Config::get('app.app_sync') ? '<span  data-toggle="tooltip" title="Disabled For Demo "><a  class="dropdown-item" href="#"  >'.app('translator')->get('lang.disable').'</a></span>' : 
                                            '<a onclick="deleteAssignMent('.$row->id.');"  class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteApplyLeaveModal" data-id="'.$row->id.'"  >'.app('translator')->get('lang.delete').'</a>') : '' ).
                                           
                                        
                                    '</div>
                                </div>';
    
                            return $btn;
                    })
                    
                    ->rawColumns(['action','date'])
                    ->make(true);

                }catch (\Exception $e) {
                    return redirect()->back();
                 }
        } 

    }

