@extends('layouts.master')
@section('css')
@section('title')
    عرض بيانات الشركة
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}


    .details
    {
        list-style: none;
        max-width: 150px;
        text-align: center;
        margin: auto;
    }
    h3
    {
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px !important;
    }

</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  عرض بيانات الشركة
@stop
<!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @foreach(['danger','warning','success','info'] as $msg)
        @if(Session::has('alert-'.$msg))
            <div class="alert alert-{{$msg}}">
                {{Session::get('alert-'.$msg)}}
            </div>
        @endif
    @endforeach


    <!-- row mb-3 -->
    <div class="row mb-3">
        <div class="col-xl-12 mb-30">
            <div class="box">
                    <div class="my-container">
                       <div class="details">
                          <h3> بيانات الشركة</h3>
                       </div>

                        <div id="tap1-content">
                            <div class="row">
{{--                                <img style="border-radius: 50%; width: 150px;  height: 150px" src="{{asset('assets/images/'.$company->profile_image)}}" alt="الصورة الشخصية">--}}
                            </div>
                            <div class="box-body wizard-content">   
                                <div class="row">
                                    <div class="col">
                                        <div class="mt-4">
                                            <label class="d-inline">اسم الشركة باللغة العربية</label>
                                            <p style="font-weight:bold">{{$company->getTranslation('company_name', 'ar')}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-inline"> اسم الشركة باللغة الانجليزية</label>
                                            <p style="font-weight:bold">{{$company->getTranslation('company_name', 'en')}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-inline">البريد الإلكتروني للشركة</label>
                                            <p style="font-weight:bold">{{$company->company_email}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-inline">رقم هاتف الشركة</label>
                                            <p style="font-weight:bold">{{$company->company_phone}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-inline">مدينة تواجد الشركة</label>
                                            <p style="font-weight:bold">{{$company->city->name}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">صورة شعار الشركة</label>
                                            <img src="{{asset('assets/images/'. $company->logo_image)}}" alt="identity_image" style="width:200px; height:150px">
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">صورة شكل الشركة</label>
                                            <img src="{{asset('assets/images/'. $company->cover_image)}}" alt="identity_image" style="width:200px; height:150px">
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">صورة هوية لممثل الشركة</label>
                                            <img src="{{asset('assets/images/'. $company->pre_image)}}" alt="identity_image" style="width:200px; height:150px">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mt-4">
                                            <label class="d-inline">الاسم الرباعي ممثل الشركة</label>
                                            <p style="font-weight:bold">{{$company->pre_fullName}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-inline">البريد الإلكتروني لممثل الشركة</label>
                                            <p style="font-weight:bold">{{$company->pre_email}}</p>
                                        </div>

                                        <div class="mt-4">
                                            <label class="d-inline">العنوان الوطني</label>
                                            <p style="font-weight:bold">{{$company->national_address}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-inline">خدمات الشركة</label>
                                            <p style="font-weight:bold">{{$company->services}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">الوظائف التي سيتم الإعلان عنها</label>
                                            <p style="font-weight:bold">{{$company->jobs}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">صورة السجل التجاري</label>
                                            <img src="{{asset('assets/images/'. $company->commercialRecord_image)}}" alt="identity_image" style="width:200px; height:150px">
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">صورة الترخيص</label>
                                            <img src="{{asset('assets/images/'. $company->licence_image)}}" alt="identity_image" style="width:200px; height:150px">
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">صورة الوكالة الشرعية لممثل الشركة</label>
                                            <img src="{{asset('assets/images/'. $company->pre_agent_image)}}" alt="identity_image" style="width:200px; height:150px">
                                        </div>
                                        <div class="mt-4">
                                            <label class="d-block">صورة العقد بين الشركة وال R7</label>
                                            <img src="{{asset('assets/images/'. $company->contract_image)}}" alt="identity_image" style="width:200px; height:150px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div id="tap2-content">--}}
{{--                            @if($company->jobTasks == [])--}}
{{--                                @foreach($company->jobTasks as $jobTask)--}}
{{--                                    {{ $jobTask->description}}--}}
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                               <p> لا يوجد أعمال سابقة</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div id="tap3-content">About content</div>--}}
{{--                        <div id="tap4-content">Contact content</div>--}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });


        // $(document).ready(function(){
        //     $("#my-taps li").click(function(){
        //
        //         var myId = $(this).attr("id");
        //
        //         $(this).removeClass("inactive").siblings().addClass("inactive");
        //
        //         $(".my-container > div").hide();
        //
        //         $("#" + myId + "-content").fadeIn(0);
        //
        //     });
        // });

    </script>
@endsection
