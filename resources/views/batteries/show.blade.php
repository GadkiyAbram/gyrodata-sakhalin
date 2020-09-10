<html>

<head>

</head>

<body>
<div class="pl-3 pr-3">
    @include('nav')
</div>

<div class="pl-4 pr-4">

    <div class="d-flex justify-content-between align-items-baseline">

        <div class="align-content-center pr-3">
            <div class="d-flex justify-content-between align-items-baseline">
                <a href="/batteries">Go back</a>
                <h5 class="pl-2">{{ $battery['SerialOne'] }}</h5>
            </div>
        </div>
        <div>
            <a href="/batteries/{{ $battery['SerialOne'] }}/edit">Edit Battery</a>
        </div>

    </div>

    <div class="row">
        <div class="col-5">
            <p><strong>Condition: </strong>{{ $battery['BatteryCondition'] }}</p>
            <p><strong>Arrived: </strong>{{ $battery['Arrived'] }}</p>
            <p><strong>Box Number: </strong>{{ $battery['BoxNumber'] }}</p>
            <p><strong>Serial 2: </strong>{{ $battery['SerialTwo'] }}</p>
            <p><strong>Serial 3: </strong>{{ $battery['SerialThr'] }}</p>
            <p><strong>CCD: </strong>{{ $battery['CCD'] }}</p>
            <p><strong>Invoice: </strong>{{ $battery['Invoice'] }}</p>
            <p><strong>Location: </strong>{{ $battery['BatteryStatus'] }}</p>
            <p><strong>Container: </strong>{{ $battery['Container'] }}</p>
            <p><strong>Comment: </strong>{{ $battery['Comment'] }}</p>
        </div>

{{--        <div class="col-5">--}}
{{--            <p><img src="data:image/jpg|png|jpeg;base64,{{ $item['ItemImage'] }}"></p>--}}
{{--        </div>--}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </div>
</div>

</body>

</html>
