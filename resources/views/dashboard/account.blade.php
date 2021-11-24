<x-dashboard>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    Overview
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    Account
                                </h1>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>


                <div class="row justify-content-between align-items-center mb-5">
                    <div class="col-12 col-md-9 col-xl-7">

                        <!-- Heading -->
                        <h2 class="mb-2">
                            Change your password
                        </h2>

                        <!-- Text -->
                        <p class="text-muted mb-xl-0">
                            We will email you a confirmation when changing your password, so please expect that email
                            after submitting.
                        </p>

                    </div>
                    <div class="col-12 col-xl-auto">
                        @if (session('status'))
                            <div class="alert alert-success mb-5" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}" id="password-email-form">
                            @csrf
                            <x-recaptcha form="password-email-form" />
                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                            <!-- Button -->
                            <button class="btn btn-white" data-sitekey="{{ config('recaptcha.key') }}"
                                data-callback="onRecaptcha" data-action="pemail">
                                Forgot your password?
                            </button>
                        </form>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 order-md-2">

                        <!-- Card -->
                        <div class="card bg-light border ml-md-4">
                            <div class="card-body">

                                <!-- Text -->
                                <p class="mb-2">
                                    Password requirements
                                </p>

                                <!-- Text -->
                                <p class="small text-muted mb-2">
                                    To create a strong password, you have to meet all of the following requirements:
                                </p>

                                <!-- List group -->
                                <ul class="small text-muted pl-4 mb-0">
                                    <li>
                                        Minimum 8 character
                                    </li>
                                    <li>
                                        At least one special character
                                    </li>
                                    <li>
                                        At least one number
                                    </li>
                                    <li>
                                        Can’t be the same as a previous password
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6">

                        <!-- Form -->
                        @if (session('reset_success'))
                            <div class="alert alert-success mb-5" role="alert">
                                {{ session('reset_success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ url('account/change-password') }}">
                            @csrf
                            <div class="form-group">

                                <!-- Label -->
                                <label for="password">Current Password</label>

                                <!-- Input group -->
                                <div class="input-group input-group-merge">

                                    <!-- Input -->
                                    <input id="current_password" type="password"
                                        class="form-control form-control-appended @error('current_password') is-invalid @enderror"
                                        name="current_password" required autocomplete="new-current_password">
                                    <!-- Icon -->
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fe fe-eye"></i>
                                        </span>
                                    </div>

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="form-group">

                                <!-- Label -->
                                <label for="password">New Password</label>

                                <!-- Input group -->
                                <div class="input-group input-group-merge">

                                    <!-- Input -->
                                    <input id="new_password" type="password"
                                        class="form-control form-control-appended @error('new_password') is-invalid @enderror"
                                        name="new_password" required autocomplete="new-password">
                                    <!-- Icon -->
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fe fe-eye"></i>
                                        </span>
                                    </div>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <!-- Password -->
                            <div class="form-group">

                                <!-- Label -->
                                <label for="new_password_confirmation">Confirm Password</label>

                                <!-- Input -->
                                <input id="new_password_confirmation" type="password" class="form-control"
                                    name="new_password_confirmation" required autocomplete="new-password">
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block btn-primary lift" type="submit">
                                Update password
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
