
@extends('layouts.header')

<style>
  .odd{
    background-color: #c2a3a3 !important;
  }
  .even{
    background-color: #c2a3a3 !important;
  }
  #search_input{
    width: 80%;
    margin-top: 10px;
    margin-bottom: 10px;
  }
</style>
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Device Expriry and Renewal
        <small>Device Expriry panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Device Expriry</li>
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


                  <div class="col-md-6"> 
                          <input type="text" id="search_input" name="search_input" placeholder="Search" onkeyup="search();" class="form-control " >
                      </div> 
                      <div class="col-md-6"> 
                           <a href="{{ route('Device') }}" class="btn btn-info pull-right" ><i class="fa fa-car"></i> All Device</a>
                  </div>
                    
                  </div>
                  <div class="box-body">
                      

                      <div class="table-responsive">
                          <table id="data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Email</th>
                                      <th>IMEI</th>
                                      <th>Device Type</th>
                                      <th>Expiry Date</th>
                                      <th>Status</th>
                                      <th colspan="3" style="text-align: center;">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php $index =1; ?>
                              @if(count($device) == 0)
                                <tr>
                                  <td colspan="8" style="text-align: center;">Device not  not available renewal.</td>
                                </tr>
                              @endif

                              @foreach($device as $value)
                                    <tr>
                                        <td style="padding-top: 26px;">{{ $index++ }}</td>
                                        <td style="padding-top: 26px;">{{ $value->email }}</td>
                                        <td style="padding-top: 26px;">{{ $value->imei }}</td>
                                        <td style="padding-top: 26px;">{{ $value->device_type }}</td>
                                        <td style="padding-top: 26px;">{{ $value->expiry_date }}</td>
                                        <td style="padding-top: 26px;">{{ $value->status }}</td>
                                        <form action="{{ url('device/renewal') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                            <input type="hidden" name="imei" value="{{ $value->imei }}">
                                            <input type="hidden" name="expiry_date" value="{{ $value->expiry_date }}">
                                            <td>
                                              <label for="renewal_date">Renewal Date</label>
                                              <input type="date" name="renewal_date" class="form-control "  placeholder="renewal Date"  value="{{ date('Y-m-d') }}" required>
                                            </td>
                                            <td>
                                              <label for="renewal_charges">Renewal Charges</label>
                                              <input type="text" name="renewal_charges" class="form-control flat-red" placeholder="renewal charges" required>
                                            </td>
                                            <td style="padding-top: 35px;">
                                              <button type="submit" class="form-control btn btn-success">Save</button>
                                            </td>
                                        </form>
                                        <td style="padding-top: 35px;">
                                          <form action="{{ url('device/InActive') }}" method="post"> 
                                              @csrf
                                              <input type="hidden" name="imei" value="{{ $value->imei }}">
                                              <input type="hidden" name="id" value="{{ $value->id }}" required>
                                              <button type="submit" class="form-control btn btn-danger">In-Active</button>
                                          </form>
                                         
                                        </td>
                                    </tr>
                                  </form>

                              @endforeach

                              </tbody>

                          </table>
                      </div>
                  </div>
                  <!-- /.box -->

                  <div class="col-md-12">
                    
                  </div>

              </div>
              <!-- /.col (left) -->
          </div>
          <!-- /col12 -->
          
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>



  
  @endsection