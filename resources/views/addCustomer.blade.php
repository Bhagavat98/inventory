
@extends('layouts.header')


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Customer
        <small>Add New Customer panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Add New Customer</li>
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
                <a href="{{ url('Customer') }}" class="btn btn-primary">
                <i class="fa fa-users"> </i> All Customer
              </a>
              </div>
              <!-- box-body start -->
              <div class="box-body">
                <form class="form" id="adddform" method="POST" action="{{ route('customer.create') }}">

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
                          <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                      </div>

                    
                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                          <label for="email"> Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                          <label for="SocietyAdmin"> Mobile</label>
                          <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="{{ old('mobile') }}"  required>
                          <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group ">
                          <label for="billing_code"> Billing Code </label>
                          <input type="number" class="form-control" placeholder="Enter Billing Code" value="{{ old('billing_code') }}{{ $billing_code }}" readonly>
                           <input type="hidden" class="form-control" name="billing_code" id="billing_code" value="{{ old('billing_code') }}{{ $billing_code }}" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('customer_type') ? 'has-error' : '' }}">
                          <label for="customer_type"> Customer Type</label>

                          <select class="form-control" id="customer_type" name="customer_type" required>
                            <option></option>
                            <option value="end_customer">End Customer</option>
                            <option value="distributor">Distributor</option>
                            <option value="retailer">Retailer</option>
                          </select>
                          <span class="text-danger">{{ $errors->first('customer_type') }}</span>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group ">
                          <label for="application"> Application</label>

                          <select class="form-control" id="application" name="application" >
                            <option></option>
                            <option value="carminesoft">Carminesoft</option>
                            <option value="cosmicagps">Cosmicagps</option>
                            <option value="schoolbusgps">Schoolbusgps</option>
                          </select>
                          
                        </div>
                      </div>


                      <!-- <div class="col-md-6">
                        <div class="form-group ">
                          <label for="employee"> Created on employee</label>

                          <select class="form-control" id="employee" name="employee">
                            <option></option>
                            <option value="naresh">Naresh</option>
                            <option value="anisha">Anisha </option>
                            <option value="suresh">Suresh</option>
                            <option value="other">other</option>
                          </select>
                          
                        </div>
                      </div> -->


                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                          <label for="gate"> Address</label>
                          <textarea class="form-control" rows="3" placeholder="Enter Address" id="address" name="address" value="{{ old('address') }}"></textarea>
                          <span class="text-danger">{{ $errors->first('address') }}</span>
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


            
