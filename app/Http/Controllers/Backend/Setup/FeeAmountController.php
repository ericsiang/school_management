<?php

namespace App\Http\Controllers\Backend\Setup;


use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class FeeAmountController extends Controller
{
    public function index(){
        $fee_category_amounts=FeeCategoryAmount::select('id','fee_category_id')
                                                    ->groupBy('fee_category_id')
                                                    //->with('fee_category')
                                                    ->get();

        return view('backend.setup.fee_amount.index',compact('fee_category_amounts'));
    }

    public function create(){
        $data=array();
        $data['fee_categories']=FeeCategory::all();
        $data['classes']=StudentClass::all();

        return view('backend.setup.fee_amount.add',compact('data'));
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'fee_category_id'=>'required',
                'amount.*'=>'required|numeric',
            ],
        );

        $countClass=count($request->class_id);
        if(!empty($countClass)){
            for($i=0;$i<$countClass;$i++){
                FeeCategoryAmount::create([
                    'fee_category_id'=>$request->fee_category_id,
                    'class_id'=>$request->class_id[$i],
                    'amount'=>$request->amount[$i],
                ]);
            }
        }
        //dd($validated);
        //dd($fee_category);
        $notification=[
            'message'=>'新增Fee Category Amount成功',
            'alert-type'=>'success',
        ];
        //dd($fee_category);
        return redirect()->route('fee_category_amount.index')->with($notification);
    }

    public function edit($fee_category_id){
        $fee_category_amounts=FeeCategoryAmount::WHERE('fee_category_id',$fee_category_id)
                                                    ->orderBy('class_id','asc')
                                                    ->get();
        $data=array();
        $data['fee_categories']=FeeCategory::all();
        $data['classes']=StudentClass::all();
        return view('backend.setup.fee_amount.update',compact('fee_category_amounts','data'));
    }

    public function update(Request $request,$fee_category_id){
        //dd($request->all());
        $validated=$request->validate(
            [
                'fee_category_id'=>'required',
                'amount.*'=>'required|numeric',
            ],
        );
        //dd($validated);

        $countClass=count(isset($request->class_id) ? $request->class_id : array());
        if(empty($countClass)){
            $fee_category_amounts=FeeCategoryAmount::WHERE('fee_category_id',$fee_category_id)
                                                    ->orderBy('class_id','asc')
                                                    ->get();
            $data=array();
            $data['fee_categories']=FeeCategory::all();
            $data['classes']=StudentClass::all();
            $notification=[
                'message'=>'尚未選擇Student Class',
                'alert-type'=>'error',
            ];

            return redirect()->route('fee_category_amount.edit',compact('fee_category_amounts','data','fee_category_id'))->with($notification);
        }else{
            FeeCategoryAmount::WHERE('fee_category_id',$fee_category_id)->delete();
            for($i=0;$i<$countClass;$i++){
                FeeCategoryAmount::create([
                    'fee_category_id'=>$request->fee_category_id,
                    'class_id'=>$request->class_id[$i],
                    'amount'=>$request->amount[$i],
                ]);
            }

            $notification=[
                'message'=>'修改Fee Category Amount成功',
                'alert-type'=>'success',
            ];
            return redirect()->route('fee_category_amount.index')->with($notification);
        }


    }

    public function detials($fee_category_id){
        $fee_category_amounts=FeeCategoryAmount::WHERE('fee_category_id',$fee_category_id)
                                                    ->orderBy('class_id','asc')
                                                    ->get();
        return view('backend.setup.fee_amount.detials',compact('fee_category_amounts'));
    }

}
