
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
  .checkbox_lable
  {
    font-size: 16px;
    font-weight: 600 !important;
    margin-right: 27px;
  }
  fieldset 
  {
    /*border: 1px solid #ddd !important;*/
    border: 1px solid #337ab7 !important;
    margin: 0;
    xmin-width: 0;
    padding: 10px;       
    position: relative;
    border-radius:4px;
    background-color:#f5f5f5;
    padding-left:10px!important;
  } 
  
    legend
    {
    font-size: 15px;
    font-weight: bold;
    /* font-family: sans-serif; */
    margin-bottom: 0px;
    width: 19%;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px 5px 5px 10px;
    background-color: #ffffff;
    }

</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Delivery Challan SIM/DEVICE 
        <small>Delivery Challan  panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Delivery Challan </li>
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
                    
                    
                        <div class="col-md-12">  
                              <form class="form-inline">
                                <label style="margin-right: 10px;font-size: 16px; margin-left: 10px"> Date : </label><input type="text" class="form-control input_top" readonly value="{{ date('d-m-Y') }}" name="created_date">
                                <input type="text" class="form-control pull-right input_top" readonly value="{{ $challan_no }}" name="created_date">
                                 <label class="pull-right" style="margin-top:5px; font-size: 16px; text-align: right; margin-right: 10px">  Challan NO : </label>
                              </form>
                        </div>

                        
                        <hr>
                        <form class="" id="challan_from" >
                        @csrf
                          <fieldset>

                          <legend>First Step:</legend>

                          <div class="col-md-12">  
                            <div class="checkbox">
                              

                              <label for="checkbox_select_all_sim"  class="checkbox_lable">
                                  
                                 <input type="checkbox"  id="checkbox_select_all_sim" value="">All Sim 
                              </label>

                              <label for="checkbox_select_all_device" class="checkbox_lable">
                                
                                <input type="checkbox"  id="checkbox_select_all_device" value="">All Device 
                              </label>

                            </div>
                          </div>


                          <div class="col-md-5">  
                            <div class="form-group ">
                              <label for="simList"> Select Sim &nbsp;&nbsp;&nbsp; <label class="label bg-maroon"> Total Sim {{ count($simList) }}</label></label>&nbsp;&nbsp;&nbsp; <label class="label label-success" id="simListSelectedCount">Selected Sim - 0</label>
                              <select class="" id="simList" name="simList" style="width: 100%;" multiple>
                                
                                @foreach($simList as $value)
                                  <option value="{{ $value->sim_no }}|{{ $value->price }}"  data-id="{{ $value->price }}"> {{ $value->email }}  {{ $value->sim_no }} -  {{ $value->sim_provider }} </option>
                                @endforeach
                              </select>
                            </div>
                          </div>


                          <div class="col-md-5">  
                            <div class="form-group ">
                              <label for="deviceList"> Select Device &nbsp;&nbsp;&nbsp; <label class="label bg-maroon"> Total Device {{ count($deviceList) }}</label> &nbsp;&nbsp;&nbsp; <label class="label label-success" id="deviceListSelectedCount">Selected Device - 0</label></label>
                              <select class="" id="deviceList" name="deviceList" style="width: 100%;" multiple>
                                
                                @foreach($deviceList as $value)
                                  <option value="{{ $value->imei }}|{{ $value->cost }}" data-id="{{ $value->cost }}">{{ $value->email }} - {{ $value->imei }} - {{ $value->device_type }} </option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group ">
                              <button type="submit" id="submit" style="margin-top: 1.7em;" class="form-control btn btn-success">Add Items</button>
                            </div>
                          </div>
                        </fieldset>
                    </form>

                    <hr style="margin: 1.5rem auto 1.1rem;">
                    <form class="" id="challan_from_secound" >
                        @csrf
                          <fieldset>

                          <legend>Second Step:</legend>

                          <div class="col-md-12">  
                            <div class="checkbox">
                              <label for="checkbox_select_all_otherstock" class="checkbox_lable">
                                
                                <input type="checkbox"  id="checkbox_select_all_otherstock" value="">All Other Stock 
                              </label>
                            </div>
                          </div>


                          <div class="col-md-5">  
                            <div class="form-group ">
                              <label for="otherstock"> Select Other Stock &nbsp;&nbsp;&nbsp; 
                                <label class="label bg-maroon"> Total Stock {{ count($otherstock) }}</label>
                              </label>&nbsp;&nbsp;&nbsp; 
                              <label class="label label-success" id="otherstockSelectedCount">Selected Other Stock - 0</label>
                              <select class="" id="otherstock" name="otherstock" style="width: 100%;" multiple>
                                
                                @foreach($otherstock as $value)
                                  <option @if($value->available_stock == '0') disabled @endif value="{{ $value->id }}|{{ $value->name }}||{{ $value->available_stock }}|{{ $value->price }}"  > {{ $value->name }} - Available ( {{ $value->available_stock }} ) </option>
                                @endforeach
                              </select>
                            </div>
                          </div>


                          <div class="col-md-2">
                            <div class="form-group ">
                              <button type="submit" id="submit1" style="margin-top: 1.7em;" class="form-control btn btn-success">Add Items</button>
                            </div>
                          </div>
                        </fieldset>
                    </form>

                  </div>
                  <form method="post" action="{{ route('deliveryChallan.create') }}" id="from_delivery_challan" >
                  <div class="box-body">
                        @csrf
                        <fieldset>
                          <legend>Third Step:</legend>
                        <div class="table-responsive">
                            <table id="DeliveryChallanTable" class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th>Sr</th>
                                    <th>Item Type</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                <tfoot style="display: none;">
                                  <tr >
                                    
                                    <td colspan="4" style="text-align: right;"><label>Total</label></td>
                                    <td style="width: 12%;">
                                       <input type="number" value="0" placeholder="total" class="form-control sumtotal" id="sumtotal" name="sumtotal"  readonly > 
                                    </td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tfoot>

                            </table>

                        </div> 
                      </fieldset>
                          
                  </div>
                  <!-- /.box -->
                  
                    <div class="box-footer pull-center">

                     <fieldset>
                       <legend>Fourth Step:</legend>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="delivery_challan_description"> Challan Description</label>
                                  <textarea class="form-control" rows="2" placeholder="Delivery Challan Description" id="delivery_challan_description" name="delivery_challan_description" ></textarea>
                                 
                            </div>
                          </div>

                          
                          <div class="col-md-4">
                              <label for="customerList">Select Customer</label>
                              <select class="form-control customerList" id="customerList" name="customerList" style="width: 100%;" required>
                                    <option></option>
                                    @foreach($customerList as $value)
                                       <option value="{{ $value->id }}">{{ $value->name }} - {{ $value->email }} - - {{ $value->customer_type }}  </option>
                                    @endforeach
                              </select>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                                <label for="payment_status">Payment Status <!-- <span class="imp_field">*</span> --></label>
                                <select class="form-control" id="payment_status" name="payment_status" style="width: 100%;"  required>
                                    <option value="pending" selected>pending</option>
                                    <option value="received">received</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                                <label for="gst"> GST Percentage <!-- <span class="imp_field">*</span> --></label>
                                <select class="form-control" id="gst" name="gst" style="width: 100%;" readonly required>
                                    <option></option>
                                    <option value="7">7%</option>
                                    <option value="12">12% </option>
                                    <option value="18" selected>18%</option>
                                    <option value="none">with out gst</option>
                                </select>
                            </div>
                          </div>


                          

                          <div class="col-md-12 " style="text-align: center;">
                            <div class="form-group">
                                <button type="submit" style="margin-top: 1.6em;" id="submitbtn" class="btn btn-success" disabled>Submit</button>
                                <a href="{{ route('DeliveryChallan') }}" style="margin-top: 1.6em;" type="" class="btn btn-warning">Cancel</a>
                            </div>
                          </div>

                       </fieldset>  
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