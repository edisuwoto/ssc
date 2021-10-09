<?php


namespace Modules\Lesson\Http\Controllers;
use App\SmExam;
use App\SmClass;
use App\SmStaff;
use App\SmSection;
use App\SmSubject;
use App\tableList;
use App\YearCheck;
use App\SmExamType;
use App\SmExamSetup;
use App\SmMarkStore;
use App\ApiBaseMethod;
use App\SmResultStore;
use App\SmClassSection;
use App\SmAssignSubject;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\Lesson\Entities\SmLesson;
use Modules\Lesson\Entities\LessonPlanner;
use Modules\Lesson\Entities\SmLessonTopic;
use Illuminate\Contracts\Support\Renderable;
use Modules\Lesson\Entities\SmLessonDetails;
use Modules\Lesson\Entities\SmLessonTopicDetail;

class SmLessonController extends Controller
{
 public function __construct(){
 	$this->middleware('PM');
 }
 public function index(){
	try {
		$data=$this->loadLesson();	
		return view('lesson::lesson.add_new_lesson', $data);
	} catch (\Exception $e) {   		   
		Toastr::error('Operation Failed', 'Failed');
		return redirect()->back();
	}
 }

 public  function storeLesson(Request $request){
 		  $request->validate(
            [
                'class' => 'required',
                'subject' => 'required',
               
	         ],
	        );
 
 			 DB::beginTransaction();

        			try {
							$sections=SmAssignSubject::where('class_id',$request->class)
													->where('subject_id',$request->subject)
													->get();

        					foreach($sections as $section){
									foreach($request->lesson as $lesson){
										if($lesson !=''){
										$smLesson=new SmLesson;
										$smLesson->lesson_title=$lesson;
										$smLesson->class_id=$request->class;	
										$smLesson->subject_id=$request->subject;
										$smLesson->section_id=$section->section_id;
										$smLesson->school_id = Auth::user()->school_id;
										$smLesson->academic_id = getAcademicId();
										$smLesson->user_id=Auth::user()->id;
										$smLesson->save();
										}
									
									}
								}
					  DB::commit();
					  Toastr::success('Operation successful', 'Success');
					  return redirect()->back();
			        } catch (\Exception $e) {						
			            Toastr::error('Operation Failed', 'Failed');
			            return redirect()->back();
			        }
	 			}
	 		

	public function editLesson($class_id,$section_id,$subject_id){
		 try {
			
			$data=$this->loadLesson();	
			$data['lesson']=SmLesson::where([['class_id',$class_id],['section_id',$section_id],['subject_id',$subject_id]])->first();
			$data['lesson_detail']=SmLesson::where([['class_id',$class_id],['section_id',$section_id],['subject_id',$subject_id]])->get();
            return view('lesson::lesson.edit_lesson',$data);
        } catch (\Exception $e) {		
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

	}
	public function updateLesson(Request $request){
		try {
			$length=count($request->lesson);
			for($i=0;$i<$length;$i++){
				$lesson_title=$request->lesson[$i];
				$check=SmLesson::where('lesson_title',$lesson_title)->first();
				$lessonDetail=new SmLesson();	
				$lessonDetail->lesson_title=$lesson_title;
				$lessonDetail->class_id=$request->class;	
				$lessonDetail->subject_id=$request->subject;
				$lessonDetail->section_id=$request->section;
				$lessonDetail->school_id=Auth::user()->school_id;
				$lessonDetail->academic_id=getAcademicId();
				$lessonDetail->user_id=Auth::user()->id;
				if($check){
					continue;
				}
				$lessonDetail->save();
			}
			Toastr::success('Operation successful', 'Success');
			return redirect()->route('lesson');
		} catch (\Exception $e) {
			Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
		}
						
	}
	public function deleteLesson($id){

		$lesson=SmLesson::find($id);
		$lesson_detail=SmLesson::where([['class_id',$lesson->class_id],['section_id',$lesson->section_id],['subject_id',$lesson->subject_id]])->get();
		foreach($lesson_detail as $lesson_data){
			SmLesson::destroy($lesson_data->id);
		}
		
		$SmLessonTopic=SmLessonTopic::where('lesson_id',$id)->get();
		if($SmLessonTopic){
		foreach ($SmLessonTopic as $t_data) {
			SmLessonTopic::destroy($t_data->id);	
			}
		}

		$SmLessonTopicDetail=SmLessonTopicDetail::where('lesson_id',$id)->get();
		if($SmLessonTopicDetail){
		foreach ($SmLessonTopicDetail as $td_data) {
			SmLessonTopicDetail::destroy($td_data->id);	
			}
		}

		$LessonPlanner=LessonPlanner::where('lesson_id',$id)->get();
		if($LessonPlanner){
		foreach ($LessonPlanner as $lp_data) {
			LessonPlanner::destroy($lp_data->id);		
			}
		}

		Toastr::success('Operation successful', 'Success');
		return redirect()->route('lesson');
	}	
	public function deleteLessonItem($id){
		try {
			
				$lesson=SmLesson::find($id);
				$lesson->delete();
		
		
				$SmLessonTopic=SmLessonTopic::where('lesson_id',$id)->get();
				if($SmLessonTopic){
				foreach ($SmLessonTopic as $t_data) {
					SmLessonTopic::destroy($t_data->id);	
					}
				}
		
				$SmLessonTopicDetail=SmLessonTopicDetail::where('lesson_id',$id)->get();
				if($SmLessonTopicDetail){
				foreach ($SmLessonTopicDetail as $td_data) {
					SmLessonTopicDetail::destroy($td_data->id);	
					}
				}
		
				$LessonPlanner=LessonPlanner::where('lesson_id',$id)->get();
				if($LessonPlanner){
				foreach ($LessonPlanner as $lp_data) {
					LessonPlanner::destroy($lp_data->id);		
					}
				}

				Toastr::success('Operation successful', 'Success');
				return redirect()->route('lesson');
		} catch (\Exception $e) {
			Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
			
		}
	}
	public function lessonPlanner(){
		return view('lesson::lesson.lesson_planner');
	}	
	public function loadLesson(){
			$teacher_info=SmStaff::where('user_id',Auth::user()->id)->first();
			$subjects= SmAssignSubject::select('subject_id')->where('teacher_id',$teacher_info->id)->get();

			$data['subjects']= SmSubject::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            $data['sections'] = SmSection::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();	 
		 
		 	if(Auth::user()->role_id==4){
		 		$data['lessons']=SmLesson::with('lessons','class','section','subject')->whereIn('subject_id',$subjects)->statusCheck()->groupby(['class_id','section_id','subject_id'])->get();
		 	}else{
		 	  $data['lessons']=SmLesson::with('lessons','class','section','subject')
								->statusCheck()
								->groupby(['class_id','section_id','subject_id'])->get(); 
		 	}

         
            if (teacherAccess()) {
				$data['classes']= SmAssignSubject::where('teacher_id',$teacher_info->id)
                ->join('sm_classes','sm_classes.id','sm_assign_subjects.class_id')
                ->where('sm_assign_subjects.academic_id', getAcademicId())
                ->where('sm_assign_subjects.active_status', 1)
                ->where('sm_assign_subjects.school_id',Auth::user()->school_id)
				->groupby('sm_assign_subjects.class_id')
                ->select('sm_classes.id','class_name')
                ->get();
            } else {
            
				$data['classes'] = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();
            }
			return $data;

	}
	
	
}
