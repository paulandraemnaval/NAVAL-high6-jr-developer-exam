<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{route('index')}}">index</a>
    <a href="{{route('cities.index')}}">cities</a>
    <a href="{{route('brgys.index')}}">brgys</a>
    <a href="{{route('patients.index')}}">patients</a>
    <a href="{{route('awarenessreports.index')}}">awareness report</a>
    <a href="{{route('virusreports.index')}}">virus report</a>
    <a href="{{route('checkstatus.index')}}">check status</a>

    <h1>Patients Page</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif
    @if (session()->has('success'))
        <div>{{session('success')}}</div>

    @endif
    <table border="1" cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Brgy</th>
            <th>Case Type</th>
            <th>Action</th>
        </tr>
        @foreach ($patients as $patient)
            <tr>
                <td>{{$patient->id}}</td>
                <td>{{$patient->name}}</td>
                <td>{{$patient->brgy->city->name}}</td>
                <td>{{$patient->brgy->name}}</td>
                <td>{{$patient->case_type}}</td>
                <td style='display: flex; gap:5px'>
                    <a href="{{route('patients.show', ["patient" => $patient])}}">View</a>
                    <a href="{{route('patients.edit', ['patient' => $patient])}}">Edit</a>
                    <form method="post" action="{{route('patients.destroy', ['patient' => $patient])}}">
                        @csrf
                        @method('delete')
                        <button type=" submit"
                            style="background-color:transparent; border:none; color: blue; text-decoration:underline; cursor: pointer; padding: 0; font:inherit">
                            Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{route('patients.create')}}">create a new patient</a>
</body>

</html>