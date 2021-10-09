<?php

namespace App\Http\Controllers;

use App\SmCourse;
use App\SmCourseCategory;
use App\SmGeneralSettings;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class SmCourseController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
	}
    public function index()
    {
        try{
            $course = SmCourse::where('school_id',Auth::user()->school_id)->get();
            $categories = SmCourseCategory::where('school_id',Auth::user()->school_id)->get();
            return view('backEnd.course.course_page', compact('course','categories'));
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|dimensions:min_width=1420,min_height=450|mimes:jpg,jpeg,png',
            'category_id'=> 'required',
        ]);
        try {
            $course = new SmCourse();
            $image = "";
            if ($request->file('image') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('image');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('image');
                $image = 'cou-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/course/', $image);
                $image = 'public/uploads/course/' . $image;
            }

            $course->title = $request->title;
            $course->image = $image;
            $course->category_id = $request->category_id;
            $course->overview = $request->overview;
            $course->outline = $request->outline;
            $course->prerequisites = $request->prerequisites;
            $course->resources = $request->resources;
            $course->stats = $request->stats;
            $course->school_id = Auth::user()->school_id;
            $result = $course->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            $categories = SmCourseCategory::where('school_id',Auth::user()->school_id)->get();
            $course = SmCourse::where('school_id',Auth::user()->school_id)->get();
            $add_course = SmCourse::find($id);
            return view('backEnd.course.course_page', compact('categories','course', 'add_course'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'dimensions:min_width=1420,min_height=450|mimes:jpg,jpeg,png',
            'category_id'=> 'required',
        ]);
        try {
            $course = SmCourse::find($request->id);
            $image = "";
            if ($request->file('image') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('image');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $course = SmCourse::find($request->id);
                if ($course->image != "") {
                    unlink($course->image);
                }

                $file = $request->file('image');
                $image = 'stu-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/course/', $image);
                $image = 'public/uploads/course/' . $image;
            }
            $course = SmCourse::find($request->id);
            $course->title = $request->title;
            if ($image != "") {
                $course->image = $image;
            }
            $course->category_id = $request->category_id;
            $course->overview = $request->overview;
            $course->outline = $request->outline;
            $course->prerequisites = $request->prerequisites;
            $course->resources = $request->resources;
            $course->stats = $request->stats;
            $result = $course->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('course-list');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $course = SmCourse::find($id);
            $result = $course->delete();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function forDeleteCourse($id)
    {
        try {
            return view('backEnd.course.delete_modal', compact('id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseDetails($id)
    {
        try {
            $course = SmCourse::find($id);
            return view('backEnd.course.course_details', compact('course'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseCategory()
    {
        try{
            $course_categories = SmCourseCategory::where('school_id',Auth::user()->school_id)->get();
            return view('backEnd.course.course_category',compact('course_categories'));
        }catch(\Exception $e){
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function storeCourseCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'required|dimensions:min_width=1420,min_height=450',
        ]);
        try {
            $image = "";
            if ($request->file('category_image') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('category_image');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('category_image');
                $image = 'cou-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/course/', $image);
                $image = 'public/uploads/course/' . $image;
            }

            SmCourseCategory::create([
                'category_name' => $request->category_name,
                'category_image' => $image,
            ]);

            Toastr::success('Operation Successfull', 'Success');
            return redirect('course-category');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function editCourseCategory($id)
    {
        try{
            $editData = SmCourseCategory::where('id',$id)
                                ->where('school_id',Auth::user()->school_id)
                                ->first();

            $course_categories = SmCourseCategory::where('school_id',Auth::user()->school_id)->get();

            return view('backEnd.course.course_category',compact('editData','course_categories'));
        }catch(\Exception $e){
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updateCourseCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'dimensions:min_width=1420,min_height=450',
        ]);

        try{
            $image = "";
            if ($request->file('category_image') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('category_image');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $data = SmCourseCategory::find($request->id);
                if ($data->category_image != "") {
                    unlink($data->category_image);
                }

                $file = $request->file('category_image');
                $image = 'stu-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/course/', $image);
                $image = 'public/uploads/course/' . $image;
            }

            $data = SmCourseCategory::find($request->id);
            $data->category_name = $request->category_name;
            if ($image != "") {
                $data->category_image = $image;
            }
            $result = $data->save();

            if($result){
                Toastr::success('Operation Successfull', 'Success');
                return redirect('course-category');
            }else{
                Toastr::error('Operation Failed', 'Failed');
                return redirect('course-category');
            }
        }catch(\Exception $e){
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteCourseCategory(Request $request)
    {
        try{
            $data = SmCourseCategory::find($request->id);
                if ($data->category_image != "") {
                    unlink($data->category_image);
                }
            $result = SmCourseCategory::find($request->id)->delete();
            if($result){
                Toastr::success('Operation Successfull', 'Success');
                return redirect('course-category');
            }else{
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }catch(\Exception $e){
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function viewCourseCategory($id)
    {
        try {
            $category_id = SmCourseCategory:: find($id);
            $courseCtaegories = SmCourse::where('category_id',$category_id->id)
                        ->where('school_id',Auth::user()->school_id)
                        ->get();
            return view('frontEnd.home.course_category', compact('category_id','courseCtaegories'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


}