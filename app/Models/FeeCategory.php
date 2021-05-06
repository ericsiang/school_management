<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeeCategoryAmount;

class FeeCategory extends Model
{
    use HasFactory;
    protected $table = 'fee_categories';
    protected $fillable=[
        'name'
    ];

    public function fee_category_amount(){
        return $this->hasMany(FeeCategoryAmount::class,'id','fee_category_id');
    }
}
