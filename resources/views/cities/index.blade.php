@extends('layouts.master')
@section('css')
@section('title')
    قائمة المدن
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
    قائمة المدن
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="box">
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

                    <div class="box-header with-border">
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            إضافة مدينة
                        </button>
                    </div>
                    <br><br>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المدينة باللغة العربية</th>
                                    <th>اسم المدينة باللغة الإنجليزية</th>
                                    <th>اسم الدولة</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cities as $item)
                                    <tr>

                                        <td>{{ @$loop->index+1 }}</td>
                                        <td>{{ @$item->getTranslation('name', 'ar') }}</td>
                                        <td>{{ @$item->getTranslation('name', 'en') }}</td>
                                        <td>{{ @$item->country->name }}</td>
                                        <td>{{ @$item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                                <i class="fa fa-edit"></i>
                                              </button>
                                              <button type="button" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                              </button>
                                        </td>
                                    </tr>

                                    <!--  page of edit_modal_city -->
                                    @include('cities.edit')

                                    <!--  page of delete_modal_city -->
                                    @include('cities.delete')


                                @endforeach
                            </table>

                            <div> {{$cities->links('pagination::bootstrap-4')}}</div>
                        </div>
                    </div>
            </div>
        </div>


       <!--  page of add_modal_city -->
       @include('cities.create')
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




