<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTraining extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class,'employee_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function traning()
    {
        return $this->belongsTo(TrainingCourse::class,'traning_id');
    }

}
