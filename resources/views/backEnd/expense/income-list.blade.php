@extends('backEnd.layouts.master')
@section('title', 'Manage Income List')
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
                        <li class="breadcrumb-item active"><a href="#">Income</a></li>
                        <li class="breadcrumb-item active"><a href="#">Income</a></li>
                        <li class="breadcrumb-item active">Manage</li>
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
                            <h5>Manage Income</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('editor.e.index') }}" method="get" class="d-flex justify-content-start">
                                    <input type="date" name="date_time" required class="form-control">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                            <div class="card">
                                <div class="card-body">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Categorizes Date and Time</th>
                                                <th>Categorizes Income</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Day - {{ \Carbon\Carbon::parse($date_time)->format('l') }}</td>
                                                <td>{{ $day }}</td>
                                            </tr>
                                            <tr>
                                                <td>Month - {{ \Carbon\Carbon::parse($date_time)->format('F') }}</td>
                                                <td>{{ $month }}</td>
                                            </tr>
                                            <tr>
                                                <td>Year - {{ $date_time }}</td>
                                                <td>{{ $year }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Tracking Code</th>
                                                <th>Delivery Charge</th>
                                                <th>Created_at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($show_data as $key => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $value->trackingCode }}</td>
                                                    <td>{{ $value->deliveryCharge }}</td>
                                                    <td>{{ $value->created_at->format('d F, Y - H:i:s A') }}</td>
                                                </tr>
                                            @endforeach
                                            </tfoot>
                                    </table>
                                    {{ $show_data->links() }}
                                </div>
                                <!-- /.card-body -->
                            </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
