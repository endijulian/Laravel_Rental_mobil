<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

@yield('title')

  <!-- Custom fonts for this template-->
  <link href="{{ asset ('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">BAIDAN CAR</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href={{ url('/admin/dashboard')}}>
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard </span></a>
        </li>
      
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Interface
        </div>

        @can('produk_show')
            <li class="nav-item">
                <a class="nav-link" href={{ url('/admin/produk')}}>
                <i class="fas fa-fw fa-table"></i>
                <span>Data Mobil </span></a>
            </li>
        @endcan

        @can('pelanggan_show')
        <li class="nav-item">
            <a class="nav-link" href={{ url('/admin/pelanggan')}}>
            <i class="fas fa-fw fa-table"></i>
            <span>Data Pelanggan </span></a>
        </li>
        @endcan

        @can('transaksi_show')
                <li class="nav-item">
                    <a class="nav-link" href={{ url('/admin/form-transaksi')}}>
                    <i class="fas fa-fw fa-table"></i>
                    <span>Form Transaksi </span></a>
                </li>
        @endcan

        @can('transaksi_show')
        <li class="nav-item">
            <a class="nav-link" href={{ url('/admin/transaksi')}}>
            <i class="fas fa-fw fa-table"></i>
            <span> Transaksi </span></a>
        </li>
        @endcan
      
        @can('laporan_show')
            <li class="nav-item">
                <a class="nav-link" href={{ url('/admin/laporan')}}>
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Laporan </span></a>
            </li>
        @endcan


        @can('user_show')
                <li class="nav-item">
                    <a class="nav-link" href={{ url('/admin/user')}}>
                    <i class="fas fa-fw fa-table"></i>
                    <span>Manajemen User</span></a>
                </li>
        @endcan

        @can('role_show')
        <li class="nav-item">
                <a class="nav-link" href={{ url('/admin/role')}}>
                <i class="fas fa-fw fa-table"></i>
                <span>Manajemen Role</span></a>
        </li>
        @endcan

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>



    <div id="content-wrapper" class="d-flex flex-column">


      <div id="content">


        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>


          <ul class="navbar-nav ml-auto">


            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>

              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>


            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name}}</span>
                {{--  <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">  --}}
                <i class="fas fa-laugh-wink"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ url('admin/profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="{{ url('admin/setting')}}">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout')}}"  onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <form action="{{ route('logout')}}" method="POST" id="form-logout" display="none">
                    @csrf
                </form>
              </div>
            </li>

          </ul>

        </nav>



        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>Copyright &copy; Your Website {{\Carbon\Carbon::now()->format('Y')}}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset ('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset ('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset ('assets/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset ('assets/vendor/chart.js/Chart.min.js') }}"></script>
  {{-- <script src="{{ asset ('assets/js/demo/chart-area-demo.js') }}"></script> --}}
  {{-- <script src="{{ asset ('assets/js/demo/chart-pie-demo.js') }}"></script> --}}

  @yield('js')

</body>

</html>
