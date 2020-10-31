<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Inventory') }} </title>
  <link rel = "icon" href="{{ asset('images/cosmicalogosmoll.png') }}"  type = "image/x-icon"> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome-free-5.11.2\css\all.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- confirm alert css -->  
  <link rel="stylesheet" href="{{ asset('dist/css/jquery-confirm.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- custom css -->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Inventory</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="{{ url('myProfile') }}" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <i class="fas fa-envelope"></i> -->
              <!-- <span class="label label-success">1</span>
 -->            </a>
            <ul class="dropdown-menu" >
              <li class="header">You have 0 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
         
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            
            
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="{{ url('myProfile') }}" class="dropdown-toggle" data-toggle="dropdown">
              <img src="@if(Auth::user()->profile_img)  {{ asset(Auth::user()->profile_img) }}  @else {{ asset('/images/user_img.jpg') }} @endif" class="user-image" alt="User Image" style="background-color: #fff;">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="@if(Auth::user()->profile_img)  {{ asset(Auth::user()->profile_img) }}  @else {{ asset('/images/user_img.jpg') }} @endif" class="img-circle" alt="User Image" style="background-color: #fff;">
        
                <p>
                  {{ Auth::user()->name }}
                   <small>Member since Jun. 2019</small> 
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('myProfile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                   
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form-nav').submit();">
                                        {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i></a>
                    <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="@if(Auth::user()->profile_img)  {{ asset(Auth::user()->profile_img) }}  @else {{ asset('/images/user_img.jpg') }} @endif" class="img-circle" alt="User Image" style="background-color: #fff">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"  class=""><i class="fa fa-circle text-success"></i> <span class="">Online</span></a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..." id="search-input" style="background-color: #ffffff">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat" style="background-color: #e3e3e3;"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      @if ( Auth::check() )
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li>
          <a href="{{ url('home') }}">
            <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;
              <span>Dashboard</span>
          </a>
        </li>
        
        <!-- super admin page admin Page -->
        <li class="treeview
        @if( Request::is('Accounts') || Request::is('account/add') || Request::is('Customer') || Request::is('customer/add')) 
         active menu-open 
         @endif
        ">
          <a href="{{ url('Accounts') }}">
            <i class="fa fa-users"></i> <span> {{ __('message.accounts') }} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="@if ( Request::is('Accounts') ) active @endif"><a href="{{ url('Accounts') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.manage accounts') }}</a></li>


              <li class="@if ( Request::is('account/add') ) active @endif"><a href="{{ url('account/add') }}"><i class="far fa-circle"></i> &nbsp;&nbsp; {{ __('message.create account') }}</a></li>


             <li class="@if ( Request::is('Customer') ) active @endif"><a href="{{ url('Customer') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.manage customers') }}</a></li>


             <li class="@if ( Request::is('customer/add') ) active @endif"><a href="{{ url('customer/add') }}"><i class="far fa-circle"></i> &nbsp;&nbsp; {{ __('message.create customer') }}</a></li>
          </ul>
        </li>
        <!-- end super admin -->



        <!-- device -->
        <li class="treeview
        @if( Request::is('Device') || Request::is('device/add') || Request::is('device/expiry') ) 
         active menu-open 
         @endif
        ">
          <a href="{{ url('Device') }}">
            <i class="fa fa-car"></i> <span>{{ __('message.device') }} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
             <li class="@if ( Request::is('Device') ) active @endif"><a href="{{ url('Device') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.manage device') }}</a></li>

              
            <li class="@if ( Request::is('device/expiry') ) active @endif"><a href="{{ url('device/expiry') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.device expiry') }}</a></li> 
          </ul>
        </li>
        <!--end device -->

       <!-- sim -->
        <li class="treeview
        @if( Request::is('Sim') || Request::is('Sim/add') || Request::is('sim/expiry')) 
         active menu-open 
         @endif
        ">
          <a href="{{ url('Sim') }}">
            <i class="fa fa-sim-card"> </i> <span>{{ __('message.sim') }} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
             <li class="@if ( Request::is('Sim') ) active @endif"><a href="{{ url('Sim') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.manage sim') }}</a></li>

             <li class="@if ( Request::is('sim/expiry') ) active @endif"><a href="{{ url('sim/expiry') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.sim expiry') }}</a></li>

          </ul>
        </li>
        <!-- end sim -->

        <!-- other Stock -->
        <li class="treeview
        @if( Request::is('other/stock') || Request::is('add/other/stock') || Request::is('other/stock/showFromDate') ) 
         active menu-open 
         @endif
        ">
          <a href="{{ url('other/stock') }}">
            <i class="fa fa-cart-arrow-down"> </i> <span>{{ __('message.other stock') }} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
             <li class="@if ( Request::is('other/stock') || Request::is('other/stock/showFromDate')) active @endif"><a href="{{ url('other/stock') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.other stock') }}</a></li>

             <li class="@if ( Request::is('add/other/stock') ) active @endif"><a href="{{ url('add/other/stock') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.add other stock') }}</a></li>

          </ul>
        </li>
        <!-- other stock end  -->

         <!-- Delivery Challan -->
        <li class="treeview
        @if( Request::is('DeliveryChallan') || Request::is('DeliveryChallan/show') || Request::is('DeliveryChallan/show/fromDate') )
         active menu-open 
         @endif
        ">
          <a href="{{ url('DeliveryChallan/show') }}">
            <i class="fas fa-file-invoice-dollar"></i> &nbsp;&nbsp; <span>{{ __('message.delivery challan') }} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
             <li class="@if ( Request::is('DeliveryChallan/show') || Request::is('DeliveryChallan/show/fromDate')) active @endif"><a href="{{ url('DeliveryChallan/show') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.show delivery challan') }}</a></li>

             <li class="@if ( Request::is('DeliveryChallan') ) active @endif"><a href="{{ url('DeliveryChallan') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.create delivery challan') }}</a></li>

          </ul>
        </li>
        <!-- Delivery Challan -->

        <!-- bar code inventory -->
        <li class="treeview
        @if( Request::is('barcode-inventory/show') || Request::is('Sim/add') || Request::is('barcode-inventory/fromDate') || Request::is('addStock') ) 
         active menu-open 
         @endif
        ">
          <a href="{{ url('barcode-inventory/show') }}">
            <i class="fa fa-barcode"> </i> <span>{{ __('message.barcode inventory') }} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
             <li class="@if ( Request::is('barcode-inventory/show') || Request::is('barcode-inventory/fromDate') ) active @endif"><a href="{{ url('barcode-inventory/show') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.show barcode inventory') }}</a></li>

             <li class="@if ( Request::is('addStock') || Request::is('addStock') ) active @endif"><a href="{{ url('addStock') }}"><i class="far fa-circle"> </i> &nbsp;&nbsp; {{ __('message.add stock multiple') }}</a></li>
             
          </ul>
        </li>
        <!-- end sim -->


        <!-- reports  -->
        <li class="treeview
        @if( Request::is('reports/device') || Request::is('reports/sim') ) 
         active menu-open 
         @endif
        ">
          <a href="{{ url('Sim') }}">
            <i class="fa fa-bar-chart"></i>  <span>{{ __('message.reports') }} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
             <li class="@if ( Request::is('reports/device') ) active @endif"><a href="{{ url('reports/device') }}"><i class="fas fa-circle"> </i>  &nbsp;&nbsp; {{ __('message.device reports') }}</a></li>

             <li class="@if ( Request::is('reports/sim') ) active @endif"><a href="{{ url('reports/sim') }}"><i class="fas fa-circle"> </i> &nbsp;&nbsp; {{ __('message.sim reports') }}</a></li>
          </ul>
        </li>
        <!-- end report -->   

        <!-- Settings -->
        <li class="@if( Request::is('settings') ) active @endif">
          <a href="{{ route('settings') }}">
            <i class="fa fa-cog"></i> <span>{{ __('message.settings') }}</span>
            
          </a>
        </li>
        <!--end Setting -->
      
        <li>
          <a href="{{ route('myProfile') }}" >
            <i class="fas fa-user" aria-hidden="true"></i> &nbsp;<span>My Profile</span>
          </a>
        </li>

       <li>
          <a href="{{ route('passwordReset.view') }}" >
            <i class="fas fa-lock" aria-hidden="true"></i> &nbsp;<span>Change Password</span>
          </a>
        </li>

        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt" aria-hidden="true"></i> <span>{{ __('Logout') }}</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
          </a>
        </li>
      </ul>
      @endif
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- loader  -->
        <!-- <div  id="loading" style="display: none;">
              <img class="pull-center" id="loading-image" src='images/ajax-loader.gif'/  >
        </div> -->
    <!-- end loader  -->




  @yield('content')
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018-2019 <a href="{{ route('home') }}">{{ config('app.name', 'Inventory') }}</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  <input type="hidden" value="{{ Auth::user()->id }}" id="myUniqueId">
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

<!--form validator -->
<script src="{{ asset('dist/js/jquery.form-validator.min.js') }}"></script>
<!-- confirm alert -->
<script src="{{ asset('dist/js/jquery-confirm.js') }}"></script>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyDfvVaa8eQJX_h4Qv93-RiQ797IfxjKNgw&libraries=places'></script>

<script src="{{ asset('dist/js/locationpicker.jquery.min.js') }}"></script>


<script src="{{ asset('datatable-plugin/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatable-plugin/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('datatable-plugin/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatable-plugin/vfs_fonts.js') }}"></script>
<script src="{{ asset('datatable-plugin/buttons.flash.min.js') }}"></script>
<script src="{{ asset('datatable-plugin/jszip.min.js') }}"></script>
<script src="{{ asset('datatable-plugin/buttons.print.min.js') }}"></script>
<script type="{{ asset('datatables-plugin/sum().js')}}"></script>

<script src="{{ asset('plugins/notification.js') }}"></script> 
<script src="{{ asset('plugins/jquery.playSound.js') }}"></script>

<!-- auto typeahead search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<!-- <script src="{{ asset('font-awesome-4.7.0/a076d05399.js') }}"></script> -->

<!-- custom script -->
<!-- custom script in side bar -->
<script src="{{ asset('js/sidebar.js') }}"></script>

@if ( Request::is('Accounts') )
<script src="{{ asset('js/accounts.js') }}"></script>
@endif

@if ( Request::is('Customer') )
<script src="{{ asset('js/customer.js') }}"></script>
@endif

@if ( Request::is('Device') )
<script src="{{ asset('js/device.js') }}"></script>
@endif

@if ( Request::is('Sim') )
<script src="{{ asset('js/sim.js') }}"></script>
@endif

@if ( Request::is('Settings') )
<script src="{{ asset('js/settings.js') }}"></script>
@endif

@if ( Request::is('reports/device') || Request::is('reports/sim') )
<script src="{{ asset('js/reports.js') }}"></script>
@endif

@if ( Request::is('Sim/expiry')  )
<script src="{{ asset('js/simExpiry.js') }}"></script>
@endif

@if ( Request::is('barcode-inventory/show') || Request::is('barcode-inventory/fromDate') )
<script src="{{ asset('js/barcode-inventory.js') }}"></script>
@endif
@if ( Request::is('addStock') || Request::is('addStock') )
<script src="{{ asset('js/addStock.js') }}"></script>
@endif
@if ( Request::is('other/stock') || Request::is('other/stock/showFromDate') )
<script src="{{ asset('js/OtherStock.js') }}"></script>
@endif
@if ( Request::is('add/other/stock')  )
<script src="{{ asset('js/addOtherStock.js') }}"></script>
@endif

@if ( Request::is('DeliveryChallan') || Request::is('DeliveryChallan/show') || Request::is('DeliveryChallan/show/fromDate'))
<script src="{{ asset('js/deliveryChallan.js') }}"></script>
@endif


<script>
setTimeout(function(){ 
//$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
//$('.eroor_message').not('.alert-important').delay(3000).fadeOut(350);
$('.nav-tabs a[href="#tab_1"]').tab('show');
}, 30);

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

$("body").prepend('<div class="loading-overlay"><div class="bounce-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>');
    $(window).on("load", function() {
        $("body").addClass("loaded")
    })

//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
</script>
@if ( Request::is('customer/add')  || Request::is('customer/edit/{id}')  )
<script>
  
  $("#application").select2({
    placeholder:"Select Application"
  });

  $("#customer_type").select2({
    placeholder:"Customer Type"
  });
  $("#employee").select2({
    placeholder:"Created on Employee"
  });

  $("#challanList").select2({
    placeholder:"Select Challan No."
  });

  
    
</script>
@endif
@stack("scripts")
<input type="text" name="_token" id="token" value="{{ csrf_token() }}">
</body>
</html>
