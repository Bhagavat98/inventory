
@extends('layouts.header')


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Account
        <small>Add New Account panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Add New Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Small boxes (Stat box) -->
      <div class="row">
         <div class="col-md-12">
            <!-- box start -->
            <div class="box box-info">
              <div class="box-header">
                <a href="{{ url('Accounts') }}" class="btn btn-primary">
                <i class="fa fa-users"> </i> All Account
              </a>
              </div>
              <!-- box-body start -->
              <div class="box-body">
                <form class="form" id="adddform" method="POST" action="{{ route('account.create') }}">

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
                  @include('flash-message')

                  @yield('content') 

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                          <label for="name"> Name</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}" >
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('dname') ? 'has-error' : '' }}">
                          <label for="dname"> Display Name</label>
                          <input type="text" class="form-control" name="dname" id="dname" placeholder="Enter Display Name" value="{{ old('dname') }}">
                          <span class="text-danger">{{ $errors->first('dname') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                          <label for="email"> Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}">
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group ">
                          <label for="SocietyAdmin"> Mobile</label>
                          <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="{{ old('mobile') }}">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                          <label for="password"> Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="{{ old('password') }}">
                          <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                          <label for="confirmedpass"> Confirmed Password</label>
                          <input type="password" class="form-control" name="confirm_password" id="confirmedpass" placeholder="Enter Confirmed Password" value="{{ old('confirm_password') }}">
                          <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        </div>
                      </div>
          

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                          <label for="gate"> Address</label>
                          <textarea class="form-control" rows="3" placeholder="Enter Address" id="address" name="address" value="{{ old('address') }}"></textarea>
                          <span class="text-danger">{{ $errors->first('address') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <!-- radio -->
                        <div class="form-group" style="margin-top: 2.5em;">
                          <label>Admin
                            <input type="radio" name="role" class="minimal" value="admin" checked>
                          </label>
                          <label>User
                            <input type="radio" name="role" class="minimal" value="user">
                          </label>
                        </div>
                      </div>

                      <div class="col-md-6 col-md-offset-3" >
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-success form-control" id="btnsubmit" >Submit</button>
                        </div>

                        <div class="col-md-6">
                          <button type="reset" class="btn btn-warning form-control" id="btnreset" >Rsest</button>
                        </div>
                     </div>
                     <!-- /col6 -->
                </form>
                <!-- /form -->
              </div>
              <!-- / box-body -->
            </div>
            <!-- box end -->
         </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  @endsection


            
