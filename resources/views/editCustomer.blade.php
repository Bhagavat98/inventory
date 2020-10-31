
@extends('layouts.header')


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Customer
        <small>Edit Customer panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Edit Customer</li>
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
                <form class="form" id="adddform" method="POST" action="{{ url('customer/update') }}/{{ $customer->id }}">

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
                          <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}{{ $customer->name }}" required>
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                      </div>

                    
                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                          <label for="email"> Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}{{ $customer->email }}" required>
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group ">
                          <label for="SocietyAdmin"> Mobile</label>
                          <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="{{ old('mobile') }}{{ $customer->mobile }}"  required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group ">
                          <label for="billing_code"> Billing Code </label>
                          <input type="number" class="form-control" placeholder="Enter Billing Code" value="{{ old('billing_code') }}{{ $customer->billing_code }}" readonly>
                           <input type="hidden" class="form-control" name="billing_code" id="billing_code" value="{{ $customer->billing_code }}" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group ">
                          <label for="customer_type"> Customer Type</label>

                          <select class="form-control" id="customer_type" name="customer_type" value="{{ old('customer_type') }}{{ $customer->customer_type }}" required>
                            
                            <option value="end_customer">End Customer</option>
                            <option value="distributor">Distributor</option>
                            <option value="retailer">Retailer</option>
                          </select>
                          
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group ">
                          <label for="application"> Application</label>

                          <select class="form-control" id="application" name="application" value="{{ old('application') }}{{ $customer->application }}">
                            
                            <option value="carminesoft">Carminesoft</option>
                            <option value="cosmicagps">Cosmicagps</option>
                            <option value="schoolbusgps">Schoolbusgps</option>
                          </select>
                          
                        </div>
                      </div>


                      <!-- <div class="col-md-6">
                        <div class="form-group ">
                          <label for="employee"> Created on employee</label>
                          <script> 
                          setTimeout(function(){ 
                            $("#application").val('{{ $customer->application }}'); 
                            $("#employee").val('{{ $customer->created_at_employee }}');
                            $("#customer_type").val('{{ $customer->customer_type }}'); 
                          }, 1000); </script>
                          <select class="form-control" id="employee" name="employee" value="{{ old('employee ') }}{{ $customer->created_at_employee  }}">
                            
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
                          <textarea class="form-control" rows="3" placeholder="Enter Address" id="address" name="address" >{{ old('address') }}{{ $customer->address }}</textarea>
                          <span class="text-danger">{{ $errors->first('address') }}</span>
                        </div>
                      </div>

                      <div class="col-md-6 col-md-offset-3" >
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-success form-control" id="btnsubmit" >Save</button>
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


            
