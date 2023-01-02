@extends('layouts.master')
@section('css')
@section('title')
    قائمة الوظائف
@stop


<style>
    /*.process{border:none; border-radius:3px; padding:3px 5px;}*/
     select{padding:10px !important;}
     .table-responsive{overflow-x:visible !important;}
    /*.process*/
    /*{*/
    /*    cursor:pointer;*/
    /*    background-color:white;*/
    /*    border-radius:3px;*/
    /*    border: 1px solid #dddd;*/
    /*    padding: 5px 3px 0 4px;*/
    /*    margin-left: 2px;*/
    /*}*/
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الوظائف
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
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


                    <a href="{{route('jobs.create')}}" class="button x-small">
                        إضافة وظيفة
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الشركة</th>
                                <th>اسم المدينة</th>
                                <th>اسم التخصص</th>
                                <th>اسم الموظف</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['jobs'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->city->name)  {{ $item->city->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->specialty->name)  {{ $item->specialty->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->user->full_name)  {{ $item->user->full_name }} @else _____ @endisset</td>
                                    <td>{{$item->start_time}}</td>
                                    <td>{{$item->end_time}}</td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                العمليات
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{route('jobs.show',$item->id)}}">
                                                    <i class="fa fa-eye" style="color: #4d3f15"></i>&nbsp عرض بيانات الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('jobs.edit',$item->id)}}">
                                                    <i class="fa fa-edit" style="color: #ffc107"></i>&nbsp تعديل بيانات الوظيفة
                                                </a>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                    <i class="fa fa-trash" style="color: red"></i>&nbsp حذف الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('jobTasks.index',[$item->id, $item->company->id])}}">
                                                    <i class="fa fa-eye" style="color: goldenrod"></i>&nbsp مهمات الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('jobRequirements.index',[$item->id , $item->company->id])}}">
                                                    <i class="fa fa-eye" style="color: #68511b"></i>&nbsp متطلبات الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('jobTerms.index',[$item->id, $item->company->id])}}">
                                                    <i class="fa fa-eye" style="color: #cbb175"></i>&nbsp شروط الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('offers.index',[$item->id, $item->company->id])}}">
                                                    <i class="fa fa-eye" style="color: #493d1e"></i>&nbsp العروض المقدمة
                                                </a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <!--  page of delete_modal_city -->
                                @include('jobs.delete')


                            @endforeach
                        </table>

                        <div> {{$data['jobs']->links('pagination::bootstrap-4')}}</div>
                    </div>
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
    </script>
@endsection




