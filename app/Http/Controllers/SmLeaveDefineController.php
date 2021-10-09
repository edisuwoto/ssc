<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;
use App\SmClass;
use App\SmStaff;
use App\SmStudent;
use App\YearCheck;
use App\SmLeaveType;
use App\ApiBaseMethod;
use App\SmLeaveDefine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\RolePermission\Entities\InfixRole;

class SmLeaveDefineController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // User::checkAuth();
	}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try{
            $leave_types = SmLeaveType::where('active_status', 1)->where('school_id',Auth::user()->school_id)->where('academic_id', getAcademicId())->get();
            $roles = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 3)->where('id', '!=', 10)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            $classes = SmClass::where('academic_id',getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->where('active_status',1)
                                ->get(['id','class_name']);

            $leave_defines = SmLeaveDefine::where('active_status', 1)->where('school_id',Auth::user()->school_id)->where('academic_id', getAcademicId())->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['leave_types'] = $leave_types->toArray();
                $data['roles'] = $roles->toArray();
                $data['leave_defines'] = $leave_defines->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.humanResource.leave_define', compact('leave_types', 'roles', 'leave_defines','classes'));
        }catch (\Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'member_type' => "required",
            'leave_type' => 'required',
            'days' => 'required',         
        ]);

        $leave_type = SmLeaveType::find($request->leave_type);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $previous = null;
            if(! is_null($request->addition) ){
                $previous =  SmLeaveDefine::where('role_id',$request->member_type) 
                                            ->orwhere('user_id',$request->staff)
                                            ->orwhere('user_id',$request->student)
                                            ->where('type_id',$request->leave_type)
                                            ->latest()->first();
                                            
            }

            if( is_numeric($request->student)  || is_numeric($request->staff) ){
                if(is_null($previous)){

                    $leave_define = new SmLeaveDefine();
                    $leave_define->role_id = $request->member_type;
                    $leave_define->type_id = $request->leave_type;
                    $leave_define->days = $request->days;
                    $leave_define->school_id = Auth::user()->school_id;
                    $leave_define->academic_id = getAcademicId();

                    if(is_numeric($request->student)){
                        $leave_define->user_id = $request->student;
                    }
                    elseif(is_numeric($request->staff)){
                        $leave_define->user_id = $request->staff;
                    }
                    $results = $leave_define->save();

                }
                else{

                        $previous->days = ($previous->days + $request->days) ;
                        $results = $previous->save();
                        }
               
                
            }
            
            else{
                $allUsers = User::where('school_id',Auth::user()->school_id)
                                        ->where('role_id',$request->member_type)
                                        ->where('selected_session', getAcademicId())
                                        ->where('active_status',1)
                                        ->get(['id','role_id']);

                 if( count($allUsers) > 0)  {
                    foreach($allUsers as $user){
                        $leave_define = new SmLeaveDefine();
                        $leave_define->role_id = $user->role_id;
                        $leave_define->type_id = $request->leave_type;
                        $leave_define->days = $request->days;
                        $leave_define->school_id = Auth::user()->school_id;
                        $leave_define->academic_id = getAcademicId();
                        $leave_define->user_id = $user->id;
                        $results = $leave_define->save();
                    }
                    

                 }                     
            }
                

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($results) {
                        return ApiBaseMethod::sendResponse(null, 'Visitor has been created successfully.');
                    }
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                } else {
                    if ($results) {
                        Toastr::success('Operation successful', 'Success');
                        return redirect()->back();
                    }
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        
        catch (\Exception $e) {
           
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        try{
            
            $leave_types = SmLeaveType::where('active_status', 1)->where('school_id',Auth::user()->school_id)->where('academic_id', getAcademicId())->get();
            $roles = InfixRole::where('active_status', 1)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            $leave_defines = SmLeaveDefine::where('active_status', 1)->where('school_id',Auth::user()->school_id)->where('academic_id', getAcademicId())->get();
            $leave_define = SmLeaveDefine::find($id);

            $user = User::find($leave_define->user_id);
            $student = null;
            $staff = null;
            $student = SmStudent::where('user_id',$user->id)->first();
            $staff = SmStaff::where('user_id',$user->id)->first();
            
            
            $classes = SmClass::where('academic_id',getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->where('active_status',1)
                                ->get(['id','class_name']);

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['leave_types'] = $leave_types->toArray();
                $data['roles'] = $roles->toArray();
                $data['leave_defines'] = $leave_defines->toArray();
                $data['leave_define'] = $leave_define->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }

            return view('backEnd.humanResource.leave_define', compact('leave_types', 'roles', 'leave_defines', 'leave_define','classes','student','staff'));
        }catch (\Exception $e) {
            
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'member_type' => "required",
            'leave_type' => 'required',
            'days' => 'required',         
        ]);


        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try{
            $leave_type = SmLeaveType::find($request->leave_type);
             if (checkAdmin()) {
                $leave_define = SmLeaveDefine::find($request->id);
            }else{
                $leave_define = SmLeaveDefine::where('id',$request->id)->where('school_id',Auth::user()->school_id)->first();
            }
                 $leave_define->type_id = $request->leave_type;
                $leave_define->days = $request->days;
                $results = $leave_define->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($results) {
                    return ApiBaseMethod::sendResponse(null, 'Leave Define has been Updated successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($results) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('leave-define');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        }catch (\Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => "required"        
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try{
            $id = $request->id;
            $tables = \App\tableList::getTableList('leave_define_id', $id);

            try {
                if ($tables==null) {
                    if (checkAdmin()) {
                        $result = SmLeaveDefine::destroy($id);
                    }else{
                        $result = SmLeaveDefine::where('id',$id)->where('school_id',Auth::user()->school_id)->delete();
                    }
                    if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                        if ($result) {
                            return ApiBaseMethod::sendResponse(null, 'Leave Define has been deleted successfully');
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
                } else {
                    $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }

            } catch (\Illuminate\Database\QueryException $e) {

                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        }catch (\Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }

    public function updateLeave(Request $request){
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => "required" ,
            'days'=> "required|numeric"      
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try{
           
             if (checkAdmin()) {
                $leave_define = SmLeaveDefine::find($request->id);
            }else{
                $leave_define = SmLeaveDefine::where('id',$request->id)->where('school_id',Auth::user()->school_id)->first();
            }
                $leave_define->days = $request->days;
                $results = $leave_define->save();

                if ($results) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('leave-define');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }

        }catch (\Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }

    }
}