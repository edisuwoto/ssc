<?php

namespace App\Exports;

use App\SmStudent;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class AllStudentExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'Admission Number',
            'Roll Number',
            'Full Name',
            'Class Name',
            'Section Name',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $all_student_data = [];
        $student_infos = SmStudent::where('school_id',Auth::user()->school_id)
                    ->where('academic_id',getAcademicId())
                    ->select('admission_no', 'roll_no', 'full_name', 'class_id', 'section_id')
                    ->orderBy('class_id','asc')
                    ->get();
        foreach($student_infos as $student_info){
            $all_student_data[] = [
                $student_info->admission_no,
                $student_info->roll_no,
                $student_info->full_name,
                $student_info->class->class_name,
                $student_info->section->section_name,
            ];
        }
        return collect($all_student_data);
    }
}
