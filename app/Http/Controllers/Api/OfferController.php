<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Job;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\CheckApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class OfferController extends Controller
{

    use CheckApi;


    /*** getAllOffers function ***/
    public function getAllOffers()
    {
        try {
            $offers = OfferResource::collection(Offer::all());
            return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','All Offers',$offers);
        }
        catch (\Exception $exception)
        {
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** create function ***/
    public function create(OfferRequest $request)
    {

        $job = Job::find($request->job_id);
        if (!$job){
            return $this->returnMessageError('هذه الوظيفة غير موجودة','404');
        }

        $user = User::find($request->user_id);
        if (!$user){
            return $this->returnMessageError('هذا المستخدم غير موجودة','404');
        }

        try {
            $offer = Offer::create([
                'job_id'=>$request['job_id'],
                'user_id'=>$request['user_id'],
                'message'=>$request['message'],
                'active'=>1,
                'accepted'=>0,
            ]);

            $getOffer = OfferResource::make($offer);

            return $this->returnMessageData('تم تسجيل البيانات بنجاح','200','offer',$getOffer);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }

    public function add_offer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
        ],[
            'job_id.required' => 'الوظيفه مطلوبه',
        ]);
        $user_id=Auth::id();
        $offer = Offer::create([
            'job_id'=>$request->job_id,
            'user_id'=>$user_id,
            'message'=>$request->message,
            'active'=>1,
            'accepted'=>0,
        ]);
        if($offer){
            $user=User::find($user_id);
            $job=Job::find($request->job_id);
            $FcmToken="f2n6ysYkTMi1E83f35TJ0D:APA91bFnUZL_4SivVBcLubegZq9Q4-jfZ3g6xdOn66YMtxz35oXWWQQPjDhQALmsl28S_mTmG3k2u1yYlmCQLQtav4YofVTbie155DU-QpQeVRvKjcEBOKiEPAr2EEmaTX0eBVbuUrK0";
            $title='العروض المقدمه';
            $body='تم اضافه عرض لوظيفه' .'('. @$job->job_description.')'. 'من قبل ' . @$user->full_name;
            send_notifaction($FcmToken,$title,$body,$user_id,$request->job_id,0);

            $data_json['status']=true;
            $data_json['message']='تم الاضافه بنجاح';
            $data_json['data']=$offer;
            return response()->json($data_json, 200);
        }else{
            $data_json['status']=false;
            $data_json['message']='يوجد شئ ما خطأ';
            return response()->json($data_json, 200);
        }

    }


    /*** getOffer function ***/
    public function getOffer($id)
    {
        $offer = Offer::find($id);

        if (!$offer)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $getOffer = OfferResource::make($offer);

        return $this->returnMessageData('تم الحصول علي البيانات بنجاح','200','offer',$getOffer);
    }



    /*** update function ***/
    public function update(OfferRequest $request, $id)
    {
        $offer = Offer::find($id);

        if (!$offer){
            return $this->returnMessageError('هذا العرض غير موجودة','404');
        }

        if (!$offer)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $job = Job::find($request->job_id);
        if (!$job){
            return $this->returnMessageError('هذه الوظيفة غير موجودة','404');
        }

        $user = User::find($request->user_id);
        if (!$user){
            return $this->returnMessageError('هذا المستخدم غير موجودة','404');
        }

        try {
            $offer->update([
                'job_id'=>$request['job_id'],
                'user_id'=>$request['user_id'],
                'message'=>$request['message'],
                'active'=>$request['active'],
            ]);
            return $this->returnMessageData('تم تحديث البيانات بنجاح','200','offer',$offer);
        }
        catch (\Exception $exception){
            return $this->returnMessageError('حدث خطأ ما','500');
        }
    }



    /*** delete function ***/
    public function delete($id)
    {
        $offer = Offer::find($id);

        if (!$offer)
        {
            return $this->returnMessageError('هذا العرض غير موجود','404');
        }

        $offer->delete();
        return $this->returnMessageSuccess('تم حذف البيانات بنجاح','200');
    }

} //end of class
