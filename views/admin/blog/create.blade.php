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

        .img-thumbnail {
                
                object-fit: cover;
                object-position: center;
                margin: 10px;
            }

            @media(max-width: 480px) {
                .img-thumbnail {
                    height: 50px;
                }
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
                                <form action="{{ route('blogs.store') }}" method="post" id="blog-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Title*</label>
                                                <input type="text" name="title" class="form-control"
                                                onblur="checkTitle()" id="title"/>
                                            <span class="error" id="err-titleCheck" style="display: none;">Title already
                                                exist </span>
                                                <span class="error" id="err-blog_name" style="display: none;">Enter title</span>
                                            </div>
                                            <div class="form-group">
                                                <label>Type*</label>
                                                <select class="select2" name="type" style="width: 100%;" id="type">
                                                    <option selected value="">Select Type</option>
                                                    <option value="business">Business</option>
                                                    <option value="design">Design</option>
                                                    <option value="interviews">Interviews</option>
                                                    <option value="marketing">Marketing</option>
                                                    <option value="research">Research</option>
                                                    <option value="reviews">Reviews</option>
                                                    <option value="tech">Tech</option>
                                                </select>
                                                <span class="error" id="err-blog_type" style="display: none;">Select blog type</span>

                                            </div>

                                            <div class="form-group">
                                                <label>Created By</label>
                                                <input type="text" name="created_by" class="form-control" />
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

                                                    <div id="blogImage" class="row" style="display: none;">
                                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                                            <img height="250" width="450" id="previewImage" class="img-thumbnail"/>
                                                  
                                                        </div>
                                                    </div>
                                                    <span class="error" id="err-blog_image" style="display: none;">Select image</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea id="compose-textarea" name='description' class="form-control" style="height: 300px"></textarea>
                                                <span class="error" id="err-blog_desc" style="display: none;">Enter Desciption</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary" id="addBlog">Save</button>
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
    $('#addBlog').click(function() {
        // alert(1);
        var title = $('#title').val();
        var description = $('#compose-textarea').val();
        var type = $('#type').val();

        var title_valid = false;
        var description_valid = false;
        var type_valid = false;
         var image_valid = false;
        
        // alert(listing_name)
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
        
        if ($('#photo')[0].files.length === 0) {
            $("#err-blog_image").css("display", "block");
            var image_valid  = false;
        } else {
            $("#err-blog_image").css("display", "none");
            var image_valid  = true;
        }

        if (title_valid == false || description_valid == false || type_valid ==false || image_valid == false) {
            $(window).scrollTop(0);
            return false;
        }

    });
});
            
    function checkEmail(){
        var company_email = $('#company_email').val();

        $.ajax({
            type: "POST",
            url: "{{ route('checkEmail') }}", //you can use any web method as well
            data: {
                _token: "{{ csrf_token() }}",
                company_email: company_email
            } //parameters if you want to send any
        }).done(function(data) {

            if(data == 1){
                $("#err-emailCheck").css("display", "block");
                $('#company_email').val('');
            }else{
                $("#err-emailCheck").css("display", "none");
                
            }

            
        });
    }

    function checkTitle() {
        var title = $('#title').val();

        $.ajax({
            type: "POST",
            url: "{{ route('checkTitle') }}", //you can use any web method as well
            data: {
                _token: "{{ csrf_token() }}",
                title: title,
                id:0
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
