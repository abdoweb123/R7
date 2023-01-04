<?php

namespace App\Http\Livewire\Users;

use App\Models\DeliveryMan;
use App\Models\Order;
use Livewire\Component;
use App\Models\Wraning;
use App\Models\User;
use Livewire\WithFileUploads;
class Wallets extends Component
{
    use WithFileUploads;
    public $user_id;
    public function mount($id)
    {
        $this->user_id=$id;
    }
    public function render()
    {
        $results=Wraning::with('company')->where("user_id",$this->user_id)->paginate();
        return view('livewire.users.wallets',[
            'results'=>$results,
        ])->extends('layouts.master');
    }
}
