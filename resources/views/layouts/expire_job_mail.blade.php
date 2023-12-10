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
    <div class="m-2">Hello,{{$values['User']['name']}}</div>     

    <div class="m-4">
        {{$values['title']}} job is expire.
    </div>

    <div class="m-2">Thanks,</div>
    <div>{{-- {{ucfirst(trans($values['user']['name']))}} --}}</div>
    @endforeach
</body>
</html>