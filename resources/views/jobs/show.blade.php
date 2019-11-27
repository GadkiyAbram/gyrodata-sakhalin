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
			<a href="/jobs">Go back</a>
		</div>
		<div>
			<h5>{{ $job->jobNumber }}</h5>
		</div>
		<div>
			<a href="#">Edit Job</a>
		</div>

	</div>

	<div class="row">
		<div class="col-4">
			<p><strong>GWD Tool: </strong>{{ $job->toolNumber }}</p>
			<p><strong>Modem: </strong>{{ $job->modemNumber }}</p>
			<p><strong>GWD BBP: </strong>{{ $job->bbpNumber }}</p>
			<p><strong>Battery: </strong>{{ $battery_serialOne }}</p>
			<p><strong>First Eng: </strong>{{ \App\Engineer::where('id', $job->engFirst)->first()->name ?? 'Not assigned'}}</p>
			<p><strong>Second Eng: </strong>{{ \App\Engineer::where('id', $job->engSecond)->first()->name ?? 'Not assigned' }}</p>
			<p><strong>Eng1 Arrived: </strong>{{ $job->eng1ArrRig }}</p>
			<p><strong>Eng2 Arrived: </strong>{{ $job->eng2ArrRig }}</p>

		</div>
		<div class="col-6">
			<p><strong>Eng1 Depart: </strong>{{ $job->eng1DepRig }}</p>
			<p><strong>Eng2 Depart: </strong>{{ $job->eng2DepRig }}</p>
			<p><strong>Container: </strong>{{ $job->container }}</p>
			<p><strong>Container arrived: </strong>{{ $job->containerArrRig }}</p>
			<p><strong>Container depart: </strong>{{ $job->containerDepRig }}</p>
			<p><strong>Circ Hrs: </strong>{{ $job->toolCircHrs }}</p>
			<p><strong>Comment: </strong>{{ $job->comment }}</p>
		</div>
	</div>



	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>