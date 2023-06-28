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
                    <h1>Edit Listing Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('listings.index') }}" class="btn ipfs-button"><i class="fa fa-arrow-left"></i>
                            Back</a>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{route('listings.update',$getListingDetail->id)}}" method="POST" data-parsley-validate="">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label for="categoryName">Name*</label>
                            <input type="text" class="form-control" id="listing_name" name="listing_name"
                                placeholder="Enter Listing Name" value="{{$getListingDetail->name}}"
                                style="height: 42px;">
                            <span class="error" id="err-listing_name" style="display: none;">Enter name</span>
                        </div>
                        <div class="row">

                            <div class="form-group col-6">
                                <!-- <label for="parentCategoryAlis">Parent category name alis</label> -->
                                <label for="parentCategoryAlis">Listing category</label>
                                <select class="form-control select2" id="listing-category" name="listing-category"
                                    style="width: 100%;" onChange="getcategoryBranch(this.value);">
                                    <option value=" ">Please listing category</option>
                                    @foreach ($allListingCategory as $l)
                                    <option value="{{ $l->id }}"
                                        {{ ($getListingDetail->listing_cat_id) == $l->id  ? 'selected' : '' }}>
                                        {{ ucfirst($l->name) }}</option>
                                    @endforeach
                                </select>
                                <span class="error" id="err-listing-category" style="display: none;">Select
                                    listing Category </span>
                            </div>

                            <div class="form-group col-6 listingBranchEdit">
                                <label for="categoryAlis">Listing Branch</label>
                                <select class="form-control select2" id="listing-category-branch-edit"
                                    name="listing-category-branch-id-edit" style="width: 100%;"
                                    onChange="getSubcategory(this.value);">
                                    <option selected="selected" value="">Select listing Branch</option>
                                    @foreach ($allListingCategoryBranch as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ ($getListingDetail->listing_cat_branchId) == $branch->id  ? 'selected' : '' }}>
                                        {{ucfirst($branch->listingBranch->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="error" id="err-listing-category-branch-edit" style="display: none;">Select
                                    listing Branch </span>

                            </div>

                            <div class="form-group col-6 listingBranch" style="display: none;">
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

                        <div class="form-group listing-subcategory-edit">
                            <div class="form-group col-6">
                                <label for="categoryAlis">Listing Subcategory</label>
                                <select class="form-control select2" id="listing-subcategory-id-edit"
                                    name="listing-subcategory-edit" style="width: 100%;">
                                    <option selected="selected" value="">Please listing subcategory</option>
                                    @foreach($allListingSubcategory as $cat)
                                    <option value="{{$cat->id}}"
                                        {{ ($getListingDetail->listing_subcategoryId) == $cat->id  ? 'selected' : '' }}>
                                        {{ucfirst($cat->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="error" id="err-listing-subcategory-id-edit" style="display: none;">Select
                                    listing Branch </span>
                            </div>
                        </div>

                        <div class="form-group listing-subcategory" style="display: none;">
                            <div class="form-group col-6">
                                <label for="categoryAlis">Listing Subcategory</label>
                                <select class="form-control select2" id="listing-subcategory-id"
                                    name="listing-subcategory" style="width: 100%;">
                                    <option selected="selected" value="">Please listing subcategory</option>
                                </select>
                                <span class="error" id="err-listing-subcategory-id" style="display: none;">Select
                                    listing Branch </span>
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

                        @for ($i = 0; $i <= 2; $i++) @if($getListingDetail->highlightListing->count() > $i)
                            <div class="row">
                                <div class="form-group col-6">
                                    <select class="form-control select2" name="highlight_listing[{{$i}}][cat_id]"
                                        style="width: 100%;">
                                        <option selected="selected" value="0">Please select focus</option>
                                        @foreach($categories as $category)
                                        <optgroup label="{{$category->name}}">
                                            @foreach($category->childs as $subcategory)
                                            <option class="marginoption" value="{{$subcategory->id}}"
                                                {{ ($getListingDetail->highlightListing[$i]->categories_id) == $subcategory->id ? 'selected' : '' }}>
                                                {{$subcategory->name}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" class="form-control" name="highlight_listing[{{$i}}][othername]"
                                        id="highlight_listing_othername_{{$i}}"
                                        placeholder="You can rename Highlighted focus lable"
                                        value="{{$getListingDetail->highlightListing[$i]->other_name}}"
                                        style="height: 42px;">
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="form-group col-6">
                                    <select class="form-control select2" name="highlight_listing[{{$i}}][cat_id]"
                                        style="width: 100%;">
                                        <option selected="selected" value="0">Please select focus</option>
                                        @foreach($categories as $category)
                                        <optgroup label="{{$category->name}}">
                                            @foreach($category->childs as $subcategory)
                                            <option class="marginoption" value="{{$subcategory->id}}">
                                                {{$subcategory->name}}</option>
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
                            @endif
                            @endfor

                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea class="form-control" rows="5" id="short_description"
                                    name="short_description">{{$getListingDetail->short_description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5" id="long_description"
                                    name="long_description">{{$getListingDetail->long_description}}</textarea>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="parentCategoryAlis">Related Listings</label>
                                </div>
                            </div>

                            @for ($i = 0; $i < 5; $i++) @if($getListingDetail->relatedListing->count() > $i)
                                <div class="row">
                                    <div class="form-group col-6">
                                        <select class="form-control select2"
                                            name="related_listing[{{$i}}][related_listing_id]" style="width: 100%;">
                                            <option selected="selected" value="0">Related listing is not selected
                                            </option>
                                            @foreach($all_listing as $listing)
                                            @if(Request::segment(2) != $listing->id)
                                            <option value="{{$listing->id}}"
                                                {{ ($getListingDetail->relatedListing[$i]->related_listing_id) == $listing->id ? 'selected' : '' }}>
                                                {{$listing->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" class="form-control"
                                            name="related_listing[{{$i}}][othername]" id="categoryAlis"
                                            placeholder="You can rename related the related listing"
                                            value="{{$getListingDetail->relatedListing[$i]->other_name}}"
                                            style="height: 42px;">
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="form-group col-6">
                                        <select class="form-control select2"
                                            name="related_listing[{{$i}}][related_listing_id]" style="width: 100%;">
                                            <option selected="selected" value="0">Related listing is not selected
                                            </option>
                                            @foreach($all_listing as $listing)
                                            <option value="{{$listing->id}}">{{$listing->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" class="form-control"
                                            name="related_listing[{{$i}}][othername]" id="categoryAlis"
                                            placeholder="You can rename related the related listing"
                                            style="height: 42px;">
                                    </div>
                                </div>
                                @endif
                                @endfor

                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">Status*</label>
                            <select class="form-control select2" name="status" style="width: 100%;"
                                onChange="getStatus(this.value);" id="status">
                                <option selected="selected" value="">Select status</option>
                                <option value="0" {{ ($getListingDetail->status) == 0 ? 'selected' : '' }}>Unpublished
                                </option>
                                <option value="1" {{ ($getListingDetail->status) == 1 ? 'selected' : '' }}>Published
                                </option>
                            </select>
                            <span class="error" id="err-status" style="display: none;">Select status</span>
                        </div>
                        <div class="form-group">
                            <label for="metaTitle">Meta title*</label>
                            <input type="text" class="form-control" id="metaTitle" name="metaTitle"
                                value="{{$getListingDetail->meta_title}}" style="height: 42px;">
                            <span class="error" id="err-metaTitle" style="display: none;">Enter meta title</span>
                        </div>

                        <div class="form-group">
                            <label for="metaDescription">Meta description*</label>
                            <textarea class="form-control" rows="5" id="metaDescription"
                                name="metaDescription">{{$getListingDetail->meta_description}}</textarea>
                            <span class="error" id="err-metaDescription" style="display: none;">Enter meta
                                descritption</span>
                        </div>

                    </div>

                    <!-- /.col -->
                </div>
                <div class="card-footer" align="right">
                    <button type="submit" class="btn btn-block btn-primary btn-sm" id="editListing">Update</button>
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
function getcategoryBranch(id) {
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

            $(".listingBranchEdit").css("display", "none");
            $(".listingBranch").css("display", "block");

            $("#err-listing-category").css("display", "none");

            $("#listing-category-branch").html(response);
        }
    });
}

function getSubcategory(val) {
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

            $(".listing-subcategory-edit").css("display", "none");
            $(".listing-subcategory").css("display", "block");

            $("#listing-subcategory-id").html(response);
        }
    });
}

function getStatus(id) {
    $("#err-status").css("display", "none");
}

$(function() {
    $('#editListing').click(function() {
        // alert(1);
        // $('#listing-category-branch-edit').parsley();
        var listingcategory = $('#listing-category').val();
        var listingcategorybranchEdit = $('#listing-category-branch-edit').val();
        var listingcategorybranch = $('#listing-category-branch').val();
        var listing_name = $('#listing_name').val();
        var status = $('#status').val();
        var metaTitle = $('#metaTitle').val();
        var metaDescription = $('#metaDescription').val();

        // alert(listing_name);
        // alert(metaTitle);
        // alert(metaDescription);

        var listingcategory_valid = false;
        var listingcategorybranchEdit_valid = false;
        var listingcategorybranch_valid = false;
        var status_valid = false;
        var listing_name_valid = false
        var metaTitle_valid = false
        var metaDescription_valid = false


        if (listing_name == '') {
            // alert(1)
            $("#err-listing_name").css("display", "block");
            var listing_name_valid = false;
            // return false;
        } else {
            // alert(2)
            $("#err-listing_name").css("display", "none");
            var listing_name_valid = true;
        }

        if (metaTitle == '') {
            // alert(3)
            $("#err-metaTitle").css("display", "block");
            var metaTitle = false;
            // return false;
        } else {
            // alert(4)
            $("#err-metaTitle").css("display", "none");
            var metaTitle_valid = true;
        }

        if (metaDescription == '') {
            // alert(5)
            $("#err-metaDescription").css("display", "block");
            var metaDescription_valid = false;
            // return false;
        } else {
            // alert(6)
            $("#err-metaDescription").css("display", "none");
            var metaDescription_valid = true;
        }


        if (listingcategory == '' || listingcategory == 0) {
            // alert(7)
            $("#err-listing-category").css("display", "block");
            var listingcategory_valid = false;
            // return false;
        } else {
            // alert(8)
            $("#err-listing-category").css("display", "none");
            var listingcategory_valid = true;

        }

        if (status == '') {
            // alert(9)
            $("#err-status").css("display", "block");
            var status_valid = false;
            // return false;
        } else {
            // alert(10)
            $("#err-status").css("display", "none");
            var status_valid = true;
        }

        if ($('.listingBranchEdit').css('display') == 'block') {
            // alert(11)
            if (listingcategorybranchEdit == '' || listingcategorybranchEdit == 0) {
                $("#err-listing-category-branch-edit").css("display", "block");
                var listingcategorybranchEdit_valid = false;
                $(window).scrollTop(0);
                return false;
            } else {
                // alert(12)
                $("#err-listing-category-branch-edit").css("display", "none");
                var listingcategorybranchEdit_valid = true;
            }
        }

        if ($('.listingBranch').css('display') == 'block') {
            // alert(13)
            if (listingcategorybranch == '' || listingcategorybranch == 0) {
                // alert(14)
                $("#err-listing-category-branch").css("display", "block");
                var listingcategorybranch_valid = false;
                $(window).scrollTop(0);
                return false;
            } else {
                // alert(15)
                $("#err-listing-category-branch").css("display", "none");
                var listingcategorybranch_valid = true;
            }
        }


        if (listingcategory_valid == false || status_valid == false ||
            listingcategorybranchEdit_valid == false || listingcategorybranch_valid == false ||
            listing_name_valid == false || metaTitle_valid == false || metaDescription_valid == false) {
            // return false;
            if ($('.listingBranchEdit').css('display') == 'block') {
                // alert('y2');
                $(window).scrollTop(0);
                if (listingcategorybranchEdit_valid = false || listing_name_valid == false ||
                    metaTitle_valid == false || metaDescription_valid == false) {
                    // alert('y3');
                    $(window).scrollTop(0);
                    return false;
                }

            }
            if ($('.listingBranch').css('display') == 'block') {
                // alert('y6');
                $(window).scrollTop(0);
                if (listingcategorybranch_valid = false || listing_name_valid == false ||
                    metaTitle_valid == false || metaDescription_valid == false) {
                    // alert('y7');
                    $(window).scrollTop(0);
                    return false;
                }

            }

        }

    });
});
</script>
@stop