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
			Total batteries: {{ $batteries->count() }}

		</div>
		<div>
			<a href="/batteries/addbattery">Add New Battery</a>
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
			<th scope="col">Container</th>
			<th scope="col">Job assigned</th>
			<th scope="col">Comment</th>
			<th scope="col">Action</th>
		</tr>
		</thead>
		@foreach($batteries as $battery)
			<tbody>
			<tr>
				<th scope="row">

					@if ($battery->condition === '1')
						<span class="conditionNew">{{ $battery->getConditionOptions($battery->condition) }}</span>
					@elseif ($battery->condition === '0')
						<span class="conditionUsed">{{ $battery->getConditionOptions($battery->condition) }}</span>
					@endif

				</th>
				<td><a href="#">{{ $battery->serialOne }}</a></td>
				<td>{{ $battery->serialTwo ?? 'N/A' }}</td>
				<td>{{ $battery->serialThree }}</td>
				<td>{{ $battery->date }}</td>
				<td>{{ $battery->container }}</td>
				<td>{{ $battery->job_assigned }}</td>
				<td>{{ $battery->comment }}</td>
				<td><a href="#">Edit</a></td>
			</tr>
			</tbody>
		@endforeach
	</table>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>