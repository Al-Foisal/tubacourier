@extends('backEnd.layouts.master')
@section('title', 'Page List')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark">Welcome !! {{auth::user()->name}}</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Banner</a></li>
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
                <h5>Create Manage</h5>
              </div>
              <div class="quick-button">
                <a href="{{ route('editor.pageCreate') }}" class="btn btn-primary btn-actions btn-create">
                Create
                </a>
              </div>
            </div>
          </div>
      </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $page->title }}</td>
                                            <td>{!! str_limit($page->details, $limit = 150, $end = '...') !!}</td>
                                            <td><ul class="action_buttons dropdown">
                                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                                              <span class="caret"></span></button>
                                              <ul class="dropdown-menu">
                                                <li>
                                                  @if($page->status==1)
                                                  <form action="{{ route('editor.pageInactive', $page) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="hidden_id" value="{{$page->id}}">
                                                    <button type="submit" class="thumbs_up" title="unpublished"><i class="fa fa-thumbs-up"></i> Active</button>
                                                  </form>
                                                  @else
                                                    <form action="{{ route('editor.pageActive', $page) }}" method="POST">
                                                      @csrf
                                                      <input type="hidden" name="hidden_id" value="{{$page->id}}">
                                                      <button type="submit" class="thumbs_down" title="published"><i class="fa fa-thumbs-down"></i> Inactive</button>
                                                    </form>
                                                  @endif
                                                </li>
                                                  <li>
                                                      <a class="edit_icon" href="{{ route('editor.pageEdit', $page) }}" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                  </li>
                                                  <li>
                                                    <form action="{{ route('editor.pageDelete', $page) }}" method="POST">
                                                      @csrf
                                                      @method('delete')
                                                      <input type="hidden" name="hidden_id" value="{{$page->id}}">
                                                      <button type="submit" onclick="return confirm('Are you delete this this?')" class="trash_icon" title="Delete"><i class="fa fa-trash"></i> Delete</button>
                                                    </form>
                                                  </li>
                                                </ul>
                                              </ul>
                                          </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsLink')
@endsection
@section('jsScript')
@endsection
