<?php

namespace App\Models;

use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeCategoryAmount extends Model
{
    use HasFactory;
    protected $fillable=[
        'fee_category_id',
        'class_id',
        'amount',
    ];

    public function fee_category(){
        return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
}
