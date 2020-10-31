
@extends('layouts.header')


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    

    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section>
        <div class="row col-md-12">
          <div class="col-md-12">
            @include('flash-message')

            @yield('content')
          </div>
        </div>
        @if ( !empty(session('user_admin'))  && ( !isSysAdmin() ))
     
        <form id="admin-login-form left-margin" action="{{ route('account.login') }}" method="POST">
          <input type="hidden" name="id" value="{{ session('user_admin') }}">
            {{ csrf_field() }}
            <button class="btn btn-danger backadminlogin" type="submit"><i class="fas fa-sign-in-alt"></i> Back To Admin Login</button>
        </form>
      
    @endif
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Small boxes (Stat box) -->

     <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $totalDevice }}</h3>

              <p>Total Device</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="{{ route('Device') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $totalSim }}</h3>

              <p>Total Sim</p>
            </div>
            <div class="icon">
              <i class="fa fa-sim-card"></i>
            </div>
            <a href="{{ route('Sim') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $totalExDevice }}</h3>

              <p>Expiry Device</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="{{ route('device.expiry') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $totalExSim }}</h3>

              <p>Expiry Sim</p>
            </div>
            <div class="icon">
              <i class="fa fa-sim-card"></i>
            </div>
            <a href="{{ route('sim.expiry') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3>{{ $totalChallan }}</h3>

              <p>Total Delivery Challan</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <a href="{{ url('DeliveryChallan/show') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>{{ $totalBarcodestock }}</h3>

              <p>Total Barcode Inventory Stock</p>
            </div>
            <div class="icon">
              <i class="fa fa-cart-arrow-down"></i> 
            </div>
            <a href="{{ url('addStock') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>{{ $totalCustomer }}</h3>

              <p>Total Customers</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('Customer') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalAccounts }}</h3>

              <p>Total Accounts</p>
            </div>
            <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="{{ route('Accounts') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


        <!-- col-md 4 -->
         <div class="col-md-4">
          <!-- box -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-car"></i>
                <h3 class="box-title">Device Stock</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                <table class="table table-bordered">
                  <thead>
                    <tr style="background-color: #7c7c7c;color: white; border: white;">
                      <th >Sr</th>
                      <th>Device Type</th>
                      <th>Available Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $counter=0; $subTotal = 0; @endphp @foreach($deviceStock as $value)
                    
                    @php $subTotal = $subTotal + $value->total; $counter++; @endphp
                      <tr> 
                        <td>{{ $counter }}</td>
                        <td>{{ $value->device_type }}</td>
                        <td>{{ $value->total }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      
                      <th colspan="2" style="text-align: right;">Total</th>
                      <th>{{ $subTotal }}</th>
                    </tr>
                  </tfoot>
                </table>
    
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix no-border">
                
              </div>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.div col 4 -->


          <!-- col-md 4 -->
         <div class="col-md-4">
          <!-- box -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-sim-card"></i>
                <h3 class="box-title">Sim Stock</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                <table class="table table-bordered">
                  <thead>
                    <tr style="background-color: #7c7c7c;color: white; border: white;">
                      <th>Sr</th>
                      <th>Sim Provider</th>
                      <th>Available Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $counter=0; $subTotal = 0; @endphp @foreach($simStock as $value)
                    
                    @php $subTotal = $subTotal + $value->total; $counter++; @endphp
                      <tr> 
                        <td>{{ $counter }}</td>
                        <td>{{ $value->sim_provider }}</td>
                        <td>{{ $value->total }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      
                      <th colspan="2" style="text-align: right;">Total</th>
                      <th>{{ $subTotal }}</th>
                    </tr>
                  </tfoot>
                </table>
    
              </div>
              <!-- /.box-body -->

              
              <div class="box-footer clearfix no-border">
                
              </div>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.div col 4 -->



          <!-- col-md 4 -->
         <div class="col-md-4">
          <!-- box -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="fa fa-cart-arrow-down"></i>
                <h3 class="box-title">Other Stock</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                <table class="table table-bordered">
                  <thead>
                    <tr style="background-color: #7c7c7c;color: white; border: white;">
                      <th>Sr</th>
                      <th>Other Stock</th>
                      <th>Quantity</th>
                      <th>Available Stock</th>
                      <th>Sold Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $counter=0; $subTotalQuantity = 0; $subTotalSold_stock = 0; $subTotalAvailable_stock = 0; @endphp @foreach($otherstock as $value)
                    
                    @php $subTotalAvailable_stock = $subTotalAvailable_stock + $value->available_stock;
                    $subTotalSold_stock = $subTotalSold_stock + $value->sold_stock;
                    $subTotalQuantity = $subTotalQuantity + $value->quantity;
                     $counter++; @endphp
                      <tr> 
                        <td>{{ $counter }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->quantity }}</td>
                        <td>{{ $value->available_stock }}</td>
                        <td>{{ $value->sold_stock }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      
                      <th colspan="2" style="text-align: right;">Total</th>
                      <th>{{ $subTotalQuantity  }}</th>
                      <th>{{ $subTotalAvailable_stock }}</th>
                      <th>{{ $subTotalSold_stock }}</th>
                    </tr>
                  </tfoot>
                </table>
    
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix no-border">
                
              </div>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.div col 4 -->

        

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  @endsection

 