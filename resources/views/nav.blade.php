<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

	<style>
		.nav-link {
			color: darkgrey;
			font-family: 'Nunito', sans-serif;
			font-weight: bold;
		}
	</style>

</head>

<body>

<div>

	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link" href="/">Main</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/news">Updates</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/equipment">Equipment</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/jobs">Job Tracking</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/batteries">Lithium Batteries</a>
		</li>
	</ul>

</div>

</body>
</html>