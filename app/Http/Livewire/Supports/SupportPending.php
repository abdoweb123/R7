<?php

namespace App\Http\Livewire\Supports;

use App\Models\Booking;
use Livewire\Component;
use App\Models\Support;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class SupportPending extends Component
{
    use WithFileUploads;
    public function mount()
    {
        $this->tittle='التذاكر المعلقه';
    }
    public function render()
    {
        $results=Support::whereStatus('pending')->paginate();
        return view('livewire.supports.support-pending',[
            'results'=>$results,
        ])->extends('layouts.master',['data_table'=>true]);
    }
    public function make_done($id)
    {
        $data=Support::find($id);
        if($data){
            $data->status='done';
            $data->admin_id=auth('company')->user()->id;
            $data->save();
            return session()->flash('alert-success','تم الاضافه بنجاح');
        }
    }
}
