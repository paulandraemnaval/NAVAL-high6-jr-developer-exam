<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{route('cities.index')}}">Back</a>


    <h1>Create City</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method='post' action="{{route('cities.store')}}">
        @csrf
        @method('post')

        <div>
            <label for="name">Name</label>
            <input type="text" name='name'>
        </div>

        <input type='submit' value='Save' />
    </form>
</body>

</html>