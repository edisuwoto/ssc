<?php

namespace App\Http\Controllers;

use Mail;
use Twilio;
use App\Role;
use App\User;
use App\SmClass;
use App\SmStaff;
use App\SmParent;
use App\SmStudent;
use App\YearCheck;
use Carbon\Carbon;
use Clickatell\Rest;
use App\SmSmsGateway;
use App\ApiBaseMethod;
use App\SmEmailSmsLog;
use App\SmNoticeBoard;
use App\SmEmailSetting;
use App\SmNotification;
use App\Jobs\SendEmailJob;
use App\SmGeneralSettings;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;

use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Notification;
use App\Notifications\CommunicateNotification;
use Modules\RolePermission\Entities\InfixRole;
use Modules\Saas\Entities\SmAdministratorNotice;



class SmCommunicateController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    public function sendMessage(Request $request)
    {

        try {
            $roles = InfixRole::where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($roles, null);
            }
            return view('backEnd.communicate.sendMessage', compact('roles'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function saveNoticeData(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'notice_title' => "required|max:50",
                'notice_date' => "required",
                'publish_on' => "required",
                'login_id' => "required",
            ]);
        } else {
            $validator = Validator::make($input, [
                'notice_title' => "required|max:50",
                'notice_date' => "required",
                'publish_on' => "required",
            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $roles_array = array();
            if (empty($request->role)) {
                $roles_array = '';
            } else {
                $roles_array = implode(',', $request->role);
            }

            $user = Auth()->user();

            if ($user) {
                $login_id = $user->id;
            } else {
                $login_id = $request->login_id;
            }

            $noticeData = new SmNoticeBoard();
            if (isset($request->is_published)) {
                $noticeData->is_published = $request->is_published;
            }
            $noticeData->notice_title = $request->notice_title;
            $noticeData->notice_message = $request->notice_message;

            $noticeData->notice_date = date('Y-m-d', strtotime($request->notice_date));
            $noticeData->publish_on = date('Y-m-d', strtotime($request->publish_on));

            // $noticeData->notice_date = Carbon::createFromFormat('m/d/Y', $request->notice_date)->format('Y-m-d');
            // $noticeData->publish_on = Carbon::createFromFormat('m/d/Y', $request->publish_on)->format('Y-m-d');

            $noticeData->inform_to = $roles_array;
            $noticeData->created_by = $login_id;
            $noticeData->school_id = Auth::user()->school_id;
            $noticeData->academic_id = getAcademicId();
            $results = $noticeData->save();


            if ($request->role != null) {

                foreach ($request->role as $key => $role) {


                    $users = User::where('role_id', $role)->where('active_status', 1)->get();
                    // return $users;
                    foreach ($users as $key => $user) {
                        $notification = new SmNotification();
                        $notification->role_id = $role;
                        $notification->message = "Notice for you";
                        $notification->date = $noticeData->notice_date;
                        $notification->user_id = $user->id;
                        $notification->url = "notice-list";
                        $notification->school_id = Auth::user()->school_id;
                        $notification->academic_id = getAcademicId();
                        $notification->save();
                    }


                }
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($results) {
                    return ApiBaseMethod::sendResponse(null, 'Class Room has been created successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($results) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('notice-list');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function noticeList(Request $request)
    {
        try {
            $allNotices = SmNoticeBoard::where('active_status', 1)
                ->orderBy('id', 'DESC')
                ->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($allNotices, null);
            }
            return view('backEnd.communicate.noticeList', compact('allNotices'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function administratorNotice(Request $request)
    {
        try {

            $allNotices = SmAdministratorNotice::where('inform_to', Auth::user()->school_id)
                ->where('active_status', 1)
                // ->where('academic_id', getAcademicId())
                ->get();
            // return $allNotices;
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($allNotices, null);
            }
            return view('backEnd.communicate.administratorNotice', compact('allNotices'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function editNotice(Request $request, $notice_id)
    {

        try {
            $roles = InfixRole::where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            // $noticeDataDetails = SmNoticeBoard::find($notice_id);
             if (checkAdmin()) {
                $noticeDataDetails = SmNoticeBoard::find($notice_id);
            }else{
                $noticeDataDetails = SmNoticeBoard::where('id',$notice_id)->where('school_id',Auth::user()->school_id)->first();
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['roles'] = $roles->toArray();
                $data['noticeDataDetails'] = $noticeDataDetails->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.communicate.editSendMessage', compact('noticeDataDetails', 'roles'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updateNoticeData(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'notice_title' => "required|max:50",
                'notice_date' => "required",
                'publish_on' => "required",
                'login_id' => "required",
            ]);
        } else {
            $validator = Validator::make($input, [
                'notice_title' => "required|max:50",
                'notice_date' => "required",
                'publish_on' => "required",
            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $roles_array = array();
            if (empty($request->role)) {
                $roles_array = '';
            } else {
                $roles_array = implode(',', $request->role);
            }
            $user = Auth()->user();

            if ($user) {
                $login_id = $user->id;
            } else {
                $login_id = $request->login_id;
            }
             if (checkAdmin()) {
                $noticeData = SmNoticeBoard::find($request->notice_id);
            }else{
                $noticeData = SmNoticeBoard::where('id',$request->notice_id)->where('school_id',Auth::user()->school_id)->first();
            }
            if (isset($request->is_published)) {
                $noticeData->is_published = $request->is_published;
            }
            $noticeData->notice_title = $request->notice_title;
            $noticeData->notice_message = $request->notice_message;

            $noticeData->notice_date = date('Y-m-d', strtotime($request->notice_date));
            $noticeData->publish_on = date('Y-m-d', strtotime($request->publish_on));
            $noticeData->notice_date = Carbon::createFromFormat('m/d/Y', $request->notice_date)->format('Y-m-d');
            $noticeData->publish_on = Carbon::createFromFormat('m/d/Y', $request->publish_on)->format('Y-m-d');
            $noticeData->inform_to = $roles_array;
            $noticeData->updated_by = $login_id;
            if ($request->is_published) {
               $noticeData->is_published = 1;
            } else {
               $noticeData->is_published = 0;
            }
            
            $results = $noticeData->update();

            if ($request->role != null) {

                foreach ($request->role as $key => $role) {
                    $users = User::where('role_id', $role)->get();
                    foreach ($users as $key => $user) {
                        $notification = new SmNotification();
                        $notification->role_id = $role;
                        $notification->message = $request->notice_title;
                        $notification->date = $noticeData->notice_date;
                        $notification->user_id = $user->id;
                        $notification->url = "notice-list";
                        $notification->school_id = Auth::user()->school_id;
                        $notification->academic_id = getAcademicId();
                        $notification->save();
                    }
                }
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($results) {
                    return ApiBaseMethod::sendResponse(null, 'Notice has been updated successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again');
                }
            } else {
                if ($results) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('notice-list');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteNoticeView(Request $request, $id)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($id, null);
            }
            return view('backEnd.communicate.deleteNoticeView', compact('id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteNotice(Request $request, $id)
    {
        try {
             if (checkAdmin()) {
                $result = SmNoticeBoard::destroy($id);
            }else{
                $result = SmNoticeBoard::where('id',$id)->where('school_id',Auth::user()->school_id)->delete();
            }
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {
                    return ApiBaseMethod::sendResponse(null, 'Notice has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function sendEmailSmsView(Request $request)
    {
        try {
            $roles = InfixRole::select('*')->where('id', '!=', 1)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            $classes = SmClass::where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['roles'] = $roles->toArray();
                $data['classes'] = $classes->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }

            return view('backEnd.communicate.sendEmailSms', compact('roles', 'classes'));
        } catch (\Exception $e) {
           
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title)
    { 
        try{
            $receiver_name =  $to_name;
            $subject= $data['email_sms_title'];
            $view ="backEnd.emails.mail";
            $compact['data'] =  array('description' =>$data['description'] , 'title'=> $data['email_sms_title']);
            foreach($to_email as $reciverEmail){
                send_mail($reciverEmail, $receiver_name, $subject , $view, $compact);
            }

            // Toastr::success('Operation Successfull', 'Success');
            return redirect()->back();
        }catch (\Exception $e) {
                Log::info($e->getMessage());
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }


    }


    public function sendSMSFromComunicate($to_mobile, $sms,$title)
    {
        $activeSmsGateway = SmSmsGateway::where('active_status', '=', 1)->where('school_id', Auth::user()->school_id)->first();
        if (empty($activeSmsGateway)) {
            Toastr::error('Please active a SMS gateway', 'Failed');
            return redirect()->back();
        }
        if ($activeSmsGateway->gateway_name == 'Twilio') {
            // this is for school wise sms setting in saas.
            config(['TWILIO.SID' => $activeSmsGateway->twilio_account_sid]);
            config(['TWILIO.TOKEN' => $activeSmsGateway->twilio_authentication_token]);
            config(['TWILIO.FROM' => $activeSmsGateway->twilio_registered_no]);


            $account_id         = $activeSmsGateway->twilio_account_sid; // Your Account SID from www.twilio.com/console
            $auth_token         = $activeSmsGateway->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
            $from_phone_number  = $activeSmsGateway->twilio_registered_no;


            $client = new Twilio\Rest\Client($account_id, $auth_token);


            if (!empty($to_mobile)) {
                $result = $message = $client->messages->create($to_mobile, array('from' => $from_phone_number, 'body' => $sms));
            }
        } //end Twilio

        else if ($activeSmsGateway->gateway_name == 'Himalayasms') {
                                $client = new HttpClient();
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
                                elseif($activeSmsGateway->gateway_name == 'Mobile SMS'){
            if ($to_mobile) {
                try{
                    $user=User::find(Auth::user()->id);
                    $notification_data=[];
                    $notification_data['title']=$title;
                    $notification_data['body']=$sms;
                    $notification_data['phone_number']=$to_mobile;
                    $notification_data['deviceID']=$user->device_token;
                    Notification::send($user, new CommunicateNotification($notification_data));
                    $result=$notification_data;
                    // Log::info($notification_data);
                }catch (\Exception $e) {
                    Log::info($e->getMessage());
                }
            } else {
                Log::info('Mobile number not found');
            }
            
            
        }
        elseif ($activeSmsGateway->gateway_name == 'Clickatell') {
            // config(['clickatell.api_key' => $activeSmsGateway->clickatell_api_id]); //set a variale in config file(clickatell.php)

            $clickatell = new \Clickatell\Rest();

            $result = $clickatell->sendMessage(['to' => $to_mobile,  'content' => $sms]);
        } //end Clickatell
        elseif ($activeSmsGateway->gateway_name == 'Msg91') {
            $msg91_authentication_key_sid = $activeSmsGateway->msg91_authentication_key_sid;
            $msg91_sender_id = $activeSmsGateway->msg91_sender_id;
            $msg91_route = $activeSmsGateway->msg91_route;
            $msg91_country_code = $activeSmsGateway->msg91_country_code;

            $curl = curl_init();

            $url = "https://api.msg91.com/api/sendhttp.php?mobiles=" . $to_mobile . "&authkey=" . $msg91_authentication_key_sid . "&route=" . $msg91_route . "&sender=" . $msg91_sender_id . "&message=" . $sms . "&country=". $msg91_country_code;
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
        elseif ($activeSmsGateway->gateway_name == 'AfricaTalking') {
            $username = $activeSmsGateway->africatalking_username; // use 'sandbox' for development in the test environment
            $apiKey   = $activeSmsGateway->africatalking_api_key; // use your sandbox app API key for development in the test environment
            $AT       = new AfricasTalking($username, $apiKey);

            // Get one of the services
            $sms_Send      = $AT->sms();
            // $to_mobile = implode(',', $to_mobile);

            // Use the service
            $result   = $sms_Send->send([
                'to'      => $to_mobile,
                'message' => $sms
            ]);
        }
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

        return $result;
    }

    public function sendEmailSms(Request $request)
    {
       
        $request->validate([
            'email_sms_title' => "required",
            'send_through' => "required",
            'description' => "required",
        ]);

        try {
        $email_sms_title = $request->email_sms_title;
        // save data in email sms log
        $saveEmailSmsLogData = new SmEmailSmsLog();
        $saveEmailSmsLogData->saveEmailSmsLogData($request);
        if (empty($request->selectTab) or $request->selectTab == 'G') {
            if (empty($request->role)) {
                Toastr::error('Please select whom you want to send', 'Failed');
                return redirect()->back();
            } else {
                if ($request->send_through == 'E') {
                    $email_sms_title = $request->email_sms_title;
                    $description = $request->description;
                    $message_to = implode(',', $request->role);

                    $to_name = '';
                    $to_email = [];
                    $to_mobile = [];
                    $receiverDetails = '';

                    foreach ($request->role as $role_id) {

                        if ($role_id == 2) {
                            $receiverDetails = SmStudent::select('email', 'full_name', 'mobile')->where('active_status', 1)->where('academic_id', getAcademicId())->get();
                        } elseif ($role_id == 3) {
                            $receiverDetails = SmParent::select('guardians_email as email', 'fathers_name as full_name', 'fathers_mobile as mobile')->where('academic_id', getAcademicId())->get();
                        } else {
                            $receiverDetails = SmStaff::select('email', 'full_name', 'mobile')->where('role_id', $role_id)->where('active_status', 1)->get();
                        }


                        foreach ($receiverDetails as $receiverDetail) {
                            $to_name    = $receiverDetail->full_name;
                            $to_email[]   = $receiverDetail->email;
                            $to_mobile[]  = $receiverDetail->mobile;
                            // send dynamic content in $data
                        }
                        $to_email = array_filter($to_email);
                    }
                    $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);
                    $flag = $this->sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title);

                    
                    // return gettype($flag);
                    if (!$flag) {
                        Toastr::error('Operation Failed' . $flag[1], 'Failed');
                        return redirect()->back();
                    } else {
                        Toastr::success('Operation successful', 'Success');
                        return redirect()->back();
                    }
                }else{
                    $email_sms_title = $request->email_sms_title;
                    $description = $request->description;
                    $message_to = implode(',', $request->role);

                    $to_name = '';
                    $to_email = '';
                    $to_mobile = '';
                    $receiverDetails = '';
                    $receiver_numbers=[];
                    foreach ($request->role as $role_id) {

                        if ($role_id == 2) {
                            $receiverDetails = SmStudent::select('email', 'full_name', 'mobile')->where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
                        } elseif ($role_id == 3) {
                            $receiverDetails = SmParent::select('guardians_email as email', 'fathers_name as full_name', 'fathers_mobile as mobile')->where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();
                        } else {
                            $receiverDetails = SmStaff::select('email', 'full_name', 'mobile')->where('role_id', $role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                        }


                        foreach ($receiverDetails as $receiverDetail) {
                            $to_name    = $receiverDetail->full_name;
                            $to_email   = $receiverDetail->email;
                            $to_mobile  = $receiverDetail->mobile;

                            if ($receiverDetail->mobile!=null) {
                                $receiver_numbers[]=$receiverDetail->mobile;
                            }
                            

                            // send dynamic content in $data
                            $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);

                            $sms = $request->description;
                            if (activeSmsGateway()->gateway_name != 'Phone SMS') {
                                $this->sendSMSFromComunicate($to_mobile, $sms,$request->email_sms_title);
                            }

                        }
                        if (activeSmsGateway()->gateway_name == 'Phone SMS') {
                            $user=User::find(Auth::user()->id);
                            // Log::info($user);
                            $job = (new \App\Jobs\sendSmsJob($sms,$request->email_sms_title,$receiver_numbers,$user))
                                    ->delay(now()->addSeconds(2)); 

                            dispatch($job);
                        }
                         //end loop
                    } //end role loop
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                }
            } //end else Please select whom you want to send

        } //end select tab G
        else if ($request->selectTab == 'I') {




            if (empty($request->message_to_individual)) {
                Toastr::error('Please select whom you want to send', 'Failed');
                return redirect()->back();
            } else {

                if ($request->send_through == 'E') {

                    $message_to_individual = $request->message_to_individual;
                   

                    $to_email = [];
                    $to_mobile = [];
                    foreach ($message_to_individual as $key => $value) {
                        $receiver_full_name_email = explode('-', $value);
                        $receiver_full_name = $receiver_full_name_email[0];
                        $receiver_email = $receiver_full_name_email[1];
                        $receiver_mobile = $receiver_full_name_email[2];

                        $to_name = $receiver_full_name;
                        $to_email[] = $receiver_email;

                        $to_mobile[] = $receiver_mobile;
                    }

                    $to_email = array_filter($to_email);
                    // send dynamic content in $data

                    $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);


                    $flag = $this->sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title);

                    if (!$flag) {
                        Toastr::error('Operation Failed', 'Failed');
                        return redirect()->back();
                    }
                } else {


                    $message_to_individual = $request->message_to_individual;

                    $receiver_numbers=[];

                    foreach ($message_to_individual as $key => $value) {
                        $receiver_full_name_email = explode('-', $value);
                        $receiver_full_name = $receiver_full_name_email[0];
                        $receiver_email = $receiver_full_name_email[1];
                        $receiver_mobile = $receiver_full_name_email[2];

                        $to_name = $receiver_full_name;
                        $to_email = $receiver_email;

                        $to_mobile = $receiver_mobile;
                        // send dynamic content in $data
                        $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);
                        // If checked Email


                        if ($to_mobile!=null) {
                            $receiver_numbers[]=$to_mobile;
                        }
                        $sms = $request->description;
                      
                        if (activeSmsGateway()->gateway_name != 'Phone SMS') {
                            $this->sendSMSFromComunicate($to_mobile, $sms,$request->email_sms_title);
                        }  

                    }
                    if (activeSmsGateway()->gateway_name == 'Phone SMS') {
                        $user=User::find(Auth::user()->id);
                        // Log::info($user);
                        $job = (new \App\Jobs\sendSmsJob($sms,$request->email_sms_title,$receiver_numbers,$user))
                                ->delay(now()->addSeconds(2)); 

                        dispatch($job);
                    }
                }
            } //end else
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
           
            //  start send email/sms to class section
            if (empty($request->message_to_section)) {
                Toastr::error('Please select whom you want to send', 'Failed');
                return redirect()->back();
            } else {

                if ($request->send_through == 'E') {



                    $class_id = $request->class_id;
                    $selectedSections = $request->message_to_section;

                    $to_email = [];
                    $to_mobile = [];
                    foreach ($selectedSections as $key => $value) {
                        $students = SmStudent::select('email', 'full_name', 'mobile')->where('class_id', $class_id)->where('section_id', $value)->where('active_status', 1)->get();

                        foreach ($students as $student) {
                            $to_name = $student->full_name;
                            $to_email[] = $student->email;
                            $to_mobile[] = $student->mobile;
                            // send dynamic content in $data

                        }
                        $to_email = array_filter($to_email);
                    }
                    

                    $data = array(
                        'name' => $student->full_name,
                        'email_sms_title' => $request->email_sms_title,
                        'description' => $request->description,

                    );
                   

                    $flag = $this->sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title);
                    
                    if (!$flag) {
                        Toastr::error('Operation Failed' . $flag[1], 'Failed');
                        return redirect()->back();
                    }
                } else {
                    $class_id = $request->class_id;
                    $selectedSections = $request->message_to_section;
                    foreach ($selectedSections as $key => $value) {
                        $students = SmStudent::select('email', 'full_name', 'mobile')->where('class_id', $class_id)->where('section_id', $value)->where('active_status', 1)->get();
                        
                        $receiver_numbers=[];
                        foreach ($students as $student) {
                            $to_name = $student->full_name;
                            $to_email = $student->email;
                            $to_mobile = $student->mobile;
                            // send dynamic content in $data
                            $data = array(
                                'name' => $student->full_name,
                                'email_sms_title' => $request->email_sms_title,
                                'description' => $request->description,
                            );
                            $sms = $request->description;
                            if ($to_mobile!=null) {
                                $receiver_numbers[]=$to_mobile;
                            }
                            if (activeSmsGateway()->gateway_name != 'Phone SMS') {
                                $this->sendSMSFromComunicate($to_mobile, $sms,$request->email_sms_title);
                            }

                        }
                        if (activeSmsGateway()->gateway_name == 'Phone SMS') {
                            $user=User::find(Auth::user()->id);
                            // Log::info($user);
                            $job = (new \App\Jobs\sendSmsJob($sms,$request->email_sms_title,$receiver_numbers,$user))
                                    ->delay(now()->addSeconds(2)); 

                            dispatch($job);
                        }

                         //end student loop
                    } //end selectedSections loop
                }
            } //end else

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();

        } //end else
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    } // end function sendEmailSms




    public function studStaffByRole(Request $request)
    {
        try {
            if ($request->id == 2) {
                $allStudents = SmStudent::where('active_status', '=', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
                $students = [];
                foreach ($allStudents as $allStudent) {
                    $students[] = SmStudent::find($allStudent->id);
                }
                return response()->json([$students]);
            }

            if ($request->id == 3) {
                $Parents= SmParent::where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->get();
                return response()->json([$Parents]);
            }

            if ($request->id != 2 and $request->id != 3) {
                $allStaffs = SmStaff::where('role_id', '=', $request->id)->where('school_id', Auth::user()->school_id)->where('active_status', '=', 1)->get();
                $staffs = [];
                foreach ($allStaffs as $staffsvalue) {
                    $staffs[] = SmStaff::find($staffsvalue->id);
                }

                return response()->json([$staffs]);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function emailSmsLog()
    {
        try {
            $emailSmsLogs = SmEmailSmsLog::where('academic_id', getAcademicId())
            ->orderBy('id', 'DESC')
            ->where('school_id', Auth::user()->school_id)
            ->get();
            // return getAcademicId();
            return view('backEnd.communicate.emailSmsLog', compact('emailSmsLogs'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}