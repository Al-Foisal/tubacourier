@extends('backEnd.layouts.master')
@section('title','Update Covarage')
@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark">Welcome !! {{auth::user()->name}}</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Covarage</a></li>
            <li class="breadcrumb-item active">Update</li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
            <div class="manage-button">
              <div class="body-title">
                <h5>Update Covarage</h5>
              </div>
              <div class="quick-button">
                <a href="{{url('admin/covarage/manage')}}" class="btn btn-primary btn-actions btn-create">
                Manage
                </a>
                <a href="{{url('admin/covarage/add')}}" class="btn btn-primary btn-actions btn-create">
                Create
                </a>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box-content">
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Covarage  Update</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{url('admin/covarage/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                      @csrf
                      <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">
                      <div class="card-body">
              
            


           
                        <div class="col-sm-6 mb-3" id="district_select">
                          <select type="text" name="area_sts"  class="select2 area_change form-control{{ $errors->has('area_sts') ? ' is-invalid' : '' }}" value="{{ old('area_sts') }}"  placeholder="Delivery Area" required="required">
                            <option value="inside_dhaka">Inside Dhaka</option>
                            <option value="outside_dhaka">Outside Dhaka</option>
                            <option value="dhaka_suburb">Dhaka Suburb</option>
                          </select>    
                        
                        </div>



                        <div class="form-group">
                          <label for="district">District</label>
                              <input type="text" class="form-control {{ $errors->has('district') ? ' is-invalid' : '' }}" value="{{ $edit_data->district}}" name="district" id="district">
                               @if ($errors->has('district'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('district') }}</strong>
                                </span>
                                @endif
                        </div>

             
                        <div class="form-group">
                          <label for="area">Area</label>
                              <input type="text" class="form-control {{ $errors->has('area') ? ' is-invalid' : '' }}" value="{{ $edit_data->area}}" name="area" id="area">
                               @if ($errors->has('area'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('area') }}</strong>
                                </span>
                                @endif
                        </div>

             
                        <div class="form-group">
                          <label for="covarage">Post Code</label>
                              <input type="text" class="form-control {{ $errors->has('post_code') ? ' is-invalid' : '' }}" value="{{ $edit_data->post_code}}" name="post_code" id="post_code">
                               @if ($errors->has('post_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('post_code') }}</strong>
                                </span>
                                @endif
                        </div>

             
                        <div class="form-group">
                          <label for="covarage">Home Delivery</label>
                              <input type="text" class="form-control {{ $errors->has('home_delivery') ? ' is-invalid' : '' }}" value="{{ $edit_data->home_delivery}}" name="home_delivery" id="home_delivery">
                               @if ($errors->has('home_delivery'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_delivery') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="covarage">Lockdown</label>
                              <input type="text" class="form-control {{ $errors->has('lockdown') ? ' is-invalid' : '' }}" value="{{ $edit_data->lockdown}}" name="lockdown" id="lockdown">
                               @if ($errors->has('lockdown'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lockdown') }}</strong>
                                </span>
                                @endif
                        </div>
             
                        <div class="form-group">
                          <label for="covarage">Charge 1kg</label>
                              <input type="text" class="form-control {{ $errors->has('charge_1kg') ? ' is-invalid' : '' }}" value="{{ $edit_data->charge_1kg}}" name="charge_1kg" id="charge_1kg">
                               @if ($errors->has('charge_1kg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('charge_1kg') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="covarage">Charge 2kg</label>
                              <input type="text" class="form-control {{ $errors->has('charge_2kg') ? ' is-invalid' : '' }}" value="{{ $edit_data->charge_2kg}}" name="charge_2kg" id="charge_2kg">
                               @if ($errors->has('charge_2kg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('charge_2kg') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="covarage">Charge 3kg</label>
                              <input type="text" class="form-control {{ $errors->has('charge_3kg') ? ' is-invalid' : '' }}" value="{{ $edit_data->charge_3kg}}" name="charge_3kg" id="charge_3kg">
                               @if ($errors->has('charge_3kg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('charge_3kg') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="covarage">COD charge</label>
                              <input type="text" class="form-control {{ $errors->has('code_charge') ? ' is-invalid' : '' }}" value="{{ $edit_data->code_charge}}" name="code_charge" id="code_charge">
                               @if ($errors->has('code_charge'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code_charge') }}</strong>
                                </span>
                                @endif
                        </div>



                   <!-- /.form-group -->
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                  </div>
              </div>
              <!-- col end -->
              <div class="col-sm-2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <script type="text/javascript">
      document.forms['editForm'].elements['areatype'].value="{{$edit_data->areatype}}"
      document.forms['editForm'].elements['status'].value="{{$edit_data->status}}"
    </script>
@endsection
