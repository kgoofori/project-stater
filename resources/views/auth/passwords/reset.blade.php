<x-auth>

    <div class="row align-items-center">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">

            <!-- Image -->
            <div class="text-center">
                <img src="/assets/img/illustrations/happiness.svg" alt="..." class="img-fluid">
            </div>

        </div>

        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                Reset Password
            </h1>

            <!-- Form -->
            <form method="POST" action="{{ route('password.update') }}" id="password-reset-form">
                @csrf
                <x-recaptcha form="password-reset-form" />

                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email address -->
                <div class="form-group">

                    <!-- Label -->
                    <label for="email">Email Address</label>

                    <!-- Input -->
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <!-- Password -->
                <div class="form-group">

                    <!-- Label -->
                    <label for="password">Password</label>

                    <!-- Input group -->
                    <div class="input-group input-group-merge">

                        <!-- Input -->
                        <input id="password" type="password"
                            class="form-control form-control-appended @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                        <!-- Icon -->
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fe fe-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                </div>

                <!-- Password -->
                <div class="form-group">

                    <!-- Label -->
                    <label for="password_confirmation">Confirm Password</label>

                    <!-- Input -->
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3 g-recaptcha"
                    data-sitekey="{{ config('recaptcha.key') }}" data-callback="onRecaptcha" data-action="preset">
                    Reset Password
                </button>

            </form>


        </div>
    </div>

</x-auth>
