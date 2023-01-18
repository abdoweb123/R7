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

                        <h4>{{ $tittle }}</h4>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">عدد الريكويست({{ $results->count() }})</span>
                        <br><br>
                        <div class="row">
                                <div class="col-md-6">
                                    <form wire:submit.prevent="report" >
                                        <div class="form-group row">
                                            <input class="form-control col-md-3 col-sm-6" type="date" placeholder="date-start" wire:model.lazy='start_date' />
                                            <input class="form-control col-md-3 col-sm-6" type="date" placeholder="date-end" wire:model.lazy='end_date'/>
                                            <button class="btn btn-info font-weight-bolder font-size-sm col-md-2 ">تقرير</button>
                                        </div>
                                    </form>
                                </div> 
                                <div class="col-md-6">
                                    <div class="row">
                                        @if(auth('company')->user()->role_id == 1)
                                        <div class="col-md-4">
                                            <select wire:model='company_id' class="form-control mr-sm-2 p-2" style="width: 100%" wire:change="company_filter">
                                                <option value="">اختر الشركه</option>
                                                @isset($companies)
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        @endif
                                        <div class="col-md-4">
                                            <select wire:model='user_id' class="form-control mr-sm-2 p-2" style="width: 100%" wire:change='user_filter'>
                                                <option value="">اختر الموظف</option>
                                                @isset($users)
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-success" wire:click='download_report_one'><i class="fa fa-download"></i> excel</button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> الوظيفه</th>
                                    <th>الموظف  </th>
                                    <th>الملاحظه </th>
                                    <th> المبلغ</th>
                                    <th> الحاله </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->job->job_description }}</td>
                                            <td>{{ @$result->user->full_name}}</td>
                                            <td>{{ @$result->notes }}</td>
                                            <td>{{ @$result->amount }}</td>
                                            <td>{{ @$result->type == 1 ?  ' -' : ' + ' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                console.log('good');
            $('#delete').modal('show');
            });
        });
        </script>
    @endsection
</div>
