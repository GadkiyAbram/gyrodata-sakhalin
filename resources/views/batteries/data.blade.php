<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="row">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Condition</th>
            <th scope="col">Serial 1</th>
            <th scope="col">Serial 2</th>
            <th scope="col">Serial 3</th>
            <th scope="col">Production Date</th>
            <th scope="col">Invoice</th>
            <th scope="col">CCD</th>
            <th scope="col">Container</th>
            <th scope="col">Comment</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        @foreach($batteries as $battery)
            <tbody>
            <tr>
                <th scope="row">

                    @if ($battery->BatteryCondition === 'New')
                        <span class="conditionNew">{{ $battery->BatteryCondition }}</span>
                    @elseif ($battery->BatteryCondition === 'Used')
                        <span class="conditionUsed">{{ $battery->BatteryCondition }}</span>
                    @endif

                </th>
                <td><a href="/batteries/{{ $battery->Id }}">{{ $battery->SerialOne }}</a></td>
                <td>{{ $battery->SerialTwo ?? 'N/A' }}</td>
                <td>{{ $battery->SerialThr }}</td>
                <td>{{ $battery->Arrived }}</td>
                <td>{{ $battery->Invoice }}</td>
                <td>{{ $battery->CCD }}</td>
                <td>{{ $battery->Container }}</td>
                <td>{{ $battery->Comment }}</td>
                <td><a href="#">Edit</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
</body>
</html>
