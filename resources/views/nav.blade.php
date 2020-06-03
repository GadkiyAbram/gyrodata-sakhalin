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
                                <li class="nav-item">
                                    <a class="nav-link" href="/master">Admin Panel</a>
                                </li>
							</ul>
					</div>
				</div>
			</nav>
		</div>
		
		<div class="d-flex align-items-baseline justify-content-between">
			@if (Auth::user())
			<div class="nav-item">
				<p>{{ Auth::user()->name }}</p>
    		</div>
    		<div class="nav-item">
    			<a class="nav-link" href="{{ route('logout') }}"
                	onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    	<p>{{ __('Logout') }}</p>
    			</a>
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

</body>
</html>
