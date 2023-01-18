<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\ReachedUs;
use App\Models\Specialty;
use Illuminate\Http\Request;

class PublicServic extends Controller
{
    public function countries()
    {
        $select_country=['id','name','active','image','code'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            // $select_country=['id','name_en as name','active'];
            $err_message='not found data';
        }
        $data=Country::select($select_country)->where('active',1)->get();
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
    public function cities()
    {
        $select_city=['id','name','country_id','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            // $select_city=['id','name_en as name','country_id','active'];
            $err_message='not found data';
        }
        $data=City::with('country:id,name')->select($select_city)->where('active',1)->get();
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
    public function specialize()
    {
        $select_specialize=['id','name','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            // $select_specialize=['id','name_en as name','country_id','active'];
            $err_message='not found data';
        }
        $data=Specialty::select($select_specialize)->where('active',1)->get();
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
    public function social_media()
    {
        $select_specialize=['id','name'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            // $select_specialize=['id','name_en as name','country_id','active'];
            $err_message='not found data';
        }
        $data=ReachedUs::select($select_specialize)->get();
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
    public function nationality()
    {
        $select_specialize=['id','name','active'];
        $err_message='لا يوجد بيانات';
        if(request()->header('lang') == 'en' ){
            // $select_specialize=['id','name_en as name','country_id','active'];
            $err_message='not found data';
        }
        $data=Nationality::select($select_specialize)
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
}
