<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCourse extends Model
{
    use HasFactory;
    public function compnay()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
}
