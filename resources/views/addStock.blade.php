
@extends('layouts.header')


@section('content')
<style>
  .imp_field{
    color: red;
  }
  .input_top{
    font-size: 16px;
    font-family: inherit;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Add Stock Multiple  
        <small>Add Stock  panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Add Stock Multiple </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
              <div class="box box-info ">

                
                  <div class="box-header with-border">
                    @include('flash-message')

                    @yield('content') 
                        
                    <form  id="addStock_form">
                        <div class="col-md-4">  
                            <div class="form-group ">
                              <label for="deviceList"> Select Device </label>
                              <select class="" id="deviceList" name="deviceList"  style="width: 100%;" >
                                @foreach($stock as $value)
                                  <option  value="{{ $value->imei }}">{{ $value->imei }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="customerList">Add Row</label>
                            <button type="submit" class="form-control btn btn-success" id="addRow">Add Row</button>
                        </div>
                      </form >

                        <div class="col-md-4">
                            <label for="customerList">Select Client</label>
                            <input type="text" name="customerList" class="form-control" value="info@cosmicagps.com" readonly="">
                        </div>
                  </div>
                  <form method="post" action="{{ route('addStockToDevice') }}">
                  <div class="box-body">
                        @csrf
                         <input type="hidden" name="customerList" class="form-control" value="info@cosmicagps.com" readonly="">
                        <div class="table-responsive">
                            <table id="addStockTable" class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th>Sr</th>
                                    <th>Item (imei) </th>
                                    <th>Vehicle Name</th>
                                    <th>Device Type</th>
                                    <th>Price</th>
                                    <th>Purchase date</th>
                                    <th>Selling Date</th>
                                    <th>Billing Frequency</th>
                                    <th>ICCD</th>
                                    <th>Purchased From</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  
                                </tbody>
                                <tfoot style="display: none;">
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;"><label>Total</label></td>
                                    <td style="width: 12%;">
                                       <input type="number" value="0" placeholder="total" class="form-control sumtotal" id="sumtotal" name="sumtotal"  readonly > 
                                    </td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tfoot>

                            </table>
                        </div> 
                  </div>
                  <!-- /.box -->
                  <div class="box-footer pull-center">
                      
                        <div class="col-md-12 " style="text-align: center;">
                          <div class="form-group">
                              <button type="submit" style="margin-top: 1.6em;" id="submitbtn" class="btn btn-success" disabled>Submit</button>
                              <a href="{{ route('DeliveryChallan') }}" style="margin-top: 1.6em;" type="" class="btn btn-warning">Cancel</a>
                          </div>
                        </div>

                       
                  </div>
                </form>
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

  

  
  @endsection