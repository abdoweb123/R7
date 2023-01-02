<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;
    public function job()
    {
        return $this->hasOne(Job::class,'id','favo_id')->with('city:id,name','company:id,company_name,logo_image,cover_image','specialty:id,name','user:id,full_name','jobTasks','JobRequirements','JobTerms','offers','offeredTasks');
    }
}
