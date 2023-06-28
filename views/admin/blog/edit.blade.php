@extends('admin.layouts.layout')
@section('content')
    <style>
        #picture__input {
            display: none;
        }

        .picture {
            width: 400px;
            aspect-ratio: 16/9;
            background: #f1f3f4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            border: 2px dashed currentcolor;
            cursor: pointer;
            font-family: sans-serif;
            transition: color 300ms ease-in-out, background 300ms ease-in-out;
            outline: none;
            overflow: hidden;
        }

        .picture:hover {
            color: #777;
            background: #ccc;
        }

        .picture:active {
            border-color: turquoise;
            color: turquoise;
            background: #eee;
        }

        .picture:focus {
            color: #777;
            background: #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .picture__img {
            max-width: 100%;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add new blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('blogs.index') }}" class="btn ipfs-button"><i class="fa fa-arrow-left"></i>
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
                                <form action="{{ route('blogs.update', $blog->id) }}" method="post" id="blog-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $blog->id}}" id="id"/>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Title*</label>
                                                <input type="text" name="title" id="title"
                                                    value="{{ $blog->title ? $blog->title : '' }}" class="form-control" onblur="checkTitle()" />
                                                <span class="error" id="err-blog_name" style="display: none;">Enter title</span>
                                                <span class="error" id="err-titleCheck" style="display: none;">Title already exist </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Type*</label>
                                                <select class="select2" name="type" style="width: 100%;" id="type">
                                                    <option value="">Type</option>
                                                    <option value="business"
                                                        @if ($blog->type == 'business') selected @endif>Business</option>
                                                    <option value="design"
                                                        @if ($blog->type == 'design') selected @endif>Design</option>
                                                    <option value="interviews"
                                                        @if ($blog->type == 'interviews') selected @endif>Interviews
                                                    </option>
                                                    <option value="marketing"
                                                        @if ($blog->type == 'marketing') selected @endif>Marketing</option>
                                                    <option value="research"
                                                        @if ($blog->type == 'research') selected @endif>Research</option>
                                                    <option value="reviews"
                                                        @if ($blog->type == 'reviews') selected @endif>Reviews</option>
                                                    <option value="tech"
                                                        @if ($blog->type == 'tech') selected @endif>Tech</option>
                                                </select>
                                                <span class="error" id="err-blog_type" style="display: none;">Select blog type</span>

                                            </div>

                                            <div class="form-group">
                                                <label>Created By</label>
                                                <input type="text"
                                                    value="{{ $blog->created_by ? $blog->created_by : '' }}"
                                                    name="created_by" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-6">

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="photo" class="col-sm-2 control-label">Upload</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" name="image"
                                                            id="photo" accept=".png, .jpg, .jpeg"
                                                            onchange="readFile(this);" multiple>
                                                    </div>

                                                    <div id="blogImage" class="row" >
                                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                                           
                                                            <a href="{{ $blog->getImageAttribute() }}" target="_blank">
                                                                <img src="{{ $blog->getImageAttribute() }}" height="250" width="450" id="previewImage" class="img-thumbnail"/>

                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea id="compose-textarea" name='description' class="form-control" style="height: 300px">{{ $blog->description ? $blog->description : '' }}</textarea>
                                                <span class="error" id="err-blog_desc" style="display: none;">Enter Desciption</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary" id="editBlog">Update</button>
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

    <script>
        function readFile(input) {
            $('#blogImage').show();
            counter = input.files.length;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }

        }

        $("#photo").change(function(){
        read(this);
    });
    </script>
@stop
@section('scripts')
    <script>
        $(function() {
    $('#editBlog').click(function() {
        // alert(1);
        var title = $('#title').val();
        var description = $('#compose-textarea').val();
        var type = $('#type').val();

        var title_valid = false;
        var description_valid = false;
        var type_valid = false;
        
        // alert(title)
        // alert(type)
        // alert(description)

        if (title == '' || title == 0) {
            $("#err-blog_name").css("display", "block");
            var title_valid  = false;
            // return false;
        } else {
            $("#err-blog_name").css("display", "none");
            var title_valid  = true;
        }

        if (description == '' || description == 0) {
            $("#err-blog_desc").css("display", "block");
            var description_valid  = false;
            // return false;
        } else {
            $("#err-blog_desc").css("display", "none");
            var description_valid  = true;
        }

        if (type == '' || type == 0) {
            $("#err-blog_type").css("display", "block");
            var type_valid  = false;
        } else {
            $("#err-blog_type").css("display", "none");
            var type_valid  = true;
        }

        if (title_valid == false || description_valid == false || type_valid ==false) {
            $(window).scrollTop(0);
            return false;
        }

    });
});

function checkTitle() {
        var title = $('#title').val();
        var id = $('#id').val();

        $.ajax({
            type: "POST",
            url: "{{ route('checkTitle') }}", //you can use any web method as well
            data: {
                _token: "{{ csrf_token() }}",
                title: title,
                id: id,
            } //parameters if you want to send any
        }).done(function(data) {

            if (data == 1) {
                $("#err-titleCheck").css("display", "block");
                $('#title').val('');
            } else {
                $("#err-titleCheck").css("display", "none");

            }


        });
    }
           

        $(function() {
            //Add text editor
            $('#compose-textarea').summernote()
        })
    </script>
@stop
