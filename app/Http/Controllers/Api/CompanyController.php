<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
class CompanyController extends Controller
{
    public $successStatus=200;
    public function login(){
        if(is_numeric(request('phone_email'))){
            if(Auth::guard('company')->attempt(['company_phone' => request('phone_email'), 'password' => request('password')])){
                $user_id = Auth::guard('company')->id();
                $data_fc_token = Company::find($user_id);
                $data_fc_token['token'] =  $data_fc_token->createToken('r-seven')->accessToken;
                $data_json['status']=true;
                $data_json['message']='';
                $data_json['data']=$data_fc_token;
                return response()->json($data_json, $this->successStatus);
            }else{
                $message='Bu veriler bende yok kayıtlarımız';
                if (request()->header('lang') == 'ar') {
                   $message='هذه البيانات ليست لدي سجلاتنا';
                }elseif (request()->header('lang') == 'en') {
                    $message='This data I do not have our records';
                }
                $data_json['status']=false;
                $data_json['message']=$message;
                $data_json['data']=null;
                return response()->json($data_json, $this->successStatus);
            }
        }else{
            if(Auth::guard('company')->attempt(['company_email' => request('phone_email'), 'password' => request('password')])){
                $user_id = Auth::guard('company')->id();
                $user = Company::find($user_id);

                $data_fc_token=$user;
                $data_fc_token['token'] =  $user->createToken('real-estate')->accessToken;

                $data_json['status']=true;
                $data_json['message']='';
                $data_json['data']=$data_fc_token;
                return response()->json($data_json, $this->successStatus);
            }else{
                $message='This data I do not have our records';
                if (request()->header('lang') == 'ar') {
                   $message='هذه البيانات ليست لدي سجلاتنا';
                }elseif (request()->header('lang') == 'en') {
                    $message='This data I do not have our records';
                }
                $data_json['status']=false;
                $data_json['message']=$message;
                $data_json['data']=null;
                return response()->json($data_json, $this->successStatus);
            }
        }
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'company_name' => 'required',
            // 'company_name_en' => 'required',
            'company_email' => 'required|email|unique:companies,company_email',
            'company_phone' => 'required',
            'city_id' => 'required',
            'pre_fullName' => 'required',
            'pre_email' => 'required|email|unique:companies,pre_email',
            'pre_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'commercialRecord_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'licence_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'pre_agent_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'national_address' => 'required',
            'services' => 'required',
            'jobs' => 'required',
            'password' => 'required|required_with:c_password|same:c_password|min:6',
            'c_password' => 'min:6',
            'contract_image' => 'required|file|mimes:jpg,jpeg,png,svg',
        ],[
            'company_name.required' => 'اسم الشركة مطلوب',
            // 'company_name_en.required' => 'اسم الشركة باللغة الانجليزية مطلوب',
            'company_email.required' => 'البريد الإلكتروني للشركة مطلوب',
            'company_email.unique' => 'هذا البريد الإلكتروني موجود بالفعل',
            'company_phone.required' => 'رقم هاتف الشركة مطلوب',
            'city_id.required' => 'اسم مدينة تواجد الشركة مطلوب',
            'pre_fullName.required' => 'الاسم الرباعي لممثل الشركة مطلوب',
            'pre_email.required' => 'البريد الإلكتروني لممثل الشركة مطلوب',
            'pre_email.unique' => 'هذا البريد الإلكتروني لممثل الشركة موجود بالفعل',
            'pre_image.required' => 'صورة هوية ممثل الشركة مطلوب',
            'pre_image.mimes' => 'يجب أن تكون صورة هوية ممثل الشركة من نوع jpg,jpeg,png,svg',
            'commercialRecord_image.required' => 'صورة السجل التجاري مطلوب',
            'commercialRecord_image.mimes' => 'يجب أن تكون صورة السجل التجاري من نوع jpg,jpeg,png,svg',
            'licence_image.required' => 'صورة الترخيص مطلوب',
            'licence_image.mimes' => 'يجب أن تكون صورة الترخيص من نوع jpg,jpeg,png,svg',
            'pre_agent_image.required' => 'صورة الوكالة الشرعية لممثل الشركة مطلوب',
            'pre_agent_image.mimes' => 'يجب أن تكون صورة الوكالة الشرعية لممثل الشركة من نوع jpg,jpeg,png,svg',
            'national_address.required' => 'العنوان الوطني مطلوب',
            'services.required' => 'خدمات الشركة مطلوب',
            'jobs.required' => 'الوظائف التي سيتم الإعلان عنها مطلوب',
            'password.required' => 'الرقم السري  مطلوب',
            'password.same' => 'يجب ان يكون الرقم السري و الاعاده متطابقان',
            'contract_image.required' => 'صورة العقد بين الشركة وال R7 مطلوب',
            'contract_image.mimes' => 'يجب أن تكون صورة العقد بين الشركة وال R7 من نوع jpg,jpeg,png,svg',
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

        if( $image = $request->file('logo_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['logo_image'] = "$photo";
        }


        if( $image = $request->file('cover_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['cover_image'] = "$photo";
        }


        if( $image = $request->file('pre_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['pre_image'] = "$photo";
        }

        if( $image = $request->file('commercialRecord_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['commercialRecord_image'] = "$photo";
        }


        if( $image = $request->file('licence_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['licence_image'] = "$photo";
        }

        if( $image = $request->file('pre_agent_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['pre_agent_image'] = "$photo";
        }

        if( $image = $request->file('contract_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $date['contract_image'] = "$photo";
        }


        $company = new Company();
        $company->company_name = ['en' => $request->company_name, 'ar' => $request->company_name];
        $company->company_email = $request->company_email;
        $company->password = Hash::make($request['company_password']);
        $company->company_phone = $request->company_phone;
        $company->city_id = $request->city_id;
        $company->pre_fullName = $request->pre_fullName;
        $company->pre_email = $request->pre_email;
        $company->logo_image = $date['logo_image'];
        $company->cover_image = $date['cover_image'];
        $company->pre_image = $date['pre_image'];
        $company->commercialRecord_image = $date['commercialRecord_image'];
        $company->licence_image = $date['licence_image'];
        $company->pre_agent_image = $date['pre_agent_image'];
        $company->national_address = $request->national_address;
        $company->services = $request->services;
        $company->jobs = $request->jobs;
        $company->contract_image = $date['contract_image'];
        $company->active = 1;
        $company->save();

       

        $company['token'] =  $company->createToken('real-estate')->accessToken;

        //end send mail
        $data_json['status']=true;
        $data_json['message']='تمت الاضافه بنجاح';
        $data_json['data']=$company;
        return response()->json($data_json, $this->successStatus);
        //return response()->json(['success'=>$success, 'data'=> $data], );
    }
}
