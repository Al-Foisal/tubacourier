@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('title', 'Parcel Create')
@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <section class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row addpercel-inner">
                        <div class="col-sm-12">

                            <!--
          <div class="bulk-upload">
           <a href="" data-toggle="modal" data-target="#exampleModal"> Bulk Upload</a>
          </div>-->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <thead>
                                                <tr>
                                                    <td>Excel File Column Instruction <a
                                                            href="{{ asset('frontEnd/images/example.xlsx') }}" download>
                                                            (Sample file ) </a></td>
                                                </tr>
                                            </thead>
                                            <table class="table table-bordered table-striped mt-1">
                                                <tbody>
                                                    <tr>
                                                        <td>Customer Name</td>
                                                        <td>Product Type</td>
                                                        <td>Customer Phone</td>
                                                        <td>Cash Collection Amount</td>
                                                        <td>Customer Address</td>
                                                        <td>Delivery Zone</td>
                                                        <td>Weight</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                            <form action="{{ url('merchant/parcel/import') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="file">Upload Excel</label>
                                                    <input class="form-control" type="file" name="excel"
                                                        accept=".xlsx, .xls">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-upload"></i> Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="addpercel-top">
                                <h3>Add New Parcel</h3>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="fraud-search">
                                <form action="{{ url('merchant/add/parcel') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name') }}" name="name" placeholder="Customer Name">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select type="text"
                                                    class="calculate package form-control{{ $errors->has('package') ? ' is-invalid' : '' }}"
                                                    value="{{ old('package') }}" name="package"
                                                    placeholder="Invoice or Memo Number" required="required">
                                                    <option value="">Select Service Package</option>
                                                    @foreach ($packages as $key => $value)
                                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('package'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('package') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select type="text"
                                                    class="form-control{{ $errors->has('percelType') ? ' is-invalid' : '' }}"
                                                    value="{{ old('percelType') }}" name="percelType"
                                                    placeholder="Invoice or Memo Number" required="required">
                                                    <option value="">Select Parcel Type</option>
                                                    <option value="1">Regular</option>
                                                    <option value="2">Liquid</option>
                                                    <option value="3">Fragile</option>
                                                </select>
                                                @if ($errors->has('percelType'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('percelType') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="number"
                                                    class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                    value="{{ old('phonenumber') }}" name="phonenumber"
                                                    placeholder="Customer Phone Number">
                                                @if ($errors->has('phonenumber'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="number"
                                                    class="calculate cod form-control{{ $errors->has('cod') ? ' is-invalid' : '' }}"
                                                    value="{{ old('cod') }}" name="cod" min="0"
                                                    placeholder="Cash Collection Amount">
                                                @if ($errors->has('cod'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('cod') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>




                                        <div class="col-sm-6">
                                            <select type="text" id="district_get"
                                                class="select2 form-control{{ $errors->has('division') ? ' is-invalid' : '' }}"
                                                value="{{ old('division') }}" placeholder="Delivery Area"
                                                required="required" name="division_id">
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('division'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('division') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-6 mb-3" id="district_select">
                                            <select type="text" id="area_get"
                                                class="select2 area_change form-control{{ $errors->has('district') ? ' is-invalid' : '' }}"
                                                value="{{ old('district') }}" placeholder="Delivery Area"
                                                required="required" name="district_id">

                                            </select>

                                        </div>



                                        <div class="col-sm-6 mb-3" id="area_select">
                                            <select type="text" id="area_list"
                                                class=" select2 form-control{{ $errors->has('areas') ? ' is-invalid' : '' }}"
                                                value="" placeholder="Delivery Area" required="required" name="area_id">

                                            </select>

                                        </div>

                                        <div class="col-sm-6 mb-3" id="union_select">
                                            <select type="text" id="union_list"
                                                class="select2 form-control{{ $errors->has('reciveZone') ? ' is-invalid' : '' }}"
                                                value="{{ old('reciveZone') }}" name="reciveZone"
                                                placeholder="Delivery Area" required="required">

                                            </select>

                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text"
                                                    class=" form-control{{ $errors->has('sale_price') ? ' is-invalid' : '' }}"
                                                    value="{{ old('sale_price') }}" name="sale_price"
                                                    placeholder="Sale Price">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text"
                                                    class=" form-control{{ $errors->has('invoice_id') ? ' is-invalid' : '' }}"
                                                    value="{{ old('invoice_id') }}" name="invoice_id"
                                                    placeholder="Invoice ID">
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="number"
                                                    class="calculate weight form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}"
                                                    value="{{ old('weight') }}" name="weight"
                                                    placeholder="Weight in KG">
                                            </div>
                                        </div>




                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                    value="{{ old('address') }}" name="address" placeholder="Customer Full Address"></textarea>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <textarea type="text" name="note" value="{{ old('note') }}" class="form-control" placeholder="Note"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <button type="submit" class="form-control">Submit</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-lg-1 col-md-1 col-sm-0"></div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="parcel-details-instance">
                            <h2>Delivery Charge Details</h2>
                            <div class="content calculate_result">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>Cash Collection</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            @if (Session::get('codpay'))
                                                {{ Session::get('codpay') }}
                                            @else
                                                0
                                            @endif Tk
                                        </p>
                                    </div>
                                </div>
                                <!-- row end -->
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>Delivery Charge</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            @if (Session::get('pdeliverycharge'))
                                                {{ Session::get('pdeliverycharge') }}
                                            @else
                                                0
                                            @endif Tk
                                        </p>
                                    </div>
                                </div>
                                <!-- row end -->
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>Cod Charge</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            @if (Session::get('pcodecharge'))
                                                {{ Session::get('pcodecharge') }}
                                            @else
                                                0
                                            @endif Tk
                                        </p>
                                    </div>
                                </div>
                                <!-- row end -->
                                <div class="row total-bar">
                                    <div class="col-sm-8">
                                        <p>Total Payable Amount</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>0 Tk</p>
                                    </div>
                                </div>
                                <!-- row end -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="text-center">Note : <span class="">If you request for pick up
                                                after 5pm, it will be collected on the next day</span></p>
                                    </div>
                                </div>
                                <!-- row end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <script>
            $('#district_select').hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
            });



            $('#district_get').on('change', function() {


                $('#district_select').show();


                var division_id = $(this).val();

                // $('#district_id_set').val(category_id);


                $.ajax({

                    type: 'get',
                    dataType: 'json',
                    url: "{{ asset('/') }}areas/get_district",
                    cache: false,
                    data: {

                        division_id: division_id

                    },
                    success: function(response) {


                        var formoption = "";
                        formoption += "<option value='" + "" + "'>" + "Select District" + "</option>";
                        $.each(response, function(v) {

                            var val = response[v];


                            formoption += "<option value='" + val.id + "'>" + val.name +
                            "</option>";

                        });

                        $('#area_get').html(formoption);

                    },

                });



            });




            $('#area_select').hide();


            $('.area_change').on('change', function() {



                var district_id = $(this).val();

                // $('#district_id_set').val(category_id);


                $.ajax({

                    type: 'get',
                    dataType: 'json',
                    url: "{{ asset('/') }}areas/get_area",
                    cache: false,
                    data: {

                        district_id: district_id

                    },
                    success: function(response) {

                        $('#area_select').show();
                        // $('#union_select').show();

                        var formoption = "";

                        formoption += "<option value='" + "" + "'>" + "Select Area" + "</option>";

                        $.each(response, function(v) {

                            var val = response[v];


                            formoption += "<option value='" + val.id + "'>" + val.name +
                            "</option>";

                        });

                        $('#area_list').html(formoption);

                    },

                });



            });




            $('#union_select').hide();


            $('#area_list').on('change', function() {



                var area_id = $(this).val();

                // $('#district_id_set').val(category_id);


                $.ajax({

                    type: 'get',
                    dataType: 'json',
                    url: "{{ asset('/') }}areas/get_union",
                    cache: false,
                    data: {

                        area_id: area_id

                    },
                    success: function(response) {

                        $('#union_select').show();

                        var formoption = "";

                        formoption += "<option value='" + "" + "'>" + "Select Union" + "</option>";








                        '<textarea type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" name="address"  placeholder="Customer Address"></textarea>'




                        $.each(response, function(v) {

                            var val = response[v];


                            formoption += "<option value='" + val.id + "'>" + val.zonename +
                                "</option>";



                        });

                        $('#union_list').html(formoption);

                    },

                });



            });
        </script>


    </section>

@endsection
