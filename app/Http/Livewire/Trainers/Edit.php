<?php

namespace App\Http\Livewire\Trainers;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Trainer;
use App\Models\Company;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$kind,$certificate,$training_license,$commercial_register,$mobile;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        return view('livewire.trainers.edit')->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
            'kind'=>'required',
        ]);
        if($this->ids != null){
            $data=Trainer::find($this->ids);
        }else{
            $data= new Trainer();
        }

        $data->name=$this->name;
        $data->kind=$this->kind;
        $data->certificate=$this->certificate;
        $data->training_license=$this->training_license;
        $data->commercial_register=$this->commercial_register;
        $data->mobile=$this->mobile;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('trainers');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->name=$edit_object['name'];
        $this->kind=$edit_object['kind'];
        $this->certificate=$edit_object['certificate'];
        $this->training_license=$edit_object['training_license'];
        $this->commercial_register=$edit_object['commercial_register'];
        $this->mobile=$edit_object['mobile'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->kind=null;
        $this->certificate=null;
        $this->training_license=null;
        $this->commercial_register=null;
        $this->mobile=null;
    }
}
