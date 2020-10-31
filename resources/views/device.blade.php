
@extends('layouts.header')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Device Manage
        <small>Device Manage panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Device Manage</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
              <div class="box box-info">
                  <div class="box-header with-border">
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
                  
                   
                    <div class="col-md-2 ">
                      <a href="{{ route('device.expiry') }}" class="btn btn-danger " >
                        Expiry Device ( {{ count($deviceEx) }} )
                      </a>
                    </div>

                    <form action="{{ route('device.import') }}" method="POST" enctype="multipart/form-data">
                      @csrf                  
                      <div class="col-md-3">
                         <input type="file" class="form-control" name="file" required> 
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-success"><i class="far fa-file-excel"></i> &nbsp; Import Device</button>
                      </div>
                    </form>

                   

                    <div class="col-md-2 ">
                        <a href="{{ route('deviceTemplate') }}" class="btn bg-maroon"><i class="fa fa-download"></i> &nbsp;Simple Template</a>
                    </div>

                    <form action="{{ route('device.export') }}" method="POST" enctype="multipart/form-data">
                      @csrf                  
                      
                      <div class="col-md-2 pull-right">
                        <button type="submit" class="btn bg-purple"><i class="fa fa-download"></i> &nbsp; Export Device</button>
                      </div>
                    </form>

                  </div>
                  <div class="box-body">
                      <div class="table-responsive">
                          <table id="data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Email</th>
                                      <th>IMEI</th>
                                      <th>Cost</th>
                                      <th>Device type</th>
                                      <th>Days</th>
                                      <th>Selling date</th>
                                      <th>Expiry date</th>
                                      <th>Billing frequency</th>
                                      <th>Last update By</th>
                                      <th>Payment status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Email</th>
                                      <th>IMEI</th>
                                      <th>Cost</th>
                                      <th>Device type</th>
                                      <th>Days</th>
                                      <th>Selling date</th>
                                      <th>Expiry date</th>
                                      <th>Billing frequency</th>
                                      <th>Last update By</th>
                                      <th>Payment status</th>
                                      <th>Action</th>
                                  </tr>
                              </tfoot>
                          </table>
                      </div>
                  </div>
                  <!-- /.box -->

              </div>
              <!-- /.col (left) -->
          </div>
          <!-- /col12 -->
          
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-edit-device" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Device</h4>
              </div>
             <form id="edit_device_from" class="edit_device_from">
              <div class="modal-body row">
                  @csrf
                  <input type="hidden" name="id" id="deviceId">
                  <div class="col-md-6">
                    <!-- <div class="form-group ">
                      <label for="email"> Email</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                      
                    </div> -->

                    <div class="form-group ">
                      <label for="email">Select Client</label>
                      <select class="form-control" id="email" name="email" @if(Auth::user()->is_super_admin == 0)  readonly @endif style="width: 100%;"  required  >
                          @foreach($customerList as $value)
                            <option value="{{ $value->email }}">{{ $value->name }} - {{ $value->email }}</option>
                          @endforeach
                      </select>
                    </div>

                  </div>


                  


                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="imei"> IMEI</label>
                      <input type="number" class="form-control" name="imei" id="imei" placeholder="Enter IMEI" required>
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="device_type"> Device Type</label>
                      <input type="text" class="form-control" name="device_type" id="device_type" placeholder="Enter Device Type">
                      
                    </div>
                  </div>

                  
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="vehicle_name"> Vehicle Name</label>
                      <input type="text" class="form-control" name="vehicle_name" id="vehicle_name" placeholder="Enter Vehicle Name" >
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="cost"> Cost</label>
                      <input type="number" class="form-control" name="cost" id="cost" placeholder="Enter Cost" >
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="renewal_charges"> Renewal Charges</label>
                      <input type="number" class="form-control" name="renewal_charges" id="renewal_charges" placeholder="Enter Renewal Charges" >
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="purchase_date"> Purchase Date</label>
                      <input type="date" class="form-control" name="purchase_date" id="purchase_date" placeholder="Purchase Date" >
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="selling_date"> Selling Date</label>
                      <input type="date" class="form-control" name="selling_date" id="selling_date" placeholder="Selling Date" required>
                      
                    </div>
                  </div>

              
                   <div class="col-md-6">
                    <div class="form-group ">
                      <label for="billing_frequency"> Billing Frequency</label>
                  
                      <select class="form-control " name="billing_frequency" id="billing_frequency" required>
                        <option value="30">Monthly</option>
                        <option value="90">6 Month</option>
                        <option value="365">Yearly</option>
                      </select>
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="iccd"> Sim/Mobile NO.</label>
                      <input type="text" placeholder="Enter Sim/Mobile No." class="form-control " name="iccd" id="iccd" plac >
                    </div>
                  </div>

                  
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="payment_status"> Payment Status</label>
                      <select class="form-control " name="payment_status" id="payment_status" >
                        <option selected disabled value="">Select Payment Status</option>
                        <option value="pending">Pending</option>
                        <option value="received">received</option>
                      </select>
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="statusList"> Status</label>
                      <select class="form-control " name="statusList" id="statusList" required>
                        <option value="Active">Active</option>
                        <option value="InActive">InActive</option>
                        <option value="Return">Return</option>
                        <option value="Detach">Detach</option>
                      </select>
                      
                    </div>
                  </div>
              </div>

              <div class="modal-footer" style="margin-top: 1em">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                &nbsp;<button type="submit" class="btn btn-primary" style="margin-right: 8px;">Save</button>
              </div>

            </form>
            <!-- /.form -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  
  @endsection