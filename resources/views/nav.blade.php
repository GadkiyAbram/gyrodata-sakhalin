<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>--}}

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

<div class="pb-2 pl-1 pr-1">

	<div class="d-flex align-items-baseline justify-content-between shadow-sm">
		<div>
			<nav class="navbar navbar-expand-md navbar-light bg-white">
				<div class="py-1">

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link" href="/">Main</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/news">Updates</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/tools">Tools</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/jobs">Job Tracking</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/batteries">Lithium Batteries</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/preferences">Preferences</a>
								</li>
                                @can('isAdmin')
                                <li class="nav-item">
                                    <a class="nav-link" href="/master">Admin Panel</a>
                                </li>
                                @endcan
							</ul>
					</div>
				</div>
			</nav>
		</div>

		<div class="d-flex align-items-baseline justify-content-between">
			@if (Auth::user())
{{--			<div class="dropdown mr-4">--}}
{{--                <a data-toggle="dropdown" style="z-index: 9">{{ Auth::user()->name }}</a>--}}
{{--                <div class="dropdown-menu">--}}
{{--                	<a href="/preferences" class="dropdown-item-gdta">Settings</a>--}}
{{--                	<a href="#" class="dropdown-item-gdta">Another</a>--}}
{{--                    <a href="{{ route('logout') }}" class="dropdown-item-gdta" onclick="event.preventDefault();--}}
{{--        			document.getElementById('logout-form').submit()">Sign out</a>--}}
{{--                </div>--}}

{{--                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                    @csrf--}}
{{--                </form>--}}
{{--            </div>--}}
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

	</div>
</div>
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
</body>
</html>
