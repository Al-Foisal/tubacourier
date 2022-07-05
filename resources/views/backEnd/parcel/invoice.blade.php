@extends('backEnd.layouts.master')
@section('title', 'Parcel Details')
@section('content')
    <button onclick="myFunction2()" class="bbb"
        style="color: #fff;border: 0;padding: 6px 12px;margin-bottom: 8px;background: green"><i
            class="fa fa-print"></i></button>
    <!-- Main content -->
    <html>

    <head>
        <meta charset="utf-8">
        <title>A simple, clean, and responsive HTML invoice template</title>

        <style>
            @page {
                size: auto;
                margin: 0mm;
            }

            @media print {

                header,
                footer {
                    display: none !important;
                }

                .modal-header {
                    display: none !important;
                }

                .bbb {
                    margin-bottom: 5px;
                }

            }

            .modal-body.printSection {
                width: 435px;
                border: 1px solid #222;
                margin: 35px;
            }

            .invoice-box {
                max-width: 400px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .table.table-bordered.parcel-invoice td {
                padding: 5px 20px;
            }

            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }


            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }

            .rtl table {
                text-align: right;
            }

            .rtl table tr td:nth-child(2) {
                text-align: left;
            }

            p {
                margin: 0;
            }

            .invoice-logo img {
                width: 180px;
            }
        </style>
    </head>

    <body>
        <!-- Modal content-->

        {{-- @foreach ($parcel as $show_data) --}}
            <div class="modal-content">
                <div class="modal-body printSection" style="width: 50rem;height:100vh;">
                    <div class="bar-code" style="width:50px;float: right">
                        <?php echo DNS2D::getBarcodeHTML(url('/') . '/track/parcel/' . $show_data->trackingCode, 'QRCODE', 2, 2); ?>
                    </div>
                    <div id="printableArea">

                        <div class="invoice-logo">
                            @foreach ($whitelogo as $key => $logo)
                                <img src="{{ asset($logo->image) }}">
                            @endforeach <br>
                        </div>
                        <div class="invoice-date">
                            <strong>{{ date('M-d-Y', strtotime($show_data->created_at)) }}</strong>
                        </div>
                        <div class="shipping-info">
                            <p style="font-size:40px; font-weight:900;"><strong>Merchant :
                                    {{ $show_data->merchant->companyName ?? '' }}</strong></p>
                            <h4 style="font-size:40px; font-weight:900;">Phone:
                                {{ $show_data->merchant->phoneNumber ?? '' }}</h4>
                        </div>

                        <div class="shipping-info">
                            <p style="font-size:40px; font-weight:900;"><strong>Customer :
                                    {{ $show_data->recipientName }}</strong></p>
                            <h4 style="font-size:40px; font-weight:900;">Phone: {{ $show_data->recipientPhone }}</h4>
                        </div>

                        <div class="shipping-info">
                            <p style="font-size:40px; font-weight:900;"><strong>Address :
                                    {{ $show_data->recipientAddress }} </strong></p>
                        </div>

                        <div class="shipping-info">
                            <p style="font-size:40px; font-weight:900;"><strong>Tracking ID :
                                    {{ $show_data->trackingCode }}</strong></p>
                        </div>
                        <div class="instruction-info" style="font-size:40px; font-weight:900;">
                            <strong>Instruction</strong>
                            <div class="codingo">
                                <ul>
                                    <li><strong>COD</strong></li>
                                    <li><strong>TK {{ $show_data->cod }}</strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="deliveryprocess action_buttons ">
                            <ul>
                                <li>
                                    <div class="form-group">
                                        <input type="checkbox" @if ($show_data->status == 4) checked @endif>
                                        <label>DELIVERY</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <input type="checkbox" @if ($show_data->status == 9) checked @endif>
                                        <label>CANCELLED</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <input type="checkbox" @if ($show_data->status == 5) checked @endif>
                                        <label>HOLD</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="merchant-note">
                            <p>Note: Turag , DHaka Bangladesh</p>
                            <p> Phone: 01936-222233 Email: turagcourier@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
        <script>
            function myFunction2() {
                window.print();
            }
        </script>
    </body>

    </html>
    <!-- Modal Section  -->
@endsection
