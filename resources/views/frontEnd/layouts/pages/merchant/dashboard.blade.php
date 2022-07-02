@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('title','Dashboard')
@section('content')
<!-- <section  class="section-padding dashboard-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
      <div class="stats-reportList-inner">
        <div class="row">
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-info">
              <div class="stats-per-item">
                <h5>Total Parcel</h5>
                <h3>{{$placepercel}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-secondary">
              <div class="stats-per-item">
                <h5>Total Pending</h5>
                <h3>{{$pendingparcel}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-danger">
              <div class="stats-per-item">
                <h5>In Transit</h5>
                <h3>{{$intransitparcel}}</h3>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-success">
              <div class="stats-per-item">
                <h5>Total Delivered</h5>
                <h3>{{$deliverd}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-danger">
              <div class="stats-per-item">
                <h5>Total Cancelled</h5>
                <h3>{{$cancelparcel}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-warning">
              <div class="stats-per-item">
                <h5>Returned To Merchant</h5>
                <h3>{{$parcelreturn}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-info">
              <div class="stats-per-item">
                <h5>Total Hold</h5>
                <h3>{{$totalhold}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-primary">
              <div class="stats-per-item">
                <h5>Collected Amount From DA</h5>
                <h3>{{$collectamount}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-success">
              <div class="stats-per-item">
                <h5>Total Paid</h5>
                <h3>{{$totalpaid}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="dashboard-payment-info">
        <div class="row">
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-dark">
              <div class="stats-per-item">
                <h5>Total Amount</h5>
                <h3>{{$totalamount}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-success">
              <div class="stats-per-item">
                <h5>Paid Amount</h5>
                <h3>{{$merchantPaid}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
            <div class="stats-reportList bg-danger">
              <div class="stats-per-item">
                <h5>Unpaid Amount</h5>
                <h3>{{$merchantUnPaid}}</h3>
              </div>
            </div>
          </div>
          
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
      </div>
    </div>
  </div>
</section> -->

<section class="section-padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="stats-widget">

            <div class="stats-item">
              <div class="stats-name">
                <img src="{{asset('frontEnd')}}/images/deliverd.png" alt="">
                <h4>Paid Amount</h4>
              </div>
              <div class="stats-count">
                <h3>{{$deliverd}}</h3>
              </div>
            </div>
            <div class="stats-item">
              <div class="stats-name">
                <img src="{{asset('frontEnd')}}/images/cancel.png" alt="">
                <h4>Cancelled</h4>
              </div>
              <div class="stats-count">
                <h3>{{$cancelled}}</h3>
              </div>
            </div>
            <div class="stats-item">
              <div class="stats-name">
                <img src="{{asset('frontEnd')}}/images/balance.png" alt="">
                <h4>Total Amount</h4>
              </div>
              <div class="stats-count">
                <h3>{{$totalamount}}</h3>
              </div>
            </div>
            
            <div class="stats-thumb">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="thumb-inner">
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h5>Deliverd</h5>
                      </div>
                      <div class="list-count">
                        <h5>{{$deliverdparcels}}</h5>
                      </div>
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h5>Par-Delivered</h5>
                      </div>
                      <div class="list-count">
                        <h5>{{$pardeliverdparcels}}</h5>
                      </div>
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h5>Cancelled</h5>
                      </div>
                      <div class="list-count">
                        <h5>{{$canelledparcels}}</h5>
                      </div>
                    </div>

                 </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="thumb-inner thub-right">
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h5>Cleared</h5>
                      </div>
                      <div class="list-count">
                        <h5>0</h5>
                      </div>
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h5>Delivered Charge</h5>
                      </div>
                      <div class="list-count">
                        <h5>{{$deliverycharge}}</h5>
                      </div>
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h5>COD</h5>
                      </div>
                      <div class="list-count">
                        <h5>{{$codcharge}}</h5>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        

        
        <!-- column end -->
        <div class="col-sm-6">
          <div class="stats-widget">

            <div class="stats-item">
              <div class="stats-name">
                <img src="{{asset('frontEnd')}}/images/totalpending.png" alt="">
                <h4>Total Pending</h4>
              </div>
              <div class="stats-count">
                <h3>{{$pendingparcels}}</h3>
              </div>
            </div>
            <div class="stats-item">
              <div class="stats-name">
                <img src="{{asset('frontEnd')}}/images/lastday.png" alt="">
                <h4>Last Day</h4>
              </div>
              <div class="stats-count">
                <h3>{{$lastdaypendingparcels}}</h3>
              </div>
            </div>
            <div class="stats-item">
              <div class="stats-name">
                <img src="{{asset('frontEnd')}}/images/pendingamount.png" alt="">
                <h4>Unpaid Amout</h4>
                <a href="https://zuri.express/merchant/support/" target="_blank">Payment Request</a>
              </div>
              <div class="stats-count">
                <h3>{{$pendingamount}}</h3>
              </div>
            </div>
            
            <div class="stats-thumb">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <div class="thumb-inner">
                    <div class="stats-thumb-list">
                      <div class="list-name-right">
                        <h5>Merchant Notice</h5>
                      </div>
                      
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name-right">
                        <h5>________</h5>
                      </div>
                      
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name-right">
                        <h5>_____</h5>
                      </div>
                    </div>
                 </div>
                </div>

                <div class="col-lg-4 col-sm-12">
                  <div class="thumb-inner thub-right">
                    <div class="stats-thumb-list">
                      <div class="list-name-right">
                        <h5>Merchant Offers</h5>
                      </div>
                      
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name-right">
                        <h5>________</h5>
                      </div>
                      
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name-right">
                        <h5>_____</h5>
                      </div>
                    </div>
                 </div>
                </div>
                
                <div class="col-lg-4 col-sm-12">
                  <div class="thumb-inner thub-right" style="background: #17A2B8;">
                    <div class="stats-thumb-list">
                      <div class="list-name-right">
                        <h6>Last 24 Hours</h6>
                      </div>
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h6>Parcel</h6>
                      </div>
                      <div class="list-count">
                        <h6>{{$last24hourparcels}}</h6>
                      </div>
                    </div>
                    <div class="stats-thumb-list">
                      <div class="list-name">
                        <h6>TK</h6>
                      </div>
                      <div class="list-count">
                        <h6>{{$last24hourtk}}</h6>
                      </div>
                    </div>
                 </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- column end -->
      </div>
    </div>
  </section>

  <section class="section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="stats-all-top">
          <h2>All Reports</h2>
        </div>
      </div>
      <!-- column end -->
      <div class="col-sm-12">
      <div class="stats-reportList-inner">
        <div class="row">

          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/tpercel.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>Total Parcel</h5>
                <h3>{{$totalparcels}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/tamount.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>Total Amount</h5>
                <h3>{{$totalamount}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/reversed.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>Reversed</h5>
                <h3>0</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/inreviewes.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>In Reviewed</h5>
                <h3>{{$inreviewdparcels}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/tdeliverd.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>Total Delivered</h5>
                <h3>{{$deliverdparcels}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/tamount.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>Delivered Amount</h5>
                <h3>{{$deliverd}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/deliverdcharge.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>Delivery Charge</h5>
                <h3>{{$deliverycharge}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 colo-md-3 col-sm-4 col-6">
            <div class="stats-reportList">
              <div class="stats-icon">
                <img src="{{asset('frontEnd')}}/images/cod.png" alt="">
              </div>
              <div class="stats-per-item">
                <h5>COD Charge</h5>
                <h3>{{$codcharge}}</h3>
              </div>
            </div>
          </div>

        </div>
      </div>
      </div>

    </div>
  </div>
</section>



@endsection