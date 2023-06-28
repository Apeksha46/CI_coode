@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Service Line Categories </h1>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('categories_trees.index') }}" class="btn ipfs-button"><i
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
                <div class="col-5">
                    <div class="card table-responsive">
                        <div class="card-header">
                            <h3 class="card-title">Add Parent Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('add-category') }}" method="post" data-parsley-validate="">
                                @csrf
                                <div class="product-item-box mb-3 add_item">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="exampleTextarea">Category Name</label>
                                                <input type="text" class="form-control" id="categoryName"
                                                    placeholder="Category Name" name="name[]" value="{{ old('name') }}"
                                                    required data-parsley-required-message="Enter name">

                                                @if ($errors->has('name'))
                                                <span class="error session-error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-3 add-btn">
                                            <label>Action</label>
                                            <div class="form-group ">
                                                <input type="button" class="itemAdd btn btn-primary" value="Add">
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
                </div>
                <!-- /.card -->

                <div class="col-7">
                    <div class="card table-responsive">
                        <div class="card-header">
                            <h3 class="card-title">Add Service Line Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{{ route('categories_trees.store') }}" method="post" data-parsley-validate="">
                                @csrf
                                <div class="product-item-box mb-3 add_input_item">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label>Select Parent Category</label>
                                                <fieldset>

                                                    <select class="form-control select2" style="width: 100%;" name="parent_id[]" id="parentId_1" required data-parsley-min="1" data-parsley-min-message="Select Parent
                                                            Category" data-parsley-class-handler=".checkbox-errors">
                                                        <option value="0" selected="selected">Select Parent
                                                            Category</option>
                                                        @foreach ($categories as $category)

                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    <div class="checkbox-errors"></div>
                                                    <span class="error" class="checkbox-errors" style="display: none;">Select Parent Category</span>
                                                </fieldset>

                                            </div>
                                            
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                <label for="exampleTextarea">Category Name</label>
                                                <input type="text" class="form-control" id="categoryName"
                                                    placeholder="Category Name" name="name[]" value="{{ old('name') }}"
                                                    required data-parsley-required-message="Enter name" style="height: 42px;">

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
                                        <button type="submit" class="btn btn-primary" id="myform">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>

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

// $(".select2").select2({
//     placeholder: "Assign to:",
//     allowClear: true
// });
    
$(document).ready(function() {
   
    //Add more Image
    var wrapper1 = $(".add_item"); //Fields wrapper
    var add_button1 = $(".itemAdd"); //Add button ID

    var y = 1; //initlal text box count
    var yy = 1;
    $(add_button1).click(function(e) { //on add input button click
        e.preventDefault();
        y++; //text box increment
        yy = yy + 1;
        $(wrapper1).append(
            `
               <div class="row ">                  
                      <div class="col-sm-6">
                            <div class="form-group ">
                            <input type="text" class="form-control" id="categoryName" placeholder="Category Name" name="name[]" value="{{ old('name') }}" required data-parsley-required-message="Enter name">

                            @if ($errors->has('name'))
                            <span
                                class="error session-error">{{ $errors->first('name') }}</span>
                            @endif
                            </div>
                        </div>

                    <div class="col-sm-3 add-btn">
                        <div class="form-group ">
                          <button class="btn btn-danger removeField" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i></button>                          
                        </div>
                    </div>
                </div>

            `); //add input box
    });

    $(wrapper1).on("click", ".removeField", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();
        y--;
    })
});


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
            `<div class="row ">
                      <div class="col-md-6 col-sm-12">
                            <div class="form-group ">
                                <fieldset>
                                    <select class="form-control select2" style="width: 100%;" name="parent_id[]" id="parentId_` + yy + `" required data-parsley-min="1" data-parsley-min-message="Select Parent
                                                                Category" data-parsley-class-handler=".checkbox-errors">
                                        <option value="0" selected="selected">Select Parent Category</option>
                                        @foreach ($categories as $category)

                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="checkbox-errors"></div>
                                    <span class="error" class="checkbox-errors" style="display: none;">Select Parent Category</span>
                                </fieldset>
                            </div>
                        </div>
                  
                      <div class="col-sm-3">
                            <div class="form-group ">
                            <input type="text" class="form-control" style="height: 42px;" id="categoryName" placeholder="Category Name" name="name[]" value="{{ old('name') }}" required data-parsley-required-message="Enter name">

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

$(document).ready(function() {

    var parsleyConfig = {
        errorsContainer: function(parsleyField) {
            var fieldSet = parsleyField.$element.closest('fieldset');
console.log("fieldSet.length",fieldSet.length)
            if (fieldSet.length > 0) {
                return fieldSet.find('.checkbox-errors');
                // $(".checkbox-errors").css("display", "block");
                // return;
                // return fieldSet.find('#checkbox-errors');
            }
            // alert(2);
            // $(".checkbox-errors").css("display", "block");

            // var $container = element.parent().find(".parsley-container");
            // if ($container.length === 0) {
            //     $container = $("<div class='parsley-container'></div>").insertBefore(element);
            // }
            // return $container;
            return parsleyField;
        }
    };


    $("form").parsley(parsleyConfig);
    
});
</script>
@stop
