<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Brgy</title>
</head>

<body>
    <a href="{{route('brgys.index')}}">Back</a>

    <h1>Create Brgy</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="post" action="{{ route('brgys.store')}}">
        @csrf
        @method('post')
        <div>
            <label for="name">Brgy Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Brgy name" required>
        </div>

        <div>
            <label for="city_id">Select City</label>
            <select name="city_id" id="city_id" required>
                <option value="">-- Select a City --</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Create Brgy</button>
        </div>
    </form>
</body>

</html>