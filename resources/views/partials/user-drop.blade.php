<!-- Dropdown -->
<div class="dropdown">
    <!-- Toggle -->
    <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-sm avatar-online">
        <span class="avatar-title rounded-circle">{{auth()->user()->initials}}</span>
        </div>

    </a>

    <!-- Menu -->
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
        <a href="/" class="dropdown-item">My Dashboard</a>
        <a href="/account" class="dropdown-item">My Account</a>
        <hr class="dropdown-divider">
        <a href="#logout" class="dropdown-item" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">Logout</a>
    </div>
</div>