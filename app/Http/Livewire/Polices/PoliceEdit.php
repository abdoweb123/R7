<?php

namespace App\Http\Livewire\Polices;

use App\Models\Police;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Company;
use App\Models\User;
use App\Models\TrainingCourse;
use Livewire\Component;

class PoliceEdit extends Component
{
    use WithFileUploads;
    public $ids,$title_en,$title_ar,$date,$details,$details_en;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($id)
    {
        $this->ids=$id;
        $data=Police::find($id);
        $this->title_en=$data->title_en;
        $this->title_ar=$data->title_ar;
        $this->date=$data->date;
        $this->details=$data->details;
        $this->details_en=$data->details_en;
        
    }
    public function render()
    {
        return view('livewire.polices.police-edit')->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
        ]);
        if($this->ids != null){
            $data=Police::find($this->ids);
        }else{
            $data= new Police();
        }
        $data->title_en=$this->title_en;
        $data->title_ar=$this->title_ar;
        $data->date=$this->date;
        $data->details=$this->details;
        $data->details_en=$this->details_en;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('polices');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->title_en=$edit_object['title_en'];
        $this->title_ar=$edit_object['title_ar'];
        $this->date=$edit_object['date'];
        $this->details=$edit_object['details'];
        $this->details_en=$edit_object['details_en'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->title_en=null;
        $this->title_ar=null;
        $this->date=null;
        $this->details=null;
        $this->details_en=null;
    }
}
