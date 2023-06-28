@extends('admin.layouts.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center profile-user-div">
                                    <a href="{{$admin->profilePic }}" target="_blank">
                                        <img class="file-upload-image profile-user-img img-fluid img-circle"
                                        src="{{$admin->profilePic }}"
                                        alt="User profile picture">
                                    </a>

                                    <button class="ipst-bottun uploadImg" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )" id="add_image">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                                <h3 class="profile-username text-center">{{ $admin->first_name }}
                                    {{ $admin->last_name }}</h3>
                                <p class="text-muted text-center">{{ $admin->email }}</p>
                                {{-- <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Phone Number</b> <a class="float-right text-dark">{{ $admin->countryCode." ".$admin->phoneNumber }}</a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card table-responsive">
                                    <div class="card-header">
                                        <h3 class="card-title">Change Password</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tile">
                                                    <form class="row" action="{{ route('change-password') }}"
                                                        method="post" id="change-password-form">
                                                        @csrf
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-sm-12">
                                                                    <label>Current Password</label>
                                                                    <i class="fa fa-eye-slash eyeIcon"
                                                                        onclick="currentPassword()"
                                                                        id="currentPassShow"></i>
                                                                    @if ($errors->has('currentpassword'))
                                                                        {{ $valid = 'is-invalid' }}
                                                                    @else
                                                                        {{ $valid = '' }}
                                                                    @endif
                                                                    <input class="form-control {{ $valid }}"
                                                                        type="password" placeholder="Enter Current Password"
                                                                        name="currentpassword" id="currentpassword">
                                                                    @if ($errors->has('currentpassword'))
                                                                        <span
                                                                            class="error session-error">{{ $errors->first('currentpassword') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12">
                                                                    <label>New Password</label>
                                                                    <i class="fa fa-eye-slash eyeIcon"
                                                                        onclick="newPassword()" id="newPassShow"></i>
                                                                    @if ($errors->has('password'))
                                                                        {{ $valid = 'is-invalid' }}
                                                                    @else
                                                                        {{ $valid = '' }}
                                                                    @endif
                                                                    <input class="form-control {{ $valid }}"
                                                                        type="password" placeholder="Enter New Password"
                                                                        name="password" id="password">

                                                                    @if ($errors->has('password'))
                                                                        <span
                                                                            class="error session-error">{{ $errors->first('password') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12">
                                                                    <label>Confirm Password</label>
                                                                    @if ($errors->has('confirmpassword'))
                                                                        {{ $valid = 'is-invalid' }}
                                                                    @else
                                                                        {{ $valid = '' }}
                                                                    @endif
                                                                    <input class="form-control {{ $valid }}"
                                                                        type="password" placeholder="Enter Confirm Password"
                                                                        name="confirmpassword" id="confirmpassword">

                                                                    @if ($errors->has('confirmpassword'))
                                                                        <span
                                                                            class="error session-error">{{ $errors->first('confirmpassword') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button class="btn ipfs-button" type="submit">Change</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="col-md-9">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card table-responsive">
                                            <div class="card-header">
                                                <h3 class="card-title">Admin Profile Update</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tile">
                                                            <form class="row" action="{{ route('update-detail') }}" method="POST"
                                                                enctype="multipart/form-data" id="update-profile-form">
                                                                @csrf
                                                                <div class="col-lg-6">

                                                                    <div class="form-group col-md-12 col-sm-12">
                                                                        <label>Name</label>
                                                                        @if ($errors->has('first_name'))
                                                                            {{ $valid = 'is-invalid' }}
                                                                        @else
                                                                            {{ $valid = '' }}
                                                                        @endif
                                                                        <input class="form-control {{ $valid }}" type="text"
                                                                            placeholder="Enter First Name"
                                                                            value="{{ old('first_name', $admin->first_name) }}"
                                                                            name="first_name">
                                                                        @if ($errors->has('first_name'))
                                                                            <span
                                                                                class="error session-error">{{ $errors->first('first_name') }}</span>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group col-md-12 col-sm-12">
                                                                        <label>Email Id</label>
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Enter Email Id"
                                                                            value="{{ old('email', $admin->email) }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <input class="file-upload-input form-control" id="image"
                                                                    type='file' onchange="readURL(this);" accept="image/*"
                                                                    aria-describedby="fileHelp" name="profilePic"
                                                                    style="display: none;" />
                                                                <div class="col-lg-6">
                                                                    <div class="form-group col-md-12 col-sm-12">
                                                                        <button class="btn ipfs-button"
                                                                            type="submit">Update</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
