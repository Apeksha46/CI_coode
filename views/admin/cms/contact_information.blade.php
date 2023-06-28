@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" id="edit_info_section">
                    <h1>Contact Information</h1>
                </div>

                <div class="col-sm-6" style="display: none;" id="update_info_section">
                    <h1>Edit Contact Information</h1>
                </div>

                <!-- <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ url()->previous() }}" class="btn ipfs-button"><i class="fa fa-arrow-left"></i>
                            Back</a>
                    </ol>
                </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card table-responsive saveData">
                        <div class="card-header">
                            <h3 class="card-title">Contact Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- <form action="" method="post" data-parsley-validate=""> -->
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail3"
                                                placeholder="Email"
                                                value="{{($contact_info==null)?" ":$contact_info->email}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Call us</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Call us"
                                                value="{{($contact_info==null)? ' ' :$contact_info->contact_no}}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Address"
                                                value="{{($contact_info==null)?'':$contact_info->address}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Discord
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Discord Link"
                                                value="{{($contact_info==null)?'':$contact_info->discord_link}}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Facebook
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Facebook Link"
                                                value="{{($contact_info==null)?'':$contact_info->facebook_link}}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Twitter Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Twitter Link"
                                                value="{{($contact_info==null)?'':$contact_info->twitter_link}}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">LinkedIn
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="LinkedIn Link"
                                                value="{{($contact_info==null)?'':$contact_info->linkedIn_link}}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Instagram
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Instagram Link"
                                                value="{{($contact_info==null)?'':$contact_info->instagram_link}}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Youtube
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Youtube Link"
                                                value="{{($contact_info==null)?'':$contact_info->youtube_link}}"
                                                readonly>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="">
                                    <!-- <button type="button" id="editbtn" class="btn btn-primary float-right mr-3"
                                        onclick="div_hide_show(1);">Edit</button> -->
                                        <button class="btn btn-primary float-right mr-3" id="edit">Edit</button>
                                </div>

                            <!-- </form> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card table-responsive editable" style="display: none;">
                        <div class="card-header">
                            <h3 class="card-title">Edit Contact Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('update_contact_info') }}" method="post" data-parsley-validate="">
                            <input type="hidden" name="id"  value="{{($contact_info==null)?'':$contact_info->id}}" >
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail3"
                                                placeholder="Email" name="email" required type="email" data-parsley-type="email" data-parsley-required-message="Enter Email-Id" data-parsley-type-message="Email-Id should be valid format"
                                                value="{{($contact_info==null)?" ":$contact_info->email}}" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Call us</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Call us" name="contact_no"
                                                value="{{($contact_info==null)? ' ' :$contact_info->contact_no}}" data-parsley-type="number" data-parsley-type-message="Only number allows" required data-parsley-required-message="Enter Mobile Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Address" name="address"
                                                value="{{($contact_info==null)?'':$contact_info->address}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Discord
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Discord Link" name="discord_link"
                                                value="{{($contact_info==null)?'':$contact_info->discord_link}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Facebook
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Facebook Link" name="facebook_link"
                                                value="{{($contact_info==null)?'':$contact_info->facebook_link}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Twitter Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Twitter Link" name="twitter_link"
                                                value="{{($contact_info==null)?'':$contact_info->twitter_link}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">LinkedIn
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="LinkedIn Link" name="linkedIn_link"
                                                value="{{($contact_info==null)?'':$contact_info->linkedIn_link}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Instagram
                                            Link</label>
                                        <div class="col-sm-10"> 
                                            <input class="form-control" placeholder="Instagram Link" name="instagram_link"
                                                value="{{($contact_info==null)?'':$contact_info->instagram_link}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Youtube
                                            Link</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Youtube Link" name="youtube_link"
                                                value="{{($contact_info==null)?'':$contact_info->youtube_link}}">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="">
                                    <!-- <button type="submit" id="updatebtn" class="btn btn-primary float-right"
                                        onclick="div_hide_show(2);">Update</button> -->
                                    
                                    <button class="btn btn-primary float-right" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
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
// function div_hide_show(val) {
//     if (val == 1) {
//         $('#update_section').show();
//         $('#edit_section').hide();

//         $('#edit_info_section').hide();
//         $('#update_info_section').show();
//     } else {
//         $('#edit_section').show();
//         $('#update_section').hide();

//         $('#edit_info_section').hide();
//         $('#update_info_section').show();
//     }
// }


    $(document).on('click', '#edit', function()
    {
        $('.saveData').hide(); //save div hide
        $('.editable').show(); //edit div hide
    });

</script>
@stop