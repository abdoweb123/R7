<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{

    /*** index function ***/
//    public function index()
//    {
//        $cities = City::latest()->paginate(10);
//        $countries = Country::select('id','name')->get();
//        return view('cities.index', compact('cities','countries'));
//    }



    /*** store function ***/
    public function store(Request $request)
    {
       $request->validate([
           'amount' => 'required',
       ],[
           'amount.required' => 'الكمية مطلوبة',
       ]);

        $announcement = new Announcement();
        $announcement->job_id = $request->job_id;
        $announcement->user_id = $request->user_id;
        $announcement->type = $request->type;
        $announcement->amount = $request->amount;
        $announcement->notes = $request->notes;
        $announcement->save();

        return redirect()->back()->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function ***/
//    public function update(CityRequest $request, City $announcement)
//    {
//        $announcement->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
//        $announcement->active = $request->active;
//        $announcement->country_id = $request->country_id;
//        $announcement->update();
//
//        return redirect()->route('cities.index')->with('alert-info','تم تعديل البيانات بنجاح');
//    }



    /*** destroy function ***/
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->back()->with('alert-success','تم نقل البيانات إلى سلة المهملات');
    }


} //end of class
