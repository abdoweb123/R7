<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>absence</title>
</head>
<body>
    <div class="table-responsive">
        <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center" >
            <thead>
            <tr>
                <th>#</th>
                <th>الموظف  </th>
                <th> الوظيفه</th>
                <th>حاله الحضور </th>
                <th> وقت البدايه </th>
                <th> وقت النهايه</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$result)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ @$result->user->full_name}}</td>
                        <td>{{ @$result->job->job_description }}</td>
                        <td>{{ @$result->started != 0 ?  'تم الحضور' : 'لم يتم الحضور' }}</td>
                        <td>{{ @$result->date_start }}</td>
                        <td>{{ @$result->end_date }}</td>
                    </tr>
                @endforeach
          
            </tbody>
        </table>
    </div>
</body>
</html>