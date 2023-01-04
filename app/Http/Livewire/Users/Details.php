<?php

namespace App\Http\Livewire\Users;

use App\Models\State;
use Livewire\Component;
use App\Models\User;
use App\Models\ToolType;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class Details extends Component
{
    use WithFileUploads;
    public $user_id,$showOrders,$showWallet,$showWraning,$showJobs;

    public function mount($user_id)
    {
        $this->showJobs=true;
        $this->showOrders=false;
        $this->showWallet=false;
        $this->showWraning=false;
        $this->user_id=$user_id;
    }
    public function render()
    {
        $result=User::find($this->user_id);
        return view('livewire.users.details',[
            'result'=>$result,
        ])->extends('layouts.master');
    }
    public function call_show_wallet()
    {
        $this->showJobs=false;
        $this->showOrders=false;
        $this->showWallet=true;
        $this->showWraning=false;
    }
    public function call_wraning()
    {
        $this->showJobs=false;
        $this->showOrders=false;
        $this->showWallet=false;
        $this->showWraning=true;
    }
    public function call_orders()
    {
        $this->showJobs=false;
        $this->showOrders=true;
        $this->showWallet=false;
        $this->showWraning=false;
    }
    public function call_jobs()
    {
        $this->showJobs=true;
        $this->showOrders=false;
        $this->showWallet=false;
        $this->showWraning=false;
    }
    public function store()
    {
        $validate=$this->validate([
            'name'=>'required|max:100',
            'email'=>'required|email|unique:delivery_men,email,'.$this->ids,
            'phone'=>'required',
            'state_id'=>'required|integer',
            'wallet'=>'required|integer',
            'password'=> 'required',
            'c_password' => 'required|same:password'
        ]);
        if($this->ids != null){
            $data=DeliveryMan::find($this->ids);
        }else{
            $data= new DeliveryMan();
        }

        $data->name=$this->name;
        $data->email=$this->email;
        $data->phone=$this->phone;
        $data->state_id=$this->state_id;
        $data->wallet=$this->wallet;
        $data->presentage=$this->presentage;
        $data->toolType_id=$this->toolType_id;
        $data->lat=$this->lat;
        $data->long=$this->long;
        $data->active=1;
        $data->working=1;
        $data->type=1;
        $data->password=Hash::make($this->password);
        if ($this->profileImage) {
            $img=$this->profileImage;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'perosn'.'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images');
            $image_data = Image::make($img->getRealPath());
            $img_name = $image_data->save($destinationPath."/".$file_name);
            if(is_null($data->profileImage)==0)
            {
                @unlink("assets/images/".$data->profileImage);
            }
            $data->profileImage=$file_name;
        }

        if ($this->toolBackLicenceImage) {
            $img=$this->toolBackLicenceImage;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'toolBackLicenceImage'.'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images');
            $image_data = Image::make($img->getRealPath());
            $img_name = $image_data->save($destinationPath."/".$file_name);
            if(is_null($data->img)==0)
            {
                @unlink("assets/images/".$data->img);
            }
            $data->toolBackLicenceImage=$file_name;
        }

        if ($this->toolFrontLicenceImage) {
            $img=$this->toolFrontLicenceImage;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'toolFrontLicenceImage'.'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images');
            $image_data = Image::make($img->getRealPath());
            $img_name = $image_data->save($destinationPath."/".$file_name);
            if(is_null($data->img)==0)
            {
                @unlink("assets/images/".$data->img);
            }
            $data->toolFrontLicenceImage=$file_name;
        }

        if ($this->nationalityFrontIdImage) {
            $img=$this->nationalityFrontIdImage;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'nationalityFrontIdImage'.'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images');
            $image_data = Image::make($img->getRealPath());
            $img_name = $image_data->save($destinationPath."/".$file_name);
            if(is_null($data->img)==0)
            {
                @unlink("assets/images/".$data->img);
            }
            $data->nationalityFrontIdImage=$file_name;
        }
        if ($this->nationalityBackIdImage) {
            $img=$this->nationalityBackIdImage;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'nationalityBackIdImage'.'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images');
            $image_data = Image::make($img->getRealPath());
            $img_name = $image_data->save($destinationPath."/".$file_name);
            if(is_null($data->img)==0)
            {
                @unlink("assets/images/".$data->img);
            }
            $data->nationalityBackIdImage=$file_name;
        }

        $check=$data->save();
        if ($check) {
            $this->resetInput();
            return redirect()->route('deliveries');
        }
    }
    public function get_selects()
    {
        $this->states=State::select('id','name')->get();
        $this->tools=ToolType::select('id','name')->get();
    }
    public function edit($id)
    {
        $this->get_selects();
        $data=DeliveryMan::find($id);
        $this->ids=$id;
        $this->name=$data->name;
        $this->email=$data->email;
        $this->phone=$data->phone;
        $this->wallet=$data->wallet;
        $this->presentage=$data->presentage;
        $this->state_id=$data->state_id;
        $this->toolType_id=$data->toolType_id;
        $this->lat=$data->lat;
        $this->long=$data->long;
        $this->name=$data->name;
    }
    public function resetInput()
    {
        $this->get_selects();
        $this->ids=null;
        $this->name=null;
        $this->email=null;
        $this->phone=null;
        $this->state_id=null;
        $this->toolType_id=null;
        $this->lat=null;
        $this->long=null;
        $this->wallet=null;
        $this->presentage=null;
        $this->password=null;
        $this->c_password=null;
    }
    public function make_delete($id)
    {
        $this->user_delete_id=$id;
        $this->emit('showDelete');
    }
    public function delete_at()
    {
        $data=DeliveryMan::find($this->user_delete_id);
        if ($data->deleted_at != null) {
            $data->deleted_at= null;
        }else{
            $data->deleted_at= now();
        }
        $data->save();
        session()->flash('success_message','deleted successfully');
        $this->emit('remove_modal');
    }
}
