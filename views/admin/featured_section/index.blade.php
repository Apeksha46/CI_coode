@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Featured Section</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card table-responsive">
                            <div class="card-header">
                                <h3 class="card-title">Featured Section Details</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="" class="table table-bordered table-hover ">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Top Android Company</td>
                                            <td>published</td>
                                            <td>
                                                <button type="button" class="btn btn-primary">show</button>
                                                <button type="button" class="btn btn-danger">Unpublished</button>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Top Blockchain Company</td>
                                            <td>unpublished</td>
                                            <td>
                                                <button type="button" class="btn btn-primary">show</button>
                                                <button type="button" class="btn btn-success">published</button>

                                            </td>
                                        </tr>
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
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="addNewCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Category Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('listing-category.store') }}" id="add-listing-category-name">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Category Name</label>
                                    @if ($errors->has('categoryName'))
                                        {{ $valid = 'is-invalid' }}
                                    @else
                                        {{ $valid = '' }}
                                    @endif
                                    <input type="text" {{ $valid }} class="form-control" name="categoryName"
                                        placeholder="Category">
                                    @if ($errors->has('categoryName'))
                                        <span class="error session-error">{{ $errors->first('categoryName') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn ipfs-button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn ipfs-button">Add</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@stop
