<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (!is_null($data))
      @foreach ($data as $value)
          <div class="m-2">Hello, {{$value['User']['name']}}</div>     

          <div class="m-4">
            The one who applied for the job has withdraw
          </div>
      
          <div class="m-2">Thanks,</div>
          <div><a href="{{url('profile',['token' => Auth::user()->remember_token])}}">{{ucfirst(trans(Auth::user()->name))}}</a></div>
      @endforeach
    @endif
</body>
</html>