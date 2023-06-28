@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add listing Sub Categories Trees</h1>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ URL::previous() }}" class="btn ipfs-button"><i
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
                            <h3 class="card-title">Add Sub Categories Trees</h3>
                            <!-- <div style="float:right">
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'excel']) }}" class="btn ipfs-button"><i class="fa fa-file-excel-o"></i> Excel</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'pdf']) }}" class="btn ipfs-button"><i class="fa fa-file-pdf-o"></i> PDF</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'csv']) }}" class="btn ipfs-button"><i class='fas fa-file-csv'></i> CSV</a>
                </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <input type="text" class="form-control" id="listingCatName"
                                            placeholder="Category Name"
                                            value="{{ucfirst($listing_cat_branch->listingCategory->name)}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Branch</label>
                                        <input type="text" class="form-control" id="listingCatBranch"
                                            placeholder="Branch"
                                            value="{{ucfirst($listing_cat_branch->listingBranch->name)}}" readonly>
                                    </div>
                                </div>
                            </form>

                            <form action="{{route('listing-subcategory.store')}}" method="post" data-parsley-validate="">
                            <input type="hidden" class="form-control" placeholder="Name" name="listing_cat_branchId" value="{{$listing_cat_branch->id}}">
                            <input type="hidden" class="form-control" placeholder="Name" name="listing_cat_id" value="{{$listing_cat_branch->listing_cat_id}}">
                            <input type="hidden" class="form-control" placeholder="Name" name="listing_branch_id" value="{{$listing_cat_branch->listing_branch_id}}">
                            <input type="hidden" class="form-control" placeholder="Name" name="listingBranch" value="{{$listing_cat_branch->listingBranch->name}}">
                                @csrf
                                <div class="product-item-box mb-3 add_input_item">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            @if($listing_cat_branch->listingBranch->name == 'countries')
                                            <div class="form-group ">
                                                <label>Select Country</label>
                                                
                                                <select class="select2" multiple="multiple"
                                                    data-placeholder="Select Country" style="width: 100%;" name="data[0][name][]"
                                                    id="country_1" required
                                                    data-parsley-required-message="Select Country">

                                                    @foreach ($countryList as $country)
                                                    <option value="{{ $country->name }}">
                                                        {{ ucfirst($country->name) }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                            @elseif($listing_cat_branch->listingBranch->name == 'states')
                                            <div class="form-group ">
                                                <label>Select State</label>
                                                <select class="select2" multiple="multiple"
                                                    data-placeholder="Select State" style="width: 100%;" name="data[0][name][]"
                                                    id="state_1" required
                                                    data-parsley-required-message="Select State">

                                                    @foreach ($stateList as $state)
                                                    <option value="{{ $state->name }}">
                                                        {{ ucfirst($state->name) }}</option>
                                                    @endforeach
                                                </select>
                                                


                                            </div>
                                            @elseif($listing_cat_branch->listingBranch->name == 'cities')
                                            <div class="form-group ">
                                                <label>Select City</label>
                                                <select class="select2" multiple="multiple"
                                                    data-placeholder="Select City" style="width: 100%;" name="data[0][name][]"
                                                    id="city_1" required
                                                    data-parsley-required-message="Select City">

                                                    @foreach ($cityList as $city)
                                                    <option value="{{ $city->name }}">
                                                        {{ ucfirst($city->name) }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @else
                                                <div class="form-group ">
                                                    <label for="exampleTextarea">Name</label>
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        name="data[0][name]" value="{{ old('name') }}" required
                                                        data-parsley-required-message="Enter name">

                                                    @if ($errors->has('name'))
                                                    <span class="error session-error">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>

                                            @endif

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
    var data_index = 0;
    var y = 1; //initlal text box count
    var yy = 1;
    $(add_button1).click(function(e) { //on add input button click
        e.preventDefault();
        y++; //text box increment
        data_index = data_index + 1;
        yy = yy + 1;
        $(wrapper1).append(
            `
        <div class="row">
        <div class="col-sm-4">
                                            @if($listing_cat_branch->listingBranch->name == 'countries')
                                            <div class="form-group ">
                                                <select class="select2" multiple="multiple"
                                                    data-placeholder="Select Country" style="width: 100%;" name="data[` + data_index + `][name][]"
                                                    id="country_` + yy + `" required
                                                    data-parsley-required-message="Select Country>

                                                    @foreach ($countryList as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ ucfirst($country->name) }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                            @elseif($listing_cat_branch->listingBranch->name == 'states')
                                            <div class="form-group ">
                                                <select class="select2" multiple="multiple"
                                                    data-placeholder="Select State" style="width: 100%;" name="data[` + data_index + `][name][]"
                                                    id="state_` + yy + `" required
                                                    data-parsley-required-message="Select State">

                                                    @foreach ($stateList as $state)
                                                    <option value="{{ $state->id }}">
                                                        {{ ucfirst($state->name) }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                            @elseif($listing_cat_branch->listingBranch->name == 'cities')
                                            <div class="form-group ">
                                                <select class="select2" multiple="multiple"
                                                    data-placeholder="Select City" style="width: 100%;" name="data[` + data_index + `][name][]"
                                                    id="city_` + yy + `" required
                                                    data-parsley-required-message="Select City">

                                                    @foreach ($cityList as $city)
                                                    <option value="{{ $city->id }}">
                                                        {{ ucfirst($city->name) }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @else
                                            <div class="form-group ">
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="data[` + data_index + `][name]" value="{{ old('name') }}" required
                                                    data-parsley-required-message="Enter name">
                                                    

                                                @if ($errors->has('name'))
                                                <span class="error session-error">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>

                                            @endif

                                        </div>
                                        <div class="col-sm-3 add-btn">
                                            <div class="form-group ">
                                                <button class="btn btn-danger remove_field" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i></button>        
                                            </div>
                                        </div>
                                    </div>
        `); //add input box

        $('#country_' + yy).select2();
        $('#state_' + yy).select2();
        $('#city_' + yy).select2();
    });

    $(wrapper1).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();
        y--;
    })
});
</script>
@stop