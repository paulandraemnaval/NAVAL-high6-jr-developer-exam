<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Status Checker</title>
</head>

<body>
    <a href="{{route('index')}}">index</a>
    <a href="{{route('cities.index')}}">cities</a>
    <a href="{{route('brgys.index')}}">brgys</a>
    <a href="{{route('patients.index')}}">patients</a>
    <a href="{{route('awarenessreports.index')}}">awareness report</a>
    <a href="{{route('virusreports.index')}}">virus report</a>
    <a href="{{route('checkstatus.index')}}">check status</a>
    <h1>Check Patient Status</h1>
    <form id="check_status_form">
        <label for="number">Number:</label>
        <input type="text" name="number" id="number" />
        <input type="submit" value="Check Status" />
    </form>

    <div id="status_result" style="margin-top: 20px;"></div>

    <script>
        const checkStatusForm = document.getElementById('check_status_form');
        const statusResult = document.getElementById('status_result');

        checkStatusForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const number = document.getElementById('number').value.trim();

            const phNumberPattern = /^(09|\+639)\d{9}$/;

            if (!phNumberPattern.test(number)) {
                statusResult.innerHTML = `<p style="color: red;">Please enter a valid Philippine mobile number.</p>`;
                return;
            }

            if (!number) {
                statusResult.innerHTML = `<p style="color: red;">Please enter a number.</p>`;
                return;
            }

            fetch(`/checkstatus/${number}`)
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'patient found') {
                        statusResult.innerHTML = `
                        <p style = "color: green;" > ${data.message}</p>
                            <p><strong>Status:</strong> ${data.name}</p>
                            <p><strong>Name:</strong> ${data.case_type}</p>
                            <p><strong>Status:</strong> ${data.coronavirus_status ? data.coronavirus_status : "N/A"}</p>
                            <p><strong>City:</strong> ${data.city}</p>
                            <p><strong>Brgy:</strong> ${data.brgy}</p>`;
                    } else {
                        statusResult.innerHTML = `<p style = "color: orange;"> ${data.message}.</p> `;
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    statusResult.innerHTML = `<p style = "color: red;" > An error occurred.Please try again later.</p>`;
                });
        });
    </script>
</body>

</html>