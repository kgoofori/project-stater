<!-- top bar -->
<nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
    <div class="container-fluid">

        <!-- Form -->
        <form class="form-inline mr-4 d-none d-md-flex">
        </form>

        <!-- User -->
        <div class="navbar-user">

            <!-- Dropdown -->
            <div class="dropdown mr-4 d-none d-md-flex">

                <!-- Toggle -->
                <a href="index.html#" class="navbar-user-link" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="icon active">
                        <i class="fe fe-bell"></i>
                    </span>
                </a>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
                    <div class="card-header">

                        <!-- Title -->
                        <h5 class="card-header-title">
                            Notifications
                        </h5>

                        <!-- Link -->
                        <a href="#!" class="small">
                            View all
                        </a>

                    </div> <!-- / .card-header -->
                    <div class="card-body">

                        <!-- List group -->
                        <div class="list-group list-group-flush list-group-activity my-n3">
                            <a class="list-group-item text-reset" href="#!">
                                <div class="row">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-title rounded-circle">{{auth()->user()->initials}}</span>
                                        </div>

                                    </div>
                                    <div class="col ml-n2">

                                        <!-- Content -->
                                        <div class="small">
                                          Welcome, <strong>{{auth()->user()->name}}</strong>
                                        </div>

                                        <!-- Time -->
                                        <small class="text-muted">
                                            --
                                        </small>

                                    </div>
                                </div> <!-- / .row -->
                            </a>
                        </div>
                    </div>
                </div> <!-- / .dropdown-menu -->
            </div>

            <!-- Dropdown -->
            @include('partials.user-drop')

        </div>

    </div>
</nav>
