<?php

namespace App\Http\Livewire\Supports;

use App\Models\Booking;
use Livewire\Component;
use App\Models\StaticTable as Static_table;
use App\Models\Support;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class SupportDone extends Component
{
    use WithFileUploads;
    public function mount()
    {
        $this->tittle='التذاكر المنتهيه';
    }
    public function render()
    {
        $results=Support::with('admin')->whereStatus('done')->paginate();
        return view('livewire.supports.support-done',[
            'results'=>$results,
        ])->extends('layouts.master',['data_table'=>true]);
    }
}
