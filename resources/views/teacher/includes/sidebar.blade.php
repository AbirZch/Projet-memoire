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
        <span class="brand-text font-weight-light">{{ auth()->user()->firstname }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-2 mb-3 d-flex">
            <form action="{{ route('teachers.me.upload') }}" id="profileImageForm" method="post"
                enctype="multipart/form-data">
                @csrf

                <input type="file" id="profileImageInput" name="profile_img" required
                    accept=".jpg, .jpeg, .png, .webp"
                    style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden; position: absolute; z-index: -1;">
                <label for="profileImageInput">
                    <img src={{ auth()->user()->img_url ? asset(auth()->user()->img_url) : '/adminAssets/dist/img/user2-160x160.jpg' }}
                        class="" alt="User Image">
                </label>

            </form>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->firstname }}</a>
            </div>
        </div>
        <script>
            document.getElementById('profileImageInput').addEventListener('change', function() {
                document.getElementById('profileImageForm').submit();
            });
        </script>

    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('teachers.inscriptions') }}" @class([
                            'nav-link',
                            'active' => request()->is('teachers/me/inscriptions*'),
                        ])>
                            <i class="far nav-icon"></i>
                            <p>Spécialities</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teachers.requests') }}" @class([
                            'nav-link',
                            'active' => request()->is('teachers/me/requests*'),
                        ])>
                            <i class="far  nav-icon"></i>
                            <p>Demandes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teachers.students') }}" @class([
                            'nav-link',
                            'active' => request()->is('teachers/me/students*'),
                        ])>
                            <i class="far  nav-icon"></i>
                            <p>Etudiants </p>
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
