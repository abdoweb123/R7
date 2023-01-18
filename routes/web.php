<?php


use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferedTaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ReachedUsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobTaskController;
use App\Http\Controllers\JobRequirementController;
use App\Http\Controllers\JobTermsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Livewire\Users\Details;
use App\Http\Livewire\TrainingCourses\TrainingCourses;
use App\Http\Livewire\UserTrainings\UserTrainings;
use App\Http\Livewire\Reports\Absences;
use App\Http\Livewire\Reports\UserMony;
use App\Http\Livewire\Reports\Trainings;
use App\Http\Livewire\Reports\Employment;
use App\Http\Livewire\Reports\Latest;
use App\Http\Livewire\Home;
use App\Http\Livewire\Polices\PoliceEdit;
use App\Http\Livewire\Polices\Polices;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::get('/',Home::class)->middleware('auth:company');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:company']], function(){
    Route::get('/dashboard',Home::class)->middleware('auth:company');

    // Route::get('', function (){ return view('auth.login'); });

    Route::middleware('admin_admin')->group(function () {
        Route::resource('countries',CountryController::class)->except('show','edit','create')->middleware('admin_admin');
        Route::resource('nationalities',NationalityController::class)->except('show','edit','create');
        Route::resource('cities',CityController::class)->except('show','edit','create');
        Route::resource('reachedUs',ReachedUsController::class)->except('show','edit','create');
        Route::resource('specialties',SpecialtyController::class)->except('show','edit','create');
        Route::post('add-wraning','UserController@add_wraning')->name('add-wraning');
        Route::resource('companies',CompanyController::class);

        // company
        Route::get('company/login/page', [CompanyController::class, 'getLoginPage'])->name('getLoginPage.company');
        Route::post('company/login', [CompanyController::class, 'login'])->name('login.company');
        Route::get('company/logout', [CompanyController::class, 'logout'])->name('logout.company');
        Route::get('company/dashboard', [CompanyController::class, 'companyDashboard'])->name('companyDashboard');
       // ploices
       Route::get('polices',Polices::class)->name('polices');
       Route::get('police-edit/{id}',PoliceEdit::class)->name('police-edit');
   
    });

    //   users
    Route::resource('users',UserController::class);


    // jobs
    Route::resource('jobs',JobController::class);
    Route::get('all/jobs/{job_id}',[JobController::class,'returnJob'])->name('returnJob');

    Route::resource('jobTasks',JobTaskController::class)->except('show','index');
    Route::get('jobTasks/create/{job_id}/{company_id}',[JobTaskController::class,'create'])->name('jobTasks.create');
    Route::get('all/jobTasks/{job_id}/{company_id}',[JobTaskController::class,'index'])->name('jobTasks.index');


    Route::resource('jobRequirements',JobRequirementController::class)->except('show','edit','create','index');
    Route::get('jobRequirements/create/{job_id}/{company_id}}',[JobRequirementController::class,'create'])->name('jobRequirements.create');
    Route::get('all/jobRequirements/{job_id}/{company_id}',[JobRequirementController::class,'index'])->name('jobRequirements.index');

    Route::resource('jobTerms',JobTermsController::class)->except('show','edit','create','index');
    Route::get('jobTerms/create/{job_id}/{company_id}}',[JobTermsController::class,'create'])->name('jobTerms.create');
    Route::get('all/jobTerms/{job_id}/{company_id}',[JobTermsController::class,'index'])->name('jobTerms.index');


    Route::get('all/offers/{job_id?}/{company_id?}',[OfferController::class,'index'])->name('offers.index');
    Route::put('update/offers/{id}',[OfferController::class,'update'])->name('offer.update');
    Route::delete('delete/offers/{id}',[OfferController::class,'destroy'])->name('offer.destroy');
    Route::get('accept-offer/{id}',[OfferController::class,'accept_offer']);
    Route::post('make/jobTask/from/offers/page',[OfferController::class,'makeJobTaskFromOffer'])->name('makeJobTaskFromOffer');

    Route::get('all/offeredTasks',[OfferedTaskController::class,'index'])->name('offeredTasks.index');
    Route::put('update/offeredTask/{id}',[OfferedTaskController::class,'update'])->name('offeredTask.update');
    Route::delete('delete/offeredTasks/{id}',[OfferedTaskController::class,'destroy'])->name('offeredTask.destroy');


    // announcements (reward , warning)
    Route::resource('announcements',AnnouncementController::class);
    Route::post('add-dues',[AnnouncementController::class,'add_dues'])->name('add-dues');

    // user details
    Route::get('user-details/{user_id}',Details::class)->name('offeredTasks.index');
    // 
    Route::get('traning-course',TrainingCourses::class)->name('traning-course');
    Route::get('user-traning',UserTrainings::class)->name('traning-course');
// reports
    Route::get('absences',Absences::class)->name('absences');
    Route::get('user-moey',UserMony::class)->name('user-moey');
    Route::get('tranings',Trainings::class)->name('tranings');
    Route::get('employments',Employment::class)->name('employments');
    Route::get('latest',Latest::class)->name('latest');
 
}); //end of routes

