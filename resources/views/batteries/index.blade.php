<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
	<style>
		.conditionNew {
			color: forestgreen;
		}
		.conditionUsed {
			color: red;
		}
	</style>
</head>

<body>
    <div class="pl-3 pr-3">
        @include('nav')
    </div>

    <div class="pl-4 pr-4">
        <div class="d-flex justify-content-between align-items-baseline">
            <div>
                <h3>Lithium Batteries</h3>
    {{--			Total batteries: {{ $count }}--}}
            </div>
            <div>
                <a href="/batteries/create">Add New Battery</a>
            </div>
        </div>

        <!-- SEARCH FORM -->
        <div class="d-flex justify-content-between align-items-baseline">
            <div class="row">
                <div class="row mb-2 ml-3 mr-3">
                    <input type="search" id="battery_data" placeholder="Search..." class="form-control">
                </div>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="Serial 1" checked>Serial 1
                    </label>

                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="Status" >Status
                    </label>

                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="CCD" >CCD
                    </label>

                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="Invoice" >Invoice
                    </label>
                </div>
            </div>
        </div>
        <p class="ml-3 mr-3" id="output"></p>

{{--	<table class="table table-striped">--}}
{{--		<thead>--}}
{{--		<tr>--}}
{{--			<th scope="col">Condition</th>--}}
{{--			<th scope="col">Serial 1</th>--}}
{{--			<th scope="col">Serial 2</th>--}}
{{--			<th scope="col">Serial 3</th>--}}
{{--			<th scope="col">Production Date</th>--}}
{{--			<th scope="col">Invoice</th>--}}
{{--			<th scope="col">CCD</th>--}}
{{--			<th scope="col">Container</th>--}}
{{--			<th scope="col">Comment</th>--}}
{{--			<th scope="col">Action</th>--}}
{{--		</tr>--}}
{{--		</thead>--}}

{{--		@foreach($batteries as $battery)--}}
{{--			<tbody>--}}
{{--			<tr>--}}
{{--				<th scope="row">--}}

{{--					@if ($battery->BatteryCondition === 'New')--}}
{{--						<span class="conditionNew">{{ $battery->BatteryCondition }}</span>--}}
{{--					@elseif ($battery->BatteryCondition === 'Used')--}}
{{--						<span class="conditionUsed">{{ $battery->BatteryCondition }}</span>--}}
{{--					@endif--}}

{{--				</th>--}}
{{--				<td><a href="/batteries/{{ $battery->Id }}">{{ $battery->SerialOne }}</a></td>--}}
{{--				<td>{{ $battery->SerialTwo ?? 'N/A' }}</td>--}}
{{--				<td>{{ $battery->SerialThr }}</td>--}}
{{--				<td>{{ $battery->Arrived }}</td>--}}
{{--				<td>{{ $battery->Invoice }}</td>--}}
{{--				<td>{{ $battery->CCD }}</td>--}}
{{--				<td>{{ $battery->Container }}</td>--}}
{{--				<td>{{ $battery->Comment }}</td>--}}
{{--				<td><a href="#">Edit</a></td>--}}
{{--			</tr>--}}
{{--			</tbody>--}}
{{--		@endforeach--}}

{{--	</table>--}}
{{--	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
</div>
</body>
</html>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        var search_where = $(".search_where:checked").val();
        $('input[type="radio"]').click(function () {
            search_where = $(this).val();
        });

        $('#battery_data').keyup(function (e) {
            var search_data = $('#battery_data').val();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('batteries.index') }}",
                data: { search_data: search_data,
                    search_where: search_where
                },
                success: function($data){
                    $('#output').html($data);
                }
            });
        });
        $('#battery_data').keyup();
    });
</script>
