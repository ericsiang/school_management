<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignStudent extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function student_user(){
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function student_year(){
        return $this->belongsTo(StudentYear::class,'year_id','id');
    }

    public function student_group(){
        return $this->belongsTo(StudentGroup::class,'group_id','id');
    }

    public function student_shift(){
        return $this->belongsTo(StudentShift::class,'group_id','id');
    }

    public function student_discount(){
        return $this->belongsTo(DiscountStudent::class,'id','assign_student_id');
    }

}
