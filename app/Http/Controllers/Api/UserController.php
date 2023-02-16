<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Api\User as ApiUser;
use App\Models\BookingRequest;
use App\Models\JobTask;
use App\Models\NotifyHistory;
use App\Models\Rate;
use App\Models\UserFavorite;
use App\Models\Wallet;
use App\Models\Wraning;
use App\Models\Notification;
use App\Models\Announcement;
use App\Models\User;
class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(is_numeric(request('phone_email'))){
            if(Auth::guard('web')->attempt(['phone' => request('phone_email'), 'password' => request('password')])){
                $user_id = Auth::guard('web')->id();
                $data_fc_token = ApiUser::with('city:id,name','nationality:id,name','workingArea:id,name','specilaty:id,name','reachedUs')->find($user_id);
                $data_fc_token->device_token=request('fcm_token');
                $data_fc_token->save();
                $data_fc_token['token'] =  $data_fc_token->createToken('real-estate')->accessToken;
                $data_json['status']=true;
                $data_json['message']='';
                $data_json['data']=$data_fc_token;
                return response()->json($data_json, $this->successStatus);
            }else{
                $message='هذه البيانات ليست لدي سجلاتنا';
                if (request()->header('lang') == 'en') {
                    $message='This data I do not have our records';
                }
                $data_json['status']=false;
                $data_json['message']=$message;
                $data_json['data']=null;
                return response()->json($data_json, $this->successStatus);
            }
        }else{
            if(Auth::guard('web')->attempt(['email'=> request('phone_email'), 'password'=> request('password')])){
                $user_id = Auth::guard('web')->id();

                $user = ApiUser::with('city:id,name','nationality:id,name','workingArea:id,name','specilaty:id,name','reachedUs')->find($user_id);
                $data_fc_token=$user;
                $data_fc_token->device_token=request('fcm_token');
                $data_fc_token->save();
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

    public function show($id=0)
    {
        // dd(request()->header('lang'));
        $user_id = Auth::id();
        $this->err_message='عفوا لا يوجد مستخدم بهذه البيانات';
        if (request()->header('lang') == 'ar') {
            $this->err_message='عفوا لا يوجد مستخدم بهذه البيانات';
        }elseif (request()->header('lang') == 'en') {
            $this->err_message='Sorry , Wrong data ';
        }
        $user=User::with('city:id,name','nationality:id,name','workingArea:id,name','specilaty:id,name','reachedUs')->find($user_id);
        if(is_null($user) == 1)
        {
            $data['status']=false;
            $data['message']='عفوا لا يوجد مستخدم بهذه البيانات';
            $data['data']=null;
            return response()->json($data, 200);
        }

        $data['status']=true;
        $data['message']='';
        $data['data']=$user;
        return response()->json($data, 200);
    }

    public function add_favorite(Request $request)
    {
        $message='تم الاضافه الي المفضله';
        $message_err='يوجد شئ ما خطا ';
        $message_err_before='تم الحذف بنجاح';
        if(request()->header('lang') == 'en'){
            $message='added to favorite successfully';
            $message_err='there are some thing wrong';
            $message_err_before='deleted from favorite successfully';
        }
        $user_id = Auth::id();
        $if_exist=UserFavorite::where(['user_id'=>$user_id,'favo_id'=>$request->favo_id])->first();
        if($if_exist != null){
            $if_exist->delete();
            $data['status']=true;
            $data['message']=$message_err_before;
            $data['data']=null;
            return response()->json($data, 200);
        }
        $data_add=new UserFavorite();
        $data_add->user_id=$user_id;
        $data_add->favo_id=$request->favo_id;
        $data_add->type='job';
        $check=$data_add->save();
        if($check){
            $data['status']=true;
            $data['message']=$message;
            $data['data']=null; 
            return response()->json($data, 200);
        }else{
            $data['status']=false;
            $data['message']=$message_err;
            $data['data']=null;
            return response()->json($data, 200);
        }
    }
    public function get_favorite()
    {
        $select_city=['id','type','parent_id','name','img','is_active'];
        $this->select_price=['id','room_id','borker_price'];
        $this->select_room=['id','description','rate','city_id','hotel_id'];
        $this->hotel_select=['id','name'];
        $this->city=['id','name'];
        $this->message='لا توجد بيانات';
        if (request()->header('lang') == 'en') {
            $this->message='not found data';
            $select_city=['id','type','parent_id','name_en as name','img','is_active'];
            $this->select_room=['id','description_en as description','rate','city_id','hotel_id'];
            $this->hotel_select=['id','name_en as name'];
            $this->city=['id','name_en as name'];
        }
        $user_id = Auth::id();

        $if_exist=UserFavorite::with('job')->select('id','user_id','favo_id')->where(['user_id'=>$user_id])->get();

        if($if_exist != null){
            $data['status']=true;
            $data['message']=$if_exist;
            return response()->json($data, 200);
        }else{
            $data['status']=false;
            $data['message']=$message;
            $data['data']=null;
            return response()->json($data, 200);
        }
    }
    //reset password
    public function reset_pass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email'=>'required',
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
        // ApiUser::find($user_id);
        $chk_user= ApiUser::where(['email'=>$request->email])->first();
        if(is_null($chk_user))
        {
            if (request()->header('lang') == 'ar') {
                $this->message_chk='لا يوجد بيانات لهذا المستخدم';
            }elseif (request()->header('lang') == 'en') {
                $this->message_chk='There is no data for this user';
            }
            $data['status']=true;
            $data['message']=$this->message_chk;
            //$data['data']=array();
            return response()->json($data, $this->successStatus);
        }
        else
        {
            $varifaid_symbol=rand(111111,999999);
            $data_upd= ApiUser::find($chk_user->id);
            $data_upd->password=Hash::make($varifaid_symbol);
            $upd =$data_upd->save();

            if( $upd == true)
            {

                $data_new=$data_upd;
                $data_new['new_password']=$varifaid_symbol;
                $data_new['token'] =  $data_upd->createToken('real-estate')->accessToken;


                // Mail::to($data_upd->email)->send(new AuthMail($data_upd));
                // if (request()->header('lang') == 'ar') {
                //     $this->message_email='تم ارسال كود التحقق الي البريد الالكتروني بنجاح ';
                // }elseif (request()->header('lang') == 'en') {
                //     $this->message_email='succefully Validation code send to gmail';
                // }elseif (request()->header('lang') == 'tr') {
                //     $this->message_email="gmail'e başarıyla gönderilen doğrulama kodu";
                // }
                $data['status']=false;
                $data['message']='';
                $data['data']=$data_new;
                return response()->json($data, $this->successStatus);
            }
            else
            {
                if (request()->header('lang') == 'ar') {
                    $this->message_not_fond='لا يوجد بيانات';
                }elseif (request()->header('lang') == 'en') {
                    $this->message_not_fond='not found data';
                }elseif (request()->header('lang') == 'tr') {
                    $this->message_not_fond='veri bulunamadı';
                }
                $data['status']=false;
                $data['message']=$this->message_not_fond;
                return response()->json($data, $this-> successStatus);
            }
        }
    }
    public function verification(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email'=>'required',
            'verification_code'=>'required',
         ]);

         if ($validator->fails())
         {
            $message = $validator->errors()->first();
            $data_json['result']=false;
            $data_json['error_message']=$message;
            $data_json['error_message_en']=$message;
            return response()->json($data_json, 200);
         }

         $data_upd= ApiUser::where('email',$request->email)->first();
         if($data_upd != null){
           $data_upd->email_verified_at=now();
           $data_upd->save();

           if( $data_upd->verification_code == $request->verification_code){
                $data_json['result']=true;
                $data_json['error_message']='تم التحقيق';
                $data_json['error_message_en']='verified';
                return response()->json($data_json, 200);
           }else{
                $data_json['result']=false;
                $data_json['error_message']=' عفوا رمز التحقيق غير صحيح';
                $data_json['error_message_en']='Sorry, the verification code is incorrect';
                return response()->json($data_json, 200);
           }
         }else{
            $data_json['result']=false;
            $data_json['error_message']='هذا الايميل غير مسجل';
            $data_json['error_message_en']='this email not registration';
            return response()->json($data_json, 200);
         }
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'full_name' => 'required',
            'id_number' => 'required',
            // 'profile_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            // 'identity_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'nationality_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'email' => 'required|email|unique:users',
            'area' => 'required',
            'workingArea_id' => 'required',
            'specialty_id' => 'required',
            'phone' => 'required|unique:users',
            'relative_phone' => 'required',
            'gender' => 'required',
            'birthDate' => 'required',
            'health_insurance' => 'required',
            'antecedents' => 'required',
            'reachedUs_id' => 'required',
            'password' => 'required|required_with:c_password|same:c_password|min:6',
            'c_password' => 'min:6'
        ],[
            'full_name.required' => 'الاسم بالكامل مطلوب',
            'id_number.required' => 'الرقم القومي مطلوب',
            // 'profile_image.required' => 'الصورة الشخصية مطلوب',
            // 'profile_image.mimes' => 'يجب أن تكون الصورة من نوع jpg,jpeg,png,svg',
            // 'identity_image.required' => 'صورة بطاقة الهوية مطلوب',
            // 'identity_image.mimes' => 'يجب أن تكون الصورة من نوع jpg,jpeg,png,svg',
            'nationality_id.required' => 'الجنسية مطلوب',
            'country_id.required' => 'الدولة مطلوب',
            'city_id.required' => 'المدينة مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'هذا البريد الإلكتروني موجود بالفعل',
            'area.required' => 'العنوان بالتفصيل مطلوب',
            'password.required' => 'الرقم السري  مطلوب',
            'password.same' => 'يجب ان يكون الرقم السري و الاعاده متطابقان',
            'workingArea_id.required' => 'منطقة العمل مطلوب',
            'specialty_id.required' => 'التخصص مطلوب',
            'phone.required' => 'الهاتف الشخصي مطلوب',
            'phone.unique' => 'الهاتف  موجود من قبل',
            'relative_phone.required' => 'هاتف قريب أو صاحب مطلوب',
            'gender.required' => 'النوع مطلوب',
            'birthDate.required' => 'تاريخ الميلاد مطلوب',
            'health_insurance.required' => 'الشهادة الصحية مطلوب',
            'antecedents.required' => 'الفيش و التشبيه مطلوب',
            'reachedUs_id.required' => 'كيف عرفتنا؟ مطلوب',
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

        $input = $request->all();

        if( $image = $request->file('profile_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $input['profile_image'] = "$photo";
        }

        if( $image = $request->file('identity_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $input['identity_image'] = "$photo";
        }

        if( $image = $request->file('insurance_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $input['insurance_image'] = "$photo";
        }
        if( $image = $request->file('antecedents_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $input['antecedents_image'] = "$photo";
        }

        if( $image = $request->file('arabic_video_url'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $input['arabic_video_url'] = "$photo";
        }

        if( $image = $request->file('english_video_url'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $input['english_video_url'] = "$photo";
        }
        else{
            $input['english_video_url'] = $request['english_video_url'];
        }



        $input['password'] = Hash::make($input['password']);
        $input['device_token'] =request('fcm_token');
        
        $data = User::create($input);

        $data['token'] =  $data->createToken('real-estate')->accessToken;

        //end send mail
        $data_json['status']=true;
        $data_json['message']=$this->message;
        $data_json['data']=$data;
        return response()->json($data_json, $this->successStatus);
        //return response()->json(['success'=>$success, 'data'=> $data], );
    }

      public function update(Request $request, $id)
    {
        // dd($request);
        $user_id=Auth::id();
        $validator = \Validator::make($request->all(), [
            'full_name' => 'required',
            'id_number' => 'required',
            'nationality_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'area' => 'required',
            'workingArea_id' => 'required',
            'specialty_id' => 'required',
            'relative_phone' => 'required',
            'gender' => 'required',
            'birthDate' => 'required',
            'health_insurance' => 'required',
            'antecedents' => 'required',
            'reachedUs_id' => 'required',
        ],[
            'full_name.required' => 'الاسم بالكامل مطلوب',
            'id_number.required' => 'الرقم القومي مطلوب',
            'profile_image.required' => 'الصورة الشخصية مطلوب',
            'profile_image.mimes' => 'يجب أن تكون الصورة من نوع jpg,jpeg,png,svg',
            'nationality_id.required' => 'الجنسية مطلوب',
            'country_id.required' => 'الدولة مطلوب',
            'city_id.required' => 'المدينة مطلوب',
            'area.required' => 'العنوان بالتفصيل مطلوب',
            'workingArea_id.required' => 'منطقة العمل مطلوب',
            'specialty_id.required' => 'التخصص مطلوب',
            'relative_phone.required' => 'هاتف قريب أو صاحب مطلوب',
            'gender.required' => 'النوع مطلوب',
            'birthDate.required' => 'تاريخ الميلاد مطلوب',
            'health_insurance.required' => 'الشهادة الصحية مطلوب',
            'antecedents.required' => 'الفيش و التشبيه مطلوب',
            'reachedUs_id.required' => 'كيف عرفتنا؟ مطلوب',
            'arabic_video_url.required' => 'فيديو التقديم بالعربية مطلوب',
            'arabic_video_url.mimes' => 'يجب أن يكون الفيديو من نوع mp4,mov,ogg,qt',
            'english_video_url.mimes' => 'يجب أن يكون الفيديو من نوع mp4,mov,ogg,qt',
        ]);
           $this->message='تم التعديل بنجاح ';
           $this->message_not_fond='لا يوجد بيانات';
           
           if (request()->header('lang') == 'en') {
                $this->message='successfully updated';
                $this->message_not_fond='There are no data';
            }
        if ($validator->fails()) {
            $errors=$validator->errors();
            $error_mg='';
            foreach ($errors->all() as $error) {
                $error_mg.=$error.' . ';
            }
            $data_json['result']=false;
            $data_json['error_message']=$error_mg;
            $data_json['error_message_en']=$error_mg;
            return response()->json($data_json, 200);
        }

         $data = $request->all();
        $user=User::find($user_id);

        if( $image = $request->file('profile_image'))
        {
            $image_path = 'assets/images/'.$user->profile_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['profile_image'] = "$photo";
            $user->update(['profile_image'=>$data['profile_image']]);
        }
        else{
            unset($data['profile_image']);
        }

        if( $image = $request->file('identity_image'))
        {
            $image_path = 'assets/images/'.$user->identity_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['identity_image'] = "$photo";
            $user->update(['identity_image'=>$data['identity_image']]);
        }
        else{
            unset($data['identity_image']);
        }


        if( $image = $request->file('antecedents_image'))
        {
            $image_path = 'assets/images/'.$user->antecedents_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['antecedents_image'] = "$photo";
            $user->update(['antecedents_image'=>$data['antecedents_image']]);
        }
        else{
            unset($data['antecedents_image']);
        }
        
        if( $image = $request->file('insurance_image'))
        {
            $image_path = 'assets/images/'.$user->insurance_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['insurance_image'] = "$photo";
            $user->update(['insurance_image'=>$data['insurance_image']]);
        }
        else{
            unset($data['insurance_image']);
        }

        if( $image = $request->file('arabic_video_url'))
        {
            $image_path = 'assets/images/'.$user->arabic_video_url;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['arabic_video_url'] = "$photo";
            $user->update(['arabic_video_url'=>$data['arabic_video_url']]);
        }
        else{
            unset($data['arabic_video_url']);
        }

        if( $image = $request->file('english_video_url'))
        {
            $image_path = 'assets/images/'.$user->english_video_url;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['english_video_url'] = "$photo";
            $user->update(['english_video_url'=>$data['english_video_url'],]);
        }
        else{
            unset($data['english_video_url']);
        }

            $user->update([
                'full_name'=>$request['full_name'],
                'id_number'=>$request['id_number'],
                'nationality_id'=>$request['nationality_id'],
                'country_id'=>$request['country_id'],
                'city_id'=>$request['city_id'],
                'area'=>$request['area'],
                'workingArea_id'=>$request['workingArea_id'],
                'specialty_id'=>$request['specialty_id'],
                'relative_phone'=>$request['relative_phone'],
                'gender'=>$request['gender'],
                'birthDate'=>$request['birthDate'],
                'health_insurance'=>$request['health_insurance'],
                'antecedents'=>$request['antecedents'],
                'reachedUs_id'=>$request['reachedUs_id'],
                'active'=>$request['active'],
            ]);
        if( $user)
        {
            $data_json['status']=true;
            $data_json['message']=$this->message;
            $data_json['data']=$user;
            return response()->json($data_json, $this-> successStatus);
        }
        else
        {
            $data['status']=false;
            $data['message']=$this->message_not_fond;
            $data['data']=null;
            return response()->json($data, $this-> successStatus);
        }
    }

    public function change_password(Request $request)
    {
        $user_id = Auth::id();
        $user=ApiUser::find($user_id);
        if(!Hash::check($request->old_password, $user->password))
        {
            $data['status']=false;
            $data['message']='الرقم السري القديم غير صحيح';
            return response()->json($data, $this-> successStatus);
        }
        else
        {
            $validator = \Validator::make($request->all(), [
                'new_password' => 'min:8|same:c_password',
                'c_password' => 'required|min:6'
            ]);
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
            // $data_upd= ApiUser::find(auth()->user()->id);
            $user['password'] = Hash::make($request->new_password);
            $upd =$user->save();
            $data=$user;
            $data['token']=  $user->createToken('sureFanni')->accessToken;

            if( $upd == true)
            {
                $data_json['status']=true;
                $data_json['message']='';
                $data_json['data']=$data;
                return response()->json($data_json, $this->successStatus);
            }
            else
            {
                $data['status']=false;
                $data['message']='لايوجد بيانات';
               // $data['data']=array();
                return response()->json($data, $this->successStatus);
            }
        }
    }
  public function new_password(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'new_password' => 'min:8|same:c_new_password',
        ]);
      $this->message='başarıyla güncellendi';
        $this->message_not_fond='veri yok';
        $this->select_state=['id','name_en'];
        $this->select_city=['id','name_en'];
        if (request()->header('lang') == 'ar') {
           $this->message='تم التعديل بنجاح ';
           $this->message_not_fond='لا يوجد بيانات';
           $this->select_state=['id','name_ar'];
           $this->select_city=['id','name_ar'];
        }elseif (request()->header('lang') == 'en') {
            $this->message='successfully updated';
            $this->message_not_fond='There are no data';
            $this->select_state=['id','name_en'];
            $this->select_city=['id','name_en'];
        }elseif (request()->header('lang') == 'tr') {
            $this->message='başarıyla güncellendi';
            $this->message_not_fond='veri yok';
            $this->select_state=['id','name_tr'];
            $this->select_city=['id','name_tr'];
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
        // $data_upd= ApiUser::whereEmail($request->email)->first();
        $data_upd=ApiUser::with(['state'=>function($q){
            $q->select($this->select_state);
        },'city'=>function($query){
            $query->select($this->select_city);
        }])->select('id','name','phone','email','avatar','whatsapp','address','is_provider','is_company','c_name','lisence_number','lisence_document','state_id','city_id')->whereEmail($request->email)->first();
        $success['token'] =$new_token=  $data_upd->createToken('sureFanni')->accessToken;
        $data_upd['password'] = Hash::make($request->new_password);
        $upd =$data_upd->save();
        if( $upd == true)
        {
            $data_user['token']=$new_token;
            $data['status']=true;
            $data['message']=$this->message;
            $data['data']=$data_user;
            return response()->json($data, $this->successStatus);
        }
        else
        {
            $data['status']=false;
            $data['error_message']=$this->message_not_fond;
            return response()->json($data, $this-> successStatus);
        }
    }
    public function rate_delivery(Request $request)
    {
        $user_id = Auth::id();
        $user=ApiUser::find($user_id);
        $check_exist=Rate::where(['user_id'=>$user_id,'rated_id'=>$request->deliveryMenId])->first();
        if($check_exist != null){
            $data['status']=false;
            $data['message']='تم التقييم من قبل';
            return response()->json($data, $this-> successStatus);
        }
        $data_new=new Rate();
        $data_new->type='delivery_rate';
        $data_new->user_id=$user_id;
        $data_new->rated_id=$request->deliveryMenId;
        $data_new->rate=$request->rate;
        $data_new->notes=$request->comment;
        $check=$data_new->save();
        if( $check == true)
        {
            $data['status']=true;
            $data['message']='تم التقييم بنجاح';
            $data['data']=$data_new;
            return response()->json($data, $this->successStatus);
        }
        else
        {
            $data['status']=false;
            $data['message']='يوجد شئ ما خطأ';
            return response()->json($data, $this-> successStatus);
        }
    }
    public function wallet_history()
    {
        $user_id=Auth::id();
        $data=Wallet::select('id','type','amountMoney','user_id','message')->where('user_id',$user_id)->get();
        if( $data == true)
        {
            $data_jsone['status']=true;
            $data_jsone['message']='';
            $data_jsone['data']=$data;
            return response()->json($data_jsone, $this->successStatus);
        }
        else
        {
            $data_jsone['status']=false;
            $data_jsone['message']='يوجد شئ ما خطأ';
            return response()->json($data_jsone, $this-> successStatus);
        }
    }
    public function booking_request(Request $request)
    {
        $user_id=Auth::id();

        if($request->type == "wallet"){
            $validator = \Validator::make($request->all(), [
                'amount'                     =>'required',
                'phone_number'                     =>'required',
            ],[
                'amount.required'=>'المبلغ مطلوبة',
                'phone_number.required'=>'الرقم مطلوبة',
            ]);

            $data_new=new BookingRequest();
            $data_new->type=$request->type;
            $data_new->user_id=$user_id;
            $data_new->amount=$request->amount;
            $data_new->phone_number=$request->phone_number;
            $data_new->save();
        }else{
            $validator = \Validator::make($request->all(), [
                'amount'                     =>'required',
                'account_number'                     =>'required',
            ],[
                'amount.required'=>'المبلغ مطلوبة',
                'account_number.required'=>'رقم الحساب مطلوبة',
            ]);

            $data_new=new BookingRequest();
            $data_new->type=$request->type;
            $data_new->user_id=$user_id;
            $data_new->amount=$request->amount;
            $data_new->account_name=$request->account_name;
            $data_new->account_number=$request->account_number;
            $data_new->branch_name=$request->branch_name;
            $data_new->bank_name=$request->bank_name;
            $data_new->save();
        }
        if($data_new != null){
            $data_json['status']=true;
            $data_json['message']='تم الطلب بنجاح';
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
    public function booking_requests_user()
    {
        $user_id=Auth::id();
        $data_get=BookingRequest::where('user_id',$user_id)->get();
        if($data_get != null){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_get;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
    public function delete_booking_requests($id)
    {
        $data_get=BookingRequest::find($id);
        $data_get->deleted_at=now();
        $check=$data_get->save();

        if($check){
            $data_json['status']=true;
            $data_json['message']='تم الحذف بنجاح';
            $data_json['data']=$data_get;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
    public function notify_user_history()
    {
        $user_id=Auth::id();
        $data_get=NotifyHistory::where('user_id',$user_id)->get();
        if($data_get != null){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_get;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
    public function get_tasks()
    {
        $user_id=Auth::id();
        $data_get=JobTask::with('job:id,minimum_cost,maximum_cost')->where('user_id',$user_id)->get();
        if($data_get != null){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_get;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
    public function wraning()
    {
        $user_id=Auth::id();
        $data_get=Wraning::with('company:id,company_name')->where('user_id',$user_id)->get();
        if($data_get != null){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_get;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
    public function get_notifaction()
    {
        $user_id=Auth::id();
        $data_get=Notification::where('user_id',$user_id)->get();
        if($data_get != null){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_get;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
    public function get_announcement()
    {
        $user_id=Auth::id();
        $data_get=Announcement::where('user_id',$user_id)->get();
        if($data_get != null){
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_get;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            $data_json['data']=null;
            return response()->json($data_json, 200);
        }
    }
}
