@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Programming Language </h1>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('programming_language.index') }}" class="btn ipfs-button"><i
                                class="fa fa-arrow-left"></i> Back</a>
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
                            <h3 class="card-title">Add Programming Language</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{{ route('programming_language.store') }}" method="post" data-parsley-validate="">
                                @csrf
                                <div class="product-item-box mb-3 add_input_item">
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                <label for="exampleTextarea">Name</label>
                                                <input type="text" class="form-control" id="categoryName"
                                                    placeholder="Name" name="name[]" value="{{ old('name') }}"
                                                    required data-parsley-required-message="Enter name">

                                                @if ($errors->has('name'))
                                                <span class="error session-error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-3 add-btn">
                                            <label>Action</label>
                                            <div class="form-group ">
                                                <input type="button" class="item_add btn btn-primary" value="Add">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row flex-row-reverse">
                                        <button type="submit" class="btn btn-primary">Add</button>
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
$(document).ready(function() {
    $('#parentId').select2();
    //Add more Image
    var wrapper1 = $(".add_input_item"); //Fields wrapper
    var add_button1 = $(".item_add"); //Add button ID

    var y = 1; //initlal text box count
    var yy = 1;
    $(add_button1).click(function(e) { //on add input button click
        e.preventDefault();
        y++; //text box increment
        yy = yy + 1;
        $(wrapper1).append(
            `
               <div class="row ">
                      <div class="col-sm-3">
                            <div class="form-group ">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name[]" value="{{ old('name') }}" required data-parsley-required-message="Enter name">

                            @if ($errors->has('name'))
                            <span
                                class="error session-error">{{ $errors->first('name') }}</span>
                            @endif
                            </div>
                        </div>

                    <div class="col-sm-3 add-btn">
                        <div class="form-group ">
                          <button class="btn btn-danger remove_field" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i></button>                          
                        </div>
                    </div>
                </div>

            `); //add input box

        $('#parentId_' + yy).select2();
    });

    $(wrapper1).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();
        y--;
    })
});
</script>
@stop