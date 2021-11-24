<!-- NAVIGATION
================================================== -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="/">
            <img src="/assets/img/logo.svg" class="navbar-brand-img 
        mx-auto" alt="...">
        </a>

        <!-- User (xs) -->
        @include('partials.user-nav')

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarDashboards" data-toggle="collapse" role="button"
                        aria-controls="sidebarDashboards">
                        <i class="fe fe-home"></i> Dashboard
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{url('/dashboard')}}" class="nav-link">
                                    Home
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <hr class="navbar-divider my-3">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/invitations')}}">
                        <i class="fe fe-user-plus"></i> Invitations
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/account')}}">
                        <i class="fe fe-grid"></i> My Account
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link" href="#sidebarModalActivity" data-toggle="modal">
                        <span class="fe fe-bell"></span> Notifications
                    </a>
                </li>
            </ul>




            <!-- Push content down -->
            <div class="mt-auto"></div>


            <!-- Customize -->
            {{-- <div id="popoverDemo">
            <a href="#modalDemo" class="btn btn-block btn-primary mb-4" data-toggle="modal">
                <i class="fe fe-sliders mr-2"></i> Customize
            </a>
        </div> --}}

        </div> <!-- / .navbar-collapse -->

    </div>
</nav>
