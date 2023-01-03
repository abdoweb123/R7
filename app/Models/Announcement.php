<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory , SoftDeletes ;


    protected $fillable = ['job_id', 'user_id','notes','amount','type'];




    /*** start relations ***/

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /*** end relations ***/



} //end of class
