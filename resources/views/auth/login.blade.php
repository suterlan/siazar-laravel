@include('partials.header')

<body class="light">
    <div class="wrapper vh-100">
        <div class="align-items-center h-100 d-flex">
            <div class="col-lg-3 mx-auto text-center">
                <h4>SISTEM INFORMASI SMK AZ-ZARKASYIH</h4>
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center">
                    <img src="{{ asset('logo_smk.png') }}" alt="" width="70px">
                </a>
                <h1 class="h6 mb-3">Sign in</h1>
                @if (session()->has('loginError'))
                    <div class="alert alert-danger" role="alert">
                        <span class="fe fe-minus-circle fe-16"></span><font _mstmutation="1" _msthash="2975089" _msttexthash="3657225">{{ session('loginError') }}</font>
                    </div>
                @endif
                <form action="/login" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputUsername" class="sr-only">Username</label>
                        <input type="text" name="username" id="inputUsername" class="form-control form-control-lg" placeholder="Username" value="{{ old('username') }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required>
                    </div>
                    {{-- <div class="checkbox mb-3">
                        <label>
                        <input type="checkbox" value="remember-me"> Stay logged in </label>
                    </div> --}}
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                    <p class="mt-5 mb-3 text-muted">© {{ date('Y') }}</p>
                </form>
            </div>
        </div>
    </div>
@include('partials.footer')
</body>
</html>
