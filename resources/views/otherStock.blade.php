
@extends('layouts.header')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Show Other Stock
        <small>Show Other Stock  panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Show Other Stock </li>
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
                      <a class="btn btn-primary" href="{{ url('add/other/stock') }}" style="margin-top: 1.7em;"> Add New Stock</a>
                    </div>
                    <form class="" action="{{ url('other/stock/showFromDate') }}" method="post">
                        @csrf

                        <div class="col-md-5">  
                            <div class="form-group ">
                              <label for="filterBy"> Select Filter By </label>
                              <script> setTimeout(function(){ $("#filterBy").val('{{ $filterBy }}'); $("#filterBy").trigger("change");    }, 1000);  </script>
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

                         <!-- <div class="col-md-2">
                            <div class="form-group ">
                              <a href="{{ url('other/export') }}/{{ $filterBy }}" id="exportLink" style="margin-top: 1.7em;" class=" btn bg-maroon "><i class="fa fa-download"></i> Download CSV</a>
                            </div>
                          </div> -->
                    

                  </div>
                  <div class="box-body">

                      <div class="table-responsive">
                          <table id="data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Stock Name</th>
                                      <th>Quantity</th>
                                      <th>Price</th>
                                      <th>Days</th>
                                      <th>Last Updated By</th>
                                      <th>Available Stock</th>
                                      <th>Sold Stock</th>
                                      <th>Description</th>
                                      <th>Selling Date</th>
                                      <th>Expiry Date</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @php $index =1; 
                                if (empty($stock)) {
                                  echo "<tr>
                                          <td colspan='5'>No Stock Available<td>
                                        <tr>" ;
                                }

                              @endphp

                              @foreach($stock as $value)                                    
                                  <tr>
                                  <td>{{ $index++ }}</td>
                                  <td>{{ $value->name }}</td>
                                  <td>{{ $value->quantity }}</td>
                                  <td>{{ $value->price }}</td>
                                  <td>
                                    <lable class="label bg-green">{{ $value->use_days }}</lable>
                                    <br><lable class="label bg-red">{{ $value->remaining_days }}</lable></td>
                                  
                                  <td>{{ $value->last_update_by }}</td>
                                  <td>{{ $value->available_stock }}</td>
                                  <td>{{ $value->sold_stock }}</td>
                                  <td>{{ $value->description }}</td>
                                  <td>{{ $value->selling_date_h }}<br>
                                  <td>{{ $value->expiry_date_h }}<br>
                                    <lable class="label bg-red">{{ $value->is_ex }}</lable>
                                  </td>
                                  <td>{{ $value->created_by_h }}</td>
                                  <td>
                                    <i class="fa fa-edit  btn_icon_edit" ></i> &nbsp;&nbsp;<i class="fas fa-trash-alt btn_icon_trash delete_btn" ></i>
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

  
 

  
  @endsection