<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                     <li>
                        <a href="{{ route('root') }}" class="waves-effect">
                            <i class="bx bx-home-circle"></i> <!-- Dashboard Icon -->
                            <span key="t-contact">@lang('sidebar.dashboard')</span>
                        </a>
                    </li>
  
                    <li class="{{ request()->routeIs('departements.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('departements.index') }}" class="waves-effect">
                            <i class="bx bxs-building-house"></i> <!-- Department Icon -->
                            <span>@lang('Département')</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('zones.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('zones.index') }}" class="waves-effect">
                            <i class="bx bx-map"></i> <!-- Zone Icon -->
                            <span>@lang('Ma Zones')</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('manage_users.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('manage_users.index') }}" class="waves-effect">
                            <i class="bx bx-group"></i> <!-- Manage Users Icon -->
                            <span>@lang('Manage Users')</span>
                        </a>
                    </li>
                    
                    <li class="{{ request()->routeIs('projects.index') || request()->routeIs('projects.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('projects.index') }}" class="waves-effect">
                            <i class="bx bx-folder-open"></i> <!-- Icône correcte pour les projets -->
                            <span>@lang('Projects')</span>
                        </a>
                    </li>
                    
                    
                     {{-- USER ROUTES  --}}
                    <li>
                        <a href="{{ route('profile') }}" class="waves-effect">
                            <i class="bx bx-user-circle"></i> <!-- Profile Icon -->
                            <span key="t-contact">@lang('sidebar.my_profile')</span>
                        </a>
                    </li>
 
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
