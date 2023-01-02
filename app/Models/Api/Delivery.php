<?php

namespace App\Models\Api;

use App\City;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionsSendRequest;
use App\Models\Rate;
use App\Models\Role;
use App\Models\State as ModelsState;
use App\Models\UsersDetail;
use App\Models\UsersSpecialty;
use App\State;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Delivery extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','img','phone'
    ];
    protected $table ='delivery_men';
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
}
