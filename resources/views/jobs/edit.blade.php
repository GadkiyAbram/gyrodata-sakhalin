<html>

<head></head>

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
            <h4>Edit {{ $job['JobNumber'] }}</h4>
        </div>
	</div>

	<form action="/jobs/{{ $job['Id'] }}" method="post">

		@method('PATCH')

		<div class="row">
			<div class="col-6">

				<div class="form-group row">
                    <label for="GDP" class="col-4 col-form-label">GDP Sections</label>
					<div class="col-4">
                        <p>{{ $job['GDP'] }}</p>
					</div>
				</div>
				<div class="form-group row">
					<label for="Modem" class="col-4 col-form-label">Modem</label>
                    <div class="col-4">
                        <p>{{ $job['Modem'] }}</p>
                    </div>
				</div>
				<div class="form-group row">
					<label for="BBP" class="col-4 col-form-label">BBP Number</label>
                    <div class="col-4">
                        <p>{{ $job['Bullplug'] }}</p>
                    </div>
				</div>
				<div class="form-group row">
					<label for="Battery" class="col-4 col-form-label">Battery</label>
                    <div class="col-4">
                        <p>{{ $job['Battery'] }}</p>
                    </div>
				</div>

				<div class="form-group row">
					<label for="EngineerOne" class="col-4 col-form-label">1st Engineer</label>
					<div class="col-4">
						<select name="EngineerOne" id="EngineerOne" class="form-control">
							<option value="{{ $job['EngineerOne'] }}">{{ $job['EngineerOne'] }}</option>
							@foreach($engineers as $engineer)
								<option value="{{ $engineer }}">{{ $engineer }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="EngineerTwo" class="col-4 col-form-label">2nd Engineer</label>
					<div class="col-4">
						<select name="EngineerTwo" id="EngineerTwo" class="form-control">
							<option value="{{ $job['EngineerTwo'] }}">{{ $job['EngineerTwo'] }}</option>
                            @foreach($engineers as $engineer)
                                <option value="{{ $engineer }}">{{ $engineer }}</option>
                            @endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="eng_one_arrived" class="col-4 col-form-label">1st Eng at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng_one_arrived" value="{{ $job['eng_one_arrived'] }}">
					</div>
				</div>
                <div class="form-group row">
                    <label for="eng_two_arrived" class="col-4 col-form-label">2nd Eng at Rig</label>
                    <div class="col-4">
                        <input type="date" class="form-control" name="eng_two_arrived" value="{{ $job['eng_two_arrived'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="eng_one_left" class="col-4 col-form-label">1st Eng Left Rig</label>
                    <div class="col-4">
                        <input type="date" class="form-control" name="eng_one_left" value="{{ $job['eng_one_left'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="eng_two_left" class="col-4 col-form-label">2nd Eng Left Rig</label>
                    <div class="col-4">
                        <input type="date" class="form-control" name="eng_two_left" value="{{ $job['eng_two_left'] }}">
                    </div>
                </div>

			</div>

			<div class="col-6">

				<div class="form-group row">
					<label for="Container" class="col-4 col-form-label">Container</label>
					<div class="col-4">
						<input type="text" class="form-control" name="Container" placeholder="Container N" value="{{ $job['Container'] }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="ContainerArrived" class="col-4 col-form-label">Container at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="ContainerArrived" value="{{ $job['ContainerArrived'] }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="ContainerLeft" class="col-4 col-form-label">Container Left Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="ContainerLeft" value="{{ $job['ContainerLeft'] }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="CirculationHours" class="col-4 col-form-label">Tool Hours</label>
					<div class="col-4">
						<input type="number" step="0.01" class="form-control" name="CirculationHours" value="{{ $job['CirculationHours'] }}">
					</div>
				</div>
                <div class="form-group row">
                    <label for="MaxTemp" class="col-4 col-form-label">Max Temp</label>
                    <div class="col-4">
                        <input type="number" step="0.01" class="form-control" name="MaxTemp" value="{{ $job['MaxTemp'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Rig" class="col-4 col-form-label">Rig</label>
                    <div class="col-4">
                        <input type="text" step="0.01" class="form-control" name="Rig" value="{{ $job['Rig'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Issues" class="col-4 col-form-label">Issues</label>
                    <div class="col-4">
                        <input type="text" step="0.01" class="form-control" name="Issues" value="{{ $job['Issues'] }}">
                    </div>
                </div>
				<div class="form-group row">
					<label for="Comment" class="col-4 col-form-label">Comment</label>
					<div class="col-4">
						<input type="text" class="form-control" name="Comment" value="{{ $job['Comment'] }}">
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<div class="col-4">
				<button type="submit" class="btn btn-primary">Update Job</button>
			</div>
		</div>
		@csrf
	</form>

</div>




<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
