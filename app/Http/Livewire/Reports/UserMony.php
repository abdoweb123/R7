<?php

namespace App\Http\Livewire\Reports;

use App\Exports\ReportOne;
use App\Models\Booking;
use App\Models\Option;
use App\Models\Order;
use Livewire\Component;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Company;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserMonyExcel;

class UserMony extends Component
{
    use WithFileUploads;
    public $ids,$user_id,$price,$desc,$desc_en,$tittle,$rooms,$start_date,$end_date,$state_id,$users,$results,$company_id;
    public function mount()
    {
        $this->tittle=' التحويلات ';
        $this->users=User::select('id','full_name')->get();
        $dataa=Announcement::with('job','user')->whereMonth('created_at',date('m'));
        if (auth('company')->user()->role_id != 1 || auth('company')->user()->parent_id != 1) {
            if(auth('company')->user()->role_id == 2){
                $company_id=auth('company')->user()->id;
            }else{
                $company_id=auth('company')->user()->parent_id;
            }
            $this->users=User::whereHas('job',function($job) use ($company_id){
                                    $job->whereCompanyId($company_id);
                                })->get();
            $dataa->whereHas('job',function($com) use ($company_id){
                $com->whereCompanyId($company_id);
            });
        }
           
        $this->results=$dataa->take(50)->get();
    }
    public function render()
    {
        if (auth('company')->user()->role_id == 1 || auth('company')->user()->parent_id == 1) {
            $users = User::select('id','full_name')->get();
            $companies=Company::select('id','company_name')->where('role_id',2)->get();
        }else{
            if(auth('company')->user()->role_id == 2){
                $company_id=auth('company')->user()->id;
            }else{
                $company_id=auth('company')->user()->parent_id;
            }
            $users=User::select('id','full_name')->whereHas('job',function($job) use ($company_id){
                $job->whereCompanyId($company_id);
            });
            $companies=null;
        }
    
        return view('livewire.reports.user-mony',compact('companies','users'))->extends('layouts.master');
    }
    public function download_report_one()
    {
         return Excel::download(new UserMonyExcel($this->results), 'user-transfer.xlsx');
    }
    public function company_filter()
    {
        $dataa=Announcement::with('job','user');
        $dataa->whereHas('job',function($com){
            $com->whereCompanyId($this->company_id);
        });
        if ($this->start_date != null) {
            $dataa->whereBetween('created_at',[$this->start_date,$this->end_date]);
        }
        $this->results=$dataa->get();
    }
    public function user_filter()
    {
        $dataa=Announcement::with('job','user');
        if ($this->start_date != null) {
            $dataa->whereBetween('created_at',[$this->start_date,$this->end_date]);
        }
        $dataa->where('user_id',$this->user_id);
        $this->results=$dataa->get();
    }
    public function report()
    {
        if($this->start_date != null){
            $dataa= Announcement::with('job','user')->whereBetween('created_at',[$this->start_date,$this->end_date]);
            if (auth('company')->user()->role_id != 1) {
                $dataa->whereHas('job',function($com){
                    $com->whereCompanyId(auth('company')->user()->id);
                });
            }
            $this->results=$dataa->get();
        }
    }

}
