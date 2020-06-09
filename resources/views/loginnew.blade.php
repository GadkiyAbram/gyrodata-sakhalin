<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<section>
    <div class="container">
        <div class="user signinBx">
            <div class="imgBx"><img src="surveying-left.jpg"></div>
            <div class="formBx">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>Log In</h2>
{{--                    <input type="email" name="" placeholder="Email">--}}
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

{{--                    <input type="password" name="" placeholder="Password">--}}
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

                    <input type="submit" name="" value="Login">
{{--                    <input type="submit" class="btn btn-primary">--}}
                    <p class="signup">Don't have an account ? <a href="#" onclick="toggleForm();">Send Request</a></p>
                </form>
            </div>
        </div>
        <div class="user signupBx">
            <div class="formBx">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>Request an account</h2>
                    <input type="text" name="first_name" placeholder="First Name">
                    <input type="text" name="last_name" placeholder="Last Name">
                    <input type="email" name="email" placeholder="Email">
                    <input type="submit" name="" value="Request">
                    <p class="signup">Already with Us ? <a href="#" onclick="toggleForm();">Log In</a></p>
                </form>
            </div>
            <div class="imgBx"><img src="surveying-right.jpg"></div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function toggleForm(){
        var container = document.querySelector('.container');
        container.classList.toggle('active');
    }

    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>
</body>
