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
            You have requested to change your password.
        </p>
        <br> <br> <br>
        <a href="<?php echo url('/'); ?>/reset/{{$details['id']}}/{{$details['token']}}" style="background:#22336B;color:#E91A22;padding:20px 30px;text-decoration:none;font-size:24px">RESET PASSWORD</a>
    </div>
</body>
</html>