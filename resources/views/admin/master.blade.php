<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.layouts.head')
    @yield('head_last_add','')
</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

  @include('admin.layouts.header')

  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		@yield('content')
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
   @include('admin.layouts.footer')

  <!-- Control Sidebar -->
  @include('admin.layouts.control_sidebar')
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->


	<!-- Vendor JS -->
    @include('admin.layouts.body_last_js')
    @yield('body_last_add_js','')

</body>
</html>
