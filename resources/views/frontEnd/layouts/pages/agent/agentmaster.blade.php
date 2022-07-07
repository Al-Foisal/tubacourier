<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Tuba Courier | @yield('title', 'Move Everywhere')</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Startup Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta tag Keywords -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('frontEnd') }}/images/fav.png" />
    <!-- Custom-Files -->
    <link rel="stylesheet" href="{{ asset('frontEnd') }}/css/bootstrap4.min.css">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="{{ asset('frontEnd') }}/css/merchant.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('frontEnd') }}/css/swiper-menu.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/dist/css/toastr.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('backEnd/') }}/plugins/select2/css/select2.min.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <!-- Style-CSS -->
    <link href="{{ asset('frontEnd') }}/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- Font-Awesome-Icons-CSS -->
    <!-- //Custom-Files -->
    <script src="{{ asset('frontEnd/') }}/js/jquery_3.4.1_jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>

<body>
    @php
        $agentInfo = App\Agent::find(Session::get('agentId'));
    @endphp
    <section class="mobile-menu ">
        <div class="swipe-menu default-theme">
            <div class="postyourad">
                <a href="{{ url('merchant/dashboard') }}">
                    @foreach ($whitelogo as $key => $value)
                        <img src="{{ asset($value->image) }}" alt="Your logo" />
                    @endforeach
                </a>

                <a href="{{ url('agent/dashboard') }}" class="mobile-username">{{ $agentInfo->names }}</a>

            </div>

            <!--Navigation Icon-->
            <div class="nav-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="codehim-nav">
                <ul class="menu-item">
                    <li><a href="{{ url('agent/dashboard') }}">Dashboard</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcels-create') }}" class="mcreate_parcel">
                            Create Parcel
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcels') }}" class="agent-logout">My Parcel</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcel/pending') }}" class="agent-logout">Pending</a>
                    </li>
                    <li>
                        <a href="{{ url('agent/parcel/picked') }}" class="agent-logout">Picked</a>
                    </li>
                    <li>
                        <a href="{{ url('agent/parcel/in-transit') }}" class="agent-logout">In Transit</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcel/deliverd') }}" class="agent-logout">Delivered</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcel/hold') }}" class="agent-logout">Hold</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcel/return-pending') }}" class="agent-logout">Return Pending</a>
                    </li>


                    <li>
                        <a href="{{ url('agent/parcel/return-to-hub') }}" class="agent-logout">Return To Hub</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcel/return-to-merchant') }}" class="agent-logout">Return To
                            Merchant</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/parcel/cancelled') }}" class="agent-logout">Cancelled</a>
                    </li>

                    <li>
                        <a href="{{ url('agent/logout') }}" class="agent-logout">Logout</a>
                    </li>

                    <li>
                        <br>
                        <br>
                        <br>
                    </li>

                    <li>
                        <br>
                        <br>
                        <br>
                    </li>



                </ul>

                <!--//Tab-->
            </nav>
        </div>





    </section>
    <!-- mobile menu end -->
    <section class="main-area">
        <div class="dash-sidebar">
            <div class="sidebar-inner">
                <div class="profile-inner">
                    <div class="profile-pic">
                        <a href="#"><img src="{{ asset('frontEnd') }}/images/avator.png" alt=""></a>
                    </div>
                    <div class="profile-id">



                        <p>{{ $agentInfo->name }}: {{ $agentInfo->id }}</p>

                    </div>
                    <div class="dashboard-button">
                        <a href="{{ url('agent/dashboard') }}">Dashboard</a>
                    </div>
                </div>
                <div class="side-list">
                    <ul>
                        <li>
                            <a href="{{ url('/agent/dashboard') }}">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('agent/parcels-create') }}">
                                <i class="fa fa-car"></i>
                                Create Parcel
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('agent/parcels') }}">
                                <i class="fa fa-car"></i>
                                My Parcel
                            </a>
                        </li>
                        @php
                            $today = DB::table('parcels')
                                ->where('parcels.agentId', Session::get('agentId'))
                                ->where('parcels.status', 4)
                                ->where('parcels.agentPaystatus', null)
                                ->where('parcels.deliverymanId', '!=', null)
                                ->where('parcels.deliverymanPaystatus', 1)
                                ->whereDate('parcels.updated_at', today())
                                ->count();
                            
                            $delay = DB::table('parcels')
                                ->where('parcels.agentId', Session::get('agentId'))
                                ->where('parcels.status', 4)
                                ->where('parcels.agentPaystatus', null)
                                ->where('parcels.deliverymanId', '!=', null)
                                ->where('parcels.deliverymanPaystatus', 1)
                                ->whereDate('parcels.updated_at', '<', today())
                                ->count();
                        @endphp
                        <li>
                            <a href="{{ url('agent/todays-payment') }}">
                                <i class="fa fa-car"></i>
                                Todays Payment({{ $today }})
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('agent/delay-payment') }}">
                                <i class="fa fa-car"></i>
                                Delay Payment({{ $delay }})
                            </a>
                        </li>

                        {{-- @foreach ($parceltypes as $parceltype) 
                     @php
                        $parcelcount = App\Parcel::where(['status'=>$parceltype->id, 'agentId'=>Session::get('agentId')])->count();
                     @endphp
                    <li class="nav-item">
                        <a href="{{url('agent/parcel',$parceltype->slug)}}">
                            <i class="fa fa-circle-notch"></i>
                            {{$parceltype->title}} ({{$parcelcount}})
                        </a>
                    </li>
                    @endforeach --}}

                        <!--<li>-->
                        <!--    <a href="{{ url('agent/profile/settings') }}">-->
                        <!--       <i class="fa fa-cogs"></i>-->
                        <!--        Settings-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li>
                            <a href="{{ url('agent/logout') }}">
                                <i class="fa fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>


                        <li>
                            <br>
                            <br>
                        </li>
                        <li>
                            <br>
                            <br>
                        </li>
                        <li>
                            <br>
                            <br>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->
        <div class="dashboard-body">
            <div class="heading-bar">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="pik-inner">
                            <ul>
                                <li>
                                    <div class="dash-logo">
                                        @foreach ($whitelogo as $key => $value)
                                            <a href="{{ url('merchant/dashboard') }}"><img
                                                    src="{{ asset($value->image) }}" alt=""></a>
                                        @endforeach
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="heading-right">
                            <ul>
                                <li>
                                    <div class="track-area">
                                        <form action="{{ url('/agent/parcel/track') }}" method="POST">
                                            @csrf
                                            <input class="form-control" type="text" name="trackid"
                                                placeholder="Search your track number..." search>
                                            <button>Submit</button>
                                        </form>
                                    </div>

                                </li>
                                <li class="profile-area">
                                    <div class="profile">
                                        <a class=""><img src="{{ asset('frontEnd') }}/images/avator.png"
                                                alt="">

                                        </a>
                                        <ul>

                                            <li><a href="{{ url('agent/logout') }}">Logout</a></li>
                                        </ul>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="main-body">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
            <!-- Column End-->
        </div>
    </section>

    <!--Next Day Pick Modal end -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('frontEnd/') }}/js/bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('frontEnd/') }}/js/swiper-menu.js"></script>
    <script src="{{ asset('backEnd/') }}/dist/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
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
    <!-- Select2 -->
    <script src="{{ asset('backEnd/') }}/plugins/select2/js/select2.full.min.js"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2({
            width: '100%'
        });

        function calculate_result() {
            $.ajax({
                type: "GET",
                url: "{{ url('cost/calculate/result') }}",
                dataType: "html",
                success: function(deliverycharge) {
                    $('.calculate_result').html(deliverycharge)
                }
            });
        }
        $('.calculate').on('keyup paste click', function() {
            var cod = $('.cod').val();
            var weight = $('.weight').val();
            if (cod, weight) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    url: "{{ url('cost/calculate') }}/" + cod + '/' + weight,
                    dataType: "json",
                    success: function(deliverycharge) {
                        return calculate_result();
                    }
                });
            }
        });
    </script>
    <script>
        flatpickr(".flatDate", {});
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'Copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'Csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },

                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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
</body>

</html>
