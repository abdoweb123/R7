<?php

namespace App\Http\Livewire\Employees;

use Livewire\Component;
use App\Models\User;
use App\Models\Company;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class Employees extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle ;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle ='مستخدمين للوحه التحكم';
        $this->showForm=false;
    }
    public function render()
    {
        $results=Company::whereParentId(auth()->guard('company')->user()->id)->paginate();
        return view('livewire.employees.employees',[
            'results'=>$results,
        ])->extends('layouts.master',['data_table'=>true]);
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object=$id;
        // $edit_object= Company::with('permissions')->whereId($id)->first();

        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=Company::find($id);
        if($data->arrived == "Y"){
            $data->arrived="N";
        }else{
            $data->arrived="Y";
        }
        $data->save();
    }
    public function switch()
    {
        $this->showForm= !$this->showForm;
    }
    public function make_delete($id)
    {
        $this->user_delete_id=$id;
        $this->emit('showDelete');
    }
  
    public function delete_at()
    {
        $data=Company::find($this->user_delete_id);
        $data->delete();
        session()->flash('success_message','deleted successfully');
        $this->emit('remove_modal');
    }
    public function active_ms($id)
    {
        $data=Company::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
