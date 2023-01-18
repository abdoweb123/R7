<?php

namespace App\Http\Livewire\Polices;

use Livewire\Component;
use App\Models\Police;
use App\Models\EmployeeTraining;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Polices extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle ;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle ='سياسه الخصوصيه';
        $this->showForm=false;
    }
    public function render()
    {
        $result=Police::find(1);
        return view('livewire.polices.polices',[
            'result'=>$result,
        ])->extends('layouts.master');
    }
}
