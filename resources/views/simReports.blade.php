
@extends('layouts.header')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('message.sim reports') }}
        <small>{{ __('message.sim reports') }} panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp;  Home</a></li>
        <li class="active">{{ __('message.sim reports') }}</li>
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

                    <form method="post" id="report_sim_from" >

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="operator">Select Operator</label>
                                  
                                      <select class="form-control operator" name="operator" id="operator" autocomplete="off" required="">
                                        <option data-id="All" value="all">All Distributor/Operator</option>
                                        @foreach($operators as $value)
                                          <option data-id="{{ $value->email }}" value="{{ $value->email }}">{{ $value->email }}</option>
                                        @endforeach
                                      </select>
                                  
                              </div>
                          </div>

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="providers">SIM Providers</label>
                                    <select class="form-control providers" name="providers" id="providers" autocomplete="off" required="">
                                          <option data-id="All" value="all">All SIM Providers</option>
                                        @foreach($providers as $value)
                                          <option data-id="{{ $value->sim_provider }}" value="{{ $value->sim_provider }}">{{ $value->sim_provider }}</option>
                                        @endforeach
                                      
                                      </select>
                              </div>
                          </div>

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="report_type">Report Type</label>
                                    <select class="form-control report_type" name="report_type" id="report_type" autocomplete="off" required="">
                                          <option data-id="Expiry" value="expiry">Expiry Reports</option>
                                          <option data-id="In Used" value="in_used">In Used</option>
                                          <option data-id="InActive" value="InActive">InActive</option>
                                          <option data-id="Closed" value="closed">closed</option>
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
                          <table id="sim_data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                    <th>Sr No.</th>
                                    <th>Email</th>
                                    <th>Sim No</th>
                                    <th>Sim Provider</th>
                                    <th>Mobile No</th>
                                    <th>Price</th>
                                    <th>Sale</th>
                                    <th>Billing frequency</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>
                                  <tr>
                                    <th>Sr No.</th>
                                    <th>Email</th>
                                    <th>Sim No</th>
                                    <th>Sim Provider</th>
                                    <th>Mobile No</th>
                                    <th>Price</th>
                                    <th>Sale</th>
                                    <th>Billing frequency</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
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

     


