@extends('admin.layouts.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service Lines </h1>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('categories_trees.create') }}" class="btn ipfs-button"><i
                                class="fa fa-plus"></i> Add</a>
                    </ol>

                    <!-- <button type="button" class="btn btn-success float-sm-right" data-toggle="modal" data-target="#addCategory">
                        <i class="fa fa-plus"></i> Add
                    </button> -->
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
                            <h3 class="card-title">Service Lines</h3>
                            <!-- <div style="float:right">
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'excel']) }}" class="btn ipfs-button"><i class="fa fa-file-excel-o"></i> Excel</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'pdf']) }}" class="btn ipfs-button"><i class="fa fa-file-pdf-o"></i> PDF</a>
                    <a href="{{ route('users.index',['export'=>true,'exportType'=>'csv']) }}" class="btn ipfs-button"><i class='fas fa-file-csv'></i> CSV</a>
                </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tbody>

                                    @foreach($categories as $category)
                                    <tr data-widget="expandable-table" aria-expanded="false">

                                        <td>
                                            @if(count($category->childs)) <i class="expandable-table-caret fas fa-caret-right fa-fw"></i> @endif
                                            {{ $category->name }}

                                            @if($category->status == 0)
                                            <button title="Status " class="btn ipfs-button" value="{{ $category}})"
                                                onclick="change_status('{{ $category->id }}','Deactive','1')"> Active
                                            </button>
                                            @else
                                            <button title="Status " class="btn ipfs-danger" value="{{ $category }})"
                                                onclick="change_status('{{ $category->id }}','Active','0')"> Deactive
                                            </button>
                                            @endif


                                            <form action="{{ route('categories_trees.destroy', $category) }}"
                                                method="POST">
                                                <button type="button" class="btn ipfs-button edit-category"
                                                    data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                                    data-parent_id="{{ $category->parent_id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </button>

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn ipfs-button" data-toggle="tooltip"
                                                    data-placement="top" title="Delete User"
                                                    onclick="return confirm('Are you sure want to delete this category!')"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>

                                        </td>

                                    </tr>

                                    @if(count($category->childs))
                                        @include('admin/categories_trees/manageChild',['childs' => $category->childs])
                                    @endif

                                    @endforeach

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

<div class="modal fade" id="editCategory">
    <div class="modal-dialog">
        <form action="{{ route('category.update') }}" method="post" data-parsley-validate="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Service Line Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="categoryId" name="categoryId" value="">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Parent Category</label>
                            <select class="form-control select2" style="width: 100%;" name="parent_id" id="parentId">
                                <option value="0" selected="selected">Select Parent Category</option>
                                @foreach ($allcategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" placeholder="Category Name"
                                name="name" value="{{ old('name') }}" required
                                data-parsley-required-message="Enter name">
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
$('.edit-category').on('click', function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var parent_id = $(this).data('parent_id');

    $('#categoryId').val(id);
    $('#categoryName').val(name);

    $('#parentId').val(parent_id);
    $('#parentId').select2().trigger('change');

    $('#editCategory').modal('show');
});

function change_status(id, value, status) {
    if (confirm("Are you sure want " + value + " this Category")) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('category.status') }}",
            type: "POST",
            data: {
                "categoryId": id,
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