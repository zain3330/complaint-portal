<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link d-flex justify-content-center align-items-center">
        <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


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

                <!-- Complaints -->
                <li class="nav-item">
                    <a href="{{ route('complaints.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i> <!-- Icon for complaints -->
                        <p>
                            Complaints
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>

                <!-- Roles -->
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i> <!-- Icon for roles -->
                        <p>
                            Roles
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>

                <!-- Departments -->
                <li class="nav-item">
                    <a href="{{ route('department.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i> <!-- Icon for departments -->
                        <p>
                            Departments
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>

                <!-- Users -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i> <!-- Icon for users -->
                        <p>
                            Users
                            <i class="right fas"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>



        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
