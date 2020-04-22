<html>

<head>

</head>

<body>
<div class="pl-3 pr-3">

	@include('nav')
</div>



<div class="pl-4 pr-4">

	<div class="d-flex justify-content-between align-items-baseline">

		<div>
			<h3>Job Tracking</h3>
		</div>

		<div>
			<a href="/jobs/create">Add New Job</a>
		</div>

	</div>


	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">Job Number</th>
			<th scope="col">Tool</th>
			<th scope="col">Modem</th>
			<th scope="col">BBP</th>
			<th scope="col">Battery</th>
			<th scope="col">Engineer 1</th>
			<th scope="col">Engineer 2</th>
			<th scope="col">Circ Hrs</th>
			<th scope="col">Container</th>
			<th scope="col">Comment</th>
			<th scope="col">###</th>
		</tr>
		</thead>
		@foreach($jobs as $job)
			<tbody>
			<tr>
				<th scope="row"><a href="/jobs/{{ $job->Id }}">{{ $job->JobNumber }}</a></th>
				{{--<td>{{ $job->gdp_id }}</td>--}}
				<td>{{ $job->GDP }}</td>
				<td>{{ $job->Modem }}</td>
				<td>{{ $job->Bullplug }}</td>
				<td>{{ $job->Battery }}</td>
				<td>{{ $job->EngineerOne }}</td>
				<td>{{ $job->EngineerTwo }}</td>
				<td>{{ $job->CirculationHours }}</td>
				<td>{{ $job->Container }}</td>
				<td>{{ $job->Comment }}</td>
				<td><a href="/jobs/{{ $job->Id }}/edit">Edit</a></td>

				{{--<th scope="row"><a href="/jobs/{{ $job->id }}">{{ $job->JobNumber }}</a></th>--}}
				{{--<td>{{ $job->gdp_id }}</td>--}}
				{{--<td>{{ \App\Item::where('Id', $job->gdp_id)->first()->Asset ?? 'N/A'}}</td>--}}
				{{--<td>{{ \App\Item::where('Id', $job->modem_id)->first()->Asset ?? 'N/A'}}</td>--}}
				{{--<td>{{ \App\Item::where('Id', $job->bullplug_id)->first()->Asset ?? 'N/A'}}</td>--}}
				{{--<td>{{ \App\Battery::where('Id', $job->battery_id)->first()->serialOne ?? 'N/A'}}</td>--}}

				{{--<td>{{ \App\Engineer::where('id', $job->eng_one)->first()->EngineerName ?? 'Not assigned'}}</td>--}}

				{{--<td>{{ \App\Engineer::where('id', $job->eng_two)->first()->EngineerName ?? 'Not assigned' }}</td>--}}

				{{--<td>{{ $job->toolCircHrs ?? 'N/A' }}</td>--}}
				{{--<td>{{ $job->container ?? 'N/A' }}</td>--}}
				{{--<td>{{ $job->comment ?? 'N/A' }}</td>--}}
				{{--<td><a href="/jobs/{{ $job->id }}/edit">Edit</a></td>--}}
			</tr>
			</tbody>
		@endforeach
	</table>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>