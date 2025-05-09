<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brgy Index</title>
</head>

<body>
    <a href="{{route('index')}}">index</a>
    <a href="{{route('cities.index')}}">cities</a>
    <a href="{{route('brgys.index')}}">brgys</a>
    <a href="{{route('patients.index')}}">patients</a>
    <a href="{{route('awarenessreports.index')}}">awareness report</a>
    <a href="{{route('virusreports.index')}}">virus report</a>
    <a href="{{route('checkstatus.index')}}">check status</a>

    <h1>Brgy Page</h1>

    @if (session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border='1' cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Actions</th>
        </tr>
        @foreach ($brgys as $brgy)
            <tr>
                <td>{{ $brgy->id }}</td>
                <td>{{ $brgy->name }}</td>
                <td>{{ $brgy->city->name }}</td>
                <td style="display:inline-flex; gap: 5px;">
                    <a href="{{ route('brgys.show', ['brgy' => $brgy]) }}">View</a>
                    <a href="{{ route('brgys.edit', ['brgy' => $brgy]) }}">Edit</a>
                    <form method="post" action="{{ route('brgys.destroy', $brgy) }}">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            style="background-color:transparent; border:none; color: blue; text-decoration:underline; cursor: pointer; padding: 0; font:inherit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('brgys.create') }}">Create a new brgy</a>
</body>

</html>