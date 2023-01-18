<?php

namespace App\Models\Api;

use App\City;
use App\Models\City as ModelsCity;
use App\Models\Nationality;
use App\Models\ReachedUs;
use App\Models\Specialty;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'phone', 'profile_image', 'full_name', 'nationality_id',
    'gender', 'birthDate', 'email', 'id_number', 'identity_image',
    'relative_phone', 'city_id', 'area', 'workingArea_id', 'health_insurance',
    'antecedents', 'reachedUs_id', 'arabic_video_url', 'english_video_url','password',
    'active', 'specialty_id'
  ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }


    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }


    public function city()
    {
        return $this->belongsTo(ModelsCity::class,'city_id');
    }


    public function workingArea()
    {
        return $this->belongsTo(ModelsCity::class,'workingArea_id');
    }


    public function reachedUs()
    {
        return $this->belongsTo(ReachedUs::class,'reachedUs_id');
    }


    public function specilaty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id');
    }


    public function job()
    {
        return $this->hasMany(Job::class,'user_id');
    }


    public function jobTasks()
    {
        return $this->hasMany(JobTask::class,'user_id');
    }


    public function offers()
    {
        return $this->hasMany(Offer::class,'user_id');
    }


    public function offeredTasks()
    {
        return $this->hasMany(OfferedTask::class,'user_id');
    }
}
