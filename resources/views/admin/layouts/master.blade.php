<html lang="en" style="height: auto;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Dashboard</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body class="sidebar-mini layout-fixed" style="height: auto;">
<div class="wrapper">

  @include('admin.layouts.header')

  @include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 894px;">
    
    <!-- Main content -->
    <section class="content">
      <!-- /.container-fluid -->
      <section class="container-fluid">
      @yield('content')
      </section>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  @include('admin.layouts.footer')

<!-- ./wrapper -->

<script src="{{ asset('js/app.js') }}"></script>

@yield('extra_script')

</body></html>