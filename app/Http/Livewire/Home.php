<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\TrainingCourse;
use App\Models\Notification;
use App\Models\Announcement;
use App\Models\City;
use App\Models\Specialty;
use App\Models\Offer;
use App\Models\User;
use App\Models\Trainer;
use App\Models\EmployeeTraining;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class Home extends Component
{
    public function mount(){
        $this->title='الصفحه الرئيسيه';
    }
    
    public function render()
    {
        // $data=Company::find(1);

        // $data->syncPermissions([18,19,20,21,22,23,24,25,26,9,10,11,12,13,14,15,16,17]);
        if (@auth('company')->user()->role_id != 1) {
            if(@auth('company')->user()->role_id == 2){
                $company_id=auth()->guard('company')->id();
                $total_jobs_disactive=Job::whereCompanyId($company_id)->where('active','!=',1)->count();
                $endDate = \Carbon::today()->addDays(7);
                $notifactions=Notification::whereCompanyId($company_id)->latest()->take(20)->get();
                $announcements=Announcement::whereHas('job',function($job) use ($company_id){
                    $job->where('company_id',$company_id);
                })->with('job','user')->paginate();
                // new
                $total_jobs_finshed=Job::whereCompanyId($company_id)->withCount([
                    'jobTasks as finishedfinshed' => function ($query) { 
                        $query->where('finished',1);
                    },
                    'jobTasks as notfinished' => function ($query) { 
                        $query->where('finished',0);
                    },
                ])->get();
                $jobs_finished=JobTask::whereCompanyId($company_id)->where('finished',1)->count();
                $jobs_not_finished=JobTask::whereCompanyId($company_id)->where('finished',0)->count();
                
                if((@$jobs_finished + @$jobs_not_finished) != 0){
                    $Percentage_of_finished_jobs=(@$jobs_finished /(@$jobs_finished + @$jobs_not_finished))*100;
                    $Percentage_of_not_finished_jobs=(@$jobs_not_finished /(@$jobs_finished + @$jobs_not_finished))*100;
                }else{
                    $Percentage_of_finished_jobs=0;
                    $Percentage_of_not_finished_jobs=0;
                }

                $total_employees=Job::whereCompanyId($company_id)->where('user_id','!=',null)->where('active',1)->count();
                $total_jobs_active=Job::whereCompanyId($company_id)->where('active',1)->count();
                $traning_coureses=TrainingCourse::whereCompanyId($company_id)->count();
                $job_tasks = JobTask::where('company_id',$company_id)->latest()->take(5)->get();
                $all_job_tasks = JobTask::where('company_id',$company_id)->select('lat_start as latitude','long_start as longitude')->get();
                $all_job_tasks = collect($all_job_tasks->toArray());
                $cities=City::whereHas('jobs',function($q) use ($company_id){
                    $q->whereCompanyId($company_id);
                })->withCount('jobs')->get();
                    // dd(json_encode($total_jobs_finshed));  
                $offers=Offer::whereHas('job',function($q) use ($company_id){
                    $q->whereCompanyId($company_id);
                })->count();
                $total_employees_training=EmployeeTraining::whereCompanyId($company_id)->count();
                $last_five_job=JOb::where('company_id',$company_id)->latest()->take(5)->get();
                $employee_tasks = JobTask::where('company_id',$company_id)->where(['started'=>1])->where('date_start','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->where('user_id','!=',null)->latest()->take(3)->get();
            }elseif(@auth('company')->user()->role_id == 3 && @auth('company')->user()->parent_id != 1){
                $company_id=@auth('company')->user()->parent_id;
                $total_jobs_disactive=Job::whereCompanyId($company_id)->where('active','!=',1)->count();
                $endDate = \Carbon::today()->addDays(7);
                $notifactions=Notification::whereCompanyId($company_id)->latest()->take(20)->get();
                $announcements=Announcement::whereHas('job',function($job) use ($company_id){
                    $job->where('company_id',$company_id);
                })->with('job','user')->paginate();
                // new
                $total_jobs_finshed=Job::whereCompanyId($company_id)->withCount([
                    'jobTasks as finishedfinshed' => function ($query) { 
                        $query->where('finished',1);
                    },
                    'jobTasks as notfinished' => function ($query) { 
                        $query->where('finished',0);
                    },
                ])->get();
                $jobs_finished=JobTask::whereCompanyId($company_id)->where('finished',1)->count();
                $jobs_not_finished=JobTask::whereCompanyId($company_id)->where('finished',0)->count();
                
                if((@$jobs_finished + @$jobs_not_finished) != 0){
                    $Percentage_of_finished_jobs=(@$jobs_finished /(@$jobs_finished + @$jobs_not_finished))*100;
                    $Percentage_of_not_finished_jobs=(@$jobs_not_finished /(@$jobs_finished + @$jobs_not_finished))*100;
                }else{
                    $Percentage_of_finished_jobs=0;
                    $Percentage_of_not_finished_jobs=0;
                }
                $total_employees=Job::whereCompanyId($company_id)->where('user_id','!=',null)->where('active',1)->count();
                $total_jobs_active=Job::whereCompanyId($company_id)->where('active',1)->count();
                $traning_coureses=TrainingCourse::whereCompanyId($company_id)->count();
                $job_tasks = JobTask::where('company_id',$company_id)->latest()->take(5)->get();
                $all_job_tasks = JobTask::where('company_id',$company_id)->select('lat_start as latitude','long_start as longitude')->get();
                $all_job_tasks = collect($all_job_tasks->toArray());
                $cities=City::whereHas('jobs',function($q) use ($company_id){
                    $q->whereCompanyId($company_id);
                })->withCount('jobs')->get();
                    // dd(json_encode($total_jobs_finshed));  
                $offers=Offer::whereHas('job',function($q) use ($company_id){
                    $q->whereCompanyId($company_id);
                })->count();
                $total_employees_training=EmployeeTraining::whereCompanyId($company_id)->count();
                $last_five_job=JOb::where('company_id',$company_id)->latest()->take(5)->get();
                $employee_tasks = JobTask::where('company_id',$company_id)->where(['started'=>1])->where('date_start','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->where('user_id','!=',null)->latest()->take(3)->get();
            }elseif (@auth('company')->user()->role_id == 3 && @auth('company')->user()->parent_id == 1) {
                // $total_employees=Job::where('user_id','!=',null)->where('active',1)->count();
                    $total_jobs_active=Job::where('active',1)->count();
                    $total_jobs_disactive=Job::where('active','!=',1)->count();
                    $endDate = \Carbon::today()->addDays(7);
                    $job_tasks=JobTask::with('user')->where('active',1)->whereBetween('date',[date('Y-m-d'),$endDate])->get();
                    $notifactions=Notification::latest()->take(20)->get();
                    $announcements=Announcement::with('job','user')->paginate();
                    $total_jobs_finshed=Job::withCount([
                        'jobTasks as finishedfinshed' => function ($query) { 
                            $query->where('finished',1);
                        },
                        'jobTasks as notfinished' => function ($query) { 
                            $query->where('finished',0);
                        },
                    ])->get();

                    $jobs_finished=JobTask::where('finished',1)->count();
                    $jobs_not_finished=JobTask::where('finished',0)->count();
                    
                    if((@$jobs_finished + @$jobs_not_finished) != 0){
                        $Percentage_of_finished_jobs=(@$jobs_finished /(@$jobs_finished + @$jobs_not_finished))*100;
                        $Percentage_of_not_finished_jobs=(@$jobs_not_finished /(@$jobs_finished + @$jobs_not_finished))*100;
                    }else{
                        $Percentage_of_finished_jobs=0;
                        $Percentage_of_not_finished_jobs=0;
                    }
                    $total_employees=User::where('active',1)->count();
                    $total_jobs_active=Job::where('active',1)->count();
                    $traning_coureses=TrainingCourse::count();
                    $job_tasks = JobTask::latest()->take(5)->get();
                    $all_job_tasks = JobTask::select('lat_start as latitude','long_start as longitude')->get();
                    $all_job_tasks = collect($all_job_tasks->toArray());
                    $cities=City::whereHas('jobs')->withCount('jobs')->get();
                    $offers=Offer::count();
                    $total_employees_training=EmployeeTraining::count();
                    $last_five_job=JOb::latest()->take(5)->get();
                    $employee_tasks = JobTask::where(['started'=>1])->where('date_start','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->where('user_id','!=',null)->latest()->take(3)->get();
            }

        }else{
            $company_id=auth()->guard('company')->id();
            $total_employees=User::where('active',1)->count();
            $total_jobs_active=Job::where('active',1)->count();
            $total_jobs_disactive=Job::where('active','!=',1)->count();
            $endDate = \Carbon::today()->addDays(7);
            $job_tasks=JobTask::with('user')->where('active',1)->whereBetween('date',[date('Y-m-d'),$endDate])->get();
            $notifactions=Notification::latest()->take(20)->get();
            $announcements=Announcement::with('job','user')->paginate();
            $total_jobs_finshed=Job::withCount([
                'jobTasks as finishedfinshed' => function ($query) { 
                    $query->where('finished',1);
                },
                'jobTasks as notfinished' => function ($query) { 
                    $query->where('finished',0);
                },
            ])->get();

            $jobs_finished=JobTask::where('finished',1)->count();
            $jobs_not_finished=JobTask::where('finished',0)->count();
            
            $Percentage_of_finished_jobs=(@$jobs_finished /(@$jobs_finished + @$jobs_not_finished))*100;
            $Percentage_of_not_finished_jobs=(@$jobs_not_finished /(@$jobs_finished + @$jobs_not_finished))*100;
            // $total_employees=Job::where('user_id','!=',null)->where('active',1)->count();
            $total_jobs_active=Job::where('active',1)->count();
            $traning_coureses=TrainingCourse::count();
            $job_tasks = JobTask::latest()->take(5)->get();
            $all_job_tasks = JobTask::select('lat_start as latitude','long_start as longitude')->get();
            $all_job_tasks = collect($all_job_tasks->toArray());
            $cities=City::whereHas('jobs')->withCount('jobs')->get();
            $offers=Offer::count();
            $total_employees_training=EmployeeTraining::count();
            $last_five_job=Job::latest()->take(5)->get();
            $employee_tasks = JobTask::where(['started'=>1])->where('date_start','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->where('user_id','!=',null)->latest()->take(3)->get();
        }
        $specialist=Specialty::count();
        $companies_count=Company::where('role_id',2)->count();
        $job_count=JOb::where('finished',1)->count();
        $job_not_complete_count=Job::where('finished',0)->count();
        $total_trainers=Trainer::count();
//         $permission = Permission::create(['name' => 'مستخدمين لوحه التحكم']);
// dd($permission);
        return view('livewire.home',compact('employee_tasks','total_trainers','job_not_complete_count','companies_count','job_count','specialist','total_jobs_active','last_five_job','total_employees_training','offers','cities','all_job_tasks','traning_coureses','Percentage_of_not_finished_jobs','Percentage_of_finished_jobs','total_jobs_finshed','total_jobs_disactive','total_employees','job_tasks','notifactions','announcements'))->extends('layouts.master');
    }
}