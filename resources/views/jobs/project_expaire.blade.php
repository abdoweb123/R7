@extends('layouts.master')
@section('css')
@section('title')
     قائمة الوظائف المنتهيه
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
قائمة الوظائف المنتهيه
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
                      <h4>قائمه الوظائف المنتهيه  </h4>
                    </div>
                    <br><br>
                    <div class="box-body">
                    <div class="table-responsive">
                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
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
                                {{-- <th>العمليات</th> --}}
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
                                        {{-- <div class="dropdown show"> --}}
                                            {{-- <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="fa fa-angle-left pull-left"></i>  العمليات
                                            </a> --}}

                                            {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> --}}
                                                {{-- <a  href="{{route('jobs.show',$item->id)}}" title="عرض بيانات الوظيفة">
                                                    <i class="fa fa-eye" style="color: #ffc107"></i>&nbsp 
                                                </a> --}}
                                                {{-- <a  href="{{route('offers.index',[$item->id, $item->company->id])}}" title="عرض بيانات الوظيفة">
                                                    <i class="fa fa-eye" style="color: #ffc107"></i>&nbsp 
                                                </a>

                                                <a  href="{{route('jobs.edit',$item->id)}}" title="تعديل بيانات الوظيفة">
                                                    <i class="fa fa-edit" style="color: #ffc107"></i>&nbsp 
                                                </a>

                                                <a  data-toggle="modal" data-target="#delete{{ $item->id }}" title=" حذف الوظيفة">
                                                    <i class="fa fa-trash" style="color: red"></i>&nbsp
                                                </a> --}}

                                              

                                            {{-- </div> --}}
                                        {{-- </div> --}}
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




