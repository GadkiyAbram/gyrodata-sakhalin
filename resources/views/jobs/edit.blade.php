<html>

<head></head>

<body>
<div class="pl-3 pr-3">
	@include('nav')
</div>
<div class="pl-4 pr-4">

	<div class="d-flex justify-content-start align-items-baseline">
		<div class="align-content-center pr-3">
            <div class="d-flex justify-content-between align-items-baseline">
                <a href="/jobs">Go back</a>
                <h5 class="pl-2">Edit {{ $job['JobNumber'] }}</h5>
            </div>
        </div>
	</div>

	<form action="/jobs/{{ $job['Id'] }}" method="post">

		@method('PATCH')

		<div class="row">
			<div class="col-6">
                <p><strong>Job / Client / Tools information:</strong></p>
                <div class="form-group row">
                    <label for="JobNumber" class="col-4 col-form-label">Job Number</label>
                    <div class="col-4">
                        <input type="text" class="form-control" name="JobNumber" value="{{ $job['JobNumber'] }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ClientName" class="col-4 col-form-label">Client</label>
                    <div class="col-4">
                        <select name="ClientName" id="ClientName" class="form-control">
                            <option value="{{ $job['ClientName'] }}">{{ $job['ClientName'] }}</option>
                            @foreach($clients as $client)
                                <option value="{{ $client }}">{{ $client }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

				<div class="form-group row">
                    <label for="GDP" class="col-4 col-form-label">GDP Sections</label>
					<div class="col-4">
                        <select name="GDP" id="GDP" class="form-control">
{{--                            TODO - refactor calculation for GDP / Modems / BBPs--}}
                            <option value="{{ $job['GDP'] }}">{{ $job['GDP'] }}</option>
{{--                            @foreach($gdps as $gdp)--}}
{{--                                <option value="{{ $gdp }}">{{ $gdp }}</option>--}}
{{--                            @endforeach--}}
                        </select>
					</div>
				</div>
				<div class="form-group row">
					<label for="Modem" class="col-4 col-form-label">Modem</label>
                    <div class="col-4">
                        <select name="Modem" id="Modem" class="form-control">
                            <option value="{{ $job['Modem'] }}">{{ $job['Modem'] }}</option>
{{--                            @foreach($modems as $modem)--}}
{{--                                <option value="{{ $modem }}">{{ $modem }}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
				</div>
				<div class="form-group row">
					<label for="BBP" class="col-4 col-form-label">BBP Number</label>
                    <div class="col-4">
                        <select name="Bullplug" id="Bullplug" class="form-control">
                            <option value="{{ $job['Bullplug'] }}">{{ $job['Bullplug'] }}</option>
{{--                            @foreach($bbps as $bbp)--}}
{{--                                <option value="{{ $bbp }}">{{ $bbp }}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
				</div>
				<div class="form-group row">
					<label for="Battery" class="col-4 col-form-label">Battery</label>
                    <div class="col-4">
                        <select name="Battery" id="Battery" class="form-control">
                            <option value="{{ $job['Battery'] }}">{{ $job['Battery'] }}</option>
{{--                            @foreach($batteries as $battery)--}}
{{--                                <option value="{{ $battery }}">{{ $battery }}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
				</div>

                <p><strong>Personnel information:</strong></p>
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
                <p><strong>Container / Destination information:</strong></p>
                <div class="form-group row">
                    <label for="Rig" class="col-4 col-form-label">Rig</label>
                    <div class="col-4">
                        <input type="text" step="0.01" class="form-control" name="Rig" value="{{ $job['Rig'] }}">
                    </div>
                </div>
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
                <p><strong>Tool Circulation / Max Temp:</strong></p>
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
                <p><strong>Other information:</strong></p>

                <div class="form-group row">
                    <label for="Issues" class="col-4 col-form-label">Issues</label>
                    <div class="col-4">
{{--                        <input type="text" step="0.01" class="form-control" name="Issues" value="{{ $job['Issues'] }}">--}}
                        <select name="Issues" id="Issues" class="form-control">
                            <option value="{{ $job['Issues'] }}">{{ $job['Issues'] }}</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
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
