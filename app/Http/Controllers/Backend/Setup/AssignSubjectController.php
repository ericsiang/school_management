<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class AssignSubjectController extends Controller
{
    public function index(){
        $assign_subjects=AssignSubject::select('id','class_id')
                                                    ->groupBy('class_id')
                                                    //->with('fee_category')
                                                    ->get();

        return view('backend.setup.assign_subject.index',compact('assign_subjects'));
    }

    public function create(){
        $data=array();
        $data['school_subjects']=SchoolSubject::all();
        $data['classes']=StudentClass::all();

        return view('backend.setup.assign_subject.add',compact('data'));
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'class_id'=>'required',
                'subject_id.*'=>'required',
                'full_mark.*'=>'required|numeric',
                'pass_mark.*'=>'required|numeric',
                'subjective_mark.*'=>'required|numeric',
            ],
        );

        $countClass=count($request->subject_id);
        if(!empty($countClass)){
            for($i=0;$i<$countClass;$i++){
                AssignSubject::create([
                    'class_id'=>$request->class_id,
                    'subject_id'=>$request->subject_id[$i],
                    'full_mark'=>$request->full_mark[$i],
                    'pass_mark'=>$request->pass_mark[$i],
                    'subjective_mark'=>$request->subjective_mark[$i],
                ]);
            }
        }
        //dd($validated);
        //dd($fee_category);
        $notification=[
            'message'=>'新增Assign Subject成功',
            'alert-type'=>'success',
        ];
        //dd($fee_category);
        return redirect()->route('assign_subject.index')->with($notification);
    }

    public function edit($class_id){
        $assign_subjects=AssignSubject::WHERE('class_id',$class_id)
                                                    ->orderBy('subject_id','asc')
                                                    ->get();
        $data=array();
        $data['school_subjects']=SchoolSubject::all();
        $data['classes']=StudentClass::all();
        return view('backend.setup.assign_subject.update',compact('assign_subjects','data'));
    }

    public function update(Request $request,$class_id){
        //dd($request->all());
        $validated=$request->validate(
            [
                'class_id'=>'required',
                'subject_id.*'=>'required',
                'full_mark.*'=>'required|numeric',
                'pass_mark.*'=>'required|numeric',
                'subjective_mark.*'=>'required|numeric',
            ],
        );
        //dd($validated);

        $countClass=count(isset($request->subject_id) ? $request->subject_id : array());
        if(empty($countClass)){
            $assign_subjects=AssignSubject::WHERE('class_id',$class_id)
                                                    ->orderBy('subject_id','asc')
                                                    ->get();
            $data=array();
            $data['school_subjects']=SchoolSubject::all();
            $data['classes']=StudentClass::all();
            $notification=[
                'message'=>'尚未選擇Student Subject',
                'alert-type'=>'error',
            ];

            return redirect()->route('assign_subject.edit',compact('assign_subjects','data','class_id'))->with($notification);
        }else{
            AssignSubject::WHERE('class_id',$class_id)->delete();
            for($i=0;$i<$countClass;$i++){
                AssignSubject::create([
                    'class_id'=>$request->class_id,
                    'subject_id'=>$request->subject_id[$i],
                    'full_mark'=>$request->full_mark[$i],
                    'pass_mark'=>$request->pass_mark[$i],
                    'subjective_mark'=>$request->subjective_mark[$i],
                ]);
            }

            $notification=[
                'message'=>'修改Assign Subject成功',
                'alert-type'=>'success',
            ];
            return redirect()->route('assign_subject.index')->with($notification);
        }


    }

    public function detials($class_id){
        $assign_subjects=AssignSubject::WHERE('class_id',$class_id)
                                                    ->orderBy('subject_id','asc')
                                                    ->get();
        return view('backend.setup.assign_subject.detials',compact('assign_subjects'));
    }
}
