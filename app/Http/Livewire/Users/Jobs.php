<?php

namespace App\Http\Livewire\Users;

use App\Models\DeliveryMan;
use App\Models\Job;
use Livewire\Component;
use App\Models\OfferedTask;
use App\Models\User;
use Livewire\WithFileUploads;
class Jobs extends Component
{
    use WithFileUploads;
    public $user_id;
    public function mount($id)
    {
        $this->user_id=$id;
    }
    public function render()
    {
        if (auth()->guard('admin') != null) {
            $results=Job::where("user_id",$this->user_id)->paginate();
        }else{
            $results=Job::whereCompanyId(auth()->guard('company')->id())->where("user_id",$this->user_id)->paginate();
        }
        $user=User::find($this->user_id);
        return view('livewire.users.jobs',[
            'results'=>$results,
            'user'=>$user,
        ])->extends('layouts.master');
    }
}
