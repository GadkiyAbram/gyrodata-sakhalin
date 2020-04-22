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
			<h4>Edit {{ $job->jobNumber }}</h4>
		</div>
	</div>

	<form action="/jobs/{{ $job->id }}" method="post">

		@method('PATCH')

		<div class="row">
			<div class="col-6">

				<div class="form-group row">
					<label for="jobNumber" class="col-4 col-form-label">Job Number</label>
					<div class="col-4">
						{{--<input type="text" class="form-control" name="jobNumber" value="{{ $job->jobNumber }}">--}}
						{{ $job->jobNumber }}
						<!--@error('jobNumber') <p style="color: red">{{ $message }}</p>@enderror-->
					</div>
				</div>
				<div class="form-group row">
					<label for="toolNumber" class="col-4 col-form-label">Tool</label>
					<div class="col-4">
						<select name="toolNumber" id="toolNumber" class="form-control">
							<option value="{{ $job->toolNumber }}">{{ $job->toolNumber }}</option>
							@foreach($tools as $tool)
								<option value="{{ $tool->tool_number }}">{{ $tool->tool_number }}</option>
							@endforeach
						</select>
						@error('toolNumber') <p style="color: red">{{ $message }}</p>@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="modemNumber" class="col-4 col-form-label">Modem</label>
					<div class="col-4">
						<select name="modemNumber" id="modemNumber" class="form-control">
							<option value="{{ $job->modemNumber }}">{{ $job->modemNumber }}</option>
							@foreach($modems as $modem)
								<option value="{{ $modem->tool_number }}">{{ $modem->tool_number }}</option>
							@endforeach
						</select>
						@error('modemNumber') <p style="color: red">{{ $message }}</p>@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="bbpNumber" class="col-4 col-form-label">BBP Number</label>
					<div class="col-4">
						<select name="bbpNumber" id="bbpNumber" class="form-control">
							<option value="{{ $job->bbpNumber }}">{{ $job->bbpNumber }}</option>
							@foreach($bbps as $bbp)
								<option value="{{ $bbp->tool_number }}">{{ $bbp->tool_number }}</option>
							@endforeach
						</select>
						@error('bbpNumber') <p style="color: red">{{ $message }}</p>@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="battery" class="col-4 col-form-label">Battery</label>
					<div class="col-4">
						<select name="battery" id="battery" class="form-control">
							<option value="{{ $job->battery->id }}">{{ $job->battery->serialOne }}</option>
							{{--<option value="{{ $battery_id }}">{{ $battery_serialOne }}</option>--}}
							@foreach($batteries as $battery)
								<option value="{{ $job->battery->id }}">{{ $job->battery->serialOne }}</option>
								{{--<option value="{{ $battery->id }}">{{ $battery->serialOne }}</option>--}}
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="engFirst" class="col-4 col-form-label">1st Engineer</label>
					<div class="col-4">
						<select name="engFirst" id="engFirst" class="form-control">
							<option value="{{ $job->engFirst }}">{{ $job->engFirst }}</option>
							@foreach($engineers as $engineer)
								<option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="engSecond" class="col-4 col-form-label">2nd Engineer</label>
					<div class="col-4">
						<select name="engSecond" id="engSecond" class="form-control">
							<option value="{{ $job->engSecond }}">{{ $job->engSecond }}</option>
							@foreach($engineers as $engineer)
								<option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="eng1ArrRig" class="col-4 col-form-label">1st Eng at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng1ArrRig">
					</div>
				</div>

			</div>

			<div class="col-6">

				<div class="form-group row">
					<label for="eng2ArrRig" class="col-4 col-form-label">2nd Eng at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng2ArrRig">
					</div>
				</div>
				<div class="form-group row">
					<label for="eng1DepRig" class="col-4 col-form-label">1st Eng Left Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng1DepRig">
					</div>
				</div>
				<div class="form-group row">
					<label for="eng2DepRig" class="col-4 col-form-label">2nd Eng Left Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="eng2DepRig">
					</div>
				</div>
				<div class="form-group row">
					<label for="container" class="col-4 col-form-label">Container</label>
					<div class="col-4">
						<input type="text" class="form-control" name="container" placeholder="Container N">
					</div>
				</div>
				<div class="form-group row">
					<label for="containerArrRig" class="col-4 col-form-label">Container at Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="containerArrRig">
					</div>
				</div>
				<div class="form-group row">
					<label for="containerDepRig" class="col-4 col-form-label">Container Left Rig</label>
					<div class="col-4">
						<input type="date" class="form-control" name="containerDepRig">
					</div>
				</div>
				<div class="form-group row">
					<label for="toolCircHrs" class="col-4 col-form-label">Tool Hours</label>
					<div class="col-4">
						<input type="number" step="0.01" class="form-control" name="toolCircHrs" value="{{ $job->toolCircHrs }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="comment" class="col-4 col-form-label">Comment</label>
					<div class="col-4">
						<input type="comment" class="form-control" name="comment" placeholder="Comment">
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