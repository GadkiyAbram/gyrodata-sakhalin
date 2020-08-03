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
                <a href="/jobs">Go back</a>
                <h5>{{ $job['JobNumber'] }}</h5>
            </div>
		</div>
		<div>
			<a href="/jobs/{{ $job['JobNumber'] }}/edit">Edit Job</a>
		</div>

	</div>

	<div class="row">
		<div class="col-4">
			<p><strong>GWD Tool: </strong>{{ $job['GDP'] }}</p>
			<p><strong>Modem: </strong>{{ $job['Modem'] }}</p>
			<p><strong>Modem Version: </strong>{{ $job['ModemVersion'] }}</p>
			<p><strong>Max Temperature </strong>{{ $job['MaxTemp'] }}</p>
			<p><strong>GWD BBP: </strong>{{ $job['Bullplug'] }}</p>
			<p><strong>Battery: </strong>{{ $job['Battery'] }}</p>
			<p><strong>First Eng: </strong>{{ $job['EngineerOne'] ?? 'Not assigned'}}</p>
			<p><strong>Second Eng: </strong>{{ $job['EngineerTwo'] ?? 'Not assigned'}}</p>
			<p><strong>Eng1 Arrived: </strong>{{ $job['eng_one_arrived'] }}</p>
			<p><strong>Eng2 Arrived: </strong>{{ $job['eng_two_arrived'] }}</p>
		</div>
		<div class="col-6">
			<p><strong>Eng1 Depart: </strong>{{ $job['eng_one_left'] }}</p>
			<p><strong>Eng2 Depart: </strong>{{ $job['eng_two_left'] }}</p>
			<p><strong>Container: </strong>{{ $job['Container'] }}</p>
			<p><strong>Container arrived: </strong>{{ $job['ContainerArrived'] }}</p>
			<p><strong>Container depart: </strong>{{ $job['ContainerLeft'] }}</p>
			<p><strong>Circ Hrs: </strong>{{ $job['CirculationHours'] }}</p>
			<p><strong>Rig: </strong>{{ $job['Rig'] }}</p>
			<p><strong>Issues: </strong>{{ $job['Issues'] }}</p>
			<p><strong>Comment: </strong>{{ $job['Comment'] }}</p>
		</div>
	</div>



	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>
