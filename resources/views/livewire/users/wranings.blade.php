<div>
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center" >
        <thead>
        <tr>
            <th>#</th>
            <th>الرساله</th>
            <th>الشركه </th>
            <th>انشئ في  </th>
        </tr>
        </thead>
        <tbody>

        @if (count($results))
            @foreach ($results as $index=>$result)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ @$result->message }}</td>
                    <td>{{ @$result->company->company_name }}</td>
                    <td>{{ @$result->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </table>
    <div> {{$results->links('pagination::bootstrap-4')}}</div>
</div>
