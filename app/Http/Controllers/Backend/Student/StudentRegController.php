<?php

namespace App\Http\Controllers\Backend\Student;

use DB;
use PDF;
use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class StudentRegController extends Controller
{
    public function index(){
        $data=[];
        $data['classes']=StudentClass::all();
        $data['years']=StudentYear::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();
        $data['year_id']='';
        $data['class_id']='';
        $assign_students=AssignStudent::all();
        //dd($exam_types);
        return view('backend.student.reg.index',compact('assign_students','data'));
    }

    public function search(Request $request){
        $data=[];
        $data['classes']=StudentClass::all();
        $data['years']=StudentYear::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();
        $data['year_id']=$request->year_id;
        $data['class_id']=$request->class_id;
        $assign_students=AssignStudent::where('id','>','0')
                                        ->when($request->year_id, function($query) use ($request){
                                            $query->where('year_id',$request->year_id);
                                        })
                                        ->when($request->class_id, function($query) use ($request){
                                            $query->where('class_id',$request->class_id);
                                        })
                                        ->get();

        return view('backend.student.reg.index',compact('assign_students','data'));
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
                'religion'=>'required',
                'dob'=>'required',
                'discount'=>'required|numeric',
                'year_id'=>'required',
                'class_id'=>'required',
                'group_id'=>'required',
                'shift_id'=>'required',
                'image'=>'required|mimes:jpg,jpeg,png',
            ],
            [
                'required'=>'?????????:attribute',
                'numeric'=>'???????????????',
                'image.required'=>'???????????????',
                'mimes'=>'???????????????jpg,jpeg,png',
                'regex'=>'??????????????????????????????'
            ]
        );
        //dd($validated);
        //dd(StudentYear::find($request->year_id)->name);
        DB::transaction(function() use ($request,$validated) {
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

                //??????Image??????????????????
                $img_name=hexdec(uniqid()).'.'.strtolower($new_img->getClientOriginalExtension());
                $store_src='upload/student_images/'.$img_name;

                Image::make($new_img)->resize(200,200)->save($store_src);
                $validated['image']=$store_src;
            }

            //dd($validated);

            //add student user
            $code=rand(0000,9999);
            $validated['user_type']='Student';
            $validated['code']=$code;
            $validated['password']=bcrypt($code);
            $validated['id_no']= $final_id_no;

            //??????user ????????????????????????
            unset($validated['discount']);
            unset($validated['year_id']);
            unset($validated['class_id']);
            unset($validated['group_id']);
            unset($validated['shift_id']);
            //dd($validated);
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

             //add discount student
            $discount_student=DiscountStudent::create([
                'assign_student_id'=>$assign_student->id,
                'fee_category_id'=>1,
                'discount'=>$request->discount,
            ]);

        });
        //dd($exam_type);
        $notification=[
            'message'=>'??????Student??????',
            'alert-type'=>'success',
        ];
        //dd($exam_type);
        return redirect()->route('student.reg.index')->with($notification);
    }

    public function edit(AssignStudent $assign_student){
        $data=[];
        $data['classes']=StudentClass::all();
        $data['years']=StudentYear::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();
        //dd($assign_student);
        return view('backend.student.reg.update',compact('assign_student','data'));
    }

    public function update(Request $request,AssignStudent $assign_student){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required',
                'fname'=>'required',
                'mname'=>'required',
                'mobile'=>'required|regex:/^09[0-9]{8}$/',
                'address'=>'required',
                'gender'=>'required',
                'religion'=>'required',
                'dob'=>'required',
                'discount'=>'required|numeric',
                'year_id'=>'required',
                'class_id'=>'required',
                'group_id'=>'required',
                'shift_id'=>'required',
                'image'=>'mimes:jpg,jpeg,png',
            ],
            [
                'required'=>'?????????:attribute',
                'numeric'=>'???????????????',
                'image.required'=>'???????????????',
                'mimes'=>'???????????????jpg,jpeg,png',
                'regex'=>'??????????????????????????????'
            ]
        );
        //dd($validated);
        //dd(StudentYear::find($request->year_id)->name);
        DB::transaction(function() use ($request,$validated,$assign_student) {

            if($request->file('image')){
                $new_img=$request->file('image');
                $save_path=public_path('upload/student_images');

                if (!file_exists($save_path)) {
                    mkdir($save_path, 777, true);
                }

                //??????????????????
                if(file_exists(public_path($assign_student->student_user->image))){
                    @unlink(public_path($assign_student->student_user->image));
                }

                //??????Image??????????????????
                $img_name=hexdec(uniqid()).'.'.strtolower($new_img->getClientOriginalExtension());
                $store_src='upload/student_images/'.$img_name;

                Image::make($new_img)->resize(200,200)->save($store_src);
                $validated['image']=$store_src;
            }

            //dd($validated);

            //update student user
            //??????user ????????????????????????
            unset($validated['discount']);
            unset($validated['year_id']);
            unset($validated['class_id']);
            unset($validated['group_id']);
            unset($validated['shift_id']);
            //dd($validated);
            User::find($assign_student->student_id)->update($validated);

            //update assign student

            $assign_student->update([
                'year_id'=>$request->year_id,
                'class_id'=>$request->class_id,
                'group_id'=>$request->group_id,
                'shift_id'=>$request->shift_id,
            ]);

             //add discount student
            DiscountStudent::find($assign_student->id)->update([
                'discount'=>$request->discount,
            ]);

        });

        $notification=[
            'message'=>'??????Student??????',
            'alert-type'=>'success',
        ];
        //dd($exam_type);
        return redirect()->route('student.reg.index')->with($notification);
    }

    public function delete(Request $request,AssignStudent $assign_student){
        //??????????????????
        if(file_exists(public_path($assign_student->student_user->image))){
            @unlink(public_path($assign_student->student_user->image));
        }
        User::find($assign_student->student_id)->delete();
        DiscountStudent::find($assign_student->id)->delete();
        $assign_student->delete();
        $notification=[
            'message'=>'??????Student??????',
            'alert-type'=>'info',
        ];
        return redirect()->route('student.reg.index')->with($notification);
    }

    public function showpdf(AssignStudent $assign_student){
        $data=$assign_student->get();
        $pdf = PDF::loadView('backend.student.reg.detials_pdf', compact('data'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }

    public function roll_index(){
        
    }

}
