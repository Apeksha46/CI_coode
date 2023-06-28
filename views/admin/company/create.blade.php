@extends('admin.layouts.layout')
@section('content')
<style>
.ipfs .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 36px !important;
    user-select: none;
    -webkit-user-select: none;
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid rgb(206 212 218)!important;
    border-radius: 4px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Company</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('companies.index') }}" class="btn ipfs-button"><i
                                class="fa fa-arrow-left"></i>
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
                <div class="col-12">
                    <div class="card table-responsive">
                        <div class="card-body">
                            <form action="{{ route('companies.store') }}" method="post" data-parsley-validate="">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Company name*</label>
                                            <input type="text" class="form-control" name="company_name" Placeholder="Company name"
                                                value="{{ old('company_name') }}" required id="company_name"
                                                data-parsley-required-message="Enter Company name"  onblur="checkCompanyName()"/>
                                            
                                            <span class="error" id="err-companyNameCheck" style="display: none;">Company name already
                                                exist </span>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Website link*</label>
                                            <input type="text" class="form-control" name="website_link"
                                                value="{{ old('website_link') }}" Placeholder="Website link" required
                                                data-parsley-required-message="Enter Website link" data-parsley-type="url" data-parsley-type-message="Enter valid url"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email-Id*</label>
                                            <input type="text" class="form-control" name="company_email"
                                                id="company_email" value="{{ old('company_email') }}"
                                                onblur="checkEmail()"  Placeholder="Company Email-Id" required
                                                data-parsley-required-message="Enter E-mail Id" type="email"
                                                data-parsley-type="email" data-parsley-required-message="Enter Email-Id"
                                                data-parsley-type-message="Email-Id should be valid format" />

                                            <span class="error" id="err-emailCheck" style="display: none;">Email already
                                                exist </span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Add Listing*</label>
                                            <fieldset>
                                                <select class="select2 form-control" style="width: 100%;"
                                                    id="addCompanyInListing"  name="listing_id"required data-parsley-min="1" data-parsley-min-message="Select Listing" data-parsley-class-handler=".checkbox-errors">
                                                    <option value="0" selected="selected">Select Listing</option>
                                                    @foreach ($listings as $listing)
                                                    <option value="{{ $listing->id }}">{{ ucfirst($listing->name) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="checkbox-errors"></div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label>Country*</label>
                                            <fieldset>

                                                <select class="select2" style="width: 100%;" id="countryLocation"
                                                    name="country_id" onchange="getStates()" required data-parsley-min="1" data-parsley-min-message="Select Country" data-parsley-class-handler=".checkbox-errors">
                                                    <option value="0" selected="selected">Country</option>
                                                    @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">
                                                        {{ ucfirst($location->name) }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="checkbox-errors"></div>
                                            </fieldset>
                                            
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>State*</label>
                                            <fieldset>
                                                <select class="select2" style="width: 100%;" id="stateId"
                                                    onchange="getCity()" name="state_id" required data-parsley-min="1" data-parsley-min-message="Select State" data-parsley-class-handler=".checkbox-errors">
                                                        <option value="0" selected="selected">State</option>
                                                </select>
                                                <div class="checkbox-errors"></div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label>City</label>
                                            <fieldset>
                                                <select class="select2" style="width: 100%;" id="city" name="city_id"  data-parsley-min-message="Select City">
                                                    <option value="0" selected="selected">City</option>
                                                </select>
                                                <div class="checkbox-errors"></div>
                                            <fieldset>
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label>Postal code*</label>
                                            <input type="text" class="form-control" name="postal_code" Placeholder="Postal code"
                                                value="{{ old('postal_code') }}"  
                                                data-parsley-required-message="Enter Postal code" data-parsley-type="number" required data-parsley-type-message="Postal code
                                                should be only digit allow" onKeyPress="if(this.value.length==6) return false;"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label>Street</label>
                                            <input type="text" class="form-control" name="street" Placeholder="Street"
                                                value="{{ old('street') }}" />

                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label>Rating*</label>
                                            <input type="text" class="form-control" name="rating" Placeholder="Rating"
                                                value="{{ old('rating') }}" onkeyup="ratingInput()" id="rating" required
                                                data-parsley-required-message="Enter rating" data-parsley-type="number" data-parsley-type-message="Rating
                                                should be only digit allow"/>
                                            <p class="error" id="priceValidation" style="display: none">Rating should be
                                                greater than zero</p>
                                            <!-- <p class="error" id="priceCheckValidation" style="display: none">Rating
                                                should be only digit allow</p> -->
                                            <p class="error" id="ratingValidation" style="display: none">Rating can not
                                                be more than 5</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Detailed Description</label>
                                            <textarea class="form-control" rows="5" minlength="200" id="description" name="description" Placeholder="Detailed Description"
                                                value="{{ old('name') }}"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btnSave">Save</button>
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
function ratingInput() {


    var rating = $("#rating").val();
    // alert(rating);

    if (rating < 0) {
        $("#priceValidation").css("display", "block");
        $("#priceCheckValidation").css("display", "none");
        $("#ratingValidation").css("display", "none");
        return
    }
    if (!(rating.replace(/[^0-9\.]/g, ''))) {
        $("#priceCheckValidation").css("display", "block");
        $("#priceValidation").css("display", "none");
        $("#ratingValidation").css("display", "none");
        return
    }

    $("#priceValidation").css("display", "none");
    $("#priceCheckValidation").css("display", "none");


    $("#priceValidation").css("display", "none");

    if (5 < rating) {
        $("#ratingValidation").css("display", "block");

        $("#priceValidation").css("display", "none");
        $("#priceCheckValidation").css("display", "none");

        // $("#showDangerMessage").html("Rating can not be more than 5")
        // $(window).scrollTop(0);

        // $("#showDangerMessage").fadeTo(2000, 500).slideUp(500, function() {
        //     $("#showDangerMessage").hide();
        // });
        return;
    }
    $("#ratingValidation_" + id).css("display", "none");
    console.log("rating", rating);

}


function capitalizeFirstLetter(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

function getCity() {
    var stateId = $("#stateId").val();

    $.ajax({
        type: "POST",
        url: "{{ route('getCities') }}", //you can use any web method as well
        data: {
            _token: "{{ csrf_token() }}",
            state_id: stateId
        } //parameters if you want to send any
    }).done(function(res) {
        $('#city').html('<option value="">City</option>');
        $.each(res.cities, function(key, value) {
            $("#city").append('<option value="' + value
                .id + '">' + capitalizeFirstLetter(value.name) + '</option>');
        });
    });
}

function getStates() {
    var country_id = $("#countryLocation").val();

    $.ajax({
        type: "POST",
        url: "{{ route('getStates') }}", //you can use any web method as well
        data: {
            _token: "{{ csrf_token() }}",
            country_id: country_id
        } //parameters if you want to send any
    }).done(function(res) {
        $('#stateId').html('<option value="">State</option>');
        $.each(res.states, function(key, value) {
            $("#stateId").append('<option value="' + value
                .id + '">' + capitalizeFirstLetter(value.name) + '</option>');
        });
    });
}
$('.btnSave').click(function() {
    $("#err-emailCheck").css("display", "none");
})

function checkEmail() {
    var company_email = $('#company_email').val();

    $.ajax({
        type: "POST",
        url: "{{ route('checkEmail') }}", //you can use any web method as well
        data: {
            _token: "{{ csrf_token() }}",
            company_email: company_email
        } //parameters if you want to send any
    }).done(function(data) {

        if (data == 1) {
            $("#err-emailCheck").css("display", "block");
            $('#company_email').val('');
        } else {
            $("#err-emailCheck").css("display", "none");

        }


    });
}


function checkCompanyName() {
    var company_name = $('#company_name').val();

    $.ajax({
        type: "POST",
        url: "{{ route('checkCompanyName') }}", //you can use any web method as well
        data: {
            _token: "{{ csrf_token() }}",
            company_name: company_name
        } //parameters if you want to send any
    }).done(function(data) {

        if (data == 1) {
            $("#err-companyNameCheck").css("display", "block");
            $('#company_name').val('');
        } else {
            $("#err-companyNameCheck").css("display", "none");

        }


    });
}

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