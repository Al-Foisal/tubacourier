@extends('backEnd.layouts.master')
@section('title', 'Create Expense')
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
                        <li class="breadcrumb-item active"><a href="#">Expense</a></li>
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
                            <h5>Create Expense</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ route('editor.e.index') }}" class="btn btn-primary btn-actions btn-create">
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
                                        <h3 class="card-title">Add Expense</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ route('editor.e.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="areatype">Select Expense Category</label>
                                                        <select name="expense_category_id" required id=""
                                                            class="form-control">
                                                            <option value="">Select..</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('name') }}" name="name" id="name">
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                            value="{{ old('amount') }}" name="amount" id="amount">
                                                        @if ($errors->has('amount'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('amount') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="created_at">created_at</label>
                                                        <input type="date"
                                                            class="form-control {{ $errors->has('created_at') ? ' is-invalid' : '' }}"  created_at="created_at" id="created_at">
                                                        @if ($errors->has('created_at'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('created_at') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            {{-- <div class="form-group">
                                                <div class="custom-label">
                                                    <label>Publication Status</label>
                                                </div>
                                                <div class="box-body pub-stat display-inline">
                                                    <input
                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                        type="radio" id="active" name="status" value="1">
                                                    <label for="active">Active</label>
                                                    @if ($errors->has('status'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="box-body pub-stat display-inline">
                                                    <input
                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                        type="radio" name="status" value="0" id="inactive">
                                                    <label for="inactive">Inactive</label>
                                                    @if ($errors->has('status'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> --}}
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
