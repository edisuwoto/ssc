<?php

namespace Modules\Lesson\Http\Controllers;
use App\SmClass;
use App\SmStaff;
use App\SmSection;
use App\SmSubject;
use App\SmClassSection;
use App\SmAssignSubject;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\Lesson\Entities\SmLesson;
use Modules\Lesson\Entities\SmLessonTopic;
use Illuminate\Contracts\Support\Renderable;
use Modules\Lesson\Entities\SmLessonDetails;
use Modules\Lesson\Entities\SmLessonTopicDetail;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
        public function ajaxSelectLesson(Request $request){
        try {
            $staff_info= SmStaff::where('user_id',Auth::user()->id)->first();
            $lesson_all=SmLesson::where('class_id','=',$request->class)
            ->where('section_id','=',$request->section)
            ->where('subject_id','=',$request->subject)
            ->distinct('lesson_id')
            ->get();

            $lessons=[];
            foreach ($lesson_all as $lesson) {
                $lessons[]=$lesson;
            }
            return response()->json([$lessons]);
        } catch (\Exception $e) {
           Toastr::error('Operation Failed','Failed');
           return redirect()->back(); 
        }
    }
    //get topic from lesson 
    public function ajaxSelectTopic(Request $request){
        try {
            $staff_info= SmStaff::where('user_id',Auth::user()->id)->first();
            $topic_all=SmLessonTopicDetail::where('lesson_id','=',$request->lesson_id)
            ->distinct('topic_id')
            ->get();
            $topics=[];
            foreach ($topic_all as $topic) {
                $topics[]=$topic;
            }
            return response()->json([$topics]);
        } catch (\Exception $e) {
           Toastr::error('Operation Failed','Failed');
           return redirect()->back(); 
        }
    }


    public function getSubject(Request $request){

        // $lessons=SmLesson::statusCheck()->get(); 
        //     if (Auth::user()->role_id==1) {
        //         $classes = SmClass::statusCheck()->get();
        //     } else {
        //         $teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
        //         $classes= SmAssignSubject::where('teacher_id',$teacher_info->id)
        //         ->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
        //         ->where('sm_assign_subjects.academic_id', getAcademicId())
        //         ->where('sm_assign_subjects.active_status', 1)
        //         ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
        //         ->select('sm_classes.id','class_name')
        //         ->get();
        //     }
        //     $sections=SmSection::get();
        $class_id = $request->class;
        $selectedSections = $request->message_to_section;
        // return $selectedSections;
        //   $subjectIds=[];
        $subjectId=SmSubject::query();
        $subjectId=$subjectId->where('class_id', $class_id);
         foreach ($selectedSections as $key => $value) {
            
            $subjectId=$subjectId->where('section_id', $value);
            // echo $value; echo "<br>";
            // $subject="";
            // $subjectIds = SmAssignSubject::where('class_id', $class_id)
            // ->whereIn('section_id', $selectedSections)->where('active_status', 1)->get('subject_id');         
           
           
         }
         return $subjectId->get();
        //   return $subjectIds;
        // $subjects=[];
        // foreach ($subjectIds as $subject) {              
            //  $subjects=SmSubject::whereIn('id',$subjectIds)->get();  

           
        // }
        // return response()->json([$subjects]);
        // return view ('lesson::lesson.create_lesson',compact('subject','classes','lessons','sections'));
      
        

    }
    public function getSubjectLesson(Request $request){
        try {
            $staff_info = SmStaff::where('user_id', Auth::user()->id)->first();
            // return $staff_info;
            if (teacherAccess()) {
                $subject_all = SmAssignSubject::where('class_id', '=', $request->class_id)->groupby('subject_id')->where('teacher_id', $staff_info->id)->distinct('subject_id')->get();

            } else {
                $subject_all = SmAssignSubject::where('class_id', '=', $request->class_id)->groupby('subject_id')->distinct('subject_id')->get();

            }
            $students = [];
            foreach ($subject_all as $allSubject) {
                $students[] = SmSubject::find($allSubject->subject_id);
            }
            return response()->json([$students]);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
        
    }
    public function index()
    {
        return view('lesson::index');
    }


    public function create()
    {
        return view('lesson::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('lesson::show');
    }


    public function edit($id)
    {
        return view('lesson::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}
