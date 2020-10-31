



@extends('layouts.header')

<style>
 
/*a:visited {
  color: #0254EB
}*/
a.morelink {
  text-decoration:none;
  outline: none;
}
.morecontent span {
  display: none;
}
.comment {

}
#showChallanItemsTable thead tr th{
  padding: 10px !important;
  text-align: center;
}
#showChallanItemsTable thead tr{
  background-color: #909090;
  color: white;
}

#showChallanItemsTable tbody tr td{
  padding: 10px !important;
  text-align: center;
}
</style>

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Show Delivery Challan 
        <small>Show Delivery Challan  panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"> </i>&nbsp; Home</a></li>
        <li class="active">Show Delivery Challan </li>
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
                    <div class="col-md-2">
                      <a class="btn btn-primary" href="{{ url('DeliveryChallan') }}" style="margin-top: 2.7em;"> Create New Delivery Challan</a>
                    </div>
                    <form class="" action="{{ url('DeliveryChallan/show/fromDate') }}" style="margin-top: 13px" method="post">
                        @csrf
                        
                        <div class="col-md-3">  
                            <div class="form-group ">
                              <label for="filterBy"> Select Filter By </label>
                              <script> setTimeout(function(){ $("#filterBy").val('{{ $filterBy }}'); $("#filterBy").trigger("change");  }, 3000);</script>
                              <select class="" id="filterBy" name="filterBy" style="width: 100%;"  required>
                                <option value="1">Today's </option>
                                <option value="7" selected>Last Week</option>
                                <option value="15">Last 15 Day</option>
                                <option value="31">Last Month</option>
                                <option value="182">Last 6 Month </option>
                                <option value="365">Last 1 Year</option>
                                <option value="all">All</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-1">
                            <div class="form-group ">
                              <button type="submit" id="submit" style="margin-top: 1.7em;" class=" btn bg-purple "><i class="fa fa-eye"></i> View</button>
                            </div>
                          </div>

                    </form>

                          <div class="col-md-3">
                            <div class="form-group ">
                              <label>Search Items</label>
                              <input type="search" class="form-control typeahead" autocomplete="off"   id="typeaheadinput" placeholder="Search imei/sim No...">
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group ">
                              <label>Search Table</label>
                              <input type="search" class="form-control " onkeyup="searchInput(this.value)"  id="searchInput" placeholder="Search ...">
                            </div>
                          </div>



                    

                  </div>
                  <div class="box-body">

                      <div class="table-responsive">
                          <table id="data_table" class="table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>Sr No.</th>
                                      <th>Challan No</th>
                                      <th>status</th>
                                      <th>Customer</th>
                                      <th>Created By</th>
                                      <th>Description </th>
                                      <th>Total Amount</th>
                                      <!-- <th>GST</th> -->
                                      <th>Payment Status</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                  </tr>
                            </thead>
                              <tbody>
                              @php $index =1; 
                                if (empty($challan)) {
                                  echo "<tr>
                                          <td colspan='5'>No Available Delivery Challan <td>
                                        <tr>" ;
                                }
                               @endphp

                              @foreach($challan as $value)                                    
                                  <tr>
                                  <td>{{ $index++ }}</td>
                                  <td style="color: #337ab7;"><button type="button"  class="btn btn-link info_challan" data-id="{{ $value->id }}" style="text-decoration: underline;">{{ $value->id }}</button></td>
                                  <td>{{ $value->status }}</td>
                                  <td>{{ $value->customer_name }}</td>
                                  <td>{{ $value->created_by_name }}</td>
                                  <td><p class="comment more">{{ $value->description }}</p></td>
                                  <td>{{ $value->total }}</td>
                                  <!-- <td>{{ $value->gst }}</td> -->
                                  <td>
                                    @if($value->payment_status == 'pending')
                                      <label class="label bg-yellow">{{ $value->payment_status }}</label>
                                    @endif

                                    @if($value->payment_status == 'received')
                                      <label class="label bg-green">{{ $value->payment_status }}</label>
                                    @endif

                                    @if($value->payment_status == 'persal')
                                      <label class="label bg-orange">{{ $value->payment_status }}</label>
                                    @endif

                                    @if(empty($value->payment_status))
                                      <label class="label bg-red">not set</label>
                                    @endif

                                    <p class="comment more">{{ $value->payment_status_desc }}</p>

                                  </td>
                                  <td>{{ date('M jS, Y A', strtotime($value->created_at)) }}  </td>
                                  <td>
                                    <a href="{{ url('DeliveryChallan/downloadPDF') }}/{{ $value->id }}" class="btn btn-danger"><i class="fa fa-download"></i> PDF </a>

                                    <a href="{{ url('DeliveryChallan/printChallan') }}/{{ $value->id }}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> View </a>

                                    <!-- <a class="btn bg-green" href="https://web.whatsapp.com" target="_blank"> <i class="fab fa-whatsapp" ></i> Share via Whatsapp</a> -->
                                    <button type="button" class="btn btn edit_status" data-id="{{ $value->id }}"  data-payment_status="{{ $value->payment_status }}"> <i class="fa fa-edit  "></i></button>
                                    <button type="button" class="btn btn send_email_btn" data-id="{{ $value->id }}"  data-customer_email="{{ $value->customer_email }}" data-to_name="{{ $value->customer_name }}"> <i class="glyphicon glyphicon-envelope"></i></button>

                                    <button type="button" class="btn btn delete_challan_btn" data-id="{{ $value->id }}"> <i class="fas fa-trash-alt  " style="color: red;"></i></button>
                                    
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
    

   <div class="modal fade" id="modal_edit_status" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Payment Stauts </h4>
              </div>
             <form method="post"  action="{{ route('deliveryChallanStatusUpdate') }}">
              <div class="modal-body row">
                  @csrf
                  <input type="hidden" class="challan_no" name="id" id="id">

                  <div class="col-md-12">
                    <div class="form-group ">
                      <label for="imei">Challan No</label>
                      <input type="number" class="form-control challan_no"  name="challan_no" id="challan_no" placeholder="Enter challan no" readonly="" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="payment_status">Payment Status <!-- <span class="imp_field">*</span> --></label>
                        <select class="form-control" id="payment_status" name="payment_status" style="width: 100%;"  required>
                            <option value="pending" selected>pending</option>
                            <option value="received">received</option>
                            <option value="persal">persal</option>
                        </select>
                    </div>
                    
                  </div>

                  <div class="col-md-12">
                    <div class="form-group ">
                      <label for="payment_status_desc">Payment Status Description</label>
                      <textarea rows="3"  class="form-control payment_status_desc" id="payment_status_desc" name="payment_status_desc" placeholder="Payment Status Description"
                        ></textarea>
                    </div>
                  </div>
                  
              </div>
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

      <!-- showChallanItemsModal -->
      <div class="modal fade" id="showChallanItemsModal" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Show Challan Details </h4>
              </div>
              <div class="modal-body ">
                <div class="col-md-5 pull-right" style="margin-bottom: 10px;">
                  <input type="search" class="form-control" onkeyup="searchInputItems(this.value)" placeholder="search ...">
                </div>

                <table id="showChallanItemsTable" cellpadding="20" width="100%"  style="padding: 10px;" border="2px solid black">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Items</th>
                      <th>Item Type</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Description</th>
                      <th>Created at</th>
                    </tr>
                  </thead>
                  <tbody id="showChallanItemsTableBody">
                    
                  </tbody>
                </table>
              </div>
              <div class="modal-footer" style="margin-top: 1em">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.modal -->


  
