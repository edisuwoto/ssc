<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmSubjectAttendance extends Model
{
    public function student()
    {
        return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }
}
