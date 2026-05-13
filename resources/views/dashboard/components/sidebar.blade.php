<ul
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar"
>
    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route('dashboard') }}"
    >
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-truck"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HAULING <sup>app</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    @role('Developer|Owner')

    <!-- Heading -->
    <div class="sidebar-heading">Master Data</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Menu Mitra -->
    <li class="nav-item {{ Request::routeIs('dashboard.owners*') || Request::routeIs('dashboard.partners*') ? 'active' : '' }}">
        <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseOne"
            aria-expanded="{{ Request::routeIs('dashboard.owners*') || Request::routeIs('dashboard.partners*') ? 'true' : 'false' }}"
            aria-controls="collapseOne"
        >
            <i class="fas fa-building"></i>
            <span>Menu Mitra Kerja</span>
        </a>

        <div
            id="collapseOne"
            class="collapse {{ Request::routeIs('dashboard.owners*') || Request::routeIs('dashboard.partners*') ? 'show' : '' }}"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Menu:</h6>

                <a
                    class="collapse-item {{ Request::routeIs('dashboard.owners*') ? 'active' : '' }}"
                    href="{{ route('dashboard.owners.index') }}"
                >
                    Data Owner
                </a>

                <a
                    class="collapse-item {{ Request::routeIs('dashboard.partners*') ? 'active' : '' }}"
                    href="{{ route('dashboard.partners.index') }}"
                >
                    List Mitra Kerja
                </a>

                @role('Developer')
                <a
                    class="collapse-item {{ Request::routeIs('dashboard.partners-trash*') ? 'active' : '' }}"
                    href="{{ route('dashboard.partners-trash.index') }}"
                >
                    List Mitra (Sampah)
                </a>
                @endrole

            </div>
        </div>
    </li>

    <hr class="sidebar-divider" />

    <div class="sidebar-heading">Data Admin</div>

    <!-- Rute Hauling -->
    <li class="nav-item {{ Request::routeIs('dashboard.tracks*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.tracks.index') }}">
            <i class="fas fa-route"></i>
            <span>Rute Hauling</span>
        </a>
    </li>

    <!-- Periode -->
    <li class="nav-item {{ Request::routeIs('dashboard.periods*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.periods.index') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Periode</span>
        </a>
    </li>

    <hr class="sidebar-divider" />
    @endrole

    <div class="sidebar-heading">Menu Data</div>

    <!-- Haul -->
    <li class="nav-item {{ Request::routeIs('dashboard.hauls.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.hauls.index') }}">
            <i class="fas fa-truck"></i>
            <span>Data Hauling</span>
        </a>
    </li>

    <!-- Create Data Hauling -->
    <li class="nav-item {{ Request::routeIs('dashboard.hauls.create*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.hauls.create') }}">
            <i class="fas fa-plus"></i>
            <span>Upload Data Hauling</span>
        </a>
    </li>

    <hr class="sidebar-divider" />

    @role('Developer|Owner')
    <div class="sidebar-heading">Menu Admin</div>

    <!-- Role -->
    <li class="nav-item {{ Request::routeIs('dashboard.roles*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.roles.index') }}">
            <i class="fas fa-user-shield"></i>
            <span>Role</span>
        </a>
    </li>

    <!-- Users -->
    <li class="nav-item {{ Request::routeIs('dashboard.users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.users.index') }}">
            <i class="fas fa-users-cog"></i>
            <span>Users</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />
    @endrole
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
