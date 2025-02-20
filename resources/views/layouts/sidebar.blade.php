<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <!-- 🔹 Dashboard (Accessible à Tous) -->
                <li class="{{ request()->routeIs('root') ? 'mm-active' : '' }}">
                    <a href="{{ route('root') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>@lang('sidebar.dashboard')</span>
                    </a>
                </li>

                <!-- 🔹 Département (Super Admin & Chef de Département) -->
                @hasanyrole('Super Admin|Chef de Département')
                <li class="{{ request()->routeIs('departements.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('departements.index') }}" class="waves-effect">
                        <i class="bx bxs-building-house"></i>
                        <span>@lang('Département')</span>
                    </a>
                </li>
                @endhasanyrole

                <!-- 🔹 Zones (Super Admin & Chef de Zone) -->
                @hasanyrole('Super Admin|Chef de Zone')
                <li class="{{ request()->routeIs('zones.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('zones.index') }}" class="waves-effect">
                        <i class="bx bx-map"></i>
                        <span>@lang('Ma Zones')</span>
                    </a>
                </li>
                @endhasanyrole

                <!-- 🔹 Gestion des Utilisateurs (Super Admin & Chef de Département) -->
                @hasanyrole('Super Admin|Chef de Département')
                <li class="{{ request()->routeIs('manage_users.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('manage_users.index') }}" class="waves-effect">
                        <i class="bx bx-group"></i>
                        <span>@lang('Manage Users')</span>
                    </a>
                </li>
                @endhasanyrole

                <!-- 🔹 Projets (Super Admin, Chef de Projet, Chef de Zone) -->
                @hasanyrole('Super Admin|Chef de Projet|Chef de Zone')
                <li class="{{ request()->routeIs('projects.index') || request()->routeIs('projects.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('projects.index') }}" class="waves-effect">
                        <i class="bx bx-folder-open"></i>
                        <span>@lang('Projects')</span>
                    </a>
                </li>
                @endhasanyrole

                <!-- 🔹 Profil (Accessible à Tous) -->
                <li class="{{ request()->routeIs('profile') ? 'mm-active' : '' }}">
                    <a href="{{ route('profile') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span>@lang('sidebar.my_profile')</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
