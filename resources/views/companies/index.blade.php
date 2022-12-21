@extends('layouts.master')
@section('css')
@section('title')
    قائمة الشركات
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    .process
    {
        cursor:pointer;
        background-color: #d4e3f026;
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
    قائمة الشركات
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


                    <a href="{{route('companies.create')}}" class="button x-small">
                        إضافة شركة
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الشركة باللغة العربية</th>
                                <th>اسم الشركة باللغة الانجليزية</th>
                                <th>صورة شعار الشركة</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($companies as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('company_name', 'ar') }}</td>
                                    <td>{{ $item->getTranslation('company_name', 'en') }}</td>
                                    <td><img src="{{asset('assets/images/'. $item->logo_image)}}" alt="identity_image" style="width:100px;"></td>

                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <a type="button" href="{{route('companies.edit',$item->id)}}" class="process">
                                           <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></a>

                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="delete">
                                           <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>

                                        <a type="button" href="{{route('companies.show',$item->id)}}" class="process">
                                            <i style="color:goldenrod; font-size:18px;" class="fa fa-eye"></i></a>
                                    </td>
                                </tr>


                                <!--  page of delete_modal_city -->
                                @include('companies.delete')


                            @endforeach
                        </table>

                        <div> {{$companies->links('pagination::bootstrap-4')}}</div>
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




