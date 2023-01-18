@extends('layouts.master')
@section('css')
@section('title')
    قائمة الموظفين
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
    قائمة الموظفين
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


                    <a href="{{route('users.create')}}" class="button x-small">
                        إضافة موظف
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم بالكامل</th>
                                <th>الصورة الشخصية</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف الشخصي</th>
                                <th>الحالة</th>
                                <th>اضافه تحذير</th>
                                <th> التفاصيل</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['users'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$item->full_name}}</td>
                                    <td><img src="{{asset('assets/images/'. $item->profile_image)}}" alt="profile_image" style="width:100px;"></td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_wraning{{ $item->id }}" title="اضافه تحذير">اضافه تحذير</button>
                                    </td>
                                    <td>
                                    <a href="{{url('user-details',$item->id)}}" class="btn btn-info btn-sm">
                                           التفاصيل</a>
                                    </td>
                                    <td>
                                        <a type="button" href="{{route('users.edit',$item->id)}}" class="process">
                                           <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></a>

                                        <a type="button" href="{{route('users.show',$item->id)}}" class="process">
                                            <i style="color:goldenrod; font-size:18px;" class="fa fa-eye"></i></a>

                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                           <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!--  page of delete_modal_city -->
                                @include('users.delete')


                            @endforeach
                        </table>

                        <div> {{$data['users']->links('pagination::bootstrap-4')}}</div>
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




