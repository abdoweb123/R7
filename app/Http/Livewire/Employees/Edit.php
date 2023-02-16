<?php

namespace App\Http\Livewire\Employees;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Company;
use App\Models\City;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$email,$phone,$city_id,$password,$permission_users=[];
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $cities=City::select('id','name')->get();
        $permissions=Permission::whereNotIn('id',[18,19,20,21,22,23,24,25])->get();
        if(auth('company')->user()->role_id ==1){
            $permissions=Permission::get();
        }elseif(auth('company')->user()->role_id == 3 && auth('company')->user()->parent_id ==1){
            $permissions=Permission::get();
        }
        return view('livewire.employees.edit',compact('cities','permissions'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'city_id'=>'required',
            'password'=>'required',
        ]);
        if($this->ids != null){
            $data=Company::find($this->ids);
        }else{
            $data= new Company();
        }

        $data->company_name=$this->name;
        $data->company_email=$this->email;
        $data->company_phone=$this->phone;
        $data->city_id=$this->city_id;
        $data->parent_id=auth()->guard('company')->id();
        $data->role_id=3;
        $data->active=1;
        $data->password=Hash::make($this->password);
        $check=$data->save();
        if ($check) {
            $data->syncPermissions([$this->permission_users]);
            $this->resetInput();
            return redirect()->to('employees-dashboard');
        }
    }
    
    public function get_object($edit_object)
    {
        $data= Company::with('permissions')->whereId($edit_object)->first();
        $this->ids=$data->id;
        $this->name=$data->company_name;
        $this->email=$data->company_email;
        $this->phone=$data->company_phone;
        $this->city_id=$data->city_id;
        $this->permission_users=$data->getAllPermissions()->pluck('id');
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->email=null;
        $this->phone=null;
        $this->city_id=null;
        $this->password=null;
    }
}
