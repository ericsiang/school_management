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
        $fee_category_amounts=FeeCategoryAmount::all();
        //dd($fee_categorys);
        return view('backend.setup.fee_amount.index',compact('fee_category_amounts'));
    }

    public function create(){
        $data=array();
        $data['fee_categories']=FeeCategory::all();
        $data['classes']=StudentClass::all();

        return view('backend.setup.fee_amount.add',compact('data'));
    }
}
