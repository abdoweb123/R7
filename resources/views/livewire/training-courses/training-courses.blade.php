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
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        @foreach(['danger','warning','success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                                <div class="alert alert-{{$msg}}">
                                    {{Session::get('alert-'.$msg)}}
                                </div>
                            @endif
                        @endforeach

                        <br><br>

                        <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'عرض الكل ' : 'اضافه ' . $tittle }}
                            </button>
@if ($showForm == true)
    <livewire:training-courses.edit >
@else
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المحتوي </th>
                                    <th>مقدمه بواسطه </th>
                                    <th>نوع المقدم </th>
                                    <th>الشركه </th>
                                    <th>تاريخ البدايه </th>
                                    <th>تاريخ النهايه </th>
                                    <th>التكلفه </th>
                                    <th>تكلفه الموظف </th>
                                    <th>تكلفه الشركه </th>
                                    <th>تكلفه التطبيق </th>
                                    <th>الاجرائات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($results))
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->content }}</td>
                                            <td>{{ @$result->provided_by }}</td>
                                            <td>{{ @$result->provided_by_type }}</td>
                                            <td>{{ @$result->compnay->company_name }}</td>
                                            <td>{{ @$result->start_date }}</td>
                                            <td>{{ @$result->end_date }}</td>
                                            <td>{{ @$result->total_cost }}</td>
                                            <td>{{ @$result->employee_cost }}</td>
                                            <td>{{ @$result->company_cost }}</td>
                                            <td>{{ @$result->app_cost }}</td>
                                            <td style="width: 15%">
                                                <button class="btn btn-primary"  title="تعديل"  wire:click='edit_form({{ $result->id }})'>
                                                    <i  class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" wire:click='make_delete({{ $result->id }})' title="حذف">
                                                    <i class="fa fa-trash"></i>
                                                </button >
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <div>
                                {{$results->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <!--  page of add_modal_city -->
    <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                id="delete">
                حذف غرفه
            </h5>
            <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent='delete_at'>
                <p> هل أنت متأكد من عملية الحذف ؟</p>
                <p> سيتم نقل عامل التوصيل إلى سلة المهملات</p>
                {{-- <input id="id" type="hidden" name="id" class="form-control""> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-danger" >حذف</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endif
    </div>
    @section('js')
        @toastr_js
        @toastr_render
        <script>
            $(document).ready(function(){
                $(".alert").delay(5000).slideUp(300);
            });
        </script>
         <script>
            $(document).ready(function(){
            window.livewire.on('remove_modal', () => {
            $('#delete').modal('hide');
            });
            window.livewire.on('showDelete', () => {
            $('#delete').modal('show');
            });
        });
        </script>
    @endsection
</div>
