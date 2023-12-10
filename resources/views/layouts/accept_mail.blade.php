<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="m-2">Hello, {{ucfirst(trans($data['user']['name']))}}</div>     
        <a href="{{url('profile',['token' => $data['doctor']['remember_token']])}}">{{$data['doctor']['name']}}</a> Thank You For Your Response 
    <div class="m-2">Thanks,</div>
    <div>{{ucfirst(trans($data['doctor']['name']))}}</div> 
</body>
</html>