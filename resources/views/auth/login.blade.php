<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/plugins/iCheck/square/blue.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{asset('public/logo.png')}}" alt="logo_pondan" height="100" width="200">
    <!-- <a href="#">APLIKASI <b>INVENTORY</b></a> -->
  </div>
  <div class="login-box-body">
    <p class="login-box-msg"><b style="font-size: 60">Login</b></p>

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group has-feedback">

        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Username" value="{{ old('email') }}" id="email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        
        @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group has-feedback">

        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="current-password" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="{{ asset('public/assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
