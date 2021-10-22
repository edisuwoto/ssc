<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmExamType extends Model
{
    protected $fillable=['percentage'];


    public static function examType($assinged_exam_type){
        try {
            return SmExamType::where('id', $assinged_exam_type)->first();
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public function getScheduleSubject()
    {
        return $this->belongsTo(SmExamSchedule::class, 'exam_period_id');
    }

    public function examSetups()
    {
        return $this->hasMany(SmExamSetup::class, 'exam_term_id');
    }
    public function examsSetup()
    {
        return $this->hasMany(SmExamSetup::class, 'exam_term_id');
    }

    public function examTerm()
    {
        return $this->belongsTo(CustomResultSetting::class, 'id','exam_type_id');
    }

    public function examSettings()
    {
        return $this->belongsTo(SmExamSetting::class, 'id','exam_type');
    }
}
