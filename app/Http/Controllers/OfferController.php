<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobTaskRequest;
use App\Http\Requests\OfferRequest;
use App\Models\Announcement;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    /*** index function ***/
    public function index($job_id,$company_id)
    {
        $offers = Offer::where('job_id',$job_id)->get();
        $tasks = JobTask::where('job_id',$job_id)->get();
        $rewards = Announcement::where('job_id',$job_id)->where('type',1)->get();
        $warnings = Announcement::where('job_id',$job_id)->where('type',2)->get();

        $job = Job::find($job_id);
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
        return view('offers.index', compact('offers','job_id','company_id','accepted','job','rewards','warnings','tasks'));
    }




    public function accept_offer($id)
    {
        if($id){
            $data=Offer::find($id);
            $data->accepted=1;
            $data->save();

            $data_job=Job::with('jobTasks')->find($data->job_id);
            $data_job->user_id=$data->user_id;
            $data_job->save();

            if($data_job->jobTasks){
                foreach ($data_job->jobTasks as $job_task) {
                    $task=JobTask::find($job_task->id);
                    $task->user_id=$data->user_id;
                    $task->save();
                }
            }
        }

        return back();
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




    /*** store function ***/
    public function makeJobTaskFromOffer(JobTaskRequest $request)
    {
        $jobTask = new JobTask();
        $jobTask->job_id = $request['job_id'];
        $jobTask->company_id = $request['company_id'];
        $jobTask->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $jobTask->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
        $jobTask->user_id = null;
        $jobTask->started = false;
        $jobTask->finished =false;
        $jobTask->active = true;
        $jobTask->save();

        return redirect()->back()->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** destroy function ***/
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->route('offers.index')->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }



} //end of class
