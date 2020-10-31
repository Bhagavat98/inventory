
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
                        
                        <div class="col-md-2">
                            
                            <button type="submit" class="form-control btn btn-success" id="addRow">Add Row</button>
                        </div>
                      </form >

                      
                      <a  href="{{ url('other/stock') }}" class="btn btn-info pull-right" id="addRow">All Other Stock</a>
                        

                       
                  </div>
                  <form method="post" action="{{ url('other/stock/create') }}">
                  <div class="box-body">
                        @csrf
                         <input type="hidden" name="customerList" class="form-control" value="info@cosmicagps.com" readonly="">
                        <div class="table-responsive">
                            <table id="addStockTable" class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th>Sr</th>
                                    <th>Stock Name </th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Billing Frequency</th>
                                    <th>Selling Date</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  
                                </tbody>
                                

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