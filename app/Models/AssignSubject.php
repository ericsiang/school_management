<?php

namespace App\Models;

use App\Models\StudentClass;
use App\Models\SchoolSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignSubject extends Model
{
    use HasFactory;
    protected $fillable=[
        'class_id',
        'subject_id',
        'full_mark',
        'pass_mark',
        'subjective_mark',
    ];

    public function student_subject(){
        return $this->belongsTo(SchoolSubject::class,'subject_id','id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
}
