<?php

namespace App\Http\Livewire\TrainingCourses;

use Livewire\Component;
use App\Models\User;
use App\Models\TrainingCourse;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TrainingCourses extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle ;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle ='دورات تدريبيه';
        $this->showForm=false;
    }
    public function render()
    {
        if (auth('company')->user()->role_id == 1 || auth('company')->user()->parent_id == 1) {
            $results=TrainingCourse::with('compnay')->paginate();
        }else{
            if(auth('company')->user()->role_id == 2){
                $company_id=auth('company')->user()->id;
            }else{
                $company_id=auth('company')->user()->parent_id;
            }
            $results=TrainingCourse::with('compnay')->whereCompanyId($company_id)->paginate();
        }
        return view('livewire.training-courses.training-courses',[
            'results'=>$results,
        ])->extends('layouts.master',['data_table'=>true]);
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= TrainingCourse::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=TrainingCourse::find($id);
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
        $data=TrainingCourse::find($this->user_delete_id);
        $data->delete();
        session()->flash('success_message','deleted successfully');
        $this->emit('remove_modal');
    }
    public function active_ms($id)
    {
        $data=TrainingCourse::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
