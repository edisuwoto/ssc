<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmHomeworkStudent extends Model
{
    protected $table= "sm_homework_students";
    public function studentInfo(){
    	return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }
    public function users(){
    	return $this->belongsTo('App\User', 'created_by', 'id');

    }
    public function homeworkDetail(){
    	return $this->belongsTo('App\SmHomework', 'homework_id', 'id');

    }
}
