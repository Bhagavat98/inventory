
@extends('layouts.header')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sim Manage
        <small>Sim Manage panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Sim Manage</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
              <div class="box box-info">
                  <div class="box-header">
                    @include('flash-message')

                    @yield('content') 
                    <div class="col-md-3">
                      <a href="{{ url('device/add') }}"  class="btn btn-primary" >
                          <i class="fa fa-plus"></i> Add New Sim 
                      </a>

                      <a href="{{ url('sim/expiry') }}"  class="btn btn-danger" >
                           Expiry Sim ( {{ count($simEx) }} )
                      </a>
                    </div>

                  
                
                    <form action="{{ route('sim.import') }}" method="POST" enctype="multipart/form-data">
                      @csrf                  
                      <div class="col-md-3">
                         <input type="file" class="form-control" name="file" required>
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-success"> <i class="far fa-file-excel"> </i> &nbsp; Import Sim</button>
                      </div>
                    </form>

                    <div class="col-md-2 ">
                        <a href="{{ route('simTemplate.download') }}" class="btn bg-maroon"><i class="fa fa-download"></i> &nbsp;Simple Template</a>
                    </div>


                    <form action="{{ route('sim.export') }}" method="POST" enctype="multipart/form-data">
                      @csrf                  
                      
                      <div class="col-md-2">
                        <button type="submit" class="btn bg-purple"><i class="fa fa-download"></i> &nbsp; Export SIM</button>
                      </div>
                   </form>



                    @if(count($errors))
                    <div class="col-md-12 alert alert-warning" style="margin-top: 1em;">
                      <strong>Whoops!</strong> There were some problems with your input.
                      <br/>
                      <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                    
                  </div>
                  <div class="box-body">
                      <div class="table-responsive">
                          <table id="data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Email</th>
                                      <th>Sim No</th>
                                     <!--  <th>Sim Provider</th> -->
                                      <th>Mobile No</th>
                                      <th>Days</th>
                                      <th>Price</th>
                                      <th>Sale</th>
                                      <th>Billing frequency</th>
                                      <th>Expiry Date</th>
                                      <th>Last update By</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Email</th>
                                      <th>Sim No</th>
                                      <!-- <th>Sim Provider</th> -->
                                      <th>Mobile No</th>
                                      <th>Days</th>
                                      <th>Price</th>
                                      <th>Sale</th>
                                      <th>Billing frequency</th>
                                      <th>Expiry Date</th>
                                      <th>Last update By</th>
                                      <th>Status</th>
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
    <!-- start modal -->
    <div class="modal fade" id="modal-edit-sim" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit SIM</h4>
              </div>
             <form id="edit_sim_from" class="edit_sim_from">
              <div class="modal-body row">
                  @csrf
                  <input type="hidden" name="id" id="simId">
                  <div class="col-md-6">
                    
                    <div class="form-group ">
                      <label for="email">Select Client</label>
                      <select class="form-control" id="email" name="email" style="width: 100%;" required>
                          @foreach($customerList as $value)
                            <option value="{{ $value->email }}">{{ $value->name }} - {{ $value->email }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="sim_no"> Sim No</label>
                      <input type="number" class="form-control" name="sim_no" id="sim_no" placeholder="Enter Sim No.">
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="sim_provider"> Sim Provider</label>
                      <input type="text" class="form-control" name="sim_provider" id="sim_provider" placeholder="Enter Sim Provider">
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="mobile_no"> Mobile No.</label>
                      <input type="number" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter Mobile No">
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="price"> Price</label>
                      <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price" >
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="selling_date"> Selling Date</label>
                      <input type="date" class="form-control" name="selling_date" id="selling_date" placeholder="Selling Date" >
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="billing_frequency"> Billing Frequency</label>
                  
                      <select class="form-control " name="billing_frequency" id="billing_frequency">
                       <option value="30">Monthly</option>
                        <option value="90">6 Month</option>
                        <option value="365">Yearly</option>
                      </select>
                      
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="status"> Status</label>
                  
                      <select class="form-control " name="status" id="status">
                        <option value="in_used">in used</option>
                        <option value="closed">closed</option>
                      </select>
                      
                    </div>
                  </div>

                 
              </div>
              <!--  /.modal-body -->

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