@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listings Category</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card table-responsive">
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control form-control-lg" type="text" id="totalListingCategory"
                                    value="{{$ListingSubcategoryList->count()}} Listing Category Found" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <form action="">
                                        <!-- <div class="input-group">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-lg btn-default" disabled>
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                                <input type="search" class="form-control form-control-lg"
                                                    placeholder="Type company name or email here" name="search_keyword"
                                                    id="searchKeyword">
                                                   

                                            </div> -->
                                        <div class="row row_margin">
                                            <div class="col-3">

                                                <label></label>
                                                <select class="select2" style="width: 100%;" id="listing_category_name"
                                                    name="listing_category_name">
                                                    <option value="">Select Listing Category</option>
                                                  
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label></label>
                                                <select class="select2" style="width: 100%;" id="listing_category_branch"
                                                    name="listing_category_branch">
                                                    <option value="">Select Listing Branch</option>
                                                   
                                                </select>

                                            </div>
                                            <div class="col-2">

                                                <label></label>

                                                <select class="select2" style="width: 100%;"
                                                    id="listing_category_status" name="listing_category_status">
                                                    <option value=" ">Statuses</option>
                                                    <option value="0">Active</option>
                                                    <option value="1">Deactive</option>
                                                </select>

                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success button1" id="ApplyButton"
                                        onclick="getFilterListingCategory()">Apply</button>
                                    <button type="button" class="btn btn-info button1" id="ApplyButton"
                                        onclick="window.location.reload();">Clear
                                        all</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card table-responsive">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg total-selected-listing-category"
                                            value="0 Listing Category Found" disabled>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">

                                        <select class="select2 checkStatus" style="width: 100%;height:5px;" onChange="changeStatusListing(this.value);" disabled> 
                                            <option selected>Set status</option>
                                            <option value="0">Active</option>
                                            <option value="1">Deactive</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-8" align="right">
                                    <a href="{{ route('listing-category.create') }}" class="btn ipfs-button"><i
                                            class="fa fa-plus"></i> Add New Listings Category</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card table-responsive">
                        <div class="card-header">
                            <h3 class="card-title">Listings category Details</h3>

                        </div>
                        <div class="row col-12 ">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input tableCheckbox" type="checkbox" id="listing_category_selectall">
                                    <label class="form-check-label">Select all</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="" class="table table-bordered table-hover custom-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Category Name</th>
                                        <th>Category Branch</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @forelse ($ListingSubcategoryList as $lc)

                                    <tr>
                                        <td>
                                            <div class="form-check1">
                                                <input class="form-check-input listing-category-selected-Id" type="checkbox"
                                                    value="{{$lc->id}}" name="lc_id[]" onclick="checkBox();">
                                                <label class="form-check-label">{{ $i++."." }}</label>
                                            </div>

                                        </td>
                                        <td>
                                            {{ucfirst($lc->name)}}
                                        </td>
                                        <td>{{ucfirst($lc->ListingCategoryBranch->listingCategory->name)}}</td>
                                        <td>{{ucfirst($lc->ListingCategoryBranch->listingBranch->name)}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @empty
                                    <tr class="no-data-row">
                                        <td colspan="5" rowspan="2" align="center">
                                            <div class="message">
                                                <p>No data available in table</p>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforelse
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

<div class="modal fade" id="editListingCategory">
    <div class="modal-dialog">
        <form action="{{route('listing-category.update')}}" method="post" data-parsley-validate="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Listing Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="listingCatBrancheId" name="listingCatBrancheId" value="">
                    <input type="hidden" id="listing_cat_id" name="listing_cat_id" value="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category Name</label>
                            <<input type="text" class="form-control" id="listingCatName" placeholder="Name" name="name"
                                value="{{ old('name') }}" required data-parsley-required-message="Enter name">
                        </div>
                        <div class="form-group">
                            <label>Select Branch</label>
                            <select class="select2" multiple="multiple" data-placeholder="Select Branch"
                                style="width: 100%;" name="listing_branch[]" id="listing_branch">

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <div class="modal fade" id="selectValidation">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Alter Message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <p>Please select at alteast one checkbox</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</div>
@stop
@section('scripts')
<script>
    function changeStatusListing(id){
        // alert(id)

        var checkedValue = [];
        $.each($(".listing-category-selected-Id:checked"), function(){
            checkedValue.push($(this).val());
        });

        // alert(checkedValue+'=='+id);

        if(checkedValue.length == 0)
        {
           $('#selectValidation').modal('show');

        }
        else
        {
            $.ajax({
                type: "post",
                url: "{{ route('changeListingCategoryStatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'listing_category_status':id,
                    'listingCategoryId':checkedValue
                },
                success: function(data){

                    console.log(data)

                    if (data == 1) {
                        toastr.success("Status update succesfully");
                    } else {
                        toastr.error("Somethings went wrong");
                    }

                    location.reload();
                }
            });
        }
    }

    function checkBox()
    {
        $('.checkStatus').prop("disabled", false);

        var checkedValue = [];
        $.each($(".listing-category-selected-Id:checked"), function(){
            checkedValue.push($(this).val());
        });

        var totalSelectedListing = checkedValue.length + ' Listings Category selected';
        $('.total-selected-listing-category').val(totalSelectedListing)
    }

    $('#listing_category_selectall').on('click', function() {
        if(this.checked){
            $('.listing-category-selected-Id').each(function(){
                $('.checkStatus').prop("disabled", false);


                console.log("true");
                var selected_box = $(".listing-category-selected-Id").prop('checked', true);
                var totalSelectedListing = selected_box.length + ' Listings Category selected';
                $('.total-selected-listing-category').val(totalSelectedListing)
            })
        }else{
            $('.listing-category-selected-Id').each(function(){
                $('.checkStatus').prop("disabled", true);
                console.log("false");
                $(".listing-category-selected-Id").prop('checked', false);

                var totalSelectedListing = ' 0 Listings Category selected';
                $('.total-selected-listing-category').val(totalSelectedListing)
                
            })
        }
        
    });

