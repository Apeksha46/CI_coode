@extends('admin.layouts.layout')
@section('content')
<style>
.loader-container {
    position: relative;
    width: 100%;
    height: 100%;
}

#loader {
    height: 0;
    width: 0;
    padding: 15px;
    border: 6px solid #ccc;
    border-right-color: #888;
    border-radius: 22px;
    -webkit-animation: rotate 1s infinite linear;
    position: fixed;
    left: 50%;
    top: 50%;
    z-index: 999;
}
@-webkit-keyframes rotate {

/* 100% keyframe for  clockwise.
 use 0% instead for anticlockwise */
100% {
    -webkit-transform: rotate(360deg);
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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <a href="{{ route('users.index') }}" class="btn ipfs-button"><i class="fa fa-arrow-left"></i> Back</a>
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
                    <a href="{{ $user->profilePic }}" target="_blank">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ $user->profilePic }}"
                            alt="User profile picture">
                        <input type="hidden" name="user_id" id="id_data" value="{{ $user->id }}" >
                    </a>
                </div>

                <h3 class="profile-username text-center">{{ (!$user->first_name) ? "User" :$user->first_name.' '.$user->last_name; }}</h3>
                <p class="text-muted text-center">{{ $user->email }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Phone Number</b> <a class="float-right text-dark">{{ (!$user->phoneNumber) ? "N/A" : ($user->countryCode.' '.$user->phoneNumber); }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Register Date</b> <a class="float-right text-dark">{{ date_format(date_create($user->created_at),"d M, Y H:i A") }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nationality</b> <a class="float-right text-dark">{{ $user->nationality ?? "N/A" }}</a>
                  </li>
                  @if($user->singup_type != 0)
                  <li class="list-group-item">
                    <b>Socialite Id</b> <a class="float-right text-dark">{{ $user->socialite_id ?? "N/A" }}</a>
                  </li>
                  @endif
                  <li class="list-group-item">
                    <b>Number Of Childs</b> <a class="float-right text-dark"> {{$user->childs()->count()}}</a>

                  </li>
                  <li class="list-group-item">
                    <b>Number Of Photos</b> <a class="float-right text-dark"> {{$imageCount}}</a>

                  </li>
                  <li class="list-group-item">
                    <b>Number Of Videos</b> <a class="float-right text-dark"> {{$videoCount}}</a>

                  </li>
                  <li class="list-group-item">
                    <b>Number Of Journals</b> <a class="float-right text-dark"> {{$user->albums()->where('post_type','journal')->count()}}</a>

                  </li>
                  <li class="list-group-item">
                    <b>Number Of Letter</b> <a class="float-right text-dark"> {{$user->letters()->count()}}</a>

                  </li>

                </ul>

              </div>
              <div class="card-footer">
                    <div class="text-right">
                        @if($user->isExpire != 'active')
                            <a class="btn btn-sm ipfs-button upgrade-child">
                                <i class="fas fa-arrow-up"></i> Upgrade
                            </a>
                        @else
                            <a href="{{ route('downgrade-user',$user->id) }}" class="btn btn-sm ipfs-danger">
                                <i class="fas fa-arrow-down"></i> Downgrade
                            </a>
                        @endif
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card direct-chat direct-chat-primary upgrade-child-card" >
                <div class="card-header">
                    <h3 class="card-title">Upgrade User</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('upgrade-user') }}"
                        method="post"
                        id="upgrade-form">
                        @csrf
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <input class="form-control"
                                        type="hidden" placeholder="User Id"
                                        name="user_id"
                                        value="{{$user->id}}">
                                </div>
                                <div class="form-group col-md-12 col-sm-12">
                                    <label>Select To Upgrade</label>
                                    <div class="clearfix">
                                        <div class="icheck-primary d-inline">
                                          <input type="radio" name="planType" value="month" id="radioPrimary1">
                                          <label for="radioPrimary1">
                                             1 Month &nbsp;
                                          </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                          <input type="radio" name="planType" value="annual" id="radioPrimary2">
                                          <label for="radioPrimary2">
                                             6 Month &nbsp;
                                          </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                          <input type="radio" name="planType" value="year" id="radioPrimary3">
                                          <label for="radioPrimary3">
                                             1 Year
                                          </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn ipfs-button" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer-->
            </div>

            {{-- <div class="card card-primary">
                <div class="card-header profile-header">
                  <h3 class="card-title">User Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <strong><i class="fa fa-id-card mr-1"></i>User Membership</strong>  <a class="float-right text-dark">Monthly</a><br>
                  <hr>
                  <b>Movies Upload:</b> <br>
                  <b>IFSC:</b> <br>
                  <b>Currency:</b>

                </div>
                <!-- /.card-body -->
            </div> --}}
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" id="user-albums-record" href="#user-record-albums" data-category="user-record-albums" data-toggle="tab">Album's Record</a></li>
                  {{-- <li class="nav-item"><a class="nav-link" id="membership-detail" href="#membership" data-category="membership" data-toggle="tab">Membership</a></li> --}}
                  <li class="nav-item"><a class="nav-link" id="childs-managed-detail" href="#childs-managed" data-category="childs-managed" data-toggle="tab">Childs Managed</a></li>
                  <li class="nav-item"><a class="nav-link" id="childs-follow-detail" href="#childs-follow" data-category="childs-follow" data-toggle="tab">Childs Follow</a></li>
                  {{-- <li class="nav-item"><a class="nav-link" id="user-albums-detail" href="#user-albums" data-category="user-albums" data-toggle="tab">Album's</a></li> --}}
                  {{-- <li class="nav-item"><a class="nav-link" id="user-albums-record" href="#user-record-albums" data-category="user-record-albums" data-toggle="tab">Album's Record</a></li> --}}
                  <li class="nav-item"><a class="nav-link" id="user-journals-detail" href="#user-journals" data-category="user-journals" data-toggle="tab">Journals</a></li>
                  <li class="nav-item"><a class="nav-link" id="user-letters-detail" href="#user-letters" data-category="user-letters" data-toggle="tab">Letters</a></li>
                  {{-- <li class="nav-item"><a class="nav-link" id="user-photos-detail" href="#user-photos" data-category="user-photos" data-toggle="tab">Photos</a></li> --}}
                  <li class="nav-item"><a class="nav-link" id="user-relation-detail" href="#user-relation" data-category="user-relation" data-toggle="tab">User Relation</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="loader-container">
                <span id="loader" style="display: none;"></span>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  {{-- <div class="active tab-pane" id="membership" aria-labelledby="membership-detail"><!-- Child's Detail --> </div> --}}
                  <div class="tab-pane" id="childs-managed" aria-labelledby="childs-managed-detail"> <!-- Child's Detail --> </div>
                  <div class="tab-pane" id="childs-follow" aria-labelledby="childs-follow-detail"> <!-- Child's Detail --> </div>
                  <div class="tab-pane" id="user-photos" aria-labelledby="user-photos-detail"> <!-- Child's Detail --> </div>
                  <div class="tab-pane" id="user-record-albums" aria-labelledby="user-albums-record"> <!-- Albums's Detail --> </div>
                  <div class="tab-pane" id="user-journals" aria-labelledby="user-journals-detail"> <!-- Journals Detail --> </div>
                  <div class="tab-pane" id="user-letters" aria-labelledby="user-letters-detail"> <!-- Letters Detail --> </div>
                  <div class="tab-pane" id="user-relation" aria-labelledby="user-relation-detail" > <!-- User Realtion --> </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
              <!-- /.card -->

          <!-- /.card -->
         </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@stop
