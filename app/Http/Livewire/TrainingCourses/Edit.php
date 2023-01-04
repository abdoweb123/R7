<?php

namespace App\Http\Livewire\TrainingCourses;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\TrainingCourse;
use App\Models\Driver;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$content,$company_id,$provided_by_type,$start_date,$provided_by,$total_cost,$employee_cost,$company_cost,$app_cost;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $drivers=Driver::select('id','name')->get();
        return view('livewire.training-courses.edit',compact('drivers'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'content'=>'required',
            'company_id'=>'required',
            'provided_by_type'=>'required',
            'provided_by'=>'required',
            'total_cost'=>'required',
            'employee_cost'=>'required',
            'company_cost'=>'required',
        ]);
        if($this->ids != null){
            $data=TrainingCourse::find($this->ids);
        }else{
            $data= new TrainingCourse();
        }

        $data->content=$this->content;
        $data->company_id=$this->company_id;
        $data->provided_by_type=$this->provided_by_type;
        $data->provided_by=$this->provided_by;
        $data->total_cost=$this->total_cost;
        $data->employee_cost=$this->employee_cost;
        $data->company_cost=$this->company_cost;
        $data->app_cost=$this->app_cost;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('TrainingCourses');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->content=$edit_object['content'];
        $this->company_id=$edit_object['company_id'];
        $this->provided_by_type=$edit_object['provided_by_type'];
        $this->provided_by=$edit_object['provided_by'];
        $this->total_cost=$edit_object['total_cost'];
        $this->employee_cost=$edit_object['employee_cost'];
        $this->company_cost=$edit_object['company_cost'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->content=null;
        $this->company_id=null;
        $this->provided_by_type=null;
        $this->provided_by=null;
        $this->total_cost=null;
        $this->employee_cost=null;
        $this->company_cost=null;
    }
}
