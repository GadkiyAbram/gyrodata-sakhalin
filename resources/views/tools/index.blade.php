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
			<h3>Tools Tracking</h3>
		</div>
		<div>
			<a href="/tools/create">Add Tool</a>
		</div>

	</div>

    <!-- SEARCH FORM -->
    <div class="input-group input-group-sm mt-1 mb-3">
        <input class="form-control form-control-navbar"
               {{--                   @keyup="searchit" v-model="search" type="search" --}}
               placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar"
                {{--                        @click="searchit"--}}
            >
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>


	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">Tool Type</th>
			<th scope="col">Tool A/N</th>
			<th scope="col">Arrived</th>
			<th scope="col">CCD</th>
			<th scope="col">Location</th>
			<th scope="col">Circ Hrs</th>
			<th scope="col">Comment</th>
			<th scope="col">###</th>
		</tr>
		</thead>
		{{--@for($i = 0; $i < count($items); $i++)--}}
			{{--<tbody>--}}
			{{--<tr>--}}
				{{--<td>{{ $items[$i]->Item }}</td>--}}
				{{--<td><a href="/tools/{{ $items[$i]->Id }}">{{ $items[$i]->Asset }}</a></td>--}}
				{{--<td>{{ $items[$i]->Arrived }}</td>--}}
				{{--<td><a href="#">{{ $items[$i]->CCD }}</a></td>--}}
				{{--<td>{{ $items[$i]->ItemStatus }}</td>--}}
				{{--<td>{{ $items[$i]->Circulation }}</td>--}}
				{{--<td>{{ $items[$i]->Comment }}</td>--}}
				{{--<td><a href="#">Edit</a></td>--}}
			{{--</tr>--}}
			{{--</tbody>--}}
		{{--@endfor--}}
		@foreach($items as $item)
			<tbody>
			<tr>
				<td>{{ $item->Item }}</td>
				<td><a href="/tools/{{ $item->Id }}">{{ $item->Asset }}</a></td>
				<td>{{ $item->Arrived }}</td>
				<td>{{ $item->CCD }}</td>
				<td>{{ $item->ItemStatus }}</td>
				<td>{{ $item->Circulation }}</td>
				<td>{{ $item->Comment }}</td>
				<td><a href="/tools/{{ $item->Id }}/edit">Edit</a></td>
			</tr>
			</tbody>
		@endforeach
	</table>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

</body>

</html>
