<header class="top-header">
    <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
            <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar-right ms-auto">
            <ul class="navbar-nav align-items-center gap-1">
                <li class="nav-item dark-mode d-none d-sm-flex">
                    <a class="nav-link dark-mode-icon" href="javascript:;">
                        <div class="">
                            <i class="bi bi-moon-fill"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item d-sm-flex">
                    <a class="nav-link" href="{{ route('index') }}" target="_blank">
                        <div class="">
                            <i class="bi bi-globe"></i>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
        <div class="dropdown dropdown-user-setting">
            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="user-setting d-flex align-items-center gap-3">
                    <img src="{{ auth()->user()->profile_picture }}" class="user-img" alt="{{ auth()->user()->name }}">
                    <div class="d-none d-sm-block">
                        <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                        <small class="mb-0 dropdown-user-designation">{{ auth()->user()->role->name }}</small>
                    </div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('dashboard.users.profile') }}">
                        <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-person"></i></div>
                            <div class="ms-3"><span>Profile</span></div>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-power"></i></div>
                            <div class="ms-3"><span>Logout</span></div>
                        </div>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
