@extends('frontEnd.layouts.master')
@section('title','Track Parcel')
@section('content')


<!--/ End Tracking -->
    <div class =" container">
            <div class="col-sm-12 ">
                <div class="row addpercel-inner">
                    <div class="col-sm-5 my-5">
                        <div class="track-left">
                            <!--<h4>Track Parcel</h4>-->
                            @foreach($trackInfos as $trackInfo)
							<div class="tracking-step">
								<div class="tracking-step-left">
									<strong>{{date('h:i A', strtotime($trackInfo->created_at))}}</strong>
									<p>{{date('M d, Y', strtotime($trackInfo->created_at))}}</p>
								</div>
								<div class="tracking-step-right"  style = "margin-top:19px;">
									<b>{{$trackInfo->notes? $trackInfo->notes->title: ''}}<b>
								</div>
							</div>
							@endforeach
                        </div>
                    </div>
                    <div class="col-sm-12  my-2">
                        <div class="track-right">
                            <h4>Customer and Parcel Details</h4>
                            <div class="item">
                                <p>Parcel ID</p>
                                <h6><strong>{{$trackparcel->trackingCode}}</strong></h6>
                            </div>
                            <div class="item">
                                <p>Customer Name :</p>
                                <h6><strong>{{$trackparcel->recipientName}}</strong></h6>
                            </div>
                            <div class="item">
                                <p>Customer Address :</p>
                                <h6><strong>{{$trackparcel->recipientAddress}}</strong></h6>
                            </div>
                        
                            <div class="item">
                                <p>Area :</p>
                                <h6><strong>{{$trackparcel->zonename}}</strong></h6>
                            </div>
                            @if(!empty($trackparcel->deliverymanId))
                            
                            @php
                                $deliverymanInfo = App\Deliveryman::find($trackparcel->deliverymanId);
                            @endphp
                            <div class="item">
                                <p>Rider Name :</p>
                                <h6><strong>{{$deliverymanInfo->name}}</strong></h6>
                            </div>
                            <div class="item">
                                <p>Rider Phone :</p>
                                <h6><strong>{{$deliverymanInfo->phone}}</strong></h6>
                            </div>
                            @endif
                            <div class="item">
                                <p>Last Update :</p>
                                <h6>{{$trackparcel->updated_at}}</h6>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection