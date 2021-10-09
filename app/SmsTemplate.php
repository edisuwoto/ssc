<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\ParentRegistration\Entities\SmStudentRegistration;

class SmsTemplate extends Model
{
    protected $table = "sms_templates";

    public static function getValueByStringTest($data, $str)
    {
        if ($str == 'password') {
            return '123456';
        } elseif ($str == 'school_name') {

            if (moduleStatusCheck('Saas') == TRUE) {

                $student_info = SmStudentRegistration::find(@$data['id']);

                return @$student_info->school->school_name;
            } else {
                $general_setting = SmGeneralSettings::find(1);
                return @$general_setting->school_name;
            }
        }


        if ($data['slug'] == 'student') {

            $student_info = SmStudent::find(@$data['id']);

            if ($str == 'student_name') {
                return @$student_info->full_name;
            } elseif ($str == 'father_name') {
                $parent_info = SmParent::find(@$student_info->parent_id);
                return @$parent_info->fathers_name;
            } elseif ($str == 'username') {
                $user_info = User::find(@$student_info->user_id);
                return @$user_info->username . '/' . @$user_info->email;
            }elseif ($str == 'admission_number') {
               
                return @$student_info->admission_no ;
            }
        } elseif ($data['slug'] == 'parent') {
            $parent_info = SmParent::find(@$data['id']);

            if ($str == 'name') {
                return @$parent_info->guardians_name;
            } elseif ($str == 'student_name') {
                $student_info = SmStudent::where('parent_id', $parent_info->id)->first();
                return @$student_info->full_name;
            } elseif ($str == 'username') {
                $user_info = User::find(@$parent_info->user_id);
                return @$user_info->username;
            }elseif ($str == 'email') {
                $user_info = User::find(@$parent_info->user_id);
                return @$user_info->email;
            }elseif ($str == 'father_name') {
                $student_info = SmStudent::where('parent_id', $parent_info->id)->first();
                return @$student_info->father_name;
            }elseif ($str == 'admission_number') {
                $student_info = SmStudent::where('parent_id', $parent_info->id)->first();
                return @$student_info->admission_no;
            }
        } else {

            $staff_info = SmStaff::find(@$data['id']);

            $user_info = User::find(@$staff_info->user_id);

            if ($str == 'name') {

                return @$user_info->full_name;

            } elseif ($str == 'username') {
                 
                return @$user_info->username;
            }
        }
    }

    public static function getValueByStringTestReset($data, $str)
    {
        if ($str == 'school_name') {
            $general_setting = SmGeneralSettings::find(1);
            return @$general_setting->school_name;
        } 
        if ($str == 'name') {
            $user = User::where('email', $data['email'])->first();
            return @$user->full_name;
        }elseif($str == 'email'){
            $user = User::where('email', $data['email'])->first();
            return @$user->email;
        }elseif($str == 'admission_number'){
            $student = SmStudent::find(@$data['id']);
            if($student){
                $user = User::find(@$student->user_id);
                if($user->role_id==2){
                    return $student->admission_number;
                }
            }

        }
        if($str == 'email'){
            $user = User::where('email', $data['email'])->first();
            return @$user->email;
        }
        if($str == 'admission_number'){
             $user = User::find(@$data['id']);
             if($user->role_id==2){
                $student = SmStudent::where('user_id',$user->id)->first();
                return $student->admission_no;
             }
            
        }
    }


    public static function getValueByStringBankPayment($data, $str)
    {
        if ($str == 'student_name') {
            return $data['student_name'] ;
        }
         elseif ($str == 'parent_name') {
            return $data['parent_name'] ;
        }
        elseif ($str == 'note') {
            return $data['note'] ;
        }
        elseif ($str == 'date') {
            return $data['date'] ;
        }
    }

