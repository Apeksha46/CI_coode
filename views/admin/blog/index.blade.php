@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Blogs</h1>
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
                                <input class="form-control form-control-lg" type="text" value="{{$blogs->count()}} blogs found"
                                    disabled>
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
                                                placeholder="Type blog tittle"  id="searchKeyword">

                                        </div>
                                        <div class="row row_margin">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label></label>
                                                    <select class="select2" style="width: 100%;" id="type">
                                                        <option selected>Type</option>
                                                        <option value="business">Business</option>
                                                        <option value="design">Design</option>
                                                        <option value="interviews">Interviews</option>
                                                        <option value="marketing">Marketing</option>
                                                        <option value="research">Research</option>
                                                        <option value="reviews">Reviews</option>
                                                        <option value="tech">Tech</option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success button1" id="ApplyButton"
                                        onclick="getBlog()">Apply</button>
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
                                        <input type="text" class="form-control total-selected-blog"
                                            value="0 Blog Found" disabled style="height: 42px;">
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
                                <a href="{{ route('blogs.create') }}" type="buttun" class="btn ipfs-button"><i
                                            class="fa fa-plus"></i> Add new
                                        blog</a>
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
                            <h3 class="card-title">All blog details</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="blogList" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>
                                            <label>Select ALL</label><br>
                                            <input class="form-check-input tableCheckbox table-th-list-SelectAll" type="checkbox" value="1"
                                                id="select_all" style="margin-top: -10px;margin-left: 7px;">
                                        </th>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Created by</th>
                                        <th>Create at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @forelse ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <div class="form-check1">
                                                <input class="form-check-input blog-selected-Id table-td-list-SelectAll"
                                                    type="checkbox" value="{{$blog->id}}" name="p_id[]"
                                                    onclick="checkBox();">
                                            </div>
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td><img src="{{ $blog->getImageAttribute() }}" width="50"
                                                height="50"></td>
                                        <td>{{ ucfirst($blog->type) }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>
                                            @if(!empty($blog->created_by))
                                                {{$blog->created_by}}
                                            @else
                                                Tech-Reviewers
                                            @endif  
                                        </td>
                                        <td>
                                            {{date('M d, Y', strtotime($blog->created_at))}}
                                        </td>
                                        <td>
                                            @if($blog->status == 0)
                                                <button title="Status " class="btn ipfs-button" value="{{ $blog}})"
                                                    onclick="change_status('{{ $blog->id }}','Deactive','1')"> Active
                                                </button>
                                            @else
                                                <button title="Status " class="btn ipfs-danger" value="{{ $blog }})"
                                                    onclick="change_status('{{ $blog->id }}','Active','0')"> Deactive
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <a title="View" href="{{ route('blogs.show', $blog->id) }}"
                                                    class="btn ipfs-button"><i class="fa fa-eye"></i>
                                                </a>

                                                <a title="Edit" href="{{ route('blogs.edit', $blog->id) }}"
                                                    class="btn ipfs-button"><i class="fa fa-edit"></i>
                                                </a>

                                                <button title="Delete" type="submit" class="btn ipfs-danger" 
                                                onclick="return confirm('Are you sure want to delete this blog!')"><i class="fa fa-trash"></i></button>
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
    var table = $('#blogList').DataTable({
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
            var selected_box = $(this).find('.blog-selected-Id').prop('checked', true);
            total++;
            $('.checkStatus').prop("disabled", false);
        } else {
            $(this).find('.blog-selected-Id').prop('checked', false);
            $('.checkStatus').prop("disabled", true);
        }
    });
    var totalSelectedListing = total + ' blog Found';
    $('.total-selected-blog').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(total)
    table.draw();
});


