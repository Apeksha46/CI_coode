@extends('admin.layouts.layout')
@section('content')
<style>
.marginoption {
    margin-left: 10px;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Listing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ url()->previous() }}" class="btn ipfs-button"><i class="fa fa-arrow-left"></i>
                            Back</a>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-danger" id="showDangerMessage" style="display: none">
                <div class="alert alert-success" id="showSuccessMessage" style="display: none"></div>

            </div>
            <form action="{{route('listings.store')}}" method="POST" data-parsley-validate="">
                @csrf
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label for="categoryName">Name*</label>
                            <input type="text" style="height: 42px;" class="form-control" id="listing_name"
                                name="listing_name" placeholder="Enter Listing Name" required
                                data-parsley-required-message="Enter name" value="{{ old('listing_name') }}">
                            <span class="error" id="err-listing_name" style="display: none;">Enter name</span>

                            @if ($errors->first('listing_name'))
                            <li>
                                {{ $errors->first('listing_name')  }}
                            </li>
                            @endif
                        </div>
                        <!-- <div class="form-group">
                            <label for="url">URL*</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Enter Url" required data-parsley-required-message="Enter url">
                        </div> -->
                        <div class="row">
                            <div class="form-group col-6">
                                <!-- <label for="parentCategoryAlis">Parent category name alis</label> -->
                                <label for="parentCategoryAlis">Listing category</label>
                                <select class="form-control select2" id="listing-category" name="listing-category"
                                    style="width: 100%;" onChange="getcategoryBranch(this.value);">
                                    <option selected="selected" value="">Please listing category</option>
                                    @foreach ($allListingCategory as $l)
                                    @if (old('listing-category') == $l->id)
                                    <option value="{{ $l->id }}" selected>{{ ucfirst($l->name) }}</option>
                                    @else
                                    <option value="{{ $l->id }}">{{ ucfirst($l->name) }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <span class="error" id="err-listing-category" style="display: none;">Select
                                    listing Category </span>
                            </div>
                            <!-- listing_cat_branchId -->

                            <div class="form-group col-6">
                                <label for="categoryAlis">Listing Branch</label>
                                <select class="form-control select2" id="listing-category-branch"
                                    name="listing-category-branch-id" style="width: 100%;"
                                    onChange="getSubcategory(this.value);">
                                    <option selected="selected" value="">Select listing Branch</option>
                                </select>
                                <span class="error" id="err-listing-category-branch" style="display: none;">Select
                                    listing Branch </span>
                            </div>


                        </div>
                        <div class="form-group">
                            <div class="form-group col-6">
                                <label for="categoryAlis">Listing Subcategory</label>
                                <select class="form-control select2" id="listing-subcategory-id"
                                    name="listing-subcategory-id" style="width: 100%;" onChange="checkListing();">
                                    <option selected="selected" value="">Please listing subcategory</option>
                                </select>
                            </div>
                        </div>


                        <div class="row">

                            <div class="form-group col-6">
                                <label for="parentCategoryAlis">Highlighted focus (green bar in company card)</label>

                            </div>

                            <div class="form-group col-6">
                                <label for="categoryAlis">Highlighted focus label</label>
                            </div>
                        </div>

                        @for ($i = 0; $i <= 2; $i++) <div class="row">
                            <div class="form-group col-6">
                                <select class="form-control select2" name="highlight_listing[{{$i}}][cat_id]"
                                    style="width: 100%;">
                                    <option selected="selected" value="0">Please select focus</option>
                                    @foreach($categories as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach($category->childs as $subcategory)
                                        <option class="marginoption" value="{{$subcategory->id}}">{{$subcategory->name}}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <input type="text" class="form-control" name="highlight_listing[{{$i}}][othername]"
                                    id="highlight_listing_othername_{{$i}}"
                                    placeholder="You can rename Highlighted focus lable" style="height: 42px;">
                            </div>
                    </div>
                    @endfor


                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" rows="5" id="short_description"
                            name="short_description">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" id="long_description"
                            name="long_description">{{ old('long_description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="parentCategoryAlis">Related Listings</label>
                        </div>

                        <div class="form-group col-6">
                            <label for="categoryAlis">Rename the related listing</label>
                        </div>
                    </div>
                    @for ($i = 0; $i < 5; $i++) <div class="row">
                        <div class="form-group col-6">
                            <select class="form-control select2" name="related_listing[{{$i}}][related_listing_id]"
                                style="width: 100%;">
                                <option selected="selected" value="0">Related listing is not selected
                                </option>
                                @foreach($all_listing as $listing)
                                <option value="{{$listing->id}}">{{$listing->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="form-control" name="related_listing[{{$i}}][othername]"
                                id="categoryAlis_{{$i}}" placeholder="You can rename related the related listing"
                                style="height: 42px;">
                        </div>
                </div>
                @endfor
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="status">Status*</label>
                <select class="form-control select2" name="status" id="status" style="width: 100%;"
                    onChange="getStatus(this.value);">
                    <option selected="selected" value="">Select status</option>
                    <option value="0">Unpublished</option>
                    <option value="1">Published</option>
                </select>
                <span class="error" id="err-status" style="display: none;">Select status</span>
            </div>
            <div class="form-group">
                <label for="metaTitle">Meta title*</label>
                <input type="text" class="form-control" id="metaTitle" name="metaTitle" required
                    data-parsley-required-message="Enter meta title" value="{{ old('metaTitle') }}"
                    style="height: 42px;">

                <span class="error" id="err-metaTitle" style="display: none;">Enter meta title</span>
            </div>


            <div class="form-group">
                <label for="metaDescription">Meta description*</label>
                <textarea class="form-control" rows="5" id="metaDescription" name="metaDescription" required
                    data-parsley-required-message="Enter meta descritption">{{ old('metaDescription') }}</textarea>
                <span class="error" id="err-metaDescription" style="display: none;">Enter meta descritption</span>
            </div>

        </div>
        <!-- /.col -->
</div>
<div class="card-footer" align="right">
    <button type="submit" class="btn btn-block btn-primary btn-sm" id="addListing">Save</button>
</div>
<!-- /.row -->
</form>
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


@stop
@section('scripts')
<script>
$(function() {
    $('#addListing').click(function() {
        // alert(1);
        // $('#listing-category-branch-edit').parsley();
        var listingcategory = $('#listing-category').val();
        var listingcategorybranch = $('#listing-category-branch').val();
        var listing_name = $('#listing_name').val();
        var status = $('#status').val();
        var metaTitle = $('#metaTitle').val();
        var metaDescription = $('#metaDescription').val();

        var listingcategory_valid = false;
        var listingcategorybranch_valid = false;
        var status_valid = false;
        var listing_name_valid  = false
        var metaTitle_valid  = false
        var metaDescription_valid  = false
        

        // alert(listing_name)
        if (listing_name == '' || listing_name == 0) {
            $("#err-listing_name").css("display", "block");
            var listing_name_valid  = false;
            // return false;
        } else {
            $("#err-listing_name").css("display", "none");
            var listing_name_valid  = true;
        }

        if (metaTitle == '' || metaTitle == 0) {
            $("#err-metaTitle").css("display", "block");
            var metaTitle_valid  = false;
            // return false;
        } else {
            $("#err-metaTitle").css("display", "none");
            var metaTitle_valid  = true;
        }

        if (metaDescription == '' || metaDescription == 0) {
            $("#err-metaDescription").css("display", "block");
            var metaDescription_valid  = false;
            // return false;
        } else {
            $("#err-metaDescription").css("display", "none");
            var metaDescription_valid  = true;
        }

        if (listingcategory == '' || listingcategory == 0) {
            $("#err-listing-category").css("display", "block");
            var listingcategory_valid = false;
            // return false;
        } else {
            $("#err-listing-category").css("display", "none");
            var listingcategory_valid = true;
        }

        if (listingcategorybranch == '' || listingcategorybranch == 0) {
            $("#err-listing-category-branch").css("display", "block");
            var listingcategorybranch_valid = false;
            // return false;
        } else {
            $("#err-listing-category-branch").css("display", "none");
            var listingcategorybranch_valid = true;
        }

        if (status == '' || status == 0) {
            $("#err-status").css("display", "block");
            var status_valid = false;
            // return false;
        } else {
            $("#err-status").css("display", "none");
            var status_valid = true;
        }

        if (listing_name == false || listingcategory == false || listingcategorybranch_valid == false ||
            status_valid == false || metaDescription_valid == false || metaTitle == false) {
            $(window).scrollTop(0);
            return false;
        }

    });
});

function getStatus(id) {
    $("#err-status").css("display", "none");
}

function getcategoryBranch(id) {
    $("#err-listing-category").css("display", "none");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('getCategoryBranch') }}",
        type: "POST",
        data: {
            "listingCategoryId": id,
        },

        success: function(response) {
            console.log(response);


            $("#listing-category-branch").html(response);
        }
    });
}



function checkListing(val) {

    var listingCategory = $('#listing-category').val();
    var listingCategoryBranch = $('#listing-category-branch').val();
    var listingSubcategoryId = $('#listing-subcategory-id').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('checkListing') }}",
        type: "POST",
        data: {
            "listingCategory": listingCategory,
            "listingCategoryBranch": listingCategoryBranch,
            "listingSubcategoryId": listingSubcategoryId,
        },
        success: function(response) {
            var data = response;
            console.log(data);
            if (data == 1) {

                $("#showDangerMessage").html("Already added listing")

                $("#showDangerMessage").fadeTo(2000, 500).slideUp(500, function() {
                    $("#showDangerMessage").hide();
                });
            } else {
                $("#showSuccessMessage").html("Available added listing")

                $("#showSuccessMessage").fadeTo(2000, 500).slideUp(500, function() {
                    $("#showSuccessMessage").hide();
                });
            }

        }
    });
}

function getSubcategory(val) {
    $("#err-listing-category-branch").css("display", "none");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('getSubcategory') }}",
        type: "POST",
        data: {
            "listing_cat_branch_id": val,
        },
        success: function(response) {
            var data = response;
            console.log(data);

            $("#listing-subcategory-id").html(response);
        }
    });
}
</script>
@stop