function getFilterListingCategory() {
    var listingCatId = $('#listing_category_name').val();
    var listing_category_status = $('#listing_category_status').val();
    var listing_branch_id = $('#listing_category_branch').val();

    

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('getFilterListingCategory') }}",
        type: "POST",
        data: {
            "listingCatId": listingCatId,
            "listing_branch_id": listing_branch_id,
            "status": listing_category_status,
        },

        success: function(response) {
            var data = response;
            console.log(data);

            $('tbody').html(data.search_data);
            var listingCatBranch_count = data.listingCatBranch_count + ' Listings Category found'
            $('#totalListingCategory').val(listingCatBranch_count)
        }
    });

}

// $('.edit-listingcategory').on('click', function() {
$('body').on('click', '.edit-listingcategory', function() {
    console.log("id")
    var id = $(this).data('id');
    var name = $(this).data('listing_cat_name');
    var listing_branch = $(this).data('listing_branch_id');
    var listing_cat_id = $(this).data('listing_cat_id');

    $('#listingCatBrancheId').val(id);
    $('#listingCatName').val(name);

    $('#listing_cat_id').val(listing_cat_id);

    $('#listing_branch').val(listing_branch);
    $('#listing_branch').select2().trigger('change');

    $('#editListingCategory').modal('show');
});

function change_status(id, value, status) {
    if (confirm("Are you sure want " + value + " this category")) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('listing-category.status') }}",
            type: "POST",
            data: {
                "listingCategoryId": id,
                "status": status,
            },

            success: function(response) {
                var data = response;
                console.log(data);
                if (data == 1) {
                    toastr.success("Status update succesfully");
                } else {
                    toastr.error("Somethings went wrong");
                }
                location.reload();
            }
        });
    }
}
</script>
@stop