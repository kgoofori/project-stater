@props(['form'])
<div>
    @error('recaptchaToken')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>

            <!-- Button -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

        </div>
    @enderror
    <input type="hidden" name="recaptchaToken" id="recaptchaToken" data-form="{{ $form }}" value="x">

</div>
