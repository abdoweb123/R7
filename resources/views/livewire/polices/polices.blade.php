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

                            <a href="{{ url('police-edit/1') }}" class="btn btn-primary mb-10">
                                تعديل
                            </a>

                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
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
                </div>
            </div>
        </div>
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
        <script src="{{ url('editor_html/ckeditor.js')}}"></script>
        <script src="{{ url('editor_html/adapters/jquery.js')}}"></script>
           <script>
           $( document ).ready( function() {
               $( 'textarea.editor1' ).ckeditor();
           } );
        
           </script>
    @endsection
</div>
