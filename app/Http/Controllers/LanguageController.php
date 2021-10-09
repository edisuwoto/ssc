<?php

namespace App\Http\Controllers;

use App\Language;
use App\tableList;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages=Language::where('school_id',Auth::user()->school_id)->get();
        return view('backEnd.systemSettings.language',compact('languages'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:languages,name',
            'code' => 'required | max:15',
            'native' => 'required | max:50',
            'rtl' => 'required',
        ]);


        try {
            $s = new Language();
            $s->name = $request->name;
            $s->code = $request->code;
            $s->native = $request->native;
            $s->rtl = $request->rtl;
            $s->school_id = Auth::user()->school_id;
            $s->save();

            Toastr::success('Operation successful', 'Success');
            return redirect('language-list');
        } catch (\Exception $e) {
           
            Toastr::error('Operation Failed', 'Failed');
            return redirect('language-list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $languages=Language::where('school_id',Auth::user()->school_id)->get();
            $editData = $languages->where('id',$id)->first();
            return view('backEnd.systemSettings.language',compact('languages','editData'));

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
        $request->validate([
            'name' => 'required|unique:languages,name,'. $request->id,
            'code' => 'required | max:15',
            'native' => 'required | max:50',
            'rtl' => 'required'
        ]);


        try {
            $s = Language::findOrfail($request->id);
            $s->name = $request->name;
            $s->code = $request->code;
            $s->native = $request->native;
            $s->rtl = $request->rtl;
            $s->school_id = Auth::user()->school_id;
            $s->update();

            Toastr::success('Operation successful', 'Success');
            return redirect('language-list');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect('language-list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tables = tableList::getTableList('lang_id', $id);
            if (empty($tables)) {
                $s = Language::findOrfail($id);
                $s->delete();
                Toastr::success('Operation successful', 'Success');
                return redirect('language-list');
            }else {
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
				Toastr::error($msg, 'Failed');
				return redirect()->back();
            }

            
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect('language-list');
        }
    }
}