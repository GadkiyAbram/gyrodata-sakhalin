<html>

<head>
	<style>
		.error{
			color: red;
			font-size: 12px;
		}
	</style>
</head>

<body>
<div class="pl-3 pr-3">
	@include('nav')
</div>
<div class="pl-4 pr-4">

	<div class="d-flex justify-content-start align-items-baseline">
		<div class="align-content-center pr-3">
			<a href="/jobs">Go back</a>
		</div>
		<div>
			<h4>Add New Job</h4>
		</div>
	</div>

	<form action="{{ route('jobs.store') }}" method="post">

		<div class="row">
			<div class="col-6">

				<div class="form-group row">
					<label for="JobNumber" class="col-4 col-form-label">Job Number</label>
					<div class="col-4">
						<input type="text" class="form-control" name="JobNumber" placeholder="RU0119GWD001">
						@if($errors->has('JobNumber'))
						<div class="error">{{ $errors->first('JobNumber') }}</div>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label for="client_id" class="col-4 col-form-label">Client</label>
					<div class="col-4">
						<select name="client_id" id="client_id" class="form-control">
							@foreach($clients as $client)
								<option value="{{ $client }}">{{ $client }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="gdp_id" class="col-4 col-form-label">Tool</label>
					<div class="col-4">
						<select name="gdp_id" id="gdp_id" class="form-control">
							@foreach($gdps as $gdp)
								<option value="{{ $gdp }}">{{ $gdp }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="modem_id" class="col-4 col-form-label">Modem</label>
					<div class="col-4">
						<select name="modem_id" id="modem_id" class="form-control">
							@foreach($modems as $modem)
								<option value="{{ $modem }}">{{ $modem }}</option>
							@endforeach
						</select>
					</div>
				</div>
                <div class="form-group row">
                    <label for="ModemVersion" class="col-4 col-form-label">Modem Version</label>
                    <div class="col-4">
                        <input type="text" class="form-control" name="ModemVersion" placeholder="4.13">
                        <div class="error">{{ $errors->first('ModemVersion') }}</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MaxTemp" class="col-4 col-form-label">Max Temperature</label>
                    <div class="col-4">
                        <input type="text" class="form-control" name="MaxTemp" placeholder="67">
                        <div class="error">{{ $errors->first('MaxTemp') }}</div>
                    </div>
                </div>
				<div class="form-group row">
					<label for="bullplug_id" class="col-4 col-form-label">BBP Number</label>
					<div class="col-4">
						<select name="bullplug_id" id="bullplug_id" class="form-control">
							@foreach($bbps as $bbp)
								<option value="{{ $bbp }}">{{ $bbp}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="battery_id" class="col-4 col-form-label">Battery</label>
					<div class="col-4">
						<select name="battery_id" id="battery_id" class="form-control">
							@foreach($batteries as $battery)
								<option value="{{ $battery }}">{{ $battery }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="eng_one" class="col-4 col-form-label">1st Engineer</label>
					<div class="col-4">
						<select name="eng_one" id="eng_one" class="form-control">
							@foreach($engineers as $engineer)
								<option value="{{ $engineer }}">{{ $engineer }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="eng_two" class="col-4 col-form-label">2nd Engineer</label>
					<div class="col-4">
						<select name="eng_two" id="eng_two" class="form-control">
							@foreach($engineers as $engineer)
								<option value="{{ $engineer }}">{{ $engineer }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="form-group row">
					<label for="eng1ArrRig" class="col-4 col-form-label">1st Eng at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng_one_arrived">
					</div>
				</div>

				<div class="form-group row">
					<label for="eng2ArrRig" class="col-4 col-form-label">2nd Eng at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng_two_arrived">
					</div>
				</div>
				<div class="form-group row">
					<label for="eng1DepRig" class="col-4 col-form-label">1st Eng Left Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng_one_left">
					</div>
				</div>
				<div class="form-group row">
					<label for="eng2DepRig" class="col-4 col-form-label">2nd Eng Left Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng_two_left">
					</div>
				</div>
				<div class="form-group row">
					<label for="Container" class="col-4 col-form-label">Container</label>
					<div class="col-4">
						<input type="text" class="form-control" name="Container" placeholder="Container N">
					</div>
				</div>
				<div class="form-group row">
					<label for="ContainerArrived" class="col-4 col-form-label">Container at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="ContainerArrived">
					</div>
				</div>
				<div class="form-group row">
					<label for="ContainerLeft" class="col-4 col-form-label">Container Left Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="ContainerLeft">
					</div>
				</div>
				<div class="form-group row">
					<label for="CirculationHours" class="col-4 col-form-label">Tool Hours</label>
					<div class="col-4">
						<input type="number" step="0.01" class="form-control" name="CirculationHours" placeholder="43.3">
						<div class="error">{{ $errors->first('CirculationHours') }}</div>
					</div>
				</div>
                <div class="form-group row">
                    <label for="Rig" class="col-4 col-form-label">Rig</label>
                    <div class="col-4">
                        <input type="text" class="form-control" name="Rig" placeholder="Rig">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Issues" class="col-4 col-form-label">Issues</label>
                    <div class="col-4">
                        <select name="Issues" id="Issues" class="form-control">
                            <option value="" disabled>Issues</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                </div>
				<div class="form-group row">
					<label for="Comment" class="col-4 col-form-label">Comment</label>
					<div class="col-4">
						<input type="text" class="form-control" name="Comment" placeholder="Your comment here">
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<div class="col-4">
				<button type="submit" class="btn btn-primary">Add Job</button>
			</div>
		</div>
		@csrf
	</form>

</div>




<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