<!-- /.content -->
  </div>


  <div class="modal fade" id="modal_send_email" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Send Challan Copy On Email </h4>
              </div>
             <form method="post"  action="{{ route('sendChallanEmail') }}">
              <div class="modal-body row">
                  @csrf
                  <input type="hidden" class="challan_no" name="id" id="id">

                  <div class="col-md-12">
                    <div class="form-group ">
                      <label for="imei">Challan No</label>
                      <input type="number" class="form-control challanNo"  name="challanNo" id="challanNo" placeholder="Enter challan no" readonly="" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="to_email">To Email-Id </label>
                        <input type="email" class="form-control to_email"  name="to_email" id="to_email" placeholder="Enter To Email"  required>
                        <input type="hidden" class="form-control to_name"  name="to_name" id="to_name" placeholder="Enter To name"  >
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="to_email">Email CC</label>
                        <input type="email" class="form-control to_c_email"  name="to_cc_email" id="to_cc_email" placeholder="Enter To  CC email" >
                    </div>
                  </div>

              <div class="modal-footer" style="margin-top: 1em">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                &nbsp;<button type="submit" class="btn btn-primary" style="margin-right: 8px;">Send</button>
              </div>

            </form>
            <!-- /.form -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<!-- /.content -->
  </div>
<input type="hidden" id="token" value="{{ csrf_token() }}" name="_token">
@endsection

@push("scripts")

<script>
$(document).ready(function() {
    var showChar = 20;
    var ellipsestext = "...";
    var moretext = "more";
    var lesstext = "less";
    $('.more').each(function() {
      var content = $(this).html();

      if(content.length > showChar) {

        var c = content.substr(0, showChar);
        var h = content.substr(showChar-1, content.length - showChar);

        var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

        $(this).html(html);
      }

    });

    $(".morelink").click(function(){
      if($(this).hasClass("less")) {
        $(this).removeClass("less");
        $(this).html(moretext);
      } else {
        $(this).addClass("less");
        $(this).html(lesstext);
      }
      $(this).parent().prev().toggle();
      $(this).prev().toggle();
      return false;
    });
});
</script>
@endpush




  