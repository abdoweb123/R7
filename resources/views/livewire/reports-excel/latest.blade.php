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
                <th>الوقت الفعلي للحضور </th>
                <th> وقت الحضور </th>
                <th>  التاخير</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$result)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ @$result->user->full_name}}</td>
                        <td>{{ @$result->job->job_description }}</td>
                        <td>{{ @$result->job->start_time }}</td>
                        <td>{{ @$result->date_start }}</td>
                        <td>{{gmdate('H:i', strtotime(@$result->job->start_time) - strtotime(@$result->date_start)) }}</td>
                    </tr>
                @endforeach
          
            </tbody>
        </table>
    </div>
</body>
</html>