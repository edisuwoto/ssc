
<?php

use App\User;
use App\SmExam;
use App\SmNews;
use App\SmPage;
use App\SmStaff;
use App\SmStyle;
use App\SmParent;
use App\SmStudent;
use App\SmExamType;
use App\SmLanguage;
use App\SmExamSetup;
use App\SmMarkStore;
use App\SmsTemplate;
use App\SmDateFormat;
use App\SmFeesMaster;
use App\SmMarksGrade;
use App\SmSmsGateway;
use App\SmFeesPayment;
use App\SmResultStore;
use GuzzleHttp\Client;
use App\SmAcademicYear;
use App\SmClassTeacher;
use App\SmEmailSetting;
use App\SmExamSchedule;
use App\SmNewsCategory;
use App\SmAssignSubject;
use App\SmExamAttendance;
use App\SmPaymentMethhod;
use App\SmGeneralSettings;
use App\InfixModuleManager;
use App\CustomResultSetting;
use App\SmExamAttendanceChild;
use App\SmClassOptionalSubject;
use App\SmOptionalSubjectAssign;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Modules\MenuManage\Entities\MenuManage;
use Modules\MenuManage\Entities\SidebarNew;
use Modules\RolePermission\Entities\InfixModuleInfo;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Modules\ParentRegistration\Entities\SmStudentRegistration;

function sendEmailBio($data, $to_name, $to_email, $email_sms_title)
{
    $systemSetting = DB::table('sm_general_settings')->select('school_name', 'email')->find(1);
    $systemEmail = DB::table('sm_email_settings')->find(1);
    $system_email = $systemEmail->from_email;
    $school_name = $systemSetting->school_name;
    if (!empty($system_email)) {
        $data['email_sms_title'] = $email_sms_title;
        $data['system_email'] = $system_email;
        $data['school_name'] = $school_name;
        $details = $to_email;
        dispatch(new \App\Jobs\SendEmailJob($data, $details));
        $error_data = [];
        return true;
    } else {
        $error_data[0] = 'success';
        $error_data[1] = 'Operation Failed, Please Updated System Mail';
        return $error_data;
    }

}
if (!function_exists('activeSmsGateway')) {
    function activeSmsGateway()
    {
        $activeSmsGateway = SmSmsGateway::where('school_id',Auth::user()->school_id)->where('active_status', '=', 1)->first();

        return $activeSmsGateway;

    }
}
if (!function_exists('youtubeVideo')) {
    function youtubeVideo($video_url)
    {
        if (Str::contains($video_url, 'youtu.be')) {
            $url = explode("/", $video_url);
            return 'https://www.youtube.com/watch?v=' . $url[3];
        }

        if (Str::contains($video_url, '&')) {
            return substr($video_url, 0, strpos($video_url, "&"));
        } else {
            return $video_url;
        }


    }
}
function showFileName($data){
    $name = explode('/', $data);
    $number = array_key_last($name);
    return $name[$number];
}
function sendSMSApi($to_mobile, $sms, $id)
{
    $activeSmsGateway = SmSmsGateway::find($id);
    if ($activeSmsGateway->gateway_name == 'Twilio') {
        $client = new Twilio\Rest\Client($activeSmsGateway->twilio_account_sid, $activeSmsGateway->twilio_authentication_token);
        if (!empty($to_mobile)) {
            $result = $message = $client->messages->create($to_mobile, array('from' => $activeSmsGateway->twilio_registered_no, 'body' => $sms));
            return $result;
        }
    } //end Twilio
    else if ($activeSmsGateway->gateway_name == 'Clickatell') {

        // config(['clickatell.api_key' => $activeSmsGateway->clickatell_api_id]); //set a variale in config file(clickatell.php)

        $clickatell = new \Clickatell\Rest();
        $result = $clickatell->sendMessage(['to' => $to_mobile, 'content' => $sms]);
    } //end Clickatell


    //start Himalayasms

    else if ($activeSmsGateway->gateway_name == 'Himalayasms') {
        $client = new Client();
		    $request = $client->get( "https://sms.techhimalaya.com/base/smsapi/index.php", [
			'query' => [
				'key' => $activeSmsGateway->himalayasms_key,
				'senderid' => $activeSmsGateway->himalayasms_senderId,
				'campaign' => $activeSmsGateway->himalayasms_campaign,
				'routeid' => $activeSmsGateway->himalayasms_routeId ,
				'contacts' => $to_mobile,
				'msg' => $sms,
				'type' => "text"
			],
			'http_errors' => false
		]);

		$result = $request->getBody();

    }

    else if ($activeSmsGateway->gateway_name == 'Msg91') {
        $msg91_authentication_key_sid = $activeSmsGateway->msg91_authentication_key_sid;
        $msg91_sender_id = $activeSmsGateway->msg91_sender_id;
        $msg91_route = $activeSmsGateway->msg91_route;
        $msg91_country_code = $activeSmsGateway->msg91_country_code;

        $curl = curl_init();

        $url = "https://api.msg91.com/api/sendhttp.php?mobiles=" . $to_mobile . "&authkey=" . $msg91_authentication_key_sid . "&route=" . $msg91_route . "&sender=" . $msg91_sender_id . "&message=" . $sms . "&country=91";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $result = "cURL Error #:" . $err;
        } else {
            $result = $response;
        }
    } //end Msg91
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        $result = "cURL Error #:" . $err;
    } else {
        $result = $response;
    }
    return $result;

} //end Msg91


