<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
</head>
<body>
    <br> <br> <br>
    <center><img src="https://meroplacement.com/uploads/setting/setting-618e88515edc0.jpg" width="30%"></center>
    <br> <br> <hr> <br> <br>
    <div style="width:50%;margin:auto">
        <p style="line-height:32px;font-size:28px">
            Welcome {{$details['name']}}, <br> <br>
            Thank you for signing up to '<b>Meroplacement</b>' as an <b>{{strtoupper($details['accounttype'])}}</b>.
            Click the link below to verify this was you.
        </p>
        <br> <br> <br>
        <a href="<?php echo url('/'); ?>/activate/{{$details['id']}}/{{$details['token']}}" style="background:#22336B;color:#E91A22;padding:20px 30px;text-decoration:none;font-size:24px">VERIFY EMAIL ADDRESS</a>
    </div>
</body>
</html>