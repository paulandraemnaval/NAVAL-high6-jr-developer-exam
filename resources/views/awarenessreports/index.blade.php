<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports Page</title>
</head>

<body>
    <a href="{{route('index')}}">index</a>
    <a href="{{route('cities.index')}}">cities</a>
    <a href="{{route('brgys.index')}}">brgys</a>
    <a href="{{route('patients.index')}}">patients</a>
    <a href="{{route('awarenessreports.index')}}">awareness report</a>
    <a href="{{route('virusreports.index')}}">virus report</a>
    <a href="{{route('checkstatus.index')}}">check status</a>

    <h1>Reports Page</h1>
    <div style='display:flex; gap:10px;'>
        <div>
            <label for="city_id">City</label>
            <select name="city_id" id="city_id">
                <option value="">-- Select a City --</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="brgy_id">Barangay</label>
            <select name="brgy_id" id="brgy_id">
                <option value="">-- Select a Brgy --</option>
            </select>
        </div>
        <button id="generate_report">Generate Report</button>
    </div>

    <div id="report_result">
        <ul id="report_counts"></ul>
    </div>

    {{-- Preload city-brgy mapping --}}
    <script>
        const cityBrgysMap = @json(
            $cities->mapWithKeys(function ($city) {
                return [$city->id => $city->brgys];
            })
        );
    </script>

    <script>
        const citySelect = document.getElementById('city_id');
        const brgySelect = document.getElementById('brgy_id');

        citySelect.addEventListener('change', function () {
            const cityId = this.value;
            brgySelect.innerHTML = '<option value="">-- Select a Brgy --</option>';

            if (cityId && cityBrgysMap[cityId]) {
                cityBrgysMap[cityId].forEach(brgy => {
                    const option = document.createElement('option');
                    option.value = brgy.id;
                    option.textContent = brgy.name;
                    brgySelect.appendChild(option);
                });
            }
        });

        const generateReportButton = document.getElementById('generate_report');

        generateReportButton.addEventListener('click', function () {
            fetch(`awarenessreports/generate/${citySelect.value}/${brgySelect.value}`)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Check internet connection');
                    }
                })
                .then(data => {
                    const counts = data.counts;
                    const reportCountsElement = document.getElementById('report_counts');
                    reportCountsElement.innerHTML = '';

                    for (const caseType in counts) {
                        const listItem = document.createElement('li');
                        listItem.textContent = `${caseType}: ${counts[caseType]}`;
                        reportCountsElement.appendChild(listItem);
                    }
                })
                .catch(error => {
                    console.error('Error generating report:', error);
                });
        });
    </script>
</body>

</html>