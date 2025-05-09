<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>COVID-19 Status Update</h1>

    <p>Dear {{ $patient->name }},</p>

    <p>Our records show that your COVID-19 status has been updated to <strong>{{$patient->case_type}}</strong>.
    </p>

    <p>Please take the necessary precautions and contact your local health officials if you haven't already.</p>

    <p>Barangay: {{ $patient->brgy->name }}<br>
        City: {{ $patient->brgy->city->name }}</p>

    <p>Stay safe,<br>The Health Authority</p>
</body>

</html>