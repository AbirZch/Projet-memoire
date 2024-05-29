<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        background-color: cadetblue;
        padding: 20px;
        box-sizing: border-box;
    }

    .sidebar h3 {
        margin-top: 0;
    }

    .sidebar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .sidebar li {
        margin-bottom: 10px;
    }


    .sidebar a {
        display: block;
        padding: 5px 10px;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
    }

    .sidebar a:hover {
        background-color: #3498DB;
        color: white;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/adminAssets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/adminAssets/dist/img/user2-160x160.jpg" class="" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>
        {{-- @php
$activatedRoute=""
  if (Request::is('admin/courses/*'))
  {
    $activatedRoute="courses"

  }
  else if (Request::is("admin/teachers/*"))
  {
    $activatedRoute="teachers"

  }
  else if (Request::is("admin/students/*"))
  {
    $activatedRoute="students"

  }
@endphp --}}
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Resources
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.index') }}" @class(['nav-link', 'active' => request()->is('admin/courses*')])>
                                <i class="far nav-icon"></i>
                                <p>Formations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.teachers.index') }}" @class(['nav-link', 'active' => request()->is('admin/teachers*')])>
                                <i class="far  nav-icon"></i>
                                <p>profs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.students.index') }}" @class(['nav-link', 'active' => request()->is('admin/students*')])>
                                <i class="far  nav-icon"></i>
                                <p>étudients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" @class(['nav-link', 'active' => request()->is('admin/users*')])>
                                <i class="far  nav-icon"></i>
                                <p>utilisateurs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.presence') }}" @class(['nav-link', 'active' => request()->is('admin/presence*')])>
                                <i class="far  nav-icon"></i>
                                <p>inscriptions presentiel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" value="se déconnecter" class="nav-link">
                                <i class="far  nav-icon"></i>

                            </form>

                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
