@extends('layouts.master')
@section('css')
@section('title')
    قائمة العروض
@stop

<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    .process{border:none; border-radius:3px; padding:3px 5px;}
    .process
    {
        cursor:pointer;
        background-color: #d4e3f026;
        border-radius:3px;
        border: 1px solid #dddd;
        padding: 5px 3px 0 4px;
        margin-left: 2px;
    }
    p{font-weight:bold}

    ul{list-style:none; margin:0; padding:0 !important;}
    ul .li-tab{display:inline-block; background-color:#28a745; padding:5px; cursor:pointer; margin-left: 10px; color:white}
    ul .inactive{background-color:#007bff; border-color: #28a745;}
    .my-container ~ div{min-height:200px; margin-top:20px; /*background-color:#eee; padding:10px; */ }
    .my-container > div:not(:first-of-type){display:none}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة العروض
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        @if($job->user)
           <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

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


                    <div class="row">
                        <div class="col">
                             <img style="border-radius: 5px; width: 160px;  height: 160px" src="{{asset('assets/images/'.$job->user->profile_image)}}" alt="الصورة الشخصية">
                        </div>

                        <div class="col">
                            <h5>{{$job->user->full_name}}</h5>
                            <br>
                            <p>  رقم الهاتف :   &nbsp;&nbsp;&nbsp;<span>{{$job->user->phone}}</span></p>
                            <p>  البريد الإلكتروني :  &nbsp;&nbsp;&nbsp;<span>{{$job->user->email}}</span></p>
                            <p>  المدينة :  &nbsp;&nbsp;&nbsp;<span>{{$job->user->city->name}}</span></p>
                        </div>

                        <div class="col text-right">
                            <button  data-toggle="modal" data-target="#dues" class="btn btn-success mx-2"> المستحقات</button>
                            <button  data-toggle="modal" data-target="#createReward" class="btn btn-primary mx-2">إعطاء مكافأة</button>
                            <button  data-toggle="modal" data-target="#createWarning" class="btn btn-warning">خصم</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif



        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h4 class="text-center font-weight-bold mb-4">تفاصيل الوظيفة</h4>

                    <div class="my-container">
                        <ul id="my-taps" class="text-center mb-5">
                            <li id="tap1" class="btn li-tab">العروض المقدمة</li>
                            <li id="tap4" class="btn inactive li-tab">المهام</li>
                            <li id="tap2" class="btn inactive li-tab">المكافاءات</li>
                            <li id="tap3" class="btn inactive li-tab">الخصومات</li>
                        </ul>



                        <div id="tap1-content">
                            {{-- offers --}}
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>وصف الوظيفة</th>
                                        <th>اسم الموظف</th>
                                        <th>الحالة</th>
                                        <th>السيرة الذاتية</th>
                                        <th>القبول</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($offers as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item->job->job_description }}</td>
                                            <td><a href="{{route('users.show',$item->user_id)}}" style="color:#e30000">{{ $item->user->full_name }}</a></td>
                                            <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                            <td><a href="{{route('users.show', $item->user_id)}}" class="btn btn-primary">CV</a></td>
                                            <td>
                                                @if( $accepted == 2 )
                                                    <a href="{{ url('accept-offer/'.$item->id) }}" class="btn btn-primary">قبول</a>
                                                @elseif(($accepted == 1 &&  $item->accepted == 1))

                                                    <a href="#" class="btn btn-success">تم القبول</a>
                                                @elseif(($accepted == 1 &&  $item->accepted == 2))
                                                    _________
                                                @endif
                                            </td>
                                            <td>
                                                @if(($accepted == 1 &&  $item->accepted == 1) || $accepted == 2)
                                                    <button type="button" class="process"
                                                            data-toggle="modal" data-target="#edit{{ $item->id }}" title="تعديل">
                                                        <i style="color:cadetblue;  font-size:18px;" class="fa fa-edit"></i></button>

                                                    <button type="button" class="process"
                                                            data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                                        <i style="color:red;  font-size:18px;" class="fa fa-trash"></i></button>
                                                @else
                                                    _________
                                                @endif
                                            </td>
                                        </tr>

                                        <!--  page of edit_modal_city -->
                                        @include('offers.edit')

                                        <!--  page of delete_modal_city -->
                                    @include('offers.delete')


                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div id="tap4-content">
                            {{-- tasks --}}
                            <div class="table-responsive">


                                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createOffer">
                                    إضافة مهمة
                                </button>


                                <table class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>وصف الوظيفة</th>
                                        <th>اسم الشركة</th>
                                        <th>اسم الموظف</th>
                                        <th>اسم المهمة باللغة العربية</th>
                                        <th>اسم المهمة باللغة الإنجليزية</th>
                                        <th>وصف المهمة باللغة العربية</th>
                                        <th>وصف المهمة باللغة العربية</th>
                                        <th>الحالة</th>
{{--                                        <th>العمليات</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tasks as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>@isset($item->job->job_description)  {{ $item->job->job_description }} @else لا يوجد @endisset</td>
                                            <td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
                                            <td>@isset($item->user->full_name)  {{ $item->user->full_name }} @else _____ @endisset</td>
                                            <td>{{$item->getTranslation('name', 'ar')}}</td>
                                            <td>{{$item->getTranslation('name', 'en')}}</td>
                                            <td>{{$item->getTranslation('description', 'ar')}}</td>
                                            <td>{{$item->getTranslation('description', 'en')}}</td>
                                            <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
{{--                                            <td>--}}
{{--                                                <a href="{{route('jobTasks.edit',$item->id)}}" class="process">--}}
{{--                                                    <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></a>--}}

{{--                                                <button type="button" class="process" data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">--}}
{{--                                                    <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>--}}
{{--                                            </td>--}}
                                        </tr>

                                        @include('jobTasks.delete')


                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div id="tap2-content">
                            {{-- rewards --}}
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المبلغ</th>
                                        <th>الملاحظات</th>
                                        <th>أنشئ في</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($rewards as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->notes !== null ? $item->notes : '_____'}}</td>
                                            <td>{{ $item->created_at}}</td>
                                            <td>
                                                <button type="button" class="process"
                                                        data-toggle="modal" data-target="#deleteAnnouncement{{ $item->id }}" title="حذف">
                                                    <i style="color:red;  font-size:18px;" class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <!--  page of delete_modal_city -->
                                       @include('offers.announcements.deleteAnnouncement')

                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div id="tap3-content">
                            {{-- warnings --}}
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المبلغ</th>
                                        <th>الملاحظات</th>
                                        <th>أنشئ في</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($warnings as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->notes !== null ? $item->notes : '_____'}}</td>
                                            <td>{{ $item->created_at}}</td>
                                            <td>
                                                <button type="button" class="process"
                                                        data-toggle="modal" data-target="#deleteAnnouncement{{ $item->id }}" title="حذف">
                                                    <i style="color:red;  font-size:18px;" class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <!--  page of delete_modal_city -->
                                       @include('offers.announcements.deleteAnnouncement')

                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                    <br><br>


                </div>
            </div>
        </div>

            @include('offers.announcements.createReward')
            @include('offers.announcements.createWarning')
            @include('offers.jobTasks.create')
    </div>


@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });


        $(document).ready(function(){
            $("#my-taps li").click(function(){

                var myId = $(this).attr("id");

                $(this).removeClass("inactive").siblings().addClass("inactive");

                $(".my-container > div").hide();

                $("#" + myId + "-content").fadeIn(0);

            });
        });
    </script>
@endsection




