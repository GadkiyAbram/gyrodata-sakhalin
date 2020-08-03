<html>

<head></head>

<body>
<div class="pl-3 pr-3">
    @include('nav')
</div>
<div class="pl-4 pr-4">

    <div class="d-flex justify-content-start align-items-baseline">
        <div class="align-content-center pr-3">
            <a href="/batteries/{{ $battery['Id'] }}">Go back</a>
        </div>
        <div>
            <h4>{{ $battery['SerialOne'] }} {{ $battery['BatteryCondition'] }}</h4>
        </div>
    </div>

    <form action="/batteries/{{ $battery['Id'] }}" method="post" enctype="multipart/form-data">

        @method('PATCH')

        <div class="form-group row">
            <label for="BoxNumber" class="col-sm-2 col-form-label">Box Number</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="BoxNumber" value="{{ $battery['BoxNumber'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="serialOne" class="col-sm-2 col-form-label">Serial 1</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="serialOne" value="{{ $battery['SerialOne'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="serialTwo" class="col-sm-2 col-form-label">Serial 2</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="serialTwo" value="{{ $battery['SerialTwo'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="serialThree" class="col-sm-2 col-form-label">Serial 3</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="serialThree" value="{{ $battery['SerialThr'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Production Date</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="date" value="{{ $battery['Arrived'] }}">
            </div>
        </div>

        {{--    TODO - Set data from DB    --}}
        <div class="form-group row">
            <label for="BatteryCondition" class="col-sm-2 col-form-label">Condition</label>
            <div class="col-sm-2">
                <select name="BatteryCondition" id="BatteryCondition" class="form-control">
                    <option value="" disabled>Condition</option>
                    <option value="New">New</option>
                    <option value="Used">Used</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="batteryInvoice" class="col-sm-2 col-form-label">Invoice</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="batteryInvoice" value="{{ $battery['Invoice'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="batteryCcd" class="col-sm-2 col-form-label">CCD</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="batteryCcd" value="{{ $battery['CCD'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="BatteryStatus" class="col-sm-2 col-form-label">Location</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="BatteryStatus" value="{{ $battery['BatteryStatus'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="Container" class="col-sm-2 col-form-label">Container</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="Container" value="{{ $battery['Container'] }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="Comment" class="col-sm-2 col-form-label">Comment</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="Comment" value="{{ $battery['Comment'] }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Update Battery</button>
            </div>
        </div>
        @csrf
    </form>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
