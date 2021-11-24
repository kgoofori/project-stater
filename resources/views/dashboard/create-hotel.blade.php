<x-dashboard>
<div class="container-fluid">
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8">

        <!-- Header -->
        <div class="header">
            <div class="header-body">
            <div class="row align-items-center">
                <div class="col">

                <!-- Pretitle -->
                <h6 class="header-pretitle">
                    New Hotel
                </h6>

                <!-- Title -->
                <h1 class="header-title">
                    Create a New Hotel
                </h1>

                </div>
            </div> <!-- / .row -->
            </div>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ url('hotels') }}" class="mb-4">
            @csrf

            <!-- Hotel name -->
            <div class="form-group">

                <!-- Label  -->
                <label for="name">
                    Hotel Name
                </label>

                <!-- Input -->
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="company" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <!-- Hotel description -->
            <div class="form-group">

                <!-- Label -->
                <label class="mb-1">
                Hotel's Description
                </label>

                <!-- Text -->
                <small class="form-text text-muted">
                    A short description about your hotel
                </small>

                <!-- Textarea -->
                <textarea name="description" class="form-control" id="description" cols="30" rows="3" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Hotel name -->
            <div class="form-group">

                <!-- Label  -->
                <label for="website">
                    Website
                </label>

                <!-- Input -->
                <input id="website" placeholder="http://website.com" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website">

                @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">

                    <!-- Label -->
                    <label>
                        Category
                    </label>

                    <!-- Select -->
                    <select class="form-control custom-select" name="category_id" required>
                        <option value=""></option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <span class="invalid-feedback" role="alert" style="display: block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                </div>
            </div>

            

            <div class="row">
                <div class="col-12 col-md-6">

                    <!-- Start Phone -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>
                        Primary Phone
                        </label>

                        <!-- Input -->
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" >

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                </div>
                <div class="col-12 col-md-6">

                    <!-- Start Email -->
                    <div class="form-group">

                    <!-- Label -->
                    <label>
                    Primary Email
                    </label>

                    <!-- Input -->
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                </div>
            </div> <!-- / .row -->

            <div class="row">
                <div class="col-12 col-md-6">

                    <!-- Start Location -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>
                        Hotel Location
                        </label>

                        <!-- Input -->
                        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="address" >

                        @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                </div>
                <div class="col-12 col-md-6">

                    <!-- Start City -->
                    <div class="form-group">

                    <!-- Label -->
                    <label>
                    City
                    </label>

                    <!-- Input -->
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" >

                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                </div>
            </div> <!-- / .row -->

            <div class="row">
                <div class="col-12 col-md-6">

                    <!-- Start Region -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>
                        Region
                        </label>

                        <!-- Input -->
                        <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region" value="{{ old('region') }}" required autocomplete="region" >

                        @error('region')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                </div>
                <div class="col-12 col-md-6">

                    <!-- Start Country -->
                    <div class="form-group">

                    <!-- Label -->
                    <label>
                    Country
                    </label>

                    <!-- Input -->
                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" >

                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                </div>
            </div> <!-- / .row -->

            <!-- Divider -->
            <hr class="mt-3 mb-3">

            <div class="row">
            <div class="col-1">
                <div class="form-group">
                    <!-- Switch -->
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" value="1" name="agreed_to_terms" required id="aggreeSwitch">
                    <label class="custom-control-label" for="aggreeSwitch"></label>
                </div>

                </div>
            </div>
            <div class="col-11">

                <!-- Terms and Condition -->
                <div class="form-group">

                <!-- Label -->
                <label class="mb-1" for="aggreeSwitch">
                    Terms and Conditions
                </label>

                <!-- Text -->
                <small class="form-text text-muted">
                    Agree to our terms and conditions before you create your hotel. You can find the full document <a href="#!">here</a>

                </small>

                @error('agreed_to_terms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                
                </div>

            </div>
            </div> <!-- / .row -->

            <!-- Divider -->
            <hr class="mt-3 mb-3">

            <!-- Buttons -->
            <button class="btn btn-lg btn-block btn-primary mb-3">
                Create Hotel
            </button>

            <a href=" {{ url('/dashboard')}} " class="btn btn-block btn-link text-muted">
            Cancel
            </a>

        </form>

    </div>
</div>
</div>
</x-dashboard>