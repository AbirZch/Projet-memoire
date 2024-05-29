  <!-- Navbar -->



  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">

          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('admin.courses.index') }}" class="nav-link">Formation</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('admin.teachers.index') }}" class="nav-link">Enseignants</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('admin.students.index') }}" class="nav-link">Etudiants</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('admin.users.index') }}" class="nav-link">Utilisateurs</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.presence') }}" class="nav-link">Presence</a>
        </li>
      </ul>


  </nav>
  <!-- /.navbar -->
