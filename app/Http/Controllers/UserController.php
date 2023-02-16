<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Nationality;
use App\Models\ReachedUs;
use App\Models\Specialty;
use App\Models\User;
use App\Models\Wraning;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    /*** index function ***/
    public function index()
    {
        if (auth('company')->user()->role_id == 1 || auth('company')->user()->parent_id == 1) {
            $data['users'] = User::latest()->paginate(10);
        }else{
            if(auth('company')->user()->role_id == 2){
                $company_id=auth('company')->user()->id;
            }else{
                $company_id=auth('company')->user()->parent_id;
            }
            $data['users'] = User::whereHas('job',function($job) use ($company_id){
                $job->whereCompanyId($company_id);
            })->latest()->paginate(10);
        }
        // $companies=Company::select('id','company_name')->get();
        return view('users.index', compact('data'));
    }



    /*** create function ***/
    public function create()
    {
        $data['countries'] = Country::select('id','name')->get();
        $data['nationalities'] = Nationality::select('id','name')->get();
        $data['cities'] = City::select('id','name')->get();
        $data['workingAreas'] = $data['cities'];
        $data['reachedUs'] = ReachedUs::select('id','name')->get();
        $data['specialties'] = Specialty::select('id','name')->get();
        $permissions=Permission::get();

        return view('users.create', compact('data','permissions'));
    }

    public function add_wraning(Request $request)
    {
        $request->validate([
            'company_id'=>'required|integer'
        ]);
        $data=new Wraning();
        $data->user_id=$request->user_id;
        $data->company_id=$request->company_id;
        $data->message=$request->message;
        $data->save();
        return redirect()->route('users.index')->with('alert-success','تم تسجيل التحذير بنجاح');
    }



    /*** store function ***/
    public function store(UserStoreRequest $request)
    {

        if( $image = $request->file('profile_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['profile_image'] = "$photo";
        }

        if( $image = $request->file('identity_image'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['identity_image'] = "$photo";
        }


        if( $image = $request->file('arabic_video_url'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['arabic_video_url'] = "$photo";
        }

        if( $image = $request->file('english_video_url'))
        {
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['english_video_url'] = "$photo";
        }
        else{
            $data['english_video_url'] = $request['english_video_url'];
        }


        $user=User::create([
            'full_name'=>$request['full_name'],
            'id_number'=>$request['id_number'],
            'profile_image'=>$data['profile_image'],
            'identity_image'=>$data['identity_image'],
            'nationality_id'=>$request['nationality_id'],
            'country_id'=>$request['country_id'],
            'city_id'=>$request['city_id'],
            'email'=>$request['email'],
            'area'=>$request['area'],
            'workingArea_id'=>$request['workingArea_id'],
            'specialty_id'=>$request['specialty_id'],
            'phone'=>$request['phone'],
            'relative_phone'=>$request['relative_phone'],
            'gender'=>$request['gender'],
            'birthDate'=>$request['birthDate'],
            'health_insurance'=>$request['health_insurance'],
            'antecedents'=>$request['antecedents'],
            'reachedUs_id'=>$request['reachedUs_id'],
            'arabic_video_url'=>$data['arabic_video_url'],
            'english_video_url'=>$data['english_video_url'],
            'active'=>$request['active'],
        ]);
        // $user->syncPermissions([$request->permission_users]);

        if($user){
            $noti=new Notification();
            $noti->user_id=$user->id;
            $noti->company_id=auth('company')->user()->id;
            $noti->notes='تم اضافه الموظف' .$request['full_name']. 'من قبل ' . auth('company')->user()->company_name;
            $noti->save();
        }

        return redirect()->route('users.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** edit function ***/
    public function edit(User $user)
    {
        // dd($user->hasPermissionTo('الدورات التدريبيه'));
        // dd($user->permissions);
        $permissions=Permission::get();

        $data['countries'] = Country::select('id','name')->get();
        $data['nationalities'] = Nationality::select('id','name')->get();
        $data['cities'] = City::select('id','name')->get();
        $data['workingAreas'] = $data['cities'];
        $data['reachedUs'] = ReachedUs::select('id','name')->get();
        $data['specialties'] = Specialty::select('id','name')->get();

        return view('users.edit', compact('data','user','permissions'));
    }

    public function profile()
    {
        $cities = City::select('id','name')->get();
        $company =Company::find(auth('company')->user()->id);
        return view('users.profile', compact('cities','company'));
    }

    /*** show function ***/
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }



    /*** update function ***/
    public function update(UserUpdateRequest $request, User $user)
    {
        
        $data = $request->all();

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
            //            $data['english_video_url'] = $request['english_video_url'];
            unset($data['english_video_url']);
        }
        
        $user->update([
            'full_name'=>$request['full_name'],
                'id_number'=>$request['id_number'],
                'nationality_id'=>$request['nationality_id'],
                'country_id'=>$request['country_id'],
                'city_id'=>$request['city_id'],
                'email'=>$request['email'],
                'area'=>$request['area'],
                'workingArea_id'=>$request['workingArea_id'],
                'specialty_id'=>$request['specialty_id'],
                'phone'=>$request['phone'],
                'relative_phone'=>$request['relative_phone'],
                'gender'=>$request['gender'],
                'birthDate'=>$request['birthDate'],
                'health_insurance'=>$request['health_insurance'],
                'antecedents'=>$request['antecedents'],
                'reachedUs_id'=>$request['reachedUs_id'],
                'active'=>$request['active'],
            ]);
            // $user->syncPermissions([$request->permission_users]);
            return redirect()->route('users.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }

    public function update_profile(Request $request,$id)
    {
        // \Validator::make($request, [
        //     'company_name_ar' => 'required',
        //     'company_email' => 'required|email',
        //     'company_phone' => 'required',
        //     'city_id' => 'required',
        // ],[
        //     'company_name_ar.required' => 'اسم الشركة باللغة العربية مطلوب',
        //     'company_email.required' => 'البريد الإلكتروني للشركة مطلوب',
        //     'company_email.unique' => 'هذا البريد الإلكتروني موجود بالفعل',
        //     'company_phone.required' => 'رقم هاتف الشركة مطلوب',
        //     'city_id.required' => 'اسم مدينة تواجد الشركة مطلوب',
        // ]);
        $company= Company::find($id);
        $data = [];

        
        if( $image = $request->file('logo_image'))
        {
            $image_path = 'assets/images/'.$company->logo_image;
            if (file_exists($image_path))
            {
                @unlink($image_path);
            }

            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['logo_image'] = "$photo";
            $company->update(['logo_image'=>$data['logo_image']]);
        }
        $company->company_name = ['en' => $request->company_name_ar, 'ar' => $request->company_name_ar];
        $company->company_email = $request->company_email;
        $company->password = Hash::make($request['company_password']);
        $company->company_phone = $request->company_phone;
        $company->city_id = $request->city_id;
        $company->save();
        // $user->syncPermissions([$request->permission_users]);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    

    
    /*** destroy function ***/
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('alert-success','تم حذف البيانات بنجاح');
    }

} //end of class
