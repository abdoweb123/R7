<?php

namespace App\Http\Livewire\Trainers;

use Livewire\Component;
use App\Models\Trainer;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Trainers extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle ;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle ='المدربين';
        $this->showForm=false;
    }
    public function render()
    {
        $results=Trainer::paginate();
        return view('livewire.trainers.trainers',[
            'results'=>$results,
        ])->extends('layouts.master',['data_table'=>true]);
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= Trainer::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=Trainer::find($id);
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
        $data=Trainer::find($this->user_delete_id);
        $data->delete();
        session()->flash('success_message','deleted successfully');
        $this->emit('remove_modal');
    }
    public function active_ms($id)
    {
        $data=Trainer::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
