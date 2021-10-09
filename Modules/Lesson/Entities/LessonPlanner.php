<?php

namespace Modules\Lesson\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class LessonPlanner extends Model
{
    protected $fillable = [];

    public function class()
    {
        return $this->belongsTo('App\SmClass', 'class_id');
    }

    public function sectionName()
    {
        return $this->belongsTo('App\SmSection', 'section_id');
    }
    public function subject()
    {
        return $this->belongsTo('App\SmSubject', 'subject_id');
    }
    public function lessonName()
    {
        return $this->belongsTo('Modules\Lesson\Entities\SmLesson', 'lesson_detail_id');
    }
    public function topicName()
    {
         return $this->belongsTo('Modules\Lesson\Entities\SmLessonTopicDetail', 'topic_detail_id');
    }
    public function teacherName(){
        return $this->belongsTo('App\SmStaff', 'teacher_id');
    }
     public function scopeLessonPlanner($query,$teacher,$class,$section,$subject){
                           return $query->where('teacher_id',$teacher)
                                        ->where('class_id', $class)
                                        ->where('section_id', $section)                      
                                        ->where('subject_id', $subject)                        
                                        ->where('academic_id', getAcademicId())
                                        ->where('school_id', Auth::user()->school_id)                        
                                        ->where('active_status', 1);
     }

}
