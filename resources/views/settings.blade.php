
@extends('layouts.header')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Settings Manage
        <small>Settings Manage panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Settings Manage</li>
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
                    <div class="alert alert-warning">
                      <strong>Whoops!</strong> There were some problems with your input.
                      <br/>
                      <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                    <h4>Settings Renewal</h4>
                  </div>
                  <div class="box-body">

                    <div class="col-md-12">
                      
                    </div>

                    

                    <form class="form-inline" action="{{ url('settings/recentactivity') }}" method="POST" enctype="multipart/form-data">
                      @csrf                  
                      <div class="col-md-4 form-group  {{ $errors->has('type') ? 'has-error' : '' }}">
                         <label class="renewalTypeSelect2">Type</label> 
                         <select class="form-control " id="renewalTypeSelect2" name="type" style="width: 100%;">
                           <option value="device">Device</option>
                           <option value="sim">Sim</option>
                         </select>
                         <span class="text-danger">{{ $errors->first('type') }}</span>
                      </div>

                      <div class="col-md-4 form-group  {{ $errors->has('recentactivityday') ? 'has-error' : '' }}" > 
                         <label class="active">RECENT ACTIVITY</label>
                         <select class="form-control " name="recentactivityday" id="recentactivityselect2" style="width: 100%;">
                           <option value="2">In Next 2 Days</option>
                           <option value="8" selected>In Next 8 Days</option>
                           <option value="15">In Next 15 Days</option>
                           <option value="20">In Next 20 Days</option>
                           <option value="30">In Next 30 Day</option>
                           <option value="45">In Next 45 Days</option>
                           <option value="60">In Next 60 Days</option>
                         </select>
                         <span class="text-danger">{{ $errors->first('recentactivityday') }}</span>
                      </div>
                      @csrf
                      <div class="col-md-4 form-group">
                        <button type="submit" class="btn btn-success" style="margin-top: 1.5em;"> Save</button>
                      </div>
                   </form>
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