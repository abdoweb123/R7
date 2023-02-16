<div>
    @section('css')
    @section('title')
       {{ $tittle }}
    @stop
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
    @section('PageTitle')
        {{ $tittle }}
    @stop
    <!-- breadcrumb -->
    @endsection
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="box">
                   <div class="box-header with-border">
                        <h3 class="box-title">سياسه الخصوصيه</h3>
                        <a href="{{ url('police-edit/1') }}" class="btn btn-warning mb-10 text-start">
                            تعديل
                        </a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>الاسم ب العربيه </th>
                                    <th> الاسم ب الانجليزيه </th>
                                    <th> ناريخ السريان </th>
                                    <th>المحتوي ب العربيه </th>
                                    <th> المحتوي ب الانجليزيه </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ @$result->title_ar }}</td>
                                        <td>{{ @$result->title_en }}</td>
                                        <td>{{ @$result->date }}</td>
                                        <td>{!! \Str::of(@$result->details)->limit(150)  !!}</td>
                                        <td>{!! \Str::of(@$result->details_en)->limit(150)  !!}</td>
                                    </tr>
                            </table>
                       </div>
                   </div>
                   <!-- /.box-body -->
                 </div>
                 <!-- /.box -->      
            </div> 
        </div>
    </div>
    @section('js')

    @endsection
</div>
