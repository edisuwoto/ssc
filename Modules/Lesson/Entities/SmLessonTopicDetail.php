<?php

namespace Modules\Lesson\Entities;

use Illuminate\Database\Eloquent\Model;

class SmLessonTopicDetail extends Model
{
    protected $fillable = [];
    public function lesson_title(){
    	return $this->belongsTo('Modules\Lesson\Entities\SmLesson', 'lesson_id');
    }
}
