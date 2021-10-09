<?php

namespace Database\Seeders;

use App\User;
use App\SmExam;
use App\SmClass;
use App\SmStaff;
use App\SmStyle;
use App\SmParent;
use App\SmSchool;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmVehicle;
use App\SmVisitor;
use App\SmExamType;
use App\SmFeesType;
use App\SmLanguage;
use App\SmClassRoom;
use App\SmClassTime;
use App\SmExamSetup;
use App\SmFeesGroup;
use App\SmMarkStore;
use App\SmFeesAssign;
use App\SmFeesMaster;
use App\SmMarksGrade;
use App\SmResultStore;
use App\GlobalVariable;
use App\SmAcademicYear;
use App\SmClassSection;
use App\SmExamSchedule;
use App\SmAssignSubject;
use App\SmAssignVehicle;
use App\SmDormitoryList;
use App\SmQuestionGroup;
use App\SmExamAttendance;
use App\SmPaymentMethhod;
use App\SmGeneralSettings;
use App\InfixModuleManager;
use Faker\Factory as Faker;
use App\SmExamAttendanceChild;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Modules\SaasSubscription\Entities\SmPackagePlan;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Modules\Saas\Entities\SaasSchoolModulePermissionAssign;
use Modules\SaasSubscription\Entities\SmSubscriptionPayment;

