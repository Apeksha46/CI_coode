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
                                    value="{{$listingCategoryList->count()}} Listing Category Found" disabled>
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
                                                    @foreach($allListingCategory as $listingcategory)
                                                    <option value="{{$listingcategory->listingCategory->id}}">
                                                        {{ucfirst($listingcategory->listingCategory->name)}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label></label>
                                                <select class="select2" style="width: 100%;"
                                                    id="listing_category_branch" name="listing_category_branch">
                                                    <option value="">Select Listing Branch</option>
                                                    @foreach($listing_branch as $listingbranch)
                                                    <option value="{{$listingbranch->id}}">
                                                        {{ucfirst($listingbranch->name)}}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-2">

                                                <label></label>

                                                <select class="select2" style="width: 100%;"
                                                    id="listing_category_status" name="listing_category_status">
                                                    <option value=" ">Status</option>
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
                                <div class="col-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control total-selected-listing-category"
                                            value="0 Listing Category selected" disabled style="height: 42px;">
                                            <input type="hidden" id="checkboxCheckedCount" value="">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">

                                        <select class="select2 checkStatus" style="width: 100%;"
                                            onChange="changeStatusListing(this.value);" disabled>
                                            <option selected>Set status</option>
                                            <option value="0">Active</option>
                                            <option value="1">Deactive</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-7" align="right">
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
                        <div class="card-body">

                            <table id="ListingCategoryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <label>Select ALL</label><br>
                                             <input class="form-check-input tableCheckbox" type="checkbox" value="1"
                                                id="select_all" style="margin-top: -10px;margin-left: 7px;">
                                        </th>
                                        <th>
                                            <!-- <input class="form-check-input tableCheckbox" type="checkbox" value="1"
                                                id="select_all" style="margin-top: -10px;margin-left: 7px;"> -->
                                            No.
                                        </th>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @forelse ($listingCategoryList as $lc)

                                    <tr>
                                        <td>
                                            <div class="form-check1">
                                                <input
                                                    class="form-check-input listing-category-selected-Id table-td-list-SelectAll"
                                                    type="checkbox" value="{{$lc->id}}" name="lc_id[]"
                                                    onclick="checkBox();">
                                            </div>

                                        </td>
                                        <td>
                                            <div class="form-check1">
                                                <label class="form-check-label">{{ $i++."." }}</label>
                                            </div>
                                        </td>
                                        <td>
                                            @if(!empty($lc->listingCategory->icon))
                                            <img class="file-upload-image profile-user-img"
                                                src="{{$lc->listingCategory->icon}}" alt="Icon">
                                            @else
                                            <img class="file-upload-image profile-user-img"
                                                src="{{url('public/storage/no_icon.png')}}" alt="Icon">
                                            @endif
                                        </td>
                                        <td>{{!empty($lc->listingCategory->name)?ucfirst($lc->listingCategory->name):'N/A'}}
                                        </td>
                                        <td>{{!empty($lc->listingBranch->name)?ucfirst($lc->listingBranch->name):'N/A'}}
                                        </td>
                                        <td>
                                            @if($lc->status == 0)
                                            <button title="Status " class="btn ipfs-button" value="{{ $lc}})"
                                                onclick="change_status('{{ $lc->id }}','Deactive','1')"> Active
                                            </button>
                                            @else
                                            <button title="Status " class="btn ipfs-danger" value="{{ $lc }})"
                                                onclick="change_status('{{ $lc->id }}','Active','0')"> Deactive
                                            </button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('listing-category.destroy', $lc) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn ipfs-button edit-listingcategory"
                                                    data-id="{{ $lc->id }}"
                                                    data-listing_cat_id="{{ $lc->listing_cat_id }}"
                                                    data-listing_branch_id="{{ $lc->listing_branch_id }}"
                                                    data-icon="{{!empty($lc->listingCategory->icon)?$lc->listingCategory->icon:'N/A'}}"
                                                    data-listing_cat_name="{{!empty($lc->listingCategory->name)?ucfirst($lc->listingCategory->name):'N/A'}}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <button type="submit" class="btn ipfs-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Delete Category"
                                                    onclick="return confirm('Are you sure want to delete this Category!')"><i
                                                        class="fa fa-trash"></i></button>

                                                <a href="{{ route('listing-subcategory.view',$lc) }}"
                                                    class="btn ipfs-button">View Listings Sub-Category</a>


                                                <a href="{{ route('listing-subcategory.add',$lc) }}"
                                                    class="btn ipfs-button">Add New Listings Sub-Category</a>
                                            </form>
                                        </td>

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
        <form action="{{route('listing-category.update')}}" method="post" data-parsley-validate=""
            enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="listingCatName" placeholder="Name" name="name"
                                value="{{ old('name') }}" required data-parsley-required-message="Enter name">
                        </div>
                        <div class="form-group">
                            <label>Select Branch</label>
                            <select class="select2" multiple="multiple" data-placeholder="Select Branch"
                                style="width: 100%;" name="listing_branch[]" id="listing_branch" required
                                data-parsley-required-message="Select atleast one branch">

                                @foreach ($listing_branch as $branch)
                                <option value="{{ $branch->id }}">
                                    {{ ucfirst($branch->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Icon</label>
                            <img class="file-upload-image profile-user-img" src="" alt="Icon" id="iconImg">
                            <input type="file" class="form-control" name="image" id="imgadd">
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

var table = $('#ListingCategoryTable').DataTable({
    "ordering": false,
    "language": {
        "lengthMenu": "Display _MENU_ records per page",
        "zeroRecords": "Nothing found - sorry",
        "info": "Showing page _PAGE_ of _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(Filtered from total _MAX_ entries)"
    }
});


$('#select_all').click(function(event) { //on click 
    var checked = this.checked;
    var total = 0;
    table.column(0).nodes().to$().each(function(index) {
        if (checked) {
            var selected_box = $(this).find('.listing-category-selected-Id').prop('checked', true);
            total++;
            $('.checkStatus').prop("disabled", false);
        } else {
            $(this).find('.listing-category-selected-Id').prop('checked', false);
            $('.checkStatus').prop("disabled", true);
        }
    });
    var totalSelectedListing = total + ' Listings Category selected';
    $('.total-selected-listing-category').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(total)

    
    table.draw();
});

function checkBox() {
    var totalchecked = $('#checkboxCheckedCount').val()
    var countchecked = table
        .rows()
        .nodes()
        .to$() // Convert to a jQuery object
        .find('.listing-category-selected-Id:checked').length;

    console.log("=======", countchecked);


    if (countchecked == 0) {
        $('.checkStatus').prop("disabled", true);
    } else {
        $('.checkStatus').prop("disabled", false);
    }

    var totalSelectedListing = countchecked + ' Listings Category selected';
    $('.total-selected-listing-category').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(checkedbox)

    table.draw();

}


function changeStatusListing(id) {
    // alert(id)

    swal({
        title: "Are you sure want to set status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var checkedValue = [];

            var rowcollection = table.$(".listing-category-selected-Id:checked", {
                "page": "all"
            });
            rowcollection.each(function(index, elem) {
                checkedValue.push($(elem).val());
            });


            $.ajax({
                type: "post",
                url: "{{ route('changeListingCategoryStatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'listing_category_status': id,
                    'listingCategoryId': checkedValue
                },
                success: function(data) {

                    console.log(data)

                    if (data == 1) {
                        toastr.success("Status update succesfully");
                    } else {
                        toastr.error("Somethings went wrong");
                    }

                    location.reload();
                }
            });

        } else {
            location.reload();
        }
    });

}

// -------------Add Image Preview------------------------------
function read(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#iconImg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgadd").change(function() {
    read(this);
});

// $('.edit-listingcategory').on('click', function() {
$('body').on('click', '.edit-listingcategory', function() {
    var APP_URL = {!! json_encode(url('/')) !!}

    var id = $(this).data('id');
    var name = $(this).data('listing_cat_name');
    var listing_branch = $(this).data('listing_branch_id');
    var listing_cat_id = $(this).data('listing_cat_id');
    // var icon = APP_URL + '/public/storage/' + $(this).data('icon');
    var icon = $(this).data('icon');

    $('#listingCatBrancheId').val(id);
    $('#listingCatName').val(name);

    $('#listing_cat_id').val(listing_cat_id);

    $('#listing_branch').val(listing_branch);
    $('#listing_branch').select2().trigger('change');


    $('#iconImg').attr("src", icon);

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

            populateDataTable(data);

            // $('tbody').html(data.search_data);
            // var listingCatBranch_count = data.listingCatBranch_count + ' Listings Category found'
            // $('#totalListingCategory').val(listingCatBranch_count)
        }
    });
}

