@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Emails</h1>
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
                                    <input class="form-control form-control-lg" type="text" value="{{ $users->count() }} emails found"
                                        disabled id="count_email_data">
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
                                                {{-- placeholder="Type emails_to, subject or company ID here" --}}
                                                <input type="search" class="form-control form-control-lg"
                                                    placeholder="Type email here" id="searchData" name="search">

                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;" id="selectStatus">
                                                            <option value="0">Status</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <select class="select2" style="width: 100%;">
                                                            <option selected>Email type</option>
                                                            <option>DESC</option>
                                                        </select>
                                                    </div>
                                                </div> --}}


                                            </div>


                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success button1"
                                            id="ApplyButton" onclick="applyFuction();">Apply</button>
                                        <button type="button" class="btn btn-info button1" id="ApplyButton" onclick="window.location.reload();">Clear
                                            all</button>
                                    </div>
                                </form> 
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

        {{-- <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card table-responsive">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg"
                                                value="0 emails selected" disabled>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-warning">skip</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card table-responsive">

                            <div class="row col-12 ">
                                {{-- <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input tableCheckbox" type="checkbox">
                                        <label class="form-check-label">Select all</label>
                                    </div>
                                </div> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="emailTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr >
                                            <th>ID.</th>
                                            <th >Registration Date</th>
                                            <th >Email to</th>
                                            <th >Company name</th>
                                            {{-- <th>Type</th> --}}
                                            <th >Status</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                {{ $i++  }}
                                            </td>
                                            <td>{{ date('M d, Y', strtotime($user->created_at)) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->company?$user->company->company_name:"-" }}</td>
                                            <td>
                                                @if($user->email_verified_at)
                                                <button type="button" class="btn btn-success rounded-pill">completed</button>
                                                 @else
                                                 <button type="button" class="btn btn-warning rounded-pill">pending</button>
                                                 @endif
                                            </td>
                                            <!-- <td></td> -->

                                        </tr>
                                        @empty
                                            <tr class="no-data-row">
                                                <td colspan="8" rowspan="2" align="center">
                                                    <div class="message"><p>No data available in table</p></div>
                    
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
    var table = $('#emailTable').DataTable({
    "ordering": false,
    "language": {
        "lengthMenu": "Display _MENU_ records per page",
        "zeroRecords": "Nothing found - sorry",
        "info": "Showing page _PAGE_ of _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(Filtered from total _MAX_ entries)"
    }
});

    function applyFuction(){
        var url = "{{ route('searchByEmail') }}"
        var searchData = $('#searchData').val();
        var selectStatus = $('#selectStatus').val();
        // alert(searchData+","+selectStatus)
        $.ajax({
            type: "post",
            url: url,
            data: {"_token": "{{ csrf_token() }}",'search':searchData,'status':selectStatus},
            success: function(data){
                console.log(data);
                populateDataTable(data);
                
                //  var count_email_data = data.user_count + ' emails found'
                // $('#count_email_data').val(count_email_data)
                // $('tbody').html(data.search_data);
               
            }
        });
    }

    function populateDataTable(data) {
    console.log("populating data table...", data);

    // clear the table before populating it with more data
    $("#emailTable").DataTable().clear();
    var length = Object.keys(data).length;
    console.log("length of service line", length);
    var status;
    var num = 1;
    if (length != 0) {
        for (var i = 0; i <= length; i++) {
            var cat = data[i];
            // var url = '{{ route("framework.destroy", ":id") }}';
            // url = url.replace(':id', cat.id);


            $('#emailTable').dataTable().fnAddData([
                num,
                cat.date,
                cat.email,
                cat.company_name,
                cat.status,
             ]);
            num++;
        }
    } else {
        $('#emailTable').dataTable().fnAddData([
            '',
            '',
            '<tr class="no-data-row"> <td colspan="6" rowspan="1" align="center"><div class="message"><p>No data available in table</p></div></td></tr>',
            '',
            '',

        ])
    }
}
</script>
@stop
