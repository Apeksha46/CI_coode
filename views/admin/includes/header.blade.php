<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="author" content="" />
    {{-- <link rel="icon" href="{{ asset('public/dist/img/IPFSLogo.jpg') }}"> --}}
    <title> Tech Reviewers | Admin</title>


     <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/dist/img/fav-icon.png') }}">
  <!---- New Url For IPFS    -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/css/ipfs.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/css/techanalyser.css') }}">

  <!-- End Url For IPFS    -->

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />

<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


  <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="{{ asset('public/plugins/daterangepicker/daterangepicker.css') }}"> -->
  {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="{{ asset('public/plugins/summernote/summernote-bs4.min.css') }}"> -->
  <!-- CodeMirror -->
  <link rel="stylesheet" href="{{ asset('public/plugins/codemirror/codemirror.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/codemirror/theme/monokai.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/toastr/toastr.min.css') }}">
  <!-- SimpleMDE -->
  <!-- <link rel="stylesheet" href="{{ asset('public/plugins/simplemde/simplemde.min.css') }}"> -->

   <!-- summernote -->
   <link rel="stylesheet" href="{{ asset('public/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet"/>
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
  <script type="text/javascript">
    const SITE_URL = "{{ URL::to('/') }}";
</script>

<style type="text/css">
    .parsley-errors-list {
          list-style-type: none;
          padding-left: 0;
          color: #ff0000;
          }
             /*============Loader======================*/
   #overlay{ 
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
  </style>

</head>
<body class="ipfs hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed {{ (Auth::user()->theme_mode == 1) ? 'dark-mode' : '' }}">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand bg-danger bg-white bg-light navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            {{-- <li class="nav-item">
                <div class="col-md-6">
                    <a href="{{ route('modeChange') }}" type="button" class="btn ipfs-button" >
                        <i class="material-icons">{{ (Auth::user()->theme_mode == 1) ? 'wb_sunny' : 'brightness_3' }}</i>
                    </a>
                </div>
            </li> --}}
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="" data-toggle="dropdown" href="#">
                <img src="{{ Auth::user()->profilePic }}" alt="AdminLTE Logo" class="brand-image img-circle" style="width: 40px; height: 40px;">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <span class="dropdown-item dropdown-header" style="background-color: #20c997;">
                <img src="{{ Auth::user()->profilePic }}" alt="AdminLTE Logo" class="brand-image img-circle profile-user-img">
              </span>

              <div class="dropdown-divider"></div>
              <div class="row" style="padding: 10px;">
                <div class="col-md-6">
                    <a href="{{ route('setting') }}" type="button" class="btn ipfs-button" >Settings</a>
                </div>
                <div class="col-md-6">
                    <a href="javascript:void(0)" type="button" class="btn ipfs-button float-right" data-toggle="modal"  data-target="#adminLogout">Logout</a>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <div class="modal fade" id="adminLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Admin Logout</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure want to logout?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn ipfs-button" data-dismiss="modal">No</button>
              <a href="{{ route('logout') }}"  class="btn ipfs-button" >Yes</a>
            </div>
          </div>
        </div>
      </div>
