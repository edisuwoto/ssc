<?php

namespace Modules\Lesson\Entities;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class SmLesson extends Model
{
    protected $fillable = [];

   
    public function class(){
        return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}
	public function section()
    {
        return $this->belongsTo('App\SmSection', 'section_id', 'id');
	}

	public function subject(){
		return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
	}

	public function scopeStatusCheck($query){
		return $query->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->where('active_status',1);
	}
	public function lessons(){
		return $this->hasMany('Modules\Lesson\Entities\SmLessonDetails', 'lesson_id', 'id');

	}
	public static function lessonName($class,$section,$subject){
		return SmLesson::where('class_id',$class)->where('section_id',$section)
		->where('subject_id',$subject)
		->where('academic_id', getAcademicId())
		->where('school_id', Auth::user()->school_id)
		->get();

	}
}
