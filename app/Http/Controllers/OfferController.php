<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    /*** index function ***/
    public function index($job_id,$company_id)
    {
        $offers = Offer::where('job_id',$job_id)->latest()->paginate(10);
        $checkAccepted = Offer::where('job_id',$job_id)->select('accepted')->get();
        $numOfAccepted = Offer::where('job_id',$job_id)->count('accepted');

        $count = 0;
        foreach ($checkAccepted as $item)
        {
           if ( $item->accepted == 1)
           {
               $accepted = 1;
           }
            else{
               $count = $count + 1;
           }

        }

        if ($count == $numOfAccepted)
        {
            $accepted = 2;
        }

        return view('offers.index', compact('offers','job_id','company_id','accepted'));


    }



    /*** update function ***/
    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->active = $request->active;
        $offer->accepted = $request->accepted;
        $offer->update();


        if ($request->accepted == 1)
        {
            // update job table column user_id
            $job = Job::find($offer->job_id);
            $job->user_id = $offer->user_id;
            $job->started = 1;
            $job->update();


            // update job_tasks table column user_id
            $jobTasks = JobTask::where('job_id',$offer->job_id)->select('id','user_id')->get();

            foreach ($jobTasks as $jobTask)
            {
                $update_jobTask = JobTask::find($jobTask->id);
                $update_jobTask->user_id = $offer->user_id;
                $update_jobTask->update();
            }
        }
        else {
            // update job table column user_id
            $job = Job::find($offer->job_id);
            $job->user_id = null;
            $job->started = false;
            $job->update();


            // update job_tasks table column user_id
            $jobTasks = JobTask::where('job_id',$offer->job_id)->select('id','user_id')->get();

            foreach ($jobTasks as $jobTask)
            {
                $update_jobTask = JobTask::find($jobTask->id);
                $update_jobTask->user_id = null;
                $update_jobTask->update();
            }
        }

        return redirect()->route('offers.index',[$request->job_id, $request->company_id])->with('alert-info','تم تحديث البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->route('offers.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }



} //end of class
