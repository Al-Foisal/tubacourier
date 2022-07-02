@extends('frontEnd.layouts.pages.deliveryman.master')
@section('title', 'Todays Payment')
@section('content')
    <div class="profile-edit mrt-30">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="{{ url('/deliveryman/submit-payment') }}" method="POST" id="myform" class="">
                    @csrf

                    <button type="submit" class="btn btn-primary" style="float: left;">Confirm Payment</button>
                    <div class="tab-inner table-responsive">
                        <hr>
                        <table id="example" class="table  table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="My-Button"></th>
                                    <th>Sl ID</th>
                                    <th>Tracking ID</th>
                                    <th>Date</th>
                                    <th>Shop Name</th>
                                    <th>Phone</th>
                                    <th>Agent</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Charge</th>
                                    <th>Sub Total</th>
                                    <th>L. Update</th>
                                    <th>Payment Status</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allparcel as $key => $value)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $value->id }}" name="parcel_id[]"
                                                form="myform">
                                        </td>
                </form>
                @php
                    $deliverymanInfo = App\Deliveryman::find($value->deliverymanId);
                    $merchantInfo = App\Merchant::find($value->merchantId);
                @endphp
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->trackingCode }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->companyName }}</td>
                <td>{{ $value->recipientPhone }}</td>
                <td>
                    {{ $value->agentname }}
                </td>
                <td>
                    @php
                        $parcelstatus = App\Parceltype::find($value->status);
                    @endphp
                    {{ $parcelstatus->title }}
                </td>
                <td> {{ $value->cod }}</td>
                <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}</td>
                <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
                <td>
                    @if ($value->merchantpayStatus == null)
                        NULL
                    @elseif($value->merchantpayStatus == 0)
                        Processing
                    @else
                        Paid
                    @endif
                </td>
                <td>
                    @php
                        $parcelnote = App\Parcelnote::where('parcelId', $value->id)
                            ->orderBy('id', 'DESC')
                            ->first();
                    @endphp
                    @if (!empty($parcelnote))
                        {{ $parcelnote->note }}
                    @endif
                </td>

                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- row end -->
    </div>
    <!-- Modal -->

@endsection
