<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($data as $values)
    <div class="m-2">Hello,{{$values['hospital']['name']}}</div>     

    <div class="m-4">
        <a class="pl-2" href="{{url('profile',['token' => $values['user']['remember_token']])}}">{{ucfirst(trans($values['user']['name']))}}</a> has applied for job in Operations {{$values['jobDetails']['title']}}
    </div>

    <div class="m-2">Thanks,</div>
    {{-- <div>{{ucfirst(trans($values['user']['name']))}}</div> --}}
    @endforeach
</body>
</html>