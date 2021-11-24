<div class="header mt-md-5">
    <div class="header-body">
      <div class="row align-items-center">
        <div class="col">

          <!-- Pretitle -->
          <h6 class="header-pretitle">
            Settings
          </h6>

          <!-- Title -->
          <h1 class="header-title">
            General Settings
          </h1>

        </div>
      </div> <!-- / .row -->
      <div class="row align-items-center">
        <div class="col">

          <!-- Nav -->
          <ul class="nav nav-tabs nav-overflow header-tabs">
            <li class="nav-item">
              <a href="{{ $myHotel->path('settings/general')}}" class="nav-link">
                General
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ $myHotel->path('settings/users')}}" class="nav-link">
                Users
              </a>
            </li>
            <li class="nav-item">
                <a href="{{ $myHotel->path('settings/subscription')}}" class="nav-link">
                  Suscriptions
                </a>
              </li>
          </ul>

        </div>
      </div>
    </div>
  </div>