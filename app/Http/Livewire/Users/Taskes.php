<?php

namespace App\Http\Livewire\Users;

use App\Models\DeliveryMan;
use App\Models\Order;
use Livewire\Component;
use App\Models\OfferedTask;
use App\Models\User;
use Livewire\WithFileUploads;
class Taskes extends Component
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
            $results=OfferedTask::where("user_id",$this->user_id)->paginate();
        }else{
            $results=OfferedTask::whereHas('job', function($q){
                $q->whereCompanyId(auth()->guard('company')->id());
            })->where("user_id",$this->user_id)->paginate();
        }
        $user=User::find($this->user_id);
        return view('livewire.users.taskes',[
            'results'=>$results,
            'user'=>$user,
        ])->extends('layouts.master');
    }
}
