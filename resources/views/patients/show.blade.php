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

    <div>Name: {{$cleanedPatient->name}}</div>
    <div>Brgy: {{$cleanedPatient->brgy->name}}</div>
    <div>Number: {{$cleanedPatient->number}}</div>
    <div>Email: {{$cleanedPatient->email}}</div>
    <div>Case Type: {{$cleanedPatient->case_type}}</div>
    @if($cleanedPatient->case_type === \App\CaseType::Positive->value)
        <div>Corona Virus Status: {{$cleanedPatient->coronavirus_status ?? 'N/A'}}</div>
    @endif
</body>

</html>