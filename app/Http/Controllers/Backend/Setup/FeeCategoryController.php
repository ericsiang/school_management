<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeCategoryController extends Controller
{
    public function index(){
        $fee_categorys=FeeCategory::all();
        //dd($fee_categorys);
        return view('backend.setup.fee_category.index',compact('fee_categorys'));
    }

    public function create(){
        return view('backend.setup.fee_category.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:fee_categories',
            ],
        );
        //dd($validated);

        $fee_category=FeeCategory::create($validated);
        //dd($fee_category);
        $notification=[
            'message'=>'新增Fee Category成功',
            'alert-type'=>'success',
        ];
        //dd($fee_category);
        return redirect()->route('fee_category.index')->with($notification);
    }

    public function edit(FeeCategory $fee_category){

        return view('backend.setup.fee_category.update',compact('fee_category'));
    }

    public function update(Request $request,FeeCategory $fee_category){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:fee_categories',
            ],
        );
        //dd($validated);

        $fee_category=$fee_category->update($validated);
        $notification=[
            'message'=>'修改Fee Category成功',
            'alert-type'=>'success',
        ];
        //dd($fee_category);
        return redirect()->route('fee_category.index')->with($notification);
    }

    public function delete(Request $request,FeeCategory $fee_category){
        $fee_category->delete();
        $notification=[
            'message'=>'刪除Fee Category成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('fee_category.index')->with($notification);
    }
}
