@extends('layouts.master')
@section('css')
@section('title')
    عرض بيانات الوظيفة
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   عرض بيانات الوظيفة
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

    <h6><span style="border-radius: 5px; padding:5px">عرض بيانات الوظيفة</span></h6>

    @foreach(['danger','warning','success','info'] as $msg)
        @if(Session::has('alert-'.$msg))
            <div class="alert alert-{{$msg}}">
                {{Session::get('alert-'.$msg)}}
            </div>
        @endif
    @endforeach

    <!-- row mb-3 -->
    @if(!auth('company'))
        <div class="row mb-3">
            <div class="col-xl-12 mb-30">
                <div class="box">
                    <div class="box-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">الشركة</label>
                                <input type="text" value="{{$job->company->company_name}}" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">المدينة</label>
                                <input type="text" value="{{$job->city->name}}" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">التخصص</label>
                                <input type="text" value="{{$job->specialty->name}}" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">خطوط الطول</label>
                                <input type="number" step="0.1" name="longitude" value="{{old('longitude', $job->longitude)}}" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">خطوط العرض</label>
                                <input type="number" step="0.1" name="latitude" value="{{old('latitude', $job->latitude)}}" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">وقت التنفيذ بالأيام</label>
                                <input type="number" name="duration_by_day" value="{{old('duration_by_day', $job->duration_by_day)}}" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">أقل تكلفة</label>
                                <input type="number" step="0.1" name="minimum_cost" value="{{old('minimum_cost', $job->minimum_cost)}}" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">أكبر تكلفة</label>
                                <input type="number" step="0.1" name="maximum_cost" value="{{old('maximum_cost', $job->maximum_cost)}}" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">نوع الوظيفة</label>
                                @if($job->job_type == 1)
                                    <input type="text" value="دوام جزئي" class="form-control" readonly>
                                @else
                                    <input type="text" value="دوام كلي" class="form-control" readonly>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">طريقة الدفع</label>
                                @if($job->job_type == 1)
                                    <input type="text" value="اليوم" class="form-control" readonly>
                                @else
                                    <input type="text" value="المهمة" class="form-control" readonly>
                                @endif
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">تاريخ البداية</label>
                                <input type="date" name="start_time" value="{{old('start_time', $job->start_time)}}"  class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">تاريخ النهاية</label>
                                <input type="date" name="end_time" value="{{old('end_time', $job->end_time)}}"  class="form-control" readonly>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col">
                                <label for="image" class="mr-sm-2">الحالة</label>
                                @if($job->active == 1)
                                    <input type="text" value="نشط" class="form-control" readonly>
                                @else
                                    <input type="text" value="غير نشط" class="form-control" readonly>
                                @endif
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">وصف الوظيفة</label>
                                <textarea name="job_description" rows="6" class="form-control" readonly>{{old('job_description', $job->job_description)}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth('company'))
        <div class="row mb-3">
        <div class="col-xl-12 mb-30">
            <div class="box">
                <div class="box-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="mr-sm-2">المدينة</label>
                            <input type="text" value="{{$job->city->name}}" class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label class="mr-sm-2">التخصص</label>
                            <input type="text" value="{{$job->specialty->name}}" class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label class="mr-sm-2">خطوط الطول</label>
                            <input type="number" step="0.1" name="longitude" value="{{old('longitude', $job->longitude)}}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="mr-sm-2">خطوط العرض</label>
                            <input type="number" step="0.1" name="latitude" value="{{old('latitude', $job->latitude)}}" class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label class="mr-sm-2">وقت التنفيذ بالأيام</label>
                            <input type="number" name="duration_by_day" value="{{old('duration_by_day', $job->duration_by_day)}}" class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label class="mr-sm-2">أقل تكلفة</label>
                            <input type="number" step="0.1" name="minimum_cost" value="{{old('minimum_cost', $job->minimum_cost)}}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="mr-sm-2">أكبر تكلفة</label>
                            <input type="number" step="0.1" name="maximum_cost" value="{{old('maximum_cost', $job->maximum_cost)}}" class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label class="mr-sm-2">نوع الوظيفة</label>
                                @if($job->job_type == 1)
                                <input type="text" value="دوام جزئي" class="form-control" readonly>
                                @else
                                <input type="text" value="دوام كلي" class="form-control" readonly>
                                @endif
                        </div>
                        <div class="col">
                            <label class="mr-sm-2">طريقة الدفع</label>
                            @if($job->job_type == 1)
                                <input type="text" value="اليوم" class="form-control" readonly>
                            @else
                                <input type="text" value="المهمة" class="form-control" readonly>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="mr-sm-2">تاريخ البداية</label>
                            <input type="date" name="start_time" value="{{old('start_time', $job->start_time)}}"  class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label class="mr-sm-2">تاريخ النهاية</label>
                            <input type="date" name="end_time" value="{{old('end_time', $job->end_time)}}"  class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label for="image" class="mr-sm-2">الحالة</label>
                            @if($job->active == 1)
                                <input type="text" value="نشط" class="form-control" readonly>
                            @else
                                <input type="text" value="غير نشط" class="form-control" readonly>
                            @endif
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="mr-sm-2">بدأ</label>
                            <input type="text" name="minimum_cost" value="{{$job->started == true ? 'تم' : '___'}}" class="form-control" readonly>
                        </div>
                        <div class="col-4">
                            <label class="mr-sm-2">انتهى</label>
                            <input type="text" name="minimum_cost" value="{{$job->finished == true ? 'تم' : '___'}}" class="form-control" readonly>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col">
                            <label class="mr-sm-2">وصف الوظيفة</label>
                            <textarea name="job_description" rows="6" class="form-control" readonly>{{old('job_description', $job->job_description)}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });
    </script>
@endsection
