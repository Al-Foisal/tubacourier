@extends('backEnd.layouts.master')
@section('title', 'Super Admin Dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <style>
        .info-box {
            box-shadow: 0 0 1pxrgba(0, 0, 0, .125), 0 1px 3pxrgba(0, 0, 0, .2);
            border-radius: 100%;
            background: #fff;
            min-height: 0;
            padding: 1rem;
            position: relative;
            width: 78px;
        }

        .info-box-border-0 {
            border: 1px solid #1d2941;
        }

        .info-box-border-1 {
            border: 1px solid #5f45da;
        }

        .info-box-border-2 {
            border: 1px solid #670a91;
        }

        .info-box-border-3 {
            border: 1px solid #096709;
        }

        .info-box-border-4 {
            border: 1px solid #ffac0e;
        }

        .info-box-border-5 {
            border: 1px solid #aab809;
        }

        .info-box-border-6 {
            border: 1px solid #2094a0;
        }

        .info-box-border-7 {
            border: 1px solid #9a8309;
        }

        .info-box-border-8 {
            border: 1px solid #c21010;
        }

        .info-box-border-9 {
            border: 1px solid #02a74a;
        }

        .info-box-border-10 {
            border: 1px solid #02a74a;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content" style="background-color: #f4f6f9">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="dashboard-body">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>Parcel Overall Status</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    @foreach ($parceltypes as $key => $value)
                                        @php
                                            $parcelcount = App\Parcel::where('status', $value->id)->count();
                                        @endphp
                                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                                            <a href="{{ url('editor/parcel', $value->slug) }}" style="color:#fff;">
                                                <div class="d-flex justify-content-start info-box-border-{{ $key }}" 
                                                style="background: white;padding: 15px 0 0 10px;border-radius: 100px;">
                                                    <div class="info-box box-bg-{{ $key }}">
                                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                                    </div>
                                                    <div class="info-box-content"
                                                        style="color: black;padding:15px 0 0 10px;">
                                                        <span class="info-box-number">{{ $parcelcount }}</span>
                                                        <br>
                                                        <span class="info-box-text">{{ $value->title }}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </a>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- col end -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- main col end -->
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="dashboard-body">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>Payment Overall Status</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                                        <div class="d-flex justify-content-start  info-box-border-1"
                                        style="background: white;padding: 15px 0 0 10px;border-radius: 100px;">
                                            <div class="info-box box-bg-1">
                                                <span class="info-box-icon bg-info"><i class="fa fa-money"></i></span>
                                            </div>

                                            <div class="info-box-content" style="color: black;padding:15px 0 0 10px;">
                                                <span class="info-box-text">Total Amount</span>
                                                <br>
                                                <span class="info-box-number">{{ $totalamounts }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                                        <div class="d-flex justify-content-start  info-box-border-2"
                                        style="background: white;padding: 15px 0 0 10px;border-radius: 100px;">
                                            <div class="info-box box-bg-2">
                                                <span class="info-box-icon bg-info"><i class="fa fa-money"></i></span>
                                            </div>

                                            <div class="info-box-content" style="color: black;padding:15px 0 0 10px;">
                                                <span class="info-box-text">Merchant Due Amount </span>
                                                <br>
                                                <span class="info-box-number">{{ $merchantsdue }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                                        <div class="d-flex justify-content-start  info-box-border-3"
                                        style="background: white;padding: 15px 0 0 10px;border-radius: 100px;">
                                            <div class="info-box box-bg-3">
                                                <span class="info-box-icon bg-info"><i class="fa fa-money"></i></span>
                                            </div>

                                            <div class="info-box-content" style="color: black;padding:15px 0 0 10px;">
                                                <span class="info-box-text">Merchant Paid Amount </span>
                                                <br>
                                                <span class="info-box-number">{{ $merchantspaid }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                                        <div class="d-flex justify-content-start  info-box-border-4"
                                        style="background: white;padding: 15px 0 0 10px;border-radius: 100px;">
                                            <div class="info-box box-bg-4">
                                                <span class="info-box-icon bg-info"><i class="fa fa-money"></i></span>
                                            </div>

                                            <div class="info-box-content" style="color: black;padding:15px 0 0 10px;">
                                                <span class="info-box-text">Today Monthly Payment</span>
                                                <br>
                                                <span class="info-box-number">{{ $todaymerchantspaid }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                </div>
                            </div>
                            <!-- col end -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- main col end -->
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card custom-card dashboard-body">
                    <div class="col-sm-12">
                        <div class="manage-button">
                            <div class="body-title">
                                <h5>Overall Status</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main col end -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float left">Parcel Statistics</h3>
                        <form class="form-group" action="{{ url('allparcel/search/') }}" method="post">
                            @csrf
                            <input type="text" placeholder="   Enter parcel" name="parcel" style="height : 40px;"
                                class="mt-2">
                            <input type="submit" value="Search" style="height : 40px;">
                        </form>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: [
                    @foreach ($parceltypes as $parceltype)
                        '{{ $parceltype->title }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Parcel Statistics',
                    backgroundColor: ['#1D2941', '#5F45DA', '#670A91', '#096709', '#FFAC0E', '#AAB809',
                        '#2094A0', '#9A8309', '#C21010'
                    ],
                    borderColor: ['#1D2941', '#5F45DA', '#670A91', '#096709', '#FFAC0E', '#AAB809',
                        '#2094A0', '#9A8309', '#C21010'
                    ],
                    data: [
                        @foreach ($parceltypes as $parceltype)
                            @php
                                $parcelcount = App\Parcel::where('status', $parceltype->id)->count();
                            @endphp {{ $parcelcount }},
                        @endforeach
                    ]
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
@endsection
