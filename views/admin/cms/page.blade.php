@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$cms->title}}</h1>
                </div>
                <!-- <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ url()->previous() }}" class="btn ipfs-button"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </ol>
                </div> -->
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
                            <h3 class="card-title">{{$cms->title}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{{ route('updatecms') }}" method="post" data-parsley-validate="">
                                <input type="hidden" class="form-control" name="id"
                                    value="{{($cms==null)?" ":$cms->id}}">
                                <input type="hidden" class="form-control" name="type"
                                    value="{{($cms==null)?" ":$cms->type}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Enter ..."
                                                value="{{($cms==null)?" ":$cms->title}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="compose-textarea" class="form-control" style="height: 300px" name='description' id="description">{{($cms==null)?" ":$cms->description}}</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary  ">Update</button>
                                    </div>

                                </div>

                            </form>
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
@stop
@section('scripts')
<script>
$(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
@stop