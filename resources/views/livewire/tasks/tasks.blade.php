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
                <div class="box">
                    <div class="box-header with-border">
                        المهام اليوميه
                            {{-- <a href="javascrip:void(0);" class="btn btn-warning mb-10" wire:click='switch'>
                                {{ $showForm == true ? 'عرض الكل ' : 'اضافه ' . $tittle }}
                            </a> --}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                             <table id="example5" class="table table-bordered table-striped" style="width:100%">
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
                                        <th>بدأ</th>
                                        <th>انتهى</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($results))
                                        @foreach ($results as $index=>$item)
                                            <tr>
                                                <td>@isset($item->job->job_description)  {{ $item->job->job_description }} @else لا يوجد @endisset</td>
                                                <td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
                                                <td>@isset($item->user->full_name)  {{ $item->user->full_name }} @else _____ @endisset</td>
                                                <td>{{$item->getTranslation('name', 'ar')}}</td>
                                                <td>{{$item->getTranslation('name', 'en')}}</td>
                                                <td>{{$item->getTranslation('description', 'ar')}}</td>
                                                <td>{{$item->getTranslation('description', 'en')}}</td>
                                                <td>{{$item->started == true ? 'تم' : '___'}}</td>
                                                <td>{{$item->finished == true ? 'تم' : '___'}}</td>
                                                <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
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
    <script src="{{ url('admin/assets/icons/feather-icons/feather.min.js') }}"></script>
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
