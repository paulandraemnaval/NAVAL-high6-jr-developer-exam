<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{route('brgys.index')}}">Back</a>

    <div class="" style='display:block'>Name: {{$brgy->name}}</div>
    <div class="" style='display:inline'>City: {{$city->name}}</div>
</body>

</html>