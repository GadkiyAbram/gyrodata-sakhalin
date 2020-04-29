<html>

<head>
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
			Total batteries: {{ $count }}

		</div>
		<div>
			<a href="/batteries/create">Add New Battery</a>
		</div>

	</div>


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

		{{--@foreach($batteries as $battery)--}}
			{{--<tbody>--}}
			{{--<tr>--}}
				{{--<th scope="row">--}}

					{{--@if ($battery->BatteryCondition === 'New')--}}
						{{--<span class="conditionNew">{{ $battery->getConditionOptions($battery->BatteryCondition) }}</span>--}}
					{{--@elseif ($battery->BatteryCondition === 'Used')--}}
						{{--<span class="conditionUsed">{{ $battery->getConditionOptions($battery->BatteryCondition) }}</span>--}}
					{{--@endif--}}

				{{--</th>--}}
				{{--<td><a href="#">{{ $battery->serialOne }}</a></td>--}}
				{{--<td>{{ $battery->serialTwo ?? 'N/A' }}</td>--}}
				{{--<td>{{ $battery->serialThr }}</td>--}}
				{{--<td>{{ $battery->Arrived }}</td>--}}
				{{--<td>{{ $battery->Container }}</td>--}}
				{{--<td>{{ $battery->Comment }}</td>--}}
				{{--<td><a href="#">Edit</a></td>--}}
			{{--</tr>--}}
			{{--</tbody>--}}
		{{--@endforeach--}}

		@for($i = 0; $i < count($batteries); $i++)
			<tbody>
			<tr>
				<th scope="row">

					@if ($batteries[$i]->BatteryCondition === 'New')
						<span class="conditionNew">{{ $batteries[$i]->BatteryCondition }}</span>
					@elseif ($batteries[$i]->BatteryCondition === 'Used')
						<span class="conditionUsed">{{ $batteries[$i]->BatteryCondition }}</span>
					@endif

				</th>
				<td><a href="/batteries/{{ $batteries[$i]->Id }}">{{ $batteries[$i]->SerialOne }}</a></td>
				<td>{{ $batteries[$i]->SerialTwo ?? 'N/A' }}</td>
				<td>{{ $batteries[$i]->SerialThr }}</td>
				<td>{{ $batteries[$i]->Arrived }}</td>
				<td>{{ $batteries[$i]->Invoice }}</td>
				<td>{{ $batteries[$i]->CCD }}</td>
				<td>{{ $batteries[$i]->Container }}</td>
				<td>{{ $batteries[$i]->Comment }}</td>
				<td><a href="#">Edit</a></td>
			</tr>
			</tbody>
		@endfor

	</table>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>
