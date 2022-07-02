@extends('backEnd.layouts.master')
@section('title','Manage Merchant Payment')
@section('content')
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
                          <h4><b><p style="color:green">Manage Merchant Payment</P></b></h4>
                        </div>
                      </div>
                    </div>
                  <div class="card-body">
                      
                    <table id="Paymentinvoice" class="table table-bordered table-striped custom-table">
                      <thead>
                      <tr>
                        <th>Id</th>
                        <th>Done By</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Total Invoice</th>
                        <th>Total Payment(BDT)</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($merchantInvoice as $key=>$value)
                         @php
                            $cod = App\Parcel::where(['merchantId'=>$value->merchantId,'paymentInvoice'=>$value->id])->whereNotNull('merchantpayStatus')->sum('cod');
                            $deliverycharge = App\Parcel::where(['merchantId'=>$value->merchantId,'paymentInvoice'=>$value->id])->whereNotNull('merchantpayStatus')->sum('deliveryCharge');
                            $codcharge = App\Parcel::where(['merchantId'=>$value->merchantId,'paymentInvoice'=>$value->id])->whereNotNull('merchantpayStatus')->sum('codCharge');
                            $totalinvoice = App\Parcel::where(['merchantId'=>$value->merchantId,'paymentInvoice'=>$value->id])->whereNotNull('merchantpayStatus')->count();
                         @endphp
                        <tr>
                           
                          <td><p style="font-size:25px">{{$loop->iteration}}</p></td>
                          <td><p style="font-size:25px">
                             
                              {{$value->done_by}}
                             
                          </p></td>
                          
                          <td><p style="font-size:25px">{{date('d M Y', strtotime($value->created_at))}}</p></td>
                          <td><p style="font-size:25px">{{date("g:i a", strtotime($value->created_at))}}</p></td>
                          <td><p style="font-size:25px">{{$totalinvoice}}</p></td>
                          <td><p style="font-size:25px">{{$cod-($deliverycharge+$codcharge)}}</p></td>


                          <td>
                                <ul>
                                  <li>
                                      <a href="{{url('author/merchant/payment/invoice-details/'.$value->id)}}" title="View Payment Invoice"> <p style="font-size:25px"><i class="fa fa-eye"></i> View Invoice</p></a>
                                  </li>
                              </ul>
                        </td>


<!--                          <td>
                            <ul class="action_buttons dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                                <span class="caret"></span></button>
                                
                                <ul class="dropdown-menu">
                                  <li>
                                      <a class="edit_icon" href="{{url('author/merchant/payment/invoice-details/'.$value->id)}}" title="View"><i class="fa fa-eye"></i> View</a>
                                  </li>
                              </ul>
                          </td>--------------------------------------------->

                          
                        </tr>
                        @endforeach
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
          </div>
        </div>
    </div>
  </section>
<!-- Modal Section  -->



<script>
       $(document).ready(function() {
          $('#Paymentinvoice').DataTable( {
              dom: 'Bfrtip',
              "lengthMenu": [[ 200, 500, -1], [ 200, 500, "All"]],
              buttons: [
                  {
                      extend: 'copy',
                      text: 'Copy',
                      exportOptions: {
                           columns: [0, 1, 2, 3, 4]
                      }
                  },
                  {
                      extend: 'excel',
                      text: 'Excel',
                      exportOptions: {
                           columns: [ 0, 1, 2, 3, 4]
                      }
                  },
                  {
                      extend: 'csv',
                      text: 'Csv',
                      exportOptions: {
                           columns: [ 0, 1, 2, 3, 4]
                      }
                  },
                  {
                      extend: 'pdfHtml5',
                      exportOptions: {
                           columns: [  0,1, 2, 3, 4]
                      }
                  },
                  
                  {
                      extend: 'print',
                      text: 'Print',
                      exportOptions: {
                           columns: [  0,1, 2, 3, 4]
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
          } );
          
           table.buttons().container()
              .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      });
</script>





@endsection