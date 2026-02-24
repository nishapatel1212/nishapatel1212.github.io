<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Electrical Safety Check</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
            text-align: left;
            width: 30%;
        }

        .section-title {
            background: #ddd;
            padding: 6px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h2> Electrical Safety Check</h2>

    <table>
        <tr>
            <th>Customer</th>
            <td>{{ $inspection->customer }}</td>
        </tr>
        <tr>
            <th>Contact</th>
            <td>{{ $inspection->contact }}</td>
        </tr>
        <tr>
            <th>Property Address</th>
            <td>{{ $inspection->property_address }}</td>
        </tr>
        <tr>
            <th>Job Number</th>
            <td>{{ $inspection->job_number }}</td>
        </tr>
        <tr>
            <th>Previous Inspection: (if known)</th>
            <td>{{ $inspection->previous_inspection }}</td>
        </tr>
        <tr>
            <th>Inspection Date</th>
            <td>{{ $inspection->inspection_date }}</td>
        </tr>
        <tr>
            <th>Next Inspection Due</th>
            <td>{{ $inspection->next_inspection_due }}</td>
        </tr>
    </table>

    <div class="section-title">Regulations</div>

    @foreach($regulations as $reg)
    <table class="report-section">
        <tr>
            <td colspan="3" class="header-row">
                {{ $reg->regulation }}
            </td>
        </tr>

        <tr>
            <td colspan="3" class="location-row">
                <span class="label"><b>Location:</b></span> {{ $reg->location }}
            </td>
        </tr>

        <tr class="image-row">
            @php
            $images = json_decode($reg->image, true) ?? [];
            @endphp

            @for ($i = 0; $i < 3; $i++)
                <td>
                @if(isset($images[$i]))
                <img src="file://{{ storage_path('app/public/' . $images[$i]) }}" width="120">
                @endif
                </td>
                @endfor
        </tr>

        <tr>
            <td colspan="3" class="rectification-row">
                <span class="label"><b>Rectification:</b></span> {{ $reg->rectification }}
            </td>
        </tr>
    </table>
    @endforeach

</body>

</html>