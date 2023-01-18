<?php

namespace App\Http\Controllers;

use App\Models\JobTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function start_task(Request $request)
    {
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $user_id=Auth::id();
        $data=JobTask::find($request->task_id);
        $data->started=1;
        $data->lat_start=$request->lat_start;
        $data->long_start=$request->long_start;
        $data->date_start=$request->date;
        $data->save();
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
    public function end_task(Request $request)
    {
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            $err_message='not found data';
        }
        $user_id=Auth::id();
        $data=JobTask::find($request->task_id);
        $data->finished=1;
        $data->lat_end=$request->lat_end;
        $data->long_end=$request->long_end;
        $data->end_date=$request->date;
        $data->save();
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
}
