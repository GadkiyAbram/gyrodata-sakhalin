<html>

<head>

</head>

<body>
<div class="pl-3 pr-3">
	@include('nav')
</div>

<div class="pl-4 pr-4">

	<form action="/tools/{{ $item['Id'] }}" method="post" enctype="multipart/form-data">

		@method('PATCH')

		<div class="d-flex justify-content-between align-items-baseline">

			<div class="align-content-center pr-3">
				<div class="d-flex justify-content-between align-items-baseline">
					<a href="/tools/{{ $item['Id'] }}">Go back</a>
					<h5 class="pl-2">{{ $item['Item'] }}</h5>
				</div>
			</div>
            <div>
                <h6 class="pl-2">PM in: {{ $circulation_remains }} hours</h6>
            </div>

		</div>

		<div class="row">
			<div class="col-6">

				<div class="form-group row">
					<label for="Asset" class="col-4 col-form-label">Tool Asset</label>
					<div class="col-5">
						<input type="text" class="form-control" name="Asset" value={{ $item['Asset'] }}>
					</div>
				</div>

				<div class="form-group row">
					<label for="Arrived" class="col-4 col-form-label">Arrived</label>
					<div class="col-5">
						<input type="date" class="form-control" name="Arrived" value={{ $item['Arrived'] }}>
					</div>
				</div>

				<div class="form-group row">
					<label for="Invoice" class="col-4 col-form-label">Invoice</label>
					<div class="col-5">
						<input type="text" class="form-control" name="Invoice" value={{ $item['Invoice'] }}>
					</div>
				</div>

				<div class="form-group row">
					<label for="CCD" class="col-4 col-form-label">Custom Declaration</label>
					<div class="col-5">
						<input type="text" class="form-control" name="CCD" value={{ $item['CCD'] }}>
					</div>
				</div>

				<div class="form-group row">
					<label for="ItemStatus" class="col-4 col-form-label">Tool Location</label>
					<div class="col-5">
						<input type="text" class="form-control" name="ItemStatus" value={{ $item['ItemStatus'] }}>
					</div>
				</div>

				<div class="form-group row">
					<label for="Comment" class="col-4 col-form-label">Comment</label>
					<div class="col-5">
						<input type="text" class="form-control" name="Comment" value={{ $item['Comment'] }}>
					</div>
				</div>

                <div class="form-group row">
                    <div class="col-5">
                        <button type="submit" class="btn btn-secondary">Edit Tool</button>
                    </div>
                </div>

			</div>

			<div class="col-5">

				<div class="form-group row">
					<label for="tool_desc_rus" class="col-4 col-form-label">Tool desc RUS</label>
					<div class="col-8">
						<textarea class="form-control" name="tool_desc_rus" rows="8" cols="3"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="Box" class="col-4 col-form-label">Box</label>
					<div class="col-8">
						<input type="text" class="form-control" value={{ $item['Box'] }}>
					</div>
				</div>

				<div class="form-group row">
					<label for="PositionCCD" class="col-4 col-form-label">Tool CCD pos</label>
					<div class="col-8">
						<input type="text" class="form-control" value={{ $item['PositionCCD'] }}>
					</div>
				</div>

				<div class="form-group row">
					<label for="image" class="col-4 col-form-label">Tool Image (<= 5 Mb)</label>
					<div class="col-8">
						<input type="file" name="image">
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
