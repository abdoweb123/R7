<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\CommonQuestion;
use App\Models\Police;
use App\Models\StaticTable;
use App\Models\ContactUs;

class PublicController extends Controller
{
    public $successStatus=200;
    public function store_support(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required',
            'mail' => 'required',
        ],[
            'phone.required' => 'رقم الهاتف  مطلوب',
            'mail.required' => 'الايميل  مطلوب',
        ]);

        $this->message='تم الاضافه بنجاح';
      if (request()->header('lang') == 'ar') {
           $this->message='تم الاضافه بنجاح';
       }elseif (request()->header('lang') == 'en') {
            $this->message='successfully registered';
       }
        if ($validator->fails()) {
            $errors=$validator->errors();
            $error_mg='';
            foreach ($errors->all() as $error) {
                $error_mg.=$error.' . ';
            }
            $data_json['status']=false;
            $data_json['message']=$error_mg;
            return response()->json($data_json, 200);
        }
        $data=new Support();
        $data->phone=$request->phone;
        $data->mail=$request->mail;
        $data->message=$request->message;
        $data->save();

        $data_json['status']=true;
        $data_json['message']=$this->message;
        $data_json['data']=$data;
        return response()->json($data_json, $this->successStatus);
    }
    public function get_support()
    {
        $data=Support::select('id','phone','mail','message')->paginate();
        if($data){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='لا يوجد بيانات';
            return response()->json($data_json, $this->successStatus);
        }
      
    }
    public function get_common_question()
    {
        $data=CommonQuestion::select('id','question','answer')->where('is_active',"Y")->get();
        if($data){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='لا يوجد بيانات';
            return response()->json($data_json, $this->successStatus);
        }
      
    }
    public function get_polices()
    {
        $data=Police::find(1);
        if($data){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='لا يوجد بيانات';
            return response()->json($data_json, $this->successStatus);
        }
      
    }
    public function get_inquires()
    {
        $data=StaticTable::where('type','inquiry')->select('id','name','name_en')->get();
        if($data){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='لا يوجد بيانات';
            return response()->json($data_json, $this->successStatus);
        }
      
    }
    public function add_contact(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'cod_mobile'=>'required',
            'mobile'=>'required',
            'inquiry_id'=>'required',
         ],[
            'name.required'=>'الاسم مطلوب!',
            'eamil.required'=>'الايميل مطلوب!',
            'cod_mobile.required'=>'كود الدوله مطلوب!',
            'mobile.required'=>'رقم الهاتف مطلوب!',
            'inquiry_id.required'=>'الاستفسار مطلوب!',
         ]);
         if ($validator->fails())
         {
            // $message = $validator->errors()->first();
            $this->message='الايميل مطلوب';
            if (request()->header('lang') == 'ar') {
                $this->message='الايميل مطلوب';
            }elseif (request()->header('lang') == 'en') {
                $this->message='The email field is required.';
            }
            $data_json['status']=false;
            $data_json['message']=$this->message;
            return response()->json($data_json, 200);
         }
        $data=new ContactUs();
        $data->name=$request->name;
        $data->cod_mobile=$request->cod_mobile;
        $data->mobile=$request->mobile;
        $data->email=$request->email;
        $data->inquiry_id=$request->inquiry_id;
        $data->message=$request->message;
        $data->save();
        if($data){
            $data_json['status']=true;
            $data_json['message']='تم الاضافه بنجاح';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='لا يوجد بيانات';
            return response()->json($data_json, $this->successStatus);
        }
      
    }
    
}
