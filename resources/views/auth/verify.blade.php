<x-auth>

<div class="row justify-content-center">
    <div class="col-12 col-md-5 col-xl-4 my-5">
    
    <!-- Heading -->
    <h1 class="display-4 text-center mb-3">
    Verify Your Email Address
    </h1>
    
    <!-- Subheading -->
    <p class="text-muted text-center mb-5">
    @if (session('resent'))
        <div class="alert alert-success mb-3" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    </p>
    
    <!-- Form -->
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <!-- Submit -->
        <button class="btn btn-lg btn-block btn-primary mb-3">
        Resend Link
        </button>
        
    </form>

    </div>
</div> <!-- / .row -->

</x-auth>

