<html>

<head></head>

<body>
<div class="pl-3 pr-3">
	@include('nav')
</div>
<div class="pl-4 pr-4">

	<div class="d-flex justify-content-start align-items-baseline">
		<div class="align-content-center pr-3">
			<a href="/batteries">Go back</a>
		</div>
		<div>
			<h4>Add Battery</h4>
		</div>
	</div>

	<form action="/batteries" method="post">
		<div class="form-group row">
			<label for="serialOne" class="col-sm-2 col-form-label">Serial 1</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" name="serialOne" placeholder="Serial 1">
			</div>
		</div>
		<div class="form-group row">
			<label for="serialTwo" class="col-sm-2 col-form-label">Serial 2</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" name="serialTwo" placeholder="Serial 2">
			</div>
		</div>
		<div class="form-group row">
			<label for="serialThree" class="col-sm-2 col-form-label">Serial 3</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" name="serialThree" placeholder="Serial 3">
			</div>
		</div>
		<div class="form-group row">
			<label for="date" class="col-sm-2 col-form-label">Production Date</label>
			<div class="col-sm-2">
				<input type="date" class="form-control" name="date" placeholder="Production Date">
			</div>
		</div>



		<div class="form-group row">
			<label for="condition" class="col-sm-2 col-form-label">Condition</label>
			<div class="col-sm-2">
				<select name="condition" id="condition" class="form-control">
					<option value="" disabled>Condition</option>
					<option value="1">New</option>
					<option value="0">Used</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="container" class="col-sm-2 col-form-label">Container</label>
			<div class="col-sm-2">
				<input type="container" class="form-control" name="container" placeholder="Container N">
			</div>
		</div>
		<div class="form-group row">
			<label for="comment" class="col-sm-2 col-form-label">Comment</label>
			<div class="col-sm-2">
				<input type="comment" class="form-control" name="comment" placeholder="Comment">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-2">
				<button type="submit" class="btn btn-primary">Add Battery</button>
			</div>
		</div>
		@csrf
	</form>

</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>