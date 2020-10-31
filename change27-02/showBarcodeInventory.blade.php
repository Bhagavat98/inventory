
@extends('layouts.header')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Show Barcode Inventory 
        <small>Show Barcode Inventory  panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Show Barcode Inventory </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
              <div class="box box-info with-border">
                  <div class="box-header">
                    @include('flash-message')

                    @yield('content') 
                    <div class="col-md-3">
                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-add-barcode-inventory" style="margin-top: 1.7em;"> Add New Barcode Inventory</button>
                    </div>
                    <form class="" action="{{ route('barcode-inventory.fromDate') }}" method="post">
                        @csrf

                        <div class="col-md-5">  
                            <div class="form-group ">
                              <label for="filterBy"> Select Filter By </label>
                              <script> setTimeout(function(){ $("#filterBy").val({{ $filterBy }}); $("#filterBy").trigger("change");    }, 1000);  </script>
                              <select class="" id="filterBy" name="filterBy" style="width: 100%;"  required>
                                <option value="1">Today's </option>
                                <option value="7" selected>Last Week</option>
                                <option value="15">Last 15 Day</option>
                                <option value="31">Last Month</option>
                                <option value="182">Last 6 Month </option>
                                <option value="365">Last 1 Year</option>
                                <option value="all">All </option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group ">
                              <button type="submit" id="submit" style="margin-top: 1.7em;" class=" btn bg-purple "><i class="fa fa-eye"></i> View</button>
                            </div>
                          </div>

                          


                    </form>

                         <div class="col-md-2">
                            <div class="form-group ">
                              <a href="{{ url('barcode-inventory/export') }}/{{ $filterBy }}" id="exportLink" style="margin-top: 1.7em;" class=" btn bg-maroon "><i class="fa fa-download"></i> Download CSV</a>
                            </div>
                          </div>
                    

                  </div>
                  <div class="box-body">

                      <div class="table-responsive">
                          <table id="data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>IMEI</th>
                                      <th>Device Type</th>
                                      <th>Purchased From</th>
                                      <th>Assigned To</th>
                                      <th>Assigned At</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @php $index =1; 
                                if (empty($barcodeimeiDisplay)) {
                                  echo "<tr>
                                          <td colspan='5'>No IMEI Available<td>
                                        <tr>" ;
                                }

                              @endphp

                              @foreach($barcodeimeiDisplay as $value)                                    
                                  <tr>
                                  <td>{{ $index++ }}</td>
                                  <td>{{ $value->imei }}</td>
                                  <td>{{ $value->deviceType }}</td>
                                  <td>{{ $value->purchased_from }}</td>
                                  <td>{{ $value->assigned_to }}</td>
                                  <td>{{ $value->assigned_at }}</td>
                                  <td>{{ date('d M Y A',strtotime($value->created_at)) }}</td>
                                  <td>
                                      @if($value->in_stock == 'in')
                                       <button type="button" class="btn bg-green" disabled>SOLDED</button>   
                                      @else 
                                          <button type="button" class="btn bg-maroon addOtherinfo" >Add To Stock</button>
                                      @endif
                                  </td>
                                  </tr>
                              @endforeach

                              </tbody>

                          </table>
                      </div>
                  </div>
                  <!-- /.box -->

              </div>
              <!-- /.col (left) -->
          </div>
          <!-- /col12 -->
          <!-- _token -->
          <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- start modal -->
    <div class="modal fade" id="modal-add-barcode-inventory" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Barcode Inventory</h4>
              </div>
             <form action="{{ url('barcode-inventory/add') }}" method="post">
              <div class="modal-body row">
                  @csrf
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="imei"> IMEI</label>
                      <input type="number" class="form-control" name="imei" id="imei" placeholder="Enter Email" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="device_type"> Device type</label>
                      <input type="text" class="form-control" name="device_type" id="device_type" placeholder="Enter Device Type">
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="purchased_from"> Purchased From</label>
                      <input type="text" class="form-control" name="purchased_from" id="purchased_from" placeholder="Enter Purchased From">
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="assigned_to"> Assigned To</label>
                      <input type="text" class="form-control" name="assigned_to" id="assigned_to" placeholder="Enter Assigned To">
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group ">
                        <label for="assigned_at"> Assigned at</label>
                        <input type="text" class="form-control" id="" value="{{ Auth::user()->name }}" name="assigned_at" readonly>
                         
                      </div>
                  </div>

                   <div class="col-md-6">
                        <div class="form-group {{ $errors->has('description ') ? 'has-error' : '' }}">
                          <label for="gate"> Description  </label>
                          <textarea class="form-control" rows="3" placeholder="Enter Description" id="description" name="description" value="{{ old('description') }}"></textarea>
                          <span class="text-danger">{{ $errors->first('descriptios') }}</span>
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

  <!-- start modal -->
    <div class="modal fade" id="modalUpdate" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add To Stock Device</h4>
              </div>
             <form action="{{ url('/add/stock/device') }}" method="post" >
              <div class="modal-body row">
                  @csrf
                  <input type="hidden" name="id" id="simId">
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="customerList">Select Client</label>
                      
                      <input type="text" name="customerList" class="form-control" value="info@cosmicagps.com" readonly>

                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="imei"> imei</label>
                      <input type="text" class="form-control" name="imei" id="imeiinventory" readonly placeholder="Enter Imei" required>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="vehicleName">Vehicle Name</label>
                      <input type="text" class="form-control" id="vehicleName"  placeholder="Enter Vehicle Name" name="vehicleName" >
                    </div>
                  </div>

                
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="deviceType"> Device Type</label>
                      <input type="text" class="form-control" name="deviceType" id="deviceType" placeholder="Enter Device Type">
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="cost"> Cost</label>
                      <input type="number" class="form-control" name="cost" id="cost" placeholder="Enter Cost" value="0"  required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="purchase_date"> Purchase date</label>
                      <input type="date" class="form-control" name="purchase_date" id="purchase_date" placeholder="Enter Purchase Date" >
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
                  
                      <select class="form-control " name="billing_frequency" id="billing_frequency" required style="width: 100%;">
                        <option value="30">Monthly</option>
                        <option value="90">6 Month</option>
                        <option value="365">Yearly</option>
                      </select>
                      
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="iccd">ICCD</label>
                      <input type="text" name="iccd" class="form-control" placeholder="Enter ICCD">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="purchased_from">Purchased From</label>
                      <input type="text" name="purchased_from" class="form-control" id="purchased_from_inventory" placeholder="Enter Purchased From">
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="assigned_to">Assigned To</label>
                      <input type="text" name="assigned_to" id="assigned_to_inventory" class="form-control" placeholder="Enter Assigned To">
                    </div>
                  </div>

                  <!-- <div class="col-md-6">
                    <div class="form-group ">
                      <label for="assigned_at"> Assigned At</label>
                      <select class="form-control " name="assigned_at" id="assigned_at_inventory"  style="width: 100%;" required>
                        
                      </select>
                    </div>
                  </div> -->

                 <!--  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="description">Description</label>
                      <textarea  type="textarea" name="description" class="form-control" id="descriptioninventory" placeholder="Enter Description"  cols="3" rows="3">
                      </textarea>
                    </div>
                  </div> -->
                  


              

                 
              </div>
              <!--  /.modal-body -->

              <div class="modal-footer" style="margin-top: 1em">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                &nbsp;<button type="submit" class="btn btn-primary" style="margin-right: 8px;">Add Stock To Device</button>
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