@extends('backEnd.layouts.master')
@section('title', 'Update Expense Category')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Welcome !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="#">Expense Category</a></li>
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
                            <h5>Update Expense Category</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ route('editor.ec.index') }}" class="btn btn-primary btn-actions btn-create">
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
                                        <h3 class="card-title">Expense Category Update</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ route('editor.ec.update',$edit_data) }}" method="POST"
                                        enctype="multipart/form-data" name="editForm">
                                        @csrf
										@method('patch')
                                        
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    value="{{ $edit_data->name }}" name="name" id="name">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
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
@endsection
