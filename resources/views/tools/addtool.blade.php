<html>

<head></head>

<body>
<div class="pl-3 pr-3">
	@include('nav')
</div>
<div class="pl-4 pr-4">

	<div class="d-flex justify-content-start align-items-baseline">
		<div class="align-content-center pr-3">
			<a href="/tools">Go back</a>
		</div>
		<div>
			<h5>Adding New Tool</h5>
		</div>
	</div>

	<form action="/tools" method="post">

		<div class="row">
			<div class="col-6">

				<div class="form-group row">
					<label for="tool_type" class="col-4 col-form-label">Tool Type</label>
					<div class="col-4">
						<input type="text" class="form-control" name="tool_type" placeholder="GWD Gyro Section">
					</div>
				</div>
				<div class="form-group row">
					<label for="tool_number" class="col-4 col-form-label">Tool Number</label>
					<div class="col-4">
						<input type="text" class="form-control" name="tool_number" placeholder="G0001">
					</div>
				</div>
				<div class="form-group row">
					<label for="tool_arrived" class="col-4 col-form-label">Arrived</label>
					<div class="col-4">
						<input type="date" class="form-control" name="tool_arrived">
					</div>
				</div>
				<div class="form-group row">
					<label for="tool_demob" class="col-4 col-form-label">Demob</label>
					<div class="col-4">
						<input type="date" class="form-control" name="tool_demob">
					</div>
				</div>

				<div class="form-group row">
					<label for="tool_invoice" class="col-4 col-form-label">Invoice</label>
					<div class="col-4">
						<input type="text" class="form-control" name="tool_invoice" placeholder="O/01/16">
					</div>
				</div>

				<div class="form-group row">
					<label for="tool_ccd" class="col-4 col-form-label">Custom Declaration</label>
					<div class="col-4">
						<input type="text" class="form-control" name="tool_ccd" placeholder="10707090-021017-0013452">
					</div>
				</div>

				<div class="form-group row">
					<label for="tool_location" class="col-4 col-form-label">Tool Location</label>
					<div class="col-4">
						<input type="text" class="form-control" name="tool_location" placeholder="Sakhalin">
					</div>
				</div>

				<div class="form-group row">
					<label for="tool_comment" class="col-4 col-form-label">Comment</label>
					<div class="col-4">
						<input type="text" class="form-control" name="tool_comment" placeholder="Your comment here">
					</div>
				</div>



				<div class="col-4">
					<button type="submit" class="btn btn-primary">Add Tool</button>
				</div>

			</div>

			<div class="col-5">

				<div class="form-group row">
					<label for="tool_desc_rus" class="col-4 col-form-label">Tool desc RUS</label>
					<div class="col-8">
						<textarea class="form-control" name="tool_desc_rus" rows="7" cols="3"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="tool_ccd_pos" class="col-4 col-form-label">Tool CCD pos</label>
					<div class="col-8">
						<input type="text" class="form-control" name="tool_ccd_pos">
					</div>
				</div>

			</div>
		</div>
		@csrf
	</form>

</div>




<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>