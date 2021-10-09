<?php
namespace App;

use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class SmStudentIdCard extends Model
{
    public static function roleName($id){
        $id_card= SmStudentIdCard::find($id);
            $arr=[];
            $names=[];
            $value=json_decode($id_card->role_id,true);
            foreach($value as $values){
                $arr[] = $values;
            }
            $roleNames = Role::whereIn('id',$arr)->get(['id','name']);
        return $roleNames;
    }

    public function scopeStatus($query){
        return $query->where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id);
    }

    public static function studentName($parent_id){
        $studentInfos = SmStudent::where('parent_id',$parent_id)
                    ->where('academic_id', getAcademicId())
                    ->where('school_id', Auth::user()->school_id)
                    ->get(['full_name','student_photo']);
        return $studentInfos;
    }
}
