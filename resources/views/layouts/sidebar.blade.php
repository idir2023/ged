<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                @admin
                    <li>
                        <a href="{{ route('root') }}" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span key="t-contact">@lang('sidebar.dashboard')</span>
                        </a>
                    </li>
                
                
                  
              
                                 
                    
                    <li class="{{ request()->routeIs('contact.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('contact.index') }}" class="waves-effect">
                            <i class="bx bx-envelope"></i>
                            <span>@lang('Departement')</span>
                        </a>
                    </li>  
                 
                    
                @else
                    {{-- USER ROUTES  --}}
                    <li>
                        <a href="{{ route('profile') }}" class="waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-contact">@lang('sidebar.my_profile')</span>
                        </a>
                    </li>

                
                @endadmin

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
