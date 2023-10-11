<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Training</title>
</head>
<body>
    <center>
        <img src="https://meroplacement.com/uploads/{{$sitesetting->logo}}" style="width:60%">
    </center>
    <div style="width:90%;margin:auto;padding:50px 10px">
        <h3>{{ $training->title }}</h3>
        <p>Strat Date: {{ date('M j, Y', strtotime($training->start_date)) }}</p>
        <p>Course Duration: {{ $training->duration }}</p>
        <div style="height:50px"></div>
        {!! $training->description !!}
    </div>
</body>
</html>