function checkBox() {
    var totalchecked = $('#checkboxCheckedCount').val()
    var countchecked = table
        .rows()
        .nodes()
        .to$() // Convert to a jQuery object
        .find('.blog-selected-Id:checked').length;

    console.log("=======", countchecked);


    if (countchecked == 0) {
        $('.checkStatus').prop("disabled", true);
    } else {
        $('.checkStatus').prop("disabled", false);
    }

    var totalSelectedListing = countchecked + ' blog Found';
    $('.total-selected-blog').val(totalSelectedListing)
    $('#checkboxCheckedCount').val(checkedbox)

    table.draw();
}

function changeStatusListing(id) {
    if(id == 0){
        var status_bloge = 'Active';
    }else{
        var status_bloge = 'Deactive';
    }

    swal({
        title: "Are you sure want " + status_bloge + " this Blog",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var checkedValue = [];

            var rowcollection = table.$(".blog-selected-Id:checked", {
                "page": "all"
            });
            rowcollection.each(function(index, elem) {
                checkedValue.push($(elem).val());
            });

            $.ajax({
                type: "post",
                url: "{{ route('changeBlogStatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'status': id,
                    'blog_Id': checkedValue
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
        title: "Are you sure want " + value + " this Blog",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('blog.status') }}",
                type: "POST",
                data: {
                    "blogId": id,
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

function getBlog() {
    var searchKeyword = $('#searchKeyword').val();
    var type = $('#type').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('getFilterBlog') }}",
        type: "POST",
        data: {
            "searchKeyword": searchKeyword,
            "type": type,
        },

        success: function(response) {
            var data = response;
            console.log(data);
            populateDataTable(data);
        }

    });

}

function populateDataTable(data) {
    console.log("populating data table...", data);

    // clear the table before populating it with more data
    $("#blogList").DataTable().clear();
    var length = Object.keys(data).length;
    console.log("length of service line", length);
    var status;
    var num = 1;
    if (length != 0) {
        for (var i = 0; i <= length; i++) {
            var cat = data[i];
            var url = '{{ route("blogs.destroy", ":id") }}';
            url = url.replace(':id', cat.id);

            var edtiUrl = '{{ route("blogs.edit", ":id") }}';
            edti_url = edtiUrl.replace(':id', cat.id);

            var viewUrl = '{{ route("blogs.show", ":id") }}';
            view_url = viewUrl.replace(':id', cat.id);


            if (cat.status == 0) {
                status = '<button title="Status " class="btn ipfs-button" value="' + JSON.stringify(cat.id) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Deactive\',\'1\')"> Active</button>';
            } else {
                status = '<button title="Status " class="btn ipfs-danger" value="' + JSON.stringify(cat.id) +
                    '" onclick="change_status(\'' + cat.id + '\',\'Active\',\'0\')"> Deactive</button>';
            }

            $('#blogList').dataTable().fnAddData([
                '<div class="form-check1"><input class="form-check-input framework-selected-Id table-td-list-SelectAll" type="checkbox" value="' + cat.id + '" name="p_id[]" onclick="checkBox();"></div>',
                num,
                cat.img,
                cat.type,
                cat.title,
                cat.created_by,
                cat.created_at,
                status,
                '<form action="' + url +
                '" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}" /><input type="hidden" name="_method" value="DELETE"> <a href="'+view_url+'" type="button" class="btn ipfs-button" title="View Blog"><i class="fa fa-eye"></i></a> <a href="'+edti_url+'" type="button" class="btn ipfs-button" title="Edit Blog"><i class="fa fa-edit"></i></a> <button type="submit" class="btn ipfs-danger" data-toggle="tooltip" data-placement="top" title="Delete Blog" onclick="return confirm(\'Are you sure want to delete this blog!\')"><i class="fa fa-trash"></i></button> </form>'
            
            ]);
            num++;
        }
    } else {
        $('#blogList').dataTable().fnAddData([
            '',
            '',
            '',
            '<tr class="no-data-row"> <td colspan="8" rowspan="1" align="center"><div class="message"><p>No data available in table</p></div></td></tr>',
            '',
            '',
            '',
            ''
        ])
    }
}
</script>

@stop