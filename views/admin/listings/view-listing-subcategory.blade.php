@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listings Subcategory Details</h1>
                </div>
                <div class="col-sm-6">
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
                            <h3 class="card-title">Listings Subcategory Details</h3>

                            <a href="{{ route('listing-subcategory.add',$listing_branch->id) }}"
                                                    class="btn ipfs-button float-sm-right">Add New Listings Sub-Category</a>
                        

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <input type="text" class="form-control" id="listingCatName"
                                            placeholder="Category Name"
                                            value="{{ucfirst($listing_branch->listingCategory->name)}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Branch</label>
                                        <input type="text" class="form-control" id="listingCatBranch"
                                            placeholder="Branch"
                                            value="{{ucfirst($listing_branch->listingBranch->name)}}" readonly>
                                    </div>
                                </div>

                               
                            </form>

                            <table id="listingSubcategory" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
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
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>
                                            {{ucfirst($lc->name)}}

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
                                        <form action="{{ route('listing-subcategory.destroy', $lc) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn ipfs-button" data-toggle="tooltip"
                                                    data-placement="top" title="Delete User"
                                                    onclick="return confirm('Are you sure want to delete this subcategory!')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="no-data-row">
                                        <td colspan="4" rowspan="2" align="center">
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

@stop
@section('scripts')
<script>
  var table = $('#listingSubcategory').DataTable({
            "ordering": false,
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "Nothing found - sorry",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(Filtered from total _MAX_ entries)"
            }
        });
        
$('.edit-listingsubcategory').on('click', function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var listingsubcategory = $(this).data('listingsubcategory');
    console.log("name",name)

    <?php
        if($listing_branch->listingBranch->name == 'countries'){ ?>
        $('#listing_branch').val(listing_branch);
        $('#listing_branch').select2().trigger('change');
            
    <?php   }elseif($listing_branch->listingBranch->name == 'states'){?>

    <?php  }elseif($listing_branch->listingBranch->name == 'cities'){?>

    <?php  }else{}?>
    // var listing_cat_id = $(this).data('listing_cat_id');

    // $('#listingCatBrancheId').val(id);
    // $('#listingCatName').val(name);

    // $('#listing_cat_id').val(listing_cat_id);

    // $('#listing_branch').val(listing_branch);
    // $('#listing_branch').select2().trigger('change');

    // $('#editListingCategory').modal('show');
});

function change_status(id, value, status) {
    if (confirm("Are you sure want " + value + " this subcategory")) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('listing-subcategory.status') }}",
            type: "POST",
            data: {
                "subcategoryId": id,
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