@extends('admin.layouts.layout')
@section('content')
<style>
    
    .ml-1 {
    margin-right: 1%!important;
}
.chip {
    font-size: 13px;
    font-weight: 500;
    height: 32px;
    margin-bottom: 5px;
    margin-left: 5px;
    padding: 3px 12px;
    color: rgba(0,0,0,.6);
    border-radius: 16px;
    background-color: #e4e4e4;
}
.rateyo{
    float: left;
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Companies</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" id="showSuccessMessage" style="display: none">
                        {{-- <strong>Success!</strong>  Companies add in listing successfully. --}}
                    </div>
                    <div class="alert alert-danger" id="showDangerMessage" style="display: none">

                    </div>
                    <div class="card table-responsive">
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control form-control-lg" type="text" id="countCompaniesCount"
                                    value="{{ $companies->count() }} companies found" disabled>
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
                                                placeholder="Type company name or email here" name="search_keyword"
                                                id="searchKeyword">

                                        </div>
                                        <div class="row">
                                            <div class="col-2">

                                                <label></label>
                                                <select class="select2" style="width: 100%;" id="companyStatus"
                                                    name="company_status">
                                                    <option value=" ">Status</option>
                                                    <option value="registered">Registered</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="verified">Verified</option>
                                                    <option value="updated">Updated</option>
                                                    <option value="blocked">Blocked</option>
                                                    <option value="declined">Declined</option>
                                                </select>

                                            </div>
                                            <div class="col-2">

                                                <label></label>
                                                <select class="select2" style="width: 100%;" id="listingStatus"
                                                    name="listing_status">
                                                    <option value=" ">Listing Status</option>
                                                    <option value="listed">Listed</option>
                                                    <option value="unlist">Unlist</option>
                                                </select>

                                            </div>
                                            <div class="col-2">
                                                    <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" style="width: 100%;" id="readyToStart"
                                                        name="ready_to_start">
                                                        <option value=" ">Ready to start</option>
                                                        @foreach ($ready_to_start as $readytostart)
                                                        <option value="{{ $readytostart->id }}">
                                                            {{ ucfirst($readytostart->ready_to) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                </div> 

                                        </div>
                                        <div class="row row_margin">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" style="width: 100%;" id="yearOfFoundation"
                                                        name="year_of_foundation">
                                                        @php
                                                        $i = 2000;
                                                        @endphp
                                                        @endphp
                                                        <option value=" ">Year of foundation</option>
                                                        @for ($i; $i <= 2022; $i++) <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                            @endfor

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">

                                                <label></label>
                                                <select class="select2" style="width: 100%;" id="hourlyRate"
                                                    name="hourly_rate">
                                                    <option value=" ">Hourly rate</option>
                                                    @foreach ($average_hourly_rate as $hourly_rate)
                                                    <option value="{{ $hourly_rate->id }}">
                                                        {{ $hourly_rate->hourly_rate }}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                            <div class="col-2">

                                                <label></label>
                                                <select class="select2" style="width: 100%;" id="minProjectSize"
                                                    name="min_project_size">
                                                    <option value=" ">Min. project size</option>
                                                    @foreach ($min_project_size as $project_size)
                                                    <option value="{{ $project_size->id }}">
                                                        {{ $project_size->project_size }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <!-- <div class="col-2">

                                            <label></label>
                                                    <select class="select2" style="width: 100%;">
                                                        <option value="">Video Pesentation</option>
                                                        <option>Date</option>
                                                    </select>
                                                
                                            </div> -->
                                        </div>
                                        <div class="row row_margin1">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" style="width: 100%;" id="clientFocus">
                                                        <option value=" ">Client focus</option>
                                                        @foreach ($client_focus as $c_focus)
                                                        <option value="{{ $c_focus->id }}">
                                                            {{ ucfirst($c_focus->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" style="width: 100%;" id="employeeNumbers"
                                                        name="employee_numbers">
                                                        <option value=" ">Employees</option>
                                                        @foreach ($employee_number as $employee_number)
                                                        <option value="{{ $employee_number->id }}">
                                                            {{ $employee_number->numbers }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option value="">Domain focus</option>
                                                            <option>Date</option>
                                                        </select>
                                                    </div>
                                                </div> --}}
                                            {{-- <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option value="">case studies count</option>
                                                            <option>Date</option>
                                                        </select>
                                                    </div>
                                                </div> --}}
                                        </div>
                                        {{-- <div class="row row_margin1"> --}}
                                        {{-- <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option value=" ">Service Line</option>
                                                            <option>DESC</option>
                                                        </select>
                                                    </div>
                                                </div> --}}
                                        {{-- <div class="col-2">

                                                    <label></label>
                                                    <select class="select2" style="width: 100%;" id="countryLocation"
                                                        name="location">
                                                        <option value=" ">Location</option>
                                                        @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}">
                                        {{ ucfirst($location->name) }}</option>
                                        @endforeach
                                        </select>

                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label></label>
                                        <select class="select2" style="width: 100%;" id="stateId" onchange="getCity()"
                                            name="state">
                                            <option value=" ">State</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->id }}">
                                                {{ ucfirst($state->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label></label>
                                        <select class="select2" style="width: 100%;" id="city" name="city">
                                            <option value=" ">City</option>

                                        </select>
                                    </div>
                                </div> --}}
                                {{-- </div> --}}
                                {{-- <div class="row row_margin1">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option value=" ">Language</option>
                                                            <option>DESC</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option value=" ">Framework</option>
                                                            <option>DESC</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option value="">CMS Solution</option>
                                                            <option>Date</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div> --}}
                                </form>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success button1" id="ApplyButton"
                                    onclick="getFilterCompanies()">Apply</button>
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
                                    <input type="text" class="form-control form-control-lg" value="0 companies selected"
                                        id="count-checked-checkboxes" style="height: 42px;" disabled>
                                    <input type="hidden" id="hidden-count-checked-checkboxes" value="" />
                                    <!-- <input type="hidden" id="checkboxCheckedCount" value=""> -->
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">

                                    <select class="select2 checkStatus"  style="width: 100%;" id="setStatus"
                                        onchange="setStatusFun()" disabled>
                                        <option value="0" selected>Set status</option>
                                        <option value="verified">Verified</option>
                                        <option value="blocked">Blocked</option>
                                        <option value="declined">Declined</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <select class="select2 checkStatus" style="width: 100%;" id="addCompanyInListing"
                                        name="add_listing[]" multiple="multiple" data-placeholder="Add to listing"
                                        disabled onchange="checkListingData()">

                                        @foreach ($listings as $listing)
                                        <option value="{{ $listing->id }}">{{ ucfirst($listing->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    
                                    <a href="{{ route('listings.create') }}">+Add new listing</a>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" id="addToListingButton" disabled class="btn btn-info"
                                    onclick="addCompanyInListing()">Apply Listing</button>
                            </div>
                           <div class="col-4" align="right">
                                <a href="{{ route('companies.create') }}" type="button" class="btn ipfs-button"><i
                                            class="fa fa-plus"></i> Add new company</a>
                            </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Import Bulk Company content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4>Import Bulk Company</h4>
                <div class="card table-responsive">
                    <div class="card-body">

                        <div class="row">


                            <div class="col-6">
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data"
                                    data-parsley-validate="" id="excelImport">
                                    @csrf
                                    <label>Select Excel File</label>
                                    <input type="file" name="file" class="form-control" id="picture" required
                                        data-parsley-required-message="Choose Excel file" accept=".xlsx, .xls">

                                        <span class="error" id="error1" style="display: none;">Only Excel file allow </span>
                                    <br>
                                    <button class="btn btn-success" id="btnSubmitExcel">
                                        Import User Data
                                    </button>
                                </form>
                            </div>

                            <div class="col-6" align="right">
                                <a href="{{ route('download') }}" type="button" class="btn ipfs-button"> Download Sample
                                    Company Excel Sheet.</a>


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
                        <h3 class="card-title">Companies Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="check-box-count" class="table table-bordered table-hover">
                            <thead>

                                <tr>
                                    <th>
                                        <label>Select ALL</label><br>
                                        <input class="form-check-input tableCheckbox table-th-list-SelectAll" type="checkbox" value="1"
                                            id="selectall" style="margin-top: -10px;margin-left: 7px;">
                                    </th>
                                    <th>
                                        <!-- <input class="form-check-input tableCheckbox" type="checkbox" value="1"
                                            id="selectall" onclick="selectAllCheckbox()"
                                            style="margin-top: -10px;margin-left: 7px;"> -->
                                        No.
                                    </th>
                                    <th>Reg. date</th>
                                    <th>Company name</th>
                                    <th>Status</th>
                                    <th>LS</th>
                                    <th>Company Email</th>
                                    <!-- <th>video</th> -->
                                    <th>Listings</th>
                                    {{-- <th>Featured on</th> --}}
                                    <!-- <th>Case studies</th> -->
                                    <!-- <th>Company Profile</th> -->
                                    <th>Action</th>
                                    <th>Average rating</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @forelse ($companies as $company)
                                <tr>
                                    <td>
                                        <div class="form-check1">
                                            <input type="checkbox" class="form-check-input selectedId table-td-list-SelectAll" name="checkbox[]"
                                                value="{{ $company->id }}" onclick="checkBox();">
                                        </div>

                                    </td>
                                    <td>
                                        <div class="form-check1">
                                            <label class="form-check-label">{{ $i++ }}</label>
                                        </div>
                                    </td>
                                    <td>{{ date('M d, Y', strtotime($company->created_at)) }}</td>
                                    <td>{{ ucfirst($company->company_name) }}</td>
                                    <td>
                                        @if($company->company_status == 'registered')
                                            @php $status = ipfs-primary;  @endphp
                                        @elseif($company->company_status == 'pending') 
                                            @php $status = 'ipfs-info';  @endphp
                                        @elseif($company->company_status == 'verified') 
                                            @php $status = 'ipfs-button'; @endphp
                                        @elseif($company->company_status == 'updated')
                                            @php $status = 'ipfs-success';  @endphp
                                            @elseif($company->company_status == 'blocked')
                                            @php $status = 'ipfs-danger';  @endphp
                                        @else
                                            @php $status = 'ipfs-warning'; @endphp
                                        @endif
                                        <span class="btn {{$status}}">{{ ucfirst($company->company_status) }}</span>
                                    </td>
                                    <td>
                                    <!-- enum('registered', 'pending', 'verified', 'updated,blocked,declined -->
                                        @if ($company->listing_status == 'listed')
                                        <i class="fa fa-eye-slash" aria-hidden="true" style="color: #00FF00;"></i>
                                        @else
                                        <i class="fa fa-eye-slash" aria-hidden="true" style="color: #FF0000;"></i>
                                        @endif

                                    </td>
                                    <td>{{ $company->company_email }}</td>
                                    <!-- <td>@</td> -->
                                    <td> {{ $company->companyListing->count() }}</td>
                                    {{-- <td>-</td> --}}
                                    <!-- <td>-</td> -->
                                    <!-- <td><a href="https://techreviewer.co/owners/profile">Sign in as Owner</a></td> -->
                                    <td>
                                        <!-- <button type="button" class="btn btn-info">Change Owner
                                            email</button> -->
                                        <a href="{{ route('companies.show', $company->id) }}" type="button"
                                            class="btn ipfs-button">View</a>
                                    </td>
                                    <td> 
                                   <div style="width: 230px!important;">
    
                                        <div class="rateyo"
                                         data-rateyo-rating="{{ floatval($company->rating); }}"
                                         data-rateyo-num-stars="5"
                                         data-rateyo-score="1"  data-id="{{$company->id}}" onclick="ratingChange('{{ $company->id }}')" > 
                                        
                                        </div>
                                        <span class="chip ml-1 result">{{ floatval($company->rating); }}</span>
                                        <input type="hidden" id="rateyo_{{$company->id}}" value="{{ floatval($company->rating); }}" class="result1"/>
                                        </div>
                                   
                                            
                                             
                                       
                                    <!--<input type="text" class="form-control" id="rating_{{ $company->id }}"-->
                                    <!--        name="rating" value="{{ floatval($company->rating); }}"-->
                                    <!--        onblur="ratingInput('{{ $company->id }}')"/>-->
                                            
                                    <!--        <p class="error" id="priceValidation_{{ $company->id }}" style="display: none">Rating should be greater than zero</p>-->
                                    <!--        <p class="error" id="priceCheckValidation_{{ $company->id }}" style="display: none">Rating should be only digit allow</p>-->
                                    <!--        <p class="error" id="ratingValidation_{{ $company->id }}" style="display: none">Rating can not be more than 5</p>-->
                                            
                                    </td>
                                </tr>
                                @empty
                                <tr class="no-data-row">
                                    <td colspan="12" rowspan="2" align="center">
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

<div class="modal fade" id="addNewCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Category Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('listing-category.store') }}" id="add-listing-category-name">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Category Name</label>
                                @if ($errors->has('categoryName'))
                                {{ $valid = 'is-invalid' }}
                                @else
                                {{ $valid = '' }}
                                @endif
                                <input type="text" {{ $valid }} class="form-control" name="categoryName"
                                    placeholder="Category">
                                @if ($errors->has('categoryName'))
                                <span class="error session-error">{{ $errors->first('categoryName') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn ipfs-button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn ipfs-button">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
@stop
@section('scripts')
<script>



$(document).ready(function(){
  $("#excelImport").on("submit", function(){
    console.log("excelImport loader")
    $("#overlay").fadeIn(300);
  });//submit
});//document ready

//binds to onchange event of your input field
$('#picture').bind('change', function() {
    var ext = $('#picture').val().split('.').pop().toLowerCase();
    
    console.log("ext",ext)
    
    if(ext == "xls" || ext =="xlsx"){
      
        
        console.log("yes extenstion")
        $('#error1').hide();
        $('#btnSubmitExcel').prop('disabled', false);
    } else {
          console.log("no extenstion")
        $('#error1').show();
        $('#btnSubmitExcel').prop('disabled', true);
        a = 0;
    }
});



    

    $('#addCompanyInListing').select2();
    
    $("#cheked_all").click(function(){
        if($("#cheked_all").is(':checked')){
            $("#addCompanyInListing > option").prop("selected", "selected");
            $("#addCompanyInListing").trigger("change");
        } else {
            $("#addCompanyInListing > option").removeAttr("selected");
            $("#addCompanyInListing").trigger("change");
        }
    });

$.fn.select2.amd.define('select2/selectAllAdapter', [
    'select2/utils',
    'select2/dropdown',
    'select2/dropdown/attachBody'
], function (Utils, Dropdown, AttachBody) {

    function SelectAll() { }
    SelectAll.prototype.render = function (decorated) {
        var self = this,
            $rendered = decorated.call(this),
            $selectAll = $(
                '<input type="checkbox" id="cheked_all"><button class="btn btn-xs btn-default" type="button"  style="margin-left:6px;"> Select All</button>'
            ),
            
            $btnContainer = $('<div style="margin-top:3px;">').append($selectAll);
        if (!this.$element.prop("multiple")) {
          
            return $rendered;
        }
        $rendered.find('.select2-dropdown').prepend($btnContainer);
        $selectAll.on('click', function (e) {
            if($("#cheked_all").is(':checked')){
                console.log("checked all");
            $("select > option").prop("selected", "selected");
            $("#addCompanyInListing").trigger("change");
            }else{
                // $("#addCompanyInListing").removeProp('selected');
                // $("#addCompanyInListing").trigger("change");
                $("#addCompanyInListing").empty();
                
                window.location.reload()
               
              }
            self.trigger('close');
        });
       
        return $rendered;
    };

    return Utils.Decorate(
        Utils.Decorate(
            Dropdown,
            AttachBody
        ),
        SelectAll
    );

});

$('#addCompanyInListing').select2({
    placeholder: 'Select',
    dropdownAdapter: $.fn.select2.amd.require('select2/selectAllAdapter')
});
var table = $('#check-box-count').DataTable({
    "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0]
        },
    ],
    "language": {
        "lengthMenu": "Display _MENU_ records per page",
        "zeroRecords": "Nothing found - sorry",
        "info": "Showing page _PAGE_ of _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(Filtered from total _MAX_ entries)"
    }
});


$('#selectall').click(function(event) { //on click
    var checked = this.checked;
    var total = 0;
    table.column(0).nodes().to$().each(function(index) {
        if (checked) {
            var selected_box = $(this).find('.selectedId').prop('checked', true);
            total++;
            $("#setStatus").removeAttr('disabled');
            $("#addCompanyInListing").removeAttr('disabled');
        } else {
            $(this).find('.selectedId').prop('checked', false);
            $("#setStatus").attr('disabled', 'disabled');

            $("#addToListingButton").attr('disabled', 'disabled');
            $("#addCompanyInListing").attr('disabled', 'disabled');
        }
    });
    var totalSelectedListing = total + ' companies selected';
    $('#count-checked-checkboxes').val(totalSelectedListing)


    table.draw();
});


 $(function () {
   table.rows().nodes().to$().find('.rateyo').rateYo().on("rateyo.change", function (e, data) {
    var rating = data.rating;
    // alert($('.rateyo').attr('data-id'))
     $(this).parent().find('.result').text(rating);
    $(this).parent().find('.result1').val(rating);
   });
});



function checkListingData() {
    var listingId = $('#addCompanyInListing').val();
    console.log("=========", listingId);
    if (listingId.length == 0) {
        $("#setStatus").attr('disabled', 'disabled');
        $("#addToListingButton").attr('disabled', 'disabled');
    } else {
        $("#setStatus").removeAttr('disabled');
        $("#addToListingButton").removeAttr('disabled');
    }
}

function checkBox() {
    var totalchecked = $('#hidden-count-checked-checkboxes').val()
    var countchecked = table
        .rows()
        .nodes()
        .to$() // Convert to a jQuery object
        .find('.selectedId:checked').length;

    console.log("=======", countchecked);

    if (countchecked == 0) {
        $("#setStatus").attr('disabled', 'disabled');
        $("#addToListingButton").attr('disabled', 'disabled');
        $("#addCompanyInListing").attr('disabled', 'disabled');
    } else {
        $("#setStatus").removeAttr('disabled');
        $("#addCompanyInListing").removeAttr('disabled');
    }

    var totalSelectedListing = countchecked + ' companies selected';
    $('#count-checked-checkboxes').val(totalSelectedListing)

    $('#hidden-count-checked-checkboxes').val(checkedbox)

    table.draw();
}

function setStatusFun() {
    swal({
            title: "Are you sure want to set status?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var setstatus = $('#setStatus').val();

                // var companies_id = [];
                // $.each($(".selectedId:checked"), function() {
                //     companies_id.push($(this).val());
                // });

                var companies_id = [];

                var rowcollection = table.$(".selectedId:checked", {
                    "page": "all"
                });
                rowcollection.each(function(index, elem) {
                    companies_id.push($(elem).val());
                });


                console.log(setstatus + "==" + companies_id);

                $.ajax({
                    type: "POST",
                    url: "{{ route('setCompanyStatus') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: setstatus,
                        companies_id: companies_id
                    }
                }).done(function(data) {
                    console.log(data);
                    $(window).scrollTop(0);

                    $("#showSuccessMessage").html("Companies status set successfully.")

                    $("#showSuccessMessage").fadeTo(2000, 500).slideUp(500, function() {
                        $("#showSuccessMessage").hide();
                    });
                    window.location.reload();
                });
            } else {
                swal("Your set status is safe!");
            }
        });
}

function addCompanyInListing(id) {
    swal({
            title: "Are you sure want to add to listing?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $("#overlay").fadeIn(300);
                
                var listingId = $('#addCompanyInListing').val();
                var companies_id = [];
                var rowcollection = table.$(".selectedId:checked", {
                    "page": "all"
                });
                rowcollection.each(function(index, elem) {
                    companies_id.push($(elem).val());
                });

                if (companies_id.length == 0) {
                    alert('please select any one companies...!')
                    return;
                }
                // alert(companies_id + '==' + listingId)
                $.ajax({
                    type: "POST",
                    url: "{{ route('addCompaniesListing') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        listing_id: listingId,
                        companies_id: companies_id
                    }
                }).done(function(data) {
                    console.log(data);
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },1000)
                    
                    $(window).scrollTop(0);
                    $("#showSuccessMessage").html("Companies add in listing successfully.")

                    $("#showSuccessMessage").fadeTo(2000, 500).slideUp(500, function() {
                        $("#showSuccessMessage").hide();
                    });
                    window.location.reload();
                });

            }
            else {
                // swal("Your set status is safe!");
                window.location.reload();
            }
        });


}



function ratingInput(id) {


    var rating = $("#rating_" + id).val();
    // alert(rating);

    if (rating < 0) {
        $("#priceValidation_" + id).css("display", "block");
        $("#priceCheckValidation_" + id).css("display", "none");
        return
    } 
    if(!(rating.replace(/[^0-9\.]/g,''))){
        $("#priceCheckValidation_" + id).css("display", "block");
        $("#priceValidation_" + id).css("display", "none");
        return
    }
    
    $("#priceValidation_" + id).css("display", "none");
    $("#priceCheckValidation_" + id).css("display", "none");


    $("#priceValidation_" + id).css("display", "none");

    if (5 < rating) {
        $("#ratingValidation_" + id).css("display", "block");

        $("#priceValidation_" + id).css("display", "none");
        $("#priceCheckValidation_" + id).css("display", "none");

        // $("#showDangerMessage").html("Rating can not be more than 5")
        // $(window).scrollTop(0);

        // $("#showDangerMessage").fadeTo(2000, 500).slideUp(500, function() {
        //     $("#showDangerMessage").hide();
        // });
        return;
    }
    $("#ratingValidation_" + id).css("display", "none");
    console.log("rating", rating);
    $.ajax({
        type: "POST",
        url: "{{ route('companyRating') }}", //you can use any web method as well
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            rating: rating
        } //parameters if you want to send any
    }).done(function(data) {
        $("#showSuccessMessage").html("rating updated.")
        $(window).scrollTop(0);

        $("#showSuccessMessage").fadeTo(2000, 500).slideUp(500, function() {
            $("#showSuccessMessage").hide();
        });
    });
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
                .id + '">' + value.name + '</option>');
        });
    });
}