function sendSMSBio($to_mobile, $sms)
{
    $activeSmsGateway = SmSmsGateway::where('school_id',Auth::user()->school_id)->where('active_status', '=', 1)->first();
    if ($activeSmsGateway->gateway_name == 'Twilio') {

        config(['TWILIO.SID' => $activeSmsGateway->twilio_account_sid]);
        config(['TWILIO.TOKEN' => $activeSmsGateway->twilio_authentication_token]);
        config(['TWILIO.FROM' => $activeSmsGateway->twilio_registered_no]);
        $account_id = $activeSmsGateway->twilio_account_sid; // Your Account SID from www.twilio.com/console
        $auth_token = $activeSmsGateway->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
        $from_phone_number = $activeSmsGateway->twilio_registered_no;
        $client = new Twilio\Rest\Client($account_id, $auth_token);
        if (!empty($to_mobile)) {
            $result = $message = $client->messages->create($to_mobile, array('from' => $from_phone_number, 'body' => $sms));
            return $result;
        }
    } //end Twilio
    else if ($activeSmsGateway->gateway_name == 'Clickatell') {


        // config(['clickatell.api_key' => $activeSmsGateway->clickatell_api_id]); //set a variale in config file(clickatell.php)

        $clickatell = new \Clickatell\Rest();
        $result = $clickatell->sendMessage(['to' => $to_mobile, 'content' => $sms]);
    } //end Clickatell

    else if ($activeSmsGateway->gateway_name == 'Msg91') {
        $msg91_authentication_key_sid = $activeSmsGateway->msg91_authentication_key_sid;
        $msg91_sender_id = $activeSmsGateway->msg91_sender_id;
        $msg91_route = $activeSmsGateway->msg91_route;
        $msg91_country_code = $activeSmsGateway->msg91_country_code;

        $curl = curl_init();

        $url = "https://api.msg91.com/api/sendhttp.php?mobiles=" . $to_mobile . "&authkey=" . $msg91_authentication_key_sid . "&route=" . $msg91_route . "&sender=" . $msg91_sender_id . "&message=" . $sms . "&country=91";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $result = "cURL Error #:" . $err;
        } else {
            $result = $response;
        }
    } //end Msg91
    elseif ($activeSmsGateway->gateway_name == 'TextLocal') {

        // Account details
        // $apiKey = urlencode('Your apiKey');
        $apiKey = $activeSmsGateway->textlocal_hash;
        
        // Message details
        $numbers = $to_mobile;
        $sender = urlencode($activeSmsGateway->textlocal_sender);
        $message = rawurlencode($sms);
    
        // $numbers = implode(',', $numbers);
    
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
    
        // Send the POST request with cURL
        $ch = curl_init('https://api.txtlocal.com/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        // Process your response here
        $result= $response;

    }
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION =>
            CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        $result = "cURL Error #:" . $err;
    } else {
        $result = $response;
    }
    return $result;
} //end Msg91


function getValueByString($student_id, $string, $extra = null)
{
    $student = SmStudent::find($student_id);
    if ($extra != null) {
        return $student->$string->$extra;
    } else {
        return $student->$string;
    }
}


function getParentName($student_id, $string, $extra = null)
{
    $student = SmStudent::find($student_id);
    $parent = SmParent::where('id', $student->parent_id)->first();
    if ($extra != null) {
        return $student->$parent->$extra;
    } else {
        return $parent->fathers_name;
    }
}

