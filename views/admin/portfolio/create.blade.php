@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add new project</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('portfolio-items.index') }}" class="btn btn-warning"><i
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

                                <form action="" method="POST">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="col-9">
                                                <label for="companyName">Company</label>
                                                <select class="form-control select2" name="companyName" style="width: 100%;"
                                                    id="companyName">
                                                    <option selected="selected" value="0">Please select company
                                                    </option>
                                                    <option value="1">Alaska</option>
                                                    <option value="2">California</option>
                                                    <option value="3">Delaware</option>
                                                    <option value="4">Tennessee</option>
                                                </select>
                                                <div class="form-group">
                                                    <label for="projectName">Project Name</label>
                                                    <input type="text" class="form-control" id="projectName"
                                                        name="projectName" placeholder="Enter project name">
                                                </div>

                                                <label for="countryName">Client country</label>
                                                <select class="form-control select2" name="countryName" style="width: 100%;"
                                                    id="countryName">
                                                    <option selected="selected" value="0">Please select company
                                                    </option>
                                                    <option value="1">Alaska</option>
                                                    <option value="2">California</option>
                                                    <option value="3">Delaware</option>
                                                    <option value="4">Tennessee</option>
                                                </select>

                                                <div class="form-group">
                                                    <label for="url">City</label>
                                                    <input type="text" class="form-control" id="city" name="city"
                                                        placeholder="Enter city">
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Project status</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="Completed">Completed</option>
                                                        <option value="Ongoing">Ongoing</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label>Challenge</label>
                                                    <textarea class="form-control" name="challenge" rows="3"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Solution</label>
                                                    <textarea class="form-control" name="solution" rows="3"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Results</label>
                                                    <textarea class="form-control" name="results" rows="3"></textarea>
                                                </div>


                                                <div class="form-group">
                                                    <label for="status">Cost</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="0">Select cost</option>
                                                        <option value="10000">10000+</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Team</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="0">Select team </option>
                                                        <option value="5-10">5-10</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Language*</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="0">Select language</option>
                                                        <option value="PHP">PHP</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Framework*</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="0">Select framework</option>
                                                        <option value="Laravel">Laravel</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="row col-4">
                                                <label>Title image*</label>
                                                <div class="form-group">
                                                    <input type="file" onchange="readURL(this);"
                                                        class="margin_between_imgs" /><br>
                                                    <img id="projectImage1" src="{{ url('public/dist/img/default.png') }}"
                                                        alt="your image" width="150" height="150"
                                                        class="margin_between_imgs" />
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="form-group col-4">
                                                    <input type="file" onchange="readURL(this);"
                                                        class="margin_between_imgs" /><br>
                                                    <img id="projectImage2" src="{{ url('public/dist/img/default.png') }}"
                                                        alt="your image" width="150" height="150"
                                                        class="margin_between_imgs" />
                                                </div>

                                                <div class="form-group col-4">
                                                    <input type="file" onchange="readURL(this);"
                                                        class="margin_between_imgs" /><br>
                                                    <img id="projectImage3" src="{{ url('public/dist/img/default.png') }}"
                                                        alt="your image" width="150" height="150"
                                                        class="margin_between_imgs" />
                                                </div>

                                                <div class="form-group col-4">
                                                    <input type="file" onchange="readURL(this);"
                                                        class="margin_between_imgs" /><br>
                                                    <img id="projectImage4" src="{{ url('public/dist/img/default.png') }}"
                                                        alt="your image" width="150" height="150"
                                                        class="margin_between_imgs" />
                                                </div>
                                            </div>



                                            <div class="col-9">
                                                <div class="form-group">
                                                    <label for="metaDescription">Project URL*</label>
                                                    <input class="form-control" id="projectURL" name="projectURL">
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Time line</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="0">Select time line</option>
                                                        <option value="More than 2 months">More than 2 months</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Service line*</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="0">Select service line</option>
                                                        <option value="blockchain"> Blockchain</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Domains*</label>
                                                    <select class="form-control select2" name="status"
                                                        style="width: 100%;">
                                                        <option value="0">Select domains focus</option>
                                                        <option value="More than 2 months">More than 2 months</option>
                                                    </select>
                                                </div>


                                            </div>

                                        </div>



                                        <!-- /.col -->
                                    </div>
                                    <div class="card-footer" align="right">
                                        <button type="submit" class="btn btn-block btn-primary btn-sm">Save</button>
                                    </div>
                                    <!-- /.row -->
                                </form>
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
    <script>
        function readURL(input) {
            alert(input)
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result).width(150).height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop
