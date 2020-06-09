@if (Auth::user())
	@include('nav')
@endif

        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .center-content {
            position: center;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 140px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

   <div class="content">

        <div class="title m-b-md">
            Gyrodata Sakhalin
        </div>

        <div>
        @if (Auth::guest())
            @if (Route::has('login'))
                <div class="center-content links">
                @auth
                    @else
                        <a href="{{ route('login') }}">Login</a>

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}">Register</a>--}}
{{--                    @endif--}}
                @endauth
                </div>
            @endif
        @else
{{--            TODO - remove logout--}}
{{--        	<div class="center-content links">--}}
{{--				<a class="nav-link" href="{{ route('logout') }}"--}}
{{--					onclick="event.preventDefault();--}}
{{--					document.getElementById('logout-form').submit();">--}}
{{--						<p> {{ __('Logout') }} </p>--}}
{{--				</a>--}}

{{--				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--					@csrf--}}
{{--				</form>--}}
{{--        	</div>--}}
       @endif
        </div>
    </div>

</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
