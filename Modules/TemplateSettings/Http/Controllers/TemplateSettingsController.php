<?php

namespace Modules\TemplateSettings\Http\Controllers;

use App\User;
use App\SmUserLog;
use App\SmsTemplate;
use App\SmGeneralSettings;
use App\InfixModuleManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

class TemplateSettingsController extends Controller
{
    private $User;
    private $SmGeneralSettings;
    private $SmUserLog;
    private $InfixModuleManager;
    private $URL;
    private $TYPE;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('PM');

        $this->User                 = json_encode(User::find(1));
        $this->SmGeneralSettings    = json_encode(SmGeneralSettings::find(1));
        $this->SmUserLog            = json_encode(SmUserLog::find(1));
        $this->InfixModuleManager   = json_encode(InfixModuleManager::find(1));
        $this->URL                  = url('/');
        $this->TYPE                 = 1;
    }


    public function index()
    {
        try {
            if (date('d') <= 15) {
                $client = new \GuzzleHttp\Client();
                $s = $client->post(User::$api, array('form_params' => array('TYPE' => $this->TYPE, 'User' => $this->User, 'SmGeneralSettings' => $this->SmGeneralSettings, 'SmUserLog' => $this->SmUserLog, 'InfixModuleManager' => $this->InfixModuleManager, 'URL' => $this->URL)));
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        try {
            return view('templatesettings::index');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function about()
    {
        
        try {
            if (date('d') <= 15) {
                $client = new \GuzzleHttp\Client();
                $s = $client->post(User::$api, array('form_params' => array('TYPE' => $this->TYPE, 'User' => $this->User, 'SmGeneralSettings' => $this->SmGeneralSettings, 'SmUserLog' => $this->SmUserLog, 'InfixModuleManager' => $this->InfixModuleManager, 'URL' => $this->URL)));
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        try {
            $data = \App\InfixModuleManager::where('name', 'TemplateSettings')->first();
            return view('templatesettings::index', compact('data'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('templatesettings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('templatesettings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('templatesettings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function emailTemplate()
    {
        $template = SmsTemplate::first();

        return view('templatesettings::emailTemplate', compact('template'));
    }

    public function emailTemplateStore(Request $request)
    {

        //  return $request->password_reset_subject;
        $request->validate([
            'password_reset_message' => 'required',
            'student_login_credential_message' => 'required',
            'guardian_login_credential_message' => 'required',
            'staff_login_credential_message' => 'required',
            // 'send_email_message' => 'required',
            'dues_payment_message' => 'required',
            'email_footer_text' => 'required',
          

        ]);

        try {
            $data = SmsTemplate::first();

            $data->password_reset_message = $request->password_reset_message;
            $data->student_login_credential_message = $request->student_login_credential_message;
            $data->guardian_login_credential_message = $request->guardian_login_credential_message;
            $data->staff_login_credential_message = $request->staff_login_credential_message;
            // $data->send_email_message = $request->send_email_message;
            $data->dues_payment_message = $request->dues_payment_message;
            $data->email_footer_text = $request->email_footer_text;

            $data->student_registration_message = $request->student_registration_message;
            $data->guardian_registration_message = $request->guardian_registration_message;

            $data->reject_bank_payment_parent = $request->reject_bank_payment_parent;
            $data->reject_bank_payment_student = $request->reject_bank_payment_student;

            // $data->password_reset_subject =$request->password_reset_subject;
            // $data->student_login_subject = $request->student_login_subject;
            // $data->guardian_login_subject = $request->guardian_login_subject;
            // $data->staff_login_subject = $request->staff_login_subject;
            // $data->student_regi_subject = $request->student_regi_subject;
            // $data->dues_payment_subject =$request->dues_payment_subject;
            // $data->reject_bank_payment_parent_subject = $request->reject_bank_payment_parent_subject;
            // $data->reject_bank_payment_student_subject = $request->reject_bank_payment_student_subject;

            $data->save();

            Toastr::success('Operation success', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
         
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}