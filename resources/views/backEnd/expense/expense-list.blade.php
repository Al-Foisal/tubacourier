@extends('backEnd.layouts.master')
@section('title', 'Manage Expense List')
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
                        <li class="breadcrumb-item active"><a href="#">Expense</a></li>
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
                            <h5>Manage Expense</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ route('editor.e.create') }}" class="btn btn-primary btn-actions btn-create">
                                Create
                            </a>
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
                                                <th>Categorizes Expense</th>
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
                                                <th>Category Name</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Created_at</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($show_data as $key => $value)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $value->expenseCategory->name }}</td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->amount }}</td>
                                                    <td>{{ $value->created_at }}</td>
                                                    {{-- <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td> --}}
                                                    <td>
                                                        <ul class="action_buttons dropdown">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                data-toggle="dropdown">Action Button
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                {{-- <li>
                                                                @if ($value->status == 1)
                                                                    <form action="{{ url('admin/district/inactive') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="unpublished"><i
                                                                                class="fa fa-thumbs-up"></i> Active</button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ url('admin/district/active') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_down"
                                                                            title="published"><i
                                                                                class="fa fa-thumbs-down"></i>
                                                                            Inactive</button>
                                                                    </form>
                                                                @endif
                                                            </li> --}}
                                                                <li>
                                                                    <a class="edit_icon"
                                                                        href="{{ route('editor.e.edit', $value->id) }}"
                                                                        title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('editor.e.delete', $value->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            onclick="return confirm('Are you delete this this?')"
                                                                            class="trash_icon" title="Delete"><i
                                                                                class="fa fa-trash"></i> Delete</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </ul>
                                                    </td>
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
@endsection
