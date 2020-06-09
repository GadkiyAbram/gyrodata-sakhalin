<html>

<head>

</head>

<body>
<div class="pl-3 pr-3">

	@include('nav')
</div>


<div class="pl-4 pr-4">

	<div>
		<div>
			<h3>Token</h3>
		</div>

		<form action="{{ route('preferences.store') }}" method="post" enctype="multipart/form-data">

			<div>
                <div class="row">
                    <div class="col-2">
                        <label for="User" class="col-form-label">Username</label>
                        <div>
                            <input type="text" class="form-control" name="User" placeholder="user1">
                        </div>
                        <label for="Password" class="col-form-label">Password</label>
                        <div>
                            <input type="text" class="form-control" name="Password" placeholder="pass1">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Get Token</button>
                        </div>
                    </div>
                </div>

			</div>
			@csrf
		</form>

	</div>



	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>
