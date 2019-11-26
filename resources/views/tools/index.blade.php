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
			<h3>Tools Tracking</h3>
		</div>
		<div>
			<a href="/tools/create">Add Tool</a>
		</div>

	</div>


	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">Tool Type</th>
			<th scope="col">Tool A/N</th>
			<th scope="col">Arrived</th>
			<th scope="col">Demob</th>
			<th scope="col">CCD</th>
			<th scope="col">Location</th>
			<th scope="col">Circ Hrs</th>
			<th scope="col">Comment</th>
			<th scope="col">###</th>
		</tr>
		</thead>
		@foreach($tools as $tool)
			<tbody>
			<tr>
				<td>{{ $tool->tool_type }}</td>
				<td><a href="/tools/{{ $tool->id }}">{{ $tool->tool_number }}</a></td>
				<td>{{ $tool->tool_arrived }}</td>
				<td>{{ $tool->tool_demob }}</td>
				<td><a href="#">{{ $tool->tool_ccd }}</a></td>
				<td>{{ $tool->tool_location }}</td>
				<td>{{ $tool->tool_circHrs }}</td>
				<td>{{ $tool->tool_comment }}</td>
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