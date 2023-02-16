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
                           <h4> {{ @$tittle }}</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                             <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> المسؤل </th>
                                        <th>رقم الهاتف </th>
                                        <th>الايميل</th>
                                        <th>الرساله  </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($results))
                                        @foreach ($results as $index=>$result)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ @$result->admin->company_name }}</td>
                                                <td>{{ @$result->phone }}</td>
                                                <td>{{ @$result->mail }}</td>
                                                <td>{{ @$result->message }}</td>
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
