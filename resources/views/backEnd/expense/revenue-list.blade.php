@extends('backEnd.layouts.master')
@section('title', 'Manage Revenue List')
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
                        <li class="breadcrumb-item active"><a href="#">Revenue</a></li>
                        <li class="breadcrumb-item active"><a href="#">Revenue</a></li>
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
                            <h5>Manage Revenue</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('editor.e.revenue') }}" method="get"
                                    class="d-flex justify-content-start">
                                    <input type="date" name="date_time" required class="form-control">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h1>Income for <i>{{ $date_time }}</i></h1>
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
                                            <td>{{ $day_income }}</td>
                                        </tr>
                                        <tr>
                                            <td>Month - {{ \Carbon\Carbon::parse($date_time)->format('F') }}</td>
                                            <td>{{ $month_income }}</td>
                                        </tr>
                                        <tr>
                                            <td>Year - {{ $date_time }}</td>
                                            <td>{{ $year_income }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-body">
                                <h1>Expense for <i>{{ $date_time }}</i></h1>
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Categorizes Date and Time</th>
                                            <th>Categorizes Expense</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Day - {{ \Carbon\Carbon::parse($date_time)->format('l') }}</td>
                                            <td>{{ $day_expense }}</td>
                                        </tr>
                                        <tr>
                                            <td>Month - {{ \Carbon\Carbon::parse($date_time)->format('F') }}</td>
                                            <td>{{ $month_expense }}</td>
                                        </tr>
                                        <tr>
                                            <td>Year - {{ $date_time }}</td>
                                            <td>{{ $year_expense }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h1>Revenue for <i>{{ $date_time }}</i></h1>
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Categorizes Date and Time</th>
                                            <th>Categorizes Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Day - {{ \Carbon\Carbon::parse($date_time)->format('l') }}</td>
                                            <td>{{ $day_revenue }}</td>
                                        </tr>
                                        <tr>
                                            <td>Month - {{ \Carbon\Carbon::parse($date_time)->format('F') }}</td>
                                            <td>{{ $month_revenue }}</td>
                                        </tr>
                                        <tr>
                                            <td>Year - {{ $date_time }}</td>
                                            <td>{{ $year_revenue }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
