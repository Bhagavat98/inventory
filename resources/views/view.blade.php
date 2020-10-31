
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
        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Device Manage</li>
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
                    <div class="col-md-2">
                      <a href="{{ url('account/add') }}"  class="btn btn-primary" >
                          <i class="fa fa-plus"></i> Add New Device 
                      </a>
                    </div>

                    <form action="{{ route('device.import') }}" method="POST" enctype="multipart/form-data">
                      @csrf                  
                      <div class="col-md-3">
                         <input type="file" class="form-control" name="file">
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-success">Import Device</button>
                      </div>
                   </form>
                    
                  </div>
                  <div class="box-body">
                      <div class="table-responsive">
                          <table id="data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Unique ID</th>
                                      <th>Title</th>
                                      <th>Asset Type</th>
                                      <th>description</th>
                                      <th>Purchase Date</th>
                                      <th>Assigned Date</th>
                                      <th>Assigen To</th>
                                      <th>Billing frequency</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php 
                                $counter = 0;
                              
                                @endphp 
                                @foreach($data as $value)
                                $counter++;
                              
                               {{ print_r($value) }}
                                @endforeach

                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Unique ID</th>
                                      <th>Title</th>
                                      <th>Asset Type</th>
                                      <th>description</th>
                                      <th>Purchase Date</th>
                                      <th>Assigned Date</th>
                                      <th>Assigen To</th>
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
          
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  @endsection