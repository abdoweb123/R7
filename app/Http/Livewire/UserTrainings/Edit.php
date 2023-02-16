<?php

namespace App\Http\Livewire\UserTrainings;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\EmployeeTraining;
use App\Models\Company;
use App\Models\User;
use App\Models\TrainingCourse;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$employee_id,$company_id,$traning_id,$start_date,$end_date,$provided_by,$total_cost,$employee_cost,$company_cost,$app_cost;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $companies=Company::select('id','company_name')->where('role_id',2)->get();
        $employees=User::select('id','full_name')->get();
        $tranings=TrainingCourse::select('id','content')->get();
        return view('livewire.user-trainings.edit',compact('companies','employees','tranings'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'company_id'=>'required',
            'employee_id'=>'required',
            'traning_id'=>'required',
        ]);
        if($this->ids != null){
            $data=EmployeeTraining::find($this->ids);
        }else{
            $data= new EmployeeTraining();
        }

        $data->employee_id=$this->employee_id;
        $data->company_id=$this->company_id;
        $data->traning_id=$this->traning_id;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('user-traning');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->employee_id=$edit_object['employee_id'];
        $this->company_id=$edit_object['company_id'];
        $this->traning_id=$edit_object['traning_id'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->employee_id=null;
        $this->company_id=null;
        $this->traning_id=null;
    }
}
