<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\Job;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Notification;
class JobController extends Controller
{

    /*** index function ***/
    public function index()
    {
       
        if (auth('company')->user()->role_id == 1 || auth('company')->user()->parent_id == 1) {
            $data['jobs'] = Job::latest()->paginate(10);
        }else{
            if(auth('company')->user()->role_id == 2){
                $company_id=auth('company')->user()->id;
            }else{
                $company_id=auth('company')->user()->parent_id;
            }
            $data['jobs'] = Job::where('company_id',$company_id)->latest()->paginate(10);
        }
        return view('jobs.index', compact('data'));
    }

    public function project_expaire()
    {
       
        if (auth('company')->user()->role_id == 1 || auth('company')->user()->parent_id == 1) {
            $data['jobs'] = Job::whereHas('jobTasks',function($q){
                $q->where('end_date','<=',date('Y-m-d'));
            })->latest()->paginate(10);
        }else{
            if(auth('company')->user()->role_id == 2){
                $company_id=auth('company')->user()->id;
            }else{
                $company_id=auth('company')->user()->parent_id;
            }
            $data['jobs'] = Job::whereHas('jobTasks',function($q){
                $q->where('end_date','<=',date('Y-m-d'));
            })->where('company_id',$company_id)->latest()->paginate(10);
        }
        return view('jobs.project_expaire', compact('data'))->extends('layouts.master',['data_table'=>true]);
    }



    /*** create function ***/
    public function create()
    {
        // $data['companies'] = Company::select('id','company_name')->get();
        $data['cities'] = City::select('id','name')->get();
        $data['specialties'] = Specialty::select('id','name')->get();

        return view('jobs.create', compact('data'));
    }




    /*** store function ***/
    public function store(JobRequest $request)
    {
        $job = new Job();
        $job->company_id = $request['company_id'];
        $job->city_id = $request['city_id'];
        $job->specialization_id = $request['specialization_id'];
        $job->user_id = null;
        $job->latitude = $request['latitude'];
        $job->longitude = $request['longitude'];
        $job->duration_by_day = $request['duration_by_day'];
        $job->minimum_cost = $request['minimum_cost'];
        $job->payment_type = $request['payment_type'];
        $job->job_type = $request['job_type'];
        $job->job_description = $request['job_description'];
        $job->start_time = $request['start_time'];
        $job->end_time = $request['end_time'];
        $job->started = false;
        $job->finished = false;
        $job->active = true;
        $job->save();
        if($job){
            $noti=new Notification();
            $noti->user_id=$job->id;
            $noti->company_id=$request['company_id'];
            $noti->notes='تم اضافه الوظيفه' .'('. $request['job_description'].')'. 'من قبل ' . auth('company')->user()->company_name;
            $noti->save();
        }
        return redirect()->route('jobTasks.create',[$job->id,$job->company_id])->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** edit function ***/
    public function edit(Job $job)
    {
        $data['companies'] = Company::where('role_id',2)->select('id','company_name')->get();
        $data['cities'] = City::select('id','name')->get();
        $data['specialties'] = Specialty::select('id','name')->get();

        return view('jobs.edit', compact('data','job'));
    }



    /*** edit function ***/
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }




    /*** update function ***/
    public function update(JobRequest $request, Job $job)
    {
        $job->update([
            'company_id'=>$request['company_id'],
            'city_id'=>$request['city_id'],
            'specialization_id'=>$request['specialization_id'],
            'latitude'=>$request['latitude'],
            'longitude'=>$request['longitude'],
            'duration_by_day'=>$request['duration_by_day'],
            'minimum_cost'=>$request['minimum_cost'],
            'payment_type'=>$request['payment_type'],
            'job_type'=>$request['job_type'],
            'job_description'=>$request['job_description'],
            'start_time'=>$request['start_time'],
            'end_time'=>$request['end_time'],
            'active'=>$request['active'],
        ]);

        return redirect()->route('jobs.index')->with('alert-success','تم تحديث البيانات بنجاح');
    }




    /*** destroy function ***/
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('alert-success','تم حذف البيانات بنجاح');
    }



    /*** index function ***/
    public function returnJob($job_id)
    {
        $data['jobs'] = Job::where('id',$job_id)->paginate(10);
        return view('jobs.index', compact('data'));
    }



} //end of class
