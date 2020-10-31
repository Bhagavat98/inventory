
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

      <p class="login-box-msg" style="font-size: 24px;">Your Profile</p>

      <img src="@if(Auth::user()->profile_img  == NULL) {{ asset('images/user_img.jpg') }} @else {{ Auth::user()->profile_img }} @endif" class="profile-user-img img-responsive img-circle" alt="User profile picture">

    <form action="{{ url('updateProfile') }}/{{ Auth::user()->id }}" method="post">
        @csrf
		  <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
          <label for="name" >Name</label>
          <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ Auth::user()->name }}{{ old('name') }}" id="new_password" required>
          <span class="fa fa-user form-control-feedback"></span>
          <span class="text-danger">{{ $errors->first('name') }}</span>
      </div>

      <div class="form-group has-feedback {{ $errors->has('display_name') ? 'has-error' : '' }}">
          <label for="display_name">Display Name</label>
          <input type="text" class="form-control" placeholder="Enter Display Name" value="{{ Auth::user()->displayName }}{{ old('display_name') }}" name="display_name" id="display_name" required>
          <span class="fa fa-user form-control-feedback"></span>
          <span class="text-danger">{{ $errors->first('display_name') }}</span>
      </div>

      <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
          <label for="email">Email</label>
          <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" value="{{ Auth::user()->email }}{{ old('email') }}" readonly disabled>
          <span class="fa fa-message form-control-feedback"></span>
          <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>

      <div class="form-group has-feedback {{ $errors->has('mobile') ? 'has-error' : '' }}">
          <label for="mobile">Mobile No.</label>
          <input type="number" class="form-control" placeholder="Enter Mobile NO." name="mobile" id="mobile" value="{{ Auth::user()->mobile }}{{ old('mobile') }}" readonly disabled>
          <span class="fa fa-phone form-control-feedback"></span>
          <span class="text-danger">{{ $errors->first('mobile') }}</span>
      </div>

      <div class="form-group has-feedback {{ $errors->has('addresss') ? 'has-error' : '' }}">
          <label for="mobile">Address</label>
           <textarea class="form-control" rows="3" placeholder="Enter Address" id="address" name="address" >{{ Auth::user()->address }}{{ old('address') }}</textarea>
          <span class="fa fa-map form-control-feedback"></span>
          <span class="text-danger">{{ $errors->first('addresss') }}</span>
      </div>


      <div class="row">
        
        <div class="col-xs-5 pull-right">
          <button type="submit" class="btn btn-primary ">Update</button>
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

	  <a href="{{ url('home') }}" class="btn btn-link" ><i class="fa fa fa-home"></i> Go To Panel</a> 
    <a href="{{ url('home') }}" class="btn btn-link " ><i class="fa fa fa-lock"></i> Change Password</a>

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
