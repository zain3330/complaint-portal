<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link d-flex justify-content-center align-items-center">
{{--        <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block">Alexander Pierce</a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- SidebarSearch Form -->
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas "></i>
                        </p>
                    </a>
                </li>

{{--                <!-- Jobs -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-briefcase"></i>--}}
{{--                        <p>--}}
{{--                            Jobs--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('jobs.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('jobs.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Job List</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <!-- Applied Jobs -->
                <li class="nav-item">
                    <a href="{{ route('complaints.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i> <!-- Changed icon class here -->
                        <p>
                            Complaints
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>
                <!-- Roles -->
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i> <!-- Changed icon class here -->
                        <p>
                            Roles
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>
                <!-- Department -->
                <li class="nav-item">
                    <a href="{{ route('department.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i> <!-- Changed icon class here -->
                        <p>
                            Departments
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>
                <!-- users -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i> <!-- Changed icon class here -->
                        <p>
                            Users
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>

                {{--                <!-- Categories -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-tags"></i>--}}
{{--                        <p>--}}
{{--                            Categories--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('categories.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('categories.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Category List</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}

{{--                    </ul>--}}
{{--                </li>--}}

{{--                <!-- Locations -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-map-marker-alt"></i>--}}
{{--                        <p>--}}
{{--                            Locations--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('locations.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('locations.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Location List</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}

{{--                    </ul>--}}
{{--                </li>--}}

{{--                <!-- Users -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-users"></i>--}}
{{--                        <p>--}}
{{--                            Users--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('users.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('users.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Users</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <!-- Manage Permissions -->--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-user-shield"></i>--}}
{{--                        <p>--}}
{{--                            Manage Permissions--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('role.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('role.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Role</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('permission.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('permission.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Permission</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('permission-role.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('permission-role.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Permission Role</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @if(auth()->user()->hasPermissionToRoute('permission-route.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('permission-route.index') }}" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Permission Route</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </nav>



        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
