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
                            <a href="javascrip:void(0);" class="btn btn-warning mb-10" wire:click='switch'>
                                {{ $showForm == true ? 'عرض الكل ' : 'اضافه ' . $tittle }}
                            </a>
                    </div>
@if ($showForm == true)
    <livewire:trainers.edit >
@else
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                             <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم  </th>
                                        <th>النوع  </th>
                                        <th>رقم الهاتف  </th>
                                        {{-- <th>الشهادة  </th> --}}
                                        {{-- <th>رخصة التدريب  </th> --}}
                                        {{-- <th> السجل التجاري  </th> --}}
                                        <th>الاجرائات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($results))
                                        @foreach ($results as $index=>$result)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ @$result->name }}</td>
                                                <td>{{ @$result->kind }}</td>
                                                <td>{{ @$result->mobile }}</td>
                                                {{-- <td><img src="{{ image_exist(@$result->certificate) }}" alt=""></td>
                                                <td><img src="{{ image_exist(@$result->training_license) }}" alt=""></td>
                                                <td><img src="{{ image_exist(@$result->commercial_register) }}" alt=""></td> --}}
                                                <td style="width: 15%">
                                                    {{-- <a href="javascript:void(0);" data-bs-toggle="tooltip" wire:click='edit_form({{ $result->id }})' data-container="body" title="" data-bs-original-title="Edit"><i class="fa fa-edit"></i> </a> --}}
                                                    {{-- <a href="javascript:void(0);" data-bs-toggle="tooltip" wire:click='make_delete({{ $result->id }})' data-container="body" title="" data-bs-original-title="Remove"><i class="fa fa-trash-o"></i> </a> --}}
                                                    <a href="javascript:void(0);" wire:click='edit_form({{ $result->id }})'class="process">
                                                        <i style="color:rgb(236, 233, 32); font-size:18px;" class="fa fa-edit"></i></a>
             
                                                     <a href="javascript:void(0);" wire:click='make_delete({{ $result->id }})' class="process">
                                                         <i style="color:rgb(202, 24, 24); font-size:18px;" class="fa fa-trash"></i></a>
             
                                                         {{-- <button href="javascript:void(0);" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                                                             <i class="fa fa-trash"></i>
                                                           </button> --}}
                                                </td>
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
    <!--  page of add_modal_city -->
        @include('livewire.training-courses.delete')
@endif
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
