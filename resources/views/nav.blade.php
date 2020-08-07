<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<!--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  -->

	<style>

		.nav-link {
			color: darkgrey;
			font-family: SegoeUI-Regular-final, sans-serif;
			font-weight: bold;
		}

		.dropdown-item-gdta {
		      display: block;
		      padding: 0.5rem 0.5rem;
		      color: #0078d4;
		      font-family: SegoeUI-Regular-final, sans-serif;
		      font-weight: 400;
		      font-size: 16px;
		}

		.dropdown-toggle {
		      white-space: nowrap;
		      color: grey;
		      font-family: SegoeUI-Regular-final, sans-serif;
		      font-size: 18px;
		}

	</style>
</head>
<body>
	<nav class="d-flex">
		<div class="navigation">
			<div class="hamburger">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div> 
			</div>
			<ul class="nav-links">
				<li><a href="/">Main</a></li>
				<li><a href="news">Updates</a></li>
				<li><a href="tools">Tools</a></li>
				<li><a href="jobs">Jobs</a></li>
				<li><a href="batteries">Batteries</a></li>
				@can('isAdmin')
				<li><a href="master">Admin Panel</a></li>
				@endcan
			</ul>
		</div>
		<div class="logo d-flex">
		@if (Auth::user())
                <div class="dropdown mr-4">
                    <a data-toggle="dropdown" style="z-index: 9" onclick="show_hide()">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu" id="drop-content" style="display: none;">
                        <a href="/preferences" class="dropdown-item-gdta">Settings</a>
                        <a href="#" class="dropdown-item-gdta">Profile</a>
                        <a href="{{ route('logout') }}" class="dropdown-item-gdta" onclick="event.preventDefault();
        			document.getElementById('logout-form').submit()">Sign out</a>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
    		@endif
    		<div class="py-1">
    			<img src="{{URL::asset('/gyrodata_logo_small.jpg')}}" height="50" width="200">
    		</div>
		</div>
	</nav>

<script type="text/javascript">

    function show_hide() {
        var click = document.getElementById("drop-content");
        if (click.style.display === "none") {
            click.style.display = "block";
        }
        else {
            click.style.display = "none";
        }

        // window.onclick = function(event) {
        //     click.style.display = "none";
        // }
	}
</script>
<script src={{URL::asset('js/navscript.js')}}></script>
</body>
</html>