function getFilterCompanies() {
    var keyword = $('#searchKeyword').val();
    var companyStatus = $('#companyStatus').val();
    var listingStatus = $('#listingStatus').val();
    var yearOfFoundation = $('#yearOfFoundation').val();
    var hourlyRate = $('#hourlyRate').val();
    var employeeNumbers = $('#employeeNumbers').val();
    var clientFocus = $('#clientFocus').val();
    var minProjectSize = $('#minProjectSize').val();
    var readyToStart = $('#readyToStart').val();
    var countryLocation = $('#countryLocation').val();
    var stateId = $('#stateId').val();
    var city = $('#city').val();


    var url = "{{ route('getFilterCompanies') }}"
    $.ajax({
        type: "post",
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
            keyword: keyword,
            company_status: companyStatus,
            listing_status: listingStatus,
            year_of_foundation: yearOfFoundation,
            hourly_rate: hourlyRate,
            employee_numbers: employeeNumbers,
            client_focus: clientFocus,
            minimal_project_size: minProjectSize,
            ready_to_start: readyToStart
        },
        success: function(data) {
            console.log(data);
            populateDataTable(data);

            // var count_email_data = data.companies_count + ' emails found'
            // $('#countCompaniesCount').val(count_email_data)
            // $('tbody').html(data.search_data);
        }
    });
}

