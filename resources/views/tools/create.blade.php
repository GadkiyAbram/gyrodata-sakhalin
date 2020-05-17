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

	<form action="{{ route('tools.store') }}" method="post" enctype="multipart/form-data">

		<div class="row">
			<div class="col-6">

				<div class="form-group row">
					<label for="Item" class="col-4 col-form-label">Tool Type</label>
					<div class="col-4">
						<select name="Item" id="Item" class="form-control">
							@foreach($components as $component)
								<option value="{{ $component }}">{{ $component }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="Asset" class="col-4 col-form-label">Tool Asset</label>
					<div class="col-4">
						<input type="text" class="form-control" name="Asset" placeholder="G0001">
                        @if($errors->has('Asset'))
                            <div class="error">{{ $errors->first('Asset') }}</div>
                        @endif

					</div>
				</div>

				<div class="form-group row">
					<label for="Arrived" class="col-4 col-form-label">Arrived</label>
					<div class="col-4">
						<input type="date" class="form-control" name="Arrived">
					</div>
				</div>

				<div class="form-group row">
					<label for="Invoice" class="col-4 col-form-label">Invoice</label>
					<div class="col-4">
						<input type="text" class="form-control" name="Invoice" placeholder="O/01/16">
					</div>
				</div>

				<div class="form-group row">
					<label for="CCD" class="col-4 col-form-label">Custom Declaration</label>
					<div class="col-4">
						<input type="text" class="form-control" name="CCD" placeholder="10707090-021017-0013452">
					</div>
				</div>

				<div class="form-group row">
					<label for="ItemStatus" class="col-4 col-form-label">Tool Location</label>
					<div class="col-4">
						<input type="text" class="form-control" name="ItemStatus" placeholder="Sakhalin">
					</div>
				</div>

				<div class="form-group row">
					<label for="Comment" class="col-4 col-form-label">Comment</label>
					<div class="col-4">
						<input type="text" class="form-control" name="Comment" placeholder="Your comment here">
					</div>
				</div>

				<div class="col-4">
					<button type="submit" class="btn btn-primary">Add Tool</button>
				</div>

			</div>

			<div class="col-5">

				<div class="form-group row">
					<label for="NameRus" class="col-4 col-form-label">Tool desc RUS</label>
					<div class="col-8">
						<textarea class="form-control" name="NameRus" rows="8" cols="3"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label for="Box" class="col-4 col-form-label">Box</label>
					<div class="col-8">
						<input type="text" class="form-control" name="Box">
					</div>
				</div>

				<div class="form-group row">
					<label for="PositionCCD" class="col-4 col-form-label">Tool CCD pos</label>
					<div class="col-8">
						<input type="text" class="form-control" name="PositionCCD">
					</div>
				</div>

				<div class="form-group row">
					<label for="image" class="col-4 col-form-label">Tool Image (<= 5 Mb)</label>
					<div class="col-8">
						<input type="file" name="image">
                        @if($errors->has('image'))
                            <div class="error">{{ $errors->first('image') }}</div>
                        @endif
					</div>
				</div>

			</div>
		</div>
		@csrf
	</form>
	
	<!--Modal-->
	<div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
