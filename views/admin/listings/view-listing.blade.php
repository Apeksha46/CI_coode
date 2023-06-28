@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Listing Detail</h1>
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
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">


                            <!-- <h3 class="profile-username text-center">hello</h3> -->
                            <!-- <p class="text-muted text-center"></p> -->
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Name </b> <a class="float-right text-dark">{{$getListingDetail->name}}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Listing category </b> <a class="float-right text-dark">
                                        {{ !empty($getListingDetail->listingCategory->name) ? ucfirst($getListingDetail->listingCategory->name) : 'N/A' }}
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>Listing Branch </b> <a
                                        class="float-right text-dark">{{ !empty($getListingDetail->listingCategoryBranch->listingBranch->name) ? ucfirst($getListingDetail->listingCategoryBranch->listingBranch->name) : 'N/A' }}
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>Listing Subcategory </b> <a
                                        class="float-right text-dark">{{ !empty($getListingDetail->listingSubcategory->name) ? ucfirst($getListingDetail->listingSubcategory->name) : 'N/A' }}
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>Status </b>
                                    <a class="float-right text-dark">
                                        @if($getListingDetail->status == 0)
                                        <span class="btn btn-sm ipfs-danger">Unpublished</span>
                                        @else
                                        <span class="btn btn-sm ipfs-success">Published</span>
                                        @endif
                                    </a>
                                </li>
                            </ul>

                        </div>

                    </div>

                    <input type="hidden" value="{{$getListingDetail->id}}" id="id_data">

                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#generalDetail"
                                        data-toggle="tab">Company Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#highlighted"
                                        data-toggle="tab">Highlighted focus</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#relatedListings"
                                        data-toggle="tab">Related listing</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="company-listing-detail"
                                        href="#getListingCompany" data-category="getListingCompany"
                                        data-toggle="tab">Company
                                        list</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="generalDetail">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Meta title</label>
                                                <!-- <input type="text" class="form-control" id="metaTitle" name="metaTitle"
                                                    required data-parsley-required-message="Enter meta title"
                                                    value="{{$getListingDetail->meta_title}}" readonly> -->
                                                <textarea class="form-control" rows="5" id="meta_title"
                                                    name="meta_title"
                                                    readonly>{{$getListingDetail->meta_title}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <textarea class="form-control" rows="5" id="short_description"
                                                    name="short_description"
                                                    readonly>{{$getListingDetail->short_description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="metaDescription">Meta description</label>
                                                <textarea class="form-control" rows="5" id="metaDescription"
                                                    name="metaDescription" required
                                                    data-parsley-required-message="Enter meta descritption"
                                                    readonly>{{$getListingDetail->meta_description}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" rows="5" id="long_description"
                                                    name="long_description"
                                                    readonly>{{$getListingDetail->long_description}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="highlighted">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="parentCategoryAlis">Highlighted focus (green bar in company
                                                card)</label>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="categoryAlis">Highlighted focus label</label>
                                        </div>
                                    </div>
                                    @for ($i = 0; $i < 2; $i++) @if($getListingDetail->highlightListing->count() > $i)
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <select class="form-control select2"
                                                    name="highlight_listing[{{$i}}][cat_id]" style="width: 100%;"
                                                    disabled>
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
                                                <input type="text" class="form-control"
                                                    name="highlight_listing[{{$i}}][othername]"
                                                    id="highlight_listing_othername_{{$i}}"
                                                    placeholder="You can rename Highlighted focus lable"
                                                    value="{{$getListingDetail->highlightListing[$i]->other_name}}"
                                                    readonly>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <select class="form-control select2"
                                                    name="highlight_listing[{{$i}}][cat_id]" style="width: 100%;"
                                                    disabled>
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
                                                <input type="text" class="form-control"
                                                    name="highlight_listing[{{$i}}][othername]"
                                                    id="highlight_listing_othername_{{$i}}"
                                                    placeholder="You can rename Highlighted focus lable" readonly>
                                            </div>
                                        </div>
                                        @endif
                                        @endfor

                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="relatedListings">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="parentCategoryAlis">Related Listings</label>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="categoryAlis">Rename the related listing</label>
                                        </div>
                                    </div>
                                    @for ($i = 0; $i < 5; $i++) @if($getListingDetail->relatedListing->count() > $i)
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <select class="form-control select2"
                                                    name="related_listing[{{$i}}][related_listing_id]"
                                                    style="width: 100%;" disabled>
                                                    <option selected="selected" value="0">Related listing is not
                                                        selected
                                                    </option>
                                                    @foreach($all_listing as $listing)
                                                    <option value="{{$listing->id}}"
                                                        {{ ($getListingDetail->relatedListing[$i]->related_listing_id) == $listing->id ? 'selected' : '' }}>
                                                        {{$listing->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <input type="text" class="form-control"
                                                    name="related_listing[{{$i}}][othername]" id="categoryAlis"
                                                    placeholder="You can rename related the related listing"
                                                    value="{{$getListingDetail->relatedListing[$i]->other_name}}"
                                                    readonly>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <select class="form-control select2"
                                                    name="related_listing[{{$i}}][related_listing_id]"
                                                    style="width: 100%;" disabled>
                                                    <option selected="selected" value="0">Related listing is not
                                                        selected
                                                    </option>
                                                    @foreach($all_listing as $listing)
                                                    <option value="{{$listing->id}}">{{$listing->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <input type="text" class="form-control"
                                                    name="related_listing[{{$i}}][othername]" id="categoryAlis"
                                                    placeholder="You can rename related the related listing" readonly>
                                            </div>
                                        </div>
                                        @endif
                                        @endfor


                                </div>

                                <div class="tab-pane" id="getListingCompany" aria-labelledby="company-listing-detail">
                                </div>

                                <!-- <div class="tab-pane" id="childs-family" aria-labelledby="childs-family-detail"> </div> -->


                                <!-- <div class="tab-pane" id="companyList">

                                    <div class="row">
                                        <table id="comapny_listing" class="table table-bordered table-hover listing_company-tbl">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Company name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>


                                        </table>


                                    </div>


                                </div> -->

                                <!-- <div class="tab-pane" id="companyList"> companyList Detail </div> -->

                            </div>

                        </div>
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

</script>
@stop