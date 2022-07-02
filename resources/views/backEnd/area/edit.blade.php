@extends('backEnd.layouts.master')
@section('title','Area Edit')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="box-content">
            <div class="row">
              <div class="col-sm-12">
                  <div class="manage-button">
                    <div class="body-title">
                      <h5>Area Edit</h5>
                    </div>
                    <div class="quick-button">
                      <a href="{{url('admin/area/manage')}}" class="btn btn-primary btn-actions btn-create">
                      Manage Area
                      </a>
                    </div>  
                  </div>
                </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Area Edit Instructions</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                   <form action="{{url('admin/area/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                  @csrf
                  <div class="main-body">
                    <div class="row">
                       <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="name">Area Name</label>
                          <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$edit_data->name}}">
                           @if ($errors->has('name'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                       
                      </div>
                      <!-- column end -->

                      <div class="col-sm-12">
                        <div class="form-group">
                          <div class="custom-label">
                            <label>Select Union</label>
                          </div>
                    
                  
                          <div class="col-sm-6">
                            <select type="text"  class="select2 form-control{{ $errors->has('district_id') ? ' is-invalid' : '' }}" value="{{ old('district_id') }}" name="district_id" placeholder="Select District" required="required">
                                <option value="">Select Union</option>
                                @foreach($districts as $district)
                                <option value="{{$district->id}}" {{($edit_data->district_id == $district->id) ? 'selected' : '' }}>{{$district->name}}</option>
                                @endforeach
                            </select>    
                             @if ($errors->has('district_id'))
                                            <span class="invalid-feedback">
                                              <strong>{{ $errors->first('district_id') }}</strong>
                                            </span>
                                          @endif
                          </div>


                        </div>


                      </div>

                      <div class="col-sm-12 mrt-15">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <!-- col end -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">
      document.forms['editForm'].elements['status'].value="{{$edit_data->status}}"
    </script>
@endsection