@extends('backEnd.layouts.master')
@section('title','Create Covarage')
@section('content')
  <div class="content-header">
    <div class="container-fluid">
        
        
        @if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif

@if(session('message'))
<div class="alert alert-{{session('type')}} m-4">
  {{session('message')}}
  </div>
@endif
        
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark">Welcome !! {{auth::user()->name}}</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Covarage</a></li>
            <li class="breadcrumb-item active">Create</li>
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
                <h5>Create covarage</h5>
              </div>
              <div class="quick-button">
                <a href="{{url('admin/covarage/manage')}}" class="btn btn-primary btn-actions btn-create">
                Manage
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
                      <h3 class="card-title">Add Covarage</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{url('admin/covarage/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">

                        <div class="col-sm-6 mb-3" id="district_select">
                          <select type="text" id="area_sts" name="area sts"  class="select2 area_change form-control{{ $errors->has('area_sts') ? ' is-invalid' : '' }}" value="{{ old('area_sts') }}"  placeholder="Delivery Area" required="required">
                            <option value="inside_dhaka">Inside Dhaka</option>
                            <option value="outside_dhaka">Outside Dhaka</option>
                            <option value="dhaka_suburb">Dhaka Suburb</option>
                          </select>    
                        
                        </div>
               
                        <div class="form-group">
                          <label for="district">District</label>
                              <input type="text" class="form-control {{ $errors->has('district') ? ' is-invalid' : '' }}" value="{{ old('district') }}" name="district" id="district">
                               @if ($errors->has('district'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('district') }}</strong>
                                </span>
                                @endif
                        </div>

             
                        <div class="form-group">
                          <label for="area">Area</label>
                              <input type="text" class="form-control {{ $errors->has('area') ? ' is-invalid' : '' }}" value="{{ old('area') }}" name="area" id="area">
                               @if ($errors->has('area'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('area') }}</strong>
                                </span>
                                @endif
                        </div>

             
                        <div class="form-group">
                          <label for="district">Post Code</label>
                              <input type="text" class="form-control {{ $errors->has('post_code') ? ' is-invalid' : '' }}" value="{{ old('post_code') }}" name="post_code" id="post_code">
                               @if ($errors->has('post_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('post_code') }}</strong>
                                </span>
                                @endif
                        </div>

             
                        <div class="form-group">
                          <label for="district">Home Delivery</label>
                              <input type="text" class="form-control {{ $errors->has('home_delivery') ? ' is-invalid' : '' }}" value="{{ old('home_delivery') }}" name="home_delivery" id="home_delivery">
                               @if ($errors->has('home_delivery'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_delivery') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="district">Lockdown</label>
                              <input type="text" class="form-control {{ $errors->has('lockdown') ? ' is-invalid' : '' }}" value="{{ old('lockdown') }}" name="lockdown" id="lockdown">
                               @if ($errors->has('lockdown'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lockdown') }}</strong>
                                </span>
                                @endif
                        </div>
             
                        <div class="form-group">
                          <label for="district">Charge 1kg</label>
                              <input type="text" class="form-control {{ $errors->has('charge_1kg') ? ' is-invalid' : '' }}" value="{{ old('charge_1kg') }}" name="charge_1kg" id="charge_1kg">
                               @if ($errors->has('charge_1kg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('charge_1kg') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="district">Charge 2kg</label>
                              <input type="text" class="form-control {{ $errors->has('charge_2kg') ? ' is-invalid' : '' }}" value="{{ old('charge_2kg') }}" name="charge_2kg" id="charge_2kg">
                               @if ($errors->has('charge_2kg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('charge_2kg') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="district">Charge 3kg</label>
                              <input type="text" class="form-control {{ $errors->has('charge_3kg') ? ' is-invalid' : '' }}" value="{{ old('charge_3kg') }}" name="charge_3kg" id="charge_3kg">
                               @if ($errors->has('charge_3kg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('charge_3kg') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="district">COD charge</label>
                              <input type="text" class="form-control {{ $errors->has('code_charge') ? ' is-invalid' : '' }}" value="{{ old('code_charge') }}" name="code_charge" id="code_charge">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection