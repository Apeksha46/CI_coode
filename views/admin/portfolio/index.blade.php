@extends('admin.layouts.layout')
@section('content')
<style>
.select2-container--default .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}

.select2-container--open .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All case studies</h1>
                </div>
                <div class="col-sm-6">

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
                                    value="{{$all_casestudy->count()}} case studies found" disabled>
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
                                            <input type="search" class="form-control form-control-lg" name="search_keyword"
                                                id="searchKeyword" placeholder="Type company name or project name here">

                                        </div>
                                        <!-- <div class="row row_margin">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <input data-date-format="dd/mm/yyyy" class="form-control"
                                                            placeholder="form" id="datepicker">

                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <input data-date-format="dd/mm/yyyy" class="form-control"
                                                            placeholder="to" id="datepicker">

                                                    </div>
                                                </div>
                                            </div> -->
                                        <div class="row row_margin2">
                                            <!-- <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option selected>Location</option>
                                                            <option>DESC</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="cost[]" style="width: 100%;" multiple="multiple" data-placeholder="Select Cost">
                                                        <option value="Less 5000">Less 5000</option>
                                                        <option value="5000+">5000+</option>
                                                        <option value="10000+">10000+</option>
                                                        <option value="25000+">25000+</option>
                                                        <option value="50000+">50000+</option>
                                                        <option value="75000+">75000+</option>
                                                        <option value="100000+">100000+</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="timeline[]" id="timeline" style="width: 100%;" multiple="multiple" data-placeholder="Select Timeline">
                                                        <option value="Less 1 month">Less 1 month</option>
                                                        <option value="2-3 months">2-3 months</option>
                                                        <option value="4-6 months">4-6 months</option>
                                                        <option value="7-12 months">7-12 months</option>
                                                        <option value="more 1 year">more 1 year</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="team[]" id="team" style="width: 100%;" multiple="multiple" data-placeholder="Select team">
                                                        <option value="1">1</option>
                                                        <option value="2-5">2-5</option>
                                                        <option value="6-9">6-9</option>
                                                        <option value="10+">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row_margin1">
                                            <!-- <div class="col-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option selected>Added by</option>
                                                            <option>DESC</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="project_status" id="project_status" style="width: 100%;"  data-placeholder="Select Project status">
                                                         <option value="">Select Project status</option>
                                                        <option value="ongoing">Ongoing</option>
                                                        <option value="completed">Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="service_line[]" id="service_line" style="width: 100%;" multiple="multiple" data-placeholder="Select service line">
                                                        <!-- <option selected="selected" value="0">Select service line</option> -->
                                                        @foreach($categories as $category)
                                                        <optgroup label="{{$category->name}}">
                                                            @foreach($category->childs as $subcategory)
                                                            <option class="marginoption" value="{{$subcategory->id}}">
                                                                {{$subcategory->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="language[]" id="language" style="width: 100%;" multiple="multiple" data-placeholder="Select language">
                                                        @foreach($programming as $language)
                                                        <option class="marginoption" value="{{$language->id}}">
                                                            {{$language->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row_margin1">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="framework[]" id="framework" style="width: 100%;" multiple="multiple" data-placeholder="Select framework">
                                                        @foreach($framework as $f)
                                                        <option class="marginoption" value="{{$f->id}}">
                                                            {{$f->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="CMSSolutions[]" id="CMSSolutions" style="width: 100%;" multiple="multiple" data-placeholder="Select CMS Solutions">
                                                        @foreach($CMSSolutions as $cms_solution)
                                                        <option class="marginoption" value="{{$cms_solution->id}}">
                                                            {{$cms_solution->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" name="domains[]" id="domains" style="width: 100%;" multiple="multiple" data-placeholder="Select Domain focus">
                                                        @foreach($domains as $d)
                                                        <option class="marginoption" value="{{$d->id}}">
                                                            {{$d->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success button1"
                                        id="ApplyButton" onclick="getFilterCaseStudies()">Apply</button>
                                    <button type="button" class="btn btn-info button1" id="ApplyButton" onclick="window.location.reload();">Clear
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
                                            <input type="text" class="form-control form-control-lg total-selected-casestudy"
                                                value="0 Case Studies selected" disabled style="height: 42px;">
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

                                    <!-- <div class="col-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger">Delete selected</button>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-6" align="right">
                                        <a href="#" type="buttun"
                                            class="btn btn-info">+Add new portfolio</a>
                                    </div> -->
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
                            <h3 class="card-title">All case studies details</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="caseStudiesTbl" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>
                                            <label>Select ALL</label><br>
                                             <input class="form-check-input tableCheckbox" type="checkbox" value="1"
                                                id="select_all" style="margin-top: -10px;margin-left: 7px;">
                                        </th>
                                        <th>ID</th>
                                        <th>Added date</th>
                                        <th>Company name</th>
                                        <th>Project name</th>
                                        <th>Project Status</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @forelse ($all_casestudy as $caseStudy)
                                    <tr>
                                        <td>
                                             <div class="form-check1">
                                                <input
                                                    class="form-check-input casestudy-selected-Id table-td-list-SelectAll"
                                                    type="checkbox" value="{{$caseStudy->id}}" name="caseStudy_id[]"
                                                    onclick="checkBox();">
                                            </div>
                                        </td>
                                        <td> {{ $i++ . '.' }}</td>
                                        <td>{{ date('M d, Y', strtotime($caseStudy->created_at)) }}</td>
                                        <td> {{ !empty($caseStudy->company->company_name)?$caseStudy->company->company_name:'N/A'}} </td>
                                        <td>{{ !empty($caseStudy->project_name)?$caseStudy->project_name:'N/A'}}</td>
                                        <td>{{ ucfirst($caseStudy->project_status)}}</td>
                                        <td>{{ !empty($caseStudy->company->user->first_name)?ucfirst($caseStudy->company->user->first_name):'N/A'}} {{ !empty($caseStudy->company->user->last_name)?ucfirst($caseStudy->company->user->last_name):''}}
                                        <td>
                                            @if($caseStudy->status == 0)
                                            <button title="Status " class="btn ipfs-button" value=""
                                                onclick="change_status('{{ $caseStudy->id }}','Deactive','1')"> Active
                                            </button>
                                            @else
                                            <button title="Status " class="btn ipfs-danger" value=""
                                                onclick="change_status('{{ $caseStudy->id }}','Active','0')"> Deactive
                                            </button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('case_studies.destroy', $caseStudy) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('case_studies.show', $caseStudy) }}" type="button"
                                                    class="btn ipfs-button"><i class="fa fa-eye"></i></a>

                                                <!-- <a href="{{ route('case_studies.edit', $caseStudy) }}" type="button"
                                                        class="btn ipfs-button"><i class="fa fa-edit"></i></a> -->


                                                <button type="submit" class="btn ipfs-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Delete case study"
                                                    onclick="return confirm('Are you sure want to delete this case study!')"><i
                                                        class="fa fa-trash"></i></button>

                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="no-data-row">
                                        <td colspan="8" rowspan="2" align="center">
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
    var table = $('#caseStudiesTbl').DataTable({
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
            var selected_box = $(this).find('.casestudy-selected-Id').prop('checked', true);
            total++;
            $('.checkStatus').prop("disabled", false);
        } else {
            $(this).find('.casestudy-selected-Id').prop('checked', false);
            $('.checkStatus').prop("disabled", true);
        }
    });
    var totalSelectedListing = total + ' Case Studies selected';
    $('.total-selected-casestudy').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(total)

    
    table.draw();
});

function checkBox() {
    var totalchecked = $('#checkboxCheckedCount').val()
    var countchecked = table
        .rows()
        .nodes()
        .to$() // Convert to a jQuery object
        .find('.casestudy-selected-Id:checked').length;

    console.log("=======", countchecked);


    if (countchecked == 0) {
        $('.checkStatus').prop("disabled", true);
    } else {
        $('.checkStatus').prop("disabled", false);
    }

    var totalSelectedListing = countchecked + ' Case Studies selected';
    $('.total-selected-casestudy').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(checkedbox)

    table.draw();

}

function changeStatusListing(id) {
    if(id == 0){
        var status_name = 'Active';
    }else{
        var status_name = 'Deactive';
    }

    swal({
        title: "Are you sure want " + status_name + " this case studies",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var checkedValue = [];

            var rowcollection = table.$(".casestudy-selected-Id:checked", {
                "page": "all"
            });
            rowcollection.each(function(index, elem) {
                checkedValue.push($(elem).val());
            });

            $.ajax({
                type: "post",
                url: "{{ route('changeCaseStudyStatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'casestudy_status': id,
                    'casestudyId': checkedValue
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

function change_status(id, value, status) {
    swal({
        title: "Are you sure want " + value + " this case studies",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('case_studies.status') }}",
                type: "POST",
                data: {
                    "id": id,
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
            

        } else {
            location.reload();
        }
    });

  
}


function getFilterCaseStudies() {
    var domains = $('#domains').val();
    var framework = $('#framework').val();
    var CMSSolutions = $('#CMSSolutions').val();
    var language = $('#language').val();
    var service_line = $('#service_line').val();
    var project_status = $('#project_status').val();
    var team = $('#team').val();
    var timeline = $('#timeline').val();
    var cost = $('#cost').val();
    var searchKeyword = $('#searchKeyword').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('getFilterCaseStudies') }}",
        type: "POST",
        data: {
            "searchKeyword": searchKeyword,
            "domain_id": domains,
            "frameworks_id": framework,
            "cms_id": CMSSolutions,
            "languages_id": language,
            "category_id": service_line,
            "project_status": project_status,
            "team": team,
            "timeline": timeline,
            "cost": cost,
        },

        success: function(response) {
            var data = response;
            console.log(data);

            populateDataTable(data);

            // $('tbody').html(data.search_data);
            // var framework_count = data.framework_count + ' Framework Found'
            // $('#totalframework').val(framework_count)
        }
    });
}

function populateDataTable(data) {
    console.log("populating data table...", data);

    // clear the table before populating it with more data
    $("#caseStudiesTbl").DataTable().clear();
    var length = Object.keys(data).length;
    console.log("length of service line", length);
    var status;
    var num = 1;
    if (length != 0) {
        for (var i = 0; i <= length; i++) {
            var cat = data[i];
            var url = '{{ route("case_studies.destroy", ":id") }}';
            url = url.replace(':id', cat.id);

            var view_url = '{{ route("case_studies.destroy", ":id") }}';
            view = view_url.replace(':id', cat.id);



            if (cat.status == 0) {
                status = '<button title="Status " class="btn ipfs-button" value="' + JSON.stringify(cat) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Deactive\',\'1\')"> Active</button>';
            } else {
                status = '<button title="Status " class="btn ipfs-danger" value="' + JSON.stringify(cat) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Active\',\'0\')"> Deactive</button>';
            }
            $('#caseStudiesTbl').dataTable().fnAddData([
                '<div class="form-check1"><input class="form-check-input casestudy-selected-Id table-td-list-SelectAll" type="checkbox" value="' + cat.id + '" name="caseStudy_id[]" onclick="checkBox();"></div>',
                num,
                cat.added_date,
                cat.company_name,
                cat.project_name,
                cat.project_status,
                cat.user_name,
                status,
                '<form action="' + url +
                '" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}" /><input type="hidden" name="_method" value="DELETE"> <a title="View case studies" href="'+view+'" type="button" class="btn ipfs-button"><i class="fa fa-eye"></i></a> <button type="submit" class="btn ipfs-danger" data-toggle="tooltip" data-placement="top" title="Delete case studies" onclick="return confirm(\'Are you sure want to delete this case studies!\')"><i class="fa fa-trash"></i></button></form>'
            ]);
            num++;
        }
    } else {
        $('#caseStudiesTbl').dataTable().fnAddData([
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