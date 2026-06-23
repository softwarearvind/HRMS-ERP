<div class="topbar d-flex justify-content-between align-items-center">

    <!-- LEFT SIDE -->
    <div>
        <h4 class="mb-0">
            Welcome, {{ Auth::user()->name }}
            ({{ Auth::user()->getRoleNames()->first() }})
        </h4>

        <p class="mb-0 text-muted">
            {{ now()->format('d M Y, h:i A') }}
        </p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="gap-3 d-flex align-items-center">

        <!-- NOTIFICATION BELL -->
        <div class="dropdown">

            <a class="text-dark position-relative"
               href="#"
               data-bs-toggle="dropdown">

                <i class="fa fa-bell fa-lg"></i>

                <span class="top-0 badge bg-danger position-absolute start-100 translate-middle">
                    {{ $notifCount ?? 0 }}
                </span>

            </a>

            <ul class="shadow dropdown-menu dropdown-menu-end"
                style="width:300px; max-height:300px; overflow:auto;">

                @forelse($notifList as $n)

                    <li class="p-2 border-bottom">
                        <b>{{ $n->title }}</b><br>
                        <small class="text-muted">{{ $n->message }}</small>
                    </li>

                @empty

                    <li class="p-2 text-center text-muted">
                        No Notifications
                    </li>

                @endforelse

            </ul>
        </div>

        <!-- ➕ CREATE MEETING -->
        <a href="#" class="btn btn-primary btn-sm">
            <i class="fa fa-video me-2"></i> Join Meeting
        </a>

        <!-- USER DROPDOWN -->
        <div class="dropdown">

            <a href="#"
               class="d-flex align-items-center text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown">

                <img src="https://via.placeholder.com/40"
                     class="rounded-circle me-2"
                     width="40" height="40">

                <span class="fw-semibold">
                    {{ Auth::user()->name }}
                </span>
            </a>

            <ul class="shadow dropdown-menu dropdown-menu-end">

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
                            <i class="fa fa-sign-out me-2"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>

    </div>
</div>