function populateDataTable(data) {
    console.log("populating data table...", data);

    // clear the table before populating it with more data
    $("#ListingCategoryTable").DataTable().clear();
    var length = Object.keys(data).length;
    console.log("length of service line", length);
    var status;
    var num = 1;
    if (length != 0) {
        for (var i = 0; i <= length; i++) {
            var cat = data[i];
            var url = '{{ route("listing-category.destroy", ":id") }}';
            url = url.replace(':id', cat.id);

            if (cat.status == 0) {
                status = '<button title="Status " class="btn ipfs-button" value="' + JSON.stringify(cat.id) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Deactive\',\'1\')"> Active</button>';
            } else {
                status = '<button title="Status " class="btn ipfs-danger" value="' + JSON.stringify(cat.id) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Active\',\'0\')"> Deactive</button>';
            }

            var subcategoryView_url = '{{ route("listing-subcategory.view", ":id") }}';
            subcategoryView = subcategoryView_url.replace(':id', cat.id);

            var subcategoryAdd_url = '{{ route("listing-subcategory.add", ":id") }}';
            subcategoryAdd = subcategoryAdd_url.replace(':id', cat.id);


            $('#ListingCategoryTable').dataTable().fnAddData([
                '<div class="form-check1"><input class="form-check-input listing-category-selected-Id table-td-list-SelectAll" type="checkbox" value="' + cat.id + '" name="lc_id[]" onclick="checkBox();"></div>',
                num,
                cat.icon_img,
                cat.listingCategory,
                cat.listingBranch,
                status,
                '<form action="' + url +
                '" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}" /><input type="hidden" name="_method" value="DELETE"><button type="button" class="btn ipfs-button edit-listingcategory" data-id="' +
                cat.id + '" data-listing_cat_id="' + cat.listing_cat_id + '" data-listing_branch_id="' + cat.listing_branch_id + '" data-listing_cat_name="' + cat.listingCategory + '"><i class="fa fa-edit"></i> </button> <button type="submit" class="btn ipfs-danger" data-toggle="tooltip" data-placement="top" title="Delete category" onclick="return confirm(\'Are you sure want to delete this category!\')"><i class="fa fa-trash"></i></button> <a href="'+subcategoryView+'" class="btn ipfs-button">View Listings Sub-Category</a> <a href="'+subcategoryAdd+'" class="btn ipfs-button">Add New Listings Sub-Category</a></form>'
            ]);
            num++;
        }
    } else {
        $('#ListingCategoryTable').dataTable().fnAddData([
            '',
            '',
            '',
            '<tr class="no-data-row"> <td colspan="6" rowspan="1" align="center"><div class="message"><p>No data available in table</p></div></td></tr>',
            '',
            '',
            ''
        ])
    }
}
</script>
@stop