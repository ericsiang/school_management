<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
{
    public function index(){
        $designations=Designation::all();
        //dd($designations);
        return view('backend.setup.designation.index',compact('designations'));
    }

    public function create(){
        return view('backend.setup.designation.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:designations',
            ],
        );
        //dd($validated);

        $designation=Designation::create($validated);
        //dd($designation);
        $notification=[
            'message'=>'新增Designation成功',
            'alert-type'=>'success',
        ];
        //dd($designation);
        return redirect()->route('designation.index')->with($notification);
    }

    public function edit(Designation $designation){

        return view('backend.setup.designation.update',compact('designation'));
    }

    public function update(Request $request,Designation $designation){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:fee_categories',
            ],
        );
        //dd($validated);

        $designation=$designation->update($validated);
        $notification=[
            'message'=>'修改Designation成功',
            'alert-type'=>'success',
        ];
        //dd($designation);
        return redirect()->route('designation.index')->with($notification);
    }

    public function delete(Request $request,Designation $designation){
        
        $designation->delete();
        $notification=[
            'message'=>'刪除Designation成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('designation.index')->with($notification);
    }
}
