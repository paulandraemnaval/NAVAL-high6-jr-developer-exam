<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <a href="{{route('patients.index')}}">Back</a>

    <h1>Edit Patient</h1>
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('patients.update', ["patient" => $patient])}}" method='post'>
        @csrf
        @method('put')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{old('name', $patient->name ?? '')}}" />

        </div>
        <label for="brgy">Brgy</label>
        <div>
            <select name="brgy_id" id="brgy">
                <option value="">-- Select a Brgy --</option>
                @foreach ($brgys as $brgy)
                    <option value="{{$brgy->id}}" {{$patient->brgy->id === $brgy->id ? 'selected' : ''}}>{{$brgy->name}}
                    </option>
                @endforeach
            </select>

        </div>
        <div>
            <label for="number">Number</label>
            <input type="text" name="number" id="number" value="{{old('number', $patient->number ?? '')}}" />

        </div>
        <div><label for="email">Email</label>
            <input type="email" name="email" id="email" value='{{old('email', $patient->email ?? '')}}'>
        </div>
        <div>
            <label for="case_type"> Case Type</label>
            <select name="case_type" id="case_type">
                <option value="">--Select a Case Type--</option>
                @foreach (App\CaseType::cases() as $caseType)
                    <option value="{{$caseType->value}}" {{$patient->case_type->value === $caseType->value ? 'selected' : ''}}>
                        {{$caseType->value}}
                    </option>
                @endforeach
            </select>
        </div>
        <div id="corona_status_div"
            style="display: {{ $patient->case_type->value === 'Positive on Covid' ? 'block' : 'none' }};"> <label
                for="coronavirus_status">Corona Status</label>
            <select name="coronavirus_status" id="coronavirus_status">
                <option value="">--Select a Corona Status--</option>
                @foreach (App\CoronavirusType::cases() as $coronaStatus)
                    <option value="{{$coronaStatus->value}}"
                        {{optional($patient->coronavirus_status)->value === $coronaStatus->value ? 'selected' : ''}}>
                        {{$coronaStatus->value}}
                    </option>
                @endforeach
            </select>
        </div>
        <input type='submit' value='Save' />
    </form>
    <script>
        const caseTypeCombo = document.getElementById('case_type');
        const statusDiv = document.getElementById('corona_status_div');

        caseTypeCombo.addEventListener('change', function () {
            if (caseTypeCombo.value == 'Positive on Covid') {
                statusDiv.style.display = 'block';
            } else {
                statusDiv.style.display = 'none';
            }
        });

    </script>
</body>

</html>