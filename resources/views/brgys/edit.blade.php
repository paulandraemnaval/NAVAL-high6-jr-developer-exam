<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Brgy</title>
</head>

<body>
    <a href="{{route('brgys.index')}}">Back</a>

    <h1>Edit Brgy</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('brgys.update', ['brgy' => $brgy])}}">
        @csrf
        @method('put')
        <div>
            <label for="name">Brgy Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Brgy name" value="{{$brgy->name}}">
        </div>

        <div>
            <label for="city_id">Select City</label>
            <select name="city_id" id="city_id" required>
                <option value="">-- Select a City --</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}" {{$city->id == $brgy->city_id ? 'selected' : ''}}>
                        {{$city->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Save</button>
        </div>
    </form>
</body>

</html>