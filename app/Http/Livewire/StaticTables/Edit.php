<?php

namespace App\Http\Livewire\StaticTables;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$name_en,$type;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($type)
    {
        $this->type=$type;
    }
    public function render()
    {
        return view('livewire.static-tables.edit')->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
            'name_en'=>'required',
        ]);
        if($this->ids != null){
            $data=StaticTable::find($this->ids);
        }else{
            $data= new StaticTable();
        }

        $data->name=$this->name;
        $data->name_en=$this->name_en;
        $data->type=$this->type;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('static-table/'.$this->type);
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->name=$edit_object['name'];
        $this->name_en=$edit_object['name_en'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->name=null;
        $this->name_en=null;
    }
}