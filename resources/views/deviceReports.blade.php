
@extends('layouts.header')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('message.device reports') }}
        <small>{{ __('message.device reports') }} panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">{{ __('message.device reports') }}</li>
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

                    <form method="post" id="report_device_from" >

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="client_type">Select Client Type</label>
                                    <select class="form-control client_type" name="client_type" id="client_type" autocomplete="off" required="">
                                        <option data-id="All Distributor" value="distributor">Distributor</option>
                                        <option data-id="All End Customer" value="end_customer">End Customer</option>
                                        <option data-id="All Retailer" value="retailer">Retailer</option>
                                    </select>
                                  
                              </div>
                          </div>

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="device_type">Device Type</label>
                                    <select class="form-control device_type" name="device_type" id="device_type" autocomplete="off" required="">
                                          <option data-id="All Device Type" value="all">All Device Type</option>
                                        @foreach($deviceType as $value)
                                          <option data-id="{{ $value->device_type }}" value="{{ $value->device_type }}">{{ $value->device_type }}</option>
                                        @endforeach
                                      
                                      </select>
                              </div>
                          </div>

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="report_type">Report Type</label>
                                    <select class="form-control report_type" name="report_type" id="report_type" autocomplete="off" required="">
                                          <option data-id="Expiry Reports" value="expiry">Expiry Reports</option>
                                          <!-- <option data-id="In Active Reports" value="inActive">In Active Device</option>
                                          <option data-id="Expiry Return" value="return">Returen Reports</option> -->
                                          <option data-id="Selling Reports" value="selling">Selling Reports</option>
                                          <option data-id="Purchase Reports" value="purchase">Purchase Reports</option>
                                      </select>
                              </div>
                          </div>


                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="from_date">From Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                      <input type="text" class="form-control date_pic from_date"  placeholder="From Date" name="from_date" id="from_date" autocomplete="off" required="" value="{{ date('d-m-Y') }}">
                                    </div>
                              </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                <input type="text" class="form-control date_pic to_date"  placeholder="To Date" name="to_date" id="to_date" autocomplete="off" required="" value="{{ date('d-m-Y') }}">
                                </div>
                            </div>
                          </div>

                          <!-- _token --> 
                          @csrf

                          <div class="col-md-12" style="text-align: center;">
                              <button type="submit" class=" btn btn-success pull-center" id="submit_btn">
                                <i class="fas fa-eye">&nbsp;View Report</i></button>&nbsp;&nbsp;&nbsp;
                            
                              <button type="button" id="reload_btn" class="btn btn-info pull-center" ><i class="fa fa-refresh">&nbsp;Refresh</i></button>
                            
                          </div>
                    </form> 
                   
                  </div>
                  <div class="box-body">
                      <div class="table-responsive">
                          <table id="device_data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Email</th>
                                      <th>IMEI</th>
                                      <th>Vehicle name</th>
                                      <th>Cost</th>
                                      <th>Device type</th>
                                      <th>Renewal charges</th>
                                      <th>Purchase date</th>
                                      <th>Selling date</th>
                                      <th>Expiry date</th>
                                      <th>Billing frequency</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Email</th>
                                      <th>IMEI</th>
                                      <th>Vehicle name</th>
                                      <th>Cost</th>
                                      <th>Device type</th>
                                      <th>Renewal charges</th>
                                      <th>Purchase date</th>
                                      <th>Selling date</th>
                                      <th>Expiry date</th>
                                      <th>Billing frequency</th>
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
          <!-- _token -->
          <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  @endsection

     


