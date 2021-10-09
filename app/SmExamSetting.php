<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmExamSetting extends Model
{
    public function examName(){
        return $this->belongsTo('App\SmExamType', 'exam_type', 'id');
    }
}
