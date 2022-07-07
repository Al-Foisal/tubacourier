<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tuba Courier || @yield('title', 'Dashbaord')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('frontEnd/') }}/images/faveicon.png">
    <!-- fabeicon css -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('frontEnd/') }}/css/font-awesome.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="{{ asset('backEnd/') }}/plugins/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('backEnd/') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/summernote/summernote-bs4.css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/select2/css/select2.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/owlcarousel/owl.theme.default.min.css">
    <!-- owl.theme.default.min -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- flatpickr -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/dist/css/toastr.min.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/dist/css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    @yield('extracss')
</head>


<body class="hold-transition sidebar-mini layout-fixed" onload="startTime()">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>




                <li class="nav-item d-none d-sm-inline-block">

                    <i class="fa fa-house-damage" style="font-size:27px"></i>

                </li>


                <!-- nav item end -->
                {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('https://tuba.express/superadmin/dashboard')}}" class="nav-link" title="Dashboard">
           <i class="fa fa-home" style="font-size:27px"></i>
          </a>
        </li> --}}




                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link"> <i class="fas fa-calendar-alt"></i>
                        <?php echo '' . date('l'); ?>, <i class=""></i> <?php echo date('d M Y'); ?> , <?php
                        date_default_timezone_set('Asia/Dhaka');
                        echo ' ' . date('h:i:sa');
                        ?> <span
                            id="time" class="time"></span></a>
                </li>

                <!-- nav item end -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" target="_blank" class="nav-link"><i class="fa fa-globe"></i> Visit
                        Website</a>
                </li>

                <!-- nav item end -->


                <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('editor/parcel/pending') }}" class="nav-link"><i class="fa fa-globe"></i>Pending
        ({{ $newpickup->count() }})
        </a>
      </li>
      
        -->


            </ul>






            <ul class="navbar-nav ml-auto">


                <!-- nav item end -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/cc') }}" target="_blank" class="nav-link"><i class="fas fa-eraser"></i>
                        Clear-Cache</a>
                </li>

                <!-- nav item end -->


                <!-- nav item end -->
                {{-- <li class="nav-item d-none d-sm-inline-block">

         <a href="{{url('https://tuba.express/webmail')}}" title=" Open Web Mail" target="_blank"  class="nav-link" ><i class="fa fa-envelope"></i></a>
           
        </li> --}}






                <!-- nav item end -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('editor/new/pickup') }}" class="nav-link" title=" Pickup Notification">
                        <i class="fas fa-bell"></i>
                        {{ $newpickup->count() }}
                    </a>
                </li>




                <!-- nav item end -->
                <li class="nav-item has-treeview">
                    <a id="goFS" class="nav-link anchor" title="Full Screen" data-widget="fullscreen">
                        <i class="fas fa-expand"></i>
                    </a>
                </li>



                <!-- nav item end ----------------------------------------------------------
        <li class="nav-item has-treeview">
           <a  id="myBtn" class="nav-link anchor" title="Lock Screen" data-widget="lockscreen">
           <i class="fas fa-lock"></i>
          </a>
       </li>
       -->



                <!-- nav item end -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('password/change') }}" class="nav-link" title="Change Password">
                        <i class="fas fa-key"></i>
                    </a>
                </li>



                <!-- nav item end ----------------------------------------------------------------------------------------
        
        <li class="nav-item has-treeview">
            <a href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
             <i class="fas fa-sign-out-alt"></i>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
             </form>
            </a>
       </li>
       
       -->




                <li class="nav-item has-treeview">
                    <a href="{{ route('logout') }}" title="Logout"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="nav-link">
                        <i class="fa fa-sign-out" style="color:red"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>







                <!-- nav item end -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/superadmin/dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light">Tuba Courier</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="user-image">
                        <img src="{{ asset(auth::user()->image) }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="user-info">
                        <a href="#" class="d-block">{{ auth::user()->name }}</a>
                        <i class="fas fa-circle"></i>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- nav item end -->
                        @if (Auth::user()->role_id == 1)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-bookmark"></i>
                                    <p>
                                        Website
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/logo/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Logo</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/banner/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Banner</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/feature/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Feature</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/price/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Pricing</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/about/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>About</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/clientfeedback/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Client Feedback</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/service/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Service</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/notice/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Notice</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/gallery/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Gallery</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/partner/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Partner</p>
                                        </a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--  <a href="{{ route('editor.pageList') }}" class="nav-link">&nbsp;&nbsp;&nbsp;-->
                                    <!--   <i class="fas fa-angle-right"></i>&nbsp;-->
                                    <!--      <p>Pages</p>-->
                                    <!--  </a>-->
                                    <!--</li>-->
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/social-media/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;&nbsp;
                                            <i class="fas fa-angle-right"></i>&nbsp;
                                            <p>Social Icon</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- nav item end -->
                            <!-- nav item end -->

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-user-tie"></i>
                                    <p>
                                        Panel User
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/superadmin/user/add') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p> Add</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/superadmin/user/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-gears"></i>&nbsp;
                                            <p>Manage</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- nav item end -->
                        @endif

                        @if (Auth::user()->role_id <= 4)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-briefcase"></i>
                                    <p>
                                        Merchant
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                        @endif





                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('merchant/register') }}" class="nav-link">&nbsp;&nbsp;
                                    <i class="fa fa-plus"></i>&nbsp;
                                    <p>Add</p>
                                </a>



                            <li class="nav-item">
                                <a href="{{ url('/author/merchant/manage') }}" class="nav-link">&nbsp;&nbsp;
                                    <i class="fas fa-cog"></i>&nbsp;
                                    <p>Manage</p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/deliverycharge/manage') }}" class="nav-link">&nbsp;&nbsp;
                                    <i class="fas fa-cog"></i>&nbsp;
                                    <p>Merchant charge manage</p>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <!-- nav item end -->


                        @if (Auth::user()->role_id <= 4)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-users"></i>
                                    <p>
                                        Deliveryman
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/deliveryman/add') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Add</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/deliveryman/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Manage</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- nav item end -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-users"></i>
                                    <p>
                                        Agent
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/author/agent/add') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Add</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/author/agent/manage') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Manage</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- nav item end -->
                        @endif

                        @if (Auth::user()->role_id <= 2)
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/deliverycharge/add') }}" class="nav-link">&nbsp;&nbsp;
                                        <i class="fa fa-plus"></i>&nbsp;
                                        <p>Service Type Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/deliverycharge/manage') }}"
                                        class="nav-link">&nbsp;&nbsp;
                                        <i class="fas fa-cog"></i>&nbsp;
                                        <p>Service TypeManage</p>
                                    </a>
                                </li>
                            </ul>





                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-map-marker"></i>
                                    <p>
                                        Service/Delivery Area
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/admin/deliverycharge/add') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Service Type Add</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/deliverycharge/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Service Type Manage</p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{ url('/admin/division/add') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Division Add</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/division/manage') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Division Manage</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/up_district/add') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>District Add</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/up_district/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>District Manage</p>
                                        </a>
                                    </li>



                                    <li class="nav-item">
                                        <a href="{{ url('/admin/area/add') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Area Add</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/area/manage') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Area Manage</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/nearestzone/add') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Union Add</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/nearestzone/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Union Manage</p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{ url('/admin/covarage/add') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Covarage Area Add</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('/admin/covarage/manage') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Covarage Area Manage</p>
                                        </a>
                                    </li>




                                </ul>
                            </li>
                        @endif





                        <!-- nav item end -->
                        @if (Auth::user()->role_id != 3)
                            <li class="nav-item has-treeview">



                                <a href="#" class="nav-link">
                                    <i class="fas fa-chart-pie"></i>
                                    <p>
                                        HR
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>


                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/author/department/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-users-cog"></i>&nbsp;
                                            <p>Department</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/author/employee/manage') }}"
                                            class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-users"></i>&nbsp;
                                            <p>Employee</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/author/agent/manage') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-user-friends"></i>&nbsp;
                                            <p>Agent</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <!-- nav item end -->

                        @if (Auth::user()->role_id <= 4)
                            <li class="nav-item has-treeview">



                                <a href="#" class="nav-link">
                                    <i class="fa fa-money"></i>
                                    <p>
                                        Accounts
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>


                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('editor.ec.index') }}"
                                            class="nav-link">                                            
                                            <p>Expense Category</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('editor.e.index') }}"
                                            class="nav-link">                                            
                                            <p>Expense</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('editor.e.income') }}" class="nav-link">                                            
                                            <p>Income</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('editor.e.revenue') }}" class="nav-link">
                                            <p>Revenue</p>
                                        </a>
                                    </li>

                                    {{-- payment --}}
                                    @php
                                        $today = DB::table('parcels')
                                            ->where('status', 4)
                                            ->where('deliverymanPaystatus', 1)
                                            ->where('deliverymanId', '!=', null)
                                            ->where('agentId', '!=', null)
                                            ->whereDate('updated_at', today())
                                            ->orderBy('id', 'desc')
                                            ->count();
                                        
                                        $old = DB::table('parcels')
                                            ->where('status', 4)
                                            ->where('deliverymanPaystatus', 1)
                                            ->where('deliverymanId', '!=', null)
                                            ->where('agentId', '!=', null)
                                            ->whereDate('updated_at', '<', today())
                                            ->orderBy('id', 'desc')
                                            ->count();
                                    @endphp
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/parcel/payment/todays-payment') }}"
                                            class="nav-link">
                                            <p>Todays Payment({{ $today }})</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/parcel/payment/old-payment') }}" class="nav-link">
                                            <p>Old Payment({{ $old }})</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/parcel/payment/merchant-payment') }}" class="nav-link">
                                            <p>Merchant Payment</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif



                        @if (Auth::user()->role_id <= 4)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-gift"></i>
                                    <p>
                                        Parcel Manage
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ url('/editor/new/parcel-create') }}" class="nav-link">
                                            <i class="fas fa-cicle-o"></i>
                                            <p>Parcel Create</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/parcel/all') }}" class="nav-link">
                                            <i class="fas fa-cicle-o"></i>
                                            <p>All Parcel</p>
                                        </a>
                                    </li>

                                    @foreach ($parceltypes as $parceltype)
                                        <li class="nav-item">
                                            <a href="{{ url('editor/parcel', $parceltype->slug) }}"
                                                class="nav-link">
                                                <i class="fas fa-cicle-o"></i>
                                                <p>{{ $parceltype->title }} ({{ $parceltype->parcel_count }})
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <!-- nav item end -->



                            <!-- nav item end -->

                        @endif

                        @if (Auth::user()->role_id <= 3)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-truck"></i>
                                    <p>
                                        Pickup Request
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/new/pickup') }}" class="nav-link">
                                            <i class="fas fa-cicle-o"></i>
                                            <p>New Pickup ({{ $newpickup->count() }})</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/pending/pickup') }}" class="nav-link">
                                            <i class="fas fa-cicle-o"></i>
                                            <p>Pending Pickup ({{ $pendingpickup->count() }})</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/accepted/pickup') }}" class="nav-link">
                                            <i class="fas fa-cicle-o"></i>
                                            <p>Accepted Pickup ({{ $acceptedpickup->count() }})</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/cancelled/pickup') }}" class="nav-link">
                                            <i class="fas fa-cicle-o"></i>
                                            <p>Cancelled Pickup ({{ $cancelledpickup->count() }})</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif


                        @if (Auth::user()->role_id <= 2)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-award"></i>
                                    <p>
                                        Note
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/note/create') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fa fa-plus"></i>&nbsp;
                                            <p>Add</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/editor/note/manage') }}" class="nav-link">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i>&nbsp;
                                            <p>Manage</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- nav item end -->
                        @endif


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
        </div>
        <div class="search-product-inner" id="live_data_show"></div>

        <footer class="main-footer">
            <strong>Copyright &copy;<a href="{{ url('/') }}">Tuba Courier</a></strong>
            All rights reserved__Design and Development QuicktechIt.
        </footer>

        <!-- jQuery -->
        <script src="{{ asset('backEnd/') }}/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('backEnd/') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <!-- Bootstrap 4 -->
        <script src="{{ asset('backEnd/') }}/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{ asset('backEnd/') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('backEnd/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('backEnd/') }}/dist/js/adminlte.js"></script>
        <!-- Summernote -->
        <script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
        </script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('backEnd/') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- FastClick -->
        <script src="{{ asset('backEnd/') }}/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('backEnd/') }}/plugins/owlcarousel/owl.carousel.min.js"></script>
        <!-- Datatable -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="{{ asset('backEnd/') }}/plugins/datatables/jquery.dataTables.js"></script>
        <script src="{{ asset('backEnd/') }}/plugins/datatables/dataTables.bootstrap4.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js "></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js "></script>
        <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <!-- flatpicker -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            $(function() {
                flatpickr("#flatpicker", {
                    minDate: "today",
                });
            })
        </script>
        <script>
            flatpickr(".flatDate", {});
        </script>
        <script src="{{ asset('backEnd/') }}/plugins/select2/js/select2.full.min.js"></script>
        <!-- Select2 -->
        <script src="{{ asset('backEnd/') }}/plugins/chart.js/Chart.min.js"></script>
        <script src="{{ asset('backEnd/') }}/plugins/sparklines/sparkline.js"></script>
        <script src="{{ asset('backEnd/') }}/dist/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        <script src="{{ asset('backEnd/') }}/dist/js/demo.js"></script>
        <!-- ChartJS -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2({
                    width: '100%'
                });



                $('#example1').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,

                });

            })
        </script>
        <script type="text/javascript">
            $("#search_data").on('keyup', function() {
                var keyword = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ url('/') }}/search_data/" + keyword,
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        console.log(data);
                        $("#live_data_show").html('');
                        $("#live_data_show").html(data);
                    }
                });
            });
        </script>
        <script>
            function percelDelivery(that) {
                if (that.value == "4") {
                    document.getElementsByClassName("customerpaid").style.display = "block";
                } else {
                    document.getElementsByClassName("customerpaid").style.display = "none";
                }
            }
        </script>
        <script>
            function myPrintFunction() {
                window.print();
            }
        </script>
        <script>
            jQuery("#My-Button").click(function() {
                jQuery(':checkbox').each(function() {
                    if (this.checked == true) {
                        this.checked = false;
                    } else {
                        this.checked = true;
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    "lengthMenu": [
                        [200, 500, -1],
                        [200, 500, "All"]
                    ],
                    buttons: [{
                            extend: 'copy',
                            text: 'Copy',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                            }
                        },
                        {
                            extend: 'excel',
                            text: 'Excel',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                            }
                        },
                        {
                            extend: 'excel',
                            text: 'D_Man',
                            exportOptions: {
                                columns: [1, 3, 4, 5, 7, 8, 10, 14]
                            }
                        },

                        {
                            extend: 'print',
                            text: 'Print',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                            }
                        },

                        {
                            extend: 'print',
                            text: 'Print all',
                            exportOptions: {
                                modifier: {
                                    selected: null
                                }
                            }
                        },
                        {
                            extend: 'colvis',
                        },

                    ],
                    select: true
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            });
        </script>
        <!-- page script -->
        <script>
            $(function() {
                /* ChartJS
                 * -------
                 * Here we will create a few charts using ChartJS
                 */

                //--------------
                //- AREA CHART -
                //--------------

                // Get context with jQuery - using jQuery's .get() method.
                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

                var areaChartData = {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                            label: 'Digital Goods',
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            pointRadius: false,
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: [28, 48, 40, 19, 86, 27, 90]
                        },
                        {
                            label: 'Electronics',
                            backgroundColor: 'rgba(210, 214, 222, 1)',
                            borderColor: 'rgba(210, 214, 222, 1)',
                            pointRadius: false,
                            pointColor: 'rgba(210, 214, 222, 1)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                    ]
                }

                var areaChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }]
                    }
                }

                // This will get the first returned node in the jQuery collection.
                var areaChart = new Chart(areaChartCanvas, {
                    type: 'line',
                    data: areaChartData,
                    options: areaChartOptions
                })

                //-------------
                //- LINE CHART -
                //--------------
                var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
                var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
                var lineChartData = jQuery.extend(true, {}, areaChartData)
                lineChartData.datasets[0].fill = false;
                lineChartData.datasets[1].fill = false;
                lineChartOptions.datasetFill = false

                var lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: lineChartData,
                    options: lineChartOptions
                })

                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData = {
                    labels: [
                        'Chrome',
                        'IE',
                        'FireFox',
                        'Safari',
                        'Opera',
                        'Navigator',
                    ],
                    datasets: [{
                        data: [700, 500, 400, 600, 300, 100],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }]
                }
                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                var donutChart = new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                })

                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieData = donutData;
                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                })

                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = jQuery.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                }

                var barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })

                //---------------------
                //- STACKED BAR CHART -
                //---------------------
                var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
                var stackedBarChartData = jQuery.extend(true, {}, barChartData)

                var stackedBarChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }

                var stackedBarChart = new Chart(stackedBarChartCanvas, {
                    type: 'bar',
                    data: stackedBarChartData,
                    options: stackedBarChartOptions
                })
            })
        </script>
        <script>
            var goFS = document.getElementById("goFS");
            goFS.addEventListener("click", function() {
                document.body.requestFullscreen();
            }, false);
        </script>



</body>

</html>
