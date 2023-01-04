<div>
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center" >
        <thead>
        <tr>
            <th>#</th>
            <th>وصف الوظيفه</th>
            <th>الشركه </th>
            <th>المدينه  </th>
        </tr>
        </thead>
        <tbody>
        @if (count($results))
            @foreach ($results as $index=>$result)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ @$result->job_description }}</td>
                    <td>{{ @$result->company->company_name }}</td>
                    <td>{{ @$result->city->name }}</td>
                    <td>
                    <a href="{{ url('all/offers/'.$result->id.'/'.$result->company_id) }}" class='btn btn-primary btn-sm'>التفاصيل </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    <div> {{$results->links('pagination::bootstrap-4')}}</div>
</div>