class sm_schoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $prefix = "school";
        for($i=2; $i<=5; $i++){
            $email= $prefix.'_'.$i.'@infixedu.com';
            $school= $faker->company. ' School';

            $store= new SmSchool();
            $store->school_name= $school;
            $store->email= $email;
            $store->created_at = date('Y-m-d h:i:s');
            $store->starting_date = date('Y-m-d');
            $store->is_email_verified = 1;
            $store->save();

            $academic_year = new SmAcademicYear();
            $academic_year->year = date('Y');
            $academic_year->title = ' academic year ' . date('Y');
            $academic_year->school_id = $i;
            $academic_year->starting_date = date('Y') . '-01-01';
            $academic_year->ending_date = date('Y') . '-12-31';
            $academic_year->save();
            
            $general_setting = new SmGeneralSettings();
            $general_setting->school_name = $school;
            $general_setting->email = $email;
            $general_setting->address = '';
            $general_setting->school_code = '';
            $general_setting->school_id = $i;
            $general_setting->phone = '';
            $general_setting->time_zone_id = 1;
            $general_setting->academic_id = $i;
            $general_setting->session_id = $i;
            $general_setting->save();

            $user            = new User();
            $user->role_id   = 1;
            $user->full_name = $faker->name;
            $user->email     = $email;
            $user->username  = $email;
            $user->password  = Hash::make('123456');
            $user->school_id = $i;
            $user->save();
            $user->toArray();

            //user details
            $staff                  = new SmStaff();
            $staff->user_id         = $user->id;
            $staff->role_id         = 1;
            $staff->staff_no        = 1;
            $staff->designation_id  = 1;
            $staff->department_id   = 1;
            $staff->first_name      = 'School';
            $staff->last_name       = 'Admin';
            $staff->full_name       = 'School Admin';
            $staff->date_of_birth   = '1980-12-26';
            $staff->date_of_joining = '2019-05-26';
            $staff->gender_id       = 1;
            $staff->school_id       = $i;
            $staff->email           = $email;
            $staff->staff_photo     = 'public/uploads/staff/1_infix_edu.jpg';
            $staff->casual_leave    = '12';
            $staff->medical_leave   = '15';
            $staff->metarnity_leave = '15';
            $staff->save();
            if (Schema::hasTable('saas_school_module_permission_assigns')) {
                for ($j = 2; $j <= 21; ++$j) {
                    $assign = new SaasSchoolModulePermissionAssign();
                    $assign->module_id = $i;
                    $assign->created_by = 1;
                    $assign->updated_by = 1;
                    $assign->school_id = $i;
                    $assign->save();
                }
            }

            if(moduleStatusCheck('RazorPay')== TRUE ){
                $payment_methods = ['Cash', 'Cheque', 'Bank', 'Stripe', 'Paystack','PayPal', 'RazorPay'];
            }else{
                $payment_methods = ['Cash', 'Cheque', 'Bank', 'Stripe', 'Paystack','PayPal'];
            }

            foreach ($payment_methods as $payment_method) {
                $method = new SmPaymentMethhod();
                $method->method = $payment_method;
                $method->type = 'System';
                $method->school_id = $i;
                $method->save();
            }

            DB::table('sm_payment_gateway_settings')->insert([
                [
                    'gateway_name'          => 'Stripe',
                    'gateway_username'      => 'demo@strip.com',
                    'gateway_password'      => '12334589',
                    'gateway_client_id'     => '',
                    'gateway_secret_key'    => 'AVZdghanegaOjiL6DPXd0XwjMGEQ2aXc58z1-isWmBFnw1h2j',
                    'gateway_secret_word'   => 'AVZdghanegaOjiL6DPXd0XwjMGEQ2aXc58z1',
                    'school_id'    => $i
                ]
            ]);


            DB::table('sm_payment_gateway_settings')->insert([
                [
                    'gateway_name'          => 'Paystack',
                    'gateway_username'      => 'demo@gmail.com',
                    'gateway_password'      => '12334589',
                    'gateway_client_id'     => '',
                    'gateway_secret_key'    => 'sk_live_2679322872013c265e161bc8ea11efc1e822bce1',
                    'gateway_publisher_key' => 'pk_live_e5738ce9aade963387204f1f19bee599176e7a71',
                    'school_id'    => $i
                ],

            ]);

            DB::table('sm_payment_gateway_settings')->insert([
                [
                    'gateway_name'          => 'PayPal',
                    'gateway_username'      => 'demo@paypal.com',
                    'gateway_password'      => '12334589',
                    'gateway_client_id'     => 'AaCPtpoUHZEXCa3v006nbYhYfD0HIX-dlgYWlsb0fdoFqpVToATuUbT43VuUE6pAxgvSbPTspKBqAF0x69',
                    'gateway_secret_key'    => 'EJ6q4h8w0OanYO1WKtNbo9o8suDg6PKUkHNKv-T6F4APDiq2e19OZf7DfpL5uOlEzJ_AMgeE0L2PtTEj69',
                    'gateway_publisher_key' => '',
                    'school_id'    => $i
                ],

            ]);

            if(moduleStatusCheck('RazorPay')== TRUE ){
                DB::table('sm_payment_gateway_settings')->insert([
                    [
                        'gateway_name'          => 'RazorPay',
                        'gateway_username'      => 'demo@gmail.com',
                        'gateway_password'      => '12334589',
                        'gateway_client_id'     => '',
                        'gateway_secret_key'    => '',
                        'gateway_publisher_key' => '',
                        'school_id'    => $i
                    ],

                ]);
            }

            DB::table('sm_payment_gateway_settings')->insert([
                [
                    'gateway_name'          => 'Bank',
                    'school_id'    => $i
                ],

            ]);

            DB::table('sm_payment_gateway_settings')->insert([
                [
                    'gateway_name'          => 'Cheque',
                    'school_id'    => $i
                ],

            ]);

            DB::table('sm_email_settings')->insert([
                [
                    'email_engine_type' => 'smtp',
                    'from_name' => $school,
                    'from_email' => $email,
                    'mail_driver'    => 'smtp',
                    'mail_host'    => 'smtp.gmail.com',
                    'mail_port'    => 587,
                    'mail_username'    =>  $email,
                    'mail_password'    => '12345678',
                    'mail_encryption'    => 'tls',
                    'school_id'    => $i,
                    'active_status'    => 0,
                    'academic_id'    => $academic_year->id,
                ],
                [
                    'email_engine_type' => 'php',
                    'from_name' => $school,
                    'from_email' => $email,
                    'mail_driver'    => 'php',
                    'mail_host'    => '',
                    'mail_port'    => '',
                    'mail_username'    =>  '',
                    'mail_password'    => '',
                    'mail_encryption'    => '',
                    'school_id'    => $i,
                    'active_status'    => 1,
                    'academic_id'    => $academic_year->id,
                ],
                
            ]);

            DB::table('sm_sms_gateways')->insert([
                [
                    'gateway_name' => 'Twilio',
                    'clickatell_username' => 'demo2',
                    'clickatell_password' => '12336',
                    'school_id'    => $i
                ],
                [
                    'gateway_name' => 'Msg91',
                    'clickatell_username' => 'demo2',
                    'clickatell_password' => '12336',
                    'school_id'    => $i
                ],
                [
                    'gateway_name' => 'TextLocal',
                    'clickatell_username' => 'demo3',
                    'clickatell_password' => '23445',
                    'school_id'    => $i
                ],
                [
                    'gateway_name' => 'AfricaTalking',
                    'clickatell_username' => 'demo3',
                    'clickatell_password' => '23445',
                    'school_id'    => $i
                ],
            ]);


            $sm_langs = SmLanguage::where('school_id',1)->get();
                        foreach($sm_langs as $lang){
                            $newLang = new SmLanguage();
                            $newLang->language_name= $lang->language_name;
                            $newLang->native= $lang->native;
                            $newLang->language_universal= $lang->language_universal;
                            $newLang->active_status= $lang->active_status;
                            $newLang->school_id= $i;
                            $newLang->save();
                        }

            DB::table('sm_background_settings')->insert([
                [
                    'title'         => 'Dashboard Background',
                    'type'          => 'image',
                    'image'         => 'public/backEnd/img/body-bg.jpg',
                    'color'         => '',
                    'school_id'         => $i,
                    'is_default'    => 1,
                ],
                [
                    'title'         => 'Login Background',
                    'type'          => 'image',
                    'image'         => 'public/backEnd/img/login-bg.jpg',
                    'color'         => '',
                    'school_id'         => $i,
                    'is_default'    => 0,
                ],
            ]);

            $s = new SmStyle();
            $s->style_name = 'Default';
            $s->path_main_style = 'style.css';
            $s->path_infix_style = 'infix.css';
            $s->primary_color = '#415094';
            $s->primary_color2 = '#7c32ff';
            $s->title_color = '#222222';
            $s->text_color = '#828bb2';
            $s->white = '#ffffff';
            $s->black = '#000000';
            $s->sidebar_bg = '#e7ecff';
            $s->barchart1 = '#8a33f8';
            $s->barchart2 = '#f25278';
            $s->barcharttextcolor = '#415094';
            $s->barcharttextfamily = '"poppins", sans-serif';
            $s->areachartlinecolor1 = 'rgba(124, 50, 255, 0.5)';
            $s->areachartlinecolor2 = 'rgba(242, 82, 120, 0.5)';
            $s->areachartlinecolor2 = 'rgba(242, 82, 120, 0.5)';
            $s->school_id = $i;
            $s->is_active = 1;
            $s->is_active = 1;
            $s->save();

            $s = new  SmStyle();
            $s->style_name = 'Lawn Green';
            $s->path_main_style = 'lawngreen_version/style.css';
            $s->path_infix_style = 'lawngreen_version/infix.css';
            $s->primary_color = '#415094';
            $s->primary_color2 = '#03e396';
            $s->title_color = '#222222';
            $s->text_color = '#828bb2';
            $s->white = '#ffffff';
            $s->black = '#000000';
            $s->sidebar_bg = '#e7ecff';
            $s->barchart1 = '#415094';
            $s->barchart2 = '#03e396';
            $s->barcharttextcolor = '#03e396';
            $s->barcharttextfamily = '"Cerebri Sans", Helvetica, Arial, sans-serif';
            $s->areachartlinecolor1 = '#415094';
            $s->areachartlinecolor2 = '#03e396';
            $s->dashboardbackground = '#e7ecff';
            $s->school_id = $i;
            $s->save();

            DB::table('sm_weekends')->insert([
                [
                    'name' => 'Saturday',
                    'order' => 1,
                    'is_weekend' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'academic_id' => $academic_year->id,
                    'school_id' => $i
                ],
                [
                    'name' => 'Sunday',
                    'order' => 2,
                    'is_weekend' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'academic_id' => $academic_year->id,
                    'school_id' => $i
                ],
                [
                    'name' => 'Monday',
                    'order' => 3,
                    'is_weekend' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'academic_id' => $academic_year->id,
                    'school_id' => $i
                ],
                [
                    'name' => 'Tuesday',
                    'order' => 4,
                    'is_weekend' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'academic_id' => $academic_year->id,
                    'school_id' => $i
                ],
                [
                    'name' => 'Wednesday',
                    'order' => 5,
                    'is_weekend' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'academic_id' => $academic_year->id,
                    'school_id' => $i
                ],
                [
                    'name' => 'Thursday',
                    'order' => 6,
                    'is_weekend' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'academic_id' => $academic_year->id,
                    'school_id' => $i
                ],
                [
                    'name' => 'Friday',
                    'order' => 7,
                    'is_weekend' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'academic_id' => $academic_year->id,
                    'school_id' => $i
                ]
            ]);



            for ($j = 1; $j <= 541; $j++) {
                $permission = new InfixPermissionAssign();
                $permission->module_id = $j;
                $permission->role_id = 5;
                $permission->school_id = $i;
                $permission->save();
            }

            $admins = [800,801,802,803,804,805,806,807,808,809,810,811,812,813,814,815,900,901,902,903,904];

            foreach ($admins as $key => $value) {
                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;   
                $permission->role_id = 5;                
                $permission->school_id = $i;                      
                $permission->save();
            }

            $ids = [399,400,401,402,403,404,428,429,430,431,456,457,458,459,460,461,462,463,478,482,483,484,549];
            foreach ($ids as $id) {
                $permission = InfixPermissionAssign::where('school_id',$i)->where('role_id',5)->where('module_id',$id)->first();
                if($permission){
                    $permission->delete();
                }          
            }

            // for teacher
            $teachers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 79, 80, 81, 82, 83, 84, 85, 86, 533, 534, 535, 536, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 214, 215, 216, 217, 218, 219, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263, 264, 265, 266, 267, 268, 269, 270, 271, 272, 273, 274, 275, 276, 537, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361, 362, 363, 364, 365, 366, 367, 368, 369, 370, 371, 372, 373, 374, 375, 277, 278, 279, 280, 281, 282, 283, 284, 285,800,801,802,803,804,805,806,807,808,809,833,834,900,901,902,903,904];

            foreach ($teachers as $key => $value) {

                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;
                $permission->role_id = 4;
                $permission->school_id = $i;
                $permission->save();
            }

            // for receiptionists
            $receiptionists = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 64, 65, 66, 67, 83, 84, 85, 86, 160, 161, 162, 163, 164, 188, 193, 194, 195, 376, 377, 378, 379, 380,900,901,902,903,904];

            foreach ($receiptionists as $key => $value) {

                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;
                $permission->role_id = 7;
                $permission->school_id = $i;
                $permission->save();
            }

            // for librarians
            $librarians = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 61, 64, 65, 66, 67, 83, 84, 85, 86, 160, 161, 162, 163, 164, 188, 193, 194, 195, 298, 299, 300, 301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 376, 377, 378, 379, 380,900,901,902,903,904];

            foreach ($librarians as $key => $value) {

                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;
                $permission->role_id = 8;
                $permission->school_id = $i;
                $permission->save();
            }

            // for drivers
            $drivers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 188, 193, 194, 19,900,901,902,903,904];

            foreach ($drivers as $key => $value) {

                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;
                $permission->role_id = 9;
                $permission->school_id = $i;
                $permission->save();
            }

            // for accountants
            $accountants = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 64, 65, 66, 67, 68, 69, 70, 83, 84, 85, 86, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 188, 193, 194, 195, 376, 377, 378, 379, 380, 381, 382, 383,900,901,902,903,904];

            foreach ($accountants as $key => $value) {

                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;
                $permission->role_id = 6;
                $permission->school_id = $i;
                $permission->save();
            }

            // student
            for ($j = 1; $j <= 55; $j++) {
                $permission = new InfixPermissionAssign();
                $permission->module_id = $j;
                $permission->role_id = 2;
                $permission->school_id = $i;
                $permission->save();
            }

                        
            $students = [800,810,815,900,901,902,903,904];
            foreach ($students as $key => $value) {
                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;                      
                $permission->role_id = 2;
                $permission->school_id = $i;
                $permission->save();
            }


            // parent
            for ($j = 56; $j <= 99; $j++) {
                $permission = new InfixPermissionAssign();
                $permission->module_id = $j;
                $permission->role_id = 3;
                $permission->school_id = $i;
                $permission->save();
            }
            // chat module
            $parents = [910,911,912,913,914];
            foreach ($parents as $key => $value) {
                $permission = new InfixPermissionAssign();
                $permission->module_id = $value;                   
                $permission->role_id = 3;
                $permission->school_id = $i;
                $permission->save();
            }

            $sectionData=['A','B','C'];
            foreach ($sectionData as $row) {
                for ($j = 2; $j <= 2; $j++) {
                    $s= new SmSection();
                    $s->section_name=$row.' '.$j;
                    $s->created_at = date('Y-m-d h:i:s');
                    $s->school_id=$i;
                    $s->academic_id=$i;
                    $s->save();
                }
            } 

            $classData = ['One', 'Two', 'Three', 'Four', 'Five'];
            foreach ($classData as $row) {
                for ($j = 2; $j <= 2; $j++) {
                    $s = new SmClass();
                    $s->class_name = $row . ' ' . $j;
                    $s->created_at = date('Y-m-d h:i:s');
                    $s->school_id = $i;
                    $s->academic_id = $i;
                    $s->save();
                }
            } 

            for ($j = 2; $j <= 2; $j++) {
                $classes= SmClass::where('school_id', $i)->get();
                foreach ($classes as  $class) {
                     $sections=SmSection::where('school_id', $i)->get();
                    foreach ($sections as $section) {
                        $s = new SmClassSection();
                        $s->class_id = $class->id;
                        $s->section_id = $section->id;
                        $s->school_id = $i;
                        $s->academic_id = $i;
                        $s->created_at = date('Y-m-d h:i:s');
                        $s->save();
                    }
                } 
            }

            DB::table('sm_subjects')->insert([

                [
                    'school_id'=> $i,
                    'academic_id'=> $i,
                    'subject_name'=> 'Bangla',
                    'subject_code'=> 'BAN-01',
                    'subject_type'=> 'T',
                    'active_status'=> 1,
                    'created_at' => date('Y-m-d h:i:s')
                ],
                [
                    'school_id'=> $i,
                    'academic_id'=> $i,
                    'subject_name'=> 'English For Today',
                    'subject_code'=> 'ENG-01',
                    'subject_type'=> 'T',
                    'active_status'=> 1,
                    'created_at' => date('Y-m-d h:i:s')
                ],
                [
                    'school_id'=> $i,
                    'academic_id'=> $i,
                    'subject_name'=> 'Mathematics',
                    'subject_code'=> 'MATH-01',
                    'subject_type'=> 'T',
                    'active_status'=> 1,
                    'created_at' => date('Y-m-d h:i:s')
                ],
                [
                    'school_id'=> $i,
                    'academic_id'=> $i,
                    'subject_name'=> 'Agricultural Education',
                    'subject_code'=> 'AG-01',
                    'subject_type'=> 'T',
                    'active_status'=> 1,
                    'created_at' => date('Y-m-d h:i:s')
                ],
                [
                    'school_id'=> $i,
                    'academic_id'=> $i,
                    'subject_name'=> 'Information and Communication Technology',
                    'subject_code'=> 'ICT-01',
                    'subject_type'=> 'T',
                    'active_status'=> 1,
                    'created_at' => date('Y-m-d h:i:s')
                ],
                [
                    'school_id'=> $i,
                    'academic_id'=> $i,
                    'subject_name'=> 'Science',
                    'subject_code'=> 'SI-01',
                    'subject_type'=> 'T',
                    'active_status'=> 1,
                    'created_at' => date('Y-m-d h:i:s')
                ],
                [
                    'school_id'=> $i,
                    'academic_id'=> $i,
                    'subject_name'=> 'Islam & Ethical Education',
                    'subject_code'=> 'IEE-01',
                    'subject_type'=> 'T',
                    'active_status'=> 1,
                    'created_at' => date('Y-m-d h:i:s')
                ],
            ]);

            for ($j = 2; $j <= 4; $j++) {
                $store = new SmVisitor();
                $store->name = $faker->name;
                $store->phone = $faker->tollFreePhoneNumber;
                $store->visitor_id = $j;
                $store->no_of_person = $faker->numberBetween(1, 5);
                $store->purpose = $faker->word;
                $store->date = $faker->dateTime()->format('Y-m-d');
                $store->in_time = $faker->time($format = 'H:i A', $max = 'now');
                $store->out_time = $faker->time($format = 'H:i A', $max = 'now');
                $store->file = '';
                $store->created_at = date('Y-m-d h:i:s');
                $store->school_id = $i;
                $store->save();
            }

            $obj = new GlobalVariable();
            $Names = $obj->Names;
            $basic_salary = 30000;

            for ($role_id = 4; $role_id <10; $role_id++) {
                for ($j = 1; $j < 2; $j++) {
                $gender_id = 1;

                $name_index = array_rand($Names, 8);
                $First_Name = $UserName = $faker->firstName($gender =  'male');
                $Last_Name  =              $faker->lastName($gender =  'male');
                $Full_name  = $First_Name . ' ' . $Last_Name;

                //parents name genarator
                $Father_First_Name  =   $faker->firstName($gender =  'male');
                $Father_Last_Name   =   $faker->firstName($gender =  'male');
                $Father_full_name   =   $Father_First_Name . ' ' . $Father_Last_Name;



                $Mother_First_Name  =   $faker->firstName($gender =  'female');
                $Mother_Last_Name   =   $faker->firstName($gender =  'female');
                $Mother_full_name = $Mother_First_Name . ' ' . $Mother_Last_Name;



                //insert staff user & pass
                $newUser            = new User();
                $newUser->role_id   = $role_id;
                $newUser->full_name = $Full_name;
                $newUser->email     = $First_Name . $j . '@infixedu.com';
                $newUser->username  = $First_Name . $j . '@infixedu.com';
                $newUser->password  = Hash::make(123456);
                $newUser->created_at = date('Y-m-d h:i:s');
                $newUser->school_id = $i;
                $newUser->save();
                $newUser->toArray();
                $staff_id_number = $newUser->id;

                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('sm_staffs')->insert([

                    [
                        'user_id'          => $staff_id_number,
                        'role_id'          => $role_id,
                        'staff_no'         => count(\App\SmStaff::all()) + 1,
                        'designation_id'   => 1,
                        'department_id'    => 1,
                        'first_name'       => $First_Name,
                        'last_name'        => $Last_Name,
                        'full_name'        => $Full_name,
                        'fathers_name'     => $Father_full_name,
                        'mothers_name'     => $Mother_full_name,

                        'date_of_birth'    => $faker->date($format = 'Y-m-d', $max = 'now'),
                        'date_of_joining'  => $faker->date($format = 'Y-m-d', $max = 'now'),

                        'gender_id'        => $gender_id,
                        'email'            => $First_Name . $j . '@infixedu.com',
                        'mobile'           => '123456789',
                        'emergency_mobile' => '1234567890',
                        'marital_status'   => 'Married',
                        'staff_photo'      => '',
                        'current_address'  => $faker->address,
                        'permanent_address' => $faker->streetAddress,
                        'qualification'    => 'B.Sc in Computer Science',
                        'experience'       => '4 Years',
                        'basic_salary'     => $basic_salary + $j,
                        'casual_leave'     => '12',
                        'medical_leave'    => '15',
                        'metarnity_leave'  => '45',

                        'driving_license'  => '56776987453',
                        'driving_license_ex_date' => '2019-02-23',
                        'school_id' => $i,
                        'created_at' => date('Y-m-d h:i:s')
                    ]


                ]);
                }
            }

            $class_id = SmClass::where('school_id',$i)->where('academic_id',$i)->first('id')->id;
            $section_id = SmClassSection::where('school_id',$i)->where('class_id',$class_id)->where('academic_id',$i)->first('section_id')->section_id;


            for ($j = 1; $j <= 20; $j++) {
                            $gender_id = 1 + $j % 2;
        
                            $student_First_Name = $student_User_Name = $faker->firstName($gender = 'male');
                            $student_Last_Name  = $faker->lastName($gender = 'male');
                            $student_full_name  = $student_First_Name . ' ' . $student_Last_Name;
        
                            //parents name genarator
                            $Father_First_Name = $Father_User_Name = $faker->firstName($gender = 'male');
                            $Father_Last_Name  = $faker->lastName($gender = 'male');
                            $Father_full_name  = $Father_First_Name . ' ' . $Father_Last_Name;
        
                            $Mother_First_Name = $faker->firstName($gender = 'female');
                            $Mother_Last_Name  = $faker->lastName($gender = 'female');
                            $Mother_full_name  = $Mother_First_Name . ' ' . $Mother_Last_Name;
        
                            //guardians name gebarator
                            $Guardian_First_Name = $faker->firstName($gender = 'male');
                            $Guardian_Last_Name  = $faker->lastName($gender = 'male');
                            $Guardian_full_name  = $Guardian_First_Name . ' ' . $Guardian_Last_Name;
        
                            $studentEmail = strtolower($student_User_Name) . $j . '@infixedu.com';
        
                            //insert student user & pass
                            $newUser            = new User();
                            $newUser->role_id   = 2;
                            $newUser->full_name = $student_full_name;
                            $newUser->email     = $studentEmail;
                            $newUser->username  = $studentEmail;
                            $newUser->password  = Hash::make(123456);
        
                            $newUser->created_at = date('Y-m-d h:i:s');
                            $newUser->school_id = $i;
                            $newUser->save();
                            $newUser->toArray();
                            $student_id = $newUser->id;
        
                            //insert student user & pass
                            $newUser            = new User();
                            $newUser->role_id   = 3;
                            $newUser->full_name = $Father_full_name;
                            $newUser->email     = strtolower($Father_User_Name).'_pa' . $j . '@infixedu.com';
                            $newUser->username  = strtolower($Father_User_Name).'_pa' . $j . '@infixedu.com';
                            $newUser->password  = Hash::make(123456);
        
                            $newUser->created_at = date('Y-m-d h:i:s');
                            $newUser->school_id = $i;
                            $newUser->school_id = $i;
                            $newUser->save();
                            $newUser->toArray();
                            $parents_id = $newUser->id;
        
                            $parent          = new SmParent();
                            $parent->user_id = $parents_id;
        
                            $parent->fathers_name       = $Father_full_name;
                            $parent->fathers_mobile     = rand(1000, 9999) . rand(1000, 9999);
                            $parent->fathers_occupation = 'Teacher';
                            $parent->fathers_photo      = '';
        
                            $parent->mothers_name       = $Mother_full_name;
                            $parent->mothers_mobile     = rand(1000, 9999) . rand(1000, 9999);
                            $parent->mothers_occupation = 'Housewife';
                            $parent->mothers_photo      = '';
        
                            $parent->guardians_name       = $Guardian_full_name;
                            $parent->guardians_mobile     = rand(1000, 9999) . rand(1000, 9999);
                            $parent->guardians_email      = $Guardian_First_Name . $j . '@infixedu.com';
                            $parent->guardians_occupation = 'Businessman';
                            $parent->guardians_relation   = 'Brother';
                            $parent->relation             = 'Son';
                            $parent->guardians_photo      = '';
        
                            $parent->guardians_address = 'Dhaka-1219, Bangladesh';
                            $parent->is_guardian       = 1;
        
                            $parent->created_at = date('Y-m-d h:i:s');
                            $parent->school_id = $i;
                            $parent->academic_id = $i;
                            $parent->save();
                            $parent->toArray();
                            $parents_id = $parent->id;
        
        
        
                            DB::table('sm_students')->insert([
                                [
                                    'user_id'                 => $student_id,
                                    'parent_id'               => $parents_id,
                                    'admission_no'            => $faker->numberBetween($min = 10000, $max = 90000),
                                    'roll_no'                 => $faker->numberBetween($min = 10000, $max = 90000),
                                    'class_id'                => $class_id,
                                    'student_category_id'     => 1,
                                    'role_id'     => 2,
                                    'section_id'              => $section_id,
                                    'session_id'              => 1,
                                    'caste'                   => 'Asian',
                                    'bloodgroup_id'           => 8 + $j % 8,
        
                                    //transport section
        
        
                                    'national_id_no'          => '237864238764' . $j * $j,
                                    'local_id_no'             => '237864238764' . $j * $j,
        
                                    'religion_id'             => 3 + $j % 5,
                                    'height'                  => 56,
                                    'weight'                  => 45,
        
                                    'first_name'              => $student_First_Name,
                                    'last_name'               => $student_Last_Name,
                                    'full_name'               => $student_full_name,
        
                                    'date_of_birth'           => $faker->date($format = 'Y-m-d', $max = 'now'),
                                    'admission_date'          => $faker->date($format = 'Y-m-d', $max = 'now'),
        
                                    'gender_id'               => $gender_id,
                                    'email'                   => $studentEmail,
                                    'mobile'                  => '+8801234567' . $j,
                                    'bank_account_no'         => '+8801234567' . $j,
        
                                    'bank_name'               => 'DBBL',
                                    'student_photo'           => '',
        
                                    'current_address'         => 'Bangladesh',
                                    'previous_school_details' => 'Bangladesh',
                                    'aditional_notes'         => 'Bangladesh',
        
                                    'permanent_address'       => 'Bangladesh',
                                    'school_id' => $i,
                                    'academic_id' => $i,
                                    'created_at' => date('Y-m-d h:i:s')
                                ],
        
                            ]);
            }

            for ($j = 1; $j <= 3; $j++) {
                $exam_time = new SmClassTime();
                $exam_time->type = "exam";
                $exam_time->period = $j."st period";
                $exam_time->start_time = '09:00:00';
                $exam_time->end_time = '12:00:00';
                $exam_time->is_break = 0;
                $exam_time->school_id = $i;
                $exam_time->academic_id = $i;
                $exam_time->save();
            }
            for ($j = 1; $j <= 3; $j++) {
                $exam_type = new SmExamType();
                $exam_type->title = $j."Term";
                $exam_type->active_status = 1;
                $exam_type->created_at = date('Y-m-d h:i:s');
                $exam_type->school_id = $i;
                $exam_type->academic_id = $i;
                $exam_type->save();
            }


            $teacher = SmStaff::where('role_id', 4)->where('school_id',$i)->first();
            $class_ids = SmClass::where('school_id', $i)->first();
            $data = SmClassSection::where('class_id', $class_ids->id)->where('school_id',$i)->get();
            $subject_id = SmSubject::where('school_id', $i)->get();

            foreach ($data as $datum) {
                $class_id = $datum->class_id;
                $section_id = $datum->section_id;
                foreach ($subject_id as $subject) {

                    DB::table('sm_assign_subjects')->insert([
                        [
                            'class_id' => $class_id,
                            'section_id' => $section_id,
                            'teacher_id' => $teacher->id,
                            'subject_id' => $subject->id,
                            'school_id' => $i,
                            'academic_id' => $i,
                            'created_at' => date('Y-m-d h:i:s')
                        ]
                    ]);
                }
            }


            $exams_types= SmExamType::where('school_id',$i)->get();
            $class_id = SmClass::where('school_id', $i)->where('academic_id',$i)->first('id')->id;
            $sections = SmClassSection::where('class_id', $class_id)->get();
            $subjects_ids = SmSubject::where('school_id', $i)->get();
            foreach ($exams_types as $exam_type_id) {
                foreach ($sections as $section) {
                    $subject_for_sections = SmAssignSubject::where('class_id', $class_id)->where('section_id', $section->section_id)->get();
                    $eligible_subjects = [];
                    foreach ($subject_for_sections as $subject_for_section) {
                        $eligible_subjects[] = $subject_for_section->subject_id;
                    }
                    foreach ($subjects_ids as $subject_id) {
                        if (in_array($subject_id->id, $eligible_subjects)) {
                            $exam = new SmExam();
                            $exam->exam_type_id = $exam_type_id->id;
                            $exam->class_id = $class_id;
                            $exam->section_id = $section->section_id;
                            $exam->subject_id = $subject_id->id;
                            $exam->exam_mark = 100;
                            $exam->school_id = $i;
                            $exam->academic_id = $i;
                            $exam->save();
                            // $exam->toArray();
                            $ex_title = "Written";
                            $ex_mark = 100;
                            $newSetupExam = new SmExamSetup();
                            $newSetupExam->exam_id = $exam->id;
                            $newSetupExam->class_id = $class_id;
                            $newSetupExam->section_id = $section->section_id;
                            $newSetupExam->subject_id = $subject_id->id;
                            $newSetupExam->exam_term_id = $exam_type_id->id;
                            $newSetupExam->exam_title = $ex_title;
                            $newSetupExam->exam_mark = $ex_mark;
                            $newSetupExam->school_id = $i;
                            $newSetupExam->academic_id = $i;
                            $newSetupExam->save();
                        }
                    }
                }
            }


            for($j=301; $j <= 304; $j++){
                $class_room = new SmClassRoom();
                $class_room->room_no = "Room".$j;
                $class_room->capacity = 50;
                $class_room->school_id = $i;
                $class_room->academic_id = $i;
                $class_room->save();
            }
            
            
            
            $examTime = SmClassTime::where('school_id',$i)->where('academic_id',$i)->first();
            $room = SmClassRoom::where('school_id',$i)->where('academic_id',$i)->first();
                foreach($exams_types as $exam_type_id){
                    foreach($sections as $section){
                        foreach ($subjects_ids as $subject_id) {
                            $exam_routine = new SmExamSchedule();
                            $exam_routine->class_id = $class_id;
                            $exam_routine->section_id = $section->section_id;
                            $exam_routine->subject_id = $subject_id->id;
                            $exam_routine->exam_period_id = $examTime->id;
                            $exam_routine->exam_term_id = $exam_type_id->id;
                            $exam_routine->room_id = $room->id;
                            $exam_routine->school_id = $i;
                            $exam_routine->academic_id = $i;
                            $exam_routine->save();
                        }
                    }
                }

               

            $examType= SmExamType::where('school_id',$i)->where('academic_id',$i)->first('id')->id;

                foreach($sections as $section){
                    foreach ($subjects_ids as $subject_id) {
                        $exam_attendance = new SmExamAttendance();
                        $exam_attendance->exam_id = $examType;
                        $exam_attendance->subject_id = $subject_id->id;
                        $exam_attendance->class_id = $class_id;
                        $exam_attendance->section_id = $section->section_id;
                        $exam_attendance->school_id = $i;
                        $exam_attendance->academic_id = $i;
                        $exam_attendance->save();
                        
                    }
                }

            $students = SmStudent::where('school_id',$i)->where('academic_id',$i)->get();
            $infos = SmExamAttendance::where('school_id',$i)->where('academic_id',$i)->get();

            foreach($infos as $info){
                foreach ($students as $student) {    
                    $exam_attendance_child = new SmExamAttendanceChild();
                    $exam_attendance_child->exam_attendance_id = $info->id;
                    $exam_attendance_child->student_id = $student->id;
                    $exam_attendance_child->attendance_type = "P";
                    $exam_attendance_child->school_id = $i;
                    $exam_attendance_child->academic_id = $i;
                    $exam_attendance_child->save();
                }
            }


            $dataGrade = [
                ['A+',  '5.00',  5.00,    5.99,   80, 100,     'Outstanding !'],
                ['A',  '4.00',  4.00,    4.99,   70, 79,      'Very Good !'],
                ['A-',  '3.50',  3.50,    3.99,   60, 69,      'Good !'],
                ['B',  '3.00',  3.00,    3.49,   50, 59,     'Outstanding !'],
                ['C',  '2.00',  2.00,    2.99,   40, 49,      'Bad !'],
                ['D',  '1.00',  1.00,    1.99,   33, 39,      'Very Bad !'],
                ['F',  '0.00',  0.00,    0.99,   0, 32,       'Failed !'],
            ];
            foreach ($dataGrade as $r) {
                $store = new SmMarksGrade();
                $store->academic_id         = $i;
                $store->school_id           = $i;
                $store->grade_name          = $r[0];
                $store->gpa                 = $r[1];
                $store->from                = $r[2];
                $store->up                  = $r[3];
                $store->percent_from        = $r[4];
                $store->percent_upto        = $r[5];
                $store->description         = $r[6];
                $store->save();
            }





            // Mark Register
            foreach($sections as $section){
                foreach ($subjects_ids as $subject_id) {
                    foreach ($students as $student) { 
                        $marks_register = new SmMarkStore();
                        $marks_register->exam_term_id           = $examType;
                        $marks_register->class_id               = $class_id;
                        $marks_register->section_id             = $section->section_id;
                        $marks_register->subject_id             = $subject_id->id;

                            $marks_register->student_id         = $student->id;
                            $marks_register->total_marks        = rand(25,100);
                        // $marks_register->exam_setup_id          = $exam_setup_id;
                        $marks_register->teacher_remarks        = "Good";
                        $marks_register->school_id = $i;
                        $marks_register->academic_id = $i;
                        $marks_register->save();

                        $mark_grade = SmMarksGrade::where([
                                    ['percent_from', '<=', $marks_register->total_marks], 
                                    ['percent_upto', '>=', $marks_register->total_marks]])
                                    ->where('academic_id',$i)
                                    ->where('school_id',$i)
                                    ->first();


                        $result_record = new SmResultStore();
                        $result_record->class_id               =   $class_id;
                        $result_record->section_id             =   $section->section_id;
                        $result_record->subject_id             =   $subject_id->id;
                        $result_record->exam_type_id           =   $examType;

                        
                            $result_record->student_id             = $student->id;
                            $result_record->total_marks            = $marks_register->total_marks;

                        $result_record->total_gpa_point        = @$mark_grade->gpa;
                        $result_record->total_gpa_grade        = @$mark_grade->grade_name;
                        $result_record->teacher_remarks        = "Good";
                        $result_record->school_id              = $i;
                        $result_record->academic_id            = $i;
                        $result_record->save();

                    }
                }
            }


            for($j=1; $j<=5; $j++){
                $store= new SmQuestionGroup();
                $store->title = $faker->word;
                $store->save();
            }


            // Fees

            DB::table('sm_fees_groups')->insert([          
                [
                    'name' => 'Library Fee',
                    'type' => 'System',
                    'description' => 'System Automatic created this fee group',
                    'school_id' => $i,
                    'academic_id' => $i,
                ],
                [
                    'name' => 'Processing Fee',
                    'type' => 'System',
                    'description' => 'System Automatic created this fee group',
                    'school_id' => $i,
                    'academic_id' => $i,
                ],
                [
                    'name' => 'Tuition Fee',
                    'type' => 'System',
                    'description' => 'System Automatic created this fee group',
                    'school_id' => $i,
                    'academic_id' => $i,
                ],
                [
                    'name' => 'Development Fee',
                    'type' => 'System',
                    'description' => 'System Automatic created this fee group',
                    'school_id' => $i,
                    'academic_id' => $i,
                ]
            ]);


            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $feeesGroups = SmFeesGroup::where('school_id',$i)->where('academic_id',$i)->get();

            $array = ['Library','Sports','Environment','E-learning'];
            foreach($feeesGroups as $key =>$feeesGroup){
                    $store                  = new SmFeesType();
                    $store->name            = $array[$key];
                    $store->fees_group_id   = $feeesGroup->id;
                    $store->description     = 'Sample Data genarated';
                    $store->school_id       = $i;
                    $store->academic_id     = $i;
                    $store->save(); 
            }

            $feesTypeData = SmFeesType::where('school_id',$i)->where('academic_id',$i)->get();
            foreach ($feesTypeData as $row) {
                $store= new SmFeesMaster();
                $store->fees_group_id= $row->fees_group_id;
                $store->fees_type_id= $row->id;
                $store->amount=500+rand()%500;
                $store->school_id       = $i;
                $store->academic_id     = $i;
                $store->save(); 
            }


            $feesMaterDatas = SmFeesMaster::where('school_id',$i)->where('academic_id',$i)->get();
            foreach($students as $student){
                foreach($feesMaterDatas as $feesMaterData){
                    $assign_fees = new SmFeesAssign();
                    $assign_fees->student_id = $student->id;
                    $assign_fees->fees_amount = $feesMaterData->amount;
                    $assign_fees->fees_master_id = $feesMaterData->id;
                    $assign_fees->school_id = $i;
                    $assign_fees->academic_id = $i;
                    $assign_fees->save();
                }
            }

        

        } // End For

        $findSaas= InfixModuleManager::where('name','Saas')->first();
        $saasPurchase= InfixModuleManager::find($findSaas->id);
        $saasPurchase->purchase_code = 123456;
        $saasPurchase->is_default = 0;
        $saasPurchase->update();

        $act = SmGeneralSettings::first();
        $act->Saas= 1;
        $act->save();

    }
}
