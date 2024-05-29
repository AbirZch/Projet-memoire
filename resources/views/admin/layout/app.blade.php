<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/adminAssets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminAssets/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="/adminAssets/custom.css">
  <style>
.course-image {
    height: 50px;
    width:auto;
    object-fit:cover;
}
 .btn-sm .btn-info {
        background: var(--primary-color);
        color: var(--secondary);

}
.table td > * {
    margin:5px;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('admin.includes.navbar')
    @include('admin.includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin.includes.alert')
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->


</div>



@include('admin.includes.scripts')
</body>
</html>
