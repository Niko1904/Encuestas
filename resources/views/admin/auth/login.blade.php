<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Encuestas | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
  <!-- Font Awesome --> 
  <link rel="stylesheet" href="{{ asset('admin/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admin/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/css/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Encuestas</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar sesion</p>      
      {{-- <form id="sign_in_adm" method="POST" action="{{ route('admin.login') }}">
          {{ csrf_field() }}          
         <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
              <div class="form-line">
                  <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
              </div>
              @if ($errors->has('email'))
              <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
              @endif
          </div>          
          <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
              <div class="form-line">
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
          </div>
          <div>
              <div class="">
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="rememberme" class="filled-in chk-col-pink">
                  <label for="rememberme">Remember Me</label>
              </div>
              <div class="text-center">
                  <button type="submit" class="btn btn-raised waves-effect g-bg-cyan">SIGN IN</button>                  
              </div>
          </div>
      </form> --}}
    <form action="{{ route('admin.login.submit') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        @if ($message = Session::get('error'))
          <div class="custom-alerts alert alert-danger fade in">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
              {!! $message !!}
          </div>
          <?php Session::forget('error');?>
        @endif
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
          <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck col-md-12">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="rememberme" class="filled-in chk-col-pink">
                  <label for="rememberme">Recordar</label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>
    </form>


    <div class="social-auth-links text-center">
     
    </div>
    <a href="#">olvide mi clave</a><br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin/js/icheck.min.js') }}"></script>
<script>
  $(function () {
    /*$('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });*/
  });
</script>
</body>
</html>