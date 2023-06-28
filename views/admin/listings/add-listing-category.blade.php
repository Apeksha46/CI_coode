@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add listing Category</h1>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('listing-category.index') }}" class="btn ipfs-button"><i
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
                            <h3 class="card-title">Add Categories Trees</h3>
                            <!-- <div style="float:right">
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'excel']) }}" class="btn ipfs-button"><i class="fa fa-file-excel-o"></i> Excel</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'pdf']) }}" class="btn ipfs-button"><i class="fa fa-file-pdf-o"></i> PDF</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'csv']) }}" class="btn ipfs-button"><i class='fas fa-file-csv'></i> CSV</a>
                </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('listing-category.store') }}" method="post"
                                enctype="multipart/form-data" id="documentAdmin" data-parsley-validate="">
                                @csrf
                                <div class="product-item-box mb-3 add_input_item">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                <label for="exampleTextarea">Name</label>
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="data[0][name]" value="{{ old('name') }}" required
                                                    data-parsley-required-message="Enter name">

                                                @if ($errors->has('name'))
                                                <span class="error session-error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group ">
                                                <label for="exampleTextarea">Icon</label>

                                                <input type="file" class="form-control" required name="data[0][image]"
                                                    data-parsley-required-message="Select image">

                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <div class="form-group ">
                                                <label>Select Branch</label>

                                                <select class="form-control select2" multiple="multiple" id="branchId_1"
                                                    name="data[0][listing_branch][]" style="width: 100%;" required
                                                    data-parsley-required-message="Select Branch">
                                                    @foreach ($listing_branch as $branch)
                                                    <option value="{{ $branch->id }}">
                                                        {{ ucfirst($branch->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-1 add-btn">
                                            <label>Action</label>
                                            <div class="form-group ">
                                                <input type="button" class="item_add btn btn-primary" value="Add">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row flex-row-reverse">
                                        <button type="submit" class="btn btn-primary"
                                            id="addListingCategory">Add</button>
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
    var data_index = 0;
    var y = 1; //initlal text box count
    var yy = 1;
    $(add_button1).click(function(e) { //on add input button click
        e.preventDefault();
        y++; //text box increment
        data_index = data_index + 1;
        yy = yy + 1;
        $(wrapper1).append(`
        <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                <input type="text" class="form-control" 
                                                    placeholder="Name" name="data[` + data_index + `][name]" value="{{ old('name') }}"
                                                    required data-parsley-required-message="Enter name">

                                                @if ($errors->has('name'))
                                                <span class="error session-error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group ">
                                                <input type="file" class="form-control" required name="data[` +
            data_index +
            `][image]" data-parsley-required-message="Select image">

                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group ">

                                                <select class="form-control select2" multiple="multiple" name="data[` +
            data_index + `][listing_branch][]" id="branchId_` + yy + `" style="width: 100%;" required
                                                    data-parsley-required-message="Select Branch">
                                                    @foreach ($listing_branch as $branch)
                                                    <option value="{{ $branch->id }}">
                                                        {{ ucfirst($branch->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-1 add-btn">
                                            <div class="form-group ">
                                                <button class="btn btn-danger remove_field" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i></button>        
                                            </div>
                                        </div>
                                    </div>
        `); //add input box

        $('#branchId_' + yy).select2();
    });

    $(wrapper1).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();
        y--;
    })
});
</script>
@stop