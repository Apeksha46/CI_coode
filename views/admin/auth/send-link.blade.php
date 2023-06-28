<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('public/dist/img/IPFSLogo.jpg') }}">
  <title>Tentative IPFS</title>

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
                <img src="{{ url('public/dist/img/IPFSLogo.jpg') }}" alt="Tentative IPFS" class="img-fluid" style="width: 250px; opacity: 1.8">
              <!-- <p><b>Admin</b> Login</p> -->
            </div>
            <p class="login-box-msg"><span class="signin" style="color: #3e3d38;">You forgot your password? Here you can easily retrieve a new password.</span> </p>

            <form action="{{ route('password-link') }}" method="post" id="loginForm">
                @csrf
                <div class="input-group form-group mb-3">
                    @php
                        if($errors->has('email')){
                            $valid = 'is-invalid';
                        }else{
                            $valid = '';
                        }
                    @endphp
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <span
                            class="error session-error">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                @if (\Session::has('error'))
                <div class="col-12 error-session">
                    <div class="input-group form-group mb-3">
                        <span class="session-error">{!! \Session::get('error') !!}</span>
                    </div>
                </div>
              @endif

              {{-- <div class="input-group form-group mb-3">
                @php
                    if($errors->has('confirmpassword')){
                        $valid = 'is-invalid';
                    }else{
                        $valid = '';
                    }
                @endphp
                <input type="password" name="confirmpassword" class="form-control {{ $valid }}" placeholder="Confirm Password"  >
                <div class="input-group-append">
                  <div class="input-group-text">

                  </div>
                </div>
                @if ($errors->has('confirmpassword'))
                    <span
                        class="error session-error">{{ $errors->first('confirmpassword') }}</span>
                @endif
            </div> --}}

                <!-- /.col -->
                <div class="col-12">
                  <div class="right d-block mx-auto">
                    <button type="submit" class="btn loginBtn ">Send Email</button>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </form>
            <!-- /.social-auth-links -->
            <p class="mb-1">
                <a href="{{ route('login') }}">Login</a>
              </p>
          </div>
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
    });

</script>
</body>
</html>
