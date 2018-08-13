<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from www.theme-guys.com/materialism/html/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Sep 2017 05:16:31 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Materialism</title>
    <meta name="msapplication-TileColor" content="#9f00a7">
    <meta name="msapplication-TileImage" content="../assets/img/favicon/mstile-144x144.html">
    <meta name="msapplication-config" content="http://www.theme-guys.com/materialism/assets/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="57x57" href="../assets/img/favicon/apple-touch-icon-57x57.html">
    <link rel="apple-touch-icon" sizes="60x60" href="../assets/img/favicon/apple-touch-icon-60x60.html">
    <link rel="apple-touch-icon" sizes="72x72" href="../assets/img/favicon/apple-touch-icon-72x72.html">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/favicon/apple-touch-icon-76x76.html">
    <link rel="apple-touch-icon" sizes="114x114" href="../assets/img/favicon/apple-touch-icon-114x114.html">
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/img/favicon/apple-touch-icon-120x120.html">
    <link rel="apple-touch-icon" sizes="144x144" href="../assets/img/favicon/apple-touch-icon-144x144.html">
    <link rel="apple-touch-icon" sizes="152x152" href="../assets/img/favicon/apple-touch-icon-152x152.html">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon-180x180.html">
    <link rel="icon" type="image/png" href="../assets/img/favicon/favicon-32x32.html" sizes="32x32">
    <link rel="icon" type="image/png" href="../assets/img/favicon/android-chrome-192x192.html" sizes="192x192">
    <link rel="icon" type="image/png" href="../assets/img/favicon/favicon-96x96.html" sizes="96x96">
    <link rel="icon" type="image/png" href="../assets/img/favicon/favicon-16x16.html" sizes="16x16">
    <link rel="manifest" href="http://www.theme-guys.com/materialism/assets/img/favicon/manifest.json">
    <link rel="shortcut icon" href="http://www.theme-guys.com/materialism/assets/img/favicon/favicon.ico">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>  <![endif]-->
    <link href="assets/css/vendors.min.css" rel="stylesheet" />
    <link href="assets/css/styles.min.css" rel="stylesheet" />
    <script charset="utf-8" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  </head>
  <body class="page-login" init-ripples="">
    <div class="center">
      <div class="card bordered z-depth-2" style="margin:0% auto; max-width:400px;">
        <div class="card-header">
          <div class="brand-logo">
            <div id="logo">
              <div class="foot1"></div>
              <div class="foot2"></div>
              <div class="foot3"></div>
              <div class="foot4"></div>
            </div> Poll </div>
        </div>
        <div class="card-content">
          <div class="m-b-30">
            <div class="card-title strong pink-text">Login</div>
            <p class="card-title-desc"> Welcome to Poll! The admin part of this web project. </p>
          </div>
          {{--  <form class="form-floating" {{ route('admin.login.post') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="inputEmail" class="control-label">Email</label>
              <input type="text" class="form-control"> </div>
            <div class="form-group">
              <label for="inputPassword" class="control-label">Password</label>
              <input type="password" class="form-control" id="inputPassword"> </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me </label>
              </div>
            </div>
          </form>  --}}
          <form id="sign_in_adm" method="POST" action="{{ route('admin.login.submit') }}">
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
            </form>
        </div>
        <div class="card-action clearfix">
          <div class="pull-right">
            <button type="button" class="btn btn-link black-text">Forgot password</button>
            <button type="button" class="btn btn-link black-text">Login</button>
          </div>
        </div>
      </div>
    </div>
    
    <script>
    (function(i, s, o, g, r, a, m)
    {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function()
      {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o), m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-62479268-1', 'auto');
    ga('send', 'pageview');
    </script>
    
    <script charset="utf-8" src="assets/js/vendors.min.js"></script>
    <script charset="utf-8" src="assets/js/app.min.js"></script>
  </body>

<!-- Mirrored from www.theme-guys.com/materialism/html/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Sep 2017 05:16:38 GMT -->
</html>