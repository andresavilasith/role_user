<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Inven @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Styles -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="/adminlte/plugins/fonts.css" rel="stylesheet">


</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <img src="{{Auth::user()->get_img}}" class="nav-img" alt="User Image">
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>


          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @can('update',[Auth::user(),['user.edit','userown.edit']])
            <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id) }}">
              Edit profile
            </a>
            @endcan
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-th-large"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
        <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> 
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        @guest
        @else
        @can('view',[Auth::user(),['user.edit','userown.edit']])
        <!-- Sidebar user panel (optional) -->
        <a href="{{ route('user.edit', Auth::user()->id) }}" class="d-block">
          <div class="user-panel mt-2 pb-2 mb-2 d-flex">
            <div class="image mr-2">
              <img src="{{Auth::user()->get_img}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              {{ Auth::user()->name }}

            </div>
          </div>
        </a>
        @endcan
        @endguest

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('haveaccess','user.index')
                <li class="nav-item has-treeview">
                  <a href="{{route('user.index')}}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <p>
                      Users
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('user.index')}}" class="nav-link">
                        <i class="far fa-list-alt"></i>
                        <p>List of users</p>
                      </a>
                    </li>
                  </ul>
                </li>
                @endcan

                @can('haveaccess','role.index')
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fas fa-tasks"></i>
                    <p>
                      Roles
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('role.index')}}" class="nav-link">
                        <i class="far fa-list-alt"></i>
                        <p>List of roles</p>
                      </a>
                    </li>
                    @can('haveaccess','role.create')
                    <li class="nav-item">
                      <a href="{{route('role.create')}}" class="nav-link">
                        <i class="fas fa-plus-circle"></i>
                        <p>Create a role</p>
                      </a>
                    </li>
                    @endcan
                  </ul>
                </li>
                @endcan

                @can('haveaccess','category.index')
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fas fa-object-group"></i>
                    <p>
                      Categories
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('category.index')}}" class="nav-link">
                        <i class="far fa-list-alt"></i>
                        <p>List of categories</p>
                      </a>
                    </li>
                    @can('haveaccess','category.create')
                    <li class="nav-item">
                      <a href="{{route('category.create')}}" class="nav-link">
                        <i class="fas fa-plus-circle"></i>
                        <p>Create a category</p>
                      </a>
                    </li>
                    @endcan
                  </ul>
                </li>
                @endcan

                @can('haveaccess','permission.index')
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fas fa-lock-open"></i>
                    <p>
                      Permissions
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('permission.index')}}" class="nav-link">
                        <i class="far fa-list-alt"></i>
                        <p>List of permissionss</p>
                      </a>
                    </li>
                    @can('haveaccess','permission.create')
                    <li class="nav-item">
                      <a href="{{route('permission.create')}}" class="nav-link">
                        <i class="fas fa-plus-circle"></i>
                        <p>Create a permission</p>
                      </a>
                    </li>
                    @endcan
                  </ul>
                </li>
                @endcan

              </ul>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: auto;">
      <!-- Main content -->
      <section class="content">
        <div class="container">

          @yield('content')


        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
      </div>
      <strong>Copyright &copy; Andres Avila
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- DataTables -->
  <!-- jQuery -->
  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/adminlte/dist/js/demo.js"></script>
  <!-- General JS -->
  <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>