<?php

namespace App\Http\Livewire\Reports;

use App\Exports\ReportOne;
use App\Models\Booking;
use App\Models\Option;
use App\Models\Order;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use App\Models\JobTask;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LatestExcel;
class Latest extends Component
{
    use WithFileUploads;
    public $ids,$room_id,$price,$desc,$desc_en,$tittle,$rooms,$start_date,$end_date,$state_id,$results,$company_id,$user_id;
    public function mount()
    {
        $this->tittle=' جدول التاخير ';
        $dataa=JobTask::whereMonth('created_at',date('m'));
        if (auth('company')->user()->role_id != 1) {
            $dataa->whereCompanyId(auth('company')->user()->id);
        }
        $this->results=$dataa->take(50)->get();
    }
    public function render()
    {
        if (auth('company')->user()->role_id == 1) {
            $users = User::select('id','full_name')->get();
            $companies=Company::select('id','company_name')->where('id','!=','1')->get();
        }else{
            $users=User::select('id','full_name')->whereHas('job',function($job){
                $job->whereCompanyId(auth('company')->user()->id);
            });
            $companies=null;
        }
        return view('livewire.reports.latest',compact('companies','users'))->extends('layouts.master');
    }
    public function download_report_one()
    {
         return Excel::download(new LatestExcel($this->results), 'LatestExcel.xlsx');
    }
    public function company_filter()
    {
        $dataa=JobTask::whereCompanyId($this->company_id);
        if ($this->start_date != null) {
            $dataa->whereBetween('created_at',[$this->start_date,$this->end_date]);
        }
        $this->results=$dataa->get();
    }
    public function user_filter()
    {
        $dataa=JobTask::with('user','job');
        if ($this->start_date != null) {
            $dataa->whereBetween('created_at',[$this->start_date,$this->end_date]);
        }
        if ($this->company_id != null) {
            $dataa->whereHas('job',function($com){
                $com->whereCompanyId($this->company_id);
            });
        }
        $dataa->where('user_id',$this->user_id);
        $this->results=$dataa->get();
    }
    public function report()
    {
        if($this->start_date != null){
            $dataa= JobTask::whereBetween('created_at',[$this->start_date,$this->end_date]);
            if (auth('company')->user()->role_id != 1) {
                $dataa->whereCompanyId(auth('company')->user()->id);
            }
            $this->results=$dataa->get();
        }
    }

}