    // get Value By String Test Registration
    public static function getValueByStringTestRegistration($data, $str)
    {
        if ($str == 'password') {
            return '123456';
        } elseif ($str == 'school_name') {
            if (moduleStatusCheck('Saas') == TRUE) {
                $student_info = SmStudentRegistration::find(@$data['id']);
                return @$student_info->school->school_name;
            } else {
                $general_setting = SmGeneralSettings::find(1);
                return @$general_setting->school_name;
            }
        }

        if ($data['slug'] == 'student') {
            $student_info = SmStudentRegistration::find(@$data['id']);
            if ($str == 'name') {
                return @$student_info->first_name . ' ' . @$student_info->last_name;
            } elseif ($str == 'guardian_name') {
                return @$student_info->guardian_name;
            } elseif ($str == 'class') {
                return @$student_info->class->class_name;
            } elseif ($str == 'section') {
                return @$student_info->section->section_name;
            }
        } elseif ($data['slug'] == 'parent') {
            $parent_info = SmStudentRegistration::find(@$data['id']);
            if ($str == 'name') {
                return @$parent_info->guardian_name;
            } elseif ($str == 'student_name') {
                return @$parent_info->first_name . ' ' . @$parent_info->last_name;
            }
        }
    }



    public static function getValueByStringTestApprove($data, $str)
    {

        if ($str == 'password') {

            return '123456';
        } elseif ($str == 'school_name') {

            if (moduleStatusCheck('Saas') == TRUE) {

                if ($data['slug'] == 'student') {
                    $student_info = SmStudent::find(@$data['id']);

                    return @$student_info->school->school_name;
                } else {
                    $student_info = SmParent::find(@$data['id']);

                    return @$student_info->school->school_name;
                }
            } else {

                $general_setting = SmGeneralSettings::find(1);
                return @$general_setting->school_name;
            }
        }


        if ($data['slug'] == 'student') {

            $student_info = SmStudent::find(@$data['id']);

            if ($str == 'student_name') {

                return @$student_info->full_name;
            } elseif ($str == 'father_name') {
                $parent_info = SmParent::find(@$student_info->parent_id);

                return @$parent_info->guardians_name;
            } elseif ($str == 'username') {

                $user_info = User::find(@$student_info->user_id);

                return @$user_info->username . '/' . @$user_info->email;
            }
        } elseif ($data['slug'] == 'parent') {
            $parent_info = SmParent::find(@$data['id']);

            if ($str == 'name') {
                return @$parent_info->guardians_name;
            } elseif ($str == 'student_name') {
                $student_info = SmStudent::where('parent_id', $parent_info->id)->first();
                return @$student_info->full_name;
            } elseif ($str == 'username') {

                $user_info = User::find(@$parent_info->guardians_email);

                return @$user_info->username;
            }
        }
    }

    public static function getValueByStringDuesFees($student_detail, $str, $fees_info)
    {

        if ($str == 'student_name') {

            return @$student_detail->full_name;

        } elseif ($str == 'parent_name') {

            $parent_info = SmParent::find($student_detail->parent_id);
            return @$parent_info->fathers_name;

        } elseif ($str == 'due_amount') {

            return @$fees_info['dues_fees'];

        } elseif ($str == 'due_date') {

            $fees_master = SmFeesMaster::find($fees_info['fees_master']);


            return @$fees_master->date;

        } elseif ($str == 'school_name') {

            return @Auth::user()->school->school_name;

        } elseif ($str == 'fees_name') {

            $fees_master = SmFeesMaster::find($fees_info['fees_master']);

            return $fees_master->feesTypes->name;
        }
    }

    public static function getValueByStringAdmissionSms($s_id, $str)
    {

        $student = SmStudent::find($s_id);
        $student_user = User::find(@$student->user_id);

        $parent = SmParent::find(@$student->parent_id);
        $parent_user = User::find(@$parent->user_id);


        if ($str == 'student_name') {

            return @$student->full_name;

        } elseif ($str == 'student_username') {

            return @$student_user->username;

        } elseif ($str == 'student_email') {

            return @$student_user->email;

        } elseif ($str == 'student_password') {

            return '123456';

        } elseif ($str == 'guardian_name') {

            return @$parent->guardians_name;

        } elseif ($str == 'guardian_email') {

            return @$parent->guardians_email;

        } elseif ($str == 'guardian_password') {

            return '123456';

        } elseif ($str == 'admission_number') {

            return @$student->admission_no;

        } elseif ($str == 'school_name') {
            return @$student->school->school_name;
        }
    }
}
