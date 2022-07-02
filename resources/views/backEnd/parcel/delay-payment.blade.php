@extends('backEnd.layouts.master')
@section('title', 'Old Payment')
@section('content')
    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible !important;
            }

            #printSection {
                position: absolute !important;
                left: 0;
                top: 0;
            }
        }
    </style>
    <!-- Main content -->
    <section class="content">


        <div class="container-fluid">
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card custom-card">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5> Parcel</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <table id="example"
                                    class="table table-bordered table-striped custom-table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Create_Date</th>
                                            <th>Company_Name</th>
                                            <th>Customer</th>
                                            <th>Tracking</th>
                                            <th>Area</th>
                                            <th>Full Address</th>
                                            <th>Phone</th>
                                            <th>Pickman</th>
                                            <th>Rider</th>
                                            <th>Agent</th>
                                            <th>Last Update</th>
                                            <th>Total</th>
                                            <th>Charge</th>
                                            <th>Sale Price</th>
                                            <th>Sub Total</th>
                                            <th>Pay ?</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($show_data as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d M Y', strtotime($value->created_at)) }}<br>
                                                    {{ date('g:i a', strtotime($value->created_at)) }}</td>
                                                <!--Create Date and Time -->
                                                <td>
                                                    @if ($value->merchant)
                                                        {{ $value->merchant->companyName }}<br>({{ $value->merchant->pickLocation }})<br>({{ $value->merchant->phoneNumber }})
                                                    @endif
                                                </td>
                                                <td>{{ $value->recipientName }}</td>
                                                <td>{{ $value->trackingCode }}</td>
                                                <td>
                                                    @if ($value->nearestZone)
                                                        {{ $value->nearestZone->zonename }}
                                                    @endif
                                                </td>
                                                <td>{{ $value->recipientAddress }}</td>
                                                <td>{{ $value->recipientPhone }}</td>
                                                <td>
                                                    {{ $value->deliverymen->name ?? '' }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">
                                                        {{ $value->deliverymen->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($value->agentPaystatus == 1)
                                                        <span class="badge bg-success">
                                                            {{ $value->agentman->name }}
                                                        </span>
                                                    @else
                                                        {{ $value->agentman->name }}
                                                    @endif
                                                </td>
                                                <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
                                                <td> {{ $value->cod }}</td>
                                                <td> {{ $value->deliveryCharge + $value->codCharge }}</td>

                                                <td> {{ $value->sale_price }}</td>
                                                <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}
                                                </td>

                                                <td>
                                                    @if ($value->merchantpayStatus == null)
                                                        <div class="text-danger"> NULL </div>
                                                    @elseif ($value->merchantpayStatus == 0)
                                                        <div class="text-warning"> Processing </div>
                                                    @else
                                                        <div class="text-success"> Paid </div>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="py-3">{{ $show_data->links() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Section  -->
@endsection
