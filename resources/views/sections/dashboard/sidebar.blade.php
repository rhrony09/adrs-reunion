<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset("uploads/logos/$settings->favicon") }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Dashboard</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="menu-label">Dashboard</li>
        <li>
            <a href="{{ route('dashboard.index') }}">
                <div class="parent-icon"><i class="bi bi-columns-gap"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if (in_array(auth()->user()->role->id, [1]))
            <li class="menu-label">Admin Area</li>
            <li>
                <a href="{{ route('dashboard.users') }}">
                    <div class="parent-icon"><i class="bi bi-people"></i>
                    </div>
                    <div class="menu-title">Users</div>
                </a>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-gear"></i>
                    </div>
                    <div class="menu-title">Controll Panel</div>
                </a>
                <ul>
                    <li><a href="{{ route('dashboard.settings.index') }}"><i class="bi bi-circle"></i>Settings</a></li>
                </ul>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</aside>