function SMSBody($body, $s_id, $time)
{
    try {
        $original_message = $body;
        // $original_message= "Dear Parent [fathers_name], your child [class] came to the school at [section]";
        $chars = preg_split('/[\s,]+/', $original_message, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        foreach ($chars as $item) {
            if (strstr($item[0], "[")) {
                $str = str_replace('[', '', $item);
                $str = str_replace(']', '', $str);
                $str = str_replace('.', '', $str);
                if ($str == "class") {
                    $str = "class";
                    $extra = "class_name";
                    $custom_array[$item] = getValueByString($s_id, $str, $extra);
                } elseif ($str == "section") {
                    $str = "section";
                    $extra = "section_name";
                    $custom_array[$item] = getValueByString($s_id, $str, $extra);
                } elseif ($str == 'check_in_time') {
                    $custom_array[$item] = $time;
                } elseif ($str == 'fathers_name') {
                    $str = "parents";
                    $extra = "fathers_name";
                    $custom_array[$item] = getValueByString($s_id, $str, $extra);
                    // $custom_array[$item]= 'father';
                } else {
                    $custom_array[$item] = getValueByString($s_id, $str);
                }
            }
        }

        foreach ($custom_array as $key => $value) {
            $original_message = str_replace($key, $value, $original_message);
        }


        return $original_message;


    } catch (\Exception $e) {
        $data = [];
        return $data;
    }

}

function FeesDueSMSBody($body, $s_id, $time)
{
    try {
        $original_message = $body;
        $chars = preg_split('/[\s,]+/', $original_message, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        foreach ($chars as $item) {
            if (strstr($item[0], "|")) {
                $str = str_replace('|', '', $item);
                // return $str;
                $str = str_replace('|', '', $str);
                $str = str_replace('.', '', $str);
                if ($str == "StudentName") {
                    $str = "StudentName";
                    $extra = "full_name";
                    $custom_array[$item] = getValueByString($s_id, $str, $extra);

                } elseif ($str == 'fathers_name') {
                    $str = "parents";
                    $extra = "fathers_name";
                    $custom_array[$item] = getValueByString($s_id, $str, $extra);
                    // $custom_array[$item]= 'father';
                } else {
                    $custom_array[$item] = getValueByString($s_id, $str);
                }
            }
        }

        foreach ($custom_array as $key => $value) {
            $original_message = str_replace($key, $value, $original_message);
        }

        return $original_message;


    } catch (\Exception $e) {
        $data = [];
        return $data;
    }

}

if (!function_exists('userPermission')) {
    function userPermission($assignId, $role_id = null, $purpose = null)
    {
        $role_id = Auth::user()->role_id;
        $permissions = app('permission');
        if ($role_id == 1 && Auth::user()->is_administrator == "yes") {
            return True;
        }
        if ((!empty($permissions)) && ($role_id != 1)) {
            if (@in_array($assignId, $permissions)) {
                return True;
            } else {
                return False;
            }
        } else {
            return True;
        }
    }
}


if (!function_exists('moduleStatusCheck')) {
    function moduleStatusCheck($module)
    {

        try {
            // get all module from session;
            $all_module = session()->get('all_module');
            //check module status
            $modulestatus = Module::find($module)->isDisabled();

            //if session exist and non empty
            if (!empty($all_module)) {
                if ((in_array($module, $all_module)) && $modulestatus == false) {

                    return True;
                } else {
                    return False;
                }

            } //if session failed or empty data then hit database
            else {
                // is available Modules / FeesCollection1 / Providers / FeesCollectionServiceProvider . php
                $is_module_available = 'Modules/' . $module . '/Providers/' . $module . 'ServiceProvider.php';

                if (file_exists($is_module_available)) {
                    $modulestatus = Module::find($module)->isDisabled();

                    if ($modulestatus == FALSE) {
                        $is_verify = InfixModuleManager::where('name', $module)->first();

                        if (!empty($is_verify->purchase_code)) {
                            return TRUE;

                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            return FALSE;
        }

    }
}


if (!function_exists('dateConvert')) {

    function dateConvert($input_date)
    {
        try {
            $system_date_format = session()->get('system_date_format');
            if (empty($system_date_format)) {
                $date_format_id = SmGeneralSettings::where('id', 1)->first(['date_format_id'])->date_format_id;
                $system_date_format = SmDateFormat::where('id', $date_format_id)->first(['format'])->format;
                session()->put('system_date_format', $system_date_format);
                return date_format(date_create($input_date), $system_date_format);
            } else {
                return date_format(date_create($input_date), $system_date_format);
            }
        } catch (\Throwable $th) {
            return $input_date;
        }
    }
}

if (!function_exists('getAcademicId')){
    function getAcademicId(){
       
        if (session()->has('sessionId')) {
            return session()->get('sessionId');
        } else {
            $session = User::where('id', Auth::user()->id)->first('selected_session')->selected_session;
            session()->put('sessionId', $session);

            return session()->get('sessionId');
        }
    }
}

if (!function_exists('timeZone')){
    function timeZone(){
       $time_zone_setup = session()->get('time_zone_setup');
        if(is_null($time_zone_setup)){
            $time_zone = SmGeneralSettings::join('sm_time_zones','sm_time_zones.id','=','sm_general_settings.time_zone_id')
            ->where('school_id',1)->first('time_zone');
             session()->put('time_zone_setup', $time_zone);
            $time_zone_setup = session()->get('time_zone_setup');
        }
        return $time_zone_setup->time_zone;
    }
}
if (!function_exists('schoolTimeZone')){
    function schoolTimeZone(){
       $time_zone_setup = session()->get('time_zone_setup');
        if(is_null($time_zone_setup)){
            $time_zone = SmGeneralSettings::join('sm_time_zones','sm_time_zones.id','=','sm_general_settings.time_zone_id')
            ->where('school_id',Auth::user()->school_id)->first('time_zone');
             session()->put('time_zone_setup', $time_zone);
            $time_zone_setup = session()->get('time_zone_setup');
        }
        return $time_zone_setup->time_zone;
    }
}

if (!function_exists('getUserLanguage')){
    function getUserLanguage(){
         if (Auth::check()) {
           return userLanguage();
        }else{
            $user=User::where('role_id',1)->first();
           return $user->language;
        }
    }
}

if (!function_exists('checkAdmin')) {
    function checkAdmin()
    {
        if (Auth::check()) {
            if (Auth::user()->is_administrator == "yes") {
                return true;
            } elseif (Auth::user()->is_saas == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('send_mail')) {
    function send_mail($reciver_email, $receiver_name, $subject, $view, $compact = [])
    {
        if(Auth::check()){
            $setting = SmEmailSetting::where('school_id',Auth::user()->school_id)->where('active_status',1)->first();  
        }
        else{
            $setting = SmEmailSetting::where('active_status',1)->first();  
        }
        
        $sender_email = $setting->from_email;
        $sender_name = $setting->from_name;
        $email_driver = $setting->mail_driver;
        
        try {
            if ($email_driver == "smtp") {

                if (Schema::hasTable('sm_email_settings')) {
                    $config = Auth::check() ? DB::table('sm_email_settings')
                            ->where('school_id',Auth::user()->school_id)
                            ->where('mail_driver','smtp')
                            ->first() 
                            : 
                            DB::table('sm_email_settings')
                            ->where('mail_driver','smtp')
                            ->first();

                    if ($config) 
                    {
                        Config::set('mail.driver', $config->mail_driver);
                        Config::set('mail.from', $config->mail_username);
                        Config::set('mail.name', $config->from_name);
                        Config::set('mail.host', $config->mail_host);
                        Config::set('mail.port', $config->mail_port);
                        Config::set('mail.username', $config->mail_username);
                        Config::set('mail.password', $config->mail_password);
                        Config::set('mail.encryption', $config->mail_encryption);
                    }
                
                    
            }
                Mail::send($view, $compact, function ($message) use ($reciver_email, $receiver_name, $sender_name, $sender_email, $subject) {
                    $message->to($reciver_email, $receiver_name)->subject($subject);
                    $message->from($sender_email, $sender_name);
                });
            }
            if ($email_driver == "php") {
                $message = (string)view($view, $compact);
                $headers = "From: <$sender_email> \r\n";
                $headers .= "Reply-To: $receiver_name <$reciver_email> \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\r\n";
                @mail($reciver_email, $subject, $message, $headers);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}


// Get File Path From HELPER

if (!function_exists('getFilePath3')) {
    function getFilePath3($data)
    {
        if ($data) {
            $name = explode('/', $data);
            if ($name[3]) {
                return $name[3];
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}

if (!function_exists('getFilePath4')) {
    function getFilePath4($data)
    {
        if ($data) {
            $name = explode('/', $data);
            if ($name[4]) {
                return $name[3];
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}

if (!function_exists('showPicName')) {
    function showPicName($data)
    {
        if ($data) {
            $name = explode('/', $data);
            if ($name[4]) {
                return $name[4];
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}

if (!function_exists('showJoiningLetter')) {
    function showJoiningLetter($data)
    {
        $name = explode('/', $data);
        return $name[3];
    }
}

if (!function_exists('showResume')) {
    function showResume($data)
    {
        $name = explode('/', $data);
        return $name[3];
    }
}

if (!function_exists('showDocument')) {
    function showDocument($data)
    {
        @$name = explode('/', @$data);
        if (!empty(@$name[4])) {

            return $name[4];
        } else {
            return '';
        }
    }
}
// end get file path from helpers


if (!function_exists('termResult')) {
    function termResult($exam_id, $class_id, $section_id, $student_id, $subject_count)
    {
        try {
            $assigned_subject = SmAssignSubject::where('class_id', $class_id)->where('section_id', $section_id)->get();
            $mark_store = DB::table('sm_mark_stores')->where([['class_id', $class_id], ['section_id', $section_id], ['exam_term_id', $exam_id], ['student_id', $student_id]])->first();
            $subject_marks = [];
            $subject_gpas = [];
            foreach ($assigned_subject as $subject) {
                $subject_mark = DB::table('sm_mark_stores')->where([['class_id', $class_id], ['section_id', $section_id], ['exam_term_id', $exam_id], ['student_id', $student_id], ['subject_id', $subject->subject_id]])->first();
                $custom_result = new CustomResultSetting;  // correct

                $subject_gpa = $custom_result->getGpa($subject_mark->total_marks);
                // return $subject_mark;
                $subject_marks[$subject->subject_id][0] = $subject_mark->total_marks;
                $subject_marks[$subject->subject_id][1] = $subject_gpa;
                $subject_gpas[$subject->subject_id] = $subject_gpa;
            }
            $total_gpa = array_sum($subject_gpas);
            $term_result = $total_gpa / $subject_count;
            return $term_result;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('getFinalResult')) {
    function getFinalResult($exam_id, $class_id, $section_id, $student_id, $percentage)
    {
        try {
            $system_setting = SmGeneralSettings::find(1);
            $system_setting = $system_setting->session_id;
            $custom_result_setup = CustomResultSetting::where('academic_year', $system_setting)->first();

            $assigned_subject = SmAssignSubject::where('class_id', $class_id)->where('section_id', $section_id)->get();

            $all_subjects_gpa = [];
            foreach ($assigned_subject as $subject) {
                $custom_result = new CustomResultSetting;
                $subject_gpa = $custom_result->getSubjectGpa($exam_id, $class_id, $section_id, $student_id, $subject->subject_id);
                $all_subjects_gpa[] = $subject_gpa[$subject->subject_id][1];
            }
            $percentage = $custom_result_setup->$percentage;
            $term_gpa = array_sum($all_subjects_gpa) / $assigned_subject->count();;
            $percentage = number_format((float)$percentage, 2, '.', '');
            $new_width = ($percentage / 100) * $term_gpa;
            return $new_width;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('getSubjectGpa')) {
    function getSubjectGpa($class_id, $section_id, $exam_id, $student_id, $subject)
    {
        try {
            $subject_marks = [];
            $subject_mark = DB::table('sm_mark_stores')->where('student_id', $student_id)->where('exam_term_id', '=', $exam_id)->first();

            $custom_result = new CustomResultSetting;
            $subject_gpa = $custom_result->getGpa($subject_mark->total_marks);

            $subject_marks[$subject][0] = $subject_mark->total_marks;
            $subject_marks[$subject][1] = $subject_gpa;

            // return $subject_mark->total_marks;
            return $subject_marks;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('getGrade')) {
    function getGrade($marks)
    {
        try {
            $marks_gpa = DB::table('sm_marks_grades')->where('percent_from', '<=', $marks)->where('percent_upto', '>=', $marks)
                ->where('academic_id', getAcademicId())->first();
            return $marks_gpa->grade_name;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('getNumberOfPart')) {
    function getNumberOfPart($subject_id, $class_id, $section_id, $exam_term_id)
    {
        try {
            $results = SmExamSetup::where([
                ['class_id', $class_id],
                ['subject_id', $subject_id],
                ['section_id', $section_id],
                ['exam_term_id', $exam_term_id],
            ])->get();
            return $results;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('GetResultBySubjectId')) {
    function GetResultBySubjectId($class_id, $section_id, $subject_id, $exam_id, $student_id)
    {

        try {
            $data = SmMarkStore::where([
                ['class_id', $class_id],
                ['section_id', $section_id],
                ['exam_term_id', $exam_id],
                ['student_id', $student_id],
                ['subject_id', $subject_id]
            ])->get();
            return $data;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('GetFinalResultBySubjectId')) {
    function GetFinalResultBySubjectId($class_id, $section_id, $subject_id, $exam_id, $student_id)
    {

        try {
            $data = SmResultStore::where([
                ['class_id', $class_id],
                ['section_id', $section_id],
                ['exam_type_id', $exam_id],
                ['student_id', $student_id],
                ['subject_id', $subject_id]
            ])->first();

            return $data;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('markGpa')) {
    function markGpa($marks)
    {
        $mark = SmMarksGrade::where([['percent_from', '<=', floor($marks)], ['percent_upto', '>=', floor($marks)]])->where('school_id',Auth::user()->school_id)->where('academic_id', getAcademicId())->first();
        if ($mark)
            return $mark;
        else
            return '';
    }
}
if (!function_exists('getGrade')) {
    function getGrade($grade)
    {
        $mark = SmMarksGrade::where('from', '<=', $grade)->where('up', '>=', $grade)->where('academic_id', getAcademicId())->first();
        if ($mark)
            return $mark;
        else
            return '';
    }
}

if (!function_exists('is_optional_subject')) {
    function is_optional_subject($student_id, $subject_id)
    {
        try {
            $result = SmOptionalSubjectAssign::where('student_id', $student_id)->where('subject_id', $subject_id)->first();
            if ($result) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (\Exception $e) {
            return FALSE;
        }
    }
}

if (!function_exists('getMarksOfPart')) {
    function getMarksOfPart($student_id, $subject_id, $class_id, $section_id, $exam_term_id)
    {
        try {
            $results = SmMarkStore::where([
                ['student_id', $student_id],
                ['class_id', $class_id],
                ['subject_id', $subject_id],
                ['section_id', $section_id],
                ['exam_term_id', $exam_term_id],
            ])->get();
            return $results;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}

if (!function_exists('getExamResult')) {
    function getExamResult($exam_id, $student)
    {
        $eligible_subjects = SmAssignSubject::where('class_id', $student->class_id)->where('section_id', $student->section_id)->where('academic_id', getAcademicId())
            ->where('school_id', Auth::user()->school_id)->get();

        foreach ($eligible_subjects as $subject) {

            $getMark = SmResultStore::where([
                ['exam_type_id', $exam_id],
                ['class_id', $student->class_id],
                ['section_id', $student->section_id],
                ['student_id', $student->id],
                ['subject_id', $subject->subject_id]
            ])->first();

            if ($getMark == "") {
                return false;
            }


            $result = SmResultStore::where([
                ['exam_type_id', $exam_id],
                ['class_id', $student->class_id],
                ['section_id', $student->section_id],
                ['student_id', $student->id]
            ])->get();

            return $result;
        }
    }
}

if (!function_exists('teacherAssignedClass')) {
    function teacherAssignedClass()
    {
        try {
            $class_id = [];
            $role_id = Auth::user()->role_id;
            if ($role_id == 4) {
                $classes = SmClassTeacher::where('teacher_id', Auth::user()->id)->get(['id']);
                foreach ($classes as $class) {
                    $class_id[] = $class->module_id;
                }
            } else {

                $general_setting = SmGeneralSettings::find(1);
                return @$general_setting->school_name;
            }
        } catch (\Exception $e) {
            return $class_id = [];
        }
    }
}

if (!function_exists('getValueByStringTestRegistration')) {
    function getValueByStringTestRegistration($data, $str)
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
}
if (!function_exists('getValueByStringTestReset')) {
    function getValueByStringTestReset($data, $str)
    {
        if ($str == 'school_name') {

            $general_setting = SmGeneralSettings::find(1);
            return @$general_setting->school_name;
        } elseif ($str == 'name') {
            $user = User::where('email', $data['email'])->first();
            return @$user->full_name;
        }
    }
}

if (!function_exists('subjectPosition')) {
    function subjectPosition($subject_id, $class_id, $custom_result)
    {

        $students = SmStudent::where('class_id', $class_id)->get();

        $subject_mark_array = [];
        foreach ($students as $student) {
            $subject_marks = 0;

            $first_exam_mark = SmMarkStore::where('student_id', $student->id)->where('class_id', $class_id)->where('subject_id', $subject_id)->where('exam_term_id', $custom_result->exam_term_id1)->sum('total_marks');

            $subject_marks = $subject_marks + $first_exam_mark / 100 * $custom_result->percentage1;

            $second_exam_mark = SmMarkStore::where('student_id', $student->id)->where('class_id', $class_id)->where('subject_id', $subject_id)->where('exam_term_id', $custom_result->exam_term_id2)->sum('total_marks');

            $subject_marks = $subject_marks + $second_exam_mark / 100 * $custom_result->percentage2;

            $third_exam_mark = SmMarkStore::where('student_id', $student->id)->where('class_id', $class_id)->where('subject_id', $subject_id)->where('exam_term_id', $custom_result->exam_term_id3)->sum('total_marks');

            $subject_marks = $subject_marks + $third_exam_mark / 100 * $custom_result->percentage3;

            $subject_mark_array[] = round($subject_marks);


        }

        arsort($subject_mark_array);

        $position_array = [];
        foreach ($subject_mark_array as $position_mark) {
            $position_array[] = $position_mark;
        }


        return $position_array;

    }
}

if (!function_exists('getValueByStringDuesFees')) {
    function getValueByStringDuesFees($student_detail, $str, $fees_info)
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
}
if (!function_exists('assignedRoutineSubject')) {

    function assignedRoutineSubject($class_id, $section_id, $exam_id, $subject_id)
    {

        try {
            return SmExamSchedule::where('class_id', $class_id)->where('section_id', $section_id)->where('exam_term_id', $exam_id)->where('subject_id', $subject_id)->first();
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }

}

if (!function_exists('assignedRoutine')) {

    function assignedRoutine($class_id, $section_id, $exam_id, $subject_id, $exam_period_id)
    {
        try {
            return SmExamSchedule::where('class_id', $class_id)->where('section_id', $section_id)->where('exam_term_id', $exam_id)->where('subject_id', $subject_id)
                ->where('exam_period_id', $exam_period_id)->first();
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }

}

if (!function_exists('is_absent_check')) {

    function is_absent_check($exam_id, $class_id, $section_id, $subject_id, $student_id)
    {
        try {
            $exam_attendance = SmExamAttendance::where('exam_id', $exam_id)->where('class_id', $class_id)->where('section_id', $section_id)->where('subject_id', $subject_id)->first();
            $exam_attendance_child = SmExamAttendanceChild::where('exam_attendance_id', $exam_attendance->id)->where('student_id', $student_id)->first();
            return $exam_attendance_child;
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }

}


if (!function_exists('feesPayment')) {
    function feesPayment($type_id, $student_id)
    {
        try {
            return SmFeesPayment::where('active_status',1)->where('fees_type_id', $type_id)->where('student_id', $student_id)->get();
        } catch (\Exception $e) {
            $data = [];
            return $data;
        }
    }
}



if (!function_exists('generalSetting')) {
    function generalSetting()
    {
        session()->forget('generalSetting');
        if (session()->has('generalSetting')) {
            return session()->get('generalSetting');
        } else {
            $generalSetting = Auth::check() ? SmGeneralSettings::where('school_id',Auth::user()->school_id)->first() : SmGeneralSettings::first() ;
            session()->put('generalSetting', $generalSetting);

            return session()->get('generalSetting');
        }
    }
}

if (!function_exists('activeStyle')) {
    function activeStyle()
    {
        if (session()->has('active_style')) {
            $active_style = session()->get('active_style');
            return $active_style;
        } else {
            $active_style = Auth::check() ? SmStyle::where('school_id', Auth::user()->school_id)->where('id', Auth::user()->style_id)->first() :
                SmStyle::where('school_id', 1)->where('is_active', 1)->first();
            session()->put('active_style', $active_style);
            return session()->get('active_style');
        }
    }
}

if (!function_exists('systemDateFormat')){
    function systemDateFormat(){
        if (session()->has('system_date_format')) {
            return session()->get('system_date_format');
        } else {
            $system_date_format = SmDateFormat::find(DB::table('sm_general_settings')->first()->date_format_id);
            session()->put('system_date_foramt', $system_date_format);

            return session()->get('system_date_foramt');
        }
    }
}
if (!function_exists('emailTemplate')){
    function emailTemplate(){
        if (session()->has('email_template')) {
            return session()->get('email_template');
        } else {
            $email_template = SmsTemplate::where('id', 1)->first();
            session()->put('email_template', $email_template);

            return session()->get('email_template');
        }
    }
}

if (!function_exists('dashboardBackground')){
    function dashboardBackground(){
        return app('dashboard_bg');
    }
}

if (!function_exists('allStyles')){
    function allStyles(){
       
        if (session()->has('all_styles')) {
            return session()->get('all_styles');
        } else {
            $all_styles = SmStyle::where('school_id', 1)->where('active_status', 1)->get() ;
            session()->put('all_styles', $all_styles);

            return session()->get('all_styles');
        }
    }
}

if (!function_exists('textDirection')){
    function textDirection(){
       
        if (session()->has('text_direction')) {
            return session()->get('text_direction');
        } else {
            $ttl_rtl = User::where('id', Auth::user()->id)->first('rtl_ltl')->rtl_ltl;
            session()->put('text_direction', $ttl_rtl);
// return $ttl_rtl;
            return session()->get('text_direction');
        }
    }
}
if (!function_exists('userRtlLtl')){
    function userRtlLtl(){
        if (session()->has('user_text_direction')) {
            return session()->get('user_text_direction');
        } else {
            $ttl_rtl = User::where('id', Auth::user()->id)->first('rtl_ltl')->rtl_ltl;
            session()->put('user_text_direction', $ttl_rtl);
// return $ttl_rtl;
            return session()->get('user_text_direction');
        }
    }
}
if (!function_exists('userLanguage')){
    function userLanguage(){
       
        if (session()->has('user_language')) {
            return session()->get('user_language');
        } else {
            $language = User::where('id', Auth::user()->id)->first('language')->language;
            session()->put('user_language', $language);

            return session()->get('user_language');
        }
    }
}


if (!function_exists('schoolConfig')){
    function schoolConfig(){
        return app('school_info');
    }
}
if (!function_exists('selectedLanguage')){
    function selectedLanguage(){
        if (session()->has('selected_language')) {
            return session()->get('selected_language');
        } else {
            $selected_language = Auth::check() ? SmGeneralSettings::where('school_id', Auth::user()->school_id)->first() :
                DB::table('sm_general_settings')->where('school_id', 1)->first();
            session()->put('selected_language', $selected_language);

            return session()->get('selected_language');
        }
    }
}

if (!function_exists('profile')){
    function profile(){
        if (session()->has('profile')) {
            return session()->get('profile');
        } else {
            if(Auth::user()->role_id == 2){
                $profile =  SmStudent::where('user_id', Auth::id())->first('student_photo');
                session()->put('profile', @$profile->student_photo);
                
            }else if(Auth::user()->role_id == 3){
                $profile =  SmParent::where('user_id', Auth::id())->first('guardians_photo');
                session()->put('profile', @$profile->guardians_photo);
                
            }
            else{
                $profile = SmStaff::where('user_id', Auth::id())->first('staff_photo');    
                session()->put('profile', @$profile->staff_photo);
            }
            

            return session()->get('profile');
        }
    }
}

if (!function_exists('getSession')){
    function getSession(){
        if (session()->has('session')) {
            return session()->get('session');
        } else {
            $selected_language = Auth::check() ? SmGeneralSettings::where('school_id', Auth::user()->school_id)->first() :
                DB::table('sm_general_settings')->where('school_id', 1)->first();
            $session = DB::table('sm_academic_years')->where('id', $selected_language->session_id)->first();
            session()->put('session', $session);

            return session()->get('session');
        }
    }
}

if (!function_exists('systemLanguage')){
    function systemLanguage(){
        if (session()->has('systemLanguage')) {
            
            return session()->get('systemLanguage');
        } else {

            $systemLanguage = SmLanguage::where('school_id',auth()->user()->school_id)->get();
            session()->put('systemLanguage',$systemLanguage);
            return session()->get('systemLanguage');
        }
    }
}

if (!function_exists('academicYears')){
    function academicYears(){
        if (session()->has('academic_years')) {
            return session()->get('academic_years');
        } else {
            $academic_years = Auth::check() ? SmAcademicYear::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get() : '';
            session()->put('academic_years',$academic_years);
            return session()->get('academic_years');
        }
    }
}


if (!function_exists('subjectFullMark')){
    function subjectFullMark($examtype, $subject){
        try{
            $full_mark = 0;
            $full_mark = SmExam::where('school_id',Auth::user()->school_id)->where('academic_id',getAcademicId())->where('exam_type_id', $examtype)->where('subject_id',$subject)->first('exam_mark')->exam_mark;
            return $full_mark;
        }
        catch (\Exception $e) {
            return '' ;
        }

    }
}


if (!function_exists('teacherAccess')){
    function teacherAccess(){
        try{
            $user = Auth::user();
            if($user->role_id == 4){
                return true;
            }
            else{
                return false;
            }
        }
        catch (\Exception $e) {
            return false;
        }
    }
}



if (!function_exists('subjectPercentageMark')){
    function subjectPercentageMark($obtained_mark,$full_nark){
        try{
            $percent = ($obtained_mark / $full_nark) * 100;
            return $percent;
        }
        catch (\Exception $e) {
            return false;
        }
    }
}

if(!function_exists('termWiseFullMark')){
    function termWiseFullMark($type_ids, $student_id){
        try{
                $average_gpa=0;
                foreach($type_ids as $type_id){
                $total_gpa = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->sum('total_gpa_point');

                $total_subject = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->count('subject_id');
                
                $percentage=CustomResultSetting::where('exam_type_id',$type_id)
                        ->where('academic_id',getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->first('exam_percentage')->exam_percentage;
                
                $average_gpa+=($total_gpa/$total_subject)*($percentage/100);
                }
                return $average_gpa;
        }catch (\Exception $e) {
            return false;
        }
    }
}
if(!function_exists('termWiseGpa')){
    function termWiseGpa($type_id, $student_id, $with_optional_subject_mark=null){
        try{
            $average_gpa= 0;
            if($with_optional_subject_mark==null){
                $total_gpa = SmResultStore::select('total_gpa_point')->where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->sum('total_gpa_point');
    
                $total_subject = SmResultStore::select('subject_id')->where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->count('subject_id');
                
                $percentage = CustomResultSetting::where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->first('exam_percentage')->exam_percentage;
    
                $average_gpa += ($total_gpa/$total_subject)*($percentage/100);
                return $average_gpa;

            }elseif($with_optional_subject_mark!=null){

                $percentage = CustomResultSetting::where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->first('exam_percentage')->exam_percentage;
    
                $average_gpa += $with_optional_subject_mark*($percentage/100);
                return $average_gpa;

            }
        }catch (\Exception $e) {
            return false;
        }
    }
}

if(!function_exists('termWiseMark')){
    function termWiseTotalMark($type_id, $student_id, $optional_subject=null){
        try{
            if($optional_subject==null){
                $average_gpa=0;
                $total_gpa = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->sum('total_gpa_point');
    
                $total_subject = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->count('subject_id');
                
                $average_gpa+=$total_gpa/$total_subject;
    
                return $average_gpa;

            }elseif($optional_subject!=null){
                $average_gpa=0;
                $optional_subject_extra_gpa=0;

                $class_id = SmStudent::find($student_id)->class_id;
                $optional_subject_above=SmClassOptionalSubject::where('class_id',$class_id)
                                ->where('school_id',Auth::user()->school_id)
                                ->where('academic_id',getAcademicId())
                                ->first('gpa_above')->gpa_above;


                $subject_ids = SmResultStore::where('student_id', $student_id)
                                    ->where('exam_type_id',$type_id)
                                    ->where('academic_id',getAcademicId())
                                    ->where('school_id',Auth::user()->school_id)
                                    ->get('subject_id');

                $optional_subject_id = SmOptionalSubjectAssign::whereIn('subject_id',$subject_ids)
                                    ->where('student_id',$student_id)
                                    ->where('academic_id',getAcademicId())
                                    ->where('school_id',Auth::user()->school_id)
                                    ->first('subject_id')->subject_id;

                $without_optional_subject_gpa = SmResultStore::where('student_id',$student_id)
                                        ->where('exam_type_id',$type_id)
                                        ->where('subject_id','!=',$optional_subject_id)
                                        ->where('academic_id',getAcademicId())
                                        ->where('school_id',Auth::user()->school_id)
                                        ->sum('total_gpa_point');


                $optional_subject_gpa = SmResultStore::where('student_id', $student_id)
                                    ->where('exam_type_id', $type_id)
                                    ->where('subject_id', $optional_subject_id)
                                    ->where('academic_id', getAcademicId())
                                    ->where('school_id', Auth::user()->school_id)
                                    ->sum('total_gpa_point');

                $maxgpa = SmMarksGrade::where('academic_id', getAcademicId())
                        ->where('school_id', Auth::user()->school_id)
                        ->max('gpa');
            
                if($optional_subject_gpa > $optional_subject_above){
                    $optional_subject_extra_gpa = $optional_subject_gpa - $optional_subject_above;
                }

                $with_optional_subject_extra_gpa = $without_optional_subject_gpa + $optional_subject_extra_gpa;

                $final_gpa_with_optional_subject = $with_optional_subject_extra_gpa / (count($subject_ids) - 1);

                if($maxgpa < $final_gpa_with_optional_subject){
                    return $maxgpa;

                }else{
                    return $final_gpa_with_optional_subject;
                }
        }

        }catch (\Exception $e) {
            return false;
        }
    }
}

if(!function_exists('optionalSubjectFullMark')){
    function optionalSubjectFullMark($type_id ,$student_id,$above_gpa, $purpose=NULL){
        try{
            $subject_ids = SmResultStore::where('student_id', $student_id)
                                ->where('exam_type_id',$type_id)
                                ->where('academic_id',getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->get('subject_id');

            $additional_subject_id = SmOptionalSubjectAssign::whereIn('subject_id',$subject_ids)
                                ->where('student_id',$student_id)
                                ->where('academic_id',getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->first('subject_id')->subject_id;
    
            if($purpose=="optional_sub_gpa"){
                $total_mark = SmResultStore::where('student_id', $student_id)
                                ->where('exam_type_id',$type_id)
                                ->where('subject_id', $additional_subject_id)
                                ->where('academic_id',getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->sum('total_gpa_point');

                                return $total_mark;

            }elseif($purpose=="with_optional_sub_gpa"){
                $total_mark = SmResultStore::where('student_id', $student_id)
                                ->where('exam_type_id',$type_id)
                                ->where('subject_id', $additional_subject_id)
                                ->where('academic_id',getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->sum('total_gpa_point');

                $exam_type_id = SmResultStore::where('student_id', $student_id)
                                ->where('exam_type_id',$type_id)
                                ->where('subject_id', $additional_subject_id)
                                ->where('academic_id',getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->count('exam_type_id');

                $total=($total_mark - $above_gpa)*$exam_type_id;
                return $total;
            }
        }catch (\Exception $e) {
            return false;
        }
    }
}

if(!function_exists('termWiseAddOptionalMark')){
    function termWiseAddOptionalMark($type_id ,$student_id, $above_gpa){
        try{
            $subject_ids = SmResultStore::where('student_id', $student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->get('subject_id');

            $additional_subject_id = SmOptionalSubjectAssign::whereIn('subject_id',$subject_ids)
                            ->where('student_id',$student_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->first('subject_id')->subject_id;

            $additional_subject_mark = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('subject_id',$additional_subject_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->sum('total_gpa_point');

            $additional_single_subject_mark = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('subject_id',$additional_subject_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->first('total_gpa_point')->total_gpa_point;

            $additional_mark_reduction= $additional_single_subject_mark-$above_gpa;
            if($additional_mark_reduction > 0){

                
            }
            $all_subject_mark = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('subject_id','!=',$additional_subject_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->sum('total_gpa_point');

            $without_additional_total_subject = SmResultStore::where('student_id',$student_id)
                            ->where('exam_type_id',$type_id)
                            ->where('subject_id','!=',$additional_subject_id)
                            ->where('academic_id',getAcademicId())
                            ->where('school_id',Auth::user()->school_id)
                            ->count('subject_id');

            $with_additional_full_gpa= $all_subject_mark + ($additional_subject_mark - $above_gpa);

            $percentage = CustomResultSetting::where('exam_type_id',$type_id)
                        ->where('academic_id',getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->first('exam_percentage')->exam_percentage;

            $with_additional_average_gpa = ($with_additional_full_gpa / $without_additional_total_subject) * ($percentage/100);

            return $with_additional_average_gpa;
                
        }catch (\Exception $e) {
            return false;
        }
    }
}

if(!function_exists('gradeName')){
    function gradeName($total_gpa){
        try{
            $grade_name = SmMarksGrade::where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->where('from', '<=', $total_gpa)
                        ->where('up', '>=', $total_gpa)
                        ->first('grade_name')->grade_name;
            return  $grade_name;
        }catch (\Exception $e) {
            return false;
        }
    }
}

if(!function_exists('remarks')){
    function remarks($total_gpa){
        try{
            $description = SmMarksGrade::where('academic_id', getAcademicId())
                        ->where('school_id',Auth::user()->school_id)
                        ->where('from', '<=', $total_gpa)
                        ->where('up', '>=', $total_gpa)
                        ->first('description')->description;
            return  $description;
        }catch (\Exception $e) {
            return false;
        }
    }
}

if(!function_exists('subjectHighestMark')){
    function subjectHighestMark($exam_id, $subject_id, $class_id, $section_id){
        try{
            $highest_mark = SmResultStore::where([['class_id', $class_id], ['exam_type_id', $exam_id], ['section_id', $section_id]])
                        ->where('subject_id', $subject_id)
                        ->where('school_id',Auth::user()->school_id)
                        ->where('academic_id',getAcademicId())
                        ->max('total_marks');
            return $highest_mark;
        }catch(\Throwable $e){
            return false;
        }
    }
}

if(!function_exists('getAllUserForChatBasedOnCondition')){
    function getAllUserForChatBasedOnCondition(){
        try{
            $users = User::with('roles')->where('id', '!=', auth()->id())->get();
            if (app('general_settings')->get('chat_can_teacher_chat_with_parents') == 'no'){
                if (auth()->user()->roles->id == 4){
                    foreach ($users as $index => $user){
                        $user->roles->id === 3 ? $users->forget($index) : '';
                    }
                }
            }
            return $users;
        }catch(Throwable $e){
            return false;
        }
    }
}

if(!function_exists('chatOpen')){
    function chatOpen(){
        return app('general_settings')->get('chat_open') == 'yes';
    }
}

// Jitsi Module Start
if (!function_exists('getDomainName')) {
    function getDomainName($url)
    {
        $url_domain = preg_replace("(^https?://)", "", $url);
        $url_domain = preg_replace("(^http?://)", "", $url_domain);
        $url_domain = str_replace("/", "", $url_domain);
        return $url_domain;

    }
}
// Jitsi Module End

if(!function_exists('invitationRequired')){
    function invitationRequired(){
        return app('general_settings')->get('chat_invitation_requirement') == 'required';
    }
}

if (!function_exists('intallMdouleMenu')) {
    function intallMdouleMenu($module_id,$module_name)
    {
        if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3 ){
            $menu_manage_module_id = MenuManage::where('active_status', 1)
                                ->where('user_id',Auth::user()->id)
                                ->where('role_id',Auth::user()->role_id)
                                ->where('module_id',$module_id)                              
                                ->first();

        }else{
            $menu_manage_module_id = MenuManage::where('active_status', 1)
                                ->where('user_id',Auth::user()->id)
                                ->where('role_id',Auth::user()->role_id)
                                ->where('module_addons',$module_id)                              
                                ->first();
        }
          if (moduleStatusCheck($module_name)== true && is_null($menu_manage_module_id) ){
                 return true;
          }else{
                  return  false;
          }
    }
}

if (!function_exists('paymentMethodName')) {
    function paymentMethodName($payment_method_id)
    {
        $paymentMethodName = SmPaymentMethhod::where('id',$payment_method_id)
                                    ->where('school_id', Auth::user()->school_id)
                                    ->first('method')->method;
          if ($paymentMethodName == "Bank"){
            return true;
          }else{
            return  false;
          }
    }
}

if (!function_exists('moduleVersion')) {
    function moduleVersion($module_name)
    {
        $dataPath = 'Modules/' . $module_name . '/' . $module_name . '.json';  
        $strJsonFileContents = file_get_contents($dataPath);
        $array = json_decode($strJsonFileContents, true);
        $version = $array[$module_name]['versions'][0];
        return $version;
    }
}


if(!function_exists('menuPosition')){
    function menuPosition($id){  

      $is_have=SidebarNew::where('user_id',Auth::user()->id)
        ->where('role_id',Auth::user()->role_id)->first();

       if($id=='is_submit'){
            return  $default=$is_have ? 1 : 0 ;
       }

    if($is_have){
            $sidebar = SidebarNew::where('active_status', 1)
                                ->where('user_id',Auth::user()->id)
                                ->where('role_id',Auth::user()->role_id)
                                ->where('infix_module_id',$id)                              
                                ->first();

         return    $position =  $sidebar ? $sidebar->parent_position_no : $id;  
    }else{
        return false;
    }
     
      
    }
}

if(!function_exists('menuStatus')){
    function menuStatus($id){
        $is_have=SidebarNew::where('user_id',Auth::user()->id)
        ->where('role_id',Auth::user()->role_id)->first();
        if(($is_have)){
            $is_have_id = SidebarNew::roleUser()->where('infix_module_id',$id)->first();
            if( $is_have_id){
               return   $status=$is_have_id->active_status==1 ? true : false ;                               
         } else{                 
            return   $status = auth()->user()->role_id==1 ? true : userPermission($id) ;       
               
            }
        }
        return true;
    }
}

if (!function_exists('customFieldValue')) {
    function customFieldValue($id,$labelName,$formName)
    {
        $custom_field_values=[];
        if($formName == "student_registration"){
            $custom_field_data = SmStudent::where('id',$id)->first();
            $value = $custom_field_data->custom_field;
        }elseif($formName == "staff_registration"){
            $custom_field_data = SmStaff::where('id',$id)->first();
            $value = $custom_field_data->custom_field;
        }else{
            $value = Null;
        }

        if($value != NULL){
            $custom_field_values = json_decode($custom_field_data->custom_field,true);
            if (is_array($custom_field_values) && array_key_exists($labelName, $custom_field_values)) {
                return $custom_field_values[$labelName];
            }else{
                return NUll;
            }
        }
    }
}


