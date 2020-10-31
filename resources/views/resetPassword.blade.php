
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Inventory') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome-free-5.11.2\css\all.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
 <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="http://www.jfhmegami.com/admin/plugins/iCheck/square/blue.css">
    <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- confirm alert css -->  
  <link rel="stylesheet" href="{{ asset('dist/css/jquery-confirm.css') }}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .login-box, .register-box {
      width: 515px;
      
    }
    body{
    background-image: url(images/inventory.jpg) !important;
  }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
                  @include('flash-message')

                    @yield('content') 
                    

                     @if(count($errors))
                    <div class="alert alert-warning">
                      <strong>Whoops!</strong> There were some problems with your input.
                      <br/>
                      <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

  <div class="login-logo">
    <img src="{{ asset('images/cosmicalogo.png') }}" style="display: block;margin-left: auto;margin-right: auto;">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">


    <p class="login-box-msg" style="font-size: 24px;">Reset your password</p>

    <form action="{{ url('resetPassword') }}" method="post">
        @csrf
		  <div class="form-group has-feedback">
          <label for="email" >Email</label>
          <input type="email" class="form-control" placeholder="Enter Your Enter" name="email" id="email" required>
          <span class="fa fa-message form-control-feedback"></span>
      </div>
      
      <div class="row">
        
        <div class="col-xs-7 pull-right">
          <button type="submit" class="btn btn-primary ">Send Password Reset Link</button>
          <a href="{{ url('home') }}" class="btn btn-warning ">Cancel</a>
          
        </div>
        <!-- /.col -->
      </div>
    </form>
<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->

    <a href="/" class="btn btn-link " ><i class="fa fa fa-lock"></i> I already have a membership</a>
    <a href="{{ url('home') }}" class="btn btn-link" ><i class="fa fa fa-home"></i> Go To Panel</a> 

	<!--<a href="register" >Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="http://www.jfhmegami.com/admin/plugins/iCheck/icheck.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });


  
</script>
</body>
</html>
