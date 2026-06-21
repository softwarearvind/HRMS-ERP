<div class="topbar d-flex justify-content-between align-items-center">
   <h4 class="mb-0">
    Welcome, {{ Auth::user()->name }}
    ({{ Auth::user()->getRoleNames()->first() }})
</h4>

<p class="text-muted mb-0">
    {{ now()->format('d M Y, h:i A') }}
</p>
    <div class="d-flex align-items-center">

        <!-- Notification -->
        <i class="fa fa-bell me-4 fs-5"></i>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown" aria-expanded="false">

                <img src="https://via.placeholder.com/40"
                     class="rounded-circle me-2"
                     width="40" height="40">

                <span class="fw-semibold">
                    {{ Auth::user()->name }}
                </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fa fa-user me-2"></i> Profile
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-cog me-2"></i> Settings
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</div>
