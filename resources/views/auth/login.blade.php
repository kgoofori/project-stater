<x-auth>

    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-xl-4 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                Welcome Back
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                Enter your email and password to sign in
            </p>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf
                <!-- Email address -->
                <x-recaptcha form="login-form" />

                <div class="form-group">

                    <!-- Label -->
                    <label>Email Address</label>

                    <!-- Input -->
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <!-- Password -->
                <div class="form-group">

                    <div class="row">
                        <div class="col">

                            <!-- Label -->
                            <label>Password</label>

                        </div>
                        <div class="col-auto">

                            <!-- Help text -->
                            @if (Route::has('password.request'))
                                <a class="form-text small text-muted" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                        </div>
                    </div> <!-- / .row -->

                    <!-- Input group -->
                    <div class="input-group input-group-merge">

                        <!-- Input -->
                        <input id="password" type="password"
                            class="form-control form-control-appended @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        <!-- Icon -->
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fe fe-eye"></i>
                            </span>
                        </div>

                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="remember" id="rememberSwitch1">
                        <label class="custom-control-label" for="rememberSwitch1">Remember me</label>
                    </div>
                </div>


                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3 g-recaptcha"
                    data-sitekey="{{ config('recaptcha.key') }}" data-callback="onRecaptcha" data-action="login">
                    Sign in
                </button>

                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                        Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>.
                    </small>
                </div>

            </form>

        </div>
    </div> <!-- / .row -->

</x-auth>
