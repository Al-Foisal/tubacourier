@extends('backEnd.layouts.master')
@section('title', 'Merchant Payment')
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
                                        <h5> Merchant Payment</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <table id="example" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Payment Method</th>
                                            <th>Merchant Due</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($show_data as $key => $value)
                                            <tr>
                                                <td>{{ $value->companyName }}</td>
                                                <td>{{ $value->paymentMethod ?? 'Not Set Yeat' }}</td>
                                                @php
                                                    $due = 0;
                                                    foreach ($value->parcels as $parcel) {
                                                        if ($parcel->merchantpayStatus == 1 && $parcel->status == 4) {
                                                            $due = $due + ($parcel->codCharge + $parcel->deliveryCharge - $parcel->cod);
                                                        }
                                                    }
                                                @endphp
                                                <td>{{ $due }}</td>
                                                <td>
                                                    <a href="{{ url('/editor/merchant/payment/merchant-payment-details',$value->id) }}">Details</a>
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
