@extends('layouts.master')
@section('css')
@section('title')
    قائمة شروط الوظائف
@stop

<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    .process
    {
        cursor:pointer;
        background-color:white;
        border-radius:3px;
        border: 1px solid #dddd;
        padding: 5px 3px 0 4px;
        margin-left: 2px;
    }
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة شروط الوظائف
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="box">

                    <h6><span style="border-radius: 5px; padding:5px"> <a href="{{route('returnJob',$job_id)}}"><span style="color:#8ea0db;">الوظيفة</span></a> / شروط الوظيفة </span></h6>

                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                
                    <div class="box-header with-border">
                        <a href="{{route('jobTerms.create',[$job_id, $company_id])}}" class="btn btn-warning">
                            إضافة شرط للوظيفة
                        </a>
                    </div>
                    @foreach(['danger','warning','success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <div class="alert alert-{{$msg}}">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach

                    <br><br>

                    <div class="box-body">
                    <div class="table-responsive">
                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الشرط باللغة العربية</th>
                                <th>اسم الشرط باللغة الإنجليزية</th>
                                <th>اسم الشركة</th>
                                <th>اسم الوظيفة</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($jobTerms as $item)
                                <tr>

                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('name', 'ar') }}</td>
                                    <td>{{ $item->getTranslation('name', 'en') }}</td>
                                    <td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->job->job_description)  {{ $item->job->job_description }} @else لا يوجد @endisset</td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#edit{{ $item->id }}" title="تعديل">
                                           <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>

                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                           <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('jobTerms.edit')

                                <!--  page of delete_modal_city -->
                                @include('jobTerms.delete')


                            @endforeach
                        </table>

                        <div> {{$jobTerms->links('pagination::bootstrap-4')}}</div>
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




