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
<body class="ipfs-login ipfs hold-transition login-page">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <div class="login-logo" style="height: 100px;">
                <img src="{{ url('public/dist/img/IPFSLogo.jpg') }}" alt="Tentative IPFS" class="img-fluid" style="width: 250px; opacity: 1.8">
              <!-- <p><b>Admin</b> Login</p> -->
            </div>
            <p class="login-box-msg"><span class="signin" style="color: #3e3d38;">You are only one step a way from your new password, recover your password now!</span> </p>

            <form action="{{ route('admin-reset-password') }}" method="post" id="reset-password">
                @csrf
                <input type="hidden" name="email" class="form-control" value="{{ $user->email }}" placeholder="Password">
                <input type="hidden" name="token" class="form-control" value="{{ $user->token }}" placeholder="Password">
              <div class="input-group form-group mb-3">
                @php
                    if($errors->has('password')){
                        $valid = 'is-invalid';
                    }else{
                        $valid = '';
                    }
                @endphp
                <input type="password" name="password" class="form-control {{ $valid }}" placeholder="Password" id="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa fa-eye-slash"
                    onclick="newPassword()" id="newPassShow"></i>
                  </div>
                </div>
                @if ($errors->has('password'))
                    <span
                        class="error session-error">{{ $errors->first('password') }}</span>
                @endif
              </div>

              <div class="input-group form-group mb-3">
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
            </div>

                <!-- /.col -->
                <div class="col-12">
                  <div class="right d-block mx-auto">
                    <button type="submit" class="btn loginBtn ">Reset</button>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </form>
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
