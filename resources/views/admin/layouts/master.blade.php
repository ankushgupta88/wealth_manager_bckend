

@include('admin.layouts.head')
<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
   <!-- Preloader -->
   <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('public/admin/dist/img/AdminLTELogo.png') }}" alt="Wait.." height="60" width="60">
   </div>
   <!-- Navbar -->
   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
         <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('admin/dashboard') }}" class="nav-link">Dashboard</a>
         </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->
         <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
               <form class="form-inline">
                  <div class="input-group input-group-sm">
                     <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                     <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                        <i class="fas fa-times"></i>
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </li>
         <!-- Messages Dropdown Menu -->
         <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
               {{ csrf_field() }} 
            </form>
         </li>
         <!-- Notifications Dropdown Menu -->
      </ul>
   </nav>
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('admin/dashboard') }}" class="brand-link">
      <img src="{{ asset('public/admin/dist/img/AdminLTELogo.png') }} " alt="Wealth Manager Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Wealth Manager Admin</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
         <!-- Sidebar Menu -->
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
               <li class="nav-item {{ request()->is('admin/dashboard') ? 'menu-open active' : '' }}">
                  <a href="{{ url('admin/dashboard') }}" class="nav-link">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                        Dashboard
                     </p>
                  </a>
               </li>
               <li class="nav-item {{ request()->is('admin/add-member') || request()->is('admin/search-member') || request()->is('admin/import-member') ? 'menu-open active' : '' }}">
                  <a href="#" class="nav-link">
                     <i class="fas fa-users"></i>
                     <p>
                        My Members
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/add-member')}}" class="nav-link {{ request()->is('admin/add-member') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Add Member</p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/search-member')}}" class="nav-link {{ request()->is('admin/search-member') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Search Members</p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{ url('admin/import-member') }}" class="nav-link {{ request()->is('admin/import-member') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p> Import Members</p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="#" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>  Members Categories</p>
                        </a>
                     </li>
                  </ul>
               </li> 
                <li class="nav-item {{ request()->is('admin/member-add-service') || request()->is('admin/member-all-service') ? 'menu-open active' : '' }}">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-columns"></i>
                     <p>
                        Member Services
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/member-add-service')}}" class="nav-link {{ request()->is('admin/member-add-service') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Add Service</p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/member-all-service')}}" class="nav-link {{ request()->is('admin/member-all-service') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>All Services</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item {{ request()->is('admin/add-firm') || request()->is('admin/all-firm-list') || request()->is('admin/firm-allow-member') || request()->is('admin/manage-member-list') ? 'menu-open active' : '' }}">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-copy"></i>
                     <p>   
                        Firms 
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/add-firm')}}" class="nav-link {{ request()->is('admin/add-firm') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Add Firm</p> 
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/all-firm-list')}}" class="nav-link {{ request()->is('admin/all-firm-list') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>All Firm List</p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/firm-allow-member')}}" class="nav-link {{ request()->is('admin/firm-allow-member') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Firm Allow Member</p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/manage-member-list')}}" class="nav-link {{ request()->is('admin/manage-member-list') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Manage Member List</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item {{ request()->is('admin/firm-add-service') || request()->is('admin/firm-all-service') ? 'menu-open active' : '' }}">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-columns"></i>
                     <p>
                        Firm Services
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/firm-add-service')}}" class="nav-link {{ request()->is('admin/firm-add-service') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Add Service</p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/firm-all-service')}}" class="nav-link {{ request()->is('admin/firm-all-service') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>All Services</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <!--plan-->
               <li class="nav-item {{ request()->is('admin/add-plan') || request()->is('admin/all-plan-list') ? 'menu-open active' : '' }}">
                  <a href="#" class="nav-link">
                     <i class="nav-icon far fa-plus-square"></i>
                     <p> Plans
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item"> 
                        <a href="{{url('admin/add-plan')}}" class="nav-link {{ request()->is('admin/add-plan') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p> Add Plan </p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/all-plan-list')}}" class="nav-link {{ request()->is('admin/all-plan-list') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>All Plan</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item {{ request()->is('admin/add-city') || request()->is('admin/all-city-list') ? 'menu-open active' : '' }}">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-copy"></i>
                     <p>
                        Cities
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/add-city')}}" class="nav-link {{ request()->is('admin/add-city') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p> Add City </p>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="{{url('admin/all-city-list')}}" class="nav-link {{ request()->is('admin/all-city-list') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>All Cities</p>
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </nav>
         <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
   </aside>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper ">
      <!-- Content Header (Page header) -->
      <div class="">
         <!--content-header-->
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <!--<h1 class="m-0">Dashboard</h1>-->
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      @yield('content')
      <footer class="main-footer ">
         <strong>Copyright &copy; 2020-2021 <a href="#">wealthmanager.com</a>.</strong>All rights reserved.
      </footer>
   </div>
   <!-- ./wrapper -->
   <!-- jQuery -->
   <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
   <!-- jQuery UI 1.11.4 -->
   <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>
      $.widget.bridge('uibutton', $.ui.button)
   </script>
   <!-- Bootstrap 4 -->
   <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- ChartJS -->
   <script src="{{ asset('public/admin/plugins/chart.js/Chart.min.js') }}"></script>
   <!-- Sparkline -->
   <script src="{{ asset('public/admin/plugins/sparklines/sparkline.js') }}"></script>
   <!-- JQVMap -->
   <script src="{{ asset('public/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
   <!-- jQuery Knob Chart -->
   <script src="{{ asset('public/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
   <!-- daterangepicker -->
   <script src="{{ asset('public/admin/plugins/moment/moment.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
   <!-- Tempusdominus Bootstrap 4 -->
   <script src="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
   <!-- Summernote -->
   <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
   <!-- overlayScrollbars -->
   <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
   <!-- bootstrap color picker -->
   <script src="{{ asset('public/admin/plugins//bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="{{ asset('public/admin/dist/js/pages/dashboard.js') }}"></script>
   <script>
      $(function () {
        // Page Desc
        $('#page_description').summernote()
        // Page Short desc
        $('#page_short_desc').summernote()
        $('.description').summernote()
      })
   </script>
   <!-- DataTables  & Plugins -->
   <script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/jszip/jszip.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
   <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $("#example2").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        $("#customDataTable").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
   </script>

   <!-- Page specific script -->
   <script>
      $(function () {
         //Colorpicker
         $('.my-colorpicker1').colorpicker()
         //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        $('#reservationdate2').datetimepicker({
            format: 'L'
        });
        $('#start_time').datetimepicker({
            format: 'HH:mm a'
        });
        $('#end_time').datetimepicker({
            format: 'HH:mm a'
        });
        
      });
   </script>
</body>
</html>