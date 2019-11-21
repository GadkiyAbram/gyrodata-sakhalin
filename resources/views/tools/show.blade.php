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
			<h5>{{ $tool->tool_number }}</h5>
		</div>
		<div>
			<a href="#">Edit Tool</a>
		</div>

	</div>

	<div class="row">
		<div class="col-12">
			<p><strong>Type: </strong>{{ $tool->tool_type }}</p>
			<p><strong>Asset: </strong>{{ $tool->tool_number }}</p>
			<p><strong>Arrived: </strong>{{ $tool->tool_arrived }}</p>
			<p><strong>Demob: </strong>{{ $tool->tool_demob }}</p>
			<p><strong>Invoice: </strong>{{ $tool->tool_invoice }}</p>
			<p><strong>Custom Decl: </strong>{{ $tool->tool_ccd }}</p>
			<p><strong>Description RUS: </strong>{{ $tool->tool_desc_rus }}</p>
			<p><strong>CCD Position: </strong>{{ $tool->tool_ccd_pos }}</p>
			<p><strong>Tool Location: </strong>{{ $tool->tool_location }}</p>
			<p><strong>Tool Last RT: </strong>{{ $tool->tool_last_rt }}</p>
			<p><strong>Comment: </strong>{{ $tool->tool_comment }}</p>
			<table class="table table-striped">
				<thead>
				<tr>
					<th scope="col">Job involved</th>
					<th scope="col">Circ Hrs</th>
				</tr>
				</thead>
				@foreach($jobs_involved as $job)
					<tbody>
					<tr>
						<td>{{ $job->jobNumber }}</td>
						<td>{{ $job->toolCircHrs }}</td>
					</tr>
					</tbody>
				@endforeach
			</table>
			<p><strong>Total Circulation: </strong>{{ $tool->tool_circHrs }}</p>
		</div>
	</div>



	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>