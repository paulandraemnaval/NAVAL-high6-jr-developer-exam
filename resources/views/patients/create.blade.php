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

    <h1>Create Patient</h1>
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('patients.store')}}" method='post'>
        @csrf
        @method('post')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" />

        </div>
        <label for="brgy">Brgy</label>
        <div>
            <select name="brgy_id" id="brgy">
                <option value="">-- Select a Brgy --</option>
                @foreach ($brgys as $brgy)
                    <option value="{{$brgy->id}}">{{$brgy->name}}</option>
                @endforeach
            </select>

        </div>
        <div>
            <label for="number">Number</label><input type="text" name="number" id="number" />

        </div>
        <div><label for="email">Email</label><input type="email" name="email" id="email"></div>
        <div>
            <label for="case_type"> Case Type</label>
            <select name="case_type" id="case_type">
                <option value="">--Select a Case Type--</option>
                @foreach (App\CaseType::cases() as $caseType)
                    <option value="{{$caseType->value}}">{{$caseType->value}}</option>
                @endforeach
            </select>
        </div>
        <div id="corona_status_div" style="display: none;">
            <label for="coronavirus_status">Corona Status</label>
            <select name="coronavirus_status" id="coronavirus_status">
                <option value="">--Select a Corona Status--</option>
                @foreach (App\CoronavirusType::cases() as $coronaStatus)
                    <option value="{{$coronaStatus->value}}">{{$coronaStatus->value}}</option>
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