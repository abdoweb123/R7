<div>
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center" >
        <thead>
        <tr>
            <th>#</th>
            <th>الوظيفه</th>
            <th>المهمه </th>
            {{--  <th>العرض  </th>  --}}
            <th>الحاله</th>
        </tr>
        </thead>
        <tbody>
        @if (count($results))
            @foreach ($results as $index=>$result)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ @$result->job->job_description }}</td>
                    <td>{{ @$result->jobTask->name }}</td>
                    {{--  <td>{{ @$result->offer->name }}</td>  --}}
                    <td>{{ @$result->active }}</td>
                </tr>
            @endforeach
        @endif
    </table>
    <div> {{$results->links('pagination::bootstrap-4')}}</div>
</div>
