<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DeliveryManController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderUserController;
use App\Http\Controllers\Api\PublicController;
use App\Http\Controllers\Api\PublicServic;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// user auth
Route::post('login', [UserController::class,'login']);
Route::post('forget-pass-user', [UserController::class,'reset_pass']);
Route::post('verification', [UserController::class,'verification']);
Route::post('register', [UserController::class,'register']);
Route::post('register-user-social', [UserController::class,'register_social']);
Route::post('new-password', [UserController::class,'new_password']);
// company auth
Route::post('login-company', [CompanyController::class,'login']);
Route::post('register-company', [CompanyController::class,'register']);

Route::group(['middleware'=>'auth:api'], function () {
    Route::post('change_password', [UserController::class,'change_password']);
    Route::get('profile', [UserController::class,'show']);
    Route::post('add-favorite', [UserController::class,'add_favorite']);
    Route::get('get-favorite', [UserController::class,'get_favorite']);
    Route::post('add-offer', [OfferController::class,'add_offer']);
    Route::post('update/{id}', [UserController::class,'update']);

    // get tasks
    Route::get('get-tasks', [UserController::class,'get_tasks']);
    Route::get('wraning', [UserController::class,'wraning']);
    // notifaction
    // Route::get('get-notifactions', [UserController::class,'wraning']);

    Route::get('get-notifaction', [UserController::class,'get_notifaction']);
    // announcement
    Route::get('get-announcement', [UserController::class,'get_announcement']);

}); //end of routes

// public services
Route::get('countries', [PublicServic::class,'countries']);
Route::get('cities', [PublicServic::class,'cities']);
Route::get('specialize', [PublicServic::class,'specialize']);
Route::get('social-media', [PublicServic::class,'social_media']);
Route::get('nationality', [PublicServic::class,'nationality']);

// job
Route::get('jobs', [JobController::class,'jobs']);
Route::get('best-job', [JobController::class,'best_jobs']);
Route::get('last-job', [JobController::class,'last_job']);
Route::get('job-details/{id}', [JobController::class,'job_details']);
// search
Route::get('search', [JobController::class,'search']);
Route::get('filter', [JobController::class,'filter']);

// task jobs
Route::post('start-task', [TaskController::class,'start_task']);
Route::post('end-task', [TaskController::class,'end_task']);
 
// support

Route::post('add-support', [PublicController::class,'store_support']);
Route::get('get-support', [PublicController::class,'get_support']);
Route::get('get-common-question', [PublicController::class,'get_common_question']);
Route::get('get-polices', [PublicController::class,'get_polices']);
