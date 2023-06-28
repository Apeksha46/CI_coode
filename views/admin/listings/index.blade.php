@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listings</h1>
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
                                <input class="form-control form-control-lg" type="text"
                                    value="{{ $all_listing->count() }} Listings found" disabled id="count_listing_data">

                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <form action="">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-lg btn-default" disabled>
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                            <input type="search" class="form-control form-control-lg"
                                                placeholder="Type listing name" id="searchData">

                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="form-control select2" name="listing_cat_id"
                                                        style="width: 100%;" id="listing_cat_id">
                                                        <option selected="selected" value="">Select Category
                                                        </option>
                                                        @foreach ($allListingCategory as $lc)
                                                        <option value="{{ $lc->listingCategory->id }}">
                                                            {{ ucfirst($lc->listingCategory->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;" id="selectStatus">
                                                        <option selected="selected" value="">Select status
                                                        </option>
                                                        <option value="0">Unpublished</option>
                                                        <option value="1">Published</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>




                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success button1" id="ApplyButton"
                                        onclick="applyFuction();">Apply</button>
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
                                        <input type="text" class="form-control total-selected-listing"
                                            value="0 listings selected" disabled style="height: 42px;">
                                        <input type="hidden" id="checkboxCheckedCount" value="">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">

                                        <select class="select2 checkStatus" name="status" style="width: 100%;"
                                            onChange="changeStatusListing(this.value);" disabled>
                                            <option selected="selected" value="">Set status</option>
                                            <option value="0">Unpublished</option>
                                            <option value="1">Published</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6" align="right">
                                    <a href="{{ route('listings.create') }}" type="button" class="btn ipfs-button"><i
                                            class="fa fa-plus"></i> Add New Listings</a>
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
                            <h3 class="card-title">Listings Details</h3>

                        </div>
                        <!-- <div class="row col-12 ">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input tableCheckbox" type="checkbox"
                                                        id="listing_selectall">
                                                    <label class="form-check-label">Select all</label>
                                                </div>
                                            </div>
                                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">


                            <table id="ListingTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="select_all_box table-th-list">
                                            <div>
                                                <label>Select ALL</label><br>
                                                <input class="form-check-input tableCheckbox table-th-list-SelectAll"
                                                    type="checkbox" value="1" id="select_all">
                                            </div>
                                        </th>
                                        <th> No. </th>
                                        <th>Listing name</th>
                                        <th>Listing Category</th>
                                        <th>Listing Branch</th>
                                        <th>Listing Subcategory</th>
                                        <th>Status</th>
                                        <th>Companies count</th>
                                        <th>Meta title</th>
                                        <th>Meta description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @forelse($all_listing as $listing)
                                    <tr>
                                        <td>
                                            <div class="form-check1">
                                                <input
                                                    class="form-check-input listing-selected-Id table-td-list-SelectAll"
                                                    type="checkbox" value="{{ $listing->id }}" name="listing_id[]"
                                                    onclick="checkBox();">

                                            </div>
                                        </td>
                                        <td>
                                            <label class="form-check-label">{{ $i++ . '.' }}</label>
                                        </td>
                                        <td>{{ ucfirst($listing->name) }}</td>
                                        <td>{{ !empty($listing->listingCategory->name) ? ucfirst($listing->listingCategory->name) : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ !empty($listing->listingCategoryBranch->listingBranch->name) ? ucfirst($listing->listingCategoryBranch->listingBranch->name) : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ !empty($listing->listingSubcategory->name) ? ucfirst($listing->listingSubcategory->name) : 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($listing->status == 0)
                                            Unpublished
                                            @else
                                            Published
                                            @endif

                                        </td>
                                        <td>{{ $listing->companyInListing->count() }}</td>
                                        <td>{{ $listing->meta_title }}</td>
                                        <td>{{ $listing->meta_description }}</td>
                                        <td>
                                            <form action="{{ route('listings.destroy', $listing) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('listings.show', $listing) }}" type="button"
                                                    class="btn ipfs-button"><i class="fa fa-eye"></i></a>

                                                <a href="{{ route('listings.edit', $listing) }}" type="button"
                                                    class="btn ipfs-button"><i class="fa fa-edit"></i></a>


                                                <button type="submit" class="btn ipfs-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Delete Category"
                                                    onclick="return confirm('Are you sure want to delete this listing!')"><i
                                                        class="fa fa-trash"></i></button>

                                            </form>
                                            <a href="https://techreviewers.co/{{$listing->getSlugAttribute()}}/" class="btn ipfs-button" id="button1"  target="_blank">Preview</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="no-data-row">
                                        <td colspan="7" rowspan="2" align="center">
                                            <div class="message">
                                                <p>No data available in table</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <input type="hidden" id="counting" name="counting" value="{{ $i - 1 }}">
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
@stop
@section('scripts')
<script>
var table = $('#ListingTable').DataTable({
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
            var selected_box = $(this).find('.listing-selected-Id').prop('checked', true);
            total++;
            $('.checkStatus').prop("disabled", false);
        } else {
            $(this).find('.listing-selected-Id').prop('checked', false);
            $('.checkStatus').prop("disabled", true);
        }
    });
    var totalSelectedListing = total + ' listings selected';
    $('.total-selected-listing').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(total)
    table.draw();
});


function checkBox() {
    var totalchecked = $('#checkboxCheckedCount').val()
    var countchecked = table
        .rows()
        .nodes()
        .to$() // Convert to a jQuery object
        .find('.listing-selected-Id:checked').length;

    console.log("=======", countchecked);


    if (countchecked == 0) {
        $('.checkStatus').prop("disabled", true);
    } else {
        $('.checkStatus').prop("disabled", false);
    }

    var totalSelectedListing = countchecked + ' listings selected';
    $('.total-selected-listing').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(checkedbox)

    table.draw();
}

function changeStatusListing(id) {
    swal({
        title: "Are you sure want to set status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            // var checkedValue = [];
            // $.each($(".listing-selected-Id:checked"), function() {
            //     checkedValue.push($(this).val());
            // });

            var checkedValue = [];

            var rowcollection = table.$(".listing-selected-Id:checked", {
                "page": "all"
            });
            rowcollection.each(function(index, elem) {
                checkedValue.push($(elem).val());
            });

            $.ajax({
                type: "post",
                url: "{{ route('changeListingStatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'listing_status': id,
                    'listing_id': checkedValue
                },
                success: function(data) {
                    console.log(data);

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
    // alert(id)
}


function applyFuction() {
    var url = "{{ route('searchByListingName') }}"
    var searchData = $('#searchData').val();
    var selectStatus = $('#selectStatus').val();
    var listing_cat_id = $('#listing_cat_id').val();


    $.ajax({
        type: "post",
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
            'search': searchData,
            'status': selectStatus,
            'listing_cat_id': listing_cat_id
        },
        success: function(data) {
            console.log(data);

            populateDataTable(data);

            // $('tbody').html(data.search_data);
            // var count_listing_data = data.listing_count + ' Listings found'
            // $('#count_listing_data').val(count_listing_data)


        }
    });
}

function populateDataTable(data) {
    console.log("populating data table...", data);

    // clear the table before populating it with more data
    $("#ListingTable").DataTable().clear();
    var length = Object.keys(data).length;
    console.log("length of service line", length);
    var status;
    var num = 1;
    if (length != 0) {
        for (var i = 0; i <= length; i++) {
            var cat = data[i];
            var url = '{{ route("listings.destroy", ":id") }}';
            url = url.replace(':id', cat.id);

            var edtiUrl = '{{ route("listings.edit", ":id") }}';
            edti_url = edtiUrl.replace(':id', cat.id);

            var viewUrl = '{{ route("listings.show", ":id") }}';
            view_url = viewUrl.replace(':id', cat.id);


            $('#ListingTable').dataTable().fnAddData([
                '<div class="form-check1"><input class="form-check-input listing-selected-Id table-td-list-SelectAll" type="checkbox" value="'+cat.id+'"  name="listing_id[]" onclick="checkBox();"></div>',
                num,
                cat.listing_name,
                cat.listingCategory,
                cat.listingBranch,
                cat.listingSubcategory,
                cat.status,
                cat.company_count,
                cat.meta_title,
                cat.meta_description,
                '<form action="' + url +
                '" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}" /><input type="hidden" name="_method" value="DELETE"> <a href="'+view_url+'" type="button" class="btn ipfs-button"><i class="fa fa-eye"></i></a> <a href="'+edti_url+'" type="button" class="btn ipfs-button"><i class="fa fa-edit"></i></a> <button type="submit" class="btn ipfs-danger" data-toggle="tooltip" data-placement="top" title="Delete listing" onclick="return confirm(\'Are you sure want to delete this listing!\')"><i class="fa fa-trash"></i></button> <a href="'+cat.preview+'" class="btn ipfs-button" id="button1" target="_blank">Preview</a></form>'
            ]);
            num++;
        }
    } else {
        $('#ListingTable').dataTable().fnAddData([
            '',
            '',
            '',
            '',
            '',
            '<tr class="no-data-row"> <td colspan="6" rowspan="1" align="center"><div class="message"><p>No data available in table</p></div></td></tr>',
            '',
            '',
            '',
            '',
            ''
        ])
    }
}
</script>
@stop