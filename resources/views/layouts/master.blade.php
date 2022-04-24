<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="dropdown-item">
                            <i class="fas fa-power-off mr-2"></i> &nbsp;Logout
                            <span class="float-right text-muted text-sm"></span>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>&nbsp; My Profile
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('change.password') }} " class="dropdown-item">
                            <i class="fas fa-key mr-2"></i>&nbsp; Reset password
                            <span class="float-right text-muted text-sm"></span>
                        </a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="fas fa-truck nav-icon"></i>
                              <p>
                                {{__('messages.truck')}}
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{ route('truck') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{__('messages.truck_new_entry')}}</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('truck.charges') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{__('messages.truck_charges_entry')}}</p>
                                </a>
                              </li>
                            </ul>
                          </li>

                          <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                              <p>
                                {{__('messages.farmar')}}
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{ route('farmer') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
<<<<<<< HEAD
                                  <p>New</p>
=======
                                  <p>{{__('messages.farmar_entries')}}</p>
>>>>>>> d5dcf15... new changes
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('ftransaction') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
<<<<<<< HEAD
                                  <p>Details</p>
=======
                                  <p> {{__('messages.farmer_material_details')}}</p>
>>>>>>> d5dcf15... new changes
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('flog') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
<<<<<<< HEAD
                                  <p>Payment</p>
=======
                                  <p>{{__('messages.farmer_payment_details')}}</p>
>>>>>>> d5dcf15... new changes
                                </a>
                              </li>
                            </ul>
                          </li>

                        <li class="nav-item">
                            <a href="{{ route('market') }}" class="nav-link">
                                <!-- <i class="nav-icon fas fa-th"></i> -->
                                <i class="fas fa-landmark nav-icon"></i>
                                <p>
                                    {{__('messages.market')}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('profit.loss') }}" class="nav-link">
                                <!-- <i class="nav-icon fas fa-th"></i> -->
                                <i class="fas fa-balance-scale-right nav-icon"></i>
                                <p>
                                    Profit Loss
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-chart-pie"></i>
                              <p>
                                {{__('messages.report')}}
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{ route('sales.report') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{__('messages.profit_loss_report')}}</p>
                                </a>
                              </li>
                            </ul>
                          </li>


                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="fab fa-amazon-pay nav-icon"></i>
                              <p>

                               <!-- {{__('messages.outside_payment')}} -->

                               {{__('messages.payment')}}

                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                             <li class="nav-item">
                                <a href="{{ route('outsidep') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>

                                <!--   <p>Agent Payment Details</p> -->

                                  <p>   {{__('messages.agent_payment_details')}}</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('salary') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>   {{__('messages.salary')}}</p>

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
        <div class="content-wrapper">
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

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <!-- Default to the left -->
            <strong>Copyright &copy; Cotton Business</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

</body>

</html>
