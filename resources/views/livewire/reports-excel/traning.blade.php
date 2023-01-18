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
                <th>الموظف</th>
                <th> التدريب </th>
                <th> وقت الالتحاق </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$result)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ @$result->user->full_name}}</td>
                        <td>{{ @$result->traning->content }}</td>
                        <td>{{ @$result->created_at }}</td>
                    </tr>
                @endforeach
          
            </tbody>
        </table>
    </div>
</body>
</html>