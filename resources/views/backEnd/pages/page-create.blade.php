@extends('backEnd.layouts.master')
@section('title', 'Create Page')
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
                    <h5>Create Page</h5>
                  </div>
                  <div class="quick-button">
                    <a href="{{route('editor.pageList')}}" class="btn btn-primary btn-actions btn-create">
                    Manage Pages
                    </a>
                  </div>
                </div>
              </div>
          </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('editor.pageStore') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title*</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter page title" name="title">
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-outline card-info form-group">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    Details*
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <textarea class="summernote form-control"  name="details"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

