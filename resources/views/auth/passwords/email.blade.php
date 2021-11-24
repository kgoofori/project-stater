<x-auth>

    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-xl-4 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-5">
                Password Reset
            </h1>

            <p class="text-muted text-center mb-5">
                Enter your email to get a password reset link.
            </p>

            <!-- Subheading -->
            @if (session('status'))
                <div class="alert alert-success mb-5" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" id="password-email-form">
                @csrf
                <x-recaptcha form="password-email-form" />
                <!-- Email address -->
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

                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3 g-recaptcha"
                    data-sitekey="{{ config('recaptcha.key') }}" data-callback="onRecaptcha"
                    data-action="pemail">
                    Reset Password
                </button>

                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                        <a href="{{ route('login') }}">Back to Log in</a>.
                    </small>
                </div>

            </form>

        </div>
    </div> <!-- / .row -->

</x-auth>
