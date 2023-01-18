<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function jobs()
    {
        $select_specialize=['id','job_description','job_type','company_id','duration_by_day','city_id','start_time','end_time','started','finished','latitude','longitude','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $data=Job::with('city:id,name','company:id,company_name,logo_image,cover_image')
                    ->select($select_specialize)
                    ->where('active',1)
                    ->get();
        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']=$err_message;
            return response()->json($data_json, 200);
        }
    }
    public function last_job()
    {
        $select_specialize=['id','job_description','job_type','company_id','duration_by_day','city_id','start_time','end_time','started','finished','latitude','longitude','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $data=Job::with('city:id,name','company:id,company_name,logo_image,cover_image')->select($select_specialize)->take(15)->where('active',1)->latest()->get();
        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']=$err_message;
            return response()->json($data_json, 200);
        }
    }
    public function best_jobs()
    {
        $select_specialize=['id','job_description','job_type','company_id','duration_by_day','city_id','start_time','end_time','started','finished','latitude','longitude','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $data=Job::with('city:id,name','company:id,company_name,logo_image,cover_image')
                    ->select($select_specialize)->take(15)
                    ->withCount('offers')
                    // ->whereHas('offers', null, '>', 5)
                    ->orderBy('offers_count', 'desc')
                    ->where('active',1)
                    ->get();
        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']=$err_message;
            return response()->json($data_json, 200);
        }
    }
    public function job_details($id)
    {
        $select_specialize=['id','job_description','job_type','company_id','duration_by_day','city_id','start_time','end_time','started','finished','latitude','longitude','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $data=Job::with('city:id,name','company:id,company_name,logo_image,cover_image','specialty:id,name','user:id,full_name','jobTasks','JobRequirements','JobTerms','offers','offeredTasks')->find($id);
        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']=$err_message;
            return response()->json($data_json, 200);
        }
    }
    public function search()
    {
        $select_specialize=['id','job_description','job_type','company_id','duration_by_day','city_id','start_time','end_time','started','finished','latitude','longitude','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $data=Job::with('city:id,name','company:id,company_name,logo_image,cover_image')
                    ->select($select_specialize)
                    ->where('job_description','like','%'.request('name').'%')
                    ->where('active',1)
                    ->get();

        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']=$err_message;
            return response()->json($data_json, 200);
        }
    }
    public function filter()
    {
        $select_specialize=['id','job_description','job_type','company_id','duration_by_day','city_id','start_time','end_time','started','finished','latitude','longitude','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $data=Job::with('city:id,name','company:id,company_name,logo_image,cover_image')
                    ->select($select_specialize)
                    ->where('active',1);
        if(request('specialize_id') != null){
            $data->where('specialization_id',request('specialize_id'));
        }
        if(request('city_id') != null){
            $data->where('city_id',request('city_id'));
        }
        if(request('min_salary') != null && request('max_salary') != null){
            $data->whereBetween('minimum_cost',[request('min_salary'),request('max_salary')]);
        }
        // if(request('max_salary') != null){
        //     $data->where('maximum_cost','<=',request('max_salary'));
        // }
        if(request('job_type') != null){
            $data->where('job_type',request('job_type'));
        }
        $data_new=$data->get();
        if ($data_new) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_new;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']=$err_message;
            return response()->json($data_json, 200);
        }
    }
}
