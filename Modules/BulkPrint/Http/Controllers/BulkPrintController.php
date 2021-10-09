<?php

namespace Modules\BulkPrint\Http\Controllers;

use App\Role;
use App\SmParent;
use App\SmClass;
use App\SmStaff;
use App\SmStudent;
use App\SmStudentIdCard;
use App\SmGeneralSettings;
use App\SmHrPayrollGenerate;
use Illuminate\Http\Request;
use App\SmHrPayrollEarnDeduc;
use App\SmStudentCertificate;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\BulkPrint\Entities\InvoiceSetting;
use Modules\RolePermission\Entities\InfixRole;

class BulkPrintController extends Controller
{
    //
    public function __construct()
	{
        $this->middleware('PM');
       
	}
    public function studentidBulkPrint(){
        try {
            $id_cards = SmStudentIdCard::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            $roles = Role::where('school_id', Auth::user()->school_id)->whereNotIn('id',[1])->get();
            return view('bulkprint::admin.generate_id_card', compact('id_cards','roles'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function studentidBulkPrintSearch(Request $request){
        try {
        $request->validate([
            'role' => 'required',
            'id_card' => 'required',         
            // 'grid_gap' => 'required',         
        ]);
         
        if($request->role==2){
            $s_students=SmStudent::query();
            if($request->class){
                $s_students->where('class_id',$request->class_id);
            }
            if($request->section){
                $request->where('section_id',$request->section_id);
            }
           $s_students = $s_students->status()->get();
       }elseif($request->role==3){
           $studentGuardian = SmStudent::where('school_id', Auth::user()->school_id)->get('parent_id');
           $s_students = SmParent::whereIn('id',$studentGuardian)->get();
       }
       else{
           $s_students=SmStaff::where('role_id',$request->role)->status()->get();
       }
       $id_card = SmStudentIdCard::status()->find($request->id_card);

       $role_id=$request->role;

       $gridGap = $request->grid_gap !=null ? $request->grid_gap :15;
        return view('bulkprint::admin.id_card_bulk_print', ['id_card' => $id_card, 's_students' => $s_students,'role_id'=>$role_id,'gridGap'=>$gridGap]);
        
    
         $pdf = PDF::loadView('bulkprint::admin.id_card_bulk_print', ['id_card' => $id_card, 's_students' => $s_students,'role_id'=>$role_id]);
        //  return $pdf->stream($id_card->title . '.pdf');
        } catch (\Throwable $th) {
           Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function ajaxIdCard(Request $request){
        try {
            
            $role_id=$request->role_id;
            $id_cards = SmStudentIdCard::where('active_status',1)->get();
            $idCards=[];
            foreach($id_cards as $id_card){
                $role_ids=json_decode($id_card->role_id);
                if(in_array($role_id,$role_ids)){
                    $d['id']=$id_card->id;
                    $d['title']=$id_card->title;
                    $idCards[]=$d;
                }
            }
        
            return response()->json([$idCards]);

        } catch (\Throwable $th) {
          
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function ajaxRoleIdCard(Request $request){
        try {
            //code...
            $id=$request->id;
            $id_card = SmStudentIdCard::status()->find($id);
            $role_ids=json_decode($id_card->role_id);
            $roles=[];
            foreach($role_ids as $role){
                $d['id']=Role::find($role)->id;
                $d['name']=Role::find($role)->name;

                $roles[]=$d;
                
            }
        
            return response()->json([$roles]);
        } catch (\Throwable $th) {
           Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function staffidBulkPrint(){
        try {
            $id_cards = SmStudentIdCard::where('active_status', 1)->where('role_id','!=','["2"]')->where('school_id', Auth::user()->school_id)->get(['id','title']);
            $roles = Role::where('school_id', Auth::user()->school_id)->whereNotIn('id',[1,2,3])->get();
            return view('bulkprint::admin.staff_generate_id_card', compact('id_cards','roles'));
        } catch (\Exception $e) {
        
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function staffidBulkPrintSearch(Request $request){
        try {
         
            $inputs=$request->except('_token');
            $validator = Validator::make($inputs, [
                'role_id' => 'required|array',
                'id_card' => 'required'               
            ]);
    
            if ($validator->fails()) {
             
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
        
            if($request->role==2){
                $s_students=SmStudent::query();
                if($request->class){
                    $s_students->where('class_id',$request->class_id);
                }
                if($request->section){
                    $request->where('section_id',$request->section_id);
                }
               $s_students=$s_students->status()->get();
             
    
           }else{
        //   return  $request->role_id;
               $s_students=SmStaff::whereIn('role_id',$request->role_id)->status()->get();
    
           }
           $id_card = SmStudentIdCard::status()->find($request->id_card);
    
              $role_id=$request->role;
  
         return view('bulkprint::admin.id_card_bulk_print', ['id_card' => $id_card, 's_students' => $s_students,'role_id'=>$role_id]);
    
         $pdf = PDF::loadView('bulkprint::admin.id_card_bulk_print', ['id_card' => $id_card, 's_students' => $s_students]);
         return $pdf->stream($id_card->title . '.pdf');
        } catch (\Throwable $th) {
            //throw $th;
             Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function settings(){
        $invoiceSettings=InvoiceSetting::where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->first();

        return view('bulkprint::feesCollection.invoice_settings',compact('invoiceSettings'));
    }
    
    public function settingsUpdate(Request $request){
        try {
        //  return  $request->all();
            if($request->copy_s_per_th && $request->copy_o_per_th && $request->copy_c_per_th ){
                $per_th=3;
            }elseif(($request->copy_s_per_th && $request->copy_o_per_th) || ($request->copy_s_per_th && $request->copy_c_per_th) || ($request->copy_o_per_th && $request->copy_c_per_th)){
                $per_th=2;
            }elseif($request->copy_s_per_th || $request->copy_o_per_th || $request->copy_c_per_th){
                $per_th=1;
            }else{
                $per_th=null;
               
            }
         
            if($per_th==null){
                Toastr::error('Please Select at least One page', 'Failed');
                return redirect()->back();
            }

            $invoiceSetting=InvoiceSetting::find($request->id);

            $invoiceSetting->per_th=$per_th;
            $invoiceSetting->student_name=$request->student_name;
            $invoiceSetting->student_section=$request->student_section;
            $invoiceSetting->student_class=$request->student_class;   
            $invoiceSetting->student_roll=$request->student_roll;
            $invoiceSetting->student_group=$request->student_group;
            $invoiceSetting->student_admission_no=$request->student_admission_no;

            $invoiceSetting->footer_1=$request->footer_1;
            $invoiceSetting->footer_2=$request->footer_2;
            $invoiceSetting->footer_3=$request->footer_3;
            $invoiceSetting->prefix=$request->prefix;
            $invoiceSetting->copy_s=$request->copy_s;
            $invoiceSetting->copy_o=$request->copy_o; 
            $invoiceSetting->copy_c=$request->copy_c;

            $invoiceSetting->c_signature_p=$request->copy_s_per_th=='on'? 1:0;
            $invoiceSetting->c_signature_o=$request->copy_o_per_th=='on'? 1:0; 
            $invoiceSetting->c_signature_c=$request->copy_c_per_th=='on'? 1:0;

            $invoiceSetting->signature_p=$request->signature_p;
            $invoiceSetting->signature_c=$request->signature_c;
            $invoiceSetting->signature_o=$request->signature_o;

            $invoiceSetting->copy_write_msg=$request->copy_write_msg;

            $invoiceSetting->updated_by=Auth::user()->id;
            $invoiceSetting->school_id=Auth::user()->school_id;
            $invoiceSetting->academic_id= getAcademicId();
            $invoiceSetting->update();
         
           
            Toastr::success('Operation Successfully', 'Failed');
            return redirect()->back();

        } catch (\Throwable $th) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
       

    }

    public function feeVoucherPrint(){
        try {
            $classes = SmClass::where('active_status', 1)
                    ->where('school_id', Auth::user()->school_id)
                    ->where('academic_id', getAcademicId())
                    ->get();
            return view('bulkprint::feesCollection.fees_bulk_print',compact('classes'));
        } catch (\Exception $e) {
         
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function feeVoucherPrintSearch(Request $request){
        try {
            $inputs=$request->except('_token');
            $validator = Validator::make($inputs, [
                'class' => 'required',               
            ]);
    
            if ($validator->fails()) {
             
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            set_time_limit(2700);

            $students=SmStudent::query();
            if(!empty($request->section)){
                $students->where('section_id',$request->section);
            }
            $students=$students->where('class_id',$request->class)
            ->where('active_status', 1)
            ->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)
            ->get();

            $invoiceSettings=InvoiceSetting::where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->first();

            return view('bulkprint::feesCollection.fees_payment_invoice_bulk_print')->with(['students' => $students,'invoiceSettings'=>$invoiceSettings]);
        } catch (\Exception $e) {            
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function payrollBulkPrint(){
        
		try{
			$roles = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })
			->orderBy('name','asc')
			->get();
			return view('bulkprint::humanResource.payroll.payroll_bulk_print', compact('roles'));
		}catch (\Exception $e) {
       
		   Toastr::error('Operation Failed', 'Failed');
		   return redirect()->back();
		}
    }

    public function payrollBulkPrintSearch(Request $request){
        try{
            $inputs=$request->except('_token');
            $validator = Validator::make($inputs, [
                // 'role_id' => "required",
                // 'payroll_month' => "required",
                // 'payroll_year' => "required"              
            ]);
            // return $request->all();

    
            if ($validator->fails()) {
             
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $role_id=$request->role_id;
            $month=$request->payroll_month;
            $year=$request->payroll_year;
             $staff_ids=SmStaff::query();
             if($request->role_id){           
                $staff_ids->where('role_id',$request->role_id);
             }
           
          $staff_ids= $staff_ids->where('school_id',Auth::user()->school_id)->get('id');

            $payrollDetails=SmHrPayrollGenerate::query();
            if($request->payroll_month){
                $payrollDetails->where('payroll_month',$month);
            }
            if($request->payroll_year){
                $payrollDetails->where('payroll_year',$year);
            }
            if($request->role_id){
                $payrollDetails->whereIn('staff_id',$staff_ids);
            }
            $payrollDetails=$payrollDetails->where('school_id',Auth::user()->school_id)->get();

          if(count($payrollDetails)==0){
              Toastr::error('Not Found ! Generate Payroll', 'Failed');
		     return redirect()->back();
          }

			$schoolDetails = SmGeneralSettings::where('school_id',Auth::user()->school_id)->first();
		

			$payrollEarnDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('earn_dedc_type', '=', 'E')->where('school_id',Auth::user()->school_id)->get();

			$payrollDedcDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('earn_dedc_type', '=', 'D')->where('school_id',Auth::user()->school_id)->get();

			return view('bulkprint::humanResource.payroll.payroll_bulk_print_invoice', compact('payrollDetails', 'payrollEarnDetails', 'payrollDedcDetails', 'schoolDetails'));
		}catch (\Exception $e) {
         
		   Toastr::error('Operation Failed', 'Failed');
		   return redirect()->back();
		}
    }
    public function certificateBulkPrint(){
        try {
            $classes = SmClass::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id',Auth::user()->school_id)->get();
            $certificates = SmStudentCertificate::where('active_status', 1)->where('school_id',Auth::user()->school_id)->get();
            return view('bulkprint::admin.generate_certificate_bulk', compact('classes', 'certificates'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function certificateBulkPrintSearch(Request $request){
        try {          
         
            $inputs=$request->except('_token');
            $validator = Validator::make($inputs, [
               'class' => 'required',
                'certificate' => 'required'              
            ]);
    
            if ($validator->fails()) {
             
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $certificate_id = $request->certificate;
            $students = SmStudent::query();

            if($request->section){
                $students->where('section_id',$request->section);
            }

            $students=$students->with('className','parents','section','gender')->where('active_status', 1)
                                ->where('academic_id', getAcademicId())
                                ->where('school_id',Auth::user()->school_id)
                                ->get();

                                // return $students;

            $certificate = SmStudentCertificate::find($certificate_id);                     
            $pdf = PDF::loadView('bulkprint::admin.student_certificate_bulk_print', ['students' => $students, 'certificate' => $certificate]);
            $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('certificate.pdf');

        } catch (\Throwable $th) {
            //throw $th;
             Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



}
