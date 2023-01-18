<?php

namespace App\Http\Livewire\Notifactions;

use Livewire\Component;
use App\Models\Notification;
class Notifactions extends Component
{
    public function render()
    {
        if (auth()->guard('admin')) {
            $results=Notification::with('user')->latest()->take(10)->get();
        }else{
            $results=null;
        }
        return view('livewire.notifactions.notifactions',compact('results'));
    }
}