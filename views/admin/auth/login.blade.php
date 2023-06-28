<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link rel="icon" href="{{ asset('public/dist/img/IPFSLogo.jpg') }}"> --}}
  <title>Tech Analyser| Admin</title>
     <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/dist/img/fav-icon.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
  {{-- y --}}
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/css/ipfs.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">

</head>
<body class="ipfs-login hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <div class="login-logo" style="height: 100px;">
                <img src="{{ url('public/dist/img/logo.png') }}" alt="Tentative IPFS" class="img-fluid" style="width: 140px; opacity: 1.8">
              <!-- <p><b>Admin</b> Login</p> -->
            </div>
            <p class="login-box-msg"><span class="signin" style="color: #3e3d38;">Admin Login!</span> </p>

            <form action="{{ route('processLogin') }}" method="post" id="loginForm">
                @csrf
              <div class="input-group form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>

              <div class="input-group form-group mb-3">
                <input type="password" name="password" id="upass" class="form-control" placeholder="Password" required >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span id="toggleBtn" class="fas fa-lock"></span>
                  </div>
                </div>
              </div>

              @if (\Session::has('error'))
                <div class="col-12 error-session">
                    <div class="input-group form-group mb-3">
                        <span class="session-error">{!! \Session::get('error') !!}</span>
                    </div>
                </div>
              @endif
              @if (\Session::has('success'))
              <div class="col-12 error-session">
                  <div class="input-group form-group mb-3">
                      <span class="session-success" style="color: rgb(47, 230, 47)">{!! \Session::get('success') !!}</span>
                  </div>
              </div>
            @endif

                <!-- /.col -->
                <div class="col-12">
                  <div class="right d-block mx-auto">
                    <button type="submit" class="btn loginBtn ">Sign In</button>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </form>
              <!-- /.social-auth-links -->
              <p class="mb-1">
                {{-- <a href="{{ route('forget-password') }}">Forgot password ?</a> --}}
              </p>
          <!-- /.login-card-body -->
        </div>
    </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('node_modules/device-uuid/lib/device-uuid.js') }}" type="text/javascript"></script>
<script src="{{ asset('node_modules/js.device.detector/dist/jquery.device.detector.min.js') }}"></script>
<script src="{{ asset('node_modules/platform/platform.js') }}"></script>



<script src="{{ asset('public/plugins/jquery-validation/jquery.validate.min.js') }}"></>
<script src="{{ asset('public/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('public/dist/js/validation.js') }}"></script>
<script src="{{ asset('public/dist/js/custom.js') }}"></script>
<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(() => {
            $(".error-session").css("display", "none");
        }, 4000);


        var p = platform.os
        var d = $.fn.deviceDetector;
        console.log(p);
    });;



</script>
</body>
</html>
