<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : ''}}">
            <a class="nav-link " href="{{route('admin.dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-menu-button-wide"></i><span>Contacts</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse {{(Route::is('clients.index') || Route::is('booking-types.index')) ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Route::is('clients.index') ? 'active' : ''}}" href="{{route('clients.index')}}">
                        <i class="ri-group-fill"></i>
                        <span>Clients</span>
                    </a>
                </li>

                
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-menu-button-wide"></i><span>System</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav2" class="nav-content collapse {{(Route::is('dispute-letters.index') || Route::is('report-sources.index') || Route::is('bureau-address.index') || Route::is('instructions.index')) ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Route::is('dispute-letters.index') ? 'active' : ''}}" href="{{route('dispute-letters.index')}}">
                        <i class="ri-group-fill"></i>
                        <span>Dispute Letter</span>
                    </a>
                </li>

                <li>
                    <a class="{{ Route::is('report-sources.index') ? 'active' : ''}}" href="{{route('report-sources.index')}}">
                        <i class="ri-group-fill"></i>
                        <span>Report Source</span>
                    </a>
                </li>

                <li>
                    <a class="{{ Route::is('bureau-address.index') ? 'active' : ''}}" href="{{route('bureau-address.index')}}">
                        <i class="ri-group-fill"></i>
                        <span>Bureau Address</span>
                    </a>
                </li>

                <li>
                    <a class="{{ Route::is('instructions.index') ? 'active' : ''}}" href="{{route('instructions.index')}}">
                        <i class="ri-group-fill"></i>
                        <span>Instructions</span>
                    </a>
                </li>


                
            </ul>

        </li>

        {{-- <li class="nav-item ">
            <a class="nav-link " href="#">
                <i class="ri-group-fill"></i>
                <span>Remunaration</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link " href="#">
                <i class="ri-group-fill"></i>
                <span>Event Mgmt</span>
            </a>
        </li> --}}
        

    </ul>

</aside>