function ratingChange(id){
   
   var rating =  $('#rateyo_'+id).val();
    $.ajax({
        type: "POST",
        url: "{{ route('companyRating') }}", //you can use any web method as well
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            rating: rating
        } //parameters if you want to send any
    }).done(function(data) {
        console.log(data)
         location.reload(true);
        // $("#showSuccessMessage").html("rating updated.")
        // $(window).scrollTop(0);

        // $("#showSuccessMessage").fadeTo(2000, 500).slideUp(500, function() {
        //     $("#showSuccessMessage").hide();
        // });
    });
   
}

function populateDataTable(data) {
    console.log("populating data table...", data);

    // clear the table before populating it with more data
    $("#check-box-count").DataTable().clear();
    var length = Object.keys(data).length;
    console.log("length of service line", length);
    var status;
    var num = 1;
    if (length != 0) {
        for (var i = 0; i <= length; i++) {
            var cat = data[i];
            var url = '{{ route("companies.show", ":id") }}';
            url = url.replace(':id', cat.id);

            $('#check-box-count').dataTable().fnAddData([
                '<div class="form-check1"><input class="form-check-input selectedId table-td-list-SelectAll" type="checkbox" onclick="checkBox();" value="'+cat.id+'" name="checkbox[]"></div>',
                num,
                cat.created_at,
                cat.company_name,
                '<span class="btn '+cat.status+'">'+cat.company_status+'</span>',
                cat.ls,
                cat.company_email,
                cat.listingCounts,
                '<a href="' +url+'" type="button" class="btn ipfs-button" >View</a>',
                '<input type="text" class="form-control" id="rating_'+cat.id+'" name="rating" value="'+cat.rating+'" onblur="ratingInput(\''+cat.id+'\')"/><p class="error" id="priceValidation_'+cat.id+'" style="display: none">Rating should be greater than zero</p> <p class="error" id="priceCheckValidation_'+cat.id+'" style="display: none">Rating should be only digit allow</p><p class="error" id="ratingValidation_'+cat.id+'" style="display: none">Rating can not be more than 5</p></td>'
            ]);


            num++;
        }
    } else {
        $('#check-box-count').dataTable().fnAddData([
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
