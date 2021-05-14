<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;

class StudentRollController extends Controller
{
    public function index(){
        $data=[];
        $data['classes']=StudentClass::all();
        $data['years']=StudentYear::all();
        $data['year_id']='';
        $data['class_id']='';

        //dd($exam_types);
        return view('backend.student.roll.index',compact('data'));
    }

    public function getStudents(Request $request){

        $data=[];
        $data['classes']=StudentClass::all();
        $data['years']=StudentYear::all();
        $data['year_id']=$request->year_id;
        $data['class_id']=$request->class_id;
        $assign_students=AssignStudent::with(['student_user'])
                                        ->where('id','>','0')
                                        ->when($request->year_id, function($query) use ($request){
                                            $query->where('year_id',$request->year_id);
                                        })
                                        ->when($request->class_id, function($query) use ($request){
                                            $query->where('class_id',$request->class_id);
                                        })
                                        ->get()
                                        ->toArray();
        return response()->json($assign_students);
    }

    public function store(Request $request){
        $year_id=$request->year_id;
        $class_id=$request->class_id;
        $student_id_arr=$request->student_id;
        $roll_arr=$request->roll;

        if(!empty($student_id_arr)){
            foreach($student_id_arr as $k => $student_id){
                AssignStudent::where('student_id',$student_id)->update(['roll'=>$roll_arr[$k]]);
            }

            $notification=[
                'message'=>'Roll Generated Successfully',
                'alert-type'=>'success',
            ];
        }else{
            $notification=[
                'message'=>'無任何學生資料',
                'alert-type'=>'error',
            ];
        }

        return redirect()->route('student.roll.index')->with($notification);
    }

}
