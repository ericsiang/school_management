<?php

namespace App\Http\Controllers\Backend\Student;

use DB;
use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Models\AssignStudents;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class StudentRegController extends Controller
{
    public function index(){
        $assign_students=AssignStudent::all();
        //dd($exam_types);
        return view('backend.student.reg.index',compact('assign_students'));
    }

    public function create(){
        $data=[];
        $data['classes']=StudentClass::all();
        $data['years']=StudentYear::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();
        return view('backend.student.reg.add',compact('data'));
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required',
                'fname'=>'required',
                'mname'=>'required',
                'mobile'=>'required|regex:/^09[0-9]{8}$/',
                'address'=>'required',
                'gender'=>'required',
                'religon'=>'required',
                'dob'=>'required',
                'discount'=>'required|numeric',
                'year_id'=>'required',
                'class_id'=>'required',
                'group_id'=>'required',
                'shift_id'=>'required',
                'image'=>'required|mimes:jpg,jpeg,png',
            ],
            [
                'required'=>'請輸入:attribute',
                'numeric'=>'請輸入數值',
                'image.required'=>'請上傳圖片',
                'mimes'=>'圖片格式為jpg,jpeg,png',
                'regex'=>'請輸入正確的手機號碼'
            ]
        );
        //dd($validated);
        //dd(StudentYear::find($request->year_id)->name);
        DB::transaction(function() use ($request) {
            $check_year=StudentYear::find($request->year_id)->name;

            $student=User::WHERE('user_type','student')->OrderBy('id','DESC')->first();

            if(empty($student)){
                $firstReg=0;
                $student_id=$firstReg+1;
                switch ($student_id) {
                    case $student_id < 10:
                        $id_no='000'.$student_id;
                        break;
                    case $student_id < 100:
                        $id_no='00'.$student_id;
                        break;
                    case $student_id < 1000:
                        $id_no='0'.$student_id;
                        break;
                }
            }else{
                $student=User::WHERE('user_type','student')->OrderBy('id','DESC')->first()->id;

                $student_id=$student+1;
                switch ($student_id) {
                    case $student_id < 10:
                        $id_no='000'.$student_id;
                        break;
                    case $student_id < 100:
                        $id_no='00'.$student_id;
                        break;
                    case $student_id < 1000:
                        $id_no='0'.$student_id;
                        break;
                }
            }

            $final_id_no=$check_year.$id_no;


            if($request->file('image')){
                $new_img=$request->file('image');
                $save_path=public_path('upload/student_images');

                if (!file_exists($save_path)) {
                    mkdir($save_path, 777, true);
                }

                //使用Image套件上傳圖片
                $img_name=hexdec(uniqid()).'.'.strtolower($new_img->getClientOriginalExtension());
                $store_src='upload/student_images/'.$img_name;

                Image::make($new_img)->resize(200,200)->save($store_src);
                $validated['image']=$store_src;
            }

        });

        //dd($validated);

        //add student user
        $code=rand(0000,9999);
        $validated['user_type']='Student';
        $validated['code']=$code;
        $validated['password']=bcrypt($code);
        $validated['religion']=$request->religon;
        unset($validated['religon']);
        unset($validated['discount']);
        unset($validated['year_id']);
        unset($validated['class_id']);
        unset($validated['group_id']);
        unset($validated['shift_id']);
        $student_user=User::create($validated);

        //add assign student
        $student_id=$student_user->id;
        $year_id=$request->year_id;
        $class_id=$request->class_id;
        $group_id=$request->group_id;
        $shift_id=$request->shift_id;

        $assign_student=AssignStudent::create([
            'student_id'=>$student_id,
            'year_id'=>$year_id,
            'class_id'=>$class_id,
            'group_id'=>$group_id,
            'shift_id'=>$shift_id,
        ]);

        $discount_student=DiscountStudent::create([
            'assign_student_id'=>$assign_student->id,
            'fee_category_id'=>1,
            'discount'=>$request->discount,
        ]);

        //dd($exam_type);
        $notification=[
            'message'=>'新增Student成功',
            'alert-type'=>'success',
        ];
        //dd($exam_type);
        return redirect()->route('student.reg.index')->with($notification);
    }

    public function edit(ExamType $exam_type){

        return view('backend.student.reg.update',compact('exam_type'));
    }

    public function update(Request $request,ExamType $exam_type){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:fee_categories',
            ],
        );
        //dd($validated);

        $exam_type=$exam_type->update($validated);
        $notification=[
            'message'=>'修改Exam Type成功',
            'alert-type'=>'success',
        ];
        //dd($exam_type);
        return redirect()->route('student.reg.index')->with($notification);
    }

    public function delete(Request $request,ExamType $exam_type){

        $exam_type->delete();
        $notification=[
            'message'=>'刪除Exam Type成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('student.reg.index')->with($notification);
    }
}
