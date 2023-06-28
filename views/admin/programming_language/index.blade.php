@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Programming Language</h1>
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
                                <input class="form-control form-control-lg" type="text" id="totalProgrammingLanguag"
                                    value="{{$allProgramming->count()}} Programming Language Found" disabled>
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
                                                placeholder="Type programming language here" name="search_keyword"
                                                id="searchKeyword">
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" style="width: 100%;" id="check_status"
                                                        name="status">
                                                        <option value="">Status</option>
                                                        <option value="0">Active</option>
                                                        <option value="1">Deactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success button1" id="ApplyButton"
                                        onclick="getFilterProgrammingLanguage()">Apply</button>
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
                                        <input type="text" class="form-control total-selected-programmingLanguag"
                                            value="0 Programming Language selected" disabled style="height: 42px;">
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
                                    <a href="{{ route('programming_language.create') }}" type="button"
                                        class="btn ipfs-button"><i  class="fa fa-plus"></i> Add Programming Language</a>
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
                            <h3 class="card-title">Programming Language Details</h3>
                        </div>
                        <div class="card-body">

                            <table id="programmingLanguageTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                        <label>Select ALL</label><br>
                                            <input class="form-check-input tableCheckbox table-th-list-SelectAll" type="checkbox" value="1"
                                                id="select_all" style="margin-top: -10px;margin-left: 7px;">
                                        </th>
                                        <th>
                                            <!-- <input class="form-check-input tableCheckbox" type="checkbox" value="1"
                                                id="select_all" style="margin-top: -10px;margin-left: 7px;"> -->
                                            No.
                                        </th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @forelse ($allProgramming as $p)

                                    <tr>
                                        <td>
                                            <div class="form-check1">
                                                <input class="form-check-input programmingLang-selected-Id table-td-list-SelectAll"
                                                    type="checkbox" value="{{$p->id}}" name="p_id[]"
                                                    onclick="checkBox();">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check1">
                                                <!-- <input class="form-check-input programmingLang-selected-Id"
                                                    type="checkbox" value="{{$p->id}}" name="p_id[]"
                                                    onclick="checkBox();"> -->
                                                <label class="form-check-label">{{ $i++."." }}</label>
                                            </div>
                                        </td>
                                        <td>{{!empty($p->name)?ucfirst($p->name):'N/A'}}
                                        </td>
                                        <td>
                                            @if($p->status == 0)
                                            <button title="Status " class="btn ipfs-button" value=""
                                                onclick="change_status('{{ $p->id }}','Deactive','1')"> Active
                                            </button>
                                            @else
                                            <button title="Status " class="btn ipfs-danger" value=""
                                                onclick="change_status('{{ $p->id }}','Active','0')"> Deactive
                                            </button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('programming_language.destroy', $p) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn ipfs-button edit-programmingLanguage"
                                                    data-id="{{ $p->id }}"
                                                    data-name="{{!empty($p->name)?ucfirst($p->name):'N/A'}}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <button type="submit" class="btn ipfs-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Delete programming language"
                                                    onclick="return confirm('Are you sure want to delete this programming language!')"><i
                                                        class="fa fa-trash"></i></button>
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

<div class="modal fade" id="editProgrammingLanguage">
    <div class="modal-dialog">
        <form action="{{ route('programming_language.update') }}" method="post" data-parsley-validate="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Programming Language</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                value="{{ old('name') }}" required data-parsley-required-message="Enter name">
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
</div>

@stop
@section('scripts')
<script>
var table = $('#programmingLanguageTable').DataTable({
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
            var selected_box = $(this).find('.programmingLang-selected-Id').prop('checked', true);
            total++;
            $('.checkStatus').prop("disabled", false);
        } else {
            $(this).find('.programmingLang-selected-Id').prop('checked', false);
            $('.checkStatus').prop("disabled", true);
        }
    });
    var totalSelectedListing = total + ' Programming Language selected';
    $('.total-selected-programmingLanguag').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(total)

    table.draw();
});

function checkBox() {
    var totalchecked = $('#checkboxCheckedCount').val()
    var countchecked = table
        .rows()
        .nodes()
        .to$() // Convert to a jQuery object
        .find('.programmingLang-selected-Id:checked').length;

    console.log("=======", countchecked);


    if (countchecked == 0) {
        $('.checkStatus').prop("disabled", true);
    } else {
        $('.checkStatus').prop("disabled", false);
    }

    var totalSelectedListing = countchecked + ' Programming Language selected';
    $('.total-selected-programmingLanguag').val(totalSelectedListing)

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

            var rowcollection = table.$(".programmingLang-selected-Id:checked", {
                "page": "all"
            });
            rowcollection.each(function(index, elem) {
                checkedValue.push($(elem).val());
            });

            $.ajax({
                type: "post",
                url: "{{ route('changeProgrammingLangStatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'status': id,
                    'programmingLang_Id': checkedValue
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


// $('.edit-listingcategory').on('click', function() {
$('body').on('click', '.edit-programmingLanguage', function() {

    var id = $(this).data('id');
    var name = $(this).data('name');

    $('#id').val(id);
    $('#name').val(name);

    $('#editProgrammingLanguage').modal('show');
});

function change_status(id, value, status) {
    if (confirm("Are you sure want " + value + " this programming language")) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('programming_language.status') }}",
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
    }
}

function getFilterProgrammingLanguage() {
    var searchKeyword = $('#searchKeyword').val();
    var check_status = $('#check_status').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('getFilterProgrammingLanguage') }}",
        type: "POST",
        data: {
            "searchKeyword": searchKeyword,
            "check_status": check_status,
        },

        success: function(response) {
            var data = response;
            console.log(data);
            populateDataTable(data);

            // $('tbody').html(data.search_data);
            // var programming_count = data.programming_count + ' Programming Language Found'
            // $('#totalProgrammingLanguag').val(programming_count)
        }
    });
}

function populateDataTable(data) {
    console.log("populating data table...", data);

    // clear the table before populating it with more data
    $("#programmingLanguageTable").DataTable().clear();
    var length = Object.keys(data).length;
    console.log("length of service line", length);
    var status;
    var num = 1;
    if (length != 0) {
        for (var i = 0; i <= length; i++) {
            var cat = data[i];
            var url = '{{ route("programming_language.destroy", ":id") }}';
            url = url.replace(':id', cat.id);

            if (cat.status == 0) {
                status = '<button title="Status " class="btn ipfs-button" value="' + JSON.stringify(cat) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Deactive\',\'1\')"> Active</button>';
            } else {
                status = '<button title="Status " class="btn ipfs-danger" value="' + JSON.stringify(cat) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Active\',\'0\')"> Deactive</button>';
            }
            $('#programmingLanguageTable').dataTable().fnAddData([
                '<div class="form-check1"><input class="form-check-input programmingLang-selected-Id table-td-list-SelectAll" type="checkbox" value="' + cat.id + '" name="p_id[]" onclick="checkBox();"></div>',
                num,
                cat.name,
                status,
                '<form action="' + url +
                '" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}" /><input type="hidden" name="_method" value="DELETE"><button type="button" class="btn ipfs-button edit-programmingLanguage" data-id="' +
                cat.id + '"  data-name="' + cat.name + '"><i class="fa fa-edit"></i> </button> <button type="submit" class="btn ipfs-danger" data-toggle="tooltip" data-placement="top" title="Delete programming language" onclick="return confirm(\'Are you sure want to delete this programming language!\')"><i class="fa fa-trash"></i></button></form>'
            ]);
            num++;
        }
    } else {
        $('#programmingLanguageTable').dataTable().fnAddData([
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