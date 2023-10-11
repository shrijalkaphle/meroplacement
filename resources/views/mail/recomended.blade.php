<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="width:60%;margin:auto">
    <center><img src="https://meroplacement.com/uploads/{{ $details['logo'] }}" alt="" style="height:150px"></center>
    <hr>
    <br> <br>
    Hello {{$details['name']}}, <br>
    With respect to your information provided to meroplacement, we found the following job(s) relevant to your profile.
    <div style="padding:20px 100px">
        @foreach($details['jobs'] as $job)
        <div style="white-space: nowrap;padding:20px">
            <div style="display: inline-block; width: 50%; white-space: normal;">
                <h4>{{$job->title}}</h4>
                {{$job->company->user->name}}
            </div>
            <div style="display: inline-block; width: 50%; white-space: normal;text-align:right;">
                <a href="https://meroplacement.com/job-view/{{ $job->slug }}" style="padding:10px 15px;border-radius:10px;border:0;background:#24346C;color:white;text-decoration: none;">Apply</a>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
</body>
</html>