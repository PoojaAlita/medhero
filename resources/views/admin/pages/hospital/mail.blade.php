<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div>Hi,{{$data['name']}}</div>

    <div>Your password is {{$data['password']}}</div>

    <div> Thanks,</div>
    <div>{{Auth::user()->name}}</div>
</body>
</html>