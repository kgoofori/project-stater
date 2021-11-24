<x-auth>

    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-xl-4 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                Confirm Your Password
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                Please confirm your password to continue
            </p>

            <!-- Form -->
            <form method="POST" action="{{ route('password.confirm') }}" id="password-confirm-form">
                @csrf
                <x-recaptcha form="password-confirm-form" />

                <!-- Password -->
                <div class="form-group">

                    <!-- Label -->
                    <label>Password</label>

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

                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3 g-recaptcha"
                    data-sitekey="{{ config('recaptcha.key') }}" data-callback="onRecaptcha"
                    data-action="pconfirm">
                    Confirm Password
                </button>

                <!-- Link -->
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <small class="text-muted text-center">
                            <a href="{{ route('password.request') }}">Forgot Your Password?</a>.
                        </small>
                    </div>
                @endif

            </form>

        </div>
    </div> <!-- / .row -->

</x-auth>
