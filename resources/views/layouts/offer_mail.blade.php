<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($data as $value)
    <div class="m-2">Hello, {{ucfirst(trans($value['user']['name']))}}</div>     
        <a href="{{url('Job-Application/index', $value['user']['id'].$value['job_post']['id'])}}">{{$value['job_post']['title']}}
        </a> offer is accepted 
        <div class="m-2">Thanks,</div>
        <div>{{ucfirst(trans($value['name']))}}</div> 
    @endforeach
</body>
</html>