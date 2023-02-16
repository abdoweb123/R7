<?php

namespace App\Http\Livewire\Tasks;

use Livewire\Component;
use App\Models\JobTask;
use App\Models\TrainingCourse;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Tasks extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle ;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle ='المهام اليوميه';
        $this->showForm=false;
    }
    public function render()
    {
        if (auth()->user() != null) {
            $results=JobTask::with('compnay')->whereCompanyId(auth()->user()->company_id)->where('date_start',date('Y-m-d'))->paginate();
        }else{
            if (auth('company')->user()->role_id == 1) {
                $results=JobTask::with('compnay')->where('date_start',date('Y-m-d'))->paginate();
            }else{
                $results=JobTask::with('compnay')->whereCompanyId(auth()->guard('company')->user()->id)->where('date_start',date('Y-m-d'))->paginate();
            }
        }
        return view('livewire.tasks.tasks',[
            'results'=>$results,
        ])->extends('layouts.master');
    }
}
