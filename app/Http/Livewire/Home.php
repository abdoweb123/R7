<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\Notification;
use App\Models\Announcement;
use Carbon\Carbon;
class Home extends Component
{
    public function render()
    {
        if (auth('company')->user()->role_id != 1) {
            $company_id=auth()->guard('company')->id();
            $total_employees=Job::whereCompanyId($company_id)->where('user_id','!=',null)->where('active',1)->count();
            $total_jobs_active=Job::whereCompanyId($company_id)->where('active',1)->count();
            $total_jobs_disactive=Job::whereCompanyId($company_id)->where('active','!=',1)->count();
            $endDate = \Carbon::today()->addDays(7);
            $job_tasks=JobTask::with('user')->whereCompanyId($company_id)->where('active',1)->whereBetween('date',[date('Y-m-d'),$endDate])->get();
            $notifactions=Notification::whereCompanyId($company_id)->latest()->take(20)->get();
            $announcements=Announcement::whereHas('job',function($job) use ($company_id){
                $job->where('company_id',$company_id);
            })->with('job','user')->paginate();
        }else{
            $company_id=auth()->guard('company')->id();
            $total_employees=Job::where('user_id','!=',null)->where('active',1)->count();
            $total_jobs_active=Job::where('active',1)->count();
            $total_jobs_disactive=Job::where('active','!=',1)->count();
            $endDate = \Carbon::today()->addDays(7);
            $job_tasks=JobTask::with('user')->where('active',1)->whereBetween('date',[date('Y-m-d'),$endDate])->get();
            $notifactions=Notification::latest()->take(20)->get();
            $announcements=Announcement::with('job','user')->paginate();
        }

        return view('livewire.home',compact('total_jobs_active','total_jobs_disactive','total_employees','job_tasks','notifactions','announcements'))->extends('layouts.master');
    }
}