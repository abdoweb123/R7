<div>
    @if (auth()->guard('company'))
        <div class="card card-statistics h-100">
            <div class="card-body">
                {{-- <div class="mb-40">
                    <h4> احصائيات الفندق <span style="color: rgb(83, 83, 185)">:{{ @$result->name }}</span></h4>
                </div> --}}
                <div class="row  mt-10" style="font-size: 20px !important">
                    <div class="col-lg-4  mb-5">
                        <div class="col  bg-warning  pt-10 pb-10 rounded-xl mr-7  text-center text-white" style="max-height: 143px;">
                           <i class="fas fa-users"></i><br>
                            اجمالي الموظفون<br>
                            <span class="text-white">{{ ( @$total_employees )}}</span><br>
                        </div>
                    </div>
                    <div class="col-lg-4  mb-5">
                        <div class="col  bg-info  pt-10 pb-10 rounded-xl mr-7  text-center text-white" style="max-height: 143px;">
                           <i class="fas fa-toggle-on "></i><br>
                            اجمالي الوظائف النشطه<br>
                            <span class="text-white">{{ (   @$total_jobs_active )}}</span><br>
                        </div>
                    </div>
                    <div class="col-lg-4  mb-5">
                        <div class="col  bg-primary  pt-10 pb-10 rounded-xl mr-7  text-center text-white" style="max-height: 143px;">
                            <i class="fas fa-toggle-off"></i><br>
                            اجمالي الوظائف الغير نشطه<br>
                            <span class="text-white">{{ ( @$total_jobs_disactive )}}</span><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            <h5>التقويم</h5>
                        </label>
                        <table class="table table-striped  table-striped  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الموظف </th>
                                    <th>وصف</th>
                                    <th>التاريخ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($job_tasks))
                                    @foreach ($job_tasks as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->user->full_name }}</td>
                                            <td>{{ @$result->description }}</td>
                                            <td>{{ @$result->date }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            <h5>الاشعارات</h5>
                        </label>
                        <table class="table table-striped table-striped  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الموظف </th>
                                    <th>الوظيفه</th>
                                    <th>الرساله</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($notifactions))
                                    @foreach ($notifactions as $index=>$notifaction)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$notifaction->user->full_name }}</td>
                                            <td>{{ @$notifaction->description }}</td>
                                            <td>{{ @$notifaction->notes }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="">
                            <h5>المصروفات</h5>
                        </label>
                        <table class="table  table-striped  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الموظف </th>
                                    <th>الوظيفه</th>
                                    <th>المبلغ</th>
                                    <th>النوع</th>
                                    <th>التفاصيل</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($announcements))
                                    @foreach ($announcements as $index=>$announcement)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$announcement->user->full_name }}</td>
                                            <td>{{ @$announcement->job->description }}</td>
                                            <td>{{ @$announcement->amount }}</td>
                                            <td>
                                                @if(@$announcement->type == 1)
                                                    مكافأه
                                                @elseif(@$announcement->type == 2)
                                                خصم 
                                                @else
                                                مستحقات
                                                @endif
                                            </td>
                                            <td>{{ @$announcement->notes }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <div>
                                {{$announcements->links('pagination::bootstrap-4')}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        مرحبا بكم في لزحه تحكم الادمن في R7
    @endif
</div>
