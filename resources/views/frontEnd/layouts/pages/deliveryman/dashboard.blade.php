@extends('frontEnd.layouts.pages.deliveryman.master')
@section('title', 'Dashboard')
@section('content')
    <style>
        .stats-reportList {
            background: #fff;
            padding: 18px;
            border-radius: 100px;
            overflow: hidden;
            margin-bottom: 15px;
            width: 51px;
            height: 53px;
        }
    </style>
    <section class="section-padding dashboard-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="stats-reportList-inner delivery-dashboar-inner">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-dark">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Total Parcel</h5>
                                        <h4>{{ $totalparcel }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-success">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Total Deliverd</h5>
                                        <h4>{{ $totaldelivery }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-secondary">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Total Hold</h5>
                                        <h4>{{ $totalhold }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-warning">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Total Cancelled</h5>
                                        <h4>{{ $totalcancel }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-info">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Return Pending</h5>
                                        <h4>{{ $returnpendin }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-danger">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Returned To Merchant</h5>
                                        <h4>{{ $returnmerchant }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- dashboard payment -->
                <div class="col-sm-12">
                    <div class="dashboard-payment-info delivery-dashboar-inner">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-info">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Total Amount</h5>
                                        <h4>{{ $totalamount }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-success">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Paid Amount</h5>
                                        <h4>0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12 mb-3" style="color:#fff;">
                                <div class="d-flex justify-content-start info-box-border-1"
                                    style="background: white;padding: 15px 0 0 10px;border-radius: 100px;border: 1px solid darkkhaki;">
                                    <div class="stats-reportList bg-danger">
                                        <span class="info-box-icon"><i class="fas fa-box"></i></span>
                                    </div>
                                    <div class="stats-per-item" style="color: black;padding:0 0 0 10px;">
                                        <h5>Unpaid Amount</h5>
                                        <h4>0</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- col end -->
                        </div>
                    </div>
                </div>
                <!-- dashboard payment -->
            </div>



            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Parcel Statistics</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
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
                                $parcelcount = App\Parcel::where(['status' => $parceltype->id, 'deliverymanId' => Session::get('deliverymanId')])->count();
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
