<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('root') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-contact">@lang('sidebar.dashboard')</span>
                    </a>
                </li>

                <!-- Département (Only for Super Admin & Chef de Département) -->
                @can('manage users')
                <li class="{{ request()->routeIs('departements.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('departements.index') }}" class="waves-effect">
                        <i class="bx bxs-building-house"></i>
                        <span>@lang('Département')</span>
                    </a>
                </li>
                @endcan

                <!-- Zones (Only for Super Admin & Chef de Zone) -->
                @can('manage projects')
                <li class="{{ request()->routeIs('zones.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('zones.index') }}" class="waves-effect">
                        <i class="bx bx-map"></i>
                        <span>@lang('Ma Zones')</span>
                    </a>
                </li>
                @endcan

                <!-- Manage Users (Only for Super Admin & Chef de Département) -->
                @can('manage users')
                <li class="{{ request()->routeIs('manage_users.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('manage_users.index') }}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span>@lang('Manage Users')</span>
                    </a>
                </li>
                @endcan

                <!-- Projects (Only for Roles with "manage projects" Permission) -->
                @can('manage projects')
                <li class="{{ request()->routeIs('projects.index') || request()->routeIs('projects.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('projects.index') }}" class="waves-effect">
                        <i class="bx bx-folder-open"></i>
                        <span>@lang('Projects')</span>
                    </a>
                </li>
                @endcan

                <!-- User Profile (Visible to All Users) -->
                <li>
                    <a href="{{ route('profile') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-contact">@lang('sidebar.my_profile')</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
