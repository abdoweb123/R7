<div>
    @section('css')
    @section('title')
       {{ $tittle }}
    @stop
    <style>
        .process{border:none; border-radius:3px; padding:3px 5px;}
        select{padding:10px !important;}
    </style>
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
    <livewire:employees.edit >
@else
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                             <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم </th>
                                        <th>الايميل  </th>
                                        <th>رقم الهاتف</th>
                                        <th>المدينه </th>
                                        <th>الاجرائات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($results))
                                        @foreach ($results as $index=>$result)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ @$result->company_name }}</td>
                                                <td>{{ @$result->company_email }}</td>
                                                <td>{{ @$result->company_phone }}</td>
                                                <td>{{ @$result->city->name }}</td>
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
        {{-- @include('livewire.training-courses.delete') --}}
@endif
</div>
    @section('js')
    <script src="{{ url('admin_new/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ url('admin_new/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ url('admin_new/assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/moment/min/moment.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{ url('admin_new/assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ url('admin_new/js/pages/advanced-form-element.js') }}"></script>
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
